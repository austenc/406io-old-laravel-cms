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

export default {
    computed: {
        superKey() {
            return isMac() ? 'Cmd' : 'Ctrl';
        }
    },

    methods: {
        fullscreenShortcut: cmdOrCtrl(function() {
            this.toggleFullscreen();
        }),

        saveOnEnter(e) {
            if ((isMac() && e.metaKey) || e.ctrlKey) {
                e.preventDefault();
                this.$refs.editor.form.submit();
            } else {
                this.autoAddListItem(e)
            }
        },

        autoAddListItem(e) {
            var editor = this.$refs.editor;            
            var selStart = editor.selectionStart;
            var lineNumber = editor.value.substr(0, selStart).split('\n').length;
            var line = editor.value.split('\n')[lineNumber - 1];
            var firstTwoChars = line.substring(0, 2);;

            // if this is a list item already, add a new one on the next line
            if (firstTwoChars == '- ') {
                e.preventDefault();
                if (line.length == 2) {
                    // remove current line
                    editor.value = editor.value.substring(0, selStart - 2) 
                        + editor.value.substring(selStart, editor.value.length);
                    editor.focus();
                    editor.selectionEnd = selStart - 2;
                } else {
                    document.execCommand("insertText", false, "\n" + '- ');
                }
            }     

            this.$refs.editor.dispatchEvent(new Event('input', {
                'bubbles': true,
                'cancelable': true
            }));    
        },

        bold: cmdOrCtrl(function() {                
            this.insert('**', '**');
        }),

        italic: cmdOrCtrl(function() {              
            this.insert('*', '*');
        }),

        link: cmdOrCtrl(function() {
            this.insert('[', '](http://)');
        }),

        unorderedList: cmdOrCtrl(function() {
            this.insert('- ', '');
        }),
    }
}