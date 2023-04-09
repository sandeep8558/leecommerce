<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData" @OnChange="change($event)" @OnEdit="edit($event)"></lits-form>
    </div>
</template>

<script>
import LitsForm from '../../form/NewForm.vue'
export default {

    props: ['id', 'categories', 'sub_categories'],

    components: {
        LitsForm,
    },

    data: function (){
        return {
            formData : {
                id : 0,
                title : "Product Group Manager",
                formName : "ProductGroupForm",
                model : "ProductGroup",
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
                    { key : 'data_category', val : 'Category', type : 'text' },
                    { key : 'data_sub_category', val : 'Sub Category', type : 'text' },
                    { key : 'group_name', val : 'Group Name', type : 'text' },
                    { key : 'display', val : 'Display', type : 'text' },
                    { key : 'brand', val : 'Brand', type : 'text' },
                    { key : 'hsn', val : 'HSN', type : 'text' },
                    { key : 'tax_name', val : 'Tax', type : 'text' },
                    { key : 'weight', val : 'Weight', type : 'text' },
                    { key : 'volume', val : 'Volume', type : 'text' },
                    { key : 'color', val : 'Color', type : 'text' },
                    { key : 'size', val : 'Size', type : 'text' },
                ],
                elements : [

                    {
                        label : 'Display',
                        name : 'display',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Display', value : '' },
                            { key : 'Show', value : 'Show' },
                            { key : 'Hide', value : 'Hide' },
                        ],
                        placeholder : 'Please Select Display',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Display',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Category',
                        name : 'category_id',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : this.categories,
                        placeholder : 'Please Select Category',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Category',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Sub Category',
                        name : 'sub_category_id',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Please Select Sub Category',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Sub Category',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Group Name',
                        name : 'group_name',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Group Name',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Group Name',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Brand',
                        name : 'brand',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Brand',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Brand',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'HSN',
                        name : 'hsn',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter HSN',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Enter HSN',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Tax Name',
                        name : 'tax_name',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Tax Name',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Tax Name',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Tax Percentage',
                        name : 'tax_percentage',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Tax Percentage',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Tax Percentage',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Weight',
                        name : 'weight',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Weight', value : '' },
                            { key : 'Yes', value : 'Yes' },
                            { key : 'No', value : 'No' },
                        ],
                        placeholder : 'Please Select Weight',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Select Weight',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Volume',
                        name : 'volume',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Volume', value : '' },
                            { key : 'Yes', value : 'Yes' },
                            { key : 'No', value : 'No' },
                        ],
                        placeholder : 'Please Select Volume',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Select Volume',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Color',
                        name : 'color',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Color', value : '' },
                            { key : 'Yes', value : 'Yes' },
                            { key : 'No', value : 'No' },
                        ],
                        placeholder : 'Please Select Color',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Select Color',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Size',
                        name : 'size',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Size', value : '' },
                            { key : 'Yes', value : 'Yes' },
                            { key : 'No', value : 'No' },
                        ],
                        placeholder : 'Please Select Size',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Select Size',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Description',
                        name : 'description',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Description',
                        type : 'textarea',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Description',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Tags',
                        name : 'tags',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Tags',
                        type : 'textarea',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Tags',
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
            if(e.target.name == 'category_id'){
                this.setSubCategories(e.target.value, "");
            }
        },

        edit(e){
            console.log(e);
            this.setSubCategories(e.category_id, e.sub_category_id);
        },

        setSubCategories(val, sub){
            let a = [];
            this.sub_categories.forEach(sub => {
                if(val == sub.category_id){
                    a.push(sub);
                }
            });
            this.formData.elements[2].value = sub;
            this.formData.elements[2].options = a;
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
