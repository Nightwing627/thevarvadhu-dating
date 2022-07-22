<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_language as $value) 
{
?>
	<form class="form-horizontal" id="language_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('language_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="language_id" value="<?=$value->language_id;?>">
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