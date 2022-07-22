<?php
	$home_parallax_image = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_image'))->row()->value;
	$home_parallax_text = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_text'))->row()->value;
?>
<form class="form-horizontal" id="parallax_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/home_parallax" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="home_parallax_status"><b><?= translate('display_status')?></b></label>
        <div class="col-sm-9">
            <?php
                $home_parallax_status = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_status'))->row()->value;
                ?>
            <div class="checkbox">
                <input id="home_parallax_status" name="home_parallax_status" class="magic-checkbox" type="checkbox" <?php if($home_parallax_status=='yes'){ echo "checked"; }?>  >
                <label for="home_parallax_status"></label>
            </div>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="parallax_image"><b><?php echo translate('background_image')?></b></label>
        <div class="col-sm-9">
        	<?php
				$parallax_image = json_decode($home_parallax_image, true);
				//print_r($parallax_image);
				if (!empty($parallax_image) && file_exists('uploads/home_page/parallax_image/'.$parallax_image[0]['image'])) {
					$parallax_image_url = base_url()."uploads/home_page/parallax_image/".$parallax_image[0]['image'];
	            ?>
					<img class="img-responsive img-border blah" src="<?=$parallax_image_url?>" style="max-width: 65%;">
				<?php
				} else {
				?>
					<img class="img-responsive img-border blah" src="<?=base_url()?>uploads/home_page/parallax_image/default_image.jpg" style="max-width: 65%;">
				<?php
				}
			?>
        </div>
        <div class="col-sm-9 col-sm-offset-2" style="margin-top: 10px">
            <span class="pull-left btn btn-dark btn-sm btn-file" id="img_edit">
                <?php echo translate('select_a_photo')?>
                <input type="file" name="parallax_image" id="parallax_image" class="form-control imgInp" <?php if(!file_exists('uploads/home_page/parallax_image/'.$parallax_image[0]['image'])){?>required=""<?php }?>>
            </span>
            <input type="hidden" id="parallax_image_is_edit" name="is_edit" value="0">
        </div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="parallax_text"><b><?php echo translate('parallax_text')?></b></label>
        <div class="col-sm-9">
        	<textarea class="form-control" id="parallax_text" name="parallax_text" rows="5" required=""><?=$home_parallax_text?></textarea>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>
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

    $("#parallax_image").change(function(){
	    $("#parallax_image_is_edit").val('1');
	});
</script>
