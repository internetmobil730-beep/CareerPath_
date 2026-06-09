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
        // 2. جلب جميع المهارات من الداتابيز لبناء الروابط الصحيحة
        $skills = DB::table('skills')->pluck('id', 'name')->toArray();
        $majors = DB::table('majors')->get();

        $pivotData = [];

        // 3. جلب التخصصات وتصنيفها بدقة تامة لتوزيع المهارات عليها
        foreach ($majors as $major) {
            $skillIds = [];
            $name = trim($major->name);

            if (in_array($name, ['Bilgisayar Programcılıgı', 'Computer Programcılığı'])) {
                $name = 'Bilgisayar Programcılığı';
            }

            // ==========================================
            // [الدفعة الأولى] المهارات الهندسية والأساسية
            // ==========================================

            // 1. مهارة: İleri Matematik
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Matematik', 'İlköğretim Matematik Öğretmenliği', 'Bilgisayar Mühendisliği', 
                'Yazılım Mühendisliği', 'Yapay Zeka Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği', 
                'Bilişim Sistemleri Mühendisliği', 'Makine Mühendisliği', 'Mekatronik Mühendisliği', 
                'İnşaat Mühendisliği', 'Endüstri Mühendisliği', 'Havacılık ve Uzay Mühendisliği', 
                'Uçak Mühendisliği', 'Otomotiv Mühendisliği', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)'
            ])) {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
            }

            // 2. مهارة: Genel Fizik
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 
                'Makine Mühendisliği', 'Mekatronik Mühendisliği', 'İnşaat Mühendisliği', 
                'Havacılık ve Uzay Mühendisliği', 'Uçak Mühendisliği', 'Otomotiv Mühendisliği', 
                'Uçak Bakım ve Onarım', 'Elektrik', 'Makine', 'Uçak Teknolojisi', 'Biyomedikal Mühendisliği'
            ])) {
                if (isset($skills['Genel Fizik'])) $skillIds[] = $skills['Genel Fizik'];
            }

            // 3. مهارة: Statik ve Dinamik Analiz
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'İnşaat Mühendisliği', 'Makine Mühendisliği', 'Mekatronik Mühendisliği', 
                'Havacılık ve Uzay Mühendisliği', 'Uçak Mühendisliği', 'Otomotiv Mühendisliği', 
                'İnşaat Teknolojisi', 'Makine', 'Uçak Teknolojisi', 'Otomotiv Teknolojisi', 'Mimarlık'
            ])) {
                if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
            }

            // 4. مهارة: Termodinamik Prensipleri
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Makine Mühendisliği', 'Havacılık ve Uzay Müazaki Mühendisliği', 'Uçak Mühendisliği', 
                'Otomotiv Mühendisliği', 'Kimya Mühendisliği', 'Makine', 'Otomotiv Teknolojisi', 
                'Uçak Teknolojisi', 'Hibrid ve Elektrikli Taşıtlar Teknolojisi', 'Alternatif Enerji Kaynakları Teknolojisi'
            ])) {
                if (isset($skills['Termodinamik Prensipleri'])) $skillIds[] = $skills['Termodinamik Prensipleri'];
            }

            // 5. مهارة: Elektriksel Devre Tasarımı
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Mekatronik Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 
                'Biyomedikal Mühendisliği', 'Mekatronik', 'Elektronik Teknolojisi', 'Elektrik', 
                'Kontrol ve Otomasyon Teknolojisi', 'Biyomedikal Cihaz Teknolojisi', 'Bilgisayar Mühendisliği'
            ])) {
                if (isset($skills['Elektriksel Devre Tasarımı'])) $skillIds[] = $skills['Elektriksel Devre Tasarımı'];
            }

            // 6. مهارة: Malzeme Bilimi
            if (in_array($name, [
                'İnşaat Mühendisliği', 'Makine Mühendisliği', 'Kimya Mühendisliği', 'Tekstil Mühendisliği', 
                'İnşaat Teknolojisi', 'Makine', 'Uçak Teknolojisi', 'Mekatronik Mühendisliği', 'Otomotiv Mühendisliği', 'Diş Protez Teknolojisi'
            ])) {
                if (isset($skills['Malzeme Bilimi'])) $skillIds[] = $skills['Malzeme Bilimi'];
            }

            // 7. مهارة: Akışkanlar Mekaniği
            if (in_array($name, [
                'Makine Mühendisliği', 'Havacılık ve Uzay Mühendisliği', 'Uçak Mühendisliği', 
                'Otomotiv Mühendisliği', 'İnşaat Mühendisliği', 'Makine', 'Kimya Mühendisliği'
            ])) {
                if (isset($skills['Akışkanlar Mekaniği'])) $skillIds[] = $skills['Akışkanlar Mekaniği'];
            }

            // 8. مهارة: Kontrol Sistemleri
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Mekatronik Mühendisliği', 'Havacılık ve Uzay Mühendisliği', 
                'Mekatronik', 'Kontrol ve Otomasyon Teknolojisi', 'Elektronik Teknolojisi', 'Uçak Mühendisliği', 'Otomotiv Mühendisliği'
            ])) {
                if (isset($skills['Kontrol Sistemleri'])) $skillIds[] = $skills['Kontrol Sistemleri'];
            }

            // 9. مهارة: Kimyasal Süreç Yönetimi
            if (in_array($name, [
                'Kimya Mühendisliği', 'Kimya', 'Kimya Teknolojisi', 'Eczacılık', 'Moleküler Biyoloji ve Genetik'
            ])) {
                if (isset($skills['Kimyasal Süreç Yönetimi'])) $skillIds[] = $skills['Kimyasal Süreç Yönetimi'];
            }


            // =========================================================
            // [الدفعة الثانية] المهارات الطبية الأساسية، الصيدلانية وطب الأسنان
            // =========================================================

            // 10. مهارة: İnsan Anatomisi
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Ebelik', 'Fizyoterapi ve Rehabilitasyon', 
                'Fizyoterapi', 'Ameliyathane Hizmetleri', 'Yaşlı Bakımı', 'İlk ve Acil Yardım',
                'Odyoloji', 'Anestezi', 'Ağız ve Diş Sağlığı', 'Diş Hekimliği', 'Tıbbi Görüntüleme Teknikleri'
            ])) {
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
            }

            // 11. مهارة: Fizyoloji
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Ebelik', 'Fizyoterapi ve Rehabilitasyon', 
                'Fizyoterapi', 'Ameliyathane Hizmetleri', 'Yaşlı Bakımı', 'İlk ve Acil Yardım',
                'Odyoloji', 'Anestezi', 'Diş Hekimliği', 'Beslenme ve Diyetetik', 'Tıbbi Laboratuvar Teknikleri'
            ])) {
                if (isset($skills['Fizyoloji'])) $skillIds[] = $skills['Fizyoloji'];
            }

            // 12. مهارة: Tıbbi Biyokimya
            if (in_array($name, [
                'Tıp', 'Eczacılık', 'Beslenme ve Diyetetik', 'Moleküler Biyoloji ve Genetik', 
                'Biyoloji', 'Tıbbi Laboratuvar Teknikleri', 'Eczane Hizmetleri', 'Diş Hekimliği'
            ])) {
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
            }

            // 13. مهارة: Farmakoloji
            if (in_array($name, [
                'Tıp', 'Eczacılık', 'Hemşirelik', 'Ebelik', 
                'Anestezi', 'Eczane Hizmetleri', 'Diş Hekimliği', 'İlk ve Acil Yardım'
            ])) {
                if (isset($skills['Farmakoloji'])) $skillIds[] = $skills['Farmakoloji'];
            }

            // 14. مهارة: Patoloji
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Patoloji Laboratuvar Teknikleri', 'Tıbbi Laboratuvar Teknikleri', 'Diş Hekimliği', 'Ağız ve Diş Sağlığı'
            ])) {
                if (isset($skills['Patoloji'])) $skillIds[] = $skills['Patoloji'];
            }

            // 15. مهارة: Klinik Mikrobiyoloji
            if (in_array($name, [
                'Tıp', 'Eczacılık', 'Hemşirelik', 'Moleküler Biyoloji ve Genetik', 
                'Biyoloji', 'Tıbbi Laboratuvar Teknikleri', 'Diş Hekimliği', 'Ameliyathane Hizmetleri'
            ])) {
                if (isset($skills['Klinik Mikrobiyoloji'])) $skillIds[] = $skills['Klinik Mikrobiyoloji'];
            }

            // 16. مهارة: Histoloji ve Embriyoloji
            if (in_array($name, [
                'Tıp', 'Beslenme ve Diyetetik', 'Moleküler Biyoloji ve Genetik', 
                'Biyoloji', 'Patoloji Laboratuvar Teknikleri', 'Diş Hekimliği', 'Ebelik'
            ])) {
                if (isset($skills['Histoloji ve Embriyoloji'])) $skillIds[] = $skills['Histoloji ve Embriyoloji'];
            }

            // 17. مهارة: Diş Morfolojisi
            if (in_array($name, [
                'Diş Hekimliği', 'Ağız ve Diş Sağlığı', 'Diş Protez Teknolojisi'
            ])) {
                if (isset($skills['Diş Morfolojisi'])) $skillIds[] = $skills['Diş Morfolojisi'];
            }

            // 18. مهارة: Restoratif Diş Tedavisi
            if (in_array($name, [
                'Diş Hekimliği', 'Ağız ve Diş Sağlığı'
            ])) {
                if (isset($skills['Restoratif Diş Tedavisi'])) $skillIds[] = $skills['Restoratif Diş Tedavisi'];
            }

            // 19. مهارة: Epidemiyoloji
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Sağlık Yönetimi', 'Beslenme ve Diyetetik', 
                'Sağlık Kurumları İşletmeciliği', 'Ebelik'
            ])) {
                if (isset($skills['Epidemiyoloji'])) $skillIds[] = $skills['Epidemiyoloji'];
            }

            // 20. مهارة: İmmünoloji
            if (in_array($name, [
                'Tıp', 'Eczacılık', 'Hemşirelik', 'Moleküler Biyoloji ve Genetik', 
                'Biyoloji', 'Tıbbi Laboratuvar Teknikleri', 'Diş Hekimliği'
            ])) {
                if (isset($skills['İmmünoloji'])) $skillIds[] = $skills['İmmünoloji'];
            }


            // ========================================================
            // [الدفعة الثالثة] المهارات الطبية التطبيقية والتقنيات الصحية
            // ========================================================

            // 21. مهارة: Genetik ve Kalıtım
            if (in_array($name, [
                'Tıp', 'Moleküler Biyoloji ve Genetik', 'Biyoloji', 'Tıbbi Laboratuvar Teknikleri', 'Diş Hekimliği', 'Ebelik'
            ])) {
                if (isset($skills['Genetik ve Kalıtım'])) $skillIds[] = $skills['Genetik ve Kalıtım'];
            }

            // 22. مهارة: Radyolojik Görüntüleme
            if (in_array($name, [
                'Tıp', 'Tıbbi Görüntüleme Teknikleri', 'Radyoterapi', 'Nükleer Tıp Teknikleri', 'Diş Hekimliği', 'Ağız ve Diş Sağlığı'
            ])) {
                if (isset($skills['Radyolojik Görüntüleme'])) $skillIds[] = $skills['Radyolojik Görüntüleme'];
            }

            // 23. مهارة: Cerrahi Teknikler
            if (in_array($name, [
                'Tıp', 'Ameliyathane Hizmetleri', 'Diş Hekimliği'
            ])) {
                if (isset($skills['Cerrahi Teknikler'])) $skillIds[] = $skills['Cerrahi Teknikler'];
            }

            // 24. مهارة: Anestezi Uygulamaları
            if (in_array($name, [
                'Tıp', 'Anestezi', 'Ameliyathane Hizmetleri'
            ])) {
                if (isset($skills['Anestezi Uygulamaları'])) $skillIds[] = $skills['Anestezi Uygulamaları'];
            }

            // 25. مهارة: İlk Yardım ve Acil Müdahale
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Ebelik', 'Fizyoterapi ve Rehabilitasyon', 
                'Fizyoterapi', 'Ameliyathane Hizmetleri', 'Yaşlı Bakımı', 'İlk ve Acil Yardım',
                'Acil Yardım ve Afet Yönetimi', 'Acil Durum ve Afet Yönetimi', 'Sivil Savunma ve Itfaiyecilik',
                'Anestezi', 'Tıbbi Görüntüleme Teknikleri', 'Ağız ve Diş Sağlığı', 'Odyoloji'
            ])) {
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
            }

            // 26. مهارة: Ortodonti Prensipleri
            if (in_array($name, [
                'Diş Hekimliği', 'Ağız ve Diش Sağlığı', 'Diş Protez Teknolojisi'
            ])) {
                if (isset($skills['Ortodonti Prensipleri'])) $skillIds[] = $skills['Ortodonti Prensipleri'];
            }

            // 27. مهارة: Biyomedikal Cihaz Teknolojisi
            if (in_array($name, [
                'Biyomedikal Mühendisliği', 'Elektrik-Elektronik Mühendisliği', 'Biyomedikal Cihaz Teknolojisi', 'Elektronik Teknolojisi', 'Tıbbi Görüntüleme Teknikleri'
            ])) {
                if (isset($skills['Biyomedikal Cihaz Teknolojisi'])) $skillIds[] = $skills['Biyomedikal Cihaz Teknolojisi'];
            }

            // 28. مهارة: Optisyenlik ve Cam Montajı
            if (in_array($name, [
                'Optisyenlik'
            ])) {
                if (isset($skills['Optisyenlik ve Cam Montajı'])) $skillIds[] = $skills['Optisyenlik ve Cam Montajı'];
            }

            // 29. مهارة: Diş Protez Teknolojisi
            if (in_array($name, [
                'Diş Hekimliği', 'Diş Protez Teknolojisi'
            ])) {
                if (isset($skills['Diş Protez Teknolojisi'])) $skillIds[] = $skills['Diş Protez Teknolojisi'];
            }

            // 30. مهارة: Diyaliz Ekipman Yönetimi
            if (in_array($name, [
                'Tıp', 'Hemşirelik', 'Diyaliz'
            ])) {
                if (isset($skills['Diyaliz Ekipman Yönetimi'])) $skillIds[] = $skills['Diyaliz Ekipman Yönetimi'];
            }


            // ========================================================
            // [الدفعة الرابعة] مهارات البرمجة، هندسة البرمجيات، وعلم الحاسوب
            // ========================================================

            // 31. مهارة: Algoritma Geliştirme
            if (in_array($name, [
                'Elektrik-Elektronik Mühendisliği', 'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yapay Zeka Mühendisliği', 
                'Yapay Zeka ve Veri Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 
                'Adli Bilişim Mühendisliği', 'Bilgisayar Programcılığı', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)', 'Dijital Oyun Tasarımı'
            ])) {
                if (isset($skills['Algoritma Geliştirme'])) $skillIds[] = $skills['Algoritma Geliştirme'];
            }

            // 32. مهارة: Veri Yapıları
            if (in_array($name, [
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yapay Zeka Mühendisliği', 
                'Yapay Zeka ve Veri Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 
                'Adli Bilişim Mühendisliği', 'Bilgisayar Programcılığı', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)'
            ])) {
                if (isset($skills['Veri Yapıları'])) $skillIds[] = $skills['Veri Yapıları'];
            }

            // 33. مهارة: Yapay Zeka Mantığı
            if (in_array($name, [
                'Yapay Zeka Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği', 
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Bilgisayar Programcılığı', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)'
            ])) {
                if (isset($skills['Yapay Zeka Mantığı'])) $skillIds[] = $skills['Yapay Zeka Mantığı'];
            }

            // 34. مهارة: Yazılım Mimarisi
            if (in_array($name, [
                'Yazılım Mühendisliği', 'Bilgisayar Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 
                'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Yazılım Mimarisi'])) $skillIds[] = $skills['Yazılım Mimarisi'];
            }

            // 35. مهارة: Gömülü Sistemler
            if (in_array($name, [
                'Bilgisayar Mühendisliği', 'Elektrik-Elektronik Mühendisliği', 'Mekatronik Mühendisliği', 
                'Mekatronik', 'Elektronik Teknolojisi', 'Bilgisayar Programcılığı', 'Biyomedikal Mühendisliği'
            ])) {
                if (isset($skills['Gömülü Sistemler'])) $skillIds[] = $skills['Gömülü Sistemler'];
            }

            // 36. مهارة: Web Tasarımı ve Front-end
            if (in_array($name, [
                'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)', 'Bilgisayar Programcılığı', 
                'Web Tasarımı ve Kodlama', 'Yazılım Mühendisliği', 'Grafik Tasarımı', 'Bilgisayar Mühendisliği'
            ])) {
                if (isset($skills['Web Tasarımı ve Front-end'])) $skillIds[] = $skills['Web Tasarımı ve Front-end'];
            }

            // 37. مهارة: UX/UI Tasarımı
            if (in_array($name, [
                'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)', 'Web Tasarımı ve Kodlama', 
                'Bilgisayar Programcılığı', 'Grafik Tasarımı', 'Dijital Oyun Tasarımı', 'Yazılım Mühendisliği'
            ])) {
                if (isset($skills['UX/UI Tasarımı'])) $skillIds[] = $skills['UX/UI Tasarımı'];
            }

            // 38. مهارة: Siber Güvenlik ve Ağ Savunması
            if (in_array($name, [
                'Bilgi Güvenliği Teknolojisi', 'Siber Güvenlik', 'Bilişim Güvenliği Teknolojisi', 
                'Adli Bilişim Mühendisliği', 'Bilgisayar Mühendisliği', 'Bilgisayar Programcılığı', 'Yazılım Mühendisliği', 'Bilişim Sistemleri Mühendisliği'
            ])) {
                if (isset($skills['Siber Güvenlik ve Ağ Savunması'])) $skillIds[] = $skills['Siber Güvenlik ve Ağ Savunması'];
            }

            // 39. مهارة: Veri Tabanı Yönetimi
            if (in_array($name, [
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği', 
                'Bilişim Sistemleri Mühendisliği', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)', 
                'Bilgisayar Programcılığı', 'Web Tasarımı ve Kodlama', 'Siber Güvenlik'
            ])) {
                if (isset($skills['Veri Tabanı Yönetimi'])) $skillIds[] = $skills['Veri Tabanı Yönetimi'];
            }

            // 40. مهارة: Mobil Uygulama Geliştirme (iOS/Android)
            if (in_array($name, [
                'Yazılım Mühendisliği', 'Bilgisayar Mühendisliği', 'Bilgisayar Programcılığı', 
                'Mobil Teknolojiler', 'Web Tasarımı ve Kodlama', 'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)'
            ])) {
                if (isset($skills['Mobil Uygulama Geliştirme (iOS/Android)'])) $skillIds[] = $skills['Mobil Uygulama Geliştirme (iOS/Android)'];
            }

            // 41. مهارة: Bulut Bilişim
            if (in_array($name, [
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 
                'Yönetim Bilişim Sistemleri', 'Yönetim Bilişim Sistemleri (MIS)', 'Bilgisayar Programcılığı', 'Siber Güvenlik'
            ])) {
                if (isset($skills['Bulut Bilişim'])) $skillIds[] = $skills['Bulut Bilişim'];
            }

            // 42. مهارة: Bilgisayar Ağları ve Sunucu Yönetimi
            if (in_array($name, [
                'İnternet ve Ağ Teknolojileri', 'Bilgi Güvenliği Teknolojisi', 'Bilişim Güvenliği Teknolojisi', 
                'Bilgisayar Mühendisliği', 'Bilgisayar Programcılığı', 'Yazılım Mühendisliği', 'Siber Güvenlik'
            ])) {
                if (isset($skills['Bilgisayar Ağları ve Sunucu Yönetimi'])) $skillIds[] = $skills['Bilgisayar Ağları ve Sunucu Yönetimi'];
            }

            // 43. مهارة: Adli Bilişim Analizi
            if (in_array($name, [
                'Adli Bilişim Mühendisliği', 'Bilgi Güvenliği Teknolojisi', 'Hukuk', 'Adalet', 'Yazılım Mühendisliği', 'Bilgisayar Programcılığı', 'Siber Güvenlik'
            ])) {
                if (isset($skills['Adli Bilişim Analizi'])) $skillIds[] = $skills['Adli Bilişim Analizi'];
            }

            // 44. مهارة: Dijital Oyun Tasarımı
            if (in_array($name, [
                'Dijital Oyun Tasarımı', 'Bilgisayar Destekli Tasarım ve Animasyon', 
                'Grafik Tasarımı', 'Bilgisayar Programcılığı', 'Yazılım Mühendisliği', 'Bilgisayar Mühendisliği'
            ])) {
                if (isset($skills['Dijital Oyun Tasarımı'])) $skillIds[] = $skills['Dijital Oyun Tasarımı'];
            }


            // ========================================================
            // [الدفعة الخامسة] مهارات التعليم، الإعلام، الإدارة والخدمات العامة
            // ========================================================

            // 45. مهارة: Sınıf Yönetimi
            if (in_array($name, [
                'Okul Öncesi Öğretmenliği', 'Sınıf Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 'Çocuk Gelişimi'
            ])) {
                if (isset($skills['Sınıf Yönetimi'])) $skillIds[] = $skills['Sınıf Yönetimi'];
            }

            // 46. مهارة: Halkla İlişkiler
            if (in_array($name, [
                'Halkla İlişkiler ve Reklamcılık', 'Kurumsal İletişim', 'Sosyal Medya Yöneticiliği', 
                'Yeni Medya ve İletişim', 'İşletme', 'İşletme Yönetimi', 'Sağlık Yönetimi', 'Havacılık Yönetimi'
            ])) {
                if (isset($skills['Halkla İlişkiler'])) $skillIds[] = $skills['Halkla İlişkiler'];
            }

            // 47. مهارة: Rehberlik ve Danışmanlık
            if (in_array($name, [
                'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'Psikoloji', 'Sosyal Hizmet', 'Çocuk Gelişimi', 'Yaşlı Bakımı'
            ])) {
                if (isset($skills['Rehberlik ve Danışmanlık'])) $skillIds[] = $skills['Rehberlik ve Danışmanlık'];
            }

            // 48. مهارة: Büro Yönetimi
            if (in_array($name, [
                'Büro Yönetimi ve Yönetici Asistanlığı', 'Tıbbi Dokümantasyon ve Sekreterlik', 
                'Sağlık Kurumları İşletmeciliği', 'İşletme Yönetimi', 'Çağrı Merkezi Hizmetleri', 'Sağlık Yönetimi', 'Adalet'
            ])) {
                if (isset($skills['Büro Yönetimi'])) $skillIds[] = $skills['Büro Yönetimi'];
            }

            // 49. مهارة: Kabin Hizmetleri ve Yolcu İlişkileri
            if (in_array($name, [
                'Sivil Havacılık Kabin Hizmetleri', 'Havacılık Yönetimi', 'Turizm ve Otel İşletmeciliği'
            ])) {
                if (isset($skills['Kabin Hizmetleri ve Yolcu İlişkileri'])) $skillIds[] = $skills['Kabin Hizmetleri ve Yolcu İlişkileri'];
            }

            // 50. مهارة: Medya Analizi
            if (in_array($name, [
                'Yeni Medya ve İletişim', 'Gazetecilik', 'Radyo, Televizyon ve Sinema', 
                'Halkla İlişkiler ve Reklamcılık', 'Sosyoloji', 'Sosyal Medya Yöneticiliği'
            ])) {
                if (isset($skills['Medya Analizi'])) $skillIds[] = $skills['Medya Analizi'];
            }

            // 51. مهارة: Gazetecilik ve Haber Yazımı
            if (in_array($name, [
                'Gazetecilik', 'Yeni Medya ve İletişim', 'Radyo, Televizyon ve Sinema'
            ])) {
                if (isset($skills['Gazetecilik ve Haber Yazımı'])) $skillIds[] = $skills['Gazetecilik ve Haber Yazımı'];
            }

            // 52. مهارة: Kurumsal İletişim
            if (in_array($name, [
                'Kurumsal İletişim', 'Halkla İlişkiler ve Reklamcılık', 'İşletme', 
                'İnsan Kaynakları Yönetimi', 'Sağlık Yönetimi', 'Havacılık Yönetimi', 'Uluslararası Ticaret ve Lojistik'
            ])) {
                if (isset($skills['Kurumsal İletişim'])) $skillIds[] = $skills['Kurumsal İletيشim'];
            }

            // 53. مهارة: Diksiyon ve Hitabet
            if (in_array($name, [
                'Radyo, Televizyon ve Sinema', 'Halkla İlişkiler ve Reklamcılık', 'Gazetecilik', 
                'Okul Öncesi Öğretmenliği', 'Sınıf Öğretmenliği', 'İngilizce Öğretmenliği', 
                'Turist Rehberliği', 'Sivil Havacılık Kabin Hizmetleri', 'Çağrı Merkezi Hizmetleri', 'Hukuk', 'Psikoloji'
            ])) {
                if (isset($skills['Diksiyon ve Hitabet'])) $skillIds[] = $skills['Diksiyon ve Hitabet'];
            }


            // ========================================================
            // [الدفعة السادسة] مهارات التصميم، الفنون، والعمارة
            // ========================================================

            // 54. مهارة: Mimari Proje Tasarımı
            if (in_array($name, [
                'Mimarlık', 'İç Mimarlık', 'İç Mimarlık ve Çevre Tasarımı', 'Şehir ve Bölge Planlama', 'İnşaat Mühendisliği'
            ])) {
                if (isset($skills['Mimari Proje Tasarımı'])) $skillIds[] = $skills['Mimari Proje Tasarımı'];
            }

            // 55. مهارة: İç Mimari Restorasyon
            if (in_array($name, [
                'İç Mimarlık', 'İç Mimarlık ve Çevre Tasarımı', 'Mimarlık', 'Mimari Restorasyon', 'İç Mekan Tasarımı'
            ])) {
                if (isset($skills['İç Mimari Restorasyon'])) $skillIds[] = $skills['İç Mimari Restorasyon'];
            }

            // 56. مهارة: Grafiksel Görselleştirme
            if (in_array($name, [
                'Grafik Tasarımı', 'Görsel İletişim Tasarımı', 'Yeni Medya ve İletişim', 'Web Tasarımı ve Kodlama', 'Dijital Oyun Tasarımı', 'İç Mimarlık ve Çevre Tasarımı'
            ])) {
                if (isset($skills['Grafiksel Görselleştirme'])) $skillIds[] = $skills['Grafiksel Görselleştirme'];
            }

            // 57. مهارة: Şehir Bölge Planlama
            if (in_array($name, [
                'Şehir ve Bölge Planlama', 'Mimarlık', 'Peyzaj Mimarlığı'
            ])) {
                if (isset($skills['Şehir Bölge Planlama'])) $skillIds[] = $skills['Şehir Bölge Planlama'];
            }

            // 58. مهارة: Perspektif ve Eskiz
            if (in_array($name, [
                'Mimarlık', 'İç Mimarlık', 'İç Mimarlık ve Çevre Tasarımı', 'İç Mekan Tasarımı', 'Grafik Tasarımı', 'Endüstriyel Tasarım', 'Mimari Restorasyon'
            ])) {
                if (isset($skills['Perspektif ve Eskiz'])) $skillIds[] = $skills['Perspektif ve Eskiz'];
            }

            // 59. مهارة: Peyzaj Tasarımı
            if (in_array($name, [
                'Peyzaj Mimarlığı', 'Mimarlık', 'Şehir ve Bölge Planlama', 'Peyzaj ve Süs Bitkileri Yetiştiriciliği'
            ])) {
                if (isset($skills['Peyzaj Tasarımı'])) $skillIds[] = $skills['Peyzaj Tasarımı'];
            }

            // 60. مهارة: Endüstriyel Modelleme
            if (in_array($name, [
                'Endüstriyel Tasarım', 'Makine Mühendisliği', 'İmalat Mühendisliği', 'Makine', 'Bilgisayar Destekli Tasarım ve Animasyon'
            ])) {
                if (isset($skills['Endüstriyel Modelleme'])) $skillIds[] = $skills['Endüstriyel Modelleme'];
            }

            // 61. مهارة: Tekstil ve Moda Tasarımı
            if (in_array($name, [
                'Moda Tasarımı', 'Tekstil Mühendisliği', 'Geleneksel El Sanatları', 'Tekstil Teknolojisi'
            ])) {
                if (isset($skills['Tekstil ve Moda Tasarımı'])) $skillIds[] = $skills['Tekstil ve Moda Tasarımı'];
            }

            // 62. مهارة: Sinema Kurgusu ve Montaj
            if (in_array($name, [
                'Radyo, Televizyon ve Sinema', 'Yeni Medya ve İletişim', 'Dijital Oyun Tasarımı', 'Fotoğrafçılık ve Kameramanlık'
            ])) {
                if (isset($skills['Sinema Kurgusu ve Montaj'])) $skillIds[] = $skills['Sinema Kurgusu ve Montaj'];
            }

            // 63. مهارة: Fotoğrafçılık Teknikleri
            if (in_array($name, [
                'Fotoğrafçılık ve Kameramanlık', 'Radyo, Televizyon ve Sinema', 'Gazetecilik', 'Görsel İletişim Tasarımı', 'Grafik Tasarımı'
            ])) {
                if (isset($skills['Fotoğrafçılık Teknikleri'])) $skillIds[] = $skills['Fotoğrafçılık Teknikleri'];
            }

            // 64. مهارة: Tipografi
            if (in_array($name, [
                'Grafik Tasarımı', 'Görsel İletişim Tasarımı', 'Web Tasarımı ve Kodlama', 'Basım ve Yayım Teknolojileri'
            ])) {
                if (isset($skills['Tipografi'])) $skillIds[] = $skills['Tipografi'];
            }

            // 65. مهارة: Müzik Teorisi
            if (in_array($name, [
                'Müzik', 'Müzikoloji', 'Sahne Sanatları', 'Konservatuvar'
            ])) {
                if (isset($skills['Müzik Teorisi'])) $skillIds[] = $skills['Müzik Teorisi'];
            }

            // 66. مهارة: Sahne ve Dekor Tasarımı
            if (in_array($name, [
                'Sahne Sanatları', 'Tiyatro', 'Radyo, Televizyon ve Sinema', 'İç Mimarlık', 'İç Mekan Tasarımı'
            ])) {
                if (isset($skills['Sahne ve Dekor Tasarımı'])) $skillIds[] = $skills['Sahne ve Dekor Tasarımı'];
            }

            // 67. مهارة: Seramik ve Cam Tasarımı
            if (in_array($name, [
                'Seramik ve Cam Tasarımı', 'Geleneksel El Sanatları', 'Endüstriyel Cam ve Seramik'
            ])) {
                if (isset($skills['Seramik ve Cam Tasarımı'])) $skillIds[] = $skills['Seramik ve Cam Tasarımı'];
            }

            // 68. مهارة: 3D Modelleme ve Animasyon
            if (in_array($name, [
                'Dijital Oyun Tasarımı', 'Bilgisayar Destekli Tasarım ve Animasyon', 'Grafik Tasarımı', 
                'Animasyon', 'İç Mimarlık', 'Endüstriyel Tasarım', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['3D Modelleme ve Animasyon'])) $skillIds[] = $skills['3D Modelleme ve Animasyon'];
            }

            // [الدفعة السابعة] مهارات الإدارة، اللوجستيات، الطيران والسلامة المهنية

            // 69. مهارة: Lojistik Yönetimi
            if (in_array($name, [
                'Uluslararası Ticaret ve Lojistik', 'Lojistik', 'Dış Ticaret', 
                'Havacılık Yönetimi', 'Denizcilik İşletmeleri Yönetimi'
            ])) {
                if (isset($skills['Lojistik Yönetimi'])) $skillIds[] = $skills['Lojistik Yönetimi'];
            }

            // 70. مهارة: İnsan Kaynakları
            if (in_array($name, [
                'İnsan Kaynakları Yönetimi', 'İşletme', 'İşletme Yönetimi', 
                'Sağlık Yönetimi', 'Kamu Yönetimi', 'Siyaset Bilimi ve Kamu Yönetimi'
            ])) {
                if (isset($skills['İnsan Kaynakları'])) $skillIds[] = $skills['İnsan Kaynakları'];
            }

            // 71. مهارة: Havacılık Yönetimi
            if (in_array($name, [
                'Havacılık Yönetimi', 'Sivil Hava Ulaştırma İşletmeciliği', 'Sivil Havacılık Kabin Hizmetleri'
            ])) {
                if (isset($skills['Havacılık Yönetimi'])) $skillIds[] = $skills['Havacılık Yönetimi'];
            }

            // 72. مهارة: İş Sağlığı ve Güvenliği
            if (in_array($name, [
                'İş Sağlığı ve Güvenliği', 'İnşaat Mühendisliği', 'Makine Mühendisliği', 
                'Maden Mühendisliği', 'Kimya Mühendisliği', 'Elektrik-Elektronik Mühendisliği'
            ])) {
                if (isset($skills['İş Sağlığı ve Güvenliği'])) $skillIds[] = $skills['İş Sağlığı ve Güvenliği'];
            }

            // 73. مهارة: E-Ticaret Yönetimi
            if (in_array($name, [
                'Elektronik Ticaret ve Yönetimi', 'Pazarlama', 'Yönetim Bilişim Sistemleri (MIS)', 
                'İşletme', 'Dış Ticaret', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['E-Ticaret Yönetimi'])) $skillIds[] = $skills['E-Ticaret Yönetimi'];
            }

            // 74. مهارة: Turizm ve Otel İşletmeciliği
            if (in_array($name, [
                'Turizm İşletmeciliği', 'Turizm ve Otel İşletmeciliği', 'Gastronomi ve Mutfak Sanatları', 
                'Aşçılık', 'Turist Rehberliği'
            ])) {
                if (isset($skills['Turizm ve Otel İşletmeciliği'])) $skillIds[] = $skills['Turizm ve Otel İşletmeciliği'];
            }

            // 75. مهارة: Havalimanı Yer Hizmetleri Yönetimi
            if (in_array($name, [
                'Sivil Hava Ulaştırma İşletmeciliği', 'Havacılık Yönetimi', 'Sivil Havacılık Kabin Hizmetleri'
            ])) {
                if (isset($skills['Havalimanı Yer Hizmetleri Yönetimi'])) $skillIds[] = $skills['Havalimanı Yer Hizmetleri Yönetimi'];
            }

            // 76. مهارة: Stratejik Yönetim
            if (in_array($name, [
                'İşletme', 'İşletme Yönetimi', 'Havacılık Yönetimi', 'Sağlık Yönetimi', 
                'Uluslararası İlişkiler', 'Yönetim Bilişim Sistemleri (MIS)'
            ])) {
                if (isset($skills['Stratejik Yönetim'])) $skillIds[] = $skills['Stratejik Yönetim'];
            }

            // 77. مهارة: Proje Yönetimi
            if (in_array($name, [
                'Endüstri Mühendisliği', 'Yazılım Mühendisliği', 'Bilgisayar Mühendisliği', 
                'İnşaat Mühendisliği', 'İşletme', 'Yönetim Bilişim Sistemleri (MIS)', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Proje Yönetimi'])) $skillIds[] = $skills['Proje Yönetimi'];
            }

            // 78. مهارة: Kriz ve Afet Yönetimi
            if (in_array($name, [
                'Acil Yardım ve Afet Yönetimi', 'Acil Durum ve Afet Yönetimi', 'Sağlık Yönetimi', 
                'Sosyal Hizmet', 'Sivil Savunma ve İtfaiyecilik', 'Kamu Yönetimi'
            ])) {
                if (isset($skills['Kriz ve Afet Yönetimi'])) $skillIds[] = $skills['Kriz ve Afet Yönetimi'];
            }

            // [الدفعة الثامنة] مهارات التجارة، المالية، التسويق والعلاقات الدولية

            // 79. مهارة: Dış Ticaret Mevzuatı
            if (in_array($name, [
                'Dış Ticaret', 'Uluslararası Ticaret ve Lojistik', 'Uluslararası Ticaret ve Finansman', 'İşletme'
            ])) {
                if (isset($skills['Dış Ticaret Mevzuatı'])) $skillIds[] = $skills['Dış Ticaret Mevzuatı'];
            }

            // 80. مهارة: Bankacılık ve Sigorta
            if (in_array($name, [
                'Bankacılık ve Sigortacılık', 'Finans ve Bankacılık', 'Uluslararası Ticaret ve Finansman', 'İktisat', 'İşletme'
            ])) {
                if (isset($skills['Bankacılık ve Sigorta'])) $skillIds[] = $skills['Bankacılık ve Sigorta'];
            }

            // 81. مهارة: Pazarlama Stratejileri
            if (in_array($name, [
                'Pazarlama', 'İşletme', 'İşletme Yönetimi', 'Halkla İlişkiler ve Reklamcılık', 'Elektronik Ticaret ve Yönetimi'
            ])) {
                if (isset($skills['Pazarlama Stratejileri'])) $skillIds[] = $skills['Pazarlama Stratejileri'];
            }

            // 82. مهارة: Dijital Pazarlama ve Reklamcılık
            if (in_array($name, [
                'Pazarlama', 'Yeni Medya ve İletişim', 'Sosyal Medya Yöneticiliği', 'Elektronik Ticaret ve Yönetimi', 
                'Halkla İlişkiler ve Reklamcılık', 'Yönetim Bilişim Sistemleri (MIS)', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Dijital Pazarlama ve Reklamcılık'])) $skillIds[] = $skills['Dijital Pazarlama ve Reklamcılık'];
            }

            // 83. مهارة: Finansal Muhasebe
            if (in_array($name, [
                'Muhasebe ve Vergi Uygulamaları', 'İşletme', 'İşletme Yönetimi', 'Maliye', 
                'Uluslararası Ticaret ve Finansman', 'Bankacılık ve Sigortacılık'
            ])) {
                if (isset($skills['Finansal Muhasebe'])) $skillIds[] = $skills['Finansal Muhasebe'];
            }

            // 84. مهارة: Uluslararası İlişkiler
            if (in_array($name, [
                'Uluslararası İlişkiler', 'Siyaset Bilimi ve Uluslararası İlişkiler', 'Siyaset Bilimi ve Kamu Yönetimi'
            ])) {
                if (isset($skills['Uluslararası İlişkiler'])) $skillIds[] = $skills['Uluslararası İlişkiler'];
            }

            // 85. مهارة: Müşteri İlişkileri Yönetimi (CRM)
            if (in_array($name, [
                'Pazarlama', 'İşletme', 'İşletme Yönetimi', 'Çağrı Merkezi Hizmetleri', 
                'Halkla İlişkiler ve Reklamcılık', 'Turizm ve Otel İşletmeciliği'
            ])) {
                if (isset($skills['Müşteri İlişkileri Yönetimi (CRM)'])) $skillIds[] = $skills['Müşteri İlişkileri Yönetimi (CRM)'];
            }

            // 86. مهارة: Sağlık Turizmi Pazarlaması
            if (in_array($name, [
                'Sağlık Yönetimi', 'Turizm İşletmeciliği', 'Turizm ve Otel İşletmeciliği', 
                'Sağlık Kurumları İşletmeciliği', 'Pazarlama'
            ])) {
                if (isset($skills['Sağlık Turizmi Pazarlaması'])) $skillIds[] = $skills['Sağlık Turizmi Pazarlaması'];
            }

            // 87. مهارة: Eğitim Psikolojisi
            if (in_array($name, [
                'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 
                'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'Psikoloji', 'Çocuk Gelişimi'
            ])) {
                if (isset($skills['Eğitim Psikolojisi'])) $skillIds[] = $skills['Eğitim Psikolojisi'];
            }

            // 88. مهارة: Özel Eğitim Yöntemleri
            if (in_array($name, [
                'Özel Eğitim Öğretmenliği', 'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 
                'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'Çocuk Gelişimi'
            ])) {
                if (isset($skills['Özel Eğitim Yöntemleri'])) $skillIds[] = $skills['Özel Eğitim Yöntemleri'];
            }

            // 89. مهارة: Erken Çocukluk Gelişimi
            if (in_array($name, [
                'Okul Öncesi Öğretmenliği', 'Çocuk Gelişimi', 'Sınıf Öğretmenliği', 'Psikoloji'
            ])) {
                if (isset($skills['Erken Çocukluk Gelişimi'])) $skillIds[] = $skills['Erken Çocukluk Gelişimi'];
            }

            // 90. مهارة: Eğitim Sosyolojisi
            if (in_array($name, [
                'Sosyoloji', 'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 
                'Özel Eğitim Öğretmenliği', 'Psikolojik Danışmanlık ve Rehberlik (PDR)'
            ])) {
                if (isset($skills['Eğitim Sosyolojisi'])) $skillIds[] = $skills['Eğitim Sosyolojisi'];
            }

            // 91. مهارة: Sosyal Hizmet ve Toplumsal Destek
            if (in_array($name, [
                'Sosyal Hizmet', 'Sosyoloji', 'Psikoloji', 'Yaşlı Bakımı'
            ])) {
                if (isset($skills['Sosyal Hizmet ve Toplumsal Destek'])) $skillIds[] = $skills['Sosyal Hizmet ve Toplumsal Destek'];
            }

            // 92. مهارة: Sosyal Medya Yönetimi
            if (in_array($name, [
                'Sosyal Medya Yöneticiliği', 'Yeni Medya ve İletişim', 'Halkla İlişkiler ve Reklamcılık', 
                'Pazarlama', 'Görsel İletişim Tasarımı', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Sosyal Medya Yönetimi'])) $skillIds[] = $skills['Sosyal Medya Yönetimi'];
            }

            // 93. مهارة: Sayısal Analiz
            if (in_array($name, [
                'Matematik', 'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 
                'Elektrik-Elektronik Mühendisliği', 'Makine Mühendisliği', 'İnşaat Mühendisliği', 
                'Endüstri Mühendisliği', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Sayısal Analiz'])) $skillIds[] = $skills['Sayısal Analiz'];
            }

            // 94. مهارة: Yöneylem Araştırması
            if (in_array($name, [
                'Endüstri Mühendisliği', 'Yönetim Bilişim Sistemleri (MIS)', 'İşletme', 
                'Matematik', 'Lojistik'
            ])) {
                if (isset($skills['Yöneylem Araştırması'])) $skillIds[] = $skills['Yöneylem Araştırması'];
            }

            // 95. مهارة: Olasılık ve İstatistik
            if (in_array($name, [
                'Matematik', 'İlköğretim Matematik Öğretmenliği', 'Endüstri Mühendisliği', 
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yyapay Zeka ve Veri Mühendisliği', 
                'Yönetim Bilişim Sistemleri (MIS)', 'İktisat', 'İşletme', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Olasılık ve İstatistik'])) $skillIds[] = $skills['Olasılık ve İstatistik'];
            }

            // 96. مهارة: Ölçme ve Değerlendirme
            if (in_array($name, [
                'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 
                'Psikolojik Danışmanlık ve Rehberlik (PDR)'
            ])) {
                // تم تصحيح اسم المصفوفة هنا من $skillsIds لـ $skillIds
                if (isset($skills['Ölçme ve Değerlendirme'])) $skillIds[] = $skills['Ölçme ve Değerlendirme'];
            }

            // 97. مهارة: Hukuk Prensipleri
            if (in_array($name, [
                'Hukuk', 'Adalet', 'Kamu Yönetimi', 'Siyaset Bilimi ve Kamu Yönetimi', 
                'Uluslararası İlişkiler', 'İş Sağlığı ve Güvenliği'
            ])) {
                if (isset($skills['Hukuk Prensipleri'])) $skillIds[] = $skills['Hukuk Prensipleri'];
            }

            // 98. مهارة: Büyük Veri Analitiği
            if (in_array($name, [
                'Yyapay Zeka ve Veri Mühendisliği', 'Yapay Zeka Mühendisliği', 'Bilgisayar Mühendisliği', 
                'Yazılım Mühendisliği', 'Yönetim Bilişim Sistemleri (MIS)', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Büyük Veri Analitiği'])) $skillIds[] = $skills['Büyük Veri Analitiği'];
            }

            // 99. مهارة: Finansal Analiz
            if (in_array($name, [
                'Uluslararası Ticaret ve Finansman', 'Finans ve Bankacılık', 'İşletme', 
                'İşletme Yönetimi', 'İktisat', 'Muhasebe ve Vergi Uygulamaları', 'Bankacılık ve Sigortacılık'
            ])) {
                if (isset($skills['Finansal Analiz'])) $skillIds[] = $skills['Finansal Analiz'];
            }

            // 100. مهارة: Akademik İngilizce
            if (in_array($name, [
                'İngiliz Dili ve Edebiyatı', 'Mütercim Tercümanlık (İngilizce)', 'İngilizce Öğretmenliği', 
                'Uluslararası İlişkiler', 'Moleküler Biyoloji ve Genetik', 'Bilgisayar Mühendisliği'
            ])) {
                if (isset($skills['Akademik İngilizce'])) $skillIds[] = $skills['Akademik İngilizce'];
            }

            // 101. مهارة: Teknik Çeviri (İngilizce)
            if (in_array($name, [
                'Mütercim Tercümanlık (İngilizce)', 'İngiliz Dili ve Edebiyatı', 'Uluslararası Ticaret ve Lojistik', 
                'Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Teknik Çeviri (İngilizce)'])) $skillIds[] = $skills['Teknik Çeviri (İngilizce)'];
            }

            // 102. مهارة: Arapça Çevirmenlik ve Tercüme
            if (in_array($name, [
                'Arap Dili ve Edebiyatı', 'Mütercim Tercümanlık (Arapça)', 'İlahiyat', 'Turist Rehberliği'
            ])) {
                if (isset($skills['Arapça Çevirmenlik ve Tercüme'])) $skillIds[] = $skills['Arapça Çevirmenlik ve Tercüme'];
            }

            // 103. مهارة: Alman Dili Analizi
            if (in_array($name, [
                'Alman Dili ve Edebiyatı', 'Mütercim Tercümanlık (Almanca)', 'Almanca Öğretmenliği'
            ])) {
                if (isset($skills['Alman Dili Analizi'])) $skillIds[] = $skills['Alman Dili Analizi'];
            }

            // 104. مهارة: Rusça Akademik Çeviri
            if (in_array($name, [
                'Rus Dili ve Edebiyatı', 'Mütercim Tercümanlık (Rusça)', 'Uluslararası İlişkiler'
            ])) {
                if (isset($skills['Rusça Akademik Çeviri'])) $skillIds[] = $skills['Rusça Akademik Çeviri'];
            }

            // 105. مهارة: Fransızca Dil Yapısı
            if (in_array($name, [
                'Fransız Dili ve Edebiyatı', 'Mütercim Tercümanlık (Fransızca)', 'Fransızca Öğretmenliği'
            ])) {
                if (isset($skills['Fransızca Dil Yapısı'])) $skillIds[] = $skills['Fransızca Dil Yapısı'];
            }

            // 106. مهارة: Hayat Boyu Öğrenme
            if (in_array($name, [
                'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 
                'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'Sosyal Hizmet'
            ])) {
                if (isset($skills['Hayat Boyu Öğrenme'])) $skillIds[] = $skills['Hayat Boyu Öğrenme'];
            }

            // 107. مهارة: Tıbbi Etik ve Deontoloji
            if (in_array($name, [
                'Tıp', 'Diş Hekimliği', 'Eczacılık', 'Hemşirelik', 'Ebelik', 
                'Fizyoterapi ve Rehabilitasyon', 'İlk ve Acil Yardım', 'Anestezi', 'Ameliyathane Hizmetleri'
            ])) {
                if (isset($skills['Tıbbi Etik ve Deontoloji'])) $skillIds[] = $skills['Tıbbi Etik ve Deontoloji'];
            }

            // 108. مهارة: Program Geliştirme
            if (in_array($name, [
                'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 'Eğitim Yönetimi'
            ])) {
                if (isset($skills['Program Geliştirme'])) $skillIds[] = $skills['Program Geliştirme'];
            }

            // 109. مهارة: Öğretim Teknolojileri
            if (in_array($name, [
                'Sınıf Öğretmenliği', 'Okul Öncesi Öğretmenliği', 'İngilizce Öğretmenliği', 
                'İlköğretim Matematik Öğretmenliği', 'Özel Eğitim Öğretmenliği', 'Bilgisayar Programcılığı'
            ])) {
                if (isset($skills['Öğretim Teknolojileri'])) $skillIds[] = $skills['Öğretim Teknolojileri'];
            }

            // 110. مهارة: Gastronomi ve Mutfak Teknikleri
            if (in_array($name, [
                'Gastronomi ve Mutfak Sanatları', 'Aşçılık', 'Turizm ve Otel İşletmeciliği'
            ])) {
                if (isset($skills['Gastronomi ve Mutfak Teknikleri'])) $skillIds[] = $skills['Gastronomi ve Mutfak Teknikleri'];
            }

            // 111. مهارة: Pastacılık ve Ekmekçilik
            if (in_array($name, [
                'Gastronomi ve Mutfak Sanatları', 'Aşçılık'
            ])) {
                if (isset($skills['Pastacılık ve Ekmekçilik'])) $skillIds[] = $skills['Pastacılık ve Ekmekçilik'];
            }
            
            // حقن مصفوفة الربط لكل تخصص أولاً بأول داخل الـ foreach الكبرى لضمان عدم ضياع التخصصات
            if (!empty($skillIds)) {
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
            }
        }

        // 4. الإدخال النهائي في جدول العلاقات دفعة واحدة للأداء العالي (Bulk Insert)
        if (!empty($pivotData)) {
            // تقسيم البيانات لـ 1000 سطر بكل دفعة لكي لا يحدث خطأ تجاوز حجم حزمة SQL
            foreach (array_chunk($pivotData, 1000) as $chunk) {
                DB::table('major_skill')->insertOrIgnore($chunk);
            }
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