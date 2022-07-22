<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('contact_messages')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li class="active"><a href="#"><?php echo translate('contact_messages')?></a></li>
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
				<h3 class="panel-title"><?php echo translate('view_contact_message')?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<?php
					foreach ($get_message as $row) {
					?>
					<table class="table table-striped table-bordered dataTable no-footer">
                        <tr>
                            <th class="custom_td" width="100"><?php echo translate('name'); ?></th>
                            <td class="custom_td"><?php echo $row->name ?></td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('from'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->email ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('subject'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->subject ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('message'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->message?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('date_&_time'); ?></th>
                            <td class="custom_td">
                                <?php echo date('d M,Y h:i:s', $row->timestamp); ?>
                            </td>
                        </tr>
                        <?php if ($row->reply != '') { ?>
                            <tr>
                                <th class="custom_td"><?php echo translate('reply'); ?></th>
                                <td class="custom_td">
                                    <?php echo $row->reply; ?>
                                </td>
                            </tr>
                        <?php }?>
                    </table>
                    <div class="col-sm-12 text-center">
	                    <?php if ($row->reply == '') { ?>
				        	<a href="<?=base_url()?>admin/contact_messages/reply_message/<?=$row->contact_message_id?>" class="btn btn-success btn-sm btn-labeled fa fa-reply"><?php echo translate('reply')?></a>
						<?php }?>
				        	<a href="<?=base_url()?>admin/contact_messages" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward"><?php echo translate('go_back')?></a>
	                    <?php
	                	}
	                    ?>
	                </div>				
				</div>
			</div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>

