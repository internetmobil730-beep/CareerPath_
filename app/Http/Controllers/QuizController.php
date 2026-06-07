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
        if ($user) {
            $user->skills()->sync($r->skills);
        }
    
        $selectedSkills = $r->skills;
    
        // جلب التخصصات التي تملك المهارات المختارة بشكل مباشر وصريح
        $matchingMajors = Major::whereHas('skills', function($query) use ($selectedSkills) {
                $query->whereIn('major_skill.skill_id', $selectedSkills); // تحديد اسم الجدول هنا لضمان التطابق
            })
            ->get()
            ->unique('name')
            ->values();
    
        return view('quiz_results', [
            'matchingMajors' => $matchingMajors
        ]);
    }
}