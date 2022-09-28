/* eslint-disable no-unused-vars */
import axiosInstance from "@/axiosInstance";

export const state = {
  categories: [],
  added: null,
  categoryToEdit: {},
  updated: null,
  deleted : null
};

export const mutations = {
  setCategories: (state, payload) => (state.categories = payload),
  setAdded: (state, payload) => (state.added = payload),
  setCategoryToEdit: (state, payload) => (state.categoryToEdit = payload),
  setUpdated: (state, payload) => (state.updated = payload),
  setDeleted : (state, payload) => state.deleted = payload,
  deleteCategory : (state, payload) => state.categories = state.categories.filter(category => category.category_id !== payload)
};

export const actions = {
  async fetchCategories({ commit }) {
    try {
      const resp = await axiosInstance.get("/categories");

      // console.log(resp)

      commit("setCategories", resp.data.resp);
    } catch (e) {
      console.log(e); // for now to save time
    }
  },

  async addCategory({ commit, dispatch }, formData) {
    commit("setAdded", null);

    try {
      const resp = await axiosInstance.post("/categories", formData);

      commit("setAdded", true);

      // you don't wanna do this, you have to manage your state well
      dispatch("fetchCategories");
    } catch (e) {
      console.log(e);
    }
  },

  async getCategoryById({ commit }, categoryId) {
    try {
      const resp = await axiosInstance.get(`/categories/${categoryId}`);
      // console.log(resp.data.resp)
      commit("setCategoryToEdit", resp.data.resp);
    } catch (e) {
      console.log(e);
    }
  },

  async updateCategory({ commit, dispatch }, formData) {
    try {
      commit("setUpdated", null);

      const resp = await axiosInstance.put(
        `/categories/${formData.category_id}`,
        formData
      );

      commit("setUpdated", true);

      dispatch("fetchCategories");
    } catch (e) {
      console.log(e);
    }
  },

  async deleteCategory({commit}, categoryId){

    commit('setDeleted', null)

    const resp = await axiosInstance.delete(`/categories/${categoryId}`)

    console.log(resp)

    commit('deleteCategory', categoryId)

    commit('setDeleted', true)

  }
};

export const getters = {
  getCategories: (state) => state.categories,
};
