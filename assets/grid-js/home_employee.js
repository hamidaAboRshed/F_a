function addEmployee()
{
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('#AddEmployee').trigger('reset');
    $("#AddEmployee").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("AddEmployee"));
    
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
                    $("#AddEmployeeModal").modal('hide');
    
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
                        $("#AddEmployeeModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });
}


function EditEmployee(id)
{
        
    $('#EditEmployee #id').val(id);
    $.ajax({
        url: './Employee/fetchEmployeeData/'+id,
        type: 'get',
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            $('#EditEmployee #first_name').val(response['FirstName']);
            $('#EditEmployee #last_name').val(response['LastName']);
            $('#EditEmployee #father_name').val(response['FatherName']);
            $('#EditEmployee #email').val(response['Email']);
            $('#EditEmployee #mobile_phone').val(response['MobilePhone']);
            $('#EditEmployee #gender').val(response['Gender']);
            $('#EditEmployee #birthday').val(response['DateOfBirthday']);
            $('#EditEmployee #address').val(response['Address']);
        }
    });
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.text-danger').remove();
    $('#EditEmployee').trigger('reset');
    $("#EditEmployee").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("EditEmployee"));
    
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
                    $("#EditEmployeeModal").modal('hide');
    
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
                        $("#EditEmployeeModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });
}

function ViewEmployee(id) {

    $.ajax({
        url: './Employee/fetchEmployeeData/'+id,
        type: 'get',
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $('#ViewEmployeeModal #name').empty().append('<B>Name:</B>'+response['FirstName']+' '+response['LastName']+' '+response['FatherName']);
            $('#ViewEmployeeModal #email').empty().append('<B>Email:</B>'+response['Email']);
            $('#ViewEmployeeModal #mobile').empty().append('<B>Mobile:</B>'+response['MobilePhone']);
            $('#ViewEmployeeModal #gender').empty().append('<B>Gender:</B>'+response['Gender']);
            $('#ViewEmployeeModal #birthday').empty().append('<B>Birthday:</B>'+response['DateOfBirth']);
            $('#ViewEmployeeModal #address').empty().append('<B>Address:</B>'+response['Address']);
            $('#ViewEmployeeModal #image').prop('src',response['Photo'])
        }
    });
}
