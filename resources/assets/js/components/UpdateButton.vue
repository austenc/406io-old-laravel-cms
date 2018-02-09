<template>
	<button type="submit" name="update" @click.prevent="submitForm" ref="button"
		class="ml-2 py-1 pt-2 px-2 bg-blue rounded text-white hover:bg-blue-dark">
		Update
	</button>
</template>

<script>
	export default {
		methods: {
			submitForm() {
				var form = this.$refs.button.form;

				// submit the form with axios with the data
				axios.post(form.action, new FormData(form)).then(function(response) {
					if (response.data == true) {
						Toast.showToast('Saved.', {
							theme: 'success', 
							timeLife: 2500
						});
					}
				})
			}
		}
	}
</script>