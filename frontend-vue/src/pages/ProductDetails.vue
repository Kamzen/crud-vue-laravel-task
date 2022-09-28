<template>
  <div>
    <div style="text-align: center; margin-top: 20px">
      <button class="btn btn-dark" @click="addVariant($route.params.id)">Add Variant</button>
    </div>

    <div class="card product-details">
      <div class="text">Royal Canin Babydog Milk for Puppies</div>
      <span class="card-text text">royal-canin-mini-adult-dry-dog-food</span>
      <div class="card-body">
        <div class="product-header">
          <div class="name">
            <p class="card-title product-details-name">Product Variants</p>
          </div>
        </div>

        <div class="card product-variant" v-for="variant in productVariants" :key="variant.variant_id">
          <p><span class="code">Sap Code : </span><span>&nbsp;&nbsp;&nbsp;{{ variant?.sap_product_code }}</span></p>
          <p><span class="code">Sap Code :</span><span>&nbsp;&nbsp;&nbsp;{{ variant?.web_product_code }}</span></p>
          <p><span class="code">Name :</span><span>&nbsp;&nbsp;&nbsp;{{ variant?.variant_name }}</span></p>

          <div class="variant-btn">
            <i
              class="bi bi-pencil edit"
              @click="editVariant(variant.variant_id)"
            ></i>
            <i class="bi bi-trash3 trash" @click="deleteVariant(variant.variant_id)"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
export default {
  components: {},
  data(){
    return{
      form : {}
    }
  },
  computed : {
    ...mapState('product', ['productVariants'])
  },
  methods : {
    ...mapActions('product', ['getProductVariants', 'deleteVariant']),
    addVariant(id){
      this.$router.push({ name : 'addvariant', params : { id : id } })
    },
    editVariant(id){
      this.$router.push({ name : 'editvariant', params : { id : id } })
    }
  },
  mounted(){
    // console.log(this.$route.params.id)
    this.form = { product_id : this.$route.params.id }
    this.getProductVariants(this.form)

  }
};
</script>

<style lang="scss">
.product-details {
  width: 30%;
  margin: auto;
  margin-top: 20px;
  .name {
    text-align: center;
    .product-details-name {
      border-bottom: 1px solid lightgray;
      font-weight: bold;
      font-size: 20px;
    }
  }
  a {
    margin-top: 10px;
  }

  .text {
    text-align: center;
    margin-top: 10px;
    font-size: 20px;
    font-weight: bolder;
  }
  .card-text {
    font-size: 12px;
    font-weight: lighter;
  }
  .product-variant {
    padding: 5px;
    margin-bottom: 10px;
    .code {
      font-weight: bolder;
    }
    .variant-btn {
      display: flex;
      justify-content: space-between;
      i {
        font-size: 20px;
      }
    }
  }
}
</style>
