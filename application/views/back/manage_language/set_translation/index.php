<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('language')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('language')?></a></li>
			<li class="active"><a href="#"><?php echo translate('set_translations')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!-- Basic Data Tables -->
		<!--===================================================-->
		<div class="panel">
			<div class="alert alert-success" id="success_alert" style="display: none; position: fixed; top: 7%; right: 1%; width: 15%; z-index: 10000">
                <!-- <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button> -->
                <?php echo translate('successfully_saved')?>
            </div>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('set_translations')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<a href="<?=base_url()?>admin/manage_language" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward"><?php echo translate('go_back')?></a>
					</div>
				</div>
				<div class="row">
					<table id="set_translation_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="15%" data-sortable="false">
									<?php echo translate('#')?>
								</th>
								<th width="35%">
									<?php echo translate('word')?>
								</th>
								<th width="35%" data-sortable="false">
									<?php echo translate('translation')?>
								</th>
							</tr>
						</thead>
					</table>
					<div class="aabn btn btn-default btn-sm"><?php echo translate('translate'); ?></div>
					<div class="ssdd btn btn-default btn-sm"><?php echo translate('save_all'); ?></div>
				</div>					
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--Language Modal-->
<!--===================================================-->
<div class="modal fade" id="site_language_list_modal" role="dialog" tabindex="-1" aria-labelledby="site_language_list_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body" id="modal_body">
            	
            </div>
        	<div class="col-sm-12 text-center" id="validation_info" style="margin-top: -30px">

        	</div>            
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <button class="btn btn-primary btn-sm" id="save_site_language" value="0"><?php echo translate('save')?></button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Language Modal-->
<!--Approval Modal-->
<!--===================================================-->
<div class="modal fade" id="site_language_list_approval_modal" role="dialog" tabindex="-1" aria-labelledby="approval_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b id="type_name"></b>" <?php echo translate('this_language?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="site_language_list_id" name="site_language_list_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="approval_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Approval Modal-->
<!--Default Bootstrap Modal For DELETE-->
<!--===================================================-->
<div class="modal fade" id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_delete_this_data?')?></p>
            	<div class="text-right">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="delete_site_language" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal For DELETE-->
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
        $('#set_translation_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/manage_language/set_translation/'.$selected_language.'/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "#" },
				{ "data": "word" },
				{ "data": "translation" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });

    $('.panel').on('click','.submittera', function(){
		var here = $(this); // alert div for show alert message
		var fid = here.data('wid');
		var form = $('#'+fid);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				here.html('Saving..'); // change submit button text
			},
			success: function() {
				here.fadeIn();
				here.html('Save');
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

	$('.panel').on('click', '.ssdd', function () {
        $('#set_translation_table').find('form').each(function () {
            var nw = $(this);
            nw.find('.submittera').click();
        });
    });

    $('.panel').on('click', '.aabn', function () {
        $('#set_translation_table').find('.abv').each(function (index, element) {
            var now = $(this);
            var dtt = now.closest('tr').find('.ann');
            var str = now.html();
            str = str.replace(/<\/?[^>]+(>|$)/g, '');
            str = str.replace(/<\/?[^>]+(>|$)/g, '');
            dtt.val(str);
        });
    });
</script>