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
        \Spatie\Permission\Models\Role::create(['name' => 'careerpath']);
        \Spatie\Permission\Models\Role::create(['name' => 'user']);

        // 1. Varsayılan bir kullanıcı oluşturun (isteğe bağlı).
        $admin = \App\Models\User::create([

            'name' => 'careerpath',
            'email' => 'internetmobil730@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('internet20mobil26'),
        ]);
        $admin->assignRole('careerpath');

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