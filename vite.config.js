import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin-dashboard.css',
                'resources/js/app.js',
                'resources/js/app.jsx',
                'resources/js/admin-dashboard.js'
            ],
            refresh: true,
        }),
    ],
});
