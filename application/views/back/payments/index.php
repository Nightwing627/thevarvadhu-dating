<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('payments')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('payments')?></a></li>
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
			<div class="panel-body">
				<div class="row">
					<!-- Paypal -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('paypal_settings')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="paypal_settings_form" method="POST" action="<?=base_url()?>admin/update_payments/update_paypal">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" for="paypal_activation"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="paypal_activation" name="paypal_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'paypal_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="paypal_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="email"><b><?= translate('paypal_email')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" name="email" value="<?=$this->db->get_where('business_settings', array('type' => 'paypal_email'))->row()->value;?>" placeholder="<?php echo translate('your_email_address')?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('account_type')?></b></label>
										<div class="col-sm-8">
											<select class="form-control" name="paypal_account_type">
												<?php
													$paypal_account_type = $this->db->get_where('business_settings', array('type' => 'paypal_account_type'))->row()->value;
												?>
									            <option value="sandbox" <?php if ($paypal_account_type == "sandbox"){?> selected<?php } ?>> <?= translate('sandbox')?></option>
									            <option value="original" <?php if ($paypal_account_type == "original"){?> selected<?php } ?>> <?= translate('original')?></option>
									        </select>
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

					<!-- Stripe -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('stripe_settings')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="stripe_settings_form" method="POST" action="<?=base_url()?>admin/update_payments/update_stripe">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" for="stripe_activation"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="stripe_activation" name="stripe_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'stripe_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="stripe_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="secret_key"><b><?= translate('secret_key')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="secret_key" value="<?=$this->db->get_where('business_settings', array('type' => 'stripe_secret_key'))->row()->value;?>" placeholder="<?php echo translate('your_secret_key')?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="publishable_key"><b><?= translate('publishable_key')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="publishable_key" value="<?=$this->db->get_where('business_settings', array('type' => 'stripe_publishable_key'))->row()->value;?>" placeholder="<?php echo translate('your_publishable_key')?>">
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

					<!-- PayUMoney -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('payUmoney_settings')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="pum_settings_form" method="POST" action="<?=base_url()?>admin/update_payments/update_pum">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" for="pum_activation"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="pum_activation" name="pum_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'pum_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="pum_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="merchant_key"><b><?= translate('merchant_key')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="pum_merchant_key" value="<?=$this->db->get_where('business_settings', array('type' => 'pum_merchant_key'))->row()->value;?>" placeholder="<?php echo translate('merchant_key')?>" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="merchant_key"><b><?= translate('merchant_SALT')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="pum_merchant_salt" value="<?=$this->db->get_where('business_settings', array('type' => 'pum_merchant_salt'))->row()->value;?>" placeholder="<?php echo translate('merchant_salt')?>" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('account_type')?></b></label>
										<div class="col-sm-8">
											<select class="form-control" name="pum_account_type">
												<?php
													$pum_account_type = $this->db->get_where('business_settings', array('type' => 'pum_account_type'))->row()->value;
												?>
									            <option value="sandbox" <?php if ($pum_account_type == "sandbox"){?> selected<?php } ?>> <?= translate('sandbox')?></option>
									            <option value="original" <?php if ($pum_account_type == "original"){?> selected<?php } ?>> <?= translate('original')?></option>
									        </select>
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

					<!-- Instamojo -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('Instamojo_settings')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="pum_settings_form" method="POST" action="<?=base_url()?>admin/update_payments/update_instamojo">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" for="instamojo_activation"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="instamojo_activation" name="instamojo_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'instamojo_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="instamojo_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="instamojo_api_key"><b><?= translate('api_key')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="instamojo_api_key" value="<?=$this->db->get_where('business_settings', array('type' => 'instamojo_api_key'))->row()->value;?>" placeholder="<?php echo translate('merchant_key')?>" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="instamojo_auth_token"><b><?= translate('auth_token')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="instamojo_auth_token" value="<?=$this->db->get_where('business_settings', array('type' => 'instamojo_auth_token'))->row()->value;?>" placeholder="<?php echo translate('auth_token')?>" >
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('account_type')?></b></label>
										<div class="col-sm-8">
											<select class="form-control" name="instamojo_account_type">
												<?php
													$instamojo_account_type = $this->db->get_where('business_settings', array('type' => 'instamojo_account_type'))->row()->value;
												?>
									            <option value="sandbox" <?php if ($instamojo_account_type == "sandbox"){?> selected<?php } ?>> <?= translate('sandbox')?></option>
									            <option value="original" <?php if ($instamojo_account_type == "original"){?> selected<?php } ?>> <?= translate('original')?></option>
									        </select>
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

					<!-- Custom Payment Method 1 -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('custom_payment_method_1')?></h3>
						    </div>
						    <div class="panel-body">
					    		<form class="form-horizontal"  method="POST" action="<?=base_url()?>admin/update_payments/update_custom_payment_1" enctype="multipart/form-data">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="custom_payment_1_activation" name="custom_payment_method_1_set" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'custom_payment_method_1_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="custom_payment_1_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('name')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_1_name" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_1_name'))->row()->value;?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('number')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_1_number" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_1_number'))->row()->value;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('instruction')?></b></label>
										<div class="col-sm-8">
											<textarea type="text" class="form-control" name="custom_payment_method_1_instruction"><?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_1_instruction'))->row()->value;?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?php echo translate('image')?></b> <br><span>(255x127)</span> </label>
								        <div class="col-sm-8">
								        	<?php
								                if (file_exists('uploads/custom_payment_methods_image/cp_method_1_image.jpg')) {
								                    $cp_image1 = base_url()."uploads/custom_payment_methods_image/cp_method_1_image.jpg";
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$cp_image1?>" style="max-width: 65%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/custom_payment_methods_image/custom_payment_dafault.jpg" style="max-width: 65%;">
								                <?php
								                }
											?>
								        </div>
								        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="cp_image1" class="form-control imgInp" >
								            </span>
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

					<!-- Custom Payment Method 2 -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('custom_payment_method_2')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal"  method="POST" action="<?=base_url()?>admin/update_payments/update_custom_payment_2" enctype="multipart/form-data">
					    			<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="custom_payment_2_activation" name="custom_payment_method_2_set" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'custom_payment_method_2_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="custom_payment_2_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('name')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_2_name" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_2_name'))->row()->value;?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('number')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_2_number" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_2_number'))->row()->value;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('instruction')?></b></label>
										<div class="col-sm-8">
											<textarea type="text" class="form-control" name="custom_payment_method_2_instruction"><?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_2_instruction'))->row()->value;?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?php echo translate('image')?></b> <br><span>(255x127)</span> </label>
								        <div class="col-sm-8">
								        	<?php
								                if (file_exists('uploads/custom_payment_methods_image/cp_method_2_image.jpg')) {
								                    $cp_image2 = base_url()."uploads/custom_payment_methods_image/cp_method_2_image.jpg";
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$cp_image2?>" style="max-width: 65%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/custom_payment_methods_image/custom_payment_dafault.jpg" style="max-width: 65%;">
								                <?php
								                }
											?>
								        </div>
								        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="cp_image2" class="form-control imgInp" >
								            </span>
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

					<!-- Custom Payment Method 3 -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('custom_payment_method_3')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal"  method="POST" action="<?=base_url()?>admin/update_payments/update_custom_payment_3" enctype="multipart/form-data">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="custom_payment_3_activation" name="custom_payment_method_3_set" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'custom_payment_method_3_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="custom_payment_3_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('name')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_3_name" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_3_name'))->row()->value;?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('number')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_3_number" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_3_number'))->row()->value;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('instruction')?></b></label>
										<div class="col-sm-8">
											<textarea type="text" class="form-control" name="custom_payment_method_3_instruction"><?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_3_instruction'))->row()->value;?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?php echo translate('image')?></b> <br><span>(255x127)</span> </label>
								        <div class="col-sm-8">
								        	<?php
								                if (file_exists('uploads/custom_payment_methods_image/cp_method_3_image.jpg')) {
								                    $cp_image3 = base_url()."uploads/custom_payment_methods_image/cp_method_3_image.jpg";
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$cp_image3?>" style="max-width: 65%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/custom_payment_methods_image/custom_payment_dafault.jpg" style="max-width: 65%;">
								                <?php
								                }
											?>
								        </div>
								        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="cp_image3" class="form-control imgInp" >
								            </span>
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

					<!-- Custom Payment Method 4 -->
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('custom_payment_method_4')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal"  method="POST" action="<?=base_url()?>admin/update_payments/update_custom_payment_4" enctype="multipart/form-data">
					    			<div class="form-group">
										<label class="col-sm-3 control-label" for="paypal_activation"><b><?= translate('activation')?></b></label>
										<div class="col-sm-8">
											<div class="checkbox">
								                <input id="custom_payment_4_activation" name="custom_payment_method_4_set" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('business_settings', array('type' => 'custom_payment_method_4_set'))->row()->value == "ok"){ ?>checked<?php } ?>>
								                <label for="custom_payment_4_activation"></label>
								            </div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?= translate('name')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_4_name" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_4_name'))->row()->value;?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('number')?></b></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="custom_payment_method_4_number" value="<?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_4_number'))->row()->value;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"><b><?= translate('instruction')?></b></label>
										<div class="col-sm-8">
											<textarea type="text" class="form-control" name="custom_payment_method_4_instruction" value=""><?=$this->db->get_where('business_settings', array('type' => 'custom_payment_method_4_instruction'))->row()->value;?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" ><b><?php echo translate('image')?></b> <br><span>(255x127)</span> </label>
								        <div class="col-sm-8">
								        	<?php
								                if (file_exists('uploads/custom_payment_methods_image/cp_method_4_image.jpg')) {
								                    $cp_image4 = base_url()."uploads/custom_payment_methods_image/cp_method_4_image.jpg";
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$cp_image4?>" style="max-width: 65%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/custom_payment_methods_image/custom_payment_dafault.jpg" style="max-width: 65%;">
								                <?php
								                }
											?>
								        </div>
								        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="cp_image4" class="form-control imgInp" >
								            </span>
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
	</div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds

	function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".panel-body").on('change', '.imgInp', function () {
        readURL_all(this);
    });
</script>
