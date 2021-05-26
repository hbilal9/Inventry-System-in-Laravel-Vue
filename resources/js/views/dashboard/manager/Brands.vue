<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Brands</h1>
          </div>
          <div class="col-auto">
            <button class="btn btn-primary" v-on:click="showAddBrandModal">
                <span class="fas fa-plus"></span> 
                Brand
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(brand, index) in brands" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td>{{brand.name}}</td>
                            <td>
                                <button class="btn btn-primary" v-on:click='editBrand(brand)'>
                                    <span class="fas fa-edit"></span>
                                </button>
                                <button class="btn btn-danger" v-on:click="showDeleteBrandPop(brand)">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Start Here -->
        <!-- Add Brand Modal -->
        <b-modal ref="addBrandModal"
                title="Add new brand"
                no-close-on-backdrop
                hide-footer
            >
            <form style="user-select: auto;" v-on:submit.prevent="addBrand">
                <div class="form-group" style="user-select: auto;">
                    <label
                        class="text-black font-w500"
                        style="user-select: auto;"
                        >Brand Name</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        style="user-select: auto;"
                        v-model="addBrandData.name"
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
                        Add Brand
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideAddBrandModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>

        <!-- Edit Brand Modal -->
        <b-modal ref="editBrandModal"
                title="Update brand"
                no-close-on-backdrop
                hide-footer
            >
            <form style="user-select: auto;" v-on:submit.prevent="updateBrand">
                <div class="form-group" style="user-select: auto;">
                    <label
                        class="text-black font-w500"
                        style="user-select: auto;"
                        >Brand Name</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        style="user-select: auto;"
                        v-model="editBrandData.name"
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
                        Update Brand
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideEditBrandModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>
        <!-- Delete Brand Modal -->
        <b-modal ref="deleteBrandModal"
                title="Delete brand"
                no-close-on-backdrop
                hide-footer
            >
            <div class="form-group" style="user-select: auto;">
                <p>
                    Are you sure to delete <b> {{deleteBrandData.name}} </b> brand ??
                </p>
            </div>
            <hr>
            <div class="form-group d-flex flex-row-reverse">
                <button
                v-on:click="deleteBrand"
                    type="button"
                    class="btn btn-primary"
                >
                    Delete Brand
                </button>
                <button
                    type="button"
                    class="btn btn-default"
                    v-on:click="hideDeleteBrandModal"
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
import * as brandService from '../../../services/brandService'
export default {
  name: "Categories",
  data() {
    return {
        addBrandData: {},
        editBrandData: {},
        deleteBrandData: {},
        brands: [],
        errors: {}
    }
  },
   mounted() {
       this.$store.state.isLoading = true;
       this.getBrands();
   },
  methods: {
    addBrand: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await brandService.addBrand(
                this.addBrandData
            );
            this.flashMessage.success({
                message: "Brand Added successfully!",
                time: 3000
            });
            this.brands.unshift(response.data);
            this.$store.state.isLoading = false;
            this.hideAddBrandModal();
            this.addBrandData.name = "";
            this.errors = ""
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
    getBrands: async function(){
        try {
            const response = await brandService.getBrands();
            this.brands = response.data;
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    editBrand(brand){
        this.editBrandData = brand;
        this.showEditBrandModal();
    },
    updateBrand: async function() {
        try {
            this.$store.state.isLoading = true;
            this.editBrandData._method = 'PUT';
            const response = await brandService.updateBrand(
                this.editBrandData.id, this.editBrandData
            );
            this.flashMessage.success({
                message: "Brand Update successfully!",
                time: 3000
            });
            this.$store.state.isLoading = false;
            this.hideEditBrandModal();
            // this.editBrandData.name = ""
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
    showDeleteBrandPop(brand){
        this.deleteBrandData = brand;
        this.showDeleteBrandModal();
    },
    deleteBrand: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await brandService.deleteBrand(
                this.deleteBrandData.id, this.deleteBrandData
            );
            this.flashMessage.success({
                message: "Brand successfully deleted!",
                time: 3000
            });
            this.brands.pop(this.deleteBrandData);
            this.$store.state.isLoading = false;
            this.hideDeleteBrandModal();
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
    showAddBrandModal(){
        this.$refs.addBrandModal.show();
    },
    hideAddBrandModal(){
        this.$refs.addBrandModal.hide();
    },
    showEditBrandModal(){
        this.$refs.editBrandModal.show();
    },
    hideEditBrandModal(){
        this.$refs.editBrandModal.hide();
    },
    showDeleteBrandModal(){
        this.$refs.deleteBrandModal.show();
    },
    hideDeleteBrandModal(){
        this.$refs.deleteBrandModal.hide();
    },
  }
}
</script>
