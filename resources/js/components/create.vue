<template>
    <div v-show="createNew" class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Create New {{ response }}</span> <button class="btn btn-sm btn-danger float-right" @click="createNew=false">Cancel</button></div>
        <form class="form-inline text-center" action="javascript:;" style="padding: 20px 30px;">
            <div class="form-group">
                <input type="text" v-model="name" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <button type="button" class="btn btn-primary" @click="createContact">Submit</button>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name : '',
                email : '',
                password : '',
                createNew : false,
                response : '',
            }
        },
        mounted() {
            let object = this;
            Bus.$on('contactnew', function() { object.showContactForm() });
            Bus.$on('contactedit', function(contact) { object.createNew = false; });
        },
        created(){
        },
        methods: {
            showContactForm(){
                this.createNew = true;
            },
            createContact(e){
                e.preventDefault();
                let object = this;
                let state = Bus;
                axios.post('api/user', {
                    name : object.name,
                    email: object.email,
                    password: '123456',
                    password_confirmation: '123456',
                }).then(function(response) {
                    if (response.status == 200) {
                        // location.reload();
                        state.$emit('fetchallusers');
                    }
                    // object.response = response.data;
                }).catch(function (error) {
                    object.response = error;
                });
            },
            test(){
                console.log('test')
            }
        }
    }
</script>
