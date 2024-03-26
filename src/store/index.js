import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null,
    isEmailVerified: false,
    email: null
  },
  mutations: {
    setSignupFormData(state, data) {
      state.SignupFormData = data;
    },
    setEmailVerified(state, value) {
      state.isEmailVerified = value;
    },
    setEmail(state, value) {
      state.email = value;
    }
  },
  actions: {
    setSignupFormData(context, data) {
      context.commit('setSignupFormData', data);
    },
    setEmailVerified(context, value){
      context.commit('setEmailVerified', value);
    },
    setEmail(context, value){
      context.commit('setEmail', value);
    }
  },
  getters: {
    getSignupFormData(state) {
      return state.SignupFormData;
    },
    isEmailVerified(state) {
      return state.isEmailVerified;
    },
    getEmail(state) {
      return state.email;
    }
  }
});