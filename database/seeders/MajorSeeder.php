<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $lisansMajors = [
           // --- Sağlık Bilimleri ve Tıp (العلوم الطبية والصحية كاملة) ---
           ['name' => 'Tıp', 'desc' => 'İnsan sağlığının korunması, hastalıkların teşhisi, tedavisi ve cerrahi müdahaleler konusunda en üst düzeyde yetkinlik kazandırır.'],
           ['name' => 'Diş Hekimliği', 'desc' => 'Ağız, diş ve diş eti sağlığını koruma, hastalıkları teşhis etme ve cerrahi/protez yöntemlerle tedavi etme yetkinliği kazandıran tıp dalıdır.'],
           ['name' => 'Eczacılık', 'desc' => 'İlaçların geliştirilmesi, üretimi, etkileşimleri ve hastalara doğru şekilde ulaştırılması konusunda uzmanlaşan, kimya ve biyoloji ağırlıklı sağlık bilimidir.'],
           ['name' => 'Hemşirelik', 'desc' => 'Bireylerin sağlığını koruma, hastalık sürecinde tıbbi bakım sağlama ve doktor tarafından planlanan tedavileri uygulama üzerine uzmanlaşan sağlık bilimidir.'],
           ['name' => 'Ebelik', 'desc' => 'Gebelik süreci, doğum anı ve doğum sonrası dönemde anne ve bebek sağlığını takip eden, sağlıklı doğum sürecini yöneten profesyonel alandır.'],
           ['name' => 'Beslenme ve Diyetetik', 'desc' => 'Besinlerin sağlığa etkilerini inceleyen; bireylere ve toplumlara sağlıklı beslenme alışkanlığı kazandıran, hastalıkların tedavisinde diyet programları hazırlayan alandır.'],
           ['name' => 'Fizyoterapi ve Rehabilitasyon', 'desc' => 'Yaralanma, hastalık veya yaşlılık nedeniyle hareket kısıtlılığı yaşayan bireylerin fiziksel fonksiyonlarını geliştirmek için egzersiz ve manuel tekniklerle tedavi uygulayan sağlık branşıdır.'],
           ['name' => 'Dil ve Konuşma Terapisi', 'desc' => 'Bireylerin konuşma, dil, ses ve yutma bozukluklarını teşhis eden ve bu sorunlara yönelik rehabilitasyon programları uygulayan uzmanlık alanıdır.'],
           ['name' => 'Odyoloji', 'desc' => 'İşitme ve denge bozukluklarının önlenmesi, teşhis edilmesi ve bu sorunların rehabilitasyonu için işitme cihazı veya terapi yöntemlerinin uygulanması üzerine uzmanlaşan sağlık dalıdır.'],
           ['name' => 'Ergoterapi (İş ve Uğraşı Terapisi)', 'desc' => 'Herhangi bir hastalık, engel veya yaşlılık nedeniyle günlük yaşam aktivitelerinde kısıtlılık yaşayan bireylerin bağımsızlığını artırmak için tedavi yöntemleri geliştirir.'],
           ['name' => 'Perfüzyon', 'desc' => 'Kalp ve akciğer ameliyatları sırasında vücudun kan dolaşımını ve oksijenlenmesini sağlayan yapay kalp-akciğer makinesini ameliyat esnasında yöneten tıbbi uzmanlık dalıdır.'],
           ['name' => 'Ortez ve Protez', 'desc' => 'Eksik uzuvların yerine yapay araçlar (protez) tasarlayan veya kas-iskelet sistemi bozukluklarını destekleyici cihazlarla (ortez) tedavi eden sağlık teknolojisi alanıdır.'],
           ['name' => 'Sağlık Yönetimi', 'desc' => 'Hastanelerin ve sağlık kuruluşlarının finansal, idari, insan kaynakları ve operasyonel süreçlerini verimli bir şekilde yönetebilecek yöneticiler yetiştirir.'],
           ['name' => 'Acil Yardım ve Afet Yönetimi', 'desc' => 'Deprem, yangın, sel gibi afetlerin öncesinde risk analizi yapan; afet anında müdahaleyi yöneten ve sonrasında iyileştirme süreçlerini koordine eden uzmanlar yetiştirir.'],
           ['name' => 'Sosyal Hizmet', 'desc' => 'Toplumdaki dezavantajlı grupların (çocuklar, yaşlılar, engelliler vb.) yaşam kalitesini artırmak için sosyal destek sistemleri ve politikalar geliştiren uygulama alanıdır.'],
       
           // --- Bilgisayar, Yazılım ve Yapay Zeka (الحاسوب وتكنولوجيا المعلومات) ---
           ['name' => 'Bilgisayar Mühendisliği', 'desc' => 'Bilgisayar sistemlerinin hem yazılım hem de donanım katmanlarını tasarlayan, geliştiren ve sistemlerin birbirleriyle entegrasyonunu sağlayan mühendislik dalıdır.'],
           ['name' => 'Yazılım Mühendisliği', 'desc' => 'Karmaşık ve büyük ölçekli yazılım sistemlerinin mühendislik prensipleriyle sistematik bir şekilde geliştirilmesini ve yönetilmesini sağlayan daldır.'],
           ['name' => 'Yapay Zeka Mühendisliği', 'desc' => 'Makinelerin veriden öğrenmesini, akıl yürütmesini ve karmaşık problemleri çözmesini sağlayan algoritmalar, sinir ağları ve akıllı sistemler tasarlayan ileri teknoloji mühendisliğidir.'],
           ['name' => 'Yapay Zeka ve Veri Mühendisliği', 'desc' => 'Yapay zeka modelleri geliştirmenin yanı sıra; büyük veri setlerinin toplanması, temizlenmesi, depolanması ve bu verilerden anlamlı bilgiler çıkarılması süreçlerine odaklanan disiplindir.'],
           ['name' => 'Yönetim Bilişim Sistemleri (MIS)', 'desc' => 'İşletme yönetimi ile bilişim teknolojilerini birleştiren; veriyi stratejik karar verme süreçlerinde kullanmak için bilgi sistemleri tasarlayan ve yöneten köprü bölümdür.'],
           ['name' => 'Bilişim Sistemleri Mühendisliği', 'desc' => 'Kurumların bilgi teknolojisi altyapısını tasarlayan, yazılım ve donanımı iş hedefleriyle birleştiren, mühendislik yaklaşımlarıyla sistem kuran bölümdür.'],
           ['name' => 'Dijital Oyun Tasarımı', 'desc' => 'Bir oyunun mekaniklerini, sanatsal dünyasını ve yazılım altyapısını birleştirerek kullanıcı deneyimi yüksek dijital oyunlar geliştirme sürecidir.'],
           ['name' => 'Bilgi Güvenliği Teknolojisi', 'desc' => 'Dijital verilerin korunması, siber saldırıların önlenmesi ve ağ güvenliğinin sağlanması için teknik stratejiler geliştiren uzmanlık alanıdır.'],
           ['name' => 'Adli Bilişim Mühendisliği', 'desc' => 'Bilgisayar, akıllı telefon ve ağ sistemleri üzerinden işlenen siber suçların izini süren, dijital delilleri hukuka uygun şekilde kurtaran ve analiz eden mühendislik dalıdır.'],
       
           // --- Mühendislik Fakültesi (كافة الهندسات الأساسية والمطلوبة) ---
           ['name' => 'Elektrik-Elektronik Mühendisliği', 'desc' => 'Elektrik gücünün yanı sıra; devre tasarımı, haberleşme sistemleri, mikroçipler ve otomasyon gibi düşük voltajlı sistemleri de kapsayan geniş bir alandır.'],
           ['name' => 'Makine Mühendisliği', 'desc' => 'Enerji, kuvvet ve hareket prensiplerini kullanarak her türlü mekanik sistemin, motorun ve makinenin tasarımı, analizi ve üretimini gerçekleştiriren temel mühendislik dalıdır.'],
           ['name' => 'Mekatronik Mühendisliği', 'desc' => 'Makine, elektrik-elektronik ve bilgisayar mühendisliğinin kesişim noktasında yer alan; robotlar, akıllı makineler ve otomasyon sistemleri geliştiren hibrit disiplindir.'],
           ['name' => 'İnşaat Mühendisliği', 'desc' => 'Bina, köprü, baraj, yol gibi yapıların statik hesaplarını yapan, tasarımını hazırlayan ve inşaat süreçlerini denetleyen temel mühendislik dalıdır.'],
           ['name' => 'Endüstri Mühendisliği', 'desc' => 'İnsan, makine, malzeme ve bilgiden oluşan sistemlerin verimliliğini artırmak için matematiksel modeller ve optimizasyon yöntemleri kullanarak süreçleri yöneten disiplindir.'],
           ['name' => 'Kimya Mühendisliği', 'desc' => 'Kimyasal süreçleri kullanarak hammaddelerin endüstriyel ölçekte, ekonomik ve güvenli bir şekilde faydalı ürünlere dönüştürülmesini sağlayan mühendislik dalıdır.'],
           ['name' => 'Biyomedikal Mühendisliği', 'desc' => 'Mühendislik prensiplerini tıp ve biyolojiye uygulayarak; tıbbi cihazlar (MR, protezler, yapay organlar) ve teşhis/tedavi yöntemleri geliştiren daldır.'],
           ['name' => 'Havacılık ve Uzay Mühendisliği', 'desc' => 'Uçak, helikopter gibi hava araçları ile uydu ve roket gibi uzay araçlarının tasarımını, üretimini ve test süreçlerini yöneten mühendislik dalıdır.'],
           ['name' => 'Uçak Mühendisliği', 'desc' => 'Hava araçlarının aerodinamik yapısını, motor sistemlerini ve performansını tasarlayan, analiz eden ve üretim süreçlerini yöneten mühendislik dalıdır.'],
           ['name' => 'Otomotiv Mühendisliği', 'desc' => 'Kara taşıtlarının tasarımı, motor sistemleri, şasi yapısı ve üretim teknolojileri üzerine uzmanlaşan mekanik ağırlıklı mühendislik dalıdır.'],
           ['name' => 'Genetik ve Biyomühendislik', 'desc' => 'Canlıların genetik yapısını analiz eden ve bu bilgileri mühendislik teknikleriyle birleştirerek yeni tedavi yöntemleri, ilaçlar veya tarımsal ürünler geliştiren bilim dalıdır.'],
           ['name' => 'Gıda Mühendisliği', 'desc' => 'Tarımsal hammaddelerin güvenli, kaliteli ve uzun ömürlü gıda ürünlerine dönüştürülmesi için üretim süreçlerini, paketleme ve depolama tekniklerini tasarlayan daldır.'],
           ['name' => 'Jeoloji Mühendisliği', 'desc' => 'Yerkürenin katı maddelerini, yapısını, tarihini ve yer altı kaynaklarının (maden, su, petrol) tespiti ile inşaat zeminlerini araştıran daldır.'],
           ['name' => 'Maden Mühendisliği', 'desc' => 'Yer altındaki maden kaynaklarının tespiti, çıkarılması, zenginleştirilmesi ve bu süreçlerin iş güvenliği ile çevre kurallarına uygun yönetilmesini sağlayan mühendisliktir.'],
           ['name' => 'Tekstil Mühendisliği', 'desc' => 'Lif, iplik ve kumaş üretim süreçlerini, tekstil kimyasını ve bu ürünlerin endüstriyel boyutta imalat teknolojilerini konu alan mühendislik dalıdır.'],
       
           // --- Mimarlık, Tasarım ve Sanat (العمارة، التصميم والفنون) ---
           ['name' => 'Mimarlık', 'desc' => 'İnsanların barınma ve çalışma gibi ihtiyaçlarına yönelik estetik, işlevsel, güvenli ve sürdürülebilir yapılar tasarlayan, bu yapıların inşa süreçlerini koordine eden disiplindir.'],
           ['name' => 'İç Mimarlık', 'desc' => 'Bina içindeki mekanların estetik, işlevsel ve kullanıcı ihtiyaçlarına uygun şekilde tasarlanması ve dekorasyon süreçlerini yöneten bölümdür.'],
           ['name' => 'İç Mimarlık ve Çevre Tasarımı', 'desc' => 'Mekan tasarımını fiziksel çevreyle bütünleştiren; malzeme, aydınlatma ve kullanıcı konforunu çevresel bağlamıyla birlikte ele alan uzmanlık alanıdır.'],
           ['name' => 'Görsel İletişim Tasarımı', 'desc' => 'Bilgiyi ve mesajı dijital mecralarda etkili bir şekilde aktarmak için grafik, tipografi ve etkileşimli öğeleri birleştiren tasarım dalıdır.'],
           ['name' => 'Grafik Tasarımı', 'desc' => 'Logo, afiş, kitap tasarımı gibi görsel unsurların; bir marka kimliği oluşturmak veya bir mesajı görsel yolla iletmek amacıyla estetik ve teknik kurallarla düzenlenmesi sanatıdır.'],
           ['name' => 'Endüstriyel Tasarım', 'desc' => 'Seri üretilecek ürünlerin kullanıcı ihtiyaçlarına uygun olarak estetik, ergonomik ve işlevsel şekilde tasarlanması sürecidir.'],
           ['name' => 'Gastronomi ve Mutfak Sanatları', 'desc' => 'Yemek pişirme tekniklerini, gıda bilimini ve mutfak yönetimini birleştiren; yemek kültürünü sanatsal bir estetik ve profesyonel işletmecilik anlayışıyla ele alan bölümdür.'],
           ['name' => 'Moda Tasarımı', 'desc' => 'Giyim ve aksesuarlar için estetik, malzeme ve pazar trendlerini harmanlayarak yeni koleksiyonlar oluşturan yaratıcı alandır.'],
           ['name' => 'Şehir ve Bölge Planlama', 'desc' => 'Kentlerin ve bölgelerin fiziksel, sosyal ve ekonomik gelişimini düzenleyen; yaşanabilir, estetik ve sürdürülebilir yerleşim alanları tasarlayan disiplindir.'],
       
           // --- İktisadi ve İdari Bilimler (العلوم الإدارية، الاقتصادية والسياسية) ---
           ['name' => 'İşletme', 'desc' => 'Bir kurumun verimli çalışabilmesi için gerekli olan yönetim, pazarlama, finans, muhasebe ve insan kaynakları süreçlerini planlayan ve yöneten alandır.'],
           ['name' => 'Ekonomi (İktisat)', 'desc' => 'Kaynakların sınırlı olduğu bir dünyada üretim, tüketim ve bölüşüm süreçlerini, piyasa işleyişini ve devlet politikalarını analiz eder.'],
           ['name' => 'Uluslararası İlişkiler', 'desc' => 'Devletler arası siyasi, ekonomik ve hukuki etkileşimleri, diplomasi tarihini, küresel örgütlerin yapısını ve world politikasındaki güç dengelerini araştıran disiplindir.'],
           ['name' => 'Siyaset Bilimi ve Kamu Yönetimi', 'desc' => 'Devletin yapısını, siyasal kurumları, yerel yönetimleri ve kamu politikalarının oluşturulup uygulanma süreçlerini inceleyen disiplindir.'],
           ['name' => 'Uluslararası Ticaret ve Lojistik', 'desc' => 'Ürün ve hizmetlerin sınırlar ötesi dolaşımını, gümrük mevzuatını, küresel tedarik zinciri yönetimini ve taşımacılık operasyonlarını kapsayan iş dünyası alanıdır.'],
           ['name' => 'Lojistik Yönetimi', 'desc' => 'Ürünlerin, hizmetlerin ve bilgilerin üretim noktasından tüketim noktasına kadar olan akışını; nakliye, depolama ve gümrükleme süreçleriyle birlikte planlayan yönetim dalıdır.'],
           ['name' => 'Bankacılık ve Finans', 'desc' => 'Para piyasaları, yatırım araçları, portföy yönetimi ve finansal analiz konularında uzmanlaşarak ekonomik değer yaratma süreçlerini yönetir.'],
           ['name' => 'İnsan Kaynakları Yönetimi', 'desc' => 'Bir kurumdaki personelin işe alımı, eğitimi, performans değerlendirmesi ve motivasyonu gibi süreçleri stratejik olarak yöneten alandır.'],
           ['name' => 'Maliye', 'desc' => 'Devletin gelir (vergi) ve harcamalarını, kamu bütçesini ve bu süreçlerin ekonomik ve toplumsal hayata etkilerini inceleyen, ekonomi ve hukuk ağırlıklı disiplindir.'],
           ['name' => 'Hukuk', 'desc' => 'Adalet sistemini, toplumsal düzeni sağlayan yasaları, bu yasaların uygulanmasını ve bireyler/kurumlar arasındaki hukuki uyuşmazlıkların çözümünü inceleyen disiplindir.'],
       
           // --- Sosyal ve Beşeri Bilimler (العلوم الإنسانية والاجتماعية) ---
           ['name' => 'Psikoloji', 'desc' => 'İnsan davranışlarını, zihinsel süreçleri, duyguları ve bunların altında yatan biyolojik/sosyal nedenleri bilimsel yöntemlerle inceleyen temel bilim dalıdır.'],
           ['name' => 'Sosyoloji', 'desc' => 'Toplumun yapısını, değişimini, toplumsal grupları, kurumları ve insanlar arasındaki sosyal etkileşimleri bilimsel yöntemlerle inceleyen temel bilimdir.'],
           ['name' => 'Felsefe', 'desc' => 'Varlık, bilgi, ahlak, mantık ve siyaset gibi evrensel konuları rasyonel ve eleştirel bir bakış açısıyla sorgulayan, düşünce tarihini ve sistemlerini inceleyen temel disiplindir.'],
           ['name' => 'Arkeoloji', 'desc' => 'Geçmişteki insan topluluklarının yaşamlarını, kültürlerini ve faaliyetlerini geride bıraktıkları maddi kalıntılar üzerinden kazı yaparak inceler.'],
           ['name' => 'Tarih', 'desc' => 'Geçmişteki insan topluluklarının faaliyetlerini, kültürlerini ve olaylar arasındaki neden-sonuç ilişkilerini belgeler ışığında inceleyen temel bilimdir.'],
           ['name' => 'Coğrafya', 'desc' => 'Yeryüzünün fiziksel özelliklerini ve insanın çevreyle olan etkileşimini, toplumsal ve ekonomik yansımalarıyla inceleyen temel bilimdir.'],
       
           // --- Medya, İletişim ve Havacılık (الإعلام، الاتصال والطيران) ---
           ['name' => 'Radyo, Televizyon ve Sinema', 'desc' => 'Medya içeriklerinin üretim süreçlerini, kamera arkası tekniklerini, senaryo yazımını, kurguyu ve yayıncılık kuramlarını kapsayan disiplindir.'],
           ['name' => 'Halkla İlişkiler ve Reklamcılık', 'desc' => 'Bir kurumun veya markanın itibarını yönetme, hedef kitleyle stratejik iletişim kurma ve ürün/hizmetleri tanıtmak için yaratıcı campaigns yürütme alanıdır.'],
           ['name' => 'Yeni Medya ve İletişim', 'desc' => 'Dijital teknolojilerle dönüşen iletişim mecralarını, sosyal medyayı, internet gazeteciliğini, dijital reklamcılığı ve etkileşimli içerik üretimini inceleyen alandır.'],
           ['name' => 'Gazetecilik', 'desc' => 'Güncel olayları araştırma, haber değeri taşıyan içerikleri toplama, yazma ve dijital/yazılı medya kanalları aracılığıyla topluma etik kurallar çerçevesinde aktarma sürecidir.'],
           ['name' => 'Pilotaj', 'desc' => 'Hava araçlarının teknik donanımı, hava hukuku, meteoroloji ve seyir kuralları üzerine eğitim vererek profesyonel ticari pilotlar yetiştiren bölümdür.'],
           ['name' => 'Havacılık Yönetimi', 'desc' => 'Havayolu şirketleri ve havalimanlarının işletilmesi, uçuş planlaması, lojistik ve sivil havacılık operasyonlarının idari süreçlerini konu alır.'],
           ['name' => 'Uçak Bakım ve Onarım', 'desc' => 'Hava araçlarının motor, gövde ve elektronik sistemlerinin periyodik kontrollerini yapan ve arızalarını gidererek uçuş emniyetini sağlayan teknik bölümdür.'],
       
           // --- Diller ve Mütercim Tercümanlık (اللغات والترجمة) ---
           ['name' => 'İngiliz Dili ve Edebiyatı', 'desc' => 'İngiliz kültürüne ait klasik ve modern edebi eserleri analiz ederek, eleştirel düşünme ve ileri düzey akademik dil yetkinliği kazandırır.'],
           ['name' => 'İngilizce Mütercim ve Tercümanlık', 'desc' => 'İngilizce ve Türkçe dilleri arasında; hukuki, tıbbi, teknik metinlerin yazılı çevirisi ile her türlü toplantıda anlık çeviri yapabilecek profesyoneller yetiştirir.'],
           ['name' => 'Alman Dili ve Edebiyatı', 'desc' => 'Alman dilinin yapısını, tarihsel gelişimini ve Alman kültürünün ürettiği edebi eserleri derinlemesine inceleyerek kültürel ve akademik analiz yetisi kazandırır.'],
           ['name' => 'Arap Dili ve Edebiyatı', 'desc' => 'Arapça dil bilgisi yapısını, klasik ve modern Arap edebiyatını ve bu dilin kültürel mirasını akademik bir bakış açısıyla ele alır.'],
           ['name' => 'Arapça Mütercim ve Tercümanlık', 'desc' => 'Arapça ile Türkçe arasında her türlü ticari, hukuki, edebi ve anlık görüşmede çeviri yapabilecek profesyoneller yetiştirir.'],
           ['name' => 'Rus Dili ve Edebiyatı', 'desc' => 'Rusça dil yapısını, tarihini ve Rus kültürünün ürettiği edebi eserleri dilbilimsel ve eleştirel bir bakış açısıyla akademik düzeyde inceler.'],
           ['name' => 'Fransız Dili ve Edebiyatı', 'desc' => 'Fransızca dilinin yapısını, tarihsel değişimini ve Fransız kültürünün dünya edebiyatına yön veren eserlerini akademik ve eleştirel bir bakış açısıyla inceler.'],
       
           // --- Eğitim Fakültesi (كليات التربية والتدريس المطلوبة) ---
           ['name' => 'Okul Öncesi Öğretmenliği', 'desc' => '0-6 yaş grubu çocukların fiziksel, zihinsel ve sosyal gelişimlerini destekleyen, onları temel eğitim dönemine hazırlayan pedagoji ve eğitim dalıdır.'],
           ['name' => 'Sınıf Öğretmenliği', 'desc' => 'İlkokul (1-4. sınıf) düzeyindeki çocukların temel eğitim süreçlerini yöneten, okuma-yazma ve temel bilimler eğitimini pedagojik yöntemlerle veren branştır.'],
           ['name' => 'İngilizce Öğretmenliği', 'desc' => 'İngilizceyi yabancı dil olarak öğretecek; dil öğretim metodolojileri ve sınıf yönetimi konusunda uzmanlaşmış eğitimciler yetiştirir.'],
           ['name' => 'Psikolojik Danışmanlık ve Rehberlik (PDR)', 'desc' => 'Bireylerin kişisel, sosyal, eğitsel ve mesleki gelişimlerini desteklemek ve sorunlarıyla başa çıkma becerisi kazandırmak amacıyla rehberlik hizmeti sunan alandır.'],
           ['name' => 'Özel Eğitim Öğretmenliği', 'desc' => 'Zihinsel, fiziksel veya duygusal açıdan özel gereksinimi olan bireylere, onların öğrenme hızına ve ihtiyaçlarına uygun tekniklerle eğitim veren profesyonel branştır.'],
           ['name' => 'İlköğretim Matematik Öğretmenliği', 'desc' => 'Ortaokul düzeyindeki öğrencilere temel matematik kavramlarını öğretecek, pedagojik formasyon eğitimi almış öğretmenler yetiştirir.'],
       
           // --- Temel Bilimler ve Diğerleri (العلوم الأساسية واللاهوت) ---
           ['name' => 'Moleküler Biyoloji ve Genetik', 'desc' => 'Canlı organizmaları moleküler düzeyde inceleyerek genlerin yapısını, işleyişini ve kalıtım mekanizmalarını araştıran, hastalıkların teşhis ve tedavisinde temel bilimsel veriler üreten daldır.'],
           ['name' => 'Biyoloji', 'desc' => 'Tüm canlıların yapısını, işleyişini, evrimini ve birbirleriyle olan etkileşimlerini hücreden ekosisteme kadar her boyutta inceleyen temel bilim dalıdır.'],
           ['name' => 'Kimya', 'desc' => 'Maddenin yapısını, özelliklerini, bileşimini ve geçirdiği değişimleri laboratuvar ortamında deney ve gözlemlerle inceleyen temel bilim dalıdır.'],
           ['name' => 'Matematik', 'desc' => 'Sayılar, yapılar, şekiller ve değişimler arasındaki mantıksal ilişkileri inceleyen; evrenin işleyişini anlamaya yarayan teorik ve uygulamalı temel bilimdir.'],
           ['name' => 'İstatistik', 'desc' => 'Verilerin toplanması, analiz edilmesi, yorumlanması ve olasılık hesapları üzerinden geleceğe yönelik anlamlı tahminler yapılmasını sağlayan matematik temelli bilimdir.'],
           ['name' => 'İlahiyat', 'desc' => 'İslam dininin temel kaynaklarını, inanç sistemini, tarihini ve dini bilimleri akademik bir perspektifle araştıran ve inceleyen bölümdür.'],
       ];
            
           
        $onLisansMajors = [
           // --- Sağlık Hizmetleri (العلوم الطبية والصحية - سنتين) ---
           ['name' => 'İlk ve Acil Yardım', 'description' => 'Kaza veya hastalık anında olay yerinde ilk müdahaleyi yapan ve hastayı güvenle hastaneye ulaştıran (paramedik) sağlık branşıdır.'],
           ['name' => 'Anestezi', 'description' => 'Operasyon öncesinde hastanın uyutulması (anestezi) ve operasyon boyunca hayati bulgularının takip edilmesi süreçlerinde anestezi doktoruna eşlik eden teknikerliktir.'],
           ['name' => 'Ameliyathane Hizmetleri', 'description' => 'Ameliyat öncesi ortamın sterilizasyonunu sağlayan, cerrahi operasyon sırasında doktora gerekli aletleri sunan ve teknik destek veren daldır.'],
           ['name' => 'Ağız ve Diş Sağlığı', 'description' => 'Diş hekimine muayene ve cerrahi işlemler sırasında yardımcı olan, tıbbi malzemeleri hazırlayan ve hasta bakımını destekleyen teknikerlik bölümüdür.'],
           ['name' => 'Diş Protez Teknolojisi', 'description' => 'Diş hekimlerinin aldığı ölçülere göre protez diş, köprü ve ağız içi apareylerin laboratuvar ortamında üretimini yapan teknik bölümdür.'],
           ['name' => 'Eczane Hizmetleri', 'description' => 'Eczanelerde ilaçların hazırlanması, stok takibi, reçete kayıtları ve hastalara danışmanlık konularında eczacıya yardımcı olan teknikerliktir.'],
           ['name' => 'Tıbbi Görüntüleme Teknikleri', 'description' => 'Hastalıkların teşhisi için kullanılan Röntgen, BT, MR, Ultrason gibi tıbbi görüntüleme cihazlarını kullanan ve çekim yapan teknikerliktir.'],
           ['name' => 'Tıbbi Laboratuvar Teknikleri', 'description' => 'Hastanelerin laboratuvarlarında kan, idrar ve doku gibi örnekleri analiz ederek hastalıkların teşhis edilmesini sağlayan sağlık branşıdır.'],
           ['name' => 'Fizyoterapi', 'description' => 'Yaralanma veya hastalık sonrası hareket kısıtlılığı yaşayan bireylere, fizyoterapist eşliğinde egzersiz ve fizik tedavi tekniklerini uygulayan teknikerliktir.'],
           ['name' => 'Diyaliz', 'description' => 'Böbrek yetmezliği yaşayan hastaların diyaliz makinesine bağlanması, tedavi sürecinin takibi ve makine bakımından sorumlu sağlık teknikerliğidir.'],
           ['name' => 'Odyometri', 'description' => 'İşitme kaybı yaşayan hastalara uzman doktor gözetiminde işitme testleri (odyogram) uygulayan ve işitme cihazlarının uygulanmasında görev alan teknikerliktir.'],
           ['name' => 'Optisyenlik', 'description' => 'Göz doktoru tarafından yazılan reçetelere göre gözlük camı ve çerçevesi hazırlayan, kontakt lens satışı ve montajı yapan sağlık branşıdır.'],
           ['name' => 'Radyoterapi', 'description' => 'Kanser tedavisi gören hastaların doktor tarafından planlanan ışın tedavilerini (radyasyon) uygulayan ve cihazları yöneten sağlık uzmanlık alanıdır.'],
           ['name' => 'Elektronörofizyoloji', 'description' => 'Beyin ve sinir sistemiyle ilgili testlerin (EEG, EMG, uyku analizi vb.) uzman doktor gözetiminde uygulanmasını sağlayan sağlık teknikerliği alanıdır.'],
           ['name' => 'Patoloji Laboratuvar Teknikleri', 'description' => 'Hastanelerde biyopsi ile alınan doku ve hücre örneklerini mikroskobik incelemeye hazır hale getiren sağlık teknikerliği alanıdır.'],
           ['name' => 'Nükleer Tıp Teknikleri', 'description' => 'Hastanelerin nükleer tıp birimlerinde görüntüleme ve tedavi amaçlı kullanılan radyoaktif maddelerin hazırlanması ve cihazların (PET-CT vb.) kullanımını kapsar.'],
           ['name' => 'Yaşlı Bakımı', 'description' => 'Yaşlı bireylerin fiziksel, sosyal ve psikolojik ihtiyaçlarını karşılayan, tıbbi takiplerini yapan ve yaşam kalitelerini artıran sağlık branşıdır.'],
           ['name' => 'Çocuk Gelişimi', 'description' => '0-18 yaş arası çocukların fiziksel, zihinsel ve duygusal gelişim takibini yapan, eğitim materyalleri hazırlayan ve ailelere danışmanlık veren teknikerliktir.'],
       
           // --- Bilgisayar ve Bilişim (تكنولوجيا المعلومات والحاسوب) ---
           ['name' => 'Bilgisayar Programcılığı', 'description' => 'Çeşitli yazılım dilleriyle kod yazma, veri tabanı yönetimi ve web uygulamaları geliştirme üzerine yoğunlaşan teknik eğitimdir.'],
           ['name' => 'Web Tasarımı ve Kodlama', 'description' => 'İnternet sitelerinin görsel tasarımı (arayüz) ve bu sitelerin çalışmasını sağlayan arka plan yazılım kodlarının geliştirilmesi üzerine yoğunlaşan alandır.'],
           ['name' => 'Siber Güvenlik', 'description' => 'Kurumların bilgisayar ağlarını siber saldırılara karşı koruyan, dijital sistem açıklarını belirleyen ve veri güvenliğini sağlayan uzmanlık alanıdır.'],
           ['name' => 'Bilişim Güvenliği Teknolojisi', 'description' => 'Bilgisayar ağlarını ve verileri siber saldırılara karşı korumak için güvenlik protokolleri geliştiren ve sistem açıklarını denetleyen daldır.'],
           ['name' => 'İnternet ve Ağ Teknolojileri', 'description' => 'Bilgisayar ağlarının kurulumu, sunucu yönetimi, web tasarımı ve ağ güvenliği sistemlerinin işletilmesini kapsayan bilişim alanıdır.'],
           ['name' => 'Mobil Teknolojiler', 'description' => 'Akıllı telefonlar ve tabletler için uygulama geliştirme (iOS/Android), mobil oyun tasarımı ve mobil sistemlerin altyapısı üzerine eğitim verir.'],
           ['name' => 'Bilgisayar Destekli Tasarım ve Animasyon', 'description' => 'Bilgisayar yazılımları kullanarak 2 boyutlu ve 3 boyutlu grafik tasarımı, karakter modelleme ve görsel efekt üretimi yapılan bölümdür.'],
       
           // --- Havacılık, Denizcilik ve Lojistik (الطيران، الملاحة واللوجستيك) ---
           ['name' => 'Sivil Havacılık Kabin Hizmetleri', 'description' => 'Uçuş sırasında yolcu güvenliğini sağlayan, ikram hizmetlerini yürüten ve acil durum prosedürlerini uygulayan kabin memurlarını (hostes/host) yetiştirir.'],
           ['name' => 'Sivil Hava Ulaştırma İşletmeciliği', 'description' => 'Havalimanı terminal işletmeciliği, yer hizmetleri, biletleme ve havayolu operasyonlarının idari yönetimini kapsar.'],
           ['name' => 'Uçak Teknolojisi', 'description' => 'Hava araçlarının motor, gövde ve elektronik sistemlerinin periyodik bakımını, arıza teşhisini ve onarımını yapan teknik uzmanlık alanıdır.'],
           ['name' => 'Uçuş Harekat Yöneticiliği (Dispatcher)', 'description' => 'Uçuş planlarını hazırlayan, yakıt hesaplaması yapan ve uçuş boyunca pilotla sürekli iletişim kurarak operasyonu takip eden teknik daldır.'],
           ['name' => 'İnsansız Hava Aracı Teknolojisi Operatörlüğü', 'description' => 'İHA (Drone) sistemlerinin uçuş operasyonlarını yöneten, teknik bakımını yapan ve veri toplama süreçlerini yürüten bölümdür.'],
           ['name' => 'Hava Lojistiği', 'description' => 'Havayolu taşımacılığında kargo yönetimi, gümrükleme, depolama ve uçuş operasyonlarının yer hizmetleri koordinasyonunu sağlayan daldır.'],
           ['name' => 'Deniz Ulaştırma ve İşletme', 'description' => 'Gemilerde vardiya zabitliği yapacak, gemi yönetimi ve denizcilik kuralları konusunda eğitim alan güverte odaklı bölümdür.'],
           ['name' => 'Yat Kaptanlığı', 'description' => 'Ticari veya özel yatlarda gemi yönetimi, seyir, güvenlik ve motor bakımı gibi konularda yetkinlik kazandırarak kaptan yetiştiriren bölümdür.'],
           ['name' => 'Lojistik', 'description' => 'Ürünlerin üretimden tüketiciye ulaşana kadar olan nakliye, depolama, gümrükleme ve tedarik zinciri süreçlerini planlayan ve yöneten disiplindir.'],
       
           // --- Teknik ve Mühendislik Teknolojileri (التقنيات والهندسات الفنية) ---
           ['name' => 'Mekatronik', 'description' => 'Makine, elektronik ve yazılım sistemlerini bir arada kullanarak akıllı cihazlar, robotlar ve modern sanayi makineleri geliştiren disiplindir.'],
           ['name' => 'Elektronik Teknolojisi', 'description' => 'Elektronik devrelerin tasarımı, endüstriyel kartların onarımı ve mikroişlemci tabanlı sistemlerin bakımı üzerine odaklanan teknik daldır.'],
           ['name' => 'Elektrik', 'description' => 'Bina ve sanayi tesislerindeki elektrik tesisatlarının kurulması, elektrikli makinelerin bakımı ve enerji dağıtım sistemlerinin işletilmesi üzerine eğitim verir.'],
           ['name' => 'Kontrol ve Otomasyon Teknolojisi', 'description' => 'Sanayide kullanılan otomatik üretim sistemlerinin, robotik teknolojilerin ve PLC tabanlı kontrol düzeneklerinin tasarımı, montajı ve bakımıyla ilgilenir.'],
           ['name' => 'Makine', 'description' => 'Her türlü makine ve mekanik sistemin tasarım projelerine destek veren, üretim aşamasında çalışan ve bu sistemlerin bakım-onarımını yapan teknik daldır.'],
           ['name' => 'Biyomedikal Cihaz Teknolojisi', 'description' => 'Hastanelerde kullanılan tıbbi cihazların (emar, röntgen, diyaliz vb.) kurulumu, periyodik bakımı ve arıza onarımını yapan teknik daldır.'],
           ['name' => 'Hibrid ve Elektrikli Taşıtlar Teknolojisi', 'description' => 'Yeni nesil elektrikli araçların batarya sistemleri, elektrik motorları ve elektronik aksamlarının bakımı ve onarımı üzerine uzmanlaşır.'],
           ['name' => 'Otomotiv Teknolojisi', 'description' => 'Motorlu taşıtların mekanik, elektrikli ve elektronik sistemlerinin arıza teşhisi, periyodik bakımı ve onarımı üzerine eğitim veren teknik bölümdür.'],
           ['name' => 'Alternatif Enerji Kaynakları Teknolojisi', 'description' => 'Güneş, rüzgar ve jeotermal gibi yenilenebilir enerji sistemlerinin montajı, bakımı ve işletilmesi üzerine uzmanlık kazandırır.'],
           ['name' => 'İnşaat Teknolojisi', 'description' => 'Bina, yol ve baraj gibi inşaat projelerinin şantiyede uygulanmasını, denetlenmesini ve metraj-keşif işlemlerini yürüten teknik bölümdür.'],
           ['name' => 'Harita ve Kadastro', 'description' => 'Arazi ölçümleri yaparak harita taslakları hazırlayan ve taşınmazların hukuki sınırlarını belirleyen (kadastro) teknik teknikerliktir.'],
           ['name' => 'Kimya Teknolojisi', 'description' => 'Kimyasal maddelerin analiz edilmesi, laboratuvar ortamında testlerin yapılması ve endüstriyel kimya üretim süreçlerinin kontrol edilmesi üzerine odaklanan teknik bölümdür.'],
       
           // --- Ticari, İdari ve Sosyal Programlar (العلوم الإدارية، التجارية والتصميم) ---
           ['name' => 'Adalet', 'description' => 'Mahkemelerde ve hukuk bürolarında yazı işleri, dosyalama ve temel hukuk süreçlerinin yürütülmesinde görev alacak ara elemanlar yetiştirir.'],
           ['name' => 'İşletme Yönetimi', 'description' => 'Küçük ve orta ölçekli işletmelerin finans, pazarlama, yönetim ve organizasyon süreçlerini yürütebilecek yetkinlik kazandırır.'],
           ['name' => 'Muhasebe ve Vergi Uygulamaları', 'description' => 'Şirketlerin ticari kayıtlarını tutan, beyanname hazırlayan ve mali tabloları yasal mevzuata göre düzenleyen uzmanlık alanıdır.'],
           ['name' => 'Dış Ticaret', 'description' => 'İthalat ve ihracat operasyonları, gümrükleme işlemleri, uluslararası ödeme yöntemleri ve lojistik süreçlerinin takibini yapan alandır.'],
           ['name' => 'Bankacılık ve Sigortacılık', 'description' => 'Finans sektöründe müşteri ilişkileri, kredi işlemleri ve sigorta poliçelerinin satışı/yönetimi süreçlerinde görev alacak personel yetiştirir.'],
           ['name' => 'E-Ticaret ve Pazarlama', 'description' => 'İnternet üzerinden ürün satışı, dijital pazarlama stratejileri, sosyal medya yönetimi ve müşteri deneyimi analizleri üzerine odaklanır.'],
           ['name' => 'Sosyal Medya Yöneticiliği', 'description' => 'Markaların dijital platformlardaki imajını yöneten, içerik üreten, reklam stratejileri kuran ve takipçi analizleri yapan modern iletişim dalıdır.'],
           ['name' => 'İnsan Kaynakları Yönetimi', 'description' => 'Şirketlerin personel işe alımı, özlük hakları, maaş yönetimi ve eğitim planlaması gibi süreçlerini koordine eden idari daldır.'],
           ['name' => 'Sağlık Kurumları İşletmeciliği', 'description' => 'Hastanelerin ve polikliniklerin idari süreçlerini, hasta kabul birimlerini ve tıbbi sekreterlik operasyonlarını yöneten idari daldır.'],
           ['name' => 'Tıbbi Dokümantasyon ve Sekreterlik', 'description' => 'Hastanelerde hasta kayıtlarını tutan, tıbbi arşivleri yöneten ve sağlık yönetimi süreçlerinde sekreterlik hizmeti veren uzmanlık alanıdır.'],
           ['name' => 'Uygulamalı İngilizce Çevirmenlik', 'description' => 'İngilizce metinlerin çevrilmesi ve sözlü iletişimde tercümanlık yapılması konusunda pratik beceriler kazandıran dil bölümüdür.'],
           ['name' => 'İlahiyat (Önlisans)', 'description' => 'İslam dininin temel kaynaklarını, inanç esaslarını ve ibadet konularını temel düzeyde öğreterek diyanet hizmetlerinde görev alacak kişiler yetiştirir.'],
       
           // --- Tasarım, Gastronomi ve Turizm (التصميم، الفنادق والسياحة) ---
           ['name' => 'İç Mekan Tasarımı', 'description' => 'Konut, ofis veya mağaza gibi iç mekanların estetik ve fonksiyonel şekilde düzenlenmesi için projeler hazırlayan ve uygulayan bölümdür.'],
           ['name' => 'Grafik Tasarımı', 'description' => 'Kurumsal kimlik, logo, ambalaj ve reklam görsellerini estetik ve teknik kurallar çerçevesinde dijital ortamda tasarlayan sanat dalıdır.'],
           ['name' => 'Aşçılık', 'description' => 'Mutfak teknikleri, yemek pişirme yöntemleri ve mutfak yönetimi konusunda uygulamalı eğitim vererek profesyonel mutfak personeli yetiştirir.'],
           ['name' => 'Pastacılık ve Ekmekçilik', 'description' => 'Unlu mamuller, tatlılar, pastalar ve ekmek çeşitlerinin uluslararası tekniklerle profesyonel düzeyde hazırlanması ve sunulması üzerine yoğunlaşır.'],
           ['name' => 'Turizm ve Otel İşletmeciliği', 'description' => 'Konaklama tesislerinin ön büro, kat hizmetleri ve genel yönetimi gibi operasyonel süreçlerini planlayan ve yürüten bölümdür.'],
           ['name' => 'Turist Rehberliği (Ön Lisans)', 'description' => 'Yerli ve yabancı turistlere tarihi ve kültürel mekanları tanıtan, seyahat gruplarını yöneten ve bölge hakkında bilgi veren profesyonel daldır.'],
       
           // --- Güvenlik ve Acil Durum (الأمن والسلامة العامة) ---
           ['name' => 'İş Sağlığı ve Güvenliği', 'description' => 'Çalışma ortamlarındaki riskleri belirleyen, iş kazalarını önlemek için tedbirler alan ve yasal mevzuata göre denetim yapan daldır.'],
           ['name' => 'Sivil Savunma ve İtfaiyecilik', 'description' => 'Yangınla mücadele, arama-kurtarma operasyonları ve afet durumlarında halkın can ve mal güvenliğini koruyan profesyonel ekipleri yetiştirir.'],
           ['name' => 'Acil Durum ve Afet Yönetimi', 'description' => 'Deprem, yangın, sel gibi afetlerin öncesinde planlama yapma ve afet anında arama-kurtarma ile koordinasyon süreçlerini yönetme eğitimidir.'],
        ];

        $languages = ['TR', 'EN'];

        foreach ($lisansMajors as $major) {
            foreach ($languages as $lang) {
                Major::updateOrCreate(
                    [
                        'name' => $major['name'], 
                        'education_language' => $lang
                    ],
                    [
                        'description' => $major['desc'],
                        'degree_type' => 'lisans'
                    ]
                );
            }
        }

        foreach ($onLisansMajors as $majorData) {
            foreach ($languages as $lang) {
                Major::updateOrCreate(
                    [
                        'name' => $majorData['name'], 
                        'education_language' => $lang
                    ],
                    [
                        'description' => $majorData['description'],
                        'degree_type' => 'on_lisans'
                    ]
                );
            }
        }
    }
}