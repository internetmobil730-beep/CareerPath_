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
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// =========================================================================
// 1. Genel Sayfalar ve Arama (Herkese Açık - Koruma Olmadan)
// =========================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('global.search');

// Detay Sayfaları (Eski ve Yeni İsimlendirme Destekleri)
Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public');
Route::get('/major-details-alt/{id}', [MajorController::class, 'showPublic'])->name('major.details');
Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university_details');
Route::get('/university-details-alt/{id}', [UniversityController::class, 'showPublic'])->name('university.details');

// Misafir Kullanıcı Giriş/Kayıt Bağlantıları (Sadece Giriş Yapmamış Kişiler)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================================================================
// 2. E-posta Onaylama Mekanizması (Email Verification Routes)
// =========================================================================

// صفحة التنبيه التي تخبر المستخدم بضرورة تفعيل الإيميل قبل تصفح الموقع
Route::get('/email/verify', function () { 
    return view('auth.verify-notice'); 
})->middleware('auth')->name('verification.notice');

// الرابط الفعلي القادم من الإيميل لتفعيل الحساب (بدون auth لتجنب مشاكل اختلاف المتصفحات)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// مسار إعادة إرسال كود التفعيل في حال ضياعه أو لم يصل للبريد أول مرة
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// =========================================================================
// 3. Öğrenciler İçin Korumalı Sayfalar (Giriş Yapmış ve E-postasını Onaylamış)
// =========================================================================
Route::middleware(['auth', 'verified', 'block.admin'])->group(function () {
    
    // Sınav (Quiz) Sayfaları
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');

    // Favoriler ve Kullanıcı İşlemleri
    Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
    Route::get('/api/user/favorites', [FavoriteController::class, 'getFavorites']);
});


// =========================================================================
// 4. Yönetici Paneli Bağlantıları (Sadece Gerçek Admin ve Güvenli)
// =========================================================================
Route::middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('skills', SkillController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('skill_categories', SkillCategoryController::class);
    Route::resource('users', UserController::class);
    Route::get('universities/{university}/manage-majors', [UniversityController::class, 'manageMajors'])->name('universities.majors');
    Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
});


// =========================================================================
// 5. Geliştirici Özel Yol Haritası (Migrate, Seed ve Admin Kurulumu)
// =========================================================================
Route::get('/run-migrate-path', function() {
    try {
        // 1. Önbellekleri Temizle
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // 2. Tabloları Sıfırla
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 3. Rolleri Oluştur
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        // 4. Orijinal Admin Hesabı Kurulumu (E-postası Onaylı Olarak)
        $adminEmail = 'internetmobil730@gmail.com';
        $admin = \App\Models\User::where('email', $adminEmail)->first();
        
        if (!$admin) {
            $admin = \App\Models\User::create([
                'name' => 'careerpath',
                'email' => $adminEmail,
                'email_verified_at' => now(), // حساب الإدارة مفعل تلقائياً لكي لا ينغلق عليكِ البنل
                'password' => bcrypt('internet20mobil26'),
            ]);
        }
        
        if (!$admin->hasRole('careerpath')) {
            $admin->assignRole($adminRole);
        }

        // 5. Seeders Çalıştırılması
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillCategorySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\UniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorUniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSkillSeeder', '--force' => true]);

        return "Tebrikler! Bütün sistem, sorular, kategoriler, beceri-bölüm eşleşmeleri ve orijinal Admin hesabı kusursuzca yüklendi!";
    } catch (\Exception $e) {
        return "Hata oluştu: " . $e->getMessage() . " | Satır: " . $e->getLine();
    }
});

// Sunucu Durum Kontrolü
Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});