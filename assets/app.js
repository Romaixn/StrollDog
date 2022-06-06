import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, InertiaLink } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`@/pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component('inertia-link', InertiaLink)
      .mixin({ methods: { route: window.route } })
      .use(plugin)
      .mount(el)
  },
})
