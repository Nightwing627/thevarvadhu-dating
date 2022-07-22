<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('send_SMS')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('send_SMS')?></a></li>
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
	                <h3 class="panel-title"><?php echo translate('SMS_send_to_members')?>
	                </h3>
	            </div>
	            <!--Input Size-->
	            <!--===================================================-->
	            <div class="panel-body">
					<div class="row">
						
			            <?php 	
			            	$twilio=$this->db->get_where('third_party_settings',array('type'=>'twilio_status','value'=>'ok'))->result_array();
		            		$msg91=$this->db->get_where('third_party_settings',array('type'=>'msg91_status','value'=>'ok'))->result_array();

			                if(count($twilio)>0  or count($msg91)>0){
			    			?>
			    				<div class="col-md-8 col-md-offset-2">
						    		<form class="form-horizontal" id="send_sms_form" method="POST" action="<?=base_url()?>admin/send_sms/do_send">
										<div class="form-group">
											<label class="col-sm-3 control-label" for="twilio_activation"><b><?php echo translate('send_message_by')?></b></label>
											<div class="col-sm-8">
												<select class="form-control" name="send_by" required="">
					                        		<?php 
					                        			if(count($twilio)>0){
					                        		 	?>
					                        		<option class="form-control" value="twilio">Twilio</option>
					                        		 <?php }		                        		 
					                        		 	if(count($msg91)>0){
					                        		  	?>
				                        		  	<option class="form-control" value="msg91">Msg91</option>
				                        		  <?php } ?>
				                        		</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="twilio_account_sid"><b><?php echo translate('select_members')?> </b></label>
											<div class="col-sm-8">
												<select class="form-control" name="member" required="">
												    <option class="form-control" value="all"><?php echo translate('all_members')?></option>
					                        		<option class="form-control" value="premium"><?php echo translate('primium_members')?></option>
					                        		<option class="form-control" value="free"><?php echo translate('free_members')?></option>
				                        	    </select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="twilio_auth_token"><b><?php echo translate('message')?></b></label>
											<div class="col-sm-8">
												<textarea placeholder="Message" rows="10" name="msg" class="form-control" required=""></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-8 text-right">
												<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save">Send</button>
											</div>
										</div>
									</form>
								</div>
					    <?php 
							} else { ?>
								<div class="col-md-12 text-center">
									<p class="text-danger">
										<?php echo translate('Please_activate_Twilio_or_Msg91_SMS_Settings');?>
									</p>
								</div>
						<?php } ?>
			        </div>				
				</div>				
		    </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		
		setTimeout(function() {
		    $('#success_alert').fadeOut('fast');
		    $('#danger_alert').fadeOut('fast');
		}, 5000); // <-- time in milliseconds
	});
</script>