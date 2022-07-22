<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('premium_plans')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('premium_plans')?></a></li>
			<li class="active"><a href="#"><?php echo translate('edit_package')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('edit_package')?></h3>
			</div>
			<!--Horizontal Form-->
			<!--===================================================-->
			<?php
				foreach ($get_plan as $value) 
				{
			?>
			<form class="form-horizontal" id="package_form" method="POST" action="<?=base_url()?>admin/packages/update" enctype="multipart/form-data">
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="demo-hor-name"><b><?php echo translate('package_name')?></b></label>
						<div class="col-sm-9">
							<input type="hidden" class="form-control" name="plan_id" value="<?=$value->plan_id?>">
							<input type="text" class="form-control" name="name" value="<?=$value->name?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="demo-hor-amount"><b><?php echo translate('amount')?></b></label>
						<div class="col-sm-9">
							<div class="input-group">
								<div class="input-group-addon"><?=currency('', 'def')?></div>
								<input type="text" class="form-control" name="amount" required="" value="<?=$value->amount?>"<?php if($value->plan_id == '1') {?> readonly <?php }?>>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="express_interest"><b><?php echo translate('express_interest')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="express_interest" value="<?=$value->express_interest?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="direct_messages"><b><?php echo translate('direct_messages')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="direct_messages" value="<?=$value->direct_messages?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="photo_gallery"><b><?php echo translate('photo_gallery')?></b></label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="photo_gallery" value="<?=$value->photo_gallery?>" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="image"><b><?php echo translate('package_image')?></b></label>
	                    <div class="col-sm-10">
		                    <div class="col-sm-6" style="margin:2px; padding:2px;">
		                    	<?php
									$image = $value->image;
									$images = json_decode($image, true);
									//print_r($images);
									if (file_exists('uploads/plan_image/'.$images[0]['image'])) {
	                                ?>
										<img class="img-responsive img-border blah" src="<?=base_url()?>uploads/plan_image/<?=$images[0]['image']?>" class="img-sm">
									<?php
									}
									else {
									?>
										<img class="img-responsive img-border blah" src="<?=base_url()?>uploads/plan_image/default_image.png" class="img-sm">
									<?php
									}
								?>
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
			<?php
			}
			?>
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