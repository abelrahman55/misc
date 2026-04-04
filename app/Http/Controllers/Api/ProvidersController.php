<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\DoctorFile;
use App\Models\PackageMakeMeeting;
use App\Models\ProviderMakeMeeting;
use App\Models\RateUser;
use App\Models\User;
use App\Models\UserNote;
use App\Services\Api\ProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Countries;
use App\Models\Specialty;
use App\Models\Town;
use App\Models\UserLicense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProvidersController extends Controller
{
    public function best_providers()
    {
        $top = ProviderService::BestProviders();
        return $top;
    }

    public function getDoctorDetails(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
        ]);

        $doctorId = $request->doctor_id;

        $doctor = User::with([
            'specialist:id,title',
            'country:id,name',
            'features',
            'files',
            'ratings' => function ($query) {
                $query->with('user:id,f_name,l_name,prof_img')
                    ->orderBy('created_at', 'desc')
                    ->limit(10);
            }
        ])
            ->where('id', $doctorId)
            ->first();

        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found',
            ], 404);
        }

        // Format the response
        $data = [
            'id' => $doctor->id,
            'full_name' => $doctor->full_name,
            'f_name' => $doctor->f_name,
            'm_name' => $doctor->m_name,
            'l_name' => $doctor->l_name,
            'email' => $doctor->email,
            'phone' => $doctor->phone,
            'mobile_number' => $doctor->mobile_number,
            'gender' => $doctor->gender,
            'about' => $doctor->about,
            'prof_img' => $doctor->prof_img_url,
            'specialty' => $doctor->specialist ? [
                'id' => $doctor->specialist->id,
                'title' => $doctor->specialist->title,
            ] : null,
            'country' => $doctor->country ? [
                'id' => $doctor->country->id,
                'name' => $doctor->country->name,
            ] : null,
            'rating' => [
                'average' => round($doctor->rate_avg, 1),
                'count' => $doctor->rate_count,
            ],
            'features' => $doctor->features->map(function ($feature) {
                return [
                    'id' => $feature->id,
                    'title' => $feature->title,
                ];
            }),
            'files' => $doctor->files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'file_url' => asset('storage/' . $file->file),
                ];
            }),
            'recent_reviews' => $doctor->ratings->map(function ($rating) {
                return [
                    'id' => $rating->id,
                    'rate' => $rating->rate,
                    'comment' => $rating->comment,
                    'reply' => $rating->reply,
                    'created_at' => $rating->created_at->format('Y-m-d H:i:s'),
                    'user' => $rating->user ? [
                        'name' => $rating->user->f_name . ' ' . $rating->user->l_name,
                        'image' => $rating->user->prof_img ? asset('storage/' . $rating->user->prof_img) : null,
                    ] : null,
                ];
            }),
            'consultation_pricing' => [
                'video_consultation_price' => $doctor->video_consultation_price ? (float) $doctor->video_consultation_price : null,
                'call_consultation_price' => $doctor->call_consultation_price ? (float) $doctor->call_consultation_price : null,
                'first_consultation_free' => (bool) $doctor->first_consultation_free,
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /* 
    | The following methods were moved to App\Http\Controllers\Web\ProvidersController
    | as they are specifically for the web dashboard (returning views or redirects).
    */
    
    // update_profile, provider_profile, welcome_provider, etc. have been removed 
    // to keep this controller focused on the Mobile/Pure API.
}
