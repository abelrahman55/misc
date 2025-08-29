<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoctorFile;
use App\Models\RateUser;
use App\Models\UserNote;
use App\Services\Api\ProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProvidersController extends Controller
{
    //
    public function best_providers(){
        $top=ProviderService::BestProviders();
        return $top;
    }
    public function welcome_provider(){
        return view('provider_dash');
    }
    public function provider_profile(){
        $user=Auth::guard('web')->user();
        $user=User::with('country','usernotes','files')->where('id',$user->id)->first();
        // return $user;
        return view('provider.provider_profile',compact('user'));
    }
    public function upload_file(Request $request){
        $validator=Validator::make($request->all(),[
            'file'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user=Auth::guard('web')->user();
        $data=$validator->validated();
        $data['user_id']=$user->id;
        if(request()->hasFile('file')){

            // $data['avatar']=request()->file('avatar')->store('users','public');
            $destinationPath = public_path('storage/' . 'files');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image=request()->file('file');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);

        $data['file']= 'files' . '/' . $imageName;

            // return $data['avatar'];
        }
        // return $data;
        $new=DoctorFile::create($data);
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
    }
    public function add_note(Request $request){
        $validator=Validator::make($request->all(),[
            'note'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user=Auth::guard('web')->user();
        $data=$validator->validated();
        $data['user_id']=$user->id;
        $new=UserNote::create($data);
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
        // return $request;
    }
    public function provider_patient(){
        $user=Auth::guard('web')->user();
        $patients=User::where('role','patient')->paginate(10);
        // return $user;
        return view('provider.provider_patient',compact('patients'));
    }
    public function provider_ratings(){
        $user=Auth::guard('web')->user();
        $reviews=RateUser::with('user')->where('provider_id',$user->id)->paginate(10);
        // return $reviews;
        return view('provider.provider_reviews',compact('user','reviews'));
    }
}
