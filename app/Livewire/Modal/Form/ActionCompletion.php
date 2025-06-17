<?php

namespace App\Livewire\Modal\Form;

use App\Models\Actions;
use Livewire\Component;

class ActionCompletion extends Component
{
    public $action;
    public $show;

    public function mount() {
        $this->show = false;
        $this->action = null;
    }
    
    protected $listeners = ['showModalFormActionCompletion' => 'showModal'];
    
    public function showModal($action_id) 
    {
        $this->action = Actions::where('id', $action_id)->first();

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
        return view('livewire.modal.form.action-completion');
    }
}
