
    <table class="table table-sm table-striped table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>
                <?php echo translate('image')?>
            </th>
            <th>
                <?php echo translate('name')?>
            </th>
            <th>
                <?php echo translate('age')?>
            </th>
            <th>
                <?php echo translate('religion')?>
            </th>
            <th>
                <?php echo translate('location')?>
            </th>
            <th>
                <?php echo translate('mother_tongue')?>
            </th>
            <th>
                <?php echo translate('status')?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
            $new_express_interest_members = array();
            foreach ($express_interest_members as $member) {
                if ($member->is_closed =='no') {
                    $new_express_interest_members[] = $member;
                }
            }
            if ($new_express_interest_members == NULL) {
        ?>
            <tr>
                <td align="center" colspan="7"><?=translate('no_result_found!')?></td>
            </tr>
        <?php
        }
        else{
            foreach ($new_express_interest_members as $data): ?>
                <?php
                    $member_id = $data->member_id;
                    $image = json_decode($data->profile_image, true);
                    $spiritual_and_social_background = json_decode($data->spiritual_and_social_background, true);
                    $present_address = json_decode($data->present_address, true);
                    $language = json_decode($data->language, true);
                ?>
                <tr id="member_<?=$member_id?>">
                    <td>
                        <a href="<?=base_url()?>home/member_profile/<?=$member_id?>">
                            <?php
                                $profile_pic_approval = $this->db->get_where('general_settings', array('type' => 'member_profile_pic_approval_by_admin'))->row()->value;
                                $profile_image_status = $data->profile_image_status;
                                $pic_show_status = 'ok';
                                if ($profile_pic_approval == 'on') {
                                    if($profile_image_status == 1){
                                        $pic_show_status = 'ok';
                                    }
                                    else{
                                        $pic_show_status = 'no';
                                    }
                                }
                                if (file_exists('uploads/profile_image/'.$image[0]['thumb']) && $pic_show_status == 'ok') {
                                ?>
                                <img src="<?=base_url()?>uploads/profile_image/<?=$image[0]['thumb']?>" alt="" style="height: 50px">
                                <?php
                                }
                                else {
                                ?>
                                <img src="<?=base_url()?>uploads/profile_image/default.jpg" alt="" style="height: 50px">
                            <?php
                            }
                            ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?=base_url()?>home/member_profile/<?=$member_id?>" style="color: #55595c">
                            <?=$data->first_name." ".$data->last_name?>
                        </a>
                    </td>
                    <td>
                        <?=(date('Y') - date('Y', $data->date_of_birth))?>
                    </td>
                    <td>
                        <?=$this->Crud_model->get_type_name_by_id('religion', $spiritual_and_social_background[0]['religion']);?>
                    </td>
                    <td>
                        <?php if($present_address[0]['country']){ echo $this->Crud_model->get_type_name_by_id('state', $present_address[0]['state']).', '.$this->Crud_model->get_type_name_by_id('country', $present_address[0]['country']);}?>
                    </td>
                    <td>
                        <?=$this->Crud_model->get_type_name_by_id('language', $language[0]['mother_tongue']);?>
                    </td>
                    <td>
                        <p>
                        <?php
                            foreach ($array_total_interests as $total_interest) {
                                if ($total_interest['id'] == $member_id) {
                                    if ($total_interest['status'] == 'pending') {
                                    ?>
                                        <span class="badge badge-md badge-pill bg-dark"><?php echo translate('pending')?></span>
                                    <?php
                                    } elseif ($total_interest['status'] == 'accepted') {
                                    ?>
                                        <span class="badge badge-md badge-pill bg-success"><?php echo translate('accepted')?></span>
                                    <?php
                                    } elseif ($total_interest['status'] == 'rejected') {
                                    ?>
                                        <span class="badge badge-md badge-pill bg-danger"><?php echo translate('rejected')?></span>
                                    <?php
                                    }
                                }
                            }
                        ?>
                        </p>
                    </td>
                </tr>
            <?php endforeach;
            }
            ?>
        </tbody>
    </table>

<div id="pseudo_pagination" style="display: none;">
    <?= $this->ajax_pagination->create_links();?>
</div>
<script type="text/javascript">
    $('#pagination').html($('#pseudo_pagination').html());
</script>
