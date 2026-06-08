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
        $universities = University::all();
        $majors = Major::all();

        if ($universities->isEmpty() || $majors->isEmpty()) {
            $this->command->warn('Önce UniversitySeeder ve MajorSeeder çalıştırmalısın!');
            return;
        }

        $data = [];
        $timestamp = now();

        // 1. العثور على جامعة بيروني بشكل دقيق من الداتا بيز
        $biruniUni = $universities->first(function ($uni) {
            return str_contains(mb_strtolower($uni->name, 'UTF-8'), 'biruni');
        });

        // 🌟 المصفوفة الشاملة لكافة تخصصات جامعة بيروني الحقيقية (بكالوريوس + دبلوم) مع أسعارها الثابتة
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
            'Yönetim Bilişim Sistemleri' => 3800, // MIS

            // --- تخصصات المعاهد الدبلوم (Ön Lisans - MYO) ---
            'Bilgisayar Programcılığı' => 2500, // تخصصك الرائع والأساسي في الفلترة 🔥
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
            'Çocuk Gelişimi' => 2200,
            'Siber Güvenlik' => 2700,
            'Adalet' => 2500
        ];

        // 2. البدء في عملية الربط الذكية
        foreach ($majors as $major) {
            $majorNameLower = mb_strtolower($major->name, 'UTF-8');

            foreach ($universities as $university) {
                $uniNameLower = mb_strtolower($university->name, 'UTF-8');
                $isMYO = str_contains($uniNameLower, 'meslek yüksekokulu');

                // الفلتر الأكاديمي لمنع ربط كليات الـ Lisans بمعاهد الـ MYO المستقلة
                if ($isMYO && $major->degree_type === 'lisans') {
                    continue;
                }

                $shouldAttach = false;
                $price = 0;

                // -----------------------------------------------------------------
                // الحالة الأولى: إذا كان اللوب يمر حالياً على "جامعة بيروني"
                // -----------------------------------------------------------------
                if ($biruniUni && $university->id === $biruniUni->id) {
                    
                    // فحص إذا كان اسم التخصص من الداتا بيز يطابق أو يحتوي على أي تخصص حقيقي في مصفوفتنا
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
                // الحالة الثانية: باقي جامعات السيستم (توزيع تلقائي وعشوائي منظم)
                // -----------------------------------------------------------------
                else {
                    // توزيع شبه عشوائي ثابت يعتمد على الـ IDs لكي لا تتغير البيانات مع كل تحديث للموقع
                    $shouldAttach = (($major->id + $university->id) % 3 === 0);

                    if ($shouldAttach) {
                        // تحديد السعر تلقائياً حسب نوع الجامعة (حكومية أم خاصة) ومستوى الدراسة
                        if ($university->type === 'devlet') {
                            $price = ($major->degree_type === 'lisans') ? rand(800, 2500) : rand(400, 1200);
                        } else {
                            $price = ($major->degree_type === 'lisans') ? rand(3500, 8000) : rand(1800, 3500);
                        }
                    }
                }

                // إضافة العلاقة إلى مصفوفة الإدخال في حال تحقق الشروط
                if ($shouldAttach) {
                    $data[] = [
                        'major_id'      => $major->id,
                        'university_id' => $university->id,
                        'tuition_usd'   => $price,
                        'created_at'    => $timestamp,
                        'updated_at'    => $timestamp,
                    ];
                }

                // الحفظ على دفعات (كل 500 علاقة) لتجنب بطء سيرفر Render وحماية الذاكرة
                if (count($data) >= 500) {
                    DB::table('major_university')->upsert($data, ['major_id', 'university_id'], ['tuition_usd', 'updated_at']);
                    $data = [];
                }
            }
        }

        // إدخال آخر دفعة متبقية في المصفوفة إن وجدت
        if (!empty($data)) {
            DB::table('major_university')->upsert($data, ['major_id', 'university_id'], ['tuition_usd', 'updated_at']);
        }
    }
}