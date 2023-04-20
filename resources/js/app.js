/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./sidebar');

$(document).ready(()=>{

    $(".autofocus").focus();

    $("#sub_cats").change(()=> {
        let link = $("#sub_cats").val();
        window.location.href = link;
    });

    $("#show_hide_password").on('click', function(event) {

        if($('#login_password').attr("type") == "text" || $('#password').attr("type") == "text"){
            $('#login_password').attr('type', 'password');
            $('#password').attr('type', 'password');
            $('#password-confirm').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else{
            $('#login_password').attr('type', 'text');
            $('#password').attr('type', 'text');
            $('#password-confirm').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("#search").focus();
    

});



window.Vue = require('vue');
import vueDebounce from 'vue-debounce'
Vue.use(vueDebounce)

import AdminUserManager from './components/administrator/UserManager.vue';
import AdminUserManagerRoles from './components/administrator/UserManagerRoles.vue';
import AdminSettings from './components/administrator/Settings.vue';
import AdminWebsiteManagerSlider from './components/administrator/website_manager/Slider.vue';
import AdminWebsiteManagerFeatures from './components/administrator/website_manager/Features.vue';
import AdminWebsiteManagerPages from './components/administrator/website_manager/Pages.vue';
import AdminWebsiteManagerContent from './components/administrator/website_manager/Content.vue';
import AdminProductsCategory from './components/administrator/products/Category.vue';
import AdminProductsSubCategory from './components/administrator/products/SubCategory.vue';
import AdminProductsProductGroup from './components/administrator/products/ProductGroup.vue';
import AdminProductsProducts from './components/administrator/products/Products.vue';
import AdminPurchase from './components/administrator/Purchase.vue';
import AdminOffers from './components/administrator/Offers.vue';

/* Elements */
import Product from './components/elements/Product.vue';
import ProductDetail from './components/elements/ProductDetail.vue';
import Wishlist from './components/elements/Wishlist.vue';
import Cart from './components/elements/Cart.vue';
import Checkout from './components/elements/Checkout.vue';
import CancelButton from './components/elements/CancelButton.vue';
import Shipping from './components/elements/Shipping.vue';


const app = new Vue({
    el: '#app',
    components: {
        AdminUserManager,
        AdminUserManagerRoles,
        AdminSettings,
        AdminWebsiteManagerSlider,
        AdminWebsiteManagerFeatures,
        AdminWebsiteManagerPages,
        AdminWebsiteManagerContent,
        AdminProductsCategory,
        AdminProductsSubCategory,
        AdminProductsProductGroup,
        AdminProductsProducts,
        AdminPurchase,
        AdminOffers,

        Product,
        ProductDetail,
        Wishlist,
        Cart,
        Checkout,
        CancelButton,
        Shipping,
    }
});
