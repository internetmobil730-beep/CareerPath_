<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller 
{
    public function showRegister(){ 
        return view('auth.register'); 
    }

    public function showLogin(){ 
        return view('auth.login'); 
    }

    public function register(Request $r){
        $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);

        // إعطاء رتبة مستخدم عادي (user) تلقائياً عند التسجيل الجديد
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('user');
        }

        Auth::login($user);

        return redirect()->route('quiz');
    }

    public function login(Request $r){
        $credentials = $r->only('email', 'password');

        if(Auth::attempt($credentials)){
            $r->session()->regenerate();

            // فحص رتبة الحساب المفرّق بين الأدمن والطالب
            if (Auth::user()->hasRole('careerpath')) {
                return redirect()->intended('/dashboard'); // توجيه الأدمن مباشرة للداشبورد
            }

            // توجيه الطالب العادي للكويز
            return redirect()->intended(route('quiz'));
        }

        return back()->withErrors(['email' => 'Yanlış Bilgiler']);
    }

    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home');
    }
}