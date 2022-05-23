const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ['./templates/**/*.html.twig'],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      }
    },
  },
  plugins: [],
}
