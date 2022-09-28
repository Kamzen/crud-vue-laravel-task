<template>
  <div class="add-category">
    <div class="card login-form-card">
      <div class="card-body">
        <h5 class="card-title form-title text-center">Add Product</h5>

        <div
          class="alert alert-success"
          role="alert"
          v-if="added && added !== null"
        >
          Product updated successfully
        </div>

        <div class="alert alert-danger" role="alert" v-if="added === false">
          Network Error
        </div>

        <form>
          <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input
              type="text"
              class="form-control"
              id="product_name"
              placeholder="Product Name"
              v-model="form.product_name"
              autocomplete="true"
              required
            />
          </div>
          <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input
              type="text"
              class="form-control"
              id="slug"
              placeholder="Slug"
              v-model="form.slug"
              autocomplete="true"
              required
            />
          </div>

          <div class="tag-flex">
            <span class="category" v-for="tag in tags" :key="tag">{{
              tag?.category_name
            }}</span>
          </div>

          <select
            class="form-select form-select-lg mb-3"
            aria-label=".form-select-lg example"
            v-model="mCategory"
            @change="onChange(mCategory)"
            style="margin-top: 20px"
          >
            <option
              v-for="category in categories"
              :key="category.category_id"
              :value="category"
            >
              {{ category.category_name }}
            </option>
          </select>

          <button type="submit" class="btn btn-dark" @click.prevent="add()">
            Add Product
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  name: "AddProduct",
  data() {
    return {
      form: {
        product_name: "",
        slug: "",
      },
      mCategory: {},
      tags: [],
    };
  },
  computed: {
    ...mapState('product', ['added']),
    categories() {
      return this.$store.state.category.categories;
    },
  },
  methods: {
    ...mapActions("product", ["addProduct"]),
    onChange(category) {
      const checkTag = this.tags.filter(
        (mCategory) => mCategory.category_id === category.category_id
      );

      if (checkTag.length === 0) this.tags.push(category);
    },
    add() {
      const ids = [];
      this.tags?.map((tag) => {
        ids.push(tag.category_id);
      });
      this.addProduct({
        ids: ids,
        ...this.form,
        category_id: this.$route.params.id,
      });
    },
  },
  mounted() {
    this.$nextTick(() => {
      this.categories;
    });
  },
};
</script>

<style lang="scss" scoped>
.add-category {
  width: 30%;
  margin: auto;
  margin-top: 20px;

  .tag-flex {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    .category {
      background-color: #212529;
      color: white;
      font-weight: bolder;
      padding: 3px;
      border-radius: 10px;
      margin: 5px;
      font-size: 12px;
    }
  }
}
</style>
