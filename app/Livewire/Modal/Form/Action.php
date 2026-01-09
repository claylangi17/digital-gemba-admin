<?php

namespace App\Livewire\Modal\Form;

use App\Models\Actions;
use App\Models\RootCauses;
use App\Models\User;
use Livewire\Component;

class Action extends Component
{
    public $action;
    public $users;
    public $show;
    public $mode;
    public $issue_id;
    public $causes = null;

    public function mount() {
        $this->show = false;
        $this->action = null;
        $this->users = [];
        $this->mode = 'create';
        $this->issue_id = null;
    }

    protected $listeners = ['showModalFormAction' => 'showModal'];

    public function showModal($issue_id, $action_id = null) 
    {
        $this->issue_id = $issue_id;
        
        // Find issue to get session and factory
        $issue = \App\Models\Issues::with('session')->find($issue_id);
        $factory_id = $issue && $issue->session ? $issue->session->factory_id : null;

        // Fetch users filtered by factory
        if ($factory_id) {
            $this->users = User::where('factory_id', $factory_id)->get();
        } else {
            $this->users = User::all();
        }
        
        if ($action_id)
        {
            $this->action = Actions::where('id', $action_id)->first();
            $this->mode = "update";
        } else {
            $this->action = null;
            $this->mode = "create";
        }

        $this->causes = RootCauses::where('issue_id', $issue_id)->get();

        $this->doShow();
    }

    public function doShow() {
        $this->dispatch('initActionRootCauseSelector');
        $this->show = true;
    }

    public function doClose()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.modal.form.action');
    }
}
