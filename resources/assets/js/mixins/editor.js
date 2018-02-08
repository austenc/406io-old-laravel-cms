
// Include marked for parsing
var marked = require('marked');

// Editor mixin
export default {

    props: {
        name: String,
        content: String,
        wrap: {
            type: Boolean,
            default: true
        },
        theme: {
            type: String,
            default: 'ace/theme/tomorrow_night_eighties'
        },
        gutter: {
            type: Boolean,
            default: false
        },
        padding: {
            type: Number,
            default: 20
        },
        lineHeight: {
            type: Number,
            default: 2
        },
        showToolbar: {
            type: Boolean,
            default: true
        },
    },

    data() {
        return {
            editor: false,
            input: 'Enter text here',
            renderer: false,
            prevSelection: '',
        }
    },

    computed: {
        output() {  
            return marked(this.input, {renderer: this.renderer});
        }
    },

    methods: {
        update: _.debounce(function (e) {
            this.input = this.editor.getValue();
        }, 100),

        dispatchInputEvent() {
            this.$refs.editor.dispatchEvent(new Event('input', {
                'bubbles': true,
                'cancelable': true
            }));
        },

        setupEditor() {
            var self = this;
            this.editor = ace.edit('ace-editor');
            this.editor.getSession().setMode('ace/mode/markdown');
            this.editor.getSession().setUseWrapMode(this.wrap);
            this.editor.getSession().setScrollTop(0);
            this.editor.setTheme(this.theme);
            this.editor.renderer.setShowGutter(this.gutter);
            this.editor.renderer.setPadding(this.padding);
            this.editor.renderer.setScrollMargin(this.padding, this.padding);
            this.editor.container.style.lineHeight = this.lineHeight;
            this.editor.setValue(this.input, -1);
            this.editor.getSession().on('changeScrollTop', function(scroll) {
                self.$refs.preview.scrollTop = parseInt(scroll) || 0;
            });
            this.editor.getSession().setUndoManager(new ace.UndoManager());
        }

    },
    mounted() {
        this.input = this.content;

        // Markdown parsing with marked
        this.renderer = new marked.Renderer();
        this.renderer.code = function(code, language){
            return '<pre><code class="hljs">' 
            + hljs.highlightAuto(code).value 
            + '</code></pre>';
        };

        this.setupEditor()
    }

}