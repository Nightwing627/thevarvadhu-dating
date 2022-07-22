<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('get_backup_of_your_script_and_data')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('backup')?></a></li>

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
	                 <?=validation_errors()?>
	            </div>
			<?php endif ?>

		    <div class="panel-body">
				<div class="text-left">
                    <h4><?= translate('instructions')?></h4>
                </div>
				<hr>
				<ol>
					<li>Your backup for script will zip all folders in project root.If you have other files which do not belong to project, those will also get zipped .</li>
					<li>If you choose <code> Download mode: Download </code> your script / sql / both will be downloaded in your devide.</li>
					<li>If you choose <code> Download mode: Root </code> your script / sql / both will be stored in your project's root folder.</li>
					<li>Full script downloading may take longer <strong>(5- 10 minutes or more)</strong> than usual.</li>
					<li>Due to the limited execution time and memory available to PHP, backing up very large <strong>databases</strong> may not be possible. If your <strong>databases</strong> is very large you might need to backup directly from your SQL server via the command line, or have your server admin do it for you if you do not have root privileges.</li>
					<li>Due to the limited execution time and memory available to PHP, backing up very large <strong>project folder</strong> may not be possible. If your <strong>project folder</strong> is very large you might need to backup directly from cpanel or via ftp.</li>
				</ol>
				<br>
				<div class="text-left">
                    <h4><?= translate('get_backup')?></h4>
                </div>
				<hr>
	    		<form class="form-horizontal" method="POST" action="<?=base_url()?>admin/backup/get_backup">
					<div class="form-group">
						<div class="col-sm-1"></div>
                        <div class="col-sm-3"><?=translate('backup_mode')?></div>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" name="backup_mode" value="only_sql" checked><?=translate('only_sql')?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="backup_mode" value="only_script"><?=translate('only_script')?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="backup_mode" value="both"><?=translate('both')?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
						<div class="col-sm-1"></div>
                        <div class="col-sm-3"><?=translate('download_or_save_in_root_folder')?></div>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" name="download_mode" value="download" checked><?=translate('download')?>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="download_mode" value="archive"><?=translate('root')?>
                            </label>
                        </div>
                    </div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-8 text-right">
							<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?=translate('get_backup')?></button>
							<a href="<?php echo base_url(); ?>admin/backup/" class="btn btn-success btn-sm " ><?php echo translate('refresh')?></a>
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
