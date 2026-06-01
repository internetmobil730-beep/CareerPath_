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
use Illuminate\Foundation\Auth\EmailVerificationRequest; // هي مشان مسار معالجة ضغطة المستخدم على رابط التأكيد القادم في الإيميل
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;

// 1. الصفحات العامة (متاحة للجميع زوار وأعضاء)
Route::get('/', [HomeController::class, 'index'])->name('home');
//  . مسار التبديل ومسار جلب البيانات للـ Sidebar.  روابط المفضلة والـ Sidebar الجديدة أضيفيها هنا 
Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::get('/api/user/favorites', [FavoriteController::class, 'getFavorites']);

// روابط الحسابات وتسجيل الدخول
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. روابط الطلاب والمستخدمين العاديين (ممنوع دخول الأدمن هنا)
// حذفت كلمة 'verified'
Route::middleware(['auth', 'block.admin'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public');
    Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university_details');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');
});


// 3. روابط لوحة تحكم الإدارة (الأدمن الحقيقي فقط حصرًا ومحمي تماماً)
// حذفت كلمة 'verified'

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

Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('global.search');
Route::get('/university-details/{id}', [UniversityController::class, 'showDetails'])->name('university.details');
Route::get('/quiz', [QuizController::class, 'showDetails'])->name('quiz');
Route::get('/major-details/{id}', [MajorController::class, 'showDetails'])->name('major_details_public');
// الكود النهائي المطور لحل تضارب الـ Seeders والصلاحيات أونلاين 
Route::get('/run-migrate-path', function() {
    try {
        // 1. تنظيف كاش لارافيل وكاش المكتبات لضمان عدم حدوث تضارب
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // 2. تنظيف وبناء الجداول من الصفر
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 3. إنشاء الصلاحيات برمجياً بشكل محمي
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        // 4. فحص وإنشاء حساب الأدمن بالصيغة الأصلية لمشروعكِ
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
        
        // ربط الصلاحية بالأدمن بشكل آمن
        if (!$admin->hasRole('careerpath')) {
            $admin->assignRole($adminRole);
        }

        // 5. استدعاء الـ Seeders بالترتيب الصحيح والمثالي لقاعدة البيانات
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
        
        //  هنا تم حقن السيرفر الجديد لبناء علاقات المهارات بالتخصصات 
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

// 1. مسار عرض صفحة التنبيه (نتركه كما هو، يحتاج تسجيل دخول لكي يراه المستخدم بعد التسجيل مباشرة)
// مسار عرض صفحة التنبيه للمستخدم بعد التسجيل مباشرة لكي يذهب ويفحص بريده
// مسار عرض صفحة التنبيه للمستخدم لتأكيد بريده الإلكتروني (استدعاء ملف العرض)
Route::get('/email/verify', function () {
    return view('auth.verify-notice');
})->middleware('auth')->name('verification.notice');

// 2. المسار الجديد والمعدل: يوجه الطلب للـ Controller ونحذف منه الـ 'auth' ليعمل من أي متصفح
// مسار معالجة ضغطة المستخدم على الزر القادم في الإيميل (مربوط بالـ Controller وبدون حماية auth)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])

    ->name('verification.verify');

