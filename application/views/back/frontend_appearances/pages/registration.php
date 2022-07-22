<p class="text-main text-semibold"><?php echo translate('registration')?></p>
<?php $registration_image = $this->db->get_where('frontend_settings', array('type' => 'registration_image'))->row()->value; ?>
<form class="form-horizontal" id="premium_plans_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/registration" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="registration_page_image"><b><?php echo translate('background_image')?></b></label>
        <div class="col-sm-9">
            <?php
                $registration_image = json_decode($registration_image, true);
                if (!empty($registration_image) && file_exists('uploads/registration_image/'.$registration_image[0]['image'])) {
                    $registration_image_url = base_url()."uploads/registration_image/".$registration_image[0]['image'];
                ?>
                    <img class="img-responsive img-border blah" src="<?=$registration_image_url?>" style="max-width: 65%;">
                <?php
                } else {
                ?>
                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/registration_image/default_image.jpg" style="max-width: 65%;">
                <?php
                }
            ?>
        </div>
        <div class="col-sm-9 col-sm-offset-2" style="margin-top: 10px">
            <span class="pull-left btn btn-dark btn-sm btn-file">
                <?php echo translate('select_a_photo')?>
                <input type="file" name="registration_image" id="registration_image" class="form-control imgInp" <?php if($registration_image == '[]'){?>required=""<?php }?>>
            </span>
            <input type="hidden" id="registration_image_is_edit" name="is_edit" value="0">
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

    $("#registration_image").change(function(){
        $("#registration_image_is_edit").val('1');
    });
</script>
