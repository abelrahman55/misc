<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Get all hospitals from users table
     */
    public function getHospitalDetails(Request $request)
    {
        $lang = $request->header('lang', 'ar');
    $specializationId = $request->query('specialization_id');

        $hospitals = User::query()
            ->with(['country', 'town', 'specialist', 'files', 'medicalStaffs', 'licenses'])
            ->where(function ($query) {
                $query->where('type', 'hospital')
                    ->orWhere('role', 'hospital');
            })
            ->when($specializationId, function ($query) use ($specializationId) {
            $query->where('specialization_id', $specializationId);
        })
            ->where('active', 1)
            ->get()
            ->map(function ($hospital) use ($lang) {
                $data = $hospital->toArray();
                if ($hospital->country) {
                    $data['country'] = $hospital->country->getTranslation('name', $lang);
                }
                if ($hospital->town) {
                    $data['town'] = $hospital->town->getTranslation('name', $lang);
                }
                if ($hospital->specialist) {
                    $data['specialist_title'] = $hospital->specialist->title[$lang] ?? ($hospital->specialist->title['ar'] ?? '');
                }
                return $data;
            });

        return res_data($hospitals, 'Hospital details retrieved successfully', 200);
    }
    
      public function getDoctorDetails(Request $request)
    {
        $lang = $request->header('lang', 'ar');
    $specializationId = $request->query('specialization_id');

        $hospitals = User::query()
            ->with(['country', 'town', 'specialist', 'files', 'medicalStaffs', 'licenses'])
            ->where(function ($query) {
                $query->where('type', 'doctor')
                    ->orWhere('role', 'doctor');
            })
            ->when($specializationId, function ($query) use ($specializationId) {
            $query->where('specialization_id', $specializationId);
        })
            ->where('active', 1)
            ->get()
            ->map(function ($hospital) use ($lang) {
                $data = $hospital->toArray();
                if ($hospital->country) {
                    $data['country'] = $hospital->country->getTranslation('name', $lang);
                }
                if ($hospital->town) {
                    $data['town'] = $hospital->town->getTranslation('name', $lang);
                }
                if ($hospital->specialist) {
                    $data['specialist_title'] = $hospital->specialist->title[$lang] ?? ($hospital->specialist->title['ar'] ?? '');
                }
                return $data;
            });

        return res_data($hospitals, 'Hospital details retrieved successfully', 200);
    }

    /**
     * Get single hospital details by ID
     */
    public function getHospitalById(Request $request, $id)
    {
        $lang = $request->header('lang', 'ar');

        $hospital = User::query()
            ->with(['country', 'town', 'specialist', 'files', 'medicalStaffs', 'licenses'])
            ->where(function ($query) {
                $query->where('type', 'hospital')
                    ->orWhere('role', 'hospital');
            })
            ->where('active', 1)
            ->find($id);

        if (!$hospital) {
            return res_data(null, 'Hospital not found', 404);
        }

        $hospitalData = $hospital->toArray();
        if ($hospital->country) {
            $hospitalData['country'] = $hospital->country->getTranslation('name', $lang);
        }
        if ($hospital->town) {
            $hospitalData['town'] = $hospital->town->getTranslation('name', $lang);
        }
        if ($hospital->specialist) {
            $hospitalData['specialist_title'] = $hospital->specialist->title[$lang] ?? ($hospital->specialist->title['ar'] ?? '');
        }

        return res_data($hospitalData, 'Hospital details retrieved successfully', 200);
    }
}
