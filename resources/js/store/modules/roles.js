import { ssoHttp } from '../../config';

export default {
  state: {
    roles: [],
    isLoading: false,
    isLoaded: false,
  },
  getters: {
    roles: state => state.roles,
    isLoading: state => state.isLoading,
    isLoaded: state => state.isLoaded,
  },
  mutations: {
    setRoles(state, payload) {
      state.roles = payload;
    },
    loading(state) {
      state.isLoading = true;
      state.isLoaded = false;
    },
    loadSuccess(state) {
      state.isLoading = false;
      state.isLoaded = true;
    },
    loadError(state) {
      state.isLoading = false;
      state.isLoaded = false;
    }
  },
  actions: {
    async requestRoles({ commit }) {
      try {
        const request = await ssoHttp.get('roles');
        commit('setRoles', request.data);
        commit('loadSuccess');
      } catch (error) {
        commit('loadError');
      }
    }
  }
}
