<?php

namespace App\Livewire\Modal\View;

use App\Models\RootCauses;
use Livewire\Component;

class RootCause extends Component
{
    public $cause;
    public $users;
    public $show;

    public function mount() {
        $this->show = false;
        $this->cause = null;
    }

    protected $listeners = ['showModalViewRootCause' => 'showModal'];

    public function showModal($id) 
    {
        $this->cause = RootCauses::where('id', $id)->first();

        $this->doShow();
    }

    public function doShow() {
        $this->show = true;

        $this->dispatch('initCauseFilesCarousel');
    }

    public function doClose()
    {
        $this->show = false;
    }
    
    public function render()
    {
        return view('livewire.modal.view.root-cause');
    }
}
