<?php

namespace App\Services\Api;

use App\Models\Specialist;
use App\Models\User;

class SpecialistService{
    static function OurSpecialist(){
          $lang          = request()->header('lang', 'ar');
    $specialtyId   = request()->query('specialization_id');
    $perPage       = min((int) request()->header('per_page', 10), 50);   // cap at 50

    $doctors = User::query()
        ->with(['specialist:id,id,title'])        // only what we need
        ->when($specialtyId, fn ($q) => $q->where('specialization_id', $specialtyId))
        ->where([
            ['role',  'doctor'],
            ['ban',   0],
            ['active',1],
        ])
        ->select('id','specialization_id','f_name','m_name','l_name','prof_img')
        ->paginate($perPage);

    // reshape
    $doctors->getCollection()->transform(function ($doctor) use ($lang) {
        return [
            'id'        => $doctor->id,
            'about'=>$doctor->about??"",
            'name'      => "{$doctor->f_name} {$doctor->m_name} {$doctor->l_name}",
            'prof_img'  => $doctor->prof_img_url,
            'speciality'=> data_get($doctor, "specialist.title.$lang", ''),
        ];
    });

    $data = [
        'data'       => $doctors->getCollection()->toArray(),
        'pagination' => [
            'total'        => $doctors->total(),
            'per_page'     => $doctors->perPage(),
            'current_page' => $doctors->currentPage(),
            'pages_count'  => $doctors->lastPage(),
        ],
    ];

    return res_data($data, '', 200);
    }
    static function GetSpcialtyProviders()
{
    $id = request('id');
    $per_page = request()->query('per_page', 10);

    $providers = User::with('features')
        ->where([
            ['specialization_id', '=', $id],
            ['role', '=', 'doctor'],
            ['ban', '=', 0],
            ['active', '=', 1],
        ])
        ->select('id', 'full_name', 'prof_img')
        ->paginate($per_page);

    $providers->getCollection()->transform(function ($provider) {
        return [
            'id'         => $provider->id,
            'full_name'  => $provider->full_name,
            'prof_img'   => $provider->prof_img_url,
            'features'   => $provider->features,
            'rate_avg'   => $provider->rate_avg ?? 0,
            'rate_count' => $provider->rate_count ?? 0,
        ];
    });

    $data = [
        'data'       => $providers->getCollection()->toArray(),
        'pagination' => [
            'total'        => $providers->total(),
            'per_page'     => $providers->perPage(),
            'current_page' => $providers->currentPage(),
            'pages_count'  => $providers->lastPage(),
        ]
    ];

    return res_data($data, '', 200);
}

}
