import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],

  // 💡 Tambahkan ini supaya Tailwind tahu kamu pakai dark mode berbasis class
  darkMode: 'class',

  theme: {
    extend: {
      // Tambahan opsional biar font & warna bisa dikustom
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          DEFAULT: '#2563eb', // blue-600
          light: '#3b82f6',   // blue-500
          dark: '#1e40af',    // blue-800
        },
      },
    },
  },

  plugins: [
    forms,               // 🔹 plugin form bawaan
    require('flowbite/plugin'), // 🔹 plugin flowbite
  ],
}
