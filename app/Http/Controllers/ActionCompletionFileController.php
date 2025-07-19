<?php

namespace App\Http\Controllers;

use App\Models\ActionCompletionFiles;
use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ActionCompletionFileController extends Controller
{
    public function create_api(Request $request)
    {
        try {

            $request->validate([
                'action_id' => "required",
                'user_id' => "required",
                'files.*' => "required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,webm|max:20480"
            ],
            [
                "action_id.required" => "Please attach action_id",
                "user_id.required" => "Please attach user_id",
                "files.*.required" => "File not found",
            ]);

            $createdFiles = [];

            foreach ($request->file('files', []) as $file) {

                // Generate unique file name
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store file
                $path = $file->storeAs(
                    'uploads/action/completion/' . (string) $request->action_id,
                    $filename,
                    'public'
                );

                // Determine type
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";

                // Create record
                $actionCompletionFile = ActionCompletionFiles::create([
                    'action_id' => $request->action_id,
                    'user_id' => $request->user_id,
                    'type' => str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO",
                    'path' => $path,
                ]);

                $createdFiles[] = $actionCompletionFile;
            }

            return response()->json([
                'status' => '200',
                'message' => 'Action Completion Files were succesfully uploaded',
                'data' => [
                    'files' => $createdFiles,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to add Action Completion Files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_api($action_id)
    {
        try {

            if (!$action_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach action_id ',
                    'data' => []
                ]);
            }

            $files = [];

            $records = ActionCompletionFiles::where('action_id', $action_id)->get();

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
                'message' => 'Action Completion File list fetched successfully',
                'data' => [
                    'action_id' => $action_id,
                    'files' => $files,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch action completion files via API', ['error' => $e->getMessage()]);

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

            $record = ActionCompletionFiles::find($file_id);

            if ($record) {
                $record->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Action completion File has been deleted',
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
            Log::error('Failed to delete action completion files via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
