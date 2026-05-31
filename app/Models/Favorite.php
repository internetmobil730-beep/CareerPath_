<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // السماح بحفظ هذه الحقول في قاعدة البيانات
    protected $fillable = ['user_id', 'major_id', 'university_id'];
}