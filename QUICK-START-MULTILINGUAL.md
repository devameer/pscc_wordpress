# دليل سريع - الدعم متعدد اللغات | Quick Start - Multilingual Support

## العربية

### ✅ تم الإعداد تلقائياً

تم إضافة دعم كامل للغتين (إنجليزي/عربي) لعناصر الهيدر التالية:
- زر البحث (Search) - النص والرابط
- زر التبرع/الإجراء (Donate Button) - النص والرابط
- رابط الأسئلة الشائعة (FAQ Link) - النص والرابط

### 📝 ماذا تفعل الآن؟

1. **اذهب إلى**: `WordPress Admin > Custom Fields`
2. **ابحث عن**: "Theme Options - Multilingual"
3. **إذا رأيت "Sync available"**: انقر عليه لمزامنة الحقول
4. **اذهب إلى**: `WordPress Admin > Theme Settings`
5. **املأ القيم**:
   - تبويب **English Settings**: للقيم الإنجليزية
   - تبويب **الإعدادات العربية**: للقيم العربية

### 📂 الملفات التي تم تعديلها

```
✓ resources/views/layout/header.php (السطر 40-63)
✓ resources/acf-json/group_theme_options_multilingual.json (جديد)
✓ MULTILINGUAL-SETUP.md (دليل مفصل)
✓ MULTILINGUAL-SETUP-AR.md (دليل عربي)
```

---

## English

### ✅ Auto-Configured

Full bilingual support (English/Arabic) has been added for these header elements:
- Search Button - Text and URL
- Donate/Action Button - Text and URL
- FAQ Link - Text and URL

### 📝 What to do now?

1. **Go to**: `WordPress Admin > Custom Fields`
2. **Look for**: "Theme Options - Multilingual"
3. **If you see "Sync available"**: Click it to sync the fields
4. **Go to**: `WordPress Admin > Theme Settings`
5. **Fill in the values**:
   - **English Settings** tab: For English values
   - **الإعدادات العربية** tab: For Arabic values

### 📂 Modified Files

```
✓ resources/views/layout/header.php (lines 40-63)
✓ resources/acf-json/group_theme_options_multilingual.json (new)
✓ MULTILINGUAL-SETUP.md (detailed guide)
✓ MULTILINGUAL-SETUP-AR.md (Arabic guide)
```

---

## Example Values | أمثلة للقيم

### English Tab
```
Search Label: Search
Donate Link:
  - URL: https://example.com/donate
  - Text: Donate
  - Target: Default
FAQ Link:
  - URL: https://example.com/faq
  - Text: FAQs
  - Target: Default
```

### Arabic Tab | التبويب العربي
```
تسمية البحث: بحث
رابط التبرع:
  - URL: https://example.com/ar/donate
  - النص: تبرع
  - الهدف: Default
رابط الأسئلة:
  - URL: https://example.com/ar/faq
  - النص: الأسئلة الشائعة
  - الهدف: Default
```

---

## How It Works | كيف يعمل

The system automatically detects the current language and displays the appropriate content.

النظام يكتشف اللغة الحالية تلقائياً ويعرض المحتوى المناسب.

**English Site** → Uses `donate_link`, `faq_link`, `topbar_search_label`
**Arabic Site** → Uses `donate_link_ar`, `faq_link_ar`, `topbar_search_label_ar`

---

## Support | الدعم

For detailed documentation, see:
- English: [MULTILINGUAL-SETUP.md](MULTILINGUAL-SETUP.md)
- العربية: [MULTILINGUAL-SETUP-AR.md](MULTILINGUAL-SETUP-AR.md)
