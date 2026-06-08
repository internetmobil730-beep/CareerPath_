<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;  // استدعاء الواجهة (Interface)
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
// استدعاء الموديلات المطلوبة للعلاقات لضمان عدم حدوث خطأ
use App\Models\Major;
use App\Models\University;

class User extends Authenticatable// implements MustVerifyEmail // تطبيق الواجهة على الكلاس
{
    use HasFactory, Notifiable, HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills');
    }

    // 🌟 أضيفي هذه الدالة المفقودة هنا لكي يراها كود الـ Blade
public function favoriteMajors()
{
    return $this->belongsToMany(Major::class, 'favorites', 'user_id', 'major_id')->withTimestamps();
}
    // 🌟 إضافة دالة الجامعات المفضلة لربط كروت الجامعات بالجدول الصحيح 'favorites'
public function favoriteUniversities()
    {
        return $this->belongsToMany(University::class, 'favorites', 'user_id', 'university_id')->withTimestamps();
    }



    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}