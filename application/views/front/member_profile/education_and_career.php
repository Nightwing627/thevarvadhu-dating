<?php 
    /*
    $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
    $education_and_career_data = json_decode($education_and_career, true);
    */
?>
<div id="info_education_and_career">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('education_&_career')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('education')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('education', $get_member[0]->eduction)?>
                            
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('occupation')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('occupation', $get_member[0]->occupation)?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('education detail')?></span>
                        </td>
                        <td>
                            <?php echo $education_and_career_data[0]['education_detail']?>
                            
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('occupation detail')?></span>
                        </td>
                        <td>
                            <?php echo $education_and_career_data[0]['occupation_detail']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('annual_income')?></span>
                        </td>
                        <td>
                                <?php echo $this->Crud_model->get_new_type_name_by_id('anual_income', $get_member[0]->anual_income, 'display')?>
                        </td>
                        <td>
                            <span><?php echo translate('employed')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_new_type_name_by_id('employed', $get_member[0]->employed, 'display')?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>