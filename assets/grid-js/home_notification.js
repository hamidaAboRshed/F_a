var site_url= '/';
function get_notifications() {
    user_id = $.cookie("user_id");
    $.ajax({
        url: site_url+'rafeed-admin/index.php/notification/get_notifications?user_id='+ user_id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            div = $('#notification_bar_content');
            div.empty();
            count = 0 ;
            response.forEach(function(element) {
                var postion =(element.description).indexOf('<br>');
                var description = (element.description).substring(0,postion);
                if(element.is_read == 0){
                    li='<li><div class="wrapper" data-toggle="modal" data-target="#NotificationModal" type="button" onclick="show_notification('+element.ID+')"><h2>'+element.title+'<i class="fa fa-info-circle" style="float:right;"></i></h2><p class="time">'+description+'</p><p style="float:right; opacity:0.65; line-height: 13px;">'+element.date+'</p></div></li>';
                    div.append(li);
                }
                else if(element.is_read == 1){
                    li='<li style="opacity:0.57;"><div class="wrapper" data-toggle="modal" data-target="#NotificationModal" type="button" onclick="show_notification('+element.ID+')"><h2>'+element.title+'<i class="fa fa-info-circle" style="float:right;"></i></h2><p class="time" >'+description+'</p><p style="float:right; opacity:0.65; line-height: 13px;">'+element.date+'</p></div></li>';
                    div.append(li);
                }
                    if(element.is_read == 0)
                    {
                        count++;
                    }
            });
                    li ='<li class="notification_show_all">'+
                    '<a href="'+site_url+'rafeed-admin/index.php/notification/table_view" class="text-center">Show all</a>'+
                '</li>';
            div.append(li);
            $('#notification_count').empty().append(count);
        }
    });
}

function run_notification()
{
    get_notifications();
    setTimeout(() => {
    run_notification()
    }, 30000);
}
 run_notification();

function show_notification(id)
{
    
    $.ajax({
        url: site_url+'rafeed-admin/index.php/notification/get_notification/'+ id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#NotificationModal #title').empty().append(response.title);
            $('#NotificationModal #desc').empty().append(response.description);
            get_notifications();
        }
    });
    $.ajax({
        url: site_url+'rafeed-admin/index.php/notification/read/'+ id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
        }
    });
}

function show_notification_table(id)
{
    get_notifications();
    $.ajax({
        url: site_url+'rafeed-admin/index.php/notification/get_notification/'+id,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#notification_table_item #title').empty().html(response.title);
            $('#notification_table_item #desc').empty().html(response.description);
            $.ajax({
                url: site_url+'rafeed-admin/index.php/notification/read/'+ id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                }
            });
        }
    });
    
}



