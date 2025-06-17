import {defineConfig, loadEnv} from 'vite'
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({command, mode}) => {
    const env = loadEnv(mode, process.cwd(), '')

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: [`resources/views/**/*`],
            }),
            tailwindcss(),
        ],
        server: {
            cors: true,
            open: env.APP_URL,
        },
    };

});
