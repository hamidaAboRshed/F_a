function addCustomer()
{
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('#AddCustomer').trigger('reset');
    $("#AddCustomer").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("AddCustomer"));
    
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
                    $("#AddCustomerModal").modal('hide');
    
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
                        $("#AddCustomerModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });
}

function EditCustomer(id)
{
        
    $('#EditCustomer #id').val(id);
    $.ajax({
        url: './Customer/fetchCustomerData/'+id,
        type: 'get',
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            $('#EditCustomer #first_name').val(response['FirstName']);
            $('#EditCustomer #last_name').val(response['LastName']);
            $('#EditCustomer #address').val(response['address']);
        }
    });
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('#EditCustomer').trigger('reset');
    $("#EditCustomer").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("EditCustomer"));
    
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
                    $("#EditCustomerModal").modal('hide');
    
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
                        $("#EditCustomerModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });
}

function ViewCustomer(id) {

    $.ajax({
        url: './Customer/fetchCustomerData/'+id,
        type: 'get',
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $('#ViewCustomerModal #first_name').empty().append('<B>First Name:</B>'+response['FirstName']);
            $('#ViewCustomerModal #last_name').empty().append('<B>Last Name:</B>'+response['LastName']);
            $('#ViewCustomerModal #address').empty().append('<B>Address:</B>'+response['address']);
            $('#ViewCustomerModal #image').prop('src',response['Photo'])
        }
    });
}
