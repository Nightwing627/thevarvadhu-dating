<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('how_to')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('knowledge_base')?></a></li>
			<li class="active"><a href="#"><?php echo translate('how_to')?></a></li>
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
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('how_to')?></h3>
			</div>
			<div class="panel-body">
		        <div class="panel-group accordion" id="demo-acc-dark-outline">
		            <div class="panel panel-bordered panel-dark">
		
		                <!--Accordion title-->
		                <div class="panel-heading">
		                    <h4 class="panel-title">
		                        <a data-parent="#demo-acc-dark-outline" data-toggle="collapse" href="#demo-acd-dark-outline-1">Collapsible Group Item #1</a>
		                    </h4>
		                </div>
		
		                <!--Accordion content-->
		                <div class="panel-collapse collapse in" id="demo-acd-dark-outline-1">
		                    <div class="panel-body">
		                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
		                    </div>
		                </div>
		            </div>
		            <div class="panel panel-bordered panel-dark">
		
		                <!--Accordion title-->
		                <div class="panel-heading">
		                    <h4 class="panel-title">
		                        <a data-parent="#demo-acc-dark-outline" data-toggle="collapse" href="#demo-acd-dark-outline-2">Collapsible Group Item #2</a>
		                    </h4>
		                </div>
		
		                <!--Accordion content-->
		                <div class="panel-collapse collapse" id="demo-acd-dark-outline-2">
		                    <div class="panel-body">
		                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
		                    </div>
		                </div>
		            </div>
		            <div class="panel panel-bordered panel-dark">
		
		                <!--Accordion title-->
		                <div class="panel-heading">
		                    <h4 class="panel-title">
		                        <a data-parent="#demo-acc-dark-outline" data-toggle="collapse" href="#demo-acd-dark-outline-3">Collapsible Group Item #3</a>
		                    </h4>
		                </div>
		
		                <!--Accordion content-->
		                <div class="panel-collapse collapse" id="demo-acd-dark-outline-3">
		                    <div class="panel-body">
		                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.
		                    </div>
		                </div>
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

