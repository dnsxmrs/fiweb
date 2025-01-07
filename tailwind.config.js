import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.css',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brown: {
                    DEFAULT: '#A27451',
                    hover: '#7E593F',
                },
                gold: {
                    DEFAULT: '#E9B303',
                    hover: '#C69702',
                },
                green: {
                    DEFAULT: '#0FAF00',
                    hover: '#0C9000',
                },
            },
        },
    },
    plugins: [],
};
