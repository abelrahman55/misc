<?php

namespace App\Services\Api;

use App\Models\User;

class ProviderService{
    static function BestProviders(){
        $topDoctors = User::with('features')
    ->where('role', 'doctor')
    ->whereNull('parent_id')
    ->where('type', 'hospital') // أو أي شرط تريده
    ->where('ban', 0)
    ->where('active', 1)
    ->withAvg('ratings', 'rate') // ⬅️ يجب أن يأتي قبل select أو orderBy
    ->orderByDesc('ratings_avg_rate') // ⬅️ يعمل فقط إذا withAvg قبله
    ->paginate(10); // or ->get()

$topDoctors->getCollection()->transform(function ($doctor) {
    return [
        'id' => $doctor->id,
        'full_name' => $doctor->full_name,
        'prof_img' => $doctor->prof_img_url,
        'features' => $doctor->features,
        'rate_avg' => round($doctor->ratings_avg_rate, 2),
        'rate_count' => $doctor->ratings()->count(),
    ];
});
return res_data($topDoctors,'',200);
    }
}
