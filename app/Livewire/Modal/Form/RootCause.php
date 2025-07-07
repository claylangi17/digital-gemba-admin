<?php

namespace App\Livewire\Modal\Form;

use App\Models\Actions;
use App\Models\RootCauses;
use App\Models\User;
use Livewire\Component;

class RootCause extends Component
{
    public $cause;
    public $users;
    public $show;
    public $mode;
    public $issue_id;

    public function mount() {
        $this->show = false;
        $this->cause = null;
        $this->users = User::all();
        $this->mode = 'create';
        $this->issue_id = null;
    }

    protected $listeners = ['showModalFormRootCause' => 'showModal'];

    public function showModal($issue_id, $cause_id = null) 
    {
        $this->issue_id = $issue_id;
        
        if ($cause_id)
        {
            $this->cause = RootCauses::where('id', $cause_id)->first();
            $this->mode = "update";
        } else {
            $this->cause = null;
            $this->mode = "create";
        }        

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
        return view('livewire.modal.form.root-cause');
    }
}
