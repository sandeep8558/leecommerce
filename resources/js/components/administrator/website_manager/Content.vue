<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData" @OnChange="change($event)"></lits-form>
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
                title : "Content Manager",
                formName : "ContentForm",
                model : "Content",
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
                    { key : 'order', val : 'Order', type : 'text' },
                    { key : 'what', val : 'What', type : 'text' },
                    { key : 'page', val : 'Page', type : 'text' },
                    { key : 'classes', val : 'Classes', type : 'text' },
                    { key : 'media', val : 'Media', type : 'image' },
                ],
                elements : [

                    {
                        label : 'Order',
                        name : 'order',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Order',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Order',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'What is Content',
                        name : 'what',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select What is Content', value : '' },
                            { key : 'Title', value : 'Title' },
                            { key : 'Paragraph', value : 'Paragraph' },
                            { key : 'Image', value : 'Image' },
                        ],
                        placeholder : 'Please Select What is Content',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select What is Content',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Page',
                        name : 'page',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Page', value : '' },
                            { key : 'Privacy Policy', value : 'Privacy Policy' },
                            { key : 'Return & Replace', value : 'Return & Replace' },
                            { key : 'Terms & Condtions', value : 'Terms & Condtions' },
                            { key : 'About', value : 'About' },
                            { key : 'Contact', value : 'Contact' },
                        ],
                        placeholder : 'Please Select Page',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Page',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Bootstrap Classes for Container',
                        name : 'classes',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Bootstrap Classes for Container',
                        type : 'text',
                        validation : '',
                        class : 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Bootstrap Classes for Container',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Content',
                        name : 'content',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Content',
                        type : 'textarea',
                        validation : '',
                        class : 'col-12 d-none mb-3',
                        labelClass : '',
                        hint : 'Please Enter Content',
                        error : '',
                        isError : false,
                        readonly : false,
                    },

                    {
                        label : 'Media',
                        name : 'media',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Select Media',
                        type : 'image',
                        validation : '',
                        class : 'col-12 d-none mb-3',
                        labelClass : '',
                        hint : '',
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
            if(e.target.name == 'what'){
                /* 4-Content 5-Image */
                switch(e.target.value){
                    case "Paragraph":
                    this.formData.elements[4].class = "col-12 mb-3 d-block";
                    this.formData.elements[5].class = "col-12 mb-3 d-none";
                    break;
                    case "Title":
                    this.formData.elements[4].class = "col-12 mb-3 d-block";
                    this.formData.elements[5].class = "col-12 mb-3 d-none";
                    break;
                    case "Image":
                    this.formData.elements[4].class = "col-12 mb-3 d-none";
                    this.formData.elements[5].class = "col-12 mb-3 d-block";
                    break;
                    case "":
                    this.formData.elements[4].class = "col-12 mb-3 d-none";
                    this.formData.elements[5].class = "col-12 mb-3 d-none";
                    break;
                }
            }
            /* console.log(e.target.name);
            console.log(e.target.value); */
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
