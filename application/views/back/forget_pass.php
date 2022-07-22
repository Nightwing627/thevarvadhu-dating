<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || <?php echo $this->system_title?></title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
<!--     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'> -->


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url()?>template/back/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url()?>template/back/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>template/back/css/theme-dark.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="<?php echo base_url()?>template/back/css/demo/nifty-demo-icons.min.css" rel="stylesheet">


        
    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url()?>template/back/css/demo/nifty-demo.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="<?php echo base_url()?>template/back/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">

    <!-- favicon -->
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
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php echo base_url()?>template/back/plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?php echo base_url()?>template/back/plugins/pace/pace.min.js"></script>


    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url()?>template/back/js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url()?>template/back/js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url()?>template/back/js/nifty.min.js"></script>

    <!--=================================================-->
    
    <!--Background Image [ DEMONSTRATION ]-->
    <script src="<?php echo base_url()?>template/back/js/demo/bg-images.js"></script>

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
	<?php
        $forget_pass_image = $this->db->get_where('general_settings', array('type' => 'forget_pass_image'))->row()->value;
        $forget_pass_image = json_decode($forget_pass_image, true);
        if (!empty($forget_pass_image) && file_exists('uploads/forget_pass_image/'.$forget_pass_image[0]['image'])) {
            $forget_pass_image_url = base_url()."uploads/forget_pass_image/".$forget_pass_image[0]['image'];
        ?>
            <div id="container" class="cls-container" style="background:url(<?php echo $forget_pass_image_url?>);background-repeat: no-repeat;background-size: cover;background-position: center top;">
        <?php
        } else {
        ?>
            <div id="container" class="cls-container">
        <?php
        }
    ?>
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
                        <?php
                            $footer_logo = $this->db->get_where('frontend_settings', array('type' => 'footer_logo'))->row()->value;
                            $footer_logo = json_decode($footer_logo, true);
                            if (!empty($footer_logo) && file_exists('uploads/footer_logo/'.$footer_logo[0]['image'])) {
                        ?>
                                <img src="<?php echo base_url()?>uploads/footer_logo/<?php echo $footer_logo[0]['image']?>" style="width:70% ">
                        <?php
                            }
                            else {
                        ?>
                                <img src="<?php echo base_url()?>uploads/footer_logo/default_image.png" style="width: 70% ">
                        <?php
                            }
                        ?>
		                <h1 class="h4" style="margin-top: 35px"><?php echo $this->system_name?></h1>
		                <p><?php echo translate('forgot_password?')?></p>
                        <p style="color: red">
                            <?php 
                                if (!empty($login_error)){
                                    echo $login_error;
                                }
                            ?>
                        </p>
		            </div>
		            <form action="<?php echo base_url()?>admin/submit_forget_pass" method="POST">
		                <div class="form-group">
		                    <input type="email" class="form-control" name="email" placeholder="Email" autofocus required>
		                </div>
		                <button class="btn btn-dark btn-block" type="submit"><?php echo translate('submit')?></button>
		            </form>
		        </div>
		
		        <div class="pad-all">
		            <a href="<?php echo base_url()?>admin/login" class="btn-link mar-rgt"><?php echo translate('log_in')?></a>
		            <!-- <a href="#" class="btn-link mar-lft"><?php echo translate('create_a_new_account')?></a> -->
		        </div>
		    </div>
		</div>
		<!--===================================================-->		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->


</body>
</html>
