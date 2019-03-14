<template>
    <div v-show="edit" class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Edit Contact</span> <button class="btn btn-sm btn-danger float-right" @click="edit=false">Cancel</button></div>
        <form @submit.prevent="editContact" class="form-inline text-center" style="padding: 20px 30px;">
            <div class="form-group">
                <input type="text" class="form-control" v-model="name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" v-model="email" placeholder="Enter email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
                axios.put('/api/user/'+ object.id, {
                    name: object.name, 
                    email: object.email
                }).then(function(response) {
                    if (response.status == 200) {
                        object.name = '';
                        object.email = '';
                        Bus.$emit('fetchallusers', {cls:'text-info', msg: 'Updated successfully.'});
                        object.edit = false;
                    }
                }).catch(function(error) {
                    console.log(error);
                })
            },
            test() { console.log('test') }
        }
    }
</script>
