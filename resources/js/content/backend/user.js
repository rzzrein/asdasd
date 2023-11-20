/*=========================================================================================
    File Name: user.js
    Description: User Page
==========================================================================================*/
$(function () {
	var $page = $('#user-page'),
		$table = {};

	var page = {
		dtTable: {},
		init() {
			$page.find('select').select2();
			$table = $page.find('#user-datatable');

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
	                url: "/admin/ajax/users",
	                type: "POST",
	                data: function (d) {
                        var cb_active = [];
                        $("#table-filter .cb-active:checked").each(function (index) {
                            cb_active.push(this.value);
                        });
                        d.active = cb_active;
	                	d.mode = 'datatable';
						d.search = {
							value: $("#filter-keyword").val()
						};
                        d.start_date = $("#table-filter #form-startdate").val();
                        d.end_date = $("#table-filter #form-enddate").val();
	                }
	            },
		        "columns": columns,
		        "columnDefs": [
	                { targets: 'wrapper-action', className: 'wrapper-action' },
	            ],
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

            page.initDaterangepicker();
		},
		deleteData(rowId) {
			$.ajax({
	            url: '/admin/users/'+rowId,
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
		avoidAutoCompleteForm() {
			if ($('#form-user').length) {
				//New user
				setTimeout(() => {
					if (!$('#form-user').find('input[name="id"]').length) {
						// $('#form-user').find('input[name="username"]').val("")
						$('#form-user').find('input[name="email"]').val("")
					}
					$('#form-user').find('input[type="password"]').val("")
				}, 1000);
			}
		},
        initDaterangepicker: function () {
            $('.form-datepicker').daterangepicker({
                autoUpdateInput: false,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),10),
                locale: {
                    format: 'DD-MM-YYYY'
                }
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
	};

	if ($page.length) {
		page.init()
		// page.avoidAutoCompleteForm()
	}
});
