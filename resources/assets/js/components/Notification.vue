<template lang="html">
	<div id="notification">
		<h1>{{ name }}</h1>
	</div>
</template>

<script>
	export default {
		props        : [],
		data         : () => {
			return {
				name: 'notification'
			}
		},
		computed     : {},
		filters      : {},
		methods      : {},
		beforeCreate : () => {
			console.log('Component notification beforeCreate');
		},
		created      : () => {
			console.log('Component notification created');
		},
		beforeMount  : () => {
			console.log('Component notification beforeMount');
		},
		mounted      : () => {
			console.log('Component notification mounted');
		},
		beforeUpdate : () => {
			console.log('notification beforeupdate');
		},
		updated      : () => {
			console.log('notification update');
		},
		activated    : () => {
			console.log('notification activated');
		},
		deactivated  : () => {
			console.log('notification deactivated');
		},
		beforeDestroy: () => {
			console.log('notification beforeDestroy');
		},
		destroyed    : () => {
			console.log('notification destroyed');
		},
		watch        : {}
	}
</script>

<style lang="css" rel="stylesheet/css">
</style>
