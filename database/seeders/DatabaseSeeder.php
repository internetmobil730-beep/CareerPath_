<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. إنشاء الأدوار بشكل محمي يمنع التكرار والانهيار أونلاين
        // استبدلي السطر القديم المنهار بهذا السطر الآمن:
        \Spatie\Permission\Models\Role::firstOrCreate([
            'name' => 'careerpath', 
            'guard_name' => 'web'
        ]);

        // 2. إنشاء حساب الأدمن بشكل متوافق تماماً وبدون استخدام عمود الـ role المفقود
        $adminEmail = 'internetmobil730@gmail.com';
        $admin = User::where('email', $adminEmail)->first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'careerpath',
                'email' => $adminEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('internet20mobil26'),
            ]);
        }

        // ربط الصلاحية بالأدمن بأمان
        if (!$admin->hasRole('careerpath')) {
            $admin->assignRole($adminRole);
        }

        // 3. استدعاء باقي جداول الأسئلة والتخصصات
        $this->call([
            SkillCategorySeeder::class,
            SkillSeeder::class,
            UniversitySeeder::class,
            MajorSeeder::class,
            MajorUniversitySeeder::class,
            MajorSkillSeeder::class,
        ]);
    }
}