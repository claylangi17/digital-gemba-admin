<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MediaProxyController extends Controller
{
    /**
     * Proxy media files from external server with SSL bypass and local caching
     */
    public function proxy(Request $request, $path)
    {
        // Define cache path
        $cachePath = "media_cache/{$path}";

        // Check if file exists in local cache
        if (Storage::disk('public')->exists($cachePath)) {
            $mimeType = Storage::disk('public')->mimeType($cachePath);
            $content = Storage::disk('public')->get($cachePath);

            return response($content)
                ->header('Content-Type', $mimeType)
                ->header('Cache-Control', 'public, max-age=864000') // 10 days
                ->header('Access-Control-Allow-Origin', '*')
                ->header('X-Cache', 'HIT');
        }

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
                $content = $response->body();

                // Save to local cache
                Storage::disk('public')->put($cachePath, $content);
                
                // Return the file content with proper headers
                return response($content)
                    ->header('Content-Type', $contentType)
                    ->header('Cache-Control', 'public, max-age=864000') // 10 days
                    ->header('Access-Control-Allow-Origin', '*')
                    ->header('X-Cache', 'MISS');
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