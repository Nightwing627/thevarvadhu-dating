<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Email_model extends CI_Model {
        /*
        *  Developed by: Active IT zone
        *  Date    : 18 September, 2017
        *  Active Matrimony CMS
        *  http://codecanyon.net/user/activeitezone
        */

        function __construct() {
            parent::__construct();
        }

        function password_reset_email($account_type = '', $id = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {

                $sub = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'member') {
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                } else {
                    $to_name = $query->row()->name;
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->body;
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[password]]', $pass, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text" );
                return $send_mail;
            } else {
                return false;
            }
        }

        function status_email($account_type = '', $id = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'user') {
                    $to_name = $query->row()->firstname . ' ' . $query->row()->lastname;
                } else {
                    $to_name = $query->row()->name;
                }
                if ($query->row()->status == 'approved') {
                    $status = "Approved";
                } else {
                    $status = "Postponed";
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[email]]', $to, $email_body);
                $email_body = str_replace('[[status]]', $status, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body,$mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function member_staff_account_opening_by_admin($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {

                if ($account_type == 'member') {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                elseif ($account_type == 'admin') {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
                    $to_name = $query->row()->name;
                    $role_type = $this->Crud_model->get_type_name_by_id('role', $query->row()->role);
                    $url = base_url()."admin/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[role_type]]', $role_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function account_opening_member_approval_off($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 9))->row()->subject;
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 9))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function account_opening_member_approval_on($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {

                if ($account_type == 'member') {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 7))->row()->subject;
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 7))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function member_email_verification($account_type = '', $email = '', $email_verification = '')
        {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->subject;
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $email_verify = base_url()."home/email_verification/".$email_verification;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[email_verify]]', $email_verify, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        // member approval email to member
        function member_approval($account_type = '', $email = '')
        {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {

                if ($account_type == 'member') {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->subject;
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function staff_account_add($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
                if ($account_type == 'member') {
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function subscruption_email($account_type = '', $member_id = '', $plan_id = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $this->db->get_where('member', array('member_id' => $member_id))->row()->email;
            $package = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;
            $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
            $query = $this->db->get_where('member', array('email' => $to));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
                if ($account_type == 'member') {

                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[package]]', $package, $email_body);
                    $email_body = str_replace('[[amount]]', $amount, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        function newsletter($title = '', $text = '', $email = '', $from = '') {
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $this->do_email($from, $from_name, $email, $title, $text);
        }

        /* ***custom email sender*** */
        function profile_report($from = '', $from_name ='', $reported_person = '')
        {

            $this->load->database();
            $to = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            $sub = 'Profile report';
            $member_type = $this->db->get_where('member',array('member_id'=>$reported_person))->row()->membership;
            if($member_type == 1)
            {
                $type = 'free_members';
            }
            else
            {
                $type = 'premium_members';
            }
            $link = base_url()."admin".'/members/'.$type.'/view_member'.'/'.$reported_person;
            $email_body = $from_name.' '.'reported to this member'.' '.$link;
            $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text" );
            return $send_mail;

        }

        // MEMBER REGISTRATION EMAIL SEND TO ADMIN
        function member_registration_email_to_admin($member_id = '')
        {
            $this->load->database();

            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $member_data = $this->db->get_where('member', array('member_id' => $member_id));
            $to = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;

            if ($member_data->num_rows() > 0) {

                $member_name = $member_data->row()->first_name . ' ' . $member_data->row()->last_name;

                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
                if ($protocol == 'smtp') {
                    $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                    $from = $member_data->row()->email;
                }

                $sub = $this->db->get_where('email_template', array('email_template_id' => 8))->row()->subject;

                $email_body = $this->db->get_where('email_template', array('email_template_id' => 8))->row()->body;
                $email_body = str_replace('[[member_name]]', $member_name, $email_body);
                $email_body = str_replace('[[email]]', $member_data->row()->email, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);


                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            } else {
                return false;
            }
        }

        // Send Message
        function send_message($message_from, $message_to) {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where("member", array('member_id' => $message_to));

            if ($query->num_rows() > 0) {
                $to                  = $query->row()->email;
                $message_to_name     = $query->row()->first_name . ' ' . $query->row()->last_name;
                $message_from_name   = $this->Crud_model->get_type_name_by_id('member', $message_from, 'first_name').' '. $this->Crud_model->get_type_name_by_id('member', $message_from, 'last_name');

                $sub = "New Message";
                $email_body = "Hi ".$message_to_name.','."\r\n"."You have new message from ".$message_from_name."\r\n"."\r\n"."Thanks,"."\r\n".$from_name;

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            }
            else {
                return false;
            }
        }

        // Express Interest
        function express_interest($interest_from, $interest_to) {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where("member", array('member_id' => $interest_to));

            if ($query->num_rows() > 0) {
                $to                   = $query->row()->email;
                $interest_to_name     = $query->row()->first_name . ' ' . $query->row()->last_name;
                $interest_from_name   = $this->Crud_model->get_type_name_by_id('member', $interest_from, 'first_name').' '. $this->Crud_model->get_type_name_by_id('member', $interest_from, 'last_name');

                $sub = "New Interest";
                $email_body = "Hi ".$interest_to_name.','."\r\n".$interest_from_name." has expressed interest on you."."\r\n"."\r\n"."Thanks,"."\r\n".$from_name;

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body, $mailtype="text");
                return $send_mail;
            }
            else {
                return false;
            }
        }

        // function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '') {
        //     $this->load->library('email');
        //     $this->email->set_newline("\r\n");
        //     $this->email->from($from, $from_name);
        //     $this->email->to($to);
        //     $this->email->subject($sub);
        //     $this->email->message($msg);

        //     if ($this->email->send()) {
        //         return true;
        //     } else {
        //         //echo $this->email->print_debugger();
        //         return false;
        //     }
        //     //echo $this->email->print_debugger();
        // }

        function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '', $mailtype = 'html' )
        {
            $config = array();
            $smtp_config = array();
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

            if (!empty($protocol)) {
                if ($protocol == 'smtp') {
                    $smtp_config = $this->get_smtp_config();
                }
            }


            $this->load->library('email');
            $this->email->set_newline("\r\n");

            $config['priority'] = 1;
            $config['mailtype'] = $mailtype;


            if (!empty($smtp_config)) {
                $from = $smtp_config['smtp_user'];
                $config = array_merge($config,$smtp_config);
            }

            if (!empty($config)) {
                $this->email->initialize($config);
            }

            $this->email->from($from, $from_name);
            $this->email->to($to);
            $this->email->subject($sub);
            $this->email->message($msg);

            if(!demo()){
                if ($this->email->send()) {
                    return true;
                } else {
                    //echo $this->email->print_debugger();
                    return false;
                }
            }else {
                return true;
            }

            //echo $this->email->print_debugger();
            //exit;
        }

        public function get_smtp_config()
        {
            $config = array();
            $flag_count = 0;

            $smtp_host = $this->db->get_where('general_settings', array('type' => 'smtp_host'))->row()->value;
            $smtp_port = $this->db->get_where('general_settings', array('type' => 'smtp_port'))->row()->value;
            $smtp_user = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            $smtp_pass = $this->db->get_where('general_settings', array('type' => 'smtp_pass'))->row()->value;


            if (!empty($smtp_host)) {

                $config['smtp_host'] = $smtp_host;
                $flag_count++; // 1

            }

            if (!empty($smtp_port)) {

                $config['smtp_port'] = $smtp_port;
                $flag_count++; // 2

            }

            if (!empty($smtp_user)) {

                $config['smtp_user'] = $smtp_user;
                $flag_count++; // 3

            }

            if (!empty($smtp_pass)) {

                $config['smtp_pass'] = $smtp_pass;
                $flag_count++; // 4

            }

            if ($flag_count < 4) {
                $config = array();
            }

            return $config;
        }

    }
