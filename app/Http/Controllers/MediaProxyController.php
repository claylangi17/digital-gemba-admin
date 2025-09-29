<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MediaProxyController extends Controller
{
    /**
     * Proxy media files from external server with SSL bypass
     */
    public function proxy(Request $request, $path)
    {
        // Construct the external URL
        $baseUrl = rtrim(env('APPRECIATION_IMAGE_BASE_URL'), '/');
        $externalUrl = "{$baseUrl}/{$path}";
        
        try {
            // Make HTTP request with SSL verification disabled
            $response = Http::withOptions([
                'verify' => false, // Bypass SSL certificate verification
                'timeout' => 30,
            ])->get($externalUrl);
            
            if ($response->successful()) {
                // Get the content type from the response
                $contentType = $response->header('Content-Type');
                
                // Return the file content with proper headers
                return response($response->body())
                    ->header('Content-Type', $contentType)
                    ->header('Cache-Control', 'public, max-age=3600')
                    ->header('Access-Control-Allow-Origin', '*');
            }
            
            // If external request fails, return 404
            return response()->json(['error' => 'File not found'], 404);
            
        } catch (\Exception $e) {
            // Log the error and return 404
            \Log::error('Media proxy error: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch media'], 500);
        }
    }
}