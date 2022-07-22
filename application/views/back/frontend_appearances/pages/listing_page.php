<p class="text-main text-semibold"><?php echo translate('listing_page')?></p>
<?php $advance_search_position = $this->db->get_where('frontend_settings', array('type' => 'advance_search_position'))->row()->value; ?>
<form class="form-horizontal" id="contact_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/listing_page">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="advance_search_position"><b><?php echo translate('advance_search_position')?></b></label>
        <div class="col-sm-9">
        	<select class="form-control" name="advance_search_position" id="advance_search_position">
                <option value="left" <?php if($advance_search_position=='left'){ echo "selected"; }?>><?php echo translate('left')?></option>
                <option value="right" <?php if($advance_search_position=='right'){ echo "selected"; }?>><?php echo translate('right')?></option>
            </select>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>