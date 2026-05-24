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

        // 2. إرسال البيانات بشكل احتياطي لـ Formspree في الخلفية دون تعطيل الطالب
        try {
            Http::post('https://formspree.io/f/xdajleyn', [
                'İşlem' => 'Yeni Hesap Kaydı 📝',
                'Kullanıcı Adı' => $user->name,
                'Kullanıcı E-postası' => $user->email,
                'Tarih' => now()->toDateTimeString()
            ]);
        } catch (\Throwable $e) { }

        // 3. التوجه مباشرة وبسلام إلى صفحة الكويز (تم تعديل المسار ليتوافق مع الـ web.php)
        return redirect()->route('quiz');
    }

    public function login(Request $r){
        $credentials = $r->only('email', 'password');

        if(Auth::attempt($credentials)){
            $r->session()->regenerate();
            $user = Auth::user();

            // إذا كان آدمن يذهب للوحة التحكم فوراً
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

            // الطالب العادي يذهب للكويز فوراً دون الحاجة لكود إيميل معطل
            return redirect()->route('quiz');
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