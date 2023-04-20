<template>
    <div class="row">

        <div class="col-12 col-lg-6">
            

            <div id="carouselExampleIndicators1" class="carousel slide">

                <span :class="[(selectedProduct.data_qty <= 0 ? 'd-none' : 'd-block')]" class="px-2 py-1 rounded-lg fw-bold" style="position:absolute; margin: 10px 0 0 10px; z-index: 1; background-color: rgba(255,200,0,0.90); color: #000;">
                    {{ Math.round((selectedProduct.mrp - selectedProduct.rate) * 100 / selectedProduct.mrp) }}% OFF
                </span>
                <span :class="[(selectedProduct.data_qty <= 0 ? 'd-bolck' : 'd-none')]" class="px-2 py-1 rounded-lg fw-bold" style="position:absolute; margin: 10px 0 0 10px; z-index: 1; background-color: rgba(255,0,0,0.90); color: #fff;">
                    Out of Stock
                </span>

                <div class="carousel-indicators">
                    <button v-if="selectedProduct.media_a != null && selectedProduct.media_a != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" aria-label="Slide 0" class="active" aria-current="true"></button>
                    <button v-if="selectedProduct.media_b != null && selectedProduct.media_b != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="1" aria-label="Slide 1"></button>
                    <button v-if="selectedProduct.media_c != null && selectedProduct.media_c != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="2" aria-label="Slide 2"></button>
                    <button v-if="selectedProduct.media_d != null && selectedProduct.media_d != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="3" aria-label="Slide 3"></button>
                    <button v-if="selectedProduct.media_e != null && selectedProduct.media_e != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="4" aria-label="Slide 4"></button>
                    <button v-if="selectedProduct.media_f != null && selectedProduct.media_f != ''" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="5" aria-label="Slide 5"></button>
                </div>

                <div class="carousel-inner">
                    
                    <div v-if="selectedProduct.media_a != null && selectedProduct.media_a != ''" class="carousel-item active">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_a" alt="">
                        </div>
                    </div>

                    <div v-if="selectedProduct.media_b != null && selectedProduct.media_b != ''" class="carousel-item">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_b" alt="">
                        </div>
                    </div>

                    <div v-if="selectedProduct.media_c != null && selectedProduct.media_c != ''" class="carousel-item">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_c" alt="">
                        </div>
                    </div>

                    <div v-if="selectedProduct.media_d != null && selectedProduct.media_d != ''" class="carousel-item">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_d" alt="">
                        </div>
                    </div>

                    <div v-if="selectedProduct.media_e != null && selectedProduct.media_e != ''" class="carousel-item">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_e" alt="">
                        </div>
                    </div>

                    <div v-if="selectedProduct.media_f != null && selectedProduct.media_f != ''" class="carousel-item">
                        <div class="image image-s rounded-4">
                            <img class="image-cover" :src="selectedProduct.media_f" alt="">
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

        </div>
        <div v-if="selectedProduct != null" class="col">

            <div class="px-3 py-2 text-left">
                <h2 class="my-0 py-2 fw-bold">{{ selectedProduct.product_group.group_name }}</h2>
                <p>{{ product.brand }}</p>
                <h2 class="my-0 fw-bold mb-2"> &#8377;{{ selectedProduct.rate }} <span class="text-danger" style="font-size: 14px;"><del>&#8377;{{ selectedProduct.mrp }}</del></span></h2>

                <p><h5 class="mt-3">Product Detail:</h5>{{ product.details }}</p>

                <!-- <p>{{ selectedProduct.data_qty }}</p> -->
                
                <div v-if="product.size == 'Yes'" class="mb-2">
                    <h5 class="mt-3">Available Sizes</h5>
                    <div class="btn-group">
                        <button @click="switchProduct('size', size.size)" class="btn btn-sm btn-outline-primary" v-for="size in selectedProduct.data_size" :key="size.size" :class="[(selectedProduct.size == size.size ? 'active' : '')]" style="min-width: 30px;">{{ size.size }}</button>
                    </div>
                </div>

                <div v-if="product.color == 'Yes'">
                    <h5 class="mt-3">Available Colors</h5>
                    <div class="btn-group">
                        <button @click="switchProduct('color', color.color)" class="btn btn-sm" v-for="color in selectedProduct.data_color" :key="color.color" :style="'background-color:'+color.color+'; border: 2px solid #cccccc; width:32px; height:32px;' + (color.color == selectedProduct.color ? 'border-color:green;' : 'border-color:#cccccc;')"></button>
                    </div>
                </div>

                <div v-if="product.weight == 'Yes'" class="mb-2">
                    <h5 class="mt-3">Available Weight</h5>
                    <div class="btn-group">
                        <button @click="switchProduct('weight', weight.weight)" class="btn btn-sm btn-outline-primary" v-for="weight in selectedProduct.data_weight" :key="weight.weight" :class="[(selectedProduct.weight == weight.weight ? 'active' : '')]">{{ weight.weight }}</button>
                    </div>
                </div>

                <div v-if="product.volume == 'Yes'" class="mb-2">
                    <h5 class="mt-3">Available Volume</h5>
                    <div class="btn-group">
                        <button @click="switchProduct('volume', volume.volume)" class="btn btn-sm btn-outline-primary" v-for="volume in selectedProduct.data_volume" :key="volume.volume" :class="[(selectedProduct.volume == volume.volume ? 'active' : '')]">{{ volume.volume }}</button>
                    </div>
                </div>
                
            </div>
            <div class="row p-2 text-left">
                <div class="col">
                    <button v-if="user == 0" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-outline-danger  position-relative"><i class="fas fa-heart mr-2"></i>Wishlist</button>
                    <button v-if="user != 0" @click="addToFavourite()" type="button" class="text-uppercase btn" :class="[(selectedProduct.data_wishlist == 1 ? 'btn-danger' : 'btn-outline-danger')]"><i class="fas fa-heart mr-2"></i>Wishlist</button>
                </div>
                <div class="col-auto">
                    <button @click="addToCart()" :class="[(selectedProduct.data_qty <= 0 ? 'disabled' : '')]" type="button" class="text-uppercase btn btn-warning">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        <span v-if="selectedProduct.data_cart > 0" class="ml-2 badge rounded-pill bg-danger">{{ selectedProduct.data_cart }}</span>
                    </button>
                    <button @click="buy()" :class="[(selectedProduct.data_qty <= 0 ? 'disabled' : '')]" type="button" class="text-uppercase btn btn-primary">Buy</button>
                </div>          
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

    props: ['product','pid','user', 'buyqty'],

    components: {
    },

    data: function (){
        return {
            selectedProduct: null,
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
            window.axios.post('/wishlist/add', {product_id:this.selectedProduct.id}).then(response => {
                this.selectedProduct.data_wishlist = this.selectedProduct.data_wishlist == 0 ? 1 : 0;
            });
        },
    },

    created(){
        if(this.product.products.length > 0){
            this.product.products.forEach(product => {
                if(this.pid == product.id){
                    this.selectedProduct = product;
                }
            });

            this.qty = this.selectedProduct.data_qty > this.buyqty ? this.buyqty : this.selectedProduct.data_qty;
        }
    },

    mounted() {
    },

}
</script>