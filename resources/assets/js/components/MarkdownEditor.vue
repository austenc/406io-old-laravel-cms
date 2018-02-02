<template>
	<div class="shadow flex flex-grow flex-col" :class="fullscreenClass">
		<div v-show="showToolbar" class="flex justify-between bg-grey-lighter text-grey p-2 border-b border-grey-light pt-3 px-4">
			<div>
				<button @click.prevent="wrapTags('**', '**')" :title="'Bold (' + superKey + ' + B)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="bold" />
				</button>
				<button @click.prevent="wrapTags('*', '*')" :title="'Italic (' + superKey + ' + I)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="italic" />
				</button>
				<button @click.prevent="wrapTags('[', '](http://)')" :title="'Insert Link (' + superKey + ' + K)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="link"/>
				</button>
				<button @click.prevent="wrapTags('`', '`')" :title="'Code (' + superKey + ' + ZZZ)'" class="outline-none  h-4 w-4 text-grey hover:text-grey-dark">
					<font-awesome-icon icon="code"/>
				</button>
			</div>
			<div class="text-right">		
				<!-- Preview Only -->
				<button @click.prevent="togglePreview" title="Preview Only" class="w-4 w-4 outline-none text-grey hover:text-grey-dark mr-1">
					<font-awesome-icon icon="eye"></font-awesome-icon>
				</button>

				<!-- Split Screen -->
				<button @click.prevent="toggleSplit" :title="split ? 'Hide Preview' : 'Show Preview'" class="w-4 h-4 outline-none text-right text-grey hover:text-grey-dark mr-1 hidden md:inline">

					<!-- Single / Split Pane Icons -->
					<font-awesome-icon :icon="['far', 'window-maximize']" v-show="split"></font-awesome-icon>
					<font-awesome-icon icon="columns" v-show="!split"></font-awesome-icon>
				</button>

				<button @click.prevent="toggleFullscreen" title="Fullscreen (Alt + Shift + F)" class="w-4 h-4 outline-none text-right text-grey hover:text-grey-dark">
					<!-- Fullscreen icon -->
					<font-awesome-icon icon="expand-arrows-alt" v-show="!fullscreen" />
					<!-- Close Icon -->
					<font-awesome-icon icon="window-close" v-show="fullscreen" />
				</button>
			</div>
		</div>
		<div :class="editorClass">

			<!-- Editor -->
			<div class="flex-1 max-h-screen" v-show="!previewOnly">
				<div id="ace-editor" ref="editor" @input="update"
					@keydown.66.prevent="bold"
					@keydown.73.prevent="italic"
					@keydown.75.prevent="link"
					@keydown.enter="saveOnEnter"
					@keydown.alt.shift.70.prevent="toggleFullscreen"
					></div>

				<textarea ref="textarea" style="display: none;"
					:name="name"
					v-model="input"
					class="font-mono text-sm appearance-none w-full text-grey-darker outline-none border-teal p-4 h-full rounded-none shadow-none">
				</textarea>
			</div>

			<!-- Split Preview -->
			<div v-show="split || previewOnly" ref="preview" class="editor-preview bg-white rounded-none w-1/2 overflow-y-scroll max-h-screen"
				:class="previewClass">
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
	// $height: 84vh;
	$height: 100%;

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
		top: 40px;

		#ace-editor, .editor-preview {
			height: 100%;			
		}
	}

	.preview-fullscreen {
		padding-bottom: 100px;
	}
</style>