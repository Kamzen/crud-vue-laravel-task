<template>
  <div class="add-category">
    <div class="card login-form-card">
      <div class="card-body">
        <h5 class="card-title form-title text-center">Add Category</h5>

        <div
          class="alert alert-success"
          role="alert"
          v-if="added && added !== null"
        >
          Product updated successfully
        </div>

        <form>
          <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input
              type="text"
              class="form-control"
              id="category_name"
              placeholder="Category Name"
              v-model="form.category_name"
              autocomplete="true"
            />
          </div>
          <div class="mb-3">
            <label for="category_meta_title" class="form-label">Category Meta Title</label>
            <input
              type="text"
              class="form-control"
              id="category_meta_title"
              placeholder="Category Meta Title"
              v-model="form.category_meta_title"
              autocomplete="true"
            />
          </div>
          <div class="mb-3">
            <label for="category_meta_desc" class="form-label">Category Meta Description</label>
            <input
              type="text"
              class="form-control"
              id="category_meta_desc"
              placeholder="Category Meta Description"
              v-model="form.category_meta_desc"
              autocomplete="true"
            />
          </div>
          <div class="mb-3">
            <label for="category_meta_keywords" class="form-label">Category Meta Keywords</label>
            <input
              type="text"
              class="form-control"
              id="category_meta_keywords"
              placeholder="Category Meta Keywords"
              v-model="form.category_meta_keywords"
              autocomplete="true"
            />
          </div>

          <button type="button" class="btn btn-dark" @click="add">
            Add Category
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
export default {
    name : 'AddCategory',
    data(){
        return{
            form : {
                category_name : '',
                category_meta_title : '',
                category_meta_desc : '',
                category_meta_keywords : ''
            }
        }
    },
    computed : { 
      ...mapState('category', ['added'])
     },

     methods : {
      ...mapActions('category', ['addCategory']),

      add(){
        this.addCategory(this.form)
      }
     }
};
</script>

<style lang="scss" scoped>
.add-category {
  width: 30%;
  margin: auto;
  margin-top: 20px;
}
</style>
