<!--Magic Checkbox [ OPTIONAL ]-->
<link href="<?=base_url()?>template/back/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('add_staff')?></h1>
			<!--Searchbox-->
			<div class="searchbox">
				<div class="pull-right">
					<a href="<?=base_url()?>admin/admins" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
				</div>
			</div>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('staff_panel')?></a></li>
			<li><a href="#"><?php echo translate('manage_staff')?></a></li>
			<li class="active"><?php echo translate('add_staff')?></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
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
	                 <?=validation_errors()?>
	            </div>
			<?php endif ?>
			
		    <div class="panel-heading">
		        <h3 class="panel-title"><?= translate('create_new_staff')?></h3>
		    </div>
		    <div class="panel-body">
		    		<form class="form-horizontal" id="manage_details_form" method="POST" action="<?=base_url()?>admin/admins/do_add">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="name"><b><?= translate('name')?> <span class="text-danger">*</span></b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['name'];}?>" name="name" placeholder="<?= translate('staff_name')?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="description"><b><?= translate('email')?> <span class="text-danger">*</span></b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['email'];}?>" name="email" placeholder="<?= translate('staff_email')?>" >
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="description"><b><?= translate('phone_no.')?> <span class="text-danger">*</span></b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['phone'];}?>" name="phone" placeholder="<?= translate('staff_phone_no.')?>" >
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="description"><b><?= translate('address')?> </span></b></label>
							<div class="col-sm-8">
								<textarea class="form-control" name="address" placeholder="<?= translate('staff_address')?>" ><?php if(!empty($form_contents)){echo $form_contents['address'];}?></textarea>
								
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="role"><b><?= translate('role')?> <span class="text-danger">*</span></b></label>
							<div class="col-sm-8">
								<?php
									if (!empty($form_contents)) {
											echo $this->Crud_model->select_html('role', 'role', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['role'], '', '', '');
										}else{
											echo $this->Crud_model->select_html('role', 'role', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '');
										}
									?>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8 text-right">
								<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save">Save</button>
							</div>
						</div>
					</form>								
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
