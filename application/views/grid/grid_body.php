
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
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/datatables.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Responsive-2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Responsive-2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/buttons.foundation.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/DataTables/Buttons-1.6.1/js/buttons.print.min.js"></script>


<script type="text/javascript">
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#MemberTable").DataTable({
			dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			'ajax': '<?php echo "$read_action"?>',
			'order': []
		});	
	});
</script>

<script>
   

  $(document).ready(function() {
//     $('#').dataTable( {
//     "autoWidth": false
// });
        $('#product').DataTable( {
            "scrollY": 400,
            "scrollX": true,
             "bSort": false,
             "bPaginate": false,
			 "autoWidth": false ,
			 "columnDefs": [
        { "width": "150px", "targets": [0,1] },       
        { "width": "40px", "targets": [4] }
      ]
    } );
} );
    //     } );
    
    //     $(".product_wrapper").css("width","100%");
    // });
    </script>