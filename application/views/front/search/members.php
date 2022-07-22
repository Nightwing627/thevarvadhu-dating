<style>
<?php
    if (empty($get_all_members) || count($get_all_members)<2)
    {
?>
    .block-wrapper {
        display: block;
        flex-wrap: wrap;
    }
<?php
    }
    else
    {
?>
    .block-wrapper {
        display: inline-flex;
        flex-wrap: wrap;
    }
<?php
    }
?>    
    .block-wrapper .list{
        width: 49%;
        margin: 5px;
    }
    @media (max-width:768px) {
        .block-wrapper {
            display:block;
        }
        .block-wrapper .list {
            width:100%;
        }
    }
</style>

<?php
if (empty($get_all_members)) {
    ?>
        <div class='text-center pt-5 pb-5'><i class='fa fa-exclamation-triangle fa-5x'></i><h5><?=translate('no_result_found!')?></h5></div>
    <?php
}
foreach ($get_all_members as $member): ?>
    <?php
        $image = json_decode($member->profile_image, true);
    ?>
    <div class="block block--style-3 list z-depth-1-top" id="block_<?=$member->member_id?>">
        <div class="block-image" style="width:150px;margin: auto;vertical-align: middle;">
            <a onclick="return goto_profile(<?=$member->member_id?>)">
                <?php
                    $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                    $profile_image_status = $member->profile_image_status;
                    $pic_show_status = 'ok';
                    if ($profile_pic_approval == 'on') {
                        if($profile_image_status == 1){
                            $pic_show_status = 'ok';
                        }
                        else{
                            $pic_show_status = 'no';
                        }
                    }
                    if (file_exists('uploads/profile_image/'.$image[0]['profile_image']) && $pic_show_status == 'ok') {
                    ?>
                    <?php
                        $pic_privacy = $member->pic_privacy;
                        $pic_privacy_data = json_decode($pic_privacy, true);
                        $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');

                        if($pic_privacy_data[0]['profile_pic_show']=='only_me') {?>
                            <!--div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.png"></div-->
                            <img src="<?=base_url()?>uploads/profile_image/default_image.png">
                        <?php
                        }
                        elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                        ?>
                            <!-- <div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['profile_image']?>)"></div> -->
                            <img src="<?=base_url()?>uploads/profile_image/<?=$image[0]['profile_image']?>">
                        <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                        ?>
                            <!-- <div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.png"></div> -->
                            <img src="<?=base_url()?>uploads/profile_image/default_image.png">
                        <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                        ?>
                        <!-- <div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$image[0]['profile_image']?>)"></div> -->
                        <img src="<?=base_url()?>uploads/profile_image/<?=$image[0]['profile_image']?>">
                    <?php }else{ ?>
                        <!-- <div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.png"></div> -->
                        <img src="<?=base_url()?>uploads/profile_image/default_image.png">
                    <?php }
                    }
                    else {
                    ?>
                        <!-- <div class="listing-image" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.png"></div> -->
                        <img src="<?=base_url()?>uploads/profile_image/default_image.png">
                    <?php
                    }
                    ?>
                </a>
        </div>
        <?php
            $basic_info = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'basic_info');
            $basic_info_data = json_decode($basic_info, true);

            $education_and_career = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'education_and_career');
            $education_and_career_data = json_decode($education_and_career, true);

            $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'physical_attributes');
            $physical_attributes_data = json_decode($physical_attributes, true);

            $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'spiritual_and_social_background');
            $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

            $language = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'language');
            $language_data = json_decode($language, true);

            $present_address = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'present_address');
            $present_address_data = json_decode($present_address, true);
            // $calculated_age = (date('Y') - date('Y', $member->date_of_birth));

                $bday = new DateTime(date('d.m.Y', $member->date_of_birth));
                $today = new Datetime(date('d.m.Y'));
                $diff = $today->diff($bday);

        ?>
        <div class="block-title-wrapper">
            <?php if ($member->membership == 2): ?>
                <a class="badge-corner badge-corner-red">
                    <span style="-ms-transform: rotate(45deg);/* IE 9 */-webkit-transform: rotate(45deg);/* Chrome, Safari, Opera */transform: rotate(45deg);font-size: 10px;margin-left: -14px;">
                        <?=translate('premium')?>
                    </span>
                </a>
            <?php endif ?>
            <h3 class="heading heading-5 strong-500 <?php if($member->membership == 1){echo 'mt-4';} else {echo'mt-1';}?>">
                <a onclick="return goto_profile(<?=$member->member_id?>)" class="c-base-1"><?=$member->first_name." ".$member->last_name?></a>
            </h3>
            <h4 class="heading heading-xs c-gray-light text-uppercase strong-400">
                <?=$this->Crud_model->get_type_name_by_id('occupation', $member->occupation)?>
            </h4>
            <table class="table-striped table-bordered mb-2" style="font-size: 12px;">
                <tr>
                    <td height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('Member ID')?></b></td>
                    <td height="30" style="padding-left: 5px;" class="font-dark" colspan="3"><a onclick="return goto_profile(<?=$member->member_id?>)" class="c-base-1"><b><?=$member->member_profile_id?></b></a></td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('age')?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><?php printf($diff->y); ?></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('height')?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark">
                        <?=$this->Crud_model->get_new_type_name_by_id('user_height', $member->p_height, 'display')?>
                    </td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('religion')?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark">
                        <?php echo $this->Crud_model->get_type_name_by_id('religion', $basic_info_data[0]['religion']);?>
                    </td>
                    <td width="120" height="30" style="padding-left: 5px;"><b><?php echo "Caste";?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark">
                        <?php
                            echo $this->Crud_model->get_type_name_by_id('caste', $basic_info_data[0]['caste']);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('mother_tongue')?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark">
                        <?=$this->Crud_model->get_new_type_name_by_id('mother_tounge', $member->mother_tounge,'display');?>
                    </td>
                    <td width="120" height="30" style="padding-left: 5px;"><b><?php echo translate('marital_status')?></b></td>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><?=$this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?></td>
                </tr>
                <tr>
                    <td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b><?php echo translate('location')?></b></td>
                    <td colspan="3" height="30" style="padding-left: 5px;" class="font-dark"><?php if($present_address_data[0]['country']){echo $this->Crud_model->get_type_name_by_id('state', $present_address_data[0]['state']).', '.$this->Crud_model->get_type_name_by_id('country', $present_address_data[0]['country']);}?></td>
                </tr>
            </table>
        </div>
        <div class="block-footer b-xs-top">
            <div class="row align-items-center">
                <div class="col-sm-12 text-center">
                    <ul class="inline-links inline-links--style-3">
                        <li class="listing-hover">
                            <a onclick="return goto_profile(<?=$member->member_id?>)">
                                <i class="fa fa-id-card"></i><?php echo translate('full_profile')?>
                            </a>
                        </li>
                        <?php
                        if($this->session->userdata('member_id') !=null && $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes')
                        { echo " "; }
                        else{ ?>
                            <li class="listing-hover">
                                <?php
                                    $interests = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'interest');
                                    $interest = json_decode($interests, true);
                                    if (!empty($this->session->userdata('member_id'))) {
                                        if (in_assoc_array($member->member_id, 'id', $interest)) {
                                            $interest_onclick = 0;
                                            $interest_text = translate('interest_expressed');
                                            $interest_class = "c-base-1";
                                            $interest_style = "";
                                        }
                                        else {
                                            $interest_onclick = 1;
                                            $interest_text = translate('express_interest');
                                            $interest_class = "";
                                            $interest_style = "";
                                        }
                                    }
                                    else {
                                        $interest_onclick = 1;
                                        $interest_text = translate('express_interest');
                                        $interest_class = "";
                                        $interest_style = "";
                                    }
                                ?>
                                <a id="interest_a_<?=$member->member_id?>" <?php if ($interest_onclick == 1){?>onclick="return confirm_interest(<?=$member->member_id?>)"<?php }?> style="<?=$interest_style?>">
                                    <span id="interest_<?=$member->member_id?>" class="<?=$interest_class?>">
                                       <i class="fa fa-heart"></i> <?=$interest_text?>
                                    </span>
                                </a>
                            </li>
                            <li class="listing-hover">
                                <?php
                                    $shortlists = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'short_list');
                                    $shortlist = json_decode($shortlists, true);
                                    if (!empty($this->session->userdata('member_id')))
                                    {
                                        if (in_array($member->member_id, $shortlist))
                                        {
                                            $shortlist_onclick = 0;
                                            $shortlist_text =  translate('shortlisted');
                                            $shortlist_class = "c-base-1";
                                            $shortlist_style = "";
                                        }
                                        else
                                        {
                                            $shortlist_onclick = 1;
                                            $shortlist_text =  translate('shortlist');
                                            $shortlist_class = "";
                                            $shortlist_style = "";
                                        }
                                    }
                                    else
                                    {
                                        $shortlist_onclick = 1;
                                        $shortlist_text =  translate('shortlist');
                                        $shortlist_class = "";
                                        $shortlist_style = "";
                                    }
                                ?>
                                <a id="shortlist_a_<?=$member->member_id?>"
                                    <?php
                                        if ($shortlist_onclick == 1){?>onclick="return do_shortlist(<?=$member->member_id?>)"<?php }
                                        elseif ($shortlist_onclick == 0) {?>onclick="return remove_shortlist(<?=$member->member_id?>)"<?php }?> style="<?=$shortlist_style?>">
                                    <span id="shortlist_<?=$member->member_id?>" class="<?=$shortlist_class?>">
                                       <i class="fa fa-list-ul"></i> <?=$shortlist_text?>
                                    </span>
                                </a>
                            </li>
                            <li class="listing-hover">
                                <?php
                                    $followed = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'followed');
                                    $follow = json_decode($followed, true);
                                    if (!empty($this->session->userdata('member_id'))) {
                                        if (in_array($member->member_id, $follow)) {
                                            $followed_onclick = 0;
                                            $followed_text =  translate('unfollow');
                                            $followed_class = "c-base-1";
                                            $followed_style = "";
                                        }
                                        else {
                                            $followed_onclick = 1;
                                            $followed_text =  translate('follow');
                                            $followed_class = "";
                                            $followed_style = "";
                                        }
                                    }
                                    else {
                                        $followed_onclick = 1;
                                        $followed_text =  translate('follow');
                                        $followed_class = "";
                                        $followed_style = "";
                                    }
                                ?>
                                <a id="followed_a_<?=$member->member_id?>"
                                    <?php
                                        if ($followed_onclick == 1){?>onclick="return do_follow(<?=$member->member_id?>)"<?php }
                                        elseif ($followed_onclick == 0){?>onclick="return do_unfollow(<?=$member->member_id?>)"<?php }?> style="<?=$followed_style?>">
                                    <span id="followed_<?=$member->member_id?>" class="<?=$followed_class?>">
                                        <i class="fa fa-star"></i> <?=$followed_text?>
                                    </span>
                                </a>
                            </li>
                            <li class="listing-hover">
                                <a onclick="return confirm_ignore(<?=$member->member_id?>)">
                                    <i class="fa fa-ban"></i><?php echo translate('ignore')?>
                                </a>
                            </li>
                            <li class="listing-hover">
                                <a>
                                    <?php
                                        $report = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'report_profile');
                                        $report = json_decode($report, true);
                                        if (!empty($this->session->userdata('member_id')))
                                        {
                                            if (in_array($member->member_id, $report))
                                            {
                                                $report_type = 0;
                                                $report_text =  translate('profile_reported');
                                                $report_class = "c-base-1";
                                                $report_style = "";
                                            }
                                            else
                                            {
                                                $report_type = 1;
                                                $report_text =  translate('profile_report');
                                                $report_class = "";
                                                $report_style = "";
                                            }
                                        }
                                        else
                                        {
                                            $report_type = 1;
                                            $report_text =  translate('profile_report');
                                            $report_class = "";
                                            $report_style = "";
                                        }
                                    ?>
                                    <a id="report_a_<?=$member->member_id?>"
                                        <?php
                                            if ($report_type == 1){?>onclick="return do_report(<?=$member->member_id?>)"<?php }
                                            elseif ($report_type == 0) {?>onclick="return is_reported(<?=$member->member_id?>)"<?php }?> style="<?=$report_style?>">
                                        <span id="report_<?=$member->member_id?>" class="<?=$report_class?>">
                                           <i class="fa fa-odnoklassniki"></i> <?=$report_text?>
                                        </span>
                                    </a>

                                </a>
                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<div id="pseudo_pagination" style="display: none;">
    <?= $this->ajax_pagination->create_links();?>
</div>

<script type="text/javascript">
    $('#pagination').html($('#pseudo_pagination').html());
</script>

<script>
    var isloggedin = "<?=$this->session->userdata('member_id')?>";

    function goto_profile(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_view_full_profile_of_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            var rmCount = "<?=$this->session->userdata('view_profile')?>";
            if (rmCount == 0)
            {
                alert("please buy a package to view this profile");
                return;
            }
            window.open("<?=base_url()?>home/member_profile/"+id,'_blank');
            // window.location.href = "<?=base_url()?>home/member_profile/"+id;
        }
    }

    var rem_interests = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'express_interest')?>");
    function confirm_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            if (rem_interests <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages')?>");
                $("#modal_body").html("<p class='text-center'><b>Remaining Express Interest(s): "+rem_interests+" times</b><br><?php echo translate('please_buy_packages_from_the_premium_plans.')?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans')?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_express_interest')?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ')?>"+rem_interests+" <?php echo translate('times')?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('expressing_an_interest_will_cost_1_from_your_remaining_interests')?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='#' id='confirm_interest' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_interest("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
            }
        }
        return false;
    }

    function do_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_interest").removeAttr("onclick");
            $("#confirm_interest").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            $("#interest_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_interest/"+id,
                    cache: false,
                    success: function(response) {
                        rem_interests = rem_interests - 1;
                        $("#active_modal .close").click();
                        $("#interest_"+id).html("<i class='fa fa-heart'></i> <?php echo translate('interest_expressed')?>");
                        $("#interest_"+id).attr("class","c-base-1");
                        $("#interest_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_expressed_an_interest_on_this_member!')?>");
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
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_shortlist_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('shortlisting')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_"+id).html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlisted')?>");
                        $("#shortlist_"+id).attr("class","c-base-1");
                        $("#shortlist_a_"+id).attr("onclick","return remove_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_shortlisted_this_member!')?>");
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
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_remove_this_member_from_shortlist')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#shortlist_a_"+id).removeAttr("onclick");
            $("#shortlist_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('removing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/remove_shortlist/"+id,
                    cache: false,
                    success: function(response) {
                        $("#shortlist_"+id).html("<i class='fa fa-list-ul'></i> <?php echo translate('shortlist')?>");
                        $("#shortlist_"+id).attr("class","");
                        $("#shortlist_a_"+id).attr("onclick","return do_shortlist("+id+")");
                        $("#shortlist_a_"+id).css("cssText", "");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_removed_this_member_from_shortlist!')?>");
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

    function do_follow(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_follow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('following')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_follow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_"+id).html("<i class='fa fa-star'></i> <?php echo translate('unfollow')?>");
                        $("#followed_"+id).attr("class","c-base-1");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#followed_a_"+id).attr("onclick","return do_unfollow("+id+")");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_followed_this_member!')?>");
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

    function do_unfollow(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_unfollow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#followed_a_"+id).removeAttr("onclick");
            $("#followed_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('unfollowing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_unfollow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#followed_"+id).html("<i class='fa fa-star'></i> <?php echo translate('follow')?>");
                        $("#followed_"+id).attr("class","");
                        $("#followed_a_"+id).attr("onclick","return do_follow("+id+")");
                        $("#followed_a_"+id).css("cssText", "");
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_unfollowed_this_member!')?>");
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

    function confirm_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_ignore')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_ignore_this_member?')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='#' id='confirm_ignore' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_ignore("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
        }
        return false;
    }

    function do_ignore(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_ignore_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_ignore").removeAttr("onclick");
            $("#confirm_ignore").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_ignore/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#block_"+id).hide();
                        $("#danger_alert").show();
                        $(".alert-danger").html("<?php echo translate('you_have_ignored_this_member!')?>");
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

    function do_report(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_report_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#report_a_"+id).removeAttr("onclick");
            $("#report_"+id).html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('reporting')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_report/"+id,
                    cache: false,
                    success: function(response) {
                        $("#report_"+id).html("<i class='fa fa-odnoklassniki'></i> <?php echo translate('reported')?>");
                        $("#report_"+id).attr("class","c-base-1");
                        $("#report_a_"+id).attr("onclick","return remove_shortlist("+id+")");
                        $("#report_a_"+id).css("cssText", "");
                        $("#success_alert").show();
                        $(".alert-success").html("<?php echo translate('you_have_reported_this_member!')?>");
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
    function is_reported(id) {

            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('report_profile')?>");
            $("#modal_body").html("<p class='text-center'><span style='color:#DC0330;font-size:11px'>** <?php echo translate('you_already_reported_this_persion')?> **</span></p>");

        return false;
    }
</script>
