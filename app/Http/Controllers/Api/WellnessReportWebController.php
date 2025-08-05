<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WellnessReportWebController extends Controller
{
    //
    public function get_wellness_reports(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $reports = \App\Models\WellnessReport::get()->map(function ($report) use ($lang) {
            $report->title = $report->title[$lang] ?? $report->title['en'];
            $report->description = $report->description[$lang] ?? $report->description['en'];
            return $report;
        });
        return response()->json(['data' => $reports], 200);
    }
}