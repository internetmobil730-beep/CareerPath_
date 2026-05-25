<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class MajorSkillSeeder extends Seeder 
{
    public function run(): void
    {
        // جلب المهارات من الداتابيز بالاسم لتسهيل الربط المباشر والدقيق
        $skills = Skill::pluck('id', 'name')->toArray();
        $pivotData = [];

        foreach (Major::all() as $major) {
            $majorName = mb_strtolower($major->name, 'UTF-8');
            $skillIds = [];

            // 1. مهارات الرياضيات والفيزياء العامة (ترتبط بكل الهندسات والعلوم الأساسية)
            if (preg_match('/(mühendis|fizik|matematik|istatistik|astronomi|havacılık|uçak|otomotiv)/', $majorName)) {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
                if (isset($skills['Genel Fizik'])) $skillIds[] = $skills['Genel Fizik'];
                if (isset($skills['Analitik Düşünme'])) $skillIds[] = $skills['Analitik Düşünme'];
                if (isset($skills['Sayısal Analiz'])) $skillIds[] = $skills['Sayısal Analiz'];
            }

            // 2. مهارات البرمجة والحاسوب والذكاء الاصطناعي
            if (preg_match('/(bilgisayar|yazılım|bilişim|yapay zeka|siber|programlama|veri|sistem|dijital oyun|mobil)/', $majorName)) {
                if (isset($skills['Algoritma Geliştirme'])) $skillIds[] = $skills['Algoritma Geliştirme'];
                if (isset($skills['Veri Yapıları'])) $skillIds[] = $skills['Veri Yapıları'];
                if (isset($skills['Yyapay Zeka Mantığı'])) $skillIds[] = $skills['Yyapay Zeka Mantığı'];
                if (isset($skills['Veri Tabanı Yönetimi'])) $skillIds[] = $skills['Veri Tabanı Yönetimi'];
                if (isset($skills['Web Tasarımı ve Front-end'])) $skillIds[] = $skills['Web Tasarımı ve Front-end'];
            }

            // 3. مهارات الهندسة الميكانيكية والكهربائية والتحكم
            if (preg_match('/(elektrik|elektronik|makine|mekatronik|otomasyon|kontrol|uçak|biyomedikal)/', $majorName)) {
                if (isset($skills['Elektriksel Devre Tasarımı'])) $skillIds[] = $skills['Elektriksel Devre Tasarımı'];
                if (isset($skills['Kontrol Sistemleri'])) $skillIds[] = $skills['Kontrol Sistemleri'];
                if (isset($skills['Termodinamik Prensipleri'])) $skillIds[] = $skills['Termodinamik Prensipleri'];
                if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
            }

            // 4. مهارات علم الأحياء والبيولوجيا (تظهر في الطب والتخصصات الطبية والحيوية)
            if (preg_match('/(tıp|tıb|biyoloji|genetik|biyomühendis|hemşire|eczac|diş|ebelik|laboratuvar|diyaliz|patoloji)/', $majorName)) {
                if (isset($skills['Genetik ve Kalıtım'])) $skillIds[] = $skills['Genetik ve Kalıtım'];
                if (isset($skills['Fizyoloji'])) $skillIds[] = $skills['Fizyoloji'];
            }

            // 5. مهارات التشريح والصحة الطبية البحتة (الطب، الأسنان، التمريض، المختبرات)
            if (preg_match('/(tıp|tıb|hemşire|diş|ebelik|laboratuvar|anestezi|diyaliz|patoloji|ameliyathane|ilk ve acil)/', $majorName)) {
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
                if (isset($skills['Tıbbi Etik ve Deontoloji'])) $skillIds[] = $skills['Tıbbi Etik ve Deontoloji'];
            }

            // 6. مهارات الإدارة والتجارة والاقتصاد والتسويق
            if (preg_match('/(işletme|yönetim|iktisat|ekonomi|finans|maliye|muhasebe|pazarlama|ticaret|lojistik|banka|sigorta)/', $majorName)) {
                if (isset($skills['Pazarlama Stratejileri'])) $skillIds[] = $skills['Pazarlama Stratejileri'];
                if (isset($skills['Finansal Analiz'])) $skillIds[] = $skills['Finansal Analiz'];
                if (isset($skills['Stratejik Yönetim'])) $skillIds[] = $skills['Stratejik Yönetim'];
                if (isset($skills['Finansal Muhasebe'])) $skillIds[] = $skills['Finansal Muhasebe'];
            }

            // 7. مهارات التصميم، العمارة والفنون
            if (preg_match('/(tasarım|mimar|grafik|moda|iç mekan|animasyon|3d)/', $majorName)) {
                if (isset($skills['Mimari Proje Tasarımı'])) $skillIds[] = $skills['Mimari Proje Tasarımı'];
                if (isset($skills['Grafiksel Görselleştirme'])) $skillIds[] = $skills['Grafiksel Görselleştirme'];
                if (isset($skills['UX/UI Tasarımı'])) $skillIds[] = $skills['UX/UI Tasarımı'];
                if (isset($skills['3D Modelleme ve Animasyon'])) $skillIds[] = $skills['3D Modelleme ve Animasyon'];
            }

            // 8. مهارات اللغات والترجمة
            if (preg_match('/(dil|edebiyat|mütercim|tercüman|çevirmen|ingilizce|almanca|arapça|fransızca|rusça)/', $majorName)) {
                if (isset($skills['Akademik İngilizce'])) $skillIds[] = $skills['Akademik İngilizce'];
                if (isset($skills['Teknik Çeviri (İngilizce)'])) $skillIds[] = $skills['Teknik Çeviri (İngilizce)'];
                if (isset($skills['Diksiyon ve Hitabet'])) $skillIds[] = $skills['Diksiyon ve Hitabet'];
            }

            // ربط المصفوفة وتنظيفها من التكرار
            $skillIds = array_filter(array_unique($skillIds));

            foreach ($skillIds as $skillId) {
                $pivotData[] = [
                    'major_id' => $major->id,
                    'skill_id' => $skillId,
                ];
            }
        }

        // إدخال البيانات في جدول الـ Pivot بضربة واحدة سريعة
        if (!empty($pivotData)) {
            DB::table('major_skill')->insertOrIgnore($pivotData);
        }
    }
}