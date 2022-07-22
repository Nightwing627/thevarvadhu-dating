<div id="info_language">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('language')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('mother_tongue')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('language', $language_data[0]['mother_tongue']);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('language')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('language', $language_data[0]['language']);?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('speak')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('language', $language_data[0]['speak']);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('read')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('language', $language_data[0]['read']);?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    
</div>