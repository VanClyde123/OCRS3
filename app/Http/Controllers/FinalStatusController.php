<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinalStatus;

class FinalStatusController extends Controller
{
    public function index()
    {
        $statuses = FinalStatus::orderBy('name')->get();
        return response()->json($statuses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:final_statuses,name',
        ]);

        $status = FinalStatus::create([
            'name' => strtoupper(trim($request->name)),
        ]);

        return response()->json([
            'message' => 'Status added successfully!',
            'status' => $status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $status = FinalStatus::findOrFail($id);
        $status->name = $request->name;
        $status->save();

        return response()->json(['message' => 'Updated successfully']);
    }
}
