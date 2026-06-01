<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // استبدل Post بالموديل الخاص بمشروعك

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // استقبال نص البحث
        $searchQuery = $request->input('query');

        // البحث في قاعدة البيانات إذا كان النص غير فارغ
        $results = Post::where('title', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('description', 'LIKE', "%{$searchQuery}%")
                        ->get();

        // إرجاع الصفحة مع النتائج وكلمة البحث
        return view('search-results', compact('results', 'searchQuery'));
    }
}
