import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Core Assets
                'resources/css/app.css',
                'resources/js/app.js',

                // Module: Core
                'Modules/Core/resources/assets/css/custom-icon.css',

                // Module: Customsfiling
                'Modules/Customsfiling/resources/assets/js/ics2_ens.js',

                // Module: NVOCC
                'Modules/NVOCC/resources/assets/css/nvocc.css',
                'Modules/NVOCC/resources/assets/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
