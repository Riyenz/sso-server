import { ssoHttp } from '../../config';

export default {
  state: {
    roles: [],
  },
  getters: {
    roles: state => state.roles,
  },
  mutations: {
    setRoles(state, payload) {
      state.roles = payload;
    },
  },
  actions: {
    async requestRoles({ commit }) {
      const request = await ssoHttp.get('roles');

      commit('setRoles', request.data);
    },
    async createRole({ getters, commit }, payload) {
      const formData = new FormData();
      formData.append('name', payload);
      formData.append('guard_name', 'api');
      const request = await ssoHttp.post('roles', formData);

      commit('setRoles', [...getters.roles, request.data]);
    },
    async editRole({ getters, commit }, payload) {
      const request = await ssoHttp.patch(`roles/${payload.id}`, payload);

      commit('setRoles', getters.roles.map(role => {
        if (role.id !== payload.id) return role;
        return request.data;
      }));
    },
    async deleteRole({ getters, commit }, payload) {
      commit('setRoles', getters.roles.filter(role => role.id !== payload));

      await ssoHttp.delete(`roles/${payload}`);
    },
  }
}
