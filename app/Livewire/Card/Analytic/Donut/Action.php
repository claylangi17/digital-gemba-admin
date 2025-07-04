<?php

namespace App\Livewire\Card\Analytic\Donut;

use App\Models\Actions;
use Carbon\Carbon;
use Livewire\Component;

class Action extends Component
{
    public $timeScope;
    public $overdue;
    public $progress;
    public $finish;
    
    public function mount()
    {    
        $this->timeScope = "all";
        $this->getData();
    }

    public function changeTimeScope ($timeScope)
    {
        $this->timeScope = $timeScope;
        $this->getData();
    }

    public function getData()
    {
        $now = Carbon::now();

        if ($this->timeScope === 'year') {
            $actions = Actions::whereYear("created_at", $now->year);
        } elseif ($this->timeScope === 'month') {
            $actions = Actions::whereYear("created_at", $now->year)
                            ->whereMonth("created_at", $now->month);
        } elseif ($this->timeScope === 'day') {
            $actions = Actions::whereYear("created_at", $now->year)
                            ->whereMonth("created_at", $now->month)
                            ->whereDay("created_at", $now->day);
        } else {
            $actions = Actions::query(); // all data
        }

        $this->overdue = (clone $actions)->where('status', "PROGRESS")
                                        ->wherePast('due_date')
                                        ->count();

        $this->progress = (clone $actions)->where('status', "PROGRESS")
                                        ->whereFuture('due_date')
                                        ->count();

        $this->finish = (clone $actions)->where('status', "FINISHED")
                                        ->count();
    }

    public function rendered($view, $html)
    {        
        $this->dispatch('requestChartUpdate');
    }

    public function render()
    {
        return view('livewire.card.analytic.donut.action');
    }
}
