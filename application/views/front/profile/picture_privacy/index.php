<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('picture_privacy_settings')?></b></h3>
</div>
<?php 
	$pic_privacy = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'pic_privacy');
    $pic_privacy_data = json_decode($pic_privacy, true);
 ?>
<div class="card-body">
    <form class="form-default col-12" id="picture_privacy_form" method="post" role="form">
		<div class="row">
		    <div class="col-md-10 ml-auto mr-auto">
		        <div class="form-group has-feedback">
		            <label for="profile_picture" class="control-label"><?php echo translate('profile_picture')?></label>
		            <select class="form-control" name="profile_pic_show">
		            	<option value="only_me" <?php if($pic_privacy_data[0]['profile_pic_show']=='only_me'){echo "selected";} ?> class="form-control"><?php echo translate('only_me')?></option>
		            	<option value="all" <?php if($pic_privacy_data[0]['profile_pic_show']=='all'){echo "selected";} ?> class="form-control"><?php echo translate('all_member')?></option>
		            	<option value="premium" <?php if($pic_privacy_data[0]['profile_pic_show']=='premium'){echo "selected";} ?> class="form-control"><?php echo translate('premium_member')?></option>
		            </select>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors">
		            </div>
		        </div>
		    </div>
		    <div class="col-md-10 ml-auto mr-auto">
		        <div class="form-group has-feedback">
		            <label for="gallery_images" class="control-label"><?php echo translate('gallery_images')?></label>
		            <select class="form-control" name="gallery_show">
		            	<option value="only_me" <?php if($pic_privacy_data[0]['gallery_show']=='only_me'){echo "selected";} ?> class="form-control"><?php echo translate('only_me')?></option>
		            	<option value="all"  <?php if($pic_privacy_data[0]['gallery_show']=='all'){echo "selected";} ?> class="form-control"><?php echo translate('all_member')?></option>
		            	<option value="premium" <?php if($pic_privacy_data[0]['gallery_show']=='premium'){echo "selected";} ?> class="form-control"><?php echo translate('premium_member')?></option>
		            </select>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors">
		            </div>
		        </div>
		    </div>
		    <div class="col-md-10 ml-auto mr-auto">
		    	<div class="form-group has-feedback text-center">
		    		<div class="text-danger" id="validation_error"> <!-- Shows Validation Errors --> </div>
		            <button type="button" class="btn btn-sm btn-base-1 btn-shadow mt-2" id="btn_privacy" style="width: 25%"><?php echo translate('save')?></button>
		        </div>
		    </div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		var new_pass = "";
		var confirm_pass = "";

		$("#btn_privacy").click(function(){
			$('#btn_privacy').html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>...");
			$.ajax({
	            type: "POST",
	            url: "<?=base_url()?>home/profile/update_pic_privacy",
	            cache: false,
	            data: $('#picture_privacy_form').serialize(),
	            success: function(response) {
	                
	                    $('#btn_privacy').html("<?php echo translate('save')?>");
	                    $('#ajax_alert').html("<div class='alert alert-success fade show' role='alert'><?php echo translate('you_have_successfully_edited_picture_privacy!')?></div>");
	                    $('#ajax_alert').show();
	                    setTimeout(function() {
	                        $('#ajax_alert').fadeOut('fast');
	                    }, 6000); // <-- time in milliseconds
	                
	            },
	            fail: function (error) {
	                alert(error);
	            }
	        });
		});
	});
</script>