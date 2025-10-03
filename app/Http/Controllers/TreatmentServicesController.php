<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTreatmentServiceRequest;
use App\Models\Appointment;
use App\Models\TreatmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TreatmentServicesController extends Controller
{
    //

    public function get_treatment_service(){
        $lang=request()->header('lang','ar');
        $treats=TreatmentService::active()->get()->map(function($faq)use ($lang){
            return [
                'id'=>$faq->id,
                'title'=>$faq->title[$lang]??"",
            ];
        });
        return res_data($treats,'',200);
    }
    public function add_new_treatment_service(AddTreatmentServiceRequest $request){
        $data=$request->validated();
        $new=TreatmentService::create($data);
        // return res_data()
        $lang=request()->header('lang','ar');
        $message=[
            'ar'=>'تمت الاضافه',
            'en'=>'Success To Add',
            'fr'=>'Succès à ajouter',
            'gr'=>'Erfolg zum Hinzufügen',
        ];
        return redirect()->back()->with('success',$message[$lang]);
    }
    public function patient_schedules(){
        $user=Auth::guard('web')->user();
        $data=Appointment::where('client_id',$user->id)->paginate(10);
        // return $data;
        return view('patient_schedules',compact('data'));
    }
    public function provider_schedules(){
        $user=Auth::guard('web')->user();
        $data=Appointment::where('doctor_id',$user->id)->paginate(10);
        // return $data;
        return view('provider_schedules',compact('data'));
    }
}
