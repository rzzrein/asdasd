const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');
const WebpackRTLPlugin = require('webpack-rtl-plugin');
const del = require('del');
const fs = require('fs');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    watchOptions: { ignored: /node_modules/ }
});

const args = getParameters();
// get selected demo, default is demo1
let demo = getDemos(path.resolve(__dirname, 'resources/vendor/metronic'))[0];

// Remove existing generated assets from public folder
del.sync([
	'public/js/tinymce/*', 'public/dist/css/*', 'public/dist/js/*', 'public/dist/media/*', 'public/dist/plugins/*',
	'public/dist/metronic/css/*', 'public/dist/metronic/js/*', 'public/dist/metronic/media/*', 'public/dist/metronic/plugins/*',
]);

// Build 3rd party plugins css/js
// TODO - SSDEV - Plugins will he handled in bootstrap.js and app.scss
if (args.indexOf('compile_metronic_plugin') !== -1) {
	mix.sass(`resources/vendor/metronic/core/plugins/plugins.scss`, `public/dist/metronic/plugins/global/plugins.bundle.css`).then(() => {
		// remove unused preprocessed fonts folder
		rimraf(path.resolve('public/dist/metronic/fonts'), () => {
		});
		rimraf(path.resolve('public/dist/metronic/images'), () => {
		});
	}).sourceMaps(!mix.inProduction())
		// .setResourceRoot('./')
		.options({processCssUrls: false})
		// TODO - SSDEV - Plugins will he handled in bootstrap.js and app.scss
		.scripts(require('./resources/vendor/metronic/core/plugins/plugins.js'), `public/dist/metronic/plugins/global/plugins.bundle.js`);

	// Build extended plugin styles
	mix.sass(`resources/vendor/metronic/${demo}/sass/plugins.scss`, `public/dist/metronic/plugins/global/plugins-custom.bundle.css`);
}


// Build Metronic css/js
mix.sass(`resources/vendor/metronic/${demo}/sass/style.scss`, `public/dist/metronic/css/style.bundle.css`, {sassOptions: {includePaths: ['node_modules']}})
    // .options({processCssUrls: false})
    .scripts(require(`./resources/vendor/metronic/${demo}/js/scripts.js`), `public/dist/metronic/js/scripts.bundle.js`);


// Dark skin mode css files
if (args.indexOf('dark_mode') !== -1) {
	// TODO - SSDEV - Plugins will he handled in bootstrap.js and app.scss
	if (args.indexOf('compile_metronic_plugin') !== -1) {
		mix.sass(`resources/vendor/metronic/core/plugins/plugins.dark.scss`, `public/dist/metronic/plugins/global/plugins.dark.bundle.css`);
	    mix.sass(`resources/vendor/metronic/${demo}/sass/plugins.dark.scss`, `public/dist/metronic/plugins/global/plugins-custom.dark.bundle.css`);
	}
	mix.sass(`resources/vendor/metronic/${demo}/sass/style.dark.scss`, `public/dist/metronic/css/style.dark.bundle.css`, {sassOptions: {includePaths: ['node_modules']}});
}


// Build custom 3rd party plugins
// (glob.sync(`resources/vendor/metronic/core/plugins/custom/**/*.js`) || []).forEach(file => {
//     mix.js(file, `public/dist/metronic/${file.replace(`resources/vendor/metronic/core/`, '').replace('.js', '.bundle.js')}`);
// });
// (glob.sync(`resources/vendor/metronic/core/plugins/custom/**/*.scss`) || []).forEach(file => {
//     mix.sass(file, `public/dist/metronic/${file.replace(`resources/vendor/metronic/core/`, '').replace('.scss', '.bundle.css')}`);
// });

// Build Metronic css pages (single page use)
(glob.sync(`resources/vendor/metronic/${demo}/sass/pages/**/!(_)*.scss`) || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace(`resources/vendor/metronic/${demo}/sass`, `public/dist/metronic/css`).replace(/\.scss$/, '.css'));
});

var extendedFiles = [];
// Extend custom js files for laravel
(glob.sync('resources/vendor/metronic/extended/js/**/*.js') || []).forEach(file => {
    var output = `public/dist/metronic/${file.replace('resources/vendor/metronic/extended/', '')}`;
    mix.scripts(file, output);
    extendedFiles.push(output);
});

// Metronic js pages (single page use)
// (glob.sync('resources/vendor/metronic/core/js/custom/**/*.js') || []).forEach(file => {
//     var output = `public/dist/metronic/${file.replace('resources/vendor/metronic/core/', '')}`;
//     if (extendedFiles.indexOf(output) === -1) {
//         mix.js(file, output);
//     }
// });
// (glob.sync(`resources/vendor/metronic/${demo}/js/custom/**/*.js`) || []).forEach(file => {
//     var output = `public/dist/metronic/${file.replace(`resources/vendor/metronic/${demo}/`, '')}`;
//     if (extendedFiles.indexOf(output) === -1) {
//         mix.js(file, output);
//     }
// });

// Metronic media
mix.copyDirectory('resources/vendor/metronic/core/media', `public/dist/metronic/media`);
mix.copyDirectory(`resources/vendor/metronic/${demo}/media`, `public/dist/metronic/media`);

// Metronic theme
(glob.sync(`resources/vendor/metronic/${demo}/sass/themes/**/!(_)*.scss`) || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace(`resources/vendor/metronic/${demo}/sass`, `public/dist/metronic/css`).replace(/\.scss$/, '.css'));
});


//Start LARACORE
mix.js('resources/js/app.js', 'dist/js')
.sass('resources/sass/app.scss', 'dist/css')
.copy('resources/images', 'public/dist/images')
.copy('resources/vendor/fonts', 'public/dist/fonts')
/**TinyMCE Assets */
.copy('resources/vendor/tinymce/icons', 'public/dist/js/icons')
.copy('resources/vendor/tinymce/langs', 'public/dist/js/langs')
.copy('resources/vendor/tinymce/plugins', 'public/dist/js/plugins')
.copy('resources/vendor/tinymce/skins', 'public/dist/js/skins')
.copy('resources/vendor/tinymce/themes', 'public/dist/js/themes')
.scripts([
	'resources/js/config.js',

	// 'resources/vendor/bootstrap-switch/js/bootstrap-switch.min.js',
	// 'resources/vendor/datepicker/js/bootstrap-datepicker.js',
	// 'resources/vendor/charts/js/raphael-min.js',
	// 'resources/vendor/charts/js/morris.min.js',
	// /**Select2 */
	// 'resources/vendor/select2/js/select2.full.min.js',
	// /**Dropzone */
	// 'resources/vendor/dropzone/js/dropzone.min.js',
	// /**DataTable */
	// 'resources/vendor/datatable/js/datatables.min.js',
	/**Validation Engine */
	'resources/vendor/validation-engine/js/jquery.validationEngine.js',
	'resources/vendor/validation-engine/js/jquery.validationEngine-en.js',
	// /**TinyMCE */
	'resources/vendor/tinymce/tinymce.min.js',
	// /**lazyload */
	'resources/vendor/lazyload/js/lazy.min.js',

	'resources/vendor/charts/js/raphael-min.js',
	'resources/vendor/charts/js/morris.min.js',

	'resources/js/helper.js',
], 'public/dist/js/script.js').version()
//BACKEND------------------------------------------------------------------------------------------------------
.scripts([
	'resources/js/config.js',
	'resources/js/content/backend/*',
], 'public/dist/js/admin.js').version()
//Notification------------------------------------------------------------------------------------------------------
.scripts([
	'resources/js/notification/enable-push.js',
], 'public/enable-push.js').version()   
.scripts([
	'resources/js/notification/enable-push-guest.js',
], 'public/enable-push-guest.js').version()   
.scripts([
	'resources/js/notification/sw.js',
], 'public/sw.js').version()   
;


function getDemos(pathDemos) {
    // get possible demo from parameter command
    let demos = [];
    args.forEach((arg) => {
        const demo = arg.match(/^demo.*/g);
        if (demo) {
            demos.push(demo[0]);
        }
    });
    if (demos.length === 0) {
        demos = ['demo1'];
    }
    return demos;
}

function getParameters() {
    var possibleArgs = [
        'dark_mode', 'rtl'
    ];
    for (var i = 0; i <= 13; i++) {
        possibleArgs.push('demo' + i);
    }

    var args = [];
    possibleArgs.forEach(function (key) {
        if (process.env['npm_config_' + key]) {
            args.push(key);
        }
    });

    return args;
}
