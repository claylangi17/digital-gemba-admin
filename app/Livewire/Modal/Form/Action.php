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
        $this->users = User::all();
        $this->mode = 'create';
        $this->issue_id = null;
    }

    protected $listeners = ['showModalFormAction' => 'showModal'];

    public function showModal($id, $issue_id = null) 
    {
        if ($id != '')
        {
            $this->action = Actions::where('id', $id)->first();
            $this->mode = "update";
        }

        if ($issue_id)
        {
            $this->issue_id = $issue_id;
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
