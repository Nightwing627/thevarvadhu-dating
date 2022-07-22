<?php $home_contact_info_text = $this->db->get_where('frontend_settings', array('type' => 'home_contact_info_text'))->row()->value; ?>
<form class="form-horizontal" id="contact_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/home_contact_info">
	<div class="form-group">
        <label class="col-sm-2 control-label" for="home_contact_status"><b><?= translate('display_status')?></b></label>
        <div class="col-sm-9">
            <?php
                $home_contact_status = $this->db->get_where('frontend_settings', array('type' => 'home_contact_status'))->row()->value;
                ?>
            <div class="checkbox">
                <input id="home_contact_status" name="home_contact_status" class="magic-checkbox" type="checkbox" <?php if($home_contact_status=='yes'){ echo "checked"; }?>  >
                <label for="home_contact_status"></label>
            </div>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="contact_info_text"><b><?php echo translate('contact_information_text')?></b></label>
        <div class="col-sm-9">
        	<textarea class="form-control" id="contact_info_text" name="contact_info_text" rows="5"><?=$home_contact_info_text?></textarea>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>