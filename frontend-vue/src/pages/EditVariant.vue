<template>
  <div class="product-variant">
    <div class="card">
      <div class="card-body">
        <div class="title text-center">Edit Variant</div>

        <div
          class="alert alert-success"
          role="alert"
          v-if="variantUpdated && variantUpdated !== null"
        >
          Variant updated successfully
        </div>

        <!-- <div class="alert alert-danger" role="alert" v-if="exist">
          Sap Code or Web Code entered already associated with a product
        </div> -->

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
              v-model="variantToEdit.sap_product_code"
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
              v-model="variantToEdit.web_product_code"
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
              v-model="variantToEdit.variant_name"
              autocomplete="true"
              required
            />
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-dark" @click.prevent="updateVariant">
              Update Variant
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
    };
  },
  computed: {
    ...mapState("product", ["variantToEdit", 'variantUpdated']),
    variant() {
      return {
        web_product_code: this.variantToEdit.sap_product_code,
        sap_product_code: this.variantToEdit.web_product_code,
        variant_name: this.variantToEdit.variant_name,
        product_id : this.variantToEdit.product_id,
        variant_id : this.variantToEdit.variant_id

      };
    },
  },
  methods: {
    ...mapActions("product", ["getVariantById", 'updatedProductVariant']),
    updateVariant(){
        this.updatedProductVariant(this.variant)
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.getVariantById(this.$route.params.id);
    });
  },
};
</script>

<style lang="scss" scoped>
.product-variant {
  width: 30%;
  margin: 20px auto;

  .title {
    font-size: 20px;
    font-weight: bolder;
  }
}
</style>
