# Multilingual ACF Fields Setup Guide

This theme supports full multilingual functionality using Polylang. The language-specific ACF fields have been **automatically created** for you.

## ✅ Auto-Generated Fields

The following ACF fields have been automatically created via JSON sync:

### 1. Search Label
- **English Field**: `topbar_search_label` (Text field)
- **Arabic Field**: `topbar_search_label_ar` (Text field)

### 2. Donate/Action Button Link
- **English Field**: `donate_link` (Link field - includes URL, title, and target)
- **Arabic Field**: `donate_link_ar` (Link field - includes URL, title, and target)

### 3. FAQ Link
- **English Field**: `faq_link` (Link field - includes URL, title, and target)
- **Arabic Field**: `faq_link_ar` (Link field - includes URL, title, and target)

## How to Access These Fields

**No manual field creation needed!** The fields are stored in:
```
resources/acf-json/group_theme_options_multilingual.json
```

ACF will automatically sync these fields when you:
1. Go to **WordPress Admin > Custom Fields**
2. You'll see a notification about field groups to sync
3. Click "Sync available" to import the fields

Alternatively, the fields will be automatically loaded on your next page load.

## How It Works

The theme automatically detects the current language and loads the appropriate fields:

- **English (en)**: Uses fields without suffix (`donate_link`, `faq_link`, `topbar_search_label`)
- **Arabic (ar)**: Uses fields with `_ar` suffix (`donate_link_ar`, `faq_link_ar`, `topbar_search_label_ar`)
- **Fallback**: If a language-specific field is empty, it falls back to the default English field
- **Double Fallback**: If both ACF fields are empty, it uses the registered Polylang string translations

## Setting Field Values

1. Go to **WordPress Admin > Theme Options** (or wherever your ACF options page is located)
2. Fill in both English and Arabic versions of each field:
   - For Link fields: Set both the URL and link text for each language
   - For Text fields: Enter the translated text

## Example Values

### English Values:
- **topbar_search_label**: "Search"
- **donate_link**:
  - URL: https://example.com/donate
  - Link Text: "Donate"
  - Target: Default
- **faq_link**:
  - URL: https://example.com/faq
  - Link Text: "FAQs"
  - Target: Default

### Arabic Values:
- **topbar_search_label_ar**: "بحث"
- **donate_link_ar**:
  - URL: https://example.com/ar/donate
  - Link Text: "تبرع"
  - Target: Default
- **faq_link_ar**:
  - URL: https://example.com/ar/faq
  - Link Text: "الأسئلة الشائعة"
  - Target: Default

## Additional Languages

To add support for more languages (e.g., French - fr):

1. Add new ACF fields with the language suffix: `donate_link_fr`, `faq_link_fr`, `topbar_search_label_fr`
2. The code in `header.php` will automatically use these fields when the site is viewed in French

## Technical Notes

- Language detection: `pll_current_language('slug')` returns the current language code
- Field naming pattern: `{field_name}_{language_code}`
- Code location: `resources/views/layout/header.php` (lines 40-63)
- Registered translations: See `app/languages.php` for all registered Polylang strings
