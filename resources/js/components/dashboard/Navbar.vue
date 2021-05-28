<template>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- Profile Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <span v-if="$store.state.isLoggedIn">
              <img v-if="$store.state.profile.photo" :src="`${$store.state.serverPath}storage/${$store.state.profile.photo}`" :alt="$store.state.profile.first_name+' '+$store.state.profile.last_name" class="img-35-cover" />
              <avatar v-else
              :username="$store.state.profile.first_name+' '+$store.state.profile.last_name"
              :size="35"
              ></avatar>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
              {{$store.state.profile.first_name}}
              {{$store.state.profile.last_name}}
          </span>
          <div class="dropdown-divider"></div>
          <router-link :to="`/${$store.state.profile.role}/profile`" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </router-link>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" v-on:click="logout">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
          </button>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
</template>

<script>
    import * as authService from "../../services/auth_service";
    import Avatar from 'vue-avatar';
    export default {
        name: "navbar",
        components: {
            Avatar
        },
        data() {
            return {
                loaded: false
            };
        },
        mounted() {
            if (!this.$store.state.isLoading) {
                setTimeout(() => {
                    this.loaded = true;
                }, 1000);
            }
        },
        methods: {
            logout: function() {
                try {
                    authService.logout();
                    this.$store.dispatch('authenticate', {});
                    this.$router.push('/');
                } catch (error) {}
            },
            toggleSidebar() {
                document.getElementsByTagName('body')[0].classList.contains('sidebar-toggled') ? document.getElementsByTagName('body')[0].classList.remove('sidebar-toggled') : document.getElementsByTagName('body')[0].classList.add('sidebar-toggled');
                document.getElementById('accordionSidebar').classList.contains('toggled') ? document.getElementById('accordionSidebar').classList.remove('toggled') : document.getElementById('accordionSidebar').classList.add('toggled');
            }
        }
    };
</script>

