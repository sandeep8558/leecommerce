<template>
<div class="container-fluid p-4">
    <ul class="list-group list-group-flush">
        <li class="list-group-item p-0 py-3">
            Application Name
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'LeeCommerce'" :datakey="'App Name'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Show App Name
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Enable'" :datakey="'Show App Name'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Tag Line
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'Tag Line'" :datakey="'Tag Line'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Show Tag Line
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'Show Tag Line'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Logo
            <span class="float-right"><toggle-switch :datawhat="'image'" :dataoptions="[]" :datavalue="''" :datakey="'Logo'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Show Logo
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'Show Logo'"></toggle-switch></span>
        </li>
        
        
        <li class="list-group-item p-0 py-3">
            Enable Cash on delivery 
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'COD'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Enable Online payment
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'Online payment'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Enable Order Cancellation
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'Order Cancellation'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Enable Order Replacement
            <span class="float-right"><toggle-switch :datawhat="'toggle'" :dataoptions="['Enable','Disable']" :datavalue="'Disable'" :datakey="'Order Replacement'"></toggle-switch></span>
        </li>
        
        <li class="list-group-item p-0 py-3">
            Address
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'Address'" :datakey="'Address'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Replacement Hours
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'1'" :datakey="'Replacement Hours'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Return Hours
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'1'" :datakey="'Return Hours'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Delivery Timing
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'5 to 7 Days'" :datakey="'Delivery Timing'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Max Product quantity to buy
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'10'" :datakey="'Buy Quantity'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Delivery Charges
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'100'" :datakey="'Delivery Charges'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Free Delivery Amount
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'500'" :datakey="'Free Delivery Amount'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Minimum Order Amount
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'100'" :datakey="'Minimum Order Amount'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Support Email
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'support@example.com'" :datakey="'Support Email'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Support Mobile
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'0000000000'" :datakey="'Support Mobile'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Google Map API Key
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'000'" :datakey="'Google Map API Key'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Razorpay API Key
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'000'" :datakey="'Razorpay API Key'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Razorpay API Secret
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'000'" :datakey="'Razorpay API Secret'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Welcome Title
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'Welcome'" :datakey="'Welcome Title'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Welcome Call
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'Welcome Call'" :datakey="'Welcome Call'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Welcome Note
            <span class="float-right"><toggle-switch :datawhat="'textarea'" :dataoptions="[]" :datavalue="'Welcome Note'" :datakey="'Welcome Note'"></toggle-switch></span>
        </li>
        <li class="list-group-item p-0 py-3">
            Theme Color
            <span class="float-right"><toggle-switch :datawhat="'text'" :dataoptions="[]" :datavalue="'#000000'" :datakey="'Theme Color'"></toggle-switch></span>
        </li>
    </ul>
</div>
</template>

<style>
</style>

<script>

import ToggleSwitch from '../elements/ToggleSwitch.vue'

export default {

    props: [],

    components: {
        ToggleSwitch,
    },

    data: function (){
        return {
            key: "Value",
        }
    },

    methods : {

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
        
    },

    mounted() {
    },

}
</script>
