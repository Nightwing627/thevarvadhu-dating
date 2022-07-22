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
        $admin_login_image = $this->db->get_where('general_settings', array('type' => 'admin_login_image'))->row()->value;
        $admin_login_image = json_decode($admin_login_image, true);
        if (!empty($admin_login_image) && file_exists('uploads/admin_login_image/'.$admin_login_image[0]['image'])) {
            $admin_login_image_url = base_url()."uploads/admin_login_image/".$admin_login_image[0]['image'];
        ?>
            <div id="container" class="cls-container" style="background:url(<?php echo $admin_login_image_url?>);background-repeat: no-repeat;background-size: cover;background-position: center top;">
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
		                <p><?php echo translate('admin_sign_in')?></p>
                        <p style="color: red">
                            <?php
                                if (!empty($login_error)){
                                    echo $login_error;
                                }
                            ?>
                        </p>
                        <p style="color: green">
                            <?php
                                if (!empty($success_alert)){
                                    echo $success_alert;
                                }
                            ?>
                        </p>
		            </div>
		            <form action="<?php echo base_url()?>admin/check_login" method="POST">
		                <div class="form-group">
		                    <input type="text" class="form-control" name="email" id="inp_usr_nm" placeholder="Username" autofocus required>
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" name="password" id="inp_pass" placeholder="Password" required>
		                </div>
		                <button class="btn btn-dark btn-block" type="submit"><?php echo translate('sign_in')?></button>
		            </form>
		        </div>

		        <div class="pad-all">
		            <a href="<?php echo base_url()?>admin/forget_pass" class="btn-link mar-rgt"><?php echo translate('forgot_password?')?></a>
		        </div>
		    </div>
		</div>
        <?php if(demo()){ ?>
            <div class="cls-content" style="padding-top: 0px">
               <div class="cls-content-sm panel">
                   <div class="panel-body">
                       <div class="mar-ver">
                           <h1 class="h4" style="color: #7b8d96;">Sign In Details</h1>
                           <div>
                               <p style="color:#ccc;"><b>Username:</b> <span id="usr_nm">admin@matrimonial.com</span></p>
                               <p style="color:#ccc;"><b>Password:</b> <span id="pass">1234</span></p>
                               <button type="button" class="btn btn-dark btn-xs cpy_btn" style="width: 100px"><?php echo translate('copy')?></button>
                           </div>
                       </div>
                   </div>
               </div>
        <?php } ?>
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->

    <style>
        #container .table-bordered, #container .table-bordered td, #container .table-bordered th {
            border-color: #7b8d96;
            color: #b8c3c8;
        }
        .cpy_btn {
            border: 1px solid #7b8d96;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.cpy_btn').click(function(){
                $('#inp_usr_nm').val($('#usr_nm').html());
                $('#inp_pass').val($('#pass').html());
            })
        })
    </script>

</body>
</html>
