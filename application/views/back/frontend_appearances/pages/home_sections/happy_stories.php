<?php $max_story_num = $this->db->get_where('frontend_settings', array('type' => 'max_story_num'))->row()->value; ?>
<form class="form-horizontal" id="happy_stories_form" method="POST" action="<?=base_url()?>admin/save_frontend_settings/home_happy_stories">
	<div class="form-group">
        <label class="col-sm-2 control-label" for="home_stories_status"><b><?= translate('display_status')?></b></label>
        <div class="col-sm-9">
            <?php
                $home_stories_status = $this->db->get_where('frontend_settings', array('type' => 'home_stories_status'))->row()->value;
                ?>
            <div class="checkbox">
                <input id="home_stories_status" name="home_stories_status" class="magic-checkbox" type="checkbox" <?php if($home_stories_status=='yes'){ echo "checked"; }?>  >
                <label for="home_stories_status"></label>
            </div>
        </div>
    </div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="max_story_num"><b><?php echo translate('max_happy_stories_number')?></b></label>
        <div class="col-sm-9">
        	<input type="number" class="form-control" id="max_story_num" name="max_story_num" value="<?=$max_story_num?>" min="5" max="40" required="">
        </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
		</div>
	</div>
</form>