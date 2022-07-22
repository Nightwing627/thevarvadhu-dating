<div id="info_additional_personal_details">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('additional_personal_details')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('home_district')?></span>
                        </td>
                        <td>
                            <?=$additional_personal_details_data[0]['home_district']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('family_residence')?></span>
                        </td>
                        <td>
                            <?=$additional_personal_details_data[0]['family_residence']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate("father's_occupation")?></span>
                        </td>
                        <td>
                            <?=$additional_personal_details_data[0]['fathers_occupation']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('special_circumstances')?></span>
                        </td>
                        <td>
                            <?=$additional_personal_details_data[0]['special_circumstances']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
