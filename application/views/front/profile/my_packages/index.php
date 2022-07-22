<div class="card-title">
    <h3 class="heading heading-6 strong-500">
    <b><?php echo translate('my_package')?></b></h3>
</div>
<div class="card-body">
    <section class="sct-color-1 pricing-plans pricing-plans--style-1">
        <div class="container">
            <span class="clearfix"></span>
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <?php
                            $package_info = $this->db->get_where('member', array('member_id' => $this->session->userdata('member_id')))->row()->package_info;
                            $package_info = json_decode($package_info, true);
                        ?>
                        <h2 class="plan-title text-uppercase strong-600"><?php echo translate('your_current_package')?></h2>
                        <div class="text-center">
                            <div class="px-2 py-2 text-left">
                                <table class="table table-condensed table-bordered">
                                    <tbody>
                                        <tr>
                                            <th><?php echo translate('title')?></th>
                                            <th><?php echo translate('info')?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('user_package')?></td>
                                            <td><?=$package_info[0]['current_package']?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('package_price')?></td>
                                            <td><?=currency($package_info[0]['package_price'])?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('package_gateway')?></td>
                                            <td><?=$package_info[0]['payment_type']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <h2 class="plan-title text-uppercase strong-600"><?php echo translate('remaining_package')?></h2>
                        <div class="text-left">
                            <div class="px-2 py-2">
                                <table class="table table-condensed table-bordered">
                                    <tbody>
                                        <tr>
                                            <th><?php echo translate('features')?></th>
                                            <th><?php echo translate('unit_left')?></th>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('remaining_interests')?></td>
                                            <td><?=$this->db->get_where('member', array('member_id' => $this->session->userdata('member_id')))->row()->express_interest;?> <?=translate('times')?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('remaining_messages')?></td>
                                            <td><?=$this->db->get_where('member', array('member_id' => $this->session->userdata('member_id')))->row()->direct_messages;?> <?=translate('times')?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('photo_gallery')?></td>
                                            <td><?=$this->db->get_where('member', array('member_id' => $this->session->userdata('member_id')))->row()->photo_gallery;?> <?=translate('images')?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="block">
                        <h2 class="plan-title text-uppercase strong-600 pt-2"><?php echo translate('buy_packages')?></h2>
                        <div class="text-center pt-2 pb-4">
                            <a href="<?=base_url()?>home/plans" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom" style="width: 50%"><?php echo translate('premium_plans')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>