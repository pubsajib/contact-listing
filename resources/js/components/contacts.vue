<template>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header">
            <span>Contacts List ( <strong>{{ contacts.length }}</strong> ) 
            <span v-if="messageMsg" class="message text-center"><span :class="messageCls">{{ messageMsg }}</span></span>
            </span> <button class="btn btn-sm btn-primary float-right" @click="createContact">Create</button>
        </div>
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
                messageCls: '',
                messageMsg: '',
            }
        },
        mounted() { 
            let object = this
            Bus.$on('fetchallusers', function(status) { object.showAllUsers(status); });
        },
        created(){
            this.showAllUsers();
        },
        methods: {
            showAllUsers(message={}){
                let object = this;
                axios.get('api/user')
                    .then(function(response) { 
                        if (response.status == 200) {
                            object.contacts = response.data;
                            if (message.hasOwnProperty('msg')) {
                                object.messageMsg = message.msg;
                                object.messageCls = message.cls;
                            }
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
                            if (index > -1) {
                                object.contacts.splice(index, 1);
                                object.messageMsg = 'Deleted.';
                                object.messageCls = 'text-danger';
                            }
                        }
                    })
                    .catch(function(error) { console.log(error); });
            },
            test() {console.log('test done.') }
        }
    }
</script>
