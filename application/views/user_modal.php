
<div class="modal fade" role="dialog" id="ResetPasswordModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reset password </h4>
            </div>

            <?php echo form_open('Users/reset_password', $attributes = array('id' => 'ResetUserPaswordForm')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Password', 'password', $attributes = array()); ?>
                            <?php echo form_input('password', set_value('password'), $attributes = array('class' => "form-control", "id" => "password")); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label('Re-type password', 'password_confirmation', $attributes = array()); ?>
                            <?php echo form_input('password_confirmation', set_value('password_confirmation'), $attributes = array('class' => "form-control", "id" => "password_confirmation")); ?>
                        </div>
                    </div>
                </div> 
                <input type="hidden" id="user_id" name="user_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'change', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>



<div class="modal fade" role="dialog" id="UserUpdateRolesModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">User Roles</h4>
            </div>

            <?php echo form_open('Users/update_user_roles', $attributes = array('id' => 'UserRolesForm')); ?>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-6">
                        User : <h2 id="username"></h2>
                    </div>
                </div>
                
                <div class="row">
                <?php foreach ($Roles as $role){?>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <?php echo form_label($role->name, 'role'.$role->id, $attributes = array()); ?>
                            <input type="checkbox" name=<?php echo $role->id?> value=<?php echo $role->id?> id=<?php echo$role->id?>>
                        </div>
                    </div>
                    <?php }?>
                </div>
              
                <input type="hidden" id="user_id" name="user_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'change', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
                <?php echo form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script src="<?php echo base_url()?>assets/grid-js/home_users.js">
