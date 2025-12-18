import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindhref="{{ asset('assets/') }}
 from '@tailwindhref="{{ asset('assets/') }}
/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/href="{{ asset('assets/') }}
/app.href="{{ asset('assets/') }}
', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindhref="{{ asset('assets/') }}
(),
    ],
});
