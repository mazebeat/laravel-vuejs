<template lang="html">
    <div>
        <form v-on:submit.prevent="createUser" method="post">
            <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                <label for="user-name">Name:</label>
                <input id="user-name" type="text" v-model="user.name" class="form-control">
                <span class="help-block" v-for="error in errors.name">{{ error }}</span>
            </div>
            <div v-bind:class="{'form-group': true, 'has-error': errors.email}">
                <label for="user-email">Email:</label>
                <input id="user-email" type="email" v-model="user.email" class="form-control">
                <span class="help-block" v-for="error in errors.email">{{ error }}</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create New User</button>
            </div>
        </form>

        <table class="table table-striped table-condensed">
            <transition name="fade" mode="out-in" appear>
                <thead>
	                <tr>
	                    <th>Id</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Action</th>
	                </tr>
                </thead>
            </transition>
            <tbody>
                <user-detail v-for="user in users" v-bind:user="user" v-on:delete-user="deleteUser" v-on:update-user="fetchUsers" :key="user.id"></user-detail>
            </tbody>
        </table>
    </div>
</template>

<script>
	export default {
	    data(){
	        return {
	            users: [],
	            errors: [],
	            user:{
	            	id: '',
	                name: '',
	                email: ''
	            },
		        message: ''
	        }
	    },
	    created(){
	        this.fetchUsers();
	    },
	    methods: {
	        fetchUsers(){
	            this.$http.get('/users').then(response => {
	                this.users = response.data.users;
	            });
	        },
	        createUser(){
	            this.$http.post('/users/', this.user).then(response => {
	                this.users.push(response.data.user);
	                this.user = {id:'', name: '', email:''};
	                if (this.errors) {
	                    this.errors = [];
	                }
	            }, (response) => {
	                this.errors = response.data;
	            });
	        },
	        deleteUser(user){
	            this.$http.delete('/users/' + user.id).then(response => {
	                let index = this.users.indexOf(user);
	                this.users.splice(index, 1);
	            });
	        }
	    }
	}
</script>

<style>
	.fade-enter-active, .fade-leave-active {
		transition: opacity 1s;
	}
	.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
		opacity: 0;
		transform: translateX(20px);
	}
</style>
