<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Sales</h1>
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
                            <th scope="col">Product Name</th>
                            <th scope="col">Total Sold</th>
                            <th scope="col">Sold By</th>
                            <th scope="col">Total Sales</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Sold Date</th>
                            <!-- <th scope="col">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sale, index) in sales.data" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td v-if="sale.id">{{sale.product.name}}</td>
                            <td v-if="sale.id">{{sale.quantity}}</td>
                            <td v-if="sale.id">{{sale.user.first_name +' '+ sale.user.last_name}}</td>
                            <td v-if="sale.id">{{sale.product.sell_price * sale.quantity}}</td>
                            <td v-if="sale.id">{{(sale.product.sell_price - sale.product.buy_price )* sale.quantity}}</td>
                            <td v-if="sale.id">{{sale.date}}</td>
                        </tr>
                        <pagination :data="sales" @pagination-change-page="fatchSales">
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
import * as userService from '../../../services/user_service'
export default {
  name: "Products",
  data() {
    return {
        sales: {},
        errors: {}
    }
  },
   mounted() {
       this.$store.state.isLoading = true;
       this.fatchSales();
   },
  methods: {
    fatchSales: async function(page = 1){
        try {
            const response = await userService.fetchAllSales(page);
            this.sales = response.data;
            // console.log(response.data)
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },
  }
}
</script>
