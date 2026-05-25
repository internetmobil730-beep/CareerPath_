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
        // 1. تصفير الجدول تماماً لإنهاء التداخل القديم
        DB::table('major_skill')->truncate();

        // 2. جلب المهارات بدقة من قاعدة البيانات
        $math = Skill::where('name', 'like', '%Matematik%')->first();
        $physics = Skill::where('name', 'like', '%Fizik%')->first();
        $analitik = Skill::where('name', 'like', '%Analitik%')->first();
        $sayisal = Skill::where('name', 'like', '%Sayısal%')->first();

        $algo = Skill::where('name', 'like', '%Algoritma%')->first();
        $veriYapi = Skill::where('name', 'like', '%Veri Yapıları%')->first();
        $dbMng = Skill::where('name', 'like', '%Veri Tabanı%')->first();

        $anatomy = Skill::where('name', 'like', '%Anatomi%')->first();
        $biochem = Skill::where('name', 'like', '%Biyokimya%')->first();
        $physiology = Skill::where('name', 'like', '%Fizyoloji%')->first();
        $firstAid = Skill::where('name', 'like', '%İlk Yardım%')->first();

        $pivotData = [];

        foreach (Major::all() as $major) {
            $name = mb_strtolower($major->name, 'UTF-8');

            // ⚠️ أولاً: استبعاد التخصصات الطبية الهجينة (مثل الهندسة الطبية الحيوية) من الحسبان البرمجي البحت
            $isBiomedical = (stripos($name, 'biyomedikal') !== false);

            // أ. قسم الهندسة والتكنولوجيا الصريحة (يُمنع دخول أي مهارة طبية هنا)
            if (
                (stripos($name, 'mühendis') !== false || 
                 stripos($name, 'muhendis') !== false || 
                 stripos($name, 'bilgisayar') !== false || 
                 stripos($name, 'yazılım') !== false || 
                 stripos($name, 'yazilim') !== false || 
                 stripos($name, 'elektrik') !== false || 
                 stripos($name, 'makine') !== false || 
                 stripos($name, 'inşaat') !== false) 
                && !$isBiomedical // حماية هندسة الحاسوب والكهرباء والمدني من مهارات الطب
            ) {
                if ($math) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $math->id];
                if ($physics) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $physics->id];
                if ($analitik) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $analitik->id];
                if ($sayisal) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $sayisal->id];

                // إذا كانت هندسة حاسوب أو برمجيات تحديداً، نربطها بمهارات البرمجة
                if (stripos($name, 'bilgisayar') !== false || stripos($name, 'yazıl') !== false || stripos($name, 'yazil') !== false) {
                    if ($algo) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $algo->id];
                    if ($veriYapi) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $veriYapi->id];
                    if ($dbMng) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $dbMng->id];
                }
            }

            // ب. قسم الطب والعلوم الصحية البحتة (تأخذ التشريح والصحة فقط، ويُمنع ربطها بالبرمجة أو الرياضيات الهندسية)
            if (
                stripos($name, 'tıp') !== false || 
                stripos($name, 'tip') !== false || 
                stripos($name, 'diş') !== false || 
                stripos($name, 'dis') !== false || 
                stripos($name, 'hemşire') !== false || 
                stripos($name, 'hemsire') !== false || 
                stripos($name, 'eczac') !== false || 
                stripos($name, 'ebelik') !== false || 
                stripos($name, 'anestezi') !== false || 
                $isBiomedical // الهندسة الطبية الحيوية تأخذ المهارات الطبية هنا لملائمتها الوظيفية
            ) {
                if ($anatomy) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $anatomy->id];
                if ($biochem) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $biochem->id];
                if ($physiology) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $physiology->id];
                if ($firstAid) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $firstAid->id];
            }
        }

        // 3. إدخال البيانات المفلترة بالكامل دون أي تداخل
        if (!empty($pivotData)) {
            DB::table('major_skill')->insertOrIgnore($pivotData);
        }
    }
}