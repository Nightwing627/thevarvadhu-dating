<style>
.modal-content {
    width: 300px;
    margin-left: auto;
    margin-right: auto;
}
</style>
<form class="form-horizontal" id="slider_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/home_slider" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="slider_display_status"><b><?= translate('display_status')?></b></label>
        <div class="col-sm-9">
            <?php
                $slider_status = $this->db->get_where('frontend_settings', array('type' => 'slider_status'))->row()->value;
                ?>
            <div class="checkbox">
                <input id="slider_display_status" name="slider_status" class="magic-checkbox" type="checkbox" <?php if($slider_status=='yes'){ echo "checked"; }?>  >
                <label for="slider_display_status"></label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <?php
                    $home_search_style = $this->db->get_where('frontend_settings', array('type' => 'home_search_style'))->row()->value;
                    $style = array(1,2);
                    foreach($style as $value){
                ?>
                    <div class="col-sm-6 box_area">
                        <div class="cc-selector">
                            <input class="home_sear" type="radio" id="home_<?php echo $value; ?>" value="<?php echo $value; ?>" name="home_search_style" <?php if($home_search_style == $value){ echo 'checked'; } ?> >
                            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="home_<?php echo $value; ?>">
                                <div class="img_show">
                                    <img src="<?php echo base_url(); ?>uploads/home_page/search_style_image/<?php echo 'style_'.$value.'.JPG' ?>" width="100%" style=" text-align-last:center;" alt="<?php echo 'search_style_'.$value; ?>" />
                                </div>
                            </label>
                        </div>
                        <div class="home_title">
                            <h5>
                                <span>
                                    <i class="fa fa-check"></i>
                                </span>
                                <?php echo translate('search_style').' '.$value; ?>
                            </h5>
                        </div>
                     </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="slider_display_status"><b><?= translate('search_box_heading')?></b></label>
        <div class="col-sm-9">
            <?php
                $searching_heading = $this->db->get_where('frontend_settings', array('type' => 'home_searching_heading'))->row()->value;
                ?>

                <input type="text" name="searching_heading" class="form-control" value="<?=$searching_heading?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="slider_position"><b><?php echo translate('slider_position')?></b></label>
        <div class="col-sm-9">
            <?php
                $slider_position = $this->db->get_where('frontend_settings', array('type' => 'slider_position'))->row()->value;
                ?>
            <select class="form-control" name="slider_position" id="search_section_position">
                <option value="left" <?php if($slider_position=='left'){ echo "selected"; }?>><?php echo translate('left')?></option>
                <option value="right" <?php if($slider_position=='right'){ echo "selected"; }?>><?php echo translate('right')?></option>
            </select>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="login_page_image"><b><?php echo translate('images')?></b></label>
        <div class="col-sm-9 img_features">
            <?php
                $home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;
                $img_features = json_decode($home_slider_image, true);
                $count = 0;
                foreach ($img_features as $row1) {
                    ?>
                    <div class="col-sm-4 col-md-4 col-lg-3 rem_div" style="margin-bottom:10px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <center>
                                    <div class="col-sm-12" style="padding:10px;">
                                        <?php
                                        if (file_exists('uploads/home_page/slider_image/' . $row1['img'])) {
                                            ?>
                                            <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/home_page/slider_image/<?php echo $row1['img']; ?>?t=<?= time(); ?>" style="max-width: 100%; max-height: 106px;"  >
                                            <?php
                                        } else {
                                            ?>
                                            <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads/home_page/slider_image/default_image.jpg" style="max-width: 100%; max-height: 106px;" >
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </center>
                            </div>
                            <div class="col-sm-12">
                                <?php
                                if ($row1['index'] !== 0) {
                                    ?>
                                    <div class="col-sm-6">
                                        <span class="pull-left btn btn-sm btn-dark btn-file btn-block">
                                            <?php echo translate('select_image')?>
                                            <input type="file" name="nimg[<?php echo $row1['index']; ?>]" class="form-control imgInp">
                                        </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="pull-right btn btn-sm btn-danger btn-block remove_data" data-img_name="<?php echo $row1['img']; ?>">
                                            <?php echo translate('remove')?>
                                        </span>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-sm-12">
                                        <span class="pull-left btn btn-sm btn-dark btn-file btn-block">
                                            <?php echo translate('select_image')?>
                                            <input type="file" name="nimg[<?php echo $row1['index']; ?>]" class="form-control imgInp">
                                            <input type="hidden" name="cnt[<?php echo $row1['index']; ?>]" id="cnt" class="form-control" />
                                        </span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count = $row1['index'];
                }
            ?>
            <input type="hidden" id="img_count" value="<?php echo $count; ?>" />
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="button" class="btn btn-sm btn-dark btn-labeled fa fa-plus" id="add_images"><?php echo translate('add_more_image')?></button>
		</div>
	</div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
        </div>
    </div>
</form>
<div id="news_image_dummy" style="display:none; margin-top:10px">
    <div class="rem">
        <div class="col-sm-4 col-md-4 col-lg-3" style="margin-bottom:10px;">
            <div class="form-group">
                <div class="col-sm-12">
                    <center>
                        <div class="col-sm-12" style="padding:10px;">
                            <img class="img-responsive img-border blah"  src="<?php echo base_url(); ?>uploads//home_page/slider_image/default_image.jpg" style="max-width: 100%; max-height: 106px;" >
                        </div>
                    </center>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-6" style="margin-left:9px">
                        <span class="pull-left btn btn-sm btn-dark btn-file btn-block" style="margin-left:-5px">
                            <?php echo translate('select_image')?>
                            <input type="file" name="nimg[{{i}}]" class="form-control imgInp">
                        </span>
                        <input type="hidden" name="cnt[{{i}}]" class="form-control">
                    </div>
                    <div class="col-sm-6" style="margin-left:-12px">
                        <span class="pull-right btn btn-sm btn-danger btn-block removal" style="margin-left:5px">
                            <?php echo translate('remove')?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url()?>template/back/plugins/bootbox/bootbox.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
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

        $('body').on('click', '.removal', function () {
            $(this).closest('.rem').remove();
        });

        $('#add_images').click(function () {
            var news_image_dummy_html = $('#news_image_dummy').html();
            var l = $('#img_count').val();
            ln = parseInt(Number(l) + 1);
            news_image_dummy_html = news_image_dummy_html.replace(/{{i}}/g, ln);
            $('.img_features').append(news_image_dummy_html);
            $('#img_count').val(ln);
            $('#cnt').val(ln);
        });
        $('body').on('click', '.remove_data', function () {
            $(this).addClass('disabled');
            var img_name = $(this).data('img_name');
            var now = $(this);
            setTimeout(function () {
                bootbox.confirm('Really Want to Delete this Image?', function (result) {
                    if (result) {
                        $.ajax({
                            url: "<?php echo base_url();?>admin/delete_slider/"+img_name,
                            beforeSend: function () {
                                now.closest('.rem_div').css('opacity', '.5');
                            },
                            success: function (result) {
                                now.closest('.rem_div').remove();
                            }
                        });
                    } else {
                        now.removeClass('disabled');
                    }
                    ;
                });
            }, 500)
        });
    });
</script>
<script>
$(document).ready(function() {
    check_style();
});
function check_style(){
    var style=$('input[name="home_search_style"]:checked').val();
    $('.home_title').removeClass('active');
    $('input[name="home_search_style"]:checked').closest(".box_area").find('.home_title').addClass('active');
}
</script>
<style>
.cc-selector input:checked + .drinkcard-cc {
    -webkit-filter: none;
    -moz-filter: none;
    filter: none;
    border: 4px solid black;
}
.home_sear{
    display: none;
}
.horizontal-tab{
    margin:15px;
}
.horizontal-tab .nav-tabs{
    border: 0;
    display:block !important;
    width:100%;
}
.horizontal-tab .nav-tabs li{
    float:left;
}
.horizontal-tab .nav-tabs li:hover{
    border-bottom:2px solid #dadada;
}
.horizontal-tab .nav-tabs li.active{
    border-bottom:2px solid #489eed;
}
.horizontal-tab .nav-tabs li.active a{
    background:#FFF;
}
.horizontal-tab .nav-tabs>li:not(.active) a:hover {
    border-color:#fff !important;
}
.horizontal-tab .tab-content{
    display:block !important;
}
.img_show{
    position:relative;
    overflow:auto;
}
.img_show::-webkit-scrollbar{
    width: 3px;
    background: #737373;
}
.img_show::-webkit-scrollbar-thumb{
    background: #fff;
}
.img_show::-webkit-scrollbar{
    width: 3px;
    background: #737373;
}
.img_show::-webkit-scrollbar-thumb{
    background: #fff;
}
.home_title{
    display: block;
    text-align: center;
}
.home_title span i{
    opacity: 0;
}
.home_title.active span i{
    opacity: 1;
    color:#096;
}
</style>
