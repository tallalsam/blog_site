<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createsession(Request $request)
    {
        \Session::put('user', $request->user);
        \Session::put('role', $request->role);
    }
    public function flushsession(Request $request)
    {

        $request->session()->flush();
        \Cookie::forget('access_token');
        return response()->json(array('error'=>''));
    }
}
