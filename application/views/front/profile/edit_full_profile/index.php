<script src="<?=base_url()?>template/front/js/jquery.inputmask.bundle.min.js"></script>
<?php include_once APPPATH.'views/front/profile/profile_nav.php';?>
<section class="slice sct-color-2">
    <div class="profile">
        <div class="container">
            <?php foreach ($get_member as $member): ?>
                <div class="row cols-md-space cols-sm-space cols-xs-space">
                    <div class="col-lg-4">
                        <?php include_once APPPATH.'views/front/profile/left_panel.php';?>
                    </div>
                    <div class="col-lg-8">
                        <?php
                            $basic_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'basic_info');
                            $basic_info_data = json_decode($basic_info, true);

                            $present_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'present_address');
                            $present_address_data = json_decode($present_address, true);

                            $family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
                            $family_info_data = json_decode($family_info, true);

                            $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
                            $education_and_career_data = json_decode($education_and_career, true);

                            $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
                            $physical_attributes_data = json_decode($physical_attributes, true);

                            $language = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'language');
                            $language_data = json_decode($language, true);

                            $hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'hobbies_and_interest');
                            $hobbies_and_interest_data = json_decode($hobbies_and_interest, true);

                            $personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'personal_attitude_and_behavior');
                            $personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);

                            $residency_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'residency_information');
                            $residency_information_data = json_decode($residency_information, true);

                            $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'spiritual_and_social_background');
                            $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

                            $life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
                            $life_style_data = json_decode($life_style, true);

                            $astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
                            $astronomic_information_data = json_decode($astronomic_information, true);

                            $astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
                            $astronomic_information_data = json_decode($astronomic_information, true);

                            $permanent_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'permanent_address');
                            $permanent_address_data = json_decode($permanent_address, true);

                            $additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'additional_personal_details');
                            $additional_personal_details_data = json_decode($additional_personal_details, true);

                            $u_manglik=$spiritual_and_social_background_data[0]['u_manglik'];

                            $partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
                            $partner_expectation_data = json_decode($partner_expectation, true);

                        ?>
                        <form id="edit_profile_form" class="form-default" role="form" action="<?=base_url()?>home/profile/update_all" method="POST">
                            <div class="widget">
                                <div class="card z-depth-2-top" id="profile_load">
                                    <?php if (!empty(validation_errors())): ?>
                                        <div class="widget" id="profile_error">
                                            <div style="border-bottom: 1px solid #e6e6e6;">
                                                <div class="card-title" style="padding: 0.5rem 1.5rem; color: #fcfcfc; background-color: #de1b1b; border-top-right-radius:0.25rem; border-top-left-radius:0.25rem;">You <b>Must Provide</b> the Information(s) bellow</div>
                                                <div class="card-body" style="padding: 0.5rem 1.5rem; background: rgba(222, 27, 27, 0.10);">
                                                    <style>
                                                        #profile_error p {
                                                            color: #DE1B1B !important; margin: 0px !important; font-size: 12px !important;
                                                        }
                                                    </style>
                                                    <?= validation_errors();?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    ?>
                                    <div class="card-title">
                                        <h3 class="heading heading-6 strong-500 pull-left">
                                            <b><?php echo translate('edit_profile_informations')?></b>
                                        </h3>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-base-1 btn-rounded btn-sm btn-shadow"><i class="ion-checkmark"></i> <?php echo translate('update')?></button>
                                            <a href="<?=base_url()?>home/profile" class="btn btn-danger btn-sm btn-shadow"><i class="ion-close"></i> <?php echo translate('cancel')?></a>
                                        </div>
                                    </div>
                                    <div class="card-body" style="padding: 1.5rem 0.5rem;">
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_introduction">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('introduction')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <textarea name="introduction" class="form-control no-resize" rows="6"><?php if(!empty($form_contents)){echo $form_contents['introduction'];} else{echo $member->introduction;}?></textarea>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_basic_info">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('basic_information')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('first_name')?></label>
                                                            <input type="text" class="form-control no-resize" name="first_name" value="<?php if(!empty($form_contents)){echo $form_contents['first_name'];} else{echo $member->first_name;}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="last_name" class="text-uppercase c-gray-light"><?php echo translate('last_name')?></label>
                                                            <input type="text" class="form-control no-resize" name="last_name" value="<?php if(!empty($form_contents)){echo $form_contents['last_name'];} else{echo $member->last_name;}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="gender" class="text-uppercase c-gray-light"><?php echo translate('gender')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['gender'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $member->gender, '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="email" class="text-uppercase c-gray-light"><?php echo translate('email')?></label>
                                                            <input type="hidden" name="old_email" value="<?=$member->email?>">
                                                            <input type="email" class="form-control no-resize" name="email" value="<?php if(!empty($form_contents)){echo $form_contents['email'];} else{echo $member->email;}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="date_of_birth" class="text-uppercase c-gray-light"><?php echo translate('date_of_birth')?></label>
                                                            <input type="date" class="form-control no-resize" name="date_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];} else{echo date('Y-m-d', $member->date_of_birth);}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['marital_status'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['marital_status'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="number_of_children" class="text-uppercase c-gray-light"><?php echo translate('number_of_children')?></label>
                                                            <input type="number" class="form-control no-resize" name="number_of_children" value="<?php if(!empty($form_contents)){echo $form_contents['number_of_children'];} else{echo $basic_info_data[0]['number_of_children'];}?>" min="0">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="area" class="text-uppercase c-gray-light"><?php echo translate('area')?></label>
                                                            <input type="text" class="form-control no-resize" name="area" value="<?php if(!empty($form_contents)){echo $form_contents['area'];} else{echo $basic_info_data[0]['area'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="on_behalf" class="text-uppercase c-gray-light"><?php echo translate('on_behalf')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['on_behalf'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['on_behalf'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="mobile" class="text-uppercase c-gray-light"><?php echo translate('mobile')?></label>
                                                            <input type="hidden" name="old_mobile" value="<?=$get_member[0]->mobile?>">
                                                            <input type="number" class="form-control no-resize" name="mobile" value="<?=$get_member[0]->mobile?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_present_address">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('present_address')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="country" class="text-uppercase c-gray-light"><?php echo translate('country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $form_contents['country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $present_address_data[0]['country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="state" class="text-uppercase c-gray-light"><?php echo translate('state')?></label>
                                                            <?php
                                                                if (!empty($present_address_data[0]['country'])) {
                                                                    if (!empty($present_address_data[0]['state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', $present_address_data[0]['state'], 'country_id', $present_address_data[0]['country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', '', 'country_id', $present_address_data[0]['country'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['country'])){
                                                                    if (!empty($form_contents['state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', $form_contents['state'], 'country_id', $form_contents['country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', '', 'country_id', $form_contents['country'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker present_state_f_edit" name="state">
                                                                        <option value=""><?php echo translate('choose_a_country_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
                                                            <?php
                                                                if (!empty($present_address_data[0]['state'])) {
                                                                    if (!empty($present_address_data[0]['city'])) {
                                                                        echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', $present_address_data[0]['city'], 'state_id', $present_address_data[0]['state'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', '', 'state_id', $present_address_data[0]['state'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['state'])){
                                                                    if (!empty($form_contents['city'])) {
                                                                        echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', $form_contents['city'], 'state_id', $form_contents['state'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', '', 'state_id', $form_contents['state'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker present_city_f_edit" name="city">
                                                                        <option value=""><?php echo translate('choose_a_state_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="postal_code" class="text-uppercase c-gray-light"><?php echo translate('postal-Code')?></label>
                                                            <input type="text" class="form-control no-resize" name="postal_code" value="<?php if(!empty($form_contents)){echo $form_contents['postal_code'];} else{echo $present_address_data[0]['postal_code'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_education_and_career">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('education_and_career')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="highest_education" class="text-uppercase c-gray-light"><?php echo translate('highest_education')?></label>
                                                            <input type="text" class="form-control no-resize" name="highest_education" value="<?php if(!empty($form_contents)){echo $form_contents['highest_education'];} else{echo $education_and_career_data[0]['highest_education'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="occupation" class="text-uppercase c-gray-light"><?php echo translate('occupation')?></label>
                                                            <input type="text" class="form-control no-resize" name="occupation" value="<?php if(!empty($form_contents)){echo $form_contents['occupation'];} else{echo $education_and_career_data[0]['occupation'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="annual_income" class="text-uppercase c-gray-light"><?php echo translate('annual_income')?></label>
                                                            <input type="text" class="form-control no-resize" name="annual_income" value="<?php if(!empty($form_contents)){echo $form_contents['annual_income'];} else{echo $education_and_career_data[0]['annual_income'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_physical_attributes">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('physical_attributes')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="height" value="<?php if(!empty($form_contents)){echo $form_contents['height'];} else{echo $member->height;}?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text small ml-2" id="text-feet"><?=translate('feet')?></span>
                                                                </div>
                                                            </div>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="weight" class="text-uppercase c-gray-light"><?php echo translate('weight')?></label>
                                                            <input type="text" class="form-control no-resize" name="weight" value="<?php if(!empty($form_contents)){echo $form_contents['weight'];} else{echo $physical_attributes_data[0]['weight'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color')?></label>
                                                            <input type="text" class="form-control no-resize" name="eye_color" value="<?php if(!empty($form_contents)){echo $form_contents['eye_color'];} else{echo $physical_attributes_data[0]['eye_color'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="hair_color" class="text-uppercase c-gray-light"><?php echo translate('hair_color')?></label>
                                                            <input type="text" class="form-control no-resize" name="hair_color" value="<?php if(!empty($form_contents)){echo $form_contents['hair_color'];} else{echo $physical_attributes_data[0]['hair_color'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion')?></label>
                                                            <input type="text" class="form-control no-resize" name="complexion" value="<?php if(!empty($form_contents)){echo $form_contents['complexion'];} else{echo $physical_attributes_data[0]['complexion'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="blood_group" class="text-uppercase c-gray-light"><?php echo translate('blood_group')?></label>
                                                            <input type="text" class="form-control no-resize" name="blood_group" value="<?php if(!empty($form_contents)){echo $form_contents['blood_group'];} else{echo $physical_attributes_data[0]['blood_group'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
                                                            <input type="text" class="form-control no-resize" name="body_type" value="<?php if(!empty($form_contents)){echo $form_contents['body_type'];} else{echo $physical_attributes_data[0]['body_type'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="body_art" class="text-uppercase c-gray-light"><?php echo translate('body_art')?></label>
                                                            <input type="text" class="form-control no-resize" name="body_art" value="<?php if(!empty($form_contents)){echo $form_contents['body_art'];} else{echo $physical_attributes_data[0]['body_art'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability')?></label>
                                                            <input type="text" class="form-control no-resize" name="any_disability" value="<?php if(!empty($form_contents)){echo $form_contents['any_disability'];} else{echo $physical_attributes_data[0]['any_disability'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_language">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('language')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="mother_tongue" class="text-uppercase c-gray-light"><?php echo translate('mother_tongue')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('language', 'mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['mother_tongue'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('language', 'mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['mother_tongue'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="language" class="text-uppercase c-gray-light"><?php echo translate('language')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['language'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['language'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="speak" class="text-uppercase c-gray-light"><?php echo translate('speak')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('language', 'speak', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['speak'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('language', 'speak', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['speak'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="read" class="text-uppercase c-gray-light"><?php echo translate('read')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('language', 'read', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['read'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('language', 'read', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['read'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'hobbies_and_interest'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_hobbies_and_interest">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('hobbies_and_interest')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="hobby" class="text-uppercase c-gray-light"><?php echo translate('hobby')?></label>
                                                            <input type="text" class="form-control no-resize" name="hobby" value="<?php if(!empty($form_contents)){echo $form_contents['hobby'];} else{echo $hobbies_and_interest_data[0]['hobby'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="interest" class="text-uppercase c-gray-light"><?php echo translate('interest')?></label>
                                                            <input type="text" class="form-control no-resize" name="interest" value="<?php if(!empty($form_contents)){echo $form_contents['interest'];} else{echo $hobbies_and_interest_data[0]['interest'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="music" class="text-uppercase c-gray-light"><?php echo translate('music')?></label>
                                                            <input type="text" class="form-control no-resize" name="music" value="<?php if(!empty($form_contents)){echo $form_contents['music'];} else{echo $hobbies_and_interest_data[0]['music'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="books" class="text-uppercase c-gray-light"><?php echo translate('books')?></label>
                                                            <input type="text" class="form-control no-resize" name="books" value="<?php if(!empty($form_contents)){echo $form_contents['books'];} else{echo $hobbies_and_interest_data[0]['books'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="movie" class="text-uppercase c-gray-light"><?php echo translate('movie')?></label>
                                                            <input type="text" class="form-control no-resize" name="movie" value="<?php if(!empty($form_contents)){echo $form_contents['movie'];} else{echo $hobbies_and_interest_data[0]['movie'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="tv_show" class="text-uppercase c-gray-light"><?php echo translate('TV_show')?></label>
                                                            <input type="text" class="form-control no-resize" name="tv_show" value="<?php if(!empty($form_contents)){echo $form_contents['tv_show'];} else{echo $hobbies_and_interest_data[0]['tv_show'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="sports_show" class="text-uppercase c-gray-light"><?php echo translate('sports_show')?></label>
                                                            <input type="text" class="form-control no-resize" name="sports_show" value="<?php if(!empty($form_contents)){echo $form_contents['sports_show'];} else{echo $hobbies_and_interest_data[0]['sports_show'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="fitness_activity" class="text-uppercase c-gray-light"><?php echo translate('fitness_activity')?></label>
                                                            <input type="text" class="form-control no-resize" name="fitness_activity" value="<?php if(!empty($form_contents)){echo $form_contents['fitness_activity'];} else{echo $hobbies_and_interest_data[0]['fitness_activity'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="cuisine" class="text-uppercase c-gray-light"><?php echo translate('cuisine')?></label>
                                                            <input type="text" class="form-control no-resize" name="cuisine" value="<?php if(!empty($form_contents)){echo $form_contents['cuisine'];} else{echo $hobbies_and_interest_data[0]['cuisine'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="dress_style" class="text-uppercase c-gray-light"><?php echo translate('dress_style')?></label>
                                                            <input type="text" class="form-control no-resize" name="dress_style" value="<?php if(!empty($form_contents)){echo $form_contents['dress_style'];} else{echo $hobbies_and_interest_data[0]['dress_style'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_personal_attitude_and_behavior">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('personal_attitude_and_behavior')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="affection" class="text-uppercase c-gray-light"><?php echo translate('affection')?></label>
                                                            <input type="text" class="form-control no-resize" name="affection" value="<?php if(!empty($form_contents)){echo $form_contents['affection'];} else{echo $personal_attitude_and_behavior_data[0]['affection'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="humor" class="text-uppercase c-gray-light"><?php echo translate('humor')?></label>
                                                            <input type="text" class="form-control no-resize" name="humor" value="<?php if(!empty($form_contents)){echo $form_contents['humor'];} else{echo $personal_attitude_and_behavior_data[0]['humor'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="political_view" class="text-uppercase c-gray-light"><?php echo translate('political_view')?></label>
                                                            <input type="text" class="form-control no-resize" name="political_view" value="<?php if(!empty($form_contents)){echo $form_contents['political_view'];} else{echo $personal_attitude_and_behavior_data[0]['political_view'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="religious_service" class="text-uppercase c-gray-light"><?php echo translate('religious_service')?></label>
                                                            <input type="text" class="form-control no-resize" name="religious_service" value="<?php if(!empty($form_contents)){echo $form_contents['religious_service'];} else{echo $personal_attitude_and_behavior_data[0]['religious_service'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_residency_information">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('residency_information')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="birth_country" class="text-uppercase c-gray-light"><?php echo translate('birth_country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'birth_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['birth_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'birth_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['birth_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="residency_country" class="text-uppercase c-gray-light"><?php echo translate('residency_country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'residency_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['residency_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'residency_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['residency_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="citizenship_country" class="text-uppercase c-gray-light"><?php echo translate('citizenship_country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'citizenship_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['citizenship_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'citizenship_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['citizenship_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="grow_up_country" class="text-uppercase c-gray-light"><?php echo translate('grow_up_country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'grow_up_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['grow_up_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'grow_up_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['grow_up_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="immigration_status" class="text-uppercase c-gray-light"><?php echo translate('immigration_status')?></label>
                                                            <input type="text" class="form-control no-resize" name="immigration_status" value="<?php if(!empty($form_contents)){echo $form_contents['immigration_status'];} else{echo $residency_information_data[0]['immigration_status'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_spiritual_and_social_background">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('spiritual_and_social_background')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="religion" class="text-uppercase c-gray-light"><?php echo translate('religion')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker present_religion_f_edit', $form_contents['religion'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker present_religion_f_edit', $spiritual_and_social_background_data[0]['religion'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="caste" class="text-uppercase c-gray-light"><?php echo translate('caste')?></label>
                                                            <?php
                                                                if (!empty($spiritual_and_social_background_data[0]['religion'])) {
                                                                    if (!empty($spiritual_and_social_background_data[0]['caste'])) {
                                                                        echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', $spiritual_and_social_background_data[0]['caste'], 'religion_id', $spiritual_and_social_background_data[0]['religion'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', '', 'religion_id', $spiritual_and_social_background_data[0]['religion'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['religion'])){
                                                                    if (!empty($form_contents['caste'])) {
                                                                        echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', $form_contents['caste'], 'religion_id', $form_contents['religion'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', '', 'religion_id', $form_contents['religion'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker present_caste_f_edit" name="caste">
                                                                        <option value=""><?php echo translate('choose_a_religion_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" id="">
                                                        <div class="form-group has-feedback">
                                                            <label for="sub_caste" class="text-uppercase c-gray-light"><?php echo translate('sub_caste')?></label>
                                                            <?php
                                                                if (!empty($spiritual_and_social_background_data[0]['caste'])) {
                                                                    if (!empty($spiritual_and_social_background_data[0]['sub_caste'])) {
                                                                        echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', $spiritual_and_social_background_data[0]['sub_caste'], 'caste_id', $spiritual_and_social_background_data[0]['caste'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', '', 'caste_id', $spiritual_and_social_background_data[0]['caste'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['caste'])){
                                                                    if (!empty($form_contents['sub_caste'])) {
                                                                        echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', $form_contents['sub_caste'], 'caste_id', $form_contents['caste'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', '', 'caste_id', $form_contents['caste'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker present_sub_caste_f_edit" name="sub_caste">
                                                                        <option value=""><?php echo translate('choose_a_caste_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="ethnicity" class="text-uppercase c-gray-light"><?php echo translate('ethnicity')?></label>
                                                            <input type="text" class="form-control no-resize" name="ethnicity" value="<?php if(!empty($form_contents)){echo $form_contents['ethnicity'];} else{echo $spiritual_and_social_background_data[0]['ethnicity'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="personal_value" class="text-uppercase c-gray-light"><?php echo translate('personal_value')?></label>
                                                            <input type="text" class="form-control no-resize" name="personal_value" value="<?php if(!empty($form_contents)){echo $form_contents['personal_value'];} else{echo $spiritual_and_social_background_data[0]['personal_value'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="family_value" class="text-uppercase c-gray-light"><?php echo translate('family_value')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_value_f_edit', $form_contents['family_value'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_value_f_edit', $spiritual_and_social_background_data[0]['family_value'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="community_value" class="text-uppercase c-gray-light"><?php echo translate('community_value')?></label>
                                                            <input type="text" class="form-control no-resize" name="community_value" value="<?php if(!empty($form_contents)){echo $form_contents['community_value'];} else{echo $spiritual_and_social_background_data[0]['community_value'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="family_status" class="text-uppercase c-gray-light"><?php echo translate('family_status')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_status_f_edit', $form_contents['family_status'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_status_f_edit', $spiritual_and_social_background_data[0]['family_status'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="u_manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik')?></label>

                                                            <select name="u_manglik" class="form-control form-control-sm selectpicker" data-placeholder="Choose a manglik" tabindex="2" data-hide-disabled="true">
                                                                <option value="">Choose one</option>
                                                                <option value="1" <?php if($u_manglik==1){ echo 'selected';} ?>>Yes</option>
                                                                <option value="2" <?php if($u_manglik==2){ echo 'selected';} ?>>No</option>
                                                                <option value="3" <?php if($u_manglik==3){ echo 'selected';} ?>>I don't know</option>
                                                            </select>
                                                            <!-- <?php
                                                                echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $spiritual_and_social_background_data[0]['manglik'], '', '', '');
                                                            ?> -->
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_life_style">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('life_style')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="diet" class="text-uppercase c-gray-light"><?php echo translate('diet')?></label>
                                                            <input type="text" class="form-control no-resize" name="diet" value="<?php if(!empty($form_contents)){echo $form_contents['diet'];} else{echo $life_style_data[0]['diet'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="drink" class="text-uppercase c-gray-light"><?php echo translate('drink')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('decision', 'drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['drink'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('decision', 'drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style_data[0]['drink'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="smoke" class="text-uppercase c-gray-light"><?php echo translate('smoke')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('decision', 'smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['smoke'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('decision', 'smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style_data[0]['smoke'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="living_with" class="text-uppercase c-gray-light"><?php echo translate('living_with')?></label>
                                                            <input type="text" class="form-control no-resize" name="living_with" value="<?php if(!empty($form_contents)){echo $form_contents['living_with'];} else{echo $life_style_data[0]['living_with'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_astronomic_information">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('astronomic_information')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="sun_sign" class="text-uppercase c-gray-light"><?php echo translate('sun_sign')?></label>
                                                            <input type="text" class="form-control no-resize" name="sun_sign" value="<?php if(!empty($form_contents)){echo $form_contents['sun_sign'];} else{echo $astronomic_information_data[0]['sun_sign'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="moon_sign" class="text-uppercase c-gray-light"><?php echo translate('moon_sign')?></label>
                                                            <input type="text" class="form-control no-resize" name="moon_sign" value="<?php if(!empty($form_contents)){echo $form_contents['moon_sign'];} else{echo $astronomic_information_data[0]['moon_sign'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="time_of_birth" class="text-uppercase c-gray-light"><?php echo translate('time_of_birth')?></label>
                                                            <input type="text" class="form-control no-resize" name="time_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['time_of_birth'];} else{echo $astronomic_information_data[0]['time_of_birth'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="city_of_birth" class="text-uppercase c-gray-light"><?php echo translate('city_of_birth')?></label>
                                                            <input type="text" class="form-control no-resize" name="city_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['city_of_birth'];} else{echo $astronomic_information_data[0]['city_of_birth'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_nentnent_address">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('permanent_address')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="permanent_country" class="text-uppercase c-gray-light"><?php echo translate('country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'permanent_country', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_country_f_edit', $form_contents['permanent_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'permanent_country', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_country_f_edit', $permanent_address_data[0]['permanent_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="permanent_state" class="text-uppercase c-gray-light"><?php echo translate('state')?></label>
                                                            <?php
                                                                if (!empty($permanent_address_data[0]['permanent_country'])) {
                                                                    if (!empty($permanent_address_data[0]['permanent_state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', $permanent_address_data[0]['permanent_state'], 'country_id', $permanent_address_data[0]['permanent_country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', '', 'country_id', $permanent_address_data[0]['permanent_country'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['permanent_country'])){
                                                                    if (!empty($form_contents['permanent_state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', $form_contents['permanent_state'], 'country_id', $form_contents['permanent_country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', '', 'country_id', $form_contents['permanent_country'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker permanent_state_f_edit" name="permanent_state">
                                                                        <option value=""><?php echo translate('choose_a_country_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="permanent_city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
                                                            <?php
                                                                if (!empty($permanent_address_data[0]['permanent_state'])) {
                                                                    if (!empty($permanent_address_data[0]['permanent_city'])) {
                                                                        echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', $permanent_address_data[0]['permanent_city'], 'state_id', $permanent_address_data[0]['permanent_state'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', '', 'state_id', $permanent_address_data[0]['permanent_state'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['permanent_state'])){
                                                                    if (!empty($form_contents['permanent_city'])) {
                                                                        echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', $form_contents['permanent_city'], 'state_id', $form_contents['permanent_state'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', '', 'state_id', $form_contents['permanent_state'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker permanent_city_f_edit" name="permanent_city">
                                                                        <option value=""><?php echo translate('choose_a_state_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="permanent_postal_code" class="text-uppercase c-gray-light"><?php echo translate('postal-Code')?></label>
                                                            <input type="text" class="form-control no-resize" name="permanent_postal_code" value="<?php if(!empty($form_contents)){echo $form_contents['permanent_postal_code'];} else{echo $permanent_address_data[0]['permanent_postal_code'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'family_info'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_family_info">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('family_information')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father')?></label>
                                                            <input type="text" class="form-control no-resize" name="father" value="<?php if(!empty($form_contents)){echo $form_contents['father'];} else{echo $family_info_data[0]['father'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother')?></label>
                                                            <input type="text" class="form-control no-resize" name="mother" value="<?php if(!empty($form_contents)){echo $form_contents['mother'];} else{echo $family_info_data[0]['mother'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="brother_sister" class="text-uppercase c-gray-light"><?php echo translate('brother_/_sister')?></label>
                                                            <input type="text" class="form-control no-resize" name="brother_sister" value="<?php if(!empty($form_contents)){echo $form_contents['brother_sister'];} else{echo $family_info_data[0]['brother_sister'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_additional_personal_details">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('additional_personal_details')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="home_district" class="text-uppercase c-gray-light"><?php echo translate('home_district')?></label>
                                                            <input type="text" class="form-control no-resize" name="home_district" value="<?php if(!empty($form_contents)){echo $form_contents['home_district'];} else{echo $additional_personal_details_data[0]['home_district'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="family_residence" class="text-uppercase c-gray-light"><?php echo translate('family_residence')?></label>
                                                            <input type="text" class="form-control no-resize" name="family_residence" value="<?php if(!empty($form_contents)){echo $form_contents['family_residence'];} else{echo $additional_personal_details_data[0]['family_residence'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="fathers_occupation" class="text-uppercase c-gray-light"><?php echo translate("father's_occupation")?></label>
                                                            <input type="text" class="form-control no-resize" name="fathers_occupation" value="<?php if(!empty($form_contents)){echo $form_contents['fathers_occupation'];} else{echo $additional_personal_details_data[0]['fathers_occupation'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="special_circumstances" class="text-uppercase c-gray-light"><?php echo translate('special_circumstances')?></label>
                                                            <input type="text" class="form-control no-resize" name="special_circumstances" value="<?php if(!empty($form_contents)){echo $form_contents['special_circumstances'];} else{echo $additional_personal_details_data[0]['special_circumstances'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
                                        ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="edit_partner_expectation">
                                                <div class="card-inner-title-wrapper  pt-0">
                                                    <h3 class="card-inner-title pull-left">
                                                    <?php echo translate('partner_expectation')?> </h3>
                                                </div>
                                                <div class='clearfix'>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="general_requirement" class="text-uppercase c-gray-light"><?php echo translate('general_requirement')?></label>
                                                            <input type="text" class="form-control no-resize" name="general_requirement" value="<?php if(!empty($form_contents)){echo $form_contents['general_requirement'];} else{echo $partner_expectation_data[0]['general_requirement'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_age" value="<?php if(!empty($form_contents)){echo $form_contents['partner_age'];} else{echo $partner_expectation_data[0]['partner_age'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_height" value="<?php if(!empty($form_contents)){echo $form_contents['partner_height'];} else{echo $partner_expectation_data[0]['partner_height'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_weight" class="text-uppercase c-gray-light"><?php echo translate('weight')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_weight" value="<?php if(!empty($form_contents)){echo $form_contents['partner_weight'];} else{echo $partner_expectation_data[0]['partner_weight'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_marital_status'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_marital_status'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="with_children_acceptables" class="text-uppercase c-gray-light"><?php echo translate('with_children_acceptables')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('decision', 'with_children_acceptables', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['with_children_acceptables'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('decision', 'with_children_acceptables', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['with_children_acceptables'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_country_of_residence" class="text-uppercase c-gray-light"><?php echo translate('country_of_residence')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_country_of_residence'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_country_of_residence'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="religion" class="text-uppercase c-gray-light"><?php echo translate('religion')?></label>
                                                            <?php
                                                                echo $this->Crud_model->select_html('religion', 'partner_religion', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_religion_edit', $partner_expectation_data[0]['partner_religion'], '', '', '');
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="caste" class="text-uppercase c-gray-light"><?php echo translate('caste')?></label>
                                                            <?php
                                                                if (!empty($partner_expectation_data[0]['partner_religion'])) {
                                                                    echo $this->Crud_model->select_html('caste', 'partner_caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_caste_edit', $partner_expectation_data[0]['partner_caste'], 'religion_id', $partner_expectation_data[0]['partner_religion'], '');
                                                                } else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker prefered_caste_edit" name="partner_caste">
                                                                        <option value=""><?php echo translate('choose_a_religion_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="sub_caste" class="text-uppercase c-gray-light"><?php echo translate('sub_caste')?></label>
                                                            <?php
                                                                if (!empty($partner_expectation_data[0]['partner_caste'])) {
                                                                    echo $this->Crud_model->select_html('sub_caste', 'partner_sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_sub_caste_edit', $partner_expectation_data[0]['partner_sub_caste'], 'caste_id', $partner_expectation_data[0]['partner_caste'], '');
                                                                } else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker prefered_sub_caste_edit" name="partner_sub_caste">
                                                                        <option value=""><?php echo translate('choose_a_caste_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_education" class="text-uppercase c-gray-light"><?php echo translate('education')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_education" value="<?php if(!empty($form_contents)){echo $form_contents['partner_education'];} else{echo $partner_expectation_data[0]['partner_education'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_profession" value="<?php if(!empty($form_contents)){echo $form_contents['partner_profession'];} else{echo $partner_expectation_data[0]['partner_profession'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_drinking_habits" class="text-uppercase c-gray-light"><?php echo translate('drinking_habits')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('decision', 'partner_drinking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_drinking_habits'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('decision', 'partner_drinking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_drinking_habits'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_smoking_habits" class="text-uppercase c-gray-light"><?php echo translate('smoking_habits')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('decision', 'partner_smoking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_smoking_habits'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('decision', 'partner_smoking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_smoking_habits'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_diet" class="text-uppercase c-gray-light"><?php echo translate('diet')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_diet" value="<?php if(!empty($form_contents)){echo $form_contents['partner_diet'];} else{echo $partner_expectation_data[0]['partner_diet'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_body_type" value="<?php if(!empty($form_contents)){echo $form_contents['partner_body_type'];} else{echo $partner_expectation_data[0]['partner_body_type'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_personal_value" class="text-uppercase c-gray-light"><?php echo translate('personal_value')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_personal_value" value="<?php if(!empty($form_contents)){echo $form_contents['partner_personal_value'];} else{echo $partner_expectation_data[0]['partner_personal_value'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik')?></label>

                                                            <?php
                                                                echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['manglik'], '', '', '');
                                                            ?>
                                                            <!-- <select name="manglik" class="form-control form-control-sm selectpicker" data-placeholder="Choose a manglik" tabindex="2" data-hide-disabled="true">
                                                                <option value="">Choose one</option>
                                                                <option value="1" <?php if($manglik==1){ echo 'selected';} ?>>Yes</option>
                                                                <option value="2" <?php if($manglik==2){ echo 'selected';} ?>>No</option>
                                                                <option value="3" <?php if($manglik==3){ echo 'selected';} ?>>I don't know</option>
                                                            </select> -->

                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_any_disability" value="<?php if(!empty($form_contents)){echo $form_contents['partner_any_disability'];} else{echo $partner_expectation_data[0]['partner_any_disability'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_mother_tongue" class="text-uppercase c-gray-light"><?php echo translate('mother_tongue')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('language', 'partner_mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_mother_tongue'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('language', 'partner_mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_mother_tongue'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="partner_family_value" class="text-uppercase c-gray-light"><?php echo translate('family_value')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_family_value" value="<?php if(!empty($form_contents)){echo $form_contents['partner_family_value'];} else{echo $partner_expectation_data[0]['partner_family_value'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="prefered_country" class="text-uppercase c-gray-light"><?php echo translate('prefered_country')?></label>
                                                            <?php
                                                                if (!empty($form_contents)) {
                                                                    echo $this->Crud_model->select_html('country', 'prefered_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['prefered_country'], '', '', '');
                                                                }
                                                                else {
                                                                    echo $this->Crud_model->select_html('country', 'prefered_country', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_country_f_edit', $partner_expectation_data[0]['prefered_country'], '', '', '');
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="prefered_state" class="text-uppercase c-gray-light"><?php echo translate('prefered_state')?></label>
                                                            <?php
                                                                if (!empty($partner_expectation_data[0]['prefered_country'])) {
                                                                    if (!empty($partner_expectation_data[0]['prefered_state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', $partner_expectation_data[0]['prefered_state'], 'country_id', $partner_expectation_data[0]['prefered_country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', '', 'country_id', $partner_expectation_data[0]['prefered_country'], '');
                                                                    }
                                                                }
                                                                elseif (!empty($form_contents['prefered_country'])){
                                                                    if (!empty($form_contents['prefered_state'])) {
                                                                        echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', $form_contents['prefered_state'], 'country_id', $form_contents['prefered_country'], '');
                                                                    } else {
                                                                        echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', '', 'country_id', $form_contents['prefered_country'], '');
                                                                    }
                                                                }
                                                                else {
                                                                ?>
                                                                    <select class="form-control form-control-sm selectpicker prefered_state_f_edit" name="prefered_state">
                                                                        <option value=""><?php echo translate('choose_a_country_first')?></option>
                                                                    </select>
                                                                <?php
                                                                }
                                                            ?>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="prefered_status" class="text-uppercase c-gray-light"><?php echo translate('prefered_status')?></label>
                                                            <input type="text" class="form-control no-resize" name="prefered_status" value="<?php if(!empty($form_contents)){echo $form_contents['prefered_status'];} else{echo $partner_expectation_data[0]['prefered_status'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-feedback">
                                                            <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion')?></label>
                                                            <input type="text" class="form-control no-resize" name="partner_complexion" value="<?php if(!empty($form_contents)){echo $form_contents['partner_complexion'];} else{echo $partner_expectation_data[0]['partner_complexion'];}?>">
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="col-8 ml-auto mr-auto">
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <a href="<?=base_url()?>home/profile" class="btn btn-danger btn-sm z-depth-2-bottom" style="width: 100%"><?php echo translate('cancel')?></a>
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-base-1 btn-rounded btn-sm z-depth-2-bottom btn-icon-only" style="width: 100%"><?php echo translate('update')?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".height_mask").inputmask({
            mask: "9.99",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>
<script>
    $(".present_country_f_edit").change(function(){
        var country_id = $(".present_country_f_edit").val();
        if (country_id == "") {
            $(".present_state_f_edit").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
            $(".present_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_state_f_edit").html(data);
                    $(".present_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".present_state_f_edit").change(function(){
        var state_id = $(".present_state_f_edit").val();
        if (state_id == "") {
            $(".present_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/city/state_id/"+state_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_city_f_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });

    $(".permanent_country_f_edit").change(function(){
        var country_id = $(".permanent_country_f_edit").val();
        if (country_id == "") {
            $(".permanent_state_f_edit").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
            $(".permanent_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".permanent_state_f_edit").html(data);
                    $(".present_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".permanent_state_f_edit").change(function(){
        var state_id = $(".permanent_state_f_edit").val();
        if (state_id == "") {
            $(".permanent_city_f_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/city/state_id/"+state_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".permanent_city_f_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_country_f_edit").change(function(){
        var country_id = $(".prefered_country_f_edit").val();
        if (country_id == "") {
            $(".prefered_state_f_edit").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_state_f_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });


    $(".present_religion_f_edit").change(function(){
        var religion_id = $(".present_religion_f_edit").val();
        if (religion_id == "") {
            $(".present_caste_f_edit").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".present_sub_caste_f_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_caste_f_edit").html(data);
                    $(".present_sub_caste_f_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".present_caste_f_edit").change(function(){
        var caste_id = $(".present_caste_f_edit").val();
        if (caste_id == "") {
            $(".present_sub_caste_f_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_sub_caste_f_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });

    $(".prefered_religion_edit").change(function(){
        var religion_id = $(".prefered_religion_edit").val();
        if (religion_id == "") {
            $(".prefered_caste_edit").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_caste_edit").html(data);
                    $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_caste_edit").change(function(){
        var caste_id = $(".prefered_caste_edit").val();
        if (caste_id == "") {
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_sub_caste_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>
