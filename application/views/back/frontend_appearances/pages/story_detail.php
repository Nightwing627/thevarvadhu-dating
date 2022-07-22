<p class="text-main text-semibold"><?php echo translate('story_detail_page')?></p>
<form class="form-horizontal" id="terms_and_conditions_form" method="POST" action="<?=base_url()?>admin/general_settings/update_terms_and_conditions">
	<div class="form-group">
		<div class="col-sm-12">
			<textarea class="form-control textarea" name="terms_and_conditions" id="terms_and_conditions" required><?=$this->Crud_model->get_type_name_by_id('general_settings', '9', 'value')?></textarea>	
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12 text-right">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>

