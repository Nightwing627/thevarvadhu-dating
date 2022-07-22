<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('earnings')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('earnings')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('earnings_list')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="earnings_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="10%">#</th>
							<th>
								<?php echo translate('earning_name')?>
							</th>
							<th>
								<?php echo translate('date')?>
							</th>
							<th>
								<?php echo translate('payment_type')?>
							</th>
							<th>
								<?php echo translate('amount')?>
							</th>
							<th>
								<?php echo translate('package')?>
							</th>
							<th>
								<?php echo translate('status')?>
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
<div class="modal fade" id="earnings_modal" role="dialog" tabindex="-1" aria-labelledby="earnings_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <!--Modal body-->
			<div id="modal_body">

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
                	<button class="btn btn-danger btn-sm" id="delete_earning" value=""><?php echo translate('delete')?></button>
            	</div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="accept_payment_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('accept_manual_payment')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to_accept_this_payment?')?></p>
            	<div class="text-right">
					<button class="btn btn-success btn-sm" id="package_payment_id" value=""><?php echo translate('yes')?></button>
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
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
        $('#earnings_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
				"url": "<?php echo base_url('admin/earnings/list_data') ?>",
				"dataType": "json",
				"type": "POST",
				"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
			},
	    	"columns": [
				{ "data": "#" },
				{ "data": "member_name" },
				{ "data": "date" },
				{ "data": "payment_type" },
				{ "data": "amount" },
				{ "data": "package" },
				{ "data": "status" },
				{ "data": "options" },
			],
			"drawCallback": function( settings ) {
		        $('.add-tooltip').tooltip();
		    }
	    });
    });
</script>
<script>
	function get_detail(id) {
	    $("#modal_title").html("<?=translate('payment_details')?>");
	    $("#modal_body").html("<div class='text-center'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
	    $.ajax({
		    url: "<?=base_url()?>admin/earnings/view_detail/"+id,
		    success: function(response) {
				$("#modal_body").html(response);
		    },
			fail: function (error) {
			    alert(error);
			}
		});
	}

	function delete_earning(id){
	    $("#delete_earning").val(id);
	}

	$("#delete_earning").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/earnings/delete/"+$("#delete_earning").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/earnings";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

	$("#package_payment_id").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/earnings/accept_payment/"+$("#package_payment_id").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/earnings";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

	// function change_payment_status(id){
	// 	$("#payment_id").val(id);
	// }


</script>
