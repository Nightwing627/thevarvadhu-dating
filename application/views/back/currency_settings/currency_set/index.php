<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('currency_settings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('currency_settings')?></a></li>
			<li><a href="#"><?= translate('all_currencies')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="panel">
			<div class="alert alert-success" id="success_alert" style="display: none; position: fixed; top: 7%; right: 1%; width: 15%; z-index: 10000">
                <!-- <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button> -->
                <?php echo translate('successfully_saved')?>
            </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-dark">
						    <div class="panel-heading">
						        <h3 class="panel-title"><?= translate('all_currencies')?></h3>
						    </div>
						    <div class="panel-body">
								<div class="panel-body">
		                            <table class="table table-striped table-bordered table-list" style="margin-bottom:0px !important">
		                              <thead>
		                                <tr>
		                                    <th><center><?php echo translate('currency_name')?></center></th>
		                                    <th><center><?php echo translate('currency_symbol')?></center></th>
		                                    <th><center> 1 U.S Dollar ($) =  </center></th>
		                                    <?php
												$currency_id = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
		                                    	$system_def_curr_name = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->name;
												$system_def_curr_symbol = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->symbol;
												$system_def_curr_code = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->code;
											?>
		                                    <th><center>1 <?php echo $system_def_curr_name; ?> (<?php echo $system_def_curr_symbol; ?>) =  ) </center></th>
		                                    <th><center><?php echo translate('status')?></center></th>
		                                    <th><center><?php echo translate('options')?></center></th>
		                                </tr> 
		                              </thead>
		                              <tbody>
		                                  <?php
		                                      $currency= $this->db->get('currency_settings')->result_array();
		                                      $i=1;
		                                      foreach($currency as $row){
		                                  ?>
		                                  
		                                      <tr>
		                                      <?php
		                                            echo form_open(base_url().'admin/set_currency_rate/', 
		                                            array(
		                                                'class' => 'form-horizontal',
		                                                'method' => 'post',
		                                                'id' => 'test_'.$row['currency_settings_id'],
		                                                'enctype' => 'multipart/form-data'
		                                            ));
		                                       ?>
		                                        <td align="center">
		                                            <?php 
		                                                if($row['currency_settings_id'] !== '27'){
		                                                	echo $row['name'];
		                                                } else {
													?>		
														<input type="text" name="name" value="<?php echo $row['name']?>"  class="form-control required">
		                                            <?php
														}
		                                                if($row['currency_settings_id'] == $currency_id){
		                                            ?>
		                                                (<?php echo translate('default'); ?>)
		                                            <?php
														}
		                                            ?>
		                                        </td>
		                                        <td align="center">                                        
		                                            <?php                        	
		                                                if($row['currency_settings_id'] !== '27'){
															echo $row['symbol'];
														} else {
													?>	
														<input type="text" name="symbol" value="<?php echo $row['symbol']?>"  class="form-control required">
		                                            <?php
														}
													?>
		                                        </td>
		                                        <td>
		                                            <?php                                             	
		                                                if($row['currency_settings_id'] !== '1'){
		                                            ?>
		                                            <div class="col-sm-12">
		                                                <div class="col-sm-8 col-sm-offset-2">
		                                                    <input type="number" name="exchange" value="<?php echo $row['exchange_rate']?>"  class="form-control required valto">
		                                                </div>
		                                            </div>	
		                                            <?php 
														}
													?>			
		                                        </td>
		                                        <td>
		                                            <?php                                             	
		                                                if($row['currency_settings_id'] !== $currency_id){
		                                            ?>
		                                            <div class="col-sm-12">
		                                                <div class="col-sm-8 col-sm-offset-2">
		                                                    <input type="number" name="exchange_def" value="<?php echo $row['exchange_rate_def']?>"  class="form-control required valto_def">
		                                                </div>
		                                                <div class="col-sm-3" style="padding-left: 0px !important;padding-right: 0px !important">
		                                                </div>
		                                            </div>
		                                            <?php
		                                                }
		                                            ?>					
		                                        </td>
		                                        <td align="center">
		                                            <?php              	
		                                                if($row['currency_settings_id'] !== $currency_id){
		                                            ?>
										                <!-- <input id="cur_stats<?=$i?>" name="cur_stats" class="" type="checkbox" <?php if($row['status'] == "ok"){ ?>checked <?php } ?>> -->

										                <div class="checkbox" style="margin-top: 7px;margin-bottom: 0px">
											                <input id="cur_stats<?=$i?>" name="cur_stats" class="magic-checkbox" type="checkbox" <?php if($row['status'] == "ok"){ ?>checked <?php } ?>>
											                <label for="cur_stats<?=$i?>"></label>
											            </div>
		                                            <?php
		                                                } else {
		                                                ?>
		                                                	<input name="cur_stats" type="hidden" checked>
		                                                <?php
		                                                }
		                                            ?>
		                                        </td>
		                                        <td align="center">
		                                            <span class="btn btn-sm btn-dark submitter1" 
		                                                data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('exchange_rate_updated'); ?>' data-id="<?php echo  $row['currency_settings_id']; ?>" >
		                                                    <?php echo translate('save');?>
		                                            </span>
		                                        </td>
		                                        </form>
											  <?php
											  	$i++;  
		                                          }
		                                      ?>
		                              	</tr>
		                              </tbody>
		                            </table>
		                        </div>								
						    </div>
						</div>
					</div>		
				</div>				
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(e) {				
	    $('.submitter1').on('click', function(){
			var btn=$(this);
			var ing = btn.data('ing');
			var msg = btn.data('msg');
			var id = btn.data('id');
			var prv = btn.html();
			var form = $('#test_'+id);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
			$.ajax({
				url: form.attr('action')+id, // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					btn.html(ing)
				},
				success: function() {
					btn.fadeIn();
					btn.html(prv)
					$('#success_alert').fadeIn('fast');
					setTimeout(function() {
					    $('#success_alert').fadeOut('fast');
					}, 5000); // <-- time in milliseconds
					// Notification
				},
				error: function(e) {
					console.log(e)
				}
			});
		});
	});
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>