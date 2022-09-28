<template>
  <NavBar />
  <router-view></router-view>
</template>

<script>
import { mapActions } from 'vuex';
// import Login from './pages/Login.vue'
import NavBar from "./components/nav-bar/NavBar.vue";

export default {
  name: "App",
  components: {
    NavBar,
},

methods : {
  ...mapActions("category", ["fetchCategories"]),
},

mounted(){
  this.fetchCategories();
}

};
</script>

<style lang="scss" scoped></style>
