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
        sans: ['"Montserrat"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          DEFAULT: "var(--main-color)",
        },
      },
    },
  },
  plugins: [],
};
