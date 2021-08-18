<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Mycontroller{ 

	public function __construct(){
     $layout= 'layout/main';
          parent::__construct();
		  
     }
	
	public function addBranch() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='admin') {
			$data['title'] 	 = 'Dashboard | Admin | Add Branch';
			$data['content'] = 'admin/setting/addBranch';
			
			$branch['company_id'] = $this->session->userdata('company_id');
			$branch['branch_name']= $this->input->post('branch_name');
			$branch['address']= $this->input->post('address');
			$branch['country']= $this->input->post('country');
			$branch['state']= $this->input->post('state');
			$branch['city']= $this->input->post('city');
			$branch['pincode']= $this->input->post('pincode');
			$branch['description']= $this->input->post('description');
			$branch['gstnumber'] = $this->input->post('gstnumber');
			$branch['createdby']			= $this->session->userdata('loginid');
			$branch['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			//Company User Details
			$user_detail['name'] = $this->input->post('person_name');
			$user['username'] = $this->input->post('username');
			$password = $this->randomKey(6);
			$user['salt'] = md5(rand(00000,99999));
			$p = hash("sha256", $password.$user['salt']);
			$user['password'] = $p;
			$user['mobile'] = $this->input->post('mobile');
			$user['email'] = $this->input->post('email');
			
			$user['role'] = 3;
			$user['status'] = 1;
			$user['type'] = 3;
			
			$user['is_approved'] = 1;
			$user['createdby']			= $this->session->userdata('loginid');
			$user['createdon']			= date_timestamp_get(date_create());
			
			$this->form_validation->set_rules("branch_name", "Branch Name", "trim|required");
			$this->form_validation->set_rules("person_name", "Contact Person", "trim|required");
			$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[tbl_users.username]");
			$this->form_validation->set_rules("mobile", "Mobile", "trim|required|numeric|min_length[10]|is_unique[tbl_users.mobile]");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			$this->form_validation->set_rules("gstnumber", "GST Number is required", "trim|required");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  
					  $insert_c_id = $this->SettingModel->InsertData('tbl_branch', $branch);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_c_id) {
						  
						  $user['company_id'] = $this->session->userdata('company_id');
						  $user['branch_id'] = $insert_c_id;
						  $insert_u_id = $this->SettingModel->InsertData('tbl_users',$user);
						  if($insert_u_id){
							  $user_detail['user_id'] = $insert_u_id;
						  $insert_ud_id = $this->SettingModel->InsertData('tbl_user_details',$user_detail);
						  if($insert_ud_id){
							  $msg = 'Your OTP for login is '.$password.' .Do not share with anybody. Regards, Omax Security';
							  $sendsms = $this->sendSMS($user['mobile'],$msg);
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('admin/Setting/addBranch');
						  		}
						  }
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('admin/Setting/addBranch');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function BranchList() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='admin') {
			$data['title'] 	 = 'Dashboard | admin | Branch List';
			$data['content'] = 'admin/setting/BranchList';
			
			$data['branchList'] = $this->SettingModel->getListWhere('*','tbl_branch','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
          
			$data['branchstatus'] = $this->CommanModel->getDataIfdataexists('status,id','tbl_users',array('company_id'=> $data['branchList'][0]['company_id'])); 
			
			
			
			
			
			$this->load->view($this->layout, $data);
			  
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editBranch($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='admin') {
			$data['title'] 	 = 'Dashboard | Admin | Add Branch';
			$data['content'] = 'admin/setting/editBranch';
			$data['branchdetail'] = $this->CommanModel->getDataIfdataexists('*','tbl_branch',array('id'=>$id));
			
			
			$branch['company_id'] = $this->session->userdata('company_id');
			$branch['branch_name']= $this->input->post('branch_name');
			$branch['address']= $this->input->post('address');
			$branch['country']= $this->input->post('country');
			$branch['state']= $this->input->post('state');
			$branch['city']= $this->input->post('city');
			$branch['pincode']= $this->input->post('pincode');
			$branch['description']= $this->input->post('description');
			$branch['gstnumber'] = $this->input->post('gstnumber');
			
			//echo var_dump($_POST); exit;
			
		
			$branch['updatedby']			= $this->session->userdata('loginid');
			$branch['updatedon']			= date_timestamp_get(date_create());
			
			$this->form_validation->set_rules("branch_name", "Branch Name", "trim|required");
			$this->form_validation->set_rules("address", "Address", "trim|required");
			$this->form_validation->set_rules("country", "Country", "trim|required");
			$this->form_validation->set_rules("state", "State", "trim|required");
			$this->form_validation->set_rules("city", "City", "trim|required");
			$this->form_validation->set_rules("pincode", "Pin Code", "trim|required");
			
			$this->form_validation->set_rules("gstnumber", "GST Number is required", "trim|required");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					
					    $insert_c_id = $this->CommanModel->Ifdataexists('id','tbl_branch',array('id'=>$this->input->post('hidetxt')));
					    if($insert_c_id)
						{
							$this->CommanModel->UpdateData('tbl_branch',$branch,array('id'=>$this->input->post('hidetxt')));
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Updated Successfull</div>');
							redirect('admin/Setting/BranchList');
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Not Updated.</div>');
							redirect('admin/Setting/editBranch');
						}
					}
				   else {
							
							$this->load->view($this->layout,$data);			
					} 
				}
			
			
		}
		else{
		
				redirect('web/index');	
		}
		
	}	
	
	public function profile()
	{
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='admin') {
			$data['title'] 	 = 'Dashboard | Admin | Add Branch';
			$data['content'] = 'admin/setting/profile';
			$data['admindetail'] = $this->CommanModel->getDataIfdataexists('*','tbl_users',array('username'=>$this->session->userdata('username')));
			$data['admindetail2'] = $this->CommanModel->getDataIfdataexists('*','tbl_user_details',array('user_id'=>$data['admindetail']['id']));
			if ($this->input->post('submit') == "Update") {
				
				$admin['user_id'] = $this->input->post('hidetxt');
				$admin['name']= $this->input->post('name');
				$admin1['mobile']= $this->input->post('mobile');
				$admin['address']= $this->input->post('address');
				$admin['country']= $this->input->post('country');
				$admin['state']= $this->input->post('state');
				$admin['city']= $this->input->post('city');
				$admin['zipcode']= $this->input->post('zipcode');
				
				$this->form_validation->set_rules("name", "Name", "trim|required");
				$this->form_validation->set_rules("address", "Address", "trim|required");
				$this->form_validation->set_rules("country", "Country", "trim|required");
				$this->form_validation->set_rules("state", "State", "trim|required");
				$this->form_validation->set_rules("city", "City", "trim|required");
				$this->form_validation->set_rules("zipcode", "Zip Code", "trim|required");
				
				 if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			     
				 }else
				 {
					 $insert_u_id = $this->CommanModel->Ifdataexists('user_id','tbl_user_details',array('user_id'=>$this->input->post('hidetxt'))); 
					 if($insert_u_id)
					 {
						  $this->CommanModel->UpdateData('tbl_user_details',$admin,array('user_id'=>$this->input->post('hidetxt')));
						  $this->CommanModel->UpdateData('tbl_users',$admin1,array('id'=>$this->input->post('hidetxt')));
						   if(!empty($_FILES['profile_photo']))
							   {
									$config['upload_path'] = 'uploads/profile/';
									$config['allowed_types'] = '*';
									$config['max_size'] = '0';
									$config['max_filename'] = '255';
									$config['encrypt_name'] = TRUE;
									$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) {
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('profile_photo'))
										{
									      echo $this->upload->display_errors();
									      $is_file_error = TRUE;
						                }
									    else
										{
							               $file = $this->upload->data();
						                }
					            }	
							    if (!$is_file_error) {
							    $this->SettingModel->save_file_info($file, array('user_id'=>$this->input->post('hidetxt')),'tbl_user_details','profile_photo');
						
						
					}
							}
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Profile Updated Successfull</div>');
						 redirect('admin/Setting/profile');
					 }
					 else
					 {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Profile Not Updated!!!!</div>');
						 redirect('admin/Setting/profile');
					 }
				 }
				
			}
			else
			{
			     $this->load->view($this->layout,$data);
			}
		}
		else
		{
			redirect('web/index');
		}
	}
	
}
