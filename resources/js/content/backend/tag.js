/*=========================================================================================
    File Name: banner.js
    Description: Banner
==========================================================================================*/
$(function () {
	var $page = $('#tag-page'),
		$table = {};

	var page = {
		dtTable: {},
		init() {
			// $page.find('select').select2();
			$table = $page.find('#tag-datatable');

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
            // console.log(columns);

			// console.table(columns);

			this.dtTable = $table.DataTable({
		        "processing": true,
	            "serverSide": true,
	            "searching": false,
	            "lengthChange": false,
				"order" : [[0, 'desc']],
	            "ajax": {
	                url: "/admin/ajax/tag",
	                type: "POST",
	                data: function (d) {
	                	d.mode = 'datatable';
						d.search = {
							value: $("#filter-keyword").val()
						};
	                }
	            },
		        "columns": columns,
                "order": [[0, 'desc']],
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

			$page.on('input', '#form-tag input[name="name"]', function(e){
				const val = $(this).val();
				$page.find('#form-tag input[name="slug"]').val(page.slugify(val));
			});
		},
        deleteData: function (rowId) {
			$.ajax({
	            url: '/admin/tags/'+rowId,
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
		slugify: function (text) {
			return text
			.toLowerCase()
			.replace(/[^\w ]+/g,'')
			.replace(/ +/g,'-')
			;
		},
	};

	if ($page.length) {
		page.init()
		// page.avoidAutoCompleteForm()
	}
});
