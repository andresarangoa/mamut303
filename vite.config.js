import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: "192.241.140.157",
            port: process.env.PORT || 3000,
        },
        port: process.env.PORT || 3000, // Default to 3000 if PORT is not set
        host: true,
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
