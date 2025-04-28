import defaultTheme from 'tailwindcss/defaultTheme';
import plugin from 'tailwindcss/plugin';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                fadeInLeft: {
                    '0%': { opacity: '0', transform: 'translateX(-50px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                fadeInRight: {
                    '0%': { opacity: '0', transform: 'translateX(50px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                fadeInTop: {
                    '0%': { opacity: '0', transform: 'translateY(-50px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
            animation: {
                'fade-in-left': 'fadeInLeft 1s ease-out forwards',
                'fade-in-right': 'fadeInRight 1s ease-out forwards',
                'fade-in-top': 'fadeInTop 1s ease-out forwards',
            },
        },
    },
    plugins: [
        plugin(function ({ addUtilities }) {
            addUtilities({
                '.text-shadow': {
                    'text-shadow': '2px 2px 4px rgba(0, 0, 0, 0.5)',
                },
                '.text-shadow-sm': {
                    'text-shadow': '1px 1px 2px rgba(0, 0, 0, 0.5)',
                },
                '.text-shadow-lg': {
                    'text-shadow': '3px 3px 6px rgba(0, 0, 0, 0.7)',
                },
                '.text-shadow-none': {
                    'text-shadow': 'none',
                },
            });
        }),
    ],
};
