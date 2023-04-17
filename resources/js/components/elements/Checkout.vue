<template>
    <div>

        <div class="row">
            <div class="col">
                <div v-for="address in addresses" :key="address.id" class="row align-items-center mb-4">
                    <div class="col-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" :id="'flexRadioDefault' + address.id" v-model="id" :value="address.id">
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-check-label" :for="'flexRadioDefault' + address.id">
                            {{address.name}} <br>
                            {{address.mobile}} | {{address.email }} <br>
                            {{address.address}} {{address.city}} {{address.pincode}} {{address.state}} {{address.country}}. <br>
                            <button @click="setDefault(address.id)" type="button" class="btn btn-link px-0">Set Default Address</button>
                            <button @click="deleteAddress(address.id)" type="button" class="btn btn-link px-0">Delete Address</button>
                            
                        </label>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault0" v-model="id" :value="0">
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-check-label" for="flexRadioDefault0">
                            Custom Address
                        </label>
                    </div>
                </div>

                <div class="row justify-content-center mx-5" v-if="id == 0">
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" :class="[(errors.name.length > 0 ? 'is-invalid': '')]" id="name" v-model="address.name" name="name">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" :class="[(errors.email.length > 0 ? 'is-invalid': '')]" id="email" v-model="address.email" name="email">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" :class="[(errors.mobile.length > 0 ? 'is-invalid': '')]" id="mobile" v-model="address.mobile" name="mobile">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" :class="[(errors.address.length > 0 ? 'is-invalid': '')]" id="address" v-model="address.address" name="address">
                            
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" :class="[(errors.city.length > 0 ? 'is-invalid': '')]" id="city" v-model="address.city" name="city">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" :class="[(errors.pincode.length > 0 ? 'is-invalid': '')]" id="pincode" v-model="address.pincode" name="pincode">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" :class="[(errors.state.length > 0 ? 'is-invalid': '')]" id="state" v-model="address.state" name="state">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" :class="[(errors.country.length > 0 ? 'is-invalid': '')]" id="country" v-model="address.country" name="country">
                        </div>
                    </div>

                    <div class="col-12 mb-5">
                        <button type="button" @click="saveAddress()" class="btn btn-primary">Save Address</button>
                        
                    </div>

                </div>

                <div class="row mb-4" v-if="id != 0">
                    <div class="col-12">
                        <button type="button" @click="pay('Online')" v-if="calc.canProceed && online == 'Enable'" class="btn btn-primary">Online Payment</button>
                        <button type="button" @click="pay('COD')" v-if="calc.canProceed && cod == 'Enable'" class="btn btn-primary">Cash On Delivery</button>
                    </div>
                </div>
                
            </div>
            <div class="col-10 col-lg-4 mb-4">
                <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item text-bg-primary p-3">
                        <div class="input-group">
                            <input type="text" id="coupon" name="coupon" v-model="coupon" class="form-control shadow-none text-uppercase" placeholder="COUPON CODE">
                            <button @click="checkCoupon()" class="btn btn-dark" type="button" id="button-addon2">APPLY</button>
                        </div>
                    </li>

                    <li v-if="coupon_message != null && coupon_message != '' && offer_id == null" class="list-group-item text-bg-danger">
                        {{ coupon_message }}
                    </li>

                    <li v-if="coupon_message != null && coupon_message != '' && offer_id != null" class="list-group-item text-bg-success">
                        {{ coupon_message }}
                    </li>

                    <li class="list-group-item text-bg-warning">{{ delivery_timing }}</li>
                    <li class="list-group-item">MRP Total <span class="float-right">{{ calc.mrp_total }}</span></li>
                    <li class="list-group-item">Cost Total <span class="float-right">{{ calc.cost_total }}</span></li>
                    <li class="list-group-item">Tax Total <span class="float-right">{{ calc.tax_total }}</span></li>
                    <li class="list-group-item">Rate Total <span class="float-right">{{ calc.rate_total }}</span></li>
                    <li class="list-group-item">Discount <span class="float-right">{{ calc.discount }}</span></li>
                    <li class="list-group-item">Offer Discount <span class="float-right">{{ calc.offer_discount }}</span></li>
                    <li class="list-group-item">Delivery Charges <span class="float-right">{{ calc.delivery_charges }}</span></li>
                    <li class="list-group-item fw-bold">Payable <span class="float-right">{{ calc.payable }}</span></li>

                    <li v-if="calc.rate_total >= free_delivery_amount" class="list-group-item fw-bold">You are eligible for free delivery.</li>

                    <li v-if="calc.rate_total < free_delivery_amount" class="list-group-item fw-bold">Shop more Rs: {{ free_delivery_amount - calc.rate_total }}/- for Free Delivery.</li>

                    <li v-if="!calc.canProceed" class="list-group-item fw-bold">
                        Minimum Order Amount is Rs: {{ minimum_order_amount }}/-
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
export default {

    props: ['delivery_timing', 'buyqty', 'delivery_charges', 'free_delivery_amount', 'minimum_order_amount', 'user', 'alladdresses', 'cod', 'online', 'app_name', 'logo', 'color'],

    components: {
    },

    data: function (){
        return {
            offer_id: null,
            coupon: null,
            coupon_message: null,
            order_id: null,
            id: 0,
            products: [],
            calc: [],
            address: {
                mobile: null,
                email: null,
                name: null,
                address: null,
                city: null,
                pincode: null,
                state: 'Maharashtra',
                country: 'India',
            },
            errors : {
                mobile: [],
                email: [],
                name: [],
                address: [],
                city: [],
                pincode: [],
                state: [],
                country: [],
            },
            addresses: [],

            options: {
                key: "rzp_test_It40r8yHilOcW7",
                amount: 100,
                currency: "INR",
                name: this.app_name,
                description: "Order Payment",
                image: this.logo,
                order_id: null,
                handler: res=>this.success(res),
                prefill: {
                    name: this.user.name,
                    email: this.user.email,
                    contact: this.user.mobile
                },
                theme: {
                    color: this.color
                }
            },
        }
    },

    methods : {

        checkCoupon(){
            this.offer_id = null;
            this.coupon_message = null;

            if(this.coupon != null && this.coupon != ''){
                this.coupon_message = null;
                let data = {
                    coupon: this.coupon,
                    rate_total: this.calc.rate_total,
                };
                window.axios.post("/checkout/check/coupon", data).then(res => {
                    this.coupon_message = res.data.message;
                    if(res.data.data != null){
                        this.offer_id = res.data.data.id;
                    }
                    this.getCart();
                    console.log(res.data.data);
                });

            } else {
                this.coupon_message = "Please Enter Coupon Code."
                $("#coupon").focus();
            }
        },

        success(res){
            let data = {
                razorpay_payment_id: res.razorpay_payment_id,
                id: this.order_id,
                orderstatus: "Success"
            };
            window.axios.post("/checkout/update_order", data).then(res => {
                window.location.href = "/customer";
            });
        },

        pay(what){
            let orderstatus = what == 'Online' ? 'Pending' : 'Success';
            let url = "/checkout/pay";
            let products = [];
            this.products.forEach(product => {
                let d = {
                    product_id: product.id,
                    group_name: product.product_group.group_name,
                    brand: product.product_group.brand,
                    hsn: product.product_group.hsn,
                    tax_name: product.product_group.tax_name,
                    tax_percentage: product.product_group.tax_percentage,
                    itemcode: product.itemcode,
                    barcode: product.barcode,
                    weight: product.weight,
                    volume: product.volume,
                    color: product.color,
                    size: product.size,
                    mrp: product.mrp,
                    cost: product.cost,
                    tax: product.tax,
                    rate: product.rate,
                    qty: product.data_cart,
                    mrp_total: product.data_calc.mrp_total,
                    cost_total: product.data_calc.cost_total,
                    tax_total: product.data_calc.tax_total,
                    rate_total: product.data_calc.rate_total,
                }
                products.push(d);
            });
            let order = {
                address_id: this.id,
                offer_id: this.offer_id,
                mrp_total:this.calc.mrp_total,
                cost_total:this.calc.cost_total,
                tax_total:this.calc.tax_total,
                rate_total:this.calc.rate_total,
                discount:this.calc.discount,
                offer_discount:this.calc.offer_discount,
                delivery:this.calc.delivery_charges,
                payable:this.calc.payable,
                orderstatus: orderstatus,
                paymentmode: what
            };

            let data = {
                order:order,
                order_data: products
            };

            window.axios.post(url, data).then(res => {
                this.options.order_id = res.data.order_id;
                this.order_id = res.data.order.id;
                if(res.data.order_id != null && res.data.order.orderstatus == "Pending"){
                    this.payment();
                } else if(res.data.order.orderstatus == "Success" && res.data.order.paymentmode == "COD"){
                    window.location.href = "/customer";
                }
            });
        },

        payment(){
            var rzp1 = new Razorpay(this.options);
            rzp1.open();
            rzp1.on('payment.failed', function (response){
                    /* alert(response.error.code); */
            });
        },

        setDefault(id){
            window.axios.post("/checkout/set_default_address", {id:id}).then(res => {
                this.addresses = res.data;
                this.setAddress();
            });
        },

        setAddress(){
            let is = 0;
            this.addresses.forEach(add => {
                if(add.default == "Yes"){
                    is = add.id;
                }
            });
            this.id = is;
        },

        resetErrors(){
            this.errors.mobile = [];
            this.errors.email = [];
            this.errors.name = [];
            this.errors.address = [];
            this.errors.city = [];
            this.errors.pincode = [];
            this.errors.state = [];
            this.errors.country = [];
        },

        resetAddress(){
            this.address.mobile = [];
            this.address.email = [];
            this.address.name = [];
            this.address.address = [];
            this.address.city = [];
            this.address.pincode = [];
            this.address.state = [];
            this.address.country = [];
        },

        deleteAddress(id){
            window.axios.post("/checkout/delete_address", {id:id})
            .then(res => {
                this.addresses = res.data;
                this.setAddress();
            });
        },

        saveAddress(){
            this.resetErrors();
            window.axios.post("/checkout/save_address", this.address)
            .then(res => {
                this.resetErrors();
                this.resetAddress();
                this.addresses = res.data.addresses;
                this.setAddress();
            })
            .catch(error => {
                if(error.response.status == 422){
                    this.errorMessage = error.response.data.message;
                    let errors = error.response.data.errors;
                    if(errors['mobile'] != null || errors['mobile'] != undefined){ this.errors.mobile = errors['mobile']; }
                    if(errors['email'] != null || errors['email'] != undefined){ this.errors.email = errors['email']; }
                    if(errors['name'] != null || errors['name'] != undefined){ this.errors.name = errors['name']; }
                    if(errors['address'] != null || errors['address'] != undefined){ this.errors.address = errors['address']; }
                    if(errors['city'] != null || errors['city'] != undefined){ this.errors.city = errors['city']; }
                    if(errors['pincode'] != null || errors['pincode'] != undefined){ this.errors.pincode = errors['pincode']; }
                    if(errors['state'] != null || errors['state'] != undefined){ this.errors.state = errors['state']; }
                    if(errors['country'] != null || errors['country'] != undefined){ this.errors.country = errors['country']; }
                } else {
                    console.log(error);
                }
            });
        },

        getCart(){
            let url = "/cart/get_cart";
            if(this.offer_id != null) {
                url += "?offer_id="+this.offer_id;
            }
            window.axios.get(url).then(res => {
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
    },

    created(){
        this.getCart();
        this.address.name = this.user.name;
        this.address.mobile = this.user.mobile;
        this.address.email = this.user.email;

        this.addresses = this.alladdresses;

        
        this.setAddress();
        
    },

    mounted() {
    },

}
</script>