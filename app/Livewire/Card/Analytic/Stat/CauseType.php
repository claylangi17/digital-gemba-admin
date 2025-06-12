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
        $this->environment = RootCauses::where("category", "environment")->count();
        $this->material = RootCauses::where("category", "material")->count();
        $this->man = RootCauses::where("category", "man")->count();
        $this->method = RootCauses::where("category", "method")->count();
        $this->machine = RootCauses::where("category", "machine")->count();
    }
    
    public function render()
    {
        return view('livewire.card.analytic.stat.cause-type');
    }
}
