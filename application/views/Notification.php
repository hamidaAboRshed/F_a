<style>
#notifications-table tr:hover{
    cursor: pointer;
}
#notification_table_item{
      margin-top: 10px;  
}
#title{
        margin: 0;
        color: #1B3059;
    }
    .modal-footer{
        padding-bottom: 5px;
    }
</style>    
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Notification</h3>
        </div>
        <table class="table table-hover" id="notifications-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Desciption</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notifications as $notification) { ?>
                    <tr id="<?php echo $notification->ID; ?>" onclick="show_notification_table(<?php echo $notification->ID; ?>)">
                        <td><?= $notification->title ?></td>
                        <td><?= substr($notification->description,0,80);?></td>
                        <td><?= $notification->date ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo $this->pagination->create_links();?>
    </div>
</div>

<div class="col-md-6" id="notification_table_item">
    <div class="card" style="margin-top: 5px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group text-center">
                  <h3 id="title"></h3>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <blockquote id="desc"></blockquote>
                </div>
            </div>
        </div>
    </div>
    
</div>
<style>
.pagination a{
    padding:7px;
}
</style>