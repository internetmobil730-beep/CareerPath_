<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;  // استدعاء الواجهة
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Major;
use App\Models\University;

class User extends Authenticatable //implements MustVerifyEmail // تطبيق واجهة التحقق المباشر
{
    // دمج الـ Traits بدون تكرار برمي لتجنب أي تعارض في الخصائص
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasProfilePhoto, TwoFactorAuthenticatable;

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

    // علاقة مهارات المستخدم
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skills');
    }

    // علاقة التخصصات المفضلة
    public function favoriteMajors()
    {
        return $this->belongsToMany(Major::class, 'favorites', 'user_id', 'major_id')->withTimestamps();
    }
        
    // علاقة الجامعات المفضلة
    public function favoriteUniversities()
    {
        return $this->belongsToMany(University::class, 'favorites', 'user_id', 'university_id')->withTimestamps();
    }

    // التحقق من صلاحية المدير
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}