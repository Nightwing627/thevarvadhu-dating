<p class="text-main text-semibold"><?php echo translate('log_in')?></p>
<?php $login_image = $this->db->get_where('frontend_settings', array('type' => 'login_image'))->row()->value; ?>
<form class="form-horizontal" id="premium_plans_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/log_in" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="login_page_image"><b><?php echo translate('background_image')?></b></label>
        <div class="col-sm-9">
            <?php
                $login_image = json_decode($login_image, true);
                //print_r($login_image);
                if (!empty($login_image) && file_exists('uploads/login_image/'.$login_image[0]['image'])) {
                    $login_image_url = base_url()."uploads/login_image/".$login_image[0]['image'];
                ?>
                    <img class="img-responsive img-border blah" src="<?=$login_image_url?>" style="max-width: 65%;">
                <?php
                } else {
                ?>
                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/login_image/default_image.jpg" style="max-width: 65%;">
                <?php
                }
            ?>
        </div>
        <div class="col-sm-9 col-sm-offset-2" style="margin-top: 10px">
            <span class="pull-left btn btn-dark btn-sm btn-file">
                <?php echo translate('select_a_photo')?>
                <input type="file" name="login_image" id="login_image" class="form-control imgInp" <?php if($login_image == '[]'){?>required=""<?php }?>>
            </span>
            <input type="hidden" id="login_image_is_edit" name="is_edit" value="0">
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

    $("#login_image").change(function(){
        $("#login_image_is_edit").val('1');
    });
</script>
