# خطوات مهمة بعد التحديث | Important Next Steps

## العربية 🇸🇦

### ⚠️ تنبيه مهم

تم نقل إعدادات الهيدر من الكود إلى ملف JSON لدعم اللغات المتعددة. يجب عليك اتباع الخطوات التالية:

### الخطوة 1: مزامنة الحقول الجديدة

1. اذهب إلى: **WordPress Admin → Custom Fields**
2. سترى رسالة في الأعلى تقول **"Sync available"** أو **"مزامنة متاحة"**
3. انقر على **"Sync available"** لاستيراد الحقول الجديدة
4. انتظر حتى تظهر رسالة النجاح

### الخطوة 2: نقل البيانات القديمة

بعد المزامنة، ستحتاج لنقل القيم من الحقول القديمة إلى الجديدة:

1. اذهب إلى: **WordPress Admin → Theme Settings**
2. ستجد **تبويبين جديدين**:
   - **English Settings** - للإعدادات الإنجليزية
   - **الإعدادات العربية** - للإعدادات العربية
3. في تبويب **Other Settings**، ستجد الحقول القديمة التي تحتوي على بياناتك
4. **انسخ القيم** من الحقول القديمة إلى التبويبات الجديدة:

#### البيانات التي يجب نسخها:

##### للإنجليزية (English Settings):
- **Search Label**: انسخ من الحقل القديم "Search Label"
- **Donate Link**: انسخ من الحقل القديم "header action btn"
- **FAQ Link**: انسخ من الحقل القديم "FAQ Link"

##### للعربية (الإعدادات العربية):
- **تسمية البحث**: اكتب "بحث"
- **رابط التبرع**: أضف الرابط والنص بالعربية
- **رابط الأسئلة الشائعة**: أضف الرابط والنص بالعربية

### الخطوة 3: احفظ التغييرات

1. انقر على **"Update"** أو **"تحديث"** لحفظ جميع القيم
2. تحقق من الموقع بكلا اللغتين للتأكد من عمل كل شيء

### الخطوة 4: إضافة الترجمات العربية

1. اذهب إلى: **WordPress Admin → Languages → String translations**
2. ابحث عن النصوص التي تريد ترجمتها (انظر [TRANSLATIONS-GUIDE.md](TRANSLATIONS-GUIDE.md))
3. أضف الترجمة العربية لكل نص
4. احفظ التغييرات
5. امسح الكاش وتحقق من الموقع بالعربية

**دليل كامل:** راجع ملف [TRANSLATIONS-GUIDE.md](TRANSLATIONS-GUIDE.md) لقائمة كاملة بجميع النصوص المطلوب ترجمتها.

### الخطوة 5 (اختياري): حذف الحقول القديمة

بعد التأكد من عمل كل شيء، يمكنك حذف الحقول القديمة المكررة من ACF.

---

## English 🇬🇧

### ⚠️ Important Notice

Header settings have been moved from code to JSON file for multilingual support. You must follow these steps:

### Step 1: Sync New Fields

1. Go to: **WordPress Admin → Custom Fields**
2. You'll see a message at the top saying **"Sync available"**
3. Click **"Sync available"** to import the new fields
4. Wait for the success message

### Step 2: Migrate Old Data

After syncing, you need to copy values from old fields to new ones:

1. Go to: **WordPress Admin → Theme Settings**
2. You'll find **two new tabs**:
   - **English Settings** - For English values
   - **الإعدادات العربية** - For Arabic values
3. In the **Other Settings** tab, you'll find the old fields with your existing data
4. **Copy the values** from old fields to the new tabs:

#### Data to Copy:

##### For English (English Settings tab):
- **Search Label**: Copy from old "Search Label" field
- **Donate Link**: Copy from old "header action btn" field
- **FAQ Link**: Copy from old "FAQ Link" field

##### For Arabic (الإعدادات العربية tab):
- **تسمية البحث (Search Label)**: Enter "بحث"
- **رابط التبرع (Donate Link)**: Add Arabic URL and text
- **رابط الأسئلة الشائعة (FAQ Link)**: Add Arabic URL and text

### Step 3: Save Changes

1. Click **"Update"** to save all values
2. Check your site in both languages to verify everything works

### Step 4: Add Arabic Translations

1. Go to: **WordPress Admin → Languages → String translations**
2. Search for the strings you want to translate (see [TRANSLATIONS-GUIDE.md](TRANSLATIONS-GUIDE.md))
3. Add Arabic translation for each string
4. Save changes
5. Clear cache and check the Arabic version of the site

**Complete Guide:** See [TRANSLATIONS-GUIDE.md](TRANSLATIONS-GUIDE.md) for a complete list of all strings that need translation.

### Step 5 (Optional): Remove Old Fields

After verifying everything works, you can delete the duplicate old fields from ACF.

---

## ملاحظات فنية | Technical Notes

### ما تم تغييره | What Changed

**Before:**
```php
// Old: Single field for all languages
get_field('donate_link', 'option')
```

**After:**
```php
// New: Language-specific fields
// English: get_field('donate_link', 'option')
// Arabic: get_field('donate_link_ar', 'option')
```

### الملفات المعدلة | Modified Files

- ✅ `app/acf/theme-options-fields.php` - تم إفراغه (cleared)
- ✅ `resources/acf-json/group_theme_options_multilingual.json` - الحقول الجديدة (new fields)
- ✅ `resources/views/layout/header.php` - دعم اللغات (multilingual support)

---

## الدعم | Support

إذا واجهت أي مشاكل | If you encounter any issues:

1. تأكد من تفعيل إضافة ACF | Make sure ACF plugin is active
2. تأكد من تفعيل إضافة Polylang | Make sure Polylang plugin is active
3. امسح الكاش | Clear cache
4. راجع ملف التوثيق الكامل | Check full documentation:
   - [MULTILINGUAL-SETUP.md](MULTILINGUAL-SETUP.md)
   - [MULTILINGUAL-SETUP-AR.md](MULTILINGUAL-SETUP-AR.md)
