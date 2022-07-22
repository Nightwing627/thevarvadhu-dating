<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('change_password')?></b></h3>
</div>
<div class="card-body">
    <form class="form-default col-12" id="change_password_form" method="post" role="form">
		<div class="row">
		    <div class="col-md-10 ml-auto mr-auto">
		        <div class="form-group has-feedback">
		            <label for="current_password" class="control-label"><?php echo translate('current_password')?></label>
		            <input type="password" class="form-control" name="current_password" id="current_password" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors">
		            </div>
		        </div>
		    </div>
		    <div class="col-md-10 ml-auto mr-auto">
		        <div class="form-group has-feedback">
		            <label for="new_password" class="control-label"><?php echo translate('new_password')?></label>
		            <input type="password" class="form-control" name="new_password" id="new_password" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors">
		            </div>
		        </div>
		    </div>
		    <div class="col-md-10 ml-auto mr-auto">
		        <div class="form-group has-feedback">
		            <label for="confirm_password" class="control-label"><?php echo translate('confirm_password')?></label>
		            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
		            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		            <div class="help-block with-errors">
		            </div>
		        </div>
		    </div>
		    <div class="col-md-10 ml-auto mr-auto">
		    	<div class="form-group has-feedback text-center">
		    		<div class="text-danger" id="validation_error"> <!-- Shows Validation Errors --> </div>
		            <button type="button" class="btn btn-sm btn-base-1 btn-shadow mt-2" id="btn_pass" style="width: 25%" disabled=""><?php echo translate('save')?></button>
		        </div>
		    </div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		var new_pass = "";
		var confirm_pass = "";

		function btn_state(){
			if (new_pass == confirm_pass && (new_pass != '' || confirm_pass != '')) {
				$("#btn_pass").removeAttr("disabled");
			} else {
				$("#btn_pass").attr("disabled", "disabled");			
			}
		}

		$("#confirm_password").keyup(function(){
			confirm_pass = $("#confirm_password").val();
			new_pass = $("#new_password").val();
			if (confirm_pass != new_pass) {
				// alert(confirm_pass+", "+new_pass);
				$("#confirm_password").css("border", "1px solid #e33244");
			} 
			else if (confirm_pass == new_pass) {
				// alert('yes');
				$("#confirm_password").css("border", "1px solid #71ba51");
			}
			btn_state();
		});

		$("#new_password").keyup(function(){
			confirm_pass = $("#confirm_password").val();
			new_pass = $("#new_password").val();
			if (confirm_pass != new_pass) {
				// alert(confirm_pass+", "+new_pass);
				$("#confirm_password").css("border", "1px solid #e33244");
			} 
			else if (confirm_pass == new_pass) {
				// alert('yes');
				$("#confirm_password").css("border", "1px solid #71ba51");
			}
			btn_state();
		});

		$("#btn_pass").click(function(){
			$('#btn_pass').prop('disabled', true);
			$('#btn_pass').html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>...");
			$.ajax({
	            type: "POST",
	            url: "<?=base_url()?>home/profile/update_password",
	            cache: false,
	            data: $('#change_password_form').serialize(),
	            success: function(response) {
	                // alert($('#form_'+section).serialize());
	                if (IsJsonString(response)) {
	                    // Re_Enabling the Elements
	                    $('#btn_pass').html("<?php echo translate('save')?>");
	                    // Displaying Validation Error for ajax submit
	                    // alert('TRUE');
	                    var JSONArray = $.parseJSON(response);
	                    var html = "";
	                    $.each(JSONArray, function(row, fields) {
	                        // alert(fields['ajax_error']);
	                        html = fields['ajax_error'];
	                    });
	                    $('#validation_info').html(html);
	                    $('#ajax_validation_alert').show();
	                    $('#change_password_form').trigger("reset");
	                    setTimeout(function() {
	                        $('#ajax_validation_alert').fadeOut('fast');
	                    }, 5000); // <-- time in milliseconds
	                }
	                else{
	                    // Loading the specific Section Area
	                    // alert('FALSE');
	                    $('#btn_pass').html("<?php echo translate('save')?>");
	                    $('#change_password_form').trigger("reset");
	                    $("#confirm_password").css("border", "1px solid #e6e6e6");
	                    
	                    $('#ajax_alert').html("<div class='alert alert-success fade show' role='alert'><?php echo translate('you_have_successfully_edited_your_password!')?></div>");
	                    $('#ajax_alert').show();
	                    setTimeout(function() {
	                        $('#ajax_alert').fadeOut('fast');
	                    }, 5000); // <-- time in milliseconds
	                }
	                //window.location.href = "<?=base_url()?>home/profile";
	            },
	            fail: function (error) {
	                alert(error);
	            }
	        });
		});

		function IsJsonString(str) {
	        try {
	            JSON.parse(str);
	        } catch (e) {
	            return false;
	        }
	        return true;
	    }
	});
</script>