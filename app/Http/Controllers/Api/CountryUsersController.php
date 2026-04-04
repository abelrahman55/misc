<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CountryUsersController extends Controller
{
    public function getUsersByCountry(Request $request)
    {
        $request->validate([
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $countryId = $request->country_id;
        $lang = $request->header('lang', 'ar');

        // Get doctors (type = 'doctor' or role = 'doctor')
        $doctors = User::query()
            ->with('country')
            ->where(function ($query) {
                $query->where('type', 'doctor')
                    ->orWhere('role', 'doctor');
            })
            ->when($countryId, function ($query) use ($countryId) {
                return $query->where('country_id', $countryId);
            })
            ->where('active', 1)
            ->select('id', 'full_name', 'f_name', 'l_name', 'email', 'phone', 'specialization_id', 'prof_img', 'country_id')
            ->with('specialist:id,title')
            ->get()
            ->map(function ($doctor) use ($lang) {
                $data = $doctor->toArray();
                if ($doctor->country) {
                    $data['country'] = $doctor->country->name[$lang] ?? ($doctor->country->name['ar'] ?? '');
                }
                if ($doctor->specialist) {
                    $data['specialist']['title'] = $doctor->specialist->title[$lang] ?? ($doctor->specialist->title['ar'] ?? '');
                }
                return $data;
            });

        // Get hospitals (type = 'hospital')
        $hospitals = User::query()
            ->with('country')
            ->where(function ($query) {
                $query->where('type', 'hospital')
                    ->orWhere('role', 'hospital');
            })
            ->when($countryId, function ($query) use ($countryId) {
                return $query->where('country_id', $countryId);
            })
            ->where('active', 1)
            ->select('id', 'full_name', 'f_name', 'l_name', 'email', 'phone', 'prof_img', 'country_id')
            ->get()
            ->map(function ($hospital) use ($lang) {
                $data = $hospital->toArray();
                if ($hospital->country) {
                    $data['country'] = $hospital->country->getTranslation('name', $lang);
                }
                return $data;
            });

        // Get providers (provider = 1 or type = 'provider')
        $providers = User::query()
            ->with('country')
            ->where(function ($query) {
                $query->where('provider', 1)
                    ->orWhere('type', 'provider')
                    ->orWhere('role', 'provider');
            })
            ->when($countryId, function ($query) use ($countryId) {
                return $query->where('country_id', $countryId);
            })
            ->where('active', 1)
            ->select('id', 'full_name', 'f_name', 'l_name', 'email', 'phone', 'specialization_id', 'prof_img', 'country_id')
            ->with('specialist:id,title')
            ->get()
            ->map(function ($provider) use ($lang) {
                $data = $provider->toArray();
                if ($provider->country) {
                    $data['country'] = $provider->country->getTranslation('name', $lang);
                }
                if ($provider->specialist) {
                    $data['specialist']['title'] = $provider->specialist->getTranslation('title', $lang);
                }
                return $data;
            });

        return response()->json([
            'success' => true,
            'data' => [
                'doctors' => $doctors,
                'hospitals' => $hospitals,
                'providers' => $providers,
            ],
        ]);
    }
}
