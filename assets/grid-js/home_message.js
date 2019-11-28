var site_url= '/';
function get_users_name() {
    user_id = $.cookie("user_id");
    $.ajax({
        url: site_url+'rafeed-admin/index.php/Users/get_users_names/'+ user_id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            div = $('#MessageForm');
            div.trigger('reset');
            $('#MessageForm #reciever').empty();
            response.forEach(function(element) {

                $item = '<option value="'+element.id+'">'+ element.FirstName+' '+element.LastName+'</option>'
                $('#MessageForm #reciever').append($item);
            });
            $("#MessageForm #reciever").trigger("chosen:updated");
        }
    });
    SendMessage();
}

function SendMessage() {
    $('.form-group').removeClass('has-error').removeClass('has-success');
    $('.modal-title').html('Send Message');
    $('#MessageForm').trigger('reset');
    //$("#MessageForm #reciever").trigger("chosen:updated");
    CKEDITOR.instances['body'].setData('');
    $("#MessageForm").unbind('submit').bind('submit', function () {
        var form = $(this);
        // remove the text-danger
        $(".text-danger").remove();
        var data = new FormData(document.getElementById("MessageForm"));
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                
                if (response.success === true) {
                    $("#MessageAlertDiv").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // hide the modal
                    $("#CreateMessageModal").modal('hide');

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
                        $("#MessageAlertDiv").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                            '</div>');
                        // hide the modal
                        $("#CreateMessageModal").modal('hide');
                        // update the manageMemberTable
                        manageMemberTable.ajax.reload(null, false);
                     
                    }
                }
            }
            
        });
        return false;
        
    });

}


function get_messages() {
    user_id = $.cookie("user_id");
    $.ajax({
        url: site_url+'rafeed-admin/index.php/message/get_messages/'+ user_id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            div = $('#message_bar_content');
            div.empty();
            count = 0 ;
            response.forEach(function(element) {
                if(element.is_read == 0){
                    li='<li><div class="wrapper" data-toggle="modal" data-target="#MessageModal" type="button" onclick="show_message('+element.ID+')"><h2>'+element.FirstName+' '+element.LastName+'<i class="fa fa-envelope" style="float:right;"></i></h2><p class="time">'+element.subject.substring(0,50)+'</p><p style="float:right; opacity:0.65; line-height: 5px;">'+element.date+'</p></div></li>';
                    div.append(li);
                }
                else if(element.is_read == 1){
                    li='<li style="opacity:0.57;"><div class="wrapper" data-toggle="modal" data-target="#MessageModal" type="button" onclick="show_message('+element.ID+')"><h2>'+element.FirstName+' '+element.LastName+'<i class="fa fa-envelope-open" style="float:right;"></i></h2><p class="time" >'+element.subject.substring(0,50)+'</p><p style="float:right; opacity:0.65; line-height: 5px;">'+element.date+'</p></div></li>';
                    div.append(li);
                }
                    if(element.is_read == 0)
                    {
                        count++;
                    }
            });

            li ='<li class="notification_show_all">'+
                    '<a href="'+site_url+'rafeed-admin/index.php/Message/table_view/1" class="text-center">Show all</a>'+
                '</li>';
                div.append(li);
            $('#message_count').empty().append(count);
        }
    });
}


function run_message()
{
    get_messages();
    setTimeout(() => {
        run_message()
    }, 3000);
}
 run_message();

 user_sned_id = -1;
 replay_subject='';
 replay_body ='';
 function show_message(id)
{
    $.ajax({
        url: site_url+'rafeed-admin/index.php/message/get_message/'+id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#MessageModal #subject').empty().html("<b>Subject: </b>"+response.subject);
            $('#MessageModal #message_body').empty().html(response.body);
            $('#MessageModal #from').empty().html("<b>From: </b>"+response.FirstName+' '+response.LastName);
            $('#MessageModal #date').empty().html(response.date);
            user_sned_id = response.user_id;
            replay_subject ='Re:'+ response.subject;
            replay_body = '<br><br><h3>Replay message:</h3><blockquote>'+ response.body +'</blockquote>';;
            $.ajax({
                url: site_url+'rafeed-admin/index.php/message/read/'+ id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    get_messages();
                }
            });
        }
    });    
}

function replay_message(e)
{
        get_users_name();
        $('#MessageModal').modal('hide');
        //$("#MessageForm #reciever").trigger("chosen:updated");
        $('#MessageForm #subject').val(replay_subject);
        $('#MessageForm #body').val(replay_body);
        setTimeout(() => {
            $('#MessageForm #subject').val(replay_subject);
            $('#MessageForm #body').val(replay_body);
            CKEDITOR.instances['body'].setData(replay_body);
            $('.chosen-choices .search-choice').remove()
            $("#MessageForm #reciever").val(user_sned_id).trigger("liszt:updated");
            $("#MessageForm #reciever").trigger("chosen:updated");
        }, 500);
 }       

function show_message_table(id)
{
    $.ajax({
        url: site_url+'rafeed-admin/index.php/message/get_message/'+id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#message_table_item #subject').empty().html("<b>Subject: </b>"+response.subject);
            $('#message_table_item #message_body').empty().html(response.body);
            $('#message_table_item #from').empty().html("<b>From: </b>"+response.FirstName+' '+response.LastName);
            $('#message_table_item #date').empty().html(response.date);
            user_sned_id = response.user_id;
            replay_subject ='Re:'+ response.subject;
            replay_body = '<br><br><h3>Replay message:</h3><blockquote>'+ response.body +'</blockquote>';;
            $.ajax({
                url: site_url+'rafeed-admin/index.php/message/read/'+ id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                }
            });
        }
    });
    
}


