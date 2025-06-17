<?php

namespace App\Livewire\Card\Table\Issue;

use App\Models\Actions;
use Livewire\Component;

class Action extends Component
{
    public $actions;
    public $issue;

    protected $listeners = [
        'triggerActionChangeCategory' => 'change_category',
        'deleteActionConfirmed' => 'delete'
    ];

    public function mount($issue)
    {
        $this->issue = $issue;
        $this->get_data();
    }

    public function change_category($category)
    {
        $this->get_data($category);

        $this->dispatch('resetGenbaActionTable');
    }

    public function reload()
    {
        $this->get_data();

        $this->dispatch('resetGenbaActionTable');
    }

    public function get_data($category = 'all')
    {
        if ($category == 'all')
        {
            $this->actions = Actions::where('issue_id', $this->issue->id)->get();
        } else {
            $this->actions = Actions::whereHas('rootCause', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->where('issue_id', $this->issue->id)
            ->get();
        }
    }

    public function delete($id)
    {
        Actions::where('id',$id)->delete();
        $this->dispatch("lv-toast-success", ["message" => "Aksi berhasil dihapus"]);

        $this->reload();
    }
    
    public function render()
    {
        return view('livewire.card.table.issue.action');
    }
}
