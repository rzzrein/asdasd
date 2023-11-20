const glob = require('glob');

// Keenthemes' plugins
var componentJs = glob.sync(`resources/vendor/metronic/core/js/components/*.js`) || [];
var coreLayoutJs = glob.sync(`resources/vendor/metronic/core/js/layout/*.js`) || [];

// Layout base js
var layoutJs = glob.sync(`resources/vendor/metronic/demo6/js/layout/*.js`) || [];

module.exports = [
    ...componentJs,
    ...coreLayoutJs,
    ...layoutJs,

    // Extended
    'resources/vendor/metronic/extended/button-ajax.js'
];
