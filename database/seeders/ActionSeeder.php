<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = [
            'Tightened quality control steps for each batch.',
            'Calibrated the machine to correct measurement errors.',
            'Trained operators on the latest SOP updates.',
            'Installed sensor monitoring system to detect faults.',
            'Replaced faulty tooling that caused defects.',
            'Standardized incoming material checks.',
            'Updated work instructions with visual guides.',
            'Implemented barcode scanning for raw material traceability.',
            'Scheduled regular equipment maintenance.',
            'Set up error-proofing mechanisms in critical processes.',
        ];

        $now = Carbon::now();

        foreach (range(1, 10) as $i) {
            DB::table('actions')->insert([
                'issue_id' => rand(6,7), // fixed as per requirement
                'root_cause_id' => rand(47, 56), // adjust according to seeded root_cause IDs
                'type' => rand(0, 1) ? 'CORRECTIVE' : 'PREVENTIVE',
                'description' => $descriptions[array_rand($descriptions)],
                'pic_id' => rand(1, 7),
                'due_date' => $now->copy()->addDays(rand(3, 30)),
                'status' => rand(0, 1) ? 'PROGRESS' : 'FINISHED',
                'evidence_files' => null,
                'evidence_description' => null,
                'created_by' => rand(1, 7),
                'created_at' => $now->subDays(rand(1, 15)),
                'updated_at' => $now,
            ]);
        }
    }
}
