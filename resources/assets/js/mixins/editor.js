
// Include marked for parsing
var marked = require('marked');

// Editor mixin
export default {

    props: ['name', 'content'],

    data() {
        return {
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
            this.input = e.target.value;
        }, 100),

        isLink(start, end) {
            return start == '[' && end.substring(0, 2) == '](';
        },

        alreadyWrapped(start, end, selStart, selEnd, oldContent) {
            // Is it the exact same start/end tags?
            if (oldContent.substring(selStart - start.length, selStart) == start
                && oldContent.substring(selEnd, selEnd + end.length) == end) {
                return true;
            }

            // Check a special case in case it was a link
            if (oldContent.substring(selStart - 2, selStart) == ']('
                && oldContent.substring(selEnd, selEnd + 1) == ')') {
                return true;
            }

            return false;
        },

        insert(start, end) {
            // grab some info
            let selStart = this.$refs.editor.selectionStart;
            let selEnd = this.$refs.editor.selectionEnd;
            let oldContent = this.$refs.editor.value;

            // Put our focus back in the editor
            this.$refs.editor.focus();

            // If the start/end are already wrapping, remove them and return
            if (this.alreadyWrapped(start, end, selStart, selEnd, oldContent)) {
                this.removeWrappedTag(start, end, selStart, selEnd, oldContent);
                return;
            }

            if (oldContent.substring(selStart - start.length, selStart) == start
                && oldContent.substring(selEnd, selEnd + end.length) == end) {
                this.removeWrappedTag(start, end, selStart, selEnd, oldContent);
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

                // If we're inserting a link, highlight the http portion
                if (this.isLink(start, end)) {
                    this.$refs.editor.setSelectionRange(selEnd + 3, selEnd + 10);
                    this.prevSelection = oldContent.substring(selStart, selEnd);
                } else {
                    this.$refs.editor.setSelectionRange(selStart + start.length, selEnd + end.length);                    
                }

                this.dispatchInputEvent();
            }
        },

        removeWrappedTag(start, end, selStart, selEnd, oldContent) {
            if (this.isLink(start, end) && selStart != selEnd) {
                this.$refs.editor.value = oldContent.substring(0, selStart - this.prevSelection.length - 3) 
                    + oldContent.substring(selStart - this.prevSelection.length - 2, selEnd - 9)
                    + oldContent.substring(selEnd + 1, oldContent.length);
                this.$refs.editor.setSelectionRange(
                    selStart - this.prevSelection.length - 3,
                    selEnd - 10
                );
            } else {
                this.$refs.editor.value = oldContent.substring(0, selStart - start.length) 
                        + oldContent.substring(selStart, selEnd)
                        + oldContent.substring(selEnd + end.length, oldContent.length);                
    
                if (selStart == selEnd) {
                    this.$refs.editor.setSelectionRange(selStart - start.length, selStart - start.length);                
                } else {
                    this.$refs.editor.setSelectionRange(selStart - start.length, selEnd - end.length);                
                }
            }


            this.dispatchInputEvent();
        },

        dispatchInputEvent() {
            this.$refs.editor.dispatchEvent(new Event('input', {
                'bubbles': true,
                'cancelable': true
            }));
        },

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
    }

}