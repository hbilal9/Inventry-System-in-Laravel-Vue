<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <router-link :to="`/${$store.state.profile.role}`" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Khan Inventory</span>
    </router-link>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview" role="menu" data-accordion="false"
            v-if="$store.state.profile.role === 'admin'"
        >
            <li class="nav-item menu-open">
                <router-link to="/admin" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/brands" class="nav-link active">
                    <i class="nav-icon fas fa-tag"></i>
                    Brands
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/categories" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    Categories
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/sub-categories" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    Sub Categories
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    Products
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/sell-products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    Sell Products
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/sales" class="nav-link active">
                    <i class="nav-icon fas fa-credit-card"></i>
                    Sales
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/admin/sale-report" class="nav-link active">
                    <i class="nav-icon fas fa-chart-area"></i>
                    Sale Report
                </router-link>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview" role="menu" data-accordion="false"
            v-if="$store.state.profile.role === 'manager'"
        >
            <li class="nav-item menu-open">
                <router-link to="/manager" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/brands" class="nav-link active">
                    <i class="nav-icon fas fa-tag"></i>
                    Brands
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/categories" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    Categories
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/sub-categories" class="nav-link active">
                    <i class="nav-icon fas fa-th"></i>
                    Sub Categories
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    Products
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/sell-products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    Sell Products
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/sales" class="nav-link active">
                    <i class="nav-icon fas fa-credit-card"></i>
                    Sales
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/manager/sale-report" class="nav-link active">
                    <i class="nav-icon fas fa-chart-area"></i>
                    Sale Report
                </router-link>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview" role="menu" data-accordion="false"
            v-if="$store.state.profile.role === 'employee'"
        >
            <li class="nav-item menu-open">
                <router-link to="/employee" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    Dashboard
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/employee/products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    Products
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/employee/sell-products" class="nav-link active">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    Sell Products
                </router-link>
            </li>
            <!-- <li class="nav-item menu-open">
                <router-link to="/employee/sales" class="nav-link active">
                    <i class="nav-icon fas fa-credit-card"></i>
                    Sales
                </router-link>
            </li>
            <li class="nav-item menu-open">
                <router-link to="/employee/sale-report" class="nav-link active">
                    <i class="nav-icon fas fa-chart-area"></i>
                    Sale Report
                </router-link>
            </li> -->
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
export default {
  name: "Sidebar",
  mounted() {
    // this.toggleSidebar();
  },
  methods: {
    // toggleSidebar() {
    //   document
    //     .getElementsByTagName("body")[0]
    //     .classList.contains("sidebar-toggled")
    //     ? document
    //         .getElementsByTagName("body")[0]
    //         .classList.remove("sidebar-toggled")
    //     : document
    //         .getElementsByTagName("body")[0]
    //         .classList.add("sidebar-toggled");
    //   this.$refs.sidebar.classList.contains("toggled")
    //     ? this.$refs.sidebar.classList.remove("toggled")
    //     : this.$refs.sidebar.classList.add("toggled");3
    // }
  }
};
 </script>
