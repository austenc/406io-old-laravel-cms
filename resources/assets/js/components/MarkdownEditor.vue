<template>
	<div class="markdown-editor h-64 flex">
		<div class="editor flex-1">
			<textarea class="input mb-0 h-full rounded-r-none" v-model="input">
				Type stuff
			</textarea>
		</div>
		<div class="preview flex-1 p-4 bg-grey-light shadow rounded rounded-l-none"
			v-html="output">
		</div>
	</div>
</template>

<script>
	var marked = require('marked');
	export default {
		data() {
			return {
				input: '_Some default text_'
			}
		},
		computed: {
			output() {
				return marked(this.input);
			}
		},
	}
</script>