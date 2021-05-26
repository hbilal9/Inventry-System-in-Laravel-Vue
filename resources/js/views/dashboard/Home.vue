<template>
	<div class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<Navbar />
			<Sidebar />
			<router-view />
			<Footer />
		</div>
	</div>
	
</template>

<script>
import Navbar from "../../components/dashboard/Navbar.vue";
import Sidebar from "../../components/dashboard/Sidebar.vue";
import Footer from "../../components/dashboard/Footer.vue";
import * as auth from "../../services/auth_service";
export default {
	name: "dashboard",
	components: {
		Navbar,
		Sidebar,
		Footer,
    },
    created() {
        document.getElementById('body').style.background = '#ffffff';
    },
	beforeCreate: async function () {
		try {
			if (auth.isLoggedIn()) {
				const response = await auth.getProfile();
				this.$store.dispatch("authenticate", response.data);
			} else {
				this.$router.push("/login");
			}
		} catch (error) {
			console.log('here reached');
			auth.logout();
		}
	},
};
</script>
