<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('general_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('general_settings')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!-- Basic Data Tables -->
		<!--===================================================-->
		<div class="panel">
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('manage_settings')?></h3>
			</div>
			<div class="panel-body">

				<div class="tab-base tab-stacked-left">
		            <!--Nav tabs-->
		            <ul class="nav nav-tabs" style="width: 145px;">
		                <li class="active">
		                    <a data-toggle="tab" href="#demo-stk-lft-tab-1"><?php echo translate('general_settings')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#demo-stk-lft-tab-2"><?php echo translate('SMTP_settings')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#demo-stk-lft-tab-3"><?php echo translate('social_links')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#demo-stk-lft-tab-4"><?php echo translate('terms_&_conditions')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#demo-stk-lft-tab-5"><?php echo translate('privacy_policy')?></a>
		                </li>
		            </ul>

		            <!--Tabs Content-->
		            <div class="tab-content">
		                <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
		                    <?php include_once "general_settings.php";?>
		                </div>
		                <div id="demo-stk-lft-tab-2" class="tab-pane fade">
		                    <?php include_once "smtp_settings.php";?>
		                </div>
		                <div id="demo-stk-lft-tab-3" class="tab-pane fade">
		                    <?php include_once "social_links.php";?>
		                </div>
		                <div id="demo-stk-lft-tab-4" class="tab-pane fade">
	                   		<?php include_once "terms_and_conditions.php";?>
		                </div>
		                <div id="demo-stk-lft-tab-5" class="tab-pane fade">
		                    <?php include_once "privacy_policy.php";?>
		                </div>
		            </div>
		        </div>

			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
	    //bootstrap WYSIHTML5 - text editor
	    $('.textarea').wysihtml5({
	        toolbar: {
	            "image": false // Button to insert an image.
	        }
	    });
	})
</script>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
