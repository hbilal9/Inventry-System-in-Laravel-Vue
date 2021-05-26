<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Sub Categories</h1>
          </div>
          <div class="col-auto">
            <button class="btn btn-primary" v-on:click="showAddCategoryModal">
                <span class="fas fa-plus"></span> 
                Sub Category
            </button>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
          <div class="card p-0">
            <div class="card-body p-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Parent Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(subCategory, index) in subCategories" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td>{{subCategory.name}}</td>
                            <td>{{subCategory.category.name}}</td>
                            <td>
                                <button class="btn btn-primary" v-on:click='editCategory(subCategory)'>
                                    <span class="fas fa-edit"></span>
                                </button>
                                <button class="btn btn-danger" v-on:click="showDeleteCategoryPop(subCategory)">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Start Here -->
        <!-- Add Category Modal -->
        <b-modal ref="addCategoryModal"
                title="Add new category"
                no-close-on-backdrop
                hide-footer
            >
            <form v-on:submit.prevent="addCategory">
                <div class="form-group">
                    <label
                        class="text-black font-w500"
                        >Parent category</label
                    >
                    <select
                        class="form-control"
                        v-model="addCategoryData.category_id"
                    >
                        <option value="">Choose category...</option>
                        <option
                            v-for="(category, index) in categories"
                            :key="index"
                            :value="category.id"
                            >{{ category.name }}</option
                        >
                    </select>
                    <div class="invalid-feedback" v-if="errors.category_id">
                        {{ errors.category_id[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label
                        class="text-black font-w500"
                        style="user-select: auto;"
                        >Category Name</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        style="user-select: auto;"
                        v-model="addCategoryData.name"
                    />
                    <div class="invalid-feedback" v-if="errors.name">
                        {{ errors.name[0] }}
                    </div>
                </div>
                <hr>
                <div class="form-group d-flex flex-row-reverse">
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Category
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideAddCategoryModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>

        <!-- Edit Category Modal -->
        <b-modal ref="editCategoryModal"
                title="Update category"
                no-close-on-backdrop
                hide-footer
            >
            <form style="user-select: auto;" v-on:submit.prevent="updateCategory">
                <div class="form-group" style="user-select: auto;">
                    <label
                        class="text-black font-w500"
                        style="user-select: auto;"
                        >Category Name</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        style="user-select: auto;"
                        v-model="editCategoryData.name"
                    />
                    <div class="invalid-feedback" v-if="errors.name">
                        {{ errors.name[0] }}
                    </div>
                </div>
                <hr>
                <div class="form-group d-flex flex-row-reverse">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="user-select: auto;"
                    >
                        Update Category
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideEditCategoryModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>
        <!-- Delete Category Modal -->
        <b-modal ref="deleteCategoryModal"
                title="Delete category"
                no-close-on-backdrop
                hide-footer
            >
            <div class="form-group" style="user-select: auto;">
                <p>
                    Are you sure to delete <b> {{deleteCategoryData.name}} </b> category ??
                </p>
            </div>
            <hr>
            <div class="form-group d-flex flex-row-reverse">
                <button
                v-on:click="deleteCategory"
                    type="button"
                    class="btn btn-primary"
                >
                    Delete Category
                </button>
                <button
                    type="button"
                    class="btn btn-default"
                    v-on:click="hideDeleteCategoryModal"
                >
                    Cancel
                </button>
            </div>
        </b-modal>
      </div>
    </section>
  </div>
</template>
<script>
import * as subCategoryService from '../../../services/subCategoryService'
export default {
  name: "Categories",
  data() {
    return {
        addCategoryData: {
            category_id: '',
            name: ''
        },
        editCategoryData: {},
        deleteCategoryData: {},
        subCategories: [],
        categories: [],
        errors: {}
    }
  },
   mounted() {
       this.$store.state.isLoading = true;
       this.getCategories();
       this.getSubCategories();
   },
  methods: {
    addCategory: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await subCategoryService.addSubCategory(
                this.addCategoryData
            );
            this.flashMessage.success({
                message: "Category Added successfully!",
                time: 3000
            });
            this.subCategories.unshift(response.data);
            this.$store.state.isLoading = false;
            this.hideAddCategoryModal();
            this.addCategoryData.name = ""
        } catch (error) {
            this.$store.state.isLoading = false;
            // console.log(error.response.status)
            switch (error.response.status) {
                case 422:
                    this.errors = error.response.data.errors;
                    break;

                default:
                    this.flashMessage.error({
                    message: "Some error occurred please try again.",
                    time: 5000
                    });
                    break;
            }
            this.flashMessage.error({
                message: error.response.data.message,
                time: 5000
            });
        }
    },
    getCategories: async function(){
        try {
            const response = await subCategoryService.getCategories();
            this.categories = response.data;
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    getSubCategories: async function(){
        try {
            const response = await subCategoryService.getSubCategories();
            this.subCategories = response.data;
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    editCategory(category){
        this.editCategoryData = category;
        this.showEditCategoryModal();
    },
    updateCategory: async function() {
        try {
            this.$store.state.isLoading = true;
            this.editCategoryData._method = 'PUT';
            const response = await subCategoryService.updateSubCategory(
                this.editCategoryData.id, this.editCategoryData
            );
            this.flashMessage.success({
                message: "Category Update successfully!",
                time: 3000
            });
            this.$store.state.isLoading = false;
            this.hideEditCategoryModal();
            // this.editCategoryData.name = ""
        } catch (error) {
            this.$store.state.isLoading = false;
            // console.log(error.response.status)
            switch (error.response.status) {
                case 422:
                    this.errors = error.response.data.errors;
                    break;

                default:
                    this.flashMessage.error({
                    message: "Some error occurred please try again.",
                    time: 5000
                    });
                    break;
            }
            this.flashMessage.error({
                message: error.response.data.message,
                time: 5000
            });
        }
    },
    showDeleteCategoryPop(category){
        this.deleteCategoryData = category;
        this.showDeleteCategoryModal();
    },
    deleteCategory: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await subCategoryService.deleteSubCategory(
                this.deleteCategoryData.id, this.deleteCategoryData
            );
            this.flashMessage.success({
                message: "Category successfully deleted!",
                time: 3000
            });
            this.categories.pop(this.deleteCategoryData);
            this.$store.state.isLoading = false;
            this.hideDeleteCategoryModal();
        } catch (error) {
            this.$store.state.isLoading = false;
            // console.log(error.response.status)
            switch (error.response.status) {
                case 422:
                    this.errors = error.response.data.errors;
                    break;

                default:
                    this.flashMessage.error({
                    message: "Some error occurred please try again.",
                    time: 5000
                    });
                    break;
            }
            this.flashMessage.error({
                message: error.response.data.message,
                time: 5000
            });
        }
    },
    showAddCategoryModal(){
        this.$refs.addCategoryModal.show();
    },
    hideAddCategoryModal(){
        this.$refs.addCategoryModal.hide();
    },
    showEditCategoryModal(){
        this.$refs.editCategoryModal.show();
    },
    hideEditCategoryModal(){
        this.$refs.editCategoryModal.hide();
    },
    showDeleteCategoryModal(){
        this.$refs.deleteCategoryModal.show();
    },
    hideDeleteCategoryModal(){
        this.$refs.deleteCategoryModal.hide();
    },
  }
}
</script>
