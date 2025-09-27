<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use stdClass;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins=User::where('role','admin')->paginate(10);
        return view('admins.index',compact('admins'));
    }
    public function store_update_admin(Request $request){
        // return $request;
        $id=request('id');
        // return $id;
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:admins,email,'.$id,
            'password'=>'nullable',
        ]);
        $data=$validator->validated();
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($data['password']!=null){
            $data['password']=bcrypt($data['password']);
        }
        else{
            unset($data['password']);
        }
        // return /$data;
        // $data['password']=bcrypt($data['password']);
        $role=User::where('id',$id)->first();
        $update=$role->update($data);
        if($update){
            $role->assignRole('admin');
            return redirect()->route('admins')->with('success','تم التعديل بنجاح');
        }
        return redirect()->back()->with('error','فشل التعديل والظروف');
    }
    public function add_admin(){
        return view('admins::add_admin');
    }
    public function edit_admin(){
        $id=request('id');
        $admin=Admin::where('id',$id)->first();
        // return $admin;
        return view('admins::edit_admin',compact('admin','id'));
    }
    public function store_new_admin(Request $request){
        // return $request;
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
        ]);
        $data=$validator->validated();
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['role']='admin';
        $data['password']=bcrypt($data['password']);
        $new=User::create($data);
        if($new){
            $new->assignRole($data['role']);
            return redirect()->route('admins')->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','فشل الاضافه والظروف');
    }
    public function delete_admin(){
        $id=request('id');
        $del=Admin::where('id',$id)->delete();
        return redirect()->route('admins')->with('success','تم الحذف بنجاح');
        // return $id;
    }
    public function admin_login(){
        // return 'rrttr';
        return view(view: 'login');
    }
    public function admin_regist(Request $request){
        $rules = [
            'email'=> 'required',
            'password'=> 'required',
        ];

        // Validate request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $credentials = request(['email', 'password']);
        if (! $token = auth()->guard('web')->attempt($credentials)) {
            // return 'eww';
            return redirect()->back()->with('error','البريد الإلكترونى او كلمة السر خاطئه');
        }
        // return $user;
        $em=new stdClass();
        // return $request;

        $user=Auth::guard('web')->user();
        // return $user;
        if($user->role=='admin'){
            return redirect('/');
        }
        else if($user->role=='doctor'){
            // return 'er';
            return redirect()->route('welcome_provider');
            // return view('provider_dash');
        }
        else{
            return redirect('/');
        }
        // return $user;
    }

    public function admin_logout(){
        auth()->guard('web')->logout();
        return redirect()->route('admin_login');
    }
}