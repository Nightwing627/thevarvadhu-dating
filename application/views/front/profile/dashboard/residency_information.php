<?php 
    $residency_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'residency_information');
    $residency_information_data = json_decode($residency_information, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_residency_information">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('residency_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_residency_information" <?php if ($privacy_status_data[0]['residency_information'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('residency_information')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_residency_information" <?php if ($privacy_status_data[0]['residency_information'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('residency_information')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('residency_information')">
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
                                <span><?php echo translate('birth_country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['birth_country']);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('residency_country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['residency_country']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('citizenship_country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['citizenship_country']);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('grow_up_country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['grow_up_country']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('immigration_status')?></span>
                            </td>
                            <td>
                                <?php echo $residency_information_data[0]['immigration_status']?>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_residency_information" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('residency_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('residency_information')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('residency_information')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_residency_information" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="birth_country" class="text-uppercase c-gray-light"><?php echo translate('birth_country')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('country', 'birth_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['birth_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="residency_country" class="text-uppercase c-gray-light"><?php echo translate('residency_country')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('country', 'residency_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['residency_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="citizenship_country" class="text-uppercase c-gray-light"><?php echo translate('citizenship_country')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('country', 'citizenship_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['citizenship_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="grow_up_country" class="text-uppercase c-gray-light"><?php echo translate('grow_up_country')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('country', 'grow_up_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information_data[0]['grow_up_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="immigration_status" class="text-uppercase c-gray-light"><?php echo translate('immigration_status')?></label>
                        <input type="text" class="form-control no-resize" name="immigration_status" value="<?php echo $residency_information_data[0]['immigration_status']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>