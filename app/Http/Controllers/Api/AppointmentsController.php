<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentsController extends Controller
{
    //
    public function make_appointment(MakeAppointmentRequest $request)
{
    $lang = request()->header('lang', 'ar');
    $data = $request->validated();

    $client = Auth::guard('users')->user();
    $data['client_id'] = $client->id;

    $message = [
        'ar' => 'تمت الاضافه',
        'en' => 'Success To Add',
        'fr' => 'Succès à ajouter',
        'gr' => 'Erfolg zum Hinzufügen',
    ];

    DB::beginTransaction();
    try {
        // إنشاء الموعد
        $new = Appointment::create($data);

        // رفع الملفات لو موجودة
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('appointments', 'public');

                AppointmentFile::create([
                    'appointment_id' => $new->id,
                    'file' => $path,
                ]);
            }
        }

        DB::commit();

        // تحميل الملفات المرتبطة عشان ترجع مع الرد
        // $new->load('files');

        return res_data(
            '',
            $message[$lang] ?? $message['ar'],
            200
        );

    } catch (\Exception $e) {
        DB::rollBack();
        return res_data(
            '',
            'Error: ' . $e->getMessage(),
            500
        );
    }
}

}
