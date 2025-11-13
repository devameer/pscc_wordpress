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
                    50: '#f3f7ff',
                    100: '#e6eefe',
                    200: '#c0d8fd',
                    300: '#9ac2fb',
                    400: '#4f95f7',
                    500: '#0469f2',
                    600: '#0554c2',
                    700: '#043f91',
                    800: '#032960',
                    900: '#01142f',
                },
            },
        },
    },
    plugins: [],
};
