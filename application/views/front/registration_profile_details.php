<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $this->db->get_where('general_settings', array('general_settings_id' => 24))->row()->value?>">
        <meta name="keywords" content="<?php echo $this->db->get_where('general_settings', array('general_settings_id' => 25))->row()->value?>">
        <meta name="author" content="<?php echo $this->db->get_where('general_settings', array('general_settings_id' => 26))->row()->value?>">
        <meta name="revisit-after" content="<?php echo $this->db->get_where('general_settings', array('general_settings_id' => 54))->row()->value?> day(s)">
        <title><?php echo $this->system_title?></title>
        <!-- Page loader -->
        <script src="<?php echo base_url()?>template/front/vendor/pace/js/pace.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/pace/css/pace-minimal.css" type="text/css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <!-- Plugins -->
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/swiper/css/swiper.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/hamburgers/hamburgers.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/animate/animate.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/vendor/lightgallery/css/lightgallery.min.css">
        <!-- Icons -->
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/ionicons/css/ionicons.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/line-icons/line-icons.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/line-icons-pro/line-icons-pro.css" type="text/css">
        <!-- Linea Icons -->
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/linea/arrows/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/linea/basic/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/linea/ecommerce/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url()?>template/front/fonts/linea/software/linea-icons.css" type="text/css">
        <!-- Global style (main) -->
        <?php
            $theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value;
            if ($theme_color == 'default-color') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'pink') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-pink.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'purple') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-purple.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'light-blue') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-light-blue.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'green') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-green.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'dark') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-dark.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'super-dark') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-super-dark.css" rel="stylesheet" media="screen">
            <?php
            }
            elseif ($theme_color == 'orange') { ?>
                <link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-orange.css" rel="stylesheet" media="screen">
            <?php
            }
            elseif ($theme_color == 'red') { ?>
        		<link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-red.css" rel="stylesheet" media="screen">
        	<?php
        	}
        	elseif ($theme_color == 'black') { ?>
        		<link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-black.css" rel="stylesheet" media="screen">
        	<?php
        	}
            elseif ($theme_color == 'blue') { ?>
        		<link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-blue.css" rel="stylesheet" media="screen">
        	<?php
        	}
        	elseif ($theme_color == 'ightseagreen') { ?>
        		<link id="stylesheet" type="text/css" href="<?php echo base_url()?>template/front/css/global-style-ightseagreen.css" rel="stylesheet" media="screen">
        	<?php
        	}
        ?>
        <!-- Custom style - Remove if not necessary -->
        <link type="text/css" href="<?php echo base_url()?>template/front/css/custom-style.css" rel="stylesheet">
        <!-- Favicon -->
        <script src="<?php echo base_url()?>template/front/vendor/jquery/jquery.min.js"></script>

        <?php
            $favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
            $favicon = json_decode($favicon, true);
            if (!empty($favicon) && file_exists('uploads/favicon/'.$favicon[0]['image'])) {
        ?>
                <link href="<?php echo base_url()?>uploads/favicon/<?php echo $favicon[0]['image']?>" rel="icon" type="image/png">
        <?php
            }
            else {
        ?>
                <link href="<?php echo base_url()?>uploads/favicon/default_image.png" rel="icon" type="image/png">
        <?php
            }
        ?>
	<style>
		.reg_active{
			font-size: x-large;
			color: #fff !important;
			text-decoration: underline;
		}
	</style>
    </head>
    <body>
        <?php include 'preloader.php';?>
        <?php include_once 'header/header.php';?>
        <?php
            $registration_image = $this->db->get_where('frontend_settings', array('type' => 'registration_image'))->row()->value;
            $registration_image_data = json_decode($registration_image, true);

        ?>
        <section class="slice-lg has-bg-cover bg-size-cover" style="background-image: url(<?php echo base_url()?>uploads/registration_image/<?php echo $registration_image_data[0]['image']?>); background-position: bottom bottom;">
            <span class="mask mask-dark--style-2"></span>
            <div class="container">
                <div class="row cols-xs-space align-items-center text-center text-md-left">
                    <div class="col-lg-7 col-md-10 ml-auto mr-auto">
                        <div class="form-card form-card--style-2 z-depth-3-top">
                            <div class="form-body">
								<center>
									<div class="reg_pad1 fontreg">
										<div class="brdrb_1">
											<div class="fullwid txtc f15 tabone clearfix">
												<a style="cursor:default" class="fl reg_active">Profile Details</a>
												<a style="cursor:default" class="fl">Career Details</a>
												<a style="cursor:default" class="fl">Lifestyle &amp; Family</a>
												<a style="cursor:default" class="fl">Contact Details</a>
											</div>
										</div>
									</div>
								</center>
                                
                                <form class="form-default mt-4" id="register_form" method="post" action="<?php echo base_url()?>home/registration/sumit_profile_details">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('date_of_birth')?></label>
                                                <input type="date" required class="form-control form-control-sm" name="date_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Religion" ?></label>
                                                <select name="religion" required class="form-control form-control-sm" data-placeholder="Choose a religion" >
													<option value="">Choose one</option>
													<?php 
														foreach ($religion as $rk => $rv) {
															?>
																<option value="<?php echo $rv->religion_id; ?>"><?php echo $rv->name;  ?></option>
															<?php
														}
													?>
													
												</select>
                                        </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Caste" ?></label>
                                                <select name="caste"  class="form-control form-control-sm" data-placeholder="Choose a caste" >
													<option value=""></option>
													<?php 
														foreach ($caste as $kkk => $vvv) {
															?>
																<!--option value="<?php echo $vvv->caste_id; ?>"><?php echo $vvv->name;  ?></option-->
															<?php
														}
													?>
												</select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Gotra" ?></label>
                                                <input type="text" class="form-control form-control-sm" name="subcaste" value="<?php if(!empty($form_contents)){echo $form_contents['subcaste'];}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="ml-0 form-check-input" type="checkbox" value="1" name="no_bar">
                                                <label class="ml-4   control-label font_light">Select "Caste no bar" if you are not particular about caste </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Marital status" ?></label>
                                                <select name="marital_status" required class="form-control form-control-sm" data-placeholder="Choose a marital status" >
													<option value="">Choose one</option>
													<?php 
														foreach ($marital_status as $k => $v) {
															?>
																<option value="<?php echo $v->marital_status_id; ?>"><?php echo $v->name;  ?></option>
															<?php
														}
													?>
													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none" id="child_status_field">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Child Status" ?></label>
                                                <?php
                                                    if (!empty($form_contents)) {
                                                        echo $this->Crud_model->select_html('child_status', 'child_status', 'name', 'edit', 'form-control form-control-sm ', $form_contents['child_status'], '', '', '');
                                                    }
                                                    else {
                                                        echo $this->Crud_model->select_html('child_status', 'child_status', 'name', 'add', 'form-control form-control-sm ', '', '', '', '');
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none" id="child_count_field">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "No. of Children" ?></label>
                                                <select name="child_count"  class="form-control form-control-sm" data-placeholder="Choose No. of Children" >
													<option value="">Choose one</option>
													<?php 
														foreach ($child_count as $k => $v) {
															?>
																<option value="<?php echo $v->child_count_id; ?>"><?php echo $v->display;  ?></option>
															<?php
														}
													?>
													
												</select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo "Height" ?></label>
                                                <select name="p_height" required class="form-control form-control-sm" data-placeholder="Choose your height" >
													<option value="">Choose one</option>
													<?php 
														foreach ($user_heights as $k => $v) {
															?>
																<option value="<?php echo $v->user_height_id; ?>"><?php echo $v->display;  ?></option>
															<?php
														}
													?>
													
												</select>
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
                                    
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom mt-2" style="width: 100%">
                                            <?php echo "Next" ?>
                                        </button>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center" style="font-size: 12px;">
                                                <a class="c-gray-light" onclick="window.history.go(-1); return false;" href="#" class=""><?php echo "Back" ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FOOTER -->
		<?php include_once'footer/footer.php';?>
        <!-- SCRIPTS -->
        <a href="#" class="back-to-top btn-back-to-top"></a>
        <!-- Core -->
        <script src="<?php echo base_url()?>template/front/vendor/popper/popper.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>template/front/js/vendor/jquery.easing.js"></script>
        <script src="<?php echo base_url()?>template/front/js/ie10-viewport-bug-workaround.js"></script>
        <script src="<?php echo base_url()?>template/front/js/slidebar/slidebar.js"></script>
        <script src="<?php echo base_url()?>template/front/js/classie.js"></script>
        <!-- Bootstrap Extensions -->
        <script src="<?php echo base_url()?>template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/bootstrap-notify/bootstrap-growl.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/scrollpos-styler/scrollpos-styler.js"></script>
        <!-- Plugins -->
        <script src="<?php echo base_url()?>template/front/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/footer-reveal/footer-reveal.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/sticky-kit/sticky-kit.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/swiper/js/swiper.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/paraxify/paraxify.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/viewport-checker/viewportchecker.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/milestone-counter/jquery.countTo.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/countdown/js/jquery.countdown.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/typed/typed.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/instafeed/instafeed.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/gradientify/jquery.gradientify.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/nouislider/js/nouislider.min.js"></script>
        <!-- Isotope -->
        <script src="<?php echo base_url()?>template/front/vendor/isotope/isotope.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <!-- Light Gallery -->
        <script src="<?php echo base_url()?>template/front/vendor/lightgallery/js/lightgallery.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/lightgallery/js/lg-thumbnail.min.js"></script>
        <script src="<?php echo base_url()?>template/front/vendor/lightgallery/js/lg-video.js"></script>
        <!-- App JS -->
        <script src="<?php echo base_url()?>template/front/js/wpx.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.top_bar_right').load('<?php echo base_url(); ?>home/top_bar_right');
                
                //Decide if the child_status field should be shown or not
                checkChildStatus();
                $('select[name="marital_status"]').on('change', '', function (e) {
                    checkChildStatus();
                });
                checkChildCount();
                $('select[name="child_status"]').on('change', '', function (e) {
                    checkChildCount();
                });

                //fetchCaste();
                $('select[name="religion"]').change(function(){

                      	var stateId = $(this).val();
                      	$.ajax({
                      	    
                            url:"<?php echo base_url()?>home/get_dropdown_by_id_caste_by_id",
                            method:"POST",
                            dataType: 'html', // request type html/json/xml
                            data:{id: stateId},
                            success:function(data)
                            {
                                console.log('success');
                               $('select[name="caste"]').html(data)
                            },
                            error: function(error){
                                console.log(error);
                            }
                        });
                });
            });
            
            
            function checkChildStatus() {
                var selectVal = $('select[name="marital_status"] option:selected').val();
                    if( selectVal>1 )
                        $("#child_status_field").removeClass('d-none');
                    else
                        $("#child_status_field").addClass('d-none');
            }
            function checkChildCount() {
                var selectVal = $('select[name="child_status"] option:selected').val();
                    if( selectVal==1 )
                        $("#child_count_field").removeClass('d-none');
                    else
                        $("#child_count_field").addClass('d-none');
            }
        </script>
    </body>
</html>
