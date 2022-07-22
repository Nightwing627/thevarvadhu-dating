<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_sub_caste as $value) 
{
?>
	<form class="form-horizontal" id="sub_caste_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="religion_id"><b><?php echo translate('religion')?></b></label>
				<div class="col-sm-8">
					<?=$this->Crud_model->select_html('religion', 'religion_id', 'name', 'edit', 'form-control chosen', $religion_id, '', '', 'load_caste');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="caste_id"><b><?php echo translate('caste')?></b></label>
				<div class="col-sm-8" id="load_caste">
					<?=$this->Crud_model->select_html('caste', 'caste_id', 'caste_name', 'edit', 'form-control chosen', $value->caste_id, 'religion_id', $religion_id, '');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('sub_caste_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="sub_caste_id" value="<?=$value->sub_caste_id;?>">
					<input type="text" class="form-control" name="sub_caste_name" value="<?=$value->sub_caste_name;?>">
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