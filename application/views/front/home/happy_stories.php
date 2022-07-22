<section class="slice sct-color-1">
    <div class="container" style="max-width:100%">
        <img src="<?php echo base_url()?>uploads/home_page/parallax_image/image_3.png" alt="image" style="width:100%">
    </div>
    <div class="container" style="max-width:100%">
        <img src="<?php echo base_url()?>uploads/home_page/parallax_image/image_1.png" alt="image" style="width:100%">
    </div>
	<div class="container" style="max-width:100%">
        <img src="<?php echo base_url()?>uploads/home_page/parallax_image/image_2.png" alt="image" style="width:100%">
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