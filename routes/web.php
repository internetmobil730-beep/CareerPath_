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


// 1. Genel sayfalar ve arama (tüm ziyaretçilere ve üyelere açıktır - koruma olmadan)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kapsamlı Favoriler ve Kenar Çubuğu Bağlantıları
Route::post('/favorite/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');
Route::get('/api/user/favorites', [FavoriteController::class, 'getFavorites']);

// Arama çubuğu ve düğmelerle birlikte çalışacak kapsamlı arama bağlantıları ve genel detay sayfaları
Route::get('/global-search', [SearchController::class, 'globalSearch'])->name('global.search');

// Düğmelerin ve arama çubuğunun Blade dosyasında ne yazılırsa yazılsın çalışmasını sağlamak için beklenen adlar (nokta ve tirelerle birlikte) tekrarlanıyor.
Route::get('/major-details/{id}', [MajorController::class, 'showPublic'])->name('major.details');
Route::get('/university-details/{id}', [UniversityController::class, 'showPublic'])->name('university.details');

// Hesap bağlantıları ve giriş
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 2. Öğrenciler ve normal kullanıcılar için bağlantılar (yöneticilerin buraya girmesine izin verilmez)
Route::middleware(['auth', 'block.admin'])->group(function () {
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::post('/quiz-results', [QuizController::class, 'submit'])->name('quiz_results.submit');
});


// 3. Yönetici kontrol paneline bağlantılar (sadece gerçek yönetici için ve tamamen güvenli)
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


// 4. Kapsamlı önbellek temizleme ve çevrimiçi tablo sıfırlama (çakışma olmadan) için geliştirilmiş kod
Route::get('/run-migrate-path', function() {
    try {
        // 1. Bağlantı veya ayar çakışmalarının oluşmadığından emin olmak için Laravel önbelleğini tamamen temizleyin.
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // 2. Masaların temizlenmesi ve sıfırdan inşası
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 3. İzinleri programatik olarak ve güvenli bir şekilde oluşturma
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'user']);
        
        // 4. Proje için orijinal yönetici hesabını kontrol edin ve oluşturun
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
        
        // İzinleri güvenli bir şekilde yöneticiye bağlama
        if (!$admin->hasRole('careerpath')) {
            $admin->assignRole($adminRole);
        }

        // 5. Veritabanı için doğru ve ideal sırada veri ekleyicileri çağırma
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


// 5. Sunucu durumunu kontrol etmek ve hesabı e-posta yoluyla onaylamak için bağlantılar (doğrudan bağlantı için kimlik doğrulama koruması bulunmamaktadır)
Route::get('/healthz', function () { 
    return response()->json(['status' => 'ok']); 
});

// Kullanıcının kayıt olduktan sonra e-postalarını kontrol edebilmesi için uyarı sayfasının görüntüleneceği yol (kimlik doğrulaması gereklidir)
Route::get('/email/verify', function () { 
    return view('auth.verify-notice'); 
})->middleware('auth')->name('verification.notice');

// E-postadaki bağlantıya kullanıcının tıklaması için işlem yolu (herhangi bir tarayıcıdan çalışması için kimlik doğrulama koruması olmadan)
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');