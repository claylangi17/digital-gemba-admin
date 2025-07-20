<?php

namespace App\Livewire\Modal\View;

use App\Jobs\FetchGembaReportPdf;
use App\Models\GenbaReports;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class Report extends Component
{
    public $isLoading = false;
    public $session_id;
    public $category;
    public $show;
    public $line;
    public $problem;
    public $reports;
    public $isReportReady = true;
    
    public function mount() {
        $this->show = false;
    }

    protected $listeners = [
        'showModalAIReport' => 'showModal',
        'getGembaReports' => 'getReports',
    ];

    public function showModal($session_id) 
    {
        $this->session_id = $session_id;
        $this->getReports();
        $this->doShow();
    }

    public function getReports()
    {
        $this->reports = GenbaReports::where('session_id', $this->session_id)->orderByDesc('created_at')->get();
    }

    public function create_report()
    {
        $this->isReportReady = false;

        $record = GenbaReports::create([
            'session_id' => $this->session_id,
            'path' => "",
            'filename' => ""
        ]);

        FetchGembaReportPdf::dispatch(
            $this->session_id,
            $record->id,
            config('services.genba_ai.url'),
            config('services.genba_ai.key'),
        );
    }

    public function checkIfReportReady()
    {
        $this->isReportReady = GenbaReports::where("session_id", $this->session_id)->orderByDesc('created_at')->first()->path != "";

        if ($this->isReportReady) {
            $this->getReports();
        };
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
        return view('livewire.modal.view.report');
    }
}
