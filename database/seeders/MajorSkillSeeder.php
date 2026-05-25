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
        // 1. تصفير الجدول تماماً لمسح أي ربط عشوائي قديم
        DB::table('major_skill')->truncate();

        // 2. جلب جميع المهارات من الداتابيز لبناء الروابط الصحيحة
        $skills = Skill::pluck('id', 'name')->toArray();
        $pivotData = [];

        // 3. جلب التخصصات وتصنيفها بدقة تامة لتوزيع المهارات عليها
        foreach (Major::all() as $major) {
            $name = $major->name; // الاسم الحقيقي للتخصص
            $skillIds = [];

            // ----------------------------------------------------------------------
            // 🛑 [1] المهارات العلمية والهندسية البحتة (Teknik Beceriler - القسم الهندسي)
            // ----------------------------------------------------------------------
            if ($name === 'İleri Matematik' || $name === 'Matematik' || $name === 'İlköğretim Matematik Öğretmenliği') {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
            }
            if (in_array($name, ['Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yapay Zeka Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 'Elektrik-Elektronik Mühendisliği', 'Makine Mühendisliği', 'Mekatronik Mühendisliği', 'İnşaat Mühendisliği', 'Endüstri Mühendisliği', 'Havacılık ve Uzay Mühendisliği', 'Uçak Mühendisliği', 'Otomotiv Mühendisliği'])) {
                if (isset($skills['İleri Matematik'])) $skillIds[] = $skills['İleri Matematik'];
                if (isset($skills['Genel Fizik'])) $skillIds[] = $skills['Genel Fizik'];
                if (isset($skills['Analitik Düşünme'])) $skillIds[] = $skills['Analitik Düşünme'];
                if (isset($skills['Sayısal Analiz'])) $skillIds[] = $skills['Sayısal Analiz'];
            }
            if (in_array($name, ['Makine Mühendisliği', 'Havacılık ve Uzay Mühendisliği', 'Uçak Mühendisliği', 'Otomotiv Mühendisliği', 'Makine', 'Otomotiv Teknolojisi', 'Uçak Teknolojisi', 'Hibrid ve Elektrikli Taşıtlar Teknolojisi'])) {
                if (isset($skills['Termodinamik Prensipleri'])) $skillIds[] = $skills['Termodinamik Prensipleri'];
                if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
                if (isset($skills['Akışkanlar Mekaniği'])) $skillIds[] = $skills['Akışkanlar Mekaniği'];
            }
            if (in_array($name, ['Elektrik-Elektronik Mühendisliği', 'Mekatronik Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 'Mekatronik', 'Elektronik Teknolojisi', 'Elektrik', 'Kontrol ve Otomasyon Teknolojisi'])) {
                if (isset($skills['Elektriksel Devre Tasarımı'])) $skillIds[] = $skills['Elektriksel Devre Tasarımı'];
                if (isset($skills['Kontrol Sistemleri'])) $skillIds[] = $skills['Kontrol Sistemleri'];
            }
            if (in_array($name, ['İnşaat Mühendisliği', 'Mimarlık', 'İç Mimarlık', 'İç Mimarlık ve Çevre Tasarımı', 'İnşaat Teknolojisi'])) {
                if (isset($skills['Statik ve Dinamik Analiz'])) $skillIds[] = $skills['Statik ve Dinamik Analiz'];
                if (isset($skills['Malzeme Bilimi'])) $skillIds[] = $skills['Malzeme Bilimi'];
            }
            if (in_array($name, ['Kimya Mühendisliği', 'Kimya', 'Kimya Teknolojisi'])) {
                if (isset($skills['Kimyasal Süreç Yönetimi'])) $skillIds[] = $skills['Kimyasal Süreç Yönetimi'];
                if (isset($skills['Malzeme Bilimi'])) $skillIds[] = $skills['Malzeme Bilimi'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [2] المهارات الطبية والصحية الصارمة (Teknik Beceriler - القسم الطبي والصحي)
            // ----------------------------------------------------------------------
            if (in_array($name, ['Tıp', 'Hemşirelik', 'Ebelik', 'Fizyoterapi ve Rehabilitasyon', 'Fizyoterapi', 'Ameliyathane Hizmetleri', 'Yaşlı Bakımı'])) {
                if (isset($skills['İnsan Anatomisi'])) $skillIds[] = $skills['İnsan Anatomisi'];
                if (isset($skills['Fizyoloji'])) $skillIds[] = $skills['Fizyoloji'];
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
            }
            if (in_array($name, ['Tıp', 'Eczacılık', 'Tıbbi Laboratuvar Teknikleri', 'Eczane Hizmetleri'])) {
                if (isset($skills['Tıbbi Biyokimya'])) $skillIds[] = $skills['Tıbbi Biyokimya'];
                if (isset($skills['Farmakoloji'])) $skillIds[] = $skills['Farmakoloji'];
                if (isset($skills['Klinik Mikrobiyoloji'])) $skillIds[] = $skills['Klinik Mikrobiyoloji'];
            }
            if (in_array($name, ['Tıp', 'Patoloji Laboratuvar Teknikleri'])) {
                if (isset($skills['Patoloji'])) $skillIds[] = $skills['Patoloji'];
                if (isset($skills['Histoloji ve Embriyoloji'])) $skillIds[] = $skills['Histoloji ve Embriyoloji'];
            }
            if (in_array($name, ['Tıp', 'Beslenme ve Diyetetik', 'Moleküler Biyoloji ve Genetik', 'Biyoloji'])) {
                if (isset($skills['Epidemiyoloji'])) $skillIds[] = $skills['Epidemiyoloji'];
                if (isset($skills['İmmünoloji'])) $skillIds[] = $skills['İmmünoloji'];
                if (isset($skills['Genetik ve Kalıtım'])) $skillIds[] = $skills['Genetik ve Kalıtım'];
            }
            if (in_array($name, ['Diş Hekimliği', 'Ağız ve Diş Sağlığı', 'Diş Protez Teknolojisi'])) {
                if (isset($skills['Diş Morfolojisi'])) $skillIds[] = $skills['Diş Morfolojisi'];
                if (isset($skills['Restoratif Diş Tedavisi'])) $skillIds[] = $skills['Restoratif Diş Tedavisi'];
                if (isset($skills['Diş Protez Teknolojisi'])) $skillIds[] = $skills['Diş Protez Teknolojisi'];
                if (isset($skills['Ortodonti Prensipleri'])) $skillIds[] = $skills['Ortodonti Prensipleri'];
            }
            if ($name === 'Anestezi') {
                if (isset($skills['Anestezi Uygulamaları'])) $skillIds[] = $skills['Anestezi Uygulamaları'];
            }
            if ($name === 'Ameliyathane Hizmetleri') {
                if (isset($skills['Cerrahi Teknikler'])) $skillIds[] = $skills['Cerrahi Teknikler'];
            }
            if (in_array($name, ['Tıbbi Görüntüleme Teknikleri', 'Radyoterapi', 'Nükleer Tıp Teknikleri'])) {
                if (isset($skills['Radyolojik Görüntüleme'])) $skillIds[] = $skills['Radyolojik Görüntüleme'];
            }
            if (in_array($name, ['Biyomedikal Mühendisliği', 'Biyomedikal Cihaz Teknolojisi'])) {
                if (isset($skills['Biyomedikal Cihaz Teknolojisi'])) $skillIds[] = $skills['Biyomedikal Cihaz Teknolojisi'];
            }
            if ($name === 'Diyaliz') {
                if (isset($skills['Diyaliz Ekipman Yönetimi'])) $skillIds[] = $skills['Diyaliz Ekipman Yönetimi'];
            }
            if ($name === 'Optisyenlik') {
                if (isset($skills['Optisyenlik ve Cam Montajı'])) $skillIds[] = $skills['Optisyenlik ve Cam Montajı'];
            }
            if (in_array($name, ['Acil Yardım ve Afet Yönetimi', 'İlk ve Acil Yardım', 'Sivil Savunma ve İtfaiyecilik', 'Acil Durum ve Afet Yönetimi'])) {
                if (isset($skills['İlk Yardım ve Acil Müdahale'])) $skillIds[] = $skills['İlk Yardım ve Acil Müdahale'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [3] مهارات البرمجة وتكنولوجيا المعلومات (Bilgisayar ve Yazılım)
            // ----------------------------------------------------------------------
            if (in_array($name, ['Bilgisayar Mühendisliği', 'Yazılım Mühendisliği', 'Yapay Zeka Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği', 'Bilişim Sistemleri Mühendisliği', 'Bilgisayar Programcılığı'])) {
                if (isset($skills['Algoritma Geliştirme'])) $skillIds[] = $skills['Algoritma Geliştirme'];
                if (isset($skills['Veri Yapıları'])) $skillIds[] = $skills['Veri Yapıları'];
                if (isset($skills['Yazılım Mimarisi'])) $skillIds[] = $skills['Yazılım Mimarisi'];
                if (isset($skills['Veri Tabanı Yönetimi'])) $skillIds[] = $skills['Veri Tabanı Yönetimi'];
                if (isset($skills['Bulut Bilişim'])) $skillIds[] = $skills['Bulut Bilişim'];
            }
            if (in_array($name, ['Yapay Zeka Mühendisliği', 'Yapay Zeka ve Veri Mühendisliği'])) {
                if (isset($skills['Yapay Zeka Mantığı'])) $skillIds[] = $skills['Yapay Zeka Mantığı'];
            }
            if (in_array($name, ['Bilgisayar Mühendisliği', 'Mekatronik Mühendisliği', 'Mekatronik', 'Gömülü Sistemler', 'Mobil Teknolojiler'])) {
                if (isset($skills['Gömülü Sistemler'])) $skillIds[] = $skills['Gömülü Sistemler'];
            }
            if (in_array($name, ['Yönetim Bilişim Sistemleri (MIS)', 'Web Tasarımı ve Kodlama'])) {
                if (isset($skills['Web Tasarımı ve Front-end'])) $skillIds[] = $skills['Web Tasarımı ve Front-end'];
                if (isset($skills['UX/UI Tasarımı'])) $skillIds[] = $skills['UX/UI Tasarımı'];
            }
            if (in_array($name, ['Bilgi Güvenliği Teknolojisi', 'Siber Güvenlik', 'Bilişim Güvenliği Teknolojisi', 'İnternet ve Ağ Teknolojileri'])) {
                if (isset($skills['Siber Güvenlik ve Ağ Savunması'])) $skillIds[] = $skills['Siber Güvenlik ve Ağ Savunması'];
                if (isset($skills['Bilgisayar Ağları ve Sunucu Yönetimi'])) $skillIds[] = $skills['Bilgisayar Ağları ve Sunucu Yönetimi'];
            }
            if (in_array($name, ['Bilgisayar Programcılığı', 'Mobil Teknolojiler'])) {
                if (isset($skills['Mobil Uygulama Geliştirme (iOS/Android)'])) $skillIds[] = $skills['Mobil Uygulama Geliştirme (iOS/Android)'];
            }
            if ($name === 'Adli Bilişim Mühendisliği') {
                if (isset($skills['Adli Bilişim Analizi'])) $skillIds[] = $skills['Adli Bilişim Analizi'];
            }
            if (in_array($name, ['Dijital Oyun Tasarımı', 'Bilgisayar Destekli Tasarım ve Animasyon'])) {
                if (isset($skills['Dijital Oyun Tasarımı'])) $skillIds[] = $skills['Dijital Oyun Tasarımı'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [4] مهارات التواصل والإعلام (İletişim Becerileri)
            // ----------------------------------------------------------------------
            if (in_array($name, ['Okul Öncesi Öğretmenliği', 'Sınıf Öğretmenliği', 'İngilizce Öğretmenliği'])) {
                if (isset($skills['Sınıf Yönetimi'])) $skillIds[] = $skills['Sınıf Yönetimi'];
                if (isset($skills['Diksiyon ve Hitabet'])) $skillIds[] = $skills['Diksiyon ve Hitabet'];
            }
            if (in_array($name, ['Halkla İlişkiler ve Reklamcılık', 'Sosyal Medya Yöneticiliği', 'Kurumsal İletişim'])) {
                if (isset($skills['Halkla İlişkiler'])) $skillIds[] = $skills['Halkla İlişkiler'];
                if (isset($skills['Kurumsal İletişim'])) $skillIds[] = $skills['Kurumsal İletişim'];
            }
            if ($name === 'Psikolojik Danışmanlık ve Rehberlik (PDR)') {
                if (isset($skills['Rehberlik ve Danışmanlık'])) $skillIds[] = $skills['Rehberlik ve Danışmanlık'];
            }
            if (in_array($name, ['Sağlık Kurumları İşletmeciliği', 'Tıbbi Dokümantasyon ve Sekreterlik', 'Büro Yönetimi'])) {
                if (isset($skills['Büro Yönetimi'])) $skillIds[] = $skills['Büro Yönetimi'];
            }
            if ($name === 'Sivil Havacılık Kabin Hizmetleri') {
                if (isset($skills['Kabin Hizmetleri ve Yolcu İlişkileri'])) $skillIds[] = $skills['Kabin Hizmetleri ve Yolcu İlişkileri'];
            }
            if (in_array($name, ['Yeni Medya ve İletişim', 'Gazetecilik'])) {
                if (isset($skills['Medya Analizi'])) $skillIds[] = $skills['Medya Analizi'];
                if (isset($skills['Gazetecilik ve Haber Yazımı'])) $skillIds[] = $skills['Gazetecilik ve Haber Yazımı'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [5] مهارات التصميم والفنون (Tasarım ve Kreatif)
            // ----------------------------------------------------------------------
            if ($name === 'Mimarlık') {
                if (isset($skills['Mimari Proje Tasarımı'])) $skillIds[] = $skills['Mimari Proje Tasarımı'];
            }
            if (in_array($name, ['İç Mimarlık', 'İç Mimarlık ve Çevre Tasarımı', 'İç Mekan Tasarımı'])) {
                if (isset($skills['İç Mimari Restorasyon'])) $skillIds[] = $skills['İç Mimari Restorasyon'];
                if (isset($skills['Perspektif ve Eskiz'])) $skillIds[] = $skills['Perspektif ve Eskiz'];
            }
            if (in_array($name, ['Görsel İletişim Tasarımı', 'Grafik Tasarımı'])) {
                if (isset($skills['Grafiksel Görselleştirme'])) $skillIds[] = $skills['Grafiksel Görselleştirme'];
                if (isset($skills['Tipografi'])) $skillIds[] = $skills['Tipografi'];
            }
            if ($name === 'Şehir ve Bölge Planlama') {
                if (isset($skills['Şehir Bölge Planlama'])) $skillIds[] = $skills['Şehir Bölge Planlama'];
            }
            if (in_array($name, ['Endüstriyel Tasarım', 'Bilgisayar Destekli Tasarım ve Animasyon'])) {
                if (isset($skills['Endüstriyel Modelleme'])) $skillIds[] = $skills['Endüstriyel Modelleme'];
                if (isset($skills['3D Modelleme ve Animasyon'])) $skillIds[] = $skills['3D Modelleme ve Animasyon'];
            }
            if (in_array($name, ['Moda Tasarımı', 'Tekstil Mühendisliği'])) {
                if (isset($skills['Tekstil ve Moda Tasarımı'])) $skillIds[] = $skills['Tekstil ve Moda Tasarımı'];
            }
            if ($name === 'Radyo, Televizyon ve Sinema') {
                if (isset($skills['Sinema Kurgusu ve Montaj'])) $skillIds[] = $skills['Sinema Kurgusu ve Montaj'];
                if (isset($skills['Fotoğrafçılık Teknikleri'])) $skillIds[] = $skills['Fotoğrafçılık Teknikleri'];
                if (isset($skills['Sahne ve Dekor Tasarımı'])) $skillIds[] = $skills['Sahne ve Dekor Tasarımı'];
            }
            if ($name === 'Müzik Teorisi') {
                if (isset($skills['Müzik Teorisi'])) $skillIds[] = $skills['Müzik Teorisi'];
            }
            if ($name === 'Seramik ve Cam Tasarımı') {
                if (isset($skills['Seramik ve Cam Tasarımı'])) $skillIds[] = $skills['Seramik ve Cam Tasarımı'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [6] مهارات الإدارة والقيادة والتجارة (Yönetim, Liderlik ve Pazarlama)
            // ----------------------------------------------------------------------
            if (in_array($name, ['Uluslararası Ticaret ve Lojistik', 'Lojistik Yönetimi', 'Lojistik', 'Hava Lojistiği'])) {
                if (isset($skills['Lojistik Yönetimi'])) $skillIds[] = $skills['Lojistik Yönetimi'];
            }
            if ($name === 'İş Sağlığı ve Güvenliği') {
                if (isset($skills['İş Sağlığı ve Güvenliği'])) $skillIds[] = $skills['İş Sağlığı ve Güvenliği'];
            }
            if (in_array($name, ['Havacılık Yönetimi', 'Sivil Hava Ulaştırma İşletmeciliği'])) {
                if (isset($skills['Havacılık Yönetimi'])) $skillIds[] = $skills['Havacılık Yönetimi'];
            }
            if ($name === 'İnsan Kaynakları Yönetimi' || $name === 'İşletme') {
                if (isset($skills['İnsan Kaynakları'])) $skillIds[] = $skills['İnsan Kaynakları'];
            }
            if (in_array($name, ['E-Ticaret ve Pazarlama', 'E-Ticaret Yönetimi'])) {
                if (isset($skills['E-Ticaret Yönetimi'])) $skillIds[] = $skills['E-Ticaret Yönetimi'];
            }
            if (in_array($name, ['Turizm ve Otel İşletmeciliği', 'Turist Rehberliği (Ön Lisans)'])) {
                if (isset($skills['Turizm ve Otel İşletmeciliği'])) $skillIds[] = $skills['Turizm ve Otel İşletmeciliği'];
            }
            if ($name === 'Sivil Hava Ulaştırma İşletmeciliği') {
                if (isset($skills['Havalimanı Yer Hizmetleri Yönetimi'])) $skillIds[] = $skills['Havalimanı Yer Hizmetleri Yönetimi'];
            }
            if (in_array($name, ['Acil Yardım ve Afet Yönetimi', 'Acil Durum ve Afet Yönetimi'])) {
                if (isset($skills['Kriz ve Afet Yönetimi'])) $skillIds[] = $skills['Kriz ve Afet Yönetimi'];
            }
            if (in_array($name, ['İşletme', 'Endüstri Mühendisliği'])) {
                if (isset($skills['Proje Yönetimi'])) $skillIds[] = $skills['Proje Yönetimi'];
                if (isset($skills['Stratejik Yönetim'])) $skillIds[] = $skills['Stratejik Yönetim'];
            }
            if (in_array($name, ['Uluslararası Ticaret ve Lojistik', 'Dış Ticaret'])) {
                if (isset($skills['Dış Ticaret Mevzuatı'])) $skillIds[] = $skills['Dış Ticaret Mevzuatı'];
            }
            if (in_array($name, ['Bankacılık ve Finans', 'Bankacılık ve Sigortacılık'])) {
                if (isset($skills['Bankacılık ve Sigorta'])) $skillIds[] = $skills['Bankacılık ve Sigorta'];
            }
            if ($name === 'Uluslararası İlişkiler') {
                if (isset($skills['Uluslararası İlişkiler'])) $skillIds[] = $skills['Uluslararası İlişkiler'];
            }
            if (in_array($name, ['Halkla İlişkiler ve Reklamcılık', 'E-Ticaret ve Pazarlama', 'Dijital Pazarlama ve Reklamcılık'])) {
                if (isset($skills['Dijital Pazarlama ve Reklamcılık'])) $skillIds[] = $skills['Dijital Pazarlama ve Reklamcılık'];
                if (isset($skills['Pazarlama Stratejileri'])) $skillIds[] = $skills['Pazarlama Stratejileri'];
            }
            if (in_array($name, ['İşletme', 'Muhasebe ve Vergi Uygulamaları', 'Maliye'])) {
                if (isset($skills['Finansal Muhasebe'])) $skills['Finansal Muhasebe'];
                if (isset($skills['Finansal Analiz'])) $skills['Finansal Analiz'];
            }
            if (in_array($name, ['İşletme Yönetimi', 'Müşteri İlişkileri Yönetimi (CRM)'])) {
                if (isset($skills['Müşteri İlişkileri Yönetimi (CRM)'])) $skillIds[] = $skills['Müşteri İlişkileri Yönetimi (CRM)'];
            }
            if ($name === 'Sağlık Yönetimi' || $name === 'Sağlık Kurumları İşletmeciliği') {
                if (isset($skills['Sağlık Turizmi Pazarlaması'])) $skillIds[] = $skills['Sağlık Turizmi Pazarlaması'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [7] المهارات والعلوم الاجتماعية والتعليمية (Sosyal Beceriler ve Analitik)
            // ----------------------------------------------------------------------
            if (in_array($name, ['Okul Öncesi Öğretmenliği', 'Sınıf Öğretmenliği', 'İngilizce Öğretmenliği', 'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'Özel Eğitim Öğretmenliği', 'İlköğretim Matematik Öğretmenliği'])) {
                if (isset($skills['Eğitim Psikolojisi'])) $skillIds[] = $skills['Eğitim Psikolojisi'];
                if (isset($skills['Eğitim Sosyolojisi'])) $skillIds[] = $skills['Eğitim Sosyolojisi'];
                if (isset($skills['Ölçme ve Değerlendirme'])) $skillIds[] = $skills['Ölçme ve Değerlendirme'];
                if (isset($skills['Program Geliştirme'])) $skillIds[] = $skills['Program Geliştirme'];
                if (isset($skills['Öğretim Teknolojileri'])) $skillIds[] = $skills['Öğretim Teknolojileri'];
            }
            if ($name === 'Özel Eğitim Öğretmenliği') {
                if (isset($skills['Özel Eğitim Yöntemleri'])) $skillIds[] = $skills['Özel Eğitim Yöntemleri'];
            }
            if (in_array($name, ['Okul Öncesi Öğretmenliği', 'Çocuk Gelişimi'])) {
                if (isset($skills['Erken Çocukluk Gelişimi'])) $skillIds[] = $skills['Erken Çocukluk Gelişimi'];
            }
            if (in_array($name, ['Sosyal Hizmet', 'Sosyoloji', 'Psikoloji'])) {
                if (isset($skills['Sosyal Hizmet ve Toplumsal Destek'])) $skillIds[] = $skills['Sosyal Hizmet ve Toplumsal Destek'];
            }
            if (in_array($name, ['Sosyal Medya Yöneticiliği', 'E-Ticaret ve Pazarlama'])) {
                if (isset($skills['Sosyal Medya Yönetimi'])) $skillIds[] = $skills['Sosyal Medya Yönetimi'];
            }
            if (in_array($name, ['Endüstri Mühendisliği', 'İstatistik'])) {
                if (isset($skills['Yöneylem Araştırması'])) $skillIds[] = $skills['Yöneylem Araştırması'];
                if (isset($skills['Olasılık ve İstatistik'])) $skillIds[] = $skills['Olasılık ve İstatistik'];
            }
            if (in_array($name, ['Yapay Zeka ve Veri Mühendisliği', 'İstatistik'])) {
                if (isset($skills['Büyük Veri Analitiği'])) $skillIds[] = $skills['Büyük Veri Analitiği'];
            }
            if (in_array($name, ['Hukuk', 'Adalet'])) {
                if (isset($skills['Hukuk Prensipleri'])) $skillIds[] = $skills['Hukuk Prensipleri'];
            }

            // ----------------------------------------------------------------------
            // 🛑 [8] مهارات اللغات والمطبخ والتطوير الشخصي (Dil Becerileri ve Kişisel Gelişim)
            // ----------------------------------------------------------------------
            if (in_array($name, ['İngiliz Dili ve Edebiyatı', 'İngilizce Mütercim ve Tercümanlık', 'İngilizce Öğretmenliği', 'Uygulamalı İngilizce Çevirmenlik'])) {
                if (isset($skills['Akademik İngilizce'])) $skillIds[] = $skills['Akademik İngilizce'];
                if (isset($skills['Teknik Çeviri (İngilizce)'])) $skillIds[] = $skills['Teknik Çeviri (İngilizce)'];
            }
            if (in_array($name, ['Arap Dili ve Edebiyatı', 'Arapça Mütercim ve Tercümanlık'])) {
                if (isset($skills['Arapça Çevirmenlik ve Tercüme'])) $skillIds[] = $skills['Arapça Çevirmenlik ve Tercüme'];
            }
            if ($name === 'Alman Dili ve Edebiyatı') {
                if (isset($skills['Alman Dili Analizi'])) $skillIds[] = $skills['Alman Dili Analizi'];
            }
            if ($name === 'Rus Dili ve Edebiyatı') {
                if (isset($skills['Rusça Akademik Çeviri'])) $skillIds[] = $skills['Rusça Akademik Çeviri'];
            }
            if ($name === 'Fransız Dili ve Edebiyatı') {
                if (isset($skills['Fransızca Dil Yapısı'])) $skillIds[] = $skills['Fransızca Dil Yapısı'];
            }
            if (in_array($name, ['Felsefe', 'İlahiyat', 'İlahiyat (Önlisans)'])) {
                if (isset($skills['Hayat Boyu Öğrenme'])) $skillIds[] = $skills['Hayat Boyu Öğrenme'];
            }
            if (in_array($name, ['Tıp', 'Diş Hekimliği', 'Eczacılık', 'Hemşirelik'])) {
                if (isset($skills['Tıbbi Etik ve Deontoloji'])) $skillIds[] = $skills['Tıbbi Etik ve Deontoloji'];
            }
            if (in_array($name, ['Gastronomi ve Mutfak Sanatları', 'Aşçılık'])) {
                if (isset($skills['Gastronomi ve Mutfak Teknikleri'])) $skillIds[] = $skills['Gastronomi ve Mutfak Teknikleri'];
            }
            if ($name === 'Pastacılık ve Ekmekçilik') {
                if (isset($skills['Pastacılık ve Ekmekçilik'])) $skillIds[] = $skills['Pastacılık ve Ekmekçilik'];
            }

            // حقن البيانات النظيفة والمطابقة للتخصص الحالي
            if (!empty($skillIds)) {
                $this->insertSkillsForMajor($major->id, $skillIds, $pivotData);
            }
        }

        // 4. إدخال مصفوفة الربط المفلترة 100% لجدول العلاقات
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