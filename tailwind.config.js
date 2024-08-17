/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'custom-gray': '#E0E0E0', // Add custom color here
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

