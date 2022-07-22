<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_city as $value) 
{
?>
	<form class="form-horizontal" id="city_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="country_id"><b><?php echo translate('country')?></b></label>
				<div class="col-sm-8">
					<?=$this->Crud_model->select_html('country', 'country_id', 'name', 'edit', 'form-control chosen', $country_id, '', '', 'load_state');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="state_id"><b><?php echo translate('state')?></b></label>
				<div class="col-sm-8" id="load_state">
					<?=$this->Crud_model->select_html('state', 'state_id', 'name', 'edit', 'form-control chosen', $value->state_id, 'country_id', $country_id, '');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('city_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="city_id" value="<?=$value->city_id;?>">
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