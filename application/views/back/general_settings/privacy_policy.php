<p class="text-main text-semibold"><?php echo translate('privacy_policy')?></p>
<form class="form-horizontal" id="privacy_policy_form" method="POST" action="<?=base_url()?>admin/general_settings/update_privacy_policy">
	<div class="form-group">
		<div class="col-sm-12">
			<textarea class="form-control textarea" name="privacy_policy" id="privacy_policy" required><?=$this->Crud_model->get_type_name_by_id('general_settings', '80', 'value')?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12 text-right">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
		</div>
	</div>
</form>
