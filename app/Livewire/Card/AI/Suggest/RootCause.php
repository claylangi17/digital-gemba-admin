<?php

namespace App\Livewire\Card\AI\Suggest;

use App\Models\RootCauses;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class RootCause extends Component
{
    public $isLoading = false;
    public $issue_id;
    public $category;
    public $show;
    public $line;
    public $problem;
    public $suggestions;
    
    public function mount() {
        $this->show = false;
    }

    protected $listeners = ['showModalAISuggestRootCause' => 'showModal'];

    public function showModal($issue_id, $line, $problem) 
    {
        $this->line = $line;
        $this->problem = $problem;
        $this->issue_id = $issue_id;
        $this->doShow();
    }

    public function get_suggestion($category)
    {
        $this->isLoading  = true;
        $this->category = $category;
        
        $apiUrl = config('services.genba_ai.url');
        $apiKey = config('services.genba_ai.key');

        if (!$apiUrl || !$apiKey) {
            // Log an error or return a specific response
            Log::error('API URL or Key is not configured.');
            return response()->json(['error' => 'API service is not configured.'], 500);
        }

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->post("{$apiUrl}/root-cause/suggest", [
            "area" => $this->line,
            "problem" => $this->problem,
            "category" => $category,
        ]);

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

    public function save_suggestion($suggestion)
    {
        RootCauses::create([
            'issue_id' => $this->issue_id,
            'category' => $this->category,
            'description' => $suggestion,
            'created_by' => Auth::user()->id,
            'supporting_files' => ''
        ]);

        $this->dispatch('lv-toast-success', ['message' => 'Saran Akar Masalah Berhasil Disimpan']);
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
        return view('livewire.card.a-i.suggest.root-cause');
    }
}
