<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_on_behalf as $value) 
{
?>
	<form class="form-horizontal" id="on_behalf_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('on_behalf_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="on_behalf_id" value="<?=$value->on_behalf_id;?>">
					<input type="text" class="form-control" name="name" value="<?=$value->name;?>">
				</div>
			</div>
		</div>
	</form>
<?php
}
?>
<!--===================================================-->
<!--End Horizontal Form-->