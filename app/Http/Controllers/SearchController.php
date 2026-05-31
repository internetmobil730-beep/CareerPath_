namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University; // موديل الجامعات
use App\Models\Major;      // موديل التخصصات

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');

        // 1. البحث في الجامعات
        $universities = University::where('name', 'LIKE', "%{$query}%")
                                    ->orWhere('description', 'LIKE', "%{$query}%")
                                    ->get();

        // 2. البحث في التخصصات
        $majors = Major::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // إرسال جميع النتائج إلى صفحة عرض نتائج موحدة
        return view('search_results', compact('universities', 'majors', 'query'));
    }
}