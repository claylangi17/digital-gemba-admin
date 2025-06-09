<?php

namespace App\Livewire\Modal\Form;

use App\Models\Actions;
use App\Models\User;
use Livewire\Component;

class Action extends Component
{
    public $action;
    public $users;
    public $show;

    public function mount() {
        $this->show = false;
        $this->action = null;
    }

    protected $listeners = ['showModalFormAction' => 'showModal'];

    public function showModal($id) 
    {
        $this->action = Actions::where('id', $id)->first();
        $this->users = User::all();

        $this->doShow();
    }

    public function doShow() {
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
