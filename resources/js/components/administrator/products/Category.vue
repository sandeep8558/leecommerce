<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData"></lits-form>
    </div>
</template>

<script>
import LitsForm from '../../form/NewForm.vue'
export default {

    props: ['id'],

    components: {
        LitsForm,
    },

    data: function (){
        return {
            formData : {
                id : 0,
                title : "Category Manager",
                formName : "CategoryForm",
                model : "Category",
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
                    { key : 'category', val : 'Category', type : 'text' },
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
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Display',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Category',
                        name : 'category',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Category',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Category',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Category Media',
                        name : 'media',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Select Category Media',
                        type : 'image',
                        validation : '',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Category Media is Required',
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
