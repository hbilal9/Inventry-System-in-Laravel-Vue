<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-auto mr-auto">
            <h1 class="m-0">Sales Report</h1>
          </div>
          <div class="col-auto">
            <button class="btn btn-primary" v-on:click="showFilterRecordModal">
                <span class="fas fa-filter"></span> 
                 Filter Report
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
                        <tr v-for="(sale, index) in salesRecords" :key="index">
                        <th scope="row">{{index + 1}}</th>
                            <td v-if="sale.id">{{sale.product.name}}</td>
                            <td v-if="sale.id">{{sale.quantity}}</td>
                            <td v-if="sale.id">{{sale.user.first_name +' '+ sale.user.last_name}}</td>
                            <td v-if="sale.id">{{sale.product.sell_price * sale.quantity}}</td>
                            <td v-if="sale.id">{{(sale.product.sell_price - sale.product.buy_price )* sale.quantity}}</td>
                            <td v-if="sale.id">{{sale.date}}</td>
                            <!-- <td>
                                <button class="btn btn-primary" v-on:click='editProduct(product)'>
                                    <span class="fas fa-edit"></span>
                                </button>
                                <button class="btn btn-danger" v-on:click="showDeleteProductPop(product)">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </section>
    <!-- Modals -->
    <b-modal ref="filterRecordModal"
                title="Filter Records"
                no-close-on-backdrop
                hide-footer
            >
            <form style="user-select: auto;" v-on:submit.prevent="filterSales">
                <div class="form-group" style="user-select: auto;">
                    <label
                        class="text-black font-w500"
                        >From</label
                    >
                    <input
                        type="date"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        v-model="filters.from"
                    />
                    <div class="invalid-feedback" v-if="errors.name">
                        {{ errors.name[0] }}
                    </div>
                </div>
                <div class="form-group" style="user-select: auto;">
                    <label
                        class="text-black font-w500"
                        >To</label
                    >
                    <input
                        type="date"
                        class="form-control"
                        spellcheck="false"
                        data-ms-editor="true"
                        v-model="filters.to"
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
                        Show Records
                    </button>
                    <button
                        type="button"
                        class="btn btn-default"
                        v-on:click="hideFilterRecordModal"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </b-modal>
  </div>
</template>
<script>
import * as userService from '../../../services/user_service'
export default {
  name: "Products",
  data() {
    return {
        filters: {},
        salesRecords: [],
        errors: {}
    }
  },
  methods: {
    filterSales: async function(){
        try {
            this.$store.state.isLoading = true;
            const response = await userService.getFilterSales(this.filters);
            if (response.data != '') {
                this.salesRecords = response.data;
            }
            else{
                this.salesRecords = []
                this.flashMessage.warning({
                message: "No Record Found.",
                time: 3000
                });
            }
            
            this.hideFilterRecordModal();
            // console.log(response.data)
            this.$store.state.isLoading = false;
        } catch (error) {
            this.$store.state.isLoading = false;
        }
    },

    showFilterRecordModal(){
        this.$refs.filterRecordModal.show();
    },
    hideFilterRecordModal(){
        this.$refs.filterRecordModal.hide();
    },
  }
}
</script>
