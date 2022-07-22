<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('currency_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('currency_settings')?></a></li>
			<li><a href="#"><?= translate('configure')?></a></li>
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
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('home_default_currency')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="paypal_settings_form" method="POST" action="<?=base_url()?>admin/update_currency_settings/home_currency">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('home_default_currency')?></b></label>
										<div class="col-sm-8">
											<?php 
												$home_def_curr = $this->db->get_where('business_settings', array('type' => 'home_def_currency'))->row()->value;
												echo $this->Crud_model->select_html('currency_settings', 'home_def_currency', 'name', 'edit', 'form-control chosen', $home_def_curr, 'status', 'ok', '');
											?>
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
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('system_default_currency')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="paypal_settings_form" method="POST" action="<?=base_url()?>admin/update_currency_settings/system_currency">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('system_default_currency')?></b></label>
										<div class="col-sm-8">
											<?php 
												$system_def_curr = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
												echo $this->Crud_model->select_html('currency_settings', 'system_def_currency', 'name', 'edit', 'form-control chosen', $system_def_curr, 'status', 'ok', '');
											?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-11 text-right">
											<span class="text-danger" style="margin-right: 3px">*<?=translate('changing_system_default_currency_will_require_changing_all_price_values')?>*</span>
											<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
										</div>
									</div>
								</form>
								
						    </div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('currency_format')?></h3>
						    </div>
						    <div class="panel-body">

					    		<form class="form-horizontal" id="paypal_settings_form" method="POST" action="<?=base_url()?>admin/update_currency_settings/currency_format">
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('currency_format')?></b></label>
										<div class="col-sm-8">
											<?php
												$currency_formats = array('us' => 'US Format - 1,234,567.89',
																'german' => 'German Format - 1.234.567,89',
																'french' => 'French Format - 1 234 567,89'
												);
												$currency_format = $this->db->get_where('business_settings', array('type' => 'currency_format'))->row()->value; 
											?>
											<select class="form-control chosen" name="currency_format">
		                                    	<?php
		                                        	foreach($currency_formats as $n => $row){
												?>
		                                        <option value="<?php echo $n;?>" <?php if($n == $currency_format){ echo 'selected'; } ?>>
													<?php echo $row;?>
		                                        </option>
												<?php		
													}
												?>
		                                    </select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('symbol_format')?></b></label>
										<div class="col-sm-8">
											<?php
												$symbol_formats = array('s_amount' => '{{ Symbol }} {{ Amount }}',
																'amount_s' => '{{ Amount }} {{ Symbol }}'
												);
												$symbol_format = $this->db->get_where('business_settings', array('type' => 'symbol_format'))->row()->value; 
											?>
											<select class="form-control chosen" name="symbol_format">
		                                    	<?php
		                                        	foreach($symbol_formats as $n => $row){
												?>
		                                        <option value="<?php echo $n;?>" <?php if($n == $symbol_format){ echo 'selected'; } ?>>
													<?php echo $row;?>
		                                        </option>
												<?php		
													}
												?>
		                                    </select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="phone"><b><?= translate('no_of_decimals')?></b></label>
										<div class="col-sm-8">
											<?php
												$formats = array('0' => '12345',
																	'1' => '1234.5',
																	'2' => '123.45',
																	'3' => '12.345'
												);
												$no_of_decimal = $this->db->get_where('business_settings', array('type' => 'no_of_decimals'))->row()->value; 
											?>
											<select class="form-control chosen" name="no_of_decimals">
		                                    	<?php
		                                        	foreach($formats as $n => $row){
												?>
		                                        <option value="<?php echo $n;?>" <?php if($n == $no_of_decimal){ echo 'selected'; } ?>>
													<?php echo $row;?>
		                                        </option>
												<?php		
													}
												?>
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