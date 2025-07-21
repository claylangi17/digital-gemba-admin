<?php

namespace App\Http\Controllers;

use App\Models\GenbaReports;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class GembaReportController extends Controller
{
    public function create($session_id)
    {
        $apiUrl = config('services.genba_ai.url');
        $apiKey = config('services.genba_ai.key');

        if (!$apiUrl || !$apiKey) {
            // Log an error or return a specific response
            Log::error('API URL or Key is not configured.');
            return response()->json(['error' => 'API service is not configured.'], 500);
        }

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
        ])->timeout(300)
        ->get("{$apiUrl}/sessions/{$session_id}/gemba_report_pdf");

        $content = $response->getBody()->getContents();
        $filename = 'gemba_report_session-' . $session_id . '- ' . Carbon::now()->format('Ymd_His') . '.pdf';
        $path = 'gemba_reports/' . $filename;

        Storage::disk('public')->put($path, $content);

        $url = Storage::url($path);

        GenbaReports::create([
            "session_id" => $session_id,
            "filename" => $filename,
            "path" => $url
        ]);

        return response()->json(['status' => 'Success'], 200);
    }
}
