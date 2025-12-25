// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],
//     server: {
//         watch: {
//             ignored: ['**/storage/framework/views/**'],
//         },
//     },
// });


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({

  plugins: [
    laravel(['resources/css/app.css', 'resources/js/app.js', 'resources/js/form.js']),
    tailwindcss(),
  ],

    plugins: [
        laravel([
            "resources/css/app.css",
            "resources/js/app.js",
            "resources/js/dashboard.js",
            "resources/js/authorDashboard.js",
        ]),
        tailwindcss(),
    ],

});