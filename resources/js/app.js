import test from "./Vue/test";
import AsyncComputed from 'vue-async-computed'

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
import InventoryShow from "./Vue/components/InventoryShow";
import CategoryIndex from "./Vue/components/CategoryIndex";
import BranchIndex from "./Vue/components/BranchIndex";
import BranchShow from "./Vue/components/BranchShow";
import CreateUpdateBranchModal from "./Vue/components/Modals/CreateUpdateBranchModal";
import CreateUpdateInventoryModal from "./Vue/components/Modals/CreateUpdateInventoryModal";

Vue.prototype.console = console;
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(AsyncComputed)

Vue.component('test-test', test);
Vue.component(InventoryIndex.name, InventoryIndex);
Vue.component(InventoryShow.name, InventoryShow);
Vue.component(SimpleTable.name, SimpleTable);
Vue.component(CategoryIndex.name, CategoryIndex);
Vue.component(BranchIndex.name, BranchIndex);
Vue.component(BranchShow.name, BranchShow);
Vue.component(CreateUpdateBranchModal.name, CreateUpdateBranchModal);
Vue.component(CreateUpdateInventoryModal.name, CreateUpdateInventoryModal);

new Vue().$mount('#wrapper')
