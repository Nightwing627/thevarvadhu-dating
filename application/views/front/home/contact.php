<?php
    $home_contact_info_text = $this->db->get_where('frontend_settings', array('type' => 'home_contact_info_text'))->row()->value;
    $home_contact_phone = $this->db->get_where('general_settings', array('type' => 'phone'))->row()->value;
    $home_contact_address = $this->db->get_where('general_settings', array('type' => 'address'))->row()->value;

?>
<section class="slice bg-base-2 no-padding">
    <div class="container">
        <div class="container-inner sct-color-1">
            <div class="block-card-wrapper">
                <div class="block-card-section">
                    <div class="" id="same_height_1">
                        <div class="row">
                            <div class="col-lg-6 no-padding">
                                <div class="same-height bg-base-2" data-same-height="#same_height_1">
                                    <center>
                                        <div class="sct-inner px-4 py-4">
                                            <h3 class="heading heading-5 strong-400">
                                            <?php echo translate('contact_information ')?></h3>
                                            <p class="mt-3 mb-3">
                                                <?php echo $home_contact_info_text?>
                                            </p>
                                            <div class="icon-block--style-3 mb-1 mt-5">
                                                <i class="icon ion-ios-telephone bg-base-4"></i>
                                                <!--<span class="heading heading-6 strong-400">
                                                <?php echo $home_contact_phone?> </span>-->
                                                <span class="heading heading-6 strong-400">
                                                 +91 78911 01107 </span>
                                            </div>
                                            <div class="icon-block--style-3 mb-3">
                                                <i class="icon ion-ios-email bg-base-4"></i>
                                                <!--<span class="heading heading-6 strong-400">
                                                <?php echo $this->system_email?> </span>-->
                                                <i class="icon ion-ios-email bg-base-4"></i>
                                                <span class="heading heading-6 strong-400">
                                                support@thevarvadhu.com </span>
                                            </div>
                                            <div class="icon-block--style-3">
                                                <i class="icon ion-ios-location bg-base-4"></i>
                                                <span class="heading heading-6 strong-400">
                                                <?php echo $home_contact_address?> </span>
                                            </div>
                                            <span class="clearfix"></span>
                                            <a href="<?php echo base_url()?>home/contact_us" class="btn btn-styled btn-block btn-base-1 btn-outline btn-circle mt-5 z-depth-2-bottom" style="width: 40%;color: #FFF!important">
                                            <?php echo translate('contact_us')?></a>
                                            <span class="clearfix"></span>
                                            <div class="text-center">
                                                <ul class="social-media social-media--style-1-v4 mt-4">
                                                    <?php
                                                        $social_links = $this->db->get('social_links')->result();
                                                        foreach ($social_links as $social_link): ?>
                                                            <?php if ($social_link->value != ''): ?>
                                                                <li>
                                                                    <a href="<?php echo $social_link->value?>" class="<?php echo $social_link->type?>" target="_blank" title="<?php echo translate($social_link->type)?>">
                                                                        <i class="<?php echo $social_link->icon?>"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endif ?>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Contact form -->
                                <form class="form-default" role="form" method="POST" action="<?php echo base_url()?>home/contact_us/send">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <label for="" class="text-uppercase c-gray-light"><?php echo translate('your_name')?></label>
                                                <input type="text" name="name" class="form-control form-control-md" required="" value="<?php if(!empty($form_contents)){echo $form_contents['name'];}?>">
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="" class="text-uppercase c-gray-light"><?php echo translate('email_address')?></label>
                                                <input type="email" name="email" class="form-control form-control-md" required="" value="<?php if(!empty($form_contents)){echo $form_contents['email'];}?>">
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-feedback">
                                                <label for="" class="text-uppercase c-gray-light"><?php echo translate('subject')?></label>
                                                <input type="text" name="subject" class="form-control form-control-md" required="" value="<?php if(!empty($form_contents)){echo $form_contents['subject'];}?>">
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <label for="" class="text-uppercase c-gray-light"><?php echo translate('message')?> <small class="text-danger sml_txt" style="text-transform: none;"><?php echo '('.translate('max_300_characters').')'?></small></label>
                                                <textarea name="message" class="form-control no-resize" rows="5" required="" maxlength="300"><?php if(!empty($form_contents)){echo $form_contents['message'];}?></textarea>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if($this->Crud_model->get_settings_value('third_party_settings','captcha_status','value') == 'ok') {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo $recaptcha_html?>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="mt-2 col-12">
                                        <?php if (!empty($captcha_incorrect) && $captcha_incorrect == TRUE): ?>
                                            <p class="text-danger"><?php echo translate('captcha_incorrect')?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-styled btn-base-1 mt-4"><?php echo translate('send_message')?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="max-width:100%">
		<iframe style="width:100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7110.342296643133!2d75.76782217529804!3d26.993135282372016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db38bfb061ef3%3A0xe19ce734a7b10b26!2sthe%20varvadhu!5e0!3m2!1sen!2sin!4v1595499468169!5m2!1sen!2sin"  height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</section>