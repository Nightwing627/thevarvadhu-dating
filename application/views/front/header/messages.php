<sup class="badge bg-base-1 noti_badge msg_counter" style="display: none;"> <!-- Counts Messages with JavaScript  --> </sup>
<div class="dropdown-menu dropdown-menu-right dropdown-scale" style="max-height: 300px;overflow: auto;">
    <h6 class="dropdown-header"><?php echo translate('messages')?></h6>
    <?php
        $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));
        sort_array_of_array($listed_messaging_members, 'message_thread_time', SORT_DESC);
        foreach ($listed_messaging_members as $messaging_member) {
        	if($this->db->get_where("member", array("member_id" => $messaging_member['member_id']))->row()->is_closed == 'no'){
	        	if ($this->db->get_where('member', array('member_id' => $messaging_member['member_id']))->row()->member_id) {
	        		$member = $this->session->userdata('member_id');
		        	if(!$this->Crud_model->is_message_thread_seen($messaging_member['message_thread_id'],$member)){
				        	$msg_counter++;
				    }
		        	$messaging_member_info = $this->db->get_where('member', array('member_id' => $messaging_member['member_id']))->row();
		        	?>
						<div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
							<span class="dropdown-item" id="noti_item">
								<a href="<?=base_url()?>home/profile/nav/messaging/<?=$messaging_member['message_thread_id']?>" style="color: #444">
									<small class="sml_txt">
										<?php
                                            $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                                            $profile_image_status = $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'profile_image_status');
                                            $pic_show_status = 'ok';
                                            if ($profile_pic_approval == 'on') {
                                                if($profile_image_status == 1){
                                                    $pic_show_status = 'ok';
                                                }
                                                else{
                                                    $pic_show_status = 'no';
                                                }
                                            }
											$msg_profile_image = $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'profile_image');
				                			$msg_images = json_decode($msg_profile_image, true);
							                if (file_exists('uploads/profile_image/'.$msg_images[0]['thumb']) && $pic_show_status == 'ok') {
							                ?>
							                    <img src="<?=base_url()?>uploads/profile_image/<?=$msg_images[0]['thumb']?>" class="dropdown-image rounded-circle">
							                <?php
							                }
							                else {
							                ?>
							                    <img src="<?=base_url()?>uploads/profile_image/default.jpg" class="dropdown-image rounded-circle">
							                <?php
							                }
							            ?>
										<span class=""><?=translate('last_conversation_with')?> <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?= $messaging_member_info->member_id ?>"><?= $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'first_name'); ?></a>  <?=translate('in')?> <br></span>
										<small class="pull-right sml_txt" style="margin-top: -14px; padding-right: 19px;"><i class="c-base-1 fa fa-clock-o"></i> <?=date('d M,y - h:i A', $messaging_member['message_thread_time'])?></small>
									</small>
								</a>
							</span>
						<div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
		        	<?php
	        	}
	        }
        }

        if (count($listed_messaging_members) <= 0) {
		?>
    		<div class="text-center">
    			<small class="sml_txt">
        			<?php echo translate('no_messages_to_show')?>
        		</small>
        	</div>
		<?php
		}
    ?>
</div>
