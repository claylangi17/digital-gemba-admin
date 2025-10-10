<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpinwheelController extends Controller
{
    /**
     * Display the spinwheel page
     */
    public function index()
    {
        $lines = Lines::orderBy('name', 'asc')->get();
        return view('spinwheel.index', compact('lines'));
    }

    /**
     * Get all lines for AJAX request
     */
    public function getLines()
    {
        $lines = Lines::orderBy('name', 'asc')->get(['id', 'name', 'description']);
        return response()->json([
            'success' => true,
            'data' => $lines
        ]);
    }

    /**
     * Store a new line
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:lines,name',
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $line = Lines::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Line berhasil ditambahkan',
                'data' => $line
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan line: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing line
     */
    public function update(Request $request, $id)
    {
        $line = Lines::find($id);
        
        if (!$line) {
            return response()->json([
                'success' => false,
                'message' => 'Line tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:lines,name,' . $id,
            'description' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $line->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Line berhasil diperbarui',
                'data' => $line
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui line: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a line
     */
    public function destroy($id)
    {
        $line = Lines::find($id);
        
        if (!$line) {
            return response()->json([
                'success' => false,
                'message' => 'Line tidak ditemukan'
            ], 404);
        }

        try {
            $line->delete();

            return response()->json([
                'success' => true,
                'message' => 'Line berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus line: ' . $e->getMessage()
            ], 500);
        }
    }
}
