<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\Blogger;
use Hash;
use Validator;
use Auth;

class LoginController extends Controller
{
    
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);
            
            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $token =  $user->createToken('user',['user'])->accessToken; 

            return response()->json(['error'=>'', 'role' => 'user', 'success' => $success , 'token' => $token]);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);
            
            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $token =  $admin->createToken('admin',['admin'])->accessToken;

            return response()->json(['error'=>'', 'role' => 'admin', 'success' => $success , 'token' => $token]);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function superadminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('superadmin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'superadmin']);
            
            $admin = SuperAdmin::select('super_admins.*')->find(auth()->guard('superadmin')->user()->id);
            $success =  $admin;
            $token =  $admin->createToken('superadmin', ['superadmin'])->accessToken;
            
            return response()->json(['error'=>'', 'role' => 'superadmin', 'success' => $success , 'token' => $token]);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    public function bloggerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('blogger')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'blogger']);
            
            $admin = Blogger::select('bloggers.*')->find(auth()->guard('blogger')->user()->id);
            $success =  $admin;
            $token =  $admin->createToken('blogger',['blogger'])->accessToken; 

            return response()->json(['error'=>'', 'role' => 'blogger', 'success' => $success , 'token' => $token]);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
}
