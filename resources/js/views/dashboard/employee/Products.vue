<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Products</h1>
          </div>
          <!-- <div class="col-auto">
            <button class="btn btn-primary" v-on:click="showAddProductModal">
                <span class="fas fa-plus"></span> 
                Product
            </button>
          </div> -->
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
                            <th scope="col">Sell Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products.data" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td>{{product.name}}</td>
                            <td v-if="product.id">{{product.category.name}}</td>
                            <td v-if="product.id">{{product.sub_category.name}}</td>
                            <td v-if="product.id">{{product.brand.name}}</td>
                            <td v-for="(stock, index) in product.stock" :key="index">
                                {{stock.in_stock}}
                            </td>
                            <td v-if="product.id">{{product.sell_price}}</td>
                        </tr>
                        <pagination :data="products" @pagination-change-page="getProducts">
                            <span slot="prev-nav">&lt; Previous</span>
	                        <span slot="next-nav">Next &gt;</span>
                        </pagination>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import * as productService from '../../../services/productService'
export default {
  name: "Products",
  data() {
    return {
        products: {},
        errors: {}
    }
  },
   mounted() {
       this.$store.state.isLoading = true;
       this.getProducts();
   },
  methods: {
    getProducts: async function(page = 1) {
        try {
            this.$store.state.isLoading = true;
            const response = await productService.getProducts(page);
            this.$store.state.isLoading = false;
            this.products = response.data;
        } catch (error) {
            console.log(error);
            this.$store.state.isLoading = false;
        }
    },
  }
}
</script>
