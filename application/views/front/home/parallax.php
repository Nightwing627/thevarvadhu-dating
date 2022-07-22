<?php
    $home_parallax_image = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_image'))->row()->value;
    $home_parallax_text = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_text'))->row()->value;

    $parallax_image = json_decode($home_parallax_image, true);
?>
<section class="slice--offset parallax-section parallax-section-lg" style="background-image: url(<?php echo base_url()?>uploads/home_page/parallax_image/<?php echo $parallax_image[0]['image']?>);">
    <span class="mask mask-dark--style-2"></span>
    <div class="container">
        <div class="row py-3 justify-content-center">
            <div class="col-lg-8 col-md-8 text-center">
                <h1 class="heading heading-inverse heading-1 strong-400 text-normal">
                <?php echo $this->system_name?> </h1>
                <span class="clearfix"></span>
                <div class="fluid-paragraph fluid-paragraph-sm mt-3 mb-3 c-white">
                    <?php echo $home_parallax_text?>
                </div>
                <div class="btn-container mt-5">
                    <?php if ($this->session->userdata('member_id')) { ?>
                        <a href="<?php echo base_url()?>home/profile" class="btn btn-styled btn-base-1 z-depth-2-bottom"><?php echo translate('go_to_profile')?></a>
                    <?php } else {?>
                        <a href="<?php echo base_url()?>home/registration" class="btn btn-styled btn-md btn-base-1 z-depth-2-bottom"><?php echo translate('register_now')?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>