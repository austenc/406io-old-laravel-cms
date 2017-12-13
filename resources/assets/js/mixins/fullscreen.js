export default {

    data() {
        return {
            fullscreen: false,
            split: false
        }
    },

    computed: {
        fullscreenClass() {
            return this.fullscreen ? 'z-50 w-full h-auto fixed pin-l pin-t' : '';
        },
        editorClass() {
            return this.fullscreen ? 'flex fixed pin-l pin-t w-full h-screen overflow-hidden editor-fullscreen' : 'flex flex-grow flex-row';
        },
    }, 

    methods:  {
        toggleFullscreen() {
            this.fullscreen = !this.fullscreen;
            this.$refs.editor.focus();
            this.toggleBodyClass();
        }, 
        toggleSplit() {
            this.split = !this.split;
            this.$refs.editor.focus();
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
    },

    mounted() {
        // Close fullscreen on ESC key press
        document.addEventListener('keyup', this.closeOnEscape);

        // Set up the reference to the body tag
        this.body = document.getElementsByTagName('body')[0];

        // Synchronize scrolling between preview and editor
        var self = this;
        this.$refs.editor.addEventListener('scroll', function() {
            self.$refs.preview.scrollTop = self.$refs.editor.scrollTop;
        });
        this.$refs.preview.addEventListener('scroll', function() {
            self.$refs.editor.scrollTop = self.$refs.preview.scrollTop;
        });

    }
}