<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css" type="text/css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"> -->

<style>
    label.cabinet{
        display: block;
        cursor: pointer;
    }

    label.cabinet input.file{
        position: relative;
        height: 100%;
        width: auto;
        opacity: 0;
        -moz-opacity: 0;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        margin-top:-30px;
    }

    #upload-demo{
        width: 250px;
        height: 250px;
        padding-bottom:25px;
        margin: auto;
    }


</style>

<div class="sidebar sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top">
    <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
        <a class="badge-corner badge-corner-red" style="right: 15px;border-top: 90px solid  #DC0330;border-left: 90px solid transparent;">
            <span style="-ms-transform: rotate(45deg);/* IE 9 */-webkit-transform: rotate(45deg);/* Chrome, Safari, Opera */transform: rotate(45deg);font-size: 14px;margin-left: -24px;margin-top: -16px;"><?=translate('closed')?></span>
        </a>
    <?php }?>
    <div class="sidebar-object mb-0">
        <!-- Profile picture -->
        <div class="profile-picture profile-picture--style-2">
            <?php
                $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                $profile_image_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'profile_image_status');
                $profile_image = $get_member[0]->profile_image;
                $images = json_decode($profile_image, true);
                if (file_exists('uploads/profile_image/'.$images[0]['thumb'])) { ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>)"></div>
                    </div>
                    <?php if($profile_pic_approval == 'on' && $profile_image_status == '0' || $profile_image_status == '2'){ ?>
                        <p class="text-center">
                            <?php
                            if($profile_image_status == '0'){
                                echo translate('pending');
                            } elseif ($profile_image_status == '2') {
                                echo translate('rejected');
                            }
                            ?>
                        </p>
                    <?php }?>
                <?php
                }
                else {
                ?>
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 30px;" class="mx-auto">
                        <div class="profile_img" id="show_img" style="background-image: url(<?=base_url()?>uploads/profile_image/default_image.jpg)"></div>
                    </div>
                <?php
                }
            ?>
            <div class="profile-connect mt-1 mb-0" id="save_button_section" style="display: none">
                <button type="button" class="btn btn-styled btn-xs btn-base-2" id="save_image" ><?php echo translate('save_image')?></button>
            </div>
            <label class="btn-aux" for="profile_image" style="cursor: pointer;">
                <i class="ion ion-edit"></i>
            </label>
            <input type="file" style="display: none;" id="profile_image" name="profile_image"/>
            <form action="<?=base_url()?>home/profile/update_image" method="POST" id="profile_image_form" enctype="multipart/form-data">
                <input type="hidden" id="profile_image_value" name="profile_image_value"/>
            </form>
            <!-- <a href="#" class="btn-aux">
                <i class="ion ion-edit"></i>
            </a> -->
        </div>
        <!-- Profile details -->
        <div class="profile-details">
            <h2 class="heading heading-3 strong-500 profile-name"><?=$get_member[0]->first_name." ".$get_member[0]->last_name?></h2>
            <?php
                $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
                $education_and_career_data = json_decode($education_and_career, true);
            ?>
            <h3 class="heading heading-6 strong-400 profile-occupation mt-3"><?=$this->Crud_model->get_type_name_by_id('occupation', $education_and_career_data[0]['occupation'], 'name');?></h3>
           
            <?php
                $package_info = json_decode($get_member[0]->package_info, true);
            ?>
            <div class="profile-stats clearfix mt-2">
                <div class="stats-entry" style="width: 100%">
                    <span class="stats-count"><?=$get_member[0]->follower?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('followers')?></span>
                </div>
            </div>
            <!-- Profile connect -->
            <div class="profile-connect mt-5">
                <!-- <a href="#" class="btn btn-styled btn-block btn-circle btn-sm btn-base-5">Follow</a>
                <a href="#" class="btn btn-styled btn-block btn-circle btn-sm btn-base-2">Send message</a> -->
                <h2 class="heading heading-5 strong-400"><?php echo translate('package_informations')?></h2>
            </div>
            <div class="profile-stats clearfix mt-0">
                <div class="stats-entry">
                    <span class="stats-count"><?=$package_info[0]['current_package']?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('current_package')?></span>
                </div>
                <div class="stats-entry">
                    <span class="stats-count"><?=currency($package_info[0]['package_price'])?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('package_price')?></span>
                </div>
            </div>
            <div class="profile-stats clearfix mt-2">
                <div class="stats-entry">
                    <span class="stats-count"><?=$package_info[0]['payment_type']?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('payment_gateway')?></span>
                </div>
                <div class="stats-entry">
                    <span class="stats-count"><?=$get_member[0]->express_interest?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('remaining_interest')?></span>
                </div>
            </div>
            <div class="profile-stats clearfix mt-2">
                <div class="stats-entry">
                    <span class="stats-count"><?=$get_member[0]->direct_messages?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('remaining_message')?></span>
                </div>
                <div class="stats-entry">
                    <span class="stats-count"><?=$get_member[0]->photo_gallery?></span>
                    <span class="stats-label text-uppercase"><?php echo translate('photo_gallery')?></span>
                </div>
            </div>
            <div class="profile-stats clearfix mt-2">
                <div class="stats-entry">
                    <span class="stats-count"><?=$get_member[0]->rm_count?></span>
                    <span class="stats-label text-uppercase"><?php echo "Remaining Profile Views";?></span>
                </div>
                <div class="stats-entry">
                    
                </div>
            </div>
        </div>
        <!-- Profile stats -->
        <div class="profile-useful-links clearfix">
            <div class="useful-links">
				<a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 gallery l_nav" target="_blank" href="<?=base_url()?>/home/printprofile">
                    <b style="font-size: 12px"><?php echo "Print Profile"?></b>
                </a>
                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 gallery l_nav" onclick="profile_load('gallery','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('gallery')?></b>
                </a>

    				
    				    <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 gallery l_nav" onclick="ShowSearch()">
                            <b style="font-size: 12px"><?php echo translate('Search')?></b>
                        </a>
                        <div id="DivSearch" style="display: none; border-style: solid; border-color: blue;">
                            <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" href="<?=base_url('id-search')?>">
                                <b style="font-size: 12px"><?php echo 'ID Search'?></b>
                            </a>
                            <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" href="<?=base_url('basic-search')?>">
                                <b style="font-size: 12px"><?php echo "Basic Search"?></b>
                            </a>
                            <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" href="<?=base_url('education-search')?>">
                                <b style="font-size: 12px"><?php echo "Education Search"?></b>
                            </a>
                            <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" href="<?=base_url('location-search')?>">
                                <b style="font-size: 12px"><?php echo "Location Search"?></b>
                            </a>
                            <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" href="<?=base_url('advance-search')?>">
                                <b style="font-size: 12px"><?php echo translate('advance_search')?></b>
                            </a>
                        </div>
    					
  
                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 happy_story l_nav" onclick="profile_load('happy_story','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('happy_story')?></b>
                </a>
                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 my_packages l_nav" onclick="profile_load('my_packages','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('My_package')?></b>
                </a>
                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 payments l_nav" onclick="profile_load('payments','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('payment_informations')?></b>
                </a>
                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 picture_privacy l_nav" onclick="profile_load('picture_privacy','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('picture_privacy')?></b>
                </a>

                <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 change_pass l_nav" onclick="profile_load('change_pass','alt-sm')">
                    <b style="font-size: 12px"><?php echo translate('change_password')?></b>
                </a>
                
                 <a class="btn btn-styled btn-sm btn-white z-depth-2-bottom mb-3 change_pass l_nav" href="https://www.thevarvadhu.com/home/logout">
                    <b style="font-size: 12px"><?php echo translate('logout')?></b>
                    
                </a>

                <div class="text-center pt-3 pb-0">
                    <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
                        <a onclick="profile_load('reopen_account')">
                        <i class="fa fa-unlock"></i>
                        <?php echo translate('re-open_account?')?>
                    </a>
                    <?php }else{?>
                        <a onclick="profile_load('close_account')">
                            <i class="fa fa-lock"></i>
                            <?php echo translate('close_account')?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    var $uploadCrop,tempFilename,rawImg,imageId;
    var Display = "none";
    $("#profile_image").change(function () {
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // $("#show_img").css({
                //     "background-image" : "url("+ e.target.result +")"
                // });
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            $("#save_button_section").show();
        }
    }
    $( document ).ready(function() {
        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 150,
                height: 200,
            },
            enforceBoundary: false,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log('jQuery bind complete');
            });
        });

        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 150, height: 200}
            }).then(function (resp) {
                $("#show_img").css({
                    "background-image" : "url("+ resp +")"
                });
                $('#profile_image_value').val(resp);
                // $('#show_img').attr('src', resp);
                $('#cropImagePop').modal('hide');
            });
        });
    });
    $("#save_image").click(function(e) {
        e.preventDefault();
        // alert('asdas');
        $("#profile_image_form").submit();
    })
    function ShowSearch() {
        if (Display == "block"){
            Display = "none";
        }
        else
        {
            Display = "block";
        }
        document.getElementById("DivSearch").style.display = Display;
    }
</script>
