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

        // البحث في الجامعات
        $universities = University::where('name', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->get();

        // البحث في التخصصات
        $majors = Major::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        // البحث في المهارات
        $skills = Skill::where('name', 'LIKE', "%{$query}%")
            ->get();

        return view('search_results', compact('universities', 'majors', 'skills', 'query'));
    }
}