<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?= translate('FAQ')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?= translate('home')?></a></li>
			<li><a href="#"><?= translate('configuration')?></a></li>
			<li><a href="#"><?= translate('FAQ')?></a></li>
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
				<h3 class="panel-title"><?= translate('FAQ_configuration')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php
							$faqs = json_decode($this->db->get_where('general_settings', array('type' => 'faqs'))->row()->value, true);
						?>
			    		<form class="form-horizontal" id="faq_settings_form" method="POST" action="<?=base_url()?>admin/faq/update">
							<?php //var_dump($faqs); ?>
							<div id="more_additional_fields">
	                            <?php
	                            if (!empty($faqs)) {
	                                foreach ($faqs as $faq) {
	                                    ?> 
	                                    <div class="form-group btm_border">
	                                        <div class="col-sm-5">
	                                            <input type="text" name="question[]" value="<?php echo $faq['question']; ?>" placeholder="<?php echo translate('question'); ?>" class="form-control" required>
	                                        </div>
	                                        <div class="col-sm-6">
	                                            <textarea rows="5" class="form-control textarea" data-height="100" name="answer[]" required><?php echo $faq['answer']; ?></textarea>
	                                        </div>
	                                        <div class="col-sm-1">
	                                            <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>
	                                        </div>
	                                    </div>
	                                    <?php
	                                }
	                            }
	                            ?> 
	                        </div>
	                        <div class="form-group btm_border">
	                            <div class="col-sm-11">
	                                <div id="more_btn" class="btn btn-dark btn-sm btn-labeled fa fa-plus pull-right">
	                                    <?php echo translate('add_more_FAQ'); ?></div>
	                            </div>
	                        </div>
	                        <div class="form-group btm_border">
	                            <div class="col-sm-11">
	                                <button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save pull-right"><?=translate('save')?></button>
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
<script>
	var add_count = 1;
	$(function () {
	    //bootstrap WYSIHTML5 - text editor
	    $('.textarea').wysihtml5({
	        toolbar: {
	            "image": false // Button to insert an image.
	        }
	    });
	})

	$("#more_btn").click(function () {
        $("#more_additional_fields").append(''
                + '<div class="form-group">'
                + '    <div class="col-sm-5">'
                + '        <input type="text" name="question[]" class="form-control"  placeholder="<?php echo translate('question'); ?>" required>'
                + '    </div>'
                + '    <div class="col-sm-6">'
                + '          <textarea rows="5" class="form-control textarea_add_'+add_count+'" data-height="100" name="answer[]" placeholder="<?php echo translate('answer');?>" required></textarea>'
                + '    </div>'
                + '    <div class="col-sm-1">'
                + '        <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>'
                + '    </div>'
                + '</div>'
                );
	    //bootstrap WYSIHTML5 - text editor
	    $('.textarea_add_'+add_count).wysihtml5({
	        toolbar: {
	            "image": false // Button to insert an image.
	        }
	    });
		add_count = add_count + 1; 
    });
    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }
</script>