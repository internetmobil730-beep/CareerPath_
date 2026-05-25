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
        // 1. تفريغ جدول العلاقات القديم تماماً لمنع التضارب
        DB::table('major_skill')->truncate();

        // 2. جلب مهارات الهندسة والعلوم الأساسية
        $mathSkill = Skill::where('name', 'like', '%Matematik%')->first();
        $physicsSkill = Skill::where('name', 'like', '%Fizik%')->first();
        $analitikSkill = Skill::where('name', 'like', '%Analitik%')->first();
        $sayisalSkill = Skill::where('name', 'like', '%Sayısal%')->first();

        // 3. جلب مهارات البرمجة والحاسوب
        $algoSkill = Skill::where('name', 'like', '%Algoritma%')->first();
        $dataStructSkill = Skill::where('name', 'like', '%Veri Yapıları%')->first();
        $dbSkill = Skill::where('name', 'like', '%Veri Tabanı%')->first();

        // 4. جلب مهارات الطب والعلوم الطبية
        $anatomySkill = Skill::where('name', 'like', '%Anatomi%')->first();
        $biochemSkill = Skill::where('name', 'like', '%Biyokimya%')->first();
        $physiologySkill = Skill::where('name', 'like', '%Fizyoloji%')->first();
        $firstAidSkill = Skill::where('name', 'like', '%İlk Yardım%')->first();

        $pivotData = [];

        // 5. الربط الذكي المباشر من خلال الفحص البسيط بالـ SQL لتجنب مشاكل الحروف الصغيره والكبيرة
        foreach (Major::all() as $major) {
            $name = $major->name;

            // أ. إذا كان التخصص تخصص هندسي أو علمي بحت (يشمل هندسة الحاسوب، الكهرباء، الميكانيك، البرمجيات، المدني، إلخ)
            if (
                stripos($name, 'mühendis') !== false || 
                stripos($name, 'muhendis') !== false || 
                stripos($name, 'fizik') !== false || 
                stripos($name, 'matematik') !== false ||
                stripos($name, 'makine') !== false ||
                stripos($name, 'elektrik') !== false ||
                stripos($name, 'bilgisayar') !== false ||
                stripos($name, 'yazılım') !== false ||
                stripos($name, 'yazilim') !== false ||
                stripos($name, 'inşaat') !== false
            ) {
                if ($mathSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $mathSkill->id];
                if ($physicsSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $physicsSkill->id];
                if ($analitikSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $analitikSkill->id];
                if ($sayisalSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $sayisalSkill->id];

                // إذا كان برمجياً بالتحديد (حاسوب أو برمجيات)، نربطه بمهارات البرمجة الإضافية
                if (stripos($name, 'bilgisayar') !== false || stripos($name, 'yazıl') !== false || stripos($name, 'yazil') !== false) {
                    if ($algoSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $algoSkill->id];
                    if ($dataStructSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $dataStructSkill->id];
                    if ($dbSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $dbSkill->id];
                }
            }

            // ب. إذا كان التخصص طبياً صريحاً (طب، أسنان، تمريض، إسعافات، إلخ)
            if (
                stripos($name, 'tıp') !== false || 
                stripos($name, 'tip') !== false || 
                stripos($name, 'diş') !== false || 
                stripos($name, 'dis') !== false ||
                stripos($name, 'hemşire') !== false ||
                stripos($name, 'hemsire') !== false ||
                stripos($name, 'eczac') !== false ||
                stripos($name, 'ebelik') !== false ||
                stripos($name, 'acil') !== false
            ) {
                // نربطه فقط بمهارات الطب البحتة (ولا يأخذ رياضيات أو فيزياء هندسية)
                if ($anatomySkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $anatomySkill->id];
                if ($biochemSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $biochemSkill->id];
                if ($physiologySkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $physiologySkill->id];
                if ($firstAidSkill) $pivotData[] = ['major_id' => $major->id, 'skill_id' => $firstAidSkill->id];
            }
        }

        // 6. إدخال مصفوفة الربط المضمونة في قاعدة البيانات بضربة واحدة سريعة
        if (!empty($pivotData)) {
            DB::table('major_skill')->insertOrIgnore($pivotData);
        }
    }
}