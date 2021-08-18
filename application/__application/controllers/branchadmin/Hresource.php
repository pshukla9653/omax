<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hresource extends Mycontroller{ 

	public function index(){
		

 //$this->load->library('mycalendar');

	echo var_dump($this->mycalendar->GetDaysDataFromMonth(2,2017,'L'));
		}
	
	public function __construct(){
     
          parent::__construct();
		  $this->load->library('mycalendar');
		  
     }
	 
	 public function applicationForm(){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Application';
			$data['content'] = 'branchadmin/hresource/applicationForm';
			
			$applicant['company_id'] 			= $this->session->userdata('company_id');
			$applicant['branch_id'] 			= $this->session->userdata('branch_id');
			//$date  								= $this->input->post('date_of_apply');
			//$dataf 								= explode('/', $date);
			$applicant['date_of_apply']			= date("Y-m-d", strtotime($this->input->post('date_of_apply')));
			$applicant['applicant_name']		= $this->input->post('applicant_name');
			$applicant['father_name']			= $this->input->post('father_name');
			$applicant['mobile']				= $this->input->post('mobile');
			$applicant['department_id']			= $this->input->post('department_id');
			$applicant['designation_id']		= $this->input->post('designation_id');
			$applicant['status']				= $this->input->post('status');
			$applicant['application_status']	= 1;
			$applicant['dob']					= date("Y-m-d", strtotime($this->input->post('dob')));
			$applicant['gender']				= $this->input->post('gender');
			$applicant['marital_status']		= $this->input->post('marital_status');
			$applicant['edu_qua']				= $this->input->post('edu_qua');
			$applicant['tech_qua']				= $this->input->post('tech_qua');
			$applicant['work_exp']				= $this->input->post('work_exp');
			$applicant['last_salary']			= $this->input->post('last_salary');
			$applicant['expected_salary']		= $this->input->post('expected_salary');
			$applicant['notice_period']			= $this->input->post('notice_period');
			$applicant['address']				= $this->input->post('address');
			$applicant['city']					= $this->input->post('city');
			$applicant['state']				= $this->input->post('state');
			$applicant['country']				= $this->input->post('country');
			$applicant['createdby']				= $this->session->userdata('loginid');
			$applicant['createdon']				= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['designationList'] = $this->SettingModel->getListWhere('*','tbl_designation','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			
			$data['applicationList'] = $this->CommanModel->getDataFromThreeTables('tbl_application.*,tbl_department.department_name,tbl_designation.designation_name', 
			'tbl_application', 'tbl_department', 'tbl_designation', 'tbl_application.department_id=tbl_department.id','tbl_application.designation_id=tbl_designation.id');
			//Company User Details
			$this->form_validation->set_rules("last_salary", "last salary ", "trim|required");
			$this->form_validation->set_rules("date_of_apply", "Date of Apply", "trim|required");
			$this->form_validation->set_rules("applicant_name", "Applicant Name", "trim|required");
			$this->form_validation->set_rules("father_name", "Father Name", "trim|required");
			$this->form_validation->set_rules("mobile", "Mobile", "trim|required");
			$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
			$this->form_validation->set_rules("edu_qua", "Education Qualification", "trim|required");
			$this->form_validation->set_rules("expected_salary", "Expected Salary", "trim|required");
			$this->form_validation->set_rules("department_id", "Department", "trim|required");
			$this->form_validation->set_rules("designation_id", "Designation", "trim|required");
			$this->form_validation->set_rules("address", "Address", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 //echo var_dump($_POST); exit; 
					  
					  $exsitdata = $this->CommanModel->Ifdataexists('id','tbl_application', array('applicant_name'=>$applicant['applicant_name'],
					  'father_name'=>$applicant['father_name'],'mobile'=>$applicant['mobile']));
					  if($exsitdata==0){
					  $insert_id = $this->CommanModel->InsertData('tbl_application', $applicant);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  if(!empty($_FILES['resume'])){
							$config['upload_path'] = 'uploads/resume/';
							$config['allowed_types'] = 'doc | pdf';
							$config['max_size'] = '0';
							$config['max_filename'] = '255';
							$config['encrypt_name'] = TRUE;
							$file = array();
							$is_file_error = FALSE;
							if (!$is_file_error) {
								$s =  $this->upload->initialize($config);
								if (!$this->upload->do_upload('resume')) {
							echo $this->upload->display_errors();
							$is_file_error = TRUE;
						} else {
							$file = $this->upload->data();
						}
					}	
							if (!$is_file_error) {
						$this->SettingModel->save_file_info($file, array('id'=>$insert_id),'tbl_application','resume');
						
						
					}
							}
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Hresource/applicationForm');
						  
								}
								else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Hresource/applicationForm');			
								} 
					  }
					   else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Register!</div>');
							  		redirect('branchadmin/Hresource/applicationForm');			
								} 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function editapplicationForm($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Application';
			$data['content'] = 'branchadmin/hresource/editapplicationForm';
			
			$applicant['company_id'] 			= $this->session->userdata('company_id');
			$applicant['branch_id'] 			= $this->session->userdata('branch_id');
			$date  								= $this->input->post('date_of_apply');
			$dataf 								= explode('/', $date);
			$applicant['date_of_apply']			= $dataf[2].'-'.$dataf[1].'-'.$dataf[0];
			$applicant['applicant_name']		= $this->input->post('applicant_name');
			$applicant['father_name']			= $this->input->post('father_name');
			$applicant['mobile']				= $this->input->post('mobile');
			$applicant['department_id']			= $this->input->post('department_id');
			$applicant['designation_id']		= $this->input->post('designation_id');
			$applicant['status']				= $this->input->post('status');
			$applicant['application_status']	= $this->input->post('application_status');
			$applicant['address']				= $this->input->post('address');
			$applicant['createdby']				= $this->session->userdata('loginid');
			$applicant['createdon']				= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['designationList'] = $this->SettingModel->getListWhere('*','tbl_designation','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			
			$data['applicationList'] = $this->CommanModel->getDataFromThreeTables('tbl_application.*,tbl_department.department_name,tbl_designation.designation_name', 
			'tbl_application', 'tbl_department', 'tbl_designation', 'tbl_application.department_id=tbl_department.id','tbl_application.designation_id=tbl_designation.id');
			
			$data['editapplicant'] = $this->CommanModel->getData('tbl_application', array('id'=>$id));
			
			//Company User Details
			
			$this->form_validation->set_rules("date_of_apply", "Date of Apply", "trim|required");
			$this->form_validation->set_rules("applicant_name", "Applicant Name", "trim|required");
			$this->form_validation->set_rules("father_name", "Father Name", "trim|required");
			$this->form_validation->set_rules("mobile", "Mobile", "trim|required");
			$this->form_validation->set_rules("department_id", "Department", "trim|required");
			$this->form_validation->set_rules("designation_id", "Designation", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Update") {
					 // echo var_dump($_POST); exit; 
					  
					  
					  
					  $insert_id = $this->CommanModel->UpdateData('tbl_application', $applicant, array('id'=>$id));
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
							 		redirect('branchadmin/Hresource/applicationForm');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Hresource/applicationForm');			
								} 
					   
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function generateLetters(){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/generateLetters';
			
			  $letterdetail['letter_type'] = $this->input->post('letter_type');
			  $letterdetail['applicant_name'] = $this->input->post('applicant_name');
			  
			  $this->form_validation->set_rules("letter_type", "Please Select Letter Type First", "trim|required");
			  $this->form_validation->set_rules("applicant_name", "Select Applicant Name", "trim|required");
			  
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				      
					 // OFFER LETTER 
				    if($letterdetail['letter_type'] == 1)
					{
                       redirect('branchadmin/Hresource/offerLetter/'.$letterdetail['applicant_name']);
						
					}
					
					// CONFIRMATION LETTER
					if($letterdetail['letter_type'] == 2)
					{
						$checkofferletter = $this->CommanModel->getDataIfdataexists('applicant_id','tbl_offerletter',array('applicant_id'=>$letterdetail['applicant_name']));
						if($checkofferletter)
						{
						  redirect('branchadmin/Hresource/confirmationLetter/'.$letterdetail['applicant_name']);
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning">First Create Offer Letter</div>');
							redirect('branchadmin/Hresource/generateLetters');
						}
					}
					// APPOINTMENT LETTER
					if($letterdetail['letter_type'] == 3)
					{
						$checkconfiermationletter = $this->CommanModel->getDataIfdataexists('applicant_id','tbl_confirmation_letter',array('applicant_id'=>$letterdetail['applicant_name']));
						if($checkconfiermationletter)
						{
						  redirect('branchadmin/Hresource/appointmentLetter/'.$letterdetail['applicant_name']);
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning">First Create Confirmation Letter</div>');
							redirect('branchadmin/Hresource/generateLetters');
						}
					}
					// APPLICANT TO EMPLOYEE
					if($letterdetail['letter_type'] == 4)
					{
						$checkappointmentletter = $this->CommanModel->getDataIfdataexists('applicant_id','tbl_appointment_letter',array('applicant_id'=>$letterdetail['applicant_name']));
						if($checkappointmentletter)
						{
						  redirect('branchadmin/Hresource/convertApplicantToEmployee/'.$letterdetail['applicant_name']);
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning">First Create Appointment Letter</div>');
							redirect('branchadmin/Hresource/generateLetters');
						}
					}
					
			  }
			
			
		}
		else{
		
				redirect('web/index');	
		} 
	 } 
	 
	 public function printLetter()
	 {
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/printLetters';
			$data['offerletterlist'] = $this->CommanModel->getAllListAll('*','tbl_offerletter','id','ASC');
			$data['allaplicantlist'] = $this->CommanModel->getAllListAll('*','tbl_application','id','ASC');	
			$this->load->view($this->layout,$data);
		}
		else
		{
			redirect('web/index');
		}
	 }
	 
	 public function offerLetter($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/offerForm';
			$data['appFormDetails']  = $this->CommanModel->getData('tbl_application', array('id'=>$id));
			$data['offerdetail']  = $this->CommanModel->getData('tbl_offerletter', array('applicant_id'=>$id));
			
			
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			
			//Company User Details
			$applicantotherdetail['applicant_id']   =  $id;
			$applicantotherdetail['reportingon']    =  $this->input->post('reportingon');
			$applicantotherdetail['place']          =  $this->input->post('place');
			$applicantotherdetail['interviewon']    =  $this->input->post('interviewon');
			$applicantotherdetail['interviewed_by'] =  $this->input->post('interviewed_by');
			$applicantotherdetail['post_offered']   =  $this->input->post('post_offered');
			$applicantotherdetail['offered_salary'] =  $this->input->post('offered_salary');
			$applicantotherdetail['reference_number'] = random_string('numeric', 8);
			$applicantotherdetail['letter_status'] =  1;
			$this->form_validation->set_rules("reportingon", "Reporting On Time","trim|required");
			$this->form_validation->set_rules("place", "Location or Place","trim|required");
            $this->form_validation->set_rules("interviewon", "Interview Time","trim|required");
			$this->form_validation->set_rules("interviewed_by", "Interview By","trim|required");
			$this->form_validation->set_rules("post_offered", "Post Offered","trim|required");
			$this->form_validation->set_rules("offered_salary", "Offered salary","trim|required|numeric");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
		 $applicantid = $this->CommanModel->Ifdataexists('applicant_id', 'tbl_offerletter' , array('applicant_id'=>$this->input->post('hidetxt')));
					  //$insert_id = $this->SettingModel->InsertData('tbl_offerletter', $applicantotherdetail);
					  //echo var_dump($insert_c_id); exit;
					  if($applicantid == 0)
					  {
						 $this->SettingModel->InsertData('tbl_offerletter', $applicantotherdetail); 
						 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
						 redirect('branchadmin/Hresource/offerLetter/'.$this->input->post('hidetxt'));
						  
					  }
					  else 
					  {
						$this->CommanModel->UpdateData('tbl_offerletter',$applicantotherdetail, array('applicant_id'=>$this->input->post('hidetxt')));  
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Updated Successfully</div>');
						redirect('branchadmin/Hresource/offerLetter/'.$this->input->post('hidetxt'));			
					  } 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }  
	 
	 public function generateofferletter($id)
	 {
		 
		 $data['details'] =   $this->CommanModel->getData('tbl_offerletter', array('applicant_id'=>$id));
		 $data['details2'] =  $this->CommanModel->getData('tbl_application', array('id'=>$id));
		 $branchid['bid']  =  $data['details2'][0]['branch_id'];
		 
		 $data['details3'] =  $this->CommanModel->getDataIfdataexists('branch_name','tbl_branch',array('id'=>$branchid['bid']));
		 $letter_status = $this->CommanModel->getDataIfdataexists('letter_status','tbl_offerletter',array('applicant_id'=>$id));
		 if($letter_status)
		 {
			 $data['title'] 	 = 'Hresource | OfferLetter';
			 $data['content'] = 'branchadmin/hresource/offerletter';
		     $this->load->view($this->layout,$data);
		 }
		 else
		 {
			 $this->session->set_flashdata('msg', '<div class="alert alert-warning">Offer Letter is not created of this Applicant</div>');
			 redirect('branchadmin/Hresource/printLetter');
		 }
	 }
	 
	 public function confirmationLetter($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/ConfirmationForm';
	$data['details3'] =  $this->CommanModel->getDataIfdataexists('applicant_name,father_name,id','tbl_application',array('id'=>$id));
	$data['details'] =  $this->CommanModel->getDataIfdataexists('reference_number','tbl_offerletter',array('applicant_id'=>$id));
	//$data['confirmationletterlist'] = $this->CommanModel->getList('*','tbl_confirmation_letter','id','ASC');
	$data['confirmationletterlist']  = $this->CommanModel->getData('tbl_confirmation_letter', array('applicant_id'=>$id));
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			//Company User Details
			
			$confirmationdata['applicant_id'] = $this->input->post('hidetxt');
			
			$confirmationdata['grade'] = $this->input->post('grade');
			$confirmationdata['designation'] = $this->input->post('designation');
			$confirmationdata['appointemntdate'] = $this->input->post('appointemntdate');
			$confirmationdata['signDesignation'] = $this->input->post('signDesignation');
			$confirmationdata['confirmdate'] = $this->input->post('confirmdate');
			$confirmationdata['reportdate'] = $this->input->post('reportdate');
			$confirmationdata['createdby']			= $this->session->userdata('loginid');
			$confirmationdata['createdon']			= date_timestamp_get(date_create());
			$confirmationdata['letter_status'] =  1;
			$this->form_validation->set_rules("grade", "Grade Name", "trim|required");
			$this->form_validation->set_rules("designation", "Designation Name", "trim|required");
			$this->form_validation->set_rules("signDesignation", "Signatory Name (Designation)", "trim|required");
			$this->form_validation->set_rules("appointemntdate", "Appointemnt Date", "trim|required");
			$this->form_validation->set_rules("confirmdate", "Confirmatio Date", "trim|required");
			$this->form_validation->set_rules("reportdate", "Report Date", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					//echo var_dump($_POST); exit; 
					  
				$applicantid = $this->CommanModel->Ifdataexists('applicant_id', 'tbl_confirmation_letter' , array('applicant_id'=>$this->input->post('hidetxt')));
					  //echo var_dump($insert_c_id); exit;
					  if($applicantid == 0)
					   {
						  $this->SettingModel->InsertData('tbl_confirmation_letter', $confirmationdata); 
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
						  redirect('branchadmin/Hresource/confirmationLetter/'.$this->input->post('hidetxt'));
					   }
					   else
					   {
						$this->CommanModel->UpdateData('tbl_confirmation_letter',$confirmationdata, array('applicant_id'=>$this->input->post('hidetxt')));
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Updated Successfully</div>');
						redirect('branchadmin/Hresource/confirmationLetter/'.$this->input->post('hidetxt'));			
					   } 
				   }
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	  public function generateconfirmationletter($id)
	 {
		 
		 $data['details'] =   $this->CommanModel->getData('tbl_offerletter', array('applicant_id'=>$id));
		 $data['details2'] =  $this->CommanModel->getData('tbl_application', array('id'=>$id));
		 $branchid['bid']  =  $data['details2'][0]['branch_id'];
		 $data['appid'] = $id;
		 $data['details3'] =  $this->CommanModel->getDataIfdataexists('branch_name','tbl_branch',array('id'=>$branchid['bid']));
		 $letter_status = $this->CommanModel->getDataIfdataexists('letter_status','tbl_confirmation_letter',array('applicant_id'=>$id));
		 if($letter_status)
		 {
			  $data['title'] 	 = 'Confirmation | Letter';
			 $data['content'] = 'branchadmin/hresource/confirmationletter';
		     $this->load->view($this->layout,$data);
			 
		 }
		 else
		 {
			 $this->session->set_flashdata('msg', '<div class="alert alert-warning">Confirmation Letter is not created of this Applicant</div>');
			 redirect('branchadmin/Hresource/printLetter');
		 }
		 
	 }
	 
	
	 
	 public function appointmentLetter($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/AppointmentForm';
			$data['details'] =  $this->CommanModel->getDataIfdataexists('applicant_name,father_name,id','tbl_application',array('id'=>$id));
			$data['details2'] =  $this->CommanModel->getDataIfdataexists('post_offered,applicant_id','tbl_offerletter',array('applicant_id'=>$id));
			$data['grade']    =  $this->CommanModel->getList('grade_name,id','tbl_grade','id','ASC');
			
			//$data['appointmentletterlist'] = $this->CommanModel->getList('*','tbl_appointment_letter','id','ASC');
			$data['appointmentletterlist']  = $this->CommanModel->getData('tbl_appointment_letter', array('applicant_id'=>$id));
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			//Company User Details
			
			$appointmentdetails['applicant_id'] = $this->input->post('hidetxt');
			$appointmentdetails['sdesignation'] = $this->input->post('sdesignation');
			$appointmentdetails['grade'] = $this->input->post('grade');
			$appointmentdetails['probation_period'] = $this->input->post('probation_period');
			$appointmentdetails['appointmentdate'] = $this->input->post('appointmentdate');
			$appointmentdetails['refnumber'] = $this->input->post('refnumber');
			$appointmentdetails['generation_date'] = $this->input->post('generation_date');
			$appointmentdetails['notice_period'] = $this->input->post('notice_period');
			$appointmentdetails['signdate'] = $this->input->post('signdate');
			$appointmentdetails['createdby']			= $this->session->userdata('loginid');
			$appointmentdetails['createdon']			= date_timestamp_get(date_create());
			$appointmentdetails['letter_status'] =  1;
			
			$this->form_validation->set_rules("sdesignation", "Signatory Name (Designation)", "trim|required");
			$this->form_validation->set_rules("grade", "Grade Name", "trim|required");
			$this->form_validation->set_rules("probation_period", "Probation Period", "trim|required");
			$this->form_validation->set_rules("appointmentdate", "Appointment Date", "trim|required");
	        $this->form_validation->set_rules("refnumber", "Refrence Number Wrong", "trim|required");
	        $this->form_validation->set_rules("generation_date", "Generation Date", "trim|required");
			$this->form_validation->set_rules("notice_period", "Notice Period", "trim|required");
			$this->form_validation->set_rules("signdate", "Signatue Date", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else 
			  {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit")
				    {
					 //echo var_dump($_POST); exit;  
					 
					  $insert_id = $this->CommanModel->getDataIfdataexists('reference_number','tbl_offerletter',array('applicant_id'=>$this->input->post('hidetxt')));
					 /// echo var_dump($insert_id['reference_number']); exit;
					 if($insert_id['reference_number'] == $appointmentdetails['refnumber'])
					 {
						 $applicantid = $this->CommanModel->Ifdataexists('applicant_id', 'tbl_appointment_letter' , array('applicant_id'=>$this->input->post('hidetxt')));
					     if($applicantid == 0) 
					     {
						    $this->SettingModel->InsertData('tbl_appointment_letter', $appointmentdetails);
						    $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
						    redirect('branchadmin/Hresource/appointmentLetter/'.$this->input->post('hidetxt'));
						  
					     }
					    else 
					     {
						   $this->CommanModel->UpdateData('tbl_appointment_letter',$appointmentdetails, array('applicant_id'=>$this->input->post('hidetxt')));
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Updated Successfully</div>');
						   redirect('branchadmin/Hresource/appointmentLetter/'.$this->input->post('hidetxt'));			
					     }
					 }
					 else
					 {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Reference Number .</div>');
						  redirect('branchadmin/Hresource/appointmentLetter'); 
					 }
				}
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function generateAppointmentLetter($id)
	 {
		 $data['id'] = $id;
		 $data['details'] =   $this->CommanModel->getData('tbl_offerletter', array('applicant_id'=>$id));
		 $data['details2'] =  $this->CommanModel->getData('tbl_application', array('id'=>$id));
		// $branchid['bid']  =  $data['details2'][0]['branch_id'];
		 
		 $data['details3'] =  $this->CommanModel->getDataIfdataexists('appointmentdate','tbl_appointment_letter',array('applicant_id'=>$id));
		 $letter_status = $this->CommanModel->getDataIfdataexists('letter_status','tbl_appointment_letter',array('applicant_id'=>$id));
		 if($letter_status)
		 {
			 $data['title'] 	 = 'Appointment | Letter';
			 $data['content'] = 'branchadmin/hresource/Appointmentletter';
		     $this->load->view($this->layout,$data);
		 }
		 else
		 {
			  $this->session->set_flashdata('msg', '<div class="alert alert-warning">Appointment Letter is not created of this Applicant</div>');
			  redirect('branchadmin/Hresource/printLetter');
		 }
	 }
	 
	 public function convertApplicantToEmployee($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/hresource/applicantToemployee';
			$data['empdetails'] =  $this->CommanModel->getDataIfdataexists('applicant_name,id,father_name,dob,address,city,mobile,edu_qua,gender','tbl_application',array('id'=>$id));
			$data['empdesignation'] =  $this->CommanModel->getDataIfdataexists('post_offered','tbl_offerletter',array('applicant_id'=>$id));
		
		   $data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
	         $this->load->view($this->layout, $data);
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 //last 
	 public function createConvertEmployee($id)
	 {
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Employee';
			$data['content'] = 'branchadmin/hresource/create';
			$data['applicant_details'] = $this->CommanModel->getDataIfdataexists('*','tbl_application',array('id'=>$id));
			$data['joindate'] = $this->CommanModel->getDataIfdataexists('appointmentdate,grade','tbl_appointment_letter',array('applicant_id'=>$id));
			$data['applicant_post'] = $this->CommanModel->getDataIfdataexists('post_offered','tbl_offerletter',array('applicant_id'=>$id));
			$data['empcode'] = $this->input->post('empcode');
			$data['empdepart'] = $this->input->post('department');
			$form['company_id'] 			= $this->session->userdata('company_id');
			$form['branch_id'] 				= $this->session->userdata('branch_id');
			$form['emp_code'] 				= $this->input->post('emp_code'); 
			$form['emp_name'] 				= $this->input->post('emp_name'); 
			
			$form['dob'] 					= $this->convertDatetoMysqlDate($this->input->post('dob')); 
			$form['gender'] 				= $this->input->post('gender'); 
			$form['language_known'] 		= $this->input->post('language_known'); 
			$form['married_status'] 		= $this->input->post('married_status'); 
			$form['identification_mark'] 	= $this->input->post('identification_mark'); 
			$form['nationality'] 			= $this->input->post('nationality'); 
			$form['mother_name'] 			= $this->input->post('mother_name'); 
			$form['mobile'] 				= $this->input->post('mobile'); 
			$form['email'] 					= $this->input->post('email'); 
			$form['pan'] 					= $this->input->post('pan'); 
			$form['adhar_card_no'] 			= $this->input->post('adhar_card_no'); 
			$form['religion'] 				= $this->input->post('religion'); 
			$form['father_name'] 			= $this->input->post('father_name'); 
			$form['wife_husband_name'] 		= $this->input->post('wife_husband_name'); 
			$form['children'] 				= $this->input->post('children'); 
			$form['blood_group'] 			= $this->input->post('blood_group'); 
			$form['hight'] 					= $this->input->post('hight'); 
			$form['weight'] 				= $this->input->post('weight'); 
			$form['chest'] 					= $this->input->post('chest'); 
			$form['cast'] 					= $this->input->post('cast'); 
			$form['p_village'] 				= $this->input->post('p_village'); 
			$form['p_post'] 				= $this->input->post('p_post'); 
			$form['p_police_station'] 		= $this->input->post('p_police_station'); 
			$form['p_dist'] 				= $this->input->post('p_dist'); 
			$form['p_state'] 				= $this->input->post('p_state'); 
			$form['p_pin'] 					= $this->input->post('p_pin'); 
			$form['p_mobile'] 				= $this->input->post('p_mobile'); 
			$form['village'] 				= $this->input->post('village'); 
			$form['post'] 					= $this->input->post('post'); 
			$form['police_station'] 		= $this->input->post('police_station'); 
			$form['dist'] 					= $this->input->post('dist'); 
			$form['t_state'] 				= $this->input->post('t_state'); 
			$form['pin'] 					= $this->input->post('pin'); 
			$form['t_mobile'] 				= $this->input->post('t_mobile'); 
			$form['createdby'] 				= $this->session->userdata('loginid');
			$form['createdon']				= date_timestamp_get(date_create());


			


			
			
			$form_detail['doj'] 			= $this->convertDatetoMysqlDate($this->input->post('doj'));  
			$form_detail['job_type'] 		= $this->input->post('job_type'); 
			$form_detail['experience'] 		= $this->input->post('experience'); 
			$form_detail['esic_id'] 		= $this->input->post('esic_id'); 
			$form_detail['pf_id'] 			= $this->input->post('pf_id'); 
			$form_detail['account_no'] 		= $this->input->post('account_no');
			$form_detail['bank_name'] 		= $this->input->post('bank_name');
			$form_detail['ifsc_code'] 		= $this->input->post('ifsc_code');
			$form_detail['branch_code'] 	= $this->input->post('branch_code'); 
			$form_detail['bank_branch_name']= $this->input->post('bank_branch_name'); 
			$form_detail['salary_type'] 	= $this->input->post('salary_type');
			$form_detail['grade'] 			= $this->input->post('grade');
			$form_detail['department'] 		= $this->input->post('department');
			$form_detail['designation'] 	= $this->input->post('designation'); 
			
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('id,department_name','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['designationList'] = $this->SettingModel->getListWhere('id,designation_name','tbl_designation','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['gradeList'] = $this->SettingModel->getListWhere('id,grade_name','tbl_grade','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['bankList'] = $this->SettingModel->getListWhere('id,bank_name','tbl_bank','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));

			//Company User Details
			
			$this->form_validation->set_rules("account_no", "Account Number", "trim|required|is_unique[tbl_employee_official.account_no]");
			$this->form_validation->set_rules("emp_code", "Employee Code", "trim|required|is_unique[tbl_employee.emp_code]");
			$this->form_validation->set_rules("pan", "PAN", "trim|is_unique[tbl_employee.pan]");
			$this->form_validation->set_rules("adhar_card_no", "Adhar Card", "trim|is_unique[tbl_employee.adhar_card_no]");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   
					 /*echo var_dump($_POST);
					 echo '<br>';
					 
					 echo var_dump($_FILES);
					  exit; */
					  
					  $insert_id = $this->SettingModel->InsertData('tbl_employee', $form);
					  //echo var_dump($insert_c_id); exit;
					  if($insert_id) {
						  for($t=1; $t<=5; $t++){
			$form_sub['emp_id'] 			= $insert_id; 				  
			$form_sub['class_stad'] 		= $this->input->post('class_stad'.$t); 
			$form_sub['subject'] 			= $this->input->post('subject'.$t); 
			$form_sub['collage_name'] 		= $this->input->post('collage_name'.$t); 
			$form_sub['passing_year'] 		= $this->input->post('passing_year'.$t); 
			$form_sub['division']			= $this->input->post('division'.$t);
			if($form_sub['class_stad']!=''){
			$this->SettingModel->InsertData('tbl_employee_qualification', $form_sub);
			}
						  }
						  
						  for($t=1; $t<=3; $t++){
			$form_lin['emp_id'] 			= $insert_id; 				  
			$form_lin['licence_type'] 		= $this->input->post('licence_type'.$t); 
			$form_lin['issued_by'] 			= $this->input->post('issued_by'.$t);
			$form_lin['regi_no'] 			= $this->input->post('regi_no'.$t);
			$form_lin['issue_date'] 		= $this->convertDatetoMysqlDate($this->input->post('issue_date'.$t));
			$form_lin['valid_upto'] 		= $this->convertDatetoMysqlDate($this->input->post('valid_upto'.$t));
			
			if($form_lin['licence_type']!=''){
			$this->SettingModel->InsertData('tbl_employee_licence', $form_lin);
			}
						  }
						  
						  for($t=1; $t<=2; $t++){
			$form_ref['emp_id'] 			= $insert_id; 				  
			$form_ref['ref_person_name'] 	= $this->input->post('ref_person_name'.$t); 
			$form_ref['ref_person_add'] 	= $this->input->post('ref_person_add'.$t); 
			$form_ref['ref_person_mbile'] 	= $this->input->post('ref_person_mbile'.$t); 
			$form_ref['ref_person_known'] 	= $this->input->post('ref_person_known'.$t); 
			if($form_ref['ref_person_name']!=''){
			$this->SettingModel->InsertData('tbl_employee_reference', $form_ref);
			}
						  }
						  
						  $form_detail['emp_id'] 			= $insert_id;
						  
						  $in_id =  $this->SettingModel->InsertData('tbl_employee_official', $form_detail);
						  if($in_id)
						    {
							   if(!empty($_FILES['logo']))
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
										if (!$this->upload->do_upload('logo'))
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$insert_id),'tbl_employee_official','photo');
						
						
					}
							}
							   
							   if(!empty($_FILES['right_thumb']))
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
										if (!$this->upload->do_upload('right_thumb'))
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$insert_id),'tbl_employee_official','right_thumb');
						
						
					}
							}
							    
							   if(!empty($_FILES['left_thumb']))
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
										if (!$this->upload->do_upload('left_thumb'))
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$insert_id),'tbl_employee_official','left_thumb');
						
						
					}
							}	
						  }
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
							 		redirect('branchadmin/Employee/employeeList');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Hresource/createConvertEmployee');			
								} 
				  
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	
	 
	 public function bonusSetup(){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/employee/create';
			
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			//Company User Details
			
			
			$this->form_validation->set_rules("department_name", "Department Name", "trim|required|is_unique[tbl_department.department_name]");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  
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
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function birthDayReminder(){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Department';
			$data['content'] = 'branchadmin/employee/create';
			
			$department['company_id'] 			= $this->session->userdata('company_id');
			$department['branch_id'] 			= $this->session->userdata('branch_id');
			$department['department_name']		= strtoupper($this->input->post('department_name'));
			$department['description']			= $this->input->post('description');
			$department['status']				= $this->input->post('status');
			$department['createdby']			= $this->session->userdata('loginid');
			$department['createdon']			= date_timestamp_get(date_create());
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			$data['departmentList'] = $this->SettingModel->getListWhere('*','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id')));
			//Company User Details
			
			
			$this->form_validation->set_rules("department_name", "Department Name", "trim|required|is_unique[tbl_department.department_name]");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('submit') == "Submit") {
					 // echo var_dump($_POST); exit; 
					  
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
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	
	       
}
