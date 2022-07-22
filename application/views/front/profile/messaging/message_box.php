<div class="card direct-chat direct-chat-warning">
    <div class="card-header with-border">
        <h3 class="card-inner-title pull-left c-base-1">
            <i class="fa fa-comments-o"></i> <span id="msg_box_header"><?php echo translate('select_a_member')?></span>
        </h3>
        <div class="pull-right">
            <small id="msg_refresh">
            </small>
        </div>
    </div>
    <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" id="msg_body" style="height: 100px">
            <p class="c-base-1 pt-4 text-center">"<?php echo translate('select_a_member_from_the_contact_list_to_start_messaging')?>"</p>
        </div>
        <!-- Contacts are loaded here -->
    </div>
    <div class="card-footer" style="padding: 8px;">
        <form class="form-default" id="message_form" method="post">
            <div class="input-group">
                <input type="text" id="message_text" name="message_text" placeholder="Type Message ..." value="" class="form-control" style="z-index: 2;" disabled>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-base-1 btn-flat enterer" id="msg_send_btn" style="width: 60px" disabled><?php echo translate('send')?></button>
                </span>
            </div>
        </form>
    </div>
</div>