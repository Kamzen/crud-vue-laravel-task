<template>
  <div class="add-button" style="text-align: center; margin-bottom: 20px">
    <a class="btn btn-dark" style="margin-top: 20px" @click="addCategory">Add Category</a>
  </div>

  <div class="home">
    <CategoryView
      v-for="category in categories"
      :key="category.category_id"
      :category="category"
      class="mg"
    />
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import CategoryView from "../components/common/CategoryView.vue";

export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Home",
  components: {
    CategoryView,
  },
  data() {
    return {};
  },
  mounted() {
    this.$nextTick(() => {
      console.log(this.categories);
      this.fetchCategories();
    });
  },
  computed: {
    ...mapState("category", ["categories"]),
  },
  methods: {
    ...mapActions("category", ["fetchCategories"]),
    addCategory(){
      this.$router.push({ name : 'addcategory' })
    }
  },
  beforeRouteEnter(_to, _from, _next) {
    _next((vm) => {
      !localStorage.getItem("access-token") &&
        vm.$router.push({ name: "login" });
    });
  },
};
</script>



<style lang="scss" scoped>
.home {
  width: 50%;
  margin: 20px auto auto;

  .mg {
    margin-bottom: 20px;
  }
}
</style>
