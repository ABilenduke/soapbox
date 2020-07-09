/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import vuetify from '~/plugins/vuetify'
import App from '~/components/App'
// import VueMoment from 'vue-moment'

import '~/plugins'
import '~/components'

// Vue.use(VueMoment);
Vue.config.productionTip = false

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
  i18n,
  router,
  store,
  vuetify,
  ...App
});
