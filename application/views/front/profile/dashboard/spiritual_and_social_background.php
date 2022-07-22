<?php
    $spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'spiritual_and_social_background');
    $spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_spiritual_and_social_background">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('spiritual_and_social_background')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_spiritual_and_social_background" <?php if ($privacy_status_data[0]['spiritual_and_social_background'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('spiritual_and_social_background')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_spiritual_and_social_background" <?php if ($privacy_status_data[0]['spiritual_and_social_background'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('spiritual_and_social_background')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('spiritual_and_social_background')">
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
                                <span><?php echo translate('religion')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('religion', $get_member[0]->religion);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('caste_/_sect')?></span>
                            </td>
                            <td>
                                <?php
                                    if($spiritual_and_social_background_data[0]['caste'] != null){
                                        echo $this->db->get_where('caste',array('caste_id'=>$spiritual_and_social_background_data[0]['caste']))->row()->caste_name;
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('sub-Caste')?></span>
                            </td>
                            <td>
                                <?php
                                    if($spiritual_and_social_background_data[0]['sub_caste'] != null){
                                        echo $this->db->get_where('sub_caste',array('sub_caste_id'=>$spiritual_and_social_background_data[0]['sub_caste']))->row()->sub_caste_name;
                                    }
                                ?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('ethnicity')?></span>
                            </td>
                            <td>
                                <?php echo $spiritual_and_social_background_data[0]['ethnicity']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('personal_value')?></span>
                            </td>
                            <td>
                                <?php echo $spiritual_and_social_background_data[0]['personal_value']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('family_value')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('family_value', $spiritual_and_social_background_data[0]['family_value']);?>

                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('community_value')?></span>
                            </td>
                            <td>
                                <?php echo $spiritual_and_social_background_data[0]['community_value']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('family_status')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('family_status', $spiritual_and_social_background_data[0]['family_status']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label"><?php echo translate('manglik')?></td>
                            <td><?php $u_manglik=$spiritual_and_social_background_data[0]['u_manglik'];

                                    if($u_manglik == 1){
                                        echo "Yes";
                                    }elseif($u_manglik == 2){
                                        echo "No";
                                    }
                                    elseif($u_manglik == 3){
                                        echo "I don't know";
                                    }else{
                                        echo " ";
                                    }
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_spiritual_and_social_background" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('spiritual_and_social_background')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('spiritual_and_social_background')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('spiritual_and_social_background')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_spiritual_and_social_background" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="religion" class="text-uppercase c-gray-light"><?php echo translate('religion')?></label>
                        <?php
                            echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker present_religion_edit', $get_member[0]->religion, '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="caste" class="text-uppercase c-gray-light"><?php echo translate('caste')?></label>
                        <?php
                            if (!empty($spiritual_and_social_background_data[0]['religion'])) {
                                echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_edit', $spiritual_and_social_background_data[0]['caste'], 'religion_id', $spiritual_and_social_background_data[0]['religion'], '');
                            } else {
                            ?>
                                <select class="form-control form-control-sm selectpicker present_caste_edit" name="caste">
                                    <option value=""><?php echo translate('choose_a_religion_first')?></option>
                                </select>
                            <?php
                            }
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="sub_caste" class="text-uppercase c-gray-light"><?php echo translate('sub_caste')?></label>
                        <?php
                            if (!empty($spiritual_and_social_background_data[0]['caste'])) {
                                echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_edit', $spiritual_and_social_background_data[0]['sub_caste'], 'caste_id', $spiritual_and_social_background_data[0]['caste'], '');
                            } else {
                            ?>
                                <select class="form-control form-control-sm selectpicker present_sub_caste_edit" name="sub_caste">
                                    <option value=""><?php echo translate('choose_a_caste_first')?></option>
                                </select>
                            <?php
                            }
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="ethnicity" class="text-uppercase c-gray-light"><?php echo translate('ethnicity')?></label>
                        <input type="text" class="form-control no-resize" name="ethnicity" value="<?php echo $spiritual_and_social_background_data[0]['ethnicity']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="personal_value" class="text-uppercase c-gray-light"><?php echo translate('personal_value')?></label>
                        <input type="text" class="form-control no-resize" name="personal_value" value="<?php echo $spiritual_and_social_background_data[0]['personal_value']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="family_value" class="text-uppercase c-gray-light"><?php echo translate('family_value')?></label>
                       <?php
                            echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker family_value_edit', $spiritual_and_social_background_data[0]['family_value'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="community_value" class="text-uppercase c-gray-light"><?php echo translate('community_value')?></label>
                        <input type="text" class="form-control no-resize" name="community_value" value="<?php echo $spiritual_and_social_background_data[0]['community_value']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="family_value" class="text-uppercase c-gray-light"><?php echo translate('family_status')?></label>
                        <?php
                            echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker family_status_edit', $spiritual_and_social_background_data[0]['family_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="u_manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik')?></label>

                        <select name="u_manglik" class="form-control form-control-sm selectpicker" data-placeholder="Choose a manglik" tabindex="2" data-hide-disabled="true">
                            <option value="">Choose one</option>
                            <option value="1" <?php if($u_manglik==1){ echo 'selected';} ?>>Yes</option>
                            <option value="2" <?php if($u_manglik==2){ echo 'selected';} ?>>No</option>
                            <option value="3" <?php if($u_manglik==3){ echo 'selected';} ?>>I don't know</option>
                        </select>
                        <!-- <?php
                            echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $spiritual_and_social_background_data[0]['manglik'], '', '', '');
                        ?> -->
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(".present_religion_edit").change(function(){
        var religion_id = $(".present_religion_edit").val();
        if (religion_id == "") {
            $(".present_caste_edit").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".present_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_caste_edit").html(data);
                    $(".present_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".present_caste_edit").change(function(){
        var caste_id = $(".present_caste_edit").val();
        if (caste_id == "") {
            $(".present_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".present_sub_caste_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>
