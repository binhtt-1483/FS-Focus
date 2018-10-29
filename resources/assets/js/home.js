window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

import VueI18n from 'vue-i18n';
import locales from 'lang';
import httpPlugin from 'plugins/http';
import 'select2/dist/js/select2.full.min.js';

require('bootstrap');
require('social-share.js/dist/js/social-share.min.js');
require('vendor/jquery.fancybox.min.js');
require('vendor/main.js');
window.marked = require('marked');
window.hljs = require('vendor/highlight.min.js');
window.toastr = require('toastr/build/toastr.min.js');
window.voca  = require('voca');

Vue.use(VueI18n);
Vue.use(httpPlugin);

Vue.config.lang = window.Language;

const i18n = new VueI18n({
    locale: Vue.config.lang,
    messages: locales
})

Vue.component('comment', require('home/components/Comment.vue'));

Vue.component('comment-home', require('home/components/CommentHome.vue'));

Vue.component('form-image', require('home/components/FormImage.vue'));

Vue.component('form-content', require('home/components/FormContentPost.vue'));

Vue.component('parse', require('home/components/Parse.vue'));

Vue.component('parse-textarea', require('home/components/Textarea.vue'));

Vue.component('avatar', require('home/components/AvatarUpload.vue'));

Vue.component('clap', require('home/components/Clap.vue'));

new Vue({
    i18n: i18n,
}).$mount('#app');
