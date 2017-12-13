// A few helper methods first
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

// Include marked for parsing
var marked = require('marked');

// Editor mixin
export default {

    props: ['name', 'value'],

    data() {
        return {
            input: 'Enter text here',
            renderer: false,
        }
    },

    computed: {
        superKey() {
            return isMac() ? 'Cmd' : 'Ctrl';
        },
        output() {  
            return marked(this.input, {renderer: this.renderer});
        }
    },

    methods: {
        update: _.debounce(function (e) {
            this.input = e.target.value;
        }, 100),

        bold: cmdOrCtrl(function() {                
            this.insert('**', '**');
        }),

        italic: cmdOrCtrl(function() {              
            this.insert('*', '*');
        }),

        link: cmdOrCtrl(function() {
            this.insert('[', '](http://)');
        }),

        insert(start, end) {
            // grab some info
            let selStart = this.$refs.editor.selectionStart;
            let selEnd = this.$refs.editor.selectionEnd;
            let oldContent = this.$refs.editor.value;

            // Put our focus back in the editor
            this.$refs.editor.focus();

            // If the start/end are already wrapping, remove them and return
            if (oldContent.substring(selStart - start.length, selStart) == start
                && oldContent.substring(selEnd, selEnd + end.length) == end) {
                this.$refs.editor.value = oldContent.substring(0, selStart - start.length) 
                    + oldContent.substring(selStart, selEnd)
                    + oldContent.substring(selEnd + end.length, oldContent.length);
                this.$refs.editor.setSelectionRange(selStart - start.length, selEnd - end.length);
                this.$refs.editor.dispatchEvent(new Event('input', {
                    'bubbles': true,
                    'cancelable': true
                }));
                return;
            }   

            // If we're not selecting anything, put the content in right at the cursor
            if (selStart === selEnd) {
                document.execCommand("insertText", false, start + end);
                this.$refs.editor.setSelectionRange(selStart + start.length, selStart + start.length);

            // Otherwise we need to surround the current selection with our tags
            } else {
                let newContent = start + oldContent.substring(selStart, selEnd) + end;
                document.execCommand("insertText", false, newContent); 

                this.$refs.editor.setSelectionRange(selStart + start.length, selEnd + end.length);
                this.$refs.editor.dispatchEvent(new Event('input', {
                    'bubbles': true,
                    'cancelable': true
                }));
            }
        }
    },
    mounted() {
        this.input = this.value;

        // Markdown parsing with marked
        this.renderer = new marked.Renderer();

        this.renderer.code = function(code, language){
            return '<pre><code class="hljs">' 
            + hljs.highlightAuto(code).value 
            + '</code></pre>';
        };
    }

}