<p class="text-main text-semibold"><?php echo translate('contact_us')?></p>
<?php $contact_us_text = $this->db->get_where('frontend_settings', array('type' => 'contact_us_text'))->row()->value; ?>
<form class="form-horizontal" id="contact_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/contact_us">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="contact_us_text"><b><?php echo translate('contact_us_header_text')?></b></label>
        <div class="col-sm-9">
        	<textarea class="form-control" id="contact_us_text" name="contact_us_text" rows="5"><?=$contact_us_text?></textarea>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>
