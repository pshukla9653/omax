`<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Mycontroller{ 

	
	
	public function __construct(){
     
          parent::__construct();
		  $this->load->library('mycalendar');
		  
     }
	 
	
	public function addDepartment() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/setting/addDepartment';
			
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getList('*','tbl_department','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("department_name", "Department Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_department', array('department_name'=>$department['department_name']));
					  
					  
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_department', $department);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addDepartment');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addDepartment');			
								} 
					  }
					  else{
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist</div>');
							  		redirect('branchadmin/Setting/addDepartment');	
					  }
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editDepartment($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Department';
			$data['content'] = 'branchadmin/setting/editDepartment';
			
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department_name_hidden				= strtoupper($this->input->post('department_name_hidden'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['updatedby']			= $this->session->userdata('loginid');
			$department['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getList('*','tbl_department','id', 'ASC');
			$data['editdepartment'] = $this->SettingModel->getData('tbl_department', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("department_name", "Department Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($department['department_name']==$department_name_hidden){
									if($data['editdepartment'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_department',$department, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDepartment');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editDepartment/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDepartment/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_department', array('department_name'=>$department['department_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editDepartment/'.$id);
									}
									
								}
								else{
									if($data['editdepartment'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_department',$department, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDepartment');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDepartment/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addDesignation() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Designation';
			$data['content'] = 'branchadmin/setting/addDesignation';
			
			$designation['company_id'] 			= $this->session->userdata('company_id');
			$designation['branch_id'] 			= $this->session->userdata('branch_id');
			$designation['designation_name']		= strtoupper($this->input->post('designation_name'));
			$designation['description']			= $this->input->post('description');
			$designation['status']				= $this->input->post('status');
			$designation['createdby']			= $this->session->userdata('loginid');
			$designation['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['designationList'] = $this->SettingModel->getList('*','tbl_designation','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("designation_name", "Designation Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 //echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_designation', array('designation_name'=>$designation['designation_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_designation', $designation);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addDesignation');
						  
								}
					else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addDesignation');			
								} 
					  }
					  else
						  {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record already exist</div>');
							  		redirect('branchadmin/Setting/addDesignation');			
								}
					 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editDesignation($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Designation';
			$data['content'] = 'branchadmin/setting/editDesignation';
			
			$designation['company_id'] 			= $this->session->userdata('company_id');
			$designation['branch_id'] 			= $this->session->userdata('branch_id');
			$designation['designation_name']		= strtoupper($this->input->post('designation_name'));
			$designation_name_hidden				= strtoupper($this->input->post('designation_name_hidden'));
			$designation['description']			= $this->input->post('description');
			$designation['status']				= $this->input->post('status');
			$designation['updatedby']			= $this->session->userdata('loginid');
			$designation['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['designationList'] = $this->SettingModel->getList('*','tbl_designation','id', 'ASC');
			$data['editdesignation'] = $this->SettingModel->getData('tbl_designation', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("designation_name", "Designation Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($designation['designation_name']==$designation_name_hidden){
									if($data['editdesignation'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_designation',$designation, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDesignation');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editDesignation/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDesignation/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_designation', array('designation_name'=>$designation['designation_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editDesignation/'.$id);
									}
									
								}
								else{
									if($data['editdesignation'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_designation',$designation, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDesignation');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDesignation/'.$id);	
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addBank() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Bank';
			$data['content'] = 'branchadmin/setting/addBank';
			
			$bank['company_id'] 			= $this->session->userdata('company_id');
			$bank['branch_id'] 			= $this->session->userdata('branch_id');
			$bank['bank_name']		= strtoupper($this->input->post('bank_name'));
			$bank['status']				= $this->input->post('status');
			$bank['createdby']			= $this->session->userdata('loginid');
			$bank['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['bankList'] = $this->SettingModel->getList('*','tbl_bank','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("bank_name", "Bank Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_bank', array('bank_name'=>$bank['bank_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_bank', $bank);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addBank');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addBank');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist</div>');
							  		redirect('branchadmin/Setting/addBank');			
								}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editBank($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Bank';
			$data['content'] = 'branchadmin/setting/editBank';
			
			$bank['company_id'] 			= $this->session->userdata('company_id');
			$bank['branch_id'] 			= $this->session->userdata('branch_id');
			$bank['bank_name']		= strtoupper($this->input->post('bank_name'));
			$bank_name_hidden				= strtoupper($this->input->post('bank_name_hidden'));
			$bank['status']				= $this->input->post('status');
			$bank['updatedby']			= $this->session->userdata('loginid');
			$bank['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['bankList'] = $this->SettingModel->getList('*','tbl_bank','id', 'ASC');
			$data['editbank'] = $this->SettingModel->getData('tbl_bank', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("bank_name", "Bank Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($bank['bank_name']==$bank_name_hidden){
									if($data['editbank'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_bank',$bank, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addBank');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editBank/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editBank/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_bank', array('bank_name'=>$bank['bank_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editBank/'.$id);
									}
									
								}
								else{
									if($data['editbank'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_bank',$bank, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addBank');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editBank/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}	
	
	public function addBankBranch() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Bank Branch';
			$data['content'] = 'branchadmin/setting/addBankBranch';
			
			$bank['company_id'] 		= $this->session->userdata('company_id');
			$bank['branch_id'] 			= $this->session->userdata('branch_id');
			$bank['bank_id'] 			= $this->input->post('bank_id');
			$bank['branch_name']		= strtoupper($this->input->post('branch_name'));
			$bank['ifsc_code']			= $this->input->post('ifsc_code');
			$bank['micr_code']			= $this->input->post('micr_code');
			$bank['status']				= $this->input->post('status');
			$bank['createdby']			= $this->session->userdata('loginid');
			$bank['createdon']			= date_timestamp_get(date_create());
			$bank['account_no']			= $this->input->post('account_no');
			$bank['branch_code']		= $this->input->post('branch_code');
			//echo var_dump($_POST); exit;
			
			$data['bankList'] = $this->SettingModel->getList('id,bank_name','tbl_bank','id', 'ASC');
			$data['branchList'] = $this->SettingModel->getBankBranchList();
			//Company User Details
			
			$this->form_validation->set_rules("bank_id", "Bank", "trim|required");
			$this->form_validation->set_rules("branch_name", "Branch Name", "trim|required");
			$this->form_validation->set_rules("branch_code", "Branch CODE", "trim|required");
			$this->form_validation->set_rules("account_no", "ACCOUNT NUMBER", "trim|required|numeric");
			$this->form_validation->set_rules("ifsc_code", "IFSC Code", "trim|required|is_unique[tbl_bank_branch.ifsc_code]");
			$this->form_validation->set_rules("micr_code", "MICR Code", "trim|required|is_unique[tbl_bank_branch.micr_code]");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_bank_branch', array('branch_name'=>$bank['branch_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_bank_branch', $bank);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addBankBranch');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addBankBranch');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist!</div>');
							  		redirect('branchadmin/Setting/addBankBranch');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editBankBranch($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Bank Branch';
			$data['content'] = 'branchadmin/setting/editBankBranch';
			
			$bank['company_id'] 		= $this->session->userdata('company_id');
			$bank['branch_id'] 			= $this->session->userdata('branch_id');
			$bank['bank_id'] 			= $this->input->post('bank_id');
			$bank['branch_name']		= strtoupper($this->input->post('branch_name'));
			$bank_name_hidden			= strtoupper($this->input->post('branch_name_hidden'));
			$bank['ifsc_code']			= $this->input->post('ifsc_code');
			$ifsc_code_hidden			= $this->input->post('ifsc_code_hidden');
			$bank['micr_code']			= $this->input->post('micr_code');
			$micr_code_hidden			= $this->input->post('micr_code_hidden');
			$bank['status']				= $this->input->post('status');
			$bank['updatedby']			= $this->session->userdata('loginid');
			$bank['updatedon']			= date_timestamp_get(date_create());
			$bank['account_no']			= $this->input->post('account_no');
			$bank['branch_code']		= $this->input->post('branch_code');
			//echo var_dump($_POST); exit;
			
			
			$data['bankList'] = $this->SettingModel->getList('*','tbl_bank','id', 'ASC');
			$data['editbankbranch'] = $this->SettingModel->getData('tbl_bank_branch', array('id'=>$id));
			$data['branchList'] = $this->SettingModel->getBankBranchList();

			//Company User Details
			
			
			$this->form_validation->set_rules("bank_id", "Bank", "trim|required");
			$this->form_validation->set_rules("branch_name", "Branch Name", "trim|required");
			$this->form_validation->set_rules("ifsc_code", "IFSC Code", "trim|required");
			$this->form_validation->set_rules("micr_code", "MICR Code", "trim|required");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					//echo var_dump($bank); exit;
					 if($bank['branch_name']==$bank_name_hidden && $bank['micr_code']==$micr_code_hidden && $bank['ifsc_code']==$ifsc_code_hidden){
									if($data['editbankbranch'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_bank_branch',$bank, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addBankBranch');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editBankBranch/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editBankBranch/'.$id);			
									}			
								}
					 else{
									if($f=$this->SettingModel->getData('tbl_bank_branch', array('bank_id'=>$bank['bank_id'],'ifsc_code'=>$bank['ifsc_code'],'micr_code'=>$bank['micr_code']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editBankBranch/'.$id);
									}
									
								}
								else{
									if($data['editbankbranch'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_bank_branch',$bank, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addBankBranch');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editBankBranch/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}	
	
	public function addGrade() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Grade';
			$data['content'] = 'branchadmin/setting/addGrade';
			
			$grade['company_id'] 			= $this->session->userdata('company_id');
			$grade['branch_id'] 			= $this->session->userdata('branch_id');
			$grade['grade_name']		= strtoupper($this->input->post('grade_name'));
			$grade['nature_of_work']			= $this->input->post('nature_of_work');
			$grade['description']			= $this->input->post('description');
			$grade['status']				= $this->input->post('status');
			$grade['createdby']			= $this->session->userdata('loginid');
			$grade['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['gradeList'] = $this->SettingModel->getList('*','tbl_grade','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("grade_name", "Grade Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_grade', array('grade_name'=>$designation['grade_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_grade', $grade);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addGrade');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addGrade');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist</div>');
							  		redirect('branchadmin/Setting/addGrade');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editGrade($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Grade';
			$data['content'] = 'branchadmin/setting/editGrade';
			
			$grade['company_id'] 			= $this->session->userdata('company_id');
			$grade['branch_id'] 			= $this->session->userdata('branch_id');
			$grade['grade_name']			= strtoupper($this->input->post('grade_name'));
			$grade_name_hidden				= strtoupper($this->input->post('grade_name_hidden'));
			$grade['nature_of_work']		= $this->input->post('nature_of_work');
			$grade['description']			= $this->input->post('description');
			$grade['status']				= $this->input->post('status');
			$grade['updatedby']				= $this->session->userdata('loginid');
			$grade['updatedon']				= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['gradeList'] = $this->SettingModel->getList('*','tbl_grade','id', 'ASC');
			$data['editgrade'] = $this->SettingModel->getData('tbl_grade', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("grade_name", "Grade Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($grade['grade_name']==$grade_name_hidden){
									if($data['editgrade'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_grade',$grade, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addGrade');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editGrade/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editGrade/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_grade', array('grade_name'=>$grade['grade_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editGrade/'.$id);
									}
									
								}
								else{
									if($data['editgrade'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_grade',$grade, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addGrade');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editGrade/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addAllowance() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Income';
			$data['content'] = 'branchadmin/setting/addIncome';
			
			$income['company_id'] 			= $this->session->userdata('company_id');
			$income['branch_id'] 			= $this->session->userdata('branch_id');
			$income['allowance_name']		= strtoupper($this->input->post('allowance_name'));
			$income['mode_of_payment']		= $this->input->post('mode_of_payment');
			$income['status']				= $this->input->post('status');
			$income['createdby']			= $this->session->userdata('loginid');
			$income['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['incomeList'] = $this->SettingModel->getList('*','tbl_allowance','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("allowance_name", "Allowance Name", "trim|required");
			$this->form_validation->set_rules("mode_of_payment", "Mode of Payment", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_allowance', array('allowance_name'=>$income['allowance_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_allowance', $income);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addAllowance');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addAllowance');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record already exist.</div>');
							  		redirect('branchadmin/Setting/addAllowance');			
								}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editAllowance($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Income';
			$data['content'] = 'branchadmin/setting/editIncome';
			
			$income['company_id'] 			= $this->session->userdata('company_id');
			$income['branch_id'] 			= $this->session->userdata('branch_id');
			$income['allowance_name']		= strtoupper($this->input->post('allowance_name'));
			$income_head_hidden				= strtoupper($this->input->post('allowance_name_hidden'));
			$income['mode_of_payment']		= $this->input->post('mode_of_payment');
			$income['status']				= $this->input->post('status');
			$income['updatedby']			= $this->session->userdata('loginid');
			$income['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['incomeList'] = $this->SettingModel->getList('*','tbl_allowance','id', 'ASC');
			$data['editincome'] = $this->SettingModel->getData('tbl_allowance', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("allowance_name", "Allowance Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($income['allowance_name']==$income_head_hidden){
									if($data['editincome'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_allowance',$income, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addAllowance');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editAllowance/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editAllowance/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_allowance', array('allowance_name'=>$income['allowance_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editAllowance/'.$id);
									}
									
								}
								else{
									if($data['editincome'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_allowance',$income, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addAllowance');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editAllowance/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addDeduction() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Deduction';
			$data['content'] = 'branchadmin/setting/addDeduction';
			
			$deduction['company_id'] 				= $this->session->userdata('company_id');
			$deduction['branch_id'] 				= $this->session->userdata('branch_id');
			$deduction['type_of_deduction']			= $this->input->post('type_of_deduction');
			
			$deduction['mode_of_deduction']			= $this->input->post('mode_of_deduction');
			if($deduction['mode_of_deduction']=='Fixed'){
			$deduction['deduction_applied_on']		= -2;
			}else{
			$deduction['deduction_applied_on']		= $this->input->post('deduction_applied_on');
			}
			$deduction['deduction_not_applied_on']	= $this->input->post('deduction_not_applied_on');
			$deduction['deduction_head']			= strtoupper($this->input->post('deduction_head'));
			$deduction['employee_contribution']		= $this->input->post('employee_contribution');
			$deduction['employer_contribution']		= $this->input->post('employer_contribution');
			$deduction['min_deduction_limit']		= $this->input->post('min_deduction_limit');
			$deduction['max_deduction_limit']		= $this->input->post('max_deduction_limit');
			$deduction['min_salary_limit']			= $this->input->post('min_salary_limit');
			$deduction['max_salary_limit']			= $this->input->post('max_salary_limit');
			
			$deduction['status']					= $this->input->post('status');
			$deduction['createdby']					= $this->session->userdata('loginid');
			$deduction['createdon']					= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['deductionList'] = $this->SettingModel->getList('*','tbl_deduction_head','id', 'ASC');
			$data['allowanceList'] = $this->SettingModel->getList('*','tbl_allowance','id', 'ASC');

			//Company User Details
			
			if($this->input->post('type_of_deduction')=='Temperary'){
			$deduction['date_from']					= date("Y-m-d", strtotime($this->input->post('date_from')));
			$deduction['date_to']					= date("Y-m-d", strtotime($this->input->post('date_to')));
			$this->form_validation->set_rules("date_from", "Date From", "trim|required");
			$this->form_validation->set_rules("date_to", "Date to", "trim|required");
			}
			if($this->input->post('mode_of_deduction')=='Calculated'){
			$this->form_validation->set_rules("deduction_applied_on", "Mode of Deduction", "trim|required");
			}
			$this->form_validation->set_rules("deduction_head", "Deduction Name", "trim|required");
			$this->form_validation->set_rules("mode_of_deduction", "Mode of Deduction", "trim|required");
			$this->form_validation->set_rules("employee_contribution", "Employee Contribution", "trim|required|numeric");
			$this->form_validation->set_rules("employer_contribution", "Employer Contribution", "trim|numeric");
			$this->form_validation->set_rules("min_deduction_limit", "Minimum Deduction Limit", "trim|numeric");
			$this->form_validation->set_rules("max_deduction_limit", "Minimum Deduction Limit", "trim|numeric");
			$this->form_validation->set_rules("min_salary_limit", "Minimum Salary Limit", "trim|numeric");
			$this->form_validation->set_rules("max_salary_limit", "Maximum Salary Limit", "trim|numeric");
			
			
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 $checkdata = $this->SettingModel->getData('tbl_deduction_head', array('deduction_head'=>$deduction['deduction_head']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_deduction_head', $deduction);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addDeduction');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addDeduction');			
								}
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record already exist.</div>');
							  		redirect('branchadmin/Setting/addDeduction');			
								}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editDeduction($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Deduction';
			$data['content'] = 'branchadmin/setting/editDeduction';
			
			$deduction['company_id'] 				= $this->session->userdata('company_id');
			$deduction['branch_id'] 				= $this->session->userdata('branch_id');
			$deduction['type_of_deduction']			= $this->input->post('type_of_deduction');
			$deduction['mode_of_deduction']			= $this->input->post('mode_of_deduction');
			$deduction['deduction_applied_on']		= $this->input->post('deduction_applied_on');
			$deduction['deduction_not_applied_on']	= $this->input->post('deduction_not_applied_on');
			$deduction['deduction_head']			= strtoupper($this->input->post('deduction_head'));
			$deduction_head_hidden					= strtoupper($this->input->post('deduction_head_hidden'));
			$deduction['employee_contribution']		= $this->input->post('employee_contribution');
			$deduction['employer_contribution']		= $this->input->post('employer_contribution');
			$deduction['min_deduction_limit']		= $this->input->post('min_deduction_limit');
			$deduction['max_deduction_limit']		= $this->input->post('max_deduction_limit');
			$deduction['min_salary_limit']			= $this->input->post('min_salary_limit');
			$deduction['max_salary_limit']			= $this->input->post('max_salary_limit');
			$deduction['status']					= $this->input->post('status');
			$deduction['updatedby']					= $this->session->userdata('loginid');
			$deduction['updatedon']					= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['deductionList'] = $this->SettingModel->getList('*','tbl_deduction_head','id', 'ASC');
			$data['editdeduction'] = $this->SettingModel->getData('tbl_deduction_head', array('id'=>$id));
			$data['allowanceList'] = $this->SettingModel->getList('*','tbl_allowance','id', 'ASC');

			//Company User Details
			//echo var_dump($data['editdeduction']); exit;
			
			if($this->input->post('type_of_deduction')=='Temperary'){
			$deduction['date_from']					= date("Y-m-d", strtotime($this->input->post('date_from')));
			$deduction['date_to']					= date("Y-m-d", strtotime($this->input->post('date_to')));
			$this->form_validation->set_rules("date_from", "Date From", "trim|required");
			$this->form_validation->set_rules("date_to", "Date to", "trim|required");
			}
			if($this->input->post('mode_of_deduction')=='Calculated'){
			$this->form_validation->set_rules("deduction_applied_on", "Mode of Deduction", "trim|required");
			}
			$this->form_validation->set_rules("deduction_head", "Deduction Name", "trim|required");
			$this->form_validation->set_rules("mode_of_deduction", "Mode of Deduction", "trim|required");
			$this->form_validation->set_rules("employee_contribution", "Employee Contribution", "trim|required|numeric");
			$this->form_validation->set_rules("employer_contribution", "Employer Contribution", "trim|numeric");
			$this->form_validation->set_rules("min_deduction_limit", "Minimum Deduction Limit", "trim|numeric");
			$this->form_validation->set_rules("max_deduction_limit", "Minimum Deduction Limit", "trim|numeric");
			$this->form_validation->set_rules("min_salary_limit", "Minimum Salary Limit", "trim|numeric");
			$this->form_validation->set_rules("max_salary_limit", "Maximum Salary Limit", "trim|numeric");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($deduction['deduction_head']==$deduction_head_hidden){
									if($data['editdeduction'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_deduction_head',$deduction, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDeduction');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editDeduction/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDeduction/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_deduction_head', array('deduction_head'=>$deduction['deduction_head']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editDeduction/'.$id);
									}
									
								}
								else{
									if($data['editdeduction'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_deduction_head',$deduction, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addDeduction');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editDeduction/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addClient() {
         
		if ($this->session->userdata('loginid')) {
			$data['title'] 	 = 'Branchadmin | Add Client';
			$data['content'] = 'branchadmin/setting/addClient';
			
			
			//FOR CLIENT 
			$client['company_id'] 				= $this->session->userdata('company_id');
			$client['branch_id'] 				= $this->session->userdata('branch_id');
			$client['industry_id']				= $this->input->post('industry_id');
			$client['client_name']				= $this->input->post('cname');
			$client['client_regi_no']			= $this->input->post('client_regi_no');
			$client['licence_no']				= $this->input->post('licence_no');
			$client['pan_cord_no']				= $this->input->post('pan_cord_no');
			$client['tax_deduction_ac_no']		= $this->input->post('tax_deduction_ac_no');
			$client['contact_person_name']		= $this->input->post('contact_person_name');
			$client['contact_person_mobile']	= $this->input->post('contact_person_mobile');
			$client['contact_person_email']		= $this->input->post('contact_person_email');
			$client['service_tax']				= $this->input->post('service_tax');
			$client['p_tax']					= $this->input->post('p_tax');
			if($this->input->post('deduction_id')!=''){
			$client['deduction_id']				= implode(',', $this->input->post('deduction_id'));
			}
			if($this->input->post('gst')!=''){
			$client['gst']				= implode(',', $this->input->post('gst'));
			}

			$client['address']					= $this->input->post('address');
			$client['country']					= $this->input->post('country');
			$client['state']					= $this->input->post('state');
			$client['city']						= $this->input->post('city');
			$client['pincode']					= $this->input->post('pincode');
			$client['status']					= $this->input->post('status');
			$client['on_up_gst']				= $this->input->post('on_up_gst');
			$client['createdby']				= $this->session->userdata('loginid');
			$client['createdon']				= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			//FOR SUB- CLINET
			$subclient['company_id'] 				= $this->session->userdata('company_id');
			$subclient['branch_id'] 				= $this->session->userdata('branch_id');
			$subclient['client_name']				= $this->input->post('ocname');
			$subclient['client_regi_no']			= $this->input->post('oclient_regi_no');
			$subclient['licence_no']				= $this->input->post('olicence_no');
			$subclient['pan_cord_no']				= $this->input->post('opan_cord_no');
			$subclient['tax_deduction_ac_no']		= $this->input->post('otax_deduction_ac_no');
			$subclient['contact_person_name']		= $this->input->post('ocontact_person_name');
			$subclient['contact_person_mobile']		= $this->input->post('ocontact_person_mobile');
			$subclient['contact_person_email']		= $this->input->post('ocontact_person_email');
			$subclient['address']					= $this->input->post('oaddress');
			$subclient['country']					= $this->input->post('ocountry');
			$subclient['state']						= $this->input->post('ostate');
			$subclient['city']						= $this->input->post('ocity');
			$subclient['pincode']					= $this->input->post('opincode');
			$subclient['createdby']					= $this->session->userdata('loginid');
			$subclient['createdon']					= date_timestamp_get(date_create());
			
			
			$data['clientList'] = $this->SettingModel->getList('*','tbl_client','id', 'ASC');
			$data['industryList'] = $this->SettingModel->getList('*','tbl_industry','id', 'ASC');
			$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');

			//Client User Details
			
			
			$this->form_validation->set_rules("industry_id", "Industry", "trim|required");
			$this->form_validation->set_rules("cname", "Client Name", "trim|required");
			$this->form_validation->set_rules("pan_cord_no", "PAN Card No.", "trim");
			$this->form_validation->set_rules("contact_person_name", "Contact Person", "trim|required");
			$this->form_validation->set_rules("contact_person_mobile", "Mobile", "trim|required|numeric|min_length[10]");
			$this->form_validation->set_rules("contact_person_email", "Email", "trim|required|valid_email");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   
				   if ($this->input->post('industry_id')) {
					  //echo var_dump($client); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_client', array('client_name'=>$client['client_name']));
					  if($checkdata==NULL){
					  $insert_c_id = $this->SettingModel->InsertData('tbl_client',$client);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_c_id) {
						 if($subclient['client_name']!=''){
							 $subclient['client_id']				= $insert_c_id;
							 $insert_c_id = $this->SettingModel->InsertData('tbl_subclient', $subclient);
							 
						 }
						 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
						redirect('branchadmin/Setting/addClient');
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addClient');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist!</div>');
							  		redirect('branchadmin/Setting/addClient');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editClient($id) {
         
		if ($this->session->userdata('loginid')) {
			$data['title'] 	 = 'Branchadmin | Add Client';
			$data['content'] = 'branchadmin/setting/editClient';
			
			$client['company_id'] 				= $this->session->userdata('company_id');
			$client['branch_id'] 				= $this->session->userdata('branch_id');
			$client['industry_id']				= $this->input->post('industry_id');
			$client['client_name']				= $this->input->post('cname');
			$client['client_regi_no']			= $this->input->post('client_regi_no');
			$client['licence_no']				= $this->input->post('licence_no');
			$client['pan_cord_no']				= $this->input->post('pan_cord_no');
			$client['tax_deduction_ac_no']		= $this->input->post('tax_deduction_ac_no');
			$client['contact_person_name']		= $this->input->post('contact_person_name');
			$client['contact_person_mobile']	= $this->input->post('contact_person_mobile');
			$client['contact_person_email']		= $this->input->post('contact_person_email');
			$client['service_tax']				= $this->input->post('service_tax');
			$client['p_tax']					= $this->input->post('p_tax');
			if($this->input->post('deduction_id')!=''){
			$client['deduction_id']				= implode(',', $this->input->post('deduction_id'));
			}else {
				$client['deduction_id']	  ='';
			}
			if($this->input->post('gst')!=''){
			$client['gst']				= $this->input->post('gst');
			}else {
				$client['gst']    ='';
			}
			$client['address']					= $this->input->post('address');
			$client['country']					= $this->input->post('country');
			$client['state']					= $this->input->post('state');
			$client['city']						= $this->input->post('city');
			$client['pincode']					= $this->input->post('pincode');
			$client['status']					= $this->input->post('status');
			$client['on_up_gst']				= $this->input->post('on_up_gst');
			$client['createdby']				= $this->session->userdata('loginid');
			$client['createdon']				= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			//FOR SUB CLIENT
			$subclient['company_id'] 				= $this->session->userdata('company_id');
			$subclient['branch_id'] 				= $this->session->userdata('branch_id');
			$subclient['client_name']				= $this->input->post('ocname');
			$subclient['client_regi_no']			= $this->input->post('oclient_regi_no');
			$subclient['licence_no']				= $this->input->post('olicence_no');
			$subclient['pan_cord_no']				= $this->input->post('opan_cord_no');
			$subclient['tax_deduction_ac_no']		= $this->input->post('otax_deduction_ac_no');
			$subclient['contact_person_name']		= $this->input->post('ocontact_person_name');
			$subclient['contact_person_mobile']		= $this->input->post('ocontact_person_mobile');
			$subclient['contact_person_email']		= $this->input->post('ocontact_person_email');
			$subclient['address']					= $this->input->post('oaddress');
			$subclient['country']					= $this->input->post('ocountry');
			$subclient['state']						= $this->input->post('ostate');
			$subclient['city']						= $this->input->post('ocity');
			$subclient['pincode']					= $this->input->post('opincode');
			
			
			$data['clientList'] = $this->SettingModel->getList('*','tbl_client','id', 'ASC');
			$data['editdclient'] = $this->SettingModel->getData('tbl_client', array('id'=>$id));
			$data['editdsubclient'] = $this->SettingModel->getData('tbl_subclient', array('client_id'=>$id));
			$data['industryList'] = $this->SettingModel->getList('*','tbl_industry','id', 'ASC');
			$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');
			//Client User Details
			
			
			$this->form_validation->set_rules("cname", "Client Name", "trim|required");
			//$this->form_validation->set_rules("client_regi_no", "Client Registration", "trim|required");
			$this->form_validation->set_rules("pan_cord_no", "PAN Card No.", "trim");
			$this->form_validation->set_rules("contact_person_name", "Contact Person", "trim|required");
			$this->form_validation->set_rules("contact_person_mobile", "Mobile", "trim|required|numeric|min_length[10]");
			$this->form_validation->set_rules("contact_person_email", "Email", "trim|required|valid_email");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('cname')) {
					  //echo var_dump($client); exit; 
					  
					  $insert_c_id = $this->SettingModel->UpdateData('tbl_client', $client, array('id'=>$id));
					  //echo var_dump($insert_c_id); exit;
					  if($insert_c_id) {
						 if($subclient['client_name']!=''){
							 $checkdata = $this->SettingModel->getData('tbl_subclient', array('client_id'=>$id));
							 if($checkdata==NULL){
								$subclient['client_id']					= $id;
								$subclient['createdby']					= $this->session->userdata('loginid');
								$subclient['createdon']					= date_timestamp_get(date_create());
								$insert_s_id = $this->SettingModel->InsertData('tbl_subclient',$subclient); 
								
							 }
							 else{
								$subclient['updatedby']					= $this->session->userdata('loginid');
								$subclient['updatedon']					= date_timestamp_get(date_create()); 
								$insert_s_id = $this->SettingModel->UpdateData('tbl_subclient', $subclient, array('id'=>$checkdata[0]['id']));
							 }
							 
						 }
						 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
						redirect('branchadmin/Setting/addClient');
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/editClient/'.$id);			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function addService() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Service';
			$data['content'] = 'branchadmin/setting/addService';
			
			$service['company_id'] 			= $this->session->userdata('company_id');
			$service['branch_id'] 			= $this->session->userdata('branch_id');
			$service['service_name']		= strtoupper($this->input->post('service_name'));
			$service['status']				= $this->input->post('status');
			$service['createdby']			= $this->session->userdata('loginid');
			$service['createdon']			= date_timestamp_get(date_create());
			$service['hsn_sac']             = $this->input->post('hsn_sac');
			//echo var_dump($_POST); exit;
			
			
			$data['serviceList'] = $this->SettingModel->getList('*','tbl_service','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("service_name", "Service Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
			$this->form_validation->set_message("hsn_sac","HSN/SAC optional",'trim');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_service', array('service_name'=>$service['service_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_service', $service);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addService');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addService');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Exist</div>');
							  		redirect('branchadmin/Setting/addService');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editService($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Service';
			$data['content'] = 'branchadmin/setting/editService';
			
			$service['company_id'] 			= $this->session->userdata('company_id');
			$service['branch_id'] 			= $this->session->userdata('branch_id');
			$service['service_name']		= strtoupper($this->input->post('service_name'));
			$service_name_hidden				= strtoupper($this->input->post('service_name_hidden'));
			$service['hsn_sac']				= $this->input->post('hsn_sac');
			$service['status']				= $this->input->post('status');
			$service['updatedby']			= $this->session->userdata('loginid');
			$service['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['serviceList'] = $this->SettingModel->getList('*','tbl_service','id', 'ASC');
			$data['editservice'] = $this->SettingModel->getData('tbl_service', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("service_name", "Service Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($service['service_name']==$service_name_hidden){
									if($data['editservice'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_service',$service, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addService');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editService/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editService/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_service', array('service_name'=>$service['service_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editService/'.$id);
									}
									
								}
								else{
									if($data['editservice'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_service',$service, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addService');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editService/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}	
	
	
	
	public function addIndustry() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Industry';
			$data['content'] = 'branchadmin/setting/addIndustry';
			
			$industry['company_id'] 			= $this->session->userdata('company_id');
			$industry['branch_id'] 			= $this->session->userdata('branch_id');
			$industry['industry_name']		= strtoupper($this->input->post('industry_name'));
			$industry['status']				= $this->input->post('status');
			$industry['createdby']			= $this->session->userdata('loginid');
			$industry['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['industryList'] = $this->SettingModel->getList('*','tbl_industry','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("industry_name", "Industry Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_industry', array('industry_name'=>$industry['industry_name']));
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_industry', $industry);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addIndustry');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addIndustry');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record already exist</div>');
							  		redirect('branchadmin/Setting/addIndustry');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}

	public function editIndustry($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update Industry';
			$data['content'] = 'branchadmin/setting/editIndustry';
			
			$industry['company_id'] 			= $this->session->userdata('company_id');
			$industry['branch_id'] 			= $this->session->userdata('branch_id');
			$industry['industry_name']		= strtoupper($this->input->post('industry_name'));
			$industry_name_hidden				= strtoupper($this->input->post('industry_name_hidden'));
			$industry['status']				= $this->input->post('status');
			$industry['updatedby']			= $this->session->userdata('loginid');
			$industry['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['industryList'] = $this->SettingModel->getList('*','tbl_industry','id', 'ASC');
			$data['editindustry'] = $this->SettingModel->getData('tbl_industry', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("industry_name", "Industry Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($industry['industry_name']==$industry_name_hidden){
									if($data['editindustry'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_industry',$industry, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addIndustry');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editIndustry/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editIndustry/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_industry', array('industry_name'=>$industry['industry_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editIndustry/'.$id);
									}
									
								}
								else{
									if($data['editindustry'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_industry',$industry, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addIndustry');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editIndustry/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}	
	
	
	public function ClientServiceMap(){
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Client Service Map';
			$data['content'] = 'branchadmin/setting/ClientServicesMap';
			
			$client['company_id'] 			= $this->session->userdata('company_id');
			$client['branch_id'] 			= $this->session->userdata('branch_id');
			$client['client_id']			= $this->input->post('client_id');
			$client['service_id']			= $this->input->post('service_id');
			$client['subservice_id']		= $this->input->post('subservice_id');
			$allowance						= $this->input->post('allowance');
			foreach($allowance as $allow_id=>$allow_amount){
				if($allow_amount!=''){
				$allowance_all[] = $allow_id.'-'.$allow_amount;
				}
			}
			$client['allowance']			= implode(',', $allowance_all);
			$client['client_rate']			= $this->input->post('client_rate');
			$client['employee_rate']		= $this->input->post('employee_rate');
			$client['strength']				= $this->input->post('strength');
			$client['total']				= $this->input->post('total');
			$client['bill_cycle']			= $this->input->post('bill_cycle');
			if($client['bill_cycle']==3){
				$client['bill_cycle_num']			= $this->input->post('bill_cycle_num');
			}
			$client['ot_rate']				= $this->input->post('ot_rate');
			$client['status']				= $this->input->post('status');
			$client['createdby']			= $this->session->userdata('loginid');
			$client['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
			$data['serviceList'] = $this->SettingModel->getList('id, service_name','tbl_service','id', 'ASC');
			$data['allowanceList'] = $this->SettingModel->getList('id, allowance_name','tbl_allowance','id', 'ASC');
			$data['DesignationList'] =$this->CommanModel->getList('id,designation_name','tbl_designation','id','ASC');
			$data['ClientSeriveMapList'] =$this->CommanModel->getClientServiceMapList();
			
			//Company User Details
			
			
			$this->form_validation->set_rules("client_id", "Client", "trim|required");
			$this->form_validation->set_rules("service_id", "Service", "trim|required");
			$this->form_validation->set_rules("subservice_id", "Sub Service", "trim|required");
			$this->form_validation->set_rules("client_rate", "Client Rate", "trim|required");
			$this->form_validation->set_rules("employee_rate", "Employee Rate", "trim|required");
			$this->form_validation->set_rules("strength", "Strength", "trim|required");
			$this->form_validation->set_rules("bill_cycle", "Bill Cycle", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					// echo var_dump($client); exit; 
					  $checkrecord= $this->CommanModel->Ifdataexists('id','tbl_client_service_mapping', 
					  array('client_id'=>$client['client_id'],'service_id'=>$client['service_id'],'subservice_id'=>$client['subservice_id']));
					 if($checkrecord==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_client_service_mapping', $client);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							redirect('branchadmin/Setting/ClientServiceMap');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/ClientServiceMap');			
								} 
					 }
					 else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist!</div>');
							  		redirect('branchadmin/Setting/ClientServiceMap');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
	}
	
	
	public function editClientServiceMap($id)
	{
		if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
		{
		$data['title'] 	 = 'Edit ClientServiceMap';
		$data['content'] = 'branchadmin/setting/editClientServicesMap';
		//$data['eventname']  =  $this->CommanModel->getDataByFieldName('eventname,id','tbl_event_category');
		$data['client_service_mapping_detail']  =  $this->CommanModel->getData('tbl_client_service_mapping',array('id'=>$id));
		$data['allowanceList'] = $this->SettingModel->getList('id, allowance_name','tbl_allowance','id', 'ASC');
		$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
		$data['serviceList'] = $this->SettingModel->getList('id, service_name','tbl_service','id', 'ASC');
		$data['DesignationList'] =$this->CommanModel->getList('id,designation_name','tbl_designation','id','ASC');
		     if ($this->input->post('submit') == "Update")
			 {
			$client['company_id'] 			= $this->session->userdata('company_id');
			$client['branch_id'] 			= $this->session->userdata('branch_id');
			$client['client_id']			= $this->input->post('client_id');
			$client['service_id']			= $this->input->post('service_id');
			$client['subservice_id']		= $this->input->post('subservice_id');
			$allowance						= $this->input->post('allowance');
			foreach($allowance as $allow_id=>$allow_amount){
				if($allow_amount!=''){
				$allowance_all[] = $allow_id.'-'.$allow_amount;
				}
			}
			$client['allowance']			= implode(',', $allowance_all);
			$client['client_rate']			= $this->input->post('client_rate');
			$client['employee_rate']		= $this->input->post('employee_rate');
			$client['strength']				= $this->input->post('strength');
			$client['total']				= $this->input->post('total');
			$client['ot_rate']				= $this->input->post('ot_rate');
			$client['bill_cycle']			= $this->input->post('bill_cycle');
			if($client['bill_cycle']==3){
				$client['bill_cycle_num']			= $this->input->post('bill_cycle_num');
			}
			$client['status']				= $this->input->post('status');
			$client['updatedby']			= $this->session->userdata('loginid');
			$client['updatedon']			= date_timestamp_get(date_create());
			
			$this->form_validation->set_rules("client_id", "Client", "trim|required");
			$this->form_validation->set_rules("service_id", "Service", "trim|required");
			$this->form_validation->set_rules("subservice_id", "Sub Service", "trim|required");
			$this->form_validation->set_rules("client_rate", "Client Rate", "trim|required");
			$this->form_validation->set_rules("employee_rate", "Employee Rate", "trim|required");
			$this->form_validation->set_rules("strength", "Strength", "trim|required");
			$this->form_validation->set_rules("bill_cycle", "Bill Cycle", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
		    //$this->load->view($this->layout, $data);
			   if ($this->form_validation->run() == FALSE)
				{
					$this->load->view($this->layout, $data);
				}
				else
			   {	
					//var_dump($_POST); exit;
					$cserviceid = $this->CommanModel->Ifdataexists('id','tbl_client_service_mapping',array('id'=>$this->input->post('txthide')));
					  if($cserviceid)
					  {
						 $this->CommanModel->UpdateData('tbl_client_service_mapping',$client, array('id'=>$this->input->post('txthide')));
						 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated...</div>'); 
					     redirect('branchadmin/Setting/ClientServiceMap');
					   }
					  else
					  {
					      $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Not Updated...</div>');
						  redirect('branchadmin/Setting/editClientServiceMap');
					  }	
				}
			 }
			 else
			 {
				$this->load->view($this->layout, $data); 
			 }
		}
			
		else
		{
			redirect('web/index');
		}
		
	}
	public function GradeBaseSalary(){
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Grade Base Salary';
			$data['content'] = 'branchadmin/setting/GradeBaseSalary';
			
			$salary['company_id'] 			= $this->session->userdata('company_id');
			$salary['branch_id'] 			= $this->session->userdata('branch_id');
			$salary['grade_id']				= $this->input->post('grade_id');
			$salary['department_id']		= $this->input->post('department_id');
			$salary['designation_id']		= $this->input->post('designation_id');
			$salary['basic_salary']			= $this->input->post('basic_salary');
			$allowance						= $this->input->post('allowance');
			foreach($allowance as $allow_id=>$allow_amount){
				if($allow_amount!=''){
				$allowance_all[] = $allow_id.'-'.$allow_amount;
				}
			}
			if($this->input->post('deduction_id')!=''){
			$salary['deduction_id']				= implode(',', $this->input->post('deduction_id'));
			}
			$salary['allowance']			= implode(',', $allowance_all);
			$salary['income_tax']				= $this->input->post('income_tax');
			$salary['status']				= $this->input->post('status');
			$salary['createdby']			= $this->session->userdata('loginid');
			$salary['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['gradeList'] = $this->SettingModel->getList('id, grade_name','tbl_grade','id', 'ASC');
			$data['departmentList'] = $this->SettingModel->getList('id, department_name','tbl_department','id', 'ASC');
			$data['designationList'] = $this->SettingModel->getList('id, designation_name','tbl_designation','id', 'ASC');
			$data['allowanceList'] = $this->SettingModel->getList('id, allowance_name','tbl_allowance','id', 'ASC');
			$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');

			$data['GradeBaseSalaryList'] =$this->CommanModel->getGradeBaseSalaryList();
			//Company User Details
			
			
			$this->form_validation->set_rules("grade_id", "Grade", "trim|required");
			$this->form_validation->set_rules("department_id", "Department", "trim|required");
			$this->form_validation->set_rules("designation_id", "Designation", "trim|required");
			$this->form_validation->set_rules("basic_salary", "Basic Salary", "trim|required");
			
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					//echo var_dump($salary); exit; 
					  $checkrecord= $this->CommanModel->Ifdataexists('id','tbl_gradebase_salary', 
					  array('grade_id'=>$salary['grade_id'],'department_id'=>$salary['department_id'],'designation_id'=>$salary['designation_id'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
					 if($checkrecord==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_gradebase_salary', $salary);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							redirect('branchadmin/Setting/GradeBaseSalary');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/GradeBaseSalary');			
								} 
					 }
					 else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist!</div>');
							  		redirect('branchadmin/Setting/GradeBaseSalary');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
	}
	
	public function editGradeBaseSalary($id){
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Grade Base Salary';
			$data['content'] = 'branchadmin/setting/editGradeBaseSalary';
			$data['gradeList'] = $this->SettingModel->getList('id, grade_name','tbl_grade','id', 'ASC');
			$data['departmentList'] = $this->SettingModel->getList('id, department_name','tbl_department','id', 'ASC');
			$data['designationList'] = $this->SettingModel->getList('id, designation_name','tbl_designation','id', 'ASC');
			$data['allowanceList'] = $this->SettingModel->getList('id, allowance_name','tbl_allowance','id', 'ASC');
			$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');

			$data['GradeBaseSalaryList'] =$this->CommanModel->getDataIfdataexists('*','tbl_gradebase_salary',array('id'=>$id));
			//Company User Details
			
			 if ($this->input->post('submit') == "Update")
			 {
				
				$salary['company_id'] 			= $this->session->userdata('company_id');
				$salary['branch_id'] 			= $this->session->userdata('branch_id');
				$salary['grade_id']				= $this->input->post('grade_id');
				$salary['department_id']		= $this->input->post('department_id');
				$salary['designation_id']		= $this->input->post('designation_id');
				$salary['basic_salary']			= $this->input->post('basic_salary');
				$allowance						= $this->input->post('allowance');
				foreach($allowance as $allow_id=>$allow_amount){
					if($allow_amount!=''){
					$allowance_all[] = $allow_id.'-'.$allow_amount;
					}
				}
				if($this->input->post('deduction_id')!=''){
				$salary['deduction_id']				= implode(',', $this->input->post('deduction_id'));
				}else
				{$salary['deduction_id']  = '';
					
					}
				$salary['allowance']			= implode(',', $allowance_all);
				
				$salary['income_tax']				= $this->input->post('income_tax');
				$salary['status']				= $this->input->post('status');
				$salary['updatedby']			= $this->session->userdata('loginid');
				$salary['updatedon']			= date_timestamp_get(date_create());
				//echo var_dump($_POST); exit;
				
			    $this->form_validation->set_rules("grade_id", "Grade", "trim|required");
				$this->form_validation->set_rules("department_id", "Department", "trim|required");
				$this->form_validation->set_rules("designation_id", "Designation", "trim|required");
				$this->form_validation->set_rules("basic_salary", "Basic Salary", "trim|required");
				
			
				$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
				$this->form_validation->set_message('required', '%s is required!');
	
			     if ($this->form_validation->run() == FALSE)
				 {
				    $this->load->view($this->layout, $data);
			     }
			     else
				 {
				   
					//echo var_dump($salary); exit; 
					  $checkrecord= $this->CommanModel->Ifdataexists('id','tbl_gradebase_salary', array('id'=>$this->input->post('hidetxt'))); 
					 
					
						  if($checkrecord)
						  {
							 $this->CommanModel->UpdateData('tbl_gradebase_salary',$salary, array('id'=>$this->input->post('hidetxt')));
							 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated...</div>'); 
							 redirect('branchadmin/Setting/GradeBaseSalary');
						   }
						  else
						  {
							  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Not Updated...</div>');
							  redirect('branchadmin/Setting/editGradeBaseSalary');
						  }	
					 
				  
				 }

			
		            
			 }
			 else
			 {
				 $this->load->view($this->layout, $data);
			 }
		
		 }
		else
		{
		    redirect('web/index');	
		}
	}
	
	public function addTaxMaster() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Deduction';
			$data['content'] = 'branchadmin/setting/addTaxMaster';
			
			$tax['company_id'] 				= $this->session->userdata('company_id');
			$tax['branch_id'] 				= $this->session->userdata('branch_id');
			$tax['type_of_tax']				= $this->input->post('type_of_tax');
			$tax['tax_applied_on']			= $this->input->post('tax_applied_on');
			$tax['min_salary_limit']			= $this->input->post('min_salary_limit');
			$tax['max_salary_limit']			= $this->input->post('max_salary_limit');
			$tax['percentage']				= $this->input->post('percentage');
			$tax['status']					= $this->input->post('status');
			$tax['createdby']					= $this->session->userdata('loginid');
			$tax['createdon']					= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['taxList'] = $this->SettingModel->getList('*','tbl_income_tax','id', 'ASC');

			//Company User Details
			
			
			//$this->form_validation->set_rules("deduction_head", "Deduction Name", "trim|required|is_unique[tbl_deduction_head.deduction_head]");
			
			$this->form_validation->set_rules("type_of_tax", "Type of Tax", "trim|required");
			$this->form_validation->set_rules("tax_applied_on", "Tax Applied On", "trim|numeric|required");
			$this->form_validation->set_rules("percentage", "Percentage", "trim|numeric|required");
			$this->form_validation->set_rules("min_salary_limit", "Minimum Salary Limit", "trim|numeric|required");
			$this->form_validation->set_rules("max_salary_limit", "Maximum Salary Limit", "trim|numeric|required");
			
			
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 
					 // echo var_dump($tax); exit;
					  $dataexist = $this->CommanModel->Ifdataexists('id','tbl_income_tax', array('type_of_tax'=>$tax['type_of_tax'],'min_salary_limit'=>$tax['min_salary_limit'],
					  'max_salary_limit'=>$tax['max_salary_limit'],'percentage'=>$tax['percentage']));
					  if($dataexist==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_income_tax', $tax);
					  
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addTaxMaster');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addTaxMaster');			
								} 
					  }
					  else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Register!</div>');
							  		redirect('branchadmin/Setting/addTaxMaster');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function editaddTaxMaster($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
	     {
			$data['title'] 	 = 'Branchadmin | Add Deduction';
			$data['content'] = 'branchadmin/setting/editaddTaxMaster';
			$data['incometaxList'] =$this->CommanModel->getDataIfdataexists('*','tbl_income_tax',array('id'=>$id));
			if ($this->input->post('submit') == "Update")
			 {
				$tax['company_id'] 				= $this->session->userdata('company_id');
				$tax['branch_id'] 				= $this->session->userdata('branch_id');
				$tax['type_of_tax']				= $this->input->post('type_of_tax');
				$tax['tax_applied_on']			= $this->input->post('tax_applied_on');
				$tax['min_salary_limit']			= $this->input->post('min_salary_limit');
				$tax['max_salary_limit']			= $this->input->post('max_salary_limit');
				$tax['percentage']				= $this->input->post('percentage');
				$tax['status']					= $this->input->post('status');
				$tax['createdby']					= $this->session->userdata('loginid');
				$tax['createdon']					= date_timestamp_get(date_create());
				//echo var_dump($_POST); exit;
	

				$this->form_validation->set_rules("type_of_tax", "Type of Tax", "trim|required");
				$this->form_validation->set_rules("tax_applied_on", "Tax Applied On", "trim|numeric|required");
				$this->form_validation->set_rules("percentage", "Percentage", "trim|numeric|required");
				$this->form_validation->set_rules("min_salary_limit", "Minimum Salary Limit", "trim|numeric|required");
				$this->form_validation->set_rules("max_salary_limit", "Maximum Salary Limit", "trim|numeric|required");
			    $this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
				$this->form_validation->set_message('required', '%s is required!');
	
				  if ($this->form_validation->run() == FALSE) {
					  $this->load->view($this->layout, $data);
				  }
				  else 
				  {
					  // echo var_dump($tax); exit;
						
						  $checkrecord= $this->CommanModel->Ifdataexists('id','tbl_income_tax', array('id'=>$this->input->post('hidetxt'))); 
						  if($checkrecord)
						  {
							  $this->CommanModel->UpdateData('tbl_income_tax',$tax, array('id'=>$this->input->post('hidetxt')));
							  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
							  redirect('branchadmin/Setting/addTaxMaster');
						  }
						  else
						   {
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Not updated...</div>');
								redirect('branchadmin/Setting/editaddTaxMaster');			
						   } 
				  }
				  
			 }
			 else
			 {
				 $this->load->view($this->layout, $data);
			 }
		 }
		else
		{
			redirect('web/index');	
		}
		
	}
	
	public function GSTMaster() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add GST';
			$data['content'] = 'branchadmin/setting/GSTMaster';
			
			
			$tax['company_id'] 				= $this->session->userdata('company_id');
			$tax['branch_id'] 				= $this->session->userdata('branch_id');
			$tax['cgst']		= $this->input->post('cgst');
			$tax['sgst']		= $this->input->post('sgst');
			$tax['igst']		= $this->input->post('igst');
			
			//echo var_dump($_POST); exit;
			$data['editSGT'] = $this->SettingModel->getListWhere('*','tbl_gst_master','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));

			

			//Company User Details
			
			
			//$this->form_validation->set_rules("deduction_head", "Deduction Name", "trim|required|is_unique[tbl_deduction_head.deduction_head]");
			
			$this->form_validation->set_rules("cgst", "CGST", "trim");
			$this->form_validation->set_rules("sgst", "SGST", "trim");
			$this->form_validation->set_rules("igst", "IGST", "trim");
			
			
			
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 
					 // echo var_dump($tax); exit;
					  
					 $checkdata = $this->SettingModel->getData('tbl_gst_master', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
					  if($checkdata== NULL){
						  $insert = $this->CommanModel->InsertData('tbl_gst_master', $tax);
					  
					  if($insert) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Insert Successfully</div>');
							 		redirect('branchadmin/Setting/GSTMaster');
						  
								}
					else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/GSTMaster');			
								} 
						  }
					  else{
					  $update = $this->CommanModel->UpdateData('tbl_gst_master', $tax, array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
					  
					  if($update) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
							 		redirect('branchadmin/Setting/GSTMaster');
						  
								}
					else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/GSTMaster');			
								} 
					  }
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
	public function clientList(){
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Shift';
			$data['content'] = 'branchadmin/setting/clientList';
			
			$this->load->view($this->layout, $data);
		}
		 
		 }
	 
	 
	
	public function profile()
	{
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Dashboard | Admin | Add Branch';
			$data['content'] = 'branchadmin/setting/profile';
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
						 redirect('branchadmin/Setting/profile');
					 }
					 else
					 {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Profile Not Updated!!!!</div>');
						 redirect('branchadmin/Setting/profile');
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
	
	   
				
			public function generateInvoice()
		    {
			   if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') 
			   {
			            $data['title'] 	 = 'Branchadmin | Generate Invoice';
			            $data['content'] = 'branchadmin/setting/generateInvoice';
						
						$year = $this->input->post('year');
						$month = $this->input->post('month');
						$client_id = $this->input->post('client_id');
						$bank_branch = $this->input->post('bank_branch_id');
						
						$SERVICEID = $this->input->post('service_id');
						$SUBSERVICEID = $this->input->post('subservice_id');
						$invoice_date = $this->convertDatetoMysqlDate($this->input->post('invoice_date'));
						
						$monthdetail = $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
						$data['allclient'] = $this->CommanModel->getListWhere('id,client_name','tbl_client','id','ASC', array('status'=>1,'branch_id'=> $this->session->userdata('branch_id'),'company_id'=>$this->session->userdata('company_id')));
						$data['bankList'] = $this->CommanModel->getListWhere('id,bank_name','tbl_bank','id','ASC', array('status'=>1,'branch_id'=> $this->session->userdata('branch_id'),'company_id'=>$this->session->userdata('company_id')));
						
						if($this->input->post('other_deduction_head') !=''){
							
							$otherdeductionhead = $this->input->post('other_deduction_head');
							$otherdeductionuom = $this->input->post('other_deduction_uom');
							$otherdeductionamount = $this->input->post('other_deduction_amount');
							
							$this->form_validation->set_rules("other_deduction_uom", "Other Deducation UOM", "trim|required|numeric");
							$this->form_validation->set_rules("other_deduction_amount", "Other Deducation Amount", "trim|required|numeric");
						}
						
						$this->form_validation->set_rules("year", "Year", "trim|required");
			            $this->form_validation->set_rules("month", "Month", "trim|required");
			            $this->form_validation->set_rules("client_id", "Employee", "trim|required");
						$this->form_validation->set_rules("service_id", "Service", "trim|required");
						$this->form_validation->set_rules("subservice_id[]", "Sub-Service", "trim|required");
						$this->form_validation->set_rules("invoice_date", "Invoice Date", "trim|required");
						$this->form_validation->set_rules("bank_branch_id", "Bank Branch", "trim|required");
			
			            $this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			            $this->form_validation->set_message('required', '%s is required!');
	                    $FinalViewData=array();
						  if ($this->form_validation->run()) 
						  {
							  if ($this->input->post('submit') == "Submit") 
								  { 
									 //$this->session->set_flashdata('msg', '<div class="alert alert-danger">We are working On this Service! Try Again after some time</div>');
									//redirect('branchadmin/Setting/generateInvoice');
									  $FinalViewData['company_id']=$this->session->userdata('company_id');
									  $FinalViewData['branch_id']=$this->session->userdata('branch_id');
									  $FinalViewData['client_id']=$client_id;
									  $FinalViewData['year_v']=$year;
									  $FinalViewData['month_v']=$month;
									  $FinalViewData['bank_branch_id']=$bank_branch;
									  $FinalViewData['invoice_date']=$invoice_date;
									 $clinetdetail = $this->CommanModel->getDataIfdataexists('*', 'tbl_client', array('id'=>$client_id));
									 if($clinetdetail['on_up_gst']=='1'){
										$invoiceno = $this->CommanModel->getListWhereLimit('invoice_no', 'tbl_client_invoice','id', 'DESC', array('company_id'=>$this->session->userdata('company_id'),'on_up_gst' => '1'), 1); 
									 	
										if($invoiceno[0]['invoice_no']==NULL){
												
												$FinalViewData['invoice_no'] = 1;
												$FinalViewData['on_up_gst'] = 1;
											
											}
										else{
												$inc = (int)$invoiceno[0]['invoice_no'];
												$FinalViewData['invoice_no'] = $inc + 1;
												$FinalViewData['on_up_gst'] = 1;
											}
									 }
									 else{
										 if($this->session->userdata('branch_id')=='1'){
											$invoiceno = $this->CommanModel->getListWhereLimit('invoice_no', 'tbl_client_invoice','id', 'DESC', array('company_id'=>$this->session->userdata('company_id'), 'on_up_gst'=>'1'), 1);  
										 }
										 else{
											$invoiceno = $this->CommanModel->getListWhereLimit('*', 'tbl_client_invoice','id', 'DESC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'), 'on_up_gst'=>NULL), 1); 
										 }
										
										if($invoiceno[0]['invoice_no']==NULL){
												
												$FinalViewData['invoice_no'] = 1;
												if($this->session->userdata('branch_id')=='1'){
													$FinalViewData['on_up_gst'] = 1;
												}
											
											}
										else{
												$inc = (int)$invoiceno[0]['invoice_no'];
												$FinalViewData['invoice_no'] = $inc + 1;
												if($this->session->userdata('branch_id')=='1'){
													$FinalViewData['on_up_gst'] = 1;
												}
												
											}
									 }
									
								
										if($SERVICEID=='-1' && $SUBSERVICEID[0]=='-1'){
										
								     $clientMapDetail =  $this->CommanModel->getListWhere('*','tbl_client_service_mapping','id','ASC',array('client_id'=>$client_id,'status'=>1));
										}
										elseif($SERVICEID!='-1' && $SUBSERVICEID[0]=='-1'){
											
								     $clientMapDetail =  $this->CommanModel->getListWhere('*','tbl_client_service_mapping','id','ASC',array('client_id'=>$client_id,'service_id'=>$SERVICEID, 'status'=>1));
										}
										elseif($SERVICEID!='-1' && $SUBSERVICEID[0]!='-1'){
											
										$clientMapDetail =  $this->CommanModel->getSubServiceByClinetListWhere('*','tbl_client_service_mapping','id','ASC', array('client_id'=>$client_id,'service_id'=>$SERVICEID,'status'=>1), $SUBSERVICEID);	
										}
									
									
									
									
								
									 if($clientMapDetail!=null)
									 {
										 
											for($i=0; $i < count($clientMapDetail); $i++)
											{
												$serid = $clientMapDetail[$i]['service_id'];
												$subserid = $clientMapDetail[$i]['subservice_id'];
												$services[] = $serid;
												$subservices[$clientMapDetail[$i]['service_id']][] = $subserid;
												$billcyle[$serid][$subserid]['bill_cycle'] = $clientMapDetail[$i]['bill_cycle'];
												$billcyle[$serid][$subserid]['bill_cycle_num'] = $clientMapDetail[$i]['bill_cycle_num'];
												$billcyle[$serid][$subserid]['strength'] = $clientMapDetail[$i]['strength'];
												$clientrate[$serid][$subserid]['client_rate'] = $clientMapDetail[$i]['client_rate'];
												$otrate[$serid][$subserid]['ot_rate'] = $clientMapDetail[$i]['ot_rate'];
												
												
											}
										foreach($subservices as $serivesid=>$subserviceids){
												
												
													for($j=0; $j < count($subserviceids); $j++){
														$client_shift = $this->CommanModel->getListWhere('id, year_v,month_v,APW,service_id,subservice_id,emp_id','tbl_shift_emp','id','ASC',array('service_id'=>$serivesid,'subservice_id'=>$subserviceids[$j],'year_v'=>$year,'month_v'=>$month,'client_id'=>$client_id));	
															///echo var_dump($client_shift);
															
															if($client_shift == ''){
																
																$this->session->set_flashdata('msg', '<div class="alert alert-danger">Please Upload Attendance for Selected Month and Year for this client</div>');
										 							redirect('branchadmin/Setting/generateInvoice');
															}
															//echo var_dump($client_shift); exit;
															$jobcount = count($client_shift); 
															
															for($r=0; $r< $jobcount; $r++){
																$apw = $client_shift[$r]['APW'];
																$apw = explode(',', $client_shift[$r]['APW']);
																$p = explode('-', $apw[0]);
																
																$ot = explode('-', $apw[3]);
															$FinalData[$serivesid][$subserviceids[$j]]['Serviceid'] = $serivesid;
															$FinalData[$serivesid][$subserviceids[$j]]['Subserviceid'] = $subserviceids[$j];
															$FinalData[$serivesid][$subserviceids[$j]]['Stranght'] = (int)$billcyle[$serivesid][$subserviceids[$j]]['strength'];
															$FinalData[$serivesid][$subserviceids[$j]]['P'] += $p[1];
															
															$FinalData[$serivesid][$subserviceids[$j]]['OT'] += $ot[1];
															$FinalData[$serivesid][$subserviceids[$j]]['P_Detail'][] = $client_shift[$r]['emp_id'].'-'.$p[1].'-'.$ot[1];
															$FinalData[$serivesid][$subserviceids[$j]]['BillCycle'] = (int)$billcyle[$serivesid][$subserviceids[$j]]['bill_cycle'];
															$FinalData[$serivesid][$subserviceids[$j]]['BillCycleNum'] = (int)$billcyle[$serivesid][$subserviceids[$j]]['bill_cycle_num'];
															$FinalData[$serivesid][$subserviceids[$j]]['ClientRate'] = $clientrate[$serivesid][$subserviceids[$j]]['client_rate'];
															$FinalData[$serivesid][$subserviceids[$j]]['OTRate'] = $otrate[$serivesid][$subserviceids[$j]]['ot_rate'];	
															}
													}
													
												}
												
							$paymentSting[0]='Serviceid-SubSeriviceid-ClientRate-Quantitiy-BillCycle-Totalprasentdays-Perdaybillrate-TotalprasentdaysbillingAmount-OTDays-PerdayOtbillingRate-TotalOTBillingAmount-TotalBasicAmount-AddDeduction-ServiceCharge@percent-TotalTaxebleAmount-CGST@percent-SGST@percent-IGST@percent-TotalGST-TotalSubServiceAmount'; 					
										//echo var_dump($FinalData); exit;
										foreach($FinalData as $serid=>$subserids){
											
												foreach($subserids as $key=>$value){
													
											$empdatil = $value['P_Detail'];
											$EMPdetail[0] = 'emp_id-presentdays-Otdays';
											for($e=0; $e < count($empdatil); $e++){
												$EMPdetail[]= $empdatil[$e];
											}
											
												$deductionids = $clinetdetail['deduction_id'];
														$deductionids = explode(',', $deductionids);
														$getduction = $this->CommanModel->getListWhereIn('*', 'tbl_deduction_head','id', 'ASC', $deductionids);	
												if($clinetdetail['gst']!=''){
												
														$getgst = $this->CommanModel->getDataIfdataexists('*', 'tbl_gst_master', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));	
												}
												if($value['BillCycle']==1){
													$noday = $monthdetail['NoOfDays'];
													$Quantitiy = $value['Stranght'];
													$clientRate = $value['ClientRate'];
													$perdaycosting = $value['ClientRate'] / $noday;
													$Totalprasentdays = $value['P'];
													$Totalotdays = (float)$value['OT'];
													$OTRate = $value['OTRate'];
													if($OTRate=='0.00'){
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=0;
														$TotalOTBillingAmount = round($Totalotdays * $perdaycosting, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														}
													else{
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=$OTRate;
														$TotalOTBillingAmount = round($Totalotdays * $PerdayOtbillingRate, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														
														}
														$GrandBasicAmount[] = $TotalBasicAmount;
														$TDeduction ='';
														$TotalDeduction='';
														for($a=0; $a < count($getduction); $a++){
														 if($getduction[$a]['max_salary_limit']!='0.00'){
																
																if($clientRate <= $getduction[$a]['max_salary_limit']){
																	
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
																}
																else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															if($getduction[$a]['max_salary_limit']=='0.00'){
																
																
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															 $TDeduction[] = $getduction[$a]['id'].'@'.$getduction[$a]['deduction_head'].'@'.$EPF.'@'.$EPFpercent;
															 $did 		= $getduction[$a]['id'];
															 $GrandEPF[$did] 	+= $EPF;
															 $TotalDeduction += $EPF;
														 }
														 
														if($clinetdetail['service_tax']!=null){
															
															$servicetax = (float)$clinetdetail['service_tax'];
															$servicetaxamount = round($TotalBasicAmount * $servicetax / 100, 2);
															
															}
															$TotalTaxebleAmount = $TotalBasicAmount + $TotalDeduction + $servicetaxamount;
															$GrandSericeCharge[]=$servicetaxamount;
														if($clinetdetail['gst']!=null){
															if($clinetdetail['gst']=='1,2'){
																$cgstpersent = $getgst['cgst'];
																$sgstpersent = $getgst['sgst'];
																$igstpersent = '';
																$CGST = round($TotalTaxebleAmount * $cgstpersent / 100, 2);
																$SGST = round($TotalTaxebleAmount * $sgstpersent / 100, 2);
																$IGST = 0;
															}
															if($clinetdetail['gst']=='3'){
																$cgstpersent = '';
																$sgstpersent = '';
																$igstpersent = $getgst['igst'];
																$CGST = 0;
																$SGST = 0;
																$IGST = round($TotalTaxebleAmount * $igstpersent / 100, 2);
															}
															
															
															}
															$GrandCGST[] = $CGST; 
															$GrandSGST[] = $SGST; 
															$GrandIGST[] = $IGST; 
															$GrandTaxebleAmount[] = $TotalTaxebleAmount; 
															$TotalGST = $CGST + $SGST + $IGST;
															$GrandTotalGST[]= $TotalGST;
															$TotalSubServiceAmount = $TotalTaxebleAmount + $TotalGST;
															$GrandTotalSubServiceAmount []= $TotalSubServiceAmount;
					$NEWSERVICE[]=$serid;
		$NEWSUBSERVICE[]=$key;									
		$paymentSting[] = $serid.'-'.$key.'-'.$clientRate.'-'.$Quantitiy.'-'.$noday.'-'.$Totalprasentdays.'-'.$perdaycosting.'-'.$TotalprasentdaysbillingAmount.'-'.$Totalotdays.'-'.$PerdayOtbillingRate.'-'.$TotalOTBillingAmount.'-'.$TotalBasicAmount.'-'.implode(':', $TDeduction).'-'.$servicetaxamount.'@'.$servicetax.'-'.$TotalTaxebleAmount.'-'.$CGST.'@'.$cgstpersent.'-'.$SGST.'@'.$sgstpersent.'-'.$IGST.'@'.$igstpersent.'-'.$TotalGST.'-'.$TotalSubServiceAmount;
												}
												if($value['BillCycle']==2){
													$noday = 1;
													$Quantitiy = $value['Stranght'];
													$clientRate = $value['ClientRate'];
													$perdaycosting = $value['ClientRate'];
													$Totalprasentdays = $value['P'];
													$Totalotdays = (float)$value['OT'];
													$OTRate = $value['OTRate'];
													if($OTRate=='0.00'){
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=0;
														$TotalOTBillingAmount = round($Totalotdays * $perdaycosting, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														}
													else{
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=$OTRate;
														$TotalOTBillingAmount = round($Totalotdays * $PerdayOtbillingRate, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														
														}
														$GrandBasicAmount[] = $TotalBasicAmount;
														$TDeduction ='';
														$TotalDeduction='';
														for($a=0; $a < count($getduction); $a++){
														  if($getduction[$a]['max_salary_limit']!='0.00'){
																
																if($clientRate <= $getduction[$a]['max_salary_limit']){
																	
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
																}
																else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															if($getduction[$a]['max_salary_limit']=='0.00'){
																
																
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															 $TDeduction[] = $getduction[$a]['id'].'@'.$getduction[$a]['deduction_head'].'@'.$EPF.'@'.$EPFpercent;
															 $did 		= $getduction[$a]['id'];
															 $GrandEPF[$did] 	+= $EPF;
															 $TotalDeduction += $EPF;
														 }
														 
														if($clinetdetail['service_tax']!=null){
															
															$servicetax = (float)$clinetdetail['service_tax'];
															$servicetaxamount = round($TotalBasicAmount * $servicetax / 100, 2);
															
															}
															$TotalTaxebleAmount = $TotalBasicAmount + $TotalDeduction  + $servicetaxamount;
															$GrandSericeCharge[]=$servicetaxamount;
														if($clinetdetail['gst']!=null){
															if($clinetdetail['gst']=='1,2'){
																$cgstpersent = $getgst['cgst'];
																$sgstpersent = $getgst['sgst'];
																$igstpersent = '';
																$CGST = round($TotalTaxebleAmount * $cgstpersent / 100, 2);
																$SGST = round($TotalTaxebleAmount * $sgstpersent / 100, 2);
																$IGST = 0;
															}
															if($clinetdetail['gst']=='3'){
																$cgstpersent = '';
																$sgstpersent = '';
																$igstpersent = $getgst['igst'];
																$CGST = 0;
																$SGST = 0;
																$IGST = round($TotalTaxebleAmount * $igstpersent / 100, 2);
															}
															
															
															}
															$GrandCGST[] = $CGST; 
															$GrandSGST[] = $SGST; 
															$GrandIGST[] = $IGST; 
															$GrandTaxebleAmount[] = $TotalTaxebleAmount; 
															$TotalGST = $CGST + $SGST + $IGST;
															$GrandTotalGST[]= $TotalGST;
															$TotalSubServiceAmount = $TotalTaxebleAmount + $TotalGST;
															$GrandTotalSubServiceAmount []= $TotalSubServiceAmount;
		$NEWSERVICE[]=$serid;
		$NEWSUBSERVICE[]=$key;
		$paymentSting[] = $serid.'-'.$key.'-'.$clientRate.'-'.$Quantitiy.'-'.$noday.'-'.$Totalprasentdays.'-'.$perdaycosting.'-'.$TotalprasentdaysbillingAmount.'-'.$Totalotdays.'-'.$PerdayOtbillingRate.'-'.$TotalOTBillingAmount.'-'.$TotalBasicAmount.'-'.implode(':', $TDeduction).'-'.$servicetaxamount.'@'.$servicetax.'-'.$TotalTaxebleAmount.'-'.$CGST.'@'.$cgstpersent.'-'.$SGST.'@'.$sgstpersent.'-'.$IGST.'@'.$igstpersent.'-'.$TotalGST.'-'.$TotalSubServiceAmount;
												}
												////// statrt bu
												if($value['BillCycle']==3){
													$noday = $value['BillCycleNum'];
													//var_dump($noday); exit;
													$Quantitiy = $value['Stranght'];
													$clientRate = $value['ClientRate'];
													$perdaycosting = $value['ClientRate'] / $noday;
													$Totalprasentdays = $value['P'];
													$Totalotdays = (float)$value['OT'];
													$OTRate = $value['OTRate'];
													if($OTRate=='0.00'){
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=0;
														$TotalOTBillingAmount = round($Totalotdays * $perdaycosting, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														}
													else{
														$TotalprasentdaysbillingAmount = round($Totalprasentdays * $perdaycosting, 2);
														$PerdayOtbillingRate=$OTRate;
														$TotalOTBillingAmount = round($Totalotdays * $PerdayOtbillingRate, 2);
														$TotalBasicAmount = $TotalprasentdaysbillingAmount + $TotalOTBillingAmount;
														
														}
														$GrandBasicAmount[] = $TotalBasicAmount;
														$TDeduction ='';
														$TotalDeduction='';
														for($a=0; $a < count($getduction); $a++){
														 if($getduction[$a]['max_salary_limit']!='0.00'){
																
																if($clientRate <= $getduction[$a]['max_salary_limit']){
																	
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
																}
																else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															if($getduction[$a]['max_salary_limit']=='0.00'){
																
																
																	if($getduction[$a]['employer_contribution']!='0.00'){
																		if($getduction[$a]['mode_of_deduction']=='Calculated'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		if($getduction[$a]['deduction_applied_on'] == '-5'){
																			$EPF  =  round($TotalOTBillingAmount * $EPFpercent / 100, 2);
																			}
																		elseif($getduction[$a]['deduction_not_applied_on'] == '-5'){
																				$EPF  =  round($TotalprasentdaysbillingAmount * $EPFpercent / 100, 2);
																		}
																		else
																		{
																		$EPF  =  round($TotalBasicAmount * $EPFpercent / 100, 2);
																		}
																		}
																		if($getduction[$a]['mode_of_deduction']=='Fixed'){
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  round($getduction[$a]['employer_contribution'], 2);
																		}
																	
																	}
																	else{
																		$EPFpercent = $getduction[$a]['employer_contribution'];
																		$EPF  =  0;
																	}
															}
															 $TDeduction[] = $getduction[$a]['id'].'@'.$getduction[$a]['deduction_head'].'@'.$EPF.'@'.$EPFpercent;
															 $did 		= $getduction[$a]['id'];
															 $GrandEPF[$did] 	+= $EPF;
															 $TotalDeduction += $EPF;
														 }
														 
														if($clinetdetail['service_tax']!=null){
															
															$servicetax = (float)$clinetdetail['service_tax'];
															$servicetaxamount = round($TotalBasicAmount * $servicetax / 100, 2);
															
															}
															
															$TotalTaxebleAmount = $TotalBasicAmount + $TotalDeduction + $servicetaxamount;
															$GrandSericeCharge[]=$servicetaxamount;
														if($clinetdetail['gst']!=null){
															if($clinetdetail['gst']=='1,2'){
																$cgstpersent = $getgst['cgst'];
																$sgstpersent = $getgst['sgst'];
																$igstpersent = '';
																$CGST = round($TotalTaxebleAmount * $cgstpersent / 100, 2);
																$SGST = round($TotalTaxebleAmount * $sgstpersent / 100, 2);
																$IGST = 0;
															}
															if($clinetdetail['gst']=='3'){
																$cgstpersent = '';
																$sgstpersent = '';
																$igstpersent = $getgst['igst'];
																$CGST = 0;
																$SGST = 0;
																$IGST = round($TotalTaxebleAmount * $igstpersent / 100, 2);
															}
															
															
															}
															$GrandCGST[] = $CGST; 
															$GrandSGST[] = $SGST; 
															$GrandIGST[] = $IGST; 
															$GrandTaxebleAmount[] = $TotalTaxebleAmount; 
															$TotalGST = $CGST + $SGST + $IGST;
															$GrandTotalGST[]= $TotalGST;
															$TotalSubServiceAmount = $TotalTaxebleAmount + $TotalGST;
															$GrandTotalSubServiceAmount []= $TotalSubServiceAmount;
		$NEWSERVICE[]=$serid;
		$NEWSUBSERVICE[]=$key;
		$paymentSting[] = $serid.'-'.$key.'-'.$clientRate.'-'.$Quantitiy.'-'.$noday.'-'.$Totalprasentdays.'-'.$perdaycosting.'-'.$TotalprasentdaysbillingAmount.'-'.$Totalotdays.'-'.$PerdayOtbillingRate.'-'.$TotalOTBillingAmount.'-'.$TotalBasicAmount.'-'.implode(':', $TDeduction).'-'.$servicetaxamount.'@'.$servicetax.'-'.$TotalTaxebleAmount.'-'.$CGST.'@'.$cgstpersent.'-'.$SGST.'@'.$sgstpersent.'-'.$IGST.'@'.$igstpersent.'-'.$TotalGST.'-'.$TotalSubServiceAmount;
												}
												
												}
												
											}
											
											
											/*for($t=0; $t < count($paymentSting); $t++){
												$tr = $paymentSting[$t];
												$tre = explode('-', $tr);
												echo var_dump($tre);
											}exit;*/
											sort($NEWSERVICE);
											sort($NEWSUBSERVICE);
											$FinalViewData['service_ids']=implode(',', array_unique($NEWSERVICE));
											$FinalViewData['sub_service_ids']=implode(',', array_unique($NEWSUBSERVICE));
											foreach($GrandEPF as $G=>$A){$DUD[]=$G.'@'.$A;}
											$grandtotal[]='TotalBasicAmount-TotalDeduction-TotalServiceCharge-TotalTaxebleAmount-TotalCGST-TotalSGST-TotalIGST-TotalGST-TotalSubseriveAmount';
											$grandtotal[]= array_sum($GrandBasicAmount).'-'.implode(':', $DUD).'-'.array_sum($GrandSericeCharge).'-'.array_sum($GrandTaxebleAmount).'-'.array_sum($GrandCGST).'-'.array_sum($GrandSGST).'-'.array_sum($GrandIGST).'-'.array_sum($GrandTotalGST).'-'.round(array_sum($GrandTotalSubServiceAmount)); 
											$FinalViewData['payment_string']=implode(',', $paymentSting);
											$FinalViewData['total_payment_string']=implode(',', $grandtotal);
											$FinalViewData['emp_details']=implode(',', $EMPdetail);
											$FinalViewData['total_amount'] = array_sum($GrandTotalSubServiceAmount);
											if($otherdeductionamount){
												$FinalViewData['other_deduction_head'] =$otherdeductionhead;
												$FinalViewData['other_deduction_uom'] =$otherdeductionuom;
												$FinalViewData['other_deduction_amount'] = $otherdeductionamount;
												$FinalViewData['total_amount_after_deduction'] = $FinalViewData['total_amount'] - $otherdeductionamount;
												
											}
											$FinalViewData['paid_amount'] = 0;
											$FinalViewData['due_amount'] = array_sum($GrandTotalSubServiceAmount);
											$FinalViewData['payment_status'] = 1;
											///var_dump($FinalViewData); exit;
											if($FinalViewData['emp_details']==''){
											$this->session->set_flashdata('msg', '<div class="alert alert-danger">Employee Attendance not found</div>');
										 			redirect('branchadmin/Setting/generateInvoice');	
											}
											////$FinalViewData['payment_string']=$paymentSting;
											$ifdataexsit = $this->CommanModel->getDataIfdataexists('id,invoice_no,payment_status', 'tbl_client_invoice', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'),
											'client_id'=>$client_id,'year_v'=>$year,'month_v'=>$month, 'service_ids'=>$FinalViewData['service_ids'],'sub_service_ids'=>$FinalViewData['sub_service_ids']));
											if($ifdataexsit==''){
												$FinalViewData['createdon'] = date_timestamp_get(date_create());;
												$FinalViewData['createdby'] = $this->session->userdata('loginid');
												$insert = $this->CommanModel->InsertData('tbl_client_invoice',$FinalViewData);
												if($insert){
													$this->session->set_flashdata('msg', '<div class="alert alert-success">Invoice generate successfully</div>');
										 			redirect('branchadmin/Setting/printInvoice/'.$insert);
													}
												else{
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Response</div>');
										 			redirect('branchadmin/Setting/generateInvoice');
													}
											}
											else{
												$FinalViewData['updatedon'] = date_timestamp_get(date_create());;
												$FinalViewData['updatedby'] = $this->session->userdata('loginid');
												$FinalViewData['invoice_no'] = $ifdataexsit['invoice_no'];
												
												if($ifdataexsit['payment_status']=='Unpaid'){
												$update=$this->CommanModel->UpdateData('tbl_client_invoice',$FinalViewData, array('id'=>$ifdataexsit['id']));
												if($update){
													$this->session->set_flashdata('msg', '<div class="alert alert-success">Invoice update successfully</div>');
										 			redirect('branchadmin/Setting/printInvoice/'.$ifdataexsit['id']);
													}
												else{
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Response</div>');
										 			redirect('branchadmin/Setting/generateInvoice');
													}
												}
												else{
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">You can not regenerate this invoice</div>');
										 			redirect('branchadmin/Setting/generateInvoice');
												}
											}
										
									 }
									 else
									 {
										 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not vailid client id..</div>');
										 redirect('branchadmin/Setting/generateInvoice');
									 }
								    
								  }
							 
						  }
						  else
						  {
								 $this->load->view($this->layout, $data); 
						  }
						
						
						
			   }
			   else
			   {
				       redirect('web/index');	
		       }
		}
		
			public function printInvoice($id){
				 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') 
				 {
					 $FinalInvoiceDetail['title'] 	 = 'Branchadmin | Employee';
					 
					 $FinalInvoiceDetail['Invoicedata'] = $this->CommanModel->getDataIfdataexists('*', 'tbl_client_invoice', array('id'=>$id));
					 $FinalInvoiceDetail['content'] = 'branchadmin/employee/InvoicePrint';
					 //$FinalInvoiceDetail['content'] = 'branchadmin/employee/Invoice6';
					 $FinalInvoiceDetail['BankBranch'] = $this->CommanModel->getBankBranchDetail($FinalInvoiceDetail['Invoicedata']['bank_branch_id']);
					 $FinalInvoiceDetail['ClientDetail'] = $this->CommanModel->getDataIfdataexists('client_name,address,state,tax_deduction_ac_no,on_up_gst', 'tbl_client', array('id'=>$FinalInvoiceDetail['Invoicedata']['client_id']));
					 $FinalInvoiceDetail['SubClientDetail'] = $this->CommanModel->getDataIfdataexists('client_name,address,state,tax_deduction_ac_no', 'tbl_subclient', array('client_id'=>$FinalInvoiceDetail['Invoicedata']['client_id']));
					 
					 if($FinalInvoiceDetail['ClientDetail']['on_up_gst']=='1'){
						 $FinalInvoiceDetail['Branchdata'] = $this->CommanModel->getDataIfdataexists('*', 'tbl_branch', array('id'=>1, 'company_id'=>$this->session->userdata('company_id')));
						 }
					 else{
						 $FinalInvoiceDetail['Branchdata'] = $this->CommanModel->getDataIfdataexists('*', 'tbl_branch', array('id'=>$this->session->userdata('branch_id'), 'company_id'=>$this->session->userdata('company_id')));
					 }
					 //echo var_dump($FinalInvoiceDetail['Invoicedata']); exit;
					 $FinalInvoiceDetail['company'] = $this->CommanModel->CompanyDetail('*');
					//var_dump($FinalInvoiceDetail['Invoicedata']['payment_string']);exit;
				     $cutOnce =	explode(',',$FinalInvoiceDetail['Invoicedata']['payment_string']);
					 //var_dump($cutOnce[1]);
				      for($i=0;$i<count($cutOnce);$i++)
					  {
						  $serviceId[] = $cutOnce[$i+1][0];  
						  $subserviceId[] = $cutOnce[$i+1][2];
						  $clientRate[] =explode('-',$cutOnce[$i+1]);
					  }
					  
					  $ServiceDeatil = $this->CommanModel->getListWhereIn('hsn_sac','tbl_service','id', 'ASC', $serviceId);
					  for($o=0; $o < count($ServiceDeatil); $o++){
						  
						  if($ServiceDeatil[$o]['hsn_sac']!=''){
						  $HSN[] = $ServiceDeatil[$o]['hsn_sac'];
						  }
					  }
					  $FinalInvoiceDetail['HSN'] = implode(',', $HSN);
					  ///echo var_dump($ServiceDeatil); exit;
					/// echo var_dump($FinalInvoiceDetail['Invoicedata']); exit;
					  $paymentdetail =$FinalInvoiceDetail['Invoicedata']['payment_string'];
					  $paymentdetail = explode(',', $paymentdetail);
					  
					  for($i=0; $i< count($paymentdetail); $i++){
						  
						  $payment[$i]= explode('-', $paymentdetail[$i]);
					  }
					  $totalpaymentdetail =$FinalInvoiceDetail['Invoicedata']['total_payment_string'];
					  $totalpaymentdetail = explode(',', $totalpaymentdetail);
					  for($i=0; $i< count($totalpaymentdetail); $i++){
						  
						  $totalpayment[$i]= explode('-', $totalpaymentdetail[$i]);
					  }
					  $empdetail =$FinalInvoiceDetail['Invoicedata']['emp_details'];
					  $empdetail = explode(',', $empdetail);	
					  for($i=0; $i< count($empdetail); $i++){
						  
						  $totalemp[$i]= explode('-', $empdetail[$i]);
					  }
					
					  $FinalInvoiceDetail['paymentdetail']= $payment;
					  $FinalInvoiceDetail['totalpayment']= $totalpayment;
					  
					 
					//exit;
					 //var_dump($FinalInvoiceDetail['paymentdetail']);
					//var_dump($FinalInvoiceDetail['totalpayment']);exit;;
					 $this->load->view($this->layout, $FinalInvoiceDetail);
				 }
				 else
				 {
					   redirect('web/index');	
				 }
			}
			
			public function QuickInvoice(){
		
				if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
					$data['title'] 	 = 'Branchadmin | Employee';
					$data['content'] = 'branchadmin/employee/quickInvoice';
					$data['clientName']=$this->CommanModel->getList('id,client_name','tbl_client','id','ASC');
					
					$value['company_id'] 	= $this->session->userdata('company_id');
					$value['branch_id'] 	= $this->session->userdata('branch_id');
					$value['year_v'] 		= $this->input->post('year_v');
					$value['month_v'] 		= $this->input->post('month_v');
					$value['client_id'] 	= $this->input->post('client_id');
					$value['service_id']	= $this->input->post('service_id');
					$subserice 				= $this->input->post('subserice');
					$prasent 				= $this->input->post('prasent');
					$absent 				= $this->input->post('absent');
					$weekoff 				= $this->input->post('weekoff');
					$OT 					= $this->input->post('OT');
					
					$check = $value;
					
					
					$this->form_validation->set_rules("year_v", "Year", "trim|required");
					$this->form_validation->set_rules("month_v", "Month", "trim|required");
					$this->form_validation->set_rules("client_id", "Client", "trim|required");
					$this->form_validation->set_rules("service_id", "Service", "trim|required");
					
					
					$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
					$this->form_validation->set_message('required', '%s is required!');
			
					  if ($this->form_validation->run() == FALSE) {
						  $this->load->view($this->layout, $data);
					  }
					  else
					  {
						  if ($this->input->post('submit') == "Submit") {
							  if($subserice==''){
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Kindly Check Sub-Service </div>');
								redirect('branchadmin/Setting/QuickInvoice');
								}
								
							  for($i=0; $i < count($subserice); $i++){
								  $subserId = $subserice[$i]; 
								  if($prasent[$subserId]==''){
									  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Kindly Fill Present Days in Checked Sub-Service </div>');
										redirect('branchadmin/Setting/QuickInvoice');
								  }
								  
							  }
							for($i=0; $i < count($subserice); $i++){
								  $subserId = $subserice[$i]; 
								  if($prasent[$subserId]!=''){
									  $check['subservice_id'] =$subserId;
									  $find = $check;
									  $p = 'P-'.(float)$prasent[$subserId];
									  $a = 'A-'.(float)$absent[$subserId];
									  $w = 'W-'.(float)$weekoff[$subserId];
									  $o = 'OT-'.(float)$OT[$subserId];
									 $value['APW'] = $p.','.$a.','.$w.','.$o;
									 $value['emp_id'] = 0;
									 $value['attendance_id'] = 0;
									 $value['days'] = 0; 
									 $value['subservice_id'] =$subserId;
									 $find['emp_id'] = 0;
									 $find['attendance_id'] = 0;
									 $find['days'] = 0; 
									 
									 
									  
						$checkdata = $this->CommanModel->getDataIfdataexists('id', 'tbl_shift_emp', $check); 
							if($checkdata!=''){
								$checkagaindata = $this->CommanModel->getDataIfdataexists('id', 'tbl_shift_emp', $find);
								if($checkagaindata!=''){
									$value['updatedon']= date_timestamp_get(date_create());
									$value['updatedby']= $this->session->userdata('loginid');
									$update = $this->CommanModel->UpdateData('tbl_shift_emp',$value, array('id'=>$checkagaindata['id']));
									if($update){
										
										$Final = 'Update';
									}
								}
								else{
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Unable to update data by this Quick Invoice </div>');
									redirect('branchadmin/Setting/QuickInvoice');
								}
							}
							else{
								$value['createdon']= date_timestamp_get(date_create());
								$value['createdby']= $this->session->userdata('loginid');
								$insert = $this->CommanModel->InsertData('tbl_shift_emp',$value);
								if($insert){
									$Final = 'Insert';
								}
								
							}
								  }
								  
							  }
								if($Final=='Insert'){
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Successfully Submit. <a href="'.base_url('branchadmin/Setting/generateInvoice').'">Click Here</a> For Generate Invoice </div>');
									redirect('branchadmin/Setting/QuickInvoice');
								}else{
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Successfully Submit. <a href="'.base_url('branchadmin/Setting/generateInvoice').'">Click Here</a> For Generate Invoice </div>');
									redirect('branchadmin/Setting/QuickInvoice');
								}
						  }
					  }
				 }
				 else{
				
						redirect('web/index');	
				} 
			 }
		public function deleteInvoice($id){
			if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
				$getdata = $this->CommanModel->getListWhereLimit('id','tbl_client_invoice','id', 'DESC', array('branch_id'=>$this->session->userdata('branch_id')),1);
				
				if($getdata[0]['id']==$id){
					
					$delete =  $this->CommanModel->deleteData('tbl_client_invoice', array('id'=>$id));
					
					if($delete){
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Delete Successfully</div>');
					redirect('Reports/clientInvoiceList');
				}
				
			}	
			else{	
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission to delete this record!</div>');
					redirect('Reports/clientInvoiceList');
					}
			}
			else{
		
				redirect('web/index');	
			}
		}
		public function deleteSalary($id){
			if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
					$get_tran = $this->CommanModel->getListWhere('*','tbl_extradeduction_trans', 'id','asc', array('payable_id'=>$id));
					$get_deduction='';
					foreach($get_tran as $get_deduction_tran):
					$updatedeaction=''; $updatemi='';
					$get_deduction = $this->CommanModel->getDataIfdataexists('*','tbl_loan_advance_details', array('id'=>$get_deduction_tran['extradeduction_id']));
					if($get_deduction_tran['loan_approved']==$get_deduction_tran['paid']){
							$updatedeaction['due'] = (float)$get_deduction_tran['paid'];
							$updatedeaction['paid'] = '0.00';
							$updatedeaction['status'] = '0';
						
					}
					else{
						$updatedeaction['due'] = (float)$get_deduction['due'] + (float)$get_deduction_tran['paid'];
						$updatedeaction['paid'] = (float)$get_deduction['paid'] - (float)$get_deduction_tran['paid'];
						$updatedeaction['status'] = '0';
						
					}
					$updatededuction = 		$this->CommanModel->UpdateData('tbl_loan_advance_details',$updatedeaction, array('id'=>$get_deduction_tran['extradeduction_id']));	
					if($get_deduction_tran['loan_type']=='0'){
						$updatemi['emi_status'] = '0';
						$updatemi['emi_payable_id'] = '';
						$this->CommanModel->UpdateData('tbl_loan_details',$updatemi, array('id'=>$get_deduction_tran['emi_id']));
					}
					if($updatededuction){
						$deletex = $this->CommanModel->deleteData('tbl_extradeduction_trans', array('id'=>$get_deduction_tran['id']));
					}
					endforeach;
					$deletedetail =  $this->CommanModel->deleteData('tbl_salary_detail', array('salary_id'=>$id));
					$delete = $this->CommanModel->deleteData('tbl_salary', array('id'=>$id));
					
					if($delete){
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Delete Successfully</div>');
					redirect('Reports/ListOfSalaryAsClient');
					}
			}
			else{
		
				redirect('web/index');	
			}
		}
	public function deleteAttadance($id){
			if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
					$getdata = $this->CommanModel->getDataIfdataexists('attendance_id','tbl_shift_emp', array('id'=>$id));
					//var_dump($getdata); exit;
					$delete = $this->CommanModel->deleteData('tbl_attendance', array('id'=>$getdata['attendance_id']));
					$deletedetail =  $this->CommanModel->deleteData('tbl_shift_emp', array('id'=>$id));
					if($delete && $deletedetail){
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Data Delete Successfully</div>');
					redirect('Reports/empAttendanceList');
					}
			}
			else{
		
				redirect('web/index');	
			}
		}
		
		
			 public function addExtraDeduction() {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add ExtraDeduction';
			$data['content'] = 'branchadmin/setting/addExtraDeduction';
			
			$extradeduction['company_id'] 			= $this->session->userdata('company_id');
			$extradeduction['branch_id'] 			= $this->session->userdata('branch_id');
			$extradeduction['extradeduction_name']		= strtoupper($this->input->post('extradeduction_name'));
			$extradeduction['description']			= $this->input->post('description');
			$extradeduction['status']				= $this->input->post('status');
			$extradeduction['createdby']			= $this->session->userdata('loginid');
			$extradeduction['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['extradeductionList'] = $this->SettingModel->getList('*','tbl_extradeduction','id', 'ASC');
			//Company User Details
			
			
			$this->form_validation->set_rules("extradeduction_name", "ExtraDeduction Name", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  $checkdata = $this->SettingModel->getData('tbl_extradeduction', array('extradeduction_name'=>$extradeduction['extradeduction_name']));
					  
					  
					  if($checkdata==NULL){
					  $insert_id = $this->SettingModel->InsertData('tbl_extradeduction', $extradeduction);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Setting/addExtraDeduction');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Setting/addExtraDeduction');			
								} 
					  }
					  else{
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already Exist</div>');
							  		redirect('branchadmin/Setting/addExtraDeduction');	
					  }
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}

			public function editExtraDeduction($id) {
         
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Update ExtraDeduction';
			$data['content'] = 'branchadmin/setting/editExtraDeduction';
			
			$extradeduction['company_id'] 			= $this->session->userdata('company_id');
			$extradeduction['branch_id'] 			= $this->session->userdata('branch_id');
			$extradeduction['extradeduction_name']		= strtoupper($this->input->post('extradeduction_name'));
			$extradeduction_name_hidden				= strtoupper($this->input->post('extradeduction_name_hidden'));
			$extradeduction['description']			= $this->input->post('description');
			$extradeduction['status']				= $this->input->post('status');
			$extradeduction['updatedby']			= $this->session->userdata('loginid');
			$extradeduction['updatedon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['extradeductionList'] = $this->SettingModel->getList('*','tbl_extradeduction','id', 'ASC');
			$data['editextradeduction'] = $this->SettingModel->getData('tbl_extradeduction', array('id'=>$id));
			//Company User Details
			
			
			$this->form_validation->set_rules("extradeduction_name", "ExtraDeduction Name", "trim|required");
			
			//$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					
					 if($extradeduction['extradeduction_name']==$extradeduction_name_hidden){
									if($data['editextradeduction'][0]['branch_id']==$this->session->userdata('branch_id')){
									if($this->SettingModel->UpdateData('tbl_extradeduction',$extradeduction, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addExtraDeduction');
									}
						 			else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
								  		redirect('branchadmin/Setting/editExtraDeduction/'.$id);			
								}
								}else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editExtraDeduction/'.$id);			
									}			
								}
								else{
									if($f=$this->SettingModel->getData('tbl_department', array('department_name'=>$extradeduction['extradeduction_name']))){
									if($f[0]['status']!='3') {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Record is already registerd</div>');
									redirect('branchadmin/Setting/editExtraDeduction/'.$id);
									}
									
								}
								else{
									if($data['editextradeduction'][0]['branch_id']==$this->session->userdata('branch_id')){
										if($this->SettingModel->UpdateData('tbl_extradeduction',$extradeduction, array('id'=>$id))) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Has Been Updated.</div>');
										redirect('branchadmin/Setting/addExtraDeduction');
									}
									}
									else {
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">You Do not have permission for edit this record</div>');
								  		redirect('branchadmin/Setting/editExtraDeduction/'.$id);
									}
								}
									
							}
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		}
		
	}
	
			public function upateInvoice(){
				
				$getlist = $this->CommanModel->getAllListAll('id,payment_string','tbl_client_invoice','id', 'ASC');
				
				
				foreach($getlist as $data){
					$payment =''; $paydetail='';$service='';$subservice='';
					$id = $data['id'];
					$payment =$data['payment_string'];
					$paydetail = explode(',', $payment);
					//var_dump($paydetail);
					
					for($i=1; $i < count($paydetail); $i++){
						
						$detail = explode('-', $paydetail[$i]);
						$service[] = $detail[0];
						$subservice[] = $detail[1];
						sort($service);
						sort($subservice);
						$UPDATE['service_ids'] = implode(',', array_unique($service));
						$UPDATE['sub_service_ids'] = implode(',', array_unique($subservice));
						//var_dump($detail);
						
					}
					//var_dump($UPDATE);
					$updatedata   =  $this->CommanModel->UpdateData('tbl_client_invoice',$UPDATE, array('id'=>$id));
						//var_dump($SUBSERVER);
					
				}
				
				
				
				
			}
}
