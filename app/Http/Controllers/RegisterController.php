<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(){
        return view('register');
    }
    public function store (Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);
    $validatedData['password'] = Hash::make($validatedData['password']);
    User::create($validatedData);
    return redirect('/login')->with('success', 'Mantap');
    }
    
}
