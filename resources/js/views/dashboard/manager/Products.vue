<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Products</h1>
          </div>
          <div class="col-auto">
            <button class="btn btn-primary" v-on:click="showAddProductModal">
                <span class="fas fa-plus"></span> 
                Product
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
                            <!-- <th scope="col">Image</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">In Stock</th>
                            <th scope="col">Buy Price</th>
                            <th scope="col">Sell Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td>{{product.name}}</td>
                            <td v-if="product.id">{{product.category.name}}</td>
                            <td v-if="product.id">{{product.sub_category.name}}</td>
                            <td v-if="product.id">{{product.brand.name}}</td>
                            <td v-for="(stock, index) in product.stock" :key="index">
                                {{stock.in_stock}}
                            </td>
                            <td v-if="product.id">{{product.buy_price}}</td>
                            <td v-if="product.id">{{product.sell_price}}</td>
                            <td>
                                <button class="btn btn-primary" v-on:click='editProduct(product)'>
                                    <span class="fas fa-edit"></span>
                                </button>
                                <button class="btn btn-danger" v-on:click="showDeleteProductPop(product)">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Start Here -->
        <!-- Add Product Modal -->
        <b-modal ref="addProductModal"
                title="Add new product"
                no-close-on-backdrop
                hide-footer
            >
            <form style="user-select: auto;" v-on:submit.prevent="addProduct">
                <div class="form-group">
                    <input
                        type="text"
                        placeholder="Product name"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                       
                        v-model="addProductData.name"
                    />
                    <div class="invalid-feedback" v-if="errors.name">
                        {{ errors.name[0] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select
                                class="form-control"
                                v-model="addProductData.brand_id"
                            >
                                <option value="">Choose brand...</option>
                                <option
                                    v-for="(brand, index) in brands"
                                    :key="index"
                                    :value="brand.id"
                                    >{{ brand.name }}</option
                                >
                            </select>
                            <div class="invalid-feedback" v-if="errors.brand_id">
                                {{ errors.brand_id[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input
                                type="number"
                                placeholder="Quantity"
                                class="form-control"
                                spellcheck="false"
                                data-ms-editor="true"
                                pla
                                v-model="addProductData.quantity"
                            />
                            <div class="invalid-feedback" v-if="errors.quantity">
                                {{ errors.quantity[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select
                                    class="form-control"
                                    v-on:change="getSubCategories($event)"
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
                        </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select
                                class="form-control"
                                v-model="addProductData.sub_category_id"
                            >
                                <option value="">Choose sub category...</option>
                                <option
                                    v-for="(subCategory, index) in subCategories"
                                    :key="index"
                                    :value="subCategory.id"
                                    >{{ subCategory.name }}</option
                                >
                            </select>
                            <div class="invalid-feedback" v-if="errors.sub_category_id">
                                {{ errors.sub_category_id[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input
                                type="number"
                                placeholder="Buy Price"
                                class="form-control"
                                spellcheck="false"
                                data-ms-editor="true"
                                pla
                                v-model="addProductData.buy_price"
                            />
                            <div class="invalid-feedback" v-if="errors.buy_price">
                                {{ errors.buy_price[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input
                                type="number"
                                placeholder="Sell Price"
                                class="form-control"
                                spellcheck="false"
                                data-ms-editor="true"
                                pla
                                v-model="addProductData.sell_price"
                            />
                            <div class="invalid-feedback" v-if="errors.sell_price">
                                {{ errors.sell_price[0] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea
                        class="form-control"
                        placeholder="Description"
                        rows="3"
                        spellcheck="false"
                        v-model="addProductData.description"
                    ></textarea>
                    <div class="invalid-feedback" v-if="errors.description">
                        {{ errors.description[0] }}
                    </div>
                </div>
                
                <hr>
                <div class="form-group d-flex flex-row-reverse">
                    <button
                        type="submit"
                        class="btn btn-primary"
                       
                    >
                        Add Product
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideAddProductModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>

        <!-- Edit Product Modal -->
        <b-modal ref="editProductModal"
                title="Update product"
                no-close-on-backdrop
                hide-footer
            >
            <form v-on:submit.prevent="updateProduct">
                <div class="form-group">
                    <label
                        class="text-black font-w500"
                        >Category</label
                    >
                    <select
                        class="form-control"
                        v-model="editProductData.category_id"
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
                        >Sub category</label
                    >
                    <select
                        class="form-control"
                        v-model="editProductData.category_id"
                    >
                        <option value="">Choose sub category...</option>
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
                        >Product Name</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        style="user-select: auto;"
                        v-model="editProductData.name"
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
                        Update Product
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideEditProductModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>
        <!-- Delete Product Modal -->
        <b-modal ref="deleteProductModal"
                title="Delete product"
                no-close-on-backdrop
                hide-footer
            >
            <div class="form-group" style="user-select: auto;">
                <p>
                    Are you sure to delete <b> {{deleteProductData.name}} </b> product ??
                </p>
            </div>
            <hr>
            <div class="form-group d-flex flex-row-reverse">
                <button
                v-on:click="deleteProduct"
                    type="button"
                    class="btn btn-primary"
                >
                    Delete Product
                </button>
                <button
                    type="button"
                    class="btn btn-default"
                    v-on:click="hideDeleteProductModal"
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
import * as productService from '../../../services/productService'
import * as brandService from '../../../services/brandService'
export default {
  name: "Products",
  data() {
    return {
        addProductData: {
            name: '',
            brand_id: '',
            category_id: '',
            sub_category_id: '',
            buy_price: null,
            sell_price: null,
            quantity: null,
            description: ''
        },
        editProductData: {},
        deleteProductData: {},
        brands: [],
        products: [],
        categories: [],
        subCategories: [],
        errors: {}
    }
  },
   mounted() {
       this.$store.state.isLoading = true;
       this.getCategories();
       this.getProducts();
       this.getBrands();
   },
  methods: {
    addProduct: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await productService.addProduct(
                this.addProductData
            );
            this.flashMessage.success({
                message: "Product Added successfully!",
                time: 3000
            });
            this.products.unshift(response.data);
            this.$store.state.isLoading = false;
            this.hideAddProductModal();
            this.addProductData.name = ""
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
            // console.log(response.data)
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    getCategories: async function(){
        try {
            const response = await productService.getCategories();
            this.categories = response.data;
            // console.log(response.data)
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    getSubCategories: async function(event) {
        try {
            const category_id = event.target.value;
            this.addProductData.category_id = category_id;
            this.$store.state.isLoading = true;
            const response = await productService.getSubCategories(category_id);
            this.$store.state.isLoading = false;
            this.subCategories = response.data;
            // console.log(this.subCategories)
        } catch (error) {
            console.log(error);
            this.$store.state.isLoading = false;
        }
    },
    getProducts: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await productService.getProducts();
            this.$store.state.isLoading = false;
            this.products = response.data;
            // console.log(this.products)
        } catch (error) {
            console.log(error);
            this.$store.state.isLoading = false;
        }
    },
    editProduct(product){
        this.editProductData = product;
        this.showEditProductModal();
    },
    updateProduct: async function() {
        try {
            this.$store.state.isLoading = true;
            this.editProductData._method = 'PUT';
            const response = await productService.updateProduct(
                this.editProductData.id, this.editProductData
            );
            this.flashMessage.success({
                message: "Product Update successfully!",
                time: 3000
            });
            this.$store.state.isLoading = false;
            this.hideEditProductModal();
            // this.editProductData.name = ""
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
    showDeleteProductPop(product){
        this.deleteProductData = product;
        this.showDeleteProductModal();
    },
    deleteProduct: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await productService.deleteProduct(
                this.deleteProductData.id, this.deleteProductData
            );
            this.flashMessage.success({
                message: "Product successfully deleted!",
                time: 3000
            });
            this.products.pop(this.deleteProductData);
            this.$store.state.isLoading = false;
            this.hideDeleteProductModal();
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
    showAddProductModal(){
        this.$refs.addProductModal.show();
    },
    hideAddProductModal(){
        this.$refs.addProductModal.hide();
    },
    showEditProductModal(){
        this.$refs.editProductModal.show();
    },
    hideEditProductModal(){
        this.$refs.editProductModal.hide();
    },
    showDeleteProductModal(){
        this.$refs.deleteProductModal.show();
    },
    hideDeleteProductModal(){
        this.$refs.deleteProductModal.hide();
    },
  }
}
</script>
