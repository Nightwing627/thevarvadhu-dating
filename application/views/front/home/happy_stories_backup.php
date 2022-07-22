<section class="slice sct-color-1">
    <div class="container">
        <div class="section-title section-title--style-1 text-center">
            <h3 class="section-title-inner">
            <span><?php echo translate('happy_stories')?></span>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>
        <span class="space-xs-xl"></span>
        <div class="swiper-js-container">
            <div class="swiper-container" data-swiper-autoplay="true" data-swiper-items="4" data-swiper-space-between="20" data-swiper-md-items="3" data-swiper-md-space-between="20" data-swiper-sm-items="2" data-swiper-sm-space-between="20" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
                <div class="swiper-wrapper pb-5">

                    <?php foreach ($happy_stories as $happy_storie): ?>
                        <div class="swiper-slide z-depth-2-bottom" data-swiper-autoplay="2300">
                            <div class="card">
                                <div class="card-image">
                                    <?php
                                        $story_image = $happy_storie->image;
                                        $images = json_decode($story_image, true);
                                        if (file_exists('uploads/happy_story_image/'.$images[0]['thumb'])) {
                                        ?>
                                            <!-- <img src="<?php echo base_url()?>uploads/happy_story_image/<?php echo $images[0]['thumb']?>"> -->
                                            <div class="home_shory" style="background-image: url('<?php echo base_url()?>uploads/happy_story_image/<?php echo $images[0]['thumb']?>')"></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <!-- <img src="<?php echo base_url()?>uploads/happy_story_image/default_image.jpg"> -->
                                            <div class="home_shory" style="background-image: url('<?php echo base_url()?>uploads/happy_story_image/default_image.jpg')"></div>
                                        <?php
                                        }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <small><em><?php echo  date_format(date_create($happy_storie->post_time),"d, F Y")?> </em></small>
                                    <h3 class="heading heading-5 strong-500 story_heading">
                                    <a href="<?php echo base_url()?>home/stories/story_detail/<?php echo $happy_storie->happy_story_id?>" style="cursor: pointer !important;"><?php echo substr($happy_storie->title,0,23)?><?php if(strlen($happy_storie->title) > 23){echo '..';}?></a>
                                    </h3>
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
    $(document).ready(function() {
        setTimeout(function() {
            set_story_box_height();
        }, 1000);
    });

    function set_story_box_height() {
        var max_title = 0;
        $('.swiper-slide .story_heading').each(function() {
            var current_height = parseInt($(this).css('height'));
            if (current_height >= max_title) {
                max_title = current_height;
            }
        });
        $('.swiper-slide .story_heading').css('height', max_title);
    }
</script>