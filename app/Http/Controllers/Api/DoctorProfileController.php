<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDoctorProfileRequest;
use App\Models\User;
use App\Models\MedicalStaff;
use App\Models\UserLicense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DoctorProfileController extends Controller
{
    /**
     * Update doctor profile with healthcare facility information
     */
    public function updateDoctorProfile(UpdateDoctorProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            // Find doctor by email
            $doctor = User::where('email', $request->email)->first();

            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'message' => 'الطبيب غير موجود'
                ], 404);
            }

            // Update healthcare facility information
            $doctor->update([
                'legal_business_name' => $request->legal_business_name,
                'healthcare_facility_type' => $request->healthcare_facility_type,
                'town_id' => $request->town_id,
                'main_point_contact' => $request->main_point_contact,
                'website' => $request->website,
                'content_blog' => $request->content_blog,
                'service_offered' => $request->service_offered,
                'specialization' => $request->specialization,
                'pricing_information' => $request->pricing_information,
                'technology' => $request->technology,
                'quality' => $request->quality,
                'preferred_partnership' => $request->preferred_partnership,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'linkedin_link' => $request->linkedin_link,
                'tiktok_link' => $request->tiktok_link,
                'role'=>$request->role,
                'type'=>$request->type??"",
            ]);

            // Update Medical Staffs
            if ($request->has('medical_staffs') && is_array($request->medical_staffs)) {
                // Delete existing medical staffs
                MedicalStaff::where('user_id', $doctor->id)->delete();

                // Create new medical staffs
                foreach ($request->medical_staffs as $staff) {
                    MedicalStaff::create([
                        'user_id' => $doctor->id,
                        'name' => $staff['name'],
                        'qualification' => $staff['qualification'] ?? null,
                        'experience_years' => $staff['experience_years'] ?? null,
                        'specialization' => $staff['specialization'] ?? null,
                    ]);
                }
            }

            // Update Licenses - Multiple files per type
            if ($request->has('licenses') && is_array($request->licenses)) {
                foreach ($request->licenses as $type => $files) {
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            // Custom storage logic
                            $location = 'licenses/' . $type;
                            $destinationPath = public_path('storage/' . $location);

                            if (! file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }

                            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->move($destinationPath, $imageName);

                            $path = $location . '/' . $imageName;

                            // Create license record
                            UserLicense::create([
                                'user_id' => $doctor->id,
                                'file' => $path,
                                'type' => $type,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            // Load relationships for response
            $doctor->load(['medicalStaffs', 'licenses', 'town']);
             $doctor->assignRole('doctor');

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث بيانات الطبيب بنجاح',
                'data' => [
                    'doctor' => $doctor,
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث البيانات',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
