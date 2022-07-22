<?php 
    /*
    $hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'hobbies_and_interest');
    $hobbies_and_interest_data = json_decode($hobbies_and_interest, true);
    */
?>
<div id="info_hobbies_and_interest">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('hobbies_&_interest')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                <tbody>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('hobby')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['hobby']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('interest')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['interest']?>
                        </td>
                    </tr>
                    <tr>
                         <td class="td-label">
                            <span><?php echo translate('music')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['music']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('books')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['books']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('movie')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['movie']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('TV_show')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['tv_show']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('sports_show')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['sports_show']?>
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('fitness_activity')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['fitness_activity']?>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">
                            <span><?php echo translate('cuisine')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['cuisine']?> 
                        </td>
                        <td class="td-label">
                            <span><?php echo translate('dress_style')?></span>
                        </td>
                        <td>
                            <?php echo $hobbies_and_interest_data[0]['dress_style']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>