var site_url= '';
function get_supplier_items() {
    supplier_id = $('#supplier_id').val();
    $.ajax({
        url: site_url+'rafeed-admin/index.php/Contract/get_supplier_items/'+ supplier_id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#supplier_items').empty().append(response);
            $(".chosen-select").chosen();
            $('#submit').show();
        }
    });  
    return false;
}



function SaveContract() {

    $("#AddContract").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("AddContract"));
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                
                if (response.success === true) {
                    window.location.href = site_url+'rafeed-admin/index.php/Contract/index';
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
                        $("#MessageAlertDiv").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        // hide the modal
                        $("#CreateMessageModal").modal('hide');
                        // update the manageMemberTable
                        //manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}

function ShowContract(id)
{
    $.ajax({
        url: site_url+'rafeed-admin/index.php/Contract/get_contract_data/'+ id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            div = $('#ContractModal #items');
            div.empty();
            $('#ContractModal #supplier_contract_no').html('Supplier Contract NO : '+response.contract.NO);
            $('#ContractModal #rafeed_contract_no').html('Contract NO : '+pad(response.contract.ID,6));
            $('#ContractModal #supplier').html('Supplier : '+response.contract.supplier_name);
            $('#ContractModal #currency').html('Currency : '+response.contract.currency_name);
            $('#ContractModal #date').html('Date : '+response.contract.date);
            $('#ContractModal #contract_file').empty();
            if(response.contract.reference_file!=null)
            {
                $('#ContractModal #contract_file').empty().append('<a href="'+site_url+"rafeed-includes/upload_files/Contracts/"+response.contract.reference_file+'"><i class="fa fa-download" aria-hidden="true"></i> Contract file</a>');
            }
            response.items.forEach(element => {
                item = "<tr>"+
                '<td>'+element.reference_code+'</td>'+
                '<td>'+element.unit_name+'</td>'+
                '<td>'+element.quantity+'</td>'+
                '<td>'+element.price+'</td>'+
                '</tr>';
                 div.append(item);
            });
        }
    });
    return false;
}

$old_supplier = $("#AddContract #supplier_id").val();
function check_entered_data(filed)
{
    $supplier = $("#AddContract #supplier_id").val();    
    if((filed=="supplier" && $old_supplier && $old_supplier != $supplier))
    {
        $('#ChangeSupplierModal #confim_message').html('Are you sure you want to change '+filed+',any data entedred will be lost?')
        $('#ChangeSupplierModal').modal();
    }
    else{
        get_supplier_items();
    }
    if(filed == "supplier")
    {
        $old_supplier =$supplier;
    }
}

function Confirm_change_supplier(element)
{
    element.preventDefault();
    $('supplier_items').empty();
    return false;
}

$(document).ready(function(){
    $('#ChangeSupplierModal #ConfirmChange').on('click',function(event)
    {
        event.preventDefault();
        $('#supplier_items').empty();
        $('#ChangeSupplierModal').modal('hide');
        get_supplier_items();
    });
})

$contract_id = null;
$(document).ready(function(){
    $('#CancelContract #ConfirmChange').on('click',function(event)
    {
        event.preventDefault();
        $.ajax({
            url: "cancel_contract/"+$contract_id,
            type: "GET",
            processData: false,
            contentType: false,
            dataType: 'json',
            success :function(response){
                $('#CancelContract').modal('hide');
                // update the manageMemberTable
                manageMemberTable.ajax.reload(null, false);
            }
        });
    });
})

function cancel_contract($id)
{
    $('#CancelContract #confim_message').html('Are you sure you want to cancel this contract?')
    $('#CancelContract').modal();
    $contract_id = $id;
}

function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}

$(document).ready(function(){
  $("#SearchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#SearchTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

