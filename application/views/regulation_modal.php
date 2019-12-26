
            
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
                        <?php echo form_label('QM', 'qm', $attributes = array()); ?>
                        <?php echo form_input('qm', set_value('qm'), $attributes = array('class' => "form-control", "id" => "qm")); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('GCTS', 'gcts', $attributes = array()); ?>
                        <?php echo form_input('gcts', set_value('gcts'), $attributes = array('class' => "form-control", "id" => "gcts")); ?>
                    </div>
                    
                    <div class="col-xs-6">
                        <?php echo form_label('IECEE', 'iecee', $attributes = array()); ?>
                        <?php echo form_input('iecee', set_value('iecee'), $attributes = array('class' => "form-control", "id" => "iecee")); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('PLASTIC', 'plastic', $attributes = array()); ?>
                        <?php echo form_input('plastic', set_value('plastic'), $attributes = array('class' => "form-control", "id" => "plastic")); ?>
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

<div class="onoffswitch3">
    <input type="checkbox" name="onoffswitch3" class="onoffswitch3-checkbox" id="myonoffswitch3" checked>
    <label class="onoffswitch3-label" for="myonoffswitch3">
        <span class="onoffswitch3-inner">
            <span class="onoffswitch3-active"><span class="onoffswitch3-switch">Active</span></span>
            <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">Inactive</span></span>
        </span>
    </label>
</div>

<!-- Material switch -->
<div class="onoffswitch3-switch">
  <label>
    Off
    <input type="checkbox">
    <span class="lever"></span> On
  </label>
</div>

<script src="<?php echo base_url()?>assets/grid-js/home_employee.js"></script>
<?php //if(can(['employee_add'])){?>
<script type="text/javascript">

  $(document).ready(function() {
    $('#button-action').append('<a class="onoffswitch3-switch" data-target="#AddEmployeeModal" onclick="get_products()"Language<a/>');
 
    //   $('#button-action').append('<a class="onoffswitch3-checkbox" data-toggle="modal" data-target="#AddEmployeeModal" onclick="get_products()">Language</a>');
 });
</script>

<?php //}?>

