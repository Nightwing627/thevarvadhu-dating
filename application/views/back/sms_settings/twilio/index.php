<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('twilio_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('sms_settings')?></a></li>
			<li><a href="#"><?= translate('twilio')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="panel">
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?= translate('twilio_settings_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="twilio_settings_form" method="POST" action="<?=base_url()?>admin/update_sms_settings/twilio">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="twilio_activation"><b><?= translate('twilio_activation')?></b></label>
								<div class="col-sm-8">
									<div class="checkbox">
						                <input id="twilio_activation" name="twilio_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('third_party_settings', array('type' => 'twilio_status'))->row()->value == "ok"){ ?>checked<?php } ?>>
						                <label for="twilio_activation"></label>
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="twilio_account_sid"><b><?= translate('account_sid')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="twilio_account_sid" value="<?=$this->db->get_where('third_party_settings', array('type' => 'twilio_account_sid'))->row()->value;?>" placeholder="<?php echo translate('account_sid')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="twilio_auth_token"><b><?= translate('authetication_token')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="twilio_auth_token" value="<?=$this->db->get_where('third_party_settings', array('type' => 'twilio_auth_token'))->row()->value;?>" placeholder="<?php echo translate('authetication_token')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="twilio_sender_phone_number"><b><?= translate('sender_phone_number')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="twilio_sender_phone_number" value="<?=$this->db->get_where('third_party_settings', array('type' => 'twilio_sender_phone_number'))->row()->value;?>" placeholder="<?php echo translate('sender_phone_number')?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-8 text-right">
									<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
								</div>
							</div>
						</form>
					</div>				
				</div>				
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>