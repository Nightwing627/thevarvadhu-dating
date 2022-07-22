<!--Default Accordion-->
<!--===================================================-->
<div class="panel-group accordion" id="accordion">
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#home_slider"><?php echo translate('slider_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse in" id="home_slider">
            <div class="panel-body">
				<?php include_once "home_sections/slider.php";?>
            </div>
        </div>
    </div>
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#home_premium_members"><?php echo translate('premium_members_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse" id="home_premium_members">
            <div class="panel-body">
				<?php include_once "home_sections/premium_members.php";?>
            </div>
        </div>
    </div>
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#home_parallax"><?php echo translate('parallax_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse" id="home_parallax">
            <div class="panel-body">
				<?php include_once "home_sections/parallax_info.php";?>
            </div>
        </div>
    </div>
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#home_happy_stories"><?php echo translate('happy_stories_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse" id="home_happy_stories">
            <div class="panel-body">
				<?php include_once "home_sections/happy_stories.php";?>
            </div>
        </div>
    </div>
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#collapseThree"><?php echo translate('premium_plans_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse" id="collapseThree">
            <div class="panel-body">
                <?php include_once "home_sections/premium_plans.php";?>
            </div>
        </div>
    </div>
    <div class="panel">
        <!--Accordion title-->
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" data-toggle="collapse" href="#collapseFour"><?php echo translate('contact_information_section')?></a>
            </h4>
        </div>
        <!--Accordion content-->
        <div class="panel-collapse collapse" id="collapseFour">
            <div class="panel-body">
                <?php include_once "home_sections/contact_info.php";?> 
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Accordion-->