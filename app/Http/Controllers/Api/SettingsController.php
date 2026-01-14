<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function settings(){
        $settings=Setting::first();
            return res_data($settings,'success',200);
        }
}
