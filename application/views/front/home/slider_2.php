<?php
    $home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;

    $slider_image = json_decode($home_slider_image, true);
?>
<div class="col-lg-9">
    <div class="swiper-js-container background-image-holder">
        <div class="swiper-container" data-swiper-autoplay="true" data-swiper-effect="coverflow" data-swiper-items="1" data-swiper-space-between="0">
            <div class="swiper-wrapper">
                <!-- Slide -->
                <?php foreach ($slider_image as $image): ?>
                    <div class="swiper-slide" data-swiper-autoplay="10000">
                        <div class="slice px-3 holder-item holder-item-light has-bg-cover bg-size-cover same-height" data-same-height="#div_properties_search" style="background-size: cover;background-position: center;background-image: url(<?php echo base_url()?>uploads/home_page/slider_image/<?php echo $image['img']?>); background-position: bottom bottom;">
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
</div>