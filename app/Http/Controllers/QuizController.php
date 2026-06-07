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
        // 1. التحقق من اختيار مهارة واحدة على الأقل
        $r->validate(['skills' => 'required|array|min:1']);
        
        $user = Auth::user();
        if ($user) {
            $user->skills()->sync($r->skills);
        }
    
        // 2. جلب التخصصات المرتبطة بالمهارات المختارة بطريقة مرنة ومضمونة
        $selectedSkills = $r->skills;

        $matchingMajors = Major::whereHas('skills', function($query) use ($selectedSkills) {
                $query->whereIn('skills.id', $selectedSkills);
            })
            ->with(['skills' => function($query) use ($selectedSkills) {
                $query->whereIn('skills.id', $selectedSkills);
            }])
            ->get()
            // ترتيب التخصصات برمجياً حسب عدد المهارات المشتركة من الأعلى للأقل
            ->sortByDesc(function($major) use ($selectedSkills) {
                return $major->skills->count();
            })
            // إزالة التكرار بناءً على اسم التخصص وإعادة ترتيب الـ Indexes للـ Blade
            ->unique('name')
            ->values();
    
        // إرسال المتغير الصحيح بنفس الاسم المتوقع في صفحة quiz_results
        return view('quiz_results', [
            'matchingMajors' => $matchingMajors
        ]);
    }
}