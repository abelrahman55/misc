<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppointmentPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentPackageController extends Controller
{
    public function index()
    {
        $lang = request()->header('lang', 'ar');
        $user = Auth::guard('users')->user();

        $packages = AppointmentPackage::with(['appointment', 'provider', 'options'])
            ->where('client_id', $user->id)
            ->get()
            ->map(function ($pkg) use ($lang) {
                return [
                    'id' => $pkg->id,
                    'appointment_id' => $pkg->appointment_id,
                    'title' => $pkg->title[$lang] ?? $pkg->title['ar'] ?? "",
                    'price' => $pkg->price,
                    'status' => $pkg->status,
                    'provider' => [
                        'id' => $pkg->provider->id ?? null,
                        'name' => $pkg->provider->full_name ?? $pkg->provider->f_name ?? "",
                    ],
                    'options' => $pkg->options->map(function ($opt) use ($lang) {
                        return [
                            'id' => $opt->id,
                            'title' => $opt->title[$lang] ?? $opt->title['ar'] ?? "",
                        ];
                    }),
                ];
            });

        return res_data($packages, '', 200);
    }

    public function show($id)
    {
        $lang = request()->header('lang', 'ar');
        $user = Auth::guard('users')->user();

        $pkg = AppointmentPackage::with(['appointment', 'provider', 'options'])
            ->where('client_id', $user->id)
            ->findOrFail($id);

        $data = [
            'id' => $pkg->id,
            'appointment_id' => $pkg->appointment_id,
            'title' => $pkg->title[$lang] ?? $pkg->title['ar'] ?? "",
            'price' => $pkg->price,
            'status' => $pkg->status,
            'rejection_reason' => $pkg->rejection_reason,
            'provider' => [
                'id' => $pkg->provider->id ?? null,
                'name' => $pkg->provider->full_name ?? $pkg->provider->f_name ?? "",
            ],
            'options' => $pkg->options->map(function ($opt) use ($lang) {
                return [
                    'id' => $opt->id,
                    'title' => $opt->title[$lang] ?? $opt->title['ar'] ?? "",
                ];
            }),
        ];

        return res_data($data, '', 200);
    }

    public function respond(Request $request, $id)
    {
        $user = Auth::guard('users')->user();
        $pkg = AppointmentPackage::where('client_id', $user->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|string|nullable',
        ]);

        $pkg->update([
            'status' => $request->status,
            'rejection_reason' => $request->status == 'rejected' ? $request->rejection_reason : null,
        ]);

        return res_data('', 'Response recorded successfully', 200);
    }

    public function pay($id)
    {
        $user = Auth::guard('users')->user();
        $pkg = AppointmentPackage::where('client_id', $user->id)->findOrFail($id);

        if ($pkg->status != 'approved') {
            return res_data('', 'Package must be approved before payment', 400);
        }

        // Simulated payment logic
        $pkg->update(['status' => 'paid']);

        return res_data('', 'Payment successful', 200);
    }
}
