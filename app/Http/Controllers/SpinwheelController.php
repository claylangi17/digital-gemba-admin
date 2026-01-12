<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SpinwheelController extends Controller
{
    /**
     * Display the spinwheel page
     */
    public function index()
    {
        $lines = Lines::orderBy('name', 'asc')->get();
        $factories = \App\Models\Factory::all();
        return view('spinwheel.index', compact('lines', 'factories'));
    }

    /**
     * Get all lines for AJAX request
     */
    public function getLines()
    {
        $lines = Lines::orderBy('name', 'asc')->get(['id', 'name', 'description', 'factory_id']);
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lines')->where(function ($query) use ($request) {
                    return $query->where('factory_id', $request->factory_id);
                })
            ],
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
            $data = [
                'name' => $request->name,
                'description' => $request->description
            ];

            if ($request->has('factory_id')) {
                $data['factory_id'] = $request->factory_id;
            }

            $line = Lines::create($data);

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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lines')->ignore($id)->where(function ($query) use ($request, $line) {
                    // Use request factory_id if present (even if null), otherwise use existing line's factory_id
                    $factoryId = $request->has('factory_id') ? $request->factory_id : $line->factory_id;
                    return $query->where('factory_id', $factoryId);
                })
            ],
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
            $data = [
                'name' => $request->name,
                'description' => $request->description
            ];

            if (!$request->user()->factory_id && $request->has('factory_id')) {
                $data['factory_id'] = $request->factory_id;
            }

            $line->update($data);

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
