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

        saveOnEnter: function(e) {

            var editor = this.$refs.editor;

            if ((isMac() && e.metaKey) || e.ctrlKey) {
                e.preventDefault();
                editor.form.submit();
            } else {
                // if this is a list item already, add a new one on the next line
                var selStart = editor.selectionStart;
                var lineNumber = editor.value.substr(0, selStart).split('\n').length;
                var lines = editor.value.split('\n');
                var currentLine = lines[lineNumber - 1].substring(0, 2);;

                if (currentLine == '- ') {
                    e.preventDefault();
                    if (lines[lineNumber - 1].length == 2) {
                        // remove current line
                        editor.value = editor.value.substring(0, selStart - 2) 
                            + editor.value.substring(selStart, editor.value.length);
                        editor.focus();
                        editor.selectionEnd = selStart - 2;
                    } else {
                        document.execCommand("insertText", false, "\n" + '- ');
                    }
                }         
            }
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