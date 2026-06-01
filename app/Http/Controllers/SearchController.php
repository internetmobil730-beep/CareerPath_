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

        // 1. البحث في الجامعات بناءً على حقول التركي المتوفرة لديكِ
        $universities = University::where('name_tr', 'LIKE', "%{$query}%")
                                    ->orWhere('description_tr', 'LIKE', "%{$query}%")
                                    ->orWhere('district', 'LIKE', "%{$query}%")
                                    ->get();

        // 2. البحث في التخصصات
        $majors = Major::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // 3. البحث في المهارات 
        $skills = Skill::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        return view('search_results', compact('universities', 'majors', 'skills', 'query'));
    }
}