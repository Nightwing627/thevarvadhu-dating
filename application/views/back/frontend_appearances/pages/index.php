<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('frontend_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>

			<li><a href="#"><?php echo translate('frontend_settings')?></a></li>
			<li><a href="#"><?php echo translate('frontend_appearances')?></a></li>
			<li class="active"><a href="#"><?php echo translate('pages')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
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
				<h3 class="panel-title"><?php echo translate('manage_frontend_pages')?></h3>
			</div>
			<div class="panel-body">

				<div class="tab-base tab-stacked-left">
		            <!--Nav tabs-->
		            <ul class="nav nav-tabs" style="width: 145px;">
		                <li class="active">
		                    <a data-toggle="tab" href="#tab-1"><?php echo translate('home')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-7"><?php echo translate('listing')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-2"><?php echo translate('premium_plans')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-3"><?php echo translate('happy_stories')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-4"><?php echo translate('contact_us')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-5"><?php echo translate('log_in')?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" href="#tab-6"><?php echo translate('registration')?></a>
		                </li>
		                <?php $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
		                	if($member_approval == 'yes'){ ?>
			                	<li>
			                    	<a data-toggle="tab" href="#tab-8"><?php echo translate('registration_when_member_approval_on')?></a>
			                	</li>
		                <?php } ?>
						<li>
		                    <a data-toggle="tab" href="#tab-9"><?php echo translate('email_verification_message')?></a>
		                </li>


		            </ul>

		            <!--Tabs Content-->
		            <div class="tab-content">
		                <div id="tab-1" class="tab-pane fade active in">
		                    <?php include_once "home.php";?>
		                </div>
		                <div id="tab-7" class="tab-pane fade">
		                    <?php include_once "listing_page.php";?>
		                </div>
		                <div id="tab-2" class="tab-pane fade">
		                    <?php include_once "premium_plans.php";?>
		                </div>
		                <div id="tab-3" class="tab-pane fade">
	                   		<?php include_once "happy_stories.php";?>
		                </div>
		                <div id="tab-4" class="tab-pane fade">
		                    <?php include_once "contact_us.php";?>
		                </div>
		                <div id="tab-5" class="tab-pane fade">
		                    <?php include_once "login.php";?>
		                </div>
		                <div id="tab-6" class="tab-pane fade">
		                    <?php include_once "registration.php";?>
		                </div>
		                <div id="tab-8" class="tab-pane fade">
		                    <?php include_once "after_registration_message.php";?>
		                </div>
						<div id="tab-9" class="tab-pane fade">
		                    <?php include_once "email_verification_message.php";?>
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
	    $('.textarea').wysihtml5();
	})
</script>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
