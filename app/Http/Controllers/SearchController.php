<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University; // موديل الجامعات الخاص بمشروعك
use App\Models\Major;      // موديل التخصصات الخاص بمشروعك

class SearchController extends Controller
{
    // تغيير اسم الدالة هنا إلى globalSearch ليطابق ملف الـ routes تماماً
    public function globalSearch(Request $request)
    {
        // استقبال نص البحث
        $query = $request->input('query');

        // 1. البحث في الجامعات
        $universities = University::where('name', 'LIKE', "%{$query}%")
                                    ->orWhere('description', 'LIKE', "%{$query}%")
                                    ->get();

        // 2. البحث في التخصصات
        $majors = Major::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // إرجاع صفحة عرض النتائج الموحدة المترجمة بالتركية مع تمرير المتغيرات
        return view('search_results', compact('universities', 'majors', 'query'));
    }
}