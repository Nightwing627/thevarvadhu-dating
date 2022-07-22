<?php 
    $additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'additional_personal_details');
    $additional_personal_details_data = json_decode($additional_personal_details, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_additional_personal_details">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('additional_personal_details')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_additional_personal_details" <?php if ($privacy_status_data[0]['additional_personal_details'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('additional_personal_details')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_additional_personal_details" <?php if ($privacy_status_data[0]['additional_personal_details'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('additional_personal_details')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('additional_personal_details')">
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
                                <span><?php echo translate('home_district')?></span>
                            </td>
                            <td>
                                <?php echo $additional_personal_details_data[0]['home_district']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('family_residence')?></span>
                            </td>
                            <td>
                                <?php echo $additional_personal_details_data[0]['family_residence']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate("father's_occupation")?></span>
                            </td>
                            <td>
                                <?php echo $additional_personal_details_data[0]['fathers_occupation']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('special_circumstances')?></span>
                            </td>
                            <td>
                                <?php echo $additional_personal_details_data[0]['special_circumstances']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_additional_personal_details" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('additional_personal_details')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('additional_personal_details')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('additional_personal_details')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_additional_personal_details" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="home_district" class="text-uppercase c-gray-light"><?php echo translate('home_district')?></label>
                        <input type="text" class="form-control no-resize" name="home_district" value="<?php echo $additional_personal_details_data[0]['home_district']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="family_residence" class="text-uppercase c-gray-light"><?php echo translate('family_residence')?></label>
                        <input type="text" class="form-control no-resize" name="family_residence" value="<?php echo $additional_personal_details_data[0]['family_residence']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="fathers_occupation" class="text-uppercase c-gray-light"><?php echo translate("father's_occupation")?></label>
                        <input type="text" class="form-control no-resize" name="fathers_occupation" value="<?php echo $additional_personal_details_data[0]['fathers_occupation']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="special_circumstances" class="text-uppercase c-gray-light"><?php echo translate('special_circumstances')?></label>
                        <input type="text" class="form-control no-resize" name="special_circumstances" value="<?php echo $additional_personal_details_data[0]['special_circumstances']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>