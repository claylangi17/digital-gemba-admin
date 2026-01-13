<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PointHistories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResetMonthlyPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-monthly-points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all user points to 0 and archive the history. Runs monthly.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting monthly point reset...');
        Log::info('Starting monthly point reset command.');

        try {
            DB::transaction(function () {
                // Get all users with points > 0
                // processing in chunks to avoid memory issues if there are many users
                User::where('points', '>', 0)->chunk(100, function ($users) {
                    foreach ($users as $user) {
                        try {
                            $currentPoints = $user->points;

                            // Create history record
                            PointHistories::create([
                                'userid'       => $user->id,
                                'description'  => 'Reset Poin Bulanan',
                                'type'         => 'DEC',       // Using 'DEC' as per ENUM('INC','DEC')
                                'category'     => 'NOTE',      // Using 'NOTE' as per ENUM('ROOT','SOL','PRE','NOTE')
                                'point_before' => $currentPoints,
                                'point_earned' => -$currentPoints,
                                'point_after'  => 0,
                            ]);

                            // Reset user points
                            $user->update(['points' => 0]);
                            
                        } catch (\Exception $e) {
                            Log::error("Failed to reset points for user ID {$user->id}: " . $e->getMessage());
                            // We might want to continue to other users even if one fails, 
                            // but inside a transaction, usually we want all or nothing.
                            // However, strictly speaking for a batch job safely, catching here helps logging
                            // but re-throwing ensures transaction rolls back if data integrity is key.
                            // For this case, let's re-throw to be safe about the transaction state.
                            throw $e;
                        }
                    }
                });
            });

            $this->info('Successfully reset points for all eligible users.');
            Log::info('Monthly point reset completed successfully.');
            return 0;

        } catch (\Exception $e) {
            $this->error('An error occurred during the point reset: ' . $e->getMessage());
            Log::error('Monthly point reset failed: ' . $e->getMessage());
            return 1;
        }
    }
}
