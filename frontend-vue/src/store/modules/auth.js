/* eslint-disable no-unused-vars */
import axios from "axios";
import router from "@/router";
import axiosInstance from "@/axiosInstance";

// just simple store, I won't be using actions type and stuff

const state = {
    userInfo : {},
    errors : {},
    isLoggedIn : false

};

const mutations = {
    setUserInfo : (state, payload) => state.userInfo = { ...payload },
    setErrors : (state, payload) => state.errors = { ...payload },
    setIsLoggedIn : (state, payload) => state.isLoggedIn = payload 
};

// won't be using getters also, will map the state for now

// const getters = {
   
//     getUserInfo : state => state.userInfo,
//     getErrors : state => state.errors

// };

const actions = {

    async login(context, form) {

        context.commit('setErrors', {});

        try {
          const resp = await axios({
            url: `http://localhost:8000/api/local/auth/login`,
            method: "POST",
            data: form,
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
            },
            withCredentials: true,
          });

          console.log(resp.status)

          // set token to local storage
          localStorage.setItem("access-token", resp.data.token);
          localStorage.setItem("userInfo", resp.data.resp);
          context.commit('setUserInfo', resp.data.resp);
          router.push({ name : 'home' })

        } catch (e) {
            console.log(e)
          e.response.status === 422
            ? context.commit('setErrors', e.response.data)
            : context.commit('setErrors', { invalid: "Network error for now" });
        }
      },

      async logout(){

        const resp = await axiosInstance.get('/logout')

        localStorage.clear()

        window.location.href = '/login'


      }

};



export {
    state, 
    mutations,
    // getters,
    actions
}