<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University; 
use App\Models\Major;      
use App\Models\Skill;      

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');

        // 1. البحث في الجامعات (تعديل الحقول إلى name و description لتطابق الـ Migration)
        $universities = University::where('name', 'LIKE', "%{$query}%")
                                    ->orWhere('description', 'LIKE', "%{$query}%")
                                    ->orWhere('district', 'LIKE', "%{$query}%")
                                    ->get();

        // 2. البحث في التخصصات (مطابق تماماً)
        $majors = Major::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // 3. البحث في المهارات (حذف البحث في description لأنه غير موجود في جدول الـ skills)
        $skills = Skill::where('name', 'LIKE', "%{$query}%")
                        ->get();

        return view('search_results', compact('universities', 'majors', 'skills', 'query'));
    }
}