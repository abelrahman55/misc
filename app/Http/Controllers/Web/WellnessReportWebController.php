<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WellnessReportWebController extends Controller
{
    //
    public function store_new_report(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image', // يفضل إضافة التحقق من نوع الصورة
            'priority' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('reports'), $file_name);
            $data['image'] = 'reports/' . $file_name; // ✅ حفظ اسم الصورة وليس الكائن
        }

        // Assuming you have a WellnessReport model similar to WhatWeWork
        $report = new \App\Models\WellnessReport();
        $report->fill($data);
        $report->save();

        return response()->json(['message' => 'Report created successfully', 'report' => $report], 201);
    }
}
