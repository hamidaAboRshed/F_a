<script src="<?php echo base_url();?>/assets/ckeditor/ckeditor.js"></script>
<style>
    #subject, #from{
        margin: 0;
    }   
    #subject b, #from b{
        color: #1B3059;
    }
    .modal-footer{
        padding-bottom: 5px;
    }
    #message_body, #CreateMessageModal{
        border-left-color: #1670F5;
    }    
</style>

<div class="modal fade" role="dialog" id="MessageModal">
    <div class="modal-dialog" role="document" style="margin: 0 auto; width: 50%;">
        <div class="modal-content">
            <div class="modal-body">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target='#CreateMessageModal' onclick="replay_message(this); "  >Replay</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div class="modal fade" role="dialog" id="CreateMessageModal">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send Message </h4>
            </div>
            <?php echo form_open('message/create',array('id'=>'MessageForm')) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('To','reciever');?>
                            <select  name='reciever[]' multiple id='reciever' class="form-control text_field chosen-select reciever">
         
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('Subject','subject');?>
                            <?php echo form_input('subject',set_value('subject'),array('id'=>'subject','class'=>'form-control'));?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('Body','body');?>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo form_label('Send via email','via_email');?>
                            <input type="checkbox" name='via_email'  id='via_email' >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php echo form_submit('submit', 'Send', array("class" => "btn btn-primary", "id" => "submit")); ?>
                </div>
            </div><!-- /.modal-content -->
            <?php form_close();?>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<script>
    
     CKEDITOR.replace('body');
   
</script>