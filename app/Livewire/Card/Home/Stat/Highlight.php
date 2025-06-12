<?php

namespace App\Livewire\Card\Home\Stat;

use App\Models\GenbaSessions;
use Livewire\Component;

class Highlight extends Component
{
    public $total;
    public $progress;
    public $finish;

    public function get_data()
    {
        $sessions = GenbaSessions::all();

        $this->total = $sessions->count();
        $this->progress = $sessions->where("status", "PROGRESS")->count();
        $this->finish = $sessions->where("status", "FINISH")->count();
    }

    public function mount()
    {
        $this->get_data();
    }
    
    public function render()
    {
        return view('livewire.card.home.stat.highlight');
    }
}
