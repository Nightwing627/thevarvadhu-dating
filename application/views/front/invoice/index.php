<style>
    /* Invoice CSS */
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    .container, table {
        font-size: 80% !important;
    }
    /* Invoice CSS */
</style>
<?php
foreach ($get_payment as $value) {
?>
    <div class="container">
        <div class="card z-depth-2-top mt-4 mb-4">
            <div class="card-body">
                <div class="print-div">
                    <div class="row">
                        <div class="col-sm-12">
                    		<div class="invoice-title">
                    			<h2><?=translate('invoice')?></h2><h3 class="pull-right"><?=translate('purchase_code_#')?><?=$value->payment_code?></h3>
                    		</div>
                    		<hr style="margin-top: 0px;">
                    		<div class="">
                                <div class="col-sm-12">
                                    <address>
                                        <strong><?=translate('purchase_date:')?></strong> <?=date('d/m/Y', $value->purchase_datetime)?><br><br>
                                    </address>
                                </div>
                    			<div class="col-sm-12">
                    				<address>
                    				<strong><?=translate('billed_to,')?></strong><br>
                    					<b><?=translate('name: ')?></b><?=$this->db->get_where('member', array('member_id' => $value->member_id))->row()->first_name.' '.$this->db->get_where('member', array('member_id' => $value->member_id))->row()->last_name?><br>
                    					<b><?=translate('address:')?></b><br>
                                        <?php
                                        $present_address = $this->db->get_where('member', array('member_id' => $value->member_id))->row()->present_address;
                                        $present_address_data = json_decode($present_address, true);
                                        if (!empty($present_address_data[0]['city'])) {
                                            $city = $this->db->get_where('city', array('city_id' => $present_address_data[0]['city']))->row()->name;
                                        }
                                        else {
                                            $city = '';
                                        }
                                        if (!empty($present_address_data[0]['state'])) {
                                           $state = $this->db->get_where('state', array('state_id' => $present_address_data[0]['state']))->row()->name;
                                        }
                                        else {
                                            $state = '';
                                        }
                                        if (!empty($present_address_data[0]['state'])) {
                                            $country = $this->db->get_where('country', array('country_id' => $present_address_data[0]['country']))->row()->name;
                                        }
                                        else {
                                            $country = '';
                                        }
                                        echo $city?><br>
                                        <?=$state?><br>
                                        <?=$country?><br>

                    				</address>
                    			</div>
                    		</div>
                    		<div class="">
                    			<div class="col-sm-6">
                    				<address>
                    					<strong><?=translate('Payment Method: ')?></strong><br>
                                        <?php
                                            if(in_array($value->payment_type,['custom_payment_method_1','custom_payment_method_2','custom_payment_method_3','custom_payment_method_4'])){
                                                echo $value->custom_payment_method_name;
                                            }else{
                                                echo $value->payment_type;
                                            }
                                        ?>
                    				</address>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                    		<div class="panel panel-default">
                    			<div class="panel-heading">
                    				<h3 class="panel-title"><strong><?=translate('purchase_summary')?></strong></h3>
                    			</div>
                    			<div class="panel-body">
                    				<div class="table-responsive">
                    					<table class="table table-condensed table-bordered">
                    						<thead>
                                                <tr>
                        							<td><strong><?=translate('item')?></strong></td>
                        							<td class="text-center"><strong><?=translate('price')?></strong></td>
                                                </tr>
                    						</thead>
                    						<tbody>
                    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                    							<tr>
                    								<td><?=translate('pachakge_type:').' '.$this->db->get_where('plan', array('plan_id' => $value->plan_id))->row()->name?></td>
                    								<td class="text-center"><?=currency($this->db->get_where('plan', array('plan_id' => $value->plan_id))->row()->amount)?></td>
                    							</tr>
                                                <tr>
                                                    <td class="thick-line text-right"><strong><?=translate('total')?></strong></td>
                                                    <td class="thick-line text-center"><?=currency($this->db->get_where('plan', array('plan_id' => $value->plan_id))->row()->amount)?></td>
                                                </tr>

                    						</tbody>
                    					</table>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center mt-5 mb-3">
                            <button type="button" class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom" style="width: 150px;" onclick="do_print('print-div')"><i class="fa fa-print"></i> <?=translate('print')?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    function do_print(div) {
        window.print();
    }
</script>
<style>
    @media print {
        .top-navbar, button {
            display: none !important;
        }
        header{
            display: none !important;
        }
        footer{
            display: none !important;
        }
    }
</style>
