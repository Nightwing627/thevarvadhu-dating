<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('choose_theme_color')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('frontend_settings')?></a></li>
			<li class="active"><a href="#"><?php echo translate('choose_theme_color')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!-- Basic Data Tables -->
		<!--===================================================-->
		<div class="panel">
			<div class="alert alert-success" id="success_alert" style="display: none; position: fixed; top: 7%; right: 1%; width: 15%; z-index: 10000">
                <!-- <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button> -->
                <?php echo translate('successfully_saved')?>
            </div>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('choose_color')?></h3>
			</div>
			<div class="panel-body">
				<?php
				    $theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value;
				    ?>
		        <div class="form-group">
		            <div class="row">
		                <?php
		                $colors = array(
		                    'default-color' => '#5E32E1',
		                    'pink' => '#E91E63',
		                    'purple' => '#9C27B0',
		                    'light-blue' => '#03A9F4',
		                    'green' => '#4CAF50',
							'orange' => '#FF7A19',
							'red' => '#e62e04',
							'black' => '#656161',
							'blue' => '#0053b6',
							'ightseagreen' => '#1BBC9C'
		                );
		                /*'dark' => '#40424F',
	                    'super-dark' => '#24142F'*/

		                foreach ($colors as $n => $color) {
		                    ?>
		                    <?php
		                    echo form_open(base_url() . 'admin/', array(
		                        'class' => 'form-horizontal',
		                        'method' => 'post',
		                        'id' => '',
		                        'enctype' => 'multipart/form-data'
		                    ));
		                    ?>
		                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 tc_wrp_ech" style="padding:30px;">
		                        <div class="" style="border:0px; width:100%; margin: 0px ; margin-bottom:10px;">
		                            <input id="theme_color_<?php echo $n; ?>" type="hidden" value="<?php echo $n; ?>" name="theme_color" >
		                            <label <?php if ($theme_color == $n) { ?> class="selected" <?php } ?> for="theme_color_<?php echo $n; ?>" style="margin-bottom:0px;  height:100px; width:100%; background-size:cover; background-position:center; background-repeat:no-repeat; background-image:url(<?php echo base_url();?>uploads/themes/theme-<?php echo $n; ?>.jpg);">
		                            </label>
		                        </div>
		                        <div class="row">
		                            <div class="col-md-6">
		                                <span class="btn btn-xs btn-info btn-labeled fa fa-desktop btn-block" data-target='#preview_modal' data-toggle='modal'onclick="preview('<?php echo $n;?>')">
		                                          <?php echo translate('preview'); ?>
		                                </span>
		                            </div>
		                            <div class="col-md-6">
		                                <span class="btn btn-xs btn-success btn-labeled fa fa-check submitter btn-block <?php
		                                if ($theme_color == $n) {
		                                    echo 'disabled';
		                                }
		                                ?>">
		                                          <?php
		                                          if ($theme_color == $n) {
		                                              echo translate('selected');
		                                          } else {
		                                              echo translate('select');
		                                          }
		                                          ?>
		                                </span>
		                            </div>
		                        </div>
		                    </div>
		                    </form>
		                    <?php
		                }
		                ?>
		            </div>
		        </div>
		    </div>
		</div>
		<!--===================================================-->
		<!-- End Striped Table -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<div class="modal fade" id="preview_modal" role="dialog" tabindex="-1" aria-labelledby="preview_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg" style="margin-left: -25%;margin-top: 4%;">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('preview_theme_color')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>
<script>
	function preview(theme_name){
		$('.modal-body').html("<img src='<?=base_url()?>uploads/themes/preview-"+theme_name+".jpg' alt='' style ='width: 100%'>");
	}
</script>
<script>
    $('.submitter').on('click',function(){
        var now = this;
        var disabled = $(this).hasClass('disabled');
        if (!disabled) {
        	$('.submitter').each(function(){
	            $(this).html('<?php echo translate('select'); ?>');
	            $(this).removeClass('disabled');
	            $(this).closest('.tc_wrp_ech').find('label').removeClass('selected');
	        });
	        setTimeout(function(){
	            $(now).closest('.tc_wrp_ech').find('label').addClass('selected');
	            $(now).html('<?php echo translate('selected'); ?>');
	            $(now).addClass('disabled');
	        }, 500);

	        // alert($(this).closest('.tc_wrp_ech').find('input').val());
	        var theme_color = $(this).closest('.tc_wrp_ech').find('input').val();
	        $.ajax({
			    url: "<?=base_url()?>admin/theme_color_settings/update",
			    type: 'POST',
			    data: {theme_color : theme_color},
			    beforeSend: function() {
					$(now).html("<?=translate('selecting..')?>"); // change submit button text
				},
			    success: function() {
					$(now).fadeIn();
					$(now).html("<?=translate('select')?>");
					$('#success_alert').fadeIn('fast');
					setTimeout(function() {
					    $('#success_alert').fadeOut('fast');
					}, 5000); // <-- time in milliseconds
					// Notification
				},
				fail: function (error) {
				    alert(error);
				}
			});
        }
    });
</script>
<style>
    .selected{
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
    }
    .modal-body {
        height:100vh;
        overflow-y: scroll;
    }
</style>
