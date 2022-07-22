<div id="info_personal_attitude_and_behavior">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('personal_atitude_&_behavior');?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('affection');?></span>
                        </td>
                        <td>
                            <?=$personal_attitude_and_behavior_data[0]['affection']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('humor');?></span>
                        </td>
                        <td>
                            <?=$personal_attitude_and_behavior_data[0]['humor']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('political_view');?></span>
                        </td>
                        <td>
                            <?=$personal_attitude_and_behavior_data[0]['political_view']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('religious_service');?></span>
                        </td>
                        <td>
                            <?=$personal_attitude_and_behavior_data[0]['religious_service']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>