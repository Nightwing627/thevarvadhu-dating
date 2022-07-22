<!--Horizontal Form-->
<!--===================================================-->
<form class="form-horizontal" id="sub_caste_form" method="post">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="religion_id"><b><?php echo translate('religion')?></b></label>
			<div class="col-sm-8">
				<?=$this->Crud_model->select_html('religion', 'religion_id', 'name', 'add', 'form-control chosen', '', '', '', 'load_caste');?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="caste_id"><b><?php echo translate('caste')?></b></label>
			<div class="col-sm-8" id="load_caste">
				<select class="form-control chosen" name="caste_id">
					<option value=""><?php echo translate('choose_a_religion_first')?></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('sub_caste')?></b></label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="sub_caste_name" value="" required>
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