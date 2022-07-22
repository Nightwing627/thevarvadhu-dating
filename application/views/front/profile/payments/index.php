<div class="card-title">
    <h3 class="heading heading-6 strong-500">
        <b><?php echo translate('payment_informations')?></b>
    </h3>
</div>
<!-- date('m/d/Y H:i:s', 1299446702); -->
<div class="card-body" style="border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
    <div id="result">
        <!-- Loads List Data with Ajax Pagination -->
    </div>
    <div id="pagination" class="pt-2" style="float: right;">
        <!-- Loads Ajax Pagination Links -->
    </div>
</div>

<script>
    $('button').tooltip();
    $('a').tooltip();
    
    function view_payment_detail(id) {
        // alert(id);
        if (isloggedin == "") {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('please_log_in')?>");
            $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_view_the_payment_details')?></p>");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button> <a href='<?=base_url()?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in')?></a>");
        }
        else {
            $("#active_modal").modal("toggle");
            $("#modal_header").html("<?php echo translate('payment_details')?>");
            //$("#modal_body").html("");
            $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close')?></button>");
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>home/view_payment_detail/"+id,
                cache: false,
                success: function(response) {
                    $("#modal_body").html(response);
                },
                fail: function (error) {
                    alert(error);
                }
            });
        }    
        return false;
    }
</script>
<style>
    .modal-dialog.modal-md {
        max-width: 500px !important; 
        margin-top: 30vh;
    }
</style>           
</section>
<script>
    $(document).ready(function(){
        filter_my_interets('0');
    });

    function filter_my_interets(page){      
        var form = $('#filter_form');
        //var url = form.attr('action')+page+'/';
        var url = '<?php echo base_url(); ?>home/ajax_payment_list/'+page;
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