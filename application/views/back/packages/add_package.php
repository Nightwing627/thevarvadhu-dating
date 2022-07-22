<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('premium_package')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('premium_packages')?></a></li>
			<li class="active"><a href="#"><?php echo translate('add_package')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!--Block Styled Form -->
		<!--===================================================-->
        <div class="row">
            <div class="col-md-8 col-lg-offset-2">
		        <div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('add_package')?></h3>
			</div>
			<!--Horizontal Form-->
			<!--===================================================-->
			<form class="form-horizontal" id="package_form" method="POST" action="<?=base_url()?>admin/packages/do_add" enctype="multipart/form-data">
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="demo-hor-name"><b><?php echo translate('package_name')?></b></label>
						<div class="col-sm-9">
							<!-- <input type="hidden" class="form-control" name="plan_id" value="<?=$value->plan_id?>"> -->
							<input type="text" class="form-control" name="name" value="" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="demo-hor-amount"><b><?php echo translate('amount')?></b></label>
						<div class="col-sm-9">
							<div class="input-group">
								<div class="input-group-addon"><?=currency('', 'def')?></div>
								<input type="text" class="form-control" name="amount" value="" required="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="express_interest"><b><?php echo translate('express_interest')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="express_interest" value="" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="direct_messages"><b><?php echo translate('direct_messages')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="direct_messages" value="" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="photo_gallery"><b><?php echo translate('photo_gallery')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="photo_gallery" value="" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="image"><b><?php echo translate('package_image')?></b></label>
	                    <div class="col-sm-10">
		                    <div class="col-sm-6" style="margin:2px; padding:2px;">
								<img class="img-responsive img-border blah" src="<?=base_url()?>uploads/plan_image/default_image.png" class="img-sm">
		                    </div>
		                    <!-- <div class="col-sm-2"></div> -->
		                </div>
		                <div class="col-sm-12" style="margin-top: 10px">
		                    <div class="col-sm-10 col-sm-offset-2" >
		                        <span class="pull-left btn btn-default btn-file margin-top-10">
		                            <?php echo translate('select_a_photo')?>
		                            <input type="file" name="image" class="form-control imgInp">
		                        </span>
		                    </div>
		                </div>
					</div>
				</div>
				<div class="panel-footer text-right">
					<a href="<?=base_url()?>admin/packages" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
					<!-- <a href="#" class="btn btn-primary" type="submit">Submit</a> -->
	                <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
				</div>
			</form>
			<!--===================================================-->
			<!--End Horizontal Form-->
		</div>
            </div>
        </div>
		<!--===================================================-->
		<!--End Block Styled Form -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<script>
	$(function () {
	    //bootstrap WYSIHTML5 - text editor
	    $('.textarea').wysihtml5();
	})
</script>
<script>
	// SCRIT FOR IMAGE UPLOAD
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".panel-body").on('change', '.imgInp', function () {
        readURL_all(this);
    });
</script>
