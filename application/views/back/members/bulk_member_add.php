
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo  translate('bulk_add_member')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo  translate('home')?></a></li>
			<li><a href="#"><?php echo  translate('members')?></a></li>
			<li><a href="#"><?php echo  translate('bulk_add_member')?></a></li>

		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="panel">

			<?php if(!empty($true_counter) && $true_counter > 0){ ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
					<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
					<?php echo $true_counter.' '.translate('member added successfully'); ?>
				</div>
			<?php } ?>
			<?php if(!empty($false_counter) && $false_counter > 0){ ?>
				<div class="alert alert-danger" id="danger" style="display: block">
					<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
					<?php echo $false_counter.' '.translate('member have not been added'); ?>
				</div>
			<?php } ?>

		    <div class="panel-body">
                <div class="text-left">
                    <h4><?php echo  translate('Instructions')?></h4>
                </div>
                <hr>
                <ol>
                    <li>
                        <?php echo translate('Download the skeleton file and fill it with data.'); ?>
                    </li>
                    <li>
                        <?php echo translate('You can download the example file to understand how the data must be filled'); ?>
                    </li>
                    <li>
                        <?php echo translate('Once you have downloaded and filled the skeleton file , upload it in the form below and
                        submit.'); ?>
                    </li>
                    <li>
                        <code>* <?php echo translate('Do not upload more than 50 member at a time .'); ?></code>
                    </li>
                    <li>
                        <?php echo translate('Members should be uploaded successfully.'); ?>
                    </li>
                </ol>
                <div class="form-group">
                    <a class="btn btn-sm btn-primary btn-dark" target="_blank" download
                       href="<?php echo base_url() . "uploads/bulk_skeletons/member.xlsx" ?>"><?php echo translate('Download member bulk add skeleton file'); ?></a>
                    <a class="btn btn-sm btn-primary" target="_blank" download
                       href="<?php echo base_url() . "uploads/bulk_skeletons/member_example.xlsx" ?>"><?php echo translate('Download member bulk add example file'); ?></a>
                </div>
		    </div>
            <div class="panel-body">
                <div class="text-left">
                    <h4><?php echo  translate('More Instructions')?></h4>
                </div>
                <hr>
                <ol>
                    <li>
                        <?php echo  translate('Gender, On Behalf and Package should be in')?> <code><?php echo  translate('numerical ids')?></code>.
                    </li>
                    <li>
                        <?php echo  translate('Male Id = 1, Female Id = 2')?>
                    </li>
                    <li>
                        <?php echo  translate('Click the')?> <code><?php echo  translate('On Behalf and Package modals/pop-ups')?></code> <?php echo  translate('to see the related ids')?>
                    </li>
                    <li>
                        <code>* <?php echo translate('Member email must be unique.'); ?></code>
                    </li>
					<li>
                        <code>* <?php echo translate('Be careful to enter the member package id.'); ?></code>
                    </li>
                    <li>
                        <?php echo  translate('Members should be uploaded successfully.')?>
                    </li>
                </ol>
                <div class="form-group">
                    <button data-target="#on_behalf_ids" type="button" class="btn btn-primary"
                            data-toggle="modal"><?php echo translate("On Behalf") ?></button>
                    <button data-target="#package_ids" type="button" class="btn btn-primary"
                            data-toggle="modal"><?php echo translate("Package") ?></button>
                </div>
            </div>


            <div class="panel-body">
                <div class="text-left">
                    <h4><?php echo  translate('Upload members')?></h4>
                </div>
                <hr style="height:1px; border:none; background-color:#000;">
                <form class=""  method="POST" action="<?php echo base_url()?>admin/bulk_member_add/do_add" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="fname"><b><?php echo  translate('upload_file')?> <span class="text-danger">*</span></b></label>
						<div class="col-sm-6">
							<input type="file" name="bulk_member_file" ondragover="" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-8 text-right">
							<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('upload')?></button>
						</div>
					</div>
                </form>
                <hr>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="on_behalf_ids" role="dialog" tabindex="-1" aria-labelledby="package_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('On Behalf IDs')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
                            <th>
								<?php echo translate('On Behalf IDs')?>
							</th>
							<th>
								<?php echo translate('On Behalf Name')?>
							</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
                                $on_behalfs = $this->db->get("on_behalf")->result();
								foreach ($on_behalfs as $on_behalf)
								{
								?>
									<tr>
										<td><?php echo $on_behalf->on_behalf_id; ?></td>
										<td>
											<?php echo $on_behalf->name;?>
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
    </div>
</div>
<div class="modal fade" id="package_ids" role="dialog" tabindex="-1" aria-labelledby="package_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('Package IDs')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
                            <th>
								<?php echo translate('Package IDs')?>
							</th>
							<th>
								<?php echo translate('Package Name')?>
							</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$i = 1;
                                $packages = $this->db->get("plan")->result();
								foreach ($packages as $package)
								{
								?>
									<tr>
										<td><?php echo $package->plan_id; ?></td>
										<td>
											<?php echo $package->name;?>
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
    </div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<style media="screen">
.body, #content-container {
color: #3b3e40;
}
</style>
