<style>.lg-outer #lg-download {display: none!important;}</style>
<div class="sidebar sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top">
    <div class="sidebar-object mb-0">
        <!-- Profile picture -->
        <div class="profile-picture profile-picture--style-2">
            <?php
                $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                $profile_image_status = $get_member[0]->profile_image_status;
                $pic_show_status = 'ok';
                if ($profile_pic_approval == 'on') {
                    if($profile_image_status == 1){
                        $pic_show_status = 'ok';
                    }
                    else{
                        $pic_show_status = 'no';
                    }
                }
                $profile_image = $get_member[0]->profile_image;
                $images = json_decode($profile_image, true);
                if (file_exists('uploads/profile_image/'.$images[0]['thumb']) && $pic_show_status == 'ok' ) {
                    $pic_privacy = $get_member[0]->pic_privacy;
                    $pic_privacy_data = json_decode($pic_privacy, true);
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                    if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                ?>
                 <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                    </div>
                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>)"></div>
                    </div>
                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                    </div>
                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                ?>
                <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                    <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>)"></div>
                </div>
                <?php }else{
                    ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                    </div>
                    <?php }
                } else {
                ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default.jpg)"></div>
                    </div>
                <?php
                }
            ?>
        </div>
        <!-- Profile details -->
        <div class="profile-details">
            <h2 class="heading heading-3 strong-500 profile-name"><?=$get_member[0]->first_name." ".$get_member[0]->last_name?></h2>
            <?php
            	$education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
            	$education_and_career_data = json_decode($education_and_career, true);
            ?>
            <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=$this->Crud_model->get_type_name_by_id('occupation', $education_and_career_data[0]['occupation'], 'name');?></h3>

        </div>
        <!-- Profile connect -->
        <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'no'){ ?>
        <div class="profile-connect mt-2">
            <div class="row">
                <div class="col-sm-12 size-sm">
                    <?php
                        $interests = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'interest');
                        $interest = json_decode($interests, true);
                        if (!empty($this->session->userdata('member_id'))) {
                            if (in_assoc_array($get_member[0]->member_id, 'id', $interest)) {
                                $interest_onclick = 0;
                                $interest_text = translate('interest_expressed');
                                $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                            }
                            else {
                                $interest_onclick = 1;
                                $interest_text = translate('express_interest');
                                $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                            }
                        }
                        else {
                            $interest_onclick = 1;
                            $interest_text = translate('express_interest');
                            $interest_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                    ?>
                    <a class="<?=$interest_class?>" id="interest_a_<?=$get_member[0]->member_id?>" <?php if ($interest_onclick == 1){?>onclick="return confirm_interest(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <span id="interest_text">
                            <i class="fa fa-heart"></i> <?=$interest_text?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 pr-1 size-smtr">
                    <?php
                        $shortlists = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'short_list');
                        $shortlist = json_decode($shortlists, true);
                        if (!empty($this->session->userdata('member_id'))) {
                            if (in_array($get_member[0]->member_id, $shortlist)) {
                                $shortlist_onclick = 0;
                                $shortlist_text = translate('shortlisted');
                                $shortlist_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                            }
                            else {
                                $shortlist_onclick = 1;
                                $shortlist_text = translate('shortlist');
                                $shortlist_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                            }
                        }
                        else {
                            $shortlist_onclick = 1;
                            $shortlist_text = translate('shortlist');
                            $shortlist_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                    ?>
                    <a class="<?=$shortlist_class?>" id="shortlist_a_<?=$get_member[0]->member_id?>"
                        <?php
                            if ($shortlist_onclick == 1){?>onclick="return do_shortlist(<?=$get_member[0]->member_id?>)"<?php }
                            elseif ($shortlist_onclick == 0){?>onclick="return remove_shortlist(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <span id="shortlist_text">
                            <i class="fa fa-list-ul"></i> <?=$shortlist_text?>
                        </span>
                    </a>
                </div>
                <div class="col-sm-6 pl-1 size-smtl">
                    <?php
                        $followed = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'followed');
                        $follow = json_decode($followed, true);
                        if (!empty($this->session->userdata('member_id'))) {
                            if (in_array($get_member[0]->member_id, $follow)) {
                                $followed_onclick = 0;
                                $followed_text = translate('unfollow');
                                $followed_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                            }
                            else {
                                $followed_onclick = 1;
                                $followed_text = translate('follow');
                                $followed_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                            }
                        }
                        else {
                            $followed_onclick = 1;
                            $followed_text = translate('follow');
                            $followed_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                    ?>
                    <a class="<?=$followed_class?>" id="followed_a_<?=$get_member[0]->member_id?>"
                        <?php
                            if ($followed_onclick == 1){?>onclick="return do_follow(<?=$get_member[0]->member_id?>)"<?php }
                            elseif ($followed_onclick == 0){?>onclick="return do_unfollow(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <span id="followed_text">
                            <i class="fa fa-star"></i> <?=$followed_text?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6 pr-1 size-smr">
                    <?php
                        $if_message = $this->db->get_where('message_thread', array('message_thread_from' => $get_member[0]->member_id, 'message_thread_to' => $this->session->userdata('member_id')))->row();
                        if (!$if_message) {
                            $if_message = $this->db->get_where('message_thread', array('message_thread_from' => $this->session->userdata('member_id'), 'message_thread_to' => $get_member[0]->member_id))->row();
                        }

                        if ($if_message) {
                            $message_onclick = 0;
                            $message_text = translate('messaging_enabled');
                            $message_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                        }
                        else {
                            $message_onclick = 1;
                            $message_text = translate('enable_messaging');
                            $message_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                    ?>
                    <a class="<?=$message_class?>" id="message_a_<?=$get_member[0]->member_id?>" <?php if ($message_onclick == 1){?>onclick="return confirm_message(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <i class="fa fa-comments-o"></i> <?=$message_text?>
                    </a>
                </div>
                <div class="col-sm-6 pl-1 size-sml">
                    <a class="btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom" id="ignore_a_<?=$get_member[0]->member_id?>" onclick="return confirm_ignore(<?=$get_member[0]->member_id?>)"><i class="fa fa-ban"></i> <?=translate('ignore')?></a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6 pr-1 size-smr">
                    <?php
                        $report = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'report_profile');
                        $report = json_decode($report, true);
                        if (!empty($this->session->userdata('member_id')))
                        {
                            if (in_array($get_member[0]->member_id, $report))
                            {
                                $report_type = 0;
                                $report_text =  translate('profile_reported');
                                $report_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom li_active";
                            }
                            else
                            {
                                $report_type = 1;
                                $report_text =  translate('profile_report');
                                $report_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                            }
                        }
                        else
                        {
                            $report_type = 1;
                            $report_text =  translate('profile_report');
                            $report_class = "btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom";
                        }
                    ?>

                    <a class="<?=$report_class?>" id="report_a_<?=$get_member[0]->member_id?>"
                        <?php
                            if ($report_type == 1){?>onclick="return do_report(<?=$get_member[0]->member_id?>)"<?php }
                            elseif ($report_type == 0){?>onclick="return is_reported(<?=$get_member[0]->member_id?>)"<?php }?>>
                        <span id="report_text">
                            <i class="fa fa-odnoklassniki"></i> <?=$report_text?>
                        </span>
                    </a>
                </div>
                <div class="col-sm-6 pl-1 size-sml">
                    <a class="btn btn-styled btn-block btn-sm btn-white z-depth-2-bottom" target="_blank" href="<?=base_url()?>/home/printprofile/<?=$get_member[0]->member_id?>">Print Profile</a>
                </div>
            </div>
        </div>
    <?php } ?>
        <div class="profile-stats clearfix mt-2">
            <div class="stats-entry" style="width: 100%">
                <span class="stats-count" id="follower"><?=$get_member[0]->follower?></span>
                <span class="stats-label text-uppercase"><?php echo translate('followers');?></span>
            </div>
        </div>
        <!-- Profile stats -->
        <!--div class="profile-stats clearfix mt-2">
            <div class="stats-entry">
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('age');?></span>
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('mother_tongue');?></span>
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('religion');?></span>
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('caste_/_sect');?></span>
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('height');?></span>
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('location');?></span>
            </div>

            <div class="stats-entry">
                <span class="stats-label text-uppercase text-left pl-2"> <?=$calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"><?=$this->Crud_model->get_type_name_by_id('language', $language_data[0]['mother_tongue']);?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"><?=$this->Crud_model->get_type_name_by_id('religion', $spiritual_and_social_background_data[0]['religion']);?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2">
                    <?php
                        if($spiritual_and_social_background_data[0]['caste'] != null){
                            echo $this->db->get_where('caste', array('caste_id'=>$spiritual_and_social_background_data[0]['caste']))->row()->caste_name;
                        }
                    ?>
                    &nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"><?=$get_member[0]->height." ".translate('feet')?>&nbsp</span>
                <span class="stats-label text-uppercase text-left pl-2"><?php if($present_address_data[0]['country']){echo $this->Crud_model->get_type_name_by_id('state', $present_address_data[0]['state']).', '.$this->Crud_model->get_type_name_by_id('country', $present_address_data[0]['country']);}?>&nbsp</span>
            </div>
        </div-->
        <!-- Profile connected accounts -->
        <div class="profile-useful-links clearfix mb-5">
            <?php
                $get_gallery = $this->db->get_where("member", array("member_id" => $get_member[0]->member_id))->row()->gallery;
                $gallery_data = json_decode($get_gallery, true);
                if (!empty($gallery_data)) {
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
             $pic_privacy = $get_member[0]->pic_privacy;
                    $pic_privacy_data = json_decode($pic_privacy, true);
                    $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                    if($pic_privacy_data[0]['gallery_show']=='only_me'){
                ?>
                 <div class="container">
                    <div class="profile-details">
                        <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=translate('gallery')?></h3>
                    </div>
                    <div class="row ml-auto mr-auto">
                        <p class="pt-2 ml-auto mr-auto">
                            <span style="font-weight: 300;font-size: 0.75rem;color: #ffffffcc;">
                                <?=translate('you_are_not_allowed_to_view_the_gallery!')?>
                            </span>
                        </p>
                    </div>
                </div>
                <?php }elseif ($pic_privacy_data[0]['gallery_show']=='premium' and $is_premium==2) {
                ?>
                    <div class="container">
                        <div class="profile-details">
                            <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=translate('gallery')?></h3>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="light-gallery">
                                    <div class="row">
                                        <?php
                                            foreach ($gallery_data as $value) {
                                                if (file_exists('uploads/gallery_image/'.$value['image'])) {
                                                ?>
                                                    <div class="col-sm-4 mt-4">
                                                        <a target="_blank" href="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="item">
                                                            <img src="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="img-fluid rounded" style="height: 68px;">
                                                        </a>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-sm-4 mt-4">
                                                        <a target="_blank" href="<?=base_url()?>uploads/gallery_image/default_image.png" class="item">
                                                            <img src="<?=base_url()?>uploads/gallery_image/default_image.png" class="img-fluid rounded" style="height: 68px;">
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }elseif ($pic_privacy_data[0]['gallery_show']=='premium' and $is_premium==1) {
                ?>
                    <div class="container">
                            <div class="profile-details">
                                <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=translate('gallery')?></h3>
                            </div>
                            <div class="row ml-auto mr-auto">
                                <p class="pt-2 ml-auto mr-auto">
                                    <span style="font-weight: 300;font-size: 0.75rem;color: #ffffffcc;">
                                        <?=translate('you_are_not_allowed_to_view_the_gallery!')?>
                                    </span>
                                </p>
                            </div>
                        </div>
                <?php }elseif ($pic_privacy_data[0]['gallery_show']=='all') {
                ?>
                        <div class="container">
                            <div class="profile-details">
                                <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=translate('gallery')?></h3>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="light-gallery">
                                        <div class="row">
                                            <?php
                                                foreach ($gallery_data as $value) {
                                                    if (file_exists('uploads/gallery_image/'.$value['image'])) {
                                                    ?>
                                                        <div class="col-sm-4 mt-4">
                                                            <a target="_blank" href="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="item">
                                                                <img src="<?=base_url()?>uploads/gallery_image/<?=$value['image']?>" class="img-fluid rounded" style="height: 68px;">
                                                            </a>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-sm-4 mt-4">
                                                            <a target="_blank" href="<?=base_url()?>uploads/gallery_image/default_image.png" class="item">
                                                                <img src="<?=base_url()?>uploads/gallery_image/default_image.png" class="img-fluid rounded" style="height: 68px;">
                                                            </a>
                                                        </div>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<script>
    var isloggedin = "<?=$this->session->userdata('member_id')?>";
    var rem_interests = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'express_interest')?>");
    var rem_messages = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'direct_messages')?>");

    function confirm_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_your_interest_on_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            if (rem_interests <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ');?>"+rem_interests+" <?php echo translate('times');?></b><br><?php echo translate('please_buy_packages_from_the_premium_plans.');?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans');?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_express_interest');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s):');?> "+rem_interests+" <?php echo translate('times');?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('expressing_an_interest_will_cost_1_from_your_remaining_interests');?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_interest' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_interest("+id+")' style='width:25%'><?php echo translate('confirm');?></a>");
            }
        }
        return false;
    }

    function do_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#interest_a_"+id).addClass("li_active");
            $("#confirm_interest").removeAttr("onclick");
            $("#confirm_interest").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            $("#interest_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_interest/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#interest_text").html("<i class='fa fa-heart'></i> <?php echo translate('interest_expressed');?>");
                        $("#interest_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_expressed_an_interest_on_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function confirm_message(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_enable_messaging');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            if (rem_messages <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_direct_message(s):');?>"+rem_messages+" <?php echo translate('times');?></b><br><?php echo translate('please_buy_packages_from_the_premium_plans');?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans');?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_enable_messaging');?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_direct_message(s):');?>"+rem_messages+" <?php echo translate('times');?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('enable_messaging_will_cost_1_from_your_remaining_direct_messages');?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_message' class='btn btn-sm btn-base-1 btn-shadow' onclick='return enable_message("+id+")' style='width:25%'><?php echo translate('confirm');?></a>");
            }
        }
        return false;
    }

    function enable_message(id) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_enable_messaging');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#message_a_"+id).addClass("li_active");
            $("#confirm_message").removeAttr("onclick");
            $("#confirm_message").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            $("#message_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/enable_message/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#message_text").html("<i class='fa fa-comments-o'></i><?php echo translate('message_enabled');?>");
                        $("#message_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_enable_messaging_with_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function do_shortlist(id) {
        // alert(id);
        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#shortlist_a_"+id).addClass("li_active");
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('shortlisting');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_text").html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlisted');?>");
                        $("#shortlist_a_"+id).attr("onclick","return remove_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_shortlisted_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function remove_shortlist(id) {
        // alert(id);
        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('removing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/remove_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_text").html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlist');?>");
                        $("#shortlist_a_"+id).attr("onclick","return do_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#shortlist_a_"+id).removeClass("li_active");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_removed_this_member_from_shortlist!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    var follower = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'follower')?>");
    function do_follow(id) {
        // alert(id);

        if (isloggedin == "") {
            alert("Please Log in");
        }
        else {
            $("#followed_a_"+id).addClass("li_active");
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('following');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_follow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_text").html("<i class='fa fa-star'></i> <?php echo translate('unfollow');?>");
                        $("#followed_a_"+id).attr("onclick","return do_unfollow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_followed_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        follower = follower + 1;
                        $('#follower').html(follower);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function do_unfollow(id) {
        if (isloggedin == "") {
            alert("Please Log in");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('unfollowing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_unfollow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_text").html("<i class='fa fa-star'></i> <?php echo translate('follow');?>");
                        $("#followed_a_"+id).attr("onclick","return do_follow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#followed_a_"+id).removeClass("li_active");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_unfollowed_this_member!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        follower = follower - 1;
                        $('#follower').html(follower);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function confirm_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_ignore');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_ignore_this_member?');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='#' id='confirm_ignore' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_ignore("+id+")' style='width:25%'><?php echo translate('confirm');?></a>");
        }
        return false;
    }

    function do_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in');?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member');?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close');?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in');?></a>");
        }
        else {
            $("#confirm_ignore").removeAttr("onclick");
            $("#confirm_ignore").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_ignore/"+id,
                    cache: false,
                    success: function(response) {
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_ignored_this_member!');?>");
                        $('#success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        setTimeout(function() {
                            window.location.href = "<?=base_url()?>home/listing";
                        }, 2000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }

    function do_report(id) {
        // alert(id);

        if (isloggedin == "") {
            // $('#myModal').modal();
            alert("Please Log in");
        }
        else {
            $("#report_a_"+id).addClass("li_active");
            $("#report_a_"+id).removeAttr("onclick");
            $("#report_text").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('reporting');?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_report/"+id,
                    cache: false,
                    success: function(response) {
                        $("#report_text").html("<i class='fa fa-odnoklassniki'></i> <?php echo translate('reported');?>");
                        $("#report_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_reported_this_member!');?>");
                        $('#danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                        follower = follower + 1;
                        $('#follower').html(follower);
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
        return false;
    }
    function is_reported(id) {

            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('report_profile')?>");
            $("#modal_body").html("<p class='text-center'><span style='color:#DC0330;font-size:11px'>** <?php echo translate('you_already_reported_this_persion')?> **</span></p>");

        return false;
    }
</script>
<style>
    /* xs */
    .size-sm {
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .size-smtr {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: .50rem!important;
    }
    .size-smtl {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: .50rem!important;
    }
    .size-smr {
        padding-left: 0px !important;
        padding-right: 0px !important;
        padding-top: 0px !important;
    }
    .size-sml {
            padding-left: 0px !important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
    /* sm */
    @media (min-width: 768px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
    /* md */
    @media (min-width: 992px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
    /* lg */
    @media (min-width: 1200px) {
        .size-sm {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .size-smtr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: .50rem!important;
        }
        .size-smtl {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: .50rem!important;
        }
        .size-smr {
            padding-left: 0px !important;
            padding-right: .25rem!important;
            padding-top: 0px !important;
        }
        .size-sml {
            padding-left: .25rem!important;
            padding-right: 0px !important;
            padding-top: 0px !important;
        }
    }
</style>
