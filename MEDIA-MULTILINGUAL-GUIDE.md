# دليل العناوين متعددة اللغات للصور والفيديو
# Multilingual Titles Guide for Photos & Videos

## العربية 🇸🇦

### نظرة عامة

تم إضافة دعم كامل للعناوين باللغتين العربية والإنجليزية لكل من:
- **الصور والفيديو** (`beit_media`)
- **Voices & Visions** (`beit_voice`)

### كيفية استخدام الحقول الجديدة

#### للصور والفيديو (Media Library)

عند إضافة أو تعديل صورة أو فيديو:

1. **عنوان المقال الأساسي (Post Title)**:
   - هذا هو العنوان الإنجليزي الافتراضي
   - سيظهر في الموقع باللغة الإنجليزية

2. **العنوان بالعربي (Arabic Title)**:
   - حقل جديد أسفل عنوان المقال
   - أدخل العنوان باللغة العربية هنا
   - سيظهر تلقائياً عند عرض الموقع باللغة العربية

#### لـ Voices & Visions

عند إضافة أو تعديل منشور Voices & Visions:

1. **Custom Title (English)**:
   - العنوان المخصص بالإنجليزية
   - اختياري - إذا ترك فارغاً، سيستخدم عنوان المقال

2. **العنوان المخصص (عربي)**:
   - العنوان المخصص بالعربية
   - اختياري - إذا ترك فارغاً، سيستخدم عنوان المقال

### الأولويات (Priority System)

النظام يعمل بنظام الأولويات التالي:

#### للغة العربية:
1. **العنوان العربي المخصص** (إذا كان موجوداً)
2. **العنوان الإنجليزي المخصص** (fallback)
3. **عنوان المقال الأساسي** (fallback نهائي)

#### للغة الإنجليزية:
1. **العنوان الإنجليزي المخصص** (إذا كان موجوداً)
2. **عنوان المقال الأساسي** (fallback)

### أين تظهر هذه العناوين؟

العناوين متعددة اللغات تظهر في:

✅ **الصفحة الرئيسية** - قسم Voices & Visions
✅ **صفحة البحث** - نتائج البحث للصور والفيديو
✅ **معرض الصور** - عناوين الصور
✅ **معرض الفيديو** - عناوين الفيديوهات
✅ **Lightbox Captions** - التسميات التوضيحية
✅ **صفحات المنشورات الفردية** - العنوان الرئيسي والمقالات ذات الصلة

---

## English 🇬🇧

### Overview

Full bilingual support (Arabic/English) has been added for titles in:
- **Photos & Videos** (`beit_media`)
- **Voices & Visions** (`beit_voice`)

### How to Use the New Fields

#### For Photos & Videos (Media Library)

When adding or editing a photo or video:

1. **Post Title**:
   - This is the default English title
   - Will be displayed on the English version of the site

2. **العنوان بالعربي (Arabic Title)**:
   - New field below the post title
   - Enter the Arabic title here
   - Will automatically display when viewing the site in Arabic

#### For Voices & Visions

When adding or editing a Voices & Visions post:

1. **Custom Title (English)**:
   - Custom English title
   - Optional - if left empty, will use the post title

2. **العنوان المخصص (عربي) (Arabic Custom Title)**:
   - Custom Arabic title
   - Optional - if left empty, will use the post title

### Priority System

The system works with the following priority order:

#### For Arabic Language:
1. **Arabic Custom Title** (if exists)
2. **English Custom Title** (fallback)
3. **Post Title** (final fallback)

#### For English Language:
1. **English Custom Title** (if exists)
2. **Post Title** (fallback)

### Where Do These Titles Appear?

Multilingual titles appear in:

✅ **Homepage** - Voices & Visions section
✅ **Search Page** - Search results for photos and videos
✅ **Photos Gallery** - Photo titles
✅ **Videos Gallery** - Video titles
✅ **Lightbox Captions** - Caption text
✅ **Single Post Pages** - Main title and related posts

---

## مثال عملي | Practical Example

### مثال: صورة في معرض الصور

```
Post Title (English): "Children Playing in the Park"
العنوان بالعربي (Arabic): "أطفال يلعبون في الحديقة"
```

**النتيجة:**
- الموقع الإنجليزي: "Children Playing in the Park"
- الموقع العربي: "أطفال يلعبون في الحديقة"

### Example: Video in Voices & Visions

```
Post Title: "Annual Charity Event 2024"
Custom Title (English): "Our Impact This Year"
العنوان المخصص (عربي): "تأثيرنا هذا العام"
```

**Result:**
- English Site: "Our Impact This Year"
- Arabic Site: "تأثيرنا هذا العام"

---

## الدعم الفني | Technical Support

### الدالة المستخدمة | Function Used

```php
beit_get_multilingual_title($post_id, $post_type)
```

هذه الدالة تتعامل تلقائياً مع:
- اكتشاف اللغة الحالية
- اختيار العنوان المناسب حسب نظام الأولويات
- Fallback إلى القيم الافتراضية عند الحاجة

This function automatically handles:
- Detecting current language
- Selecting appropriate title based on priority system
- Fallback to default values when needed

### الحقول في قاعدة البيانات | Database Fields

#### For `beit_media`:
- `media_custom_title_ar` - Arabic title

#### For `beit_voice`:
- `voice_custom_title` - English custom title
- `voice_custom_title_ar` - Arabic custom title

---

## ملاحظات مهمة | Important Notes

⚠️ **ملاحظة:** إذا لم تضف عنوان عربي، سيظهر العنوان الإنجليزي في الموقع العربي
⚠️ **Note:** If you don't add an Arabic title, the English title will appear on the Arabic site

✅ **نصيحة:** دائماً أضف العناوين بكلا اللغتين للحصول على أفضل تجربة مستخدم
✅ **Tip:** Always add titles in both languages for the best user experience

🔄 **تحديث تلقائي:** التغييرات تظهر فوراً بدون الحاجة لمسح الكاش
🔄 **Auto-Update:** Changes appear immediately without needing to clear cache
