<template>
	<div class="shadow flex flex-grow flex-col border border-grey-light" :class="fullscreenClass">
		<div class="flex justify-between bg-grey-lighter text-grey h-10 p-2 border-b border-grey-light pt-3 px-4">
			<div>
				Page Content
			</div>
			<div class="text-right">		
				<button @click="toggleSplit" :title="split ? 'Hide Preview' : 'Show Preview'" class="outline-none text-right text-grey hover:text-grey-dark mr-1">

					<!-- Single / Split Pane Icons -->
					<svg v-show="split" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<path d="M0 3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm2 2v12h16V5H2z"/>
					</svg>
					<svg v-show="!split" class="w-4 h-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					  <path d="M 9 17.357 L 9 4.607 L 11 4.607 L 11 17.357 L 9 17.357 Z M 0 3 C 0 1.9 0.9 1 2 1 L 18 1 C 19.105 1 20 1.895 20 3 L 20 17 C 20 18.105 19.105 19 18 19 L 2 19 C 0.895 19 0 18.105 0 17 L 0 3 Z M 2 5 L 2 17 L 18 17 L 18 5 L 2 5 Z"/>
					</svg>
				</button>

				<button @click="toggleFullscreen" title="Fullscreen" class="outline-none text-right text-grey hover:text-grey-dark">
					<!-- Close Icon -->
					<svg v-show="fullscreen" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/></svg>

					<!-- Fullscreen icon -->
					<svg v-show="!fullscreen" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.8 15.8L0 13v7h7l-2.8-2.8 4.34-4.32-1.42-1.42L2.8 15.8zM17.2 4.2L20 7V0h-7l2.8 2.8-4.34 4.32 1.42 1.42L17.2 4.2zm-1.4 13L13 20h7v-7l-2.8 2.8-4.32-4.34-1.42 1.42 4.33 4.33zM4.2 2.8L7 0H0v7l2.8-2.8 4.32 4.34 1.42-1.42L4.2 2.8z"/></svg>
				</button>
			</div>
		</div>
		<div class="flex flex-grow flex-row">
			<div class="flex-1">
				<textarea class="appearance-none w-full text-grey-darker outline-none border-teal p-4 h-full rounded-none shadow-none" v-model="input">
					Type stuff
				</textarea>
			</div>
			<div v-show="split" class="flex-1 p-4 bg-white rounded-none border-l border-grey-lighter">
				<div v-html="output"></div>
			</div>
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
				split: true,
			}
		},
		computed: {
			fullscreenClass() {
				return this.fullscreen ? 'z-50 absolute w-full pin-t pin-l h-full' : 'h-64';
			},
			output() {
				return marked(this.input);
			}
		},

		methods: {
			toggleFullscreen() {
				this.fullscreen = !this.fullscreen;
			}, 
			toggleSplit() {
				this.split = !this.split;
			},
			closeOnEscape(evt) {
				if (evt.keyCode === 27 && this.fullscreen) {
					this.fullscreen = false;
				}
			}
		},

		mounted() {
			document.addEventListener('keyup', this.closeOnEscape);
		}
	}
</script>

<style>
	.outline-none, .outline-none:focus {
		outline: none;
	}
</style>