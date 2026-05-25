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
    
        // السطر السحري: تصفية الأسماء المتكررة مع الحفاظ التام على الترتيب الذكي التنازلي القادم من الداتابيز
        $matchingMajors = $matchingMajors->unique('name');
    
        return view('quiz_results', compact('matchingMajors'));
    }
}