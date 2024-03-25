import { createStore } from 'vuex';

export default createStore({
  state: {
    SignupFormData: null
  },
  mutations: {
    setSignupFormData(state, data) {
      state.SignupFormData = data;
    }
  },
  actions: {
    setSignupFormData(context, data) {
      context.commit('setSignupFormData', data);
    }
  },
  getters: {
    getSignupFormData(state) {
      return state.SignupFormData;
    }
  }
});
