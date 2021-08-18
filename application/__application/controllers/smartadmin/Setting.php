<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Mycontroller{ 

	public function __construct(){
     $layout= 'layout/main';
          parent::__construct();
		  
     }
	
	public function addCompany() {
         
		if ($this->session->userdata('loginid')) {
			$data['title'] 	 = 'Dashboard | Smartadmin | Add Company';
			$data['content'] = 'smartadmin/setting/companyMaster';
			
			$company['company_name']= $this->input->post('cname');
			$company['financial_year_from']= $this->convertDatetoMysqlDate($this->input->post('financial_year_from'));
			$company['financial_year_to']= $this->convertDatetoMysqlDate($this->input->post('financial_year_to'));
			$company['establishment_date']= $this->convertDatetoMysqlDate($this->input->post('establishment_date'));
			$company['company_regi_no']= $this->input->post('company_regi_no');
			$company['licence_no']= $this->input->post('licence_no');
			$company['pan_cord_no']= $this->input->post('pan_cord_no');
			$company['tax_deduction_ac_no']= $this->input->post('tax_deduction_ac_no');
			$company['pf_regi_no']= $this->input->post('pf_regi_no');
			$company['pf_regi_date']= $this->convertDatetoMysqlDate($this->input->post('pf_regi_date'));
			$company['policy_in_lieu_edli_no']= $this->input->post('policy_in_lieu_edli_no');
			$company['policy_in_lieu_edli_date']= $this->convertDatetoMysqlDate($this->input->post('policy_in_lieu_edli_date'));
			$company['esi_regi_no']= $this->input->post('esi_regi_no');
			$company['esi_regi_date']= $this->convertDatetoMysqlDate($this->input->post('esi_regi_date'));
			$company['gratuity_reg_no']= $this->input->post('gratuity_reg_no');
			$company['address']= $this->input->post('address');
			$company['country']= $this->input->post('country');
			$company['state']= $this->input->post('state');
			$company['city']= $this->input->post('city');
			$company['pincode']= $this->input->post('pincode');
			$company['createdby']			= $this->session->userdata('loginid');
			$company['createdon']			= date_timestamp_get(date_create());
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
			$user['role'] = 2;
			$user['status'] = 1;
			$user['type'] = 2;
			$user['branch_id'] = 0;
			$user['is_approved'] = 1;
			$user['createdby']			= $this->session->userdata('loginid');
			$user['createdon']			= date_timestamp_get(date_create());
			
			$this->form_validation->set_rules("cname", "Company Name", "trim|required");
			$this->form_validation->set_rules("company_regi_no", "Company Registration", "trim|required");
			$this->form_validation->set_rules("pan_cord_no", "PAN Card No.", "trim|required","PAN Card No. is Requed");
			$this->form_validation->set_rules("person_name", "Contact Person", "trim|required");
			$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[tbl_users.username]");
			$this->form_validation->set_rules("mobile", "Mobile", "trim|required|numeric|min_length[10]|is_unique[tbl_users.mobile]");
			$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  
					  $insert_c_id = $this->SettingModel->InsertData('tbl_company',$company);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_c_id) {
						  if(!empty($_FILES['logo'])){
							$config['upload_path'] = 'uploads/company_logo/';
							$config['allowed_types'] = '*';
							$config['max_size'] = '0';
							$config['max_filename'] = '255';
							$config['encrypt_name'] = TRUE;
							$file = array();
							$is_file_error = FALSE;
							if (!$is_file_error) {
								$s =  $this->upload->initialize($config);
								if (!$this->upload->do_upload('logo')) {
							echo $this->upload->display_errors();
							$is_file_error = TRUE;
						} else {
							$file = $this->upload->data();
						}
					}	
							if (!$is_file_error) {
						$this->SettingModel->save_file_info($file, array('id'=>$insert_c_id),'tbl_company','logo_path');
						
						
					}
							}
						  $user['company_id'] = $insert_c_id;
						  $insert_u_id = $this->SettingModel->InsertData('tbl_users',$user);
						  if($insert_u_id){
							  $user_detail['user_id'] = $insert_u_id;
						  $insert_ud_id = $this->SettingModel->InsertData('tbl_user_details',$user_detail);
						  if($insert_ud_id){
							  $msg = 'Your OTP for login is '.$password.' .Do not share with anybody. Regards, Omax Security';
							  $sendsms = $this->sendSMS($user['mobile'],$msg);
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('smartadmin/Setting/addCompany');
						  		}
						  }
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('smartadmin/Setting/addCompany');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	public function CompanyList() {
         
		if ($this->session->userdata('loginid')) {
			$data['title'] 	 = 'Dashboard | Smartadmin | Add Company';
			$data['content'] = 'smartadmin/setting/ComapnyList';
			
			
			   $this->load->view($this->layout, $data);
			  
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	
		
	
	
}
