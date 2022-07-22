<div id="info_spiritual_and_social_background">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('spiritual_and_social_background')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('religion')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('religion', $spiritual_and_social_background_data[0]['religion']);?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('caste_/_sect')?></span>
                        </td>
                        <td>
                            <?php
                                if($spiritual_and_social_background_data[0]['caste'] != null){
                                    echo $this->db->get_where('caste',array('caste_id'=>$spiritual_and_social_background_data[0]['caste']))->row()->caste_name;
                                }
                             ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('sub-Caste')?></span>
                        </td>
                        <td>
                            <?php
                                if($spiritual_and_social_background_data[0]['sub_caste'] != null){
                                    echo $this->db->get_where('sub_caste',array('sub_caste_id'=>$spiritual_and_social_background_data[0]['sub_caste']))->row()->sub_caste_name;
                                }
                            ?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('ethnicity')?></span>
                        </td>
                        <td>
                            <?=$spiritual_and_social_background_data[0]['ethnicity']?>
                        </td>
                    </tr>
                    <tr>
                            <td class="td-label">
                                <span><?php echo translate('personal_value')?></span>
                            </td>
                            <td>
                                <?=$spiritual_and_social_background_data[0]['personal_value']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('family_value')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('family_value', $spiritual_and_social_background_data[0]['family_value']);?>

                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('community_value')?></span>
                            </td>
                            <td>
                                <?=$spiritual_and_social_background_data[0]['community_value']?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('family_status')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('family_status', $spiritual_and_social_background_data[0]['family_status']);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label"><?php echo translate('manglik')?></td>
                            <td><?php $u_manglik=$spiritual_and_social_background_data[0]['u_manglik'];

                                    if($u_manglik == 1){
                                        echo "Yes";
                                    }elseif($u_manglik == 2){
                                        echo "No";
                                    }
                                    elseif($u_manglik == 3){
                                        echo "I don't know";
                                    }else{
                                        echo " ";
                                    }
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
