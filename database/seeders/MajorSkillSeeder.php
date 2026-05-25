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
        // 1. تصفير جدول العلاقات تماماً لتنظيف أي عشوائية سابقة
        DB::table('major_skill')->truncate();

        // 2. جلب جميع المهارات بدقة من الداتابيز بالأسماء الحرفية
        $skills = Skill::pluck('id', 'name')->toArray();
        $pivotData = [];

        foreach (Major::all() as $major) {
            $name = mb_strtolower($major->name, 'UTF-8');
            $skillIds = [];

            // ---------------------------------------------------------
            // 🛑 القسم الأول: المهارات العلمية والهندسية البحتة (يُمنع خلطها بالطب)
            // ---------------------------------------------------------
            
            // أ. مهارات الحاسوب، البرمجة، والذكاء الاصطناعي (تخص الحاسوب والبرمجيات ونظم المعلومات فقط)
            if (
                stripos($name, 'bilgisayar') !== false || 
                stripos($name, 'yazılım') !== false || 
                stripos($name, 'yazilim') !== false || 
                stripos($name, 'yapay zeka') !== false || 
                stripos($name, 'bilişim') !== false
            ) {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
                if (isset($skills['Analitik Düşünme'])) $skillIds[] = $skills['Analitik Düşünme'];
                if (isset($skills['Algoritma Geliştirme'])) $skillIds[] = $skills['Algoritma Geliştirme'];
                if (isset($skills['Veri Yapıları'])) $skillIds[] = $skills['Veri Yapıları'];
                if (isset($skills['Veri Tabanı Yönetimi'])) $skillIds[] = $skills['Veri Tabanı Yönetimi'];
                if (isset($skills['Yyapay Zeka Mantığı'])) $skillIds[] = $skills['Yyapay Zeka Mantığı'];
                
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
                continue; // الانتقال للتخصص التالي مباشرة للحماية من التداخل
            }

            // ب. مهارات الهندسة العامة (ميكانيك، كهرباء، مدني)
            $isGeneralEngineering = (stripos($name, 'mühendis') !== false || stripos($name, 'muhendis') !== false) && stripos($name, 'biyomedikal') === false;
            if ($isGeneralEngineering) {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
                if (isset($skills['Genel Fizik'])) $skillIds[] = $skills['Genel Fizik'];
                if (isset($skills['Analitik Düşünme'])) $skillIds[] = $skills['Analitik Düşünme'];
                if (isset($skills['Sayısal Analiz'])) $skillIds[] = $skills['Sayısal Analiz'];
                
                // ربط المهارات الميكانيكية والهندسية التفصيلية
                if (stripos($name, 'makine') !== false || stripos($name, 'otomotiv') !== false || stripos($name, 'uçak') !== false) {
                    if (isset($skills['Termodinamik Prensipleri'])) $skillIds[] = $skills['Termodinamik Prensipleri'];
                    if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
                    if (isset($skills['Akışkanlar Mekaniği'])) $skillIds[] = $skills['Akışkanlar Mekaniği'];
                }
                
                // ربط مهارات الكهرباء والإلكترونيات والتحكم
                if (stripos($name, 'elektrik') !== false || stripos($name, 'elektronik') !== false || stripos($name, 'mekatronik') !== false) {
                    if (isset($skills['Elektriksel Devre Tasarımı'])) $skillIds[] = $skills['Elektriksel Devre Tasarımı'];
                    if (isset($skills['Kontrol Sistemleri'])) $skillIds[] = $skills['Kontrol Sistemleri'];
                }
                
                // ربط مهارات الهندسة المدنية والعمارة
                if (stripos($name, 'inşaat') !== false || stripos($name, 'mimar') !== false) {
                    if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
                    if (isset($skills['Malzeme Bilimi'])) $skillIds[] = $skills['Malzeme Bilimi'];
                }

                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
                continue;
            }

            // ---------------------------------------------------------
            // 🛑 القسم الثاني: المهارات الطبية والصحية الصارمة (يُمنع خلطها بالهندسة)
            // ---------------------------------------------------------
            
            // أ. مهارات الطب البشري العام والتمريض
            if (stripos($name, 'tıp') !== false || stripos($name, 'tip') !== false || stripos($name, 'hemşire') !== false || stripos($name, 'hemsire') !== false) {
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
                if (isset($skills['Fizyoloji'])) $skillIds[] = $skills['Fizyoloji'];
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
                if (isset($skills['Farmakoloji'])) $skillIds[] = $skills['Farmakoloji'];
                if (isset($skills['Patoloji'])) $skillIds[] = $skills['Patoloji'];
                if (isset($skills['Klinik Mikrobiyoloji'])) $skillIds[] = $skills['Klinik Mikrobiyoloji'];
                if (isset($skills['Histoloji ve Embriyoloji'])) $skillIds[] = $skills['Histoloji ve Embriyoloji'];
                if (isset($skills['Epidemiyoloji'])) $skillIds[] = $skills['Epidemiyoloji'];
                if (isset($skills['İmmünoloji'])) $skillIds[] = $skills['İmmünoloji'];
                if (isset($skills['Genetik ve Kalıtım'])) $skillIds[] = $skills['Genetik ve Kalıtım'];
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
                
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
                continue;
            }

            // ب. مهارات طب الأسنان وتكنولوجيا تعويضات الأسنان (Diş Hekimliği / Diş Protez)
            if (stripos($name, 'diş') !== false || stripos($name, 'dis') !== false) {
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
                if (isset($skills['Diş Morfolojisi'])) $skillIds[] = $skills['Diş Morfolojisi'];
                if (isset($skills['Restoratif Diş Tedavisi'])) $skillIds[] = $skills['Restoratif Diş Tedavisi'];
                if (isset($skills['Diş Protez Teknolojisi'])) $skillIds[] = $skills['Diş Protez Teknolojisi'];
                if (isset($skills['Ortodonti Prensipleri'])) $skillIds[] = $skills['Ortodonti Prensipleri'];
                
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
                continue;
            }

            // ج. مهارات الصيدلة البحتة (Eczacılık)
            if (stripos($name, 'eczac') !== false) {
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
                if (isset($skills['Farmakoloji'])) $skillIds[] = $skills['Farmakoloji'];
                if (isset($skills['Klinik Mikrobiyoloji'])) $skillIds[] = $skills['Klinik Mikrobiyoloji'];
                continue;
            }

            // د. مهارات التخصصات الصحية المساعدة (البصريات، الإسعافات، الأطراف، الهندسة الطبية)
            if (stripos($name, 'optisyen') !== false) {
                if (isset($skills['Optisyenlik ve Cam Montajı'])) $skillIds[] = $skills['Optisyenlik ve Cam Montajı'];
                if (isset($skills['Genel Fizik'])) $skillIds[] = $skills['Genel Fizik'];
            }
            if (stripos($name, 'ortez') !== false || stripos($name, 'protez') !== false) {
                if (isset($skills['Ortez ve Protez Teknolojisi'])) $skillIds[] = $skills['Ortez ve Protez Teknolojisi'];
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
            }
            if (stripos($name, 'biyomedikal') !== false) {
                if (isset($skills['Biyomedikal Cihaz Teknolojisi'])) $skillIds[] = $skills['Biyomedikal Cihaz Teknolojisi'];
                if (isset($skills['Elektriksel Devre Tasarımı'])) $skillIds[] = $skills['Elektriksel Devre Tasarımı'];
            }
            if (stripos($name, 'diyaliz') !== false) {
                if (isset($skills['Diyaliz Ekipman Yönetimi'])) $skillIds[] = $skills['Diyaliz Ekipman Yönetimi'];
                if (isset($skills['Fizyoloji'])) $skillIds[] = $skills['Fizyoloji'];
            }
            if (stripos($name, 'acil') !== false || stripos($name, 'ilkyardım') !== false) {
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
            }
            if (stripos($name, 'radyoloji') !== false || stripos($name, 'görüntüleme') !== false) {
                if (isset($skills['Radyolojik Görüntüleme'])) $skillIds[] = $skills['Radyolojik Görüntüleme'];
            }

            // هـ. مهارات التخصصات المخبرية والتشريحية (Laboratuvar / Patoloji)
            if (stripos($name, 'laboratuvar') !== false || stripos($name, 'tıbbi biyolojik') !== false) {
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
                if (isset($skills['Klinik Mikrobiyoloji'])) $skillIds[] = $skills['Klinik Mikrobiyoloji'];
                if (isset($skills['Histoloji ve Embriyoloji'])) $skillIds[] = $skills['Histoloji ve Embriyoloji'];
            }

            // و. مهارات العلوم الكيميائية وإدارة العمليات (Kimya)
            if (stripos($name, 'kimya') !== false) {
                if (isset($skills['Kimyasal Süreç Yönetimi'])) $skillIds[] = $skills['Kimyasal Süreç Yönetimi'];
                if (isset($skills['Malzeme Bilimi'])) $skillIds[] = $skills['Malzeme Bilimi'];
            }

            // حفظ المهارات الإضافية المتبقية للتخصصات الفرعية
            if (!empty($skillIds)) {
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
            }
        }

        // 3. إدخال البيانات المفلترة بالكامل والمترابطة بشكل صحيح
        if (!empty($pivotData)) {
            DB::table('major_skill')->insertOrIgnore($pivotData);
        }
    }

    private function insertSkillsForMajor($majorId, $skillIds, &$pivotData)
    {
        $skillIds = array_filter(array_unique($skillIds));
        foreach ($skillIds as $skillId) {
            $pivotData[] = [
                'major_id' => $majorId,
                'skill_id' => $skillId,
            ];
        }
    }
}