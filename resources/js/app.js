import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, app, props }) {
    new Vue({
      render: h => h(app, props),
    }).$mount(el)
  }
})