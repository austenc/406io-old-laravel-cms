
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

$(function() {
    $('#sidebar-toggle').click(function() {
        $('#sidebar').removeClass('hidden');
        $('#sidebar-toggle').addClass('hidden');
        $('#sidebar-close').removeClass('hidden');
    });

    $('#sidebar-close').click(function() {
        $('#sidebar').addClass('hidden');
        $('#sidebar-toggle').removeClass('hidden');
        $(this).addClass('hidden');
    })
});

import VueToast from 'vue-toast'

Vue.component('publish-button', require('./components/PublishButton.vue'));

const app = new Vue({
    el: '#app',
    components: {VueToast},
    mounted() {
        window.Toast = this.$refs.toast;
        Toast.setOptions({
            position: 'right bottom',
        });
	}
});

hljs.initHighlightingOnLoad();
