<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('Facebook_chat_settings')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('facebook_chat_settings')?></a></li>
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
				<h3 class="panel-title"><?= translate('facebook_chat_settings')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
			    		<form class="form-horizontal" id="facebook_chat_settings_form" method="POST" action="<?=base_url()?>admin/update_facebook_chat_settings">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="facebook_chat_activation"><b><?= translate('facebook_chat_activation')?></b></label>
								<div class="col-sm-8">
									<div class="checkbox">
						                <input id="facebook_chat_activation" name="facebook_chat_activation" class="magic-checkbox" type="checkbox" <?php if($this->db->get_where('third_party_settings', array('type' => 'facebook_chat_set'))->row()->value == "yes"){ ?>checked<?php } ?>>
						                <label for="facebook_chat_activation"></label>
						            </div>
								</div>
							</div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="facebook_chat_page_id"><b><?= translate('facebook_page_id')?> </b></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facebook_chat_page_id" value="<?=$this->db->get_where('third_party_settings', array('type' => 'facebook_chat_page_id'))->row()->value;?>" placeholder="<?php echo translate('facebook_page_id')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="facebook_chat_logged_in_greeting"><b><?= translate('facebook_chat_logged_in_greeting(Optional)')?> </b></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facebook_chat_logged_in_greeting" value="<?=$this->db->get_where('third_party_settings', array('type' => 'facebook_chat_logged_in_greeting'))->row()->value;?>" placeholder="<?php echo translate('hello_sir!')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="facebook_chat_logged_out_greeting"><b><?= translate('facebook_chat_logged-out_greeting(Optional)')?> </b></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facebook_chat_logged_out_greeting" value="<?=$this->db->get_where('third_party_settings', array('type' => 'facebook_chat_logged_out_greeting'))->row()->value;?>" placeholder="<?php echo translate('thank_you')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="facebook_chat_theme_color"><b><?= translate('facebook-chat_theme-color(Optional)')?> </b></label>
                                <div class="col-sm-8">
                                    <input type="color" class="widget-img pos-sta accordion mar-no" name="facebook_chat_theme_color" value="<?=$this->db->get_where('third_party_settings', array('type' => 'facebook_chat_theme_color'))->row()->value;?>" >
                                </div>
                            </div>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-8 text-right">
									<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
