<?php

namespace App\Livewire\Card\Analytic\Stat;

use App\Models\Lines;
use Livewire\Component;

class Area extends Component
{
    public $lines;
    
    public function mount()
    {
        $this->lines = Lines::withCount('issues')
        ->orderBy('issues_count', 'desc')
        ->take(5)
        ->get();
    }
    
    public function render()
    {
        return view('livewire.card.analytic.stat.area');
    }
}
