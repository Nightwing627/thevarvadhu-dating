<section class="sct-color-1">
    <div class="container-fluid no-padding">
        <div class="row row-no-padding">
            <?php $slider_status = $this->db->get_where('frontend_settings', array('type' => 'slider_status'))->row()->value;
			$home_stories_status = $this->db->get_where('frontend_settings', array('type' => 'home_stories_status'))->row()->value;
            $home_members_status = $this->db->get_where('frontend_settings', array('type' => 'home_members_status'))->row()->value;
            $home_parallax_status = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_status'))->row()->value;
            $home_plans_status = $this->db->get_where('frontend_settings', array('type' => 'home_plans_status'))->row()->value;
            $home_contact_status = $this->db->get_where('frontend_settings', array('type' => 'home_contact_status'))->row()->value;
            $slider_position = $this->db->get_where('frontend_settings', array('type' => 'slider_position'))->row()->value;
            if($slider_status=='yes'){
                $home_search_style = $this->db->get_where('frontend_settings', array('type' => 'home_search_style'))->row()->value;
                if ($home_search_style == '2') {
                    if($slider_position=='left'){
                        include_once 'slider_2.php';
                        include_once 'search.php';
                    } elseif($slider_position=='right'){
                        include_once 'search.php';
                        include_once 'slider_2.php';
                    }
                } elseif ($home_search_style == '1') {
                    include_once 'slider.php';
                }
            }
            ?>
        </div>
    </div>
</section>
<?php
	if($home_stories_status=='yes'){
        include_once'happy_stories.php';
    }
    if($home_members_status=='yes'){
        include_once'premium_members.php';
    }
    if($home_parallax_status=='yes'){
        include_once'parallax.php';
    }
    if($home_plans_status=='yes'){
        include_once'packages.php';
    }
    if($home_contact_status=='yes'){
        include_once'contact.php';
    }
?>
<script src="<?php echo base_url('template/front/js/jquery.inputmask.bundle.min.js')?>"></script>
<script>
    $(document).ready(function(){
        $(".height_mask").inputmask({
            mask: "9.99",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#aged_from").change(function(){
            var from = parseInt($("#aged_from").val());
            var to = parseInt($("#aged_to").val());
            if (to < from) {
                var to = $("#aged_to").val(from);
            }
        });
        $("#aged_to").change(function(){
            var from = parseInt($("#aged_from").val());
            var to = parseInt($("#aged_to").val());
            if (to < from) {
                var to = $("#aged_to").val(from);
            }
        });
    });

     $(".s_religion").change(function(){
        var religion_id = $(".s_religion").val();
        if (religion_id == "") {
            $(".s_caste").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".s_caste").html(data);
                    $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });

    $(".s_caste").change(function(){
        var caste_id = $(".s_caste").val();
        if (caste_id == "") {
            $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?php echo base_url()?>home/get_dropdown_by_id_sub_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function (data) {
                    if(data == false ){
                        $(".s_sub_caste").html("<option value=''><?php echo translate('none')?></option>");
                    } else {
                        $(".s_sub_caste").html(data);
                    };
               },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>
