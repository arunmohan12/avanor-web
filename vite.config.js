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
                'resources/css/vendor/propertydetails.css',
                'resources/css/vendor/about.css',
                'resources/css/vendor/privacy.css',
                'resources/css/vendor/terms.css',
                'resources/css/vendor/blog.css',
                'resources/css/vendor/partners.css',
                'resources/css/components/leadform.css',
                'resources/css/components/communities.css',
           
               'resources/css/vendor/devdetails.css',
                'resources/js/pages/contact.js',
                'resources/js/pages/propertydetails.js',
                'resources/js/pages/devdetails.js',
                'resources/js/pages/partners.js',
                'resources/js/app.js',
            

                
                'resources/css/landingpages/the-heightsv2.css',
                'resources/js/landingpages/the-heights.js',
            
            ],
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
