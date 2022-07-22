<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('my_interests')?></b></h3>
</div>

<div class="card-body">
    <?php if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){?>
            <div class="col-md-12">
                <p class="c-base-1 pt-4 text-center">"<?php echo translate('your_account_is_closed!_please_re-open_the_account_to_see_your_express_interests_list!')?>"
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
           
</section>
<script>
    $(document).ready(function(){
        filter_my_interets('0');
    });

    function filter_my_interets(page){      
        var form = $('#filter_form');
        //var url = form.attr('action')+page+'/';
        var url = '<?php echo base_url(); ?>home/ajax_my_interest_list/'+page;
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