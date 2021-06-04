const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                aclonica: 'Aclonica',
                lobster: 'Lobster',
                monoton: 'Monoton',
                specialelite: 'Special Elite',
                bebasneue: 'Bebas Neue, cursive',
                montserrat: 'Montserrat, sans-serif',
                opensans: 'Open Sans, sans-serif',
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
