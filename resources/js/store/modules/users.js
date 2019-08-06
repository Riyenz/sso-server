import { ssoHttp } from '../../config';

export default {
  state: {
    users: [],
  },
  getters: {
    users: state => state.users,
  },
  mutations: {
    setUsers(state, payload) {
      state.users = payload;
    },
  },
  actions: {
    async requestUsers({ commit }) {
      const request = await ssoHttp.get('users');

      commit('setUsers', request.data);
    },
    async createUser({ getters, commit }, { name, email, password }) {
      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('password', password);
      const request = await ssoHttp.post('users', formData);

      commit('setUsers', [...getters.users, request.data]);
    },
    async editUser({ getters, commit }, payload) {
      const request = await ssoHttp.patch(`users/${payload.id}`, payload);

      commit('setUsers', getters.users.map(user => {
        if (user.id !== payload.id) return user;
        return request.data;
      }));
    },
    async deleteUser({ getters, commit }, payload) {
      commit('setUsers', getters.users.filter(user => user.id !== payload));

      await ssoHttp.delete(`users/${payload}`);
    },
  }
}
