<div class="mb-2 pl-3">
    <b><?php echo translate('Member ID').' - '?></b><b class="c-base-1"><?php echo $get_member[0]->member_profile_id; ?></b>
</div>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_introduction">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('introduction')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('introduction')">
                <i class="ion-edit"></i>
                </button>
            </div>
        </div>
        <div class="table-full-width">
            <div class="table-full-width">
                <table class="table table-profile table-responsive table-slick">
                    <tbody>
                        <tr>
                            <td class="">                                
                                <?php echo nl2br($get_member[0]->introduction); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_introduction" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('introduction')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow mb-1" onclick="save_section('introduction')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow mb-1" onclick="load_section('introduction')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_introduction" class="form-default" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <textarea name="introduction" class="form-control no-resize" rows="5"><?php echo $get_member[0]->introduction?></textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>