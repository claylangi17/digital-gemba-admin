<?php

namespace App\Livewire\Card\AI\Suggest;

use App\Models\Actions;
use App\Models\RootCauses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Action extends Component
{
    public $isLoading = false;
    public $causes = null;
    public $issue_id;
    public $category;
    public $show;
    public $line;
    public $problem;
    public $suggestions = [];
    
    public function mount() {
        $this->show = false;
    }

    protected $listeners = ['showModalAISuggestAction' => 'showModal'];

    public function showModal($issue_id, $line, $problem) 
    {
        $this->line = $line;
        $this->problem = $problem;
        $this->issue_id = $issue_id;

        $this->causes = RootCauses::where('issue_id', $issue_id)->get();

        $this->doShow();

        $this->dispatch('initRootCauseSelector');
    }

    public function get_suggestion($rawData, $type)
    {
        $this->suggestions = [];
        $request_data = explode('#', $rawData);
        
        $this->isLoading  = true;
        $this->category = $request_data[1];
        
        $apiUrl = config('services.genba_ai.url');
        $apiKey = config('services.genba_ai.key');

        if (!$apiUrl || !$apiKey) {
            // Log an error or return a specific response
            Log::error('API URL or Key is not configured.');
            return response()->json(['error' => 'API service is not configured.'], 500);
        }

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->post("{$apiUrl}/actions/suggest", [
            "area" => $this->line,
            "problem" => $this->problem,
            "root_cause" => $request_data[2],
            "category" => $this->category,
        ]);

        if ($response->successful()) {
            // Store the suggestions in the array
            $data = $response->json();

            $actionType = $type == "corrective" ? "temporary_actions" : "preventive_actions";

            foreach ($data[$actionType] as $action) {
                $this->suggestions[] = [
                    "cause_id" => $request_data[0],
                    "type" => $type,
                    "description" => $action,
                ];
            }

        } else {
            // Optional: handle error, maybe log it
            $this->suggestions = [];
        }
    
        $this->dispatch('initRootCauseSelector');
    }

    public function save_suggestion($rawData)
    {
        // cause_id#type#description
        // $data = explode('#', $rawData);
        
        Actions::create([
            'issue_id' => $this->issue_id,
            "root_cause_id" => $rawData["cause_id"],
            'type' => $rawData["type"],
            'pic_id' => Auth::user()->id,
            'description' => $rawData["description"],
            'due_date' => null,
            'status' => "PROGRESS",
            'created_by' => Auth::user()->id
        ]);

        // Remove the saved suggestion from the list
        $this->suggestions = array_filter($this->suggestions, function ($item) use ($rawData) {
            return $item !== $rawData;
        });

        // Optional: Reset array keys
        $this->suggestions = array_values($this->suggestions);


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
        return view('livewire.card.a-i.suggest.action');
    }
}
