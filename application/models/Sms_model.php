 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_model extends CI_Model {
    /*  
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */
     
    function __construct()
    {
        parent::__construct();
    }

    // SEND SMS VIA TWILIO API
    function send_sms_via_twilio($message = '' , $reciever_phone = '') {

        // LOAD TWILIO LIBRARY
        require_once(APPPATH . 'libraries/twilio_library/Twilio.php');

        $account_sid    = $this->db->get_where('third_party_settings', array('type' => 'twilio_account_sid'))->row()->value;
        $auth_token     = $this->db->get_where('third_party_settings', array('type' => 'twilio_auth_token'))->row()->value;
        $client         = new Services_Twilio($account_sid, $auth_token);

        $client->account->messages->create(array(
            'To'        => $reciever_phone,
            'From'      => $this->db->get_where('third_party_settings', array('type' => 'twilio_sender_phone_number'))->row()->value,
            'Body'      => $message
        ));
    }

    //SMS via msg91
    function send_sms_via_msg91($message = '' , $reciever_phone = '') {
        $authKey       = $this->db->get_where('third_party_settings', array('type' => 'msg91_authentication_key'))->row()->value;
        $senderId      = $this->db->get_where('third_party_settings', array('type' => 'msg91_sender_ID'))->row()->value;
        $country_code  = $this->db->get_where('third_party_settings', array('type' => 'msg91_country_code'))->row()->value;
        $route         = $this->db->get_where('third_party_settings', array('type' => 'msg91_route'))->row()->value;
        $type         = $this->db->get_where('third_party_settings', array('type' => 'msg91_type'))->row()->value;

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $reciever_phone;

        //Your message to send, Add URL encoding here.
        $message = urlencode($message);

        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route,
            'country' => $country_code
        );
        
        // Testing API URL
        if($type=='original'){
            //Live API URL
            $url="http://api.msg91.com/api/sendhttp.php";
        }else{
            // Testing API URL
            $url="https://control.msg91.com/api/sendhttp.php";
        }
        

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);
    }
}