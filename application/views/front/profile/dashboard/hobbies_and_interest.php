<?php 
    $hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'hobbies_and_interest');
    $hobbies_and_interest_data = json_decode($hobbies_and_interest, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_hobbies_and_interest">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('hobbies_and_interests')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_hobbies_and_interest" <?php if ($privacy_status_data[0]['hobbies_and_interest'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('hobbies_and_interest')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_hobbies_and_interest" <?php if ($privacy_status_data[0]['hobbies_and_interest'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('hobbies_and_interest')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('hobbies_and_interest')">
                <i class="ion-edit"></i>
                </button> 
            </div>
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

    <div id="edit_hobbies_and_interest" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('hobbies_and_interests')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('hobbies_and_interest')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('hobbies_and_interest')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_hobbies_and_interest" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="hobby" class="text-uppercase c-gray-light"><?php echo translate('hobby')?></label>
                        <input type="text" class="form-control no-resize" name="hobby" value="<?php echo $hobbies_and_interest_data[0]['hobby']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="interest" class="text-uppercase c-gray-light"><?php echo translate('interest')?></label>
                        <input type="text" class="form-control no-resize" name="interest" value="<?php echo $hobbies_and_interest_data[0]['interest']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="music" class="text-uppercase c-gray-light"><?php echo translate('music')?></label>
                        <input type="text" class="form-control no-resize" name="music" value="<?php echo $hobbies_and_interest_data[0]['music']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="books" class="text-uppercase c-gray-light"><?php echo translate('books')?></label>
                        <input type="text" class="form-control no-resize" name="books" value="<?php echo $hobbies_and_interest_data[0]['books']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="movie" class="text-uppercase c-gray-light"><?php echo translate('movie')?></label>
                        <input type="text" class="form-control no-resize" name="movie" value="<?php echo $hobbies_and_interest_data[0]['movie']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="tv_show" class="text-uppercase c-gray-light"><?php echo translate('TV_show')?></label>
                        <input type="text" class="form-control no-resize" name="tv_show" value="<?php echo $hobbies_and_interest_data[0]['tv_show']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="sports_show" class="text-uppercase c-gray-light"><?php echo translate('sports_show')?></label>
                        <input type="text" class="form-control no-resize" name="sports_show" value="<?php echo $hobbies_and_interest_data[0]['sports_show']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="fitness_activity" class="text-uppercase c-gray-light"><?php echo translate('fitness_activity')?></label>
                        <input type="text" class="form-control no-resize" name="fitness_activity" value="<?php echo $hobbies_and_interest_data[0]['fitness_activity']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="cuisine" class="text-uppercase c-gray-light"><?php echo translate('cuisine')?></label>
                        <input type="text" class="form-control no-resize" name="cuisine" value="<?php echo $hobbies_and_interest_data[0]['cuisine']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="dress_style" class="text-uppercase c-gray-light"><?php echo translate('dress_style')?></label>
                        <input type="text" class="form-control no-resize" name="dress_style" value="<?php echo $hobbies_and_interest_data[0]['dress_style']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>