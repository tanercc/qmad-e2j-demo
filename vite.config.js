import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            // The Laravel plugin will re-write asset URLs to point to the
            // Laravel web server. This alias will ensure that the Vite
            // server can find the assets in the public directory.
            public: '/public',
            // [Vue warn]: Component provided template option but runtime compilation is not supported in this build of Vue.
            // Configure your bundler to alias "vue" to "vue/dist/vue.esm-bundler.js".
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
