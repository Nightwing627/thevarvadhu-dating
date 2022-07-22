<section class="page-title page-title--style-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h2 class="heading heading-3 strong-400 mb-0"><?php echo translate('story_details')?></h2>
            </div>
        </div>
    </div>
</section>
<section class="slice--offset sct-color-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="block block-post">
					<?php 
                        include_once'story_detail.php';
					?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="block block-post">
                    <?php
                    foreach ($get_story as $story) 
                    {
                        if ($story->posted_by == $this->session->userdata('member_id')) {

                    ?>
                        <div id="share">
                            
                        </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="mt-3">
                        <?php 
                            include_once'comments.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#share').share({
            networks: ['facebook', 'googleplus', 'twitter', 'linkedin', 'tumblr', 'in1', 'stumbleupon', 'digg'],
            theme: 'square'
        });
    });
</script>