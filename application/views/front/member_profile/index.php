<section class="slice sct-color-2">
    <div class="profile">
        <div class="container">
            <div class="row cols-md-space cols-sm-space cols-xs-space">
                <!-- Alerts for Member actions -->
                <div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                    <div class="alert alert-success fade show" role="alert">
                        <!-- Success Alert Content -->
                        <!-- You have <b>Successfully</b> Edited your Profile! -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                    <div class="alert alert-danger fade show" role="alert">
                        <!-- Success Alert Content -->
                        <!-- You have <b>Successfully</b> Edited your Profile! -->
                    </div>
                </div>
                <!-- Alerts for Member actions -->
                <?php
                    // Leading Json data
                    $basic_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'basic_info');
                    $basic_info_data = json_decode($basic_info, true);
                    
                    $present_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'present_address');
                    $present_address_data = json_decode($present_address, true);  

                    $education_and_career = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'education_and_career');
                    $education_and_career_data = json_decode($education_and_career, true);

                    $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'physical_attributes');
                    $physical_attributes_data = json_decode($physical_attributes, true);

                    $language = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'language');
                    $language_data = json_decode($language, true);

                    $hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'hobbies_and_interest');
                    $hobbies_and_interest_data = json_decode($hobbies_and_interest, true);

                    $personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'personal_attitude_and_behavior');
                    $personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);

                    $residency_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'residency_information');
                    $residency_information_data = json_decode($residency_information, true);

                    $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'spiritual_and_social_background');
                    $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

                    $life_style = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'life_style');
                    $life_style_data = json_decode($life_style, true);

                    $astronomic_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'astronomic_information');
                    $astronomic_information_data = json_decode($astronomic_information, true);

                    $permanent_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'permanent_address');
                    $permanent_address_data = json_decode($permanent_address, true);

                    $family_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'family_info');
                    $family_info_data = json_decode($family_info, true);

                    $additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'additional_personal_details');
                    $additional_personal_details_data = json_decode($additional_personal_details, true);

                    $partner_expectation = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'partner_expectation');
                    $partner_expectation_data = json_decode($partner_expectation, true);

                    $privacy_status = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'privacy_status');
                    $privacy_status_data = json_decode($privacy_status, true);
                
                ?>
                <div class="col-lg-4">
                    <?php include_once APPPATH.'views/front/member_profile/left_panel.php';?>
                </div>
                <div class="col-lg-8">
                	<div class="row">
                    	<!-- <div class="col-lg-12">
                        	<div class="feature feature--boxed-border feature--bg-1 mb-4 z-depth-2-top" style="padding: 0.8rem 0.8rem;">
                                <div class="block-title">
                                    <h3 class="heading heading-6 strong-500 pull-left mb-2 pl-2">
                                        <b><?php echo translate('quick_information')?></b>
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <div class="table-full-width">
                                        <div class="table-full-width">
                                            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                                <tbody>
                                                    <tr>
                                                        <td class="td-label"><span><?php echo translate('Member_ID')?></span></td>
                                                        <td colspan="3"><b class="c-base-1"><?=$get_member[0]->member_profile_id?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-label">
                                                            <span><?php echo translate('first_name')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$get_member[0]->first_name?>
                                                        </td>
                                                        <td class="td-label">
                                                            <span><?php echo translate('last_name')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$get_member[0]->last_name?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-label">
                                                            <span><?php echo translate('gender')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender)?>
                                                        </td>
                                                        <td class="td-label">
                                                            <span><?php echo translate('age')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-label">
                                                            <span><?php echo translate('marital_status')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
                                                        </td>
                                                        <td class="td-label">
                                                            <span><?php echo translate('number_of_children')?></span>
                                                        </td>
                                                        <td>
                                                            <?=$basic_info_data[0]['number_of_children']?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-label">
                                                            <span><?php echo translate('area')?></span>
                                                        </td>
                                                        <td >
                                                            <?=$basic_info_data[0]['area']?>
                                                        </td>
                                                        <td class="td-label">
                                                            <span><?php echo translate('on_behalf')?></span>
                                                        </td>
                                                        <td >
                                                            <?=$this->Crud_model->get_type_name_by_id('on_behalf', $basic_info_data[0]['on_behalf']);?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="widget">
                        <div class="card z-depth-2-top" id="profile_load">
                            <div class="card-title">
                                <h3 class="heading heading-6 strong-500 pull-left">
                                    <b>Profile Information</b>
                                </h3>
                            </div>
                            <div class="card-body" style="padding: 1.5rem 0.5rem;">
                                <!-- Contact information -->
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_introduction">
                                        <?php include_once 'introduction.php'; ?>
                                    </div>
                                </div>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_basic_info">
                                        <?php include_once 'basic_info.php'; ?>
                                    </div>
                                </div>
                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
                                //         if ($privacy_status_data[0]['present_address'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_present_address">
                                        <?php include_once 'present_address.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>
                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {
                                //         if ($privacy_status_data[0]['education_and_career'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_education_and_career">
                                        <?php include_once 'education_and_career.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>
                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
                                //     if ($privacy_status_data[0]['physical_attributes'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_physical_attributes">
                                        <?php include_once 'physical_attributes.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>

                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'hobbies_and_interests'))->row()->value == "yes") {
                                //     if ($privacy_status_data[0]['hobbies_and_interest'] == 'yes') {
                                    ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="section_hobbies_and_interest">
                                                <?php include_once 'hobbies_and_interest.php'; ?>
                                            </div>
                                        </div>
                                    <?php
                                //     }
                                // }
                                ?>


                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
                                //     if ($privacy_status_data[0]['life_style'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_life_style">
                                        <?php include_once 'life_style.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>


                                <!-- <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['language'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_language">
                                        <?php include_once 'language.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?> -->
                                <!-- <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['personal_attitude_and_behavior'] == 'yes') {
                                    ?>
                                        <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                            <div id="section_personal_attitude_and_behavior">
                                                <?php include_once 'personal_attitude_and_behavior.php'; ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                ?> -->
                                <!-- <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['residency_information'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_residency_information">
                                        <?php include_once 'residency_information.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?> -->
                                <!-- <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['spiritual_and_social_background'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_spiritual_and_social_background">
                                        <?php include_once 'spiritual_and_social_background.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?> -->
                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
                                //     if ($privacy_status_data[0]['astronomic_information'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_astronomic_information">
                                        <?php include_once 'astronomic_information.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>
                                <!-- <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['permanent_address'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_permanent_address">
                                        <?php include_once 'permanent_address.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?> -->
                                <?php
                                // if ($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes") {
                                //     if ($privacy_status_data[0]['family_info'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_family_info">
                                        <?php include_once 'family_info.php'; ?>
                                    </div>
                                </div>
                                <?php
                                //     }
                                // }
                                ?>
                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['additional_personal_details'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_additional_personal_details">
                                        <?php include_once 'additional_personal_details.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
                                    if ($privacy_status_data[0]['partner_expectation'] == 'yes') {
                                ?>
                                <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                                    <div id="section_partner_expectation">
                                        <?php include_once 'partner_expectation.php'; ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
