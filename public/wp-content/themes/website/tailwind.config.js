module.exports = {
  purge: [
      './*.php'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/ui'),
      require('@tailwindcss/typography'),
  ],
}
