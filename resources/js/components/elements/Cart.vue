<template>
    <div>

        <div v-if="products.length <= 0" class="container py-5 text-center" style="min-height: 75vh;">
            <div>
                <h3>You don't have products added in your Cart!</h3>
                <a class="btn btn-outline-primary btn-lg" href="/category/1">Continue Shopping</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">

                <div class="row align-items-center mb-3" v-for="product in products" :key="product.id">
                    <div class="col-4 col-md-3 col-lg-2">
                        <div class="image image-s">
                            <img class="image-cover" :src="product.media_a" :alt="product.data_product_group">
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="m-0 mb-2">{{ product.data_product_group }}</h5>
                        <p class="m-0 mb-2">{{ product.product_group.brand }}</p>
                        <h4 class="m-0 mb-2">&#8377;{{ product.rate }} <del class="fs-6 text-danger">MRP &#8377;{{ product.mrp }}</del></h4>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm mb-3" style="width:100px !important;">
                            <button @click="minus(product)" class="btn btn-outline-primary" type="button"><i class="fas fa-minus"></i></button>
                            <input type="text" class="form-control border-primary text-center" :value="product.data_cart">
                            <button @click="plus(product)" class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
                        </div>

                        <div class="input-group input-group-sm" style="width:100px !important;">
                            <button @click="deleteCartItem(product.id)" class="btn btn-danger w-100" type="button">Delete</button>
                        </div>
                    </div>
                </div>

            </div>
            <div v-if="products.length > 0" class="col-10 col-lg-4 mb-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-bg-warning">{{ delivery_timing }}</li>
                    <li class="list-group-item">MRP Total <span class="float-right">{{ calc.mrp_total }}</span></li>
                    <li class="list-group-item">Cost Total <span class="float-right">{{ calc.cost_total }}</span></li>
                    <li class="list-group-item">Tax Total <span class="float-right">{{ calc.tax_total }}</span></li>
                    <li class="list-group-item">Rate Total <span class="float-right">{{ calc.rate_total }}</span></li>
                    <li class="list-group-item">Discount <span class="float-right">{{ calc.discount }}</span></li>
                    <li class="list-group-item">Delivery Charges <span class="float-right">{{ calc.delivery_charges }}</span></li>
                    <li class="list-group-item fw-bold">Payable <span class="float-right">{{ calc.payable }}</span></li>

                    <li v-if="calc.rate_total >= free_delivery_amount" class="list-group-item fw-bold">You are eligible for free delivery.</li>

                    <li v-if="calc.rate_total < free_delivery_amount" class="list-group-item fw-bold">Shop more Rs: {{ free_delivery_amount - calc.rate_total }}/- for Free Delivery.</li>

                    <li class="list-group-item">
                        <a href="/checkout" class="btn btn-primary w-100" :class="calc.canProceed ? '' : 'disabled'">Proceed</a>
                    </li>

                    <li v-if="!calc.canProceed" class="list-group-item fw-bold text-danger">
                        Minimum Order Amount is Rs: {{ minimum_order_amount }}/-
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    props: ['delivery_timing', 'buyqty', 'delivery_charges', 'free_delivery_amount', 'minimum_order_amount'],

    components: {
    },

    data: function (){
        return {
            products: [],
            calc: [],
        }
    },

    methods : {
        getCart(){
            window.axios.get("/cart/get_cart").then(res => {
                this.respond(res);
            });
        },
        deleteCartItem(id){
            window.axios.get("/cart/delete_cart_item/"+id).then(res => {
                this.respond(res);
            });
        },

        respond(res){
            this.products = res.data.products;
            this.calc = res.data.calc;
            let elm = document.getElementById("myCart");
            elm.innerHTML = this.products.length;
        },

        plus(product){
            let q = product.data_cart + 1;
            let qq = product.data_qty > this.buyqty ? this.buyqty : product.data_qty;

            if(q <= qq) {
                this.updateCart(product, q);
            }
        },

        minus(product){
            let q = product.data_cart - 1;
            if(q <= 0) {
                this.deleteCartItem(product.id);
            } else {
                this.updateCart(product, q);
            }            
        },

        updateCart(product, qty){
            
            window.axios.post('/cart/add', {product_id:product.id, qty:qty}).then(res => {
                this.getCart();
            });
        },
    },

    created(){
        this.getCart();
    },

    mounted() {
    },

}
</script>
        