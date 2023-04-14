<template>
<div>
    <div v-if="what == 'toggle'" class="input-group">
        <button v-for="(option, index) in options" :key="option" @click="toggleValue()" :class="[(val == options[index] ? 'btn-success' : 'btn-outline-success disabled')]" class="btn" type="button">{{ options[index] }}</button>
    </div>

    <div v-if="what == 'text'" class="input-group">
        <input @input="makeTampered()" type="text" :class="[(isTampered ? 'is-invalid' : 'is-valid')]" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" v-model="val">
        <button @click="updateValueToServer()" :class="[(isTampered ? 'btn-danger' : 'btn-outline-success')]" class="btn" type="button" id="button-addon2">Save</button>
    </div>

    <div v-if="what == 'textarea'" class="mb-3">
        <textarea @input="makeTampered()" :class="[(isTampered ? 'is-invalid' : 'is-valid')]" class="form-control" id="exampleFormControlTextarea1" rows="5" cols="50" v-model="val"></textarea>
        <button @click="updateValueToServer()" :class="[(isTampered ? 'btn-danger' : 'btn-outline-success')]" class="btn float-right" type="button" id="button-addon2">Save</button>
    </div>

    <form enctype="multipart/form-data" action="POST" @submit.prevent="submitForm($event)">
        <div v-if="what == 'image'" class="input-group">
            <img :src="val" style="height:35px;" class="mr-2">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Save</button>
        </div>
    </form>
</div>
</template>

<script>

export default {

    props: ['dataoptions', 'datavalue', 'datakey', 'datawhat'],

    components: {
    },

    data: function (){
        return {
            options: ["On", "Off"],
            val: "On",
            key: "COD",
            what: this.datawhat,
            isTampered: false,
        }
    },

    methods : {

        submitForm(e){
            const fd = new FormData();
            fd.append('key', this.key);
            fd.append('what', 'file');
            if(e.target[0].files.length > 0){
                let file = e.target[0].files[0];
                fd.append('media', file);
            }
            let url = "/administrator/save_setting";
            window.axios.post(url, fd).then(response => {
                this.getSetting();
            });
        },

        makeTampered(){
            this.isTampered = true;
        },

        toggleValue(){
            let v = this.val == this.options[0] ? this.options[1] : this.options[0];
            this.val = v;
            this.updateValueToServer();
        },

        updateValueToServer(){
            let url = "/administrator/save_setting";
            window.axios.post(url, {key: this.key, val: this.val}).then(response => {
                this.isTampered = false;
            });
        },

        getSetting(){
            let url = "/administrator/get_setting";
            window.axios.post(url, {key: this.key, val: this.val}).then(response => {
                this.val = response.data.val;
            });
        },

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
        if(this.dataoptions.length > 0 && this.dataoptions.length == 2){
            this.options = this.dataoptions;
        }
        this.val = this.datavalue;
        this.key = this.datakey;
        this.getSetting();
    },

    mounted() {
    },

}
</script>
    