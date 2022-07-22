<p class="text-main text-semibold"><?php echo translate('SMTP_settings')?></p>
<?php $mail_status = $this->Crud_model->get_type_name_by_id('general_settings', '76', 'value') ?>
<form class="form-horizontal" id="smtp_settings_form" method="POST" action="<?=base_url()?>admin/general_settings/update_smtp">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="mail_status"><b><?php echo translate('SMTP_status')?></b></label>
		<div class="col-sm-8">
			<div class="checkbox">
                <input id="mail_status" name="mail_status" class="magic-checkbox" type="checkbox" <?php if($mail_status == 'smtp') {?>checked<?php }?>>
                <label for="mail_status"></label>
            </div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="smtp_host"><b><?php echo translate('SMTP_host')?></b></label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="smtp_host" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '72', 'value')?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="smtp_port"><b><?php echo translate('SMTP_port')?></b></label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="smtp_port" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '73', 'value')?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="smtp_user"><b><?php echo translate('SMTP_user')?></b></label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="smtp_user" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '74', 'value')?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="smtp_pass"><b><?php echo translate('SMTP_password')?></b></label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="smtp_pass" value="<?=$this->Crud_model->get_type_name_by_id('general_settings', '75', 'value')?>" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-8 text-right">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
		</div>
	</div>
</form>