<template lang="html">
	<div id="notification-message">
		<h1>{{ name }}</h1>
	</div>
</template>

<script>
	export default {
		props   : [],
		data() {
			return {
				name: 'notification-message'
			}
		},
		computed: {},
		filters : {},
		methods : {},
		beforeCreate() {
			console.log('Component notification-message beforeCreate');
		},
		created(){
			console.log('Component notification-message created');
			Echo.join('channel')
				.here((users) => {
					//
				})
				.joining((user) => {
					console.log(user.name);
				})
				.leaving((user) => {
					console.log(user.name);
				})
				.listen('channelEvent', (e) => {
					console.log('listen', e);
				});
		},
		beforeMount() {
			console.log('Component notification-message beforeMount');
		},
		mounted() {
			console.log('Component notification-message mounted');
		},
		beforeUpdate() {
			console.log('notification-message beforeupdate');
		},
		updated() {
			console.log('notification-message update');
		},
		activated() {
			console.log('notification-message activated');
		},
		deactivated() {
			console.log('notification-message deactivated');
		},
		beforeDestroy() {
			console.log('notification-message beforeDestroy');
		},
		destroyed() {
			console.log('notification-message destroyed');
		},
		watch   : {}
	}
</script>

<style lang="css" rel="stylesheet/css">
</style>