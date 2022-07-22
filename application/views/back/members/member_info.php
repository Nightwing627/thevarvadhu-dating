<?php
$basic_info = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'basic_info');
$basic_info_data = json_decode($basic_info, true);
?>
<div class="fluid">
	<div class="fixed-fluid">
		<div class="fluid">
			<div class="panel">
				<div class="panel-body">

					<!--Dark Panel-->
			        <!--===================================================-->
			        <div class="pull-right">
						<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-sm btn-labeled fa fa-trash' data-toggle='tooltip' data-placement='top' title='".translate('delete_member')."' onclick='delete_member("<?php echo $value->member_id?>")'><?php echo translate('delete')?></i></button>
						<a href="<?php echo base_url()?>admin/members/<?php echo $parameter?>/edit_member/<?php echo $value->member_id?>" class="btn btn-primary btn-sm btn-labeled fa fa-edit" type="button"><?php echo translate('edit')?></a>
					</div>

			        <div class="text-left">
			        	<h4>Member ID - <?php echo $value->member_profile_id?></h4>
			        </div>

			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('introduction')?></h3>
			            </div>
			            <div class="panel-body">
			                <p><?php echo $value->introduction?></p>
			            </div>
			        </div>

			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('basic_information')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table table-condenced">
							<tr>
								<td>
									<b><?php echo translate('first_name')?></b>
								</td>
								<td>
									<?php echo $value->first_name?>
								</td>
								<td>
									<b><?php echo translate('last_name')?></b>
								</td>
								<td>
									<?php echo $value->last_name?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('gender')?></b>
								</td>
								<td>
                            		<?php echo $this->Crud_model->get_type_name_by_id('gender', $value->gender)?>
								</td>
								<td>
									<b><?php echo translate('email')?></b>
								</td>
								<td>
									<?php echo $value->email?>
									<?php if($member_email_verification = $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value == "on"){ ?>
										<br>
										<?php if ($value->email_verification_status == 1)
											{
												echo "<span class='badge badge-success' >".translate('email_verified')."</span>";
											}
											elseif ($value->is_closed == "no") {
												echo "<span class='badge badge-danger' >".translate('email_not_verified')."</span>";
											}
										?>
									<?php } ?>
								</td>

							</tr>
							<tr>
								<td>
									<b><?php echo translate('age')?></b>
								</td>
								<td>
									<?php
										$bday = new DateTime(date('d.m.Y', $value->date_of_birth));
										$today = new Datetime(date('d.m.Y'));
										$diff = $today->diff($bday);
										printf($diff->y);
									?>
									<!-- <?php echo $calculated_age = (date('Y') - date('Y', $value->date_of_birth));?> -->
								</td>
								<td>
									<b><?php echo translate('marital_status')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('number_of_children')?></b>
								</td>
								<td>
									
									<?php echo $this->Crud_model->get_type_name_by_id('child_count', $basic_info_data[0]['child_count'])?>
								</td>
								<td>
									<b>Religion</b>
								</td>
								<td>
									<?php
										echo $this->Crud_model->get_type_name_by_id('religion', $basic_info_data[0]['religion']);
									?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('mobile')?></b>
								</td>
								<td>
									<?php echo $value->mobile?>
								</td>
								<td>
									<b><?php echo translate('onbehalf')?></b>
								</td>
								<td>
									<?php
									$id = $value->on_behalf; 
									if($id == 1) echo "Self";
									elseif($id == 2) echo "Daughter/Son";
									elseif($id == 3) echo "Sister";
									elseif($id == 4) echo "Brother";
									elseif($id == 5) echo "Friend";
									elseif($id == 6) echo "Mother";
									else echo "Father";
									?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('date_of_birth')?></b>
								</td>
								<td>
									<?php echo date('d/m/Y', $value->date_of_birth)?>
								</td>
								<td>
									<b>CASTE</b>
								</td>
								<td>
									<?php 
									echo $this->Crud_model->get_type_name_by_id('caste', $basic_info_data[0]['caste']);
									?>
								</td>
							</tr>
							<tr>
								<td>
									<b>GOTRA</b>
								</td>
								<td><?php echo $value->subcaste; ?></td>
								<td>
									<b>Height</b>
								</td>
								<td>
									<?php 
										echo $this->Crud_model->get_type_name_by_id('user_height', $basic_info_data[0]['p_height']);
									?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('country')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('country', $value->country);?>
								</td>
								<td>
									<b><?php echo translate('state')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('state', $value->state);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('city')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('city', $value->city);?>
								</td>
								<td>
									<b><?php echo "Address"; ?></b>
								</td>
								<td>
									<?php echo $present_address_data[0]['address']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo "Residence";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('residence', $value->residence);?>
								</td>
								<td>
									<b><?php echo "Mobile2"; ?></b>
								</td>
								<td>
									<?php echo $present_address_data[0]['mobile2']?>
								</td>
							</tr>

							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo "Education";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('education', $value->eduction)?>
								</td>
								<td>
									<b><?php echo "Occupation";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('occupation', $value->occupation)?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo "Education Detail";?></b>
								</td>
								<td>
									<?php echo $education_and_career_data[0]['education_detail']?>
								</td>
								<td>
									<b>Occupation Detail</b>
								</td>
								<td>
									<?php echo $education_and_career_data[0]['occupation_detail']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo "Annual Income";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_new_type_name_by_id('anual_income', $value->anual_income, 'display')?>
								</td>
								<td>
									<b>Employed</b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_new_type_name_by_id('employed', $value->employed, 'display')?>
								</td>
							</tr>

							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('weight')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['weight']?>
								</td>
								<td>
									<b><?php echo translate('eye_color')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['eye_color']?>
								</td>
							</tr>
							<tr>
								
								<td>
									<b><?php echo translate('hair_color')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['hair_color']?>
								</td>

								<td>
									<b><?php echo translate('complexion')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['complexion']?>
								</td>
							</tr>
							<tr>
								
								<td>
									<b><?php echo translate('blood_group')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['blood_group']?>
								</td>

								<td>
									<b><?php echo translate('body_type')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['body_type']?>
								</td>
							</tr>
							<tr>
								
								<td>
									<b><?php echo translate('body_art')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['body_art']?>
								</td>

								<td>
									<b><?php echo translate('any_disability')?></b>
								</td>
								<td>
									<?php echo $physical_attributes_data[0]['any_disability']?>
								</td>
							</tr>
							</table>
			            </div>
			        </div>
			        <?php
                        }
                    ?>
					<?php
						// $life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
						$life_style_data = $life_style;
                        if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
                    ?>
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('life_style')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('diet')?></b>
								</td>
								<td>
									<?php echo $life_style_data[0]['diet']?>
								</td>
								<td>
									<b><?php echo translate('drink')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['drink'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('smoke')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['smoke'])?>
								</td>
								<td>
									<b><?php echo translate('living_with')?></b>
								</td>
								<td>
									<?php echo $life_style_data[0]['living_with']?>
								</td>
							</tr>
							</table>
			            </div>
			        </div>
					<?php
                        }
                    ?>
					
					<?php
						$astronomic_information_data = $astronomic_information;
                        if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
                    ?>
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('astronomic_information')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('sun_sign')?></b>
								</td>
								<td>
									<?php echo $astronomic_information_data[0]['sun_sign']?>
								</td>
								<td>
									<b><?php echo translate('moon_sign')?></b>
								</td>
								<td>
									<?php echo $astronomic_information_data[0]['moon_sign']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('time_of_birth')?></b>
								</td>
								<td>
									<?php echo $astronomic_information_data[0]['time_of_birth']?>
								</td>
								<td>
									<b><?php echo translate('city_of_birth')?></b>
								</td>
								<td>
									<?php echo $astronomic_information_data[0]['city_of_birth']?>
								</td>
							</tr>
							</table>
			            </div>
			        </div>
			        <?php
                        }
                    ?>


					<?php
						$family_info = $this->Crud_model->get_type_name_by_id('member', $value->member_id, 'family_info');
						$family_info_data = json_decode($family_info, true);
                        if ($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes") {
                    ?>
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('family_information')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							<tr>
								<td>
									<b><?php echo "Family Type";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_new_type_name_by_id('family_type', $value->family_type, 'display')?>
								</td>
								<td>
									<b><?php echo "Family Status";?></b>
								</td>
								<td><?php echo $this->Crud_model->get_type_name_by_id('family_status', $value->family_status)?></td>
							</tr>
							<tr>
								<td>
									<b><?php echo "Family Values";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('family_value', $value->family_values)?>
								</td>
								<td>
									<b>Mother Tounge</b>
								</td>
								<td><?php echo $this->Crud_model->get_new_type_name_by_id('mother_tounge', $value->mother_tounge, 'display')?></td>
							</tr>

							<tr>
								<td>
									<b><?php echo translate('father').' Name';?></b>
								</td>
								<td>
									<?php echo $family_info_data[0]['father_name']?>
								</td>
								<td>
									<b><?php echo translate('mother').' Name';?></b>
								</td>
								<td><?php echo $family_info_data[0]['mother_name']?></td>
							</tr>

							<tr>
								<td>
									<b><?php echo translate('father').' Occupation';?></b>
								</td>
								<td>
									<?php echo $family_info_data[0]['father_occupation']?>
								</td>
								<td>
									<b><?php echo translate('mother').' Occupation';?></b>
								</td>
								<td><?php echo  $family_info_data[0]['mother_occupation']?></td>
							</tr>

							<tr>
								<td>
									<b><?php echo "Brothers";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $value->brothers, 'display')?>
								</td>
								<td>
									<b><?php echo "Sisters";?></b>
								</td>
								<td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $value->sisters, 'display')?></td>
							</tr>

							<tr>
								<td>
									<b><?php echo "Married Brothers";?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $value->married_brothers, 'display')?>
								</td>
								<td>
									<b><?php echo "Married Sisters";?></b>
								</td>
								<td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $value->married_sisters, 'display')?></td>
							</tr>
							</table>
			            </div>
			        </div>
			        <?php
                        }
                    ?>

                    
                    
                    <?php
						// $partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
						$partner_expectation_data = $partner_expectation;
                        if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
                    ?>
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title"><?php echo translate('partner_expectation')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('general_requirement')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['general_requirement']?>
								</td>
								<td>
									<b><?php echo translate('age')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_age']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('height')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_height']?>
								</td>
								<td>
									<b><?php echo translate('weight')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_weight']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('marital_status')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation_data[0]['partner_marital_status'])?>
								</td>
								<td>
									<b><?php echo translate('with_children_acceptables')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['with_children_acceptables'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('country_of_residence')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence'])?>
								</td>
								<td>
									<b><?php echo translate('religion')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('religion', $partner_expectation_data[0]['partner_religion'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('sub_caste')?></b>
								</td>
								<td>
									<?php 
										if($partner_expectation_data[0]['partner_sub_caste'] != null){
											$this->db->get_where('sub_caste', array('sub_caste_id'=>$partner_expectation_data[0]['partner_sub_caste']))->row()->sub_caste_name;
										}
									?>
								</td>
								<td>
									<b><?php echo translate('caste_/_sect')?></b>
								</td>
								<td>
									<?php 
										if($partner_expectation_data[0]['partner_caste'] != null){
											echo $this->db->get_where('caste', array('caste_id'=>$partner_expectation_data[0]['partner_caste']))->row()->caste_name;
										}									
									?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('education')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_education']?>
								</td>
								<td>
									<b><?php echo translate('profession')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_profession']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('drinking_habits')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_drinking_habits'])?>
								</td>
								<td>
									<b><?php echo translate('smoking_habits')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_smoking_habits'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('diet')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_diet']?>
								</td>
								<td>
									<b><?php echo translate('body_type')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_body_type']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('personal_value')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_personal_value']?>
								</td>
								<td>
									<b><?php echo translate('manglik')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['manglik'])?>
									<!-- <?php $manglik=$partner_expectation_data[0]['manglik'];

										if($manglik == 1){
											echo "Yes";
										}elseif($manglik == 2){
											echo "No";
										}
										elseif($manglik == 3){
											echo "I don't know";
										}else{
											echo " ";
										}
									?> -->
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('any_disability')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_any_disability']?>
								</td>
								<td>
									<b><?php echo translate('mother_tongue')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('language', $partner_expectation_data[0]['partner_mother_tongue'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('family_value')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_family_value']?>
								</td>
								<td>
									<b><?php echo translate('prefered_country')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['prefered_country'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('prefered_state')?></b>
								</td>
								<td>
									<?php echo $this->Crud_model->get_type_name_by_id('state', $partner_expectation_data[0]['prefered_state'])?>
								</td>
								<td>
									<b><?php echo translate('prefered_status')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['prefered_status']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('complexion')?></b>
								</td>
								<td>
									<?php echo $partner_expectation_data[0]['partner_complexion']?>
								</td>
								<td>
									<b></b>
								</td>
								<td>

								</td>
							</tr>
							</table>
			            </div>
			        </div>
			        <?php
                        }
                    ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function delete_member(id){
	    $("#delete_member").val(id);
	}

	function deleteAMember() {
		$.ajax({
		    url: "<?php echo base_url()?>admin/member_delete/"+$("#delete_member").val(),
		    success: function(response) {
				window.location.href = "<?php echo base_url()?>admin/members/<?php echo $parameter?>";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}
</script>

<div class="modal fade" id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_delete_this_data?')?></p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="delete_member" onclick="deleteAMember()"value=""><?php echo translate('delete')?></button>
            	</div>
            </div>

        </div>
    </div>
</div>
