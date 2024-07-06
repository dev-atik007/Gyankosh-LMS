import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'application/resources/css/app.css',
                'application/resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
