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

    public function showModal($id, $issue_id = null) 
    {
        if ($id != '')
        {
            $this->cause = RootCauses::where('id', $id)->first();
            $this->mode = "update";
        }

        if ($issue_id)
        {
            $this->issue_id = $issue_id;
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
