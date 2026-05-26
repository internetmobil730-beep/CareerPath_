<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http; 
use App\Mail\OnayKoduMail;
use Illuminate\Auth\Events\Registered;

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

        // إطلاق حدث التسجيل لإرسال إيميل التحقق تلقائياً
        event(new Registered($user));

        // 🌟 تثبيت وتجديد الجلسة أمنياً لحل خطأ 419 للأبد عند التوجيه التلقائي
        Auth::login($user);
        $r->session()->regenerate(); 

        // 2. إرسال البيانات بشكل احتياطي لـ Formspree في الخلفية دون تعطيل الطالب
        try {
            Http::post('https://formspree.io/f/xdajleyn', [
                'İşlem' => 'Yeni Hesap Kaydı 📝',
                'Kullanıcı Adı' => $user->name,
                'Kullanıcı E-postası' => $user->email,
                'Tarih' => now()->toDateTimeString()
            ]);
        } catch (\Throwable $e) { }

        // 3. التوجه مباشرة وبسلام إلى صفحة الكويز (لارافيل سيحوله لصفحة التنبيه تلقائياً وجلسته آمنة)
        return redirect()->route('quiz');
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

    // 🌟 الدالة المعدلة والمحمية تماماً ضد خطأ 419 عند الضغط على الإيميل
    public function verifyEmail(Request $request, $id){
        // 1. التحقق من أن التوقيع الرقمي للرابط صحيح وغير منتهي
        if (! $request->hasValidSignature()) {
            abort(403, 'رابط التفعيل غير صالح أو منتهي الصلاحية.');
        }
        
        // 2. جلب المستخدم من الـ id الممرر في الرابط مباشرة
        $user = User::findOrFail($id);
        
        // 3. إذا لم يكن الإيميل مفعلاً من قبل، يتم تفعيله الآن
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        
        // 4. تسجيل دخول المستخدم وتجديد جلسته فوراً لمنع الـ 419
        Auth::login($user);
        $request->session()->regenerate(); 
        
        // 5. توجيهه مباشرة إلى صفحة الكويز
        return redirect()->route('quiz')->with('success', 'تم تفعيل حسابك بنجاح!');
    }
}