import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                lora: ['Lora', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                primary: '#075985',
                royalBlue: '#0033A0',
                thaiFlagRed: '#DA291C',
                white: '#FFFFFF',
                lightGray: '#F1F1F1',
                thaiGold: '#FFD700',
                darkGray: '#333333',
                lightBlue: '#E6F0FF',
                darkRed: '#A11C22',
            },
        },
    },

    plugins: [forms],
};
