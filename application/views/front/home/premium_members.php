<section class="slice sct-color-1">
    <div class="container">
        <div class="section-title section-title--style-1 text-center">
            <h3 class="section-title-inner">
            <span><?php echo translate('premium_members')?></span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>
        <span class="space-xs-xl"></span>
        <div class="swiper-js-container">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-items="4" data-swiper-space-between="20" data-swiper-md-items="3" data-swiper-md-space-between="20" data-swiper-sm-items="2" data-swiper-sm-space-between="20" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
                <div class="swiper-wrapper pb-5">
                    <?php foreach ($premium_members as $premium_member): ?>
                        <div class="swiper-slide" data-swiper-autoplay="2000">
                            <div class="block block--style-5">
                                <div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
                                    <div class="profile-picture profile-picture--style-2">
                                        <?php
                                            $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                                            $profile_image_status = $premium_member->profile_image_status;
                                            $pic_show_status = 'ok';
                                            if ($profile_pic_approval == 'on') {
                                                if($profile_image_status == 1){
                                                    $pic_show_status = 'ok';
                                                }
                                                else{
                                                    $pic_show_status = 'no';
                                                }
                                            }
                                            $image = json_decode($premium_member->profile_image, true);
                                            if (file_exists('uploads/profile_image/'.$image[0]['profile_image']) && $pic_show_status == 'ok') {
                                            ?>
                                            <?php
                                                $pic_privacy = $premium_member->pic_privacy;
                                                $pic_privacy_data = json_decode($pic_privacy, true);
                                                $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                                                if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                                                    if($premium_member->member_id != $this->session->userdata('member_id')){

                                            ?>
                                                <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php }else{ ?>
                                                <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/<?php echo $image[0]['profile_image']?>)">
                                                </div>
                                                <?php } }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==2) {
                                                ?>
                                                    <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/<?php echo $image[0]['profile_image']?>)"></div>
                                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                                                ?>
                                                    <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/default.jpg"></div>
                                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                                                ?>
                                                <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/<?php echo $image[0]['profile_image']?>)"></div>
                                            <?php }else{ ?>
                                                <div class="home_pm" style="background-image: url(<?php echo base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php }
                                            }
                                            else {
                                            ?>
                                                <div class="home_pm" style="background-image: url('<?php echo base_url()?>uploads/profile_image/default.jpg"></div>
                                            <?php
                                            }
                                        ?>
                                        <!-- <img src="<?php echo base_url()?>template/front/uploads/profile_image/"> -->
                                    </div>
                                    <div class="card-body text-center">
                                        <h3 class="heading heading-5 premium_heading"><?php echo $premium_member->first_name." ".$premium_member->last_name?></h3>
                                        <!-- <h3 class="heading heading-light heading-sm strong-300">CEO of Webpixels</h3> -->
                                        <div class="mt-2">
                                            <ul class="inline-links inline-links--style-2">
                                                <?php
                                                    $followers = $this->db->get_where('member', array('member_id' => $premium_member->member_id))->row()->follower;
                                                    $following_json = $this->db->get_where('member', array('member_id' => $premium_member->member_id))->row()->followed;
                                                    $following = json_decode($following_json, true);
                                                ?>
                                                <li>
                                                <span class="c-base-1 strong-500"><?php echo $followers?></span> <?php echo translate('follower(s)')?></li>
                                                <li>
                                                <span class="c-base-1 strong-500"><?php echo count($following)?></span> <?php echo translate('following')?></li>
                                            </ul>
                                        </div>
                                        <?php if($premium_member->member_id == $this->session->userdata('member_id')){ ?>
                                            <a href="<?php echo base_url()?>home/profile" class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white"><?php echo translate('full_profile')?></a>
                                        <?php } else { ?>
                                            <a class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white" onclick="return goto_profile(<?php echo $premium_member->member_id?>)"><?php echo translate('full_profile')?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var isloggedin = "<?php echo $this->session->userdata('member_id')?>";

    $(document).ready(function() {
        setTimeout(function() {
            set_premium_member_box_height();
        }, 1000);
    });

    function set_premium_member_box_height() {
        var max_title = 0;
        $('.swiper-slide .premium_heading').each(function() {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_title) {
                max_title = current_height;
            }
        });
        $('.swiper-slide .premium_heading').css('height', max_title);
    }

    function goto_profile(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_login')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_login_to_view_full_profile_of_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?php echo base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('login')?></a>");
        }
        else {
            var rmCount = "<?=$this->session->userdata('view_profile')?>";
            if (rmCount == 0)
            {
                alert("please buy a package to view this profile");
                return;
            }
            window.open("<?php echo base_url()?>home/member_profile/"+id,"_blank");
            // window.location.href = "<?php echo base_url()?>home/member_profile/"+id;
        }
    }
</script>
