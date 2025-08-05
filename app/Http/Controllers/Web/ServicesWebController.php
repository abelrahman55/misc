<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesWebController extends Controller
{
    //
    public function store_new_service(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('services'), $file_name);
            $data['image'] = 'services/' . $file_name;
        }

        // Assuming you have a Service model to handle the data
        $service = new Services();
        $service->fill($data);
        $service->save();

        return response()->json(['message' => 'Service created successfully', /* 'service' => $service */], 201);
    }
}
