<template>
  <div class="card product">
    <!-- <img src="" class="card-img-top" alt="..." /> -->
    <div class="card-body">
      <div class="product-header">
        <div class="name">
          <p class="card-title product-name">
            {{ product?.product_name }}
          </p>
        </div>
        <div>
          <i class="bi bi-pencil edit" @click="editProduct(product?.product_id)"></i>
          <i class="bi bi-trash3 trash" @click="deleteProduct(product?.product_id)"></i>
          <span class="btn btn-dark" @click="viewProduct(product?.product_id)">View Product</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Product",
  methods : {
    ...mapActions('product',['deleteProduct']),
    viewProduct(id){
      this.$router.push({ name : 'detailproduct', params : {id : id} })
    },
    editProduct(id){
      this.$router.push({ name : 'editproduct', params : { id : id } })
    }
  },
  props : ['product'],
  mounted(){
    console.log(this.product);
  }
};
</script>

<style lang="scss" scoped>
.product {
  .product-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    .name {
      .product-name {
        margin: 0;
        max-width: 20ch;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    }

    div {
      margin: 0;
      i {
        font-size: 25px;
        margin: 0 10px;
      }
      .edit {
        &:hover {
          color: lightgray;
          font-weight: bolder;
          background-color: #ffffff;
        }
      }
      .trash {
        color: #c53c31;
        &:hover {
          color: red;
          font-weight: bolder;
        }
      }
    }
  }
}
</style>
