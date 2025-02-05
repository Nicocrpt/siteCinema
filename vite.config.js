import { defineConfig } from 'vite';
import { visualizer } from 'rollup-plugin-visualizer';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        visualizer({ open: true }),
    ],
    build: {
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            // Active le tree shaking via des options Rollup personnalisées
            treeshake: true, // Assure-toi que le tree shaking est activé (par défaut, il l'est)
        } // 1MB par exemple, ajuste selon tes besoins
    },
});
