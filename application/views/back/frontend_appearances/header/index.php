<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('frontend_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('frontend_settings')?></a></li>
			<li><a href="#"><?php echo translate('frontend_appearances')?></a></li>
			<li class="active"><a href="#"><?php echo translate('header')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('manage_frontend_header')?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" id="general_settings_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/update_header" enctype="multipart/form-data" >
					<div class="form-group">
				        <label class="col-sm-3 control-label" for="sticky_header_status"><b><?= translate('sticky_header')?></b></label>
				        <div class="col-sm-6">
				            <?php
				                $sticky_header = $this->db->get_where('frontend_settings', array('type' => 'sticky_header'))->row()->value;
				                ?>
				            <div class="checkbox">
				                <input id="sticky_header_status" name="sticky_header" class="magic-checkbox" type="checkbox" <?php if($sticky_header=='yes'){ echo "checked"; }?>  >
				                <label for="sticky_header_status"></label>
				            </div>
				        </div>
				    </div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="header_logo"><b><?php echo translate('header_logo')?></b></label>
				        <div class="col-sm-6">
				        	<?php
				        		$header_logo = $this->db->get_where('frontend_settings', array('type' => 'header_logo'))->row()->value;
				    			$header_logo = json_decode($header_logo, true);
				                //print_r($header_logo);
				                if (!empty($header_logo) && file_exists('uploads/header_logo/'.$header_logo[0]['image'])) {
				                    $header_logo_url = base_url()."uploads/header_logo/".$header_logo[0]['image'];
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=$header_logo_url?>" style="max-width: 65%;">
				                <?php
				                } else {
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/header_logo/default_image.png" style="max-width: 65%;">
				                <?php
				                }
							?>
				        </div>
				        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
				            <span class="pull-left btn btn-dark btn-sm btn-file">
				                <?php echo translate('select_a_photo')?>
				                <input type="file" name="header_logo" id="header_logo" class="form-control imgInp" <?php if($header_logo == '[]'){?>required=""<?php }?>>
				            </span>
				            <input type="hidden" id="header_logo_is_edit" name="is_edit" value="0">
				        </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="favicon"><b><?php echo translate('favicon')?></b></label>
				        <div class="col-sm-6">
				        	<?php
				        		$favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
				    			$favicon = json_decode($favicon, true);
				                //print_r($favicon);
				                if (!empty($favicon) && file_exists('uploads/favicon/'.$favicon[0]['image'])) {
				                    $favicon_url = base_url()."uploads/favicon/".$favicon[0]['image'];
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=$favicon_url?>" style="max-width: 65%;">
				                <?php
				                } else {
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/favicon/default_image.png" style="max-width: 65%;">
				                <?php
				                }
							?>
				        </div>
				        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
				            <span class="pull-left btn btn-dark btn-sm btn-file">
				                <?php echo translate('select_a_photo')?>
				                <input type="file" name="favicon" id="favicon" class="form-control imgInp" <?php if($favicon == '[]'){?>required=""<?php }?>>
				            </span>
				            <input type="hidden" id="favicon_is_edit" name="is_edit" value="0">
				        </div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6 text-right">
				        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
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

    $("#header_logo").change(function(){
        $("#header_logo_is_edit").val('1');
    });
    $("#favicon").change(function(){
        $("#favicon_is_edit").val('1');
    });
</script>
