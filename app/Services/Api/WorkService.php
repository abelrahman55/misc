<?php

namespace App\Services\Api;

use App\Models\WhatWeWork;

class WorkService{
    static function GetWorks(){
        $lang = request()->header('lang', 'ar');
        $works=WhatWeWork::where('status', 1)->orderBy('priority', 'asc')->get()->map(function($work)use($lang){
            return [
                'id' => $work->id,
                'title' => $work->title[$lang] ?? $work->title['ar'], // Fallback to Arabic if the requested language is not available
                'image' => $work->image_url,
                'status' => $work->status,
                'priority' => $work->priority,
            ];
        });
        return res_data($works, '', 200);
    }
}
