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
                title : "User Manager",
                formName : "UserForm",
                model : "User",
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
                    { key : 'name', val : 'Name', type : 'text' },
                    { key : 'mobile', val : 'Mobile', type : 'text' },
                    { key : 'email', val : 'Email', type : 'text' },
                ],
                elements : [

                    {
                        label : 'Full Name',
                        name : 'name',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Full Name',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Full Name',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Mobile',
                        name : 'mobile',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Mobile',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Mobile',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Email',
                        name : 'email',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Email',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Email',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Password',
                        name : 'password',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter Password',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3',
                        labelClass : '',
                        hint : 'Please Enter Password',
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
