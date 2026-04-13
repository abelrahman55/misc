<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeleconsultationRequest;
use App\Models\TeleconsultationRequest;
use App\Models\TeleconsultationMedicalFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeleconsultationRequestController extends Controller
{
    /**
     * Display a listing of the user's teleconsultation requests.
     */
    public function index()
    {
        $user = Auth::guard('users')->user();
        if (!$user) {
            return res_data([], 'Unauthorized', 401);
        }

        $requests = TeleconsultationRequest::with(['specialty', 'doctor', 'medicalFiles', 'latestMessage'])
            ->where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return res_data($requests, 'Teleconsultation requests retrieved successfully.');
    }

    /**
     * Store a newly created teleconsultation request in storage.
     */
    public function store(StoreTeleconsultationRequest $request)
    {
        $user = Auth::guard('users')->user();
        if (!$user) {
            return res_data([], 'Unauthorized', 401);
        }

        $teleconsultation = TeleconsultationRequest::create([
            'client_id' => $user->id,
            'specialty_id' => $request->specialty_id,
            'complaint' => $request->complaint,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        if ($request->hasFile('medical_files')) {
            foreach ($request->file('medical_files') as $file) {
                $path = UploadFile($file, 'teleconsultation_medical_files');
                TeleconsultationMedicalFile::create([
                    'teleconsultation_request_id' => $teleconsultation->id,
                    'file_path' => $path,
                ]);
            }
        }

        return res_data($teleconsultation->load('medicalFiles'), 'Teleconsultation request created successfully.', 201);
    }

    /**
     * Display the specified teleconsultation request.
     */
    public function show($id)
    {
        $user = Auth::guard('users')->user();
        if (!$user) {
            return res_data([], 'Unauthorized', 401);
        }

        $teleconsultation = TeleconsultationRequest::with(['specialty', 'doctor', 'medicalFiles', 'messages.user'])
            ->where('client_id', $user->id)
            ->findOrFail($id);

        return res_data($teleconsultation, 'Teleconsultation request details retrieved.');
    }
}
