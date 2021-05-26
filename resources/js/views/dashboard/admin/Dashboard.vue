<template>
    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{allStocks}}</h3>

                <p>All Stocks</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3> {{todaySales}} </h3>
                <p>Today's Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{totalEmployees}}</h3>

                <p>Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <section class="col-lg-7 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <!-- <line-chart :data="`${salesChart.date}: ${salesChart.sales}`">

                      </line-chart> -->
                   </div>
                </div>
              </div>
            </div>

          </section>
          <section class="col-lg-5 connectedSortable">
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Last Sales
                </h3>
              </div>
              <div class="card-body">
                <!-- <line-chart class="chart" :data="salesChart"
                  style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
                </line-chart> -->
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import * as adminService from '../../../services/admin_service'
export default {
  name: "Dashboard",
  data() {
    return {
      allStocks: 0,
      todaySales: 0,
      totalEmployees: 0,
      salesChart: {},
      errors: {},
    }
  },
  created() {
    this.getDashboard();
  },
  methods: {
    getDashboard: async function(){
      try {
        this.$store.state.isLoading = true
        const response = await adminService.getDashboard();
        this.totalEmployees = response.data.employees;
        response.data.todaySales.forEach(element => {
          this.todaySales += parseInt(element.quantity);
        });
        response.data.allStocks.forEach(element => {
          this.allStocks += parseInt(element.in_stock);
        });
        response.data.lastSevenDays.forEach(element => {
          this.salesChart.date = element.date
          this.salesChart.sales = element.quantity
          // console.log(this.salesChart.date, this.salesChart.sales)
        });
        this.$store.state.isLoading = false
      } catch (error) {
        this.$store.state.isLoading = false
      }
    }
  }
}
</script>
