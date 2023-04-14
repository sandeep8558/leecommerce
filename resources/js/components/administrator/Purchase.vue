<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData"></lits-form>
    </div>
</template>

<script>
import LitsForm from '../form/NewForm.vue'
export default {

    props: ['id'],

    components: {
        LitsForm,
    },

    data: function (){
        return {
            formData : {
                id : 0,
                title : "Purchase Manager",
                formName : "PurchaseForm",
                model : "Purchase",
                action : "CRUD", /* CRUD | EDIT | SEARCH */
                method : "",
                custom_query : [],
                with : [],
                mail : {
                    name : "Sandeep Rathod",
                    to : "sandeep198558@yahoo.com",
                    subject : "Email From Users of Zataks",
                },
                settings : {
                    isTitle : true,
                    isReset : true,
                    isSubmit : true,
                    isDateSearch : false,
                    isExport : true,

                    isForm : true,
                    isSearch : true,
                    isResults : true,
                    isAction : true,
                    isLoadMore : true,
                },
                display : [
                    { key : 'product_id', val : 'Product ID', type : 'text' },
                    { key : 'data_product', val : 'Product', type : 'text' },
                    { key : 'date', val : 'Date', type : 'text' },
                    { key : 'quantity', val : 'Qty', type : 'text' },
                    { key : 'rate', val : 'Rate', type : 'text' },
                    { key : 'amount', val : 'Amount', type : 'text' },
                    { key : 'supplier', val : 'Supplier', type : 'text' },
                    { key : 'bill_no', val : 'Bill No', type : 'text' },
                    { key : 'narration', val : 'Narration', type : 'text' },
                ],
                elements : [
                    {
                        label : 'Product ID',
                        name : 'product_id',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Product ID',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-13 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Product ID',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Date',
                        name : 'date',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Date',
                        type : 'date',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-13 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Date',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Bill No',
                        name : 'bill_no',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Bill No',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-13 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Bill No',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Supplier',
                        name : 'supplier',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Supplier',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-13 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Supplier',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Quantity',
                        name : 'quantity',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Quantity',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Quantity',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Rate',
                        name : 'rate',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Rate',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Rate',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Amount',
                        name : 'amount',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Amount',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Amount',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    
                    {
                        label : 'Narration',
                        name : 'narration',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Narration',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Narration',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                ],
            },
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
        if(this.id == null){
            this.formData.id = 0;
        } else {
            this.formData.id = this.id;
        }
    },

    mounted() {
    },

}
</script>
