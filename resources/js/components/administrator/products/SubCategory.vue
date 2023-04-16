<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData"></lits-form>
    </div>
</template>

<script>
import LitsForm from '../../form/NewForm.vue'
export default {

    props: ['id', 'categories'],

    components: {
        LitsForm,
    },

    data: function (){
        return {
            formData : {
                id : 0,
                title : "Sub Category Manager",
                formName : "SubCategoryForm",
                model : "SubCategory",
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
                    { key : 'sub_category', val : 'Sub Category', type : 'text' },
                    { key : 'display', val : 'Display', type : 'text' },
                    { key : 'title', val : 'Title', type : 'text' },
                    { key : 'media', val : 'Media', type : 'image' },
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
                        class : 'col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3',
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
                        class : 'col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-3',
                        labelClass : '',
                        hint : 'Please Select Category',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Sub Category',
                        name : 'sub_category',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Sub Category',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Sub Category',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Sub Category Media',
                        name : 'media',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Select Sub Category Media',
                        type : 'image',
                        validation : '',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Sub Category Media is Required',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Title for the Page',
                        name : 'title',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Title for the Page',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Title for the Page',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Keywords',
                        name : 'keywords',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Keywords',
                        type : 'textarea',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Keywords',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Page Description',
                        name : 'description',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Page Description',
                        type : 'textarea',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Page Description',
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
