<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('social_media_comments')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('social_media_comments')?></a></li>
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
				<h3 class="panel-title"><?= translate('social_media_comments_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="social_media_comments_settings_form" method="POST" action="<?=base_url()?>admin/update_social_media_comments_settings">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="phone"><b><?= translate('type')?></b></label>
								<div class="col-sm-8">
									<select class="form-control" name="type">
										<?php
											$social_media_comments_type = $this->db->get_where('third_party_settings', array('type' => 'comment_type'))->row()->value;
										?>
							            <option value="facebook" <?php if ($social_media_comments_type == "facebook"){?> selected<?php } ?>> <?= translate('facebook')?></option>
							            <option value="discus" <?php if ($social_media_comments_type == "discus"){?> selected<?php } ?>> <?= translate('discus')?></option>
							        </select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="discus_id"><b><?= translate('discus_id')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="discus_id" value="<?=$this->db->get_where('third_party_settings', array('type' => 'discus_id'))->row()->value;?>" placeholder="<?php echo translate('your_discus_id')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="facebook_comment_api"><b><?= translate('facebook_comment_id')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="facebook_comment_api" value="<?=$this->db->get_where('third_party_settings', array('type' => 'fb_comment_api'))->row()->value;?>" placeholder="<?php echo translate('your_facebook_comment_id')?>">
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