/*=========================================================================================
    File Name: medical-record.js
    Description: medical record Page
==========================================================================================*/
$(function () {
	var $page = $('#medical-records-page'),
		$table = {};

	var page = {
		dtTable: {},
		init: function () {
			$page.find('select').select2();
			page.initDatatable()
            page.initDaterangepicker()
		},
		initDatatable: function () {
			$table = $page.find('#medical-records-datatable');

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
	                url: "/admin/ajax/medicalRecord",
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

			$table.on('click', '.encrypt-modal', function (e) {
		    	e.preventDefault();

				var modalTitle = $(this).parent().parent().parent().find('td:eq(1)').text();
				if (!modalTitle) {
					modalTitle = $(this).parent().parent().parent().find('td:eq(2)').text();
				}

				var encryptionStatus = $(this).parent().parent().parent().find('td:eq(4)').find('span').text().toLowerCase();
				if (encryptionStatus == 'encrypted') {
					$("#decrypt-download").show();
					var id = $(this).parent().parent().parent().find('td:eq(0)').text();
					$("#decrypt-download").attr('data-id', id);
				} else {
					$("#encrypt").show();
					$("#download").show();

					var id = $(this).parent().parent().parent().find('td:eq(0)').text();
					$("#download").attr('data-id', id);
					$("#encrypt").attr('data-id', id);
				}
				$('#exampleModalLabel').text(modalTitle);
		    	$('#exampleModal').modal('toggle');
		    });

			$('#exampleModal').on('hidden.bs.modal', function (e) {
				page.clearModal();
			})

			$("#decrypt-download, #download").on('click', function (e) {
				$.ajax({
					url: '/admin/ajax/medicalRecord',
					type: 'POST',
					data: {
	                	mode: 'decrypt-download',
						id: $(this).data('id'),
						key: $('#modal-key').val()
	                },
					success: function (data) {
						// Assuming 'data' contains the file URL returned from your AJAX request
						var fileUrl = data;

						// Extract the last part of the URL as the filename
						var filename = fileUrl.split('/').pop();

						// Create an invisible anchor element
						var link = document.createElement('a');
						link.style.display = 'none';

						// Set the download URL
						link.href = fileUrl;

						// Set the download attribute with the extracted filename
						link.download = filename;

						// Append the anchor element to the document
						document.body.appendChild(link);

						// Simulate a click on the anchor element to trigger the download
						link.click();

						console.log(data);

						// Remove the anchor element from the document
						document.body.removeChild(link);
						$('#exampleModal').modal('toggle');
						page.clearModal();
						page.dtTable.draw();
                    },
					error: function(response, textStatus, errorThrown) {
					
						if (response.status == 422) {
							helper.setAlert('Decryption key is incorrect', 'warning');
						} else {
							helper.setAlert('Nonono', 'warning');
						}
					}
				});
			});

			$('#encrypt').on('click', function(e) {
				$.ajax({
					url: '/admin/ajax/medicalRecord',
					type: 'POST',
					data: {
	                	mode: 'encrypt',
						id: $(this).data('id'),
						key: $('#modal-key').val()
	                },
					success: function (data) {
						$('#exampleModal').modal('toggle');
						page.clearModal();
						page.dtTable.draw();
						helper.setAlert('Medical record is encrypted successfully', 'success');
                    },
					error: function(response, textStatus, errorThrown) {
					
						if (response.status == 422) {
							helper.setAlert('Decryption key is incorrect', 'warning');
						} else {
							helper.setAlert('Nonono', 'warning');
						}
					}
				});
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
		clearModal: function () {
			$("#decrypt-download").removeAttr('data-id');
			$("#encrypt").hide();
			$("#download").hide();
			$("#decrypt-download").hide();
			$('#modal-key').val('');
		},
		deleteData: function (rowId) {
			$.ajax({
	            url: '/admin/medical-records/'+rowId,
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
		checkboxHide: function () {
			if ($('textarea[name="active_footer"]').length) {

				$('textarea[name="active_footer"]').change(function () {
					$(".textarea").prop('disabled', this.checked);
				});
			}
			$('.input_control').prop('checked', true);
			$('.input_control').trigger('change');
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
