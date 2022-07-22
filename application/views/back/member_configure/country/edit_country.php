<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_country as $value) 
{
?>
	<form class="form-horizontal" id="country_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('country_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="country_id" value="<?=$value->country_id;?>">
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