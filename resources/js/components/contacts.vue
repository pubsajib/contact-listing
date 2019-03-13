<template>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Contacts List ( <strong>{{ contacts.length }}</strong> ) </span> <button class="btn btn-sm btn-primary float-right" @click="createContact">Create</button></div>
        <table v-if="contacts.length" class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" style="margin-bottom:10px;">
                    <td>{{ contact.name}}</td>
                    <td>{{ contact.email }}</td>
                    <td style="text-align: center;width: 150px;">
                        <button class="btn btn-sm btn-info" @click="editContact(contact)">Edit</button>
                        <button class="btn btn-sm btn-danger" @click="deleteContact(contact)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 v-else class="text-danger text-center">Nothing found!</h3>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                contacts: '',
                contact: '',
            }
        },
        mounted() { 
            Bus.$on('fetchallusers', this.showAllUsers());
        },
        created(){
            this.showAllUsers();
        },
        methods: {
            showAllUsers(){
                let object = this;
                axios.get('api/user')
                    .then(function(response) { 
                        if (response.status == 200) {
                            object.contacts = response.data; 
                            // console.log(response.data); 
                        }
                    })
                    .catch(function(error) { console.log(error); }); 
            },
            createContact(){
                Bus.$emit('contactnew')
            },
            editContact(contact){
                Bus.$emit('contactedit',contact)
            },
            deleteContact(contact) {
                let object = this;
                axios.delete('/api/user/'+contact.id)
                    .then(function(response) { 
                        if (response.status == 200) {
                            let index = object.contacts.indexOf(contact);
                            if (index > -1) object.contacts.splice(index, 1);
                        }
                    })
                    .catch(function(error) { console.log(error); });
            },
            test() {console.log('test done.') }
        }
    }
</script>
