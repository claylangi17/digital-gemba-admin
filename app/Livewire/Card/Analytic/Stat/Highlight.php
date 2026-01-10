<?php

namespace App\Livewire\Card\Analytic\Stat;

use App\Models\Actions;
use App\Models\AppreciationNotes;
use App\Models\Issues;
use Carbon\Carbon;
use Livewire\Component;

class Highlight extends Component
{
    public $total_issue;
    public $total_issue_last;

    public $done_issue;
    public $done_issue_last;

    public $overdue_action;
    public $overdue_action_last;

    public $total_appreciation;
    public $total_appreciation_last;
    
    public function get_data()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;

        // Current month data
        $this->total_issue = Issues::whereMonth('created_at', $currentMonth)
                                  ->whereYear('created_at', $currentYear)
                                  ->whereHas('session')
                                  ->count();

        $this->done_issue = Issues::whereMonth('created_at', $currentMonth)
                                 ->whereYear('created_at', $currentYear)
                                 ->where('status', 'CLOSED')
                                 ->whereHas('session')
                                 ->count();

        $this->overdue_action = Actions::whereMonth('due_date', $currentMonth)
                                      ->whereYear('due_date', $currentYear)
                                      ->where('status', 'PENDING')
                                      ->where('due_date', '<', Carbon::now())
                                      ->whereHas('issue.session')
                                      ->count();

        $this->total_appreciation = AppreciationNotes::whereMonth('created_at', $currentMonth)
                                                    ->whereYear('created_at', $currentYear)
                                                    ->whereHas('session')
                                                    ->count();
    }

    public function get_data_last()
    {
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;

        // Previous month data
        $this->total_issue_last = Issues::whereMonth('created_at', $previousMonth)
                                       ->whereYear('created_at', $previousYear)
                                       ->whereHas('session')
                                       ->count();

        $this->done_issue_last = Issues::whereMonth('created_at', $previousMonth)
                                      ->whereYear('created_at', $previousYear)
                                      ->where('status', 'CLOSED')
                                      ->whereHas('session')
                                      ->count();

        $this->overdue_action_last = Actions::whereMonth('due_date', $previousMonth)
                                           ->whereYear('due_date', $previousYear)
                                           ->where('status', 'PENDING')
                                           ->where('due_date', '<', Carbon::now()->subMonth())
                                           ->whereHas('issue.session')
                                           ->count();

        $this->total_appreciation_last = AppreciationNotes::whereMonth('created_at', $previousMonth)
                                                         ->whereYear('created_at', $previousYear)
                                                         ->whereHas('session')
                                                         ->count();
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
