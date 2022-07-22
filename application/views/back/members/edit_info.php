<div class="fluid">
	<div class="fixed-fluid">
		<div class="fluid">
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
                            <?php echo  validation_errors();?>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            ?>
			<?php
				$basic_info = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'basic_info');
				$basic_info_data = json_decode($basic_info, true);
			?>
			<form id="edit_profile_form" class="form-default" role="form" action="<?php echo base_url()?>admin/members/update_member/<?php echo $value->member_id?>/<?php echo $parameter?>" method="POST" enctype="multipart/form-data">
				<div class="panel">
					<div class="panel-body">
						<!--Dark Panel-->
				        <!--===================================================-->
				        <div class="pull-right">
							<button class="btn btn-primary btn-sm btn-labeled fa fa-floppy-o" type="submit"><?php echo translate('update')?></button>
						</div>

				        <div class="text-left">
				        	<h4><?php echo  translate('Member ID')?> - <?php echo $value->member_profile_id?></h4>
				        </div>

				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('introduction')?></h3>
				            </div>
				            <div class="panel-body">
				            	<textarea name="introduction" class="form-control no-resize" rows="6"><?php if(!empty($form_contents)){echo $form_contents['introduction'];} else{echo $value->introduction;}?></textarea>
				            </div>
				        </div>

				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('basic_information')?></h3>
				            </div>
				            <div class="panel-body">
				            	<div class='clearfix'>
	                            </div>
				                <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('first_name')?><span class="text-danger">*</span></label>
	                                        <input type="text" class="form-control no-resize" name="first_name" value="<?php if(!empty($form_contents)){echo $form_contents['first_name'];} else{echo $value->first_name;}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="last_name" class="text-uppercase c-gray-light"><?php echo translate('last_name')?><span class="text-danger">*</span></label>
	                                        <input type="text" class="form-control no-resize" name="last_name" value="<?php if(!empty($form_contents)){echo $form_contents['last_name'];} else{echo $value->last_name;}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="gender" class="text-uppercase c-gray-light"><?php echo translate('gender')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['gender'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->gender, '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="email" class="text-uppercase c-gray-light"><?php echo translate('email')?><span class="text-danger">*</span></label>
	                                        <input type="hidden" name="old_email" value="<?php echo $value->email?>">
	                                        <input type="email" class="form-control no-resize" name="email" value="<?php if(!empty($form_contents)){echo $form_contents['email'];} else{echo $value->email;}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="date_of_birth" class="text-uppercase c-gray-light"><?php echo translate('date_of_birth')?><span class="text-danger">*</span></label>
	                                        <input type="date" class="form-control no-resize" name="date_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];} else{echo date('Y-m-d', $value->date_of_birth);}?>">
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
											<?php echo $this->Crud_model->select_html('child_count', 'number_of_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['child_count'], '', '', '');?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="area" class="text-uppercase c-gray-light"><?php echo "Religion";?></label>
											<?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['religion'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['religion'], '', '', '');
	                                            }
	                                        ?>
	                                        <!-- <input type="text" class="form-control no-resize" name="area" value="<?php if(!empty($form_contents)){echo $form_contents['area'];} else{echo $basic_info[0]['area'];}?>"> -->
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="on_behalf" class="text-uppercase c-gray-light"><?php echo translate('on_behalf')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['on_behalf'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->on_behalf, '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mobile" class="text-uppercase c-gray-light"><?php echo translate('mobile')?><span class="text-danger">*</span></label>
	                                        <input type="hidden" name="old_mobile" value="<?php echo $value->mobile?>">
	                                        <input type="number" class="form-control no-resize" name="mobile" value="<?php echo $value->mobile?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors"></div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="on_behalf" class="text-uppercase c-gray-light"><?php echo "Caste" ?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('caste', 'caste', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['caste'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('caste', 'caste', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['caste'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mobile" class="text-uppercase c-gray-light"><?php echo "GOTRA";?></label>
											<input type="text" class="form-control no-resize" name="gotra" value="<?php echo $value->subcaste?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors"></div>
	                                    </div>
	                                </div>
	                            </div>

								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="on_behalf" class="text-uppercase c-gray-light"><?php echo "Height" ?></label>
											<?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('user_height', 'b_height', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['caste'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('user_height', 'b_height', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['p_height'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        
	                                    </div>
	                                </div>
	                            </div>


	                            <div class="row">
	                            	<div class="form-group">
										<label class="col-sm-2 control-label text-uppercase" for="profile_image"><b><?php echo translate('profile_image')?></b></label>
								        <div class="col-sm-9">
								        	<?php
												if (!empty($image) && file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
													$profile_image_url = base_url()."uploads/profile_image/".$image[0]['thumb'];
									            ?>
													<img class="img-responsive img-border blah" src="<?php echo $profile_image_url?>" style="max-width: 30%; height: 150px">
												<?php
												} else {
												?>
													<img class="img-responsive img-border blah" src="<?php echo base_url()?>uploads/profile_image/default_thumb.jpg" style="max-width: 30%; height: 150px">
												<?php
												}
											?>
								        </div>
								        <div class="col-sm-9 col-sm-offset-2" style="margin-top: 10px">
								            <span class="pull-left btn btn-dark btn-sm btn-file" id="img_edit">
								                <?php echo translate('select_a_photo')?>
								                <input type="file" name="profile_image" id="profile_image" class="form-control imgInp" >
								            </span>
								            <input type="hidden" id="profile_image_is_edit" name="is_edit" value="0">
								        </div>
									</div>
	                            </div>
				            </div>
				        </div>
				        <?php
							$present_address = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'present_address');
							$present_address_data = json_decode($present_address, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('present_address')?></h3>
				            </div>
				            <div class="panel-body">
				            	<div class='clearfix'>
	                            </div>
				                <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="country" class="text-uppercase c-gray-light"><?php echo translate('country')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $form_contents['country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $value->country, '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="state" class="text-uppercase c-gray-light"><?php echo translate('state')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($value->country)) {
	                                                if (!empty($value->state)) {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', $value->state, 'country_id', $value->country, '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', '', 'country_id', $value->country, '');
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
	                                            if (!empty($value->state)) {
	                                                if (!empty($value->city)) {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', $value->city, 'state_id', $value->state, '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', '', 'state_id', $value->state, '');
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
	                                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo "Address";?></label>
	                                        <input type="text" class="form-control no-resize" name="address" value="<?php if(!empty($form_contents)){echo $form_contents['address'];} else{echo $present_address_data[0]['address'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

								<div class="row">
	                                <div class="col-md-6">
										<div class="form-group has-feedback">
	                                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo "Residence";?></label>
											<?php echo $this->Crud_model->select_html('residence', 'residence', 'name', 'edit', 'form-control form-control-sm selectpicker ', $value->residence, '', '', '');?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo "Mobile2";?></label>
	                                        <input type="text" class="form-control no-resize" name="mobile2" value="<?php if(!empty($form_contents)){echo $form_contents['mobile2'];} else{echo $present_address_data[0]['mobile2'];}?>">
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
							$education_and_career = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'education_and_career');
							$education_and_career_data = json_decode($education_and_career, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('education_&_career')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="highest_education" class="text-uppercase c-gray-light"><?php echo "Education";?></span></label>
											<?php echo $this->Crud_model->select_html('education', 'education', 'name', 'edit', 'form-control form-control-sm selectpicker ', $value->eduction, '', '', '');?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="occupation" class="text-uppercase c-gray-light"><?php echo "Occupation";?></label>
											<?php echo $this->Crud_model->select_html('occupation', 'occupation', 'name', 'edit', 'form-control form-control-sm selectpicker ', $value->occupation, '', '', '');?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo "Education Detail";?></label>
	                                        <input type="text" class="form-control no-resize" name="education_detail" value="<?php if(!empty($form_contents)){echo $form_contents['education_detail'];} else{echo $education_and_career_data[0]['education_detail'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo "Occupation Detail";?></label>
	                                        <input type="text" class="form-control no-resize" name="occupation_detail" value="<?php if(!empty($form_contents)){echo $form_contents['occupation_detail'];} else{echo $education_and_career_data[0]['occupation_detail'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>

								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo "Annual Income";?></label>
	                                        <?php echo $this->Crud_model->select_html('anual_income', 'anual_income', 'name', 'edit', 'form-control form-control-sm selectpicker ', $value->anual_income, '', '', '');?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo "Employed";?></label>
	                                        <?php echo $this->Crud_model->select_html('employed', 'employed', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->employed, '', '', '');?>
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
							$physical_attributes = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'physical_attributes');
							$physical_attributes_data = json_decode($physical_attributes, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('physical_attributes')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="weight" class="text-uppercase c-gray-light"><?php echo translate('weight')?></label>
	                                        <input type="text" class="form-control no-resize" name="weight" value="<?php if(!empty($form_contents)){echo $form_contents['weight'];} else{echo $physical_attributes_data[0]['weight'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color')?></label>
	                                        <input type="text" class="form-control no-resize" name="eye_color" value="<?php if(!empty($form_contents)){echo $form_contents['eye_color'];} else{echo $physical_attributes_data[0]['eye_color'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="hair_color" class="text-uppercase c-gray-light"><?php echo translate('hair_color')?></label>
	                                        <input type="text" class="form-control no-resize" name="hair_color" value="<?php if(!empty($form_contents)){echo $form_contents['hair_color'];} else{echo $physical_attributes_data[0]['hair_color'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion')?></label>
	                                        <input type="text" class="form-control no-resize" name="complexion" value="<?php if(!empty($form_contents)){echo $form_contents['complexion'];} else{echo $physical_attributes_data[0]['complexion'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="blood_group" class="text-uppercase c-gray-light"><?php echo translate('blood_group')?></label>
	                                        <input type="text" class="form-control no-resize" name="blood_group" value="<?php if(!empty($form_contents)){echo $form_contents['blood_group'];} else{echo $physical_attributes_data[0]['blood_group'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
	                                        <input type="text" class="form-control no-resize" name="body_type" value="<?php if(!empty($form_contents)){echo $form_contents['body_type'];} else{echo $physical_attributes_data[0]['body_type'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>


	                            </div>
	                            <div class="row">
	                                
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="body_art" class="text-uppercase c-gray-light"><?php echo translate('body_art')?></label>
	                                        <input type="text" class="form-control no-resize" name="body_art" value="<?php if(!empty($form_contents)){echo $form_contents['body_art'];} else{echo $physical_attributes_data[0]['body_art'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

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
							$life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
							$life_style_data = json_decode($life_style, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('life_style')?></h3>
				            </div>
				            <div class="panel-body">
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
							$astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
							$astronomic_information_data = json_decode($astronomic_information, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('astronomic_information')?></h3>
				            </div>
				            <div class="panel-body">
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
							$family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
							$family_info_data = json_decode($family_info, true);
	                        if ($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('family_information')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="father" class="text-uppercase c-gray-light">Family Type</label>
											<?php echo $this->Crud_model->select_html('family_type', 'family_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->family_type, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother" class="text-uppercase c-gray-light">Family Status</label>
											<?php echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->family_status, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="father" class="text-uppercase c-gray-light">Family Values</label>
											<?php echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->family_values, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother" class="text-uppercase c-gray-light">Mother Tounge</label>
											<?php echo $this->Crud_model->select_html('mother_tounge', 'mother_tounge', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->mother_tounge, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father').' Name'?></label>
	                                        <input type="text" class="form-control no-resize" name="father" value="<?php if(!empty($form_contents)){echo $form_contents['father_name'];} else{echo $family_info_data[0]['father_name'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Name'?></label>
											<input type="text" class="form-control no-resize" name="mother" value="<?php if(!empty($form_contents)){echo $form_contents['mother_name'];} else{echo $family_info_data[0]['mother_name'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father').' Occupation'?></label>
	                                        <input type="text" class="form-control no-resize" name="father_occu" value="<?php if(!empty($form_contents)){echo $form_contents['father_occupation'];} else{echo $family_info_data[0]['father_occupation'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Occupation'?></label>
	                                        <input type="text" class="form-control no-resize" name="mother_occu" value="<?php if(!empty($form_contents)){echo $form_contents['mother_occupation'];} else{echo $family_info_data[0]['mother_occupation'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>


	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="brother_sister" class="text-uppercase c-gray-light">Brothers</label>
											<?php echo $this->Crud_model->select_html('brothers-sister_count', 'brothers', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->brothers, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="brother_sister" class="text-uppercase c-gray-light">Sisters</label>
											<?php echo $this->Crud_model->select_html('brothers-sister_count', 'sisters', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->sisters, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>


	                            </div>

								<div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="brother_sister" class="text-uppercase c-gray-light">Married Brothers</label>
											<?php echo $this->Crud_model->select_html('brothers-sister_count', 'mbrothers', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->married_brothers, '', '', ''); ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

									<div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="brother_sister" class="text-uppercase c-gray-light">Married Sisters</label>
											<?php echo $this->Crud_model->select_html('brothers-sister_count', 'msisters', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->married_sisters, '', '', ''); ?>
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
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('partner_expectation')?></h3>
				            </div>
				            <div class="panel-body">
				               <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="general_requirement" class="text-uppercase c-gray-light"><?php echo translate('general_requirement')?></label>
	                                        <input type="text" class="form-control no-resize" name="general_requirement" value="<?php if(!empty($form_contents)){echo $form_contents['general_requirement'];} else{echo $partner_expectation[0]['general_requirement'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age')?></label>
	                                        <input type="text" class="form-control no-resize" name="partner_age" value="<?php if(!empty($form_contents)){echo $form_contents['partner_age'];} else{echo $partner_expectation[0]['partner_age'];}?>">
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
	                                        <input type="text" class="form-control no-resize" name="partner_height" value="<?php if(!empty($form_contents)){echo $form_contents['partner_height'];} else{echo $partner_expectation[0]['partner_height'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="partner_weight" class="text-uppercase c-gray-light"><?php echo translate('weight')?></label>
	                                        <input type="text" class="form-control no-resize" name="partner_weight" value="<?php if(!empty($form_contents)){echo $form_contents['partner_weight'];} else{echo $partner_expectation[0]['partner_weight'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="partner_marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['partner_marital_status'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_marital_status'], '', '', '');
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
	                                                echo $this->Crud_model->select_html('decision', 'with_children_acceptables', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['with_children_acceptables'], '', '', '');
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
	                                                echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_country_of_residence'], '', '', '');
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
	                                            echo $this->Crud_model->select_html('religion', 'partner_religion', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_religion_edit', $partner_expectation[0]['partner_religion'], '', '', '');
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
	                                            if (!empty($partner_expectation[0]['partner_religion'])) {
	                                                echo $this->Crud_model->select_html('caste', 'partner_caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_caste_edit', $partner_expectation[0]['partner_caste'], 'religion_id', $partner_expectation[0]['partner_religion'], '');
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
	                                            if (!empty($partner_expectation[0]['partner_caste'])) {
	                                                echo $this->Crud_model->select_html('sub_caste', 'partner_sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker prefered_sub_caste_edit', $partner_expectation[0]['partner_sub_caste'], 'caste_id', $partner_expectation[0]['partner_caste'], '');
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
	                                        <input type="text" class="form-control no-resize" name="partner_education" value="<?php if(!empty($form_contents)){echo $form_contents['partner_education'];} else{echo $partner_expectation[0]['partner_education'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession')?></label>
	                                        <input type="text" class="form-control no-resize" name="partner_profession" value="<?php if(!empty($form_contents)){echo $form_contents['partner_profession'];} else{echo $partner_expectation[0]['partner_profession'];}?>">
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
	                                                echo $this->Crud_model->select_html('decision', 'partner_drinking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_drinking_habits'], '', '', '');
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
	                                                echo $this->Crud_model->select_html('decision', 'partner_smoking_habits', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_smoking_habits'], '', '', '');
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
	                                        <input type="text" class="form-control no-resize" name="partner_diet" value="<?php if(!empty($form_contents)){echo $form_contents['partner_diet'];} else{echo $partner_expectation[0]['partner_diet'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="partner_body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
	                                        <input type="text" class="form-control no-resize" name="partner_body_type" value="<?php if(!empty($form_contents)){echo $form_contents['partner_body_type'];} else{echo $partner_expectation[0]['partner_body_type'];}?>">
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
	                                        <input type="text" class="form-control no-resize" name="partner_personal_value" value="<?php if(!empty($form_contents)){echo $form_contents['partner_personal_value'];} else{echo $partner_expectation[0]['partner_personal_value'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik')?></label>

	                                        <?php
	                                            echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['manglik'], '', '', '');
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
	                                        <input type="text" class="form-control no-resize" name="partner_any_disability" value="<?php if(!empty($form_contents)){echo $form_contents['partner_any_disability'];} else{echo $partner_expectation[0]['partner_any_disability'];}?>">
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
	                                                echo $this->Crud_model->select_html('language', 'partner_mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_mother_tongue'], '', '', '');
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
	                                        <input type="text" class="form-control no-resize" name="partner_family_value" value="<?php if(!empty($form_contents)){echo $form_contents['partner_family_value'];} else{echo $partner_expectation[0]['partner_family_value'];}?>">
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
	                                                echo $this->Crud_model->select_html('country', 'prefered_country', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_country_f_edit', $partner_expectation[0]['prefered_country'], '', '', '');
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
	                                            if (!empty($partner_expectation[0]['prefered_country'])) {
	                                                if (!empty($partner_expectation[0]['prefered_state'])) {
	                                                    echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', $partner_expectation[0]['prefered_state'], 'country_id', $partner_expectation[0]['prefered_country'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'prefered_state', 'name', 'edit', 'form-control form-control-sm selectpicker prefered_state_f_edit', '', 'country_id', $partner_expectation[0]['prefered_country'], '');
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
	                                        <input type="text" class="form-control no-resize" name="prefered_status" value="<?php if(!empty($form_contents)){echo $form_contents['prefered_status'];} else{echo $partner_expectation[0]['prefered_status'];}?>">
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
	                                        <input type="text" class="form-control no-resize" name="partner_complexion" value="<?php if(!empty($form_contents)){echo $form_contents['partner_complexion'];} else{echo $partner_expectation[0]['partner_complexion'];}?>">
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
	                    <div class="panel-footer text-center">
							<button class="btn btn-primary btn-sm btn-labeled fa fa-floppy-o" type="submit"><?php echo translate('update')?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	// SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".panel-body").on('change', '.imgInp', function () {
        readURL_all(this);
    });

    $("#profile_image").change(function(){
	    $("#profile_image_is_edit").val('1');
	});
</script>
