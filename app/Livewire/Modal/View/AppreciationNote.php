<?php

namespace App\Livewire\Modal\View;

use App\Models\AppreciationNotes;
use Livewire\Component;

class AppreciationNote extends Component
{
    public $note;
    public $show;

    public function mount() {
        $this->note = null;
    }

    protected $listeners = ['showModalViewAppreciationNote' => 'showModal'];

    public function showModal($id) 
    {
        $this->note = AppreciationNotes::with('byUser')->where('id', $id)->first();

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
        return view('livewire.modal.view.appreciation-note');
    }
}
