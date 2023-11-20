import QiscusSDKCore from 'qiscus-sdk-core';

window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.bootstrap = require('bootstrap');
window.$ = require('jquery')
window.jQuery = window.$
require('jquery-ui/dist/jquery-ui.js');
window.select2 = require('select2')
window.slugify = require('slugify')
window.DataTable = require( 'datatables.net-bs5' );

window.bootbox = require('bootbox')
window.iziToast = require('izitoast')
window.bootstrapSwitch = require('bootstrap-switch')
window.dropzone = require('dropzone')
window.datepicker = require('bootstrap-datepicker')
window.bootstrapDaterangepicker = require('bootstrap-daterangepicker')
window.bootstrapMaxlength = require('bootstrap-maxlength')
window.Dropzone = window.dropzone
window.wnumb = require('wnumb')
window.Swal = require('sweetalert2')
window.moment = require('moment')
window.SmoothScroll = require('smooth-scroll')
window.Popper = require('@popperjs/core')
window.qiscus = new QiscusSDKCore()
window.EmojiMart = require('emoji-mart')

$.fn.dataTable.ext.errMode = 'throw';

addEventListener("error", (event) => {
    let isDataTableError =
        event.message?.includes('Error: DataTables warning: table id=') == true &&
        event.message?.includes('Ajax error. For more information about this error') == true;

    if (isDataTableError) {
        event.preventDefault();
        window.location.reload();
    }
});
