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

        bold: cmdOrCtrl(function() {                
            this.insert('**', '**');
        }),

        italic: cmdOrCtrl(function() {              
            this.insert('*', '*');
        }),

        link: cmdOrCtrl(function() {
            this.insert('[', '](http://)');
        }),
    }
}