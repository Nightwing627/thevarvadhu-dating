<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo  translate('add_member')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo  translate('home')?></a></li>
			<li><a href="#"><?php echo  translate('members')?></a></li>
			<li><a href="#"><?php echo  translate('add_member')?></a></li>

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
	                <?php echo $success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>

	                <?php echo $danger_alert?>
	                 <?php echo validation_errors()?>
	            </div>
			<?php endif ?>
	    	<?php if (!empty(validation_errors())): ?>
                <div class="widget" id="profile_error">
                    <div style="border-bottom: 1px solid #e6e6e6;">
                        <div class="card-title" style="padding: 0.5rem 1.5rem; color: #fcfcfc; background-color: #de1b1b; border-top-right-radius:0.25rem; border-top-left-radius:0.25rem;">You <b>Must Provide</b> the Information(s) bellow</div>
                        <div class="card-body" style="padding: 0.5rem 1.5rem; background: rgba(222, 27, 27, 0.10);">
                            <style>
                                #profile_error p {
                                    color: #DE1B1B !important; margin: 0px !important; font-size: 12px !important;
                                }
                            </style>
                            <?php echo  validation_errors();?>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            ?>

		    <div class="panel-heading">
		        <h3 class="panel-title"><?php echo  translate('add_new_member_info')?></h3>
		    </div>
		    <div class="panel-body">
	    		<form class="form-horizontal" id="manage_details_form" method="POST" action="<?php echo base_url()?>admin/members/add_member/do_add">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="fname"><b><?php echo  translate('first_name')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['fname'];}?>" name="fname" placeholder="<?php echo  translate('first_name')?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="lname"><b><?php echo  translate('last_name')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['lname'];}?>" name="lname" placeholder="<?php echo  translate('last_name')?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="email"><b><?php echo  translate('email')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['email'];}?>" name="email" placeholder="<?php echo  translate('email')?>" required="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="gender"><b><?php echo  translate('gender')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<?php
                                if (!empty($form_contents)) {
                                    echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['gender'], '', '', '');
                                }
                                else {
                                    echo $this->Crud_model->select_html('gender', 'gender', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '');
                                }
                            ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="date_of_birth"><b><?php echo  translate('date_of_birth')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="date"  value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];}?>" class="form-control" name="date_of_birth" style="line-height: normal;">
						</div>
					</div>
						<div class="form-group">
						<label class="col-sm-3 control-label" for="mobile"><b><?php echo  translate('mobile')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="number" value="<?php if(!empty($form_contents)){echo $form_contents['mobile'];}?>" class="form-control" name="mobile"  placeholder=" <?php echo  translate('mobile_no.')?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="on_behalf"><b><?php echo  translate('on_behalf')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<?php
                                if (!empty($form_contents)) {
                                    echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['on_behalf'], '', '', '');
                                }
                                else {
                                    echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '');
                                }
                            ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="plan"><b><?php echo  translate('plan')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<?php
                                if (!empty($form_contents)) {
                                    echo $this->Crud_model->select_html('plan', 'plan', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['plan'], '', '', '');
                                }
                                else {
                                    echo $this->Crud_model->select_html('plan', 'plan', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '');
                                }
                            ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="password"><b><?php echo  translate('password')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="password"  class="form-control" name="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="cpassword"><b><?php echo  translate('confirm_password')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="cpassword">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-8 text-right">
							<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('add_member')?></button>
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
