import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Mapeo de variables CSS a clases Tailwind
                primary: 'var(--color-primary)',
                secondary: 'var(--color-secondary)',
                tertiary: 'var(--color-tertiary)',
                quaternary: 'var(--color-quaternary)',
                
                // Colores auxiliares
                peach: 'var(--color-peach)',
                sky: 'var(--color-sky)',
                'gray-pastel': 'var(--color-gray-pastel)',
                text: 'var(--color-text)'
            },
        },
    },

    plugins: [forms],
};
