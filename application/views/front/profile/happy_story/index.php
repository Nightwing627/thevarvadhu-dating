<?php 
    if ($this->db->get_where("member",array("member_id" => $this->session->userdata('member_id')))->row()->membership == 1) 
    {
    ?>
        <div class="card-title">
            <h3 class="heading heading-6 strong-500">
                <b><?=translate('your_story')?></b>
            </h3>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <p class="text-center pt-2"><?=translate('please_upgrade_to_premium_membership_to_post_your_stories')?></p>
                <div class="text-center pt-2 pb-4">
                    <a href="<?=base_url()?>home/plans" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom" style="width: 50%"><?=translate('get_premium_membership')?></a>
                </div>
            </div>
        </div>
    <?php        
    }
    else {
?>
        <?php
            $story_exist = $this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->result();
        ?>
        <div class="card-title">
            <h3 class="heading heading-6 strong-500">
                <b><?php 
                    if ($story_exist) {
                        echo translate('your_story');
                    }
                    else {
                        echo translate('upload_your_story');      
                    }
                ?></b>
            </h3>
            <?php
            if ($story_exist) {
                if ($this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->row()->approval_status == "1") {
            ?>
                    <span class="badge badge-md badge-pill bg-success"><?=translate('approved')?></span>
            <?php
                }
                else{
            ?>
                    <span class="badge badge-md badge-pill bg-danger"><?=translate('not_approved')?></span>
            <?php
                }
            }
            ?>
        </div>
        <div class="card-body">
            <?php
            $get_story = $this->db->get_where("happy_story", array("posted_by" => $this->session->userdata('member_id')))->result();
            if ($story_exist) {
                foreach ($get_story as $value) 
                {
                ?>
                <div class="mb-4">
                    <?php 
                        $is_approved = $this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->row()->approval_status;
                    ?>
                    <a class="c-base-1" href="<?php if($is_approved == '1'){echo base_url()?>home/stories/story_detail/<?=$value->posted_by;}else{echo '#';}?>"><h3 class="heading heading-2 strong-400 text-normal">
                    <?=$value->title?>
                    </h3></a>
                    <ul class="inline-links inline-links--style-2 mt-1">
                        <li>
                            <?= date_format(date_create($value->post_time),"d, F Y")?> 
                        </li>
                    </ul>
                </div>
                <?php 
                    $images = json_decode($value->image, true);
                ?>
                <section class="swiper-js-container background-image-holder" data-holder-type="fullscreen" data-holder-offset=".navbar" style="height: 420px;">
                    <div class="swiper-container swiper-container-horizontal swiper-container-fade" data-swiper-autoplay="true" data-swiper-effect="fade" data-swiper-items="1" data-swiper-space-between="0" data-swiper-sm-items="1" data-swiper-sm-space-between="0" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
                        <div class="swiper-wrapper" style="transition-duration: 0ms;">
                            <!-- Slide -->
                            <?php
                                $i = 0; 
                                foreach ($images as $image): ?>
                                    <div class="swiper-slide <?php if($i==0){echo 'swiper-slide-active';}?>" data-swiper-autoplay="5000" style="width: 100%; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                        <div class="slice holder-item holder-item-light has-bg-cover bg-size-cover" style="background-image: url('<?=base_url()?>uploads/happy_story_image/<?=$image['img']?>'); background-position: bottom bottom;">
                                        </div>
                                    </div>
                                <?php
                                $i++; 
                                endforeach;
                            ?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
                            <?php
                                $j = 0; 
                                foreach ($images as $image): ?>
                                    <span class="swiper-pagination-bullet <?php if($j==0){echo 'swiper-pagination-bullet-active';}?>"></span>
                                <?php
                                $j++; 
                                endforeach;
                            ?> 
                            <!-- <span class="swiper-pagination-bullet"></span> -->
                        </div>

                        <!-- Add Arrows -->
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </section>

                <!-- <div class="block-image">
                    <img src="<?=base_url()?>template/front/images/prv/blog/img-2.jpg" class="rounded">
                </div> -->
                <div class="block-body block-post-body mt-3">
                    <p>
                        <?=$value->description?>
                    </p>
                </div>
                <?php
                    $video_exist = $this->db->get_where("story_video",array("story_video_uploader_id" => $this->session->userdata('member_id')))->result();
                    if ($video_exist) {
                        $get_video = $this->db->get_where("story_video", array("story_video_uploader_id" => $this->session->userdata('member_id')))->result_array();
                        foreach ($get_video as $video) {?>
                            <div class="post-media text-center" style="padding-top: 10px">
                                <?php if($video['type'] == 'upload'){?>
                                    <video controls height="450" width="80%">
                                        <source src="<?php echo base_url();?><?php echo $video['video_src'];?>">
                                    </video>
                                <?php }else{?>
                                    <iframe controls="2" height="450" width="80%" 
                                        src="<?php echo $video['video_src'];?>" frameborder="0" >
                                    </iframe>
                                <?php }?>
                            </div>
                        <?php
                        }
                    }
                ?>
                <?php
                }
            }
            else {
            ?>
                <form class="form-default col-12" id="happy_story_form" method="post" action="<?=base_url()?>home/stories/add" role="form" enctype="multipart/form-data">
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <label class="control-label"><?php echo translate('story_title')?> <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <label class="control-label"><?php echo translate('story_details')?> <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="" rows="6" required></textarea>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <label class="control-label"><?php echo translate('date')?> <span class="text-danger">*</span></label>
                        <input type="date" name="post_time" class="form-control" required>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <label class="control-label"><?php echo translate('partner_name')?> <span class="text-danger">*</span></label>
                        <input type="text" name="partner_name" class="form-control" required>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <div class="row">
                            <div class="col-sm-7 select_div" id="img_main">
                                <label class="control-label"><?php echo translate('upload_image')?> <span class="text-danger">*</span></label>
                                <div class="col-sm-12" style="margin:2px; padding:2px;">
                                    <img class="img-responsive img-border blah z-depth-1-bottom" style="width: 100%;border: 1px solid #e6e6e6;" src="<?=base_url()?>uploads/happy_story_image/default_image.jpg" class="img-sm">
                                </div>
                                <label for="image_main" class="control-label">
                                    <a class="btn btn-styled btn-xs btn-base-2 btn-shadow ml-1" style="color: #FFF"><?php echo translate('select_a_photo')?></a>
                                </label>
                                <input type="file" id="image_main" name="image[]" class="form-control imgInp" style="display: none" required>
                            </div>
                            <div class="col-sm-5 select_div2" id="add_extra">
                                <div id="btn_section">
                                    <label class="control-label"></label>
                                    <div class="col-sm-12" style="margin:2px; padding:2px;">
                                        <button type="button" id="is_select" class="btn btn-styled btn-xs btn-base-2 btn-shadow mt-1" disabled><?php echo translate('add_another_image')?></button>
                                    </div>
                                </div>
                                <div id="additional" style="display: none">
                                    <label class="control-label"><?php echo translate('add_another_image')?></label>
                                    <div class="col-sm-12" style="margin:2px; padding:2px;">
                                        <img class="img-responsive img-border blah z-depth-1-bottom" style="width: 100%;border: 1px solid #e6e6e6;" src="<?=base_url()?>uploads/happy_story_image/default_image.jpg" class="img-sm">
                                    </div>
                                    <label for="image_extra" class="control-label">
                                        <a class="btn btn-styled btn-xs btn-base-2 btn-shadow ml-1" style="color: #FFF"><?php echo translate('select_a_photo')?></a>
                                        <a id="is_cancel" class="btn btn-styled btn-xs btn-danger btn-shadow ml-1" style="color: #FFF"><?php echo translate('cancel')?></a>
                                    </label>
                                    <input type="file" id="image_extra" name="image[]" class="form-control imgInp2" style="display: none" disabled>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto">
                        <div class="row">
                            <div class="col-sm-12 select_div" id="vid_main">
                                <label class="control-label"><?php echo translate('upload_video')?></label> <br>
                                <div id="vid_detail" style="display: none">
                                    <label class="control-label"><?php echo translate('upload_method')?> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="upload_method" onchange="video_sector(this.value)">
                                        <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                                        <option value="upload"><?php echo translate('upload_video') ?></option>
                                        <option value="share"><?php echo translate('share_link'); ?></option>
                                    </select>
                                    <div class="mt-1" id="video_upload" style="display:none">
                                        <label class="btn btn-styled btn-xs btn-base-2 btn-shadow ml-1" for="videoInp" style="margin: 5px 0px !important;cursor: pointer;"><?=translate('select_a_video')?></label><span class="text-danger video_limit_msg" style="margin-left: 10px; font-size: 12px"><?php echo translate("max_limit_25_Mb"); ?></span>
                                        <input class="form-control videoInp" id="videoInp" type="file" name="upload_video" style="display: none" accept="video/*"/>
                                        <div id="message"></div>
                                        <label class="control-label"><?php echo translate('video_preview')?></label><br>
                                        <video controls id="upload_story_video" width="400">
                                        </video>
                                    </div>
                                    <div id="video_share" style="display:none;">
                                        <label class="control-label"><?php echo translate('sharing_site')?></label>
                                        <select class="form-control site" name="site">
                                            <option selected disabled><?php echo translate('choose_an_option'); ?></option>
                                            <option value="youtube"><?php echo translate('youtube') ?></option>
                                            <option value="dailymotion"><?php echo translate('dailymotion'); ?></option>
                                            <option value="vimeo"><?php echo translate('vimeo'); ?></option>
                                        </select>
                                        <label class="control-label"><?php echo translate('video_link')?></label>
                                        <input type="text" id="video_link" name="video_link" class="form-control" onchange="preview(this.value)">                                        
                                        <label class="control-label"><?php echo translate('video_preview')?></label>       <div class="row">
                                            <div class="col-sm-10" id="video_preview">

                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="vl" name="vl" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="control-label" id="btn_vid">
                            <a class="btn btn-styled btn-xs btn-base-2 btn-shadow ml-1" id="up_vid" style="color: #FFF"><?php echo translate('upload_video')?></a>
                        </label>
                    </div>
                    <div class="form-group has-feedback col-10 ml-auto mr-auto text-center">
                        <button type="button" class="btn btn-sm btn-base-1 z-depth-2-bottom" onclick="confirm_post_story()" style="width: 25%"><?php echo translate('apply')?></button>
                        <button type="submit" id="btn_story_upload" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom" style="width: 25%; display: none"><?php echo translate('apply')?></button>
                    </div>    
                </form>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
<script>
    $(document).ready(function(){
        //$('.swiper-container').swiper();
        $("#vid_main :input").prop("disabled", true);
        load_swiper();
    });

    $('#happy_story_form').on('submit', function(e){
        $('#happy_story_form').hide();
        $('.card-body').append("<div class='text-center pt-5 pb-5 mt-5 mb-5' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i><p class='mt-4'>Please Wait. Uploading your Video...</p></div>");
    });

    var isloggedin = "<?=$this->session->userdata('member_id')?>";

    function confirm_post_story() {
        // alert();
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_upload_your_story!');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_story_upload');?>");
            $("#modal_body").html("<p class='text-center' style='font-size:85%;'><?php echo translate('after_submitting_the_story,_admin_will_review_the_upload_and_varify_the_informations._then_admin_may_approve_your_post');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_post_story' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_post_story()' style='width:25%'><?php echo translate('confirm');?></a>");
        }    
        return false;
    }

    function do_post_story() {
        if (isloggedin != ""){
            $("#confirm_post_story").removeAttr("onclick");
            $("#confirm_post_story").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            setTimeout(function() {
                $("#active_modal .close").click();
                $(".btn-back-to-top").click(); 
                $("#btn_story_upload").click();
            }, 500); // <-- time in milliseconds
        }    
        return false;
    }

    // SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.select_div').find('.blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#is_select").prop('disabled', false);
        }
    }
    $("#img_main").on('change', '.imgInp', function () {
        readURL_all(this);
    });

    // SCRIT FOR EXTRA IMAGE UPLOAD
    function readURL_all2(input) {
        if (input.files && input.files[0]) {
            var reader2 = new FileReader();
            reader2.onload = function (e) {
                $('.select_div2').find('.blah').attr('src', e.target.result);
            }
            reader2.readAsDataURL(input.files[0]);
        }
    }
    function video_sector(upload_type) {
        if (upload_type == 'upload') {
            $('#video_share').hide('slow');
            $('#video_upload').show('slow');
            $('#video_link').removeAttr('required');
        } else if (upload_type == 'share') {
            $('#video_upload').hide('slow');
            $('#video_share').show('slow');
            $('#video_link').attr("required", true);
        }
    }
    function preview(v_link) {
        var site = $('.site').val();
        if (site == 'youtube') {
            var x = v_link.split('=');
            var video_link = x[1];
        } else if (site == 'dailymotion') {
            var temp = v_link.split('/');
            var x = temp[4].split('_');
            var video_link = x[0];
        } else if (site == 'vimeo') {
            var x = v_link.split('/');
            var video_link = x[3];
        }
        //alert(video_link);
        $('#vl').val(video_link);
        $('#video_preview').load('<?php echo base_url(); ?>index.php/home/stories/preview/'+site+'/'+video_link);
    }
    $("#add_extra").on('change', '.imgInp2', function () {
        readURL_all2(this);
    });

    $("#is_select").click(function(){
        $("#btn_section").hide();
        $("#additional").show();
        $("#image_extra").prop('disabled', false);
        $("#image_extra").prop('required', true);
    });

    $("#is_cancel").click(function(){
        $("#btn_section").show();
        $("#additional").hide();
        $("#image_extra").prop('disabled', true);
        $("#image_extra").prop('required', false);

    });
    $("#up_vid").click(function(){
        $("#btn_vid").hide();
        $("#vid_detail").show();
        $("#vid_main :input").prop("disabled", false);
        /*$("#image_extra").prop('disabled', false);
        $("#image_extra").prop('required', true);*/
    });
</script>
<script>
    (function localFileVideoPlayer() {
        'use strict'
        var URL = window.URL || window.webkitURL;
        var displayMessage = function (message, isError) {
            var element = document.querySelector('#message');
            element.innerHTML = message;
            element.className = isError ? 'error' : 'info';
        }
        var playSelectedFile = function (event) {
            var file = this.files[0];
            var file_size = this.files[0].size;
            if (file_size <= 25000000) {
                $('.video_limit_msg').html("<?php echo translate("max_limit_25_Mb"); ?>");
                var type = file.type;
                var videoNode = document.querySelector('#upload_story_video');
                var canPlay = videoNode.canPlayType(type);
                if (canPlay === '')
                    canPlay = 'no';
                //var message = 'Can play type "' + type + '": ' + canPlay ;
                var isError = canPlay === 'no';
                //displayMessage(message, isError) ;
                if (isError) {
                    return
                }
                var fileURL = URL.createObjectURL(file);
                videoNode.src = fileURL;
            } else {
                $('#videoInp').val('');
                $('.video_limit_msg').html("<?php echo translate("video_file_exceeded_25_Mb!"); ?>");
            }
            
        }
        var inputNode = document.querySelector('.videoInp');
        inputNode.addEventListener('change', playSelectedFile, false);
    })();
</script>