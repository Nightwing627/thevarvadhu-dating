<div id="content-container">
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('member_profile_picture_approval')?></h1>

		</div>
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('member_photo_approval')?></a></li>
			<li class="active"><a href="#"><?php echo translate('profile_picture')?></a></li>

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
				<h3 class="panel-title"><?php echo translate('profile_picture_approval_requests')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th width="10%">#</th>
							<th>
								<?php echo translate('member_id')?>
							</th>
							<th>
								<?php echo translate('member_name')?>
							</th>
                            <th>
								<?php echo translate('image')?>
							</th>
                            <th>
								<?php echo translate('status')?>
							</th>
							<th width="15%">
								<?php echo translate('options')?>
							</th>
						</tr>
						</thead>
						<tbody>
                            <?php
                            $i = 1;
							$this->db->where('profile_image_status ','0');
							$this->db->or_where('profile_image_status','2');
                            $members = $this->db->get('member')->result();
                                foreach ($members as $member) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $member->member_profile_id; ?></td>
                                        <td><?php echo $member->first_name.' '.$member->last_name; ?></td>
                                        <td>
                                            <?php $image = json_decode($member->profile_image, true);
                    		            	if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {?>
												<a  href="#">
                                                	<img src="<?php echo base_url()?>uploads/profile_image/<?php echo $image[0]['thumb']?>" class='img-sm'>
												</a>
											<?php }?>
                                        </td>
                                        <td>
											<?php if($member->profile_image_status == '0'){?>
                                                <button class='badge badge-info' ><?php echo translate('pending'); ?></i></button>
                                            <?php } elseif ($member->profile_image_status == '2') {?>
                                                <button class='badge badge-danger' ><?php echo translate('rejected'); ?></i></button>
                                            <?php } elseif ($member->profile_image_status == '1') {?>
                                                <button class='badge badge-success' ><?php echo translate('accepted'); ?></i></button>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <button  data-toggle='modal' data-target='#profile_image_status_modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='<?php echo translate('approve'); ?>' onclick="profile_image_status(<?php echo $member->member_id?>, 1)">
                                                <i class='fa fa-thumbs-up'></i>
                                            </button>
											<?php if ($member->profile_image_status != '2') {?>
                                                <button  data-toggle='modal' data-target='#profile_image_status_modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='<?php echo translate('reject'); ?>' onclick="profile_image_status(<?php echo $member->member_id?>, 2)">
                                                    <i class='fa fa-trash'></i>
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- status modal -->
<div class="modal fade" id="profile_image_status_modal" role="dialog" tabindex="-1" aria-labelledby="profile_image_status_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure,_you_want_to')?> "<b id="status_type"></b>" <?php echo translate('this_profile_picture?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="member_id" name="member_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="image_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- End status modal  -->

<script type="text/javascript">
    function profile_image_status(member_id,image_status){
        $("#image_status").val(image_status);
	    if (image_status == '1') {
	    	$("#status_type").html("<?php echo translate('accept')?>");
	    }
	    if (image_status == '2') {
			$("#status_type").html("<?php echo translate('reject')?>");
	    }
	    $("#member_id").val(member_id);
	}

	$("#image_status").click(function(){
    	$.ajax({
		    url: "<?php echo base_url()?>admin/member_profile_image_approval/change_status/"+$("#image_status").val()+"/"+$("#member_id").val(),
		    success: function(response) {
				window.location.href = "<?php echo base_url()?>admin/member_profile_image_approval";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>
