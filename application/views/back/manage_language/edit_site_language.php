<?php
foreach ($get_site_language as $value) {
?>
    <form class="form-horizontal" id="site_language_form" method="POST" enctype="multipart/form-data" action="<?=base_url()?>admin/manage_language/update/<?=$value->site_language_list_id?>">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="language_icon"><b><?php echo translate('language_icon')?></b></label>
            <div class="col-sm-6">
                <img class="img-responsive img-border blah" src="<?=base_url()?>uploads/language_list_image/language_<?=$value->site_language_list_id?>.jpg" style="max-width: 65%;">
            </div>
            <div class="col-sm-6 col-sm-offset-3" style="margin-top: 10px">
                <span class="pull-left btn btn-dark btn-sm btn-file">
                    <?php echo translate('select_a_photo')?>
                    <input type="file" name="language_icon" id="language_icon" class="form-control imgInp">
                </span>
                <input type="hidden" id="language_icon_is_edit" name="is_edit" value="0">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="language_name"><b><?php echo translate('language_name')?></b></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="language_name" value="<?=$value->name?>" required>
            </div>
        </div>
        <button type="submit" id="site_language_form_submit" style="display: none">Submit</button>
    </form>
<?php
}
?>
<script>
    // SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        //alert();
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

    $(".form-horizontal").on('change', '.imgInp', function () {
        readURL_all(this);
    });

    $("#language_icon").change(function(){
        $("#language_icon_is_edit").val('1');
    });
</script>
