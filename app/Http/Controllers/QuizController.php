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
        $skills = Skill::all(); // ⚠️ هنا المشكلة إذا كانت الداتابيز غير مهيأة
        return view('quiz', compact('skills'));
    }

    public function submit(Request $r)
    {
        $r->validate(['skills' => 'required|array|min:1']);
        $user = Auth::user();
        
        $user->skills()->sync($r->skills);
    
        // جلب التخصصات المرتبة حسب الأولوية الأعلى
        $matchingMajors = Major::whereHas('skills', function($query) use ($r) {
            $query->whereIn('skills.id', $r->skills);
        })
        ->withCount(['skills' => function($query) use ($r) {
            $query->whereIn('skills.id', $r->skills);
        }])
        ->orderBy('skills_count', 'desc')
        ->get();
    
        // 🌟 تعديل السطر السحري: أضفنا ->values() في النهاية لإعادة ترتيب المؤشرات ومنع انهيار الـ Blade
        $matchingMajors = $matchingMajors->unique('name')->values();
    
        return view('quiz_results', compact('matchingMajors'));
        
    }
}