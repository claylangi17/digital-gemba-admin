<?php

namespace App\Http\Controllers;

use App\Models\RootCauseFiles;
use App\Models\RootCauses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RootCauseFileController extends Controller
{
    public function create_api(Request $request)
    {
        try {

            $request->validate([
                'cause_id' => "required",
                'user_id' => "required",
                'files.*' => "required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ],
            [
                "cause_id.required" => "Please attach cause_id",
                "user_id.required" => "Please attach user_id",
                "files.*.required" => "File not found",
            ]);

            $createdFiles = [];

            foreach ($request->file('files', []) as $file) {

                // Generate unique file name
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store file
                $path = $file->storeAs(
                    'uploads/root-cause/' . (string) $request->cause_id,
                    $filename,
                    'public'
                );

                // Determine type
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";

                // Create record
                $rootCauseFile = RootCauseFiles::create([
                    'root_cause_id' => $request->cause_id,
                    'user_id' => $request->user_id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);

                $createdFiles[] = $rootCauseFile;
            }

            return response()->json([
                'status' => '200',
                'message' => 'Root Cause Files were succesfully uploaded',
                'data' => [
                    'files' => $createdFiles,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to add Root Cause Files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_api($cause_id)
    {
        try {

            if (!$cause_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach cause_id ',
                    'data' => []
                ]);
            }

            $files = [];

            $records = RootCauseFiles::where('root_cause_id', $cause_id)->get();

            foreach ($records as $record) {
                $files[] = [
                    'id' => $record->id,
                    'user_id' => $record->user_id,
                    'type' => $record->type,
                    'path' => $record->path,
                ];
            }

            return response()->json([
                'status' => '200',
                'message' => 'Root Cause File list fetched successfully',
                'data' => [
                    'cause_id' => $cause_id,
                    'files' => $files,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch root cause files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete_api($file_id)
    {
        try {

            if (!$file_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach file_id of the file',
                    'data' => []
                ]);
            }

            $record = RootCauseFiles::find($file_id);

            if ($record) {
                $record->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Root Cause File has been deleted',
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'File not found',
                    'data' => []
                ]);
            }
            

        } catch (\Exception $e) {
            Log::error('Failed to delete root cause files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
