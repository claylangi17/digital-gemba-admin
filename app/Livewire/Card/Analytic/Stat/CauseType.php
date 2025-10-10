<?php

namespace App\Livewire\Card\Analytic\Stat;

use App\Models\RootCauses;
use Livewire\Component;

class CauseType extends Component
{
    public $environment;
    public $material;
    public $man;
    public $method;
    public $machine;

    public function mount()
    {
        $this->environment = RootCauses::where("category", "environment")
            ->whereHas('issue', function($query) {
                $query->where('session_id', '!=', 1);
            })->count();
        $this->material = RootCauses::where("category", "material")
            ->whereHas('issue', function($query) {
                $query->where('session_id', '!=', 1);
            })->count();
        $this->man = RootCauses::where("category", "man")
            ->whereHas('issue', function($query) {
                $query->where('session_id', '!=', 1);
            })->count();
        $this->method = RootCauses::where("category", "method")
            ->whereHas('issue', function($query) {
                $query->where('session_id', '!=', 1);
            })->count();
        $this->machine = RootCauses::where("category", "machine")
            ->whereHas('issue', function($query) {
                $query->where('session_id', '!=', 1);
            })->count();
    }
    
    public function render()
    {
        return view('livewire.card.analytic.stat.cause-type');
    }
}
