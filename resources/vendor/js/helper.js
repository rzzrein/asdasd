var helper = {};
$(function () {
	helper = {
		init: function () {
			this.initElement();
		},
		initElement: function () {
			$(document).tooltip({
	            selector: '[data-toggle="tooltip"]'
	        });
			if (typeof notifAlert != 'undefined') {
	            helper.setAlert(notifAlert.message, notifAlert.type, notifAlert.title);
	        }
			/* Init CKEditor */
			if ($(".form-ckeditor").length) {
				$(".form-ckeditor").each(function(index) {
					CKEDITOR.replace($(this).attr('id'));
				});
			}
			/* Init Select2 */
			if ($(".form-select2").length) {
				$(".form-select2").select2();
			}
		},
		deleteConfirm: function(message, functionCallback, rowId) {
	        bootbox.confirm({
	            message: message,
	            buttons: {
	                confirm: {
	                    label: 'Delete',
	                    className: 'btn-danger'
	                },
	                cancel: {
	                    label: 'Cancel',
	                    className: 'btn-default'
	                }
	            },
	            callback: function(result) {
	                if (result) {
	                    functionCallback(rowId);
	                }
	            }
	        });
	    },
		okConfirm: function(message, functionCallback, rowId) {
	        bootbox.confirm({
	            message: message,
	            buttons: {
	                confirm: {
	                    label: 'OK',
	                    className: 'btn-success'
	                },
	                cancel: {
	                    label: 'Cancel',
	                    className: 'btn-default'
	                }
	            },
	            callback: function(result) {
	                if (result) {
	                    functionCallback(rowId);
	                }
	            }
	        });
	    },
	    setAlert: function (message, type, title) {
	    	iziToast.settings({
	            position: 'topCenter',
	            transitionIn: 'fadeInDown',
	            transitionOut: 'flipOutX',
	            timeout: 2000
	        });
	    	switch(type) {
	            case 'success':
	                iziToast.success({
	                    title: 'OK',
	                    message: message,
	                });
	                break;
	            case 'warning':
	                iziToast.warning({
	                    title: 'Warning',
	                    message: message,
	                });
	                break;
	            case 'danger':
	                iziToast.error({
	                    title: 'Error',
	                    message: message,
	                });
	                break;
	            case 'info':
	                iziToast.info({
	                    title: 'Info',
	                    message: message,
	                });
	                break;
	            default:
	                iziToast.show({
	                    message: message,
	                });
	                break;
	        }
	    }

	};
	helper.init();
});