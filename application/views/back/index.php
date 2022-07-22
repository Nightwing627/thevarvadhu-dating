<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once "top/".$top;?>
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

<?php include_once "bottom/".$bottom;?>
</head>
<body>
	<!-- START OF CONTAINER -->
	<div id="container" class="effect aside-float aside-bright mainnav-lg">
		<?php include_once "header.php";?>
		<div class="boxed">
			<?php 
				include_once $folder."/".$file;
				//include_once "aside.php";
				include_once "navigation.php";
			?>
		</div>
		<?php include_once "footer.php";?>
		<!-- SCROLL PAGE BUTTON -->
		<!--===================================================-->
		<button class="scroll-top btn">
			<i class="pci-chevron chevron-up"></i>
		</button>
		<!--===================================================-->
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->
</body>
</html>
