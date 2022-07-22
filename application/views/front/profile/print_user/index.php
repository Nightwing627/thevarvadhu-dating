
<?php
    $basic_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'basic_info');
    $basic_info_data = json_decode($basic_info, true);
?>
<?php 
    $present_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'present_address');
    $present_address_data = json_decode($present_address, true);
?>
<?php 
    $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
    $education_and_career_data = json_decode($education_and_career, true);
?>
<?php 
    $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
    $physical_attributes_data = json_decode($physical_attributes, true);
?>
<?php 
    $language = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'language');
    $language_data = json_decode($language, true);
?>
<?php 
    $hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'hobbies_and_interest');
    $hobbies_and_interest_data = json_decode($hobbies_and_interest, true);
?>
<?php 
    $personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'personal_attitude_and_behavior');
    $personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);
?>
<?php 
    $residency_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'residency_information');
    $residency_information_data = json_decode($residency_information, true);
?>
<?php
    $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'spiritual_and_social_background');
    $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);
?>
<?php 
    $life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
    $life_style_data = json_decode($life_style, true);
?>
<?php 
    $astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
    $astronomic_information_data = json_decode($astronomic_information, true);
?>
<?php 
    $permanent_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'permanent_address');
    $permanent_address_data = json_decode($permanent_address, true);
?>
<?php 
    $family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
    $family_info_data = json_decode($family_info, true);
?>
<?php 
    $additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'additional_personal_details');
    $additional_personal_details_data = json_decode($additional_personal_details, true);
?>
<?php
    $partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
    $partner_expectation_data = json_decode($partner_expectation, true);
?>

<!DOCTYPE html>
<html lang="en">
   <head>
	   <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Profile Information</title>
       <link href="<?=base_url()?>/uploads/favicon/favicon_1595155647.png" rel="icon" type="image/png">
	   <link rel="stylesheet" href="<?=base_url()?>/template/front/vendor/bootstrap/css/bootstrap.min.css" type="text/css"  media='screen,print'>
      <link id="stylesheet" type="text/css" href="<?=base_url()?>/template/front/css/global-style-red.css" rel="stylesheet" media="screen">
	   
   </head>
   
   <body style="background: #000;">

      <div class="container" style="width: 80%;margin: 0 auto;padding: 20px;background: #fff;">
          <div style="float: right;">
            <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow btnPrint"  >Print & Download</button>
        </div>
      </div>
      <div class="container" style="width: 80%;margin: 0 auto;padding: 20px;background: #fff;">
         <div class="widget">
            <div class="card z-depth-2-top" id="profile_load">
               <div class="card-title" style="border-bottom: 0;">
                  <h3 class="heading heading-6 strong-500 pull-left">
                     <b>Profile Information</b>
                  </h3>

               </div>
               <div class="card-body pt-2" style="padding: 1rem 0.5rem;">
                  <!-- Contact information -->
                 
                  <div id="section_basic_info">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_basic_info">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Basic Information            
                              </h3>
							   
                           </div>
                           <div class="table-full-width">
							   <div class="row">
								<div class="col-sm-2 col-md-2 to col-xs-2">
								  <div class="profile-picture">
                           <?php
                              $profile_image = $get_member[0]->profile_image;
                              $images = json_decode($profile_image, true);
                              if ($images[0]['thumb'] == "")
                              {
                                 $images[0]['thumb'] = "default_thumb.jpg";
                              }
                           ?>
									<div class="profile-picture" style="max-width: 100%;color: #e62e04;border-radius: 10px;border: 2px solid #e62e04;border-radius: 10px;width: 10vw;max-width: 100%;">
										<img style="color: #e62e04; border-radius: 10px;" src="<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>">
									</div>
													
								 </div>
								</div>
								<div class="col-sm-10 col-md-10 to col-xs-10" >
								  <div class="table-full-width">
									 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
										<tbody>
										   <tr>
											  <td class="td-label">
												 <span>First Name</span>
											  </td>
											  <td>
												 <?php echo $get_member[0]->first_name?>                            
											  </td>
											  <td class="td-label">
												 <span>Last Name</span>
											  </td>
											  <td>
												 <?php echo $get_member[0]->last_name?>                            
											  </td>
										   </tr>
										   <tr>
											  <td class="td-label">
												 <span>Gender</span>
											  </td>
											  <td>
												 <?php echo $this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender)?>                            
											  </td>
											  <td class="td-label">
												 <span>Email</span>
											  </td>
											  <td>
												 <?php echo $get_member[0]->email?>                            
											  </td>
										   </tr>
										   <tr>
											  <td class="td-label">
												 <span>Age</span>
											  </td>
											  <td>
												 <?php
                                       $calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));
                                       echo $calculated_age;
                                    ?>                            
											  </td>
											  <td class="td-label">
												 <span>Marital Status</span>
											  </td>
											  <td>
											      <?php echo $this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
											  </td>
										   </tr>
										   <tr>
											  <td class="td-label">
												 <span>Number Of Children</span>
											  </td>
											  <td>
                                       <?php echo $this->Crud_model->get_type_name_by_id('child_count', $basic_info_data[0]['child_count'])?>
											  </td>
											  <td class="td-label">
												 <span>Date Of Birth</span>
											  </td>
											  <td>
												 <?php echo date('d/m/Y', $get_member[0]->date_of_birth)?>                           
											  </td>
										   </tr>
										   <tr>
											  <td class="td-label">
												 <span>On Behalf</span>
											  </td>
											  <td>
                                      <?php
                                       $id = $get_member[0]->on_behalf; 
                                       if($id == 1) echo "Self";
                                       elseif($id == 2) echo "Daughter/Son";
                                       elseif($id == 3) echo "Sister";
                                       elseif($id == 4) echo "Brother";
                                       elseif($id == 5) echo "Friend";
                                       elseif($id == 6) echo "Mother";
                                       else echo "Father";
                                       ?>
											  </td>
											  <td class="td-label">
												 <span>Mobile</span>
											  </td>
											  <td><?php echo $get_member[0]->mobile?></td>
										   </tr>
										   <tr>
                                                <td class="td-label">
                                                    <span><?php echo translate('Caste')?></span>
                                                </td>
                                                <td>
                                                     <?php echo $this->Crud_model->get_type_name_by_id('caste', $basic_info_data[0]['caste']);?>
                                                </td>
                                                <td class="td-label">
                                                    <span><?php echo "GOTRA";?></span>
                                                </td>
                                                <td><?php echo $get_member[0]->subcaste?></td>
                                            </tr>
                                            <tr>
                                                <td class="td-label">
                                                    <span><?php echo "Height";?></span>
                                                </td>
                                                <td>
                                                     <?php echo $this->Crud_model->get_type_name_by_id('user_height', $basic_info_data[0]['p_height']);?>
                                                </td>
                                                <td class="td-label">
                                                    <span><?php echo "Religion";?></span>
                                                </td>
                                                <td><?php echo $this->Crud_model->get_type_name_by_id('religion', $basic_info_data[0]['religion']);?></td>
                                            </tr>
										</tbody>
									 </table>
								  </div>
								</div>
							  </div>
								  
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="section_present_address">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_present_address">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Present Address            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>Country</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('country', $get_member[0]->country);?>
                                          </td>
                                          <td class="td-label">
                                             <span>State</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('state', $get_member[0]->state);?>
                                          </td>
                                       </tr>
                                       <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('city')?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_type_name_by_id('city', $get_member[0]->city);?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('address')?></span>
                                            </td>
                                            <td>
                                                <?php echo $present_address_data[0]['address']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('residence')?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_type_name_by_id('residence', $get_member[0]->residence);?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('mobile2')?></span>
                                            </td>
                                            <td>
                                                <?php echo $present_address_data[0]['mobile2']?>
                                            </td>
                                        </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div id="section_education_and_career">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_education_and_career">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Education And Career            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('education')?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_type_name_by_id('education', $get_member[0]->eduction)?>
                                                
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('occupation')?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_type_name_by_id('occupation', $get_member[0]->occupation)?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('education detail')?></span>
                                            </td>
                                            <td>
                                                <?php echo $education_and_career_data[0]['education_detail']?>
                                                
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('occupation detail')?></span>
                                            </td>
                                            <td>
                                                <?php echo $education_and_career_data[0]['occupation_detail']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('annual_income')?></span>
                                            </td>
                                            <td>
                                                 <?php echo $this->Crud_model->get_new_type_name_by_id('anual_income', $get_member[0]->anual_income, 'display')?>
                                            </td>
                                            <td>
                                                <span><?php echo translate('employed')?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_new_type_name_by_id('employed', $get_member[0]->employed, 'display')?>
                                            </td>
                                        </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
						 
                     </div>
                  </div>
                  <div id="section_physical_attributes">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_physical_attributes">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Physical Attributes            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>Weight</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['weight']?>
                                          </td>

                                          <td class="td-label">
                                             <span>Eye Color</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['eye_color']?>
                                          </td>

                                       </tr>
                                       <tr>
                                          
                                          <td class="td-label">
                                             <span>Hair Color</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['hair_color']?>
                                          </td>

                                          <td class="td-label">
                                             <span>Complexion</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['complexion']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          
                                          <td class="td-label">
                                             <span>Blood Group</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['blood_group']?>
                                          </td>

                                          <td class="td-label">
                                             <span>Body Type</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['body_type']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          
                                          <td class="td-label">
                                             <span>Body Art</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['body_art']?>
                                          </td>

                                          <td class="td-label">
                                             <span>Any Disability</span>
                                          </td>
                                          <td>
                                              <?php echo $physical_attributes_data[0]['any_disability']?>
                                          </td>


                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
						
                     </div>                                     
                  </div>
                  
                  <div id="section_hobbies_and_interest">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_hobbies_and_interest">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Hobbies And Interests            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>Hobby</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['hobby']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Interest</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['interest']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Music</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['music']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Books</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['books']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Movie</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['movie']?>
                                          </td>
                                          <td class="td-label">
                                             <span>TV Show</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['tv_show']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Sports Show</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['sports_show']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Fitness Activity</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['fitness_activity']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Cuisine</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['cuisine']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Dress Style</span>
                                          </td>
                                          <td>
                                              <?php echo $hobbies_and_interest_data[0]['dress_style']?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div id="section_life_style">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_life_style">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Life Style            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>Diet</span>
                                          </td>
                                          <td>
                                              <?php echo $life_style_data[0]['diet']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Drink</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['drink'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Smoke</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['smoke'])?>
                                          </td>
                                          <td class="td-label">
                                             <span>Living With</span>
                                          </td>
                                          <td>
                                              <?php echo $life_style_data[0]['living_with']?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="section_astronomic_information">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_astronomic_information">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Astronomic Information            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>Sun Sign</span>
                                          </td>
                                          <td>
                                              <?php echo $astronomic_information_data[0]['sun_sign']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Moon Sign</span>
                                          </td>
                                          <td>
                                              <?php echo $astronomic_information_data[0]['moon_sign']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>City Of Birth</span>
                                          </td>
                                          <td>
                                              <?php echo $astronomic_information_data[0]['city_of_birth']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Time Of Birth</span>
                                          </td>
                                          <td>
                                              <?php echo $astronomic_information_data[0]['time_of_birth']?>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div id="section_family_info">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_family_info">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Family Information            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo "Family Type";?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_new_type_name_by_id('family_type', $get_member[0]->family_type, 'display')?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo "Family Status";?></span>
                                            </td>
                                            <td><?php echo $this->Crud_model->get_type_name_by_id('family_status', $get_member[0]->family_status)?></td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo "Family Values";?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_type_name_by_id('family_value', $get_member[0]->family_values)?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo "Mother Tounge";?></span>
                                            </td>
                                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('mother_tounge', $get_member[0]->mother_tounge, 'display')?></td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('father').' Name';?></span>
                                            </td>
                                            <td>
                                                <?php echo $family_info_data[0]['father_name']?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('mother').' Name';?></span>
                                            </td>
                                            <td>
                                                <?php echo $family_info_data[0]['mother_name']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo translate('father').' Occupation';?></span>
                                            </td>
                                            <td>
                                                <?php echo $family_info_data[0]['father_occupation']?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo translate('mother').' Occupation';?></span>
                                            </td>
                                            <td>
                                                <?php echo  $family_info_data[0]['mother_occupation']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo "Brothers";?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->brothers, 'display')?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo "Sisters";?></span>
                                            </td>
                                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->sisters, 'display')?></td>
                                        </tr>
                                        <tr>
                                            <td class="td-label">
                                                <span><?php echo "Married Brothers";?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->married_brothers, 'display')?>
                                            </td>
                                            <td class="td-label">
                                                <span><?php echo "Married Sisters";?></span>
                                            </td>
                                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->married_sisters, 'display')?></td>
                                        </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="section_partner_expectation">
                     <div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
                        <div id="info_partner_expectation">
                           <div class="card-inner-title-wrapper pt-0">
                              <h3 class="card-inner-title pull-left">
                                 Partner Expectation            
                              </h3>
                           </div>
                           <div class="table-full-width">
                              <div class="table-full-width">
                                 <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                                    <tbody>
                                       <tr>
                                          <td class="td-label">
                                             <span>General Requirement</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['general_requirement']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Age</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_age']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Height</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_height']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Weight</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_weight']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Marital Status</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation_data[0]['partner_marital_status'])?>
                                          </td>
                                          <td class="td-label">
                                             <span>With Children Acceptables</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['with_children_acceptables'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Country Of Residence</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence'])?>
                                          </td>
                                          <td class="td-label">
                                             <span>Religion</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('religion', $partner_expectation_data[0]['partner_religion'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Caste / Sect</span>
                                          </td>
                                          <td>
                                              <?php
                                                    if($partner_expectation_data[0]['partner_caste'] != null){
                                                        echo $this->db->get_where('caste', array('caste_id'=>$partner_expectation_data[0]['partner_caste']))->row()->caste_name;
                                                    }
                                                ?>
                                          </td>
                                          <td class="td-label">
                                             <span>Sub Caste</span>
                                          </td>
                                          <td>
                                              <?php
                                                    if($partner_expectation_data[0]['partner_sub_caste'] != null){
                                                        $this->db->get_where('sub_caste', array('sub_caste_id'=>$partner_expectation_data[0]['partner_sub_caste']))->row()->sub_caste_name;
                                                    }
                                                ?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Education</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_education']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Profession</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_profession']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Drinking Habits</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_drinking_habits'])?>
                                          </td>
                                          <td class="td-label">
                                             <span>Smoking Habits</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('decision', $partner_expectation_data[0]['partner_smoking_habits'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Diet</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_diet']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Body Type</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_body_type']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Personal Value</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_personal_value']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Manglik</span>
                                          </td>
                                          <td>
                                             
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Any Disability</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_any_disability']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Mother Tongue</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('language', $partner_expectation_data[0]['partner_mother_tongue'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Family Value</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_family_value']?>
                                          </td>
                                          <td class="td-label">
                                             <span>Prefered Country</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['prefered_country'])?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Prefered State</span>
                                          </td>
                                          <td>
                                              <?php echo $this->Crud_model->get_type_name_by_id('state', $partner_expectation_data[0]['prefered_state'])?>
                                          </td>
                                          <td class="td-label">
                                             <span>Prefered Status</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['prefered_status']?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="td-label">
                                             <span>Complexion</span>
                                          </td>
                                          <td>
                                              <?php echo $partner_expectation_data[0]['partner_complexion']?>
                                          </td>
                                          <td></td>
                                          <td></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
					  <br>
					   <img src="/uploads/footer_logo/footer_logo_1595156340.png" class="img-responsive" style="float:right;">
                  </div>
				  
               </div>
            </div>
			 <br>
			 <center><button type="button" class="btn btn-success btn-md btn-icon-only btn-shadow btnPrint">Print & Download</button></center>
         </div>
      </div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	   <script type="text/javascript">
        $(function () {
            $(".btnPrint").click(function () {
                var contents = $("#profile_load").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html><head><title>Profile Information</title>');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
				frameDoc.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">'); 
                //frameDoc.document.write('<link href="/template/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"  media="screen,print" type="text/css" />');
				 frameDoc.document.write('<link href="<?=base_url()?>/template/front/css/global-style-red.css" rel="stylesheet" type="text/css" />');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
            });
        });
    </script>
   </body>
</html>