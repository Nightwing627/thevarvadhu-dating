<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('configuration')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('configuration')?></a></li>
			<li><a href="#"><?php echo translate('member_profile')?></a></li>
			<li class="active"><a href="#"><?php echo translate('caste')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('castes')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12 pull-right" style="padding-bottom: 10px">
						<!-- <a href="<?=base_url()?>admin/caste/add_caste" class="btn btn-primary btn-sm btn-labeled fa fa-plus">Create New</a> -->
						<button data-target="#caste_modal" data-toggle="modal" id="add_caste" class="btn btn-primary btn-sm btn-labeled fa fa-plus"><?php echo translate('create_new')?></button>
					</div>
				</div>
				<div class="row">
					<table id="caste_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="10%">#</th>
							<th>
								<?php echo translate('caste')?>
							</th>
							<th>
								<?php echo translate('religion')?>
							</th>
							<th width="20%" data-sortable="false">
								<?php echo translate('options')?>
							</th>
						</tr>
						</thead>
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
<div class="modal fade" id="caste_modal" role="dialog" tabindex="-1" aria-labelledby="caste_modal" aria-hidden="true">
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
                <button class="btn btn-primary btn-sm" id="save_caste" value="0"><?php echo translate('save')?></button>
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
                	<button class="btn btn-danger btn-sm" id="delete_caste" value=""><?php echo translate('delete')?></button>
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
        $('#caste_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/caste/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "#" },
				{ "data": "name" },
				{ "data": "religion_name" },
				{ "data": "options" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });
</script>
<script>
	$("#add_caste").click(function(){
	    $("#modal_title").html("Add caste");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_caste").val(1);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/caste/add_caste",
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function edit_caste(id){
		$("#modal_title").html("Edit caste");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $("#save_caste").val(2);
	    $('#validation_info').html("");
	    $.ajax({
		    url: "<?=base_url()?>admin/caste/edit_caste/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}

	$("#save_caste").click(function(){
		var check = $("#save_caste").val();
		var form = $("#caste_form");
		if (check == 1) {
			var page_url = "<?=base_url()?>admin/caste/do_add"
		} 
		if (check == 2) {
			var page_url = "<?=base_url()?>admin/caste/update"
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
		    		window.location.href = "<?=base_url()?>admin/caste";
		    	}
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	});

	function delete_caste(id){
	    $("#delete_caste").val(id);
	}

	$("#delete_caste").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/caste/delete/"+$("#delete_caste").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/caste";
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