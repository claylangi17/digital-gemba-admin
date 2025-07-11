<?php

namespace App\Livewire\Modal\Form;

use App\Models\Issues;
use App\Models\Items;
use App\Models\Lines;
use App\Models\User;
use Livewire\Component;

class Issue extends Component
{
    public $issue;

    public $users;
    public $lines;
    public $items;

    public $show;
    public $mode;
    public $session_id;

    public function mount() {
        $this->show = false;
        $this->issue = null;
        $this->users = User::all();
        $this->lines = Lines::all();
        $this->items = Items::all();
        $this->mode = 'create';
        $this->session_id = null;
    }

    protected $listeners = ['showModalFormIssue' => 'showModal'];

    public function showModal($session_id, $issue_id = null) 
    {
        $this->session_id = $session_id;
        
        if ($issue_id)
        {
            $this->issue = Issues::where('id', $issue_id)->first();
            $this->mode = "update";
        } else {
            $this->issue = null;
            $this->mode = "create";
        }

        $this->doShow();
    }

    public function doShow() {
        $this->dispatch('initIssueVirSelector');

        if ($this->mode == "update")
        {
            $this->dispatch('UpdateIssueVirSelector');
        }
        $this->show = true;
    }

    public function doClose()
    {
        $this->show = false;
        $this->issue = null;
        $this->session_id = null;
        $this->mode = "create";
    }
    
    public function render()
    {
        return view('livewire.modal.form.issue');
    }
}
