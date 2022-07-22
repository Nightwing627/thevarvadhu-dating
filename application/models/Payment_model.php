<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model {
	/*	
	 *	Developed by: Active IT zone
	 *	Date	: 18 September, 2017
	 *	Active Matrimony CMS
	 *	http://codecanyon.net/user/activeitezone
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	function paypal_package_payment($step='',$cost='',$user='',$package='',$product=''){
        $this->load->library('paypal');
		if($step == 'initiate'){
			$paypal_email  			= $this->db->get_where('business_settings',array('type'=>'paypal_email'))->row()->value;
			$data['user']      		= $user;
			$data['package']      	= $package;
			$data['info']  	    	= $product;
			$data['amount']         = $cost;
			$data['status']         = 'due';
			$data['method']         = 'paypal';
			$data['cause']         	= 'product_package';
			$data['timestamp']      = time();

			$this->db->insert('payments', $data);
			$payments_id           = $this->db->insert_id();
			$this->session->set_userdata('payments_id', $payments_id);
			
			$cost  = $cost/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;
			/****TRANSFERRING USER TO PAYPAL TERMINAL****/
			$this->paypal->add_field('rm', 2);
			$this->paypal->add_field('no_note', 0);
			$this->paypal->add_field('cmd', '_xclick');

			$this->paypal->add_field('amount', $cost);
			$this->paypal->add_field('custom', $payments_id);
			$this->paypal->add_field('business', $paypal_email);
			$this->paypal->add_field('notify_url', base_url() . 'home/paypal_responses/notify');
			$this->paypal->add_field('cancel_return', base_url() . 'home/paypal_responses/cancel');
			$this->paypal->add_field('return', base_url() . 'home/paypal_responses/success');
			
			$this->paypal->submit_paypal_post();			
		} elseif($step == 'notify'){
			if ($this->paypal->validate_ipn() == true) {				
				$data['status']             = 'paid';
				$data['details']    		= json_encode($_POST);
				$payments_id                = $_POST['custom'];
				$this->db->where('payments_id', $payments_id);
				$this->db->update('payments', $data);
				$product_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->info;
				$package_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->package;
				$this->Crud_model->set_product_package($product_id,$package_id);
			}			
		} elseif($step == 'cancel'){
			$payments_id = $this->session->userdata('payments_id');
			$this->db->where('payments_id', $payments_id);
			$this->db->delete('payments');
			$this->session->set_userdata('payments_id', '');
			$this->session->set_flashdata('alert', 'payment_cancel');
			redirect(base_url() . 'home/profile/', 'refresh');
		} elseif($step == 'success'){
			$this->session->set_userdata('payments_id', '');
			redirect(base_url() . 'home/profile/', 'refresh');
		}
	}
	
	function stripe_package_payment($amount='',$user='',$package='',$product=''){
		if($this->input->post('stripeToken')) {
			$amount_in_usd  = $amount/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;
			
			$stripe_publishable      = $this->db->get_where('business_settings', array(
				'type' => 'stripe_publishable'
			))->row()->value;
			$stripe_api_key      = $this->db->get_where('business_settings', array(
				'type' => 'stripe_secret'
			))->row()->value;
			

			require_once(APPPATH . 'libraries/stripe-php/init.php');
			\Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
			
			$customer_email = $this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->email;
			
			$customer = \Stripe\Customer::create(array(
				'email' => $customer_email, // customer email id
				'card'  => $_POST['stripeToken']
			));

			$charge = \Stripe\Charge::create(array(
				'customer'  => $customer->id,
				'amount'    => ceil($amount_in_usd*100),
				'currency'  => 'USD'
			));

			if($charge->paid == true){	
				$data['user']      		= $user;
				$data['package']      	= $package;
				$data['info']  	    	= $product;
				$data['amount']         = $amount;
				$data['status']         = 'paid';
				$data['method']         = 'stripe';
				$data['cause']         	= 'product_package';
				$data['timestamp']      = time();
				$data['details']    	= json_encode($_POST);
	
				$this->db->insert('payments', $data);
				$payments_id            = $this->db->insert_id();
				
				$product_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->info;
				$package_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->package;
				$this->Crud_model->set_product_package($product_id,$package_id);
				return 'success';
			} else {
				return 'fail';
			}
			
		} else{
			return 'fail';
		}	
		
	}
	
	function paypal_package_payment_user($step='',$cost='',$user='',$package=''){
        $this->load->library('paypal');
		if($step == 'initiate'){
			$paypal_email  			= $this->db->get_where('business_settings',array('type'=>'paypal_email'))->row()->value;
			$data['user_id']      		= $user;
			$data['user_package_id']      	= $package;
			$data['package_price']         = $cost;
			$data['payment_status']         = 'due';
			$data['payment_method']         = 'paypal';
			$data['timestamp']      = time();

			$this->db->insert('user_payment', $data);
			$payments_id           = $this->db->insert_id();
			$this->session->set_userdata('payments_id', $payments_id);
			
			$cost  = $cost/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;
			/****TRANSFERRING USER TO PAYPAL TERMINAL****/
			$this->paypal->add_field('rm', 2);
			$this->paypal->add_field('no_note', 0);
			$this->paypal->add_field('cmd', '_xclick');

			$this->paypal->add_field('item_name', 'Package Upgrade');
			$this->paypal->add_field('amount', $cost);
			$this->paypal->add_field('custom', $payments_id);
			$this->paypal->add_field('business', $paypal_email);
			$this->paypal->add_field('notify_url', base_url() . 'home/paypal_responses_user/notify');
			$this->paypal->add_field('cancel_return', base_url() . 'home/paypal_responses_user/cancel');
			$this->paypal->add_field('return', base_url() . 'home/paypal_responses_user/success');
			
			$this->paypal->submit_paypal_post();			
		} elseif($step == 'notify'){
			if ($this->paypal->validate_ipn() == true) {			
				$data['payment_status']             = 'paid';
				$payments_id                = $_POST['custom'];
				$this->db->where('user_payment_id', $payments_id);
				$this->db->update('user_payment', $data);
				$user_id = $this->db->get_where('user_payment',array('user_payment_id'=>$payments_id))->row()->user_id;
				$package_id = $this->db->get_where('user_payment',array('user_payment_id'=>$payments_id))->row()->user_package_id;
				//$this->Crud_model->set_user_package($user_id,$package_id);
				$data1['user_package'] 			= $package_id;
				$this->db->where('user_id',$user_id);
				$this->db->update('user', $data1);
			}			
		} elseif($step == 'cancel'){
			$payments_id = $this->session->userdata('payments_id');
			$this->db->where('user_payment_id', $payments_id);
			$this->db->delete('user_payment');
			$this->session->set_userdata('user_payment_id', '');
			$this->session->set_flashdata('alert', 'payment_cancel');
			redirect(base_url() . 'home/profile/', 'refresh');
		} elseif($step == 'success'){
			$this->session->set_userdata('payments_id', '');
			redirect(base_url() . 'home/profile/', 'refresh');
		}
	}
	
	function stripe_package_payment_user($cost='',$user='',$package=''){
		if($this->input->post('stripeToken')) {
			$amount_in_usd  = $cost/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;
			
			$stripe_publishable      = $this->db->get_where('business_settings', array(
				'type' => 'stripe_publishable'
			))->row()->value;
			$stripe_api_key      = $this->db->get_where('business_settings', array(
				'type' => 'stripe_secret'
			))->row()->value;

			require_once(APPPATH . 'libraries/stripe-php/init.php');
			\Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
			
			$customer_email = $this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->email;
			
			$customer = \Stripe\Customer::create(array(
				'email' => $customer_email, // customer email id
				'card'  => $_POST['stripeToken']
			));

			$charge = \Stripe\Charge::create(array(
				'customer'  => $customer->id,
				'amount'    => ceil($amount_in_usd*100),
				'currency'  => 'USD'
			));

			if($charge->paid == true){	
				$data['user']      		= $user;
				$data['package']      	= $package;
				$data['amount']         = $cost;
				$data['status']         = 'paid';
				$data['method']         = 'stripe';
				$data['cause']         	= 'product_package';
				$data['timestamp']      = time();
				$data['details']    	= json_encode($_POST);
	
				$this->db->insert('payments', $data);
				$payments_id            = $this->db->insert_id();
				
				$user_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->user;
				$package_id = $this->db->get_where('payments',array('payments_id'=>$payments_id))->row()->package;
				$this->Crud_model->set_user_package($user_id,$package_id);
				return 'success';
			} else {
				return 'fail';
			}
			
		} else{
			return 'fail';
		}	
		
	}
}








