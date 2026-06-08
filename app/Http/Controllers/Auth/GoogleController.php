<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    /**
     * توجيه المستخدم إلى صفحة تسجيل الدخول الخاصة بجوجل
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * استقبال بيانات المستخدم القادمة من جوجل بعد تسجيل الدخول بنجاح
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // البحث عن الطالب في قاعدة البيانات بواسطة إيميله، أو إنشاؤه كطالب جديد إن لم يكن مسجلاً
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    // كلمة مرور عشوائية معقدة وآمنة خلف الكواليس لأن الدخول يتم عبر جوجل
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)), 
                ]
            );

            // تسجيل دخول الطالب في النظام فوراً
            Auth::login($user);

            // توجيهه إلى الصفحة الرئيسية للموقع بعد الدخول
            return redirect()->to('/home'); 

        } catch (Exception $e) {
            // في حال حدوث أي خطأ، يعود لصفحة تسجيل الدخول مع رسالة تنبيه
            return redirect()->to('/login')->with('error', 'Google ile giriş yapılırken bir hata oluştu.');
        }
    }
}