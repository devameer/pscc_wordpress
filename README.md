# Beit WordPress Theme

A modern, multilingual WordPress theme with full RTL/LTR support.

## 🌐 Multilingual Support

This theme supports **Arabic** and **English** with automatic RTL/LTR switching using Polylang.

### Quick Setup

1. Install Polylang plugin
2. Configure languages (Arabic + English)
3. Create translations
4. Done! Language switcher appears automatically in header

### 📚 Documentation

- **[POLYLANG-SETUP.md](POLYLANG-SETUP.md)** - Complete Arabic setup guide
- **[MULTILINGUAL-GUIDE.md](MULTILINGUAL-GUIDE.md)** - English guide
- **[TAILWIND-RTL-EXAMPLES.md](TAILWIND-RTL-EXAMPLES.md)** - Tailwind RTL usage
- **[TEST-CHECKLIST.md](TEST-CHECKLIST.md)** - Testing procedures
- **[CHANGES-LOG.md](CHANGES-LOG.md)** - Detailed changelog

## ✨ Features

- ✅ **Bilingual Support**: Arabic (RTL) & English (LTR)
- ✅ **Language Switcher**: Dynamic switcher in header
- ✅ **Automatic Direction**: RTL/LTR switching
- ✅ **Custom Fonts**: Cairo for Arabic, Montserrat for English
- ✅ **Tailwind RTL**: Built-in RTL variants
- ✅ **Responsive**: Mobile-first design
- ✅ **Performance Optimized**: Lazy loading, deferred scripts
- ✅ **SEO Ready**: Proper hreflang and language tags

## 🚀 Installation

### Requirements

- WordPress 6.0+
- PHP 7.4+
- Polylang plugin (Free)

### Steps

1. Upload theme to `/wp-content/themes/beit/`
2. Activate theme in WordPress admin
3. Install and activate Polylang plugin
4. Configure languages (see [POLYLANG-SETUP.md](POLYLANG-SETUP.md))

## 🔧 Configuration

### Polylang Settings

1. Go to **Settings > Languages**
2. Add **Arabic (ar)** - RTL
3. Add **English (en)** - LTR
4. Set default language
5. Create language-specific menus

### Theme Customization

- **Logo**: Upload in **Theme Settings > Site Logo**
- **Colors**: Customizable primary colors
- **Topbar**: Email, phone, social links via ACF
- **Menus**: Create separate menus for each language

## 📁 Theme Structure

```
beit/
├── app/
│   ├── languages.php       # Polylang integration (NEW)
│   ├── setup.php
│   ├── assets.php
│   └── ...
├── public/
│   └── css/
│       ├── app.css
│       └── rtl.css         # RTL styles (NEW)
├── resources/
│   ├── views/
│   │   └── layout/
│   │       └── header.php  # Language switcher (UPDATED)
│   └── assets/
├── functions.php           # (UPDATED)
├── tailwind.config.js      # RTL variants (UPDATED)
└── *.md                    # Documentation
```

## 🎨 RTL/LTR Support

### Automatic Features

- HTML `dir` attribute (`rtl`/`ltr`)
- Body classes (`lang-ar`, `lang-en`, `rtl`, `ltr`)
- Conditional CSS loading
- Font family switching
- Layout direction reversal

### Tailwind RTL Variants

```html
<!-- Margin example -->
<div class="ml-4 rtl:mr-4 rtl:ml-0">Content</div>

<!-- Text alignment -->
<div class="text-left rtl:text-right">Content</div>

<!-- Font family -->
<h1 class="font-sans rtl:font-arabic">Heading</h1>
```

See [TAILWIND-RTL-EXAMPLES.md](TAILWIND-RTL-EXAMPLES.md) for more examples.

## 🔍 Development

### Build Assets

```bash
# Install dependencies
npm install

# Build for development
npm run dev

# Build for production
npm run build

# Watch for changes
npm run watch
```

### File Locations

- **CSS Source**: `resources/assets/css/main.css`
- **Compiled CSS**: `public/css/app.css`
- **RTL CSS**: `public/css/rtl.css`
- **JavaScript**: `resources/assets/js/theme.js`

## 🌍 Supported Languages

- **Arabic (ar)** - العربية - RTL
- **English (en)** - English - LTR

Additional languages can be added via Polylang settings.

## 🧪 Testing

Complete testing checklist available in [TEST-CHECKLIST.md](TEST-CHECKLIST.md).

### Quick Tests

- [ ] Language switcher appears in header
- [ ] Clicking switches between Arabic/English
- [ ] Layout reverses for RTL
- [ ] Fonts change appropriately
- [ ] Menus align correctly
- [ ] Mobile responsive

## 🐛 Troubleshooting

### Language Switcher Not Showing

1. Ensure Polylang is activated
2. Add at least 2 languages
3. Clear browser cache

### RTL Not Working

1. Check Arabic language is set to RTL in Polylang
2. Verify `rtl.css` exists in `public/css/`
3. Hard refresh browser (Ctrl+Shift+R)

### More Issues?

See [TEST-CHECKLIST.md](TEST-CHECKLIST.md) → "Common Issues & Solutions"

## 📦 Dependencies

### Required Plugins

- **Polylang** (Free) - Language management

### Recommended Plugins

- **Advanced Custom Fields (ACF)** - Custom fields
- **Yoast SEO** - SEO optimization (with Polylang integration)

## 🔗 Useful Links

- [Polylang Documentation](https://polylang.pro/doc/)
- [WordPress i18n](https://developer.wordpress.org/apis/internationalization/)
- [Tailwind CSS RTL](https://tailwindcss.com/docs/hover-focus-and-other-states#rtl-support)

## 📄 License

GPL v2 or later

## 👨‍💻 Credits

**Theme**: Beit
**Version**: 1.2.0
**Multilingual Support**: Added 2025-11-28

---

## 🚀 Quick Start Checklist

- [ ] Install Polylang plugin
- [ ] Add Arabic & English languages
- [ ] Set default language (Arabic)
- [ ] Create menu for Arabic
- [ ] Create menu for English
- [ ] Create homepage in Arabic
- [ ] Create homepage in English
- [ ] Link translations
- [ ] Test language switcher
- [ ] Verify RTL/LTR layouts
- [ ] Check mobile responsiveness

---

**Need detailed help?** Read [POLYLANG-SETUP.md](POLYLANG-SETUP.md) (Arabic) or [MULTILINGUAL-GUIDE.md](MULTILINGUAL-GUIDE.md) (English)

Made with ❤️ for WordPress
