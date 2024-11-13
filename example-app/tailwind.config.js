/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/**/*.blade.php',  // Для файлов Blade (если используете Laravel)
      './resources/**/*.js',         // Для JavaScript файлов в Laravel
      './resources/**/*.vue',        // Если используете Vue.js
      './public/**/*.html',          // Для HTML файлов
      './src/**/*.{html,js}',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

