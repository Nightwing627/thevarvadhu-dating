<?php
    $home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;
    $home_searching_heading = $this->db->get_where('frontend_settings', array('type' => 'home_searching_heading'))->row()->value;

    $slider_image = json_decode($home_slider_image, true);

    // for slider dynamic margin
    $found = 0;
    if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value != "yes") { $found++; }
    if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value != "yes") { $found++; };
?>
<style>
    
    .s-search label {
        white-space: nowrap;
    }
    .outer-search {
        position: absolute; top: 45%; z-index: 1;<?php if ($found == 1) {?>margin-left: 40px;<?php } elseif ($found == 2) { ?> margin-left: 40px;<?php } else { ?> margin-left: 50px;<?php } ?>
    }
    .btn-search {
        border-radius: 3px !important;
    }
    @media (max-width: 576px) {
        .outer-search {
            top: auto !important; bottom: 0px; margin-left: 0px !important;
        }
        .btn-search {
            margin-top: 0px !important;
        }
    }
    @media (min-width: 567px) and (max-width: 991px) {
        .outer-search {
            position: absolute; top: auto !important; bottom: 0px !important; z-index: 1;<?php if ($found == 1) {?>margin-left: -25px !important;<?php } elseif ($found == 2) { ?> margin-left: 40px !important;<?php } else { ?> margin-left: -25px !important;<?php } ?>
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        .outer-search {
            position: absolute; top: 45% !important; z-index: 1;<?php if ($found == 1) {?>margin-left: 8.5% !important;<?php } elseif ($found == 2) { ?> margin-left: 15% !important;<?php } else { ?> margin-left: 1.5% !important;<?php } ?>
        }
    }
    @media (max-width: 1024px) {
        .s-search {
            margin-right: 30px;
        }
    }
    @media (max-width: 420px) {
        .s-search {
            margin-right: 15px;
        }
    }
</style>
<div class="col-lg-12">
    <div style="position: relative;">
        <div class="swiper-js-container background-image-holder">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-effect="coverflow" data-swiper-items="1" data-swiper-space-between="0">
                <div class="swiper-wrapper">
                    <!-- Slide -->
                    <?php foreach ($slider_image as $image): ?>
                        <div class="swiper-slide" data-swiper-autoplay="10000">
                            <div class="slice px-3 holder-item holder-item-light has-bg-cover bg-size-cover same-height" data-same-height="#div_properties_search" style="height: 650px; background-size: cover; background-position: center; background-image: url(<?php echo base_url()?>uploads/home_page/slider_image/<?php echo $image['img']?>); background-position: bottom bottom;">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button swiper-button-next">
                </div>
                <div class="swiper-button swiper-button-prev">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="outer-search">
                <h4 class="text-white text-center mb-4">
                    <span style="text-shadow: 4px 3px 6px #000;"><?php echo $home_searching_heading?></span>
                </h4>
                <div class="feature feature--boxed-border feature--bg-1 z-depth-2-bottom px-3 py-4 animated animation-ended s-search" data-animation-in="zoomIn" data-animation-delay="400" style="background: #1b1e23b3;">
                    <form class="mt-4" data-toggle="validator" role="form" action="<?php echo base_url()?>home/listing/home_search" method="POST" style="margin-top: 0px !important;">
                        <div class="row">
                            <?php if (!empty($this->session->userdata['member_id'])) { ?>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-6 ml-auto">
                                    <div class="form-group has-feedback">
                                        <label class="text-uppercase text-white">I'm Looking For A</label>
                                        <select name="gender" onChange="(this.value,this)" class="form-control form-control-sm selectpicker"   data-placeholder="Choose a gender" tabindex="2" data-hide-disabled="true" >
                                            <?php $member_gender = $this->db->get_where('member',array('member_id'=>$this->session->userdata['member_id']))->row()->gender; ?>
                                            <?php if($member_gender == '2') { ?>
                                                <option value="1" >Male</option>
                                            <?php } elseif ($member_gender == '1') { ?>
                                                <option value="2" >Female</option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>

                            <?php } else {?>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-6 ml-auto">
                                    <div class="form-group has-feedback">
                                        <label class="text-uppercase text-white"><?php echo translate("i'm_looking_for_a")?></label>
                                        <?php echo  $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                        <span class="help-block with-errors"></span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-lg-1 col-md-1 col-sm-3 col-3">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase text-white"><?php echo translate('aged_from')?></label>
                                    <input type="number" class="form-control form-control-sm" name="aged_from" id="aged_from" value="">
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-3 col-3">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase text-white"><?php echo translate('to')?></label>
                                    <input type="number" class="form-control form-control-sm" name="aged_to" id="aged_to" value="">
                                </div>
                                <div class="help-block with-errors">
                                </div>
                            </div>
                            
                            <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase text-white"><?php echo translate('religion')?></label>
                                    <?php echo  $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker s_religion', '', '', '', ''); ?>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase text-white"><?php echo translate('caste')?></label>
                                    <select  name="caste" class="form-control form-control-sm selectpicker s_caste">
                                        <option value=""><?php echo translate('choose_a_religion_first')?></option>
                                    </select>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase text-white"><?php echo translate('mother_tongue')?></label>
                                    <?php echo  $this->Crud_model->select_html('mother_tounge', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12 mr-auto">
                                <button type="submit" class="btn btn-styled btn-sm btn-block btn-base-1 btn-search" style="padding: 6.5px 5px !important;margin-top: 29px;"><?php echo translate('search')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
