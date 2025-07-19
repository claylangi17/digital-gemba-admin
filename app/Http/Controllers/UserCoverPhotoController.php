<?php

namespace App\Http\Controllers;

use App\Models\ActionCompletionFiles;
use App\Models\Actions;
use App\Models\UserCoverPhoto;
use App\Models\UserProfilePhoto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserCoverPhotoController extends Controller
{
    public function create_api(Request $request)
    {
        try {

            $request->validate([
                'user_id' => "required",
                'files.*' => "required|file|mimes:jpeg,png,jpg,gif|max:20480"
            ],
            [
                "user_id.required" => "Please attach user_id",
                "files.*.required" => "File not found",
                "files.*.file" => "File not found",
                "files.*.mimes" => "Invalid file type",
                "files.*.max" => "File size is too large",
            ]);

            $createdFiles = [];

            foreach ($request->file('files', []) as $file) {

                // Generate unique file name
                $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store file
                $path = $file->storeAs(
                    'uploads/user/cover/' . (string) $request->user_id,
                    $filename,
                    'public'
                );

                // Determine type
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'image/') ? "PHOTO" : "VIDEO";

                // Create record
                $profilePhoto = UserCoverPhoto::create([
                    'user_id' => $request->user_id,
                    'path' => $path,
                ]);

                $createdFiles[] = $profilePhoto;
            }

            return response()->json([
                'status' => '200',
                'message' => 'Cover Photo were succesfully uploaded',
                'data' => [
                    'files' => $createdFiles,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to add Cover Photo via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_api($user_id)
    {
        try {

            if (!$user_id) {
                return response()->json([
                    'status' => '400',
                    'message' => 'Please attach user_id ',
                    'data' => []
                ]);
            }

            $files = [];

            $record = UserCoverPhoto::where('user_id', $user_id)->orderByDesc('created_at')->first();

            $files[] = [
                'id' => $record->id,
                'user_id' => $record->user_id,
                'type' => $record->type,
                'path' => $record->path,
            ];

            return response()->json([
                'status' => '200',
                'message' => 'Cover Photo fetched successfully',
                'data' => [
                    'user_id' => $user_id,
                    'file' => $files,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to fetch Cover photo via API', ['error' => $e->getMessage()]);

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

            $record = UserCoverPhoto::find($file_id);

            if ($record) {
                $record->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Cover photo has been deleted',
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
            Log::error('Failed to delete cover photo via API', ['error' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
