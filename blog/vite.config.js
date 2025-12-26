import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel([
      "resources/css/app.css",
      "resources/js/app.js",
      "resources/js/dashboard.js",
      "resources/js/authorDashboard.js",
    ]),
    tailwindcss(),
  ],
  resolve: {
    alias: {
      'lucide-icons': 'lucide/dist/esm/icons',
    },
  },
});