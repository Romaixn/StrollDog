import './styles/app.scss';
import "vue-toastification/dist/index.css";

// start the Stimulus application
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, InertiaLink } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Toast from 'vue-toastification'
import { plugin, defaultConfig } from '@formkit/vue'
import { generateClasses } from '@formkit/themes'
import { en, fr } from '@formkit/i18n'

InertiaProgress.init()

const FormKit = plugin

createInertiaApp({
  resolve: name => import(`@/pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component('inertia-link', InertiaLink)
      .mixin({ methods: { route: window.route } })
      .use(plugin)
      .use(Toast)
      .use(FormKit, defaultConfig({
        locales: { en, fr },
        locale: 'fr',
        config: {
          classes: generateClasses({
            global: {
              outer: 'mb-5',
              label: 'block text-sm font-medium text-gray-700',
              input: 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md',
              help: 'text-xs text-gray-500',
              messages: 'list-none p-0 mt-1 mb-0',
              message: 'text-red-500 mb-1 text-xs'
            },
            submit: {
              input: 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'
            }
          })
        },
        plugins: [addAsteriskPlugin]
      }))
      .mount(el)
  },
})

function addAsteriskPlugin (node) {
  node.on('created', () => {
    const schemaFn = node.props.definition.schema
    node.props.definition.schema = (sectionsSchema = {}) => {
      const isRequired = node.props.parsedRules.some(rule => rule.name === 'required')

      if (isRequired) {
        // this input has the required rule so we modify
        // the schema to add an astrics to the label.
        sectionsSchema.label = {
          children: ['$label', ' *']
        }
      }
      return schemaFn(sectionsSchema)
    }
  })
}
