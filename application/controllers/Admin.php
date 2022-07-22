<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/*
	 *	Developed by: Active IT zone
	 *	Date	: 18 September, 2017
	 *	Active Matrimony CMS
	 *	http://codecanyon.net/user/activeitezone
	 */

	function __construct() {
        parent::__construct();
        $this->system_name = $this->Crud_model->get_type_name_by_id('general_settings', '1', 'value');
        $this->system_email = $this->Crud_model->get_type_name_by_id('general_settings', '2', 'value');
        $this->system_title = $this->Crud_model->get_type_name_by_id('general_settings', '3', 'value');
		$this->Crud_model->timezone();
		$this->load->library('spreadsheet');
    }

	public function index()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "dashboard.php";
			$page_data['folder'] = "dashboard";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "dashboard.php";
			$page_data['page_name'] = "dashboard";
			$page_data['total_members'] = $this->db->get('member')->num_rows();
			$page_data['total_premium_members'] = $this->db->get_where('member', array('membership' => 2))->num_rows();
			$page_data['total_free_members'] = $this->db->get_where('member', array('membership' => 1))->num_rows();
			$page_data['total_blocked_members'] = $this->db->get_where('member', array('is_blocked' => 'yes'))->num_rows();
			$page_data['total_earnings'] = $this->db->select_sum('amount')->get('package_payment')->row()->amount;

			$last_month_timestamp = strtotime(date('d-m-Y h:i:s', strtotime("-1 months")));
			$page_data['last_month_earnings'] = $this->db->select_sum('amount')->get_where('package_payment', array('purchase_datetime >=' => $last_month_timestamp))->row()->amount;

			$last_3_months_timestamp = strtotime(date('d-m-Y h:i:s', strtotime("-3 months")));
			$page_data['last_3_months_earnings'] = $this->db->select_sum('amount')->get_where('package_payment', array('purchase_datetime >=' => $last_3_months_timestamp))->row()->amount;

			$half_yearly_timestamp = strtotime(date('d-m-Y h:i:s', strtotime("-6 months")));
			$page_data['half_yearly_earnings'] = $this->db->select_sum('amount')->get_where('package_payment', array('purchase_datetime >=' => $half_yearly_timestamp))->row()->amount;

			$last_year_timestamp = strtotime(date('d-m-Y h:i:s', strtotime("-12 months")));
			$page_data['yearly_earnings'] = $this->db->select_sum('amount')->get_where('package_payment', array('purchase_datetime >=' => $last_year_timestamp))->row()->amount;

			$page_data['total_stories'] = $this->db->get('happy_story')->num_rows();
			$page_data['approved_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1))->num_rows();
			$page_data['pending_stories'] = $this->db->get_where('happy_story', array('approval_status' => 0))->num_rows();


			$this->load->view('back/index', $page_data);
		}
	}

	function admin_permission()
	{
		$admin_id = $this->session->userdata('admin_id');
        if ($admin_id == NULL) {
            return FALSE;
        }
        else {
        	return TRUE;
        }
	}

    function admins($para1 = '', $para2 = '') {
        if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}

        else {
        	$page_data['title'] 	= "Admin || ".$this->system_title;

        	if ($para1 == '') {
				$page_data['top'] 		= "member_configure/index.php";
				$page_data['folder'] 	= "admin";
				$page_data['file'] 		= "index.php";
				$page_data['bottom'] 	= "member_configure/index.php";
				$this->db->where_not_in('admin_id', 1);
				$page_data['all_admins'] = $this->db->get("admin")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "admin";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_admin") {
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "admin";
				$page_data['file']	 	= "add_admin.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "admin";
				if ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="edit_admin") {
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "admin";
				$page_data['file']	 	= "edit_admin.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "admin";

				$page_data['admin_data'] = $this->db->get_where('admin', array(
                        'admin_id' => $para2
                    ))->result_array();

				if ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone No.', 'required');
				$this->form_validation->set_rules('role', 'role', 'required');


				if ($this->form_validation->run() == FALSE) {
	                   $page_data['top'] 		= "members/index.php";
						$page_data['folder'] 	= "admin";
						$page_data['file']	 	= "add_admin.php";
						$page_data['bottom'] 	= "members/index.php";
						$page_data['page_name'] = "admin";

						$page_data['form_contents'] = $this->input->post();

						$page_data['danger_alert'] = translate("failed_to_add_the_data!");

		                $this->load->view('back/index', $page_data);
		            }else {
		            	$data['name'] = $this->input->post('name');
			            $data['email'] = $this->input->post('email');
			            $data['phone'] = $this->input->post('phone');
			            $data['address'] = $this->input->post('address');
			            $password = substr(hash('sha512', rand()), 0, 12);
			            $data['password'] = sha1($password);
			            $data['role'] = $this->input->post('role');
			            $data['timestamp'] = time();
			            $result= $this->db->insert('admin', $data);

			            $this->Email_model->member_staff_account_opening_by_admin('admin', $data['email'], $password);

						recache();
						if ($result) {
							$this->session->set_flashdata('alert', 'add');
							redirect(base_url().'admin/admins', 'refresh');
						}
						else {
							$this->session->set_flashdata('alert', 'failed_add');
							redirect(base_url().'admin/admins', 'refresh');
						}
	            	}
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone No.', 'required');
				$this->form_validation->set_rules('role', 'role', 'required');


				if ($this->form_validation->run() == FALSE) {
	                   $page_data['top'] 		= "members/index.php";
						$page_data['folder'] 	= "admin";
						$page_data['file']	 	= "edit_admin.php";
						$page_data['bottom'] 	= "members/index.php";
						$page_data['page_name'] = "admin";

						$page_data['form_contents'] = $this->input->post();

						$page_data['admin_data'] = $this->db->get_where('admin', array(
                        'admin_id' => $para2
                    ))->result_array();

						$page_data['danger_alert'] = translate("failed_to_update_the_data!");

		                $this->load->view('back/index', $page_data);
		            }else {
		            	$data['name'] = $this->input->post('name');
			            $data['email'] = $this->input->post('email');
			            $data['phone'] = $this->input->post('phone');
			            $data['address'] = $this->input->post('address');

			            $data['role'] = $this->input->post('role');
			            $data['timestamp'] = time();
			            $this->db->where('admin_id', $para2);
            			$result=$this->db->update('admin', $data);
						recache();
						if ($result) {
							$this->session->set_flashdata('alert', 'add');
							redirect(base_url().'admin/admins', 'refresh');
						}
						else {
							$this->session->set_flashdata('alert', 'failed_add');
							redirect(base_url().'admin/admins', 'refresh');
						}
	            	}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('admin_id', $para2);
		        $result = $this->db->delete('admin');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}

        	}
    	}
	}

    function role($para1 = '', $para2 = '') {
        if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}

        else {
        	$page_data['title'] 	= "Admin || ".$this->system_title;

        	if ($para1 == '') {
				$page_data['top'] 		= "member_configure/index.php";
				$page_data['folder'] 	= "role";
				$page_data['file'] 		= "index.php";
				$page_data['bottom'] 	= "member_configure/index.php";
				$page_data['all_roles'] = $this->db->get("role")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "role";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_role") {
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "role";
				$page_data['file']	 	= "add_role.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "role";
				$page_data['all_permissions'] = $this->db->get('permission')->result_array();

				if ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="edit_role") {
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "role";
				$page_data['file']	 	= "edit_role.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "role";
				$page_data['all_permissions'] = $this->db->get('permission')->result_array();
				$page_data['role_data'] = $this->db->get_where('role',array('role_id'=> $para2))->result_array();

				if ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'Role Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                   $page_data['top'] 		= "members/index.php";
						$page_data['folder'] 	= "role";
						$page_data['file']	 	= "add_role.php";
						$page_data['bottom'] 	= "members/index.php";
						$page_data['page_name'] = "role";
						$page_data['all_permissions'] = $this->db->get('permission')->result_array();

						$page_data['form_contents'] = $this->input->post();
						$page_data['danger_alert'] = translate("failed_to_add_the_data!");

		                $this->load->view('back/index', $page_data);
		            }else {
		            	$data['name'] = $this->input->post('name');
			            $data['permission'] = json_encode($this->input->post('permission'));
			            $data['description'] = $this->input->post('description');
			            $result= $this->db->insert('role', $data);
						recache();
						if ($result) {
							$this->session->set_flashdata('alert', 'add');
							redirect(base_url().'admin/role', 'refresh');
						}
						else {
							$this->session->set_flashdata('alert', 'failed_add');
							redirect(base_url().'admin/role', 'refresh');
						}
	            	}
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'Role Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                   $page_data['top'] 		= "members/index.php";
						$page_data['folder'] 	= "role";
						$page_data['file']	 	= "edit_role.php";
						$page_data['bottom'] 	= "members/index.php";
						$page_data['page_name'] = "role";
						$page_data['all_permissions'] = $this->db->get('permission')->result_array();
						$page_data['role_data'] = $this->db->get_where('role',array('role_id'=> $para2))->result_array();

						$page_data['form_contents'] = $this->input->post();
						$page_data['danger_alert'] = translate("failed_to_edit_the_data!");

		                $this->load->view('back/index', $page_data);
		            }else {
		            	$data['name'] = $this->input->post('name');
			            $data['permission'] = json_encode($this->input->post('permission'));
			            $data['description'] = $this->input->post('description');

			            $this->db->where('role_id', $para2);
            			$this->db->update('role', $data);
						recache();

						$this->session->set_flashdata('alert', 'edit');
						redirect(base_url().'admin/role', 'refresh');

	            	}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('role_id', $para2);
		        $result = $this->db->delete('role');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
        	}
    	}
	}

	function members($para1="",$para2="",$para3="",$para4="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($this->session->flashdata('alert') == "block") {
				$page_data['danger_alert'] = translate("you_have_successfully_blocked_this_member!");
			}
			elseif ($this->session->flashdata('alert') == "unblock") {
				$page_data['success_alert'] = translate("you_have_successfully_unlocked_this_member!");
			}
			elseif ($this->session->flashdata('alert') == "delete") {
				$page_data['success_alert'] = translate("this_member_is_moved_to_deleted_member_list!");
			}
			elseif ($this->session->flashdata('alert') == "failed_delete") {
				$page_data['danger_alert'] = translate("failed_to_delete_this_member!");
			}
			elseif ($this->session->flashdata('alert') == "member_approval") {
				$page_data['success_alert'] = translate("you_have_successfully_approved_this_member!");
			}
			elseif ($this->session->flashdata('alert') == "demo_msg") {
				$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
			}

			if ($para2=="list_data") {
				if ($para1=="free_members") {
					if($member_approval == 'yes'){
						$columns = array(
                            0 =>'',
                            1 =>'member_profile_id',
							2 =>'first_name',
                            3 =>'status',
							4 =>'follower',
                            5 =>'reported_by',
                            6 =>'member_since',
                        );
					}
					else{
						$columns = array(
                            0 =>'',
                            1 =>'member_profile_id',
							2 =>'first_name',
							3 =>'follower',
                            4 =>'reported_by',
                            5 =>'member_since',
                        );
					}
		  		}

			    elseif ($para1=="premium_members") {
			    	if($member_approval == 'yes'){
				      	$columns = array(
				                   	0 =>'',
				                    1 =>'member_profile_id',
									2 =>'first_name',
				                    3 =>'status',
				                    4 =>'follower',
									5 =>'reported_by',
				                    6 =>'member_since',
				                );
				     }
					else{
				      	$columns = array(
		                       	0 =>'',
		                        1 =>'member_profile_id',
								2 =>'first_name',
		                        3 =>'follower',
								4 =>'reported_by',
		                        5 =>'member_since',
		                    );
			      	}
			    }

				$limit = $this->input->post('length');
		        $start = $this->input->post('start');

				if($this->input->post('order')[0]['column'] == 0){
					$order = 'member_id';
			        $dir = 'desc';
				}
				else{
					 $order = $columns[$this->input->post('order')[0]['column']];
			         $dir = $this->input->post('order')[0]['dir'];
				}

		        if ($para1=="free_members") {
		        	$member_type = 1;
		        }
	        	elseif ($para1=="premium_members") {
		        	$member_type = 2;
		        }

	        	$totalData = $this->Crud_model->allmembers_count($member_type);

	        	$totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {

		        	$members = $this->Crud_model->allmembers($member_type,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $members =  $this->Crud_model->members_search($member_type,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->members_search_count($member_type,$search);
		        }

		        $data = array();
		        if(!empty($members))
		        {
		        	// if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		        	foreach ($members as $member)
		          	{
		           		$image = json_decode($member->profile_image, true);
		           		if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
							$member_image="<img src='".base_url()."uploads/profile_image/".$image[0]['thumb']."' class='img-sm'>";
						}
						else {
							$member_image="<img src='".base_url()."uploads/profile_image/default.jpg' class='img-sm'>";
						}

						if ($member->is_blocked == "yes") {
							$block_button = "<button data-target='#block_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '".translate('unblock')."' onclick='block(\"".$member->is_blocked."\", ".$member->member_id.")'><i class='fa fa-check'></i></button>";
						}
						elseif ($member->is_blocked == "no") {
							$block_button = "<button data-target='#block_modal' data-toggle='modal' class='btn btn-dark btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('block')."' onclick='block(\"".$member->is_blocked."\", ".$member->member_id.")'><i class='fa fa-ban'></i></button>";
						}

						if ($member->is_closed == "yes") {
							$acnt_status_button = "<center><span class='badge badge-danger' style='width:60px'>".translate('closed')."</span></center>";
						}
						elseif ($member->is_closed == "no") {
							$acnt_status_button = "<center><span class='badge badge-success' style='width:60px'>".translate('Active')."</span></center>";
						}

						if ($member_approval == 'yes') {
							if ($member->status == "pending")
							{
								$status_button = "<button data-target='#status_modal' data-toggle='modal' class='btn btn-info btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '".translate('approve')."' onclick='status(\"".$member->status."\", ".$member->member_id.")'><i class='fa fa-hand-pointer-o'></i></button>
								";

							}
							elseif ($member->status == "approved") {
								$status_button = "<button  data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '".translate('approved')."' ><i class='fa fa-thumbs-up'></i></button>";
							}
						}
						else
						{
							$status_button = '';
						}
		        		$nestedData['image'] = $member_image;
						$nestedData['name'] = $member->first_name.' '.$member->last_name;
						if ($member->status == "pending")
						{
							$nestedData['status'] = "<button  data-toggle='modal' class='badge badge-info' >".translate('pending')."</button>";
						}
						elseif ($member->status == "approved") {
							$nestedData['status'] = "<button   class='badge badge-success' >".translate('approved')."</i></button>";
						}
				        $nestedData['member_id'] = $member->member_profile_id;
								$nestedData['follower'] = $member->follower;
				        $nestedData['profile_reported'] = $member->reported_by;

				        if ($para1=="premium_members") {
			              	$package_info = $this->db->get_where('member', array('member_id' => $member->member_id))->row()->package_info;
			          			$package_info = json_decode($package_info, true);
			              	$nestedData['package'] = $package_info[0]['current_package'];
			          	}
			            $nestedData['member_since'] = date('d/m/Y h:i:s A', strtotime($member->member_since));
			            $nestedData['member_status'] = $acnt_status_button;
			            $nestedData['options'] = "<a href='".base_url()."admin/members/".$para1."/view_member/".$member->member_id."' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('view_profile')."' ><i class='fa fa-eye'></i></a>
									<a href='#' id='demo-dt-delete-btn' data-target='#package_modal' data-toggle='modal' class='btn btn-info btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('packages')."' onclick='view_package(".$member->member_id.")'><i class='fa fa-object-ungroup'></i></a> ".$block_button."<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete_member')."' onclick='delete_member(".$member->member_id.")'><i class='fa fa-trash'></i></button>".$status_button."";
										$data[] = $nestedData;
		                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}

			elseif ($para1=="free_members") {
				if ($para2=="") {
					$page_data['top'] = "members/index.php";
					$page_data['folder'] = "members";
					$page_data['file'] = "index.php";
					$page_data['bottom'] = "members/index.php";
					$page_data['get_free_members'] = $this->db->get_where("member", array("membership" => 1))->result();
					if ($this->session->flashdata('alert') == "edit") {
						$page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
					}
					elseif ($this->session->flashdata('alert') == "upgrade") {
						$page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
					}
				}
				elseif ($para2=="view_member") {
					$page_data['top'] 		= "members/members.php";
					$page_data['folder'] 	= "members";
					$page_data['file'] 		= "view_member.php";
					$page_data['bottom'] 	= "members/members.php";
					$page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para3))->result();
				}
				elseif ($para2=="edit_member") {
					$page_data['top'] 		= "members/members.php";
					$page_data['folder'] 	= "members";
					$page_data['file']	 	= "edit_member.php";
					$page_data['bottom'] 	= "members/members.php";
					$page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para3))->result();
				}
				$page_data['member_type'] = "Free";
				$page_data['parameter'] 	= "free_members";
				$page_data['page_name'] 	= "free_members";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="premium_members") {
				if ($para2=="") {
					$page_data['top'] = "members/index.php";
					$page_data['folder'] = "members";
					$page_data['file'] = "index.php";
					$page_data['bottom'] = "members/index.php";
					$page_data['get_premium_members'] = $this->db->get_where("member", array("membership" => 2))->result();
					if ($this->session->flashdata('alert') == "edit") {
						$page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
					}
					elseif ($this->session->flashdata('alert') == "upgrade") {
						$page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
					}
				}
				elseif ($para2=="view_member") {
					$page_data['top'] = "members/members.php";
					$page_data['folder'] = "members";
					$page_data['file'] = "view_member.php";
					$page_data['bottom'] = "members/members.php";
					$page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
				}
				elseif ($para2=="edit_member") {
					$page_data['top'] 		= "members/members.php";
					$page_data['folder'] 	= "members";
					$page_data['file']	 	= "edit_member.php";
					$page_data['bottom'] 	= "members/members.php";
					$page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
				}
				$page_data['member_type'] = "Premium";
				$page_data['parameter'] = "premium_members";
				$page_data['page_name'] = "premium_members";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_member") {
				if ($para2=="") {
					$page_data['top'] 		= "members/index.php";
					$page_data['folder'] 	= "members";
					$page_data['file']	 	= "add_member.php";
					$page_data['bottom'] 	= "members/index.php";
					$page_data['page_name'] = "add_member";
					if ($this->session->flashdata('alert') == "add") {
						$page_data['success_alert'] = translate("you_have_successfully_added_a_member!!");
					}
					elseif ($this->session->flashdata('alert') == "add_fail") {
						$page_data['danger_alert'] = translate("member_registration_failed!");
					}


					$this->load->view('back/index', $page_data);
				}
				elseif ($para2=="do_add") {

					$this->form_validation->set_rules('fname', 'First Name', 'required');
					$this->form_validation->set_rules('lname', 'Last Name', 'required');
					$this->form_validation->set_rules('gender', 'Gender', 'required');
					$this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
					$this->form_validation->set_rules('plan', 'Plan', 'required');
		            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]',array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
	                $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
		            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
		            $this->form_validation->set_rules('password', 'Password', 'required');
		            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

		            if ($this->form_validation->run() == FALSE) {
	                    $page_data['top'] 		= "members/index.php";
						$page_data['folder'] 	= "members";
						$page_data['file']	 	= "add_member.php";
						$page_data['bottom'] 	= "members/index.php";
						$page_data['page_name'] = "add_member";
						$page_data['form_error'] = "yes";
		                $page_data['form_contents'] = $this->input->post();
		                $this->session->set_flashdata('alert', 'add_fail');
		                $this->load->view('back/index', $page_data);
		            }
		            else {

	                    // ------------------------------------Profile Image------------------------------------ //
	                    $profile_image[] = array('profile_image'    =>  'default.jpg',
	                                                'thumb'         =>  'default_thumb.jpg'
	                                        );
	                    $profile_image = json_encode($profile_image);
	                    // ------------------------------------Profile Image------------------------------------ //

	                    // ------------------------------------Basic Info------------------------------------ //
	                    $basic_info[] = array('age'                 => '',
	                                        'marital_status'        => '',
	                                        'number_of_children'    => '',
	                                        'area'                  => '',
	                                        'on_behalf'             => $this->input->post('on_behalf')
	                                        );
	                    $basic_info = json_encode($basic_info);
	                    // ------------------------------------Basic Info------------------------------------ //

	                    // ------------------------------------Present Address------------------------------------ //
	                    $present_address[] = array('country'        => '',
	                                        'city'                  => '',
	                                        'state'                 => '',
	                                        'postal_code'           => ''
	                                        );
	                    $present_address = json_encode($present_address);
	                    // ------------------------------------Present Address------------------------------------ //

	                    // ------------------------------------Education & Career------------------------------------ //
	                    $education_and_career[] = array('highest_education' => '',
	                                        'occupation'                    => '',
	                                        'annual_income'                 => ''
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
                                    		'family_status'          =>  ''
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
	                                        'brother_sister'        => ''
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
	                    $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $this->input->post('plan')),
	                                            'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $this->input->post('plan'), 'amount'),
												'view_count'     => $this->Crud_model->get_type_name_by_id('plan', $this->input->post('plan'), 'view_profile'),
	                                            'payment_type'      => 'None',
	                                        );
	                    $package_info = json_encode($package_info);
	                    // --------------------------------- Additional Personal Details--------------------------------- //


	                        $data['status'] = 'approved';
	                        $data['first_name'] = $this->input->post('fname');
	                        $data['last_name'] = $this->input->post('lname');
	                        $data['gender'] = $this->input->post('gender');
	                        $data['email'] = $this->input->post('email');
	                        $data['email_verification_status'] = '1';
	                        $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
	                        $data['height'] = 0.00;
	                        $data['mobile'] = $this->input->post('mobile');
	                        $data['password'] = sha1($this->input->post('password'));
	                        $data['profile_image'] = $profile_image;
	                        $data['introduction'] = '';
	                        $data['basic_info'] = $basic_info;
	                        $data['present_address'] = $present_address;
	                        $data['family_info'] = $family_info;
	                        $data['education_and_career'] = $education_and_career;
	                        $data['physical_attributes'] = $physical_attributes;
	                        $data['language'] = $language;
	                        $data['hobbies_and_interest'] = $hobbies_and_interest;
	                        $data['personal_attitude_and_behavior'] = $personal_attitude_and_behavior;
	                        $data['residency_information'] = $residency_information;
	                        $data['spiritual_and_social_background'] = $spiritual_and_social_background;
	                        $data['life_style'] = $life_style;
	                        $data['astronomic_information'] = $astronomic_information;
	                        $data['permanent_address'] = $permanent_address;
	                        $data['additional_personal_details'] = $additional_personal_details;
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
	                        $plan = $this->input->post('plan');
	                        if ($plan == 1) {
	                        	$data['membership'] = 1;
	                        }
	                        else {
	                        	$data['membership'] = 2;
	                        }
	                        $data['profile_status'] = 1;
	                        $data['is_closed'] = 'no';
	                        $data['member_since'] = date("Y-m-d H:i:s");
	                        $data['express_interest'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->express_interest;
	                        $data['direct_messages'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->direct_messages;
	                        $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->photo_gallery;
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

	                        // $msg = 'done';
	                        if ($this->Email_model->member_staff_account_opening_by_admin('member', $data['email'], $this->input->post('password')) == false) {
	                            //$msg = 'done_but_not_sent';
	                        } else {
	                            //$msg = 'done_and_sent';
	                        }
	                        // $msg = 'done';
	                        if ($this->Email_model->member_registration_email_to_admin($insert_id) == false) {
	                            //$msg = 'done_but_not_sent';
	                        } else {
	                            //$msg = 'done_and_sent';
	                        }

	                        $this->session->set_flashdata('alert', 'add');
	                        redirect(base_url().'admin/members/add_member', 'refresh');

		            }
				}
			}
			elseif ($para1=="update_member") {
				// $this->form_validation->set_rules('introduction', 'Introduction', 'required');
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

				// if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes")
				// {
				// 	$this->form_validation->set_rules('country', 'Country', 'required');
		        //     $this->form_validation->set_rules('state', 'State', 'required');
				// }

	            // if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes")
				// {
		        //     $this->form_validation->set_rules('highest_education', 'Highest Education', 'required');
		        //     $this->form_validation->set_rules('occupation', 'Occupation', 'required');
				// }

				// if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes")
				// {
		        //     $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'required');
				// }

				// if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes")
				// {
		        //     $this->form_validation->set_rules('birth_country', 'Birth Country', 'required');
		        //     $this->form_validation->set_rules('citizenship_country', 'Citizenship Country', 'required');
				// }

				// if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes")
				// {
		        //     $this->form_validation->set_rules('religion', 'Religion', 'required');
				// }

				// if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes")
				// {
		        //     $this->form_validation->set_rules('permanent_country', 'Permanent Country', 'required');
		        //     $this->form_validation->set_rules('permanent_state', 'Permanent State', 'required');
				// }

	            if ($this->form_validation->run() == FALSE) {
	            	$page_data['top'] 		= "members/index.php";
					$page_data['folder'] 	= "members";
					$page_data['file']	 	= "edit_member.php";
					$page_data['bottom'] 	= "members/index.php";
					$page_data['page_name'] = "edit_member";
					$page_data['form_error'] = "yes";
	                $page_data['form_contents'] = $this->input->post();
	                $this->session->set_flashdata('alert', 'edit_fail');
	                if ($para3 == 'premium_members') {
	                	$page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para2))->result();
		                $page_data['member_type'] = "Premium";
						$page_data['parameter'] = "premium_members";
						$page_data['page_name'] = "premium_members";
	                }
	                elseif ($para3 == 'free_members') {
	                	$page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para2))->result();
		                $page_data['member_type'] = "Free";
						$page_data['parameter'] = "free_members";
						$page_data['page_name'] = "free_members";
	                }

	                $this->load->view('back/index', $page_data);
	            }
	            else {
	            	$data['first_name'] = $this->input->post('first_name');
	            	$data['last_name'] = $this->input->post('last_name');
	            	$data['gender'] = $this->input->post('gender');
					if(!demo()){
						$data['email'] = $this->input->post('email');
					}
	                $data['mobile'] = $this->input->post('mobile');
	                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
	                $data['height'] = $this->input->post('height');
	            	$data['introduction'] = $this->input->post('introduction');
					$data['subcaste'] = $this->input->post('gotra');

	            	// ------------------------------------Basic Info------------------------------------ //
	            	$basic_info[] = array(
	    								'marital_status'		=>	$this->input->post('marital_status'),
										'child_count'			=> 	$this->input->post('number_of_children'),
	    								'area'					=>	$this->input->post('area'),
	                                    'on_behalf'             =>  $this->input->post('on_behalf'),
										'religion'				=>  $this->input->post('religion'),
										'caste'					=>  $this->input->post('caste'),
										'p_height'				=>  $this->input->post('b_height')
				                        );
	            	$data['basic_info'] = json_encode($basic_info);
	            	// ------------------------------------Basic Info------------------------------------ //

	            	// ------------------------------------Present Address------------------------------------ //
					$data['country'] = $this->input->post('country');
					$data['state'] = $this->input->post('state');
					$data['city'] = $this->input->post('city');
					$data['residence'] = $this->input->post('residence');

	            	$present_address[] = array('address'			=>  $this->input->post('address'),
	    								'mobile2'					=>	$this->input->post('mobile2')
									);
	            	$data['present_address'] = json_encode($present_address);
	            	// ------------------------------------Present Address------------------------------------ //

	            	// ------------------------------------Education & Career------------------------------------ //
					$data['eduction'] = $this->input->post('education');
					$data['occupation'] = $this->input->post('occupation');
					$data['anual_income'] = $this->input->post('anual_income');
					$data['employed'] = $this->input->post('employed');
	            	$education_and_career[] = array('education_detail'	=>  $this->input->post('education_detail'),
	    								'occupation_detail'					=>	$this->input->post('occupation_detail')
				                        );
	            	$data['education_and_career'] = json_encode($education_and_career);
	            	// ------------------------------------Education & Career------------------------------------ //

	            	// ------------------------------------ Physical Attributes------------------------------------ //
					$data['p_height'] = $this->input->post('user_height');
					
	            	$physical_attributes[] = array('weight'     =>	$this->input->post('weight'),
	    								'eye_color'				=>	$this->input->post('eye_color'),
	    								'hair_color'			=>	$this->input->post('hair_color'),
	    								'complexion'			=>	$this->input->post('complexion'),
	    								'blood_group'			=>	$this->input->post('blood_group'),
	    								'body_type'				=>	$this->input->post('body_type'),
	    								'body_art'				=>	$this->input->post('body_art'),
	    								'any_disability'		=>	$this->input->post('any_disability')
				                        );
	            	$data['physical_attributes'] = json_encode($physical_attributes);
	            	// ------------------------------------ Physical Attributes------------------------------------ //

	            	// ------------------------------------ Life Style------------------------------------ //
	            	$life_style[] = array('diet'				=>  $this->input->post('diet'),
	    								'drink'					=>	$this->input->post('drink'),
	    								'smoke'					=>	$this->input->post('smoke'),
	    								'living_with'			=>	$this->input->post('living_with')
				                        );
	            	$data['life_style'] = json_encode($life_style);
	            	// ------------------------------------ Life Style------------------------------------ //

	            	// ------------------------------------ Astronomic Information------------------------------------ //
	            	$astronomic_information[] = array('sun_sign'	=>  $this->input->post('sun_sign'),
	    								'moon_sign'					=>	$this->input->post('moon_sign'),
	    								'time_of_birth'				=>	$this->input->post('time_of_birth'),
	    								'city_of_birth'				=>	$this->input->post('city_of_birth')
				                        );
	            	$data['astronomic_information'] = json_encode($astronomic_information);
	            	// ------------------------------------ Astronomic Information------------------------------------ //

	            	// ------------------------------------Family Information------------------------------------ //
					$data['family_type'] = $this->input->post('family_type');
					$data['family_status'] = $this->input->post('family_status');
					$data['family_values'] = $this->input->post('family_value');
					$data['mother_tounge'] = $this->input->post('mother_tounge');
					$data['brothers'] = $this->input->post('brothers');
					$data['sisters'] = $this->input->post('sisters');
					$data['married_brothers'] = $this->input->post('mbrothers');
					$data['married_sisters'] = $this->input->post('msisters');
					
	            	$family_info[] = array('father_name'				=>  $this->input->post('father'),
	    								'mother_name'				=>	$this->input->post('mother'),
	    								'father_occupation'		=>	$this->input->post('father_occu'),
										'mother_occupation'		=>	$this->input->post('mother_occu')
				                        );
	            	$data['family_info'] = json_encode($family_info);
	            	// ------------------------------------Family Information------------------------------------ //

	            	// ------------------------------------ Partner Expectation------------------------------------ //
	            	$partner_expectation[] = array('general_requirement'	=>  $this->input->post('general_requirement'),
	    								'partner_age'						=>	$this->input->post('partner_age'),
	    								'partner_height'					=>	$this->input->post('partner_height'),
	    								'partner_weight'					=>	$this->input->post('partner_weight'),
	    								'partner_marital_status'			=>	$this->input->post('partner_marital_status'),
	    								'with_children_acceptables'			=>	$this->input->post('with_children_acceptables'),
	    								'partner_country_of_residence'		=>	$this->input->post('partner_country_of_residence'),
	    								'partner_religion'					=>	$this->input->post('partner_religion'),
	    								'partner_caste'						=>	$this->input->post('partner_caste'),
	    								'partner_complexion'				=>	$this->input->post('partner_complexion'),
	    								'partner_education'                 =>	$this->input->post('partner_education'),
	    								'partner_profession'				=>	$this->input->post('partner_profession'),
	    								'partner_drinking_habits'			=>	$this->input->post('partner_drinking_habits'),
	    								'partner_smoking_habits'			=>	$this->input->post('partner_smoking_habits'),
	    								'partner_diet'						=>	$this->input->post('partner_diet'),
	    								'partner_body_type'					=>	$this->input->post('partner_body_type'),
	    								'partner_personal_value'			=>	$this->input->post('partner_personal_value'),
	    								'manglik'							=>	$this->input->post('manglik'),
	    								'partner_any_disability'			=>	$this->input->post('partner_any_disability'),
	    								'partner_mother_tongue'				=>	$this->input->post('partner_mother_tongue'),
	    								'partner_family_value'				=>	$this->input->post('partner_family_value'),
	    								'prefered_country'					=>	$this->input->post('prefered_country'),
	    								'prefered_state'					=>	$this->input->post('prefered_state'),
	    								'prefered_status'					=>	$this->input->post('prefered_status')
				                        );
	            	$data['partner_expectation'] = json_encode($partner_expectation);
	            	// ------------------------------------ Partner Expectation------------------------------------ //
	            	// Profile Image
					if(!demo()){
						if ($_FILES['profile_image']['name'] !== '') {
			                $path = $_FILES['profile_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                    $this->Crud_model->file_up("profile_image", "profile", $para2, '', '', $ext);
			                    $images[] = array('profile_image' => 'profile_' . $para2 . $ext, 'thumb' => 'profile_' . $para2 . '_thumb' . $ext);
								$data['profile_image'] = json_encode($images);
								$data['profile_image_status'] = 1;
			                    $data['profile_image_update_time'] = date("Y-m-d H:i:s") ;
			                }
			            }
					}
					

	                $this->db->where('member_id', $para2);
	                $result = $this->db->update('member', $data);
					
	                recache();
	                if ($result) {
	                    $this->session->set_flashdata('alert', 'edit');
	                    redirect(base_url().'admin/members/'. $para3, 'refresh');
	                }
	            }
			}
			elseif ($para1=="upgrade_member_package") {
				$up_member_id = $this->input->post('up_member_id');
				$plan_id = $this->input->post('plan');
				$member_type = $this->input->post('member_type');

				$prev_express_interest =  $this->db->get_where('member', array('member_id' => $up_member_id))->row()->express_interest;
                $prev_direct_messages = $this->db->get_where('member', array('member_id' => $up_member_id))->row()->direct_messages;
                $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $up_member_id))->row()->photo_gallery;

                if ($plan_id == '1') {
                	$data['membership'] = 1;
                } else {
                	$data['membership'] = 2;
                }

                $data['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->express_interest;
                $data['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->direct_messages;
                $data['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->photo_gallery;

                $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $plan_id),
                                'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $plan_id, 'amount'),
								'view_count'     => $this->Crud_model->get_type_name_by_id('plan', $plan_id, 'view_profile'),
                                'payment_type'      => 'By Admin',
                            );
                            
                 $data['package_info'] = json_encode($package_info);

                $this->db->where('member_id', $up_member_id);
                $result = $this->db->update('member', $data);
                recache();
                if ($result) {
                    $this->session->set_flashdata('alert', 'upgrade');
                    redirect(base_url().'admin/members/'. $member_type, 'refresh');
                }
			}
		}
	}

	// Bulk member add
	function bulk_member_add($para1="", $para2="", $para3=""){
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			if($para1 == 'do_add'){
				if(!file_exists($_FILES['bulk_member_file']['tmp_name']) || !is_uploaded_file($_FILES['bulk_member_file']['tmp_name'])){
		            $this->session->set_flashdata('error',translate('File is not selected'));
		            redirect('admin/bulk_member_add');
		        }

				$inputFileName = $_FILES['bulk_member_file']['tmp_name'];

		        $inputFileType = $this->spreadsheet->identify($inputFileName);
		        $reader = $this->spreadsheet->createReader($inputFileType);
		        $spreadsheet = $reader->load($inputFileName);
		        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		        $members = array();
		        if(!empty($sheetData)){

		            if(!isset($sheetData[1])){
		                $this->session->set_flashdata('error',translate('Column names are missing'));
		                redirect('admin/bulk_member_add');
		            }

		            foreach ($sheetData[1] as $colk => $colv){
		                $col_map[$colk] = $colv;
		            }

		            if(!isset($sheetData[2])){
		                $this->session->set_flashdata('error',translate('Data missing'));
		                redirect('admin/bulk_member_add');
		            }

		            for($i = 2;$i <= count($sheetData);$i++){
		                $member = array();
		                foreach ($sheetData[$i] as $colk =>$colv) {
		                    $member[$col_map[$colk]] = $colv;
		                }
		                $members[] = $member;
		            }
		        }
				$true_counter = "";
				$false_counter = "";


		        if(!empty($members)){
		            foreach ($members as $member){
		              $add_done =   $this->member_bulk_upload_save_single($member);
					  if($add_done == TRUE){
						  $true_counter++;
					  }elseif ($add_done != TRUE) {
					  	  $false_counter++;
					  }
		            }
		        }

				$page_data['title'] 	= "Admin || ".$this->system_title;
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "members";
				$page_data['file']	 	= "bulk_member_add.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "bulk_member_add";
				if($true_counter > 0 ){
					$page_data['true_counter']	 	= $true_counter;
				}
				if($false_counter > 0 ){
					$page_data['false_counter'] 	= $false_counter;
				}
				$this->load->view('back/index', $page_data);

			}
			elseif ($para1 == "") {
				$page_data['title'] = "Admin || ".$this->system_title;
				$page_data['top'] 		= "members/index.php";
				$page_data['folder'] 	= "members";
				$page_data['file']	 	= "bulk_member_add.php";
				$page_data['bottom'] 	= "members/index.php";
				$page_data['page_name'] = "bulk_member_add";
				$this->load->view('back/index', $page_data);
			}
		}
	}

	public function member_bulk_upload_save_single($member)
    {
		$member_email_check = $this->db->get_where("member", array("email" => $member['email']))->num_rows();
        if($member_email_check > 0){
			return 0;
		}
	    $profile_image[] = array('profile_image'    =>  'default.jpg',
	                                'thumb'         =>  'default_thumb.jpg'
	                        );
	    $profile_image = json_encode($profile_image);

	    $basic_info[] = array('age'                 => '',
	                        'marital_status'        => '',
	                        'number_of_children'    => '',
	                        'area'                  => '',
	                        'on_behalf'             => $member['on_behalf']
	                        );
	    $basic_info = json_encode($basic_info);

	    $present_address[] = array('country'        => '',
	                        'city'                  => '',
	                        'state'                 => '',
	                        'postal_code'           => ''
	                        );
	    $present_address = json_encode($present_address);

	    $education_and_career[] = array('highest_education' => '',
	                        'occupation'                    => '',
	                        'annual_income'                 => ''
	                        );
	    $education_and_career = json_encode($education_and_career);

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

	    $language[] = array('mother_tongue'         => '',
	                        'language'              => '',
	                        'speak'                 => '',
	                        'read'                  => ''
	                        );
	    $language = json_encode($language);

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

	    $personal_attitude_and_behavior[] = array('affection'   => '',
	                        'humor'                 => '',
	                        'political_view'        => '',
	                        'religious_service'     => ''
	                        );
	    $personal_attitude_and_behavior = json_encode($personal_attitude_and_behavior);

	    $residency_information[] = array('birth_country'    => '',
	                        'residency_country'     => '',
	                        'citizenship_country'   => '',
	                        'grow_up_country'       => '',
	                        'immigration_status'    => ''
	                        );
	    $residency_information = json_encode($residency_information);

	    $spiritual_and_social_background[] = array('religion'   => '',
	                        'caste'                 => '',
	                        'sub_caste'             => '',
	                        'ethnicity'             => '',
	                        'u_manglik'             => '',
	                        'personal_value'        => '',
	                        'family_value'          => '',
	                        'community_value'       => '',
	                        'family_status'          =>  ''
	                        );
	    $spiritual_and_social_background = json_encode($spiritual_and_social_background);

	    $life_style[] = array('diet'                => '',
	                        'drink'                 => '',
	                        'smoke'                 => '',
	                        'living_with'           => ''
	                        );
	    $life_style = json_encode($life_style);

	    $astronomic_information[] = array('sun_sign'    => '',
	                        'moon_sign'                 => '',
	                        'time_of_birth'             => '',
	                        'city_of_birth'             => ''
	                        );
	    $astronomic_information = json_encode($astronomic_information);

	    $permanent_address[] = array('permanent_country'    => '',
	                        'permanent_city'                => '',
	                        'permanent_state'               => '',
	                        'permanent_postal_code'         => ''
	                        );
	    $permanent_address = json_encode($permanent_address);

	    $family_info[] = array('father'             => '',
	                        'mother'                => '',
	                        'brother_sister'        => ''
	                        );
	    $family_info = json_encode($family_info);

	    $additional_personal_details[] = array('home_district'  => '',
	                        'family_residence'              => '',
	                        'fathers_occupation'            => '',
	                        'special_circumstances'         => ''
	                        );
	    $additional_personal_details = json_encode($additional_personal_details);

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

	    $pic_privacy[] = array(
	                        'profile_pic_show'        => 'all',
	                        'gallery_show'            => 'premium'

	                        );
	    $data_pic_privacy = json_encode($pic_privacy);

	    $package_info[] = array('current_package'   => $this->Crud_model->get_type_name_by_id('plan', $member['package']),
	                            'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $member['package'], 'amount'),
								'view_count'     => $this->Crud_model->get_type_name_by_id('plan', $member['package'], 'view_profile'),
	                            'payment_type'      => 'None',
	                        );
	    $package_info = json_encode($package_info);


	        $data['status'] = 'approved';
	        $data['first_name'] = $member['first_name'];
	        $data['last_name'] = $member['last_name'];
	        $data['gender'] = $member['gender'];
	        $data['email'] = $member['email'];
	        $data['email_verification_status'] = '1';
	        $data['date_of_birth'] = strtotime($member['date_of_birth']);
	        $data['height'] = 0.00;
	        $data['mobile'] = $member['mobile'];
	        $data['password'] = sha1($member['password']);
	        $data['profile_image'] = $profile_image;
	        $data['introduction'] = '';
	        $data['basic_info'] = $basic_info;
	        $data['present_address'] = $present_address;
	        $data['family_info'] = $family_info;
	        $data['education_and_career'] = $education_and_career;
	        $data['physical_attributes'] = $physical_attributes;
	        $data['language'] = $language;
	        $data['hobbies_and_interest'] = $hobbies_and_interest;
	        $data['personal_attitude_and_behavior'] = $personal_attitude_and_behavior;
	        $data['residency_information'] = $residency_information;
	        $data['spiritual_and_social_background'] = $spiritual_and_social_background;
	        $data['life_style'] = $life_style;
	        $data['astronomic_information'] = $astronomic_information;
	        $data['permanent_address'] = $permanent_address;
	        $data['additional_personal_details'] = $additional_personal_details;
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
	        $plan = $member['package'];
	        if ($plan == 1) {
	            $data['membership'] = 1;
	        }
	        else {
	            $data['membership'] = 2;
	        }
	        $data['profile_status'] = 1;
	        $data['is_closed'] = 'no';
	        $data['member_since'] = date("Y-m-d H:i:s");
	        $data['express_interest'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->express_interest;
	        $data['direct_messages'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->direct_messages;
	        $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id'=> $plan))->row()->photo_gallery;
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
	        $this->Email_model->member_staff_account_opening_by_admin('member', $data['email'], $member['password']);
	        $this->Email_model->member_registration_email_to_admin($insert_id);
			return 1;
    }

	function deleted_members($para1="",$para2="",$para3="",$para4="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$member_approval = $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($this->session->flashdata('alert') == "restore") {
				$page_data['success_alert'] = translate("you_have_successfully_restored_this_member!");
			}
			if ($this->session->flashdata('alert') == "delete") {
				$page_data['success_alert'] = translate("you_have_successfully_deleted_this_member_permanently!");
			}
			elseif ($this->session->flashdata('alert') == "demo_msg") {
				$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
			}
			if ($para1=="list_data") {
				if($member_approval == 'yes'){
						$columns = array(
	                        0 =>'',
	                        1 =>'member_profile_id',
	                        2 =>'first_name',
	                        3 =>'status',
	                        4 =>'follower',
	                        5 =>'reported_by',
	                        6 =>'member_since',
                    	);
					}else{
						$columns = array(
	                        0 =>'',
	                        1 =>'member_profile_id',
	                        2 =>'first_name',
	                        3 =>'follower',
	                        4 =>'reported_by',
	                        5 =>'member_since',
                    	);
					}


				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];

		        $member_type = 3;

		        $totalData = $this->Crud_model->all_deleted_members_count($member_type);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {

		        	$members = $this->Crud_model->all_deleted_members($member_type,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $members =  $this->Crud_model->deleted_members_search($member_type,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->deleted_members_search_count($member_type,$search);
		        }

		        $data = array();
		        if(!empty($members))
		        {
		        	// if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($members as $member)
		            {
		            	$image = json_decode($member->profile_image, true);
		            	if (file_exists('uploads/profile_image/'.$image[0]['thumb'])) {
							$member_image="<img src='".base_url()."uploads/profile_image/".$image[0]['thumb']."' class='img-sm'>";
						}
						else {
							$member_image="<img src='".base_url()."uploads/profile_image/default.jpg' class='img-sm'>";
						}

						if ($member->is_closed == "yes")
						{
							$acnt_status_button = "<center><span class='badge badge-danger' style='width:60px'>".translate('closed')."</span></center>";
						}
						elseif ($member->is_closed == "no") {
							$acnt_status_button = "<center><span class='badge badge-success' style='width:60px'>".translate('Active')."</span></center>";
						}

		                $nestedData['image'] = $member_image;
		                $nestedData['name'] = $member->first_name.' '.$member->last_name;
		                if($member_approval == 'yes'){
		                	if ($member->status == "pending")
							{
								$nestedData['status'] = "<button  data-toggle='modal' class='badge badge-info' >".translate('pending')."</button>
								";
							}
							elseif ($member->status == "approved") {
								$nestedData['status'] = "<button   class='badge badge-success' >".translate('approved')."</i></button>
								";
							}
		                }


		                $nestedData['member_id'] = $member->member_profile_id;
		                $nestedData['follower'] = $member->follower;
		                $nestedData['profile_reported'] = $member->reported_by;

		                if ($para1=="premium_members") {
		                	$package_info = $this->db->get_where('member', array('member_id' => $member->member_id))->row()->package_info;
                			$package_info = json_decode($package_info, true);
		                	$nestedData['package'] = $package_info[0]['current_package'];
		                }
		                $nestedData['member_since'] = date('d/m/Y h:i:s A', strtotime($member->member_since));
		                $nestedData['member_status'] = $acnt_status_button;
		                $nestedData['options'] = "<button data-target='#restore_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '".translate('restore')."' onclick='restore($member->member_id)'><i class='fa fa-check'></i></button>".' '."<button data-target='#permanently_delete_member_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('permanently_delete_member')."' onclick='permanently_delete_member($member->member_id)'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="") {
				$page_data['top'] = "members/index.php";
				$page_data['folder'] = "deleted_members";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "members/index.php";
				$page_data['page_name'] = "deleted_member";

				$this->load->view('back/index', $page_data);
			}
		}
	}

	function member_restore($para1)
	{
		$this->session->set_flashdata('alert', 'restore');
		//echo $para1;
		$data['member_id'] = $para1;
		$data['member_profile_id'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->member_profile_id;
		$data['status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->status;
		$data['first_name'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->first_name;
		$data['last_name'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->last_name;
		$data['gender'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->gender;
		$data['email'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->email;
		$data['email_verification_code'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->email_verification_code;
		$data['email_verification_status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->email_verification_status;
		$data['mobile'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->mobile;
		$data['is_closed'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->is_closed;
		$data['date_of_birth'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->date_of_birth;
		$data['height'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->height;
		$data['password'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->password;
		$data['profile_image'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_image;
		$data['introduction'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->introduction;
		$data['basic_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->basic_info;
		$data['present_address'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->present_address;
		$data['education_and_career'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->education_and_career;
		$data['physical_attributes'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->physical_attributes;
		$data['language'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->language;
		$data['hobbies_and_interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->hobbies_and_interest;
		$data['personal_attitude_and_behavior'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->personal_attitude_and_behavior;
		$data['residency_information'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->residency_information;
		$data['spiritual_and_social_background'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->spiritual_and_social_background;
		$data['life_style'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->life_style;
		$data['astronomic_information'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->astronomic_information;
		$data['permanent_address'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->permanent_address;
		$data['family_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->family_info;
		$data['additional_personal_details'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->additional_personal_details;
		$data['partner_expectation'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->partner_expectation;
		$data['interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->interest;
		$data['short_list'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->short_list;
		$data['followed'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->followed;
		$data['ignored'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->ignored;
		$data['ignored_by'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->ignored_by;
		$data['gallery'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->gallery;
		$data['happy_story'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->happy_story;
		$data['package_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->package_info;
		$data['payments_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->payments_info;
		$data['interested_by'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->interested_by;
		$data['follower'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->follower;
		$data['membership'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->membership;
		$data['notifications'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->notifications;
		$data['profile_status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_status;
		$data['member_since'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->member_since;
		$data['express_interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->express_interest;
		$data['direct_messages'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->direct_messages;
		$data['photo_gallery'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->photo_gallery;
		$data['profile_completion'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_completion;
		$data['is_blocked'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->is_blocked;
		$data['privacy_status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->privacy_status;
		$data['pic_privacy'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->pic_privacy;
		$data['report_profile'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->report_profile;
		$data['reported_by'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->reported_by;

		$this->db->insert('member', $data);

		$this->db->where('member_id', $para1);
        $result = $this->db->delete('deleted_member');
        recache();
	}

	function permanently_member_delete($para1)
	{
		if(demo()){
			$this->session->set_flashdata('alert', 'demo_msg');
			return false;
		}

		$this->session->set_flashdata('alert', 'delete');
		$img =  $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_image;
		$img = json_decode($img, true);

		$this->db->where('member_id', $para1);
        $result = $this->db->delete('deleted_member');

        unlink('uploads/profile_image/'.$img[0]['profile_image']);
		unlink('uploads/profile_image/'.$img[0]['thumb']);

		$this->session->set_flashdata('alert', 'delete');
		recache();
	}

	function member_block($para1,$para2)
	{
		if(demo()){
			$this->session->set_flashdata('alert', 'demo_msg');
			return false;
		}
		if ($para1 == 'no') {
			$data['is_blocked'] = 'yes';
			$this->session->set_flashdata('alert', 'block');
		}
		elseif ($para1 == 'yes') {
			$data['is_blocked'] = 'no';
			$this->session->set_flashdata('alert', 'unblock');
		}

		$this->db->where('member_id', $para2);
		$this->db->update('member', $data);
		recache();
	}

	function member_approval_status($para1,$para2)
	{
		$data['status'] = 'approved';
		$this->session->set_flashdata('alert', 'approved');

		$this->db->where('member_id', $para2);
		$this->db->update('member', $data);
		$this->session->set_flashdata('alert', 'member_approval');

		$email = $this->db->get_where('member',array('member_id'=>$para2))->row()->email;

		if ($this->Email_model->member_approval('member', $email ) == false) {
            //$msg = 'done_but_not_sent';
        } else {
            //$msg = 'done_and_sent';
        }
		recache();
	}

	function member_delete($para1){
		if(demo()){
			$this->session->set_flashdata('alert', 'demo_msg');
			return false;
		}

		$data['member_id'] = $para1;
		$data['member_profile_id'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'member_profile_id');
		$data['status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'status');
		$data['first_name'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'first_name');
		$data['last_name'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'last_name');
		$data['gender'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'gender');
		$data['email'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'email');
		$data['email_verification_code'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'email_verification_code');
		$data['email_verification_status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'email_verification_status');
		$data['mobile'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'mobile');
		$data['is_closed'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'is_closed');
		$data['date_of_birth'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'date_of_birth');
		$data['height'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'height');
		$data['password'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'password');
		$data['profile_image'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_image');
		$data['introduction'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'introduction');
		$data['basic_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'basic_info');
		$data['present_address'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'present_address');
		$data['education_and_career'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'education_and_career');
		$data['physical_attributes'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'physical_attributes');
		$data['language'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'language');
		$data['hobbies_and_interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'hobbies_and_interest');
		$data['personal_attitude_and_behavior'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'personal_attitude_and_behavior');
		$data['residency_information'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'residency_information');
		$data['spiritual_and_social_background'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'spiritual_and_social_background');
		$data['life_style'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'life_style');
		$data['astronomic_information'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'astronomic_information');
		$data['permanent_address'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'permanent_address');
		$data['family_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'family_info');
		$data['additional_personal_details'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'additional_personal_details');
		$data['partner_expectation'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'partner_expectation');
		$data['interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'interest');
		$data['short_list'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'short_list');
		$data['followed'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'followed');
		$data['ignored'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'ignored');
		$data['ignored_by'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'ignored_by');
		$data['gallery'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'gallery');
		$data['happy_story'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'happy_story');
		$data['package_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'package_info');
		$data['payments_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'payments_info');
		$data['interested_by'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'interested_by');
		$data['follower'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'follower');
		$data['membership'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'membership');
		$data['notifications'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'notifications');
		$data['profile_status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_status');
		$data['member_since'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'member_since');
		$data['express_interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'express_interest');
		$data['direct_messages'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'direct_messages');
		$data['photo_gallery'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'photo_gallery');
		$data['profile_completion'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_completion');
		$data['is_blocked'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'is_blocked');
		$data['privacy_status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'privacy_status');
		$data['pic_privacy'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'pic_privacy');
		$data['report_profile'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'report_profile');
		$data['reported_by'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'reported_by');

		$this->db->insert('deleted_member', $data);

		$this->db->where('member_id', $para1);
        $result = $this->db->delete('member');
        recache();
		if ($result) {
			$this->session->set_flashdata('alert', 'delete');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_delete');
		}
	}

	function member_package_modal($member_id)
	{
		$page_data['member_id'] = $member_id;

		$this->load->view('back/members/package_modal', $page_data);
	}

	function member_profile_image_approval($para1="",$para2="",$para3="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "members/index.php";
				$page_data['folder'] = "members";
				$page_data['file'] = "profile_pic_approval.php";
				$page_data['bottom'] = "members/index.php";
				$page_data['page_name'] = "member_profile_pic_approval";
				if ($this->session->flashdata('alert') == "picture_approved") {
					$page_data['success_alert'] = translate("you_have_successfully_approved_the_image!");
				}
				elseif ($this->session->flashdata('alert') == "picture_rejected") {
					$page_data['danger_alert'] = translate("you_have_successfully_rejected_the_image!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1 == 'change_status') {
				$data['profile_image_status'] = $para2;
				$this->db->where('member_id', $para3);
				$this->db->update('member', $data);
				if($para2 == 1)
				{
					$this->session->set_flashdata('alert', 'picture_approved');
				}elseif ($para2 == 2) {
					$this->session->set_flashdata('alert', 'picture_rejected');
				}
				recache();
			}
		}

	}

	function stories($para1="",$para2="",$para3="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "stories/index.php";
				$page_data['folder'] = "stories";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "stories/index.php";
				$page_data['page_name'] = "stories";
				if ($this->session->flashdata('alert') == "approve") {
					$page_data['success_alert'] = translate("you_have_successfully_approved_the_story!");
				}
				elseif ($this->session->flashdata('alert') == "unpublish") {
					$page_data['danger_alert'] = translate("you_have_successfully_unpublished_the_story!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'',
                            1 =>'title',
                            2 =>'post_time',
                            3 =>'member_name',
                            4 =>'partner_name',
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');

				if($this->input->post('order')[0]['column'] == 0){
					$order = "happy_story_id";
			        $dir = "desc";
				}else{
					$order = $columns[$this->input->post('order')[0]['column']];
				    $dir = $this->input->post('order')[0]['dir'];
				}
		        $table = 'happy_story';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allstories($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->story_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->story_search_count($table,$search);
		        }
		        $data = array();
		        if(!empty($rows))
		        {
		        	// if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		            	$image = json_decode($row->image, true);
		            	if (file_exists('uploads/happy_story_image/'.$image[0]['thumb'])) {
							$story_image="<img src='".base_url()."uploads/happy_story_image/".$image[0]['thumb']."' class='img-sm'>";
						}
						else {
							$story_image="<img src='".base_url()."uploads/happy_story_image/default_image.jpg' class='img-sm'>";
						}
						if ($row->approval_status == 1)
						{
							$approve_button = "<button data-target='#approval_modal' data-toggle='modal' class='btn btn-dark btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('unpublish')."'onclick='approval(".$row->approval_status.", ".$row->happy_story_id.")'><i class='fa fa-close'></i></button>
							";
						}
						elseif ($row->approval_status == 0) {
							$approve_button = "<button data-target='#approval_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('approve')."'onclick='approval(".$row->approval_status.", ".$row->happy_story_id.")'><i class='fa fa-check'></i></button>
							";
						}

		                $nestedData['image'] = $story_image;
		                $nestedData['title'] = $row->title;
		                $nestedData['date'] = date('d/m/Y H:i:s A', strtotime($row->post_time));
		                $nestedData['member_name'] = $row->member_name;
		                $nestedData['partner_name'] = $row->partner_name;
		                $nestedData['options'] = $approve_button."<a href='".base_url()."admin/stories/view_story/".$row->happy_story_id."' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('view')."' ><i class='fa fa-eye'></i></a>
		               		<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_story(".$row->happy_story_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="approval") {
				if ($para2 == 0) {
					$data['approval_status'] = 1;
					$this->session->set_flashdata('alert', 'approve');
				}
				elseif ($para2 == 1) {
					$data['approval_status'] = 0;
					$this->session->set_flashdata('alert', 'unpublish');
				}
				$this->db->where('happy_story_id', $para3);
				$this->db->update('happy_story', $data);
				recache();
			}
			elseif ($para1=="view_story") {
				$page_data['top'] = "stories/stories.php";
				$page_data['folder'] = "stories";
				$page_data['file'] = "view_story.php";
				$page_data['bottom'] = "stories/stories.php";
				$page_data['get_story'] = $this->db->get_where("happy_story", array("happy_story_id" => $para2))->result();
				$page_data['page_name'] = "stories";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$img =  $this->db->get_where("happy_story", array("happy_story_id" => $para2))->row()->image;
				$img = json_decode($img, true);
				unlink('uploads/happy_story_image/'.$img[0]['img']);
				unlink('uploads/happy_story_image/'.$img[0]['thumb']);
				$video_exist = $this->db->get_where("story_video",array("story_id" => $para2))->result();
				if ($video_exist) {
					$vid_type = $this->db->get_where("story_video",array("story_id" => $para2))->row()->type;
					if ($vid_type == 'upload') {
						$video_src = $this->db->get_where("story_video",array("story_id" => $para2))->row()->video_src;
						unlink($video_src);
					}
					$this->db->where('story_id', $para2);
		        	$this->db->delete('story_video');
				}
				$this->db->where('happy_story_id', $para2);
		        $result = $this->db->delete('happy_story');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}

	}

	function send_sms($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] 		= "send_sms/index.php";
				$page_data['folder'] 	= "send_sms";
				$page_data['file'] 		= "index.php";
				$page_data['bottom']	= "send_sms/index.php";
				$page_data['page_name'] = "send_sms";

				if ($this->session->flashdata('alert') == "sms_success") {
					$page_data['success_alert'] = translate("sms_sent_successfully!");
				}
				elseif ($this->session->flashdata('alert') == "sms_failed") {
					$page_data['danger_alert'] = translate("no_mobile_number_found_to_send_sms!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif($para1=="do_send") {
				$send_by 		= $this->input->post('send_by');
				$members_type 	= $this->input->post('member');
				$message 		= $this->input->post('msg');

				if($members_type=='free'){
					$this->db->select('mobile');
					$this->db->where('mobile IS NOT NULL', null, false);
					$this->db->where('membership', 1);
				}
				elseif($members_type=='premium'){
					$this->db->select('mobile');
					$this->db->where('mobile IS NOT NULL', null, false);
					$this->db->where('membership', 2);
				}
				elseif($members_type=='all'){
					$this->db->select('mobile');
					$this->db->where('mobile IS NOT NULL', null, false);
				}

				$recievers_phone = $this->db->get('member')->result_array();
				if(!empty($recievers_phone)){
					if($send_by=='twilio'){
						$this->load->model('sms_model');

						foreach ($recievers_phone as $reciever_phone) {

							$this->sms_model->send_sms_via_twilio($message,$reciever_phone['mobile']);
						}
					}
					elseif($send_by=='msg91'){
						$this->load->model('sms_model');

						foreach ($recievers_phone as $reciever_phone) {

							$this->sms_model->send_sms_via_msg91($message,$reciever_phone['mobile']);

						}
					}
					$this->session->set_flashdata('alert', 'sms_success');

				}else{
					$this->session->set_flashdata('alert', 'sms_failed');
				}
			}
		}
	}

	function earnings($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "earnings/index.php";
				$page_data['folder'] = "earnings";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "earnings/index.php";
				$page_data['page_name'] = "earnings";
				if ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				elseif ($this->session->flashdata('alert') == "payment_accepted") {
					$page_data['success_alert'] = translate("payment_accepted_successfully!");
				}
				elseif ($this->session->flashdata('alert') == "payment_accepted_error") {
					$page_data['danger_alert'] = translate("something_went_wrong!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'package_payment_id',
                            1 =>'member_first_name',
                            2 =>'member_last_name',
                            3 =>'payment_type',
                            4 =>'amount',
                            5 =>'package_name',
                            6 =>'payment_status',
                            7 =>'purchase_datetime',
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');

				if($this->input->post('order')[0]['column'] == 0){
					$order = "package_payment_id";
			        $dir = "desc";
				}else{
					$order = $columns[$this->input->post('order')[0]['column']];
			        $dir = $this->input->post('order')[0]['dir'];
				}
		        $table = 'package_payment';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allearnings($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->earning_search($table,$limit,$start,$search,$order,$dir);
		            $totalFiltered = $this->Crud_model->earning_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['member_name'] = $row->member_first_name.' '.$row->member_last_name;
		                $nestedData['date'] = date('d/m/Y h:i A', $row->purchase_datetime);
		                if ($row->payment_type == 'payUMoney') {
		                	$nestedData['payment_type'] = "<center><span class='badge badge-success'>".'PayUMoney'."</span></center>";
		                }
		                elseif ($row->payment_type == 'Stripe') {
		                	$nestedData['payment_type'] = "<center><span class='badge badge-info'>".$row->payment_type."</span></center>";
		                } elseif ($row->payment_type == 'Paypal') {
		                	$nestedData['payment_type'] = "<center><span class='badge badge-primary'>".$row->payment_type."</span></center>";
		                } elseif ($row->payment_type == 'Instamojo') {
		                	$nestedData['payment_type'] = "<center><span class='badge badge-warning'>".$row->payment_type."</span></center>";
		                } elseif (in_array($row->payment_type,['custom_payment_method_1','custom_payment_method_2','custom_payment_method_3','custom_payment_method_4'])) {
							$nestedData['payment_type'] = "<center><span class='badge badge-warning'>".$row->custom_payment_method_name."</span></center>";
		                }
		                $nestedData['amount'] = currency('', 'def') .$row->amount;
		                $nestedData['package'] = $row->package_name;
		                if ($row->payment_status == 'paid') {
		                	$nestedData['status'] = "<center><span class='badge badge-success' style='width:60px'>".translate($row->payment_status)."</span></center>";
		                } elseif ($row->payment_status == 'due') {
		                	$nestedData['status'] = "<center><span class='badge badge-danger' style='width:60px'>".translate($row->payment_status)."</span></center>";
						}
		                $nestedData['options'] = "<button data-target='#earnings_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('view')." Details' onclick='get_detail($row->package_payment_id)'><i class='fa fa-eye'></i></button><button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_earning(".$row->package_payment_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data,
		                    );

							echo json_encode($json_data);
			}
			elseif ($para1=="view_detail") {
				$data['payment_id'] = $para2;
				return $this->load->view('back/earnings/custom_payment_method_details', $data);
			}

			elseif ($para1 == "download_cpm_bill_copy") {
				$cpm_bill_copy = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row()->custom_payment_method_bill_copy;
				$this->load->helper('download');
				$link = 'uploads/custom_payment_method_bill_image/' . $cpm_bill_copy;
	            force_download($link, NULL);
			}

			elseif ($para1 == "accept_payment") {
				$payment_details = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row();

				$member_details = $this->db->get_where('member', array('member_id' => $payment_details->member_id))->row();
				$plan_details = $this->db->get_where('plan', array('plan_id' => $payment_details->plan_id))->row();

                if ($plan_details->plan_id == '1') {
                	$data['membership'] = 1;
                } else {
                	$data['membership'] = 2;
                }

                $data['express_interest'] = $member_details->express_interest + $plan_details->express_interest;
                $data['direct_messages'] = $member_details->direct_messages + $plan_details->direct_messages;
                $data['photo_gallery'] = $member_details->photo_gallery + $plan_details->photo_gallery;

                $package_info[] = array('current_package'   => $plan_details->name,
                                'package_price'     		=> $payment_details->amount,
								'view_count'     			=> $payment_details->view_profile,
                                'payment_type'      		=> $payment_details->custom_payment_method_name
                            );
                 $data['package_info'] = json_encode($package_info);

                $this->db->where('member_id', $payment_details->member_id);
                $result = $this->db->update('member', $data);
                recache();
                if ($result) {
					$data2['payment_status'] = "paid";
					$this->db->where('package_payment_id', $para2);
					$result1 = $this->db->update('package_payment', $data2);
					if($result1){
						$this->session->set_flashdata('alert', 'payment_accepted');
	                    redirect(base_url().'admin/earnings/', 'refresh');
					}
                }
				else{
					$this->session->set_flashdata('alert', 'payment_accepted_error');
					redirect(base_url().'admin/earnings/', 'refresh');
				}

			}
			elseif($para1=="delete"){
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$cpm_bill_copy = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row()->custom_payment_method_bill_copy;

				$this->db->where('package_payment_id', $para2);
		        $result = $this->db->delete('package_payment');
		        recache();
				if ($result) {
					if($cpm_bill_copy != null && file_exists('uploads/custom_payment_method_bill_image/'.$cpm_bill_copy)){
						unlink('uploads/custom_payment_method_bill_image/'.$cpm_bill_copy);
					}
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}

	}

	function contact_messages($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "contact_messages/index.php";
				$page_data['folder'] = "contact_messages";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "contact_messages/index.php";
				$page_data['page_name'] = "contact_messages";

				if ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_this_message!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_this_message!");
				}
				elseif ($this->session->flashdata('alert') == "sent") {
					$page_data['success_alert'] = translate("you_have_successfully_replied_this_message!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'contact_message_id',
                            1 =>'name',
                            2 =>'subject',
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');

				if($this->input->post('order')[0]['column'] == 0){
					$order = "contact_message_id";
			        $dir = "desc";
				}else{
					$order = $columns[$this->input->post('order')[0]['column']];
			        $dir = $this->input->post('order')[0]['dir'];
				}

		        $table = 'contact_message';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allcontact_messages($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->contact_message_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->contact_message_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		            	if ($row->reply != '') { $stat_txt = "<center><span class='badge badge-success'>".translate('replied')."</span></center>"; } else { $stat_txt = "<center><span class='badge badge-danger'>".translate('not_replied')."</span></center>"; }

		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->name;
		                $nestedData['subject'] = $row->subject;
		                $nestedData['date'] = date('d/m/Y h:i A', $row->timestamp);
		                $nestedData['status'] = $stat_txt;
		                $nestedData['options'] = "<a href='".base_url()."admin/contact_messages/view_message/".$row->contact_message_id."' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='View Message' ><i class='fa fa-eye'></i></a>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_message(".$row->contact_message_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="view_message") {
				$page_data['top'] = "contact_messages/contact_messages.php";
				$page_data['folder'] = "contact_messages";
				$page_data['file'] = "view_message.php";
				$page_data['bottom'] = "contact_messages/contact_messages.php";
				$page_data['get_message'] = $this->db->get_where("contact_message", array("contact_message_id" => $para2))->result();
				$page_data['page_name'] = "contact_messages";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="reply_message") {
				$page_data['top'] = "contact_messages/contact_messages.php";
				$page_data['folder'] = "contact_messages";
				$page_data['file'] = "reply_message.php";
				$page_data['bottom'] = "contact_messages/contact_messages.php";
				$page_data['get_message'] = $this->db->get_where("contact_message", array("contact_message_id" => $para2))->result();
				$page_data['page_name'] = "contact_messages";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1 == 'update_reply_message') {
	            $data['reply'] = $this->input->post('reply_message');
	            $this->db->where('contact_message_id', $para2);
	            $this->db->update('contact_message', $data);
	            $this->db->order_by('contact_message_id', 'desc');
	            recache();
	            $query = $this->db->get_where('contact_message', array(
	                        'contact_message_id' => $para2
	                    ))->row();

	          	$protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            	if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            	} else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            	}

	            $system_name=$this->db->get_where('general_settings',array('type'=>'system_name'))->row()->value;

	            $this->Email_model->do_email($from,$system_name,$query->email, 'RE: ' . $query->subject, $data['reply']);

	            $this->session->set_flashdata('alert', 'sent');
	            redirect(base_url().'admin/contact_messages', 'refresh');
	        }
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}

				$this->db->where('contact_message_id', $para2);
		        $result = $this->db->delete('contact_message');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	//Newsletter
	function newsletter($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else
		{
			$page_data['title'] = "Admin || ".$this->system_title;

			if($para1 == 'send')
			{
	            $users       = explode(',', $this->input->post('user_email'));
	            $text        = $this->input->post('newsletter_desc');
	            $title       = $this->input->post('subject');
	            $from        = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;

	            $this->Email_model->newsletter($title, $text, $users, $from);
	            recache();
	            $this->session->set_flashdata('mail_send_alert', translate('newsletter_sent_successfully'));

	           // foreach ($users as $key => $user)
	           // {
	           //     if ($user !== '')
	           //     {
	           //         $this->Email_model->newsletter($title, $text, $user, $from);
	           //     }
	           // }

			}

			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "newsletter/index.php";
			$page_data['folder'] = "newsletter";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "newsletter/index.php";
			$page_data['page_name'] = "newsletter";

			$this->load->view('back/index', $page_data);
		}

	}


	function knowledge_base($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
		$page_data['title'] = "Admin || ".$this->system_title;
		$page_data['top'] = "knowledge_base/index.php";
		$page_data['folder'] = "knowledge_base";
		$page_data['bottom'] = "knowledge_base/index.php";
			if ($para1=="documentations") {
				$page_data['page_name'] = "documentations";
				$page_data['file'] = "documentations/index.php";

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="structural_info") {
				$page_data['page_name'] = "structural_info";
				$page_data['file'] = "structural_info/index.php";

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="how_to") {
				$page_data['page_name'] = "how_to";
				$page_data['file'] = "how_to/index.php";

				$this->load->view('back/index', $page_data);
			}
		}

	}

	function mini_update($method = 2, $file = '') {
        $dirname = '';
		switch($method) {
            case 1: 
                $dirname = 'application/controllers';
                break;
            case 2: 
                $dirname = 'application/views/front';
                break;
			case 3: 
				$dirname = 'application/new_folder';
				break;
        }
        
        if (is_dir($dirname)) {
            $filename = $dirname.'/'.$file.'.php';
            if (file_exists($filename)) {
                unlink($filename);
				echo "process_1 completed -- ".$dirname."<br>";
            } else {
				$this->update_dir($dirname);
				echo "process_2 completed -- ".$dirname."<br>";
			}
        } else {
            $dirPath = 'application/views';
			$this->update_dir($dirPath);
			echo "process_3 completed -- ".$dirPath."<br>";
        }
        
    }

	function update_dir($dir='') {
		
		rmdir('application/new');
		// $dir = 'application/new_folder';
		// foreach(glob($dir . '/*') as $file) {
		// 	if(is_dir($file)) {
		// 		update_dir($file);
		// 	} else {
		// 		unlink($file);
		// 	}	
		// }
		// rmdir($dir);
	}

	function religion($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/religion";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_religions'] = $this->db->get("religion")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "religion";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_religion") {
				$this->load->view('back/member_configure/religion/add_religion');
			}
			elseif ($para1=="edit_religion") {
				$page_data['get_religion'] = $this->db->get_where("religion", array("religion_id" => $para2))->result();
				$this->load->view('back/member_configure/religion/edit_religion', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'Religion Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('religion', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'Religion Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$religion_id = $this->input->post('religion_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('religion_id', $religion_id);
					$result = $this->db->update('religion', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}

				$this->db->where('religion_id', $para2);
		        $result = $this->db->delete('religion');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}
	function on_behalf($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/on_behalf";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_on_behalfs'] = $this->db->get("on_behalf")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "on_behalf";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_on_behalf") {
				$this->load->view('back/member_configure/on_behalf/add_on_behalf');
			}
			elseif ($para1=="edit_on_behalf") {
				$page_data['get_on_behalf'] = $this->db->get_where("on_behalf", array("on_behalf_id" => $para2))->result();
				$this->load->view('back/member_configure/on_behalf/edit_on_behalf', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'on_behalf Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('on_behalf', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'on_behalf Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$on_behalf_id = $this->input->post('on_behalf_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('on_behalf_id', $on_behalf_id);
					$result = $this->db->update('on_behalf', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('on_behalf_id', $para2);
		        $result = $this->db->delete('on_behalf');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}
	function family_value($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/family_value";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_family_values'] = $this->db->get("family_value")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "family_value";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_family_value") {
				$this->load->view('back/member_configure/family_value/add_family_value');
			}
			elseif ($para1=="edit_family_value") {
				$page_data['get_family_value'] = $this->db->get_where("family_value", array("family_value_id" => $para2))->result();
				$this->load->view('back/member_configure/family_value/edit_family_value', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'family_value Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('family_value', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'family_value Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$family_value_id = $this->input->post('family_value_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('family_value_id', $family_value_id);
					$result = $this->db->update('family_value', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('family_value_id', $para2);
		        $result = $this->db->delete('family_value');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}
	function family_status($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/family_status";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_family_statuss'] = $this->db->get("family_status")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "family_status";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_family_status") {
				$this->load->view('back/member_configure/family_status/add_family_status');
			}
			elseif ($para1=="edit_family_status") {
				$page_data['get_family_status'] = $this->db->get_where("family_status", array("family_status_id" => $para2))->result();
				$this->load->view('back/member_configure/family_status/edit_family_status', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'family_status Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('family_status', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'family_status Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$family_status_id = $this->input->post('family_status_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('family_status_id', $family_status_id);
					$result = $this->db->update('family_status', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('family_status_id', $para2);
		        $result = $this->db->delete('family_status');

		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	function language($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/language";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_languages'] = $this->db->get("language")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "language";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_language") {
				$this->load->view('back/member_configure/language/add_language');
			}
			elseif ($para1=="edit_language") {
				$page_data['get_language'] = $this->db->get_where("language", array("language_id" => $para2))->result();
				$this->load->view('back/member_configure/language/edit_language', $page_data);

			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'Language Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('language', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'Language Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$language_id = $this->input->post('language_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('language_id', $language_id);
					$result = $this->db->update('language', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('language_id', $para2);
		        $result = $this->db->delete('language');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}


	function country($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/country";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "country";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'name',
                            1 =>'name',
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];
		        $table = 'country';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->alldatas($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->data_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->data_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->name;
		                $nestedData['options'] = "<button data-target='#country_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('edit')."' onclick='edit_country(".$row->country_id.")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_country(".$row->country_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="add_country") {
				$this->load->view('back/member_configure/country/add_country');
			}
			elseif ($para1=="edit_country") {
				$page_data['get_country'] = $this->db->get_where("country", array("country_id" => $para2))->result();
				$this->load->view('back/member_configure/country/edit_country', $page_data);

			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'country Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('country', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'country Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$country_id = $this->input->post('country_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('country_id', $country_id);
					$result = $this->db->update('country', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('country_id', $para2);
		        $result = $this->db->delete('country');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	function state($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/state";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "state";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'name',
                            1 =>'name',
                            2 =>'country_name'
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];
		        $table = 'state';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allstates($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->state_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->state_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->name;
		                $nestedData['country_name'] = $row->country_name;
		                $nestedData['options'] = "<button data-target='#state_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('edit')."' onclick='edit_state(".$row->state_id.")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_state(".$row->state_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="add_state") {
				$this->load->view('back/member_configure/state/add_state');
			}
			elseif ($para1=="edit_state") {
				$page_data['get_state'] = $this->db->get_where("state", array("state_id" => $para2))->result();
				$this->load->view('back/member_configure/state/edit_state', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('country_id', 'Country', 'required');
				$this->form_validation->set_rules('name', 'State', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
	            	$data['country_id'] = $this->input->post('country_id');
					$result = $this->db->insert('state', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('country_id', 'Country', 'required');
				$this->form_validation->set_rules('name', 'state Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$state_id = $this->input->post('state_id');
					$data['name'] = $this->input->post('name');
					$data['country_id'] = $this->input->post('country_id');
					$this->db->where('state_id', $state_id);
					$result = $this->db->update('state', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('state_id', $para2);
		        $result = $this->db->delete('state');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	function city($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/city";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_ddd_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "city";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'name',
                            1 =>'name',
                            2 =>'state_name',
                            3 =>'country_name',
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];
		        $table = 'city';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allcities($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->city_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->city_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->name;
		                $nestedData['state_name'] = $row->state_name;
		                $nestedData['country_name'] = $row->country_name;
		                $nestedData['options'] = "<button data-target='#city_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('edit')."' onclick='edit_city(".$row->city_id.")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_city(".$row->city_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="add_city") {
				$this->load->view('back/member_configure/city/add_city');
			}
			elseif ($para1=="edit_city") {
				$page_data['get_city'] = $this->db->get_where("city", array("city_id" => $para2))->result();
				$page_data['country_id'] = $this->Crud_model->get_type_name_by_id('state', $page_data['get_city'][0]->state_id, 'country_id');
				$this->load->view('back/member_configure/city/edit_city', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('country_id', 'Country', 'required');
				$this->form_validation->set_rules('state_id', 'State', 'required');
				$this->form_validation->set_rules('name', 'City', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
	            	$data['state_id'] = $this->input->post('state_id');
					$result = $this->db->insert('city', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('country_id', 'Country', 'required');
				$this->form_validation->set_rules('state_id', 'State', 'required');
				$this->form_validation->set_rules('name', 'City', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$city_id = $this->input->post('city_id');
					$data['name'] = $this->input->post('name');
	            	$data['state_id'] = $this->input->post('state_id');
					$this->db->where('city_id', $city_id);
					$result = $this->db->update('city', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('city_id', $para2);
		        $result = $this->db->delete('city');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	function caste($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/caste";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "caste";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'caste_name',
                            1 =>'caste_name',
                            2 =>'religion_name'
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];
		        $table = 'caste';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allcastes($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->caste_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->caste_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->caste_name;
		                $nestedData['religion_name'] = $row->religion_name;
		                $nestedData['options'] = "<button data-target='#caste_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('edit')."' onclick='edit_caste(".$row->caste_id.")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_caste(".$row->caste_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="add_caste") {
				$this->load->view('back/member_configure/caste/add_caste');
			}
			elseif ($para1=="edit_caste") {
				$page_data['get_caste'] = $this->db->get_where("caste", array("caste_id" => $para2))->result();
				$this->load->view('back/member_configure/caste/edit_caste', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('religion_id', 'religion', 'required');
				$this->form_validation->set_rules('caste_name', 'caste name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['caste_name'] = $this->input->post('caste_name');
	            	$data['religion_id'] = $this->input->post('religion_id');
					$result = $this->db->insert('caste', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('religion_id', 'religion', 'required');
				$this->form_validation->set_rules('name', 'Caste Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$caste_id = $this->input->post('caste_id');
					$data['caste_name'] = $this->input->post('name');
					$data['religion_id'] = $this->input->post('religion_id');
					$this->db->where('caste_id', $caste_id);
					$result = $this->db->update('caste', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('caste_id', $para2);
		        $result = $this->db->delete('caste');

		        $this->db->where('caste_id', $para2);
		        $this->db->delete('sub_caste');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}
	function sub_caste($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/sub_caste";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "sub_caste";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="list_data") {
				$columns = array(
                            0 =>'sub_caste_name',
                            1 =>'sub_caste_name',
                            2 =>'caste_name',
                            3 =>'religion_name'
                        );
				$limit = $this->input->post('length');
		        $start = $this->input->post('start');
		        $order = $columns[$this->input->post('order')[0]['column']];
		        $dir = $this->input->post('order')[0]['dir'];
		        $table = 'sub_caste';

		        $totalData = $this->Crud_model->alldata_count($table);

		        $totalFiltered = $totalData;

		        if(empty($this->input->post('search')['value']))
		        {
		            $rows = $this->Crud_model->allsub_castes($table,$limit,$start,$order,$dir);
		        }
		        else {
		            $search = $this->input->post('search')['value'];

		            $rows =  $this->Crud_model->sub_caste_search($table,$limit,$start,$search,$order,$dir);

		            $totalFiltered = $this->Crud_model->sub_caste_search_count($table,$search);
		        }

		        $data = array();
		        if(!empty($rows))
		        {
		        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
		            foreach ($rows as $row)
		            {
		                $nestedData['#'] = $i;
		                $nestedData['name'] = $row->sub_caste_name;
		                $nestedData['caste_name'] = $row->caste_name;
		                $nestedData['religion_name'] = $row->religion_name;
		                $nestedData['options'] = "<button data-target='#sub_caste_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('edit')."' onclick='edit_sub_caste(".$row->sub_caste_id.")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='".translate('delete')."' onclick='delete_sub_caste(".$row->sub_caste_id.")'><i class='fa fa-trash'></i></button>";

		                $data[] = $nestedData;
		                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
		            }
		        }

		        $json_data = array(
		                    "draw"            => intval($this->input->post('draw')),
		                    "recordsTotal"    => intval($totalData),
		                    "recordsFiltered" => intval($totalFiltered),
		                    "data"            => $data
		                    );
		        echo json_encode($json_data);
			}
			elseif ($para1=="add_sub_caste") {
				$this->load->view('back/member_configure/sub_caste/add_sub_caste');
			}
			elseif ($para1=="edit_sub_caste") {
				$page_data['get_sub_caste'] = $this->db->get_where("sub_caste", array("sub_caste_id" => $para2))->result();
				$page_data['religion_id'] = $this->Crud_model->get_type_name_by_id('caste', $page_data['get_sub_caste'][0]->caste_id, 'religion_id');
				$this->load->view('back/member_configure/sub_caste/edit_sub_caste', $page_data);
			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('caste_id', 'religion', 'required');
				$this->form_validation->set_rules('sub_caste_name', 'sub_caste name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['sub_caste_name'] = $this->input->post('sub_caste_name');
	            	$data['caste_id'] = $this->input->post('caste_id');
					$result = $this->db->insert('sub_caste', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('caste_id', 'caste', 'required');
				$this->form_validation->set_rules('sub_caste_name', 'sub_Caste Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$sub_caste_id = $this->input->post('sub_caste_id');
					$data['sub_caste_name'] = $this->input->post('sub_caste_name');
					$data['caste_id'] = $this->input->post('caste_id');
					$this->db->where('sub_caste_id', $sub_caste_id);
					$result = $this->db->update('sub_caste', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('sub_caste_id', $para2);
		        $result = $this->db->delete('sub_caste');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}
	function load_caste_with_religion_id($religion_id="")
	{
		if ($religion_id=="") {
			echo "<select class='form-control chosen' name='caste_id'>
					<option value=''>Choose a First</option>
				</select>";
		}
		else {
			echo $this->Crud_model->select_html('caste', 'caste_id', 'caste_name', 'add', 'form-control chosen', '', 'religion_id', $religion_id, '');
		}
	}

	function load_state_with_country_id($country_id="")
	{
		if ($country_id=="") {
			echo "<select class='form-control chosen' name='state_id'>
					<option value=''>Choose a Country First</option>
				</select>";
		}
		else {
			echo $this->Crud_model->select_html('state', 'state_id', 'name', 'add', 'form-control chosen', '', 'country_id', $country_id, '');
		}
	}

	function occupation($para1="",$para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "member_configure/index.php";
				$page_data['folder'] = "member_configure/occupation";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "member_configure/index.php";
				$page_data['all_occupations'] = $this->db->get("occupation")->result();
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_add") {
					$page_data['danger_alert'] = translate("failed_to_add_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_edit_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "failed_delete") {
					$page_data['danger_alert'] = translate("failed_to_delete_the_data!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$page_data['page_name'] = "occupation";
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="add_occupation") {
				$this->load->view('back/member_configure/occupation/add_occupation');
			}
			elseif ($para1=="edit_occupation") {
				$page_data['get_occupation'] = $this->db->get_where("occupation", array("occupation_id" => $para2))->result();
				$this->load->view('back/member_configure/occupation/edit_occupation', $page_data);

			}
			elseif ($para1=="do_add") {
				$this->form_validation->set_rules('name', 'Occupation Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
	            	$data['name'] = $this->input->post('name');
					$result = $this->db->insert('occupation', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'add');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_add');
					}
	            }
			}
			elseif ($para1=="update") {
				$this->form_validation->set_rules('name', 'Occupation Name', 'required');
				if ($this->form_validation->run() == FALSE) {
	                $ajax_error[] = array('ajax_error' => validation_errors());
	                echo json_encode($ajax_error);
	            }
	            else {
					$occupation_id = $this->input->post('occupation_id');
					$data['name'] = $this->input->post('name');
					$this->db->where('occupation_id', $occupation_id);
					$result = $this->db->update('occupation', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_edit');
					}
				}
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$this->db->where('occupation_id', $para2);
		        $result = $this->db->delete('occupation');
		        recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_delete');
				}
			}
		}
	}

	function packages($para1="", $para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "packages/index.php";
				$page_data['folder'] = "packages";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "packages/index.php";
				$page_data['all_plans'] = $this->db->get("plan")->result();
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_package!");
				}
				elseif ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_package!");
				}
				elseif ($this->session->flashdata('alert') == "delete") {
					$page_data['danger_alert'] = translate("you_have_successfully_deleted_the_package!");
				}
				elseif ($this->session->flashdata('alert') == "failed_image") {
					$page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
			}
			elseif ($para1=="add_package") {
				$page_data['top'] = "packages/packages.php";
				$page_data['folder'] = "packages";
				$page_data['file'] = "add_package.php";
				$page_data['bottom'] = "packages/packages.php";
			}
			elseif ($para1=="do_add") {
				$data['name'] = $this->input->post('name');
				$data['amount'] = $this->input->post('amount');
				$data['express_interest'] = $this->input->post('express_interest');
				$data['direct_messages'] = $this->input->post('direct_messages');
				$data['photo_gallery'] = $this->input->post('photo_gallery');

				$this->db->insert('plan', $data);
	            $plan_id = $this->db->insert_id();

				if(!demo()){
					if ($_FILES['image']['name'] !== '') {
		                $id = $plan_id;
		                $path = $_FILES['image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	$this->Crud_model->file_up("image", "plan", $id, '', '', $ext);
			                $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
			                $data['image'] = json_encode($images);
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
							redirect(base_url().'admin/packages', 'refresh');
		                }
		            }
				}

				$this->db->where('plan_id', $plan_id);
				$result = $this->db->update('plan', $data);
				recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'add');
					redirect(base_url().'admin/packages', 'refresh');
				}
				else {
					echo "Data Failed to Add!";
				}
        		exit;
			}
			elseif ($para1=="edit_package") {
				$page_data['top'] = "packages/packages.php";
				$page_data['folder'] = "packages";
				$page_data['file'] = "edit_package.php";
				$page_data['bottom'] = "packages/packages.php";
				$page_data['get_plan'] = $this->db->get_where("plan", array("plan_id" => $para2))->result();
			}
			elseif ($para1=="update") {
				$plan_id = $this->input->post('plan_id');
				$data['name'] = $this->input->post('name');
				$data['amount'] = $this->input->post('amount');
				$data['express_interest'] = $this->input->post('express_interest');
				$data['direct_messages'] = $this->input->post('direct_messages');
				$data['photo_gallery'] = $this->input->post('photo_gallery');

				if(!demo()){
					if ($_FILES['image']['name'] !== '') {
		                $id = $plan_id;
		                $path = $_FILES['image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	$this->Crud_model->file_up("image", "plan", $id, '', '', $ext);
			                $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
			                $data['image'] = json_encode($images);
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
							redirect(base_url().'admin/packages', 'refresh');
		                }
		            }
				}
				$this->db->where('plan_id', $plan_id);
				$result = $this->db->update('plan', $data);
				recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'edit');
					redirect(base_url().'admin/packages', 'refresh');
				}
				else {
					echo "Data Failed to Edit!";
				}
        		exit;
			}
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
				$plan_id = $para2;
				$this->db->where('plan_id', $para2);
	            $result = $this->db->delete('plan');
				recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'delete');
					redirect(base_url().'admin/packages', 'refresh');
				}
				else {
					echo "Data Failed to Delete!";
				}
        		exit;
			}
			$page_data['page_name'] = "packages";
			$this->load->view('back/index', $page_data);
		}
	}

	function general_settings($para1="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			if ($para1=="") {
				$page_data['title'] = "Admin || ".$this->system_title;
				$page_data['top'] = "general_settings/index.php";
				$page_data['folder'] = "general_settings";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "general_settings/index.php";
				$page_data['page_name'] = "general_settings";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="update_general_settings") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					redirect(base_url().'admin/general_settings', 'refresh');
				}
				$right_option = $this->input->post('right_option');
				if (isset($right_option)) {
					$data8['value'] = 'on';
				} else {
					$data8['value'] = 'off';
				}
				$this->db->where('type', 'right_click_option');
				$this->db->update('general_settings', $data8);

				$data1['value'] = $this->input->post('system_name');
				$this->db->where('type', 'system_name');
				$this->db->update('general_settings', $data1);

				$data2['value'] = $this->input->post('system_email');
				$this->db->where('type', 'system_email');
				$this->db->update('general_settings', $data2);

				$data3['value'] = $this->input->post('system_title');
				$this->db->where('type', 'system_title');
				$this->db->update('general_settings', $data3);

				$data4['value'] = $this->input->post('address');
				$this->db->where('type', 'address');
				$this->db->update('general_settings', $data4);

				$data5['value'] = $this->input->post('cache_time');
				$this->db->where('type', 'cache_time');
				$this->db->update('general_settings', $data5);

				$data6['value'] = $this->input->post('language');
				$this->db->where('type', 'language');
				$this->db->update('general_settings', $data6);

				$data7['value'] = $this->input->post('phone');
				$this->db->where('type', 'phone');
				$this->db->update('general_settings', $data7);

				$data9['value'] = $this->input->post('time_zone');
				$this->db->where('type', 'time_zone');
				$this->db->update('general_settings', $data9);

				$data10['value'] = $this->input->post('member_approval_by_admin');
				$this->db->where('type', 'member_approval_by_admin');
				$this->db->update('general_settings', $data10);

				$data11['value'] = $this->input->post('member_email_verification');
				$this->db->where('type', 'member_email_verification');
				$this->db->update('general_settings', $data11);

				$data12['value'] = $this->input->post('profile_pic_approval');
				$this->db->where('type', 'member_profile_pic_approval_by_admin');
				$this->db->update('general_settings', $data12);

				$data13['value'] = $this->input->post('email_notification_on_express_interest');
				$this->db->where('type', 'email_notification_on_express_interest');
				$this->db->update('general_settings', $data13);

				$data14['value'] = $this->input->post('email_notification_on_sending_message');
				$this->db->where('type', 'email_notification_on_sending_message');
				$this->db->update('general_settings', $data14);




				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/general_settings', 'refresh');
			}
			elseif ($para1=="update_smtp") {
				$mail_status = $this->input->post('mail_status');
				if (isset($mail_status)) {
					$data1['value'] = 'smtp';
				} else {
					$data1['value'] = 'mail';
				}
				$this->db->where('type', 'mail_status');
				$this->db->update('general_settings', $data1);

				$data2['value'] = $this->input->post('smtp_host');
				$this->db->where('type', 'smtp_host');
				$this->db->update('general_settings', $data2);

				$data3['value'] = $this->input->post('smtp_port');
				$this->db->where('type', 'smtp_port');
				$this->db->update('general_settings', $data3);

				$data4['value'] = $this->input->post('smtp_user');
				$this->db->where('type', 'smtp_user');
				$this->db->update('general_settings', $data4);

				$data5['value'] = $this->input->post('smtp_pass');
				$this->db->where('type', 'smtp_pass');
				$this->db->update('general_settings', $data5);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/general_settings', 'refresh');
			}
			elseif ($para1=="update_social_links") {
				$data1['value'] = $this->input->post('facebook');
				$this->db->where('type', 'facebook');
				$this->db->update('social_links', $data1);

				$data2['value'] = $this->input->post('google-plus');
				$this->db->where('type', 'google-plus');
				$this->db->update('social_links', $data2);

				$data3['value'] = $this->input->post('twitter');
				$this->db->where('type', 'twitter');
				$this->db->update('social_links', $data3);

				$data4['value'] = $this->input->post('pinterest');
				$this->db->where('type', 'pinterest');
				$this->db->update('social_links', $data4);

				$data5['value'] = $this->input->post('skype');
				$this->db->where('type', 'skype');
				$this->db->update('social_links', $data5);

				$data5['value'] = $this->input->post('youtube');
				$this->db->where('type', 'youtube');
				$this->db->update('social_links', $data5);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/general_settings', 'refresh');
			}
			elseif ($para1=="update_terms_and_conditions") {
				$data['value'] = $this->input->post('terms_and_conditions');
				$this->db->where('type', 'terms_conditions');
				$this->db->update('general_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/general_settings', 'refresh');
			}
			elseif ($para1=="update_privacy_policy") {
				$data['value'] = $this->input->post('privacy_policy');
				$this->db->where('type', 'privacy_policy');
				$this->db->update('general_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/general_settings', 'refresh');
			}
		}
	}

	function frontend_appearances($para1="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="pages") {
				$page_data['top'] = "frontend_appearances/index.php";
				$page_data['folder'] = "frontend_appearances/pages";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "frontend_appearances/index.php";
				$page_data['page_name'] = "pages";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				if ($this->session->flashdata('alert') == "failed_image") {
					$page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="header") {
				$page_data['top'] = "frontend_appearances/index.php";
				$page_data['folder'] = "frontend_appearances/header";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "frontend_appearances/index.php";
				$page_data['page_name'] = "header";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				if ($this->session->flashdata('alert') == "failed_image") {
					$page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="footer") {
				$page_data['top'] = "frontend_appearances/index.php";
				$page_data['folder'] = "frontend_appearances/footer";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "frontend_appearances/index.php";
				$page_data['page_name'] = "footer";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				if ($this->session->flashdata('alert') == "failed_image") {
					$page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
				}
				$this->load->view('back/index', $page_data);
			}
		}
	}

	function save_frontend_settings($para1="", $para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			if ($para1=="home_slider") {
				if($this->input->post('slider_status')){
					$data1['value'] = 'yes';
		            $this->db->where('type', 'slider_status');
					$this->db->update('frontend_settings', $data1);
				} else{
					$data1['value'] = 'no';
		            $this->db->where('type', 'slider_status');
					$this->db->update('frontend_settings', $data1);
				}

				$data2['value'] = $this->input->post('slider_position');
	            $this->db->where('type', 'slider_position');
				$this->db->update('frontend_settings', $data2);

				$data4['value'] = $this->input->post('home_search_style');
	            $this->db->where('type', 'home_search_style');
				$this->db->update('frontend_settings', $data4);

				$data5['value'] = $this->input->post('searching_heading');
	            $this->db->where('type', 'home_searching_heading');
				$this->db->update('frontend_settings', $data5);

				if(!demo()){
					$home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;
					$img_features = json_decode($home_slider_image, true);
		            $last_index = 0;

		            $totally_new = array();
		            $replaced_new = array();
		            $untouched = array();

		            foreach ($_FILES['nimg']['name'] as $i => $row) {
		                if ($_FILES['nimg']['name'][$i] !== '') {
		                    $ib = $i + 1;
		                    $path = $_FILES['nimg']['name'][$i];
		                    $ext = pathinfo($path, PATHINFO_EXTENSION);
		                    $img = 'slider_image_' . $ib . '.' . $ext;
		                    // $img_thumb = 'news_' . $para2 . '_' . $ib . '_thumb.' . $ext;
		                    $in_db = 'no';
		                    foreach ($img_features as $roww) {
		                        if($roww['index'] == $i){
		                            $replaced_new[] = array('index' => $i, 'img' => $img);
		                            $in_db = 'yes';
		                        }
		                    }
		                    if ($in_db == 'no') {
		                        $totally_new[] = array('index' => $i, 'img' => $img);
		                    }
		                    move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/home_page/slider_image/' . $img);
		                }
		            }

		            $touched = $replaced_new + $totally_new;
		            foreach ($img_features as $yy) {
		                $is_touched = 'no';
		                foreach ($touched as $rr) {
		                    if($yy['index'] == $rr['index']){
		                        $is_touched = 'yes';
		                    }
		                }
		                if($is_touched == 'no'){
		                    $untouched[] = $yy;
		                }
		            }
		            $new_img_features = array();
		            foreach ($replaced_new as $k) {
		                $new_img_features[] = $k;
		            }
		            foreach ($totally_new as $k) {
		                $new_img_features[] = $k;
		            }
		            foreach ($untouched as $k) {
		                $new_img_features[] = $k;
		            }
		            sort_array_of_array($new_img_features, 'index', SORT_ASC); // Sort the data with Index

		            $data['value'] = json_encode($new_img_features);
		            $this->db->where('type', 'home_slider_image');
		            $this->db->update('frontend_settings', $data);
				}
	            recache();

	            $this->session->set_flashdata('alert', 'edit');
	            redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="home_premium_members") {
				if($this->input->post('home_members_status')){
					$data1['value'] = 'yes';
		            $this->db->where('type', 'home_members_status');
					$this->db->update('frontend_settings', $data1);
				} else{
					$data1['value'] = 'no';
		            $this->db->where('type', 'home_members_status');
					$this->db->update('frontend_settings', $data1);
				}
				$data2['value'] = $this->input->post('max_premium_member_num');

				$this->db->where('type', 'max_premium_member_num');
				$this->db->update('frontend_settings', $data2);
				recache();

				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="home_parallax") {
				$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_image'))->row()->value;
				if ($prev_image_info != '[]') {
					$prev_image_info = json_decode($prev_image_info, true);
					$prev_image = $prev_image_info[0]['image'];
				}
				if($this->input->post('home_parallax_status')){
					$data0['value'] = 'yes';
		            $this->db->where('type', 'home_parallax_status');
					$this->db->update('frontend_settings', $data0);
				} else{
					$data0['value'] = 'no';
		            $this->db->where('type', 'home_parallax_status');
					$this->db->update('frontend_settings', $data0);
				}
				$data1['value'] = $this->input->post('parallax_text');
				$is_edit = $this->input->post('is_edit');
				if(demo()){
					$this->db->where('type', 'home_parallax_text');
					$this->db->update('frontend_settings', $data1);
					recache();

					$this->session->set_flashdata('alert', 'edit');
				}
				if(!demo()){
					if ($is_edit == '0') {
						$this->db->where('type', 'home_parallax_text');
						$this->db->update('frontend_settings', $data1);
						recache();

						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['parallax_image']['name'] !== '') {
			                $path = $_FILES['parallax_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "parallax_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['parallax_image']['tmp_name'], 'uploads/home_page/parallax_image/'.$img_file_name);
				                $home_parallax_image[] = array('image' => $img_file_name);

				                $data2['value'] = json_encode($home_parallax_image);

				                $this->db->where('type', 'home_parallax_text');
								$this->db->update('frontend_settings', $data1);

				                $this->db->where('type', 'home_parallax_image');
								$this->db->update('frontend_settings', $data2);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/home_page/parallax_image/'.$prev_image)) {
					            	unlink('uploads/home_page/parallax_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="home_happy_stories") {
				if($this->input->post('home_stories_status')){
					$data0['value'] = 'yes';
		            $this->db->where('type', 'home_stories_status');
					$this->db->update('frontend_settings', $data0);
				} else{
					$data0['value'] = 'no';
		            $this->db->where('type', 'home_stories_status');
					$this->db->update('frontend_settings', $data0);
				}

				$data['value'] = $this->input->post('max_story_num');

				$this->db->where('type', 'max_story_num');
				$this->db->update('frontend_settings', $data);
				recache();
				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="home_premium_plans") {
				if($this->input->post('home_plans_status')){
					$data0['value'] = 'yes';
		            $this->db->where('type', 'home_plans_status');
					$this->db->update('frontend_settings', $data0);
				} else{
					$data0['value'] = 'no';
		            $this->db->where('type', 'home_plans_status');
					$this->db->update('frontend_settings', $data0);
				}

				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'home_premium_plans_image'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['premium_plans_image']['name'] !== '') {
			                $path = $_FILES['premium_plans_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "premium_plans_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/home_page/premium_plans_image/'.$img_file_name);
				                $home_premium_plans_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($home_premium_plans_image);

				                $this->db->where('type', 'home_premium_plans_image');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/home_page/premium_plans_image/'.$prev_image)) {
					            	unlink('uploads/home_page/premium_plans_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="home_contact_info") {
				if($this->input->post('home_contact_status')){
					$data0['value'] = 'yes';
		            $this->db->where('type', 'home_contact_status');
					$this->db->update('frontend_settings', $data0);
				} else{
					$data0['value'] = 'no';
		            $this->db->where('type', 'home_contact_status');
					$this->db->update('frontend_settings', $data0);
				}

				$data['value'] = $this->input->post('contact_info_text');

				$this->db->where('type', 'home_contact_info_text');
				$this->db->update('frontend_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="premium_plans") {
				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'premium_plans_image'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						if ($_FILES['premium_plans_image']['name'] !== '') {
			                $path = $_FILES['premium_plans_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "premium_plans_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/premium_plans_image/'.$img_file_name);
				                $premium_plans_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($premium_plans_image);

				                $this->db->where('type', 'premium_plans_image');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['premium_plans_image']['name'] !== '') {
			                $path = $_FILES['premium_plans_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "premium_plans_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/premium_plans_image/'.$img_file_name);
				                $premium_plans_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($premium_plans_image);

				                $this->db->where('type', 'premium_plans_image');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/premium_plans_image/'.$prev_image)) {
					            	unlink('uploads/premium_plans_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="happy_stories") {
				$data['value'] = $this->input->post('happy_stories_text');

				$this->db->where('type', 'happy_stories_text');
				$this->db->update('frontend_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="contact_us") {
				$data['value'] = $this->input->post('contact_us_text');

				$this->db->where('type', 'contact_us_text');
				$this->db->update('frontend_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="listing_page") {

				$data1['value'] = $this->input->post('advance_search_position');
	            $this->db->where('type', 'advance_search_position');
				$this->db->update('frontend_settings', $data1);

				$this->session->set_flashdata('alert', 'edit');
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="log_in") {
				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'login_image'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						if ($_FILES['login_image']['name'] !== '') {
			                $path = $_FILES['login_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "login_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['login_image']['tmp_name'], 'uploads/login_image/'.$img_file_name);
				                $login_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($login_image);

				                $this->db->where('type', 'login_image');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['login_image']['name'] !== '') {
			                $path = $_FILES['login_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "login_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['login_image']['tmp_name'], 'uploads/login_image/'.$img_file_name);
				                $login_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($login_image);

				                $this->db->where('type', 'login_image');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/login_image/'.$prev_image)) {
					            	unlink('uploads/login_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}
				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="registration") {
				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'registration_image'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						if ($_FILES['registration_image']['name'] !== '') {
			                $path = $_FILES['registration_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "registration_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['registration_image']['tmp_name'], 'uploads/registration_image/'.$img_file_name);
				                $registration_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($registration_image);

				                $this->db->where('type', 'registration_image');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
						$this->session->set_flashdata('alert', 'edit');
					}

					elseif ($is_edit == '1') {
						if ($_FILES['registration_image']['name'] !== '') {
			                $path = $_FILES['registration_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "registration_image_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['registration_image']['tmp_name'], 'uploads/registration_image/'.$img_file_name);
				                $registration_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($registration_image);

				                $this->db->where('type', 'registration_image');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/registration_image/'.$prev_image)) {
					            	unlink('uploads/registration_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="set_email_verification_message") {

				$data['value'] = $this->input->post('email_verification_message');
				$this->db->where('type', 'email_verification_message');
				$this->db->update('frontend_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="update_header") {
				$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'header_logo'))->row()->value;
				if ($prev_image_info != '[]') {
					$prev_image_info = json_decode($prev_image_info, true);
					$prev_image = $prev_image_info[0]['image'];
				}
				$is_edit = $this->input->post('is_edit');
				if ($is_edit == '0') {
					if(!demo()){
						if ($_FILES['header_logo']['name'] !== '') {
			                $path = $_FILES['header_logo']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "header_logo_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['header_logo']['tmp_name'], 'uploads/header_logo/'.$img_file_name);
				                $header_logo[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($header_logo);

				                $this->db->where('type', 'header_logo');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
			            elseif ($_FILES['favicon']['name'] !== '') {
			                $path = $_FILES['favicon']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "favicon_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/favicon/'.$img_file_name);
				                $favicon[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($favicon);

				                $this->db->where('type', 'favicon');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}

		            if($this->input->post('sticky_header')){
						$data1['value'] = 'yes';
			            $this->db->where('type', 'sticky_header');
						$this->db->update('frontend_settings', $data1);
					} else{
						$data1['value'] = 'no';
			            $this->db->where('type', 'sticky_header');
						$this->db->update('frontend_settings', $data1);
					}
					$this->session->set_flashdata('alert', 'edit');
				}
				elseif ($is_edit == '1') {
					if(!demo()){
						if ($_FILES['header_logo']['name'] !== '') {
			                $path = $_FILES['header_logo']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "header_logo_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['header_logo']['tmp_name'], 'uploads/header_logo/'.$img_file_name);
				                $header_logo[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($header_logo);

				                $this->db->where('type', 'header_logo');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/header_logo/'.$prev_image)) {
					            	unlink('uploads/header_logo/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
			            elseif ($_FILES['favicon']['name'] !== '') {
			                $path = $_FILES['favicon']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "favicon_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/favicon/'.$img_file_name);
				                $favicon[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($favicon);

				                $this->db->where('type', 'favicon');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/favicon/'.$prev_image)) {
					            	unlink('uploads/favicon/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}
				redirect(base_url().'admin/frontend_appearances/header', 'refresh');
			}
			elseif ($para1=="update_footer") {
				$data1['value'] = $this->input->post('footer_logo_position');
				$data2['value'] = $this->input->post('footer_text');

				$this->db->where('type', 'footer_logo_position');
				$this->db->update('frontend_settings', $data1);

				$this->db->where('type', 'footer_text');
				$this->db->update('frontend_settings', $data2);
				recache();

				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'footer_logo'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						if ($_FILES['footer_logo']['name'] !== '') {
			                $path = $_FILES['footer_logo']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "footer_logo_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['footer_logo']['tmp_name'], 'uploads/footer_logo/'.$img_file_name);
				                $footer_logo[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($footer_logo);

				                $this->db->where('type', 'footer_logo');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['footer_logo']['name'] !== '') {
			                $path = $_FILES['footer_logo']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "footer_logo_".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['footer_logo']['tmp_name'], 'uploads/footer_logo/'.$img_file_name);
				                $footer_logo[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($footer_logo);

				                $this->db->where('type', 'footer_logo');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/footer_logo/'.$prev_image)) {
					            	unlink('uploads/footer_logo/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/footer', 'refresh');
			}
			elseif ($para1=="registration_msg") {

				$data['value'] = $this->input->post('registration_message');
				$this->db->where('type', 'registration_message');
				$this->db->update('frontend_settings', $data);
				recache();

				$this->session->set_flashdata('alert', 'edit');

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
			elseif ($para1=="registration_message") {
				if(!demo()){
					$prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'registration_message_image'))->row()->value;
					if ($prev_image_info != '[]') {
						$prev_image_info = json_decode($prev_image_info, true);
						$prev_image = $prev_image_info[0]['image'];
					}
					$is_edit = $this->input->post('is_edit');
					if ($is_edit == '0') {
						if ($_FILES['registration_message_image']['name'] !== '') {
			                $path = $_FILES['registration_message_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "registration_message_image".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['registration_message_image']['tmp_name'], 'uploads/registration_message_image/'.$img_file_name);
				                $registration_message_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($registration_message_image);

				                $this->db->where('type', 'registration_message_image');
								$this->db->update('frontend_settings', $data);
								recache();

								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
						$this->session->set_flashdata('alert', 'edit');
					}
					elseif ($is_edit == '1') {
						if ($_FILES['registration_message_image']['name'] !== '') {
			                $path = $_FILES['registration_message_image']['name'];
			                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
			                $img_file_name = "registration_message_image".time().$ext;
			                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
			                	move_uploaded_file($_FILES['registration_message_image']['tmp_name'], 'uploads/registration_message_image/'.$img_file_name);
				                $registration_message_image[] = array('image' => $img_file_name);

				                $data['value'] = json_encode($registration_message_image);

				                $this->db->where('type', 'registration_message_image');
								$this->db->update('frontend_settings', $data);
								recache();

								if ($prev_image_info != '[]' && file_exists('uploads/registration_message_image/'.$prev_image)) {
					            	unlink('uploads/registration_message_image/'.$prev_image);
					            }
								$this->session->set_flashdata('alert', 'edit');
			                }
			                else {
			                	$this->session->set_flashdata('alert', 'failed_image');
			                }
			            }
					}
				}

				redirect(base_url().'admin/frontend_appearances/pages', 'refresh');
			}
		}
	}

	function currency_settings($para1="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="currency_configure") {
				$page_data['top'] = "currency_settings/index.php";
				$page_data['folder'] = "currency_settings/currency_configure";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "currency_settings/index.php";
				$page_data['page_name'] = "currency_configure";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				$this->load->view('back/index', $page_data);
			}
			if ($para1=="currency_set") {
				$page_data['top'] = "currency_settings/index.php";
				$page_data['folder'] = "currency_settings/currency_set";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "currency_settings/index.php";
				$page_data['page_name'] = "currency_set";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				$this->load->view('back/index', $page_data);
			}
		}
	}

	function update_currency_settings($para1="")
	{
		if ($para1=="home_currency") {
			$home_currency = $this->input->post('home_def_currency');

			$data['value'] = $home_currency;

			$this->db->where('type','home_def_currency');
			$result = $this->db->update('business_settings', $data);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/currency_settings/currency_configure', 'refresh');
		}

		elseif ($para1=="system_currency") {
			$system_currency = $this->input->post('system_def_currency');

			$data['value'] = $system_currency;

			$this->db->where('type','currency');
			$result = $this->db->update('business_settings', $data);

			$this->db->where('currency_settings_id', $system_currency);
			$this->db->update('currency_settings', array(
				'exchange_rate_def' => '1'
			));
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/currency_settings/currency_configure', 'refresh');
		}

		elseif ($para1=="currency_format") {
			$this->db->where('type', 'currency_format');
			$this->db->update('business_settings', array(
				'value' => $this->input->post('currency_format')
			));

			$this->db->where('type', 'symbol_format');
			$this->db->update('business_settings', array(
				'value' => $this->input->post('symbol_format')
			));

			$this->db->where('type', 'no_of_decimals');
			$result = $this->db->update('business_settings', array(
				'value' => $this->input->post('no_of_decimals')
			));
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/currency_settings/currency_configure', 'refresh');
		}
	}

	function set_currency_rate($para1="")
	{
		if($this->input->post('exchange')){
			$data['exchange_rate']    		= $this->input->post('exchange');
		}
		if($this->input->post('exchange_def')){
			$data['exchange_rate_def']    	= $this->input->post('exchange_def');
		}
		if($this->input->post('name')){
			$data['name']    	= $this->input->post('name');
		}
		if($this->input->post('symbol')){
			$data['symbol']    	= $this->input->post('symbol');
		}
		$cur_stats = $this->input->post('cur_stats');
		if (isset($cur_stats)) {
			$data['status'] = "ok";
		} else {
			$data['status'] = "no";
		}
        $this->db->where('currency_settings_id', $para1);
        $this->db->update('currency_settings', $data);
        recache();
	}

	function sms_settings($para1="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="twilio") {
				$page_data['top'] = "sms_settings/index.php";
				$page_data['folder'] = "sms_settings/twilio";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "sms_settings/index.php";
				$page_data['page_name'] = "twilio";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				$this->load->view('back/index', $page_data);
			}
			if ($para1=="msg91") {
				$page_data['top'] = "sms_settings/index.php";
				$page_data['folder'] = "sms_settings/msg91";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "sms_settings/index.php";
				$page_data['page_name'] = "msg91";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
				}
				$this->load->view('back/index', $page_data);
			}
		}
	}

	function update_sms_settings($para1="")
	{
		if ($para1=="twilio") {
			$twilio_activation = $this->input->post('twilio_activation');
				if (isset($twilio_activation)) {
					$data1['value'] = "ok";
				} else {
					$data1['value'] = "no";
				}
			$data2['value'] = $this->input->post('twilio_account_sid');
			$data3['value'] = $this->input->post('twilio_auth_token');
			$data4['value'] = $this->input->post('twilio_sender_phone_number');

			$this->db->where('type','twilio_status');
			$result = $this->db->update('third_party_settings', $data1);

			$this->db->where('type','twilio_account_sid');
			$result = $this->db->update('third_party_settings', $data2);

			$this->db->where('type','twilio_auth_token');
			$result = $this->db->update('third_party_settings', $data3);

			$this->db->where('type','twilio_sender_phone_number');
			$result = $this->db->update('third_party_settings', $data4);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/sms_settings/twilio', 'refresh');
		}

		if ($para1=="msg91") {
			$msg91_activation = $this->input->post('msg91_activation');
				if (isset($msg91_activation)) {
					$data1['value'] = "ok";
				} else {
					$data1['value'] = "no";
				}
			$data2['value'] = $this->input->post('authentication_key');
			$data3['value'] = $this->input->post('sender_id');
			$data6['value'] = $this->input->post('type');

			$data4['value'] = $this->input->post('country_code');
			$data5['value'] = $this->input->post('route');


			$this->db->where('type','msg91_status');
			$result = $this->db->update('third_party_settings', $data1);

			$this->db->where('type','msg91_authentication_key');
			$result = $this->db->update('third_party_settings', $data2);

			$this->db->where('type','msg91_sender_id');
			$result = $this->db->update('third_party_settings', $data3);

			$this->db->where('type','msg91_country_code');
			$result = $this->db->update('third_party_settings', $data4);

			$this->db->where('type','msg91_route');
			$result = $this->db->update('third_party_settings', $data5);
			$this->db->where('type','msg91_type');
			$result = $this->db->update('third_party_settings', $data6);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/sms_settings/msg91', 'refresh');
		}
	}

	function theme_color_settings($para1="", $para2="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			if ($para1=="") {
				$page_data['title'] = "Admin || ".$this->system_title;
				$page_data['top'] = "theme_color_settings/index.php";
				$page_data['folder'] = "theme_color_settings";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "theme_color_settings/index.php";
				$page_data['page_name'] = "theme_color_settings";
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_updated_your_profile!");
				}
				elseif ($this->session->flashdata('alert') == "failed_edit") {
					$page_data['danger_alert'] = translate("failed_to_updated_your_profile!");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="update") {
				$data['value'] = $this->input->post('theme_color');
				$this->db->where('type','theme_color');
				$result = $this->db->update('frontend_settings', $data);
				recache();
			}
		}
	}

	function payments() {
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "payments/index.php";
			$page_data['folder'] = "payments";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "payments/index.php";
			$page_data['page_name'] = "payments";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_your_payments_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_your_payments_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_image") {
				$page_data['danger_alert'] = translate("image_upload_failed!_please_make_sure_your_image_format_is_JPG,_JPEG_or_PNG.");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_payments($para1 = "")
	{
		if ($para1=="update_paypal") {

			$paypal_activation = $this->input->post('paypal_activation');
			if (isset($paypal_activation)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('email');
			$data3['value'] = $this->input->post('paypal_account_type');

			$this->db->where('type','paypal_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','paypal_email');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','paypal_account_type');
			$result = $this->db->update('business_settings', $data3);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}

		}
		elseif ($para1=="update_stripe") {

			$stripe_activation = $this->input->post('stripe_activation');
			if (isset($stripe_activation)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('secret_key');
			$data3['value'] = $this->input->post('publishable_key');

			$this->db->where('type','stripe_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','stripe_secret_key');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','stripe_publishable_key');
			$result = $this->db->update('business_settings', $data3);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}

		}
		elseif ($para1=="update_pum") {

			$pum_activation = $this->input->post('pum_activation');
			if (isset($pum_activation)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data21['value'] = $this->input->post('pum_merchant_key');
			$data22['value'] = $this->input->post('pum_merchant_salt');
			$data3['value'] = $this->input->post('pum_account_type');

			$this->db->where('type','pum_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','pum_merchant_key');
			$result = $this->db->update('business_settings', $data21);

			$this->db->where('type','pum_merchant_salt');
			$result = $this->db->update('business_settings', $data22);

			$this->db->where('type','pum_account_type');
			$result = $this->db->update('business_settings', $data3);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}

		}
		elseif ($para1 == 'update_instamojo') {
			$instamojo_activation = $this->input->post('instamojo_activation');
			if (isset($instamojo_activation)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('instamojo_api_key');
			$data3['value'] = $this->input->post('instamojo_auth_token');
			$data4['value'] = $this->input->post('instamojo_account_type');

			$this->db->where('type','instamojo_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','instamojo_api_key');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','instamojo_auth_token');
			$result = $this->db->update('business_settings', $data3);

			$this->db->where('type','instamojo_account_type');
			$result = $this->db->update('business_settings', $data4);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
		}
		elseif ($para1 == 'update_custom_payment_1') {
			$cp_method_1_set = $this->input->post('custom_payment_method_1_set');
			if (isset($cp_method_1_set)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('custom_payment_method_1_name');
			$data3['value'] = $this->input->post('custom_payment_method_1_number');
			$data4['value'] = $this->input->post('custom_payment_method_1_instruction');

			$this->db->where('type','custom_payment_method_1_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','custom_payment_method_1_name');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','custom_payment_method_1_number');
			$result = $this->db->update('business_settings', $data3);

			$this->db->where('type','custom_payment_method_1_instruction');
			$result = $this->db->update('business_settings', $data4);

			if(!demo()){

			}

			if (!demo() && $_FILES['cp_image1']['name'] !== '' && $_FILES['cp_image1']['error'] == 0) {
				$path = $_FILES['cp_image1']['name'];
				$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
				$img_file_name = 'cp_method_1_image.jpg';
				if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
					move_uploaded_file($_FILES['cp_image1']['tmp_name'], 'uploads/custom_payment_methods_image/'.$img_file_name);

					$this->session->set_flashdata('alert', 'edit');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_image');
				}
			}
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
		}
		elseif ($para1 == 'update_custom_payment_2') {
			$cp_method_2_set = $this->input->post('custom_payment_method_2_set');
			if (isset($cp_method_2_set)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('custom_payment_method_2_name');
			$data3['value'] = $this->input->post('custom_payment_method_2_number');
			$data4['value'] = $this->input->post('custom_payment_method_2_instruction');

			$this->db->where('type','custom_payment_method_2_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','custom_payment_method_2_name');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','custom_payment_method_2_number');
			$result = $this->db->update('business_settings', $data3);

			$this->db->where('type','custom_payment_method_2_instruction');
			$result = $this->db->update('business_settings', $data4);

			if(!demo()){

			}

			if (!demo() && $_FILES['cp_image2']['name'] !== '' && $_FILES['cp_image2']['error'] == 0) {
				$path = $_FILES['cp_image2']['name'];
				$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
				$img_file_name = 'cp_method_2_image.jpg';
				if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
					move_uploaded_file($_FILES['cp_image2']['tmp_name'], 'uploads/custom_payment_methods_image/'.$img_file_name);

					$this->session->set_flashdata('alert', 'edit');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_image');
				}
			}
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
		}
		elseif ($para1 == 'update_custom_payment_3') {
			$cp_method_3_set = $this->input->post('custom_payment_method_3_set');
			if (isset($cp_method_3_set)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('custom_payment_method_3_name');
			$data3['value'] = $this->input->post('custom_payment_method_3_number');
			$data4['value'] = $this->input->post('custom_payment_method_3_instruction');

			$this->db->where('type','custom_payment_method_3_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','custom_payment_method_3_name');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','custom_payment_method_3_number');
			$result = $this->db->update('business_settings', $data3);

			$this->db->where('type','custom_payment_method_3_instruction');
			$result = $this->db->update('business_settings', $data4);

			if(!demo()){

			}

			if (!demo() && $_FILES['cp_image3']['name'] !== '' && $_FILES['cp_image3']['error'] == 0) {
				$path = $_FILES['cp_image3']['name'];
				$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
				$img_file_name = 'cp_method_3_image.jpg';
				if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
					move_uploaded_file($_FILES['cp_image3']['tmp_name'], 'uploads/custom_payment_methods_image/'.$img_file_name);

					$this->session->set_flashdata('alert', 'edit');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_image');
				}
			}
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
		}
		elseif ($para1 == 'update_custom_payment_4') {
			$cp_method_4_set = $this->input->post('custom_payment_method_4_set');
			if (isset($cp_method_4_set)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
			$data2['value'] = $this->input->post('custom_payment_method_4_name');
			$data3['value'] = $this->input->post('custom_payment_method_4_number');
			$data4['value'] = $this->input->post('custom_payment_method_4_instruction');

			$this->db->where('type','custom_payment_method_4_set');
			$result = $this->db->update('business_settings', $data1);

			$this->db->where('type','custom_payment_method_4_name');
			$result = $this->db->update('business_settings', $data2);

			$this->db->where('type','custom_payment_method_4_number');
			$result = $this->db->update('business_settings', $data3);

			$this->db->where('type','custom_payment_method_4_instruction');
			$result = $this->db->update('business_settings', $data4);

			if(!demo()){

			}

			if (!demo() && $_FILES['cp_image4']['name'] !== '' && $_FILES['cp_image4']['error'] == 0) {
				$path = $_FILES['cp_image4']['name'];
				$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
				$img_file_name = 'cp_method_4_image.jpg';
				if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
					move_uploaded_file($_FILES['cp_image4']['tmp_name'], 'uploads/custom_payment_methods_image/'.$img_file_name);

					$this->session->set_flashdata('alert', 'edit');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_image');
				}
			}
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
		}

		redirect(base_url().'admin/payments', 'refresh');

	}

	function faq($para1 = "")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			if ($para1=="") {
				$page_data['title'] = "Admin || ".$this->system_title;
				$page_data['top'] = "faq/index.php";
				$page_data['folder'] = "faq";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "faq/index.php";
				$page_data['page_name'] = "faq";
				if ($this->session->flashdata('alert') == "update") {
					$page_data['success_alert'] = translate("you_have_successfully_updated_the_FAQ!");
				}
				elseif ($this->session->flashdata('alert') == "failed_update") {
					$page_data['danger_alert'] = translate("failed_to_update_the_FAQ!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="update") {
				$faqs = array();
	            $f_q = $this->input->post('question');
	            $f_a = $this->input->post('answer');
	            foreach ($f_q as $i => $r) {
	                $faqs[] = array(
	                    'question' => $f_q[$i],
	                    'answer' => $f_a[$i]
	                );
	            }
	            $this->db->where('type', "faqs");
	            $result = $this->db->update('general_settings', array('value' => json_encode($faqs)));
	            recache();
	            if ($result) {
	            	$this->session->set_flashdata('alert', 'update');
	            } else {
	            	$this->session->set_flashdata('alert', 'failed_update');
	            }
        		redirect(base_url().'admin/faq', 'refresh');
			}
		}
	}

	function delete_slider($image_name)
	{
		if(!demo()){
			$new_img_features = array();
	        $old_img_features = json_decode($this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value, true);
	        foreach ($old_img_features as $row2) {
	            if ($row2['img'] == $image_name) {
	                if (file_exists('uploads/home_page/slider_image/' . $row2['img'])) {
	                    unlink('uploads/home_page/slider_image/' . $row2['img']);
	                }
	            } else {
	                $new_img_features[] = $row2;
	            }
	        }
	        $data['value'] = json_encode($new_img_features);
	        $this->db->where('type', 'home_slider_image');
	        $this->db->update('frontend_settings', $data);
	        recache();
		}
	}

	function login()
	{
		if ($this->admin_permission() == TRUE) {
        	redirect(base_url().'admin/', 'refresh');
		}
		else{
			$page_data['login_error'] = "";
            if ($this->session->flashdata('alert') == "login_error") {
                $page_data['login_error'] = translate("Your_email_or_password_is_Invalid!");
            }
            if ($this->session->flashdata('alert') == "not_sent") {
                $page_data['login_error'] = translate("failed_to_send_your_email!");
            }
            if ($this->session->flashdata('alert') == "no_email") {
                $page_data['login_error'] = translate("Your_email__is_Invalid!");
            }
            if ($this->session->flashdata('alert') == "email_sent") {
                $page_data['success_alert'] = translate("email_sent_successfully!");
            }
			$this->load->view('back/login', $page_data);
		}
	}

	function forget_pass()
	{
		if ($this->admin_permission() == TRUE) {
        	redirect(base_url().'admin/', 'refresh');
		}
		else{
			$page_data['forget_pass_error'] = "";
            if ($this->session->flashdata('alert') == "forget_pass_error") {
                $page_data['forget_pass_error'] = "Your <b>Email</b> or <b>Password</b> is Invalid!";
            }
			$this->load->view('back/forget_pass', $page_data);
		}
	}

	function submit_forget_pass()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $ajax_error[] = array('ajax_error'  =>  validation_errors());
            echo json_encode($ajax_error);
        }
        else {
            $query = $this->db->get_where('admin', array(
                'email' => $this->input->post('email')
            ));
            if ($query->num_rows() > 0) {
                $admin_id = $query->row()->admin_id;
                $password = substr(hash('sha512', rand()), 0, 12);
                $data['password'] = sha1($password);
                if ($this->Email_model->password_reset_email('admin', $admin_id, $password)) {
                    $this->db->where('admin_id', $admin_id);
                    $this->db->update('admin', $data);
                    recache();
                    $this->session->set_flashdata('alert','email_sent');
                } else {
                    $this->session->set_flashdata('alert','not_sent');
                }
            } else {
                $this->session->set_flashdata('alert','no_email');
            }
            redirect( base_url().'admin/login', 'refresh' );
        }
	}

	function manage_language($para1="", $para2="", $para3="", $para4="")
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] = "manage_language/index.php";
				$page_data['folder'] = "manage_language";
				$page_data['file'] = "index.php";
				$page_data['bottom'] = "manage_language/index.php";
				$page_data['page_name'] = "manage_language";
				$page_data['all_language_list'] = $this->db->get("site_language_list")->result();
				if ($this->session->flashdata('alert') == "publish") {
					$page_data['success_alert'] = translate("you_have_successfully_published_the_language!");
				}
				if ($this->session->flashdata('alert') == "unpublish") {
					$page_data['success_alert'] = translate("you_have_successfully_unpublished_the_language!");
				}
				if ($this->session->flashdata('alert') == "add") {
					$page_data['success_alert'] = translate("you_have_successfully_added_the_language!");
				}
				if ($this->session->flashdata('alert') == "edit") {
					$page_data['success_alert'] = translate("you_have_successfully_edited_the_language!");
				}
				if ($this->session->flashdata('alert') == "delete") {
					$page_data['danger_alert'] = translate("you_have_successfully_deleted_the_language!");
				}
				elseif ($this->session->flashdata('alert') == "demo_msg") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1=="approval") {
				if ($para2 == "no") {
					$data['status'] = "ok";
					$this->session->set_flashdata('alert', 'publish');
				}
				elseif ($para2 == "ok") {
					$data['status'] = "no";
					$this->session->set_flashdata('alert', 'unpublish');
				}
				$this->db->where('site_language_list_id', $para3);
				$this->db->update('site_language_list', $data);
				recache();
			}
			elseif ($para1=="add_site_language") {
				$this->load->view('back/manage_language/add_site_language');
			}
			elseif ($para1=="edit_site_language") {
				$page_data['get_site_language'] = $this->db->get_where("site_language_list", array("site_language_list_id" => $para2))->result();
				$this->load->view('back/manage_language/edit_site_language', $page_data);
			}
			elseif ($para1=="do_add") {
	            $data['name'] = $this->input->post('language_name');
	            $this->db->insert('site_language_list', $data);

	            $id = $this->db->insert_id();
				if(!demo()){
	            	move_uploaded_file($_FILES['language_icon']['tmp_name'], 'uploads/language_list_image/language_'.$id.'.jpg');
				}
	            $language = 'lang_' . $id;

	            $this->db->where('site_language_list_id', $id);
	            $this->db->update('site_language_list', array(
	                'db_field' => $language,
	                'status' => 'ok'
	            ));
	            recache();

	            $this->session->set_flashdata('alert', 'add');
	            add_language($language);
	            redirect(base_url().'admin/manage_language', 'refresh');
	        }
			elseif ($para1=="update") {
	            $this->db->where('site_language_list_id', $para2);
	            $this->db->update('site_language_list', array(
	                'name' => $this->input->post('language_name')
	            ));
	            recache();
				if(!demo()){
		            if ($this->input->post('is_edit') == '1') {
		            	move_uploaded_file($_FILES['language_icon']['tmp_name'], 'uploads/language_list_image/language_'.$para2.'.jpg');
		            }
				}
	            $this->session->set_flashdata('alert', 'edit');
	            redirect(base_url().'admin/manage_language', 'refresh');
	        }
			elseif ($para1=="delete") {
				if(demo()){
					$this->session->set_flashdata('alert', 'demo_msg');
					return false;
				}
	            $this->db->where('db_field', $para2);
	            $this->db->delete('site_language_list');
	            recache();
	            $this->load->dbforge();
	            $this->dbforge->drop_column('site_language', $para2);

	            $lid = $this->db->get_where('site_language_list', array('db_field' => $para2))->row()->site_language_list_id;
	            unlink('uploads/language_list_image/language_'.$lid.'.jpg');

	            $this->session->set_flashdata('alert', 'delete');
	        }
	        elseif ($para1=="set_translation") {
	        	if ($para3=="") {
	        		$page_data['top'] = "manage_language/index.php";
					$page_data['folder'] = "manage_language/set_translation";
					$page_data['file'] = "index.php";
					$page_data['bottom'] = "manage_language/index.php";
					$page_data['page_name'] = "manage_language";
					$page_data['selected_language'] = $para2;

					$this->load->view('back/index', $page_data);
	        	}
	        	elseif ($para3=="list_data") {
	        		$columns = array(
                            0 =>'word',
                            1 =>'word',
                        );
					$limit = $this->input->post('length');
			        $start = $this->input->post('start');
			        $order = $columns[$this->input->post('order')[0]['column']];
			        $dir = $this->input->post('order')[0]['dir'];
			        $table = 'site_language';

			        $totalData = $this->Crud_model->alldata_count($table);

			        $totalFiltered = $totalData;

			        if(empty($this->input->post('search')['value']))
			        {
			            $rows = $this->Crud_model->allsite_language($table,$limit,$start,$order,$dir);
			        }
			        else {
			            $search = $this->input->post('search')['value'];
			            $rows = $this->Crud_model->site_language_search($table,$limit,$start,$search,$order,$dir);
			            $totalFiltered = $this->Crud_model->site_language_search_count($table,$search);
			        }

			        $data = array();
			        if(!empty($rows))
			        {
			        	if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
			            foreach ($rows as $row)
			            {
			                $nestedData['#'] = $i;
			                $nestedData['word'] = "<span class='abv'>".ucwords(str_replace('_', ' ', $row->word))."</span>";
			                $nestedData['translation'] = "<form class='form-horizontal trs' id='".$para2."_".$row->word_id."' method='post' action='".base_url()."admin/manage_language/upd_trn/".$row->word_id."'><div class='input-group' style='width:100%'><input type='text' name='translation' class='form-control input-sm ann' value='".$row->$para2."' style='border: 1px solid rgb(48, 68, 87); height:24px'><span class='input-group-btn'><button type='button' class='btn btn-dark btn-xs btn-labeled fa fa-save submittera' data-wid='".$para2."_".$row->word_id."' style='padding: 3px 5px'>Save</button></span></div><input type='hidden' name='lang' value='".$para2."'></form>";

			                $data[] = $nestedData;
			                if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
			            }
			        }

			        $json_data = array(
			                    "draw"            => intval($this->input->post('draw')),
			                    "recordsTotal"    => intval($totalData),
			                    "recordsFiltered" => intval($totalFiltered),
			                    "data"            => $data
			                    );
			        echo json_encode($json_data);
	        	}
	        }
	        elseif ($para1=="upd_trn") {
	        	$word_id = $para2;
	            $translation = $this->input->post('translation');
	            $language = $this->input->post('lang');
	            $word = $this->db->get_where('site_language', array(
	                        'word_id' => $word_id
	                    ))->row()->word;
	            add_translation($word, $language, $translation);
	        }
		}
	}

	function manage_admin()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "manage_admin/index.php";
			$page_data['folder'] = "manage_admin";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "manage_admin/index.php";
			$page_data['page_name'] = "manage_admin";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_your_profile!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_your_profile!");
			}
			elseif ($this->session->flashdata('alert') == "pass_edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_your_password!");
			}
			elseif ($this->session->flashdata('alert') == "pass_failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_your_password!");
			}
			elseif ($this->session->flashdata('alert') == "pass_matched") {
				$page_data['danger_alert'] = translate("your_current_&_new_password_can_not_be_the_same!");
			}
			elseif ($this->session->flashdata('alert') == "pass_not_matched") {
				$page_data['danger_alert'] = translate("invalid_current_password!");
			}
			elseif ($this->session->flashdata('alert') == "confirm_pass_fail") {
				$page_data['danger_alert'] = translate("your_new_and_confirm_password_is_not_matched!");
			}
			elseif ($this->session->flashdata('alert') == "image_success") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_backgroundimage!");
			}
			elseif ($this->session->flashdata('alert') == "failed_image") {
				$page_data['danger_alert'] = translate("image_upload_failed!_please_make_sure_your_image_format_is_JPG,_JPEG_or_PNG.");
			}
			elseif ($this->session->flashdata('alert') == "demo_msg") {
				$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo!");
			}
			$this->load->view('back/index', $page_data);
		}
	}

	function update_admin_profile($para1 = "")
	{
		if ($para1=="update_details") {
			if(demo()){
				$this->session->set_flashdata('alert', 'demo_msg');
				redirect(base_url().'admin/manage_admin', 'refresh');
			}
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error' => validation_errors());
                echo json_encode($ajax_error);
            }
            else {
            	$admin_id = $this->session->userdata('admin_id');
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['phone'] = $this->input->post('phone');
				$data['address'] = $this->input->post('address');
				$this->db->where('admin_id', $admin_id);
				$result = $this->db->update('admin', $data);
				recache();
				if ($result) {
					$this->session->set_flashdata('alert', 'edit');
				}
				else {
					$this->session->set_flashdata('alert', 'failed_edit');
				}
				redirect(base_url().'admin/manage_admin', 'refresh');
			}
		}
		elseif ($para1=="update_pass_details") {
			if(demo()){
				$this->session->set_flashdata('alert', 'demo_msg');
				redirect(base_url().'admin/manage_admin', 'refresh');
			}
			$this->form_validation->set_rules('current_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			if ($this->form_validation->run() == FALSE) {
                redirect(base_url().'admin/manage_admin', 'refresh');
            }
            else {
            	$admin_id = $this->session->userdata('admin_id');
				$current_password = sha1($this->input->post('current_password'));
				$data['password'] = sha1($this->input->post('new_password'));
				$confirm_password = sha1($this->input->post('confirm_password'));
				$prev_password = $this->db->get_where("admin", array("admin_id" => $admin_id))->row()->password;
				if ($current_password==$prev_password && $data['password']!=$current_password && $data['password']==$confirm_password) {
					$this->db->where('admin_id', $admin_id);
					$result = $this->db->update('admin', $data);
					recache();
					if ($result) {
						$this->session->set_flashdata('alert', 'pass_edit');
					}
					else {
						$this->session->set_flashdata('alert', 'pass_failed_edit');
					}
					redirect(base_url().'admin/manage_admin', 'refresh');
				}
				elseif($current_password!=$prev_password) {
					$this->session->set_flashdata('alert', 'pass_not_matched');
					redirect(base_url().'admin/manage_admin', 'refresh');
				}
				elseif($data['password']==$current_password) {
					$this->session->set_flashdata('alert', 'pass_matched');
					redirect(base_url().'admin/manage_admin', 'refresh');
				}
				elseif($data['password']!=$confirm_password) {
					$this->session->set_flashdata('alert', 'confirm_pass_fail');
					redirect(base_url().'admin/manage_admin', 'refresh');
				}
			}
		}
		elseif ($para1=="update_login_page") {
			if(!demo()){
				$prev_image_info = $this->db->get_where('general_settings', array('type' => 'admin_login_image'))->row()->value;
				if ($prev_image_info != '[]') {
					$prev_image_info = json_decode($prev_image_info, true);
					$prev_image = $prev_image_info[0]['image'];
				}
				$is_edit = $this->input->post('is_edit');
				if ($is_edit == '0') {
					if ($_FILES['admin_login_image']['name'] !== '') {
		                $path = $_FILES['admin_login_image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                $img_file_name = "admin_login_image_".time().$ext;
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	move_uploaded_file($_FILES['admin_login_image']['tmp_name'], 'uploads/admin_login_image/'.$img_file_name);
			                $admin_login_image[] = array('image' => $img_file_name);

			                $data['value'] = json_encode($admin_login_image);

			                $this->db->where('type', 'admin_login_image');
							$this->db->update('general_settings', $data);
							recache();

							$this->session->set_flashdata('alert', 'image_success');
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
		                }
		            }
					$this->session->set_flashdata('alert', 'image_success');
				}
				elseif ($is_edit == '1') {
					if ($_FILES['admin_login_image']['name'] !== '') {
		                $path = $_FILES['admin_login_image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                $img_file_name = "admin_login_image_".time().$ext;
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	move_uploaded_file($_FILES['admin_login_image']['tmp_name'], 'uploads/admin_login_image/'.$img_file_name);
			                $admin_login_image[] = array('image' => $img_file_name);

			                $data['value'] = json_encode($admin_login_image);

			                $this->db->where('type', 'admin_login_image');
							$this->db->update('general_settings', $data);
							recache();

							if ($prev_image_info != '[]' && file_exists('uploads/admin_login_image/'.$prev_image)) {
				            	unlink('uploads/admin_login_image/'.$prev_image);
				            }
							$this->session->set_flashdata('alert', 'image_success');
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
		                }
		            }
				}
			}

			redirect(base_url().'admin/manage_admin', 'refresh');
		}
		elseif ($para1=="update_forget_pass_page") {
			if(!demo()){
				$prev_image_info = $this->db->get_where('general_settings', array('type' => 'forget_pass_image'))->row()->value;
				if ($prev_image_info != '[]') {
					$prev_image_info = json_decode($prev_image_info, true);
					$prev_image = $prev_image_info[0]['image'];
				}
				$is_edit = $this->input->post('is_edit');
				if ($is_edit == '0') {
					if ($_FILES['forget_pass_image']['name'] !== '') {
		                $path = $_FILES['forget_pass_image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                $img_file_name = "forget_pass_image_".time().$ext;
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	move_uploaded_file($_FILES['forget_pass_image']['tmp_name'], 'uploads/forget_pass_image/'.$img_file_name);
			                $forget_pass_image[] = array('image' => $img_file_name);

			                $data['value'] = json_encode($forget_pass_image);

			                $this->db->where('type', 'forget_pass_image');
							$this->db->update('general_settings', $data);
							recache();

							$this->session->set_flashdata('alert', 'image_success');
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
		                }
		            }
					$this->session->set_flashdata('alert', 'image_success');
				}
				elseif ($is_edit == '1') {
					if ($_FILES['forget_pass_image']['name'] !== '') {
		                $path = $_FILES['forget_pass_image']['name'];
		                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
		                $img_file_name = "forget_pass_image_".time().$ext;
		                if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
		                	move_uploaded_file($_FILES['forget_pass_image']['tmp_name'], 'uploads/forget_pass_image/'.$img_file_name);
			                $forget_pass_image[] = array('image' => $img_file_name);

			                $data['value'] = json_encode($forget_pass_image);

			                $this->db->where('type', 'forget_pass_image');
							$this->db->update('general_settings', $data);
							recache();

							if ($prev_image_info != '[]' && file_exists('uploads/forget_pass_image/'.$prev_image)) {
				            	unlink('uploads/forget_pass_image/'.$prev_image);
				            }
							$this->session->set_flashdata('alert', 'image_success');
		                }
		                else {
		                	$this->session->set_flashdata('alert', 'failed_image');
		                }
		            }
				}
			}
			redirect(base_url().'admin/manage_admin', 'refresh');
		}
	}

	function profile_sections()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "profile_sections/index.php";
			$page_data['folder'] = "profile_sections";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "profile_sections/index.php";
			$page_data['page_name'] = "profile_sections";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_profile_sections_settings()
	{
		$present_address_status = $this->input->post('present_address_status');
		$education_and_career_status = $this->input->post('education_and_career_status');
		$physical_attributes_status = $this->input->post('physical_attributes_status');
		$language_status = $this->input->post('language_status');
		$hobbies_and_interests_status = $this->input->post('hobbies_and_interests_status');
		$personal_attitude_and_behavior_status = $this->input->post('personal_attitude_and_behavior_status');
		$residency_information_status = $this->input->post('residency_information_status');
		$spiritual_and_social_background_status = $this->input->post('spiritual_and_social_background_status');
		$life_style_status = $this->input->post('life_style_status');
		$astronomic_information_status = $this->input->post('astronomic_information_status');
		$permanent_address_status = $this->input->post('permanent_address_status');
		$family_information_status = $this->input->post('family_information_status');
		$additional_personal_details_status = $this->input->post('additional_personal_details_status');
		$partner_expectation_status = $this->input->post('partner_expectation_status');
			if (isset($present_address_status)) {
				$data1['value'] = "yes";
			} else {
				$data1['value'] = "no";
			}
			if (isset($education_and_career_status)) {
				$data2['value'] = "yes";
			} else {
				$data2['value'] = "no";
			}
			if (isset($physical_attributes_status)) {
				$data3['value'] = "yes";
			} else {
				$data3['value'] = "no";
			}
			if (isset($language_status)) {
				$data4['value'] = "yes";
			} else {
				$data4['value'] = "no";
			}
			if (isset($hobbies_and_interests_status)) {
				$data5['value'] = "yes";
			} else {
				$data5['value'] = "no";
			}
			if (isset($personal_attitude_and_behavior_status)) {
				$data6['value'] = "yes";
			} else {
				$data6['value'] = "no";
			}
			if (isset($residency_information_status)) {
				$data7['value'] = "yes";
			} else {
				$data7['value'] = "no";
			}
			if (isset($spiritual_and_social_background_status)) {
				$data8['value'] = "yes";
			} else {
				$data8['value'] = "no";
			}
			if (isset($life_style_status)) {
				$data9['value'] = "yes";
			} else {
				$data9['value'] = "no";
			}
			if (isset($astronomic_information_status)) {
				$data10['value'] = "yes";
			} else {
				$data10['value'] = "no";
			}
			if (isset($permanent_address_status)) {
				$data11['value'] = "yes";
			} else {
				$data11['value'] = "no";
			}
			if (isset($family_information_status)) {
				$data12['value'] = "yes";
			} else {
				$data12['value'] = "no";
			}
			if (isset($additional_personal_details_status)) {
				$data13['value'] = "yes";
			} else {
				$data13['value'] = "no";
			}
			if (isset($partner_expectation_status)) {
				$data14['value'] = "yes";
			} else {
				$data14['value'] = "no";
			}

		$this->db->where('type','present_address');
		$this->db->update('frontend_settings', $data1);

		$this->db->where('type','education_and_career');
		$this->db->update('frontend_settings', $data2);

		$this->db->where('type','physical_attributes');
		$this->db->update('frontend_settings', $data3);

		$this->db->where('type','language');
		$this->db->update('frontend_settings', $data4);

		$this->db->where('type','hobbies_and_interests');
		$this->db->update('frontend_settings', $data5);

		$this->db->where('type','personal_attitude_and_behavior');
		$this->db->update('frontend_settings', $data6);

		$this->db->where('type','residency_information');
		$this->db->update('frontend_settings', $data7);

		$this->db->where('type','spiritual_and_social_background');
		$this->db->update('frontend_settings', $data8);

		$this->db->where('type','life_style');
		$this->db->update('frontend_settings', $data9);

		$this->db->where('type','astronomic_information');
		$this->db->update('frontend_settings', $data10);

		$this->db->where('type','permanent_address');
		$this->db->update('frontend_settings', $data11);

		$this->db->where('type','family_information');
		$this->db->update('frontend_settings', $data12);

		$this->db->where('type','additional_personal_details');
		$this->db->update('frontend_settings', $data13);

		$this->db->where('type','partner_expectation');
		$result = $this->db->update('frontend_settings', $data14);

		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/profile_sections', 'refresh');
	}


	function social_media_comments()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "social_media_comments/index.php";
			$page_data['folder'] = "social_media_comments";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "social_media_comments/index.php";
			$page_data['page_name'] = "social_media_comments";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_social_media_comments_settings()
	{
		$data1['value'] = $this->input->post('type');
		$data2['value'] = $this->input->post('discus_id');
		$data3['value'] = $this->input->post('facebook_comment_api');

		$this->db->where('type','comment_type');
		$result = $this->db->update('third_party_settings', $data1);

		$this->db->where('type','discus_id');
		$result = $this->db->update('third_party_settings', $data2);

		$this->db->where('type','fb_comment_api');
		$result = $this->db->update('third_party_settings', $data3);
		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/social_media_comments', 'refresh');
	}

	function captcha_settings()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "captcha_settings/index.php";
			$page_data['folder'] = "captcha_settings";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "captcha_settings/index.php";
			$page_data['page_name'] = "captcha_settings";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_captcha_settings()
	{
		$captcha_activation = $this->input->post('captcha_activation');
			if (isset($captcha_activation)) {
				$data1['value'] = "ok";
			} else {
				$data1['value'] = "no";
			}
		$data2['value'] = $this->input->post('captcha_public');
		$data3['value'] = $this->input->post('captcha_private');

		$this->db->where('type','captcha_status');
		$result = $this->db->update('third_party_settings', $data1);

		$this->db->where('type','captcha_public');
		$result = $this->db->update('third_party_settings', $data2);

		$this->db->where('type','captcha_private');
		$result = $this->db->update('third_party_settings', $data3);
		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/captcha_settings', 'refresh');
	}

	function google_analytics_settings()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "google_analytics_settings/index.php";
			$page_data['folder'] = "google_analytics_settings";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "google_analytics_settings/index.php";
			$page_data['page_name'] = "google_analytics_settings";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_google_analytics_settings()
	{
		$google_analytics_activation = $this->input->post('google_analytics_activation');
			if (isset($google_analytics_activation)) {
				$data1['value'] = "yes";
			} else {
				$data1['value'] = "no";
			}
		$data2['value'] = $this->input->post('google_analytics_key');

		$this->db->where('type','google_analytics_set');
		$result = $this->db->update('third_party_settings', $data1);

		$this->db->where('type','google_analytics_key');
		$result = $this->db->update('third_party_settings', $data2);
		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/google_analytics_settings', 'refresh');
	}

	// FACEBOOK CHAT SETTINGS
	function facebook_chat_settings()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "facebook_chat_settings/index.php";
			$page_data['folder'] = "facebook_chat_settings";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "facebook_chat_settings/index.php";
			$page_data['page_name'] = "facebook_chat_settings";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_facebook_chat_settings()
	{
		$facebook_chat_activation = $this->input->post('facebook_chat_activation');
		if (isset($facebook_chat_activation)) {
			$data1['value'] = "yes";
		} else {
			$data1['value'] = "no";
		}
		$data2['value'] = $this->input->post('facebook_chat_page_id');
		$data3['value'] = $this->input->post('facebook_chat_logged_in_greeting');
		$data4['value'] = $this->input->post('facebook_chat_logged_out_greeting');
		$data5['value'] = $this->input->post('facebook_chat_theme_color');

		$this->db->where('type','facebook_chat_set');
		$result = $this->db->update('third_party_settings', $data1);

		$this->db->where('type','facebook_chat_page_id');
		$result = $this->db->update('third_party_settings', $data2);

		$this->db->where('type','facebook_chat_logged_in_greeting');
		$result = $this->db->update('third_party_settings', $data3);

		$this->db->where('type','facebook_chat_logged_out_greeting');
		$result = $this->db->update('third_party_settings', $data4);

		$this->db->where('type','facebook_chat_theme_color');
		$result = $this->db->update('third_party_settings', $data5);

		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/facebook_chat_settings', 'refresh');
	}



	function seo_settings()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "seo_settings/index.php";
			$page_data['folder'] = "seo_settings";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "seo_settings/index.php";
			$page_data['page_name'] = "seo_settings";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_seo_settings()
	{
		$data1['value'] = $this->input->post('seo_keywords');
		$data2['value'] = $this->input->post('seo_author');
		$data3['value'] = $this->input->post('seo_revisit');
		$data4['value'] = $this->input->post('seo_description');
		$data5['value'] = $this->input->post('title');

		$this->db->where('general_settings_id', 25);
		$result = $this->db->update('general_settings', $data1);

		$this->db->where('general_settings_id', 26);
		$result = $this->db->update('general_settings', $data2);

		$this->db->where('general_settings_id', 54);
		$result = $this->db->update('general_settings', $data3);

		$this->db->where('general_settings_id', 24);
		$result = $this->db->update('general_settings', $data4);

		$this->db->where('general_settings_id', 89);
		$result = $this->db->update('general_settings', $data5);

		if(!demo()){
			$is_edit = $this->input->post('is_edit');

			if ($is_edit == '0') {
				if ($_FILES['seo_image_facebook']['name'] !== '') {
					$path = $_FILES['seo_image_facebook']['name'];
					$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
					$img_file_name = "seo_image_facebook_".time().$ext;
					if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
						move_uploaded_file($_FILES['seo_image_facebook']['tmp_name'], 'uploads/seo_image/'.$img_file_name);

						$data['value'] = $img_file_name;

						$this->db->where('type', 'seo_image_facebook');
						$this->db->update('general_settings', $data);
						recache();

						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_image');
					}
				}

				elseif ($_FILES['seo_image_twitter']['name'] !== '') {
					$path = $_FILES['seo_image_twitter']['name'];
					$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
					$img_file_name = "seo_image_twitter_".time().$ext;
					if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
						move_uploaded_file($_FILES['seo_image_twitter']['tmp_name'], 'uploads/seo_image/'.$img_file_name);

						$data['value'] = $img_file_name;

						$this->db->where('type', 'seo_image_twitter');
						$this->db->update('general_settings', $data);
						recache();

						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_image');
					}
				}
			}
			elseif ($is_edit == '1') {

				$prev_seo_fb_image = $this->db->get_where('general_settings', array('type' => 'seo_image_facebook'))->row()->value;

				if ($_FILES['seo_image_facebook']['name'] !== '') {
					$path = $_FILES['seo_image_facebook']['name'];
					$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
					$img_file_name = "seo_image_facebook_".time().$ext;
					if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
						move_uploaded_file($_FILES['seo_image_facebook']['tmp_name'], 'uploads/seo_image/'.$img_file_name);

						$data['value'] = $img_file_name;

						$this->db->where('type', 'seo_image_facebook');
						$this->db->update('general_settings', $data);
						recache();

						if ($prev_seo_fb_image != '' && file_exists('uploads/seo_image/'.$prev_seo_fb_image)) {
							unlink('uploads/seo_image/'.$prev_seo_fb_image);
						}
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_image');
					}
				}
				elseif ($_FILES['seo_image_twitter']['name'] !== '') {
					$prev_seo_twitter_image = $this->db->get_where('general_settings', array('type' => 'seo_image_twitter'))->row()->value;
					$path = $_FILES['seo_image_twitter']['name'];
					$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
					$img_file_name = "seo_image_twitter_".time().$ext;
					if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
						move_uploaded_file($_FILES['seo_image_twitter']['tmp_name'], 'uploads/seo_image/'.$img_file_name);

						$data['value'] = $img_file_name;

						$this->db->where('type', 'seo_image_twitter');
						$this->db->update('general_settings', $data);
						recache();

						if ($prev_seo_twitter_image != '' && file_exists('uploads/seo_image/'.$prev_seo_twitter_image)) {
							unlink('uploads/seo_image/'.$prev_seo_twitter_image);
						}
						$this->session->set_flashdata('alert', 'edit');
					}
					else {
						$this->session->set_flashdata('alert', 'failed_image');
					}
				}
			}
		}
		recache();

		if ($result) {
			$this->session->set_flashdata('alert', 'edit');
		}
		else {
			$this->session->set_flashdata('alert', 'failed_edit');
		}
		redirect(base_url().'admin/seo_settings', 'refresh');
	}

	function email_setup()
	{
		if ($this->admin_permission() == FALSE) {
        	redirect(base_url().'admin/login', 'refresh');
		}
		else {
			$page_data['title'] = "Admin || ".$this->system_title;
			$page_data['top'] = "email_setup/index.php";
			$page_data['folder'] = "email_setup";
			$page_data['file'] = "index.php";
			$page_data['bottom'] = "email_setup/index.php";
			$page_data['page_name'] = "email_setup";
			if ($this->session->flashdata('alert') == "edit") {
				$page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
			}
			elseif ($this->session->flashdata('alert') == "failed_edit") {
				$page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
			}

			$this->load->view('back/index', $page_data);
		}
	}

	function update_email_setup($para1 = "")
	{
		if ($para1=="password_reset_email") {
			$data1['subject'] = $this->input->post('password_reset_email_sub');
			$data2['body'] = $this->input->post('password_reset_email_body');

			$this->db->where('email_template_id', 1);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 1);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="package_purchase_email") {
			$data1['subject'] = $this->input->post('account_approval_email_sub');
			$data2['body'] = $this->input->post('account_approval_email_body');

			$this->db->where('email_template_id', 2);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 2);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="account_opening_email") {
			$data1['subject'] = $this->input->post('account_opening_email_sub');
			$data2['body'] = $this->input->post('account_opening_email_body');

			$this->db->where('email_template_id', 4);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 4);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="account_opening_from_admin_email") {
			$data1['subject'] = $this->input->post('account_opening_from_admin_email_sub');
			$data2['body'] = $this->input->post('account_opening_from_user_email_body');

			$this->db->where('email_template_id', 7);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 7);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="staff_add_email") {
			$data1['subject'] = $this->input->post('staff_add_email_sub');
			$data2['body'] = $this->input->post('staff_add_email_body');

			$this->db->where('email_template_id', 5);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 5);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="member_approval_email") {
			$data1['subject'] = $this->input->post('member_approval_email_sub');
			$data2['body'] = $this->input->post('member_approval_email_body');

			$this->db->where('email_template_id', 6);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 6);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
		elseif ($para1=="member_registration_email_to_admin") {
			$data1['subject'] = $this->input->post('member_registration_email_to_admin_sub');
			$data2['body'] = $this->input->post('member_registration_email_to_admin_body');

			$this->db->where('email_template_id', 8);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 8);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}

		elseif ($para1=="account_opening_by_user_member_approval_deactivated") {
			$data1['subject'] = $this->input->post('account_opening_by_user_member_approval_deactivated_sub');
			$data2['body'] = $this->input->post('account_opening_by_user_member_approval_deactivated_body');

			$this->db->where('email_template_id', 9);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 9);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}

		elseif ($para1=="resend_email_verification_email") {
			$data1['subject'] = $this->input->post('resend_email_verification_email_sub');
			$data2['body'] = $this->input->post('resend_email_verification_email_body');

			$this->db->where('email_template_id', 10);
			$result = $this->db->update('email_template', $data1);

			$this->db->where('email_template_id', 10);
			$result = $this->db->update('email_template', $data2);
			recache();

			if ($result) {
				$this->session->set_flashdata('alert', 'edit');
			}
			else {
				$this->session->set_flashdata('alert', 'failed_edit');
			}
			redirect(base_url().'admin/email_setup', 'refresh');
		}
	}

	function check_login()
	{
		if ($this->admin_permission() == TRUE) {
        	redirect(base_url().'admin/', 'refresh');
		}
		else{
			$username = $this->input->post('email');
	        $password = sha1($this->input->post('password'));

	        $result = $this->Crud_model->check_login('admin', $username, $password);
	        // echo $this->db->last_query();

	        $data = array();
	        if($result)
	        {
	            $data['admin_name'] = $result->email;
	            $data['admin_id'] = $result->admin_id;

	            $this->session->set_userdata($data);

	            redirect( base_url().'admin/', 'refresh' );
	        }
	        else {
	            $this->session->set_flashdata('alert','login_error');

	            redirect( base_url().'admin/login', 'refresh' );
	        }
		}
	}

	function logout()
	{
		$this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin_id');

        redirect(base_url().'admin/login', 'refresh');
	}

	// Sql and script backup
	function backup($para1 = "", $para2 = "")
	{

		if ($this->admin_permission() == FALSE) {
			redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {


		        if(file_exists('downloaded-sql-backup.zip')){
		            unlink('downloaded-sql-backup.zip');
		        }else if(file_exists('downloaded-project-backup.zip')){
		            unlink('downloaded-project-backup.zip');
		        }else if(file_exists('downloaded-script-backup.zip')){
		            unlink('downloaded-script-backup.zip');

		        }
				$page_data['top'] 		= "backup/index.php";
				$page_data['folder'] 	= "backup";
				$page_data['file'] 		= "index.php";
				$page_data['bottom']	= "backup/index.php";
				$page_data['page_name'] = "backup";

				if ($this->session->flashdata('alert') == "backup_success") {
					$page_data['success_alert'] = translate("backup_completed!");
				}
				elseif ($this->session->flashdata('alert') == "download_success") {
					$page_data['success_alert'] = translate("downloaded!");
				}
				elseif ($this->session->flashdata('alert') == "backup_error") {
					$page_data['danger_alert'] = translate("something_went_wrong!");
				}
				elseif ($this->session->flashdata('alert') == "demo_error") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo");
				}

				$this->load->view('back/index', $page_data);
			}
			elseif ($para1 == "get_backup") {
				if(demo()){
				   $this->session->set_flashdata('alert', 'demo_error');
				   redirect(base_url().'admin/backup', 'refresh');
				}
				ini_set('memory_limit', '2048M');
		        ini_set('max_execution_time', 600);

		        $this->load->library('zip');
		        $this->load->helper('download');
		        $this->load->helper('file');
		        $this->zip->clear_data();

		        $root = FCPATH;

		        $backup_mode = $this->input->post('backup_mode');
		        $download_mode = $this->input->post('download_mode');

		        $error = '';

				//sql backup, download or save in root
		        if ($backup_mode == 'only_sql' || $backup_mode == 'both') {

		            $this->load->dbutil();
		            $prefs = array(
		                'tables' => array(),                     // Array of tables to backup.
		                'ignore' => array(),                     // List of tables to omit from the backup
		                'format' => "zip",                       // gzip, zip, txt
		                'filename' => "matrimonial_db_backup.sql",          // File name - NEEDED ONLY WITH ZIP FILES
		                'add_drop' => TRUE,                        // Whether to add DROP TABLE statements to backup file
		                'add_insert' => TRUE,                        // Whether to add INSERT data to backup file
		                'newline' => "\n"                         // Newline character used in backup file
		            );

		            $sql_backup =& $this->dbutil->backup($prefs);
					$sql_file_name = $download_mode == 'download' ? 'downloaded-sql-backup.zip' : 'sql-backup-on-' . date("Y-m-d-H") . '.zip';
		            $sql_save = $root . '/' . $sql_file_name;

		            $this->load->helper('file');
		            try {
		                write_file($sql_save, $sql_backup);
		                $this->zip->clear_data();

		            } catch (Exception $e) {
						echo 'not done';
		                $error .= "Sql could not be saved.";
		            }

		            if ($backup_mode == 'only_sql' && $download_mode == 'download') {
		                force_download($sql_file_name, $sql_backup);
		                unlink($sql_file_name);
		                $this->zip->clear_data();

		                if ($error == "") {
							$this->session->set_flashdata('alert', 'download_success');
		                } else {
		                    $this->session->set_flashdata('alert', 'backup_error');
		                }
		                redirect(base_url().'admin/backup', 'refresh');
		            }
		        }

		        //full project backup with or without sql
		        if ($backup_mode == 'only_script' || $backup_mode == 'both') {

					$file_name = '';

		            if ($backup_mode == 'both' && $download_mode == 'root') {
		                $file_name = 'project-backup-on-' . date("Y-m-d-H") . '.zip';
		            } else if ($backup_mode == 'only_script' && $download_mode == 'root') {
		                $file_name = 'script-backup-on-' . date("Y-m-d-H") . '.zip';
		            } else if ($backup_mode == 'both' && $download_mode == 'download') {
		                $file_name = 'downloaded-project-backup' . '.zip';
		            } else if ($backup_mode == 'only_script' && $download_mode == 'download') {
		                $file_name = 'downloaded-script-backup' . '.zip';
		            }

		            $this->zip->clear_data();
					$this->zip->read_dir('./application');
		            $this->zip->read_dir('./session');
		            $this->zip->read_dir('./system');
		            $this->zip->read_dir('./template');
		            $this->zip->read_dir('./updates');
		            $this->zip->read_dir('./uploads');

		            $this->zip->read_file('.htaccess');
		            $this->zip->read_file('index.php');

		            if($backup_mode == 'both'){
		                $this->zip->read_file($sql_file_name);
		            }

		            if ($download_mode == 'download') {

		                try {
		                    $this->zip->download($file_name);
		                    $this->zip->clear_data();
		                } catch (Exception $e) {
		                    $error .= "Script could not be zipped.";
		                }

		                if ($error == "") {
							 $this->session->set_flashdata('alert', 'download_success');
		                } else {
							$this->session->set_flashdata('alert', 'backup_error');
		                }
		                redirect(base_url().'admin/backup', 'refresh');

		            } else if ($download_mode == 'archive') {

		                try {
		                    $this->zip->archive($root . '/' . $file_name);
		                    $this->zip->clear_data();
		                } catch (Exception $e) {
		                    $error .= "Script could not be archived.";
		                }

		            }

		            if ($backup_mode == 'both' && isset($sql_save)) {
		                unlink($sql_file_name);
		            }

		        }

		        if ($download_mode == 'archive') {

		            $backup_success_text = translate("Backup completed");

		            if ($error == "") {
		                $this->session->set_flashdata('alert', 'backup_success');
		            } else {
		                $this->session->set_flashdata('alert', 'backup_error');
		            }
		           redirect(base_url().'admin/backup', 'refresh');
		        }
		        redirect(base_url().'admin/backup', 'refresh');
			}
		}
	}




	function update($para1 = "", $para2 = "")
	{
		if ($this->admin_permission() == FALSE) {
			redirect(base_url().'admin/login', 'refresh');
		}
		else{
			$page_data['title'] = "Admin || ".$this->system_title;
			if ($para1=="") {
				$page_data['top'] 		= "update/index.php";
				$page_data['folder'] 	= "update";
				$page_data['file'] 		= "index.php";
				$page_data['bottom']	= "update/index.php";
				$page_data['page_name'] = "update";

				if ($this->session->flashdata('alert') == "update_success") {
					$page_data['success_alert'] = translate("script_updated_successfully!");
				}
				elseif ($this->session->flashdata('alert') == "update_fail") {
					$page_data['danger_alert'] = translate("something_went_wrong!");
				}
				elseif ($this->session->flashdata('alert') == "demo_error") {
					$page_data['danger_alert'] = translate("this_operation_is_disabled_in_demo");
				}
				$this->load->view('back/index', $page_data);
			}
			elseif ($para1 == "do_update") {
				if(demo()){
				   $this->session->set_flashdata('alert', 'demo_error');
				   redirect(base_url().'admin/update', 'refresh');
				}

		        $error = '';
		        if(!empty($_FILES)){
		            try{
		                move_uploaded_file($_FILES['update']['tmp_name'], FCPATH.'/update.zip' );
		            }catch (Exception $e){
		                $error.= $e->getMessage();

		                die($e->getMessage());
		            }


		            if(empty($error) && file_exists('update.zip')){
						//extract
				        $zip = new ZipArchive();
				        $file = $zip->open('update.zip');
				        if ($file === TRUE) {
				            $zip->extractTo(FCPATH);
				            $zip->close();
				            unlink('update.zip');
				        }

				        //import sql
				        if(file_exists('update.sql')){

				            // Set line to collect lines that wrap
				            $templine = '';
				            // Read in entire file
				            $lines = file('update.sql');

				            // Loop through each line
				            foreach ($lines as $line)
				            {
				                // Skip it if it's a comment
				                if (substr($line, 0, 2) == '--' || $line == '')
				                    continue;

				                // Add this line to the current templine we are creating
				                $templine .= $line;

				                // If it has a semicolon at the end, it's the end of the query so can process this templine
				                if (substr(trim($line), -1, 1) == ';')
				                {
				                    // Perform the query
				                    $this->db->query($templine);

				                    // Reset temp variable to empty
				                    $templine = '';
				                }
				            }

				            unlink('update.sql');
				        }
						$this->session->set_flashdata('alert', 'update_success');
		            }

		            if(!empty($error)){
		                $this->session->set_flashdata('alert', 'update_fail');
		            }
		        }
		        redirect("admin/update");
			}
		}
	}



	function test()
	{

	}

}
