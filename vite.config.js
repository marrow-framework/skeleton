import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

// laravel-vite-plugin isn't Laravel-specific here — it just writes
// public/build/hot and public/build/manifest.json, the layout
// FrameworkExtension's vite_*() Twig functions expect. `refresh` also
// covers PHP source, not just templates, so Vite's own file watcher is
// the sole reload mechanism while `npm run dev` runs (see
// HotReloadMiddleware, which steps aside once it detects that).
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                'resources/views/**/*.twig',
                'modules/**/Views/**/*.twig',
                'app/**/*.php',
                'modules/**/*.php',
                'config/**/*.php',
                'routes/**/*.php',
            ],
        }),
        tailwindcss(),
    ],
});
