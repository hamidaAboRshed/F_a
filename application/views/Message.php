<style>
#messages-table tr:hover{
    cursor: pointer;
}
#message_table_item{
      margin-top: 10px;  
}
</style>    
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Messages</h3>
        </div>
        <table class="table table-hover" id="messages-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>From</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) { ?>
                    <tr id="<?php echo $message['ID']; ?>" onclick="show_message_table(<?php echo $message['ID']; ?>)">
                        <td><?= $message['subject'] ?></td>
                        <td><?= $message['FirstName'].' '. $message['LastName'] ?></td>
                        <td><?= $message['date'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo $this->pagination->create_links();?>
    </div>
</div>

<div class="col-md-6" id="message_table_item">
    <div class="card" style="margin-top: 5px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                  <h3 id="subject"></h3>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                  <h3 id="from"></h3>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <blockquote id="message_body"></blockquote>
                </div>
            </div>
            <div class="col-xs-12" style="text-align:right;">
                <div class="form-group">
                <small id="date"></small>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateMessageModal" onclick="replay_message(this);" style="float:right;">Replay</button>
            </div>
        </div>
    </div>
    
</div>
<style>
.pagination a{
    padding:7px;
}
</style>