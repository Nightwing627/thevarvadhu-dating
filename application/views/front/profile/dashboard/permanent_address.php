<?php 
    $permanent_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'permanent_address');
    $permanent_address_data = json_decode($permanent_address, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_permanent_address">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('permanent_address')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_permanent_address" <?php if ($privacy_status_data[0]['permanent_address'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('permanent_address')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_permanent_address" <?php if ($privacy_status_data[0]['permanent_address'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('permanent_address')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('permanent_address')">
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
                                <span><?php echo translate('country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $permanent_address_data[0]['permanent_country']);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('state')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('state', $permanent_address_data[0]['permanent_state']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('city')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('city', $permanent_address_data[0]['permanent_city']);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('postal-Code')?></span>
                            </td>
                            <td>
                                <?php echo $permanent_address_data[0]['permanent_postal_code']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_permanent_address" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('permanent_address')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('permanent_address')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('permanent_address')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_permanent_address" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="permanent_country" class="text-uppercase c-gray-light"><?php echo translate('country')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('country', 'permanent_country', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_country_edit', $permanent_address_data[0]['permanent_country'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="permanent_state" class="text-uppercase c-gray-light"><?php echo translate('state')?></label>
                        <?php
                            if (!empty($permanent_address_data[0]['permanent_country'])) {
                                echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_edit', $permanent_address_data[0]['permanent_state'], 'country_id', $permanent_address_data[0]['permanent_country'], '');   
                            } else {
                            ?>
                                <select class="form-control form-control-sm selectpicker permanent_state_edit" name="permanent_state">
                                    <option value=""><?php echo translate('choose_a_country_first')?></option>
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
                        <label for="permanent_city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
                        <?php
                            if (!empty($permanent_address_data[0]['permanent_state'])) {
                                echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_edit', $permanent_address_data[0]['permanent_city'], 'state_id', $permanent_address_data[0]['permanent_state'], '');   
                            } 
                            else {
                            ?>
                                <select class="form-control form-control-sm selectpicker permanent_city_edit" name="permanent_city">
                                    <option value=""><?php echo translate('choose_a_state_first')?></option>
                                </select>
                            <?php
                            }
                        ?>                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="permanent_postal_code" class="text-uppercase c-gray-light"><?php echo translate('postal-Code')?></label>
                        <input type="text" class="form-control no-resize" name="permanent_postal_code" value="<?php echo $permanent_address_data[0]['permanent_postal_code']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(".permanent_country_edit").change(function(){
        var country_id = $(".permanent_country_edit").val();
        if (country_id == "") {
            $(".permanent_state_edit").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
            $(".permanent_city_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".permanent_state_edit").html(data);
                    $(".permanent_city_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".permanent_state_edit").change(function(){
        var state_id = $(".permanent_state_edit").val();
        if (state_id == "") {
            $(".permanent_city_edit").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id/city/state_id/"+state_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".permanent_city_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>