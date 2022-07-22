<?php 
    $life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
    $life_style_data = json_decode($life_style, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_life_style">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('life_style')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_life_style" <?php if ($privacy_status_data[0]['life_style'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('life_style')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_life_style" <?php if ($privacy_status_data[0]['life_style'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('life_style')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('life_style')">
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
                                <span><?php echo translate('diet')?></span>
                            </td>
                            <td>
                                <?php echo $life_style_data[0]['diet']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('drink')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['drink'])?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('smoke')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['smoke'])?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('living_with')?></span>
                            </td>
                            <td>
                                <?php echo $life_style_data[0]['living_with']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_life_style" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('life_style')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('life_style')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('life_style')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_life_style" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="diet" class="text-uppercase c-gray-light"><?php echo translate('diet')?></label>
                        <input type="text" class="form-control no-resize" name="diet" value="<?php echo $life_style_data[0]['diet']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="drink" class="text-uppercase c-gray-light"><?php echo translate('drink')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('decision', 'drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style_data[0]['drink'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="smoke" class="text-uppercase c-gray-light"><?php echo translate('smoke')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('decision', 'smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style_data[0]['smoke'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="living_with" class="text-uppercase c-gray-light"><?php echo translate('living_with')?></label>
                        <input type="text" class="form-control no-resize" name="living_with" value="<?php echo $life_style_data[0]['living_with']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>