<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('msg91_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('sms_settings')?></a></li>
			<li><a href="#"><?= translate('msg91')?></a></li>
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
				<h3 class="panel-title"><?= translate('msg91_settings_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="msg91_settings_form" method="POST" action="<?=base_url()?>admin/update_sms_settings/msg91">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="msg91_activation"><b><?= translate('msg91_activation')?></b></label>
								<div class="col-sm-8">
									<div class="checkbox">
						                <input id="msg91_activation" name="msg91_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('third_party_settings', array('type' => 'msg91_status'))->row()->value == "ok"){ ?>checked<?php } ?>>
						                <label for="msg91_activation"></label>
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="type"><b><?= translate('account_type')?> </b></label>
								<div class="col-sm-8">
									<select class="form-control" name="type">
										<option class="form-control" value="test" <?php if($this->db->get_where('third_party_settings', array('type' => 'msg91_type'))->row()->value == "test"){ echo "selected";}?>><?= translate('test')?></option>
										<option class="form-control" value="original" <?php if($this->db->get_where('third_party_settings', array('type' => 'msg91_type'))->row()->value == "original"){ echo "selected";}?>><?= translate('original')?></option>

									</select>
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="authentication_key"><b><?= translate('authentication_key')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="authentication_key" value="<?=$this->db->get_where('third_party_settings', array('type' => 'msg91_authentication_key'))->row()->value;?>" placeholder="<?php echo translate('authentication_key')?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="sender_ID"><b><?= translate('sender_ID')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="sender_id" value="<?=$this->db->get_where('third_party_settings', array('type' => 'msg91_sender_ID'))->row()->value;?>" placeholder="<?php echo translate('sender_ID')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="country_code"><b><?= translate('country_code')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="country_code" value="<?=$this->db->get_where('third_party_settings', array('type' => 'msg91_country_code'))->row()->value;?>" placeholder="<?php echo translate('country_code')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="route"><b><?= translate('route')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="route" value="<?=$this->db->get_where('third_party_settings', array('type' => 'msg91_route'))->row()->value;?>" placeholder="<?php echo translate('route')?>">
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