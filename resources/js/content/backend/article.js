/*=========================================================================================
    File Name: article.js
    Description: article Page
==========================================================================================*/
$(function () {
	var $page = $('#articles-page'),
		$table = {};

	var page = {
		dtTable: {},
		init: function () {
			$page.find('select').select2();

			// let tagSelect = $page.find('select[name="tag_ids[]"]');
			page.prepareSelect2Sortable($page.find('select[name="tag_ids[]"]'));

			page.initTinyMCE()
			page.initDatatable()
			page.createSlug()
            page.initDaterangepicker()
		},
		initDatatable: function () {
			$table = $page.find('#articles-datatable');

			var columns = [];
			var theadCols = $table.find('thead').find('tr').find('th');
			theadCols.each(function(){
				var data = $(this).attr("data");
				var name = $(this).attr("name");
				var searchable = $(this).attr("searchable") == 'false';
				var className = $(this).attr("class-name");
				var orderable = $(this).attr("orderable") == 'false';
				var colData = {
					data,
					name,
					searchable: searchable ? false : true,
					className,
					orderable: orderable ? false : true};
				columns.push(colData);
			});

			this.dtTable = $table.DataTable({
		        "processing": true,
	            "serverSide": true,
	            "searching": false,
	            "lengthChange": false,
				"order" : [[0, 'desc']],
	            "ajax": {
	                url: "/admin/ajax/articles",
	                type: "POST",
	                data: function (d) {
	                	d.mode = 'datatable';
						d.search = {
							value: $("#filter-keyword").val()
						};
                        var cb_active = [];
                        $("#table-filter .cb-active:checked").each(function (index) {
                            cb_active.push(this.value);
                        });
                        d.active = cb_active;
                        d.start_date = page.toISODate($("#table-filter #form-startdate").val(), '00:00');
                        d.end_date = page.toISODate($("#table-filter #form-enddate").val(), '23:59');
                        d.active = cb_active;
	                },
                    dataFilter: function(data, json){
                        return page.toLocalDate(data);
                    }
	            },
		        "columns": columns,
                "order": [[0, 'desc']],
		        "columnDefs": [
	                { targets: 'wrapper-action', className: 'wrapper-action' },
                    { targets: 'no-sort', orderable: false }
				],
				"drawCallback": function( settings ) {
					$('.lazy').Lazy();
				}
		    });

		    $table.on('click', '.btn-delete', function (e) {
		    	e.preventDefault();
		    	rowId = $(this).data('id');
		    	helper.deleteConfirm('Are you sure to delete this data?', page.deleteData, rowId);
		    });

		    $("#btn-filter").on('click', function (e) {
				page.dtTable.draw();
			});
			$("#filter-keyword").on("keyup", function(e) {
				e.preventDefault();
			  	if (e.keyCode === 13) {
			    	page.dtTable.draw();
			  	}
			});
            $("#table-filter").on('submit', function (e) {
                e.preventDefault();
                page.dtTable.draw();
                return false;
            });
            $("#table-filter .btn-reset").on('click', function (e) {
                e.preventDefault();
                $("#table-filter")[0].reset();
                $("#table-filter .form-daterangepicker").val('');
                page.dtTable.draw();
            });
		},
		deleteData: function (rowId) {
			$.ajax({
	            url: '/admin/articles/'+rowId,
	            type: 'DELETE',
	            dataType: 'json',
	            success: function(response) {
	            	page.dtTable.draw();
	            	helper.setAlert(response.message, 'success');
	            },
	            error: function(response) {
	                console.log(response);
	            }
	        });
		},
		createSlug: function () {
			if ($('input[name="title"]').length) {
				$('input[name="title"]').on('input', function () {
					$('input[name="slug"]').val(page.slugify($(this).val()))
				});
			}
		},
		checkboxHide: function () {
			if ($('textarea[name="active_footer"]').length) {

				$('textarea[name="active_footer"]').change(function () {
					$(".textarea").prop('disabled', this.checked);
				});
			}
			$('.input_control').prop('checked', true);
			$('.input_control').trigger('change');
		},
		slugify: function (text) {
			return text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-')
			;
		},
		initDaterangepicker: function () {
            $('.form-datepicker').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),10)
            });
            $('.form-datepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                $("#form-startdate").val(picker.startDate.format('YYYY-MM-DD'));
                $("#form-enddate").val(picker.endDate.format('YYYY-MM-DD'));
            });
            $("div.daterangepicker").on('click', function(e) {
                e.stopPropagation();
            });
        },
		initTinyMCE: function () {
			if ($('textarea[name="body"]').length) {
				tinymce.init({
					content_style:
						"@import url('https://fonts.googleapis.com/css?family=Nunito+Sans');",
					selector: 'textarea[name="body"]',
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
					removed_menuitems: 'newdocument, code',
					plugins : 'print preview searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount  imagetools textpattern help lists',
					toolbar : 'formatselect fontselect fontsizeselect customimage | pastetext bold italic strikethrough forecolor backcolor permanentpen formatpainter | checklist | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | addcomment | powerpaste | a11ychecker code',
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
			if($('textarea[name="short_description"]').length){
				tinymce.init({
					content_style:
						"@import url('https://fonts.googleapis.com/css?family=Nunito+Sans');",
					selector: 'textarea[name="short_description"]',
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
					removed_menuitems: 'newdocument, code',
					plugins : 'print preview searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount  imagetools textpattern help lists',
					toolbar : 'formatselect fontselect fontsizeselect customimage | pastetext bold italic strikethrough forecolor backcolor permanentpen formatpainter | checklist | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | addcomment | powerpaste | a11ychecker code',
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
		toLocalDate(data) {
            let data2 = JSON.parse(data);
            let options = {year:"numeric", month:"short", day:"numeric", hour:"numeric", minute:"numeric"}
            $.each(data2.data, function(k,v) {
                var date = new Date(v.created_at + " UTC")
                v.created_at = date.toLocaleDateString('id', options);
            })
            return JSON.stringify(data2);
        },
		toISODate(date, time='00:00') {
			if (!date) {
				return null;
			}
			date = new Date(date+' '+time).toISOString();
			return date;
		},
		prepareSelect2Sortable: function(element){
			element.select2()
				 .on('select2:select', function(evt){
					var id = evt.params.data.id;
					var el = $(this).children("option[value="+id+"]");
					moveElementToEndOfParent(el);
					$(this).trigger("change");
				 });
			element.parent()
				 .find("ul.select2-selection__rendered")
				 .sortable({
					containment: 'parent',
					update: function() {
						orderSortedValues();
						// console.log(""+element.val())
					}
				 });
			orderSortedValues = function() {
				var value = ''
				element.parent().find("ul.select2-selection__rendered").children("li[title]").each(function(i, obj){
					var el = element.children('option').filter(function () { return $(this).html() == obj.title });
					moveElementToEndOfParent(el)
				});
			};
			moveElementToEndOfParent = function(el) {
				var parent = el.parent();
				el.detach();
				parent.append(el);
			};
		}

	};

	if ($page.length) {
		page.init();
	}
});
