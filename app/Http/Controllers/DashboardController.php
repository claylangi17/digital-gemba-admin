<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function setFactory(Request $request)
    {
        $request->validate([
            'factory_id' => 'nullable|exists:factories,id',
        ]);

        if ($request->factory_id) {
            session(['viewing_factory_id' => $request->factory_id]);
        } else {
            session()->forget('viewing_factory_id');
        }

        return redirect()->back();
    }
}
