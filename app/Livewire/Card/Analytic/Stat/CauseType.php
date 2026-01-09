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
            ->whereHas('issue.session')->count();
        $this->material = RootCauses::where("category", "material")
            ->whereHas('issue.session')->count();
        $this->man = RootCauses::where("category", "man")
            ->whereHas('issue.session')->count();
        $this->method = RootCauses::where("category", "method")
            ->whereHas('issue.session')->count();
        $this->machine = RootCauses::where("category", "machine")
            ->whereHas('issue.session')->count();
    }
    
    public function render()
    {
        return view('livewire.card.analytic.stat.cause-type');
    }
}
