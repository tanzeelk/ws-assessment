import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'vite-plugin-laravel/inertia'
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
	resolve: (name) => resolvePageComponent(name, import.meta.glob('../views/pages/**/*.vue')),
	setup({ el, app, props, plugin }) {
		createApp({ render: () => h(app, props) })
			.use(plugin)
			.component("Link", Link)
			.mount(el)
	},
	title: title => `DAA - ${title}`
})

InertiaProgress.init({
	color: 'red',
	showSpinner: true
});
