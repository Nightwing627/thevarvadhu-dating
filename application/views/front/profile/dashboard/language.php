<?php 
    $language = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'language');
    $language_data = json_decode($language, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_language">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('language')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_language" <?php if ($privacy_status_data[0]['language'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('language')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_language" <?php if ($privacy_status_data[0]['language'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('language')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('language')">
                <i class="ion-edit"></i>
                </button> 
            </div>
        </div>
        <div class="table-full-width">
            <div class="table-full-width">
                <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                    <tbody>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('mother_tongue')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_new_type_name_by_id('mother_tounge', $get_member[0]->mother_tounge,'display');?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('language')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('language', $language_data[0]['language']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('speak')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('language', $language_data[0]['speak']);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('read')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('language', $language_data[0]['read']);?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>

    <div id="edit_language" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('language')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('language')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('language')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_language" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mother_tongue" class="text-uppercase c-gray-light"><?php echo translate('mother_tongue')?></label>
                        <?php 
                            echo $this->Crud_model->select_new_html('mother_tounge', 'mother_tounge', 'display', 'edit', 'form-control form-control-sm selectpicker',$get_member[0]->mother_tounge, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="language" class="text-uppercase c-gray-light"><?php echo translate('language')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['language'], '', '', '');
                        ?>                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="speak" class="text-uppercase c-gray-light"><?php echo translate('speak')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('language', 'speak', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['speak'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="read" class="text-uppercase c-gray-light"><?php echo translate('read')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('language', 'read', 'name', 'edit', 'form-control form-control-sm selectpicker', $language_data[0]['read'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>