const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
       
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
             colors:{
                red_custom:{
                    light: '#',
                    DEFAULT: '#C97B7D',
                    dark: '#',
                },
                gray_custom:{
                    light: '#',
                    DEFAULT: '#323232',
                    dark: '#343434',
                }
             },
        },
    },

    variants: {
        extend: {
            filter: ['hover', 'focus'],
            overflow: ['hover', 'focus'],
            zIndex: ['hover', 'active'],
        },
        
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
