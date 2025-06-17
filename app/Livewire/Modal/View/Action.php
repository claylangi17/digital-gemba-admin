<?php

namespace App\Livewire\Modal\View;

use App\Models\Actions;
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

    protected $listeners = ['showModalViewAction' => 'showModal'];

    public function showModal($id) 
    {
        $this->action = Actions::where('id', $id)->first();

        $this->doShow();

        $this->dispatch('initActionFilesCarousel');
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
        return view('livewire.modal.view.action');
    }
}
