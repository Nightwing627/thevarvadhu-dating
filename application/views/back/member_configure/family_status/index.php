<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('Configuration')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('Configuration')?></a></li>
			<li><a href="#"><?php echo translate('member_profile')?></a></li>
			<li class="active"><a href="#"><?php echo translate('family_status')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('family_statuss')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<!-- <a href="<?=base_url()?>admin/family_status/add_family_status" class="btn btn-primary btn-sm btn-labeled fa fa-plus">Create New</a> -->
						<button data-target="#family_status_modal" data-toggle="modal" id="add_family_status" class="btn btn-primary btn-sm btn-labeled fa fa-plus"><?php echo translate('create_new')?></button>
					</div>
				</div>
				<div class="row">
					<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="10%">#</th>
							<th>
								<?php echo translate('name')?>
							</th>
							<th width="15%">
								<?php echo translate('options')?>
							</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
								foreach ($all_family_statuss as $value) 
								{
								?>
									<tr>
										<td><?=$i?></td>
										<td>
											<?=$value->name;?>
										</td>
										<td>
											<button data-target="#family_status_modal" data-toggle="modal" class="btn btn-primary btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('edit')?>" onclick="edit_family_status(<?=$value->family_status_id?>)"><i class="fa fa-edit"></i></button>
											<button data-target="#delete_modal" data-toggle="modal" class="btn btn-danger btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?=translate('delete')?>" onclick="delete_family_status(<?=$value->family_status_id?>)"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
								<?php
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<style>
	#validation_info p {
		margin: 0px;
		color: #DE1B1B;
	}
</style>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="family_status_modal" role="dialog" tabindex="-1" aria-labelledby="family_status_modal" aria-hidden="true">
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
                <button class="btn btn-primary btn-sm" id="save_family_status" value="0"><?php echo translate('save')?></button>
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
                	<button class="btn btn-danger btn-sm" id="delete_family_status" value=""><?php echo translate('delete')?></button>
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
	$("#add_family_status").click(function(){
	    $("#modal_title").html("Add Family Value");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_family_status").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/family_status/add_family_status",
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function edit_family_status(id){
		$("#modal_title").html("Edit Family Value");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_family_status").val(2);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/family_status/edit_family_status/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}

	$("#save_family_status").click(function(){
		var check = $("#save_family_status").val();
		var form = $("#family_status_form");
		if (check == 1) {
			var page_url = "<?=base_url()?>admin/family_status/do_add"
		} 
		if (check == 2) {
			var page_url = "<?=base_url()?>admin/family_status/update"
		}
	    $.ajax({
		    type: "POST",
		    url: page_url,
		    cache: false,
		    data: form.serialize(),
		    success: function(response) {
		    	if (IsJsonString(response)) {
		    		// Displaying Validation Error for ajax submit
		    		var JSONArray = $.parseJSON(response);
		    		var html = "";
		    		$.each(JSONArray, function(row, fields) {
		    			html = fields['ajax_error'];
		    		});
		    		$('#validation_info').html(html);
		    	}
		    	else {
		    		window.location.href = "<?=base_url()?>admin/family_status";
		    	}
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function delete_family_status(id){
	    $("#delete_family_status").val(id);
	}

	$("#delete_family_status").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/family_status/delete/"+$("#delete_family_status").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/family_status";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function IsJsonString(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
</script>