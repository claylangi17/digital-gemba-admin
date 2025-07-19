<?php

namespace App\Http\Controllers;

use App\Models\AppreciationNoteFiles;
use App\Models\AppreciationNotes;
use App\Models\PointHistories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AppreciationNoteFileController extends Controller
{
    public function create_api(Request $request)
    {
        try {

            $request->validate([
                'appreciation_note_id' => "required",
                'files.*' => "required|file|mimes:jpeg,png,jpg,gif|max:20480"
            ],
            [
                "appreciation_note_id.required" => "Please attach appreciation_note_id",
                "user_id.required" => "Please attach user_id",
                "files.*.required" => "File not found",
            ]);

            $createdFiles = [];

            foreach ($request->file('files', []) as $file) {

                // Generate unique file name
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store file
                $path = $file->storeAs(
                    'uploads/appreciation/note' . (string) $request->action_id,
                    $filename,
                    'public'
                );

                // Determine type
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";

                // Create record
                $appreciationNoteFile = AppreciationNoteFiles::create([
                    'appreciation_note_id' => $request->appreciation_note_id,
                    'user_id' => $request->user_id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);

                $createdFiles[] = $appreciationNoteFile;
            }

            return response()->json([
                'status' => '200',
                'message' => 'Appreciation Note Files were succesfully uploaded',
                'data' => [
                    'files' => $createdFiles,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to add Appreciation Note Files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_api($appreciation_note_id)
    {
        try {

            if (!$appreciation_note_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach appreciation_note_id ',
                    'data' => []
                ]);
            }

            $files = [];

            $records = AppreciationNoteFiles::where('appreciation_note_id', $appreciation_note_id)->get();

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
                'message' => 'Appreciation Note File list fetched successfully',
                'data' => [
                    'appreciation_note_id' => $appreciation_note_id,
                    'files' => $files,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch Appreciation Note files via API', ['error' => $e->getMessage()]);

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

            $record = AppreciationNoteFiles::find($file_id);

            if ($record) {
                $record->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Appreciation Note File has been deleted',
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
            Log::error('Failed to delete Appreciation Note files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
