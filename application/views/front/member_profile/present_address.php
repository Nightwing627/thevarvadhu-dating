<div id="info_present_address">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('present_address');?>
        </h3>
    </div>
    <?php 
        /*
        $present_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'present_address');
        $present_address_data = json_decode($present_address, true);
        */
    ?>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('country')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('country', $get_member[0]->country);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('state')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('state', $get_member[0]->state);?>
                        </td>


                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('city')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('city', $get_member[0]->city);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('address')?></span>
                        </td>
                        <td>
                            <?php echo $present_address_data[0]['address']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('residence')?></span>
                        </td>
                        <td>
                            <?php echo $this->Crud_model->get_type_name_by_id('residence', $get_member[0]->residence);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('mobile2')?></span>
                        </td>
                        <td>
                            <?php echo $present_address_data[0]['mobile2']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>