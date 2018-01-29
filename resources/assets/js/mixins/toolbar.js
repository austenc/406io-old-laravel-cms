import * as ace from 'brace';
var Range = new ace.acequire('ace/range').Range;

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
            } 
        },

        alreadyWrappedWith(selection, before, after) {
            var rangeBefore = new Range(
                selection.start.row, selection.start.column - before.length, 
                selection.end.row, selection.start.column
            );
            var rangeAfter = new Range(
                selection.end.row, selection.end.column,
                selection.end.row, selection.end.column + after.length
            );
            var charsBefore = this.editor.session.getTextRange(rangeBefore);
            var charsAfter = this.editor.session.getTextRange(rangeAfter);

            // Are the before/after tags already wrapping our selection?
            if (charsBefore == before && charsAfter == after) {
                // We should remove the before and after (toggling off)
                this.editor.session.replace(rangeAfter, '');
                this.editor.session.replace(rangeBefore, '');
                this.editor.focus();
                this.dispatchInputEvent();

                return true;
            }

            return false;
        },

        wrapTags(before, after) {

            var selection = this.editor.getSelectionRange();
            
            // Toggle it off if this is already wrapped
            if (this.alreadyWrappedWith(selection, before, after)) {
                return true;
            }

            // Otherwise, add before/after tags wrapping the selection
            this.editor.session.replace(selection, 
                before + this.editor.session.getTextRange(selection) + after
            );   
            selection.start.column += before.length;
            selection.end.column += before.length;
            this.editor.selection.setRange(selection);
            this.editor.focus()   
            this.dispatchInputEvent();        
        },

        bold: cmdOrCtrl(function() {
            this.wrapTags('**', '**');
        }),

        italic: cmdOrCtrl(function() {              
            this.wrapTags('*', '*');
        }),

        link: cmdOrCtrl(function() {
            this.wrapTags('[', '](http://)');
        }),
    }
}