var CKEDITOR_BASEPATH = '/src/app-assets/vendors/js/ckeditor/';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': token.content
	    }
	});
}