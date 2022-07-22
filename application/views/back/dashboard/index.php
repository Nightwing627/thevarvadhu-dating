<style>
</style>
<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?=translate('dashboard')?></h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<h5 class="text-overflow"><?=translate('earnings')?></h5>
		<dvi class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<h5 class="text-overflow"><?=translate('member_informations')?></h5>
						<div class="row">
							<div class="col-md-3 col-lg-3">
								<div class="panel">
									<div class="panel-body text-center clearfix">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-users fa-3x text-purple"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$total_members?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('total_members')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="panel">
									<div class="panel-body text-center clearfix">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-trophy fa-3x text-warning"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$total_premium_members?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('premium_members')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="panel">
									<div class="panel-body text-center clearfix">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-user-circle-o fa-3x text-mint"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$total_free_members?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('free_members')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="panel">
									<div class="panel-body text-center clearfix">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-user-times fa-3x text-danger"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$total_blocked_members?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('blocked_members')?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5 class="text-overflow"><?=translate('earnings')?></h5>
						<div class="row">
							<div class="col-md-5ths">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-briefcase fa-3x text-primary"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=currency('', 'def'). $total_earnings?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('total_earnings')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5ths">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-usd fa-3x text-warning"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=currency('', 'def'). $last_month_earnings?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('last_month')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5ths">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-money fa-3x text-info"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=currency('', 'def'). $last_3_months_earnings?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('last_3_months')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5ths">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-money fa-3x text-mint"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=currency('', 'def'). $half_yearly_earnings?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('half_yearly')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5ths">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-money fa-3x text-success"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=currency('', 'def'). $yearly_earnings?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('yearly')?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5 class="text-overflow"><?=translate('stories_informations')?></h5>
						<div class="row">
							<div class="col-md-4 col-lg-4">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-venus-mars fa-3x text-pink"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$total_stories?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('total_stories')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-lg-4">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-check-circle fa-3x text-success"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$approved_stories?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('approved_stories')?>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-lg-4">
								<div class="panel">
									<div class="panel-body text-center clearfix" style="padding: 12px 0">
										<div class="col-sm-12 pad-top">
											<div class="text-lg">
												<!-- <img src="<?=base_url()?>uploads/dashboard_icons/icon-md.png" style="width: 64px"> -->
												<i class="fa fa-question-circle fa-3x text-danger"></i>
											</div>
											<div class="text-lg">
												<p class="text-2x text-thin text-main">
													<?=$pending_stories?>
												</p>
											</div>
											<p class="text-sm text-bold text-uppercase">
												<?=translate('pending_stories')?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5 class="text-overflow"><?=translate('informatives')?></h5>
						<div class="row">
							<div class="col-md-3">
						        <a href="<?=base_url()?>admin/frontend_appearances/pages">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-dark">
							                <i class="psi-monitor-3 icon-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('frontend_pages_settings')?></p>
							            </div>
							        </div>
						       	</a>
						    </div>
						    <div class="col-md-3">
						       	<a href="<?=base_url()?>admin/payments">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-primary">
							                <i class="fa fa-credit-card-alt fa-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('payments_settings')?></p>
							            </div>
							        </div>
						       	</a>
						    </div>
						    <div class="col-md-3">
						       	<a href="<?=base_url()?>admin/social_media_comments">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-info">
							                <i class="fa fa-comments-o fa-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('social_comments_settings')?></p>
							            </div>
							        </div>
						       	</a>
					       	</div>
					       	<div class="col-md-3">
							    <a href="https://activeitzone.com/product/active-matrimonial-cms/knowledge-base/diagramic-analytics" target="_blank">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-danger">
							                <i class="fa fa-file fa-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('diagram')?></p>
							            </div>
							        </div>
							    </a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
							    <a href="https://activeitzone.com/product/active-matrimonial-cms/knowledge-base/how-to" target="_blank">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-warning">
							                <i class="fa fa-question-circle fa-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('how_to')?></p>
							            </div>
							        </div>
							    </a>
							</div>
							<div class="col-md-3">
						       	<a href="https://activeitzone.com/product/active-matrimonial-cms/knowledge-base/structure-list" target="_blank">
							        <div class="panel media middle pad-all">
							            <div class="media-left">
							                <span class="icon-wrap icon-wrap-sm icon-circle bg-success">
							                <i class="psi-structure icon-2x"></i>
							                </span>
							            </div>
							            <div class="media-body">
							                <p class="text-lg text-semibold text-main"><?=translate('structural_info')?></p>
							            </div>
							        </div>
							    </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</dvi>
	</div>
	<!--===================================================-->
	<!--End page content-->
</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
