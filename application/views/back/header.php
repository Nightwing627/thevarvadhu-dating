<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
<div id="navbar-container" class="boxed">
	<!--Brand logo & name-->
	<!--================================-->
	<div class="navbar-header">
		<a href="<?php echo base_url()?>admin" class="navbar-brand">
		<?php
            $favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
            $favicon = json_decode($favicon, true);
            if (!empty($favicon) && file_exists('uploads/favicon/'.$favicon[0]['image'])) {
        ?>
        		<img src="<?php echo base_url()?>uploads/favicon/<?php echo $favicon[0]['image']?>" alt="Active Matrimony Logo" class="brand-icon" style="padding: 5px">
                <!-- <link href="<?php echo base_url()?>uploads/favicon/<?php echo $favicon[0]['image']?>" rel="icon" type="image/png"> -->
        <?php
            }
            else {
        ?>
        		<img src="<?php echo base_url()?>uploads/favicon/default_image.png" alt="Active Matrimony Logo" class="brand-icon" style="padding: 5px">
                <!-- <link href="<?php echo base_url()?>uploads/favicon/default_image.png" rel="icon" type="image/png"> -->
        <?php
            }
        ?>

		<div class="brand-title hidden-sm hidden-xs">
			<span class=""><?php echo $this->system_name?></span>
		</div>
		</a>
	</div>
	<!--================================-->
	<!--End brand logo & name-->
	<!--Navbar Dropdown-->
	<!--================================-->
	<div class="navbar-content clearfix">
		<ul class="nav navbar-top-links pull-left">
			<!--Navigation toogle button-->
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<li class="tgl-menu-btn">
			<a class="mainnav-toggle" href="#">
			<i class="fa fa-bars" aria-hidden="true"></i>
			</a>
			</li>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<!--End Navigation toogle button-->
		</ul>
		<?php if(demo()){ ?>
			<ul class="nav navbar-top-links pull-left">
				<p style="margin-top: 20px;margin-left: 20px;"><i class="text-danger blink_me fa fa-exclamation-triangle" style="font-size: 16px"></i> For Demo purpose some functionality &amp; all image uploads are DISABLED</p>
			</ul>
		<?php } ?>

		<ul class="nav navbar-top-links pull-right">
			<!--Language selector-->
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<li>
			<div class="lang-selected" style="margin-top:12px;">
				<a href="<?php echo base_url()?>home" target="_blank" class="btn btn-dark btn-sm" style="border-radius: 3px;"><i class="fa fa-desktop"></i> <?php echo translate('visit_home_page')?></a>
			</div>
			</li>
			<li id="dropdown-user" class="dropdown">
			<a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
			<span class="ic-user pull-right">
			<!--<img class="img-circle img-user media-object" src="<?php echo base_url()?>template/back/img/profile-photos/1.png" alt="Profile Picture">-->
			<i class="psi-administrator"></i>
			</span>
			<div class="username hidden-xs">
				<?php echo $this->session->userdata('admin_name')?>
			</div>
			</a>
			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
				<!-- Dropdown heading  -->

				<!-- User dropdown menu -->
				<ul class="head-list">
					<li>
					<a href="<?php echo base_url()?>admin/manage_admin">
					<i class="demo-pli-gear icon-lg icon-fw"></i><?php echo translate('manage_profile')?></a>
					</li>
					<li>
					<a href="<?php echo base_url()?>admin/logout">
					<i class="demo-pli-unlock icon-lg icon-fw"></i> <?php echo translate('logout')?> </a>
					</li>
				</ul>
			</div>
			</li>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<!--End user dropdown-->
		</ul>
	</div>
	<!--================================-->
	<!--End Navbar Dropdown-->
</div>
<style>
	.blink_me {
		animation: blinker 1.5s linear infinite;
	}
	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
</style>
</header>
<!--===================================================-->
<!--END NAVBAR-->
