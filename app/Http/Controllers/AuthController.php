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

// 1. الصفحات العامة (متاحة للجميع: زوار وأعضاء)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::get('/api/user/favorites', [FavoriteController::class, 'getFavorites']);

// روابط البحث الشامل والصفحات العامة للتفاصيل
Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('global.search');
Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university.details');
Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public');

// روابط الحسابات وتسجيل الدخول
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. روابط الطلاب والمستخدمين العاديين
Route::middleware(['auth', 'block.admin'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
});

// 3. روابط لوحة تحكم الإدارة (الأدمن فقط حصرًا)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('skills', SkillController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('skill_categories', SkillCategoryController::class);
    Route::resource('users', UserController::class);
    Route::get('universities/{university}/manage-majors', [UniversityController::class, 'manageMajors'])->name('universities.majors');
    Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
});

// الكود المطور لحل تضارب الـ Seeders وتصفير كاش الروابط أونلاين 
Route::get('/run-migrate-path', function() {
    try {
        // تنظيف شامل وكامل لكل أنواع الكاش بما فيها كاش الروابط لإنهاء المشكلة فوراً 
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        $adminEmail = 'internetmobil730@gmail.com';
        $admin = \App\Models\User::where('email', $adminEmail)->first();
        
        if (!$admin) {
            $admin = \App\Models\User::create([
                'name' => 'careerpath',
                'email' => $adminEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('internet20mobil26'),
            ]);
        }
        
        if (!$admin->hasRole('careerpath')) {
            $admin->assignRole($adminRole);
        }

        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillCategorySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\UniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorUniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSkillSeeder', '--force' => true]);

        return "Tebrikler! Bütün yönlendirme önbelleği temizlendi ve sistem başarıyla güncellendi! 🎉";
    } catch (\Exception $e) {
        return "Hata oluştu: " . $e->getMessage() . " | Satır: " . $e->getLine();
    }
});

Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});

Route::get('/email/verify', function () {
    return view('auth.verify-notice');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');