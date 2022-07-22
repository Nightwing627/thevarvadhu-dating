<table class="table table-sm table-striped table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>
                <?php echo translate('date')?>
            </th>
            <th>
                <?php echo translate('payment_type')?>
            </th>
            <th>
                <?php echo translate('amount')?>
            </th>
            <th>
                <?php echo translate('package')?>
            </th>
            <th>
                <?php echo translate('status')?>
            </th>
            <th width="100">
            </th>
        </tr>
        </thead>
        <tbody>
            <?php $i=$page; ?>
            <?php foreach ($payments_info as $payment_info): ?>
                <tr>
                    <td>
                        <?=$i+1?>
                    </td>
                    <td>
                        <?=date('d/m/Y H:i A', $payment_info->purchase_datetime)?>
                    </td>
                    <td align="center">
                        <?php if ($payment_info->payment_type == "Paypal"): ?>
                            <span class="badge badge-md badge-pill bg-primary"><?php echo translate('paypal')?></span>
                        <?php endif ?>
                        <?php if ($payment_info->payment_type == "Stripe"): ?>
                            <span class="badge badge-md badge-pill bg-info"><?php echo translate('stripe')?></span>
                        <?php endif ?>
                        <?php if ($payment_info->payment_type == "payUMoney"): ?>
                            <span class="badge badge-md badge-pill bg-success"><?php echo translate('payUMoney')?></span>
                        <?php endif ?>
                        <?php if ($payment_info->payment_type == "Instamojo"): ?>
                            <span class="badge badge-md badge-pill bg-danger"><?php echo translate('Instamojo')?></span>
                        <?php endif ?>
                        <?php if ($payment_info->payment_type == "custom_payment_method_1" || $payment_info->payment_type == "custom_payment_method_2" || $payment_info->payment_type == "custom_payment_method_3" || $payment_info->payment_type == "custom_payment_method_4" ): ?>
                            <span class="badge badge-md badge-pill bg-warning"><?php echo $payment_info->custom_payment_method_name; ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?=currency($payment_info->amount)?>
                    </td>
                    <td>
                        <?=$this->Crud_model->get_type_name_by_id('plan', $payment_info->plan_id)?>
                    </td>
                    <td>
                        <?php if ($payment_info->payment_status == "paid"): ?>
                            <span class="badge badge-md badge-pill bg-success badge_payment"><?php echo translate('paid')?></span>
                        <?php endif ?>
                        <?php if ($payment_info->payment_status == "due"): ?>
                            <span class="badge badge-md badge-pill bg-danger badge_payment"><?php echo translate('due')?></span>
                        <?php endif ?>
                    </td>
                    <td align="right">
                        <?php
                        if ($payment_info->payment_status == "paid") {
                        ?>
                        <a href="<?=base_url()?>home/invoice/<?=$payment_info->package_payment_id?>" target="_blank" class="btn btn-info btn-sm btn-icon-only btn-shadow" data-toggle="tooltip" data-placement="top" title="<?=translate('view_invoice')?>">
                            <span id=""><i class="fa fa-file"></i></span>
                        </a>
                        <?php
                        }
                        ?>
                        <!-- <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow" data-toggle="tooltip" data-placement="top" title="<?=translate('view_details')?>" onclick="return view_payment_detail(<?=$payment_info->package_payment_id?>)">
                            <span id=""><i class="fa fa-eye"></i></span>
                        </button> -->
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach ?>
        </tbody>
    </table>


    <div id="pseudo_pagination" style="display: none;">
    <?= $this->ajax_pagination->create_links();?>
</div>
<script type="text/javascript">
    $('#pagination').html($('#pseudo_pagination').html());
</script>
