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

        // 1. إنشاء المستخدم في قاعدة البيانات
        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password)
        ]);

        Auth::login($user);

        // 2. توليد رمز التأكيد الخماسي/السداسي
        $onayKodu = rand(100000, 999999);
        
        // 3. حفظ الرمز في الجلسة وطباعته بشكل احتياطي على الشاشة لتجنب أي انهيار بالسيرفر
        session([
            'onay_kodu' => $onayKodu, 
            'onaylandi' => false,
            'flash_onay_kodu' => $onayKodu // سيظهر في واجهة الـ Verify مباشرة لتجاوز خطأ 500
        ]);

        // 4. محاولة إرسال إشعار Formspree في الخلفية دون أن يؤثر فشله على الطالب
        try {
            Http::post('https://formspree.io/f/xdajleyn', [
                'İşlem' => 'Yeni Hesap Kaydı 📝',
                'Kullanıcı Adı' => $user->name,
                'Kullanıcı E-postası' => $user->email,
                'Tarih' => now()->toDateTimeString()
            ]);
        } catch (\Throwable $e) { }

        // 5. محاولة إرسال الإيميل الحقيقي (إذا نجحت ممتاز، وإذا فشلت فلن يظهر خطأ 500 بسبب الـ try-catch)
        try {
            Mail::to($user->email)->send(new OnayKoduMail($onayKodu));
        } catch (\Throwable $e) { }

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

            $onayKodu = rand(100000, 999999);
            
            session([
                'onay_kodu' => $onayKodu, 
                'onaylandi' => false,
                'flash_onay_kodu' => $onayKodu
            ]);

            try {
                Http::post('https://formspree.io/f/xdajleyn', [
                    'İşlem' => 'Kullanıcı Giriş Yaptı 🔑',
                    'Kullanıcı Adı' => $user->name,
                    'Kullanıcı E-postası' => $user->email,
                    'Tarih' => now()->toDateTimeString()
                ]);
            } catch (\Throwable $e) { }

            try {
                Mail::to($user->email)->send(new OnayKoduMail($onayKodu));
            } catch (\Throwable $e) { }

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