<!--Magic Checkbox [ OPTIONAL ]-->
<link href="<?=base_url()?>template/back/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('add_role')?></h1>
			<!--Searchbox-->
			<div class="searchbox">
				<div class="pull-right">
					<a href="<?=base_url()?>admin/role" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
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
			<li><a href="#"><?php echo translate('manage_role')?></a></li>
			<li class="active"><?php echo translate('add_role')?></li>
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
		        <h3 class="panel-title"><?= translate('create_new_role')?></h3>
		    </div>
		    <div class="panel-body">
		    		<form class="form-horizontal" id="manage_details_form" method="POST" action="<?=base_url()?>admin/role/do_add">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="name"><b><?= translate('name')?> <span class="text-danger">*</span></b></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="<?php if(!empty($form_contents)){echo $form_contents['name'];}?>" name="name" placeholder="<?= translate('role_name')?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="description"><b><?= translate('description')?> </span></b></label>
							<div class="col-sm-8">
								<textarea name="description" class="form-control" placeholder="<?php echo translate('role_description'); ?>"><?php if(!empty($form_contents)){echo $form_contents['description'];}?></textarea>
								
							</div>
						</div>
						<div class="form-group">
			                <label class="col-sm-3 control-label" for="demo-hor-3"><?php echo translate('access_permissions'); ?></label>
			                <div class="col-sm-8">
			                    <table>
			                        <?php
			                        foreach ($all_permissions as $row1) {
		                            	?>
		                                <tr style="border-bottom: 1px solid #f2f2f2">
		                                    <td width="250">
		                                        <label class="control-label"><?php echo translate($row1['codename']);?></label>
		                                    </td>
		                                    <td>
		                                    	<div class="checkbox" style="padding-top: 5px;">
									                <input id="per_<?php echo $row1['permission_id']; ?>"  name="permission[]"  value="<?php echo $row1['permission_id']; ?>" data-id='<?php echo $row1['permission_id']; ?>' class="magic-checkbox" type="checkbox">
									                <label for="per_<?php echo $row1['permission_id']; ?>">
									     
									                </label>
									            </div>
		                                    </td>
		                                </tr>
		                                <?php
			                        }
			                        ?>
			                    </table>
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
