<!-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<div class="messages"></div>
<div id="button-action"></div>
<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="MemberTable">
	<thead>
		<tr>
			<?php foreach ($grid_header as $key => $value) {
				echo "<th>".$value."</th>";
			} ?>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<?php foreach ($grid_header as $key => $value) {
				echo "<th>".$value."</th>";
			} ?>	
		</tr>
	</tfoot>
</table>

<?php if (isset($custom_modal_file)) {
	$this->load->view($custom_modal_file,$custom_modal_data);
}
?>

<script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/grid-inline/dataTables.cellEdit.js"></script>
<script type="text/javascript">
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#MemberTable").DataTable({
			/*dom: 'Bfrtip',*/
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			'ajax': '<?php echo "$read_action"?>',
			'order': []
		});
		manageMemberTable.MakeCellsEditable({
        	//"onUpdate": myCallbackFunction
        	"onUpdate": myCallbackFunction,
	        "inputCss":'form-control',
	        "columns": [0,1],
	        "confirmationButton": { // could also be true
	            "confirmCss": 'btn btn-primary btn-default',
	            "cancelCss": 'btn btn-default'
	        },
	        "inputTypes": [
	            {
	                "column": 0,
	                "type": "text",
	                "options": null
	            },
	            {
	                "column":1, 
	                "type": "text",
	                "options":null
	            }
	             // Nothing specified for column 3 so it will default to text
	            
	        ]
    	});	
	});
	function myCallbackFunction(updatedCell, updatedRow, oldValue) {
		length = $('select[name="MemberTable_length"]').val();
		row_id = updatedCell[0][0].row%(length);
		if (updatedCell.data() != oldValue) {
		    $.ajax({
		        async: true,
		        type: 'post',
		        url: './Indexes/update_value_inline/'+$($("#MemberTable tbody tr")[row_id]).find('#row_id').val(),
		        data: {
		        	'tabel_name': '<?php echo $table_name;?>',
		        	'language_index':updatedCell[0][0].column,
		        	'value':updatedCell.data()
		        },
		         success: function(result){
		            if(result=='true')
		            {
		                // update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
		            }
		         }
		     });
		}
	    //updatedCell[0][0].row
	}
</script>