<template>
    <main>
        <FlashMessage position="right top"></FlashMessage>
        <Loading :active="$store.state.isLoading" :is-full-page="true" />
        <router-view></router-view>
    </main>
</template>

<script>
    import * as authService from "./services/auth_service";
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        name: 'App',
        components: {
            Loading,
        },
        data() {
            return {}
        },
        mounted() {
            this.$store.state.isLoading = false;
            setTimeout(() => {
                document.getElementsByTagName('body')[0].classList.add('loaded');
            }, 1000);
        },
        beforeCreate: async function() {
            try {
                if (authService.isLoggedIn()) {
                    const response = await authService.getProfile();
                    this.$store.dispatch('authenticate', response.data);
                }
            } catch (error) {
                authService.logout();
            }
        }
    };
</script>
