<p class="text-main text-semibold"><?php echo translate('registration_message')?></p>
<form class="form-horizontal" id="terms_and_conditions_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/registration_msg">
    <div class="form-group">
        <div class="col-sm-12">
            <textarea class="form-control textarea" name="registration_message" id="registration_message" required><?=$this->Crud_model->get_type_name_by_id('frontend_settings', '44', 'value')?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
        </div>
    </div>
</form>

<!-- <p class="text-main text-semibold"><?php echo translate('registration_message')?></p> -->
<?php $registration_message_image = $this->db->get_where('frontend_settings', array('type' => 'registration_message_image'))->row()->value; ?>
<form class="form-horizontal" id="premium_plans_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/registration_message" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="registration_message_page_image"><b><?php echo translate('background_image')?></b></label>
        <div class="col-sm-9">
            <?php
                $registration_message_image = json_decode($registration_message_image, true);
                //print_r($registration_message_image);
                if (!empty($registration_message_image) && file_exists('uploads/registration_message_image/'.$registration_message_image[0]['image'])) {
                    $registration_message_image = base_url()."uploads/registration_message_image/".$registration_message_image[0]['image'];
                ?>
                    <img class="img-responsive img-border blah" src="<?=$registration_message_image?>" style="max-width: 65%;">
                <?php
                } else {
                ?>
                    <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/registration_message_image/default_image.jpg" style="max-width: 65%;">
                <?php
                }
            ?>
        </div>
        <div class="col-sm-9 col-sm-offset-2" style="margin-top: 10px">
            <span class="pull-left btn btn-dark btn-sm btn-file">
                <?php echo translate('select_a_photo')?>
                <input type="file" name="registration_message_image" id="registration_message_image" class="form-control imgInp" <?php if($registration_message_image == '[]'){?>required=""<?php }?>>
            </span>
            <input type="hidden" id="registration_message_image_is_edit" name="is_edit" value="0">
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

    $("#registration_message_image").change(function(){
        $("#registration_message_image_is_edit").val('1');
    });
</script>
