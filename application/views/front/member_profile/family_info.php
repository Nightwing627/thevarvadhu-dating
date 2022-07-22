<?php 
/*
    $family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
    $family_info_data = json_decode($family_info, true);
    */
?>
<div id="info_family_info">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('family_information')?>
        </h3>
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