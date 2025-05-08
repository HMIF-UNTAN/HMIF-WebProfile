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
    safelist: [
        'animate-fade-in-top',
        'animate-fade-in-left',
        'animate-fade-in-right',
        'animate-fade-in-bottom',
        'amimate-blur-in-out-text',
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
                    '0%': { opacity: '0', transform: 'translateY(-100px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeInBottom: {
                    '0%': { opacity: '0', transform: 'translateY(50px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                blurInOutText: {
                    '0%': { filter: 'blur(10px)', opacity: '0' },
                    '100%': { filter: 'blur(0)', opacity: '1' },
                },
            },
            animation: {
                'fade-in-left': 'fadeInLeft 1s ease-out forwards',
                'fade-in-right': 'fadeInRight 1s ease-out forwards',
                'fade-in-top': 'fadeInTop 1s ease-out forwards',
                'fade-in-bottom': 'fadeInBottom 1s ease-out forwards',
                'blur-in-out-text': 'blurInOutText 1s ease-out forwards',
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
