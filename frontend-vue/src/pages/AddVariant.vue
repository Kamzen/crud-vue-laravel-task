<template>
  <div class="product-variant">
    <div class="card">
      <div class="card-body">
        <div class="title text-center">Add Variant</div>

        <div
          class="alert alert-success"
          role="alert"
          v-if="variantAdded && variantAdded !== null"
        >
          Variant updated successfully
        </div>

        <div class="alert alert-danger" role="alert" v-if="exist">
          Sap Code or Web Code entered already associated with a product
        </div>

        <form method="POST">
          <div class="mb-3">
            <label for="sap_product_code" class="form-label"
              >Sap Product Code</label
            >
            <input
              type="text"
              class="form-control"
              id="sap_product_code"
              placeholder="Sap Product Code"
              v-model="form.sap_product_code"
              autocomplete="true"
              required
            />
          </div>

          <div class="mb-3">
            <label for="web_product_code" class="form-label"
              >Web Product Code</label
            >
            <input
              type="text"
              class="form-control"
              id="web_product_code"
              placeholder="Web Product Code"
              v-model="form.web_product_code"
              autocomplete="true"
              required
            />
          </div>

          <div class="mb-3">
            <label for="variant_name" class="form-label">Variant Name</label>
            <input
              type="text"
              class="form-control"
              id="variant_name"
              placeholder="Variant Name"
              v-model="form.variant_name"
              autocomplete="true"
              required
            />
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-dark" @click="addVariant">
              Add Variant
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      open: false,
      form: {
        web_product_code: "",
        sap_product_code: "",
        variant_name: "",
      },
    };
  },
  computed : {
    ...mapState('product', ['variantAdded', 'exist'])
  },
  methods: {
    ...mapActions("product", ["addProductVariant"]),
    addVariant(e) {
      e.preventDefault();
      this.form = { ...this.form, product_id: this.$route.params.id };
      this.addProductVariant(this.form);
    },
  },
};
</script>

<style lang="scss">
.product-variant {
  width: 30%;
  margin: 20px auto;

  .title {
    font-size: 20px;
    font-weight: bolder;
  }
}
</style>
