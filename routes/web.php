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

// =========================================================================
// 1. الصفحات العامة والبحث (متاحة للجميع زوار وأعضاء - بدون حماية)
// =========================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// روابط المفضلة والـ Sidebar الشاملة
Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::get('/api/user/favorites', [FavoriteController::class, 'getFavorites']);

// روابط البحث الشامل وصفحات التفاصيل العامة لتعمل مع شريط البحث والأزرار معاً
Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('global.search');

// تكرار الأسماء المتوقعة (بالنقطة وبالشرطة) لضمان عمل الأزرار وشريط البحث مهما كان المكتوب في الـ Blade
Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major_details_public')->name('major.details');
Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university_details')->name('university.details');

// روابط الحسابات وتسجيل الدخول
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================================================================
// 2. روابط الطلاب والمستخدمين العاديين (ممنوع دخول الأدمن هنا)
// =========================================================================
Route::middleware(['auth', 'block.admin'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');
});


// =========================================================================
// 3. روابط لوحة تحكم الإدارة (الأدمن الحقيقي فقط ومحمي تماماً)
// =========================================================================
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


// =========================================================================
// 4. الكود المطور لتنظيف الكاش الشامل وتصفير الجداول أونلاين (بدون تعارض)
// =========================================================================
Route::get('/run-migrate-path', function() {
    try {
        // 1. تنظيف كاش لارافيل بالكامل لضمان عدم حدوث تضارب في الروابط والإعدادات
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // 2. تنظيف وبناء الجداول من الصفر
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 3. إنشاء الصلاحيات برمجياً بشكل محمي
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        // 4. فحص وإنشاء حساب الأدمن الأصلي للمشروع
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
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillCategorySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\SkillSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\UniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorUniversitySeeder', '--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\MajorSkillSeeder', '--force' => true]);

        return "Tebrikler! Bütün sistem, sorular, kategoriler, beceri-bölüm eşleşmeleri ve orijinal Admin hesabı kusursuzca yüklendi! 🎉";
    } catch (\Exception $e) {
        return "Hata oluştu: " . $e->getMessage() . " | Satır: " . $e->getLine();
    }
});


// =========================================================================
// 5. روابط فحص حالة السيرفر وتأكيد الحساب بالإيميل (بدون حماية auth للرابط المباشر)
// =========================================================================
Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});

// مسار عرض صفحة التنبيه للمستخدم بعد التسجيل لكي يذهب ويفحص بريده (يحتاج auth)
Route::get('/email/verify', function () { 
    return view('auth.verify-notice'); 
})->middleware('auth')->name('verification.notice');

// مسار معالجة ضغطة المستخدم على الرابط القادم في الإيميل (بدون حماية auth ليعمل من أي متصفح)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');