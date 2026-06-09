<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Major;
use Illuminate\Support\Facades\DB;

class MajorUniversitySeeder extends Seeder
{
    public function run(): void
    {
        // استخدام الإستعلام المباشر أو جلب العلاقات الأساسية لتخفيف استهلاك الذاكرة
        $universities = University::all();
        $majors = Major::all();

        if ($universities->isEmpty() || $majors->isEmpty()) {
            $this->command->warn('Önce UniversitySeeder ve MajorSeeder çalıştırmalısın!');
            return;
        }

        $data = [];
        $timestamp = now();

        // 1. العثور على جامعة بيروني بدقة لتطبيق أسعارها الثابتة والحقيقية
        $biruniUni = $universities->first(function ($uni) {
            return str_contains(mb_strtolower($uni->name, 'UTF-8'), 'biruni');
        });

        // 🌟 مصفوفة تخصصات جامعة بيروني الحقيقية بأسعارها الثابتة
        $biruniRealMajors = [
            // --- كليات البكالوريوس (Lisans) ---
            'Tıp' => 20000,
            'Diş Hekimliği' => 15000,
            'Eczacılık' => 12000,
            'Hemşirelik' => 4500,
            'Bilgisayar Mühendisliği' => 5500,
            'Yazılım Mühendisliği' => 5500,
            'İç Mimarlık ve Çevre Tasarımı' => 3800,
            'Fizyoterapi ve Rehabilitasyon' => 4000,
            'Beslenme ve Diyetetik' => 3500,
            'Odyoloji' => 3200,
            'Psikoloji' => 3800,
            'Moleküler Biyoloji ve Genetik' => 4000,
            'Biyomedikal Mühendisliği' => 4200,
            'Okul Öncesi Öğretmenliği' => 3400,
            'Özel Eğitim Öğretmenliği' => 3400,
            'İngiliz Dili ve Edebiyatı' => 3200,
            'Yönetim Bilişim Sistemleri' => 3800,

            // --- تخصصات المعاهد الدبلوم (Ön Lisans - MYO) ---
            'Bilgisayar Programcılığı' => 2500,
            'Anestezi' => 2800,
            'İlk ve Acil Yardım' => 2800,
            'Optisyenlik' => 2300,
            'Diyaliz' => 2300,
            'Ağız ve Diş Sağlığı' => 2500,
            'Tıbbi Laboratuvar Teknikleri' => 2400,
            'Tıbbi Görüntüleme Teknikleri' => 2400,
            'Ameliyathane Hizmetleri' => 2400,
            'Eczane Hizmetleri' => 2300,
            'Fizyoterapi' => 2400,
            'Çocuk Geliشimi' => 2200,
            'Siber Güvenlik' => 2700,
            'Adalet' => 2500
        ];

        // 2. البدء في حلقة الربط الذكي والأكاديمي الشامل
        foreach ($majors as $major) {
            $majorNameLower = mb_strtolower($major->name, 'UTF-8');

            foreach ($universities as $university) {
                $uniNameLower = mb_strtolower($university->name, 'UTF-8');
                $isMYO = str_contains($uniNameLower, 'meslek yüksekokulu');

                // فلتر أكاديمي لمنع ربط بكالوريوس بمعاهد دبلوم مستقلة
                if ($isMYO && $major->degree_type === 'lisans') {
                    continue;
                }

                $shouldAttach = false;
                $price = 0;

                // -----------------------------------------------------------------
                // الحالة الأولى: إذا كان اللوب يمر حالياً على "جامعة بيروني"
                // -----------------------------------------------------------------
                if ($biruniUni && $university->id === $biruniUni->id) {
                    foreach ($biruniRealMajors as $realName => $realPrice) {
                        $realNameLower = mb_strtolower($realName, 'UTF-8');
                        if (str_contains($majorNameLower, $realNameLower)) {
                            $shouldAttach = true;
                            $price = $realPrice;
                            break;
                        }
                    }
                }
                // -----------------------------------------------------------------
                // الحالة الثانية: باقي جامعات السيستم (ربط منطقي بناءً على نوع الجامعة والكلمات المفتاحية)
                // -----------------------------------------------------------------
                else {
                    // الفلترة الذكية للجامعات التخصصية:
                    $isTehnicUni = str_contains($uniNameLower, 'teknik');
                    $isHealthUni = str_contains($uniNameLower, 'sağlık') || str_contains($uniNameLower, 'tıp');
                    $isFineArtsUni = str_contains($uniNameLower, 'güzel sanatlar');

                    // أ) كلمات دلالية للتخصصات الطبية والصحية
                    $healthKeywords = ['tıp', 'diş', 'eczacılık', 'hemşirelik', 'sağlık', 'fizyoterapi', 'anestezi', 'laboratuvar', 'ameliyathane', 'diyaliz', 'optisyenlik', 'odyoloji', 'beslenme'];
                    // ب) كلمات دلالية للتخصصات الهندسية والتكنولوجية
                    $techKeywords = ['mühendisliği', 'bilgisayar', 'yazılım', 'programcılığı', 'bilişim', 'siber', 'elektronik', 'makine', 'inşaat', 'mimarlık'];
                    // ج) كلمات دلالية للفنون والتصميم
                    $artKeywords = ['tasarımı', 'grafik', 'iç mimarlık', 'moda', 'sinema', 'fotoğrafçılık', 'tiyatro', 'müzik', 'seramik'];

                    // تطبيق شروط الفلترة الأكاديمية:
                    if ($isHealthUni) {
                        // جامعات العلوم الصحية تُعطى الأولوية للتخصصات الطبية والصحية
                        foreach ($healthKeywords as $keyword) {
                            if (str_contains($majorNameLower, $keyword)) { $shouldAttach = true; break; }
                        }
                    } elseif ($isTehnicUni) {
                        // الجامعات التقنية تُعطى الأولوية للهندسة والتكنولوجيا
                        foreach ($techKeywords as $keyword) {
                            if (str_contains($majorNameLower, $keyword)) { $shouldAttach = true; break; }
                        }
                    } elseif ($isFineArtsUni) {
                        // جامعات الفنون الجميلة تُعطى تخصصات التصميم والفن
                        foreach ($artKeywords as $keyword) {
                            if (str_contains($majorNameLower, $keyword)) { $shouldAttach = true; break; }
                        }
                    } else {
                        // الجامعات العامة (Düz Üniversiteler) تحتوي على أغلب التخصصات الشائعة تلقائياً
                        // لمنع حشو كل التخصصات بكل الجامعات، نقوم بعمل ربط منطقي شبه عشوائي مدعوم بالـ ID للجامعات العامة
                        $shouldAttach = (($major->id + $university->id) % 2 === 0);
                    }

                    // إذا تأكد ربط التخصص بالجامعة، نحسب السعر بناءً على (حكومية/خاصة) ونوع التخصص
                    if ($shouldAttach) {
                        $isMedicalMajor = false;
                        foreach (['tıp', 'diş', 'eczacılık'] as $medKey) {
                            if (str_contains($majorNameLower, $medKey)) { $isMedicalMajor = true; break; }
                        }

                        if ($university->type === 'devlet') {
                            if ($isMedicalMajor) {
                                $price = rand(1500, 4000); // كليات الطب البشري والأسنان الحكومية للأجانب
                            } else {
                                $price = ($major->degree_type === 'lisans') ? rand(700, 2000) : rand(350, 900);
                            }
                        } else { // الجامعات الخاصة
                            if ($isMedicalMajor) {
                                $price = str_contains($majorNameLower, 'tıp') ? rand(14000, 22000) : rand(10000, 16000);
                            } else {
                                $price = ($major->degree_type === 'lisans') ? rand(3000, 7000) : rand(1500, 3000);
                            }
                        }
                    }
                }

                // 3. تجميع البيانات لحفظها في قاعدة البيانات
                if ($shouldAttach) {
                    $data[] = [
                        'major_id'      => $major->id,
                        'university_id' => $university->id,
                        'tuition_usd'   => $price,
                        'created_at'    => $timestamp,
                        'updated_at'    => $timestamp,
                    ];
                }

                // حفظ البيانات على دفعات (كل 500 علاقة) لتجنب تجاوز الذاكرة في Render
                if (count($data) >= 500) {
                    DB::table('major_university')->upsert($data, ['major_id', 'university_id'], ['tuition_usd', 'updated_at']);
                    $data = [];
                }
            }
        }

        // إدخال الدفعة الأخيرة المتبقية إن وجدت
        if (!empty($data)) {
            DB::table('major_university')->upsert($data, ['major_id', 'university_id'], ['tuition_usd', 'updated_at']);
        }
    }
}