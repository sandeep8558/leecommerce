<template>
<div class="row align-items-center justify-content-center">
    <div class="col-12 col-md-4 col-lg-3 col-xl-2 mb-3">
        <a :href="'/product/'+myWishlist.product.product_group_id+'/'+myWishlist.product_id">
            <div class="image image-s">
                <img class="image-cover" :src="myWishlist.product.media_a" alt="">
            </div>
        </a>
    </div>
    <div class="col mb-3">
        <h4>{{ myWishlist.product.product_group.group_name }}</h4>
        <h2>&#8377;{{ myWishlist.product.rate }} <del class="fs-6 text-danger">MRP &#8377;{{ myWishlist.product.mrp }}</del></h2>
    </div>
    <div class="col-auto">
        <button @click="removeProduct()" class="btn btn-danger">Remove for wishlist</button>
    </div>
</div>
</template>

<script>

export default {

    props: ['wishlist'],

    components: {
    },

    data: function (){
        return {
            myWishlist: null,
        }
    },

    methods : {

        removeProduct(){
            window.axios.post('/wishlist/add', {product_id:this.myWishlist.product_id}).then(response => {
                window.location.reload();
            });
        }

    },

    created(){
        this.myWishlist = this.wishlist;
    },

    mounted() {
    },

}
</script>
        