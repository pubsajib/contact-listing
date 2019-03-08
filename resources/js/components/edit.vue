<template>
    <div v-show="edit" class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Create New</span> <button class="btn btn-sm btn-danger float-right" @click="edit=false">Cancel</button></div>
        <form class="form-inline text-center" action="" style="padding: 20px 30px;">
            <div class="form-group">
                <input type="text" class="form-control" v-model="contact.name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" v-model="contact.email" placeholder="Enter email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                contact : {fname:'', email:''},
                edit : false,
            }
        },
        mounted() {
            let edit = this;
            Bus.$on('contactedit', function(contact) {
                edit.showContactForm(contact)
            })
        },
        created(){},
        methods: {
            showContactForm(contact){
                this.contact = contact;
                this.edit = true;
            },
            test(){
                console.log('test')
            }
        }
    }
</script>
