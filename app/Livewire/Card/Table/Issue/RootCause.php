<?php

namespace App\Livewire\Card\Table\Issue;

use App\Models\RootCauses;
use Livewire\Component;

class RootCause extends Component
{
    public $root_causes;
    public $issue;

    public function mount($issue)
    {
        $this->issue = $issue;
        $this->get_data();
    }

    public function change_category($category)
    {
        $this->get_data($category);

        $this->dispatch('resetGenbaCauseTable');
        $this->dispatch('triggerActionChangeCategory', $category);
    }

    public function reload()
    {
        $this->get_data();

        $this->dispatch('resetGenbaCauseTable');
    }

    public function get_data($category = 'all')
    {
        if ($category == 'all')
        {
            $this->root_causes = RootCauses::where('issue_id', $this->issue->id)->get();
        } else {
            $this->root_causes = RootCauses::where('issue_id', $this->issue->id)->where('category', $category)->get();
        }
    }
    
    public function render()
    {
        return view('livewire.card.table.issue.root-cause');
    }
}
