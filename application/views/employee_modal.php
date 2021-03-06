<div class="modal fade" role="dialog" id="AddEmployeeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Employee</h4>
            </div>

            <?php echo form_open_multipart('employee/add_employee', $attributes = array('id' => 'AddEmployee')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('First name', 'firts_name', $attributes = array()); ?>
                            <?php echo form_input('first_name', set_value('first_name'), $attributes = array('class' => "form-control", "id" => "first_name")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Last Name', 'last_name', $attributes = array()); ?>
                            <?php echo form_input('last_name', set_value('last_name'), $attributes = array('class' => "form-control", "id" => "last_name")); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('Father name', 'father_name', $attributes = array()); ?>
                        <?php echo form_input('father_name', set_value('father_name'), $attributes = array('class' => "form-control", "id" => "father_name")); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php echo form_label('address', 'address', $attributes = array()); ?>
                        <?php echo form_input('address', set_value('address'), $attributes = array('class' => "form-control", "id" => "address")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('gender', 'gender', $attributes = array()); ?>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-xs-6">
                        <?php echo form_label('Birthday', 'birthday', $attributes = array()); ?>
                        <input type="date" name="biryhday" id="birthday" class="form-control">
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('Email', 'email', $attributes = array()); ?>
                        <?php echo form_input('email', set_value('email'), $attributes = array('class' => "form-control", "id" => "email")); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('Mobile Phone', 'mobile', $attributes = array()); ?>
                        <?php echo form_input('mobile', set_value('mobile'), $attributes = array('class' => "form-control", "id" => "mobile")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('Photo', 'photo', $attributes = array()); ?>
                        <input type="file" name="photo" class="file" accept='image/png,image/jpeg,image/jpg,image/gif'>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'Save', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div class="modal fade" role="dialog" id="EditEmployeeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Employee</h4>
            </div>

            <?php echo form_open_multipart('employee/edit_employee', $attributes = array('id' => 'EditEmployee')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('First name', 'firts_name', $attributes = array()); ?>
                            <?php echo form_input('first_name', set_value('first_name'), $attributes = array('class' => "form-control", "id" => "first_name")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Last Name', 'last_name', $attributes = array()); ?>
                            <?php echo form_input('last_name', set_value('last_name'), $attributes = array('class' => "form-control", "id" => "last_name")); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('Father name', 'father_name', $attributes = array()); ?>
                        <?php echo form_input('father_name', set_value('father_name'), $attributes = array('class' => "form-control", "id" => "father_name")); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php echo form_label('address', 'address', $attributes = array()); ?>
                        <?php echo form_input('address', set_value('address'), $attributes = array('class' => "form-control", "id" => "address")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('gender', 'gender', $attributes = array()); ?>
                        ,<select name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-xs-6">
                        <?php echo form_label('Birthday', 'birthday', $attributes = array()); ?>
                        <input type="date" name="birthday" id="birthday" class="form-control">
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('Email', 'email', $attributes = array()); ?>
                        <?php echo form_input('email', set_value('email'), $attributes = array('class' => "form-control", "id" => "email")); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo form_label('Mobile Phone', 'mobile', $attributes = array()); ?>
                        <?php echo form_input('mobile', set_value('mobile'), $attributes = array('class' => "form-control", "id" => "mobile")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo form_label('Photo', 'photo', $attributes = array()); ?>
                        <input type="file" name="photo" class="file" accept='image/png,image/jpeg,image/jpg,image/gif'>
                    </div>
                </div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'Save', array("class" => "btn btn-primary", "id" => "submit")); ?>
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
  
  $(document).ready(function() {
      $('#button-action').append('<a class="btn btn-default pull pull-right" data-toggle="modal" data-target="#AddEmployeeModal" onclick="addEmployee()">Add </a>');
  });
</script>
<?php //}?>
