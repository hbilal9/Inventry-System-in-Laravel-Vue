<template>
    <div>
        <section class="home_banner_area">
            <div class="banner_inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="banner_content">
                                <h2>
                                    Easy & Managable <br>
                                    Bussiness
                                </h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                    magna aliqua. Ut enim ad minim.
                                    sed do eiusmod tempor incididunt.
                                </p>
                                <div class="d-flex align-items-center">
                                    <router-link class="btn btn-primary" to="/dashboard/login"><span>Login to dashboard</span></router-link>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="home_right_img">
                                <img class="img-fluid" :src="`${$store.state.serverPath}storage/images/landing.png`" alt="" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: 'Home',
    }
</script>

<style scoped>
.home_banner_area {
z-index: 1;
background: url(https://preview.colorlib.com/theme/gaas/img/banner/xhome-banner.png.pagespeed.ic.gORzdDzPTH.png) no-repeat right center;
background-size: cover;
}

.home_banner_area .banner_inner {
width: 100%;
}
.home_banner_area .banner_inner .home_right_img {
    padding-top: 260px;
    padding-bottom: 142px;
}
.home_banner_area .banner_inner .col-lg-5 {
    vertical-align: middle;
    align-self: center;
}
.home_banner_area .banner_inner .banner_content {
    text-align: left;
    color: #fff;
}
.home_banner_area .banner_inner .banner_content h2 {
    margin-top: 0;
    font-size: 48px;
    font-weight: 400;
    line-height: 54px;
    margin-bottom: 20px;
}
.home_banner_area .banner_inner .banner_content p {
    color: #fff;
    font-size: 14px;
    margin-bottom: 20px;
}
.home_banner_area .banner_inner .banner_content .primary_btn {
    border-color: #fff;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    margin-right: 30px;
}
.home_banner_area .banner_inner .banner_content .primary_btn:hover {
    background: #fff;
    color: #222;
}
.home_banner_area .banner_inner .banner_content .watch_video {
    margin: 0 30px;
    font-size: 12px;
    text-transform: uppercase;
}
.banner_area {
    position: relative;
    z-index: 1;
    min-height: 400px;
}
.banner_area .banner_inner {
    position: relative;
    overflow: hidden;
    width: 100%;
    min-height: 400px;
    background-image: url(https://preview.colorlib.com/theme/gaas/img/banner/xcommon-banner.png.pagespeed.ic.2-qk8hjYOd.png);
    background-size: cover;
    z-index: 1;
}
.banner_area .banner_inner .banner_content h2 {
    color: #fff;
    font-size: 36px;
    font-family: "Rajdhani", sans-serif;
    margin-bottom: 0;
    text-transform: capitalize;
    font-weight: bold;
}
.banner_area .banner_inner .banner_content .page_link a {
    font-size: 14px;
    color: #fff;
    font-family: "Roboto", sans-serif;
    margin-right: 32px;
    position: relative;
}
/* .banner_area .banner_inner .banner_content .page_link a:before {
    content: "\e87a";
    font-family: "Linearicons-Free";
    font-size: 14px;
    position: absolute;
    right: -25px;
    top: 54%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
} */
.banner_area .banner_inner .banner_content .page_link a:last-child {
    margin-right: 0;
}
.banner_area .banner_inner .banner_content .page_link a:last-child:before {
    display: none;
}
</style>