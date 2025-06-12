<?php

namespace App\Livewire\Card\Analytic\Stat;

use App\Models\Lines;
use Livewire\Component;

class Area extends Component
{
    public $lines;
    
    public function mount()
    {
        $this->lines = Lines::all();
    }
    
    public function render()
    {
        return view('livewire.card.analytic.stat.area');
    }
}
