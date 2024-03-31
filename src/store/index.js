import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null,
    isEmailVerified: false,
    rememberMe: false,
    selectedUser: null
  },
  mutations: {
    setSignupFormData(state, data) {
      state.SignupFormData = data;
    },
    setEmailVerified(state, value) {
      state.isEmailVerified = value;
    },
    setRememberMe(state, value) {
      state.rememberMe = value;
    },
    setSelectedUser(state, user) {
      state.selectedUser = user;
    }
  },
  actions: {
    setSignupFormData(context, data) {
      context.commit('setSignupFormData', data);
    },
    setEmailVerified(context, value){
      context.commit('setEmailVerified', value);
    },
    updateRememberMe(context, value){
      context.commit('setRememberMe', value);
    },
    selectUser({ commit }, user) {
      commit('setSelectedUser', user);
    }
  },
  getters: {
    getSignupFormData(state) {
      return state.SignupFormData;
    },
    isEmailVerified(state) {
      return state.isEmailVerified;
    }
  }
});