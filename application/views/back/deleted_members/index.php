
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('deleted_members')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('members')?></a></li>
			<li class="active"><?php echo translate('deleted_members')?></li>
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
	                <?php echo $success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?php echo $danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('deleted_members_list')?></h3>
			</div>
			<div class="panel-body">
				<table id="members_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th data-sortable="false">
							<?php echo translate('user_image')?>
						</th>
						<th>
							<?php echo translate('Member ID')?>
						</th>
						<th>
							<?php echo translate('name')?>
						</th>
						<?php $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value; 
						if($member_approval == 'yes') { ?>
							<th>
								<?php echo translate('approval_status')?>
							</th>
						<?php } ?>
						
						<th>
							<?php echo translate('followers')?>
						</th>
						<th>
							<?php echo translate('profile_reported')?>
						</th>
						<th>
							<?php echo translate('member_since')?>
						</th>
						<th>
							<?php echo translate('member_status')?>
						</th>
						<th width= "15%" data-sortable="false">
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
<div class="modal fade" id="restore_modal" role="dialog" tabindex="-1" aria-labelledby="restore_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b><?php echo translate('restore')?></b>" <?php echo translate('this_user?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="cfm_restore" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->

<!-- member permanently delete modal -->
<div class="modal fade" id="permanently_delete_member_modal" role="dialog" tabindex="-1" aria-labelledby="permanently_delete_member_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_delete_this_data_permanently?')?></p>
            	<div class="text-right">
            		<input type="hidden" id="delete_member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-danger btn-sm" id="permanently_delete_member" value=""><?php echo translate('delete')?></button>
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
    $(document).ready(function () {
    	var url = "<?php echo base_url('admin/deleted_members/list_data') ?>";
		$('#members_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": url,
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "image" },
				{ "data": "member_id" },
				{ "data": "name" },
				<?php $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value; 
					if($member_approval == 'yes') { ?>
					{ "data": "status" },
				<?php } ?>
				{ "data": "follower" },
				{ "data": "profile_reported" },
				{ "data": "member_since" },
				{ "data": "member_status" },
				{ "data": "options" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });

    function restore(member_id){
	    $("#member_id").val(member_id);
	}

	$("#cfm_restore").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/member_restore/"+$("#member_id").val(),
		    success: function(response) {
		    	// alert($("#member_id").val());
				window.location.href = "<?php echo base_url()?>admin/deleted_members";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function permanently_delete_member(id){
	    $("#delete_member_id").val(id);
	}

	$("#permanently_delete_member").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/permanently_member_delete/"+$("#delete_member_id").val(),
		    success: function(response) {
				window.location.href = "<?php echo base_url()?>admin/deleted_members";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>