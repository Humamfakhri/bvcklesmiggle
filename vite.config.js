import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/header.js',
                'resources/js/navbar.js',
                'resources/js/home.js',
                'resources/js/articles.js',
                'resources/js/products.js',
                'resources/js/partnership.js',
                'resources/js/admin-articles.js',
                'resources/js/admin-products.js',
                'resources/js/trix.umd.min.js',
            ],
            refresh: true,
        }),
    ],
});
