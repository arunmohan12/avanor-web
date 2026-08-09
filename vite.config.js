import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/css/vendor/home.css',
                'resources/css/vendor/contact.css',
                'resources/js/pages/home.js',
                'resources/css/vendor/property-search.css',
                'resources/css/vendor/about.css',
                'resources/css/vendor/privacy.css',
                'resources/css/vendor/terms.css',
                'resources/js/pages/contact.js',
                
                'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
     
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
