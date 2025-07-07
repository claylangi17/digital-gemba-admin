<?php

namespace App\Livewire\Modal\View;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $user;
    public $show;

    public function mount() {
        $this->user = null;
    }

    protected $listeners = ['showModalViewUser' => 'showModal'];

    public function showModal($id) 
    {
        $this->user = ModelsUser::where('id', $id)->first();

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
        return view('livewire.modal.view.user');
    }
}
