<!--Horizontal Form-->
<!--===================================================-->
<form class="form-horizontal" id="city_form" method="post">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="country_id"><b><?php echo translate('country')?></b></label>
			<div class="col-sm-8">
				<?=$this->Crud_model->select_html('country', 'country_id', 'name', 'add', 'form-control chosen', '', '', '', 'load_state');?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="state_id"><b><?php echo translate('state')?></b></label>
			<div class="col-sm-8" id="load_state">
				<select class="form-control chosen" name="state_id">
					<option value=""><?php echo translate('choose_a_country_first')?></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('city')?></b></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="name" value="" required>
			</div>
		</div>
	</div>
</form>
<!--===================================================-->
<!--End Horizontal Form-->
<script>
	$(function(){
	    $(".chosen").chosen();
	});
</script>