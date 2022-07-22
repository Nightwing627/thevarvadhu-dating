<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('stories')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('stories')?></a></li>
			<li class="active"><a href="#"><?php echo translate('story_details')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<!--Block Styled Form -->
		<!--===================================================-->
		<?php
			foreach ($get_story as $value) 
			{
		?>
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('story_details')?></h3>
			</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<div class="col-md-offset-1 col-md-10">
						<div class="text-center">
							<?php
								$member_type = $this->Crud_model->get_type_name_by_id('member', $value->posted_by, 'membership');
								if ($member_type==1) {
									$type= "free_members";
								}
								elseif ($member_type==2) {
									$type= "premium_members";
								}
							?>
							<span style="float: right;"><?php echo translate('posted_by')?> <a href="<?=base_url()?>admin/members/<?=$type?>/view_member/<?=$value->posted_by?>"><?= $this->Crud_model->get_type_name_by_id('member', $value->posted_by, 'first_name')." ". $this->Crud_model->get_type_name_by_id('member', $value->posted_by, 'last_name');?></a></span>
							<h4 class="page-title"><?=$value->title?></h4>
						</div>
			            <!--Carousel-->
			            <!--===================================================-->
			            <?php 
			            	$images = json_decode($value->image, true);
			            ?>
			            <div id="happy_story_carousel" class="carousel slide" data-ride="carousel">
			                <!--Indicators-->
			                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			                <ol class="carousel-indicators out">
			                	<?php 
			                		$i = 0;
			                		foreach ($images as $image): ?>
			                			<li data-slide-to="<?=$i?>" data-target="#happy_story_carousel" class="<?php if($i==0){echo 'active';}?>"></li>
			                		<?php
			                		$i++; 
			                		endforeach;
			                	?>
			                </ol>
			                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			                <div class="carousel-inner text-center">
			                	<?php
			                		$j = 0; 
			                		foreach ($images as $image): ?>
				                		<div class="item <?php if($j==0){echo 'active';}?>">
					                    	<div class="happy_story_carousel" style="background-image: url(<?=base_url()?>uploads/happy_story_image/<?=$image['img']?>)"></div>
					                    </div>
			                		<?php
			                		$j++; 
			                		endforeach;
			                	?>
			                </div>
			                <!--carousel-control-->
			                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			                <a class="carousel-control left" data-slide="prev" href="#happy_story_carousel"><i class="demo-pli-arrow-left icon-2x"></i></a>
			                <a class="carousel-control right" data-slide="next" href="#happy_story_carousel"><i class="demo-pli-arrow-right icon-2x"></i></a>
			                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			            </div>
			            <!--===================================================-->
			            <!--End Carousel-->
			            <p><b><?php echo translate('post_time:')?></b> <?=date('d/m/Y H:i:s A', strtotime($value->post_time))?></p>
			            <p><?=$value->description?></p>
			            <?php
					        $video_exist = $this->db->get_where("story_video",array("story_video_uploader_id" => $value->posted_by))->result();
					        if ($video_exist) {
					            $get_video = $this->db->get_where("story_video", array("story_video_uploader_id" => $value->posted_by))->result_array();
					            foreach ($get_video as $video) {?>
					                <div class="post-media text-center" style="padding-top: 10px;">
					                    <?php if($video['type'] == 'upload'){?>
					                        <video controls height="450" width="80%">
					                            <source src="<?php echo base_url();?><?php echo $video['video_src'];?>">
					                        </video>
					                    <?php }else{?>
					                        <iframe controls="2" height="450" width="80%" 
					                            src="<?php echo $video['video_src'];?>" frameborder="0" >
					                        </iframe>
					                    <?php }?>
					                </div>
					            <?php
					            }
					        }
					    ?>
			        </div>
			    </div>
			</div>
			<div class="panel-footer text-center">
				<?php
				if ($value->approval_status == 0) {
				?>
				<button class="btn btn-success btn-sm btn-labeled fa fa-check" type="button" data-target='#approval_modal' data-toggle='modal' onclick="approval(<?=$value->approval_status?>, <?=$value->happy_story_id?>)"><?php echo translate('approve')?></button>
				<?php
				}
				else {
				?>
				<button class="btn btn-dark btn-sm btn-labeled fa fa-close" type="button" data-target='#approval_modal' data-toggle='modal' onclick="approval(<?=$value->approval_status?>, <?=$value->happy_story_id?>)"><?php echo translate('unpublish')?></button>
				<?php
				}
				?>
				<a href="<?=base_url()?>admin/stories" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward" type="submit"><?php echo translate('go_back')?></a>
			</div>
		</div>
		<?php
			}
		?>
		<!--===================================================-->
		<!--End Block Styled Form -->
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="approval_modal" role="dialog" tabindex="-1" aria-labelledby="approval_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_your_action')?></h4>
            </div>
           	<!--Modal body-->
            <div class="modal-body">
            	<p><?php echo translate('are_you_sure_you_want_to')?> "<b id="type_name"></b>" <?php echo translate('this_story?')?>?</p>
            	<div class="text-right">
            		<input type="hidden" id="story_id" name="story_id" value="">
            		<button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                	<button class="btn btn-primary btn-sm" id="approval_status" value=""><?php echo translate('confirm')?></button>
            	</div>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<script>
	function approval(status,story_id){
	    $("#approval_status").val(status);
	    if (status == 1) {
	    	$("#type_name").html("<?php echo translate('unpublish')?>");
	    }
	    if (status == 0) {
			$("#type_name").html("<?php echo translate('approve')?>");
	    }
	    $("#story_id").val(story_id);
	}

	$("#approval_status").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/stories/approval/"+$("#approval_status").val()+"/"+$("#story_id").val(),
		    success: function(response) {
		    	// alert(response);
				window.location.href = "<?=base_url()?>admin/stories";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })

    function delete_story(id){
	    $("#delete_story").val(id);
	}

	$("#delete_story").click(function(){
    	$.ajax({
		    url: "<?=base_url()?>admin/stories/delete/"+$("#delete_story").val(),
		    success: function(response) {
				window.location.href = "<?=base_url()?>admin/stories";
		    },
			fail: function (error) {
			    alert(error);
			}
		});
    })
</script>