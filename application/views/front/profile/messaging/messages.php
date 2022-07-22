<?php
    $user_id = $this->session->userdata('member_id');
    $thread_info = $this->db->get_where('message_thread', array('message_thread_id' => $message_thread_id))->row();

    $info1 = $this->db->get_where('member', array('member_id' => $thread_info->message_thread_from))->row();
    $info2 = $this->db->get_where('member', array('member_id' => $thread_info->message_thread_to))->row();

    if ($info1->member_id == $user_id) {
        $from_info = $info1;
        $to_info = $info2;
    } else {
        $from_info = $info2;
        $to_info = $info1;
    }

    $from_image = json_decode($from_info->profile_image, true);
    $to_image = json_decode($to_info->profile_image, true);
    if ($message_count >= 50) {
    ?>
        <div class="text-center"><small><a class="c-base-1" onclick="load_all_msg(<?=$message_thread_id?>)"><?=translate('show_all_messages')?></a></small></div>
    <?php
    }
    foreach ($messages as $message) {
        if ($message->message_from == $user_id) {
        ?>
            <!-- Message. Default to the right -->
            <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">You<!-- <?=$from_info->first_name." ".$from_info->last_name?> --></span>
                    <span class="direct-chat-timestamp pull-left"><?=date('d M,y - h:i A', $message->message_time)?></span>
                </div>
                <!-- /.direct-chat-info -->
                <?php
                    if (file_exists('uploads/profile_image/'.$from_image[0]['thumb'])) {
                    ?>
                        <img class="direct-chat-img"  src="<?=base_url()?>uploads/profile_image/<?=$from_image[0]['thumb']?>">
                    <?php
                    }
                    else {
                    ?>
                        <img class="direct-chat-img"  src="<?=base_url()?>uploads/profile_image/default.jpg">
                    <?php
                    }
                ?>
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    <?=$message->message_text?>
                </div>
                <!-- /.direct-chat-text -->
            </div>
        <?php
        }
        else {
        ?>
            <!-- Message to the left -->
            <div class="direct-chat-msg ">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><?=$to_info->first_name." ".$to_info->last_name?></span>
                    <span class="direct-chat-timestamp pull-right"><?=date('d M,y - h:i A', $message->message_time)?></span>
                </div>
                <!-- /.direct-chat-info -->
                <a target="_blank" href="<?=base_url()?>home/member_profile/<?=$to_info->member_id?>">
                <?php
                    if (file_exists('uploads/profile_image/'.$to_image[0]['thumb'])) {
                    ?>
                        <img class="direct-chat-img"  src="<?=base_url()?>uploads/profile_image/<?=$to_image[0]['thumb']?>">
                    <?php
                    }
                    else {
                    ?>
                        <img class="direct-chat-img"  src="<?=base_url()?>uploads/profile_image/default.jpg">
                    <?php
                    }
                ?>
                </a>
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                     <?=$message->message_text?>
                </div>
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
        <?php
        }
    }
?>
<script>
    $(document).ready(function(){
        $("#msg_send_btn").attr("onclick", "msg_send(<?=$thread_info->message_thread_id?>, <?=$from_info->member_id?>, <?=$to_info->member_id?>)");

        $('#msg_body').animate({
            scrollTop: $('#msg_body').get(0).scrollHeight
        }, 1);
    });
</script>
<script>
    $(document).ready(function(){

    });
</script>
