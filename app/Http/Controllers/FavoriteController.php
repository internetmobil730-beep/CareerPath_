<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        // 1. التأكد أولاً أن المستخدم مسجل دخوله للموقع
        if (!Auth::check()) {
            return response()->json(['error' => 'Lütfen önce giriş yapın.'], 401);
        }
        
        // 🌟 إذا كان زائر، نرسل رد غير مصرح ومعه رسالة التنبيه بالتركية أو العربية كما تحبين
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthenticated', 
                'message' => 'Favorilere eklemek için lütfen önce giriş yapın أو سجل دخولك أولاً.'
            ], 401);
        }

        $userId = Auth::id();
        $majorId = $request->input('major_id');
        $universityId = $request->input('university_id');

        // 2. البحث في جدول المفضلة لمعرفة إن كان هذا الكرت مضافاً مسبقاً أم لا
        $query = Favorite::where('user_id', $userId);
        
        if ($majorId) {
            $query->where('major_id', $majorId);
        } else {
            $query->where('university_id', $universityId);
        }

        $favorite = $query->first();

        // 3. التبديل الذكي: إن كان موجوداً نقوم بحذفه (Unfavorite)، وإن لم يكن موجوداً نقوم بإنشائه (Favorite)
        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'major_id' => $majorId,
                'university_id' => $universityId
            ]);
            return response()->json(['status' => 'added']);
        }
    }


    // دالة جديدة  مهمتها تلبية طلب الجافا سكريبت وإرسال التخصصات والجامعات المفضلة للمستخدم الحالي:
   public function getFavorites()
    {
        try {
            // 1. إذا كان زائر، الـ Sidebar يعرض دائماً أصفاراً وقائمة فارغة دون أخطاء
            if (!Auth::check()) {
                return response()->json([
                    'majors' => [],
                    'universities' => [],
                    'total_count' => 0
                ]);
            }

            $user = Auth::user();

            // 2. جلب البيانات بأمان مع فحص وجود العلاقات لتجنب الـ Error 500
            // تأكدي أن العلاقات favoriteMajors و favoriteUniversities معرّفة في موديل User
            $majors = method_exists($user, 'favoriteMajors') 
                ? $user->favoriteMajors()->select('majors.id', 'majors.name')->get() 
                : collect();

            $universities = method_exists($user, 'favoriteUniversities') 
                ? $user->favoriteUniversities()->select('universities.id', 'universities.name')->get() 
                : collect();
            
            return response()->json([
                'majors' => $majors,
                'universities' => $universities,
                'total_count' => $majors->count() + $universities->count()
            ]);

        } catch (\Exception $e) {
            // 🌟 في حال حدوث أي خطأ سيرفري غير متوقع، نعيد رد JSON نظيف بدلاً من صفحة الـ HTML الانهيارية
            return response()->json([
                'majors' => [],
                'universities' => [],
                'total_count' => 0,
                'debug_error' => $e->getMessage() // هذا السطر سيطبع لكِ الخطأ الحقيقي داخل المتصفح للتعرف عليه
            ], 500);
        }
    }
}
