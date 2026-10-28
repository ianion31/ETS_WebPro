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
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Biru tua untuk sidebar dan panel
                ink: { DEFAULT: '#0d2352', 800: '#14306b', 700: '#1c3f85' },
                // Biru aksi: tombol, link, grafik
                brand: { DEFAULT: '#1f56d6', dark: '#1846b0', soft: '#e8efff' },
                // Kuning emas: penanda menu aktif dan sorotan kecil
                gold: { DEFAULT: '#f6b21a', soft: '#fff4d6' },
                // Latar halaman
                paper: '#f3f5f9',
            },
        },
    },

    plugins: [forms],
};
