<?php
    $basic_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'basic_info');
    $basic_info_data = json_decode($basic_info, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_basic_info">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('basic_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1 disabled"> 
                <!--onclick="edit_section('basic_info')"-->
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
                                <span><?php echo translate('first_name')?></span>
                            </td>
                            <td>
                                <?php echo $get_member[0]->first_name?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('last_name')?></span>
                            </td>
                            <td>
                                <?php echo $get_member[0]->last_name?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('gender')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender)?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('email')?></span>
                            </td>
                            <td>
                                <?php echo $get_member[0]->email?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('age')?></span>
                            </td>
                            <td>
                                <?php
                                    $calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));
                                    echo $calculated_age;
                                ?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('marital_status')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('number_of_children')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('child_count', $basic_info_data[0]['child_count'])?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('date_of_birth')?></span>
                            </td>
                            <td>
                                <?php echo date('d/m/Y', $get_member[0]->date_of_birth)?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('on_behalf')?></span>
                            </td>
                            <td>
                                <?php
                                $id = $get_member[0]->on_behalf; 
                                if($id == 1) echo "Self";
                                elseif($id == 2) echo "Daughter/Son";
                                elseif($id == 3) echo "Sister";
                                elseif($id == 4) echo "Brother";
                                elseif($id == 5) echo "Friend";
                                elseif($id == 6) echo "Mother";
                                else echo "Father";
                                ?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('mobile')?></span>
                            </td>
                            <td><?php echo $get_member[0]->mobile?></td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('Caste')?></span>
                            </td>
                            <td>
                                 <?php 
                                 echo $this->Crud_model->get_type_name_by_id('caste', $basic_info_data[0]['caste']);
                                 ?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('Gotra');?></span>
                            </td>
                            <td><?php echo $get_member[0]->subcaste; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php echo translate('Height'); ?></span>
                            </td>
                            <td>
                                <?php 
                                echo $this->Crud_model->get_type_name_by_id('user_height', $basic_info_data[0]['p_height']);
                                ?>
                            </td>
                            <td>
                                <span><?php echo translate('Religion'); ?></span>
                            </td>
                            <td>
                                <?php
                                echo $this->Crud_model->get_type_name_by_id('religion', $basic_info_data[0]['religion']);
                                ?>
                            </td>
                        </tr>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_basic_info" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('basic_information')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('basic_info')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('basic_info')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_basic_info" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('first_name')?></label>
                        <input type="text" class="form-control no-resize" name="first_name" value="<?php echo $get_member[0]->first_name?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="last_name" class="text-uppercase c-gray-light"><?php echo translate('last_name')?></label>
                        <input type="text" class="form-control no-resize" name="last_name" value="<?php echo $get_member[0]->last_name?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('gender')?></label>
                        <?php
                            echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->gender, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="email" class="text-uppercase c-gray-light"><?php echo translate('email')?></label>
                        <input type="hidden" name="old_email" value="<?php echo $get_member[0]->email?>">
                        <input type="email" class="form-control no-resize" name="email" value="<?php echo $get_member[0]->email?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="date_of_birth" class="text-uppercase c-gray-light"><?php echo translate('date_of_birth')?> </label>
                        <input type="date" class="form-control no-resize" name="date_of_birth" value="<?php echo date('Y-m-d', $get_member[0]->date_of_birth)?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status')?></label>
                        <?php
                            echo $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['marital_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="number_of_children" class="text-uppercase c-gray-light"><?php echo translate('number_of_children')?></label>
                        <input type="number" class="form-control no-resize" name="number_of_children" value="<?php echo $basic_info_data[0]['number_of_children']?>" min="0">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="on_behalf" class="text-uppercase c-gray-light"><?php echo translate('on_behalf')?></label>
                        <?php
                            echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker present_on_behalf_edit', $basic_info_data[0]['on_behalf'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mobile" class="text-uppercase c-gray-light"><?php echo translate('mobile')?></label>
                        <input type="hidden" name="old_mobile" value="<?php echo $get_member[0]->mobile?>">
                        <input type="number" class="form-control no-resize" name="mobile" value="<?php echo $get_member[0]->mobile?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
