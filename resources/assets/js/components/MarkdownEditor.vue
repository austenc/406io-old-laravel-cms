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
				<button @click.prevent="insert('[', '](http://)')" :title="'Insert Link (' + superKey + ' + K)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="link"/>
				</button>
				<button @click.prevent="insert('- ', '')" :title="'Unordered List (' + superKey + ' + Shift + L)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="list"/>
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
				<div id="ace-editor" ref="editor" @input="update"

					></div>

				<textarea ref="textarea" style="display: none;"
					:name="name"
					v-model="input"
					class="font-mono text-sm appearance-none w-full text-grey-darker outline-none border-teal p-4 h-full rounded-none shadow-none">
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
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import Editor from '../mixins/editor';
	import Toolbar from '../mixins/toolbar';
	import Fullscreen from '../mixins/fullscreen';

	import * as ace from 'brace';
	import 'brace/mode/markdown';
	import 'brace/theme/tomorrow_night_eighties';

	export default {
		components: {
			FontAwesomeIcon
		},
		mixins: [Editor, Toolbar, Fullscreen],
	}
</script>

<style lang="scss">
	$height: 84vh;

	#ace-editor {
		padding-top: 1rem;
		position: relative;
		width: 100%;
	}
	#ace-editor, .editor-preview {
		height: $height;
	}
	.outline-none, .outline-none:focus {
		outline: none;
	}

	.editor-toolbar {
		height: 40px;
	}

	.editor-fullscreen {
		top: 41px;

		#ace-editor, .editor-preview {
			height: 100%;			
		}
	}

	.preview-fullscreen {
		padding-bottom: 100px;
	}
</style>