<?php

namespace App\Http\Controllers;

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        if($user->role === 'admin'){
            return view ('layouts.Admin.index');
        } else{
            return redirect()->intended(route('beranda.index'));
        }
    }
}
