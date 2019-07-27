import Vue from 'vue';
import Vuex from 'vuex';
import roles from './modules/roles';

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    roles,
  }
})
