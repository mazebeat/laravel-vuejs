<template lang="html">
    <tr>
        <td>{{ user.id }}</td>
        <td>
            <input id="edit-name" type="text" class="form-control" v-model="editForm.name" v-if="edit">
            <span v-else>{{ user.name }}</span>
        </td>
        <td>
            <input id="edit-email" type="text" class="form-control" v-model="editForm.email" v-if="edit">
            <span v-else>{{ user.email }}</span>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-info" v-on:click="editUser" v-if="!edit">Edit</button>
            <button type="button" class="btn btn-sm btn-default" v-on:click="cancelEdit" v-if="edit">Cancel</button>
            <button type="button" class="btn btn-sm btn-primary" v-on:click="updateUser(user, editForm)" v-if="edit">Update</button>
            <button type="button" class="btn btn-sm btn-danger" v-on:click="$emit('delete-user', user)" v-if="!edit">Delete</button>
        </td>
    </tr>
</template>

<script>
	export default {
	    props:['user'],
	    data(){
	        return {
	            edit: false,
	            editForm :{
	                name: '',
	                email: ''
	            }
	        }
	    },
	    methods: {
	        editUser(){
	            this.edit = true;
	            this.editForm.name = this.user.name;
	            this.editForm.email = this.user.email;
	        },
	        cancelEdit(){
	            this.edit = false;
	            this.editForm.name = '';
	            this.editForm.email = '';
	        },
	        updateUser(oldUser, newUser){
	            this.$http.patch('/users/' + oldUser.id, newUser)
		            .then(response => {
		                this.$emit('update-user');
		                this.cancelEdit();
		            }, (response) => {
			            this.$parent.errors = response.data;
		            });
	        }
	    },
		mounted() {
			let channel = 'newuser.' + this.user.id;
			console.log(channel);
			Echo.private(channel)
				.listen('NewUser', (event) => {
					console.log(event);
				});
		}
	}
</script>
