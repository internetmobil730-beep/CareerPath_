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


// 1. الصفحات العامة (متاحة للجميع زوار وأعضاء)
Route::get('/', [HomeController::class, 'index'])->name('home');


// روابط الحسابات وتسجيل الدخول
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 2. روابط الطلاب والمستخدمين العاديين (ممنوع دخول الأدمن هنا)
Route::middleware(['auth', 'block.admin'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public');
    Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university_details');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');
});


// 3. روابط لوحة تحكم الإدارة (الأدمن فقط حصرًا)
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('skills', SkillController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('skill_categories', SkillCategoryController::class);
    Route::resource('users', UserController::class);
    Route::get('universities/{university}/manage-majors', [UniversityController::class, 'manageMajors'])->name('universities.majors');
    Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');
});

// 🌟 كود سحري لتشغيل الـ Migrate أونلاين بدون استخدام الـ Shell 🌟
Route::get('/run-migrate-path', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        return "Tebrikler! Bütün tablolar başarıyla sıfırlandı ve yeniden yüklendi. 🎉";
    } catch (\Exception $e) {
        return "Hata oluştu: " . $e->getMessage();
    }
});

// رابط فحص حالة السيرفر (مهم لمنصة Render)
Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});