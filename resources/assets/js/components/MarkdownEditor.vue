<template>
	<div class="shadow flex flex-grow flex-col border border-grey-light" :class="fullscreenClass" style="min-height: 300px;">
		<div class="flex justify-between bg-grey-lighter text-grey p-2 border-b border-grey-light pt-3 px-4">
			<div>
				<button @click.prevent="insert('**', '**')" :title="'Bold (' + superKey + ' + B)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="bold" />
				</button>
				<button @click.prevent="insert('*', '*')" :title="'Italic (' + superKey + ' + I)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="italic" />
				</button>
			</div>
			<div class="text-right">		
				<button @click.prevent="toggleSplit" :title="split ? 'Hide Preview' : 'Show Preview'" class="w-4 h-4 outline-none text-right text-grey hover:text-grey-dark mr-1">

					<!-- Single / Split Pane Icons -->
					<font-awesome-icon :icon="['far', 'window-maximize']" v-show="split"></font-awesome-icon>
					<font-awesome-icon icon="columns" v-show="!split"></font-awesome-icon>
				</button>

				<button @click.prevent="toggleFullscreen" title="Fullscreen" class="w-4 h-4 outline-none text-right text-grey hover:text-grey-dark">
					<!-- Fullscreen icon -->
					<font-awesome-icon icon="expand-arrows-alt" v-show="!fullscreen" />
					<!-- Close Icon -->
					<font-awesome-icon icon="window-close" v-show="fullscreen" />
				</button>
			</div>
		</div>
		<div :class="editorClass">

			<!-- Editor -->
			<div class="flex-1">
				<textarea ref="editor"
					@keydown.66="bold"
					@keydown.73="italic"
					:name="name"
					class="font-mono text-sm appearance-none w-full text-grey-darker outline-none border-teal p-4 h-full rounded-none shadow-none" 
					v-model="input">
					Type stuff
				</textarea>
			</div>

			<!-- Preview -->
			<div v-show="split" ref="preview" :class="{'preview-fullscreen': fullscreen}" class="editor-preview flex-1 bg-white rounded-none border-l border-grey-lighter overflow-y-scroll">
				<div class="p-4 px-6" v-html="output"></div>
			</div>
		</div>
	</div>
</template>

<script>
	var marked = require('marked');
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'

	export default {
		props: ['name', 'value'],
		components: {
			FontAwesomeIcon
		},
		data() {
			return {
				input: '_Some default text_',
				fullscreen: false,
				split: true,
			}
		},
		computed: {
			superKey() {
				return isMac() ? 'Cmd' : 'Ctrl';
			},
			fullscreenClass() {
				return this.fullscreen ? 'z-50 w-full h-auto fixed pin-l pin-t' : '';
			},
			editorClass() {
				return this.fullscreen ? 'flex fixed pin-l pin-t w-full h-screen overflow-hidden editor-fullscreen' : 'flex flex-grow flex-row';
			},
			output() {	
				return marked(this.input);
			}
		},

		methods: {
			toggleFullscreen() {
				this.fullscreen = !this.fullscreen;
				this.toggleBodyClass();
			}, 
			toggleSplit() {
				this.split = !this.split;
			},
			closeOnEscape(evt) {
				if (evt.keyCode === 27 && this.fullscreen) {
					this.fullscreen = false;
				}
			},
			toggleBodyClass() {
				if (this.fullscreen) {
					if (this.body.classList)
					  this.body.classList.add('overflow-hidden');
					else
					  this.body.className += ' ' + 'overflow-hidden';
				} else {
					if (this.body.classList)
					  this.body.classList.remove('overflow-hidden');
					else
					  this.body.className = this.body.className.replace(new RegExp('(^|\\b)' + 'overflow-hidden' + '(\\b|$)', 'gi'), ' ');
				}
			},

			bold: cmdOrCtrl(function() {				
				this.insert('**', '**');
			}),

			italic: cmdOrCtrl(function() {				
				this.insert('*', '*');
			}),

			insert(start, end) {
				// grab some info
				let selStart = this.$refs.editor.selectionStart;
				let selEnd = this.$refs.editor.selectionEnd;
				let oldContent = this.$refs.editor.value;
				this.$refs.editor.focus();

				// If we're not selecting anything, put the content in right at the cursor
				if (selStart === selEnd) {
					this.$refs.editor.value = this.input.substring(0, selEnd) 
						+ start + end + this.input.substring(selEnd, oldContent.length);
					this.$refs.editor.setSelectionRange(selEnd + 2, selEnd + start.length + end.length - 2);

				// Otherwise we need to surround the current selection with our tags
				} else { 
					this.$refs.editor.value = oldContent.substring(0, selStart) 
					+ start + oldContent.substring(selStart, selEnd) + end 
					+ oldContent.substring(selEnd, oldContent.length)

					// this.$refs.editor.setSelectionRange(selEnd +)
				}
			}
		},

		mounted() {
			this.input = this.value;
			this.body = document.getElementsByTagName('body')[0];
			document.addEventListener('keyup', this.closeOnEscape);
			var self = this;
			this.$refs.editor.addEventListener('scroll', function() {
				self.$refs.preview.scrollTop = self.$refs.editor.scrollTop;
			});
			this.$refs.preview.addEventListener('scroll', function() {
				self.$refs.editor.scrollTop = self.$refs.preview.scrollTop;
			});

			// Markdown parsing with marked
			var markedOptions = {};
			markedOptions.highlight = function(code) {
				return hljs.highlightAuto(code).value;
			};
			marked.setOptions(markedOptions);
		}
	}

	function isMac() {
		var platform = window.navigator.platform,
		    macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'];

		return macosPlatforms.indexOf(platform) !== -1;
	}

	function cmdOrCtrl(fn) {
		return function (e) {
		  if ((isMac() && e.metaKey) || e.ctrlKey) {
		    return fn.apply(this, arguments)
		  }
		}
	}
</script>

<style>
	.outline-none, .outline-none:focus {
		outline: none;
	}

	.editor-toolbar {
		height: 40px;
	}

	.editor-fullscreen {
		top: 41px;
	}

	.preview-fullscreen, .editor-fullscreen textarea {
		padding-bottom: 100px;
	}
</style>