/* eslint-disable no-unused-vars */
import axiosInstance from "@/axiosInstance";

// would be better for variant to have it's own module

export const state = {
  products: [],
  productToEdit: {},
  updated: null,
  added: null,
  productVariants: [],
  variantAdded: null,
  exist: null,
  variantToEdit: {},
  variantUpdated: null,
};

export const mutations = {
  setProducts: (state, payload) => (state.products = payload),
  setProductToEdit: (state, payload) => (state.productToEdit = payload),
  setUpdated: (state, payload) => (state.updated = payload),
  setAdded: (state, payload) => (state.added = payload),
  setProductVariants: (state, payload) => (state.productVariants = payload),
  setVariantAdded: (state, payload) => (state.variantAdded = payload),
  setExist: (state, payload) => (state.exist = payload),
  setVariantToEdit: (state, payload) => (state.variantToEdit = payload),
  setVariantUpdated: (state, payload) => (state.variantUpdated = payload),
  removeProduct : (state,payload) => state.products = state.products.filter(product => product.product_id !== payload),
  removeProductVariant : (state,payload) => state.productVariants = state.productVariants.filter(productVariant => productVariant.variant_id !== payload)
};

export const actions = {
  async getProducts({ commit }, categoryId) {
    const resp = await axiosInstance.get(`/categories/products/${categoryId}`);
    console.log(resp);
    commit("setProducts", resp.data.products[0].products);
  },

  async getProductToEdit({ commit }, productId) {
    const resp = await axiosInstance.get(`/products/${productId}`);

    console.log(resp.data.product);

    commit("setProductToEdit", resp.data.product);
  },

  async updateProduct({ commit, dispatch }, formData) {
    const categoryId = formData.category_id;
    const productId = formData.product_id;
    commit("setUpdated", null);
    try {
      await axiosInstance.put(`/products/${productId}`, formData);

      dispatch("getProducts", categoryId);

      commit("setUpdated", true);
    } catch (e) {
      console.log(e);
      commit("setUpdated", false);
    }
  },
  //   not a perfect way to dispatch getProducts just to updated the view state, just doing it to manage time, already behind because of the load shedding, lol just saying
  async addProduct({ commit, dispatch }, formData) {
    const categoryId = formData.category_id;
    commit("setAdded", null);
    try {
      await axiosInstance.post(`/products/`, formData);

      dispatch("getProducts", categoryId);

      commit("setAdded", true);
    } catch (e) {
      console.log(e);
      commit("setAdded", false);
    }
  },

  async getProductVariants({ commit }, formData) {
    try {
      const productId = formData.product_id;

      const resp = await axiosInstance.get(`/variants/${productId}/all`);

      commit("setProductVariants", resp.data.variants);
    } catch (e) {
      console.log(e);
    }
  },

  async addProductVariant({ commit, dispatch }, formData) {
    commit("setVariantAdded", null);
    commit("setExist", null);

    try {
      const resp = await axiosInstance.post(`/variants`, formData);

      // eslint-disable-next-line no-prototype-builtins
      if (resp.data?.hasOwnProperty("exist")) commit("setExist", true);
      else {
        commit("setVariantAdded", true);
        dispatch("getProductVariants", { product_id: formData.product_id });
      }
    } catch (e) {
      console.log(e);
    }
  },

  async getVariantById({ commit }, variantId) {
    try {
      const resp = await axiosInstance.get(`variants/${variantId}`);

      commit("setVariantToEdit", resp.data.variant);
    } catch (e) {
      console.log(e);
    }
  },

  async updatedProductVariant({ commit, dispatch }, formData){

    try{

        commit('setVariantUpdated', null)

        const resp = await axiosInstance.put(`/variants`, formData)

        commit('setVariantUpdated', true)

        dispatch('getProductVariants', { product_id : formData.product_id })

    }catch(e){
        console.log(e)
    }

  },

  async deleteProduct({commit}, productId){

    const resp = await axiosInstance.delete(`/products/${productId}`)

    console.log(resp)

    commit('removeProduct', productId)

  },
  
  async deleteVariant({commit}, variantId){

    const resp = await axiosInstance.delete(`/variants/${variantId}`)

    console.log(resp)

    commit('removeProductVariant', variantId)

  }
};

export const getters = {}; // not gonna use getters will map state from component
