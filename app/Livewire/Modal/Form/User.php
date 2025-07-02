<?php

namespace App\Livewire\Modal\Form;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $user;
    public $show;
    public $mode;

    public function mount() {
        $this->user = null;
        $this->mode = 'create';
    }

    protected $listeners = ['showModalFormUser' => 'showModal'];

    public function showModal($id) 
    {
        if ($id)
        {
            $this->user = ModelsUser::where('id', $id)->first();
            $this->mode = "update";
        } else {
            $this->user = null;
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
        return view('livewire.modal.form.user');
    }
}
