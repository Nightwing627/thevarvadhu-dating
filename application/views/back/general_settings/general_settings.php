<p class="text-main text-semibold"><?php echo translate('general_settings')?></p>
<?php $right_option = $this->Crud_model->get_type_name_by_id('general_settings', '85', 'value') ?>

<form class="form-horizontal" id="general_settings_form" method="POST" action="<?=base_url()?>admin/general_settings/update_general_settings">
	<div class="form-group">
		<label class="col-sm-4 control-label" for="system_name"><b><?php echo translate('system_name')?></b></label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="system_name" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '1', 'value')?>" placeholder="Your Site Name" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="system_email"><b><?php echo translate('system_email')?></b></label>
		<div class="col-sm-7">
			<input type="email" class="form-control" name="system_email" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '2', 'value')?>" placeholder="Your Site Email" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="system_title"><b><?php echo translate('system_title')?></b></label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="system_title" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '3', 'value')?>" placeholder="Your Site Title" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="address"><b><?php echo translate('address')?></b></label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="address" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '4', 'value')?>" placeholder="Address">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="phone"><b><?php echo translate('phone')?></b></label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="phone" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '5', 'value')?>" placeholder="Phone No.">
		</div>
	</div>
	<!-- Time Zone Set-->
    <div class="form-group">
		<label class="col-sm-4 control-label" for="time_zone"><b><?php echo translate('time_zone')?></b></label>
		<div class="col-sm-7">
			<input type="text" class="form-control" name="time_zone" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '87', 'value')?>" placeholder="<?php echo translate('time_zone').' ( '.'ex'.' : '.translate('asia/').translate('dhaka').' )'; ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-4 control-label" for="language"><b><?php echo translate('language')?></b></label>
        <div class="col-sm-7">
            <select name="language" class="form-control">
                <?php
                $set_lang = $this->db->get_where('general_settings', array('type' => 'language'))->row()->value;
                $fields = $this->db->list_fields('site_language');
                foreach ($fields as $field) {
                    if ($field !== 'word' && $field !== 'word_id') {
                        ?>
                        <option value="<?php echo $field; ?>" <?php
                        if ($set_lang == $field) {
                            echo 'selected';
                        }
                        ?> ><?php echo $this->db->get_where('site_language_list',array('db_field'=>$field))->row()->name;?></option>
                                <?php
                            }
                        }
                        ?>
            </select>
        </div>
    </div>

    <div class="form-group">
    	<label class="col-sm-4 control-label" for="member_approval_by_admin"><b><?php echo translate('member_approval_by_admin')?></b></label>
        <div class="col-sm-7">
            <select name="member_approval_by_admin" class="form-control">
                <?php $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value; ?>
                <option value="yes" <?php if($member_approval == 'yes') echo 'selected'; ?> ><?php echo translate('yes')?> </option>
                <option value="no" <?php if($member_approval == 'no') echo 'selected'; ?> ><?php echo translate('no')?> </option>
            </select>
        </div>
    </div>
	<div class="form-group">
    	<label class="col-sm-4 control-label" for="email_verification"><b><?php echo translate('member_email_verification')?></b></label>
        <div class="col-sm-7">
            <select name="member_email_verification" class="form-control">
                <?php $member_email_verification = $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value; ?>
                <option value="on" <?php if($member_email_verification == 'on') echo 'selected'; ?> ><?php echo translate('on')?> </option>
                <option value="off" <?php if($member_email_verification == 'off') echo 'selected'; ?> ><?php echo translate('off')?> </option>
			</select>
			<span><?php echo translate('If you select member email verification off, then registered members email will be auto verified'); ?>.</span>
        </div>
    </div>
	<div class="form-group">
    	<label class="col-sm-4 control-label" for="email_verification"><b><?php echo translate('member_profile_picture_approval_by_admin')?></b></label>
        <div class="col-sm-7">
            <select name="profile_pic_approval" class="form-control">
                <?php $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value; ?>
                <option value="on" <?php if($profile_pic_approval == 'on') echo 'selected'; ?> ><?php echo translate('on')?> </option>
                <option value="off" <?php if($profile_pic_approval == 'off') echo 'selected'; ?> ><?php echo translate('off')?> </option>
			</select>
        </div>
    </div>
	<div class="form-group">
    	<label class="col-sm-4 control-label" for="email_verification"><b><?php echo translate('email_notification_on_express_interest')?></b></label>
        <div class="col-sm-7">
            <select name="email_notification_on_express_interest" class="form-control">
                <?php $express_interest_email_notification = $this->db->get_where('general_settings', array('type' => 'email_notification_on_express_interest'))->row()->value; ?>
                <option value="on" <?php if($express_interest_email_notification == 'on') echo 'selected'; ?> ><?php echo translate('on')?> </option>
                <option value="off" <?php if($express_interest_email_notification == 'off') echo 'selected'; ?> ><?php echo translate('off')?> </option>
			</select>
        </div>
    </div>
	<div class="form-group">
    	<label class="col-sm-4 control-label" for="email_verification"><b><?php echo translate('email_notification_on_sending_message')?></b></label>
        <div class="col-sm-7">
            <select name="email_notification_on_sending_message" class="form-control">
                <?php $message_sending_email_notification = $this->db->get_where('general_settings', array('type' => 'email_notification_on_sending_message'))->row()->value; ?>
                <option value="on" <?php if($message_sending_email_notification == 'on') echo 'selected'; ?> ><?php echo translate('on')?> </option>
                <option value="off" <?php if($message_sending_email_notification == 'off') echo 'selected'; ?> ><?php echo translate('off')?> </option>
			</select>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-4 control-label" for="cache_time"><b><?php echo translate('homepage_cache_time'); ?> (<?php echo translate('minutes'); ?>)</b></label>
		<div class="col-sm-6">
			<input type="number" min="0" step=".01" class="form-control" name="cache_time" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '59', 'value')?>">
		</div>
		<div class="col-sm-2 control-label text-left">
            <?php echo translate('minutes'); ?>
        </div>
	</div>
    <div class="form-group">
		<label class="col-sm-3 control-label" for="right_option"><b><?php echo translate('mouse_right_click_off')?></b></label>
		<div class="col-sm-8">
			<div class="checkbox">
                <input id="right_option" name="right_option" class="magic-checkbox" type="checkbox" <?php if($right_option == 'on') {?>checked<?php }?>>
                <label for="right_option"></label>
            </div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-8 text-right">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
		</div>
	</div>
</form>
