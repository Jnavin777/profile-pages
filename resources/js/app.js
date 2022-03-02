import test from "./Vue/test";
import InventoryIndex from "./Vue/components/InventoryIndex";

require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Vue from 'vue';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import SimpleTable from "./Vue/Partials/SimpleTable";

Vue.prototype.console = console;
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.component('test-test', test);
Vue.component(InventoryIndex.name, InventoryIndex);
Vue.component(SimpleTable.name, SimpleTable);

new Vue().$mount('#wrapper')
