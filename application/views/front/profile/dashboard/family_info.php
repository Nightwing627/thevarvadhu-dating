<?php 
    $family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
    $family_info_data = json_decode($family_info, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_family_info">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('family_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_family_info" <?php if ($privacy_status_data[0]['family_info'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('family_info')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_family_info" <?php if ($privacy_status_data[0]['family_info'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('family_info')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1 disabled">
                     <!--onclick="edit_section('family_info')"-->
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
                                <span><?php echo "Family Type";?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_new_type_name_by_id('family_type', $get_member[0]->family_type, 'display')?>
                            </td>
                            <td class="td-label">
                                <span><?php echo "Family Status";?></span>
                            </td>
                            <td><?php echo $this->Crud_model->get_type_name_by_id('family_status', $get_member[0]->family_status)?></td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo "Family Values";?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('family_value', $get_member[0]->family_values)?>
                            </td>
                            <td class="td-label">
                                <span><?php echo "Mother Tounge";?></span>
                            </td>
                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('mother_tounge', $get_member[0]->mother_tounge, 'display')?></td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('father').' Name';?></span>
                            </td>
                            <td>
                                <?php echo $family_info_data[0]['father_name']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('mother').' Name';?></span>
                            </td>
                            <td>
                                <?php echo $family_info_data[0]['mother_name']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('father').' Occupation';?></span>
                            </td>
                            <td>
                                <?php echo $family_info_data[0]['father_occupation']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('mother').' Occupation';?></span>
                            </td>
                            <td>
                                <?php echo  $family_info_data[0]['mother_occupation']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo "Brothers";?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->brothers, 'display')?>
                            </td>
                            <td class="td-label">
                                <span><?php echo "Sisters";?></span>
                            </td>
                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->sisters, 'display')?></td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo "Married Brothers";?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->married_brothers, 'display')?>
                            </td>
                            <td class="td-label">
                                <span><?php echo "Married Sisters";?></span>
                            </td>
                            <td><?php echo $this->Crud_model->get_new_type_name_by_id('brothers-sister_count', $get_member[0]->married_sisters, 'display')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_family_info" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('family_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('family_info')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('family_info')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_family_info" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="father" class="text-uppercase c-gray-light"><?php echo 'Family Type';?></label>
                        <?php
                            echo $this->Crud_model->select_new_html('family_type', 'family_type', 'display', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->family_type, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Name';?></label>
                        <input type="text" class="form-control no-resize" name="mother" value="<?php echo $family_info_data[0]['mother']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father').' Name';?></label>
                        <input type="text" class="form-control no-resize" name="father" value="<?php echo $family_info_data[0]['father']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Name';?></label>
                        <input type="text" class="form-control no-resize" name="mother" value="<?php echo $family_info_data[0]['mother']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father').' Name';?></label>
                        <input type="text" class="form-control no-resize" name="father" value="<?php echo $family_info_data[0]['father']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Name';?></label>
                        <input type="text" class="form-control no-resize" name="mother" value="<?php echo $family_info_data[0]['mother']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father').' Occupation';?></label>
                        
                         <?php
                            echo $this->Crud_model->select_new_html('father_ocuupation', 'father_ocuupation', 'display', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->father_ocuupation, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother').' Occupation';?></label>
                        
                         <?php
                            echo $this->Crud_model->select_new_html('mother_occupation', 'mother_occupation', 'display', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->mother_occupation, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="brother_sister" class="text-uppercase c-gray-light"><?php echo "Brothers";?></label>
                        
                        <?php
                            echo $this->Crud_model->select_new_html('brothers-sister_count', 'brothers', 'display', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->brothers, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="brother_sister" class="text-uppercase c-gray-light"><?php echo "Sisters";?></label>
                        
                         <?php
                            echo $this->Crud_model->select_new_html('brothers-sister_count', 'sisters', 'display', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->sisters, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>