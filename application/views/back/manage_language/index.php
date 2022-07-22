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
			<li class="active"><a href="#"><?php echo translate('language')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('language_list')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<!-- <a href="<?=base_url()?>admin/site_language_list/add_site_language_list" class="btn btn-primary btn-sm btn-labeled fa fa-plus">Create New</a> -->
						<button data-target="#site_language_list_modal" data-toggle="modal" id="add_site_language" class="btn btn-primary btn-sm btn-labeled fa fa-plus"><?php echo translate('create_new')?></button>
					</div>
				</div>
				<div class="row">
					<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="25%" data-sortable="false">
								<?php echo translate('#')?>
							</th>
							<th>
								<?php echo translate('name')?>
							</th>
							<th>
								<?php echo translate('icon')?>
							</th>
							<th width="15%">
								<?php echo translate('options')?>
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$i = 1;
							foreach ($all_language_list as $value) 
							{
							?>
							<tr>
								<td><?=$i?></td>
								<td><?=$value->name?></td>
								<td>
					                <img class="img-responsive img-border blah img-sm" src="<?=base_url()?>uploads/language_list_image/language_<?=$value->site_language_list_id?>.jpg" style="height: 33px;">
								</td>
								<td>
									<?php
										if ($value->status == "no") {
									?>
									<button data-target="#site_language_list_approval_modal" data-toggle="modal" class="btn btn-success btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo translate('publish')?>" onclick="approval('<?=$value->status?>',<?=$value->site_language_list_id?>)"><i class="fa fa-check"></i></button>
									<?php
										}
										else{
									?>
									<button data-target="#site_language_list_approval_modal" data-toggle="modal" class="btn btn-dark btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo translate('unpublish')?>" onclick="approval('<?=$value->status?>',<?=$value->site_language_list_id?>)"><i class="fa fa-close"></i></button>
									<?php
										}
									?>
									<a href="<?=base_url()?>admin/manage_language/set_translation/<?=$value->db_field?>" class="btn btn-primary btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo translate('set_translations')?>"><i class="fa fa-wrench"></i></a>
									<button data-target="#site_language_list_modal" data-toggle="modal" class="btn btn-info btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo translate('edit')?>" onclick="edit_site_language(<?=$value->site_language_list_id?>)"><i class="fa fa-edit"></i></button>
									<button data-target="#delete_modal" data-toggle="modal" class="btn btn-danger btn-xs add-tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo translate('delete')?>" onclick="delete_site_language('<?=$value->db_field?>')"><i class="fa fa-trash"></i></button>
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
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
	function approval(status,site_language_list_id){
	    $("#approval_status").val(status);
	    if (status == 'ok') {
	    	$("#type_name").html("<?php echo translate('unpublish')?>");
	    }
	    if (status == 'no') {
			$("#type_name").html("<?php echo translate('publish')?>");
	    }
	    $("#site_language_list_id").val(site_language_list_id);
	}

	$("#approval_status").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/manage_language/approval/"+$("#approval_status").val()+"/"+$("#site_language_list_id").val(),
		    success: function(response) {
		    	// alert(response);
				window.location.href = "<?=base_url()?>admin/manage_language";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    });
</script>
<script>
	$("#add_site_language").click(function(){
	    $("#modal_title").html("<?=translate('add_language')?>");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    //$("#save_site_language").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/manage_language/add_site_language",
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function edit_site_language(id){
		$("#modal_title").html("<?=translate('edit_language')?>");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    //$("#save_site_language").val(2);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/manage_language/edit_site_language/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}

	$("#save_site_language").click(function(){
		$("#site_language_form_submit").click();
	});

	function delete_site_language(name){
	    $("#delete_site_language").val(name);
	}

	$("#delete_site_language").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/manage_language/delete/"+$("#delete_site_language").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/manage_language";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    });
</script>