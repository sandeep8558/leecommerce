<template>
    <span>
        <button class="btn btn-dark float-right mr-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Ship this Order</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order ID - {{ order_id }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Enter Shipping Details</label>
                            <input v-model="shippingDetails" type="text" class="form-control" @input="check()" :class="[(isValid ? '' : 'is-invalid')]" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="ship()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>

export default {

    props: ['order_id', 'shipping'],

    components: {
    },

    data: function (){
        return {
            shippingDetails: null,
            isValid: false
        }
    },

    methods : {
        ship(){
            if(this.isValid){
                window.axios.post('/administrator/order/save/shipping', {
                    order_id: this.order_id,
                    shipping: this.shippingDetails,
                }).then(res => {
                    window.location.reload();
                });
            }
        },

        check(){
            this.isValid = this.shippingDetails != null && this.shippingDetails != '' ? true : false;
        }
    },

    created(){
        this.shippingDetails = this.shipping;
    },

    mounted() {
    },

}
</script>
            