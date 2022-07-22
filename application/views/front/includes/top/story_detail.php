
<!-- Meta Tags -->
<?php
    $meta_title = $this->db->get_where('general_settings', array('general_settings_id' => 89))->row()->value;
    $meta_keywords = $this->db->get_where('general_settings', array('general_settings_id' => 25))->row()->value;
    $meta_description = $this->db->get_where('general_settings', array('general_settings_id' => 24))->row()->value;
    $site_name = $this->db->get_where('general_settings', array('general_settings_id' => 1))->row()->value;
	foreach ($get_story as $value)
	{
		$images = json_decode($value->image, true);
		$story_image =  $images[0]['img'];
	}
	$story_image_url = base_url()."uploads/happy_story_image/".$story_image;


?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $meta_description; ?>">
<meta name="keywords" content="<?php echo $meta_keywords; ?>">
<meta name="author" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 26))->row()->value?>">
<meta name="revisit-after" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 54))->row()->value?> day(s)">

<!-- Open Graph data -->
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php  echo base_url().$page_url; ?>" />
<meta property="og:image" content="<?php echo $story_image_url; ?>" />
<meta property="og:description" content="<?php echo $meta_description; ?>" />
<meta property="og:site_name" content="<?php echo $site_name; ?>" />


<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php echo $site_name; ?>">
<meta name="twitter:title" content="<?php echo $meta_title; ?>">
<meta name="twitter:description" content="<?php echo $meta_description; ?>">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="<?php echo $story_image_url; ?>">

<!-- Meta tags -->


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
<!-- Sharing -->
<link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/plugins/share/jquery.share.css" rel="stylesheet" media="screen">

<script src="<?=base_url()?>template/front/vendor/jquery/jquery.min.js"></script>
