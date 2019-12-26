<div class="modal fade" role="dialog" id="addRoleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Role</h4>
            </div>

            <?php echo form_open('Role/create_role', $attributes = array('id' => 'createRoleForm')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Role Name', 'RoleName', $attributes = array()); ?><span class="color-red" >*</span>
                            <?php echo form_input('RoleName', set_value('name'), $attributes = array('class' => "form-control", "id" => "name")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Display name', 'DisplayName', $attributes = array()); ?><span class="color-red" >*</span>
                            <?php echo form_input('DisplayName', set_value('display_name'), $attributes = array('class' => "form-control", "id" => "display_name")); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_label('Description', 'Description', $attributes = array()); ?>
                        <?php echo form_input('Description', set_value('description'), $attributes = array('class' => "form-control", "id" => "description")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Status', 'Status', $attributes = array()); ?><br>
                            <select data-placeholder="Select" class="form-control" id="Status" name="status">
                               <option value="1">Active </option>
                               <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'Save', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div class="modal fade" role="dialog" id="editRoleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Role</h4>
            </div>

            <?php echo form_open('Role/edit_role', $attributes = array('id' => 'editRoleForm')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Role Name', 'RoleName', $attributes = array()); ?><span class="color-red" >*</span>
                            <?php echo form_input('name', set_value('name'), $attributes = array('class' => "form-control", "id" => "name")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Display name', 'DisplayName', $attributes = array()); ?><span class="color-red" >*</span>
                            <?php echo form_input('display_name', set_value('display_name'), $attributes = array('class' => "form-control", "id" => "display_name")); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_label('Description', 'Description', $attributes = array()); ?>
                        <?php echo form_input('description', set_value('description'), $attributes = array('class' => "form-control", "id" => "description")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Status', 'Status', $attributes = array()); ?><br>
                            <select data-placeholder="Select" class="form-control" id="Status" name="status">
                               <option value="1">Active </option>
                               <option value="2">Not Active</option>
                            </select>
                        </div>
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

&nbsp;
<br/>
<div class="modal fade" role="dialog" id="RoleUpdatePermissionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Role permissions</h4>
            </div>

            <?php echo form_open('Role/update_role_permissions', $attributes = array('id' => 'RolePermissionsForm')); ?>
            <div class="modal-body">

               <div class="row">
                <?php foreach ($permissions as $permission){?>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <?php echo form_label($permission->name, 'permission'.$permission->ID, $attributes = array()); ?>
                            <input type="checkbox" name=<?php echo $permission->ID?> value=<?php echo $permission->ID?> id=<?php echo$permission->ID?>>
                        </div>
                    </div>
                    <?php }?>
                </div>
              
                <input type="hidden" id="role_id" name="role_id">
                <div class="modal-footer">
                   <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'change', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script src="<?php echo base_url()?>assets/grid-js/home_role.js"></script>
<?php// if(can(['role_add'])){?>
<script type="text/javascript">
  
  $(document).ready(function() {
      $('#button-action').append('<a class="btn btn-warning pull pull-right" data-toggle="modal" data-target="#addRoleModal" onclick="addRoleModal()">Add </a>');
  });
</script>
<?php //}?>