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
        // تأكدي أن السطر 17 مكتوب هكذا تماماً وليس باستخدام create
        \Spatie\Permission\Models\Role::firstOrCreate([
            'name' => 'careerpath',
            'role' => 'careerpath', // أضيفي الحقول المطلوبة لجدولك منعاً لأي خطأ ناتج عن الـ Migration
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