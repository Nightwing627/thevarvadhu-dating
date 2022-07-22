<p class="text-main text-semibold"><?php echo translate('social_links')?></p>
<form class="form-horizontal" id="social_links_form" action="<?=base_url()?>admin/general_settings/update_social_links" method="POST">
	<!--FACEBOOK-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon fb_font">
	                <i class="fa fa-facebook-square fa-lg"></i>
	            </span>
	            <input type="text" name="facebook" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '1', 'value')?>" class="form-control">
	        </div>
	    </div>
	</div>
	<!--G+-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon g_font">
	                <i class="fa fa-google-plus-square fa-lg"></i>
	            </span>
	            <input type="text" name="google-plus" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '2', 'value')?>" class="form-control">
	        </div>

	    </div>
	</div>
	<!--TWITTER-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon tw_font">
	                <i class="fa fa-twitter-square fa-lg"></i>
	            </span>
	            <input type="text" name="twitter" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '3', 'value')?>" class="form-control">
	        </div>

	    </div>
	</div>
	<!--PINTEREST-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon pin_font">
	                <i class="fa fa-pinterest fa-lg"></i>
	            </span>
	            <input type="text" name="pinterest" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '5', 'value')?>" class="form-control">
	        </div>

	    </div>
	</div>
	<!--SKYPE-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon skype_font">
	                <i class="fa fa-skype fa-lg"></i>
	            </span>
	            <input type="text" name="skype" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '4', 'value')?>" class="form-control">
	        </div>

	    </div>
	</div>
	<!--YOUTUBE-->
	<div class="form-group row">
	    <label class="col-sm-2 control-label"></label>
	    <div class="col-sm-8">
	        <div class="input-group mar-btm">
	            <span class="input-group-addon youtube_font">
	                <i class="fa fa-youtube fa-lg"></i>
	            </span>
	            <input type="text" name="youtube" value="<?=$this->Crud_model->get_type_name_by_id('social_links', '6', 'value')?>" class="form-control">
	        </div>
	    </div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8 text-right">
        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('save')?></button>
		</div>
	</div>
</form>