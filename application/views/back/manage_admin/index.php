<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('manage_admin_profile')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('manage_admin_profile')?></a></li>
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
						        <h3 class="panel-title"><?php echo translate('manage_details')?></h3>
						    </div>
						    <div class="panel-body">
						    	<?php
						    	$admin_id = $this->session->userdata('admin_id');
						    	$admin_info = $this->db->get_where("admin", array("admin_id" => $admin_id))->result();
						    	foreach ($admin_info as $info) {
						    	?>
						    		<form class="form-horizontal" id="manage_details_form" method="POST" action="<?=base_url()?>admin/update_admin_profile/update_details">
										<div class="form-group">
											<label class="col-sm-3 control-label" for="name"><b><?php echo translate('name')?> <span class="text-danger">*</span></b></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="name" value="<?=$info->name?>" placeholder="Your Name" required="">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="email"><b><?php echo translate('email')?> <span class="text-danger">*</span></b></label>
											<div class="col-sm-8">
												<input type="email" class="form-control" name="email" value="<?=$info->email?>" placeholder="Your Email Address" required="">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="phone"><b><?php echo translate('phone')?></b></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="phone" value="<?=$info->phone?>" placeholder="Your Phone Number">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="address"><b><?php echo translate('address')?></b></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="address" value="<?=$info->address?>" placeholder="Your Address">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-8 text-right">
												<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
											</div>
										</div>
									</form>
						    	<?php
						    	}
						    	?>
						    </div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?php echo translate('change_password')?></h3>
						    </div>
						    <div class="panel-body">
						        <form class="form-horizontal" id="manage_password_form" method="POST" action="<?=base_url()?>admin/update_admin_profile/update_pass_details">
									<div class="form-group">
										<label class="col-sm-4 control-label" for="current_password"><b><?php echo translate('current_password')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-7">
											<input type="password" class="form-control" name="current_password" id="current_password" value="" placeholder="<?php echo translate('your_current_password')?>" required="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="new_password"><b><?php echo translate('new_password')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-7">
											<input type="password" class="form-control" name="new_password" id="new_password" value="" placeholder="<?php echo translate('your_new_password')?>" required="">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" for="confirm_password"><b><?php echo translate('confirm_password')?> <span class="text-danger">*</span></b></label>
										<div class="col-sm-7">
											<input type="password" class="form-control" name="confirm_password" id="confirm_password" value="" placeholder="<?php echo translate('confirm_password')?>" required="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-7 text-right">
											<button type="submit" id="btn_pass" class="btn btn-primary btn-sm btn-labeled fa fa-save" disabled=""><?php echo translate('save')?></button>
										</div>
									</div>
								</form>
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?php echo translate('admin_login_background')?></h3>
						    </div>
						    <div class="panel-body">
						    	<?php $admin_login_image = $this->db->get_where('general_settings', array('type' => 'admin_login_image'))->row()->value; ?>
					    		<form class="form-horizontal" id="manage_login_form" method="POST" action="<?=base_url()?>admin/update_admin_profile/update_login_page" enctype="multipart/form-data" >
									<div class="form-group">
								        <label class="col-sm-2 control-label" for="login_page_image"><b><?php echo translate('background_image')?></b></label>
								        <div class="col-sm-10">
								            <?php
								                $admin_login_image = json_decode($admin_login_image, true);
								                //print_r($admin_login_image);
								                if (!empty($admin_login_image) && file_exists('uploads/admin_login_image/'.$admin_login_image[0]['image'])) {
								                    $admin_login_image_url = base_url()."uploads/admin_login_image/".$admin_login_image[0]['image'];
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$admin_login_image_url?>" style="max-width: 70%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/admin_login_image/default_image.jpg" style="max-width: 70%;">
								                <?php
								                }
								            ?>
								        </div>
								        <div class="col-sm-10 col-sm-offset-2" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="admin_login_image" id="admin_login_image" class="form-control imgInp" <?php if($admin_login_image == '[]'){?>required=""<?php }?>>
								            </span>
								            <input type="hidden" id="admin_login_image_is_edit" name="is_edit" value="0">
								        </div>
								    </div>
								    <div class="form-group">
								        <div class="col-sm-offset-2 col-sm-10">
								            <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
								        </div>
								    </div>
								</form>
						    </div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?php echo translate('admin_forget_password_background')?></h3>
						    </div>
						    <div class="panel-body">
						    	<?php $forget_pass_image = $this->db->get_where('general_settings', array('type' => 'forget_pass_image'))->row()->value; ?>
					    		<form class="form-horizontal" id="manage_forget_pass_form" method="POST" action="<?=base_url()?>admin/update_admin_profile/update_forget_pass_page" enctype="multipart/form-data">
									<div class="form-group">
								        <label class="col-sm-2 control-label" for="login_page_image"><b><?php echo translate('background_image')?></b></label>
								        <div class="col-sm-10">
								            <?php
								                $forget_pass_image = json_decode($forget_pass_image, true);
								                //print_r($forget_pass_image);
								                if (!empty($forget_pass_image) && file_exists('uploads/forget_pass_image/'.$forget_pass_image[0]['image'])) {
								                    $forget_pass_image_url = base_url()."uploads/forget_pass_image/".$forget_pass_image[0]['image'];
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=$forget_pass_image_url?>" style="max-width: 70%;">
								                <?php
								                } else {
								                ?>
								                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/forget_pass_image/default_image.jpg" style="max-width: 70%;">
								                <?php
								                }
								            ?>
								        </div>
								        <div class="col-sm-10 col-sm-offset-2" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="forget_pass_image" id="forget_pass_image" class="form-control imgInp" <?php if($forget_pass_image == '[]'){?>required=""<?php }?>>
								            </span>
								            <input type="hidden" id="forget_pass_image_is_edit" name="is_edit" value="0">
								        </div>
								    </div>
								    <div class="form-group">
								        <div class="col-sm-offset-2 col-sm-10">
								            <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
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
	$(document).ready(function(){

		setTimeout(function() {
		    $('#success_alert').fadeOut('fast');
		    $('#danger_alert').fadeOut('fast');
		}, 5000); // <-- time in milliseconds

		var current_pass = "";
		var new_pass = "";
		var confirm_pass = "";

		function btn_state(){
			if (new_pass == confirm_pass && (new_pass != '' || confirm_pass != '')) {
				$("#btn_pass").removeAttr("disabled");
			} else {
				$("#btn_pass").attr("disabled", "disabled");
			}
		}

		$("#confirm_password").keyup(function(){
			confirm_pass = $("#confirm_password").val();
			new_pass = $("#new_password").val();
			if (confirm_pass != new_pass) {
				// alert(confirm_pass+", "+new_pass);
				$("#confirm_password").css("border", "1px solid #e33244");
			}
			else if (confirm_pass == new_pass) {
				// alert('yes');
				$("#confirm_password").css("border", "1px solid #71ba51");
			}
			btn_state();
		});

		$("#new_password").keyup(function(){
			confirm_pass = $("#confirm_password").val();
			new_pass = $("#new_password").val();
			if (confirm_pass != new_pass) {
				// alert(confirm_pass+", "+new_pass);
				$("#confirm_password").css("border", "1px solid #e33244");
			}
			else if (confirm_pass == new_pass) {
				// alert('yes');
				$("#confirm_password").css("border", "1px solid #71ba51");
			}
			btn_state();
		});

	    // SCRIT FOR IMAGE UPLOAD
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

	    $("#admin_login_image").change(function(){
	        $("#admin_login_image_is_edit").val('1');
	    });

	    $("#forget_pass_image").change(function(){
	        $("#forget_pass_image_is_edit").val('1');
	    });
	});
</script>
