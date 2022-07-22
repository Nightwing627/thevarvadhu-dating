<!--Horizontal Form-->
<!--===================================================-->
<?php
foreach ($get_caste as $value) 
{
?>
	<form class="form-horizontal" id="caste_form" action="" method="post">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('religion')?></b></label>
				<div class="col-sm-8">
					<?=$this->Crud_model->select_html('religion', 'religion_id', 'name', 'edit', 'form-control chosen', $value->religion_id, '', '', '');?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="demo-hor-inputemail"><b><?php echo translate('caste_name')?></b></label>
				<div class="col-sm-8">
					<input type="hidden" class="form-control" name="caste_id" value="<?=$value->caste_id;?>">
					<input type="text" class="form-control" name="name" value="<?=$value->caste_name;?>">
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