<?php
namespace App\Jobs;

use App\Models\GenbaReports;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class FetchGembaReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $session_id;
    protected $file_id;
    protected $apiUrl;
    protected $apiKey;

    public $timeout = 300; // seconds
    public $tries = 3;

    public function __construct($sessionId, $fileId, $apiUrl, $apiKey)
    {
        $this->session_id = $sessionId;
        $this->file_id = $fileId;
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function handle()
    {
        try {
            $response = Http::withHeaders([
                'X-API-KEY' =>  $this->apiKey,
            ])->timeout(300)
            ->get("{$this->apiUrl}/sessions/{$this->session_id}/gemba_report_pdf");
    
            $content = $response->getBody()->getContents();
            $filename = 'gemba_report_session-' . $this->session_id . '- ' . Carbon::now()->format('Ymd_His') . '.pdf';
            $path = 'gemba_reports/' . $filename;
    
            Storage::disk('public')->put($path, $content);
    
            $url = Storage::url($path);

            GenbaReports::where("id", $this->file_id)->update([
                "filename" => $filename,
                "path" => $url
            ]);
    
            // You can log it or store result to database
            Log::info("Fetched report for session {$this->session_id}: " . $response->status());
        } catch (\Exception $e) {
            Log::error("Failed to fetch report for session {$this->session_id}: " . $e->getMessage());
        }
    }
}

