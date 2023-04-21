<template>
    <div v-if="selectedProduct != null" class="shadow rounded-4">
        
        <a class="btn btn-clear w-100 p-0" :href="'/product/' + product.id + '/' + selectedProduct.id">
            <div class="image image-s rounded-top-4 border-bottom">
                <span :class="[(selectedProduct.data_qty <= 0 ? 'd-none' : 'd-block')]" class="px-2 py-1 rounded-lg fw-bold" style="position:absolute; margin: 10px 0 0 10px; z-index: 1; background-color: rgba(255,200,0,0.90); color: #000;">
                    {{ Math.round((selectedProduct.mrp - selectedProduct.rate) * 100 / selectedProduct.mrp) }}% OFF
                </span>
                <span :class="[(selectedProduct.data_qty <= 0 ? 'd-bolck' : 'd-none')]" class="px-2 py-1 rounded-lg fw-bold" style="position:absolute; margin: 10px 0 0 10px; z-index: 1; background-color: rgba(255,0,0,0.90); color: #fff;">
                    Out of Stock
                </span>
                <img class="image-cover" :src="selectedProduct.media_a" alt="">
            </div>
        </a>

        <div class="px-3 py-2 text-left">
            <p class="my-0 py-2">{{ selectedProduct.product_group.group_name }}</p>
            <h2 class="my-0 mb-2"> &#8377;{{ selectedProduct.rate }} <span class="text-danger" style="font-size: 14px;"><del>&#8377;{{ selectedProduct.mrp }}</del></span></h2>

            <!-- <p>{{ selectedProduct.data_qty }}</p> -->
            
            <div v-if="product.size == 'Yes'" class="mb-2">
                <div class="btn-group">
                    <button @click="switchProduct('size', size.size)" class="btn btn-sm btn-outline-primary" v-for="size in selectedProduct.data_size" :key="size.size" :class="[(selectedProduct.size == size.size ? 'active' : '')]" style="min-width: 30px;">{{ size.size }}</button>
                </div>
            </div>

            <div v-if="product.color == 'Yes'">
                <div class="btn-group">
                    <button @click="switchProduct('color', color.color)" class="btn btn-sm" v-for="color in selectedProduct.data_color" :key="color.color" :style="'background-color:'+color.color+'; border: 2px solid #cccccc; width:32px; height:32px;' + (color.color == selectedProduct.color ? 'border-color:green;' : 'border-color:#cccccc;')"></button>
                </div>
            </div>

            <div v-if="product.weight == 'Yes'" class="mb-2">
                <div class="btn-group">
                    <button @click="switchProduct('weight', weight.weight)" class="btn btn-sm btn-outline-primary" v-for="weight in selectedProduct.data_weight" :key="weight.weight" :class="[(selectedProduct.weight == weight.weight ? 'active' : '')]">{{ weight.weight }}</button>
                </div>
            </div>

            <div v-if="product.volume == 'Yes'" class="mb-2">
                <div class="btn-group">
                    <button @click="switchProduct('volume', volume.volume)" class="btn btn-sm btn-outline-primary" v-for="volume in selectedProduct.data_volume" :key="volume.volume" :class="[(selectedProduct.volume == volume.volume ? 'active' : '')]">{{ volume.volume }}</button>
                </div>
            </div>

            <hr class="mb-0">
            
        </div>

        <div class="row p-2 text-left">
            <div class="col">
                <button v-if="user == 0" @click="addToFavourite()" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-clear py-0  position-relative" style="font-size: 22px;"><i class="fas fa-heart"></i></button>
                <button v-if="user != 0" @click="addToFavourite()" type="button" class="btn btn-clear py-0  position-relative" :class="[(selectedProduct.data_wishlist==1 ? 'text-danger' : 'text-dark')]" style="font-size: 22px;"><i class="fas fa-heart"></i></button>
            </div>
            <div class="col-auto">
                <button @click="addToCart()" type="button" :class="[(selectedProduct.data_qty <= 0 ? 'disabled' : '')]" class="btn btn-clear py-0 px-1 position-relative" style="font-size: 22px; border: 0;">
                    <i class="fas fa-shopping-cart"></i>
                    <span v-if="selectedProduct.data_cart > 0" class="badge rounded-pill text-bg-danger" style="font-size: 12px; display: inline-block; left: -5px; top: -15px;">{{ selectedProduct.data_cart }}</span>
                </button>
                
                <button @click="buy()" :class="[(selectedProduct.data_qty <= 0 ? 'disabled' : '')]" type="button" class="btn btn-primary">Buy</button>
            </div>          
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Notice!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hi, <br>
                    You are not Logged In.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <a href="/login" class="btn btn-primary">Go to Login</a>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
    
<script>
export default {

    props: ['product', 'user', 'buyqty'],

    components: {
    },

    data: function (){
        return {
            selectedProduct: null,
            qty: 0,
        }
    },

    methods : {

        switchProduct(key, val){
            let size = this.selectedProduct.size;
            let color = this.selectedProduct.color;
            let weight = this.selectedProduct.weight;
            let volume = this.selectedProduct.volume;
            switch(key){
                case 'size':
                size = val;
                break;
                case 'color':
                color = val;
                break;
                case 'weight':
                weight = val;
                break;
                case 'volume':
                volume = val;
                break;
            }
            this.product.products.forEach(product => {
                if(product.size == size && product.color == color && product.weight == weight && product.volume == volume){
                    this.selectedProduct = product;
                }
            });
        },

        buy(){
            this.addToCart(true);
        },

        addToCart(buy=false){
            window.axios.post('/cart/add', {user_id:this.user, product_id:this.selectedProduct.id}).then(response => {
                if(this.qty > this.selectedProduct.data_cart){
                    this.selectedProduct.data_cart += 1;
                }
                let elm = document.getElementById("myCart");
                elm.innerHTML = response.data.length;
                elm.classList.remove("d-none");
                if(buy){
                    window.location.href = "/cart";
                }
            });
        },

        addToFavourite(){
            window.axios.post('/wishlist/add', {user_id:this.user, product_id:this.selectedProduct.id}).then(response => {
                this.selectedProduct.data_wishlist = this.selectedProduct.data_wishlist == 0 ? 1 : 0;
            });
        },

        change(e){
            /* console.log(e.target.value); */
        },

        /* getBusinessPlan(){
            window.axios.get('/auth/crud/showall?model=BusinessPlan&key=plan_name&val=id').then(res => {
                this.formData.elements[1].options = res.data;
            });
        } */
    },

    created(){
        if(this.product.products.length > 0){
            this.selectedProduct = this.product.products[0];
            this.qty = this.selectedProduct.data_qty > this.buyqty ? this.buyqty : this.selectedProduct.data_qty;
        }
    },

    mounted() {
    },

}
</script>