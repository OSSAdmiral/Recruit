/** @type {import('tailwindcss').Config} */

import preset from './vendor/filament/support/tailwind.config.preset'

export default {
  presets: [preset],
  content: [
      './app/Filament/**/*.php',
      './resources/views/filament/**/*.blade.php',
      './vendor/filament/**/*.blade.php',
      './awcodes/filament-quick-create/resources/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

