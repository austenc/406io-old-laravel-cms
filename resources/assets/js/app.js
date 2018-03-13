
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Snotify from 'vue-snotify'
import 'vue-snotify/styles/material.scss'

Vue.use(Snotify);

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('publish-button', require('./components/PublishButton.vue'));
Vue.component('update-button', require('./components/UpdateButton.vue'));
Vue.component('markdown-editor', require('./components/MarkdownEditor.vue'));

const app = new Vue({
    el: '#app',
});

hljs.initHighlightingOnLoad();
