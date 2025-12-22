# BEIT Theme - Translation Guide

## إرشادات الترجمة

هذا الدليل يوضح كيفية إضافة الترجمات للثيم.

## الطريقة 1: استخدام Polylang (الطريقة الموصى بها)

الثيم يدعم Polylang بشكل كامل. جميع النصوص الثابتة مسجلة تلقائياً في Polylang.

### الخطوات:
1. تثبيت وتفعيل إضافة Polylang
2. إضافة اللغة العربية في إعدادات Polylang
3. الذهاب إلى: **Languages → String translations**
4. البحث عن النصوص وترجمتها

### النصوص المسجلة للتقارير السنوية والمنشورات:

#### العربية:
- **Year** → **السنة**
- **Download Report** → **تحميل التقرير**
- **Download Publication** → **تحميل المنشور**
- **No Annual Reports Found** → **لم يتم العثور على تقارير سنوية**
- **No Publications Found** → **لم يتم العثور على منشورات**
- **Check back soon for the latest reports.** → **تحقق قريباً للحصول على أحدث التقارير.**
- **Check back soon for the latest publications.** → **تحقق قريباً للحصول على أحدث المنشورات.**
- **Reports pagination** → **ترقيم صفحات التقارير**
- **Publications pagination** → **ترقيم صفحات المنشورات**
- **No annual reports found. Please add some via the dashboard.** → **لم يتم العثور على تقارير سنوية. يرجى إضافة بعضها عبر لوحة التحكم.**
- **No publications found. Please add some via the dashboard.** → **لم يتم العثور على منشورات. يرجى إضافة بعضها عبر لوحة التحكم.**

## الطريقة 2: استخدام ملفات .po/.mo

إذا كنت تستخدم ووردبريس بدون Polylang، يمكنك استخدام ملفات الترجمة التقليدية.

### الملفات المتاحة:
- `ar.po` - ملف الترجمة العربية (يمكن تحريره بواسطة Poedit)
- `ar.mo` - ملف الترجمة المترجم (يتم إنشاؤه تلقائياً)

### كيفية التحديث:
1. افتح ملف `ar.po` باستخدام [Poedit](https://poedit.net/)
2. قم بتحديث الترجمات
3. احفظ الملف (سيتم إنشاء `ar.mo` تلقائياً)
4. ارفع الملفات إلى `wp-content/themes/beit/resources/languages/`

## Custom Post Types المدعومة في Polylang

الثيم يدعم الترجمة لجميع أنواع المحتوى المخصصة:
- Hero Slides (السلايدر الرئيسي)
- News (الأخبار)
- Programs (البرامج والمشاريع)
- **Annual Reports (التقارير السنوية)**
- **Publications (المنشورات)**

## ملاحظات مهمة

1. **ACF Fields**: جميع حقول ACF تستخدم `__()` للترجمة
2. **Template Strings**: جميع النصوص في القوالب قابلة للترجمة
3. **Admin Strings**: نصوص لوحة التحكم مترجمة بواسطة ووردبريس
4. **Dynamic Content**: المحتوى الديناميكي (العناوين، المحتوى) يُترجم عبر Polylang

## الدعم الفني

للمساعدة في الترجمة، يرجى مراجعة:
- [Polylang Documentation](https://polylang.pro/doc/)
- [WordPress i18n Documentation](https://developer.wordpress.org/plugins/internationalization/)
