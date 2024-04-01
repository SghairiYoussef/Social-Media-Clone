import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null,
    isEmailVerified: false,
    rememberMe: false,
    isModified: false
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
    setIsModified(state, value) {
      state.isModified = value;
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
    setIsModified({ commit }, value) {
      commit('setIsModified', value);
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