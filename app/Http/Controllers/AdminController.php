<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginAdmin(){
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postloginAdmin(Request $request){
        $remember = $request->has('remember_me') ? true : false;
        
         // Thử đăng nhập
         if(auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password
         ], $remember)){
             // Nếu đăng nhập thành công, chuyển hướng đến trang 'home'
             return redirect()->to('home');
         } else {
             
             return back()->withInput()->withErrors(['loginError' => 'Email hoặc mật khẩu không chính xác.']);
        }
    }
    
}
