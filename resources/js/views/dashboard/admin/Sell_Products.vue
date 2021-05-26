<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0">Manage Sell</h1>
          </div>
          <div class="col-sm-7" v-if="searchBar">
                <form v-on:submit.prevent="getSearchResult">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border"
                            type="text" placeholder="Search product..."
                            v-model="searchData"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="input-group-text amber lighten-3" type="submit">
                                <i class="fas fa-search text-grey" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
          <div class="card p-0">
            <div class="card-body p-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="search-tab"
                        data-toggle="tab" href="#search" role="tab"
                        v-on:click="searchBar=true"
                        aria-controls="home" aria-selected="true">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="cart-tab"
                        v-on:click="searchBar=false"
                        data-toggle="tab" href="#cart" role="tab"
                        @click="getCartProducts"
                        aria-controls="profile" aria-selected="false">Cart</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Search Result Tab -->
                    <div class="tab-pane fade show active" id="search" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-4 p-4"
                                v-for="(result, index) in searchResults" :key="index">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">{{result.name}}</h5>
                                        <p class="card-text">{{result.description}}</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input v-model="result.quantity" type="number"
                                                    class="form-control" placeholder="Qty"
                                                    style="width: 100px">
                                            </div>
                                            <div class="col-sm-6">
                                                <button v-on:click="addToCard(result)" class="btn btn-primary">
                                            add to cart
                                        </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cart Tab -->
                    <div class="tab-pane fade" id="cart" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <!-- <th scope="col">Image</th> -->
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Sub Total</th>
                                    <!-- <th scope="col">Date</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products" :key="index">
                                <th scope="row">{{index + 1}}</th>
                                    <td v-if="product.id">{{product.product.name}}</td>
                                    <td v-if="product.id">{{product.product.sell_price}}</td>
                                    <td v-if="product.id">{{product.quantity}}</td>
                                    <td v-if="product.id">{{product.brand.name}}</td>
                                    <td  v-if="product.id">{{product.total}}</td>
                                    <!-- <td><input type="date" v-model="product.date"></td> -->
                                    <td>
                                        <button class="btn btn-success" v-on:click="calculateTotal(product)">
                                            <span class="fas fa-check"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- total price card -->
        <div class="row justify-content-md-center" v-if="!searchBar">
            <div class="col-sm-8">
                <div class="card p-4"  v-if="totalCart">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                v-for="(data, index) in cartData" :key="index"
                            >
                                Name: <span class="badge badge-primary badge-pill"> {{data.product.name}}</span>
                                Brand: <span class="badge badge-primary badge-pill"> {{data.brand.name}}</span>
                                Qty: <span class="badge badge-primary badge-pill"> {{data.quantity}}</span>
                                Sub Total: <span class="badge badge-primary badge-pill"> {{data.total}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-right">
                        <b>Total: {{totalPrice}}</b> 
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" style="width: 50%" v-on:click="sellProduct">Sell</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import * as productService from '../../../services/productService'
import * as cartService from '../../../services/cartService'
export default {
  name: "Products",
  data() {
    return {
        searchData: '',
        searchResults: [],
        searchBar: true,
        totalCart: false,
        cartData: [],
        totalPrice: 0,
        products: [],
        errors: {}
    }
  },
   mounted() {
    //    this.$store.state.isLoading = true;
       this.getCartProducts();
   },
  methods: {
    getSearchResult: async function(){
        try {
            this.$store.state.isLoading = true;
            const response = await productService.getSearchResult(this.searchData);
            this.$store.state.isLoading = false;
            this.searchResults = response.data;
        } catch (error) {
            this.$store.state.isLoading = false;
            this.flashMessage.error({
                message: error.response.data.errors.searchData,
                time: 5000
            });
        }
    },
    getCartProducts: async function() {
        try {
            this.$store.state.isLoading = true;
            const response = await cartService.getCartProducts();
            this.$store.state.isLoading = false;
            this.products = response.data;
            // console.log(this.products)
        } catch (error) {
            console.log(error);
            this.$store.state.isLoading = false;
        }
    },
    addToCard: async function(result){
        try {
            this.$store.state.isLoading = true;
            const response = await cartService.addToCart(result);
            this.flashMessage.success({
                message: "Added to cart.",
                time: 3000
            });
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
    calculateTotal(product){
        console.log(product)
        this.totalCart  = true
        this.cartData.push(product);
        this.totalPrice += parseFloat(product.total)
    },
    sellProduct: async function(){
        try {
            this.$store.state.isLoading = true;
            const response = await cartService.sellProduct(this.cartData);
            this.flashMessage.success({
                message: "Order successfully created.",
                time: 5000
            });
            this.cartData = [];
            this.products = [];
            this.totalPrice = 0;
            this.totalCart  = false
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
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
