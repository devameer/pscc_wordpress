# ميزة معرض الصور مع Lightbox

## الوصف
تم إضافة ميزة معرض الصور (Gallery) لـ Media Library Items مع دعم كامل لـ Lightbox.

## الميزات الجديدة

### 1. حقل Gallery في ACF
- تم إضافة حقل "Gallery Images" في صفحة تحرير Media Item
- يظهر فقط عندما يكون Media Type = Photo
- يسمح بإضافة عدة صور إلى الألبوم
- الصورة البارزة (Featured Image) تُعرض كأول صورة في المعرض

### 2. صفحة عرض Media Item المفردة
- تم إنشاء ملف `single-beit_media.php`
- يعرض جميع الصور (Featured Image + Gallery Images) في شبكة جميلة
- عند النقر على أي صورة، يفتح Lightbox لعرض الصور
- يمكن التنقل بين الصور داخل الـ Lightbox
- يعرض عدد الصور الإجمالي أسفل المعرض

### 3. تحديثات على صفحة Photos Gallery
- الآن عند عرض قائمة الصور، تظهر بطاقة لكل Media Item
- إذا كان المعرض يحتوي على أكثر من صورة واحدة، يظهر عدد الصور في شارة
- عند النقر على الصورة، يفتح Lightbox مباشرة مع جميع صور المعرض (Featured + Gallery)
- يتم إنشاء مجموعة Lightbox فريدة لكل معرض لضمان عدم الخلط بين المعارض المختلفة

### 4. دعم Gallery في الصفحة الرئيسية
- الصور التي تظهر في الصفحة الرئيسية (Voices & Visions) تدعم الآن Gallery
- عند النقر على صورة تحتوي على معرض، يفتح Lightbox مع جميع صور المعرض
- التنقل بين الصور يعمل بنفس الطريقة كما في صفحة Photos Gallery

## كيفية الاستخدام

### 1. إضافة معرض صور جديد
1. من لوحة التحكم، اذهب إلى **Media Library > Add New**
2. أضف عنوان للمعرض
3. اختر **Media Type: Photo**
4. أضف صورة بارزة (Featured Image) - هذه ستكون الصورة الرئيسية
5. في قسم **Gallery Images**، أضف الصور الإضافية للمعرض
6. انقر **Publish**

### 2. عرض المعرض في الموقع
- الصور تظهر في صفحة Photos Gallery (`/photos-gallery/`)
- عند النقر على أي صورة، يفتح Lightbox مباشرة مع جميع صور المعرض
- يمكن التنقل بين الصور داخل الـ Lightbox باستخدام الأسهم
- كل معرض له مجموعة Lightbox خاصة به (عند النقر تظهر صوره فقط)

## الملفات المعدلة

### الملفات الجديدة:
- `single-beit_media.php` - Template لعرض Media Item المفرد

### الملفات المعدلة:
- `app/acf/media-library-fields.php` - إضافة حقل Gallery
- `page-photos-gallery.php` - تحديث لعرض Gallery في Lightbox
- `resources/views/sections/voices.php` - إضافة دعم Gallery في الصفحة الرئيسية
- `resources/assets/css/main.css` - إضافة CSS لتنسيق العناوين في Lightbox
- `resources/assets/js/theme.js` - إضافة كود تفعيل العناوين في FSLightbox

### الملفات الموجودة (لم يتم تعديلها):
- `app/assets.php` - مكتبة fslightbox موجودة مسبقاً
- `app/post-types.php` - post type beit_media موجود مسبقاً

## التقنيات المستخدمة

- **ACF Gallery Field**: لتخزين وإدارة الصور
- **FSLightbox**: لعرض الصور في Lightbox مع العناوين (موجود مسبقاً في الموضوع)
- **Tailwind CSS**: للتصميم
- **AOS**: للـ animations (موجود مسبقاً)
- **Custom CSS**: لتنسيق عرض العناوين في Lightbox

## ملاحظات مهمة

1. الصورة البارزة (Featured Image) إلزامية لعرض المعرض
2. حقل Gallery اختياري - يمكن استخدام الصورة البارزة فقط
3. جميع الصور تُعرض بدقة عالية في Lightbox
4. يتم استخدام lazy loading للصور لتحسين الأداء
5. التصميم responsive ويعمل على جميع الأجهزة
6. دعم كامل للـ RTL (العربية)
7. العناوين تظهر بشكل واضح في Lightbox مع خلفية شبه شفافة
8. تنسيق جميل للعناوين مع ظلال نصية لسهولة القراءة

## أمثلة على الاستخدام

### مثال 1: معرض بسيط (صورة واحدة)
- Featured Image فقط
- Gallery Images: فارغ
- النتيجة: صورة واحدة تُعرض

### مثال 2: معرض كامل (عدة صور)
- Featured Image: صورة رئيسية
- Gallery Images: 5 صور إضافية
- النتيجة: 6 صور تُعرض في الشبكة، يمكن التنقل بينها

---

تاريخ الإنشاء: 2025-12-25
