
	function get_solution_category(sel) {
		
	    $.ajax({
	      async: false,
	      type: 'post',
	      url: '../indexes/Product_category/get_category_by_solution/'+sel.value,
	      success: function(result){

	          $('#product_cat').empty(); //remove all child nodes
	          var obj=JSON.parse(result);
	          $('#product_cat').append($('<option value="0"></option>'));
	          $.each(obj, function () {
	              var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
	             $('#product_cat').append(newOption);
	          });
	          $('#product_cat').trigger("chosen:updated");
	          
	       }
	    });
	}

	function get_category_families(sel) {
		
	    $.ajax({
	      async: false,
	      type: 'post',
	      url: '../premium_product/get_family_by_category',
	      data:{'sol_id' : $("#solution").val(), 'cat_id' : sel.value},
	      success: function(result){

	          $('#ProductFamily').empty(); //remove all child nodes
	          var obj=JSON.parse(result);
	          $('#ProductFamily').append($('<option value="0">All</option>'));
	          $.each(obj, function () {
	              var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
	             $('#ProductFamily').append(newOption);
	          });
	          $('#ProductFamily').trigger("chosen:updated");
	          
	       }
	    });
	}

	function get_premium_product_data() {
		if ($("#solution").val() && $('#product_cat').val() && $('#ProductFamily').val()) {
			$(".alert").remove();
			if ( $.fn.dataTable.isDataTable('#MemberTable') ) {
			    manageMemberTable.destroy();
                manageMemberTable.clear();
                $('#MemberTable thead select').remove();
		  	}
		  	  
		  	manageMemberTable = $("#MemberTable").DataTable({
                columnDefs: [
                   { targets: [7,8], type: 'html' }
                ],
				'dom': 'lBfrtip',
		        'buttons': [
			        'copy', 'csv', 'excel', 'pdf', 'print'
			    ],
                "ordering": false,
                initComplete: function () {
                    this.api().columns([1,2,3,4,5,7,8]).every( function () {
                        var column = this.column( this, {search: 'applied'});
                        var select = $('<select id="filter_s"><option value="">ALL</option></select>')
                            .appendTo($(column.header()))
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
                        column.data().unique().sort().each( function ( d, j ) {
                            if(column.index() == 7 || column.index() == 8){ d = $(d).text(); }
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                } );
        },  
				'ajax':{
			        'type': 'POST',
			        'url': './fetch_premium_product_grid_report/1',
					'data': {'sol_id' : $("#solution").val(), 'cat_id' :$('#product_cat').val(), 'family_id': $('#ProductFamily').val()} 
				},
			});
		  }
		  else
		  	$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
				  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
				  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Please select required field!'+
				'</div>');
	}