<template>
  <div>
    <div class="add-button" style="text-align : center; margin-bottom : 20px">
      <a class="btn btn-dark" style="margin-top : 20px;" @click="addProduct">Add Product</a>
    </div>
    <div class="category-products">
      <Product
        class="mg"
        v-for="product in products"
        :key="product.product_id"
        :product="product"
      />
    </div>
  </div>
</template>

<script>
import Product from "@/components/common/Product.vue";
import { mapActions, mapState } from "vuex";
export default {
  name: "CategoryProducts",

  data() {
    return {
      categoryId: this.$route.params.id,
    };
  },
  computed: {
    ...mapState("product", ["products"]),
  },
  methods: {
    ...mapActions("product", ["getProducts"]),
    addProduct(){
      this.$router.push({ name : 'addproduct' })
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.getProducts(this.categoryId);
      console.log(this.products);
    });
  },
  components: { Product },
};
</script>

<style lang="scss" scoped>
.category-products {
  width: 30%;
  margin: auto;
  .mg{
    margin-bottom: 20px;
  }
}
</style>
