import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Toaster from "@meforma/vue-toaster";

InertiaProgress.init()

createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    title: title => title ? `${title} - Prosperna` : 'Prosperna',
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(Toaster)
            .mount(el)
    },
}).then(r => true)
