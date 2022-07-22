<div id="info_astronomic_information">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('astronomic_information')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('sun_sign')?></span>
                        </td>
                        <td>
                            <?=$astronomic_information_data[0]['sun_sign']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('moon_sign')?></span>
                        </td>
                        <td>
                            <?=$astronomic_information_data[0]['moon_sign']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('time_of_birth')?></span>
                        </td>
                        <td>
                            <?=$astronomic_information_data[0]['time_of_birth']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('city_of_birth')?></span>
                        </td>
                        <td>
                            <?=$astronomic_information_data[0]['city_of_birth']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>