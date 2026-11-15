<?php
session_start();

/* =====================================================
   KAHVETAT - PROFESYONEL GELİŞTİRİLMİŞ TEK DOSYALIK SİSTEM
===================================================== */

function guvenli($veri) {
    return htmlspecialchars(trim((string)($veri ?? '')), ENT_QUOTES, 'UTF-8');
}

/* ---------------- DİL SİSTEMİ (TAM KAPSAMLI) ---------------- */

if (isset($_GET['lang']) && in_array($_GET['lang'], ['tr','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'tr';

$sozluk = [
    'Ana Sayfa'=>'Home','Menü'=>'Menu','Tarifler'=>'Recipes',
    'Sepetim'=>'My Cart','Toplu Sipariş'=>'Bulk Order',
    'Kampanyalar'=>'Campaigns','Stok Takibi'=>'Stock Tracking',
    'Satış Raporu'=>'Sales Report','Yönetim'=>'Management',
    'Giriş'=>'Login','Kayıt Ol'=>'Register','Çıkış Yap'=>'Logout',
    'Merhaba'=>'Hello','Ürünleri İncele'=>'Browse Products',
    'Hemen Sipariş Ver'=>'Order Now','Ürün Arama...'=>'Search products...',
    'Tümü'=>'All','Sepete Ekle'=>'Add to Cart',
    'Tükendi'=>'Out of Stock','Stok'=>'Stock',
    'Gündüz'=>'Light Mode','Gece'=>'Dark Mode',
    'Önceki'=>'Previous','Sonraki'=>'Next',
    'Sıcak Kahve'=>'Hot Coffee','Soğuk Kahve'=>'Cold Coffee',
    'Frozen'=>'Frozen Drinks','Milkshake'=>'Milkshakes',
    'Tatlılar'=>'Desserts','Kilo Kahve'=>'Coffee by Kilo','Ekipman'=>'Equipment',
    'Her Fincanda Ayrı Bir Hikâye'=>'A Unique Story in Every Cup',
    'Özenle seçilmiş çekirdekler, usta ellerde hazırlanan eşsiz lezzetler.'=>'Carefully selected beans and unique flavors crafted by expert hands.',
    '500₺ ve üzeri alışverişlerinizde ücretsiz kargo!'=>'Free shipping on orders over 500 TL!',
    'Ürün Çeşidi'=>'Products','Sepetteki Adet'=>'Items in Cart',
    'Mağaza Cirosu'=>'Store Revenue','Özelleştir & Sepete Ekle'=>'Customize & Add to Cart',
    'Sipariş Özeti'=>'Order Summary','Ara Toplam:'=>'Subtotal:',
    'Kargo:'=>'Shipping:','Ücretsiz'=>'Free','Ad Soyad'=>'Full Name',
    'İl'=>'City','İlçe'=>'District','Açık Adres'=>'Full Address',
    'Ödeme Yöntemi'=>'Payment Method','Kredi Kartı Online'=>'Credit Card',
    'Kapıda Nakit / Kart'=>'Cash / Card on Delivery',
    'Siparişi Onayla'=>'Confirm Order','Ürün'=>'Product',
    'Özellikler'=>'Options','Fiyat'=>'Price','Adet'=>'Quantity',
    'İşlem'=>'Action','Sil'=>'Remove','Kaldır'=>'Remove',
    'Sipariş vermek için giriş yapmalısınız.'=>'Please log in to place an order.',
    'Sepetiniz boş.'=>'Your cart is empty.',
    'Ürün başarıyla sepete eklendi.'=>'Product added to cart.',
    'Aktif Kampanyalar & Fırsatlar'=>'Active Campaigns & Offers',
    'Usta Baristalardan Özel Kahve & Tatlı Tarifleri'=>'Special Coffee & Dessert Recipes',
    'Toplu Sipariş & Etkinlik Talebi'=>'Bulk Order & Event Request',
    'Yeni Ürün Ekle'=>'Add New Product',
    'Mevcut Ürünleri Yönet'=>'Manage Products',
    'Ürün Adı'=>'Product Name','Kategori'=>'Category',
    'Stok Adedi'=>'Stock Quantity','Açıklama'=>'Description',
    'Ürünü Kaydet'=>'Save Product','Hesabınıza Giriş Yapın'=>'Log In to Your Account',
    'E-posta Adresi'=>'Email Address','Şifre'=>'Password',
    'Yeni Hesap Oluştur'=>'Create New Account',
    'Tat Tercihi'=>'Taste Preference','Yumuşak'=>'Mild',
    'Dengeli'=>'Balanced','Sert'=>'Strong','Acı'=>'Bitter',
    'Tatlı'=>'Sweet','Sıcak / Soğuk'=>'Hot / Cold',
    'Ücretsiz Kargo'=>'Free Shipping',
    'Kart Üzerindeki İsim'=>'Name on Card','Kart Numarası'=>'Card Number',
    'Son Kullanma Tarihi'=>'Expiry Date','Güvenlik Kodu'=>'CVV',
    'Kampanyayı İncele'=>'View Campaign','Alışverişe Başla'=>'Start Shopping',
    'WhatsApp Destek'=>'WhatsApp Support','Bizi Takip Edin'=>'Follow Us',
    'Tüm Hakları Saklıdır.'=>'All Rights Reserved.',
    'İlk siparişinize özel %5 indirim!'=>'5% off your first order!',
    '10 adet ve üzeri siparişlerde %20 indirim!'=>'20% off orders of 10 or more!',
    'KahveTat özel reçetesiyle hazırlanmıştır.'=>'Prepared with KahveTat signature recipes.',
    'Henüz gerçekleşen bir satış bulunmuyor.'=>'No sales have been made yet.',
    'Sepetinizde henüz ürün bulunmuyor.'=>'Your cart is currently empty.',
    'KahveTat'=>'KahveTat',
    'Kahve Sertliği'=>'Coffee Strength',
    'Kart Bilgileri'=>'Card Details',
    'Demo ödeme alanıdır. Gerçek kart işlemi yapılmaz ve kart bilgileri saklanmaz.'=>'Demo payment fields. No real payment is processed and card details are not stored.',
    'Teslimat'=>'Delivery','Tarih'=>'Date','Durum'=>'Status',
    'Stokta'=>'In Stock','Kritik Stok'=>'Low Stock',
    'Telefon Numarası'=>'Phone Number','Teslim Tarihi'=>'Delivery Date',
    'Teslim Saati'=>'Delivery Time','Özel Notlar'=>'Special Notes',
    'Geri'=>'Back','İleri'=>'Forward',
    'Kurumsal'=>'Corporate','Müşteri Hizmetleri'=>'Customer Services',
    'Hızlı Bağlantılar'=>'Quick Links','Hakkımızda'=>'About Us',
    'Hedeflerimiz'=>'Our Goals','İnsan Kaynakları'=>'Human Resources',
    'İletişim Bilgilerimiz'=>'Contact Info','Sanal Blog'=>'Blog',
    'Gizlilik Sözleşmesi'=>'Privacy Policy','İptal ve İade Koşulları'=>'Cancellation & Return',
    'Kullanım Sözleşmesi'=>'Terms of Use','Sıkça Sorulan Sorular'=>'FAQ',
    'Banka Hesap Numaraları'=>'Bank Accounts','Destek Merkezi / Yardım'=>'Support Center',
    'Yeni Üyelik'=>'New Membership','Siparişlerim'=>'My Orders',
    'İletişim Formu'=>'Contact Form','Havale Bildirim Formu'=>'Wire Transfer Form',
    'Kargo Takibi'=>'Cargo Tracking',
    'Hoş Geldin İndirimi'=>'Welcome Discount','Ücretsiz Kargo Kampanyası'=>'Free Shipping Campaign',
    'Toplu Alım Fırsatı'=>'Bulk Purchase Offer','Kahve Molası'=>'Coffee Break',
    'Tatlı Keyfi'=>'Dessert Pleasure','Geleneksel Lezzetler'=>'Traditional Flavors',
    'Kahve Köşeni Kur'=>'Setup Your Coffee Corner','Barista Tavsiyesi'=>'Barista Recommendation',
    'Yeni üyelerimize ilk siparişlerinde %5 indirim.'=>'5% discount on the first order for new members.',
    '500 TL ve üzeri alışverişlerde ücretsiz kargo.'=>'Free shipping on purchases of 500 TL and above.',
    '10 adet ve üzeri siparişlerde %20 indirim.'=>'20% discount on orders of 10 or more.',
    'Sıcak kahve çeşitlerini keşfedin.'=>'Discover hot coffee varieties.',
    'Kahvenizin yanına tatlı çeşitlerimizi deneyin.'=>'Try our dessert varieties next to your coffee.',
    'Türk kahvesi ve geleneksel tatlar.'=>'Turkish coffee and traditional flavors.',
    'Kahve ekipmanlarını inceleyin.'=>'Explore glasses, thermoses and coffee machines.',
    'Usta ellerden özel lezzetler.'=>'Special flavors from master hands.',
    'Soğuk kahve ve frozen çeşitleri sizi bekliyor.'=>'Discover our iced coffee and frozen drinks.',
    'Bardak, kupa ve termos çeşitlerini inceleyin.'=>'Explore our cups, mugs and thermoses.',
    'Eşsiz lezzet kombinasyonları.'=>'Unique flavor combinations.',
    'Bardak, Termos & Makineler'=>'Cups, Mugs & Thermoses',
    'Serinletici Lezzetler'=>'Refreshing Drinks',
    'Menü'=>'Menu','Tarifler'=>'Recipes','Kampanyalar'=>'Campaigns',
    'Boyut Seçimi:'=>'Choose Size:','Süt / Ekstra:'=>'Milk / Extra:','Buz / Derece:'=>'Ice Preference:',
    'Küçük Boy'=>'Small','Orta Boy (+15 TL)'=>'Medium (+15 TL)','Büyük Boy (+30 TL)'=>'Large (+30 TL)',
    'Normal Süt'=>'Regular Milk','Laktozsuz Süt (+10 TL)'=>'Lactose-Free Milk (+10 TL)',
    'Badem Sütü (+15 TL)'=>'Almond Milk (+15 TL)','Yulaf Sütü (+15 TL)'=>'Oat Milk (+15 TL)',
    'Standart'=>'Regular','Ekstra Buz'=>'Extra Ice','Az Buz'=>'Less Ice','Buzsuz'=>'No Ice',
    'Malzemeler'=>'Ingredients','Hazırlanışı'=>'Preparation','Kampanya Detayları'=>'Campaign Details',
    'Ürün veya kategori ara...'=>'Search products or categories...',
    'Tariflerde ara...'=>'Search recipes...',
    'Arama sonucunda ürün bulunamadı.'=>'No products match your search.',
    'Arama sonucunda tarif bulunamadı.'=>'No recipes match your search.',
    'Telefon'=>'Phone','Hafta İçi'=>'Weekdays','Cumartesi'=>'Saturday',
    'E-posta'=>'Email','Adres'=>'Address','İletişim'=>'Contact',
    'Sorularınız ve siparişleriniz için bizimle iletişime geçebilirsiniz.'=>'Contact us for questions and orders.',
    'KahveTat Logolu Termos (500 ml)'=>'KahveTat Branded Thermos (500 ml)',
    'KahveTat Logolu Bardak (350 ml)'=>'KahveTat Branded Cup (350 ml)',
    'KahveTat Logolu Kupa (400 ml)'=>'KahveTat Branded Mug (400 ml)',
    'Americano'=>'Americano','Caffe Latte'=>'Caffè Latte','Cappuccino'=>'Cappuccino','Flat White'=>'Flat White',
    'Caramel Macchiato'=>'Caramel Macchiato','Mocha'=>'Mocha','Espresso'=>'Espresso','Double Espresso'=>'Double Espresso',
    'White Chocolate Mocha'=>'White Chocolate Mocha','Geleneksel Türk Kahvesi'=>'Traditional Turkish Coffee',
    'Cortado'=>'Cortado','Macchiato'=>'Macchiato','Ristretto'=>'Ristretto','Affogato'=>'Affogato',
    'Viennese Coffee'=>'Viennese Coffee','Irish Coffee'=>'Irish Coffee','Café au Lait'=>'Café au Lait',
    'Red Eye'=>'Red Eye','Black Eye'=>'Black Eye','Iced Americano'=>'Iced Americano','Iced Latte'=>'Iced Latte',
    'Iced Caramel Latte'=>'Iced Caramel Latte','Cold Brew'=>'Cold Brew','Iced Mocha'=>'Iced Mocha',
    'Iced Vanilla Latte'=>'Iced Vanilla Latte','Iced White Mocha'=>'Iced White Mocha','Iced Cappuccino'=>'Iced Cappuccino',
    'Iced Hazelnut Latte'=>'Iced Hazelnut Latte','Nitro Cold Brew'=>'Nitro Cold Brew','Iced Toffee Nut Latte'=>'Iced Toffee Nut Latte',
    'Iced Coconut Latte'=>'Iced Coconut Latte','Iced Macchiato'=>'Iced Macchiato','Frappuccino Deluxe'=>'Frappuccino Deluxe',
    'Iced Red Eye'=>'Iced Red Eye','Cold Brew Tonic'=>'Cold Brew Tonic','Iced Spanish Latte'=>'Iced Spanish Latte',
    'Iced Honey Almond Latte'=>'Iced Honey Almond Latte','Iced Oat Latte'=>'Iced Oat Latte','Cold Brew Float'=>'Cold Brew Float',
    'Çikolatalı Milkshake'=>'Chocolate Milkshake','Oreolu Milkshake'=>'Oreo Milkshake','Vanilyalı Milkshake'=>'Vanilla Milkshake',
    'Çilekli Milkshake'=>'Strawberry Milkshake','Muzlu Milkshake'=>'Banana Milkshake','Karamelli Milkshake'=>'Caramel Milkshake',
    'Fındıklı Milkshake'=>'Hazelnut Milkshake','Kahveli Milkshake'=>'Coffee Milkshake','Lotus Milkshake'=>'Lotus Milkshake',
    'Nutella Milkshake'=>'Nutella Milkshake','Bademli Milkshake'=>'Almond Milkshake','Raspberry Milkshake'=>'Raspberry Milkshake',
    'Kestaneli Milkshake'=>'Chestnut Milkshake','Bisküvili Milkshake'=>'Biscuit Milkshake','Krokanlı Milkshake'=>'Praline Milkshake',
    'Çikolatalı Cookie'=>'Chocolate Cookie','Çikolatalı Brownie'=>'Chocolate Brownie','San Sebastian Cheesecake'=>'San Sebastian Cheesecake',
    'Tiramisu'=>'Tiramisu','Magnolia'=>'Magnolia Pudding','Lotus Cheesecake'=>'Lotus Cheesecake','Frambuazlı Cheesecake'=>'Raspberry Cheesecake',
    'Profiterol'=>'Profiteroles','Waffle'=>'Waffle','Pancake'=>'Pancakes','Croissant'=>'Croissant','Donut'=>'Donut',
    'Trileçe'=>'Tres Leches Cake','Mozaik Pasta'=>'Chocolate Mosaic Cake','Ekler'=>'Éclairs','Kestaneli Pasta'=>'Chestnut Cake',
    'Profiterol Topu'=>'Profiterole Bites','Fıstıklı Baklava'=>'Pistachio Baklava','Künefe'=>'Kunafa','Sufle'=>'Chocolate Fondant',
    'Çilekli Frozen'=>'Strawberry Frozen','Karpuzlu Frozen'=>'Watermelon Frozen','Mangolu Frozen'=>'Mango Frozen',
    'Muzlu Frozen'=>'Banana Frozen','Limonlu Frozen'=>'Lemon Frozen','Ananaslı Frozen'=>'Pineapple Frozen',
    'Şeftalili Frozen'=>'Peach Frozen','Orman Meyveli Frozen'=>'Forest Berry Frozen','Çikolatalı Frozen'=>'Chocolate Frozen',
    'Karamelli Frozen'=>'Caramel Frozen','Böğürtlenli Frozen'=>'Blackberry Frozen','Kavunlu Frozen'=>'Melon Frozen',
    'Ahududulu Frozen'=>'Raspberry Frozen','Kivi Frozen'=>'Kiwi Frozen','Ejder Meyveli Frozen'=>'Dragon Fruit Frozen',
    'Cafe Bombon'=>'Café Bombón','Geleneksel Türk Kahvesi (1 kg)'=>'Traditional Turkish Coffee (1 kg)',
    'Filtre Kahve Çekirdeği (1 kg)'=>'Filter Coffee Beans (1 kg)','Dibek Kahvesi (1 kg)'=>'Dibek Coffee (1 kg)',
    'Granül Kahve (1 kg)'=>'Instant Coffee (1 kg)',"Espresso Kapsül Kahve (50'li Paket)"=>'Espresso Capsules (Pack of 50)',
    'Boyut Seçimi:'=>'Choose Size:','Süt / Ekstra:'=>'Milk / Extras:','Buz / Derece:'=>'Ice:','Küçük Boy'=>'Small',
    'Orta Boy (+15 TL)'=>'Medium (+15 TL)','Büyük Boy (+30 TL)'=>'Large (+30 TL)','Normal Süt'=>'Regular Milk',
    'Laktozsuz Süt (+10 TL)'=>'Lactose-Free Milk (+10 TL)','Badem Sütü (+15 TL)'=>'Almond Milk (+15 TL)',
    'Yulaf Sütü (+15 TL)'=>'Oat Milk (+15 TL)','Standart'=>'Standard','Ekstra Buz'=>'Extra Ice','Az Buz'=>'Less Ice','Buzsuz'=>'No Ice',
    'Bitter Çikolata'=>'Dark Chocolate','Beyaz Çikolata'=>'White Chocolate','Sütlü Çikolata'=>'Milk Chocolate',
    'Çilek Soslu'=>'Strawberry Sauce','Sade'=>'Plain','Muz Dilimleri'=>'Banana Slices','Çilek Dilimleri'=>'Strawberry Slices',
    'Fındık Parçacıklı'=>'Chopped Hazelnuts','Telefon'=>'Phone','Hafta İçi'=>'Weekdays','Cumartesi'=>'Saturday',
    'Adres'=>'Address','İletişim'=>'Contact','Arama temizle'=>'Clear search','Ara'=>'Search','Kurum'=>'Organization','Min. 10'=>'Min. 10','Min. 6'=>'Min. 6','Standart'=>'Standard','Bitter Çikolata'=>'Dark Chocolate','Beyaz Çikolata'=>'White Chocolate','Sütlü Çikolata'=>'Milk Chocolate','Çilek Soslu'=>'Strawberry Sauce','Sade'=>'Plain','Muz Dilimleri'=>'Banana Slices','Çilek Dilimleri'=>'Strawberry Slices','Fındık Parçacıklı'=>'Chopped Hazelnuts','Orta Boy (+15 TL)'=>'Medium (+15 TL)','Min. 10'=>'Min. 10','Kurum'=>'Organization',
    'Ölçü / Seçenek'=>'Size / Options','Stokta'=>'In Stock','Kritik Stok'=>'Low Stock','Tükendi'=>'Out of Stock',
    'Bu ürünü silmek istediğinize emin misiniz?'=>'Are you sure you want to delete this product?',
    'Bilgileri kontrol edin. Şifre en az 6 karakter olmalı.'=>'Please check the details. Passwords must be at least 6 characters.',
    'Bu e-posta adresi zaten kayıtlı.'=>'This email address is already registered.',
    'Kayıt başarılı! İlk siparişinize özel %5 indirim kazandınız.'=>'Registration successful! You have received 5% off your first order.',
    'Giriş başarılı, keyifli alışverişler dileriz.'=>'Login successful. Enjoy your shopping.',
    'E-posta veya şifre hatalı.'=>'Incorrect email or password.',
    'Güvenli çıkış yapıldı.'=>'You have safely logged out.',
    'Üzgünüz, stok sınırına ulaşıldı.'=>'Sorry, the stock limit has been reached.',
    'Kart bilgilerini kontrol edin.'=>'Please check your card details.',
    'Toplu sipariş için giriş yapmalısınız.'=>'Please log in to place a bulk order.',
    'Toplu sipariş talebiniz oluşturuldu. %20 indirim uygulandı.'=>'Your bulk order request has been created. A 20% discount has been applied.',
    'Lütfen alanları doldurun ve en az 10 adet seçin.'=>'Please complete the fields and select at least 10 items.',
    'Yeni ürün başarıyla eklendi.'=>'The new product has been added successfully.',
    'Ürün sistemden silindi.'=>'The product has been removed from the system.',
    'Ürün başarıyla sepete eklendi.'=>'Product added to cart successfully.',
    'Özenle seçilmiş çekirdekler, usta ellerde hazırlanan eşsiz lezzetler.'=>'Carefully selected beans and unique flavors crafted by expert hands.',
    'Özel İçecekler'=>'Specialty Drinks',
    'Eşsiz lezzet kombinasyonları.'=>'Unique flavor combinations.',
    'Serinletici Lezzetler'=>'Refreshing Drinks',
    'Soğuk kahve ve frozen çeşitleri sizi bekliyor.'=>'Explore our iced coffees and frozen drinks.',
    'Sıcak kahve çeşitlerini keşfedin.'=>'Explore our hot coffee selection.',
    'Kahvenizin yanına tatlı çeşitlerimizi deneyin.'=>'Pair your coffee with our selection of desserts.',
    'Türk kahvesi ve geleneksel tatlar.'=>'Discover Turkish coffee and traditional flavors.',
    'Usta ellerden özel lezzetler.'=>'Special creations prepared by our expert baristas.',
    'Yeni üyelerimize ilk siparişlerinde %5 indirim.'=>'New members get 5% off their first order.',
    '500 TL ve üzeri alışverişlerde ücretsiz kargo.'=>'Free shipping on orders of 500 TL or more.',
    '10 adet ve üzeri siparişlerde %20 indirim.'=>'Get 20% off orders of 10 items or more.',
    'Bardak, kupa ve termos çeşitlerini inceleyin.'=>'Explore our cups, mugs and thermoses.',
];

function t($metin) {
    global $lang, $sozluk;
    if ($lang !== 'en') return $metin;
    if (isset($sozluk[$metin])) return $sozluk[$metin];
    if (strpos($metin, 'Siparişiniz alındı! Toplam: ') === 0) return 'Your order has been received! Total: ' . substr($metin, strlen('Siparişiniz alındı! Toplam: '));
    return $metin;
}

function kategoriCevir($kategori) {
    return t($kategori);
}

/* ---------------- ŞEHİRLER ---------------- */

$sehirler = [
'Adana','Adıyaman','Afyonkarahisar','Ağrı','Amasya','Ankara','Antalya',
'Artvin','Aydın','Balıkesir','Bilecik','Bingöl','Bitlis','Bolu','Burdur',
'Bursa','Çanakkale','Çankırı','Çorum','Denizli','Diyarbakır','Edirne',
'Elazığ','Erzincan','Erzurum','Eskişehir','Gaziantep','Giresun',
'Gümüşhane','Hakkari','Hatay','Isparta','Mersin','İstanbul','İzmir',
'Kars','Kastamonu','Kayseri','Kırklareli','Kırşehir','Kocaeli',
'Konya','Kütahya','Malatya','Manisa','Kahramanmaraş','Mardin',
'Muğla','Muş','Nevşehir','Niğde','Ordu','Rize','Sakarya','Samsun',
'Siirt','Sinop','Sivas','Tekirdağ','Tokat','Trabzon','Tunceli',
'Şanlıurfa','Uşak','Van','Yozgat','Zonguldak','Aksaray','Bayburt',
'Karaman','Kırıkkale','Batman','Şırnak','Bartın','Ardahan','Iğdır',
'Yalova','Karabük','Kilis','Osmaniye','Düzce'
];

/* ---------------- ÜRÜN KATALOĞU (KAHVE, TATLI, BARDAK, KUPA VE TERMOS) ---------------- */

$katalog = [
'Sıcak Kahve'=>[
'Americano','Caffe Latte','Cappuccino','Flat White','Caramel Macchiato',
'Mocha','Espresso','Double Espresso','White Chocolate Mocha',
'Geleneksel Türk Kahvesi','Macchiato','Ristretto',
'Affogato','Viennese Coffee','Irish Coffee',
'Red Eye','Black Eye','Cafe Bombon'
],
'Soğuk Kahve'=>[
'Iced Americano','Iced Latte','Iced Caramel Latte','Cold Brew',
'Iced Mocha','Iced Vanilla Latte','Iced White Mocha','Iced Cappuccino',
'Iced Toffee Nut Latte',
'Iced Coconut Latte','Iced Macchiato','Frappuccino Deluxe',
'Iced Spanish Latte','Iced Honey Almond Latte'
],
'Frozen'=>[
'Çilekli Frozen','Karpuzlu Frozen','Mangolu Frozen','Muzlu Frozen',
'Limonlu Frozen','Ananaslı Frozen','Şeftalili Frozen',
'Orman Meyveli Frozen','Çikolatalı Frozen','Karamelli Frozen',
'Böğürtlenli Frozen','Kavunlu Frozen','Ahududulu Frozen',
'Kivi Frozen','Ejder Meyveli Frozen'
],
'Milkshake'=>[
'Çikolatalı Milkshake','Oreolu Milkshake','Vanilyalı Milkshake',
'Çilekli Milkshake','Muzlu Milkshake','Karamelli Milkshake',
'Fındıklı Milkshake','Lotus Milkshake','Nutella Milkshake'
],
'Tatlılar'=>[
'Çikolatalı Cookie','Çikolatalı Brownie','San Sebastian Cheesecake',
'Tiramisu','Magnolia','Lotus Cheesecake','Frambuazlı Cheesecake',
'Profiterol','Waffle','Pancake','Croissant','Donut',
'Trileçe','Mozaik Pasta','Ekler',
'Fıstıklı Baklava','Künefe','Sufle'
],
'Kilo Kahve'=>[
'Geleneksel Türk Kahvesi (1 kg)',
'Filtre Kahve Çekirdeği (1 kg)',
'Dibek Kahvesi (1 kg)',
'Espresso Kapsül Kahve (50\'li Paket)'
],
'Ekipman'=>[
'KahveTat Logolu Termos (500 ml)',
'KahveTat Logolu Kupa (400 ml)'
]
];

$fiyatlar = [
'Sıcak Kahve'=>115,'Soğuk Kahve'=>130,'Frozen'=>145,
'Milkshake'=>155,'Tatlılar'=>165,
'Kilo Kahve'=>650,'Ekipman'=>199
];

/* Ekipmanlar için özel gerçekçi fiyatlar */
$ozelFiyatlar = [
    'KahveTat Logolu Termos (500 ml)' => 399,
    'KahveTat Logolu Bardak (350 ml)' => 149,
    'KahveTat Logolu Kupa (400 ml)' => 199,
    'Geleneksel Türk Kahvesi (1 kg)' => 520,
    'Filtre Kahve Çekirdeği (1 kg)' => 690,
    'Dibek Kahvesi (1 kg)' => 590,
    'Granül Kahve (1 kg)' => 450,
    "Espresso Kapsül Kahve (50'li Paket)" => 790
];

/* Ürün görselleri: her ürünün adıyla eşleşen ayrı görsel araması kullanılır. */
$urunGorselHavuzu = [
    'Sıcak Kahve' => [], 'Soğuk Kahve' => [], 'Frozen' => [],
    'Milkshake' => [], 'Tatlılar' => [], 'Kilo Kahve' => [], 'Ekipman' => []
];
function urunGorselUret($ad, $kategori) {
    /* Her ürün için adına ve türüne özel arama terimi + benzersiz kilit kullanılır. */
    $terimler = [
        'Americano'=>'americano black coffee in ceramic cup',
        'Caffe Latte'=>'caffe latte latte art glass cup',
        'Cappuccino'=>'cappuccino thick milk foam coffee cup',
        'Flat White'=>'flat white coffee latte art cup',
        'Caramel Macchiato'=>'caramel macchiato layered coffee glass',
        'Mocha'=>'mocha chocolate espresso coffee cup',
        'Espresso'=>'single espresso shot demitasse cup',
        'Double Espresso'=>'double espresso shot small espresso cup',
        'White Chocolate Mocha'=>'white chocolate mocha coffee whipped cream',
        'Geleneksel Türk Kahvesi'=>'traditional turkish coffee in fincan',
        'Cortado'=>'cortado coffee small glass', 'Macchiato'=>'espresso macchiato coffee cup',
        'Ristretto'=>'ristretto espresso small cup', 'Affogato'=>'affogato espresso over vanilla ice cream',
        'Viennese Coffee'=>'viennese coffee whipped cream cup', 'Irish Coffee'=>'irish coffee glass cream',
        'Café au Lait'=>'cafe au lait coffee milk cup', 'Red Eye'=>'red eye black coffee espresso cup',
        'Black Eye'=>'black eye coffee espresso mug',
        'Iced Americano'=>'iced americano black coffee ice clear glass',
        'Iced Latte'=>'iced latte milk coffee ice glass', 'Iced Caramel Latte'=>'iced caramel latte coffee glass',
        'Cold Brew'=>'cold brew coffee ice glass', 'Iced Mocha'=>'iced mocha chocolate coffee glass',
        'Iced Vanilla Latte'=>'iced vanilla latte coffee glass', 'Iced White Mocha'=>'iced white mocha coffee glass',
        'Iced Cappuccino'=>'iced cappuccino coffee foam glass', 'Iced Hazelnut Latte'=>'iced hazelnut latte coffee glass',
        'Nitro Cold Brew'=>'nitro cold brew coffee glass creamy foam', 'Iced Toffee Nut Latte'=>'iced toffee nut latte coffee',
        'Iced Coconut Latte'=>'iced coconut latte coffee glass', 'Iced Macchiato'=>'iced macchiato layered coffee glass',
        'Frappuccino Deluxe'=>'frappuccino blended iced coffee whipped cream', 'Iced Red Eye'=>'iced red eye coffee glass',
        'Cold Brew Tonic'=>'cold brew tonic espresso tonic water glass', 'Iced Spanish Latte'=>'iced spanish latte condensed milk coffee',
        'Iced Honey Almond Latte'=>'iced honey almond milk latte', 'Iced Oat Latte'=>'iced oat milk latte coffee',
        'Cold Brew Float'=>'cold brew coffee float vanilla ice cream',
        'KahveTat Logolu Termos (500 ml)'=>'minimal matte stainless steel reusable coffee thermos bottle product photography',
        'KahveTat Logolu Bardak (350 ml)'=>'minimal reusable branded takeaway coffee cup with lid product photography',
        'KahveTat Logolu Kupa (400 ml)'=>'minimal ceramic coffee mug product photography on neutral background',
        'Geleneksel Türk Kahvesi (1 kg)'=>'',
        'Filtre Kahve Çekirdeği (1 kg)'=>'',
        'Dibek Kahvesi (1 kg)'=>'',
        'Granül Kahve (1 kg)'=>'',
        "Espresso Kapsül Kahve (50'li Paket)"=>''
    ];
    if ($kategori === 'Ekipman') {
        if (strpos($ad, 'Termos') !== false) return 'gorseller/termos.png';
        if (strpos($ad, 'Kupa') !== false) return 'gorseller/kupa.png';
        return '';
    }
    if ($kategori === 'Kilo Kahve') return '';
    /* Downloads'tan alınan yerel ürün fotoğrafları (gorseller/ klasörü) */
    $yerel = [
        'Americano'=>'u15','Caffe Latte'=>'u09','Cappuccino'=>'u01','Flat White'=>'u02',
        'Caramel Macchiato'=>'u03','Mocha'=>'u04','Espresso'=>'u05','Double Espresso'=>'u06',
        'White Chocolate Mocha'=>'u07','Geleneksel Türk Kahvesi'=>'u08','Macchiato'=>'u03',
        'Ristretto'=>'u10','Affogato'=>'u11','Viennese Coffee'=>'u12','Irish Coffee'=>'u13',
        'Red Eye'=>'u14','Black Eye'=>'u15','Cafe Bombon'=>'u16',
        'Iced Americano'=>'u00','Iced Latte'=>'u19','Iced Caramel Latte'=>'u18','Cold Brew'=>'u20',
        'Iced Mocha'=>'u21','Iced Vanilla Latte'=>'u22','Iced White Mocha'=>'u23','Iced Cappuccino'=>'u24',
        'Iced Toffee Nut Latte'=>'u25','Iced Coconut Latte'=>'u26','Iced Macchiato'=>'u27',
        'Frappuccino Deluxe'=>'u28','Iced Spanish Latte'=>'u29','Iced Honey Almond Latte'=>'u30',
        'Çilekli Frozen'=>'u31','Karpuzlu Frozen'=>'u32','Mangolu Frozen'=>'u33','Muzlu Frozen'=>'u34',
        'Limonlu Frozen'=>'u35','Ananaslı Frozen'=>'u36','Şeftalili Frozen'=>'u37','Orman Meyveli Frozen'=>'u38',
        'Çikolatalı Frozen'=>'u45','Karamelli Frozen'=>'u40','Böğürtlenli Frozen'=>'u41','Kavunlu Frozen'=>'u33',
        'Ahududulu Frozen'=>'u42','Kivi Frozen'=>'u43','Ejder Meyveli Frozen'=>'u44',
        'Çikolatalı Milkshake'=>'u39','Oreolu Milkshake'=>'u46','Vanilyalı Milkshake'=>'u48','Çilekli Milkshake'=>'u47',
        'Muzlu Milkshake'=>'u48','Karamelli Milkshake'=>'u49','Fındıklı Milkshake'=>'u50','Lotus Milkshake'=>'u51',
        'Nutella Milkshake'=>'u52',
        'Çikolatalı Cookie'=>'u53','Çikolatalı Brownie'=>'u54','San Sebastian Cheesecake'=>'u55','Tiramisu'=>'u56',
        'Magnolia'=>'u57','Lotus Cheesecake'=>'u58','Frambuazlı Cheesecake'=>'u59','Profiterol'=>'u60','Waffle'=>'u61',
        'Pancake'=>'u62','Croissant'=>'u63','Donut'=>'u64','Trileçe'=>'u65','Mozaik Pasta'=>'u66','Ekler'=>'u67',
        'Fıstıklı Baklava'=>'u68','Künefe'=>'u69','Sufle'=>'u70'
    ];
    if (isset($yerel[$ad])) return 'gorseller/' . $yerel[$ad] . '.jpg';
    if (isset($terimler[$ad])) {
        $query = $terimler[$ad];
    } elseif ($kategori === 'Tatlılar') {
        $query = $ad . ' dessert pastry food close up';
    } elseif ($kategori === 'Frozen') {
        $query = $ad . ' fruit slush frozen drink clear cup';
    } elseif ($kategori === 'Milkshake') {
        $query = $ad . ' milkshake tall glass whipped cream';
    } elseif ($kategori === 'Ekipman') {
        $query = $ad . ' coffee mug cup thermos product photo';
    } else {
        $query = $ad . ' specialty coffee drink cup';
    }
    return 'https://loremflickr.com/900/650/' . rawurlencode($query) . '?lock=' . abs(crc32($ad));
}

function tarifCevir($metin) {
    global $lang;
    if ($lang !== 'en') return $metin;
    $map = [
      'MALZEMELER:'=>'INGREDIENTS:', 'HAZIRLANIŞI:'=>'METHOD:', 'HAZIRLAMA ÖNERİSİ:'=>'BREWING GUIDE:', 'KULLANIM BİLGİSİ:'=>'USAGE:',
      '1 shot espresso (30 ml)'=>'1 shot espresso (30 ml)', '2 shot espresso (60 ml)'=>'2 shots espresso (60 ml)',
      '1 su bardağı sıcak su (180 ml)'=>'1 cup hot water (180 ml)', '1 su bardağı süt (200 ml)'=>'1 cup milk (200 ml)',
      'Yarım su bardağı süt (100 ml)'=>'½ cup milk (100 ml)', 'Yarım su bardağı süt köpüğü (100 ml)'=>'½ cup milk foam (100 ml)',
      '1 yemek kaşığı kakao veya çikolata sosu (15 g)'=>'1 tablespoon cocoa or chocolate sauce (15 g)',
      '1 fincan soğuk su (65 ml)'=>'1 Turkish coffee cup cold water (65 ml)', '2 çay kaşığı Türk kahvesi (6 g)'=>'2 teaspoons Turkish coffee (6 g)',
      'İsteğe göre 1 çay kaşığı şeker'=>'1 teaspoon sugar, optional', '1 su bardağı soğuk su (180 ml)'=>'1 cup cold water (180 ml)',
      '1 su bardağı buz'=>'1 cup ice', '30 g kalın öğütülmüş kahve'=>'30 g coarsely ground coffee',
      '1,5 su bardağı içme suyu (360 ml)'=>'1½ cups drinking water (360 ml)', 'Servis için buz'=>'Ice for serving',
      '1 su bardağı süt veya su (200 ml)'=>'1 cup milk or water (200 ml)', 'İsteğe göre 1 tatlı kaşığı şurup (10 ml)'=>'1 teaspoon syrup (10 ml), optional',
      'Soğuk servis için 1 su bardağı buz'=>'1 cup ice for iced drinks', '1 su bardağı meyve veya ürünün ana aroması (150 g)'=>'1 cup fruit or main flavor ingredient (150 g)',
      '1 su bardağı buz (frozen için)'=>'1 cup ice (for frozen drinks)', '2 top dondurma (milkshake için, yaklaşık 100 g)'=>'2 scoops ice cream (about 100 g, for milkshakes)',
      '1 su bardağı un (120 g)'=>'1 cup flour (120 g)', 'Yarım su bardağı şeker (100 g)'=>'½ cup sugar (100 g)',
      '2 adet yumurta'=>'2 eggs', '2 yemek kaşığı sıvı yağ (20 ml)'=>'2 tablespoons vegetable oil (20 ml)',
      'Filtre kahve: 1 su bardağı (200 ml) su için 12-15 g kahve kullanın.'=>'Filter coffee: use 12–15 g coffee per 1 cup (200 ml) water.',
      'Türk kahvesi: 1 fincan (65 ml) su için 2 çay kaşığı (6 g) kahve kullanın.'=>'Turkish coffee: use 2 teaspoons (6 g) coffee per 1 cup (65 ml) water.',
      'Espresso: 18 g ince öğütülmüş kahveyle yaklaşık 36 ml çıktı alın.'=>'Espresso: use 18 g finely ground coffee for about 36 ml yield.',
      'Bardak, kupa veya termosu sıcak/soğuk içeceğin türüne göre hazırlayın.'=>'Choose a cup, mug or thermos suitable for your hot or cold drink.',
      '1. Fincana 1 shot espresso alın.'=>'1. Pour one shot of espresso into a cup.', '2. Üzerine 1 su bardağı sıcak suyu yavaşça ekleyin.'=>'2. Slowly add 1 cup of hot water.',
      '3. Sıcak servis edin.'=>'3. Serve hot.', '1. Espressoyu büyük fincana alın.'=>'1. Pour the espresso into a large cup.',
      '2. Sütü ısıtıp hafifçe köpürtün.'=>'2. Heat and lightly froth the milk.', '3. Sütü espressoya dökün, az miktarda köpükle tamamlayın.'=>'3. Pour the milk into the espresso and finish with a little foam.',
      '1. Espressoyu fincana hazırlayın.'=>'1. Prepare the espresso in a cup.', '2. Sütü ısıtıp köpürtün.'=>'2. Heat and froth the milk.',
      '3. Sütü ve yoğun köpüğü espresso üzerine ekleyin.'=>'3. Add the milk and thick foam over the espresso.',
      '1. Çikolatayı fincana koyun.'=>'1. Add the chocolate to a cup.', '2. Sıcak espressoyu ekleyip karıştırın.'=>'2. Add the hot espresso and stir.',
      '3. Isıtılmış sütü ilave ederek servis edin.'=>'3. Add the steamed milk and serve.', '1. Cezveye suyu, kahveyi ve şekeri ekleyin.'=>'1. Add the water, coffee and sugar to a cezve.',
      '2. Kısık ateşte köpük oluşana kadar karıştırmadan pişirin.'=>'2. Heat gently without stirring until foam forms.',
      '3. Köpüğü fincana paylaştırın, kahveyi taşırmadan fincana dökün.'=>'3. Divide the foam between cups, then carefully pour in the coffee.',
      '1. Bardağı buzla doldurun.'=>'1. Fill a glass with ice.', '2. Soğuk suyu ekleyin.'=>'2. Add the cold water.',
      '3. Espressoyu üzerine döküp servis edin.'=>'3. Pour the espresso over the top and serve.', '1. Kahve ve suyu kapaklı kavanozda karıştırın.'=>'1. Combine the coffee and water in a lidded jar.',
      '2. Buzdolabında 12-16 saat bekletin.'=>'2. Refrigerate for 12–16 hours.', '3. İnce süzgeç veya filtreyle süzün; buzla servis edin.'=>'3. Strain through a fine sieve or filter; serve over ice.',
      '1. Espressoyu hazırlayın.'=>'1. Prepare the espresso.', '2. Süt veya suyu ürünün türüne göre ekleyin.'=>'2. Add milk or water according to the drink.',
      '3. Soğuk hazırlanıyorsa bardağı buzla doldurun.'=>'3. If serving cold, fill the glass with ice.', '4. Malzemeleri karıştırıp taze servis edin.'=>'4. Mix the ingredients and serve fresh.',
      '1. Malzemeleri blender haznesine alın.'=>'1. Place the ingredients in a blender.', '2. Frozen için buzla, milkshake için dondurmayla pürüzsüz olana kadar çekin.'=>'2. Blend with ice for a frozen drink or ice cream for a milkshake until smooth.',
      '3. Soğuk bardağa aktarın ve bekletmeden servis edin.'=>'3. Pour into a chilled glass and serve immediately.', '1. Yumurta ve şekeri 2-3 dakika çırpın.'=>'1. Whisk the eggs and sugar for 2–3 minutes.',
      '2. Sütü ve yağı ekleyin.'=>'2. Add the milk and oil.', '3. Unu kontrollü biçimde karıştırın; ürün türüne göre uygun kalıpta pişirin.'=>'3. Gradually mix in the flour and bake in a suitable pan.',
      '4. Soğuduktan sonra porsiyonlayıp servis edin.'=>'4. Allow to cool, portion and serve.', '1. Kahveyi hazırlama yöntemine uygun incelikte öğütün.'=>'1. Grind the coffee to suit your brewing method.',
      '2. Ölçülen su ve kahveyi seçtiğiniz yönteme göre demleyin.'=>'2. Brew the measured water and coffee using your chosen method.', '3. Taze servis edin.'=>'3. Serve fresh.',
      '1. İçeceğinizi ayrı bir kapta hazırlayın.'=>'1. Prepare your drink in a separate container.', '2. Ürüne dikkatlice aktarın.'=>'2. Carefully pour it into your drinkware.',
      '3. Kullanım sonrasında ürünü temizleyip kurulayın.'=>'3. Clean and dry the item after use.'
    ];
    return strtr($metin, $map);
}

function tarifOlustur($ad, $kategori) {
    $tarifler = [
        'Americano'=>"MALZEMELER:
- 1 shot espresso (30 ml)
- 1 su bardağı sıcak su (180 ml)

HAZIRLANIŞI:
1. Fincana 1 shot espresso alın.
2. Üzerine 1 su bardağı sıcak suyu yavaşça ekleyin.
3. Sıcak servis edin.",
        'Caffe Latte'=>"MALZEMELER:
- 1 shot espresso (30 ml)
- 1 su bardağı süt (200 ml)

HAZIRLANIŞI:
1. Espressoyu büyük fincana alın.
2. Sütü ısıtıp hafifçe köpürtün.
3. Sütü espressoya dökün, az miktarda köpükle tamamlayın.",
        'Cappuccino'=>"MALZEMELER:
- 1 shot espresso (30 ml)
- Yarım su bardağı süt (100 ml)
- Yarım su bardağı süt köpüğü (100 ml)

HAZIRLANIŞI:
1. Espressoyu fincana hazırlayın.
2. Sütü ısıtıp köpürtün.
3. Sütü ve yoğun köpüğü espresso üzerine ekleyin.",
        'Mocha'=>"MALZEMELER:
- 1 shot espresso (30 ml)
- 1 yemek kaşığı kakao veya çikolata sosu (15 g)
- 1 su bardağı süt (200 ml)

HAZIRLANIŞI:
1. Çikolatayı fincana koyun.
2. Sıcak espressoyu ekleyip karıştırın.
3. Isıtılmış sütü ilave ederek servis edin.",
        'Geleneksel Türk Kahvesi'=>"MALZEMELER:
- 1 fincan soğuk su (65 ml)
- 2 çay kaşığı Türk kahvesi (6 g)
- İsteğe göre 1 çay kaşığı şeker

HAZIRLANIŞI:
1. Cezveye suyu, kahveyi ve şekeri ekleyin.
2. Kısık ateşte köpük oluşana kadar karıştırmadan pişirin.
3. Köpüğü fincana paylaştırın, kahveyi taşırmadan fincana dökün.",
        'Iced Americano'=>"MALZEMELER:
- 2 shot espresso (60 ml)
- 1 su bardağı soğuk su (180 ml)
- 1 su bardağı buz

HAZIRLANIŞI:
1. Bardağı buzla doldurun.
2. Soğuk suyu ekleyin.
3. Espressoyu üzerine döküp servis edin.",
        'Cold Brew'=>"MALZEMELER:
- 30 g kalın öğütülmüş kahve
- 1,5 su bardağı içme suyu (360 ml)
- Servis için buz

HAZIRLANIŞI:
1. Kahve ve suyu kapaklı kavanozda karıştırın.
2. Buzdolabında 12-16 saat bekletin.
3. İnce süzgeç veya filtreyle süzün; buzla servis edin."
    ];
    if (isset($tarifler[$ad])) return $tarifler[$ad];
    if ($kategori === 'Sıcak Kahve' || $kategori === 'Soğuk Kahve') return "MALZEMELER:
- 1 shot espresso (30 ml)
- 1 su bardağı süt veya su (200 ml)
- İsteğe göre 1 tatlı kaşığı şurup (10 ml)
- Soğuk servis için 1 su bardağı buz

HAZIRLANIŞI:
1. Espressoyu hazırlayın.
2. Süt veya suyu ürünün türüne göre ekleyin.
3. Soğuk hazırlanıyorsa bardağı buzla doldurun.
4. Malzemeleri karıştırıp taze servis edin.";
    if ($kategori === 'Frozen' || $kategori === 'Milkshake') return "MALZEMELER:
- 1 su bardağı süt (200 ml)
- 1 su bardağı meyve veya ürünün ana aroması (150 g)
- 1 su bardağı buz (frozen için)
- 2 top dondurma (milkshake için, yaklaşık 100 g)

HAZIRLANIŞI:
1. Malzemeleri blender haznesine alın.
2. Frozen için buzla, milkshake için dondurmayla pürüzsüz olana kadar çekin.
3. Soğuk bardağa aktarın ve bekletmeden servis edin.";
    if ($kategori === 'Tatlılar') return "MALZEMELER:
- 1 su bardağı un (120 g)
- Yarım su bardağı şeker (100 g)
- 2 adet yumurta
- Yarım su bardağı süt (100 ml)
- 2 yemek kaşığı sıvı yağ (20 ml)

HAZIRLANIŞI:
1. Yumurta ve şekeri 2-3 dakika çırpın.
2. Sütü ve yağı ekleyin.
3. Unu kontrollü biçimde karıştırın; ürün türüne göre uygun kalıpta pişirin.
4. Soğuduktan sonra porsiyonlayıp servis edin.";
    if ($kategori === 'Kilo Kahve') return "HAZIRLAMA ÖNERİSİ:
- Filtre kahve: 1 su bardağı (200 ml) su için 12-15 g kahve kullanın.
- Türk kahvesi: 1 fincan (65 ml) su için 2 çay kaşığı (6 g) kahve kullanın.
- Espresso: 18 g ince öğütülmüş kahveyle yaklaşık 36 ml çıktı alın.

HAZIRLANIŞI:
1. Kahveyi hazırlama yöntemine uygun incelikte öğütün.
2. Ölçülen su ve kahveyi seçtiğiniz yönteme göre demleyin.
3. Taze servis edin.";
    return "KULLANIM BİLGİSİ:
- Ürünü kullanmadan önce temizleyin.
- Bardak, kupa veya termosu sıcak/soğuk içeceğin türüne göre hazırlayın.

HAZIRLANIŞI:
1. İçeceğinizi ayrı bir kapta hazırlayın.
2. Ürüne dikkatlice aktarın.
3. Kullanım sonrasında ürünü temizleyip kurulayın.";
}

/* Ürün bazlı indirim oranları (%) — kampanya sayfası yerine ürün kartlarında gösterilir */
$kategoriIndirimleri = [
    'Sıcak Kahve'=>10,'Soğuk Kahve'=>15,'Frozen'=>20,'Milkshake'=>10,
    'Tatlılar'=>15,'Kilo Kahve'=>5,'Ekipman'=>0
];

$varsayilanUrunler = [];
$yeniId = 1;
$sayaclar = [];

foreach ($katalog as $kategori => $urunler) {
    foreach ($urunler as $ad) {
        $gorsel = urunGorselUret($ad, $kategori);

        $listeFiyati = $ozelFiyatlar[$ad] ?? ($fiyatlar[$kategori] ?? 100);
        /* Her ürüne değil, yaklaşık üçte birine indirim uygulanır (kategori oranıyla) */
        $indirimOrani = (abs(crc32($ad)) % 3 === 0) ? ($kategoriIndirimleri[$kategori] ?? 0) : 0;
        $urunFiyati = round($listeFiyati * (1 - $indirimOrani / 100), 2);

        $varsayilanUrunler[$yeniId] = [
            'id'=>$yeniId,
            'ad'=>$ad,
            'kategori'=>$kategori,
            'liste_fiyat'=>$listeFiyati,
            'indirim'=>$indirimOrani,
            'fiyat'=>$urunFiyati,
            'stok'=>50,
            'aciklama'=>$ad.' - KahveTat özel reçetesiyle hazırlanmıştır.',
            'hazirlanis'=>tarifOlustur($ad, $kategori),
            'gorsel'=>$gorsel,
            'tat'=>in_array($kategori,['Tatlılar'])?'Tatlı':'Dengeli',
            'sertlik'=>in_array($kategori,['Sıcak Kahve','Kilo Kahve'])?'Sert':'Yumuşak',
            'sicaklik'=>in_array($kategori,['Sıcak Kahve','Kilo Kahve'])?'Sıcak':'Soğuk'
        ];
        $yeniId++;
    }
}

/* Katalog değiştiğinde (ürünler kaldırıldı, id'ler kaydı) eski oturum ürünlerini ve sepeti sıfırla */
if (($_SESSION['katalog_surum'] ?? '') !== 'v5') {
    unset($_SESSION['urunler']);
    $_SESSION['sepet'] = [];
    $_SESSION['katalog_surum'] = 'v5';
}

if (!isset($_SESSION['urunler'])) {
    $_SESSION['urunler'] = $varsayilanUrunler;
} else {
    foreach ($varsayilanUrunler as $id => $urun) {
        if (!isset($_SESSION['urunler'][$id])) $_SESSION['urunler'][$id] = $urun;
        else {
            $_SESSION['urunler'][$id]['gorsel'] = $urun['gorsel'];
            $_SESSION['urunler'][$id]['fiyat'] = $urun['fiyat'];
            $_SESSION['urunler'][$id]['liste_fiyat'] = $urun['liste_fiyat'];
            $_SESSION['urunler'][$id]['indirim'] = $urun['indirim'];
            $_SESSION['urunler'][$id]['hazirlanis'] = $urun['hazirlanis'];
            $_SESSION['urunler'][$id]['kategori'] = $urun['kategori'];
            $_SESSION['urunler'][$id]['ad'] = $urun['ad'];
        }
    }
    foreach ($_SESSION['urunler'] as $id => $urun) {
        if (($urun['kategori'] ?? '') === 'Ekipman' && !in_array(($urun['ad'] ?? ''), $katalog['Ekipman'], true)) {
            unset($_SESSION['urunler'][$id]);
        }
        if (($urun['kategori'] ?? '') === 'Kilo Kahve') {
            $_SESSION['urunler'][$id]['gorsel'] = '';
        }
    }
}

/* ---------------- OTURUM VERİLERİ ---------------- */

if (!isset($_SESSION['kullanicilar'])) $_SESSION['kullanicilar']=[];
if (!isset($_SESSION['sepet'])) $_SESSION['sepet']=[];
if (!isset($_SESSION['satislar'])) $_SESSION['satislar']=[];
if (!isset($_SESSION['toplu_siparisler'])) $_SESSION['toplu_siparisler']=[];
if (!isset($_SESSION['indirim_kullananlar'])) $_SESSION['indirim_kullananlar']=[];

$mesaj='';
$mesajTipi='success';
$sekme=guvenli($_REQUEST['sekme']??'anasayfa');
$alt_kategori=guvenli($_REQUEST['kat']??'Tümü');
$islem=$_POST['islem']??'';

/* ---------------- KULLANICI İŞLEMLERİ ---------------- */

if ($islem==='kayit') {
    $ad=guvenli($_POST['ad']??'');
    $email=strtolower(guvenli($_POST['email']??''));
    $sifre=$_POST['sifre']??'';

    if (!$ad || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($sifre)<6) {
        $mesaj='Bilgileri kontrol edin. Şifre en az 6 karakter olmalı.';
        $mesajTipi='error'; $sekme='kayit';
    } elseif (isset($_SESSION['kullanicilar'][$email])) {
        $mesaj='Bu e-posta adresi zaten kayıtlı.';
        $mesajTipi='error'; $sekme='kayit';
    } else {
        $_SESSION['kullanicilar'][$email]=[
            'ad'=>$ad,'email'=>$email,
            'sifre'=>password_hash($sifre,PASSWORD_DEFAULT)
        ];
        $_SESSION['kullanici']=$email;
        $_SESSION['indirim_kullananlar'][$email]=false;
        $mesaj='Kayıt başarılı! İlk siparişinize özel %5 indirim kazandınız.';
        $sekme='menu';
    }
}

if ($islem==='giris') {
    $email=strtolower(guvenli($_POST['email']??''));
    $sifre=$_POST['sifre']??'';

    if (isset($_SESSION['kullanicilar'][$email]) &&
        password_verify($sifre,$_SESSION['kullanicilar'][$email]['sifre'])) {
        $_SESSION['kullanici']=$email;
        $mesaj='Giriş başarılı, keyifli alışverişler dileriz.';
        $sekme='menu';
    } else {
        $mesaj='E-posta veya şifre hatalı.';
        $mesajTipi='error'; $sekme='giris';
    }
}

if ($islem==='cikis') {
    unset($_SESSION['kullanici']);
    $mesaj='Güvenli çıkış yapıldı.';
    $sekme='anasayfa';
}

/* ---------------- SEPETE EKLE ---------------- */

if ($islem==='sepete_ekle') {
    $urun_id=intval($_POST['urun_id']??0);
    $boyut=guvenli($_POST['boyut']??'Küçük Boy');
    $secenek1=guvenli($_POST['secenek1']??'Standart');
    $secenek2=guvenli($_POST['secenek2']??'Standart');
    $ekstra=guvenli($_POST['ekstra']??'Yok');

    $ekFiyat = 0;
    if (strpos($boyut, 'Orta') !== false) $ekFiyat += 15;
    if (strpos($boyut, 'Büyük') !== false) $ekFiyat += 30;
    if (strpos($secenek1, '+10') !== false) $ekFiyat += 10;
    if (strpos($secenek1, '+15') !== false) $ekFiyat += 15;

    if (isset($_SESSION['urunler'][$urun_id]) &&
        $_SESSION['urunler'][$urun_id]['stok']>0) {

        $key=$urun_id.'_'.md5($boyut.$secenek1.$secenek2.$ekstra);

        if (!isset($_SESSION['sepet'][$key])) {
            $_SESSION['sepet'][$key]=[
                'urun_id'=>$urun_id,
                'adet'=>0,
                'boyut'=>$boyut,
                'secenek1'=>$secenek1,
                'secenek2'=>$secenek2,
                'ekstra'=>$ekstra,
                'ek_fiyat'=>$ekFiyat
            ];
        }

        if ($_SESSION['sepet'][$key]['adet'] <
            $_SESSION['urunler'][$urun_id]['stok']) {
            $_SESSION['sepet'][$key]['adet']++;
            $mesaj='Ürün başarıyla sepete eklendi.';
        } else {
            $mesaj='Üzgünüz, stok sınırına ulaşıldı.';
            $mesajTipi='error';
        }
    }
    $sekme='menu';
}

/* ---------------- SEPET GÜNCELLE ---------------- */

if ($islem==='sepet_guncelle') {
    $key=$_POST['sepet_key']??'';
    $alt=$_POST['alt_islem']??'';

    if (isset($_SESSION['sepet'][$key])) {
        $u_id=$_SESSION['sepet'][$key]['urun_id'];

        if ($alt==='arttir' &&
            $_SESSION['sepet'][$key]['adet'] < $_SESSION['urunler'][$u_id]['stok']) {
            $_SESSION['sepet'][$key]['adet']++;
        } elseif ($alt==='azalt') {
            $_SESSION['sepet'][$key]['adet']--;
            if ($_SESSION['sepet'][$key]['adet']<=0) {
                unset($_SESSION['sepet'][$key]);
            }
        } elseif ($alt==='sil') {
            unset($_SESSION['sepet'][$key]);
        }
    }
    $sekme='sepet';
}

/* ---------------- SİPARİŞ TAMAMLA ---------------- */

if ($islem==='siparis_tamamla') {
    if (empty($_SESSION['kullanici'])) {
        $mesaj='Sipariş vermek için giriş yapmalısınız.';
        $mesajTipi='error'; $sekme='giris';
    } elseif (empty($_SESSION['sepet'])) {
        $mesaj='Sepetiniz boş.';
        $mesajTipi='error'; $sekme='sepet';
    } else {
        $musteri=guvenli($_POST['musteri']??'');
        $il=guvenli($_POST['il']??'');
        $ilce=guvenli($_POST['ilce']??'');
        $adres=guvenli($_POST['adres']??'');
        $odeme=guvenli($_POST['odeme_tipi']??'');
        $email=$_SESSION['kullanici'];

        if ($odeme==='Kredi Kartı Online') {
            $kartAd=guvenli($_POST['kart_ad']??'');
            $kartNo=preg_replace('/\D/','',$_POST['kart_no']??'');
            $kartSKT=guvenli($_POST['kart_skt']??'');
            $kartCVV=preg_replace('/\D/','',$_POST['kart_cvv']??'');

            if (!$kartAd || strlen($kartNo)<13 ||
                strlen($kartNo)>19 || !$kartSKT ||
                strlen($kartCVV)<3 || strlen($kartCVV)>4) {
                $mesaj='Kart bilgilerini kontrol edin.';
                $mesajTipi='error';
                $sekme='sepet';
            }
        }

        if ($mesajTipi!=='error') {
            $toplam=0;
            $detay=[];
            $kalemler=[];

            foreach ($_SESSION['sepet'] as $item) {
                $u=$_SESSION['urunler'][$item['urun_id']];
                $kalemler[]=['urun_id'=>$item['urun_id'],'adet'=>$item['adet']];
                $birimFiyat = $u['fiyat'] + ($item['ek_fiyat'] ?? 0);
                $detay[]=$item['adet'].'x '.$u['ad'].' ('.$item['boyut'].', '.$item['secenek1'].', '.$item['secenek2'].')';
                $toplam += $birimFiyat * $item['adet'];
                $_SESSION['urunler'][$item['urun_id']]['stok'] -= $item['adet'];
            }

            $indirim=empty($_SESSION['indirim_kullananlar'][$email])
                ? $toplam*0.05 : 0;
            $toplam-=$indirim;

            $kargo=$toplam>=500?0:40;
            $kapida=(strpos($odeme,'Kapıda')!==false)?30:0;
            $toplam+=$kargo+$kapida;

            $sid=time().rand(10,99);

            $_SESSION['satislar'][$sid]=[
                'id'=>$sid,
                'musteri'=>$musteri,
                'email'=>$email,
                'teslimat'=>"$il / $ilce - $adres",
                'odeme'=>$odeme,
                'detay'=>implode(' | ',$detay),
                'kargo'=>$kargo==0?'Ücretsiz':'40 TL',
                'tutar'=>$toplam,
                'kampanya'=>$indirim>0?'%5 İndirim Uygulandı':'',
                'tarih'=>date('d.m.Y H:i'),
                'durum'=>'Hazırlanıyor',
                'kalemler'=>$kalemler,
                'gecmis'=>[[date('d.m.Y H:i'),'Hazırlanıyor']]
            ];

            $_SESSION['indirim_kullananlar'][$email]=true;
            $_SESSION['sepet']=[];

            $mesaj='Siparişiniz alındı! Toplam: '.number_format($toplam,2).' TL';
            $sekme='siparislerim';
        }
    }
}

/* ---------------- GEÇMİŞ SİPARİŞ YÖNETİMİ ---------------- */

$siparisDurumlari=['Hazırlanıyor','Kargoda','Teslim Edildi','İptal Edildi'];
$topluDurumlari=['Onay Bekliyor','Onaylandı','Hazırlanıyor','Tamamlandı','Reddedildi'];

/* Sipariş iptal/silme sırasında ürün stoklarını geri yükler */
function siparisStokIade($s) {
    foreach (($s['kalemler'] ?? []) as $k) {
        if (isset($_SESSION['urunler'][$k['urun_id']])) $_SESSION['urunler'][$k['urun_id']]['stok'] += $k['adet'];
    }
}

if (in_array($islem, ['siparis_durum','siparis_sil','toplu_durum'], true)) {
    $sekme='siparisler';
    if (empty($_SESSION['kullanici'])) {
        $mesaj='Bu işlem için giriş yapmalısınız.'; $mesajTipi='error'; $sekme='giris';
    } elseif ($islem==='siparis_durum') {
        $sid=$_POST['sid']??''; $yeni=$_POST['durum']??'';
        if (isset($_SESSION['satislar'][$sid]) && in_array($yeni,$siparisDurumlari,true)) {
            $eski=$_SESSION['satislar'][$sid]['durum']??'Hazırlanıyor';
            if ($eski==='İptal Edildi') {
                $mesaj='İptal edilmiş siparişin durumu değiştirilemez.'; $mesajTipi='error';
            } elseif ($yeni!==$eski) {
                if ($yeni==='İptal Edildi') siparisStokIade($_SESSION['satislar'][$sid]);
                $_SESSION['satislar'][$sid]['durum']=$yeni;
                $_SESSION['satislar'][$sid]['gecmis'][]=[date('d.m.Y H:i'),$yeni];
                $mesaj='Sipariş #'.$sid.' durumu güncellendi: '.$yeni;
            }
        }
    } elseif ($islem==='siparis_sil') {
        $sid=$_POST['sid']??'';
        if (isset($_SESSION['satislar'][$sid])) {
            $d=$_SESSION['satislar'][$sid]['durum']??'Hazırlanıyor';
            if (in_array($d,['Hazırlanıyor','Kargoda'],true)) siparisStokIade($_SESSION['satislar'][$sid]);
            unset($_SESSION['satislar'][$sid]);
            $mesaj='Sipariş kaydı silindi.';
        }
    } elseif ($islem==='toplu_durum') {
        $rid=$_POST['rid']??''; $yeni=$_POST['durum']??'';
        if (isset($_SESSION['toplu_siparisler'][$rid]) && in_array($yeni,$topluDurumlari,true)) {
            $_SESSION['toplu_siparisler'][$rid]['durum']=$yeni;
            $mesaj='Toplu sipariş '.$rid.' durumu güncellendi: '.$yeni;
        }
    }
}

/* Müşteri kendi siparişini, hazırlanma aşamasındayken iptal edebilir */
if ($islem==='siparis_iptal_musteri') {
    $sekme='siparislerim';
    $sid=$_POST['sid']??'';
    if (!empty($_SESSION['kullanici']) && isset($_SESSION['satislar'][$sid])
        && ($_SESSION['satislar'][$sid]['email']??'')===$_SESSION['kullanici']
        && ($_SESSION['satislar'][$sid]['durum']??'Hazırlanıyor')==='Hazırlanıyor') {
        siparisStokIade($_SESSION['satislar'][$sid]);
        $_SESSION['satislar'][$sid]['durum']='İptal Edildi';
        $_SESSION['satislar'][$sid]['gecmis'][]=[date('d.m.Y H:i'),'İptal Edildi'];
        $mesaj='Siparişiniz iptal edildi.';
    } else {
        $mesaj='Bu sipariş iptal edilemez.'; $mesajTipi='error';
    }
}

/* Yönetim sayfalarının ortak sekme çubuğu */
function adminSekmeler($aktif) {
    $sek = [
        ['stok','📊',dil('Stok Takibi','Stock Tracking')],
        ['siparisler','📋',dil('Geçmiş Siparişler','Order History')],
        ['satislar','💰',dil('Satış Raporu','Sales Report')],
        ['yonetim','⚙️',dil('Ürün Yönetimi','Product Management')],
    ];
    $h = '<div class="adm-tabs">';
    foreach ($sek as $s) $h .= '<a class="'.($aktif===$s[0]?'on':'').'" href="?sekme='.$s[0].'">'.$s[1].' '.$s[2].'</a>';
    return $h.'</div>';
}

function durumEtiket($d) {
    global $lang;
    $en=['Hazırlanıyor'=>'Preparing','Kargoda'=>'Shipped','Teslim Edildi'=>'Delivered','İptal Edildi'=>'Cancelled',
         'Onay Bekliyor'=>'Awaiting Approval','Onaylandı'=>'Approved','Tamamlandı'=>'Completed','Reddedildi'=>'Rejected'];
    return $lang==='en' ? ($en[$d] ?? $d) : $d;
}
function durumSinif($d) {
    $m=['Hazırlanıyor'=>'st-hazir','Kargoda'=>'st-kargo','Teslim Edildi'=>'st-teslim','İptal Edildi'=>'st-iptal',
        'Onay Bekliyor'=>'st-hazir','Onaylandı'=>'st-kargo','Tamamlandı'=>'st-teslim','Reddedildi'=>'st-iptal'];
    return $m[$d] ?? 'st-hazir';
}

/* ---------------- TOPLU SİPARİŞ ---------------- */

if ($islem==='toplu_siparis_olustur') {
    if (empty($_SESSION['kullanici'])) {
        $mesaj='Toplu sipariş için giriş yapmalısınız.';
        $mesajTipi='error'; $sekme='giris';
    } else {
        $musteri=guvenli($_POST['musteri']??'');
        $telefon=guvenli($_POST['telefon']??'');
        $urun_id=intval($_POST['urun_id']??0);
        $adet=intval($_POST['adet']??0);
        $tarih=guvenli($_POST['tarih']??'');
        $saat=guvenli($_POST['saat']??'');
        $notlar=guvenli($_POST['notlar']??'');

        if (isset($_SESSION['urunler'][$urun_id]) &&
            $adet>=10 && $musteri && $telefon && $tarih && $saat) {

            $u=$_SESSION['urunler'][$urun_id];
            $normal=$u['fiyat']*$adet;
            $indirimli=$normal*0.8;
            $rid='TPL-'.rand(1000,9999);

            $_SESSION['toplu_siparisler'][$rid]=[
                'id'=>$rid,'musteri'=>$musteri,'telefon'=>$telefon,
                'urun_ad'=>$u['ad'],'adet'=>$adet,
                'tarih_saat'=>"$tarih - $saat",
                'normal_tutar'=>$normal,'indirimli_tutar'=>$indirimli,
                'notlar'=>$notlar,'durum'=>'Onay Bekliyor'
            ];

            $mesaj='Toplu sipariş talebiniz oluşturuldu. %20 indirim uygulandı.';
        } else {
            $mesaj='Lütfen alanları doldurun ve en az 10 adet seçin.';
            $mesajTipi='error';
        }
        $sekme='toplu';
    }
}

/* ---------------- ÜRÜN YÖNETİMİ ---------------- */

if ($islem==='urun_ekle') {
    $ad=guvenli($_POST['ad']??'');
    $kategori=guvenli($_POST['kategori']??'');
    $fiyat=floatval($_POST['fiyat']??0);
    $stok=intval($_POST['stok']??0);
    $aciklama=guvenli($_POST['aciklama']??'');

    if ($ad && $fiyat>0) {
        $id=empty($_SESSION['urunler'])?1:max(array_keys($_SESSION['urunler']))+1;
        $_SESSION['urunler'][$id]=[
            'id'=>$id,'ad'=>$ad,'kategori'=>$kategori,
            'fiyat'=>$fiyat,'stok'=>$stok,
            'aciklama'=>$aciklama,
            'hazirlanis'=>tarifOlustur($ad, $kategori),
            'gorsel'=>urunGorselUret($ad, $kategori),
            'tat'=>'Dengeli','sertlik'=>'Yumuşak','sicaklik'=>'Sıcak'
        ];

        $mesaj='Yeni ürün başarıyla eklendi.';
        $sekme='yonetim';
    }
}

if ($islem==='urun_sil') {
    $id=intval($_POST['id']??0);
    if (isset($_SESSION['urunler'][$id])) {
        unset($_SESSION['urunler'][$id]);
        $mesaj='Ürün sistemden silindi.';
    }
    $sekme='yonetim';
}

/* ---------------- İSTATİSTİKLER ---------------- */

$toplam_urun=count($_SESSION['urunler']);
$sepet_adet=0;
foreach ($_SESSION['sepet'] as $i) $sepet_adet+=$i['adet'];

$toplam_ciro=0;
foreach ($_SESSION['satislar'] as $s) { if (($s['durum'] ?? '') !== 'İptal Edildi') $toplam_ciro+=$s['tutar']; }

$girisYapildi=!empty($_SESSION['kullanici']);
$aktifKullanici=$girisYapildi
    ? $_SESSION['kullanicilar'][$_SESSION['kullanici']]['ad'] : '';

/* Sipariş sayfaları için giriş gerekir */
if (!$girisYapildi && in_array($sekme, ['siparisler','siparislerim'], true)) {
    $mesaj='Bu sayfa için giriş yapmalısınız.'; $mesajTipi='error'; $sekme='giris';
}

/* Arayüz tercihleri (çerezden) */
$temalar = [
    'kahve'=>['Klasik Kahve','☕'], 'orman'=>['Orman Yeşili','🌲'],
    'okyanus'=>['Okyanus','🌊'], 'gul'=>['Gül Kurusu','🌸'], 'gece'=>['Gece Mavisi','🌙'],
    'mor'=>['Mor','🍇'], 'bordo'=>['Bordo','🍷'],
    'lavanta'=>['Açık Lavanta','💜'], 'nane'=>['Açık Nane','🍃'], 'seftali'=>['Açık Şeftali','🍑'], 'bulut'=>['Açık Gökyüzü','☁️']
];
$gorunumler = [
    'izgara'=>['Izgara','▦'], 'liste'=>['Liste','☰'], 'kompakt'=>['Kompakt','▤']
];
$aktifTema = $_COOKIE['tema'] ?? 'kahve';
if (!isset($temalar[$aktifTema])) $aktifTema = 'kahve';
$aktifGorunum = $_COOKIE['gorunum'] ?? 'izgara';
if (!isset($gorunumler[$aktifGorunum])) $aktifGorunum = 'izgara';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= t('KahveTat') ?> | Premium Coffee & Dessert</title>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%238c582f'/%3E%3Cg fill='none' stroke='white' stroke-width='4.4' stroke-linecap='round' stroke-linejoin='round' transform='translate(0 2) scale(2)'%3E%3Cpath d='M6 12h17v6.5A6.5 6.5 0 0 1 16.5 25h-4A6.5 6.5 0 0 1 6 18.5V12z'/%3E%3Cpath d='M23 14h2.2a3 3 0 0 1 0 6H23'/%3E%3C/g%3E%3C/svg%3E">

<style>
:root {
    --bg: #f5efe6;
    --card: #ffffff;
    --text: #211812;
    --muted: #6b584c;
    --accent: #8c582f;
    --green: #374e20;
    --green-hover: #263814;
    --header: #241810;
    --border: #dfd0c2;
    --shadow: 0 12px 35px rgba(33,24,18,0.08);
    --topbar: linear-gradient(100deg,#293d1b 0%,#607d3e 48%,#31491f 100%);
    --hdr-grad:
      radial-gradient(ellipse at 12% 0%,rgba(190,145,94,.20),transparent 38%),
      radial-gradient(ellipse at 92% 100%,rgba(91,119,57,.20),transparent 34%),
      linear-gradient(115deg,#1b120d 0%,#302016 48%,#21170f 100%);
    --sale: #d63c2f;
}
/* ARAYÜZ TEMALARI */
body[data-tema="orman"] {
    --bg:#eef3ea;--border:#cfdcc8;--accent:#3d7a45;--green:#2f6b3a;--green-hover:#1f4d28;
    --topbar:linear-gradient(100deg,#1d4a27 0%,#4b8f55 50%,#245c30 100%);
    --hdr-grad:radial-gradient(ellipse at 12% 0%,rgba(120,190,120,.22),transparent 40%),linear-gradient(115deg,#0f2616 0%,#1d3d27 50%,#12301b 100%);
}
body[data-tema="okyanus"] {
    --bg:#eaf2f7;--border:#c9dbe6;--accent:#2a7fae;--green:#1f6f9f;--green-hover:#165479;
    --topbar:linear-gradient(100deg,#14506f 0%,#3a90bf 50%,#1a5f86 100%);
    --hdr-grad:radial-gradient(ellipse at 12% 0%,rgba(100,180,230,.22),transparent 40%),linear-gradient(115deg,#0b2233 0%,#16405c 50%,#0e2d44 100%);
}
body[data-tema="gul"] {
    --bg:#faf0f2;--border:#ecd2d8;--accent:#b4486a;--green:#a63d5f;--green-hover:#822c48;
    --topbar:linear-gradient(100deg,#8a2f4c 0%,#d0728f 50%,#9a3454 100%);
    --hdr-grad:radial-gradient(ellipse at 12% 0%,rgba(240,150,175,.22),transparent 40%),linear-gradient(115deg,#2d1119 0%,#4a1f2e 50%,#35151f 100%);
}
body[data-tema="gece"] {
    --bg:#0e1420;--card:#172033;--text:#e8eefc;--muted:#97a6c4;--border:#27344f;--accent:#7fa8ff;
    --green:#3f6fe0;--green-hover:#2f56b8;--shadow:0 12px 35px rgba(0,0,0,.4);
    --topbar:linear-gradient(100deg,#1b2d63 0%,#3f6fe0 50%,#22388a 100%);
    --hdr-grad:linear-gradient(115deg,#070b14 0%,#111b30 50%,#0a1020 100%);
}
body[data-tema="mor"] {
    --bg:#f3eefa;--border:#d9cbee;--accent:#7b43b8;--green:#6a35a8;--green-hover:#4f2582;
    --topbar:linear-gradient(100deg,#4b1f80 0%,#9055d0 50%,#5a2a94 100%);
    --hdr-grad:radial-gradient(ellipse at 12% 0%,rgba(190,140,240,.24),transparent 40%),linear-gradient(115deg,#1d0f33 0%,#3a1c63 50%,#27134a 100%);
}
body[data-tema="bordo"] {
    --bg:#f8eeee;--border:#e3c9c9;--accent:#8e1f2f;--green:#7a1828;--green-hover:#59101c;
    --topbar:linear-gradient(100deg,#5c0f1c 0%,#a42b3d 50%,#6a1423 100%);
    --hdr-grad:radial-gradient(ellipse at 12% 0%,rgba(220,110,125,.22),transparent 40%),linear-gradient(115deg,#26080d 0%,#4c1019 50%,#32090f 100%);
}
/* AÇIK RENKLİ TEMALAR: çok açık sayfa zemini, orta tonlu üst alan */
body[data-tema="lavanta"] {
    --bg:#faf7ff;--card:#ffffff;--border:#e4dbf5;--muted:#6f6488;--accent:#8a6bd0;--green:#8467c9;--green-hover:#6a4fb0;
    --topbar:linear-gradient(100deg,#8467c9 0%,#b9a2ec 50%,#8f74d2 100%);
    --hdr-grad:linear-gradient(115deg,#7a5fc0 0%,#9a82da 50%,#8a6fcf 100%);
    --shadow:0 12px 35px rgba(110,80,190,.10);
}
body[data-tema="nane"] {
    --bg:#f3fbf6;--card:#ffffff;--border:#d3ecdc;--muted:#5d7a68;--accent:#3fa56b;--green:#3a9d68;--green-hover:#2b7d51;
    --topbar:linear-gradient(100deg,#3a9d68 0%,#79cfa0 50%,#43a874 100%);
    --hdr-grad:linear-gradient(115deg,#359060 0%,#4fb27f 50%,#3f9e6d 100%);
    --shadow:0 12px 35px rgba(50,150,100,.10);
}
body[data-tema="seftali"] {
    --bg:#fff7f1;--card:#ffffff;--border:#f3dccb;--muted:#80685a;--accent:#e0804a;--green:#d9763f;--green-hover:#b85e2d;
    --topbar:linear-gradient(100deg,#d9763f 0%,#f2a574 50%,#de7f4b 100%);
    --hdr-grad:linear-gradient(115deg,#d5733c 0%,#ec9763 50%,#dc7d49 100%);
    --shadow:0 12px 35px rgba(220,120,70,.12);
}
body[data-tema="bulut"] {
    --bg:#f4f9fe;--card:#ffffff;--border:#d6e6f5;--muted:#5f7790;--accent:#4a97d6;--green:#3f8ccb;--green-hover:#2e70a8;
    --topbar:linear-gradient(100deg,#3f8ccb 0%,#85bdeb 50%,#4a96d4 100%);
    --hdr-grad:linear-gradient(115deg,#3a84c2 0%,#62a5de 50%,#4a93d0 100%);
    --shadow:0 12px 35px rgba(70,140,210,.10);
}
body.dark-mode[data-tema="mor"] {--accent:#c29cf0;--green:#8a52cf;--green-hover:#6e3cad}
body.dark-mode[data-tema="bordo"] {--accent:#e58a98;--green:#a82a3d;--green-hover:#861f30}
body.dark-mode[data-tema="lavanta"] {--accent:#b9a2ec;--green:#8f74d2;--green-hover:#765bbb}
body.dark-mode[data-tema="nane"] {--accent:#8fdcb0;--green:#43a874;--green-hover:#348a5d}
body.dark-mode[data-tema="seftali"] {--accent:#f2a574;--green:#de7f4b;--green-hover:#bf6636}
body.dark-mode[data-tema="bulut"] {--accent:#85bdeb;--green:#4a96d4;--green-hover:#3a7cb5}
body.dark-mode[data-tema="orman"] {--accent:#8ac98f;--green:#4a9a56;--green-hover:#387a43}
body.dark-mode[data-tema="okyanus"] {--accent:#7cc3ea;--green:#3a90bf;--green-hover:#2b74a0}
body.dark-mode[data-tema="gul"] {--accent:#e79ab3;--green:#c95a80;--green-hover:#a24465}
body.dark-mode {
    --bg: #100b08;
    --card: #1c1410;
    --text: #f3ece4;
    --muted: #a69485;
    --accent: #d4945a;
    --green: #537532;
    --green-hover: #3e5823;
    --header: #080503;
    --border: #33261c;
    --shadow: 0 12px 35px rgba(0,0,0,0.35);
}
* {box-sizing:border-box;margin:0;padding:0}
body {
    font-family:'Segoe UI',Arial,sans-serif;
    background:var(--bg);
    color:var(--text);
    line-height:1.6;
    transition:.3s;
}
a {color:inherit}
button,input,select,textarea {font:inherit}

/* ÜCRETSİZ KARGO GÖZ ALICI BANDI */
.top-bar {
    background:var(--topbar);
    color:#fff;text-align:center;padding:12px 14px;
    font-weight:900;font-size:16px;letter-spacing:.8px;
    font-style:italic;box-shadow:inset 0 -3px 8px rgba(0,0,0,0.25);
    text-shadow:0 1px 2px rgba(0,0,0,0.4);
}

/* PREMIUM ÜST ALAN: DAHA FERAH, KATMANLI VE DENGELİ */
.main-header {
    background:var(--hdr-grad);
    color:#fff;position:sticky;top:0;z-index:300;
    border-bottom:1px solid rgba(224,190,148,.25);
    box-shadow:0 12px 32px rgba(0,0,0,.32),inset 0 1px rgba(255,255,255,.06);
}
.header-inner {
    max-width:1700px;margin:auto;padding:18px 30px;
    display:flex;align-items:center;justify-content:space-between;
    gap:24px;flex-wrap:wrap;
}
.logo-box {
    display:flex;align-items:center;gap:14px;
    text-decoration:none;background:linear-gradient(145deg,rgba(255,255,255,.13),rgba(255,255,255,.045));
    border:1px solid rgba(232,202,166,.38);
    border-radius:20px;padding:12px 20px;
    box-shadow:0 8px 24px rgba(0,0,0,.20),inset 0 1px rgba(255,255,255,.13);
    transition:.3s;flex-shrink:0;
}
.logo-box:hover {transform:scale(1.02);background:rgba(255,255,255,0.16)}
.logo-icon {
    width:58px;height:58px;border-radius:16px;
    display:grid;place-items:center;position:relative;overflow:hidden;
    background:linear-gradient(145deg,#f1d9b8 0%,#c99a68 48%,#8b5b3b 100%);
    color:#24170f;box-shadow:0 6px 16px rgba(0,0,0,.28);
    border:1px solid rgba(255,255,255,.38);
}
.logo-icon span {font:900 25px/1 Georgia,serif;letter-spacing:-3px;transform:translateX(-1px);text-shadow:1px 1px 0 rgba(255,255,255,.25)}
.logo-icon:after {content:"";position:absolute;inset:6px;border:1px solid rgba(49,30,18,.42);border-radius:11px;pointer-events:none}

.logo-title {font:900 32px Georgia,serif;color:#fff;line-height:1.1;letter-spacing:.5px}
.logo-sub {font-size:11px;color:#e3d1be;letter-spacing:1.5px;font-weight:700}

.header-actions {
    display:flex;align-items:center;gap:9px 10px;flex-wrap:wrap;
    justify-content:flex-end;flex:1;min-width:0;
}
.header-btn {
    display:inline-flex;align-items:center;justify-content:center;
    gap:8px;padding:12px 16px;border-radius:12px;
    color:#fff;text-decoration:none;font-weight:800;
    font-size:13px;background:linear-gradient(145deg,rgba(255,255,255,.105),rgba(255,255,255,.045));
    border:1px solid rgba(255,255,255,.17);
    cursor:pointer;transition:.22s;white-space:nowrap;
    box-shadow:0 4px 11px rgba(0,0,0,.14),inset 0 1px rgba(255,255,255,.07);
}
.header-btn:hover {background:linear-gradient(135deg,#627d3d,#405b29);border-color:rgba(226,205,166,.48);transform:translateY(-2px);box-shadow:0 8px 18px rgba(0,0,0,.25)}
.nav-dropdown{position:relative;display:inline-flex;align-items:center}
.nav-dropdown>summary{list-style:none;user-select:none}
.nav-dropdown>summary::-webkit-details-marker{display:none}
.nav-dropdown>summary:after{content:'⌄';font-size:13px;margin-left:2px;color:#e4c49e}
.dropdown-panel{
    position:absolute;top:calc(100% + 12px);left:0;min-width:245px;max-height: min(70vh,520px);overflow:auto;
    padding:9px;background:linear-gradient(145deg,#38271c,#211710);border:1px solid rgba(220,185,143,.32);
    border-radius:15px;box-shadow:0 18px 38px rgba(0,0,0,.42);z-index:500;
    opacity:0;visibility:hidden;transform:translateY(8px);transition:.18s;
}
.nav-dropdown:hover .dropdown-panel,.nav-dropdown:focus-within .dropdown-panel,.nav-dropdown[open] .dropdown-panel{opacity:1;visibility:visible;transform:translateY(0)}
.dropdown-panel a{display:flex;align-items:center;gap:9px;padding:11px 13px;border-radius:9px;color:#f7eadb;text-decoration:none;font-weight:750;font-size:13px;transition:.18s}
.dropdown-panel a:hover{background:rgba(150,177,105,.24);color:#fff;padding-left:17px}
.dropdown-panel .dropdown-divider{height:1px;background:rgba(255,255,255,.12);margin:6px 4px}
.dropdown-heading{padding:8px 13px 5px;color:#d9b88f;font-size:11px;font-weight:900;letter-spacing:1px;text-transform:uppercase}
.cart-count {
    background:#e67e22;color:white;border-radius:20px;
    padding:2px 8px;font-size:12px;font-weight:900;
}
.search-box {
    display:flex;align-items:center;gap:6px;
    border:1px solid rgba(255,255,255,0.28);
    border-radius:30px;padding:5px 12px;background:rgba(0,0,0,0.2);
}
.search-box input {
    width:130px;border:0!important;background:transparent!important;
    color:#fff!important;outline:none;padding:5px!important;
}
.search-box input::placeholder {color:#e3d1be}
.history {display:flex;gap:9px;align-items:center;padding:7px 9px;border-radius:18px;background:rgba(255,255,255,.045);border:1px solid rgba(255,255,255,.10);box-shadow:inset 0 1px rgba(255,255,255,.06)}
.hist-btn {
    width:42px;height:42px;border-radius:14px;
    border:1px solid rgba(225,193,154,.25);
    background:linear-gradient(145deg,rgba(255,255,255,.15),rgba(255,255,255,.055));color:white;
    cursor:pointer;font-size:20px;transition:.2s;
    display:grid;place-items:center;text-decoration:none;
}
.hist-btn:hover {background:linear-gradient(135deg,#627d3d,#405b29);transform:translateY(-2px);box-shadow:0 5px 12px rgba(0,0,0,.22)}

.sub-nav-bar {
    background:var(--card);border-bottom:1px solid var(--border);
    display:flex;justify-content:center;gap:12px;flex-wrap:wrap;
    padding:16px 24px;box-shadow:0 4px 12px rgba(0,0,0,0.04);
}
.sub-nav-btn {
    padding:11px 22px;border-radius:30px;
    text-decoration:none;color:var(--text);
    font-weight:800;font-size:15px;
    border:1px solid var(--border);background:var(--bg);
    transition:.25s;
}
.sub-nav-btn:hover,.sub-nav-btn.active {
    background:var(--green);color:#fff;border-color:var(--green);
    transform:translateY(-2px);box-shadow:0 4px 12px rgba(55,78,32,0.3);
}
.container {max-width:1550px;margin:auto;padding:28px}

.hero {
    max-width:1500px;margin:25px auto 40px;
    min-height:480px;border-radius:24px;
    background:linear-gradient(135deg,rgba(16,11,8,0.85),rgba(16,11,8,0.25)),
    url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=1600') center/cover;
    display:flex;align-items:center;padding:60px;
    color:#fff;box-shadow:var(--shadow);
}
.hero-content {max-width:750px}
.hero h1 {font:900 68px Georgia,serif;margin-bottom:14px;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
.hero p {font-size:20px;margin-bottom:18px;text-shadow:0 1px 2px rgba(0,0,0,0.5)}
.hero-btn {
    display:inline-block;background:var(--green);color:white;
    padding:16px 32px;border-radius:12px;text-decoration:none;
    font-weight:900;font-size:16px;margin-top:14px;transition:.25s;
    box-shadow:0 4px 15px rgba(55,78,32,0.4);
}
.hero-btn:hover {background:var(--green-hover);transform:translateY(-3px)}

.stats {
    display:grid;grid-template-columns:repeat(3,1fr);
    gap:20px;margin-bottom:40px;
}
.stat-card {
    background:var(--card);border:1px solid var(--border);
    padding:28px;border-radius:20px;text-align:center;
    box-shadow:var(--shadow);transition:.3s;
}
.stat-card:hover {transform:translateY(-3px);border-color:var(--green)}
.stat-card h3 {font-size:36px;color:var(--green);font-weight:900}
.stat-card p {color:var(--muted);font-weight:750;font-size:16px;margin-top:5px}

.menu-grid {
    display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));
    gap:24px;
}
.product-card {
    background:var(--card);border:1px solid var(--border);
    border-radius:20px;overflow:hidden;box-shadow:var(--shadow);
    display:flex;flex-direction:column;transition:.3s;
}
.product-card:hover {
    transform:translateY(-6px);
    border-color:var(--green);
    box-shadow:0 16px 35px rgba(0,0,0,0.15);
}
.product-card img {width:100%;height:220px;object-fit:cover;background:#eee}
.product-body {padding:20px;display:flex;flex-direction:column;flex:1}
.product-body .cat {
    color:var(--green);font-weight:900;font-size:12px;
    text-transform:uppercase;letter-spacing:.8px;
}
.product-body h3 {font-size:19px;margin:8px 0;font-weight:800;min-height:52px;line-height:1.35}
.product-body .price {
    font-size:23px;color:var(--accent);
    font-weight:900;margin:6px 0 12px;
}
.product-body p {font-size:14px;color:var(--muted);margin-bottom:14px;min-height:42px;line-height:1.5}
.product-body form {display:flex;flex-direction:column;flex:1}
.product-body form .btn {margin-top:auto}
.product-body form .badge {align-self:flex-start}
.product-body select {
    width:100%;padding:10px;margin-bottom:10px;
    border-radius:9px;border:1px solid var(--border);
    background:var(--bg);color:var(--text);font-weight:600;
}
.btn {
    display:inline-flex;align-items:center;justify-content:center;
    padding:12px 18px;border-radius:10px;border:0;
    cursor:pointer;text-decoration:none;font-weight:900;
    transition:.25s;
}
.btn-primary {background:var(--green);color:white;width:100%}
.btn-primary:hover {background:var(--green-hover);box-shadow:0 4px 12px rgba(55,78,32,0.3)}
.btn-danger {background:#b33939;color:white}
.btn-danger:hover {background:#8e2a2a}

.badge {
    display:inline-block;padding:5px 10px;border-radius:8px;
    font-size:12px;font-weight:900;margin-bottom:12px;
}
.badge-ok {background:#e7f2ed;color:#2c5234}
.badge-out {background:#fdeaea;color:#b33939}

.form-card {
    background:var(--card);border:1px solid var(--border);
    border-radius:20px;padding:32px;max-width:720px;
    margin:25px auto;box-shadow:var(--shadow);
}
.form-group {margin-bottom:18px}
label {display:block;font-weight:800;margin-bottom:8px;font-size:15px}
input,select,textarea {
    width:100%;padding:13px 16px;
    border:1px solid var(--border);border-radius:10px;
    background:var(--bg);color:var(--text);font-weight:600;
}
input:focus,select:focus,textarea:focus {outline:2px solid var(--green)}

table {
    width:100%;border-collapse:separate;border-spacing:0;background:var(--card);
    border:1px solid var(--border);border-radius:15px;
    overflow:hidden;margin:14px 0 24px;box-shadow:var(--shadow);
}
th,td {padding:14px 16px;text-align:left;vertical-align:middle;border-bottom:1px solid var(--border);font-size:14px;overflow-wrap:anywhere}
th {background:var(--bg);font-weight:900;white-space:nowrap}
tbody tr:last-child td, table tr:last-child td {border-bottom:0}
td .btn {white-space:nowrap}

.alert {
    padding:16px 20px;border-radius:12px;margin-bottom:24px;
    background:#e7f2ed;color:#23472f;font-weight:800;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}
.alert.error {background:#fdeaea;color:#8a2828}

/* ÜRÜN ÜZERİ İNDİRİM */
.product-image-wrap .sale-badge,.sale-badge-flat {
    background:var(--sale);color:#fff;font-weight:900;font-size:13px;
    padding:6px 11px;border-radius:999px;box-shadow:0 4px 12px rgba(214,60,47,.4);letter-spacing:.3px;
}
.product-image-wrap .sale-badge {position:absolute;top:12px;left:12px;z-index:2}
.sale-badge-flat {display:inline-block;margin-left:8px;vertical-align:middle}
.price-old {font-size:15px;color:var(--muted);text-decoration:line-through;font-weight:700;margin-left:8px}
.perk-list {display:flex;flex-wrap:wrap;gap:6px;margin:0 0 12px}
.perk-list span {font-size:11px;font-weight:800;padding:4px 8px;border-radius:7px;background:var(--bg);border:1px dashed var(--green);color:var(--green)}

/* GÖRÜNÜM SEÇENEKLERİ (menü sayfası) */
body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) {grid-template-columns:1fr}
body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) .product-card {flex-direction:row}
body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) .product-image-wrap {flex:0 0 280px}
body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) .product-image-wrap>img {height:100%;min-height:240px}
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) {grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:14px}
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) .product-image-wrap>img {height:140px}
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) .product-body {padding:13px}
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) .product-body h3 {font-size:15px;min-height:42px}
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) .product-body p,
body[data-gorunum="kompakt"] .menu-grid:not(.recipe-grid) .perk-list {display:none}
@media(max-width:700px){
    body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) .product-card {flex-direction:column}
    body[data-gorunum="liste"] .menu-grid:not(.recipe-grid) .product-image-wrap {flex-basis:auto}
}
.recipe-card .product-body {padding:22px;gap:10px}
.recipe-card .product-body h3 {min-height:48px;line-height:1.35;margin:4px 0}
.recipe-card .recipe-text {line-height:1.8;white-space:pre-line;background:var(--bg);padding:18px;border-radius:14px;font-size:14px;border:1px solid var(--border);flex:1;color:var(--text);overflow-wrap:anywhere}
.recipe-card {height:100%;min-width:0}
.recipe-grid {align-items:stretch;grid-template-columns:repeat(auto-fill,minmax(300px,1fr))}
.catalog-search-wrap {max-width:760px;margin:24px auto 28px}
.catalog-search {display:flex;gap:10px;background:var(--card);border:1px solid var(--border);padding:9px;border-radius:16px;box-shadow:var(--shadow)}
.catalog-search input {flex:1;min-width:0;border:0!important;outline:0;background:transparent!important;padding:12px 14px!important;color:var(--text)!important;font-size:15px}
.catalog-search button {border:0;border-radius:11px;padding:0 22px;background:var(--green);color:#fff;font-weight:850;cursor:pointer}
.catalog-search .search-clear {width:40px;min-width:40px;height:40px;padding:0;border-radius:50%;background:#eee;color:#4a4038;font-size:25px;line-height:1;display:grid;place-items:center}
.catalog-search .search-clear:hover {background:#d9c5ad;color:#24170f}
.search-box .search-clear {background:transparent;border:0;color:#fff;font-size:22px;line-height:1;cursor:pointer;padding:0 3px}
.search-box .search-clear:hover {color:#ffd9ad}
.catalog-search button[type="submit"] {min-height:42px;white-space:nowrap}
/* Tüm sekmelerde ortak, taşmayan tablo düzeni */
table {width:100%;max-width:100%;border-collapse:collapse;table-layout:fixed}
table th,table td {padding:12px 10px;vertical-align:middle;text-align:left;overflow-wrap:anywhere;word-break:normal;line-height:1.5}
table th {font-weight:850}
table tr {border-bottom:1px solid var(--border)}
table img {max-width:100%;height:auto}
@media(max-width:760px){
    /* Her sekmedeki tablolar aynı genişlik ve kaydırma davranışını kullanır. */
    table {display:block;width:100%;max-width:100%;min-width:0;overflow-x:auto;overflow-y:hidden;-webkit-overflow-scrolling:touch;white-space:normal}
    table thead,table tbody {width:100%}
    table th,table td {min-width:125px;padding:11px 10px;font-size:13px}
    table th:first-child,table td:first-child {min-width:90px}
    .catalog-search {gap:6px;padding:7px}
    .catalog-search input {padding:10px 8px!important}
    .catalog-search button[type="submit"] {padding:0 12px}
}

.product-image-wrap {position:relative;overflow:hidden}
.product-image-wrap>img {display:block;width:100%;height:220px;object-fit:cover}
.equipment-brand-stamp {position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);padding:8px 13px;border-radius:9px;background:rgba(35,23,16,.88);border:1px solid rgba(239,211,176,.9);color:#f5dfc2;font:900 18px Georgia,serif;letter-spacing:1px;box-shadow:0 3px 12px rgba(0,0,0,.28);pointer-events:none}
.recipe-search-title {text-align:center;color:var(--muted);margin:-12px 0 4px;font-size:14px}
.home-intro {margin:28px 0;padding:22px 26px;border-radius:16px;background:var(--card);border:1px solid var(--border);box-shadow:var(--shadow);color:var(--muted);font-weight:700;text-align:center}

/* WHATSAPP FLOAT */
.whatsapp-float {
    position:fixed;bottom:28px;right:28px;
    width:65px;height:65px;border-radius:50%;
    background:#25d366;color:white;text-decoration:none;
    display:grid;place-items:center;font-size:34px;
    box-shadow:0 6px 25px rgba(37,211,102,0.5);z-index:999;
    transition:.3s;
}
.whatsapp-float:hover {transform:scale(1.1)}

/* SADE, MARKA ODAKLI FOOTER */
.site-footer {background:var(--header);color:#e3d1be;padding:34px 26px 20px;margin-top:70px;border-top:3px solid #b8895d}
.footer-contact-wrap {max-width:1450px;margin:0 auto 24px;display:grid;grid-template-columns:minmax(260px,1.5fr) minmax(220px,1fr);gap:34px;align-items:start}
.footer-brand {display:flex;align-items:center;gap:15px;margin-bottom:18px}
.footer-brand-mark {width:54px;height:54px;border-radius:17px;display:grid;place-items:center;background:linear-gradient(145deg,#f0d4a8,#a96f43);color:#2a1a10;font:900 20px Georgia,serif;box-shadow:0 7px 18px rgba(0,0,0,.2);letter-spacing:-1px}
.footer-brand strong {font:900 25px Georgia,serif;color:#fff;letter-spacing:.2px}
.footer-brand p {margin-top:5px;color:#bca997;font-size:13px;line-height:1.6}
.footer-contact-details {display:grid;gap:10px;color:#d0bda9;font-size:13px;line-height:1.7}
.footer-contact-details p {margin:0}
.footer-contact-details strong {color:#fff}
.footer-contact-side h4 {font-size:16px;color:#fff;margin:4px 0 12px}
.footer-contact-side p {font-size:13px;color:#bca997;line-height:1.8;margin:0 0 9px}
.footer-contact-side a {color:#e5c49e;text-decoration:none;font-weight:800}
.footer-contact-side a:hover {color:#fff}
.footer-bottom {max-width:1450px;margin:0 auto;padding-top:17px;border-top:1px solid rgba(255,255,255,.12);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;font-size:13px;color:#bca997}
.footer-bottom a {color:#e5c49e;text-decoration:none;font-weight:800}
.footer-bottom a:hover {color:#fff}
@media(max-width:700px){.footer-contact-wrap{grid-template-columns:1fr;gap:22px}.site-footer{padding:28px 18px 18px}}

.pw-wrap {position:relative;display:block}
.pw-wrap input {padding-right:48px}
.pw-eye {position:absolute;right:6px;top:50%;transform:translateY(-50%);width:38px;height:38px;border:0;background:transparent;cursor:pointer;font-size:19px;line-height:1;border-radius:8px;color:var(--text);opacity:.75}
.pw-eye:hover {opacity:1;background:rgba(0,0,0,.07)}

.hidden {display:none!important}

@media(max-width:1100px) {
}
@media(max-width:900px) {
    .header-inner {flex-wrap:wrap;justify-content:center}
    .header-actions {justify-content:center}
    .dropdown-panel{left:50%;transform:translate(-50%,8px)}
    .nav-dropdown:hover .dropdown-panel,.nav-dropdown:focus-within .dropdown-panel,.nav-dropdown[open] .dropdown-panel{transform:translate(-50%,0)}
    .hero {min-height:380px;padding:30px}
    .hero h1 {font-size:46px}
}
@media(max-width:650px) {
    .stats {grid-template-columns:1fr}
    .container {padding:15px}
    .header-actions {width:100%;gap:8px;justify-content:center}
    .header-btn {font-size:12px;padding:10px 12px}
    .dropdown-panel{position:fixed;top:auto;left:50%;margin-top:6px;width:min(90vw,340px);max-height:65vh}
    .nav-dropdown:hover .dropdown-panel,.nav-dropdown:focus-within .dropdown-panel,.nav-dropdown[open] .dropdown-panel{transform:translate(-50%,0)}
    .hero h1 {font-size:38px}
    .hero p {font-size:16px}
    .menu-grid {grid-template-columns:1fr}
    table {display:block;overflow-x:auto;white-space:normal}
    th,td {min-width:110px;padding:11px 12px}
}

/* =====================================================
   MODERN ARAYÜZ 2.0
===================================================== */
:root {--ease:cubic-bezier(.22,.8,.3,1)}
html {scroll-behavior:smooth}
body {font-family:'Inter','Segoe UI',system-ui,-apple-system,sans-serif;-webkit-font-smoothing:antialiased}
.container {max-width:1400px;padding:24px}
.hide-sm {display:inline}

/* Kayan duyuru bandı */
.announce {background:var(--topbar);color:#fff;overflow:hidden;white-space:nowrap;font-size:13px;font-weight:700;padding:9px 0}
.announce-track {display:inline-flex;gap:64px;padding-left:64px;animation:marquee 38s linear infinite;will-change:transform}
.announce:hover .announce-track {animation-play-state:paused}
@keyframes marquee {to {transform:translateX(-50%)}}

/* Üst menü */
.nav {position:sticky;top:0;z-index:400;background:color-mix(in srgb,var(--card) 82%,transparent);-webkit-backdrop-filter:saturate(1.6) blur(14px);backdrop-filter:saturate(1.6) blur(14px);border-bottom:1px solid var(--border)}
.nav-inner {max-width:1400px;margin:auto;padding:12px 24px;display:flex;align-items:center;gap:16px}
.brand {display:flex;align-items:center;gap:10px;text-decoration:none;color:var(--text);flex-shrink:0}
.brand-mark {width:42px;height:42px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,var(--green),var(--accent));color:#fff;box-shadow:0 8px 20px color-mix(in srgb,var(--green) 40%,transparent);transition:transform .4s var(--ease)}
.brand:hover .brand-mark {transform:rotate(-8deg) scale(1.06)}
.brand-name {font:800 22px 'Inter','Segoe UI',system-ui,sans-serif;letter-spacing:-.03em;color:var(--text)}
.brand-name b {font-weight:800;color:var(--green)}
.footer-brand-mark {color:#2a1a10}
.nav-links {display:flex;gap:4px;margin-left:10px}
.nav-links a {white-space:nowrap;padding:9px 15px;border-radius:999px;text-decoration:none;font-weight:700;font-size:14px;color:var(--muted);transition:.2s}
.nav-links a:hover {color:var(--text);background:var(--bg)}
.nav-links a.on {background:var(--green);color:#fff}
.nav-search {margin-left:auto;flex:1;max-width:320px;display:flex;align-items:center;gap:6px;background:var(--bg);border:1px solid var(--border);border-radius:999px;padding:2px 6px 2px 14px;transition:.2s}
.nav-search:focus-within {border-color:var(--green);box-shadow:0 0 0 4px color-mix(in srgb,var(--green) 18%,transparent)}
.nav-search input {border:0;background:transparent;padding:9px 4px;width:100%;font-size:14px;font-weight:600;color:var(--text)}
.nav-search input:focus {outline:none}
.ns-clear {border:0;background:transparent;color:var(--muted);font-size:20px;cursor:pointer;padding:0 6px}
.nav-actions {display:flex;align-items:center;gap:8px}
.icon-btn {position:relative;height:42px;min-width:42px;padding:0 13px;border-radius:999px;border:1px solid var(--border);background:var(--card);color:var(--text);display:inline-flex;align-items:center;justify-content:center;gap:7px;font-weight:800;font-size:13px;cursor:pointer;text-decoration:none;transition:.2s;white-space:nowrap}
.icon-btn:hover {border-color:var(--green);transform:translateY(-1px)}
.icon-btn.primary {background:var(--green);border-color:var(--green);color:#fff}
.icon-btn.primary:hover {background:var(--green-hover)}
.cart-dot {background:var(--sale);color:#fff;border-radius:999px;font-size:11px;padding:1px 7px;font-weight:900}
.burger {display:none}
.pop {position:relative}
.pop>summary {list-style:none}
.pop>summary::-webkit-details-marker {display:none}
.pop-panel {position:absolute;right:0;top:calc(100% + 10px);width:270px;background:var(--card);border:1px solid var(--border);border-radius:20px;box-shadow:0 24px 60px rgba(0,0,0,.2);padding:14px;z-index:500;animation:popin .18s var(--ease)}
@keyframes popin {from {opacity:0;transform:translateY(-6px) scale(.98)}}
.pop-title {font-size:11px;font-weight:900;letter-spacing:1px;text-transform:uppercase;color:var(--muted);margin:4px 4px 10px}
.swatches {display:grid;grid-template-columns:repeat(6,1fr);gap:9px;margin-bottom:16px}
.sw {aspect-ratio:1;border-radius:50%;border:3px solid var(--card);background:var(--c);cursor:pointer;box-shadow:0 0 0 1px var(--border);transition:.2s}
.sw:hover {transform:scale(1.12)}
.sw.on {box-shadow:0 0 0 2.5px var(--c)}
.seg {display:flex;gap:6px;margin-bottom:12px}
.seg button {flex:1;padding:9px 4px;border-radius:12px;border:1px solid var(--border);background:var(--bg);color:var(--text);font-weight:800;font-size:12px;cursor:pointer}
.seg button.on {background:var(--green);color:#fff;border-color:var(--green)}
.pop-row {display:flex;width:100%;align-items:center;gap:8px;padding:11px 12px;border-radius:12px;border:0;background:transparent;color:var(--text);font-weight:700;font-size:14px;text-decoration:none;cursor:pointer;text-align:left}
.pop-row:hover {background:var(--bg)}
.pop-row.danger {color:#c0392b}

/* Kategori şeridi (kayar) */
.rail-wrap {border-bottom:1px solid var(--border);background:var(--card)}
.rail {max-width:1400px;margin:auto;display:flex;gap:10px;overflow-x:auto;padding:14px 24px;scrollbar-width:none;scroll-snap-type:x proximity}
.rail::-webkit-scrollbar {display:none}
.pill {flex:0 0 auto;scroll-snap-align:start;padding:10px 20px;border-radius:999px;text-decoration:none;font-weight:800;font-size:14px;border:1px solid var(--border);background:var(--bg);color:var(--text);transition:.2s}
.pill:hover {border-color:var(--green)}
.pill.on {background:var(--green);color:#fff;border-color:var(--green)}

/* Ana sayfa: hero kaydırıcı */
.hero-slider {position:relative;margin:8px 0 28px}
.hs-track {display:flex;overflow-x:auto;scroll-snap-type:x mandatory;scrollbar-width:none;border-radius:32px;scroll-behavior:smooth}
.hs-track::-webkit-scrollbar {display:none}
.hs-slide {flex:0 0 100%;scroll-snap-align:start;min-height:440px;display:grid;grid-template-columns:1.1fr .9fr;align-items:center;gap:30px;padding:46px 70px;background:var(--hdr-grad);color:#fff;position:relative;overflow:hidden}
.hs-slide::after {content:"";position:absolute;width:520px;height:520px;right:-120px;top:-160px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.16),transparent 65%);pointer-events:none}
.hs-content {position:relative;z-index:1;max-width:560px}
.hs-tag {display:inline-block;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.25);padding:6px 14px;border-radius:999px;font-weight:800;font-size:13px;margin-bottom:18px}
.hs-content h2 {font-size:clamp(30px,4.6vw,54px);line-height:1.08;font-weight:900;letter-spacing:-.02em;margin-bottom:14px}
.hs-content p {font-size:17px;opacity:.92;margin-bottom:26px;line-height:1.6}
.hs-cta {display:inline-flex;align-items:center;gap:8px;background:#fff;color:#1d140f;padding:14px 26px;border-radius:999px;font-weight:900;text-decoration:none;transition:.25s var(--ease);box-shadow:0 10px 26px rgba(0,0,0,.25)}
.hs-cta:hover {transform:translateY(-3px) scale(1.03)}
.hs-img {position:relative;z-index:1;justify-self:center}
.hs-img img {width:min(380px,100%);aspect-ratio:1;object-fit:cover;border-radius:36px;box-shadow:0 30px 60px rgba(0,0,0,.4);transform:rotate(3deg);transition:.6s var(--ease)}
.hs-slide:hover .hs-img img {transform:rotate(0) scale(1.03)}
.hs-arrow {position:absolute;top:50%;transform:translateY(-50%);width:48px;height:48px;border-radius:50%;border:1px solid rgba(255,255,255,.35);background:rgba(0,0,0,.28);color:#fff;font-size:26px;cursor:pointer;display:grid;place-items:center;transition:.2s;-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px)}
.hs-arrow:hover {background:rgba(255,255,255,.9);color:#111}
.hs-arrow.prev {left:16px} .hs-arrow.next {right:16px}
.hs-dots {position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px}
.hs-dots button {width:9px;height:9px;border-radius:999px;border:0;background:rgba(255,255,255,.5);cursor:pointer;transition:.35s var(--ease);padding:0}
.hs-dots button.on {width:30px;background:#fff}

/* Özellik şeridi */
.features {display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:12px}
.features>div {background:var(--card);border:1px solid var(--border);border-radius:20px;padding:18px;display:grid;grid-template-columns:auto 1fr;column-gap:14px;align-items:center;box-shadow:var(--shadow)}
.features span {grid-row:span 2;font-size:28px;width:52px;height:52px;border-radius:16px;display:grid;place-items:center;background:var(--bg)}
.features strong {font-size:15px;font-weight:900}
.features small {color:var(--muted);font-size:12.5px;font-weight:600}

/* Bölümler ve kaydırıcılar */
.sec {margin-top:40px}
.sec-head {display:flex;align-items:flex-end;justify-content:space-between;gap:14px;margin-bottom:14px}
.sec-head h2 {font-size:26px;font-weight:900;letter-spacing:-.02em}
.sec-head p {color:var(--muted);font-size:14px;font-weight:600}
.sec-tools {display:flex;gap:8px}
.sl-btn {width:42px;height:42px;border-radius:50%;border:1px solid var(--border);background:var(--card);color:var(--text);font-size:22px;cursor:pointer;transition:.2s;line-height:1}
.sl-btn:hover {background:var(--green);color:#fff;border-color:var(--green)}
.sl-track {display:flex;gap:18px;overflow-x:auto;scroll-snap-type:x proximity;padding:6px 4px 22px;margin:0 -4px;scrollbar-width:none;scroll-behavior:smooth;cursor:grab}
.sl-track::-webkit-scrollbar {display:none}
.sl-track.drag {cursor:grabbing;scroll-behavior:auto;scroll-snap-type:none}
.sl-track>* {flex:0 0 250px;scroll-snap-align:start}
.mini {background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:var(--shadow);display:flex;flex-direction:column;transition:transform .35s var(--ease),box-shadow .35s}
.mini:hover {transform:translateY(-8px);box-shadow:0 26px 50px rgba(0,0,0,.16)}
.mini-img {position:relative;aspect-ratio:1/1;overflow:hidden;display:block;background:var(--bg)}
.mini-img img {width:100%;height:100%;object-fit:cover;transition:transform .6s var(--ease);-webkit-user-drag:none}
.mini:hover .mini-img img {transform:scale(1.08)}
.mini-ph {display:grid;place-items:center;height:100%;font-size:52px}
.mini-img .sale-badge {position:absolute;top:12px;left:12px}
.mini-body {padding:14px 16px 16px;display:flex;flex-direction:column;gap:6px;flex:1}
.mini-cat {font-size:11px;font-weight:900;letter-spacing:.8px;text-transform:uppercase;color:var(--green)}
.mini h3 {font-size:16px;font-weight:800;line-height:1.3;min-height:42px}
.mini-price {font-size:19px;font-weight:900;color:var(--accent)}
.mini-price s {font-size:13px;color:var(--muted);font-weight:700;margin-left:4px}
.mini-add {width:100%;margin-top:6px;padding:11px;border:0;border-radius:14px;background:var(--green);color:#fff;font-weight:900;cursor:pointer;transition:.2s}
.mini-add:hover {background:var(--green-hover);transform:translateY(-1px)}
.mini-out {margin-top:6px;color:var(--muted);font-weight:800}
.cat-track>* {flex-basis:230px}
.cat-card {position:relative;min-height:170px;border-radius:26px;overflow:hidden;display:flex;flex-direction:column;justify-content:flex-end;padding:18px;color:#fff;text-decoration:none;background:var(--hdr-grad) center/cover;transition:transform .35s var(--ease)}
.cat-card::before {content:"";position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.72),rgba(0,0,0,.05) 70%)}
.cat-card:hover {transform:translateY(-6px) scale(1.02)}
.cat-card>* {position:relative}
.cat-name {font-size:19px;font-weight:900}
.cat-count {font-size:12.5px;opacity:.85;font-weight:700}
.cta-band {margin-top:44px;border-radius:30px;padding:34px 40px;background:var(--hdr-grad);color:#fff;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.cta-band h2 {font-size:26px;font-weight:900}
.cta-band p {opacity:.9;margin-top:4px}

/* Ürün kartları (menü) */
.menu-grid {gap:22px}
.product-card {border-radius:24px;transition:transform .35s var(--ease),box-shadow .35s}
.product-card:hover {transform:translateY(-8px);box-shadow:0 26px 54px rgba(0,0,0,.16)}
.product-image-wrap>img {transition:transform .6s var(--ease)}
.product-card:hover .product-image-wrap>img {transform:scale(1.07)}
.btn {border-radius:14px}
.form-card,.stat-card,table {border-radius:24px}
.catalog-search {border-radius:999px}
.catalog-search button[type="submit"] {border-radius:999px}

/* Termos / kupa: ürünün tamamı görünsün, kenarlar bulanık arka planla dolsun */
.product-image-wrap.contain {height:260px;background:var(--bg)}
.product-image-wrap.contain::before {content:"";position:absolute;inset:-20px;background:var(--bgimg) center/cover;filter:blur(22px) saturate(1.1);opacity:.85}
.product-image-wrap.contain>img {position:relative;height:100%;width:100%;object-fit:contain;padding:12px 0;filter:drop-shadow(0 12px 18px rgba(0,0,0,.22))}
.ph-wrap {height:220px;display:grid;place-items:center;background:var(--hdr-grad)}
.ph-icon {font-size:64px;filter:drop-shadow(0 6px 14px rgba(0,0,0,.35))}
.ph-wrap .sale-badge {position:absolute;top:12px;left:12px}

/* Yönetim: sekmeler, sipariş kartları, durum rozetleri */
.adm-tabs {display:flex;gap:8px;overflow-x:auto;margin-bottom:22px;padding:6px;background:var(--card);border:1px solid var(--border);border-radius:999px;width:fit-content;max-width:100%;scrollbar-width:none}
.adm-tabs a {flex:0 0 auto;padding:10px 18px;border-radius:999px;text-decoration:none;font-weight:800;font-size:14px;color:var(--muted);transition:.2s}
.adm-tabs a:hover {color:var(--text);background:var(--bg)}
.adm-tabs a.on {background:var(--green);color:#fff}
.adm-h {font-size:26px;font-weight:900;letter-spacing:-.02em;color:var(--green);margin-bottom:16px}
.adm-stats {display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:22px}
.adm-stat {background:var(--card);border:1px solid var(--border);border-radius:20px;padding:16px 18px;box-shadow:var(--shadow)}
.adm-stat small {display:block;color:var(--muted);font-weight:700;font-size:12.5px}
.adm-stat strong {font-size:26px;font-weight:900}
.adm-stat.hl {background:linear-gradient(135deg,var(--green),var(--accent));color:#fff;border:0}
.adm-stat.hl small {color:rgba(255,255,255,.85)}
.adm-filter {display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px}
.adm-filter select {width:auto;min-width:160px}
.adm-filter input[type=search] {flex:1;min-width:220px}
.adm-filter .btn {width:auto;padding:0 22px}
.order-card {background:var(--card);border:1px solid var(--border);border-radius:22px;box-shadow:var(--shadow);margin-bottom:16px;overflow:hidden}
.order-card>header,.order-card>footer {display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;padding:14px 20px}
.order-card>header {border-bottom:1px solid var(--border);background:var(--bg)}
.order-card>footer {border-top:1px solid var(--border);justify-content:flex-start}
.order-card .muted {color:var(--muted);font-size:13px;font-weight:600}
.order-grid {display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px;padding:18px 20px}
.order-grid>div {display:flex;flex-direction:column;gap:3px;min-width:0;overflow-wrap:anywhere;font-size:14px}
.order-grid small {font-size:11px;font-weight:900;letter-spacing:.8px;text-transform:uppercase;color:var(--muted)}
.order-grid .amount {font-size:20px;color:var(--accent)}
.order-log {display:flex;gap:8px;flex-wrap:wrap;padding:0 20px 16px}
.order-log span {font-size:12px;font-weight:700;padding:4px 10px;border-radius:999px;background:var(--bg);border:1px solid var(--border);color:var(--muted)}
.inline-form {display:flex;gap:8px;align-items:center;flex-wrap:wrap}
.inline-form select {width:auto;padding:10px 14px}
.order-card .btn {width:auto;padding:10px 18px}
.st {display:inline-block;padding:5px 12px;border-radius:999px;font-size:12px;font-weight:900;white-space:nowrap}
.st-hazir {background:#fff3d6;color:#8a5a00}
.st-kargo {background:#dcecff;color:#1c4f8f}
.st-teslim {background:#dcf5e4;color:#1d6b3a}
.st-iptal {background:#fde2e2;color:#a32626}
.stepper {list-style:none;display:flex;gap:10px;padding:16px 20px 0;margin:0}
.stepper li {flex:1;display:flex;align-items:center;gap:8px;font-weight:800;font-size:13px;color:var(--muted);padding-top:10px;border-top:4px solid var(--border);border-radius:2px}
.stepper li span {width:24px;height:24px;border-radius:50%;display:grid;place-items:center;background:var(--border);font-size:12px}
.stepper li.done {color:var(--green);border-top-color:var(--green)}
.stepper li.done span {background:var(--green);color:#fff}

/* Görünür olunca beliren animasyon */
.js .reveal {opacity:0;transform:translateY(26px);transition:opacity .8s var(--ease),transform .8s var(--ease)}
.js .reveal.in {opacity:1;transform:none}
.to-top {position:fixed;left:24px;bottom:28px;width:46px;height:46px;border-radius:50%;border:1px solid var(--border);background:var(--card);color:var(--text);font-size:20px;cursor:pointer;box-shadow:var(--shadow);opacity:0;pointer-events:none;transition:.3s;z-index:900}
.to-top.show {opacity:1;pointer-events:auto}

@media(max-width:1100px){
    .nav-search {max-width:none;min-width:150px}
    .burger {display:inline-flex}
    .nav-links {display:none;position:absolute;left:0;right:0;top:100%;flex-direction:column;background:var(--card);border-bottom:1px solid var(--border);padding:10px 20px 16px;margin:0}
    .nav-links.open {display:flex}
    .features {grid-template-columns:repeat(2,1fr)}
    .hs-slide {grid-template-columns:1fr;padding:34px 26px 56px;min-height:0;text-align:left}
    .hs-img img {width:min(260px,70%)}
    .hs-arrow {display:none}
}
@media(max-width:640px){
    .nav-inner {flex-wrap:wrap;gap:10px;padding:10px 14px}
    .nav-search {order:5;flex:1 1 100%}
    .nav-actions {margin-left:auto}
    .hide-sm {display:none}
    .brand-name {font-size:19px}
    .features {grid-template-columns:1fr}
    .sl-track>* {flex-basis:210px}
    .cta-band {padding:24px}
}
@media(prefers-reduced-motion:reduce){
    .announce-track {animation:none}
    .js .reveal {opacity:1;transform:none;transition:none}
    html,.hs-track,.sl-track {scroll-behavior:auto}
}
</style>
<script>document.documentElement.classList.add('js')</script>
</head>

<body class="<?= isset($_COOKIE['theme']) && $_COOKIE['theme']==='dark'?'dark-mode':'' ?>" data-tema="<?= $aktifTema ?>" data-gorunum="<?= $aktifGorunum ?>">

<?php
function dil($tr, $en) { global $lang; return $lang === 'tr' ? $tr : $en; }
$temaRenk = [
    'kahve'=>'#8c582f','orman'=>'#2f6b3a','okyanus'=>'#1f6f9f','gul'=>'#a63d5f','gece'=>'#3f6fe0',
    'mor'=>'#6a35a8','bordo'=>'#7a1828','lavanta'=>'#8467c9','nane'=>'#3a9d68','seftali'=>'#d9763f','bulut'=>'#3f8ccb'
];
$duyurular = [
    dil('🚚 500₺ ve üzeri alışverişlerde ücretsiz kargo','🚚 Free shipping on orders over 500₺'),
    dil('🎁 İlk siparişinize özel %5 indirim','🎁 5% off your first order'),
    dil('📦 10 adet ve üzeri siparişlerde %20 ek indirim','📦 Extra 20% off orders of 10 or more'),
    dil('☕ Seçili ürünlerde %20\'ye varan indirim','☕ Up to 20% off selected products'),
];
?>
<div class="announce" aria-label="<?= dil('Duyurular','Announcements') ?>">
    <div class="announce-track">
        <?php for ($k = 0; $k < 2; $k++): foreach ($duyurular as $d): ?><span><?= $d ?></span><?php endforeach; endfor; ?>
    </div>
</div>

<header class="nav">
    <div class="nav-inner">
        <a class="brand" href="?sekme=anasayfa" aria-label="KahveTat">
            <span class="brand-mark" aria-hidden="true">
                <svg viewBox="0 0 32 32" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 12h17v6.5A6.5 6.5 0 0 1 16.5 25h-4A6.5 6.5 0 0 1 6 18.5V12z"/>
                    <path d="M23 14h2.2a3 3 0 0 1 0 6H23"/>
                    <path d="M11 3.5c-1.2 1.4 1.2 2.4 0 4M16 3.5c-1.2 1.4 1.2 2.4 0 4M21 3.5c-1.2 1.4 1.2 2.4 0 4" stroke-width="1.8"/>
                </svg>
            </span>
            <span class="brand-name">Kahve<b>Tat</b></span>
        </a>

        <nav class="nav-links" id="navLinks">
            <a href="?sekme=anasayfa" class="<?= $sekme==='anasayfa'?'on':'' ?>"><?= t('Ana Sayfa') ?></a>
            <a href="?sekme=menu" class="<?= $sekme==='menu'?'on':'' ?>"><?= t('Menü') ?></a>
            <a href="?sekme=tarifler" class="<?= $sekme==='tarifler'?'on':'' ?>"><?= t('Tarifler') ?></a>
            <a href="?sekme=toplu" class="<?= $sekme==='toplu'?'on':'' ?>"><?= t('Toplu Sipariş') ?></a>
            <?php if ($girisYapildi): ?><a href="?sekme=siparislerim" class="<?= $sekme==='siparislerim'?'on':'' ?>"><?= t('Siparişlerim') ?></a><?php endif; ?>
        </nav>

        <form method="GET" class="nav-search">
            <input type="hidden" name="sekme" value="menu">
            <span aria-hidden="true">🔍</span>
            <input type="text" name="ara" value="<?= guvenli($_GET['ara'] ?? '') ?>" placeholder="<?= t('Ürün Arama...') ?>">
            <?php if (!empty($_GET['ara'])): ?><button type="button" class="ns-clear" aria-label="<?= t('Arama temizle') ?>" onclick="clearSearch(this)">×</button><?php endif; ?>
        </form>

        <div class="nav-actions">
            <details class="pop">
                <summary class="icon-btn" title="<?= dil('Arayüz','Appearance') ?>">🎨</summary>
                <div class="pop-panel">
                    <div class="pop-title"><?= dil('Renk Teması','Color Theme') ?></div>
                    <div class="swatches">
                        <?php foreach ($temalar as $tk=>$tv): ?>
                            <button type="button" class="sw <?= $aktifTema===$tk?'on':'' ?>" data-tema="<?= $tk ?>" title="<?= guvenli($tv[0]) ?>" style="--c:<?= $temaRenk[$tk] ?? '#888' ?>" onclick="setTema('<?= $tk ?>')"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="pop-title"><?= dil('Ürün Görünümü','Product Layout') ?></div>
                    <div class="seg">
                        <?php foreach ($gorunumler as $gk=>$gv): ?>
                            <button type="button" class="<?= $aktifGorunum===$gk?'on':'' ?>" data-gorunum="<?= $gk ?>" onclick="setGorunum('<?= $gk ?>')"><?= $gv[1] ?> <?= guvenli($gv[0]) ?></button>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="pop-row" onclick="toggleTheme()">🌓 <?= t('Gündüz') ?> / <?= t('Gece') ?></button>
                </div>
            </details>

            <a class="icon-btn" href="?sekme=<?= urlencode($sekme) ?>&amp;lang=<?= $lang==='tr'?'en':'tr' ?>"><?= $lang==='tr'?'EN':'TR' ?></a>

            <?php if ($girisYapildi): ?>
                <details class="pop">
                    <summary class="icon-btn">👤 <span class="hide-sm"><?= guvenli(mb_substr($aktifKullanici,0,12)) ?></span></summary>
                    <div class="pop-panel">
                        <div class="pop-title"><?= t('Merhaba') ?>, <?= guvenli($aktifKullanici) ?></div>
                        <a class="pop-row" href="?sekme=siparislerim">🧾 <?= t('Siparişlerim') ?></a>
                        <a class="pop-row" href="?sekme=siparisler">📋 <?= dil('Sipariş Yönetimi','Order Management') ?></a>
                        <a class="pop-row" href="?sekme=stok">📊 <?= t('Stok Takibi') ?></a>
                        <a class="pop-row" href="?sekme=satislar">💰 <?= t('Satış Raporu') ?></a>
                        <a class="pop-row" href="?sekme=yonetim">⚙️ <?= t('Yönetim') ?></a>
                        <form method="POST">
                            <input type="hidden" name="islem" value="cikis">
                            <button class="pop-row danger" type="submit">⎋ <?= t('Çıkış Yap') ?></button>
                        </form>
                    </div>
                </details>
            <?php else: ?>
                <a class="icon-btn hide-sm" href="?sekme=giris"><?= t('Giriş') ?></a>
                <a class="icon-btn primary hide-sm" href="?sekme=kayit"><?= t('Kayıt Ol') ?></a>
            <?php endif; ?>

            <a class="icon-btn primary" href="?sekme=sepet" aria-label="<?= t('Sepetim') ?>">🛒 <span class="cart-dot"><?= $sepet_adet ?></span></a>
            <button type="button" class="icon-btn burger" aria-label="Menu" onclick="document.getElementById('navLinks').classList.toggle('open')">☰</button>
        </div>
    </div>
</header>

<?php if ($sekme==='menu'): ?>
<div class="rail-wrap">
    <div class="rail">
        <a class="pill <?= $alt_kategori==='Tümü'?'on':'' ?>" href="?sekme=menu&amp;kat=Tümü"><?= t('Tümü') ?></a>
        <?php foreach (array_keys($katalog) as $kat): ?>
            <a class="pill <?= $alt_kategori===$kat?'on':'' ?>" href="?sekme=menu&amp;kat=<?= urlencode($kat) ?>"><?= t($kat) ?></a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="container">

<?php if ($mesaj): ?>
    <div class="alert <?= $mesajTipi==='error'?'error':'' ?>">
        <?= guvenli(t($mesaj)) ?>
    </div>
<?php endif; ?>

<!-- ANA SAYFA -->

<?php if ($sekme==='anasayfa'): ?>

    <?php
    /* Hızlı ekleme için kategoriye göre varsayılan seçenekler */
    function hizliSecenek($kat) {
        if (in_array($kat, ['Sıcak Kahve','Soğuk Kahve','Milkshake','Frozen'], true)) return ['Küçük Boy','Normal Süt','Standart'];
        if ($kat === 'Tatlılar') return ['Standart','Bitter Çikolata','Sade'];
        return ['Standart','Standart','Standart'];
    }
    function miniKart($u) {
        global $lang;
        $ind = (int)($u['indirim'] ?? 0);
        $sec = hizliSecenek($u['kategori'] ?? '');
        ob_start(); ?>
        <article class="mini">
            <a class="mini-img" href="?sekme=menu&amp;kat=<?= urlencode($u['kategori']) ?>&amp;ara=<?= urlencode($u['ad']) ?>">
                <?php if (!empty($u['gorsel'])): ?><img src="<?= guvenli($u['gorsel']) ?>" alt="<?= guvenli($u['ad']) ?>" loading="lazy"><?php else: ?><span class="mini-ph">☕</span><?php endif; ?>
                <?php if ($ind > 0): ?><span class="sale-badge">%<?= $ind ?> <?= $lang==='tr'?'İNDİRİM':'OFF' ?></span><?php endif; ?>
            </a>
            <div class="mini-body">
                <span class="mini-cat"><?= t($u['kategori']) ?></span>
                <h3><?= t($u['ad']) ?></h3>
                <div class="mini-price"><?= number_format($u['fiyat'],2) ?> ₺ <?php if ($ind > 0): ?><s><?= number_format($u['liste_fiyat'] ?? $u['fiyat'],2) ?> ₺</s><?php endif; ?></div>
                <?php if (($u['stok'] ?? 0) > 0): ?>
                <form method="POST">
                    <input type="hidden" name="islem" value="sepete_ekle">
                    <input type="hidden" name="urun_id" value="<?= (int)$u['id'] ?>">
                    <input type="hidden" name="boyut" value="<?= guvenli($sec[0]) ?>">
                    <input type="hidden" name="secenek1" value="<?= guvenli($sec[1]) ?>">
                    <input type="hidden" name="secenek2" value="<?= guvenli($sec[2]) ?>">
                    <button class="mini-add" type="submit">+ <?= t('Sepete Ekle') ?></button>
                </form>
                <?php else: ?><span class="mini-out"><?= t('Tükendi') ?></span><?php endif; ?>
            </div>
        </article>
        <?php return ob_get_clean();
    }
    function slider($id, $baslik, $alt, $kartlar) { ?>
        <section class="sec reveal">
            <div class="sec-head">
                <div><h2><?= $baslik ?></h2><p><?= $alt ?></p></div>
                <div class="sec-tools">
                    <button type="button" class="sl-btn" data-sl="<?= $id ?>" data-dir="-1" aria-label="←">‹</button>
                    <button type="button" class="sl-btn" data-sl="<?= $id ?>" data-dir="1" aria-label="→">›</button>
                </div>
            </div>
            <div class="sl-track" id="<?= $id ?>"><?= implode('', $kartlar) ?></div>
        </section>
    <?php }

    $slaytlar = [
        ['u01', dil('Yeni Sezon','New Season'), t('Her Fincanda Ayrı Bir Hikâye'), t('Özenle seçilmiş çekirdekler, usta ellerde hazırlanan eşsiz lezzetler.'), '?sekme=menu&kat=Sıcak%20Kahve', t('Ürünleri İncele')],
        ['u38', dil('%20\'ye varan indirim','Up to 20% off'), dil('Serinleten Frozen\'lar','Refreshing Frozen Drinks'), dil('Meyve aromalı frozen ve soğuk kahvelerde şimdi indirimli fiyatlar.','Fruity frozen drinks and iced coffees now at special prices.'), '?sekme=menu&kat=Frozen', dil('Frozen\'ları Gör','See Frozen Drinks')],
        ['u56', dil('Tatlı Molası','Sweet Break'), dil('Tiramisu\'dan Künefe\'ye','From Tiramisu to Künefe'), dil('Kahvenizin yanına en çok yakışan tatlılar %15 indirimli.','Desserts that pair perfectly with your coffee, 15% off.'), '?sekme=menu&kat=Tatlılar', dil('Tatlıları Keşfet','Explore Desserts')],
        ['u49', dil('Toplu Sipariş','Bulk Orders'), dil('10+ adette %20 ek indirim','Extra 20% off for 10+'), dil('Etkinlik, ofis ve toplantılar için toplu sipariş talebi oluşturun.','Place a bulk request for events, offices and meetings.'), '?sekme=toplu', t('Toplu Sipariş')],
    ];
    $katGorselleri = ['Sıcak Kahve'=>'u01','Soğuk Kahve'=>'u19','Frozen'=>'u31','Milkshake'=>'u49','Tatlılar'=>'u58','Kilo Kahve'=>'u08','Ekipman'=>''];
    $katSayac = [];
    foreach ($_SESSION['urunler'] as $uu) { $katSayac[$uu['kategori']] = ($katSayac[$uu['kategori']] ?? 0) + 1; }
    ?>

    <section class="hero-slider" aria-roledescription="carousel">
        <div class="hs-track" id="heroTrack">
            <?php foreach ($slaytlar as $s): ?>
            <div class="hs-slide">
                <div class="hs-content">
                    <span class="hs-tag"><?= $s[1] ?></span>
                    <h2><?= $s[2] ?></h2>
                    <p><?= $s[3] ?></p>
                    <a class="hs-cta" href="<?= guvenli($s[4]) ?>"><?= $s[5] ?> →</a>
                </div>
                <div class="hs-img"><img src="gorseller/<?= $s[0] ?>.jpg" alt=""></div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="hs-arrow prev" onclick="heroGit(-1)" aria-label="←">‹</button>
        <button type="button" class="hs-arrow next" onclick="heroGit(1)" aria-label="→">›</button>
        <div class="hs-dots" id="heroDots"><?php foreach ($slaytlar as $i=>$s): ?><button type="button" onclick="heroGit(0,<?= $i ?>)" aria-label="<?= $i+1 ?>"></button><?php endforeach; ?></div>
    </section>

    <div class="features reveal">
        <div><span>🚚</span><strong><?= dil('Ücretsiz Kargo','Free Shipping') ?></strong><small><?= dil('500₺ ve üzeri siparişlerde','On orders over 500₺') ?></small></div>
        <div><span>🎁</span><strong><?= dil('İlk Siparişe %5','5% First Order') ?></strong><small><?= dil('Yeni üyelere özel','For new members') ?></small></div>
        <div><span>📦</span><strong><?= dil('Toplu Alım %20','Bulk Buy 20%') ?></strong><small><?= dil('10 adet ve üzeri','10 items or more') ?></small></div>
        <div><span>☕</span><strong><?= dil('Taze & Özel','Fresh & Crafted') ?></strong><small><?= dil('Usta baristalardan','By expert baristas') ?></small></div>
    </div>

    <section class="sec reveal">
        <div class="sec-head"><div><h2><?= dil('Kategoriler','Categories') ?></h2><p><?= dil('Kaydırarak keşfedin','Swipe to explore') ?></p></div>
            <div class="sec-tools"><button type="button" class="sl-btn" data-sl="catTrack" data-dir="-1">‹</button><button type="button" class="sl-btn" data-sl="catTrack" data-dir="1">›</button></div></div>
        <div class="sl-track cat-track" id="catTrack">
            <?php foreach (array_keys($katalog) as $kk): $g = $katGorselleri[$kk] ?? ''; ?>
            <a class="cat-card" href="?sekme=menu&amp;kat=<?= urlencode($kk) ?>" <?php if ($g): ?>style="background-image:url('gorseller/<?= $g ?>.jpg')"<?php endif; ?>>
                <span class="cat-name"><?= t($kk) ?></span>
                <span class="cat-count"><?= (int)($katSayac[$kk] ?? 0) ?> <?= dil('ürün','items') ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <?php
    $firsat = array_filter($_SESSION['urunler'], function($x){ return ($x['indirim'] ?? 0) > 0 && !empty($x['gorsel']) && ($x['stok'] ?? 0) > 0; });
    usort($firsat, function($a,$b){ return ($b['indirim'] ?? 0) <=> ($a['indirim'] ?? 0); });
    slider('slFirsat', '🔥 '.dil('İndirimli Ürünler','Discounted Products'), dil('En yüksek indirimler önde','Biggest discounts first'), array_map('miniKart', array_slice($firsat, 0, 14)));

    foreach ([['Sıcak Kahve','slSicak','☕'],['Tatlılar','slTatli','🍰'],['Milkshake','slShake','🥤']] as $blok) {
        $liste = array_values(array_filter($_SESSION['urunler'], function($x) use ($blok){ return ($x['kategori'] ?? '') === $blok[0] && ($x['stok'] ?? 0) > 0; }));
        if ($liste) slider($blok[1], $blok[2].' '.t($blok[0]), dil('Hepsini görmek için kaydırın','Scroll to see them all'), array_map('miniKart', array_slice($liste, 0, 14)));
    }
    ?>

    <div class="cta-band reveal">
        <div><h2><?= dil('Etkinliğiniz için toplu sipariş','Bulk orders for your event') ?></h2><p><?= dil('10 adet ve üzeri siparişlerde otomatik %20 indirim.','Automatic 20% off orders of 10 or more.') ?></p></div>
        <a class="hs-cta" href="?sekme=toplu"><?= t('Toplu Sipariş') ?> →</a>
    </div>

<!-- MENÜ -->

<?php elseif ($sekme==='menu'):
    $arama=trim($_GET['ara']??'');
?>
    <div class="catalog-search-wrap">
        <form method="GET" class="catalog-search">
            <input type="hidden" name="sekme" value="menu">
            <input type="hidden" name="kat" value="<?= guvenli($alt_kategori) ?>">
            <input type="search" name="ara" value="<?= guvenli($arama) ?>" placeholder="<?= t('Ürün veya kategori ara...') ?>">
            <?php if ($arama !== ''): ?><button type="button" class="search-clear" aria-label="<?= t('Arama temizle') ?>" title="<?= t('Arama temizle') ?>" onclick="clearSearch(this)">×</button><?php endif; ?>
            <button type="submit">🔍 <?= t('Ara') ?></button>
        </form>
    </div>

    <div class="menu-grid">
            <?php
            $gosterilen=0;
            foreach ($_SESSION['urunler'] as $u):

                if ($alt_kategori!=='Tümü' && $u['kategori']!==$alt_kategori) continue;
                if ($arama!=='' && mb_stripos(($u['ad'] ?? '').' '.t($u['ad'] ?? '').' '.($u['kategori'] ?? '').' '.t($u['kategori'] ?? ''),$arama)===false) continue;

                $gosterilen++;
            ?>
                <div class="product-card">
                    <?php if (!empty($u['gorsel'])): ?>
                    <div class="product-image-wrap <?= ($u['kategori'] ?? '') === 'Ekipman' ? 'contain' : '' ?>" <?php if (($u['kategori'] ?? '') === 'Ekipman'): ?>style="--bgimg:url('<?= guvenli($u['gorsel']) ?>')"<?php endif; ?>>
                        <img src="<?= guvenli($u['gorsel']) ?>" alt="<?= guvenli($u['ad']) ?>" loading="lazy">
                        <?php if (($u['indirim'] ?? 0) > 0): ?><span class="sale-badge">%<?= (int)$u['indirim'] ?> <?= $lang==='tr'?'İNDİRİM':'OFF' ?></span><?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="product-image-wrap ph-wrap">
                        <span class="ph-icon">☕</span>
                        <?php if (($u['indirim'] ?? 0) > 0): ?><span class="sale-badge">%<?= (int)$u['indirim'] ?> <?= $lang==='tr'?'İNDİRİM':'OFF' ?></span><?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <div class="product-body">
                        <span class="cat"><?= t($u['kategori']) ?></span>
                        <h3><?= t($u['ad']) ?></h3>
                        <?php $uInd = (int)($u['indirim'] ?? 0); ?>
                        <div class="price">
                            <?= number_format($u['fiyat'],2) ?> ₺
                            <?php if ($uInd > 0): ?>
                                <span class="price-old"><?= number_format($u['liste_fiyat'] ?? $u['fiyat'],2) ?> ₺</span>
                            <?php endif; ?>
                        </div>
                        <div class="perk-list">
                            <?php if ($uInd > 0): ?><span>💸 <?= $lang==='tr' ? 'Şimdi %'.$uInd.' indirimli' : $uInd.'% off now' ?></span><?php endif; ?>
                            <span>📦 <?= $lang==='tr' ? '10+ adet %20 ek indirim' : '10+ items extra 20% off' ?></span>
                            <span>🚚 <?= $lang==='tr' ? '500₺ üzeri ücretsiz kargo' : 'Free shipping over 500₺' ?></span>
                        </div>

                        <p><?= $lang==='en' ? t($u['ad']).' — prepared with care using quality ingredients.' : guvenli($u['aciklama']) ?></p>

                        <form method="POST">
                            <input type="hidden" name="islem" value="sepete_ekle">
                            <input type="hidden" name="urun_id" value="<?= $u['id'] ?>">

                            <?php if (in_array($u['kategori'],['Sıcak Kahve','Soğuk Kahve','Milkshake','Frozen'])): ?>
                                <label style="font-size:12px;font-weight:800;display:block;margin-bottom:4px"><?= t('Boyut Seçimi:') ?></label>
                                <select name="boyut">
                                    <option value="Küçük Boy"><?= t('Küçük Boy') ?> (<?= t('Standart') ?>)</option>
                                    <option value="Orta Boy (+15 TL)"><?= t('Orta Boy (+15 TL)') ?></option>
                                    <option value="Büyük Boy (+30 TL)"><?= t('Büyük Boy (+30 TL)') ?></option>
                                </select>

                                <label style="font-size:12px;font-weight:800;display:block;margin-bottom:4px"><?= t('Süt / Ekstra:') ?></label>
                                <select name="secenek1">
                                    <option value="Normal Süt"><?= t('Normal Süt') ?></option>
                                    <option value="Laktozsuz Süt (+10 TL)"><?= t('Laktozsuz Süt (+10 TL)') ?></option>
                                    <option value="Badem Sütü (+15 TL)"><?= t('Badem Sütü (+15 TL)') ?></option>
                                    <option value="Yulaf Sütü (+15 TL)"><?= t('Yulaf Sütü (+15 TL)') ?></option>
                                </select>

                                <label style="font-size:12px;font-weight:800;display:block;margin-bottom:4px"><?= t('Buz / Derece:') ?></label>
                                <select name="secenek2">
                                    <option value="Standart"><?= t('Standart') ?></option>
                                    <option value="Ekstra Buz"><?= t('Ekstra Buz') ?></option>
                                    <option value="Az Buz"><?= t('Az Buz') ?></option>
                                    <option value="Buzsuz"><?= t('Buzsuz') ?></option>
                                </select>
                            <?php elseif ($u['kategori']==='Tatlılar'): ?>
                                <select name="secenek1">
                                    <option value="Bitter Çikolata"><?= t('Bitter Çikolata') ?></option>
                                    <option value="Beyaz Çikolata"><?= t('Beyaz Çikolata') ?></option>
                                    <option value="Sütlü Çikolata"><?= t('Sütlü Çikolata') ?></option>
                                    <option value="Çilek Soslu"><?= t('Çilek Soslu') ?></option>
                                </select>
                                <select name="secenek2">
                                    <option value="Sade"><?= t('Sade') ?></option>
                                    <option value="Muz Dilimleri"><?= t('Muz Dilimleri') ?></option>
                                    <option value="Çilek Dilimleri"><?= t('Çilek Dilimleri') ?></option>
                                    <option value="Fındık Parçacıklı"><?= t('Fındık Parçacıklı') ?></option>
                                </select>
                            <?php else: ?>
                                <input type="hidden" name="boyut" value="Standart">
                                <input type="hidden" name="secenek1" value="Standart">
                                <input type="hidden" name="secenek2" value="Standart">
                            <?php endif; ?>

                            <span class="badge <?= $u['stok']>0?'badge-ok':'badge-out' ?>">
                                <?= $u['stok']>0 ? t('Stok').': '.$u['stok'] : t('Tükendi') ?>
                            </span>

                            <?php if ($u['stok']>0): ?>
                                <button class="btn btn-primary" type="submit"><?= t('Sepete Ekle') ?> 🛒</button>
                            <?php else: ?>
                                <button class="btn" disabled style="width:100%;background:#ccc"><?= t('Tükendi') ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($gosterilen===0): ?>
                <p style="grid-column:1/-1;text-align:center;padding:35px;color:var(--muted)"><?= t('Arama sonucunda ürün bulunamadı.') ?></p>
            <?php endif; ?>
    </div>

<!-- SEPET -->

<?php elseif ($sekme==='sepet'): ?>

    <h2 style="color:var(--green);margin-bottom:20px;font-size:26px">🛒 <?= t('Sepetim') ?></h2>

    <?php if (empty($_SESSION['sepet'])): ?>
        <div class="form-card" style="text-align:center">
            <p style="font-size:16px;margin-bottom:15px"><?= t('Sepetinizde henüz ürün bulunmuyor.') ?></p>
            <a href="?sekme=menu" class="hero-btn"><?= t('Ürünleri İncele') ?></a>
        </div>
    <?php else:
        $sepet_toplam=0;
    ?>

        <div style="display:grid;grid-template-columns:minmax(0,2fr) minmax(320px,1fr);gap:24px">

            <div>
                <table>
                    <tr>
                        <th><?= t('Ürün') ?></th>
                        <th><?= t('Özellikler') ?></th>
                        <th><?= t('Fiyat') ?></th>
                        <th><?= t('Adet') ?></th>
                        <th><?= t('İşlem') ?></th>
                    </tr>

                    <?php foreach ($_SESSION['sepet'] as $key=>$item):
                        if (!isset($_SESSION['urunler'][$item['urun_id']])) continue;
                        $u=$_SESSION['urunler'][$item['urun_id']];
                        $birimFiyat = $u['fiyat'] + ($item['ek_fiyat'] ?? 0);
                        $ara_tutar=$birimFiyat*$item['adet'];
                        $sepet_toplam+=$ara_tutar;
                    ?>
                    <tr>
                        <td><strong><?= t($u['ad']) ?></strong></td>
                        <td><?= t($item['boyut']) ?> | <?= t($item['secenek1']) ?> / <?= t($item['secenek2']) ?></td>
                        <td><?= number_format($birimFiyat,2) ?> ₺</td>
                        <td>
                            <form method="POST" style="display:inline">
                                <input type="hidden" name="islem" value="sepet_guncelle">
                                <input type="hidden" name="sepet_key" value="<?= guvenli($key) ?>">
                                <input type="hidden" name="alt_islem" value="azalt">
                                <button class="btn" style="padding:4px 10px">−</button>
                            </form>

                            <strong style="margin:0 6px"><?= $item['adet'] ?></strong>

                            <form method="POST" style="display:inline">
                                <input type="hidden" name="islem" value="sepet_guncelle">
                                <input type="hidden" name="sepet_key" value="<?= guvenli($key) ?>">
                                <input type="hidden" name="alt_islem" value="arttir">
                                <button class="btn" style="padding:4px 10px">+</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="islem" value="sepet_guncelle">
                                <input type="hidden" name="sepet_key" value="<?= guvenli($key) ?>">
                                <input type="hidden" name="alt_islem" value="sil">
                                <button class="btn btn-danger" style="padding:6px 12px;font-size:12px"><?= t('Sil') ?></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="form-card" style="margin:0;height:fit-content">
                <h3 style="color:var(--green);margin-bottom:16px;font-size:20px"><?= t('Sipariş Özeti') ?></h3>

                <p style="display:flex;justify-content:space-between;font-size:15px">
                    <span><?= t('Ara Toplam:') ?></span>
                    <strong><?= number_format($sepet_toplam,2) ?> ₺</strong>
                </p>

                <p style="display:flex;justify-content:space-between;margin-top:10px;font-size:15px">
                    <span><?= t('Kargo:') ?></span>
                    <strong><?= $sepet_toplam>=500?t('Ücretsiz'):'40.00 ₺' ?></strong>
                </p>

                <?php if ($sepet_toplam<500): ?>
                    <p style="font-size:13px;color:var(--muted);margin-top:10px">
                        <?= $lang==='tr'
                            ? 'Ücretsiz kargo için '.number_format(500-$sepet_toplam,2).' TL daha alışveriş yapın.'
                            : 'Spend '.number_format(500-$sepet_toplam,2).' TL more for free shipping.' ?>
                    </p>
                <?php endif; ?>

                <hr style="border:0;border-top:1px solid var(--border);margin:18px 0">

                <form method="POST" id="checkoutForm">
                    <input type="hidden" name="islem" value="siparis_tamamla">

                    <div class="form-group">
                        <label><?= t('Ad Soyad') ?></label>
                        <input type="text" name="musteri" required value="<?= $girisYapildi?guvenli($aktifKullanici):'' ?>">
                    </div>

                    <div class="form-group">
                        <label><?= t('İl') ?></label>
                        <select name="il" required>
                            <?php foreach ($sehirler as $s): ?>
                                <option value="<?= guvenli($s) ?>" <?= $s==='Ankara'?'selected':'' ?>><?= guvenli($s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= t('İlçe') ?></label>
                        <input type="text" name="ilce" required>
                    </div>

                    <div class="form-group">
                        <label><?= t('Açık Adres') ?></label>
                        <textarea name="adres" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label><?= t('Ödeme Yöntemi') ?></label>
                        <select name="odeme_tipi" id="odemeTipi" onchange="kartAlaniniGoster()" required>
                            <option value="Kredi Kartı Online"><?= t('Kredi Kartı Online') ?></option>
                            <option value="Kapıda Nakit / Kart"><?= t('Kapıda Nakit / Kart') ?> (+30 TL)</option>
                        </select>
                    </div>

                    <div id="kartAlanlari" style="padding:16px;border:1px solid var(--border);border-radius:12px;margin-bottom:18px;background:var(--bg)">
                        <h4 style="margin-bottom:12px;color:var(--green);font-size:16px">💳 <?= t('Kart Bilgileri') ?></h4>

                        <div class="form-group">
                            <label><?= t('Kart Üzerindeki İsim') ?></label>
                            <input type="text" name="kart_ad" id="kartAd" autocomplete="cc-name">
                        </div>

                        <div class="form-group">
                            <label><?= t('Kart Numarası') ?></label>
                            <input type="text" name="kart_no" id="kartNo"
                                   maxlength="19" placeholder="0000 0000 0000 0000"
                                   inputmode="numeric" autocomplete="cc-number">
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                            <div class="form-group">
                                <label><?= t('Son Kullanma Tarihi') ?></label>
                                <input type="text" name="kart_skt" id="kartSkt"
                                       placeholder="MM/YY" maxlength="5" autocomplete="cc-exp">
                            </div>
                            <div class="form-group">
                                <label><?= t('Güvenlik Kodu') ?></label>
                                <input type="password" name="kart_cvv" id="kartCvv"
                                       maxlength="4" inputmode="numeric" autocomplete="cc-csc">
                            </div>
                        </div>

                        <small style="color:var(--muted);display:block;margin-top:6px">
                            <?= t('Demo ödeme alanıdır. Gerçek kart işlemi yapılmaz ve kart bilgileri saklanmaz.') ?>
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary" style="padding:15px;font-size:16px">
                        <?= t('Siparişi Onayla') ?>
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>

<!-- TARİFLER -->

<?php elseif ($sekme==='tarifler'):
    $tarifArama=trim($_GET['tarif_ara']??'');
    $tarifSayisi=0;
?>

    <h2 style="color:var(--green);margin-bottom:24px;font-size:26px">
        <?= t('Usta Baristalardan Özel Kahve & Tatlı Tarifleri') ?>
    </h2>
    <p class="recipe-search-title"><?= $lang==='tr'?'İçecek ve tatlı tariflerini kolayca bulun.':'Find drink and dessert recipes easily.' ?></p>
    <div class="catalog-search-wrap">
        <form method="GET" class="catalog-search">
            <input type="hidden" name="sekme" value="tarifler">
            <input type="search" name="tarif_ara" value="<?= guvenli($tarifArama) ?>" placeholder="<?= t('Tariflerde ara...') ?>">
            <?php if ($tarifArama !== ''): ?><button type="button" class="search-clear" aria-label="<?= t('Arama temizle') ?>" title="<?= t('Arama temizle') ?>" onclick="clearSearch(this)">×</button><?php endif; ?>
            <button type="submit">🔍 <?= t('Ara') ?></button>
        </form>
    </div>

    <div class="menu-grid recipe-grid">
        <?php foreach ($_SESSION['urunler'] as $u): ?>
            <?php
                if (($u['kategori'] ?? '') === 'Ekipman') continue;
                if ($tarifArama !== '' && mb_stripos(($u['ad'] ?? '').' '.t($u['ad'] ?? '').' '.($u['kategori'] ?? '').' '.t($u['kategori'] ?? ''), $tarifArama) === false) continue;
                $tarifSayisi++;
            ?>
            <div class="product-card recipe-card">
                <div class="product-body">
                    <span class="cat"><?= t($u['kategori']) ?></span>
                    <h3><?= t($u['ad']) ?></h3>
                    <div class="recipe-text"><?= guvenli(tarifCevir($u['hazirlanis'])) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if ($tarifSayisi === 0): ?>
            <p style="grid-column:1/-1;text-align:center;padding:35px;color:var(--muted)"><?= t('Arama sonucunda tarif bulunamadı.') ?></p>
        <?php endif; ?>
    </div>

<!-- TOPLU SİPARİŞ -->

<?php elseif ($sekme==='toplu'): ?>

    <div class="form-card">
        <h2 style="color:var(--green);margin-bottom:12px;font-size:24px"><?= t('Toplu Sipariş & Etkinlik Talebi') ?></h2>
        <p style="color:var(--muted);margin-bottom:20px;font-size:15px">
            <?= $lang==='tr'
                ? '10 adet ve üzeri siparişlerinizde otomatik %20 indirim uygulanır.'
                : 'Orders of 10 or more automatically receive a 20% discount.' ?>
        </p>

        <form method="POST">
            <input type="hidden" name="islem" value="toplu_siparis_olustur">

            <div class="form-group">
                <label><?= t('Ad Soyad') ?> / <?= t('Kurum') ?></label>
                <input type="text" name="musteri" required value="<?= $girisYapildi?guvenli($aktifKullanici):'' ?>">
            </div>

            <div class="form-group">
                <label><?= t('Telefon Numarası') ?></label>
                <input type="text" name="telefon" required placeholder="05XX XXX XX XX">
            </div>

            <div class="form-group">
                <label><?= t('Ürün') ?></label>
                <select name="urun_id" required>
                    <?php foreach ($_SESSION['urunler'] as $u): ?>
                        <option value="<?= $u['id'] ?>">
                            <?= t($u['ad']) ?> (<?= number_format($u['fiyat'],2) ?> TL)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label><?= t('Adet') ?> (<?= t('Min. 10') ?>)</label>
                <input type="number" name="adet" min="10" value="10" required>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                <div class="form-group">
                    <label><?= t('Teslim Tarihi') ?></label>
                    <input type="date" name="tarih" required>
                </div>
                <div class="form-group">
                    <label><?= t('Teslim Saati') ?></label>
                    <input type="time" name="saat" required>
                </div>
            </div>

            <div class="form-group">
                <label><?= t('Özel Notlar') ?></label>
                <textarea name="notlar" rows="3"></textarea>
            </div>

            <button class="btn btn-primary" style="padding:14px"><?= t('Toplu Sipariş') ?></button>
        </form>
    </div>

<!-- SİPARİŞ YÖNETİMİ (GEÇMİŞ SİPARİŞLER) -->

<?php elseif ($sekme==='siparisler' && $girisYapildi):
    $fDurum = $_GET['durum'] ?? 'Tümü';
    $fAra = trim($_GET['q'] ?? '');
    $say = ['toplam'=>0,'Hazırlanıyor'=>0,'Kargoda'=>0,'Teslim Edildi'=>0,'İptal Edildi'=>0];
    foreach ($_SESSION['satislar'] as $s0) { $say['toplam']++; $d0=$s0['durum'] ?? 'Hazırlanıyor'; if (isset($say[$d0])) $say[$d0]++; }
    $liste = array_reverse($_SESSION['satislar'], true);
?>
    <?= adminSekmeler('siparisler') ?>

    <div class="adm-stats">
        <div class="adm-stat"><small><?= dil('Toplam Sipariş','Total Orders') ?></small><strong><?= $say['toplam'] ?></strong></div>
        <div class="adm-stat"><small><?= dil('Hazırlanıyor','Preparing') ?></small><strong><?= $say['Hazırlanıyor'] ?></strong></div>
        <div class="adm-stat"><small><?= dil('Kargoda','Shipped') ?></small><strong><?= $say['Kargoda'] ?></strong></div>
        <div class="adm-stat"><small><?= dil('Teslim Edildi','Delivered') ?></small><strong><?= $say['Teslim Edildi'] ?></strong></div>
        <div class="adm-stat"><small><?= dil('İptal','Cancelled') ?></small><strong><?= $say['İptal Edildi'] ?></strong></div>
        <div class="adm-stat hl"><small><?= dil('Net Ciro','Net Revenue') ?></small><strong><?= number_format($toplam_ciro,2) ?> ₺</strong></div>
    </div>

    <form method="GET" class="adm-filter">
        <input type="hidden" name="sekme" value="siparisler">
        <select name="durum" onchange="this.form.submit()">
            <option value="Tümü"><?= t('Tümü') ?></option>
            <?php foreach ($siparisDurumlari as $sd): ?><option value="<?= guvenli($sd) ?>" <?= $fDurum===$sd?'selected':'' ?>><?= guvenli(durumEtiket($sd)) ?></option><?php endforeach; ?>
        </select>
        <input type="search" name="q" value="<?= guvenli($fAra) ?>" placeholder="<?= dil('Sipariş no, müşteri, e-posta veya ürün ara...','Search order no, customer, email or product...') ?>">
        <button class="btn btn-primary" type="submit">🔍 <?= t('Ara') ?></button>
    </form>

    <h2 class="adm-h"><?= dil('Geçmiş Siparişler','Order History') ?></h2>
    <?php
    $gosterilenSiparis = 0;
    foreach ($liste as $s):
        $d = $s['durum'] ?? 'Hazırlanıyor';
        if ($fDurum !== 'Tümü' && $d !== $fDurum) continue;
        if ($fAra !== '' && mb_stripos(($s['id'] ?? '').' '.($s['musteri'] ?? '').' '.($s['email'] ?? '').' '.($s['detay'] ?? ''), $fAra) === false) continue;
        $gosterilenSiparis++;
    ?>
    <article class="order-card">
        <header>
            <div><strong>#<?= guvenli($s['id']) ?></strong> <span class="muted"><?= guvenli($s['tarih']) ?></span></div>
            <span class="st <?= durumSinif($d) ?>"><?= guvenli(durumEtiket($d)) ?></span>
        </header>
        <div class="order-grid">
            <div><small><?= t('Ad Soyad') ?></small><b><?= guvenli($s['musteri']) ?></b><span class="muted"><?= guvenli($s['email']) ?></span></div>
            <div><small><?= t('Ürün') ?></small><span><?= guvenli($s['detay']) ?></span></div>
            <div><small><?= t('Teslimat') ?></small><span><?= guvenli($s['teslimat']) ?></span><span class="muted"><?= guvenli($s['odeme']) ?></span></div>
            <div><small><?= t('Fiyat') ?></small><b class="amount"><?= number_format($s['tutar'],2) ?> ₺</b><?php if (!empty($s['kampanya'])): ?><span class="muted"><?= guvenli($s['kampanya']) ?></span><?php endif; ?></div>
        </div>
        <?php if (!empty($s['gecmis'])): ?>
        <div class="order-log">
            <?php foreach ($s['gecmis'] as $g): ?><span><?= guvenli($g[0]) ?> · <?= guvenli(durumEtiket($g[1])) ?></span><?php endforeach; ?>
        </div>
        <?php endif; ?>
        <footer>
            <?php if ($d !== 'İptal Edildi'): ?>
            <form method="POST" class="inline-form">
                <input type="hidden" name="islem" value="siparis_durum">
                <input type="hidden" name="sid" value="<?= guvenli($s['id']) ?>">
                <select name="durum">
                    <?php foreach ($siparisDurumlari as $sd): ?><option value="<?= guvenli($sd) ?>" <?= $d===$sd?'selected':'' ?>><?= guvenli(durumEtiket($sd)) ?></option><?php endforeach; ?>
                </select>
                <button class="btn btn-primary" type="submit"><?= dil('Durumu Güncelle','Update Status') ?></button>
            </form>
            <?php else: ?><span class="muted"><?= dil('İptal edilen sipariş değiştirilemez.','Cancelled orders cannot be changed.') ?></span><?php endif; ?>
            <form method="POST" onsubmit="return confirm('<?= dil('Bu sipariş kaydı silinsin mi?','Delete this order record?') ?>')">
                <input type="hidden" name="islem" value="siparis_sil">
                <input type="hidden" name="sid" value="<?= guvenli($s['id']) ?>">
                <button class="btn btn-danger" type="submit"><?= t('Sil') ?></button>
            </form>
        </footer>
    </article>
    <?php endforeach; ?>
    <?php if ($gosterilenSiparis === 0): ?>
        <div class="form-card" style="text-align:center;max-width:none"><?= empty($_SESSION['satislar']) ? t('Henüz gerçekleşen bir satış bulunmuyor.') : dil('Filtreye uygun sipariş bulunamadı.','No orders match the filter.') ?></div>
    <?php endif; ?>

    <h2 class="adm-h" style="margin-top:38px"><?= dil('Toplu Sipariş Talepleri','Bulk Order Requests') ?></h2>
    <?php if (empty($_SESSION['toplu_siparisler'])): ?>
        <div class="form-card" style="text-align:center;max-width:none"><?= dil('Henüz toplu sipariş talebi yok.','No bulk order requests yet.') ?></div>
    <?php else: foreach (array_reverse($_SESSION['toplu_siparisler'], true) as $tp): $td = $tp['durum'] ?? 'Onay Bekliyor'; ?>
    <article class="order-card">
        <header>
            <div><strong><?= guvenli($tp['id']) ?></strong> <span class="muted"><?= guvenli($tp['tarih_saat']) ?></span></div>
            <span class="st <?= durumSinif($td) ?>"><?= guvenli(durumEtiket($td)) ?></span>
        </header>
        <div class="order-grid">
            <div><small><?= t('Ad Soyad') ?></small><b><?= guvenli($tp['musteri']) ?></b><span class="muted"><?= guvenli($tp['telefon']) ?></span></div>
            <div><small><?= t('Ürün') ?></small><span><?= (int)$tp['adet'] ?> × <?= guvenli(t($tp['urun_ad'])) ?></span></div>
            <div><small><?= t('Özel Notlar') ?></small><span><?= guvenli($tp['notlar'] ?: '—') ?></span></div>
            <div><small><?= t('Fiyat') ?></small><b class="amount"><?= number_format($tp['indirimli_tutar'],2) ?> ₺</b><span class="muted"><s><?= number_format($tp['normal_tutar'],2) ?> ₺</s></span></div>
        </div>
        <footer>
            <form method="POST" class="inline-form">
                <input type="hidden" name="islem" value="toplu_durum">
                <input type="hidden" name="rid" value="<?= guvenli($tp['id']) ?>">
                <select name="durum">
                    <?php foreach ($topluDurumlari as $sd): ?><option value="<?= guvenli($sd) ?>" <?= $td===$sd?'selected':'' ?>><?= guvenli(durumEtiket($sd)) ?></option><?php endforeach; ?>
                </select>
                <button class="btn btn-primary" type="submit"><?= dil('Durumu Güncelle','Update Status') ?></button>
            </form>
        </footer>
    </article>
    <?php endforeach; endif; ?>

<!-- MÜŞTERİNİN SİPARİŞLERİ -->

<?php elseif ($sekme==='siparislerim' && $girisYapildi):
    $benim = array_filter($_SESSION['satislar'], function($x){ return ($x['email'] ?? '') === $_SESSION['kullanici']; });
    $benim = array_reverse($benim, true);
    $adimlar = ['Hazırlanıyor','Kargoda','Teslim Edildi'];
?>
    <h2 class="adm-h">🧾 <?= t('Siparişlerim') ?></h2>
    <?php if (empty($benim)): ?>
        <div class="form-card" style="text-align:center"><p style="margin-bottom:14px"><?= dil('Henüz bir siparişiniz yok.','You have no orders yet.') ?></p><a href="?sekme=menu" class="btn btn-primary" style="display:inline-flex;width:auto;padding:12px 24px"><?= t('Alışverişe Başla') ?></a></div>
    <?php else: foreach ($benim as $s): $d = $s['durum'] ?? 'Hazırlanıyor'; $ai = array_search($d, $adimlar, true); ?>
    <article class="order-card">
        <header>
            <div><strong>#<?= guvenli($s['id']) ?></strong> <span class="muted"><?= guvenli($s['tarih']) ?></span></div>
            <span class="st <?= durumSinif($d) ?>"><?= guvenli(durumEtiket($d)) ?></span>
        </header>
        <?php if ($d !== 'İptal Edildi'): ?>
        <ol class="stepper">
            <?php foreach ($adimlar as $i=>$a): ?><li class="<?= ($ai !== false && $i <= $ai) ? 'done' : '' ?>"><span><?= $i+1 ?></span><?= guvenli(durumEtiket($a)) ?></li><?php endforeach; ?>
        </ol>
        <?php endif; ?>
        <div class="order-grid">
            <div><small><?= t('Ürün') ?></small><span><?= guvenli($s['detay']) ?></span></div>
            <div><small><?= t('Teslimat') ?></small><span><?= guvenli($s['teslimat']) ?></span><span class="muted"><?= guvenli($s['odeme']) ?></span></div>
            <div><small><?= t('Fiyat') ?></small><b class="amount"><?= number_format($s['tutar'],2) ?> ₺</b></div>
        </div>
        <?php if ($d === 'Hazırlanıyor'): ?>
        <footer>
            <form method="POST" onsubmit="return confirm('<?= dil('Siparişi iptal etmek istediğinize emin misiniz?','Are you sure you want to cancel this order?') ?>')">
                <input type="hidden" name="islem" value="siparis_iptal_musteri">
                <input type="hidden" name="sid" value="<?= guvenli($s['id']) ?>">
                <button class="btn btn-danger" type="submit"><?= dil('Siparişi İptal Et','Cancel Order') ?></button>
            </form>
        </footer>
        <?php endif; ?>
    </article>
    <?php endforeach; endif; ?>

<!-- STOK -->

<?php elseif ($sekme==='stok'): ?>

    <?= adminSekmeler('stok') ?>
    <h2 class="adm-h"><?= t('Stok Takibi') ?></h2>

    <table>
        <tr>
            <th><?= t('Ürün') ?></th>
            <th><?= t('Kategori') ?></th>
            <th><?= t('Fiyat') ?></th>
            <th><?= t('Stok') ?></th>
            <th><?= t('Durum') ?></th>
        </tr>

        <?php foreach ($_SESSION['urunler'] as $u): ?>
        <tr>
            <td><strong><?= t($u['ad']) ?></strong></td>
            <td><?= t($u['kategori']) ?></td>
            <td><?= number_format($u['fiyat'],2) ?> TL</td>
            <td><?= $u['stok'] ?></td>
            <td>
                <span class="badge <?= $u['stok']>5?'badge-ok':'badge-out' ?>">
                    <?= $u['stok']>5 ? t('Stokta') : t('Kritik Stok') ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<!-- SATIŞLAR -->

<?php elseif ($sekme==='satislar'): ?>

    <?= adminSekmeler('satislar') ?>
    <h2 class="adm-h"><?= t('Satış Raporu') ?></h2>

    <?php if (empty($_SESSION['satislar'])): ?>
        <div class="form-card" style="text-align:center"><?= t('Henüz gerçekleşen bir satış bulunmuyor.') ?></div>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th><?= t('Ad Soyad') ?></th>
                <th><?= t('Ürün') ?></th>
                <th><?= t('Teslimat') ?></th>
                <th><?= t('Fiyat') ?></th>
                <th><?= t('Durum') ?></th>
                <th><?= t('Tarih') ?></th>
            </tr>
            <?php foreach ($_SESSION['satislar'] as $s): ?>
            <tr>
                <td>#<?= guvenli($s['id']) ?></td>
                <td><?= guvenli($s['musteri']) ?><br><small style="color:var(--muted)"><?= guvenli($s['email']) ?></small></td>
                <td><?= guvenli($s['detay']) ?></td>
                <td><?= guvenli($s['teslimat']) ?></td>
                <td><strong><?= number_format($s['tutar'],2) ?> TL</strong></td>
                <td><span class="st <?= durumSinif($s['durum'] ?? 'Hazırlanıyor') ?>"><?= guvenli(durumEtiket($s['durum'] ?? 'Hazırlanıyor')) ?></span></td>
                <td><?= guvenli($s['tarih']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

<!-- YÖNETİM -->

<?php elseif ($sekme==='yonetim'): ?>

    <?= adminSekmeler('yonetim') ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px">

        <div class="form-card" style="margin:0">
            <h3 style="color:var(--green);margin-bottom:18px;font-size:20px"><?= t('Yeni Ürün Ekle') ?></h3>

            <form method="POST">
                <input type="hidden" name="islem" value="urun_ekle">

                <div class="form-group">
                    <label><?= t('Ürün Adı') ?></label>
                    <input type="text" name="ad" required>
                </div>

                <div class="form-group">
                    <label><?= t('Kategori') ?></label>
                    <select name="kategori">
                        <?php foreach (array_keys($katalog) as $kat): ?>
                            <option value="<?= guvenli($kat) ?>"><?= t($kat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><?= t('Fiyat') ?> (TL)</label>
                    <input type="number" step="0.01" name="fiyat" required>
                </div>

                <div class="form-group">
                    <label><?= t('Stok Adedi') ?></label>
                    <input type="number" name="stok" value="50" required>
                </div>

                <div class="form-group">
                    <label><?= t('Açıklama') ?></label>
                    <textarea name="aciklama"></textarea>
                </div>

                <button class="btn btn-primary" style="padding:14px"><?= t('Ürünü Kaydet') ?></button>
            </form>
        </div>

        <div class="form-card" style="margin:0">
            <h3 style="color:var(--green);margin-bottom:18px;font-size:20px"><?= t('Mevcut Ürünleri Yönet') ?></h3>

            <div style="max-height:580px;overflow:auto">
                <table>
                    <?php foreach ($_SESSION['urunler'] as $u): ?>
                    <tr>
                        <td>
                            <strong><?= t($u['ad']) ?></strong><br>
                            <small style="color:var(--muted)"><?= number_format($u['fiyat'],2) ?> TL</small>
                        </td>
                        <td style="text-align:right">
                            <form method="POST" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                                <input type="hidden" name="islem" value="urun_sil">
                                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                <button class="btn btn-danger" style="padding:8px 14px;font-size:13px"><?= t('Kaldır') ?></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

<!-- GİRİŞ -->

<?php elseif ($sekme==='giris'): ?>

    <div class="form-card">
        <h2 style="text-align:center;color:var(--green);margin-bottom:24px;font-size:26px">
            <?= t('Hesabınıza Giriş Yapın') ?>
        </h2>

        <form method="POST">
            <input type="hidden" name="islem" value="giris">

            <div class="form-group">
                <label><?= t('E-posta Adresi') ?></label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label><?= t('Şifre') ?></label>
                <input type="password" name="sifre" required>
            </div>

            <button class="btn btn-primary" style="padding:15px;font-size:16px"><?= t('Giriş') ?></button>
        </form>

        <p style="text-align:center;margin-top:18px;font-size:15px">
            <?= $lang==='tr'?'Hesabınız yok mu?':'Don’t have an account?' ?>
            <a href="?sekme=kayit" style="color:var(--green);font-weight:900"><?= t('Kayıt Ol') ?></a>
        </p>
    </div>

<!-- KAYIT -->

<?php elseif ($sekme==='kayit'): ?>

    <div class="form-card">
        <h2 style="text-align:center;color:var(--green);margin-bottom:24px;font-size:26px">
            <?= t('Yeni Hesap Oluştur') ?>
        </h2>

        <form method="POST">
            <input type="hidden" name="islem" value="kayit">

            <div class="form-group">
                <label><?= t('Ad Soyad') ?></label>
                <input type="text" name="ad" required>
            </div>

            <div class="form-group">
                <label><?= t('E-posta Adresi') ?></label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label><?= t('Şifre') ?> (<?= t('Min. 6') ?>)</label>
                <input type="password" name="sifre" minlength="6" required>
            </div>

            <button class="btn btn-primary" style="padding:15px;font-size:16px"><?= t('Kayıt Ol') ?> - %5</button>
        </form>

        <p style="text-align:center;margin-top:18px;font-size:15px">
            <?= $lang==='tr'?'Zaten hesabınız var mı?':'Already have an account?' ?>
            <a href="?sekme=giris" style="color:var(--green);font-weight:900"><?= t('Giriş') ?></a>
        </p>
    </div>

<?php endif; ?>

</div>

<button type="button" class="to-top" id="toTop" aria-label="Top">↑</button>

<!-- WHATSAPP DESTEK BUTONU -->

<a href="https://wa.me/905555555555?text=Merhaba%20KahveTat"
   target="_blank" rel="noopener" class="whatsapp-float"
   title="<?= t('WhatsApp Destek') ?>">💬</a>

<!-- İLETİŞİM BİLGİLERİ VE ALT BİLGİ -->
<footer class="site-footer">
    <div class="footer-contact-wrap">
        <div class="footer-contact-main">
            <div class="footer-brand">
                <div class="footer-brand-mark"><svg viewBox="0 0 32 32" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h17v6.5A6.5 6.5 0 0 1 16.5 25h-4A6.5 6.5 0 0 1 6 18.5V12z"/><path d="M23 14h2.2a3 3 0 0 1 0 6H23"/><path d="M11 3.5c-1.2 1.4 1.2 2.4 0 4M16 3.5c-1.2 1.4 1.2 2.4 0 4M21 3.5c-1.2 1.4 1.2 2.4 0 4" stroke-width="1.8"/></svg></div>
                <div>
                    <strong>KahveTat</strong>
                    <p><?= t('Özenle seçilmiş çekirdekler, usta ellerde hazırlanan eşsiz lezzetler.') ?></p>
                </div>
            </div>
            <div class="footer-contact-details">
                <p><strong>📞 <?= t('Telefon') ?>:</strong> 0 (324) 327 51 51</p>
                <p><strong>🕒 <?= t('Hafta İçi') ?>:</strong> 09:00 - 18:00 &nbsp; | &nbsp; <strong><?= t('Cumartesi') ?>:</strong> 09:00 - 13:00</p>
                <p><strong>✉️ <?= t('E-posta') ?>:</strong> info@kahvetat.com</p>
                <p><strong>📍 <?= t('Adres') ?>:</strong> Keçiören / Ankara</p>
            </div>
        </div>
        <div class="footer-contact-side">
            <h4><?= t('İletişim') ?></h4>
            <p><?= t('Sorularınız ve siparişleriniz için bizimle iletişime geçebilirsiniz.') ?></p>
            <p>💬 <a href="https://wa.me/905555555555" target="_blank" rel="noopener"><?= t('WhatsApp Destek') ?></a></p>
            <p>✉️ <a href="mailto:info@kahvetat.com">info@kahvetat.com</a></p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> KahveTat <?= t('Tüm Hakları Saklıdır.') ?></p>
        <a href="https://wa.me/905555555555" target="_blank" rel="noopener"><?= t('WhatsApp Destek') ?></a>
    </div>
</footer>

<script>
/* Arama alanını temizle ve sonuç listesini ilk hâline döndür */
function clearSearch(button) {
    const form = button.closest('form');
    if (!form) return;
    const field = form.querySelector('input[name="ara"], input[name="tarif_ara"]');
    if (!field) return;
    field.value = '';
    form.submit();
}

/* ARAYÜZ: RENK TEMASI VE ÜRÜN GÖRÜNÜMÜ */
function setTema(ad) {
    document.body.dataset.tema = ad;
    document.cookie = "tema=" + ad + "; path=/; max-age=" + (60*60*24*365);
    document.querySelectorAll('.sw').forEach(function(b){ b.classList.toggle('on', b.dataset.tema === ad); });
}
function setGorunum(ad) {
    document.body.dataset.gorunum = ad;
    document.cookie = "gorunum=" + ad + "; path=/; max-age=" + (60*60*24*365);
    document.querySelectorAll('.seg button').forEach(function(b){ b.classList.toggle('on', b.dataset.gorunum === ad); });
}

/* KAYAN BÖLÜMLER: oklar, sürükleyerek kaydırma, hero otomatik geçiş */
document.querySelectorAll('.sl-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const tr = document.getElementById(btn.dataset.sl);
        if (tr) tr.scrollBy({left: parseInt(btn.dataset.dir, 10) * Math.max(260, tr.clientWidth * 0.8), behavior: 'smooth'});
    });
});
document.querySelectorAll('.sl-track').forEach(function(tr) {
    let down = false, startX = 0, startLeft = 0, moved = false;
    tr.addEventListener('mousedown', function(e) { down = true; moved = false; startX = e.pageX; startLeft = tr.scrollLeft; });
    window.addEventListener('mouseup', function() { if (down) { down = false; tr.classList.remove('drag'); } });
    tr.addEventListener('mousemove', function(e) {
        if (!down) return;
        const dx = e.pageX - startX;
        if (Math.abs(dx) > 5) { moved = true; tr.classList.add('drag'); }
        tr.scrollLeft = startLeft - dx;
    });
    tr.addEventListener('click', function(e) { if (moved) { e.preventDefault(); e.stopPropagation(); moved = false; } }, true);
});

const heroTrack = document.getElementById('heroTrack');
let heroIdx = 0, heroTimer = null;
function heroDots() {
    const dots = document.querySelectorAll('#heroDots button');
    dots.forEach(function(d, i) { d.classList.toggle('on', i === heroIdx); });
}
function heroGit(yon, hedef) {
    if (!heroTrack) return;
    const n = heroTrack.children.length;
    heroIdx = (typeof hedef === 'number') ? hedef : (heroIdx + yon + n) % n;
    heroTrack.scrollTo({left: heroTrack.clientWidth * heroIdx, behavior: 'smooth'});
    heroDots();
    heroBaslat();
}
function heroBaslat() {
    clearInterval(heroTimer);
    heroTimer = setInterval(function() { heroGit(1); }, 6000);
}
if (heroTrack) {
    heroDots();
    heroBaslat();
    heroTrack.addEventListener('scroll', function() {
        const i = Math.round(heroTrack.scrollLeft / heroTrack.clientWidth);
        if (i !== heroIdx) { heroIdx = i; heroDots(); }
    }, {passive: true});
    heroTrack.addEventListener('mouseenter', function() { clearInterval(heroTimer); });
    heroTrack.addEventListener('mouseleave', heroBaslat);
}

/* Görününce beliren öğeler */
(function() {
    const els = document.querySelectorAll('.reveal, .product-card, .stat-card');
    els.forEach(function(el) { el.classList.add('reveal'); });
    if (!('IntersectionObserver' in window)) { els.forEach(function(el) { el.classList.add('in'); }); return; }
    const io = new IntersectionObserver(function(list) {
        list.forEach(function(en) { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
    }, {threshold: 0.08});
    els.forEach(function(el) { io.observe(el); });
})();

/* Açılır paneller: dışarı tıklanınca kapan */
document.addEventListener('click', function(e) {
    document.querySelectorAll('details.pop[open]').forEach(function(d) { if (!d.contains(e.target)) d.removeAttribute('open'); });
});

/* Yukarı çık */
(function() {
    const b = document.getElementById('toTop');
    if (!b) return;
    window.addEventListener('scroll', function() { b.classList.toggle('show', window.scrollY > 600); }, {passive: true});
    b.addEventListener('click', function() { window.scrollTo({top: 0, behavior: 'smooth'}); });
})();

/* GECE / GÜNDÜZ MODU */
function toggleTheme() {
    document.body.classList.toggle('dark-mode');
    const isDark=document.body.classList.contains('dark-mode');
    document.cookie="theme="+(isDark?'dark':'light')+"; path=/; max-age="+(60*60*24*365);
}

/* KART ÖDEME ALANLARI */
function kartAlaniniGoster() {
    const odeme=document.getElementById('odemeTipi');
    const alan=document.getElementById('kartAlanlari');

    if (!odeme || !alan) return;

    const kart=odeme.value==='Kredi Kartı Online';
    alan.classList.toggle('hidden',!kart);

    document.getElementById('kartAd').required=kart;
    document.getElementById('kartNo').required=kart;
    document.getElementById('kartSkt').required=kart;
    document.getElementById('kartCvv').required=kart;
}

document.addEventListener("DOMContentLoaded", function() {
    kartAlaniniGoster();
});

/* KART NUMARASINI DÜZENLE */
const kartNo=document.getElementById('kartNo');
if (kartNo) {
    kartNo.addEventListener('input',function() {
        let deger=this.value.replace(/\D/g,'').substring(0,16);
        this.value=deger.replace(/(.{4})/g,'$1 ').trim();
    });
}

/* SON KULLANMA TARİHİ */
const kartSkt=document.getElementById('kartSkt');
if (kartSkt) {
    kartSkt.addEventListener('input',function() {
        let deger=this.value.replace(/\D/g,'').substring(0,4);
        if (deger.length>=3) {
            deger=deger.substring(0,2)+'/'+deger.substring(2);
        }
        this.value=deger;
    });
}

/* ŞİFRE ALANLARINA GÖZ (göster/gizle) */
document.querySelectorAll('input[type="password"]').forEach(function(inp) {
    const wrap = document.createElement('div');
    wrap.className = 'pw-wrap';
    inp.parentNode.insertBefore(wrap, inp);
    wrap.appendChild(inp);
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'pw-eye';
    btn.textContent = '👁️';
    btn.setAttribute('aria-label', 'Şifreyi göster / gizle');
    btn.addEventListener('click', function() {
        const goster = inp.type === 'password';
        inp.type = goster ? 'text' : 'password';
        btn.textContent = goster ? '🙈' : '👁️';
    });
    wrap.appendChild(btn);
});

/* CVV SADECE RAKAM */
const kartCvv=document.getElementById('kartCvv');
if (kartCvv) {
    kartCvv.addEventListener('input',function() {
        this.value=this.value.replace(/\D/g,'').substring(0,4);
    });
}
</script>

</body>
</html>