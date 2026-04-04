<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    //
    public function store_new_team(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'nullable|string|max:255',
            'description' => 'nullable|array',
        ]);

        $team = new \App\Models\Team();
        $team->name = $data['name'];
        $team->position = $data['position'] ?? null;
        $team->description = $data['description'] ?? [];

        if ($request->hasFile('image')) {
            $team->image = $request->file('image')->store('teams', 'public');
        }

        $team->save();

        return response()->json(['message' => 'Team created successfully', 'team' => $team], 201);
    }
}
