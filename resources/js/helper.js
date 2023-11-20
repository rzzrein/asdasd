var helper = {};
$(function () {
	helper = {
		init: function () {
			this.initElement();
		},
		initElement: function () {
            if ($(".notif-alert").length) {
                var alertMessage = $(".notif-alert").val();
                var alertType = $(".notif-alert").data('type');
                helper.setAlert(alertMessage, alertType);
            }
			/* Init CKEditor */
			if ($(".form-ckeditor").length) {
				var config = {
                    'plugins': 'advcode',
                    'toolbar': 'code',
					'toolbarGroups': [
						{ name: 'document', groups: [ 'Source', '-', 'mode', 'document', 'doctools' ] },
						{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
						{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
						{ name: 'forms', groups: [ 'forms' ] },
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
						{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
						{ name: 'links', groups: [ 'links' ] },
						{ name: 'styles', groups: [ 'styles' ] },
						{ name: 'insert', groups: [ 'insert' ] },
						'/',
						'/',
						{ name: 'colors', groups: [ 'colors' ] },
						{ name: 'tools', groups: [ 'tools' ] },
						{ name: 'others', groups: [ 'others' ] },
						{ name: 'about', groups: [ 'about' ] },
                        { name: 'code', groups: [ 'about' ] },
					],
					'removeButtons': 'Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,SelectAll,Replace,Maximize,ShowBlocks,About,Flash,HorizontalRule,Format,Font,TextColor,BGColor,Save,NewPage,Preview,Print,Smiley,SpecialChar,PageBreak,Iframe,CopyFormatting,RemoveFormat,Subscript,Superscript,BidiLtr,BidiRtl,Language,Templates,Styles'
				};
				$(".form-ckeditor").each(function(index) {
					CKEDITOR.replace($(this).attr('id'), config);
				});
			}
			/* Init Select2 */
			if ($(".form-select2").length) {
				$(".form-select2").select2();
            }
		},
		deleteConfirm: function(message, functionCallback, rowId) {
			Swal.fire({
				title: message,
				showDenyButton: true,
				confirmButtonText: 'Delete',
				denyButtonText: `Cancel`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					functionCallback(rowId)
				}
			})
	    },
		okConfirm: function(message, functionCallback, rowId) {
			Swal.fire({
				title: message,
				showDenyButton: true,
				confirmButtonText: 'OK',
				denyButtonText: `Cancel`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					functionCallback(rowId)
				}
			})
	    },
	    setAlert: function (message, type) {
            iziToast.settings({
                position: 'topRight',
                transitionIn: 'fadeInDown',
                transitionOut: 'flipOutX',
                balloon: true,
                timeout: 4000
            });
            switch (type) {
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
	    },
		listenTabs: function () {
			// Javascript to enable link to tab
			var url = document.location.toString();
			if (url.match('#')) {
				$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
			}

			// Change hash for page-reload
			$('.nav-tabs a').on('shown.bs.tab', function (e) {
				window.location.hash = e.target.hash;
			});
		},
		initTinyMCE: function () {
			if ($('.form-tinymce').length) {
				tinymce.init({
					content_style:
						"@import url('https://fonts.googleapis.com/css?family=Nunito+Sans');",
					selector: '.form-tinymce',
					init_instance_callback: function (editor) {
						editor.on('focus', function (e) {
						});
						editor.on('blur', function (e) {
						});
						editor.on('paste', function (e) {
							tinymce.activeEditor.formatter.apply('p');
						});
					},
					contextmenu_never_use_native: true,
					contextmenu: "copy cut paste spellchecker",
					link_quicklink: false,
					removed_menuitems: 'newdocument',
					plugins : 'print preview searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount  imagetools textpattern help lists code',
					toolbar : 'code | formatselect fontselect fontsizeselect customimage | pastetext bold italic strikethrough forecolor backcolor permanentpen formatpainter | checklist | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | addcomment | powerpaste | a11ychecker',
					block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
					// block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
					spellchecker_languages: 'US English=en,UK English=en_gb,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Norwegian=nb,Brazilian Portuguese=pt_BR,Iberian Portuguese=pt_PT,Spanish=es,Swedish=sv',
					spellchecker_language: 'en', //Set spellchecker language to British English + additional medical terms
					theme   : "silver",
					menu : {
						 format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats block font align fontsizes font_sizes | removeformat'},
					 },
					paste_as_text : false,
					height  : 350,
					branding: false,
					document_base_url: $('#base_url').val(),
					// tinydrive_upload_path : '/' + $('#hidden_assesment_id').val(),
					// tinydrive_max_image_dimension: 450,
					// tinydrive_token_provider: '/jwtprovider/getjwt?id=' + $('#hidden_assesment_id').val() ,
					images_upload_handler: function (blobInfo, success, failure) {
						var xhr, formData;
						xhr = new XMLHttpRequest();
						xhr.withCredentials = false;
						xhr.open('POST', '/admin/ajax/file?mode=image-upload');

						console.log(blobInfo.blob().size);
						if (blobInfo.blob().size > 1024000) {
							failure('Maximum image size is 1024 KB');
						} else {
							xhr.onload = function() {
								var json;
								if (xhr.status != 200 && xhr.status != 201) {
									failure('HTTP Error: ' + xhr.status);
									return;
								}
								json = JSON.parse(xhr.responseText);
								if (!json || typeof json.url != 'string') {
									failure('Invalid JSON: ' + xhr.responseText);
									return;
								}
								success(json.url);
							};
							formData = new FormData();
							formData.append('file', blobInfo.blob(), blobInfo.filename());
							formData.append('_token', token.content);
							xhr.send(formData);
						}
					},
					tinycomments_mode: 'embedded',
					paste_data_images : true,
					paste_enable_default_filters : false,
					paste_word_valid_elements: "b,i,em,h1,h2,h3,u,p,ol,ul,li,table,p,span",
					paste_merge_formats : true,
					paste_convert_word_fake_lists : false,
					paste_retain_style_properties: "color font-size align",
					tinycomments_author: 'Author',
					powerpaste_allow_local_images: true,
					powerpaste_word_import: 'clean',
					powerpaste_html_import: 'clean',
					smart_paste: true,
					formats: {
						alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-left', styles: {textAlign: 'left'} },
						aligncenter: {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center', styles: {display: 'block', margin: '0px auto', textAlign: 'center'}},
						alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-right', styles: {textAlign: 'right'}  },
						alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full', styles: {textAlign: 'justify'}  },
						alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full', styles: {textAlign: 'full'}  },
						// h1: { block: 'h1', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '24pt' , 'color' : '#000000', 'font-family' : 'calibri', 'text-align' : 'center', textAlign: 'center'} },
						// h2: { block: 'h2'},
						// h3: { block: 'h3'},
						// h4: { block: 'h4'},
						h1: { block: 'h1', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '24pt' , 'color' : '#000000', 'font-family' : 'calibri', 'text-align' : 'center', textAlign: 'center'} },
						h2: { block: 'h2', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '16pt' , 'color' : '#000000', 'font-family' : 'calibri', 'text-align' : 'left', textAlign: 'left'} },
						h3: { block: 'h3', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '14pt' , 'color' : '#444444', 'font-family' : 'calibri', 'text-align' : 'left', textAlign: 'left'} },
						h4: { block: 'h4', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '12pt' , 'color' : '#555555', 'font-family' : 'calibri', 'text-align' : 'left', textAlign: 'left'} },
						// h5: { block: 'h5', classes: 'heading', styles: {'font-weight': 'bold', 'font-size': '12pt' , 'color' : '#555555', 'font-family' : 'calibri', 'text-align' : 'left', textAlign: 'left'} },
						p: { block: 'p', classes: 'paragraph', styles: { 'font-weight' : 'normal', 'font-size': '11pt' , 'color' : '#000000', 'font-family' : 'calibri', 'text-align' : 'left',  textAlign: 'left'} },
					},
					font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Calibri=calibri;Comic Sans=comic sans;Verdana=verdana;Tahoma=tahoma;Lucida=lucida;Nunito Sans=nunito sans',
					fontsize_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
					insert_button_items: 'insertfile',
					style_formats: [
						 {title: 'Bold text', inline: 'b'},
						 // {title: 'Heading 2', inline: 'h2'},
						 // {title: 'Heading 3', inline: 'h3'},
						 // {title: 'Heading 4', inline: 'h4'},
						 {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
						 // {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
						 // {title: 'Example 1', inline: 'span', classes: 'example1'},
						 // {title: 'Example 2', inline: 'span', classes: 'example2'},
						 {title: 'Table styles'},
						 {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},
						 // { title: 'My heading', format: 'h1' }
					],
					// powerpaste_clean_filtered_inline_elements: 'strong, em, b, i, u, strike, sup, sub, font, span',
					powerpaste_clean_filtered_inline_elements: 'strong, em, strike, sup, sub, font, span',
					convert_fonts_to_spans: true,
					help_tabs: [
						'shortcuts', // the default shortcuts tabs
					],
					setup: function(editor) {
						 // Register tooltip button
						 editor.ui.registry.addButton('custom_tooltip', {
							 text: 'Tooltip',
							 title: 'Add a tool tip to the selected text.',
							 onclick: function() {
								 editor.windowManager.open({
									 title: 'Insert Tooltip',
									 body: [{
											 type: 'textbox',
											 name: 'tooltipText',
											 label: 'Tooltip Text',
											 value: ''
										 }],
									 onsubmit: function(e) {
										 var title = e.data.tooltipText;
										 var content = editor.selection.getContent();
										 editor.ui.registry.insertContent('<span class="tooltip" title="' + title + '">' + content + '</span>');
									}
								});
							}
						});
					},
				});
			}
		},
		numberInput: function (val) {
			return val.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');
		}
	};
	helper.init();
});
