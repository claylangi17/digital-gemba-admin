<?php

namespace App\Livewire\Modal\View;

use App\Models\GenbaReports;
use App\Models\GenbaSessions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Report extends Component
{
    public $isLoading = false;
    public $session_id;
    public $category;
    public $show;
    public $line;
    public $problem;
    public $reports;
    
    public function mount() {
        $this->show = false;
    }

    protected $listeners = [
        'showModalAIReport' => 'showModal',
    ];

    public function showModal($session_id) 
    {
        $this->session_id = $session_id;
        $this->getReports();
        $this->doShow();
    }

    public function getReports()
    {
        $this->reports = GenbaReports::where('session_id', $this->session_id)->orderByDesc('created_at')->get();
    }

    public function create_report()
    {

        $apiUrl = config('services.genba_ai.url');
        $apiKey = config('services.genba_ai.key');

        if (!$apiUrl || !$apiKey) {
            // Log an error or return a specific response
            Log::error('API URL or Key is not configured.');
            return response()->json(['error' => 'API service is not configured.'], 500);
        }

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->timeout(300)
        ->get("{$apiUrl}/sessions/{$this->session_id}/gemba_report_pdf");

        $content = $response->getBody()->getContents();
        $filename = 'gemba_report_session-' . $this->session_id . '- ' . Carbon::now()->format('Ymd_His') . '.pdf';
        $path = 'gemba_reports/' . $filename;

        Storage::disk('public')->put($path, $content);

        $url = Storage::url($path);

        GenbaReports::create([
            "session_id" => $this->session_id,
            "filename" => $filename,
            "path" => $url
        ]);

        $this->getReports();
    }

    public function doShow() {
        $this->show = true;

    }

    public function doClose()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.modal.view.report');
    }
}
