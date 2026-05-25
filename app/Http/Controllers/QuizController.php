<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('quiz', compact('skills'));
    }

    public function submit(Request $r)
    {
        $r->validate(['skills' => 'required|array|min:1']);
        
        $user = Auth::user();
        
        // 1. حفظ مهارات المستخدم في جدول الربط الخاص به (إذا كان مسجلاً)
        if ($user) {
            $user->skills()->sync($r->skills);
        }

        // 2. جلب التخصصات وترتيبها حسب الأفضلية (الأكثر مطابقة للمهارات المحددة)
        $selectedSkills = $r->skills;

        $matchingMajors = Major::where('education_language', 'TR') // جلب نسخة واحدة من التخصص لمنع تكرار الكروت في الـ Blade
            ->whereHas('skills', function($query) use ($selectedSkills) {
                $query->whereIn('skills.id', $selectedSkills);
            })
            ->withCount(['skills' => function($query) use ($selectedSkills) {
                $query->whereIn('skills.id', $selectedSkills);
            }])
            ->orderBy('skills_count', 'desc')
            ->get();

        // 3. التوجيه لصفحة النتائج مع التخصصات المرتبة
        return view('quiz_results', compact('matchingMajors'));
    }
}