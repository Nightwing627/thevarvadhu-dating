<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('profile_sections')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('profile_sections')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="panel">
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?= translate('profile_sections_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
			    		<form class="form-horizontal" id="profile_sections_settings_form" method="POST" action="<?=base_url()?>admin/update_profile_sections_settings">
			    			<div class="form-group">
			    				<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="present_address_status" name="present_address_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="present_address_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="present_address_status"><b><?= translate('present_address')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="education_and_career_status" name="education_and_career_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="education_and_career_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="education_and_career_status"><b><?= translate('education_and_career')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="physical_attributes_status" name="physical_attributes_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="physical_attributes_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="physical_attributes_status"><b><?= translate('physical_attributes')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="language_status" name="language_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="language_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="language_status"><b><?= translate('language')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="hobbies_and_interests_status" name="hobbies_and_interests_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'hobbies_and_interests'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="hobbies_and_interests_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="hobbies_and_interests_status"><b><?= translate('hobbies_and_interests')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="personal_attitude_and_behavior_status" name="personal_attitude_and_behavior_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="personal_attitude_and_behavior_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="personal_attitude_and_behavior_status"><b><?= translate('personal_attitude_and_behavior')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="residency_information_status" name="residency_information_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="residency_information_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="residency_information_status"><b><?= translate('residency_information')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="spiritual_and_social_background_status" name="spiritual_and_social_background_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="spiritual_and_social_background_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="spiritual_and_social_background_status"><b><?= translate('spiritual_and_social_background')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="life_style_status" name="life_style_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="life_style_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="life_style_status"><b><?= translate('life_style')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="astronomic_information_status" name="astronomic_information_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="astronomic_information_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="astronomic_information_status"><b><?= translate('astronomic_information')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="permanent_address_status" name="permanent_address_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="permanent_address_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="permanent_address_status"><b><?= translate('permanent_address')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="family_information_status" name="family_information_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="family_information_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="family_information_status"><b><?= translate('family_information')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="additional_personal_details_status" name="additional_personal_details_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="additional_personal_details_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="additional_personal_details_status"><b><?= translate('additional_personal_details')?></b></label>
							</div>
							<div class="form-group">
								<div class="col-sm-3 text-right">
									<div class="checkbox">
						                <input id="partner_expectation_status" name="partner_expectation_status" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="partner_expectation_status"></label>
						            </div>
								</div>
								<label class="col-sm-3 control-label text-left" for="partner_expectation_status"><b><?= translate('partner_expectation')?></b></label>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-8 text-right">
									<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
								</div>
							</div>
						</form>
					</div>				
				</div>				
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>