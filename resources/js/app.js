require('./bootstrap');
import {
    App,
    plugin
} from '@inertiajs/inertia-vue'
import Vue from 'vue'
import VueMeta from 'vue-meta'
import {
    InertiaProgress
} from '@inertiajs/progress'
import vuetify from './plugin/vuetify';

import '@mdi/font/css/materialdesignicons.css';


InertiaProgress.init({
    color: '#1A5CFF',
})
Vue.use(plugin)
Vue.use(VueMeta)

const el = document.getElementById('app')

new Vue({
    metaInfo: {
        titleTemplate: title => (title ? `${title} - INVENTARIO UNAP` : 'INVENTARIO UNAP'),
    },
    vuetify,
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(el)
