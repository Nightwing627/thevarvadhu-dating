<?php $max_premium_member_num = $this->db->get_where('frontend_settings', array('type' => 'max_premium_member_num'))->row()->value; ?>
<form class="form-horizontal" id="premium_member_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/home_premium_members">
	<div class="form-group">
        <label class="col-sm-2 control-label" for="home_members_status"><b><?= translate('display_status')?></b></label>
        <div class="col-sm-9">
            <?php
                $home_members_status = $this->db->get_where('frontend_settings', array('type' => 'home_members_status'))->row()->value;
                ?>
            <div class="checkbox">
                <input id="home_members_status" name="home_members_status" class="magic-checkbox" type="checkbox" <?php if($home_members_status=='yes'){ echo "checked"; }?>  >
                <label for="home_members_status"></label>
            </div>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="max_premium_member_num"><b><?php echo translate('max_premium_member_number')?></b></label>
        <div class="col-sm-9">
        	<input type="number" class="form-control" id="max_premium_member_num" name="max_premium_member_num" value="<?=$max_premium_member_num?>" min="5" max="40" required="">
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>