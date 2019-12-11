<div class="modal fade" role="dialog" id="AddRegulationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Regulations</h4>
            </div>

            <?php echo form_open('Regulation/add_product', $attributes = array('id' => 'AddRegulation')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Code', 'hs_code', $attributes = array()); ?>
                            <?php echo form_input('hs_code', set_value('hs_code'), $attributes = array('class' => "form-control", "id" => "hs_code")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Technical regulation', 'technical_regulation_ar', $attributes = array()); ?>
                            <?php echo form_input('technical_regulation_ar', set_value('technical_regulation_ar'), $attributes = array('class' => "form-control", "id" => "technical_regulation_ar")); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('Category name', 'category_name_ar', $attributes = array()); ?>
                        <?php echo form_input('category_name_ar', set_value('category_name_ar'), $attributes = array('class' => "form-control", "id" => "category_name_ar")); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php echo form_label('Scheme', 'scheme', $attributes = array()); ?>
                        <?php echo form_input('scheme', set_value('scheme'), $attributes = array('class' => "form-control", "id" => "scheme")); ?>
                    </div>
                </div>
                
                
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


<div class="modal fade" role="dialog" id="ViewEmployeeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Employee</h4>
            </div>
            <div class="row">
                <div class="col-md-6 img">
                    <img src="<?php echo base_url();?>" id='image' width="100%" style="padding: 10px;" alt="" class="img-rounded">
                </div>
                <div class="col-md-6 details">
                    <blockquote>
                        <h5 id="name"></h5>
                        <small><cite title="Source Title" id='address'><i class="icon-map-marker"></i></cite></small>
                        <small id="birthday"> </small>
                    </blockquote>
                    <p id='gender'></p>
                    <p id="email"></p>
                    <p id="mobile"></p>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?php echo base_url()?>assets/grid-js/home_employee.js"></script>
<?php //if(can(['employee_add'])){?>
<script type="text/javascript">
  
//   $(document).ready(function() {
//       $('#button-action').append('<a class="btn btn-default pull pull-right" data-toggle="modal" data-target="#AddEmployeeModal" onclick="addEmployee()">Add </a>');
 // });
</script>
<?php //}?>