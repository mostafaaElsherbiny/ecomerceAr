<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $redirectTo = '/admin';

    public function login(){
        return view('admin.login');
    }

    public function dologin(){
        $rememeberme=request('rememberme')==1?true:false;
        if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$rememeberme)){
            return redirect(route('admin.dashboard'));
            dd(session()->all());
        }else{
            session()->flash('error',trans('admin.incorrectInformation'));
            return redirect(route('admin.login'));

        }
    }
    public function logout(Request $request){
        admin()->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');

    }

    public function forgetPassword(){
        return view('admin.resetpass');
    }
    public function forgetPassword_p(Request $request){
        return $request->all();
    }
}



