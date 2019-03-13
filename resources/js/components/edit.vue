<template>
    <div v-show="edit" class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Edit Contact</span> <button class="btn btn-sm btn-danger float-right" @click="edit=false">Cancel</button></div>
        <form class="form-inline text-center" action="" style="padding: 20px 30px;">
            <div class="form-group">
                <input type="text" class="form-control" v-model="name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" v-model="email" placeholder="Enter email" name="email">
            </div>
            <button type="button" class="btn btn-primary" @click="editContact">Submit</button>
        </form>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                id:'',
                name:'', 
                email:'',
                edit : false,
            }
        },
        mounted() {
            let object = this;
            Bus.$on('contactedit', function(contact) { object.showContactForm(contact) });
            Bus.$on('contactnew', function() { object.edit = false; });
        },
        created(){},
        methods: {
            showContactForm(contact){
                this.id = contact.id;
                this.name = contact.name;
                this.email = contact.email;
                this.edit = true;
            },
            editContact(){
                let object = this;
                axios.put('/api/user/'+ this.id, {name: this.name, email: this.email}).then(function(response) {
                    console.log(response.status);
                }).catch(function(error) {
                    console.log(error);
                })
            },
            test() { console.log('test') }
        }
    }
</script>
