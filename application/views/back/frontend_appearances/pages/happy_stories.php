<p class="text-main text-semibold"><?php echo translate('happy_stories')?></p>
<?php $happy_stories_text = $this->db->get_where('frontend_settings', array('type' => 'happy_stories_text'))->row()->value; ?>
<form class="form-horizontal" id="contact_info_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/happy_stories">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="happy_stories_text"><b><?php echo translate('happy_stories_header_text')?></b></label>
        <div class="col-sm-9">
        	<textarea class="form-control" id="happy_stories_text" name="happy_stories_text" rows="5"><?=$happy_stories_text?></textarea>
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>