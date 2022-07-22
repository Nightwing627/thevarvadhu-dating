<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo  translate('update_your_script')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo  translate('home')?></a></li>
			<li><a href="#"><?php echo  translate('update')?></a></li>

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

		    <div class="panel-body">
				<div class="text-left">
                    <h4><?php echo  translate('instructions')?></h4>
                </div>
				<hr>
				<ol>
					<li>You can only update to next version from the immediate previous version. Read the document carefully on how to update</li>
					<li>You require proper folder <code>permission</code> for files to upload,extract and overwrite. Other wise take the manual approach.</li>
					<li>Upload the <code>update.zip file from updates/current version to next version(Ex: 2.1 to 2.2)/update.zip</code> .</li>
					<li>Then click on the <code>update</code> button.</li>
					<li>Zip file uploading, extracting, replacing and import the update sql may take some time depending on the file size.</li>
					<li>After the update you will see the new version</li>
				</ol>
				<br>
				<div class="text-left">
                    <h4><?php echo  translate('update')?></h4>
                </div>
				<hr>
				<form class="form-horizontal"  method="POST" action="<?php echo base_url()?>admin/update/do_update" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="fname"><b><?php echo  translate('upload_the_update_file')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-6">
							<input type="file" name="update" ondragover="" class="form-control" accept=".zip" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-8 text-right">
							<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('update')?></button>
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
	}, 5000);
</script>
