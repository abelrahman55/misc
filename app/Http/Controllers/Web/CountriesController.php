<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    //
    public function store_new_country(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $data = $validator->validated();
        $country = Countries::create($data);

        return response()->json(['status' => true, 'message' => 'Country Added Successfully']);
    }

    public function get_towns(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $query = \App\Models\Town::query();

        if ($request->has('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        $towns = $query->with('country')->get()->map(function ($country) use ($lang) {
            return [
                'id' => $country->id,
                'name' => $country->getTranslation('name', $lang),
            ];
        });
        return response()->json(['status' => true, 'data' => $towns]);
    }
}
