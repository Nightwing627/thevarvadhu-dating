<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('captcha_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('captcha_settings')?></a></li>
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
				<h3 class="panel-title"><?= translate('captcha_settings_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="captcha_settings_form" method="POST" action="<?=base_url()?>admin/update_captcha_settings">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="captcha_activation"><b><?= translate('captcha_activation')?></b></label>
								<div class="col-sm-8">
									<div class="checkbox">
						                <input id="captcha_activation" name="captcha_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('third_party_settings', array('type' => 'captcha_status'))->row()->value == "ok"){ ?>checked<?php } ?>>
						                <label for="captcha_activation"></label>
						            </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="captcha_public"><b><?= translate('public_key')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="captcha_public" value="<?=$this->db->get_where('third_party_settings', array('type' => 'captcha_public'))->row()->value;?>" placeholder="<?php echo translate('public_key')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="captcha_private"><b><?= translate('private_key')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="captcha_private" value="<?=$this->db->get_where('third_party_settings', array('type' => 'captcha_private'))->row()->value;?>" placeholder="<?php echo translate('private_key')?>">
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