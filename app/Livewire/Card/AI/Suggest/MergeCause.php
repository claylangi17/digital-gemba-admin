<?php

namespace App\Livewire\Card\AI\Suggest;

use App\Models\RootCauses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MergeCause extends Component
{
    public $show;
    public $issue_id;
    public $suggestions = [];


    public function mount($id)
    {
        $this->issue_id = $id;
    }

    protected $listeners = ['showModalAISuggestMergeCause' => 'showModal'];

    public function showModal() 
    {
        $this->doShow();
    }

    public function get_suggestion()
    {
        $this->suggestions = [];
        
        $causes = RootCauses::where('issue_id', $this->issue_id)->get();
        $rootCausesPayload = [];

        foreach ($causes as $cause) {
            $rootCausesPayload[] = [
                'root_cause' => $cause->description,
                'user_id' => (string) $cause->created_by,
            ];
        }

        $apiUrl = config('services.genba_ai.url');
        $apiKey = config('services.genba_ai.key');

        if (!$apiUrl || !$apiKey) {
            // Log an error or return a specific response
            Log::error('API URL or Key is not configured.');
            return;
        }

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->post("{$apiUrl}/root-cause/merge", [
            // Pass the PHP array directly. Laravel's HTTP client will handle JSON encoding.
            "root_causes" => $rootCausesPayload,
        ]);

        if ($response->successful()) {
            // Store the suggestions in the array
            $data = $response->json();
            foreach ($data['merged_root_causes'] as $cause) {

                $originals = [];

                foreach ($cause["original_data"] as $original) {
                    $originals[] = $original["root_cause"];
                }

                $this->suggestions[] = [
                    "merged" => $cause["merged_root_cause"],
                    "category" => strtolower($cause["category"]),
                    "originals" => implode(", ", $originals),
                ];
            }
        } else {
            // Optional: handle error, maybe log it
            $this->suggestions = [];
        }
    }

    public function save_suggestion($rawData)
    {
        // cause_id#type#description
        // $data = explode('#', $rawData);
        
        RootCauses::create([
            'issue_id' => $this->issue_id,
            'category' => $rawData["category"],
            'description' => $rawData["merged"],
            'created_by' => Auth::user()->id,
        ]);

        // Remove the saved suggestion from the list
        $this->suggestions = array_filter($this->suggestions, function ($item) use ($rawData) {
            return $item !== $rawData;
        });

        // Optional: Reset array keys
        $this->suggestions = array_values($this->suggestions);


        $this->dispatch('lv-toast-success', ['message' => 'Saran Akar Masalah Gabungan Berhasil Disimpan']);
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
        return view('livewire.card.a-i.suggest.merge-cause');
    }
}
