import './styles/app.scss';
import "vue-toastification/dist/index.css";

// start the Stimulus application
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, InertiaLink } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Toast from 'vue-toastification';

InertiaProgress.init()

createInertiaApp({
  resolve: name => import(`@/pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component('inertia-link', InertiaLink)
      .mixin({ methods: { route: window.route } })
      .use(plugin)
      .use(Toast)
      .mount(el)
  },
})
