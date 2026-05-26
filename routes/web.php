<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\SkillCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest; 

// 1. الصفحات العامة (متاحة للجميع زوار وأعضاء)
Route::get('/', [HomeController::class, 'index'])->name('home');

// روابط الحسابات وتسجيل الدخول
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. روابط الطلاب والمستخدمين العاديين (ممنوع دخول الأدمن هنا)
Route::middleware(['auth', 'block.admin', 'verified'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public');
    Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university_details');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');
});

// 3. روابط لوحة تحكم الإدارة (الأدمن الحقيقي فقط حصرًا ومحمي تماماً)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class, 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('skills', SkillController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('skill_categories', SkillCategoryController::class);
    Route::resource('users', UserController::class);
    Route::get('universities/{university}/manage-majors', [UniversityController::class, 'manageMajors'])->name('universities.majors');
    Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
});

// 🌟 الكود النهائي المطور والمصحح بالترتيب البرمجي الآمن 🌟
Route::get('/run-migrate-path', function() {
    try {
        // 1. تنظيف كاش لارافيل لضمان عدم حدوث تضارب في قراءة الإعدادات القديمة
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        
        // 2. بناء الجداول أولاً من الصفر (يجب أن يتم هذا السطر قبل استدعاء أي موديول)
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 3. مسح كاش المكتبات الخاصة بالصلاحيات بعد بناء الجداول مباشرة
        if (isset(app()[\Spatie\Permission\PermissionRegistrar::class])) {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        }
        
        // 4. إنشاء الصلاحيات برمجياً داخل الجداول الجديدة التي تم بناؤها
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        // 5. إنشاء حساب الأدمن الخاص بكِ وتفعيله تلقائياً
        $adminEmail = 'internetmobil730@gmail.com';
        $admin = \App\Models\User::create([
            'name' => 'careerpath',
            'email' => $adminEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('internet20mobil26'),
        ]);
        
        // ربط الصلاحية بالأدمن بشكل آمن
        $admin->assignRole($adminRole);

        // 6. استدعاء الـ Seeders بالترتيب الصحيح والمثالي لقاعدة البيانات لمنع أخطاء العلاقات (Foreign Keys)
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\SkillCategorySeeder',
            '--force' => true
        ]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\SkillSeeder',
            '--force' => true
        ]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\UniversitySeeder',
            '--force' => true
        ]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\MajorSeeder',
            '--force' => true
        ]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\MajorUniversitySeeder',
            '--force' => true
        ]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\MajorSkillSeeder',
            '--force' => true
        ]);

        return "Tebrikler! Bütün sistem, sorular, kategoriler, beceri-bölüm eşleşmeleri ve orijinal Admin hesabı kusursuzca yüklendi! 🎉";
    } catch (\Exception $e) {
        return "Hata oluştu: " . $e->getMessage() . " | Satır: " . $e->getLine();
    }
});

// رابط فحص حالة السيرفر (مهم لمنصة Render)
Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});

// 1. مسار عرض صفحة التنبيه لتأكيد البريد الإلكتروني
Route::get('/email/verify', function () {
    return view('auth.verify-notice');
})->middleware('auth')->name('verification.notice');

// 2. مسار معالجة ضغطة المستخدم على الزر القادم في الإيميل (بدون حماية auth ليعمل بكفاءة)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('verification.verify');