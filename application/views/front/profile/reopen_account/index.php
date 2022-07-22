<!-- <?php
    $story_exist = $this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->result();
?> -->
<div class="card-title">
    <h3 class="heading heading-6 strong-500">
        <b>
            <?php echo translate('re-open_account');?>
        </b>
    </h3>
</div>
<div class="card-body py-5">
	<p class="text-center">
		<b><?php echo translate('are_you_sure_to_re-open_the_account?') ?></b>
	</p>
	<div id="confirm_view">
		<form class="form-default text-center" data-toggle="validator" role="form">
	        <div class="filter-radio">
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="confirm_yes" value="yes">
	                <label for="confirm_yes"><?php echo translate('yes')?></label>
	            </div>
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="confirm_no" value="no">
	                <label for="confirm_no"><?php echo translate('no')?></label>
	            </div>
	        </div>
	        <button type="button" class="btn btn-base-1 btn-sm mt-2 btn-shadow" id="confirm_btn"><?php echo translate('Confirm')?></button>
	    </form>
	</div>
</div>

<script type="text/javascript">
	
	$('#confirm_btn').click(function() {
	   if($('#confirm_yes').is(':checked')) { 
		   	$.ajax({
                url: "<?=base_url()?>home/profile/reopen_account/yes",
                success: function(response) {
                    setTimeout(
	                function() 
	                {
	                   location.reload();
	                }, 0001); 
                }
            });
	   }
	   else if($('#confirm_no').is(':checked')) { 
	   			$.ajax({
                url: "<?=base_url()?>home/profile/reopen_account/no",
                success: function(response) {
                setTimeout(
	                function() 
	                {
	                   location.reload();
	                }, 0001); 
                }
            });
	    }
	});
</script>