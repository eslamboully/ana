<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    public function login()
    {
        if (!auth('admin')->check()) {
            return view('Admin.login');
        }
        return redirect()->route('admin.home');
    }

    public function login_post(Request $request)
    {
        $arr = ['email' => $request->get('email'),'password' => $request->get('password')];
        if (auth('admin')->attempt($arr,$request->get('remember_me'))){
            return redirect()->route('admin.home');
        }
        Session::flash('message','Invalid Email or Password');
        return redirect()->back();
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        return view('Admin/home');
    }

    public function lang($lang)
    {
        if (session()->has('admin-lang')) {
            session()->forget('admin-lang');
            session()->put('admin-lang',$lang);
        } else {
            session()->put('admin-lang',$lang);
        }

        return redirect()->back();
    }
}
