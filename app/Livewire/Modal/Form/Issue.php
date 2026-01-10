<?php

namespace App\Livewire\Modal\Form;

use App\Models\Issues;
use App\Models\Items;
use App\Models\Lines;
use App\Models\User;
use App\Models\IssueFiles;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Issue extends Component
{
    public $issue;
    public $existingFiles = [];

    public $users;
    public $lines;
    public $items;

    public $show;
    public $mode;
    public $session_id;

    public function mount() {
        $this->show = false;
        $this->issue = null;
        $this->users = [];
        $this->lines = [];
        $this->items = [];
        $this->mode = 'create';
        $this->session_id = null;
    }

    protected $listeners = ['showModalFormIssue' => 'showModal'];

    public function showModal($session_id, $issue_id = null) 
    {
        $this->session_id = $session_id;
        
        // Find session to get factory_id
        $session = \App\Models\GenbaSessions::find($session_id);
        $factory_id = $session ? $session->factory_id : null;

        // Base queries
        $userQuery = User::query();
        $lineQuery = Lines::query();
        $itemQuery = Items::query();

        // Apply factory filter if session has a factory
        if ($factory_id) {
            $userQuery->where('factory_id', $factory_id);
            $lineQuery->where('factory_id', $factory_id);
            $itemQuery->where('factory_id', $factory_id);
        }

        $this->users = $userQuery->get();
        $this->lines = $lineQuery->get();
        $this->items = $itemQuery->get();
        
        if ($issue_id)
        {
            $this->issue = Issues::where('id', $issue_id)->first();
            $this->mode = "update";
            
            // Load existing files for this issue
            $this->existingFiles = IssueFiles::where('issue_id', $issue_id)->get();
        } else {
            $this->issue = null;
            $this->mode = "create";
            $this->existingFiles = [];
        }

        $this->doShow();
    }

    public function doShow() {
        $this->dispatch('initIssueVirSelector');

        if ($this->mode == "update")
        {
            $this->dispatch('UpdateIssueVirSelector');
        }
        $this->show = true;
    }

    public function doClose()
    {
        $this->show = false;
        $this->issue = null;
        $this->session_id = null;
        $this->mode = "create";
        $this->existingFiles = [];
    }

    public function deleteFile($fileId)
    {
        try {
            // Find the file record
            $file = IssueFiles::find($fileId);
            
            if ($file) {
                // Delete the physical file from storage
                if (Storage::disk('public')->exists($file->path)) {
                    Storage::disk('public')->delete($file->path);
                }
                
                // Delete the database record
                $file->delete();
                
                // Refresh the existing files list
                if ($this->issue) {
                    $this->existingFiles = IssueFiles::where('issue_id', $this->issue->id)->get();
                }
                
                // Show success message
                $this->dispatch('alert', [
                    'type' => 'success',
                    'message' => 'File berhasil dihapus!'
                ]);
            }
        } catch (\Exception $e) {
            // Show error message
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal menghapus file: ' . $e->getMessage()
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.modal.form.issue');
    }
}
