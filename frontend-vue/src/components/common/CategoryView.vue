<template>

  <div class="card category">
    <div class="card-body">
      <div class="category-header">
        <div class="title">
          <span class="card-title category-title">{{
            category?.category_name
          }}</span>
          <span class="category-meta">{{ category?.category_meta_title }}</span>
        </div>
        <div>
          <i
            class="bi bi-pencil edit"
            @click="editCategory(category?.category_id)"
          ></i>
          <i
            class="bi bi-trash3 trash"
            @click="deleteCat(category?.category_id)"
          ></i>
        </div>
      </div>
      <p class="card-text">
        {{ category?.category_meta_keywords }}
      </p>
      <div class="button">
        <a class="btn btn-dark" @click="viewProducts(category?.category_id)"
          >View Products</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Category",
  props: ["category"],
  data() {
    return {};
  },
  methods: {
    ...mapActions("category", ["deleteCategory"]),
    viewProducts(id) {
      this.$router.push({ name: "products", params: { id: id } });
    },
    editCategory(id) {
      this.$router.push({ name: "editcategory", params: { id: id } });
    },
    deleteCat(categoryId) {
      this.deleteCategory(categoryId);
    },
  },
};
</script>
<style scoped lang="scss">
.category {
  .category-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid lightgray;

    .title {
      display: flex;
      flex-direction: column;
      .category-title {
        margin: 0;
        font-weight: bolder;
        font-size: 20px;
        &:hover {
          color: lightgray;
        }
      }

      .category-meta {
        margin: 0;
        max-width: 90ch;
        font-size: 12px;
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
  .card-text {
    width: 100%;
    color: #212f3c;
    line-height: 1.5em;
    height: 7.5em;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 20px;
  }
  .button {
    padding: 0 20px;
  }
}
</style>
