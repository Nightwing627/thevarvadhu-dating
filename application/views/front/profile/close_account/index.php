<!-- <?php
    $story_exist = $this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->result();
?> -->
<div class="card-title">
    <h3 class="heading heading-6 strong-500">
        <b>
            <?php echo translate('close_account');?>
        </b>
    </h3>
</div>
<div class="card-body py-5">
	<p class="text-center">
		<b><?php echo translate('to_colse_your_account_we_want_some_informations._please_answer_the_question_below') ?></b>
	</p>
	<?php
        $story_exist = $this->db->get_where("happy_story",array("posted_by" => $this->session->userdata('member_id')))->num_rows();
        if($story_exist == 0){      
    ?>
	<div id="main_view">
		<p class="text-center">
			<?php echo translate('have_you_found_your_partner_from_this_website?');?>
		</p>
		<form class="form-default text-center" data-toggle="validator" role="form">
	        <div class="filter-radio">
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="find_yes" value="yes">
	                <label for="find_yes"><?php echo translate('yes')?></label>
	            </div>
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="find_no" value="no">
	                <label for="find_no"><?php echo translate('no')?></label>
	            </div>
	        </div>
	        <button type="button" class="btn btn-base-1 btn-sm mt-2 btn-shadow" id="main_btn"><?php echo translate('Next')?></button>
	    </form>
	</div>
	
	<div id="story_view">
		<p class="text-center">
			<?php echo translate('do_you_want_to_share_your_story?');?>
		</p>
		<form class="form-default text-center" data-toggle="validator" role="form">
	        <div class="filter-radio">
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="story_yes" value="yes">
	                <label for="story_yes"><?php echo translate('yes')?></label>
	            </div>
	            <div class="radio radio-primary">
	                <input type="radio" name="check" id="story_no" value="no">
	                <label for="story_no"><?php echo translate('no')?></label>
	            </div>
	        </div>
	        <button type="button" class="btn btn-base-1 btn-sm mt-2 btn-shadow" id="story_btn"><?php echo translate('Next')?></button>
	    </form>
	</div>
<?php } ?>
	<div id="confirm_view">
		<p class="text-center">
			<?php echo translate('do_you_realy_want_to_close_your_account?');?>
		</p>
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
	var story_exist='<?=$story_exist?>';
	if(story_exist !== '0'){
		$("#story_view").hide(); 
		$("#main_view").hide();
		
	}else{
		$("#confirm_view").hide();
		$("#story_view").hide();
	}
	$('#main_btn').click(function() {
	   if($('#find_yes').is(':checked')) { 
   			$("#story_view").show(); 
   			$("#main_view").hide(); 
	   }
	   else if($('#find_no').is(':checked')) { 
	   		$("#confirm_view").show(); 
	   		$("#main_view").hide();
	   	}
	   		
	});

	$('#story_btn').click(function() {
	   if($('#story_yes').is(':checked')) { profile_load("happy_story"); }
	   else if($('#story_no').is(':checked')) { 
		   	$("#confirm_view").show(); 
		   	$("#main_view").hide(); 
		   	$("#story_view").hide(); 
	   }
	});
	$('#confirm_btn').click(function() {
	   if($('#confirm_yes').is(':checked')) { 
		   	$.ajax({
                url: "<?=base_url()?>home/profile/close_account/yes",
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
                url: "<?=base_url()?>home/profile/close_account/no",
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