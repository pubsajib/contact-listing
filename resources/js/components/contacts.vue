<template>
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header"><span>Contacts List</span> <button class="btn btn-sm btn-primary float-right" @click="createContact">Create</button></div>
        <table class="table table-dark table-hover">
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
    </div>
</template>
<script>
    export default {
        props: ['users'],
        data() {
            return {
                edit: false,
                contact: {id: '', name: '', email: ''},
                contacts: JSON.parse(this.users),
            }
        },
        mounted() {
            // this.$on('contactnew', function() {
            //     console.log('something2ß')
            // })
            // console.log(this.users)
        },
        methods: {
            createContact(){
                Bus.$emit('contactnew')
            },
            editContact(contact){
                Bus.$emit('contactedit',contact)
            },
            deleteContact(contact){
                console.log(contact.id)
            },
            test(){
                console.log('test done.')
            }
        }
    }
</script>
