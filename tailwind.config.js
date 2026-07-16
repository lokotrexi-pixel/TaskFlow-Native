/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './index.php',
    './dashboard/**/*.php',
    './project/**/*.php',
    './task/**/*.php',
    './workspace/**/*.php',
    './auth/**/*.php',
    './includes/**/*.php',
    './assets/**/*.{js,css}',
  ],
  theme: {
    extend: {
      colors: {
        background: '#020617',
        sidebar: '#0f172a',
        card: '#1e293b',
        bordercolor: '#334155',
        primary: '#4f46e5',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
      },
    },
  },
  safelist: [
    'translate-x-0',
    '-translate-x-full',
    'hidden',
    'overflow-hidden',
  ],
  plugins: [],
};
