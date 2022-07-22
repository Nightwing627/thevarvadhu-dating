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
			<li class="active"><a href="#"><?php echo translate('footer')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('manage_frontend_footer')?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" id="general_settings_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/update_footer" enctype="multipart/form-data" >
					<div class="form-group">
						<label class="col-sm-3 control-label" for="footer_logo"><b><?php echo translate('footer_logo')?></b></label>
				        <div class="col-sm-6">
				        	<?php
				        		$footer_logo = $this->db->get_where('frontend_settings', array('type' => 'footer_logo'))->row()->value;
				        		$footer_logo_position = $this->db->get_where('frontend_settings', array('type' => 'footer_logo_position'))->row()->value;
				        		$footer_text = $this->db->get_where('frontend_settings', array('type' => 'footer_text'))->row()->value;
				    			$footer_logo = json_decode($footer_logo, true);
				                //print_r($footer_logo);
				                if (!empty($footer_logo) && file_exists('uploads/footer_logo/'.$footer_logo[0]['image'])) {
				                    $footer_logo_url = base_url()."uploads/footer_logo/".$footer_logo[0]['image'];
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=$footer_logo_url?>" style="max-width: 65%;">
				                <?php
				                } else {
				                ?>
				                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/footer_logo/default_image.png" style="max-width: 65%;">
				                <?php
				                }
							?>
				        </div>
				        <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
				            <span class="pull-left btn btn-dark btn-sm btn-file">
				                <?php echo translate('select_a_photo')?>
				                <input type="file" name="footer_logo" id="footer_logo" class="form-control imgInp" <?php if($footer_logo == '[]'){?>required=""<?php }?>>
				            </span>
				            <input type="hidden" id="footer_logo_is_edit" name="is_edit" value="0">
				        </div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="footer_logo_position"><b><?php echo translate('logo_position')?></b></label>
						<div class="col-sm-6">
							<select class="form-control" name="footer_logo_position" id="footer_logo_position">
					            <option value="left" <?php if($footer_logo_position == "left"){ ?>selected<?php } ?>><?php echo translate('left')?></option>
					            <option value="right" <?php if($footer_logo_position == "right"){ ?>selected<?php } ?>><?php echo translate('right')?></option>
					        </select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="footer_text"><b><?php echo translate('footer_text')?></b></label>
						<div class="col-sm-6">
							<textarea class="form-control" id="footer_text" name="footer_text" rows="5"><?=$footer_text?></textarea>
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

    $("#footer_logo").change(function(){
        $("#footer_logo_is_edit").val('1');
    });
</script>
