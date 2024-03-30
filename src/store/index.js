import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null,
    isEmailVerified: false,
    rememberMe: false
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