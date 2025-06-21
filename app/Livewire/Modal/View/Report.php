<?php

namespace App\Livewire\Modal\View;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Report extends Component
{
    public $isLoading = false;
    public $session_id;
    public $category;
    public $show;
    public $line;
    public $problem;
    public $suggestions;
    
    public function mount() {
        $this->show = false;
    }

    protected $listeners = ['showModalAIreport' => 'showModal'];

    public function showModal($session_id) 
    {
        $this->session_id = $session_id;
        $this->doShow();
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
        ])->get("{$apiUrl}/sessions/{$this->session_id}/gemba_report_pdf");

        if ($response->successful()) {
            // Store the suggestions in the array
            $data = $response->json();
            $this->suggestions = $data['suggested_root_causes'] ?? [];
        } else {
            // Optional: handle error, maybe log it
            $this->suggestions = [];
        }
    
        $this->isLoading  = false;
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
