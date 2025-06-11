<?php

namespace App\Livewire\Card\Analytic\Stat;

use App\Models\Actions;
use App\Models\AppreciationNotes;
use App\Models\Issues;
use Carbon\Carbon;
use Livewire\Component;

class Highlight extends Component
{
    public $active_issue;
    public $active_issue_last;

    public $done_issue;
    public $done_issue_last;

    public $overdue_action;
    public $overdue_action_last;

    public $total_appreciation;
    public $total_appreciation_last;
    
    public function get_data()
    {
        $this->active_issue = Issues::whereMonth('created_at', Carbon::now()->month)->where('status', "OPEN")->count();
        $this->done_issue = Issues::whereMonth('created_at', Carbon::now()->month)->where('status', "CLOSED")->count();
        $this->overdue_action = Actions::whereMonth('created_at', Carbon::now()->month)->wherePast('due_date')->count();
        $this->total_appreciation = AppreciationNotes::whereMonth('created_at', Carbon::now()->month)->count();
    }

    public function get_data_last()
    {
        $this->active_issue_last = Issues::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', "OPEN")->count();
        $this->done_issue_last = Issues::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', "CLOSED")->count();
        $this->overdue_action_last = Actions::whereMonth('created_at', Carbon::now()->subMonth()->month)->wherePast('due_date')->count();
        $this->total_appreciation_last = AppreciationNotes::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
    }

    public function mount()
    {
        $this->get_data();
        $this->get_data_last();
    }

    public function render()
    {
        return view('livewire.card.analytic.stat.highlight');
    }
}
