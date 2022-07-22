<div id="info_residency_information">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('residency_information')?>
        </h3>
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
                            <?=$this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['birth_country']);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('residency_country')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['residency_country']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('citizenship_country')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['citizenship_country']);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('grow_up_country')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('country', $residency_information_data[0]['grow_up_country']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('immigration_status')?></span>
                        </td>
                        <td>
                            <?=$residency_information_data[0]['immigration_status']?>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>