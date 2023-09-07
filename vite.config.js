import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/career.css',
                'resources/css/career-job-post.css',
                'resources/js/app.js'],
            refresh: [
                'app/livewire/**'
            ],
        }),
    ],
});
