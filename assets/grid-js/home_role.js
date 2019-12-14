function addRoleModal() {
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('Add role');
    $('#createRoleForm').trigger('reset');
    $("#createRoleForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("createRoleForm"));
    
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                
                if (response.success === true) {
                    $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // hide the modal
                    $("#addRoleModal").modal('hide');

                    // update the manageMemberTable
                    manageMemberTable.ajax.reload(null, false);
              

                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function (index, value) {
                            var id = $("#" + index);

                            id
                                .closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .after(value);

                        });
                      
                    } else {
                        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        // hide the modal
                        $("#addRoleModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}


function update_role_modal(id) {
    $.ajax({
        url: "./Role/get_role?id="+id,
        type: "get",
        dataType: 'json',
        success: function (response) {
            if(response.length==1){
                $("#editRoleModal #name").val(response[0]['name']);
                $('#editRoleModal #display_name').val(response[0]['display_name']);
                $('#editRoleModal #Status').val(response[0]['status']);
                $('#editRoleModal #description').val(response[0]['description']);
                $('#editRoleModal #id').val(response[0]['id']);
            
            }
            else 
            {
                $("#editRoleModal")[0].reset();
                $("#editRoleModal").hide();
            }
            
        }
      
    });

    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();

    $('.modal-title').html('Edit role');

    $("#editRoleForm").unbind('submit').bind('submit', function () {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("editRoleForm"));
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            async: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success === true) {
                    $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // hide the modal
                    $("#editRoleModal").modal('hide');

                    // update the manageMemberTable
                    manageMemberTable.ajax.reload(null, false);

                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function (index, value) {
                            var id = $("#" + index);

                            id
                                .closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .after(value);

                        });
                    } else {
                        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        // hide the modal
                        $("#editRoleModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                    }
                }
            }
        });
        return false;
    });
}




function  update_role_permissions(id) {

    $('#RolePermissionsForm').trigger('reset');
    $('#RoleUpdatePermissionModal #role_id').val(id);
    $.ajax({
        url: "../Role/get_role_permissions?role_id="+id,
        type: "get",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
           response.forEach(function(item){
            $('#'+item.permission_id).prop('checked',true);
        })
           

        }
    });

 
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('Role permissions');;
    $('#RolePermissionsForm  #user_id').val(id);
    $("#RolePermissionsForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("RolePermissionsForm"));
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                
                if (response.success === true) {
                    $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // hide the modal
                    $("#RoleUpdatePermissionModal").modal('hide');

                    // update the manageMemberTable
                    manageMemberTable.ajax.reload(null, false);
              

                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function (index, value) {
                            var id = $("#" + index);

                            id
                                .closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .after(value);

                        });
                      
                    } else {
                        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        // hide the modal
                        $("#RoleUpdatePermissionModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

    
    

}


