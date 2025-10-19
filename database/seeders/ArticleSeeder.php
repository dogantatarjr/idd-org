<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Deploy esnasında oluşturulacak makaleler

        Article::create([
            'title' => 'Sürdürülebilir Moda',
            'content' => 'Sürdürülebilir moda çevre dostu ve etik olarak üretilmesi gereken ürünler olarak tanımlanır. Özellikle son zamanlarda sürdürülebilirlik terimi hemen her yerde görülüyor. Aslında hemen her şeye uygulanabilen sürdürülebilirlik, içinde yaşadığımız dünyanın sürdürülmesi için dengeyi sağlayan bir kavram. Üretim ve tüketimin en hızlı sektörleri arasında yer alan modanın bu kapsamda çevreye pek çok olumsuz etkisi oluyor. Sürdürülebilir moda ile giyim ürünlerinde bulunan çevresel etkiler en aza indirgeniyor. Hatta sürdürülebilir moda için bazı markalar ikinci el ürünler satarak tüketicileri teşvik etmeye çalışıyor.
                        Dünya üzerinde kaynakların tükeniyor oluşu insanlığı pek çok alanda olduğu gibi modada da sürdürülebilir olmaya itiyor. Sürdürülebilir moda ile birlikte dünyada su kaynaklarının tükenme riski azalırken tüketim çılgınlığının da azalması amaçlanıyor. Sürdürülebilir moda projeleri sayesinde kaliteli ürünler üretiliyor.  Kullanıcıların satın aldıkları ürünleri uzun vadeli olarak kullanabilmeleri sağlanıyor. Kaliteli ve uzun süreli olarak kullanılabilen ürünler satın almak sürdürülebilir moda konusuna katkı sağlıyor. Sürdürülebilir moda hem üretici hem tüketiciyi ilgilendiren ortak bir çalışma denilebilir. Sürdürülebilir modanın devamlılığı için üretici ve tüketici payına düşenleri yaptığı takdirde daha yaşanılabilir bir dünya mümkün.',
            'user_id' => 1,
            'category_id' => 1,
            'image' => 'https://storage.dogasigorta.com/app-1433/blogs-images/surdurulebilir-moda.jpg',
            'likes' => 15,
            'comments' => 3,
            'created_at' => now(),
            'updated_at'=> now(),
        ]);

        Article::create([
            'title' => 'Organik Tarım',
            'content'=> '“Organik tarım nedir?” sorusuna verilebilecek en net ve düzgün cevap şu şekilde olabilir: Bir ürünün yetiştirilmesinden itibaren ürünün hasat edilmesi, işlenmesi ve ürünün ambalajlanmasından tüketilmesine kadar gerçekleşen bütün işlemlerde hiçbir şekilde kimyasal madde veya tarım ilacı kullanılmaması. Her aşamasında ayrı özen gösterilen kontrollü ve sertifikalı bir şekilde üretilen organik tarım şeklinde amaç doğal hayatın, doğal dengenin korunması ve bunun yanı sıra su, hava gibi doğal, yaşamsal kaynakların korunmasıdır. Gerçekleştirilen bu yöntem içerisinde sentetik gübre ve sağlıklı üretimi engelleyen kimyasal madde, ilaç kullanılmaması yüksek verimin yanı sıra iyi bir kalite sürekliliğini de sağlar.

                        Doğal ve sağlıklı bir şekilde bitki yetiştirmek özellikle organik tarım için oldukça büyük önem taşıyor. Organik tarımın amaçlarından bir diğeri ise toprak sağlığını ve toprak verimliliğini kaybetmemek, sağlıklı gıdalar üretirken doğal kaynakları korumak ve biyoçeşitliliği artırmaktır. Aşağıda yer alan maddeleri inceleyerek organik tarım hakkında daha fazla bilgi sahibi olabilirsiniz.

                        Organik tarım yapmanız için bazı adımlar şöyle sıralanabilir:

                        1.	Toprağınızı hazırlayın: Organik tarımda kullanacağınız toprağı organik maddeler ile zenginleştirin. Toprağın su tutma kapasitesini artırmak ve bunun yanı sıra bitki köklerine daha iyi besin sağlamak için doğal malzemeler, yeşil gübre veya hayvan gübresi kullanın.

                        2.	Organik tarıma uygun bitki seçimi: Organik tarımı gerçekleştireceğiniz ortamın iklim ve toprak koşullarına uygun bitkiler seçiniz. Ayrıca yerel bitki çeşitlerini kullanmak da bu tarım çeşidinin bir parçası.

                        3.	Sulama yöntemleri: Yetiştireceğiniz bitkilerin ihtiyacı olan suyu karşılamak için damlama, sulama kanalları veya yağmurlama gibi doğal sulama yöntemlerini tercih ediniz.

                        4.	Yetiştirilen bitkinin hasat edilmesi: Hasat zamanı yetiştirilen bitkilerin en verimli olduğu zamanlarda yapılır. Hasat zamanı ise bitkinin büyüme durumuna bağlı.',
            'user_id' => 2,
            'category_id' => 2,
            'image' => 'https://topraktangetir.com/wp-content/uploads/2020/10/Organik_Tarim_Kredileri.jpg',
            'likes' => 32,
            'comments' => 1,
            'created_at' => now(),
            'updated_at'=> now(),
        ]);

        Article::create([
            'title'=> 'İklim Krizi ve Kültür-Sanat Alanına Yansıması',
            'content'=> 'Gezegenimizin karşı karşıya olduğu sorunlar arasında belki de ilk sırada olan iklim değişikliği, acil önlem alınması gerekli konular arasında yerini almaktadır. Açıklanan bilimsel veriler Türkiye’de ve Dünya’da ekolojik kriz sonucunda yaşanan iklim felaketlerini gözler önüne sererken, mevcut ekolojik krizin yıkıcı sonuçları da tüm dünyanın gündemini oluşturmaktadır. Güncel ekolojik politika ve uygulamalar çerçevesinde mevcut krizin artarak devam edeceği öngörülürken, sürdürülebilir bir dünya için başlatılan iklim hareketi de her geçen gün farklı alanları da içine alarak büyümektedir. Gezegenimizin bugününü ve geleceğini ciddi bir şekilde tehdit eden iklim krizine karşı, kültür-sanat alanı da bilinçlendirici bir rol üstlenerek tüm dünyanın dikkatini bahsi geçen krize çekmeyi amaçlamıştır. Bu süreçte düzenlenen etkinlikler sanat ve kültür aracılığı ile mevcut kriz ile ilgili düşünülmesi ve çözümler üretilmesi için farkındalık yaratılmasını, aynı zamanda da kültür kurumları ve sanatçılar için ortak bir payda oluşturulmasını sağlamıştır. Çalışma kapsamında iklim değişikliği ve bunun sonucu olan ekolojik kriz incelenerek irdelenmiştir. Bu bağlamda iklim krizinin Türkiye’de ve Dünya’da kültür-sanat alanına olan yansıması hem sanatçılar hem de kültür sanat platformları özelinde incelenmiştir.',
            'user_id' => 3,
            'category_id' => 3,
            'image' => 'https://www.bugday.org/blog/wp-content/uploads/2024/05/Ekran-Resmi-2024-04-29-11.37.37.png',
            'likes' => 27,
            'comments' => 4,
            'created_at' => now(),
            'updated_at'=> now(),
        ]);
    }
}
