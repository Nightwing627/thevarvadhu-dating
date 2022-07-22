<?php
    $i = 1;
    foreach ($get_all_stories as $value): ?>
        <?php 
            $images = json_decode($value->image, true);
        ?>
        <?php if ($i%2 != 0): ?>
            <section class="sct-color-2 <?php if($i == 1){echo 'b-xs-top';}?>">
                <div class="row row-no-padding align-items-center cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-6">
                        <?php
                        if (file_exists('uploads/happy_story_image/'.$images[0]['img'])) {
                        ?>
                            <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>"><img src="<?=base_url()?>uploads/happy_story_image/<?=$images[0]['img']?>" class="img-fluid img-center"></a>
                        <?php
                        }
                        else {
                        ?>
                            <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>"><img src="<?=base_url()?>uploads/happy_story_image/default_image.png" class="img-fluid img-center"></a>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-lg-6">
                        <div class="col-wrapper--text text-center text-lg-left">
                            <h3 class="heading heading-2 strong-500 text-normal">
                                <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>" class="c-base-1"><?=$value->title?></a>
                            </h3>
                            <span><i class="c-base-1 fa fa-clock-o"></i> <?= date_format(date_create($value->post_time),"d, F Y")?></span>
                            <p class="lead mt-4">
                                <?=substr($value->description,0 ,150).". . ."?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif ?>

        <?php if ($i%2 == 0): ?>
            <section class="sct-color-1">
                <div class="row row-no-padding align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <?php
                        if (file_exists('uploads/happy_story_image/'.$images[0]['img'])) {
                        ?>
                            <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>"><img src="<?=base_url()?>uploads/happy_story_image/<?=$images[0]['img']?>" class="img-fluid img-center"></a>
                        <?php
                        }
                        else {
                        ?>
                            <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>"><img src="<?=base_url()?>uploads/happy_story_image/default_image.png" class="img-fluid img-center"></a>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-lg-6 order-lg-1">
                        <div class="col-wrapper--text text-center text-lg-left">
                            <h3 class="heading heading-2 strong-500 text-normal">
                                <a href="<?=base_url()?>home/stories/story_detail/<?=$value->happy_story_id?>" class="c-base-1"><?=$value->title?></a>
                            </h3>
                            <span><i class="c-base-1 fa fa-clock-o"></i> <?= date_format(date_create($value->post_time),"d, F Y")?></span>
                            <p class="lead mt-4">
                                <?=substr($value->description,0 ,150).". . ."?>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif ?>
    
    <?php
    $i++;
    endforeach; 
?>
<div id="pseudo_pagination" style="display: none;">
    <?= $this->ajax_pagination->create_links();?>
</div>
<script type="text/javascript">
    $('#pagination').html($('#pseudo_pagination').html());
</script>