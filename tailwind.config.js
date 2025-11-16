const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './*.php',
        './app/**/*.php',
        './resources/views/**/*.php',
        './resources/assets/js/**/*.js',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1.25rem',
                lg: '1.5rem',
                xl: '2rem',
            },
        },
        extend: {
            fontFamily: {
                sans: ['"Montserrat"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#fef2f3',
                    100: '#fde5e8',
                    200: '#faccd2',
                    300: '#f7b2bb',
                    400: '#f17f8e',
                    500: '#CB0B29',
                    600: '#b70a24',
                    700: '#99081e',
                    800: '#7b0618',
                    900: '#650513',
                    DEFAULT: '#CB0B29',
                },
            },
        },
    },
    plugins: [],
};
