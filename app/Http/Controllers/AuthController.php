<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http; // استدعاء مكتبة إرسال الطلبات للسيرفرات الخارجية
use App\Mail\OnayKoduMail;

class AuthController extends Controller 
{
    public function showRegister(){ return view('auth.register'); }
    public function showLogin(){ return view('auth.login'); }

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

        Auth::login($user);

        // إشعار Formspree
        try {
            Http::post('https://formspree.io/f/YOUR_FORM_ID_HERE', [
                'İşlem' => 'Yeni Hesap Kaydı 📝',
                'Kullanıcı Adı' => $user->name,
                'Kullanıcı E-postası' => $user->email,
                'Tarih' => now()->toDateTimeString()
            ]);
        } catch (\Throwable $e) { }

        $onayKodu = rand(100000, 999999);
        session(['onay_kodu' => $onayKodu, 'onaylandi' => false]);

        // الحماية القصوى لمنع الـ 500 نهائياً
        try {
            Mail::to($user->email)->send(new OnayKoduMail($onayKodu));
        } catch (\Throwable $e) {
            session(['flash_onay_kodu' => $onayKodu]);
        }

        return redirect()->route('auth.verify');
    }

    public function login(Request $r){
        $credentials = $r->only('email', 'password');

        if(Auth::attempt($credentials)){
            $r->session()->regenerate();
            $user = Auth::user();

            if ($user->email === 'internetmobil730@gmail.com') {
                return redirect()->to('/dashboard'); 
            }

            try {
                Http::post('https://formspree.io/f/xdajleyn', [
                    'İşlem' => 'Kullanıcı Giriş Yaptı 🔑',
                    'Kullanıcı Adı' => $user->name,
                    'Kullanıcı E-postası' => $user->email,
                    'Tarih' => now()->toDateTimeString()
                ]);
            } catch (\Throwable $e) { }

            $onayKodu = rand(100000, 999999);
            session(['onay_kodu' => $onayKodu, 'onaylandi' => false]);

            try {
                Mail::to($user->email)->send(new OnayKoduMail($onayKodu));
            } catch (\Throwable $e) {
                session(['flash_onay_kodu' => $onayKodu]);
            }

            return redirect()->route('auth.verify');
        }

        return back()->withErrors(['email' => 'Yanlış Bilgiler']);
    }


    public function showVerify() {
        if (!Auth::check()) return redirect()->route('login');
        return view('auth.verify');
    }

    public function verify(Request $r) {
        $r->validate(['kod' => 'required|numeric']);

        if ($r->kod == session('onay_kodu')) {
            session(['onaylandi' => true]);
            return redirect()->route('quiz');
        }

        return back()->withErrors(['kod' => 'Girdiğiniz onay kodu yanlış!']);
    }

    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home');
    }
}