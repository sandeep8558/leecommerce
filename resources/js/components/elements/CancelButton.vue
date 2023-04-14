<template>
<div  class="container py-2 text-danger">
    <a v-if="!isCancel" @click="cancelOrder()" class="btn btn-danger">Cancel Order</a>
    <span v-if="isCancel"><b>Order Status:</b> {{ message }}</span>
</div>

</template>

<script>
export default {

    props: ['order_id', 'cancelled_at', 'shipped_at'],

    components: {
    },

    data: function (){
        return {
            isCancel: false,
            isShipped: false,
            message:"Your order is cancelled.",
            messages: [
                "Your order is cancelled.",
                "This order is already processed and shipped. We Can't Cancel this order."
            ],
        }
    },

    methods : {
        cancelOrder(){
            let conf = confirm("Are you sure to cancel this order?");
            if(conf){
                window.axios.get('/order/cancel/'+this.order_id).then(res => {
                    switch(res.data){
                        case 0:
                        this.isCancel = false;
                        break;

                        case 1:
                        this.isCancel = true;
                        this.message = this.messages[0];
                        break;

                        case 2:
                        this.isCancel = true;
                        this.isShipped = true;
                        this.message = this.messages[1];
                        break;
                    }
                });
            }
        }
    },

    created(){
        this.isCancel = (this.cancelled_at == null || this.cancelled_at == '') ? false : true;
        this.isShipped = (this.shipped_at == null || this.shipped_at == '') ? false : true;
        if(this.isShipped){
            this.message = this.messages[1];
            this.isCancel = true;
        } else {
            this.message = this.messages[0];
        }
        
    },

    mounted() {
    },

}
</script>
        