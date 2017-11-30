<template>
	<div class="markdown-editor flex flex-grow" :class="fullscreenClass">
		<div class="editor flex-1">
			<textarea class="input mb-0 p-4 h-full rounded-r-none" v-model="input">
				Type stuff
			</textarea>
		</div>
		<div class="preview flex-1 p-4 bg-grey-light shadow rounded rounded-l-none">
			<a @click="toggleFullscreen" class="block">Fullscreen</a>
			<div v-html="output"></div>
		</div>
	</div>
</template>

<script>
	var marked = require('marked');
	export default {
		data() {
			return {
				input: '_Some default text_',
				fullscreen: false,
			}
		},
		computed: {
			fullscreenClass() {
				return this.fullscreen ? 'z-50 absolute w-full pin-t pin-l h-full' : '';
			},
			output() {
				return marked(this.input);
			}
		},

		methods: {
			toggleFullscreen() {
				this.fullscreen = !this.fullscreen;
			}
		}
	}
</script>