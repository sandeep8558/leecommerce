<template>
    <div class="container-fluid p-0">
        <lits-form :formData="formData" @OnChange="change($event)"></lits-form>
    </div>
</template>

<script>
import LitsForm from '../form/NewForm.vue'
export default {

    props: ['id', 'user_id'],

    components: {
        LitsForm,
    },

    data: function (){
        return {
            formData : {
                id : 0,
                title : "Role Manager",
                formName : "RoleForm",
                model : "Role",
                action : "CRUD", /* CRUD | EDIT | SEARCH */
                method : "",
                custom_query : ['user_id', '==', this.user_id],
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
                    { key : 'user_id', val : 'User ID', type : 'text' },
                    { key : 'role', val : 'Role', type : 'text' },
                    { key : 'status', val : 'Status', type : 'text' },
                ],
                elements : [

                    {
                        label : 'User ID',
                        name : 'user_id',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [],
                        placeholder : 'Enter User ID',
                        type : 'text',
                        validation : 'required | string',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Enter User ID',
                        error : '',
                        isError : false,
                        readonly : true,
                    },
                    {
                        label : 'Status',
                        name : 'status',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Status', value : '' },
                            { key : 'Active', value : 'Active' },
                            { key : 'Non-Active', value : 'Non-Active' },
                            { key : 'Block', value : 'Block' },
                            { key : 'Hold', value : 'Hold' },
                            { key : 'Discontinue', value : 'Discontinue' },
                        ],
                        placeholder : 'Please Select Status',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Status',
                        error : '',
                        isError : false,
                        readonly : false,
                    },
                    {
                        label : 'Role',
                        name : 'role',
                        value : '',
                        values : [],
                        ObjectValue : {},
                        options : [
                            { key : 'Select Role', value : '' },
                            { key : 'Administrator', value : 'Administrator' },
                            { key : 'Web-Admin', value : 'Web-Admin' },
                            { key : 'Store Manager', value : 'Store Manager' },
                            { key : 'Customer', value : 'Customer' },
                        ],
                        placeholder : 'Please Select Role',
                        type : 'select',
                        validation : 'required',
                        class : 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3',
                        labelClass : '',
                        hint : 'Please Select Role',
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
            this.formData.elements[0].value = this.user_id;
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
