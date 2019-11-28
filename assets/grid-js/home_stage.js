function AddStage() {
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('Add Stage ');
    $('#AddStageForm').trigger('reset');
    $("#AddStageForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("AddStageForm"));
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
                    $("#StageModal").modal('hide');

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
                        $("#StageModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}

function EditStage(id) {
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('.modal-title').html('Edit Stage ');
    $('#EditStageForm').trigger('reset');
    $('#EditStageForm #stage_id').val(id);
    $.ajax({
        url: '../getStageData?stage_id='+id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if(response == null)
            {
                $('.container-fluid').append('<p class="text-danger">Error in fetching stage data</p>');
                $("#EditStageModal").modal('hide');
                return false;
            }
            else {
                $('#EditStageForm #name').val(response.name);
                $('#EditStageForm #next_stage').val(response.next_stage_id); 
                $('#EditStageForm #max_time').val(response.max_time); 
                $.ajax({
                    url: '../getStageUser?stage_id='+id,
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        response.forEach(element => {
                            $('#users option[value='+element.user_id+']').attr('selected','selected');
                            });
                    }
                    
                });
            }
        }
        
    });
    $("#EditStageForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("EditStageForm"));
        
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
                    $("#EditStageModal").modal('hide');

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
                        $("#EditStageModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}

