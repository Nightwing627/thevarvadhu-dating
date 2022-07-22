<style>
#loading-center{
	width: 100%;
	height: 100%;
	position: relative;
	}
#loading-center-absolute {
	position: absolute;
	left: 50%;
	top: 50%;
	height: 50px;
	width: 150px;
	margin-top: -25px;
	margin-left: -75px;

}
.object{
	width: 8px;
	height: 50px;
	margin-right:5px;
	background-color: white;
	-webkit-animation: animate 1s infinite;
	animation: animate 1s infinite;
	float: left;
	}

.object:last-child {
	margin-right: 0px;
	}

.object:nth-child(10){
	-webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;	
	}
.object:nth-child(9){
	-webkit-animation-delay: 0.8s;
    animation-delay: 0.8s;	
	}	
.object:nth-child(8){
	-webkit-animation-delay: 0.7s;
    animation-delay: 0.7s;	
	}
.object:nth-child(7){
	-webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;	
	}
.object:nth-child(6){
	-webkit-animation-delay: 0.5s;
    animation-delay: 0.5s;	
	}
.object:nth-child(5){
	-webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
	}
.object:nth-child(4){
	-webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;		
	}
.object:nth-child(3){
	-webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;	
	}
.object:nth-child(2){
	-webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;
	}						
@-webkit-keyframes animate {
 
  50% {
	-ms-transform: scaleY(0); 
   	-webkit-transform: scaleY(0);
    transform: scaleY(0);	
	}
}
@keyframes animate {
  50% {
	-ms-transform: scaleY(0); 
   	-webkit-transform: scaleY(0);
    transform: scaleY(0);
	}
}
<?php
	$theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value; 
	if ($theme_color == 'default-color') {
		$preloader_bg = "#5E32E1";
	} elseif ($theme_color == 'pink') {
		$preloader_bg = "#E91E63";
	} elseif ($theme_color == 'purple') {
		$preloader_bg = "#9C27B0";
	} elseif ($theme_color == 'light-blue') {
		$preloader_bg = "#03A9F4";
	} elseif ($theme_color == 'green') {
		$preloader_bg = "#4CAF50";
	} elseif ($theme_color == 'dark') {
		$preloader_bg = "#5E32E1";
	} elseif ($theme_color == 'super-dark') {
		$preloader_bg = "#5E32E1";
	}
?>
#loading{
	background-color: <?php echo $preloader_bg; ?>;
	height: 100%;
	width: 100%;
	position: fixed;
	z-index: 1050;
	margin-top: 0px;
	top: 0px;
}
</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
            <div class="object"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
	//$(window).load(function() {
	$(document).ready(function(e) {
		$("#loading").delay(500).fadeOut(500);
		$("#loading-center").click(function() {
			$("#loading").fadeOut(500);
		});
	});
</script>