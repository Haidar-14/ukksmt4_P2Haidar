<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
  
    public function index()
    {
        return view('login.login');
    }

   
    public function login(Request $request)
    {
       
        $user = User::first();
        
       
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('123')
            ]);
        }
        
      
        Auth::login($user);
        
        
        return redirect('/admin');
    }
    
   
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}   