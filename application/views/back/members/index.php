
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('members')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('members')?></a></li>
			<li class="active"><?php echo translate($member_type)?> <?php echo translate('members')?></li>
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
				<h3 class="panel-title"><?php echo translate($member_type)?> <?php echo translate('members_list')?></h3>
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
						<?php if ($parameter == "premium_members"): ?>
							<th data-sortable="false">
								<?php echo translate('package')?>
							</th>
						<?php endif ?>
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

<!-- status modal -->
<div class="modal fade" id="status_modal" role="dialog" tabindex="-1" aria-labelledby="status_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b id="status_type"></b>" <?php echo translate('this_user?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="status_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- End status modal  -->

<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="package_modal" role="dialog" tabindex="-1" aria-labelledby="package_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('package_information')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body" id="package_modal_body">

            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="upgrade_modal" role="dialog" tabindex="-1" aria-labelledby="upgrade_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('upgrade_package')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<form class="form-horizontal" id="package_upgrade_form" method="POST" action="<?php echo base_url()?>admin/members/upgrade_member_package">
					<div class="row">
					    <div class="col-md-10 col-md-offset-1">
					        <div class="upgrade">
					            <h5><?php echo translate('choose_your_package')?></h5>
					            <div class="text-left">
					                <div class="px-2 py-2">
					                	<input type="hidden" id="up_member_id" name="up_member_id" value="">
					                	<input type="hidden" id="member_type" name="member_type" value="<?php echo $parameter?>">
					                    <?php echo $this->Crud_model->select_html('plan', 'plan', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '');?>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
	            	<div class="text-center" style="margin-top: 15px;">
		        		<button class="btn btn-success add-tooltip" type="submit"><?php echo translate('submit')?></button>
		        	</div>
		        </form>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="block_modal" role="dialog" tabindex="-1" aria-labelledby="block_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b id="block_type"></b>" <?php echo translate('this_user?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="block_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>

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
                	<button class="btn btn-danger btn-sm" id="delete_member" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>

        </div>
    </div>
</div>

<!--===================================================-->
<!--End Default Bootstrap Modal-->
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
    	var type = "<?php echo $parameter?>";
    	var url = "";
    	if (type == "free_members") {
    		url = "<?php echo base_url('admin/members/free_members/list_data') ?>";
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
    	}
    	if (type == "premium_members") {
    		url = "<?php echo base_url('admin/members/premium_members/list_data') ?>";
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
					{ "data": "package" },
					{ "data": "member_since" },
					{ "data": "member_status" },
					{ "data": "options" },
				],
				"drawCallback": function( settings ) {
			        $('.add-tooltip').tooltip();
			    }
		    });
    	}
    	if (type == "deleted_members") {
    		url = "<?php echo base_url('admin/deleted_members/list_data') ?>";
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
					{ "data": "follower" },
					{ "data": "package" },
					{ "data": "member_since" },
					{ "data": "member_status" },
					{ "data": "options" },
				],
				"drawCallback": function( settings ) {
			        $('.add-tooltip').tooltip();
			    }
		    });
    	}
    });
    function view_package(id){
		$.ajax({
		    url: "<?php echo base_url()?>admin/member_package_modal/"+id,
		    success: function(response) {
				$("#package_modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}
</script>
<script>
	function block(status, member_id){
	    $("#block_status").val(status);
	    if (status == 'yes') {
	    	$("#block_type").html("<?php echo translate('unblock')?>");
	    }
	    if (status == 'no') {
			$("#block_type").html("<?php echo translate('block')?>");
	    }
	    $("#member_id").val(member_id);
	}

	$("#block_status").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/member_block/"+$("#block_status").val()+"/"+$("#member_id").val(),
		    success: function(response) {
		    	// alert(response);
				window.location.href = "<?php echo base_url()?>admin/members/<?php echo $parameter?>";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function delete_member(id){
	    $("#delete_member").val(id);
	}

	$("#delete_member").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/member_delete/"+$("#delete_member").val(),
		    success: function(response) {
				window.location.href = "<?php echo base_url()?>admin/members/<?php echo $parameter?>";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>

<script>
	function status(status, member_id){
	    $("#status_status").val(status);
	    if (status == 'approved') {
	    	$("#status_type").html("<?php echo translate('reject')?>");
	    }
	    if (status == 'pending') {
			$("#status_type").html("<?php echo translate('approve')?>");
	    }
	    $("#member_id").val(member_id);
	}

	$("#status_status").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/member_approval_status/"+$("#status_status").val()+"/"+$("#member_id").val(),
		    success: function(response) {
		    	// alert(response);
				window.location.href = "<?php echo base_url()?>admin/members/<?php echo $parameter?>";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>
