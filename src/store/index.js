import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null,
    isEmailVerified: false
  },
  mutations: {
    setSignupFormData(state, data) {
      state.SignupFormData = data;
    },
    setEmailVerified(state, value) {
      state.isEmailVerified = value;
    }
  },
  actions: {
    setSignupFormData(context, data) {
      context.commit('setSignupFormData', data);
    },
    setEmailVerified(context, value){
      context.commit('setEmailVerified', value);
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
