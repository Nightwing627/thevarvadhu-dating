<?php 
    /*
    $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
    $physical_attributes_data = json_decode($physical_attributes, true);
    */
?>
<div id="info_physical_attributes">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('physical_attributes');?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('height')?></span>
                        </td>
                        <td>
                            
                            <?php echo $this->Crud_model->get_new_type_name_by_id('user_height', $get_member[0]->p_height, 'display')?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('weight')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['weight']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('eye_color')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['eye_color']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('hair_color')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['hair_color']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('complexion')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['complexion']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('blood_group')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['blood_group']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('body_type')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['body_type']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('body_art')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['body_art']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('any_disability')?></span>
                        </td>
                        <td>
                            <?php echo $physical_attributes_data[0]['any_disability']?>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>