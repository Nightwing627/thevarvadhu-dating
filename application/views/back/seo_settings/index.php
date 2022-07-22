<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('seo_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('seo_settings')?></a></li>
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
				<h3 class="panel-title"><?= translate('seo_settings_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="seo_settings_form" method="POST" action="<?=base_url()?>admin/update_seo_settings" enctype="multipart/form-data" >
							<div class="form-group">
								<label class="col-sm-3 control-label" for="title"><b><?= translate('title')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="title" value="<?=$this->db->get_where('general_settings', array('general_settings_id' => 89))->row()->value?>" placeholder="<?php echo translate('author')?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_keywords"><b><?= translate('keywords')?> </b></label>
								<div class="col-sm-8">
									<input type="text" name="seo_keywords" class="form-control" placeholder="<?php echo translate('keywords')?>" value="<?=$this->db->get_where('general_settings', array('general_settings_id' => 25))->row()->value?>" data-role="tagsinput">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_author"><b><?= translate('author')?> </b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="seo_author" value="<?=$this->db->get_where('general_settings', array('general_settings_id' => 26))->row()->value?>" placeholder="<?php echo translate('author')?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_revisit"><b><?= translate('revisit_after')?> </b></label>
								<div class="col-sm-7">
									<input type="number" class="form-control" name="seo_revisit" value="<?=$this->db->get_where('general_settings', array('general_settings_id' => 54))->row()->value?>" placeholder="<?php echo translate('revisit_after')?>">
								</div>
								<div class="col-sm-1 control-label text-left">
									<?=translate('day(s)')?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_description"><b><?= translate('description')?> </b></label>
								<div class="col-sm-8">
									<textarea class="form-control" name="seo_description" rows="4"><?=$this->db->get_where('general_settings', array('general_settings_id' => 24))->row()->value?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_image_facebook"><b><?php echo translate('seo_image_facebook')?></b> <br><span>(600x315)</span> </label>
						        <div class="col-sm-6">
						        	<?php
						        		$seo_image_facebook = $this->db->get_where('general_settings', array('general_settings_id' => 90))->row()->value;

						                if (!empty($seo_image_facebook) && file_exists('uploads/seo_image/'.$seo_image_facebook)) {
						                    $seo_image_facebook_url = base_url()."uploads/seo_image/".$seo_image_facebook;
						                ?>
						                    <img class="img-responsive img-border blah" src="<?=$seo_image_facebook_url?>" style="max-width: 65%;">
						                <?php
						                } else {
						                ?>
						                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/seo_image/seo_image_facebook _default.png" style="max-width: 65%;">
						                <?php
						                }
									?>
						        </div>
						        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
						            <span class="pull-left btn btn-dark btn-sm btn-file">
						                <?php echo translate('select_a_photo')?>
						                <input type="file" name="seo_image_facebook" id="seo_image_facebook" class="form-control imgInp" <?php if($seo_image_facebook == ''){?> required="" <?php }?>>
						            </span>
						            <input type="hidden" id="seo_image_facebook_is_edit" name="is_edit" value="0">
						        </div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="seo_image_twitter"><b><?php echo translate('seo_image_twitter')?></b><br><span>(280x150)</span></label>
						        <div class="col-sm-6">
						        	<?php
						        		$seo_image_twitter = $this->db->get_where('general_settings', array('general_settings_id' => 91))->row()->value;
						                if (!empty($seo_image_twitter) && file_exists('uploads/seo_image/'.$seo_image_twitter)) {
						                    $seo_image_twitter_url = base_url()."uploads/seo_image/".$seo_image_twitter;
						                ?>
						                    <img class="img-responsive img-border blah" src="<?=$seo_image_twitter_url?>" style="max-width: 65%;">
						                <?php
						                } else {
						                ?>
						                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/seo_image/seo_image_twitter_default.png" style="max-width: 65%;">
						                <?php
						                }
									?>
						        </div>
						        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
						            <span class="pull-left btn btn-dark btn-sm btn-file">
						                <?php echo translate('select_a_photo')?>
						                <input type="file" name="seo_image_twitter" id="seo_image_twitter" class="form-control imgInp" <?php if($seo_image_twitter == '[]'){?>required=""<?php }?>>
						            </span>
						            <input type="hidden" id="seo_image_twitter_is_edit" name="is_edit" value="0">
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

    $("#seo_image_twitter").change(function(){
        $("#seo_image_twitter_is_edit").val('1');
    });
    $("#seo_image_facebook").change(function(){
        $("#seo_image_facebook_is_edit").val('1');
    });

</script>
