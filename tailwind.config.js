const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    "./*.php",
    "./app/**/*.php",
    "./resources/views/**/*.php",
    "./resources/assets/js/**/*.js",
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: "1rem",
        sm: "1.25rem",
        lg: "1.5rem",
        xl: "2rem",
      },
    },
    extend: {
      fontFamily: {
        sans: ['"29LT Bukra"', ...defaultTheme.fontFamily.sans],
        bukra: ['"29LT Bukra"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          DEFAULT: "#CB0B29",
          600: "#CB0B29",
          700: "#A00921",
        },
      },
    },
  },
  plugins: [
    // RTL Support Plugin
    function ({ addVariant }) {
      addVariant('rtl', '[dir="rtl"] &');
      addVariant('ltr', '[dir="ltr"] &');
    },
  ],
};
