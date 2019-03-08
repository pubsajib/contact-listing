<template>
    <div v-show="createNew" class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Create New</span> <button class="btn btn-sm btn-danger float-right" @click="createNew=false">Cancel</button></div>
        <form class="form-inline text-center" action="/action_page.php" style="padding: 20px 30px;">
            <div class="form-group">
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <button type="button" class="btn btn-primary" @click="createContact">Submit</button>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                contact : {name:'', email:''},
                createNew : false,
            }
        },
        mounted() {
            let create = this;
            Bus.$on('contactnew', function() {
                create.showContactForm()
            })
        },
        created(){
        },
        methods: {
            showContactForm(){
                this.createNew = true;
            },
            createContact(){
                // axios.post('/register', contact).then(){}
                this.test();
            },
            test(){
                console.log('test')
            }
        }
    }
</script>
