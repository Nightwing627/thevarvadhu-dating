<?php include_once 'meta.php'; ?>
<!-- Page loader -->
<script src="<?=base_url()?>template/front/vendor/pace/js/pace.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/pace/css/pace-minimal.css" type="text/css">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
<!-- Plugins -->
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/swiper/css/swiper.min.css">
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/hamburgers/hamburgers.min.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/animate/animate.min.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/vendor/lightgallery/css/lightgallery.min.css">
<!-- Icons -->
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/font-awesome/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/ionicons/css/ionicons.min.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/line-icons/line-icons.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/line-icons-pro/line-icons-pro.css" type="text/css">
<!-- Linea Icons -->
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/arrows/linea-icons.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/basic/linea-icons.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/ecommerce/linea-icons.css" type="text/css">
<link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/software/linea-icons.css" type="text/css">
<!-- Global style (main) -->
<?php
	$theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value;
	if ($theme_color == 'default-color') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'pink') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-pink.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'purple') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-purple.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'light-blue') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-light-blue.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'green') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-green.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'dark') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-dark.css" rel="stylesheet" media="screen">
	<?php
	} elseif ($theme_color == 'super-dark') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-super-dark.css" rel="stylesheet" media="screen">
	<?php
	}
	elseif ($theme_color == 'orange') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-orange.css" rel="stylesheet" media="screen">
	<?php
	}
	elseif ($theme_color == 'red') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-red.css" rel="stylesheet" media="screen">
	<?php
	}
	elseif ($theme_color == 'black') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-black.css" rel="stylesheet" media="screen">
	<?php
	}
	elseif ($theme_color == 'blue') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-blue.css" rel="stylesheet" media="screen">
	<?php
	}
	elseif ($theme_color == 'ightseagreen') { ?>
		<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-ightseagreen.css" rel="stylesheet" media="screen">
	<?php
	}
?>
<!-- Custom style - Remove if not necessary -->
<link type="text/css" href="<?=base_url()?>template/front/css/custom-style.css" rel="stylesheet">
<!-- Favicon -->

<!-- SCRIPTS -->
<!-- Core -->
<script src="<?=base_url()?>template/front/vendor/jquery/jquery.min.js"></script>
