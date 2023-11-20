var CKEDITOR_BASEPATH = '/robust/app-assets/vendors/js/editors/ckeditor/';

var token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': token.content
	    }
	});
}