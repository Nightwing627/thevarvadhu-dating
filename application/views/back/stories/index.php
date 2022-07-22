<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('stories')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('stories')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('stories_list')?></h3>
			</div>
			<div class="panel-body">
				<table id="stories_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th width="25%" data-sortable="false">
							<?php echo translate('image')?>
						</th>
						<th>
							<?php echo translate('title')?>
						</th>
						<th>
							<?php echo translate('date')?>
						</th>
						<th>
							<?php echo translate('member_name')?>
						</th>
						<th>
							<?php echo translate('partner_name')?>
						</th>
						<th width="13%" data-sortable="false">
							<?php echo translate('options')?>
						</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="approval_modal" role="dialog" tabindex="-1" aria-labelledby="approval_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b id="type_name"></b>" <?php echo translate('this_story?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="story_id" name="story_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="approval_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
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
                	<button class="btn btn-danger btn-sm" id="delete_story" value=""><?php echo translate('delete')?></button>
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
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
        $('#stories_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/stories/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "image" },
				{ "data": "title" },
				{ "data": "date" },
				{ "data": "member_name" },
				{ "data": "partner_name" },
				{ "data": "options" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });
</script>
<script>
	function approval(status,story_id){
	    $("#approval_status").val(status);
	    if (status == 1) {
	    	$("#type_name").html("<?php echo translate('unpublish')?>");
	    }
	    if (status == 0) {
			$("#type_name").html("<?php echo translate('approve')?>");
	    }
	    $("#story_id").val(story_id);
	}

	$("#approval_status").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/stories/approval/"+$("#approval_status").val()+"/"+$("#story_id").val(),
		    success: function(response) {
		    	// alert(response);
				window.location.href = "<?=base_url()?>admin/stories";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function delete_story(id){
	    $("#delete_story").val(id);
	}

	$("#delete_story").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/stories/delete/"+$("#delete_story").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/stories";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>
