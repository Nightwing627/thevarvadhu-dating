<?php
    /*
    $basic_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'basic_info');
    $basic_info_data = json_decode($basic_info, true);
    */
?>
<div id="info_basic_info">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('basic_information')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('first_name')?></span>
                        </td>
                        <td>
                            <?=$get_member[0]->first_name?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('last_name')?></span>
                        </td>
                        <td>
                            <?=$get_member[0]->last_name?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('gender')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender)?>
                        </td>
                        <td class="td-label">
                            <span><?php echo "Email";?></span>
                        </td>
                        <td>
                            <?php echo $get_member[0]->email?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('age')?></span>
                        </td>
                        <td>
                            <?=$calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('marital_status')?></span>
                        </td>
                        <td>
                            <?=$this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('number_of_children')?></span>
                        </td>
                        <td>
                            <?=$basic_info_data[0]['number_of_children']?>
                        </td>                        
                        <td class="td-label">
                            <span><?php echo translate('date_of_birth')?></span>
                        </td>
                        <td>
                            <?=date('d/m/Y', $get_member[0]->date_of_birth)?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('on_behalf')?></span>
                        </td>
                        <td>
                            <?php
                                $id = $get_member[0]->on_behalf; 
                                if($id == 1) echo "Self";
                                elseif($id == 2) echo "Daughter/Son";
                                elseif($id == 3) echo "Sister";
                                elseif($id == 4) echo "Brother";
                                elseif($id == 5) echo "Friend";
                                elseif($id == 6) echo "Mother";
                                else echo "Father";
                            ?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('mobile')?></span>
                        </td>
                        <td><?php echo $get_member[0]->mobile?></td>
                    </tr>
                    <tr>
                            <td class="td-label">
                                <span><?php echo translate('Caste')?></span>
                            </td>
                            <td>
                                 <?php 
                                 echo $this->Crud_model->get_type_name_by_id('caste', $basic_info_data[0]['caste']);
                                 ?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('Gotra');?></span>
                            </td>
                            <td><?php echo $get_member[0]->subcaste; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php echo translate('Height'); ?></span>
                            </td>
                            <td>
                                <?php 
                                echo $this->Crud_model->get_type_name_by_id('user_height', $basic_info_data[0]['p_height']);
                                ?>
                            </td>
                            <td>
                                <span><?php echo translate('Religion'); ?></span>
                            </td>
                            <td>
                                <?php
                                echo $this->Crud_model->get_type_name_by_id('religion', $basic_info_data[0]['religion']);
                                ?>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
