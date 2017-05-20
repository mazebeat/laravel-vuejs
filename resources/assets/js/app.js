/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('user-detail', require('./components/User.vue'));
Vue.component('users-list', require('./components/Users.vue'));
Vue.component('chat-message', require('./components/chatmessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

const app = new Vue({
	el     : '#app',
	data   : {
		messages   : [],
		usersInRoom: []
	},
	methods: {
		addMessage(message) {
			this.messages.push(message);
			axios.post('/chat/messages', message).then(response => {
				// Check if message were save correctly;
			})
		}
	},
	created() {
		axios.get('/chat/messages').then(response => {
			this.messages = response.data;
		});

		Echo.join('chatroom')
			.here((users) => {
				this.usersInRoom = users;
			})
			.joining((user) => {
				this.usersInRoom.push(user);
			})
			.leaving((user) => {
				this.usersInRoom = this.usersInRoom.filter(u => u != user)
			})
			.listen('ChatMessagePosted', (e) => {
				this.messages.push({
					message: e.message.message,
					user   : e.user
				});
			});
	}
});