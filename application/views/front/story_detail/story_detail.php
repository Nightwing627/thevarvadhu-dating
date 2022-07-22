<?php
foreach ($get_story as $value)
{
?>
    <div class="mb-4">
        <h3 class="heading heading-2 strong-400 text-normal">
        <?=$value->title?> </h3>
        <ul class="inline-links inline-links--style-2 mt-1">
            <li>
                <i class="c-base-1 fa fa-clock-o"></i> <?= date_format(date_create($value->post_time),"d, F Y")?>
            </li>
            <li>
                <?=translate('by')?>
                <?php
                    if ($value->posted_by == $this->session->userdata('member_id')) {
                ?>
                    <a class="c-base-1" href="#"><?=translate('me')?></a>
                <?php
                    }
                    else {
                ?>
                    <a class="c-base-1" href="<?=base_url()?>home/member_profile/<?=$value->posted_by?>"><?= $this->Crud_model->get_type_name_by_id('member', $value->posted_by, 'first_name')." ". $this->Crud_model->get_type_name_by_id('member', $value->posted_by, 'last_name');?></a>
                <?php
                    }
                ?>
            </li>
            <!-- <li> 5 comments </li> -->
        </ul>
    </div>
    <?php
        $images = json_decode($value->image, true);
    ?>
    <section class="swiper-js-container background-image-holder swiper_custom" data-holder-type="fullscreen" data-holder-offset=".navbar">
        <div class="swiper-container swiper-container-horizontal swiper-container-fade" data-swiper-autoplay="true" data-swiper-effect="fade" data-swiper-items="1" data-swiper-space-between="0" data-swiper-sm-items="1" data-swiper-sm-space-between="0" data-swiper-xs-items="1" data-swiper-xs-space-between="0">
            <div class="swiper-wrapper" style="transition-duration: 0ms;">
                <!-- Slide -->
                <?php
                    $i = 0;
                    foreach ($images as $image): ?>
                        <div class="swiper-slide <?php if($i==0){echo 'swiper-slide-active';}?>" data-swiper-autoplay="5000" style="width: 1343px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                            <div class="slice holder-item holder-item-light has-bg-cover bg-size-cover" style="background-image: url('<?=base_url()?>uploads/happy_story_image/<?=$image['img']?>'); background-position: bottom bottom;">
                            </div>
                        </div>
                    <?php
                    $i++;
                    endforeach;
                ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
                <?php
                    $j = 0;
                    foreach ($images as $image): ?>
                        <span class="swiper-pagination-bullet <?php if($j==0){echo 'swiper-pagination-bullet-active';}?>"></span>
                    <?php
                    $j++;
                    endforeach;
                ?>
                <!-- <span class="swiper-pagination-bullet"></span> -->
            </div>

            <!-- Add Arrows -->
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev swiper-button-disabled"></div>
        </div>
    </section>

    <!-- <div class="block-image">
        <img src="<?=base_url()?>template/front/images/prv/blog/img-2.jpg" class="rounded">
    </div> -->
    <div class="block-body block-post-body mb-5">
        <p>
            <?=$value->description?>
        </p>
    </div>
    <?php
        $video_exist = $this->db->get_where("story_video",array("story_video_uploader_id" => $value->posted_by))->result();
        if ($video_exist) {
            $get_video = $this->db->get_where("story_video", array("story_video_uploader_id" => $value->posted_by))->result_array();
            foreach ($get_video as $video) {?>
                <div class="post-media text-center pt-1 pb-3">
                    <?php if($video['type'] == 'upload'){?>
                        <video controls height="450" width="80%">
                            <source src="<?php echo base_url();?><?php echo $video['video_src'];?>">
                        </video>
                    <?php }else{?>
                        <iframe controls="2" height="450" width="80%"
                            src="<?php echo $video['video_src'];?>" frameborder="0" >
                        </iframe>
                    <?php }?>
                </div>
            <?php
            }
        }
    ?>
<?php
}
?>
