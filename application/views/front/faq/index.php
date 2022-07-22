<section class="slice sct-color-1">
    <div class="container">
        <div class="section-title section-title--style-1 text-center mb-4">
            <h3 class="section-title-inner heading-1 strong-300 text-normal">
                <?php echo translate('frequently_asked_questions')?>
            </h3>
            <span class="section-title-delimiter clearfix d-none"></span>
        </div>

        <span class="clearfix"></span>

        <div class="paragraph paragraph-sm c-gray-light strong-300 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- Collapse - Style 4 -->
                    <div class="accordion accordion--style-4" id="collapseFive">
                    <?php
                        $faqs = json_decode($this->db->get_where('general_settings', array('type' => 'faqs'))->row()->value, true);
                        if (!empty($faqs)) {
                            $i = 1;
                            foreach ($faqs as $faq) {
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <a class="accordion-toggle <?php if($i>1){?>collapsed<?php }?>" data-toggle="collapse" data-parent="#collapseFive" href="#collapseFive-<?=$i?>" <?php if($i==1){?> aria-hidden="false" aria-expanded="true" <?php }else{?> aria-expanded="false" <?php }?>>
                                                <span class="collapse-heading-icon">
                                                    <i class="fa"><?=$i?></i>
                                                </span>
                                                <?=$faq['question']?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive-<?=$i?>" class="panel-collapse collapse <?php if($i==1){?>show<?php }?>" style="border: 1px solid #e0eded">
                                        <div class="card-body">
                                            <?=$faq['answer']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            <?php
                                $i++;
                            }
                        } else {
                        ?>
                            <div class='text-center pt-5 pb-5'><i class='fa fa-exclamation-triangle fa-5x'></i><h5><?=translate('no_FAQ_posted_yet!')?></h5></div>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>