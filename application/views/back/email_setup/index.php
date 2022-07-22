<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('email_setup')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('configurations')?></a></li>
			<li><a href="#"><?php echo translate('email_setup')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('email_setup')?></h3>
			</div>
			<div class="panel-body">

				<div class="tab-base tab-stacked-left">
		            <!--Nav tabs-->
		            <ul class="nav nav-tabs" style="width: 145px;">
		                <li class="active">
		                    <a data-toggle="tab" href="#tab-1"><?php echo translate('password_reset_email')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-2"><?php echo translate('package_purchase_email')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-3"><?php echo translate('account_opening_by_admin_email')?></a>
		                </li>
		                <?php $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
		                	if($member_approval=='yes'){ ?>
			                	<li>
				                    <a data-toggle="tab" href="#tab-4"><?php echo translate('account_opening_from_user_email._when_member_member_approval_active')?></a>
				                </li>
			                <?php }
			                else
			                { ?>
			                	<li>
				                    <a data-toggle="tab" href="#tab-8"><?php echo translate('account_opening_from_user_email._when_member_approval_deactivated')?></a>
				                </li>
			                <?php
			            }
			            ?>

		                <li>
		                    <a data-toggle="tab" href="#tab-7"><?php echo translate('member_registration_email_to_admin')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-5"><?php echo translate('staff_account_add_email')?></a>
		                </li>
						<li>
		                    <a data-toggle="tab" href="#tab-6"><?php echo translate('member_approval_email')?></a>
		                </li>
						<li>
		                    <a data-toggle="tab" href="#tab-10"><?php echo translate('member_email_verification')?></a>
		                </li>
		            </ul>

		            <!--Tabs Content-->
		            <div class="tab-content">
		                <div id="tab-1" class="tab-pane fade active in">
		                	<?php
		                	$password_reset_email = $this->db->get_where('email_template', array('email_template_id' => 1))->result();
		                	?>
		                	<?php
		                	foreach ($password_reset_email as $value1) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/password_reset_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="password_reset_email_sub" value="<?=$value1->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="password_reset_email_body" style="height: 380px;"><?=$value1->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-2" class="tab-pane fade">
		                	<?php
		                	$package_purchase_email = $this->db->get_where('email_template', array('email_template_id' => 2))->result();
		                	?>
		                	<?php
		                	foreach ($package_purchase_email as $value2) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/package_purchase_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_approval_email_sub" value="<?=$value2->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_approval_email_body" style="height: 380px;"><?=$value2->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-3" class="tab-pane fade">
							<?php
		                	$account_opening_email = $this->db->get_where('email_template', array('email_template_id' => 4))->result();
		                	?>
		                	<?php
		                	foreach ($account_opening_email as $value3) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/account_opening_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_opening_email_sub" value="<?=$value3->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_opening_email_body" style="height: 380px;"><?=$value3->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
						<div id="tab-4" class="tab-pane fade">
							<?php
		                	$account_opening_from_admin_email = $this->db->get_where('email_template', array('email_template_id' => 7))->result();
		                	?>
		                	<?php
		                	foreach ($account_opening_from_admin_email as $value3) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/account_opening_from_admin_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_opening_from_admin_email_sub" value="<?=$value3->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_opening_from_user_email_body" style="height: 380px;"><?=$value3->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>

		                <div id="tab-8" class="tab-pane fade">
							<?php
		                	$account_opening_by_user_member_approval_deactivated = $this->db->get_where('email_template', array('email_template_id' => 9))->result();
		                	?>
		                	<?php
		                	foreach ($account_opening_by_user_member_approval_deactivated as $value8) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/account_opening_by_user_member_approval_deactivated">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_opening_by_user_member_approval_deactivated_sub" value="<?=$value8->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_opening_by_user_member_approval_deactivated_body" style="height: 380px;"><?=$value8->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>

		                <div id="tab-7" class="tab-pane fade">
							<?php
		                	$member_registration_email_to_admin = $this->db->get_where('email_template', array('email_template_id' => 8))->result();
		                	?>
		                	<?php
		                	foreach ($member_registration_email_to_admin as $value3) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/member_registration_email_to_admin">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="member_registration_email_to_admin_sub" value="<?=$value3->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="member_registration_email_to_admin_body" style="height: 250px;"><?=$value3->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>

		                <div id="tab-5" class="tab-pane fade">
							<?php
		                	$staff_opening_email = $this->db->get_where('email_template', array('email_template_id' => 5))->result();
		                	?>
		                	<?php
		                	foreach ($staff_opening_email as $value4) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/staff_add_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="staff_add_email_sub" value="<?=$value4->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="staff_add_email_body" style="height: 380px;"><?=$value4->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>

						<div id="tab-6" class="tab-pane fade">
						   <?php
						   $member_approval_email = $this->db->get_where('email_template', array('email_template_id' => 6))->result();
						   ?>
						   <?php
						   foreach ($member_approval_email as $value5) {
						   ?>
						   <form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/member_approval_email">
							   <div class="form-group btm_border">
								   <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
								   </label>
								   <div class="col-sm-8 col-sm-offse">
									   <input type="text" name="member_approval_email_sub" value="<?=$value5->subject?>" placeholder="" class="form-control" >
								   </div>
							   </div>
							   <div class="form-group btm_border">
								   <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
								   </label>
								   <div class="col-sm-8">
									   <textarea rows="15" class="form-control textarea" data-height="100" name="member_approval_email_body" style="height: 380px;"><?=$value5->body?></textarea>
									   <br>
									   <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
								   </div>
							   </div>
							   <div class="form-group">
								   <div class="col-sm-offset-2 col-sm-9">
									   <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
								   </div>
							   </div>
						   </form>
						   <?php
						   }
						   ?>
					    </div>
						<div id="tab-10" class="tab-pane fade">
						   <?php
						   $resend_email_verification_email = $this->db->get_where('email_template', array('email_template_id' => 10))->result();
						   ?>
						   <?php
						   foreach ($resend_email_verification_email as $value10) {
						   ?>
						   <form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/resend_email_verification_email">
							   <div class="form-group btm_border">
								   <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
								   </label>
								   <div class="col-sm-8 col-sm-offse">
									   <input type="text" name="resend_email_verification_email_sub" value="<?=$value10->subject?>" placeholder="" class="form-control" >
								   </div>
							   </div>
							   <div class="form-group btm_border">
								   <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
								   </label>
								   <div class="col-sm-8">
									   <textarea rows="15" class="form-control textarea" data-height="100" name="resend_email_verification_email_body" style="height: 380px;"><?=$value10->body?></textarea>
									   <br>
									   <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
								   </div>
							   </div>
							   <div class="form-group">
								   <div class="col-sm-offset-2 col-sm-9">
									   <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
								   </div>
							   </div>
						   </form>
						   <?php
						   }
						   ?>
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
