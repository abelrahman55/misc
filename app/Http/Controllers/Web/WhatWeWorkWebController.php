<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WhatWeWork;
use Illuminate\Http\Request;


class WhatWeWorkWebController extends Controller
{
    public function store_new_work(Request $request)
{
    $data = $request->validate([
        'title' => 'required',
        'image' => 'nullable|image', // يفضل إضافة التحقق من نوع الصورة
        'priority' => 'required|integer',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('works'), $file_name);
        $data['image'] = 'works/'.$file_name; // ✅ حفظ اسم الصورة وليس الكائن
    }

    $work = new WhatWeWork();
    $work->fill($data);
    $work->save();

    return response()->json(['message' => 'Work created successfully', 'work' => $work], 201);
}

}
