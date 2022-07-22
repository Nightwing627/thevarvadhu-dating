<div id="info_life_style">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('life_style');?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('diet');?></span>
                        </td>
                        <td>
                            <?=$life_style_data[0]['diet']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('drink');?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['drink'])?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('smoke');?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('decision', $life_style_data[0]['smoke'])?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('living_with');?></span>
                        </td>
                        <td>
                            <?=$life_style_data[0]['living_with']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>