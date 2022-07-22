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
                <?php echo translate('options')?>
            </th>
        </tr>
        </thead>
        <tbody>

    <?php
        $new_ignored_members_data = array();
        foreach ($ignored_members_data as $member) {
            if ($member->is_closed =='no') {
                $new_ignored_members_data[] = $member;
            }
        }
        if ($new_ignored_members_data == NULL) {
        ?>
            <tr>
                <td align="center" colspan="7"><?=translate('no_result_found!')?></td>
            </tr>
        <?php
        } else {
            foreach ($new_ignored_members_data as $member): ?>
                <?php
                    if($member->is_closed =='no'){
                    $image = json_decode($member->profile_image, true);
                    $basic_info = json_decode($member->basic_info, true);
                    $spiritual_and_social_background = json_decode($member->spiritual_and_social_background, true);
                    $present_address = json_decode($member->present_address, true);
                    $language = json_decode($member->language, true);
                ?>
                <tr id="member_<?=$member->member_id?>">
                    <td>
                        <?php
                            if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
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
                    </td>
                    <td>
                        <?=$member->first_name." ".$member->last_name?>
                    </td>
                    <td>
                        <?=(date('Y') - date('Y', $member->date_of_birth))?>
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
                        <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow" data-toggle="tooltip" data-placement="top" title="<?=translate('unblock')?>" onclick="return confirm_unblock(<?=$member->member_id?>)">
                            <span id="unblock_<?=$member->member_id?>"><i class="fa fa-check"></i></span>
                        </button>
                    </td>
                </tr>
            <?php } endforeach;
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
