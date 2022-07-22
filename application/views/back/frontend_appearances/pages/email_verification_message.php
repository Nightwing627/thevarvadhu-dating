<p class="text-main text-semibold"><?php echo translate('email_verification')?></p>
<form class="form-horizontal" id="contact_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/set_email_verification_message">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="email_verification_message"><b><?php echo translate('email_verification_message')?></b></label>
        <div class="col-sm-9">
        	<textarea class="form-control" id="contact_us_text" name="email_verification_message" rows="5"><?=$this->Crud_model->get_type_name_by_id('frontend_settings', '46', 'value')?></textarea>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>
