<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    //
    public function get_teams(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $teams = \App\Models\Team::where('status', 1)->get()->map(function ($team) use ($lang) {
            $team->name = $team->name[$lang] ?? $team->name['en'];
            $team->description = $team->description[$lang] ?? $team->description['en'];
            return $team;
        });
        return res_data($teams, 200);
        // return response()->json(['data' => $teams], 200);
    }
}
