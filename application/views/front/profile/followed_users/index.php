<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('followed_users')?></b></h3>
</div>
<div class="card-body">
    <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
            <div class="col-md-12">
                <p class="c-base-1 pt-4 text-center">"<?php echo translate('your_account_is_closed!_please_re-open_the_account_to_see_your_followed_list!')?>"
                </p>
                <div class="text-center pt-2 pb-4">
                    <a onclick="profile_load('reopen_account')" href="#" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom"><?php echo translate('re-open_account')?></a>
                </div>
            </div>
        <?php }else{?>
        <div id="result">
            <!-- Loads List Data with Ajax Pagination -->
        </div>
        <div id="pagination" class="pt-2" style="float: right;">
            <!-- Loads Ajax Pagination Links -->
        </div>
    <?php } ?>
</div>

<script>
    $('button').tooltip();

    var rem_interests = parseInt("<?=$this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'express_interest')?>");
    function confirm_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?=translate('please_login')?>");
            $("#modal_body").html("<p class='text-center'><?=translate('please_login_to_express_your_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?=translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?=translate('login')?></a>");
        }
        else {
            if (rem_interests <= 0) {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('buy_premium_packages')?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ')?>"+rem_interests+" <?php echo translate('times')?></b><br><?php echo translate('you_have_no_remaining_express_interests. Please_buy_any_package_from_the_premium_plans.')?></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/plans' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('premium_plans')?></a>");
            }
            else {
                $("#active_modal").modal("toggle");
                $("#modal_header").html("<?php echo translate('confirm_express_interest')?>");
                $("#modal_body").html("<p class='text-center'><b><?php echo translate('remaining_express_interest(s): ')?>"+rem_interests+" <?php echo translate('times')?></b><br><span style='color:#DC0330;font-size:11px'>**N.B. <?php echo translate('expressing_an_interest_will_cost_1_from_your_remaining_interests')?>**</span></p>");
                $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='#' id='confirm_interest' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_interest("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
            }
        }    
        return false;
    }

    function do_interest(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_express_your_interest_on_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_interest").removeAttr("onclick");
            $("#confirm_interest").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            $("#interest_a_"+id).removeAttr("onclick");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_interest/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#interest_a_"+id).attr("class", "btn btn-dark btn-sm btn-icon-only btn-shadow");
                        $("#interest_a_"+id).attr("title", "<?=translate('interest_expressed')?>");
                        $("#interest_a_"+id).attr("data-original-title", "<?=translate('interest_expressed')?>");
                        // $("#interest_a_"+id).tooltip();
                        $("#ajax_success_alert").show();
                        $(".ajax_success_alert").html("<?php echo translate('you_have_expressed_an_interest_on_this_member!')?>");
                        $('#ajax_danger_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#ajax_success_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }    
        return false;
    }

    function confirm_remove(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_unfollow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('confirm_unfollow')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_unfollow_this_member?')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='#' id='confirm_remove' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_unfollow("+id+")' style='width:25%'><?php echo translate('confirm')?></a>");
        }    
        return false;
    }

    function do_unfollow(id) {
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_unfollow_this_member')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#confirm_remove").removeAttr("onclick");
            $("#confirm_remove").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing')?>..");
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>home/add_unfollow/"+id,
                    cache: false,
                    success: function(response) {
                        $("#active_modal .close").click();
                        $("#member_"+id).hide();
                        $("#ajax_danger_alert").show();
                        $(".ajax_danger_alert").html("<?php echo translate('you_have_unfollowed_this_member!')?>");
                        $('#ajax_success_alert').fadeOut('fast');
                        setTimeout(function() {
                            $('#ajax_danger_alert').fadeOut('fast');
                        }, 5000); // <-- time in milliseconds
                    },
                    fail: function (error) {
                        alert(error);
                    }
                });
            }, 500); // <-- time in milliseconds
        }
    }
</script>           
</section>
<script>
    $(document).ready(function(){
        filter_my_interets('0');
    });

    function filter_my_interets(page){      
        var form = $('#filter_form');
        //var url = form.attr('action')+page+'/';
        var url = '<?php echo base_url(); ?>home/ajax_followed_list/'+page;
        var place = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: url, // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data 
            cache       : false,
            contentType : false,
            processData : false,
            beforeSend: function() {
                place.html("");
                place.html("<div class='text-center pt-5 pb-5' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i><p>Please Wait...</p></div>").fadeIn(); 
                // change submit button text
            },
            success: function(data) {
                setTimeout(function(){
                    place.html(data); // fade in response data
                }, 20);
                setTimeout(function(){
                    place.fadeIn(); // fade in response data
                }, 30);
            },
            error: function(e) {
                console.log(e)
            }
        });
        
    }
</script>
