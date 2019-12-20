function Reset_Password(id) {
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('Reset Password');
    $('#ResetUserPaswordForm').trigger('reset');
    $('#ResetUserPaswordForm  #user_id').val(id);
    $("#ResetUserPaswordForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("ResetUserPaswordForm"));
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
                    $("#ResetPasswordModal").modal('hide');

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
                        $("#ResetPasswordModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}

function change_status(id) {

    var data = "";
    $.ajax({
        url: "./User/change_status?id="+id,
        type: "get",
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
             
                    // update the manageMemberTable
                    manageMemberTable.ajax.reload(null, false);
                 
                }
            }
        }
        
    });

}

function  update_user_roles(id) {

    $('#UserUpdateRolesModal #user_id').val(id);
    $.ajax({
        url: "./User/get_user_roles?id="+id,
        type: "get",
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
           response.forEach(function(item){
            $('#'+item).prop('checked',true);
        })
           

        }
    });

    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('User Roles');;
    $('#UserRolesForm  #user_id').val(id);
    $("#UserRolesForm").trigger('reset');
    $("#UserRolesForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("UserRolesForm"));
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
                    $("#UserUpdateRolesModal").modal('hide');

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
                        $("#UserUpdateRolesModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

    
    

}
