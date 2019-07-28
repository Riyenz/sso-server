import { ssoHttp } from '../../config';

export default {
  state: {
    permissions: [],
  },
  getters: {
    permissions: state => state.permissions,
  },
  mutations: {
    setPermissions(state, payload) {
      state.permissions = payload;
    },
  },
  actions: {
    async requestPermissions({ commit }) {
      const request = await ssoHttp.get('permissions');

      commit('setPermissions', request.data);
    },
    async createPermission({ getters, commit }, payload) {
      const formData = new FormData();
      formData.append('name', payload);
      formData.append('guard_name', 'api');
      const request = await ssoHttp.post('permissions', formData);

      commit('setPermissions', [...getters.permissions, request.data]);
    },
    async editPermission({ getters, commit }, payload) {
      const request = await ssoHttp.patch(`permissions/${payload.id}`, payload);

      commit('setPermissions', getters.permissions.map(permission => {
        if (permission.id !== payload.id) return permission;
        return request.data;
      }));
    },
    async deletePermission({ getters, commit }, payload) {
      commit('setPermissions', getters.permissions.filter(permission => permission.id !== payload));

      await ssoHttp.delete(`permissions/${payload}`);
    },
  }
}
