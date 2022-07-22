<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_state as $value) 
{
?>
	<form class="form-horizontal" id="state_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('country')?></b></label>
				<div class="col-sm-8">
					<?=$this->Crud_model->select_html('country', 'country_id', 'name', 'edit', 'form-control chosen', $value->country_id, '', '', '');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('state_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="state_id" value="<?=$value->state_id;?>">
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
<script>
	$(function(){
	    $(".chosen").chosen();
	});
</script>