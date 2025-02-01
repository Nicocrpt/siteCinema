import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/css/**/*.css',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            boxShadow: {
                'inner-bl': 'inset 1px 0 3px rgba(0, 0, 0, 0.2), inset 0 -1px 3px rgba(0, 0, 0, 0.2)',
                'inner-br': 'inset -1px 0 3px rgba(0, 0, 0, 0.2), inset 0 -1px 3px rgba(0, 0, 0, 0.2)'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'xs': '530px',
                'xxs' : '400px',

            }
        },
    },

    plugins: [
        forms,

    ],
};
