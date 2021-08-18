<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends Mycontroller{ 

	
	
	public function __construct(){
     		
          parent::__construct();
		  $this->load->library('mycalendar');
		  
     }
	 
	 public function create(){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Employee';
			$data['content'] = 'branchadmin/employee/create';
			
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
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('id,department_name','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$data['designationList'] = $this->SettingModel->getListWhere('id,designation_name','tbl_designation','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$data['gradeList'] = $this->SettingModel->getListWhere('id,grade_name','tbl_grade','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));

			//Company User Details
			
			$this->form_validation->set_rules("account_no", "Account Number", "trim|numeric");
			$this->form_validation->set_rules("emp_code", "Employee Code", "trim|required");
			$this->form_validation->set_rules("pan", "PAN", "trim|is_unique[tbl_employee.pan]");
			$this->form_validation->set_rules("adhar_card_no", "Adhar Card", "trim|is_unique[tbl_employee.adhar_card_no]|numeric");
			
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
					  $checkdata = $this->SettingModel->getData('tbl_employee', array('emp_code'=>$form['emp_code'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
					  if($checkdata == NULL){
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
							$in_id = $this->SettingModel->InsertData('tbl_employee_official', $form_detail);
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
							  		redirect('branchadmin/Employee/create');			
								} 
			  }
				else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Emp Code is aleardy Exist!</div>');
							  		redirect('branchadmin/Employee/create');			
								}   
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function editEmp($id){
		
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Add Employee';
			$data['content'] = 'branchadmin/employee/edit';
			
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
			$form_detail['bank_branch_name'] = $this->input->post('bank_branch_name');
			$form_detail['salary_type'] 	= $this->input->post('salary_type');
			$form_detail['grade'] 			= $this->input->post('grade');
			$form_detail['department'] 		= $this->input->post('department');
			$form_detail['designation'] 	= $this->input->post('designation');
			if($form_detail['date_of_leave']!=''){ 
			$form_detail['date_of_leave'] 	= $this->convertDatetoMysqlDate($this->input->post('date_of_leave')); 
			}
			//echo var_dump($_POST); exit;
			
			
			$data['departmentList'] = $this->SettingModel->getListWhere('id,department_name','tbl_department','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$data['designationList'] = $this->SettingModel->getListWhere('id,designation_name','tbl_designation','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$data['gradeList'] = $this->SettingModel->getListWhere('id,grade_name','tbl_grade','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			
			$data['editemp'] = $this->CommanModel->getDataFromTwoTables('tbl_employee.*,tbl_employee_official.*', 'tbl_employee','tbl_employee_official','tbl_employee.id=tbl_employee_official.emp_id',array('tbl_employee.id'=>$id));
			$data['editquali'] = $this->SettingModel->getListWhere('*','tbl_employee_qualification','id', 'ASC', array('emp_id'=>$id));
			$data['editlice'] = $this->SettingModel->getListWhere('*','tbl_employee_licence','id', 'ASC', array('emp_id'=>$id));
			$data['editrefe'] = $this->SettingModel->getListWhere('*','tbl_employee_reference','id', 'ASC', array('emp_id'=>$id));

			//Company User Details
			//echo var_dump($data['editemp']); exit;
			
			$this->form_validation->set_rules("emp_code", "Employee Code", "trim|required");
			$this->form_validation->set_rules("pan", "PAN", "trim");
			$this->form_validation->set_rules("adhar_card_no", "Adhar Card", "trim");
			
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
					  
					  $updated = $this->SettingModel->UpdateData('tbl_employee', $form, array('id'=>$id));
					  //echo var_dump($insert_c_id); exit;
					  if($updated) {
						  for($t=0; $t<=4; $t++){
			
			$class_id 						= $this->input->post('class_id'.$t); 				  
			$form_sub['class_stad'] 		= $this->input->post('class_stad'.$t); 
			$form_sub['subject'] 			= $this->input->post('subject'.$t); 
			$form_sub['collage_name'] 		= $this->input->post('collage_name'.$t); 
			$form_sub['passing_year'] 		= $this->input->post('passing_year'.$t); 
			$form_sub['division']			= $this->input->post('division'.$t);
			if($form_sub['class_stad']!=''){
			$this->SettingModel->UpdateData('tbl_employee_qualification', $form_sub, array('id'=>$class_id,'emp_id'=>$id));
			}
						  }
						  
						  for($t=0; $t<=2; $t++){
			$licence_id 					= $this->input->post('licence_id'.$t); 		  
			$form_lin['licence_type'] 		= $this->input->post('licence_type'.$t); 
			$form_lin['issued_by'] 			= $this->input->post('issued_by'.$t);
			$form_lin['regi_no'] 			= $this->input->post('regi_no'.$t);
			$form_lin['issue_date'] 		= $this->convertDatetoMysqlDate($this->input->post('issue_date'.$t));
			$form_lin['valid_upto'] 		= $this->convertDatetoMysqlDate($this->input->post('valid_upto'.$t));
			
			if($form_lin['licence_type']!=''){
			$this->SettingModel->UpdateData('tbl_employee_licence', $form_lin, array('id'=>$licence_id,'emp_id'=>$id));
			}
						  }
						  
						  for($t=0; $t<=1; $t++){
			$ref_person_id 					= $this->input->post('ref_person_id'.$t); 				  
			$form_ref['ref_person_name'] 	= $this->input->post('ref_person_name'.$t); 
			$form_ref['ref_person_add'] 	= $this->input->post('ref_person_add'.$t); 
			$form_ref['ref_person_mbile'] 	= $this->input->post('ref_person_mbile'.$t); 
			$form_ref['ref_person_known'] 	= $this->input->post('ref_person_known'.$t); 
			if($form_ref['ref_person_name']!=''){
			$this->SettingModel->UpdateData('tbl_employee_reference', $form_ref, array('id'=>$ref_person_id,'emp_id'=>$id));
			}
						  }
						  
						  $form_detail['emp_id'] 			= $id;
						  
						 // $in_id =  $this->SettingModel->InsertData('tbl_employee_official', $form_detail);
					$in_id =	$this->SettingModel->UpdateData('tbl_employee_official', $form_detail, array('emp_id'=>$id));
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$id),'tbl_employee_official','photo');
						
						
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$id),'tbl_employee_official','right_thumb');
						
						
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
							    $this->SettingModel->save_file_info($file, array('emp_id'=>$id),'tbl_employee_official','left_thumb');
						
						
					}
							}	
						  }
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
							 		redirect('branchadmin/Employee/employeeList');
						  
								}
						else {
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
							  		redirect('branchadmin/Employee/editEmp/'.$id);			
								} 
				  
			
			
		}
		
		 }
		else{
		
				redirect('web/index');	
		} 
	 }
	 
	 
	
	 public function MusterRollAttendance(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/rollattendance';
			
			$year = $this->input->post('year');
			$month = $this->input->post('month');   
			$emp_id = $this->input->post('emp_id');
			
			
			$data['empList'] = $this->CommanModel->getAllEMPDetailListWhere('tbl_employee.id,tbl_employee.emp_code, emp_name,tbl_designation.designation_name', array('tbl_employee_official.salary_type'=>'AsPerEmployee','tbl_employee_official.date_of_leave'=>NULL)); 
			
			$this->form_validation->set_rules("year", "Year", "trim|required");
			$this->form_validation->set_rules("month", "Month", "trim|required");
			$this->form_validation->set_rules("emp_id[]", "Employee", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else{
				  if ($this->input->post('submit') == "Submit") {
					  
					$vdata['title'] 	 	= 'Branchadmin | Employee';
					$vdata['content'] 		= 'branchadmin/employee/rollattendanceList';
					$vdata['monthname'] 	= $this->month[$month];
					$vdata['month_id'] 		= $month;
					$vdata['yearname'] 		= $year;		
				 	$vdata['month'] 		= $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					$vdata['empList'] 		= $this->CommanModel->getListWhereIn('id,emp_code,emp_name','tbl_employee','id', 'ASC', $emp_id);
					//echo var_dump($vdata['month']); exit;
					$this->load->view($this->layout, $vdata);
				  }
			  }
		 }
		 else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function MusterRollAttendanceList(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$value['year_v'] = $this->input->post('year_v');
			$value['month_v'] = $this->input->post('month_v');
			$locked = $this->input->post('lock');
			$ot_days = $this->input->post('ot_days');
			$NoofDays = $this->input->post('NoOfDays');
			$attendance = $this->input->post('att');
			$emp_ids = $this->input->post('emp_id');
			//echo var_dump($_POST); exit;
			foreach($emp_ids as $empid){
				
				if($empid==''){
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">Select Employee First</div>');
					redirect('branchadmin/Employee/MusterRollAttendance');
					}
				else{
					$value['emp_id'] = $empid;
					$value['ot_days'] = $ot_days[$empid];
					$value['locked_status'] = $locked[$empid];
					$att	=	$attendance[$empid];
					//echo 'ok';
						if($att[1]!=''){
						for($i=1; $i <= $NoofDays; $i++){
							if($att[$i]!=''){
								$value['day'.$i] = $att[$i];
								$checkatt[] = $att[$i];
							}
							
							
						
						}
						}
						else{
							$checkatt =1;
							}
						if($checkatt==null){
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Mark atleast one day attendance!</div>');
					redirect('branchadmin/Employee/MusterRollAttendance');
							
							}
						else{
								
								$checkIfdata = $this->CommanModel->getDataIfdataexists('id','tbl_attendance', array('emp_id'=>$value['emp_id'],'year_v'=>$value['year_v'],'month_v'=>$value['month_v']));
								//echo var_dump($value); exit;
								//echo var_dump($checkIfdata); exit;
								if($checkIfdata==null){
									//echo var_dump($value); exit;
									$value['createdby'] = $this->session->userdata('loginid');
									$value['createdon'] = date_timestamp_get(date_create());
									$insert = $this->CommanModel->InsertData('tbl_attendance', $value);
									}
								if($checkIfdata!=null){
									$value['updatedby'] = $this->session->userdata('loginid');
									$value['updatedon'] = date_timestamp_get(date_create());
									$update = $this->CommanModel->UpdateData('tbl_attendance',$value, array('id'=>$checkIfdata['id']));
									
									}
								}
						
					}
			}
			
			if($insert || $update){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Attendance saved!</div>');
					redirect('branchadmin/Employee/MusterRollAttendance');	
			}
			
			//echo var_dump($_POST); exit;
			
	
			  
		 }
		 else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function MusterRollAttendanceReport(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/rollattendanceReport';
			
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$emp_id = $this->input->post('emp_id');
			
			
			$data['empList'] = $data['empList'] = $this->CommanModel->getAllEMPDetailListWhere('tbl_employee.id,tbl_employee.emp_code, emp_name,tbl_designation.designation_name ',array('tbl_employee_official.salary_type'=>'AsPerEmployee','tbl_employee_official.date_of_leave'=>NULL));
			
			$this->form_validation->set_rules("year", "Year", "trim|required");
			$this->form_validation->set_rules("month", "Month", "trim|required");
			$this->form_validation->set_rules("emp_id[]", "Employee", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else{
				  if ($this->input->post('submit') == "Submit") {
					  
					$vdata['title'] 	 	= 'Branchadmin | Employee';
					$vdata['content'] 		= 'branchadmin/employee/rollattendanceListReport';
					$vdata['monthname'] 	= $this->month[$month];
					$vdata['month_id'] 		= $month;
					$vdata['yearname'] 		= $year;		
				 	$vdata['month'] 		= $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					$vdata['empList'] 		= $this->CommanModel->getListWhereIn('id,emp_code,emp_name','tbl_employee','id', 'ASC', $emp_id);
					//echo var_dump($vdata['month']); exit;
					$this->load->view($this->dlayout, $vdata);
				  }
			  }
		 }
		 else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function CreateLoan(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Loan';
			$data['content'] = 'branchadmin/employee/createLoan';
			
			//$year = $this->input->post('year');
			//$month = $this->input->post('month');
			//$emp_id = $this->input->post('emp_id');
			
			$data['adminList'] = $this->CommanModel->getAllEMPDetailListWhereIn('tbl_employee.id,tbl_employee.emp_code,tbl_employee.emp_name,tbl_designation.designation_name', 'tbl_designation.id', array(2,3,5,104,258,86,83));
			$data['empList'] = $this->CommanModel->getList('id,emp_code,emp_name','tbl_employee','id', 'ASC');
			$data['extradedutinmasterList'] = $this->CommanModel->getList('*','tbl_extradeduction','id', 'ASC'); 
			$data['loandetail'] = $this->CommanModel->getListWhere('*','tbl_loan_advance_details','id', 'ASC', array('branch_id'=>$this->session->userdata('branch_id'),'company_id' => $this->session->userdata('company_id')));
			$data['ClientList'] = $this->CommanModel->getList('id, client_name','tbl_client','id', 'ASC'); 
			///var_dump($data['loandetail']); exit;
			
			$loanAdvanceDetail['company_id'] 	  = $this->session->userdata('company_id');
			$loanAdvanceDetail['branch_id'] 	  = $this->session->userdata('branch_id');
			$loanAdvanceDetail['loan_type']       = $this->input->post('loan_type');
			$loanAdvanceDetail['emp_id']          = $this->input->post('emp_id');
			$loanAdvanceDetail['client_id']       = $this->input->post('client_id');
			$loanAdvanceDetail['loan_amount']     = $this->input->post('loan_amount');
			$loanAdvanceDetail['loan_approved']   = $this->input->post('loan_approved');
			$dateapp								=	explode('/', $this->input->post('date_approved'));
			$loanAdvanceDetail['year_v']    		= $dateapp[2];
			$loanAdvanceDetail['month_v']    		= $dateapp[1];
			$loanAdvanceDetail['due']   			= $this->input->post('loan_approved');
			$loanAdvanceDetail['paid']  			 = 0;
			if($loanAdvanceDetail['loan_type'] 		!= '0')
			{
			$loanAdvanceDetail['emi_amount']      = 0;
			$loanAdvanceDetail['emi_no']          = 0;
			}
			else
			{
			$loanAdvanceDetail['emi_amount']      = $this->input->post('emi_amount');
			$loanAdvanceDetail['emi_no']          = $this->input->post('emi_no'); 
			}
			$loanAdvanceDetail['date_applied']    = $this->input->post('date_applied');
			$loanAdvanceDetail['date_approved']   = $this->input->post('date_approved');
			$loanAdvanceDetail['loan_approved_by'] = $this->input->post('loan_approved_by');
			$loanAdvanceDetail['purpose_loan']     = $this->input->post('purpose_loan');
			$loanAdvanceDetail['createdon']        = date_timestamp_get(date_create());
			$loanAdvanceDetail['createdby']        = $this->session->userdata('loginid');
			$loanAdvanceDetail['status']           = 0;
			
			
			
			$this->form_validation->set_rules("loan_type", "Loan Type Must be Required", "trim|required");
			$this->form_validation->set_rules("emp_id", "Select Employee For Loan or Advance", "trim|required");
			$this->form_validation->set_rules("loan_amount", "Enter loan Amount", "trim|required");
			$this->form_validation->set_rules("loan_approved", "Enter Approved loan Amount", "trim|required");
			if($loanAdvanceDetail['loan_type'] == '0')
			{
			   $this->form_validation->set_rules("emi_amount", "Enter EMI Amount", "trim|required");
			   $this->form_validation->set_rules("emi_no", "Enter No of EMI", "trim|required");
			   
			}
			$this->form_validation->set_rules("date_applied", "Enter Applied Date of Loan/Advance", "trim|required");
			$this->form_validation->set_rules("date_approved", "Enter Approved Date of Loan/Advance", "trim|required");
			$this->form_validation->set_rules("loan_approved_by", "Loan/Advance  Approved By", "trim|required");
			$this->form_validation->set_rules("purpose_loan", "Enter Purpose of Loan/Advance", "trim|required");
		    $this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	        
			  
			  if ($this->form_validation->run() == FALSE)
			  {
				  $this->load->view($this->layout, $data);
			  }
			  else
			  {
				  if ($this->input->post('submit') == "Submit")
				  {
					 // if($loanAdvanceDetail['month_v']
					//echo var_dump($loanAdvanceDetail); exit;
					 $checkdata = $this->SettingModel->getData('tbl_loan_advance_details', array('loan_type'=>$loanAdvanceDetail['loan_type'],
					 'emp_id'=>$loanAdvanceDetail['emp_id'],'year_v'=>$loanAdvanceDetail['year_v'],'month_v'=>$loanAdvanceDetail['month_v']));
					  if($checkdata==NULL){
						$checkdataifloan = $this->SettingModel->getData('tbl_loan_advance_details', array('loan_type'=>$loanAdvanceDetail['loan_type'],
					 'emp_id'=>$loanAdvanceDetail['emp_id'],'status'=>'0')); 
					  if($checkdataifloan==NULL){
					 $tbl_id = $this->CommanModel->InsertData('tbl_loan_advance_details',$loanAdvanceDetail);
					 if($tbl_id){
					 if($loanAdvanceDetail['loan_type'] == '0')
					 {
						    $loanDetail['emp_id'] = $this->input->post('emp_id');
							$loanDetail['emi_amount'] = $this->input->post('emi_amount');
							$loanDetail['row_id'] = $tbl_id;
							$loanDetail['createdon'] = date_timestamp_get(date_create());
							$loanDetail['emi_status']    = 0;
						    $loanDetail['year_v']    = $loanAdvanceDetail['year_v'];
							$loanDetail['month_v']    = $loanAdvanceDetail['month_v'];
							$mono = 0;
						    for($i=1;$i<=$loanAdvanceDetail['emi_no'];$i++)
							{
								$loanDetail['no_of_emi'] = $i;
								$this->CommanModel->InsertData('tbl_loan_details',$loanDetail);
								$mono++;
							}
					 }
					 
					 $this->session->set_flashdata('msg', '<div class="alert alert-success">Successfull </div>');
					 redirect('branchadmin/Employee/CreateLoan');
					 }
					  }
					  else{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Second Loan not allowed for this Employee</div>');
					  redirect('branchadmin/Employee/CreateLoan');  
					  }
					  }
					  else{
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Data already exist!</div>');
					  redirect('branchadmin/Employee/CreateLoan');
					  }
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Error...Something Went Worng Please Check...</div>');
					  redirect('branchadmin/Employee/CreateLoan');
				  }
			  }
		 }
		 else
		 {
		
				redirect('web/index');	
		} 
	 }
	 
	 public function editLoan($id)
	 {
		if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
		{
		$data['title'] 	 = 'Edit Loan/Advance';
		$data['content'] = 'branchadmin/employee/editLoan';
		$data['adminList'] = $this->CommanModel->getAllEMPDetailListWhereIn('tbl_employee.id,tbl_employee.emp_code,tbl_employee.emp_name,tbl_designation.designation_name', 'tbl_designation.id', array(2,3,5,104,258,86,83));
		$data['empList'] = $this->CommanModel->getList('id,emp_code,emp_name','tbl_employee','id', 'ASC'); 
		$data['loanList'] = $this->CommanModel->getDataIfdataexists('*','tbl_loan_advance_details',array('id'=>$id));
		$data['loandetail'] = $this->CommanModel->getList('*','tbl_loan_advance_details','id', 'ASC'); 
		$data['extradedutinmasterList'] = $this->CommanModel->getList('*','tbl_extradeduction','id', 'ASC'); 
		$data['ClientList'] = $this->CommanModel->getList('id, client_name','tbl_client','id', 'ASC'); 
		//var_dump($data['loanList']); exit;
		     if ($this->input->post('submit') == "Update")
			 {
				$loanAdvanceDetail['loan_type'] = $this->input->post('loan_type');
				$loanAdvanceDetail['emp_id'] = $this->input->post('emp_id');
				$loanAdvanceDetail['client_id']       = $this->input->post('client_id');
				$loanAdvanceDetail['loan_amount'] = $this->input->post('loan_amount');
				$loanAdvanceDetail['loan_approved'] = $this->input->post('loan_approved');
				$loanAdvanceDetail['date_applied'] = $this->input->post('date_applied');
				$loanAdvanceDetail['date_approved'] = $this->input->post('date_approved');
				$dateapp								=	explode('/', $this->input->post('date_approved'));
				$loanAdvanceDetail['year_v']    		= $dateapp[2];
				$loanAdvanceDetail['month_v']    		= $dateapp[1];
				$loanAdvanceDetail['loan_approved_by'] = $this->input->post('loan_approved_by');
				$loanAdvanceDetail['purpose_loan'] = $this->input->post('purpose_loan');
				$loanAdvanceDetail['createdon'] = date_timestamp_get(date_create());
			
			
			
			
				$this->form_validation->set_rules("loan_type", "Loan Type Must be Required", "trim|required");
				$this->form_validation->set_rules("emp_id", "Select Employee For Loan or Advance", "trim|required");
				$this->form_validation->set_rules("loan_amount", "Enter loan Amount", "trim|required");
				$this->form_validation->set_rules("loan_approved", "Enter Approved loan Amount", "trim|required");
				
				$this->form_validation->set_rules("date_applied", "Enter Applied Date of Loan/Advance", "trim|required");
				$this->form_validation->set_rules("date_approved", "Enter Approved Date of Loan/Advance", "trim|required");
				$this->form_validation->set_rules("loan_approved_by", "Loan/Advance  Approved By", "trim|required");
				$this->form_validation->set_rules("purpose_loan", "Enter Purpose of Loan/Advance", "trim|required");
				
				$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
				$this->form_validation->set_message('required', '%s is required!');
		    
				   if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->layout, $data);
					}
					else
				    {	
						//var_dump($_POST); exit;
						$cserviceid = $this->CommanModel->Ifdataexists('id','tbl_loan_advance_details',array('id'=>$this->input->post('txthide')));
						if($cserviceid)
						{
							
								$this->CommanModel->UpdateData('tbl_loan_advance_details',$loanAdvanceDetail, array('id'=>$this->input->post('txthide')));
								if($loanAdvanceDetail['loan_type'] == '0')
					            {
									    $loanDetail['emp_id'] = $this->input->post('emp_id');
										$loanDetail['emi_amount'] = $this->input->post('emi_amount');
										$loanDetail['row_id'] = $tbl_id;
										$loanDetail['updatedon'] = date_timestamp_get(date_create());
										$loanDetail['year']    = date('Y');
										$mono = 0;
										for($i=1;$i<=$loanAdvanceDetail['emi_no'];$i++)
										{
											$loanDetail['no_of_emi'] = $i;
											$this->CommanModel->UpdateData('tbl_loan_details',$loanDetail,array('id'=>$this->input->post('txthide')));
											$mono++;
										}
								}
								$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated...</div>'); 
								redirect('branchadmin/Employee/CreateLoan');
							     
							
							
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-warning">Record Not Updated...</div>');
							redirect('branchadmin/Employee/CreateLoan');
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
	
	
	public function CreateExtraDeduction(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Loan';
			$data['content'] = 'branchadmin/employee/createExtraDeduction';
			
			//$year = $this->input->post('year');
			//$month = $this->input->post('month');
			//$emp_id = $this->input->post('emp_id');
			
			
			$data['empList'] = $this->CommanModel->getList('id,emp_code,emp_name','tbl_employee','id', 'ASC'); 
			$data['extradedutinmasterList'] = $this->CommanModel->getList('*','tbl_extradeduction','id', 'ASC');
			$data['loandetail'] = $this->CommanModel->getList('*','tbl_loan_advance_details','id', 'ASC');
			
			
			//$this->form_validation->set_rules("month", "Month", "trim|required");
			//$this->form_validation->set_rules("emp_id[]", "Employee", "trim|required");
			$loanAdvanceDetail['company_id'] 	  = $this->session->userdata('company_id');
			$loanAdvanceDetail['branch_id'] 	  = $this->session->userdata('branch_id');
			$loanAdvanceDetail['loan_type']       = $this->input->post('loan_type');
			$loanAdvanceDetail['emp_id']          = $this->input->post('emp_id');
			
			$loanAdvanceDetail['loan_amount']     = $this->input->post('loan_amount');
			$loanAdvanceDetail['loan_approved']   = $this->input->post('loan_approved');
			$loanAdvanceDetail['due']  			  = $this->input->post('loan_approved');
			$loanAdvanceDetail['paid']   = '0.00';
			$loanAdvanceDetail['year_v']    = date('Y');
			$loanAdvanceDetail['month_v']    = date('m');
			if($loanAdvanceDetail['loan_type'] == 'Advance')
			{
			$loanAdvanceDetail['emi_amount']      = 0;
			$loanAdvanceDetail['emi_no']          = 0;
			}
			else
			{
			$loanAdvanceDetail['emi_amount']      = $this->input->post('emi_amount');
			$loanAdvanceDetail['emi_no']          = $this->input->post('emi_no'); 
			}
			$loanAdvanceDetail['emi_start_month'] = $this->input->post('emi_start_month');
			$loanAdvanceDetail['date_applied']    = $this->input->post('date_applied');
			$loanAdvanceDetail['date_approved']   = $this->input->post('date_approved');
			$loanAdvanceDetail['loan_approved_by'] = $this->input->post('loan_approved_by');
			$loanAdvanceDetail['purpose_loan']     = $this->input->post('purpose_loan');
			$loanAdvanceDetail['createdon']        = date_timestamp_get(date_create());
			$loanAdvanceDetail['createdby']        = $this->session->userdata('loginid');
			$loanAdvanceDetail['status']           = 0;
			
			
			
			$this->form_validation->set_rules("loan_type", "Loan Type Must be Required", "trim|required");
			$this->form_validation->set_rules("emp_id", "Select Employee For Loan or Advance", "trim|required");
			$this->form_validation->set_rules("loan_amount", "Enter loan Amount", "trim|required");
			$this->form_validation->set_rules("loan_approved", "Enter Approved loan Amount", "trim|required");
			if($loanAdvanceDetail['loan_type'] == 'Loan')
			{
			   $this->form_validation->set_rules("emi_amount", "Enter EMI Amount", "trim|required");
			   $this->form_validation->set_rules("emi_no", "Enter No of EMI", "trim|required");
			   
			}
			$this->form_validation->set_rules("emi_start_month", "Enter Month of EMI Start", "trim|required");
			$this->form_validation->set_rules("date_applied", "Enter Applied Date of Loan/Advance", "trim|required");
			$this->form_validation->set_rules("date_approved", "Enter Approved Date of Loan/Advance", "trim|required");
			$this->form_validation->set_rules("loan_approved_by", "Loan/Advance  Approved By", "trim|required");
			$this->form_validation->set_rules("purpose_loan", "Enter Purpose of Loan/Advance", "trim|required");
		    $this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	        
			  
			  if ($this->form_validation->run() == FALSE)
			  {
				  $this->load->view($this->layout, $data);
			  }
			  else
			  {
				  if ($this->input->post('submit') == "Submit")
				  {
					 // if($loanAdvanceDetail['month_v']
					 // echo var_dump($_POST); exit;
					 $tbl_id = $this->CommanModel->InsertData('tbl_loan_advance_details',$loanAdvanceDetail);
					 if($loanAdvanceDetail['loan_type'] == 'Loan')
					 {
						    $loanDetail['emp_id'] = $this->input->post('emp_id');
							$loanDetail['emi_amount'] = $this->input->post('emi_amount');
							$loanDetail['row_id'] = $tbl_id;
							$loanDetail['createdon'] = date_timestamp_get(date_create());
							$loanDetail['emi_status']    = 0;
						    $loanDetail['year_v']    = date('Y');
							$loanDetail['month_v']    = date('m');
							$mono = 0;
						    for($i=1;$i<=$loanAdvanceDetail['emi_no'];$i++)
							{
								$loanDetail['no_of_emi'] = $i;
								$loanDetail['emi_start_month'] = $date+$mono;
								$this->CommanModel->InsertData('tbl_loan_details',$loanDetail);
								$mono++;
							}
					 }
					 $this->session->set_flashdata('msg', '<div class="alert alert-success">Successfull </div>');
					 redirect('branchadmin/Employee/CreateLoan');
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Error...Something Went Worng Please Check...</div>');
					  redirect('branchadmin/Employee/CreateLoan');
				  }
			  }
		 }
		 else
		 {
		
				redirect('web/index');	
		} 
	 }
	 
	 
	 public function employeeList(){
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/listview';
			
			
			//$data['empList'] = $this->CommanModel->getList('*','tbl_employee','id', 'ASC'); 
			$data['empList'] = $this->CommanModel->getAllEMPDetailList('tbl_employee.*,tbl_employee_official.*'); 
			
			$this->load->view($this->dlayout, $data);
		 }
		 else{
		
				redirect('web/index');	
		} 
	 }
	
	 public function editemi($id)
	 {
		$data['title'] 	            = 'Edit EMI Detail';
		$data['content']            = 'branchadmin/employee/editemidetail'; 
		$data['emidetail']          =  $this->CommanModel->getListWhere('*','tbl_loan_details','id','ASC',array('row_id'=>$id));
		$data['row']          =     $this->CommanModel->getDataIfdataexists('row_id','tbl_loan_details',array('row_id'=>$id));
		$this->load->view($this->layout,$data);
	 } 
	 
	 public function editEmiDetail($id)
	 {
		 if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
		 {
			$data['title'] 	            = 'Edit EMI Detail';
			$data['content']            = 'branchadmin/employee/editInstallmentDetail'; 
			$data['emidetail']          =  $this->CommanModel->getListWhere('*','tbl_loan_details','id','ASC',array('id'=>$id));
			if ($this->input->post('submit') == "Update")
			{
				$loanDetail['no_of_emi'] = $this->input->post('emi_no');
				$loanDetail['emi_amount'] = $this->input->post('emi_amount');
				$loanDetail['emi_start_month'] = $this->input->post('emi_start_month');
				$this->CommanModel->UpdateData('tbl_loan_details',$loanDetail,array('id'=>$this->input->post('txthide')));
				$this->session->set_flashdata('msg', '<div class="alert alert-warning">Record Updated...</div>');
				redirect('branchadmin/Employee/editemi/'.$data['emidetail'][0]['row_id']);
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
	 
	 public function deleteEmiDetail($id)
	 {
		$id = $this->CommanModel->deleteRow('tbl_loan_details',$id);
		if($id)
		{
			//$row_id = $this->input->post('hidetxt1');
			$this->session->set_flashdata('msg', '<div class="alert alert-warning">Record Deleted...</div>');
			redirect('branchadmin/Employee/editemi'.$this->input->post('hidetxt1'));
		}
	 }
	
	 
	 
	
	
	public function generateClientBasedSalary(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/generateClientBasedSalary';
			
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$emp_id = $this->input->post('emp_id');
			$client_id = $this->input->post('client_id');
			 
			
			
			$data['ClientList'] = $this->CommanModel->getListWhere('id,client_name','tbl_client','id', 'ASC', array('branch_id'=>$this->session->userdata('branch_id'),'company_id'=>$this->session->userdata('company_id'))); 

			
			$this->form_validation->set_rules("year", "Year", "trim|required");
			$this->form_validation->set_rules("month", "Month", "trim|required");
			$this->form_validation->set_rules("emp_id", "Employee", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else{
				  if ($this->input->post('submit') == "Submit") {
					  
					  if($emp_id != '-1'){
					  $attandanceData = $this->CommanModel->getDataIfdataexists('*', 'tbl_attendance', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $monthdetail = $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					  $getempPData = $this->CommanModel->getDataIfdataexists('id,emp_code,emp_name', 'tbl_employee', array('id'=>$emp_id));
					  $getempData = $this->CommanModel->getDataIfdataexists('*', 'tbl_employee_official', array('emp_id'=>$emp_id));
					  $checksalarydata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  
					  $NoofDaysInmonth = $monthdetail['NoOfDays'];
					  $startmotnthdate = $year.'-'.$month.'-'. 01;
					  $endmotnthdate = $year.'-'.$month.'-'. $NoofDaysInmonth;
					  ///exit;
					  //echo var_dump($monthdetail); exit;
					  $getshiftdata = $this->CommanModel->getListWhere('*', 'tbl_shift_emp', 'id', 'ASC', array('emp_id'=>$emp_id, 'year_v'=>$year, 'month_v'=>$month)); 
					  $getsalarySt = $this->CommanModel->getDataIfdataexists('*', 'tbl_gradebase_salary', array('grade_id'=>$getempData['grade'],
					  'department_id'=>$getempData['department'],'designation_id'=>$getempData['designation'],'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					 // var_dump($getshiftdata);
					 // var_dump($getsalarySt);
					  if($attandanceData==null){
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Mark Attandance first from this month or Employee!</div>');
							redirect('branchadmin/Employee/generateClientBasedSalary');	
						  }
						if($attandanceData['locked_status']=='0'){
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Lock Attandance first from this month or Employee!</div>');
							redirect('branchadmin/Employee/generateClientBasedSalary');
							
							}
						else{
									if((strtotime($startmotnthdate) <= strtotime($getempData['doj'])) && (strtotime($getempData['doj']) <= strtotime($endmotnthdate))){
									$JoinInThisMOnth = true;	
									}
									else{
										$JoinInThisMOnth = false;
										for($i=1; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
										}
									}
									
									foreach($getshiftdata as $shift){
										$shiftid = $shift['id'];
										$clientid = $shift['client_id'];
										$serviceid = $shift['service_id'];
										$subserviceid = $shift['subservice_id'];
										$APW = explode(',', $shift['APW']);
										$days = $shift['days'];
										$days = explode(',', $days);
										
										for($i=0; $i< count($days); $i++){
											$dy = explode('-', $days[$i]);
											$finaldays[$dy[0]]=$dy[1];	
										}
										if($JoinInThisMOnth == true){
										$joindate = explode('-', $getempData['doj']);
										///echo var_dump($finaldays); exit;
										$p=''; $w='';$a=''; 
									for($i=(int)$joindate[2]; $i <=$NoofDaysInmonth; $i++){
										
										if($finaldays[$i]!=''){
											
											if($finaldays[$i]=='P'){ $p[]=$finaldays[$i];}
											if($finaldays[$i]=='W'){ $w[]=$finaldays[$i];}
											if($finaldays[$i]=='A'){ $a[]=$finaldays[$i];}
											
										}
										
										
									
										}
										if($p!=''){
										$totalPresent = count($p);
										}
										if($w!=''){
										$totalweekof = count($w);
										}
										if($a!=''){
										$totalabsend = count($a);
										}
										
										}
										else{
											$pp = explode('-', $APW[0]);
											$aa = explode('-', $APW[1]);
											$ww = explode('-', $APW[2]);
										$totalPresent = $pp[1];
										$totalweekof = $ww[1];
										$totalabsend = $aa[1];
										}
										///echo var_dump($totalPresent); exit;
										
										$ot = explode('-', $APW[3]);
										$totalot = $ot[1];
										$FinalEmpDetail='';
										$FinalEmpDetail['year_v'] = $year;
					 					$FinalEmpDetail['month_v'] = $month;
										$FinalEmpDetail['salary_type'] = 1;
										$FinalEmpDetail['shiftid'] = $shift['id'];
										$FinalEmpDetail['clientid'] = $shift['client_id'];
										$FinalEmpDetail['serviceid'] = $shift['service_id'];
										$FinalEmpDetail['subserviceid'] = $shift['subservice_id'];
										$FinalEmpDetail['APW'] = $shift['APW'];
					  					$FinalEmpDetail['emp_code'] = $getempPData['emp_code'];
					  					$FinalEmpDetail['emp_id'] = $emp_id;
					  					$FinalEmpDetail['PresentDay'] = (int)$totalPresent;
					  					$FinalEmpDetail['WeekOffDay'] = (int)$totalweekof;
					  					$FinalEmpDetail['AbsentDay'] = (int)$totalabsend;
					  					$FinalEmpDetail['OTDay'] = (float)$totalot;
									$getmappdata='';	
										$getmappdata = $this->CommanModel->getDataIfdataexists('*', 'tbl_client_service_mapping', array('client_id'=>$clientid,
					  'service_id'=>$serviceid,'subservice_id'=>$subserviceid,'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					 
					 
					  
					  if($getsalarySt==null){
						  	$this->session->set_flashdata('msg', '<div class="alert alert-danger">Can Not Find Any Salary Stracture for This Grade/Department/Designation!</div>');
							redirect('branchadmin/Employee/generateClientBasedSalary');
						  }
						  if($getmappdata==null){
						  	$this->session->set_flashdata('msg', '<div class="alert alert-danger">Can Not Find Any Salary Stracture for This Client/Service/Subserver!</div>');
							redirect('branchadmin/Employee/generateClientBasedSalary');
						  }
						  $allowance = '';
						  if($getmappdata!='' && $getsalarySt!=''){
							  $allowance = $getmappdata['allowance'];
							  $getbasisc ='';
							  $getbasisc =  explode(',', $allowance);
							  $totalall = 0;
							  for($i=0; $i< count($getbasisc); $i++){
								  $r = explode('-', $getbasisc[$i]);
								  $totalall +=  $r[1];
							  }
							  
							  $deduction = $getsalarySt['deduction_id'];
							$NoofDaysInmonth = $monthdetail['NoOfDays'];
						 if($getmappdata['bill_cycle']=='1'){
						  	  $FinalEmpDetail['BasicSalary'] = (float)$getmappdata['employee_rate'] - $totalall;
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
						  }
						  if($getmappdata['bill_cycle']=='3'){
							  $NoofDaysInmonth = (int)$getmappdata['bill_cycle_num'];
						  	  $FinalEmpDetail['BasicSalary'] = (float)$getmappdata['employee_rate'] - $totalall;
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
							 
						  }
						  if($getmappdata['bill_cycle']=='2'){
						  	$FinalEmpDetail['BasicSalary'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['PresentDay']);
							$FinalEmpDetail['PayableBasicSalary'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['PresentDay']);
						  }
							  
							 
								
								
									$CurrentAllowance=''; $PayableAllowance='';$totalallwance=''; $totalallwancepayable=''; $allwance='';$income='';
								if(!empty($allowance)){
									
									$allowance = explode(',',$allowance);
								  for($i=0; $i < count($allowance); $i++){
									  $income = explode('-', $allowance[$i]);
									  $getalltype = $this->CommanModel->getDataIfdataexists('mode_of_payment', 'tbl_allowance', array('id'=>$income[0]));
									  if($getalltype['mode_of_payment']=='1'){
										  $totalallwance += (float)$income[1];
										  $totalallwancepayable += (float)$income[1];
										  $CurrentAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										  $PayableAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 }
										 if($getalltype['mode_of_payment']=='0'){
   										  
										  if($getmappdata['bill_cycle']=='2'){
											  $totalallwance += round($income[1] * $FinalEmpDetail['PresentDay']);
						  						 $allwance = round($income[1] * $FinalEmpDetail['PresentDay']);
						  					}
											else{
												$totalallwance += (float)$income[1];
												 $allwance = round($income[1] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
												}
										 
										  $totalallwancepayable += $allwance;
										  $CurrentAllowance[] = $income[0].':'.$income[1].':'.$getalltype['mode_of_payment'];
										  $PayableAllowance[] = $income[0].':'.$allwance.':'.$getalltype['mode_of_payment'];
										 }
										 
										 
								  }
								  $FinalEmpDetail['CurrentAllowance'] = implode(',', $CurrentAllowance);
								 $FinalEmpDetail['PayableAllowance'] = implode(',', $PayableAllowance);
								 $FinalEmpDetail['TotalAllowance'] = $totalallwancepayable;
								  }
								  else{
								$FinalEmpDetail['CurrentAllowance'] = '';
								 $FinalEmpDetail['PayableAllowance'] = '';
								 $FinalEmpDetail['TotalAllowance'] = 0;
								  }
								
								  
								  $FinalEmpDetail['GrossSalary'] = $FinalEmpDetail['BasicSalary'] + $totalallwance; 
								  
							 if($FinalEmpDetail['OTDay']!=0){
								  if($getmappdata['bill_cycle']=='2'){
									  $FinalEmpDetail['OTDayAmount'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['OTDay']);
									  }
								  else{
									  
									  $FinalEmpDetail['OTDayAmount'] = round($FinalEmpDetail['GrossSalary'] / $NoofDaysInmonth * $FinalEmpDetail['OTDay']);
								  }
									  
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'] + $FinalEmpDetail['OTDayAmount'];
								  }
								  else{
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'];
								  }	  
							  if($deduction!=null){
								  $CurrentDeduction=''; $ApplyDeduction=''; 
								  $deduction = explode(',',$deduction);
								  $getdeduction = $this->CommanModel->getListWhereIn('*', 'tbl_deduction_head', 'id', 'ASC', $deduction);
								  for($i=0; $i < count($getdeduction); $i++){
									  if($getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
									  
									  if($getdeduction[$i]['type_of_deduction']==='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
													else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$calculateddeduction1 = ceil($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = ceil($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = ceil($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = ceil($AllwancedeductonGross * $seconddeduction / 100);
														}else{
															$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
														}
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['PayableBasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
									  }
									  
									  if($getdeduction[$i]['type_of_deduction']==='Temperary'){
										  $todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
														if($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
														
														if($FinalEmpDetail['BasicSalary'] >= $getdeduction[$i]['max_salary_limit']){
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
														$FinalEmpDetail['BasicSalary'] = $getdeduction[$i]['max_salary_limit'];
														}else{
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];	
														}
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													
													$totald = $calculateddeduction1;
													}
													}
													else{
														$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['PayableBasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											}
									  }
									  
								  }
								  }
								  }
							  }
							  $FinalEmpDetail['CurrentDeduction'] = implode(',', $CurrentDeduction);
							  $FinalEmpDetail['ApplyDeduction'] = implode(',', $ApplyDeduction);
							  $FinalEmpDetail['TotalDeductionEP'] = 0;
							$FinalEmpDetail['TotalDeductionER'] = 0;
							  foreach($ApplyDeduction as $dedkey=>$deduva){
								  $fd = explode(':', $deduva);
								  //echo var_dump((float)$fd[2]);
								  $FinalEmpDetail['TotalDeductionEP'] += (float)$fd[2];
								  
									$FinalEmpDetail['TotalDeductionER'] += (float)$fd[3];
								  
								  }
							  $FinalEmpDetail['NetSalary'] = $FinalEmpDetail['PayableGrossSalary'] - $FinalEmpDetail['TotalDeductionEP'];	  
							  for($i=0; $i < count($getdeduction); $i++){
								
									 if($getdeduction[$i]['deduction_applied_on']=='-3'){ 
									 if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}

													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
											}
									 }
									 else{
										 $FinalEmpDetail['DeductionOnNetSalary'] ='';
										 $FinalEmpDetail['DeductionAmountOnNetSalary']='0.00';
										 $FinalEmpDetail['FinalNetSalary'] ='0.00';
									 }
									if($FinalEmpDetail['FinalNetSalary']=='0.00'){
										$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['NetSalary'];
										}
										else{
											$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['FinalNetSalary'];
											}
											///echo var_dump($getdeduction[$i]['deduction_applied_on']); exit;
									if($getdeduction[$i]['deduction_applied_on']=='-4'){
									  if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
												
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
											}
											}
										
									  }
									else{
										$FinalEmpDetail['DeductionOnTakeHomeSalary'] ='';
										$FinalEmpDetail['DeductionAmountOnTakeHomeSalary']='0.00';
										$FinalEmpDetail['FinalTakeHomeSalary'] = '';
									}
									  if($FinalEmpDetail['FinalTakeHomeSalary']==''){
										  $FinalEmpDetail['FinalTakeHomeSalary'] = $FinalEmpDetail['TakeHomeSalary'];
									  }
									  
									  
							  }
							  
							$FinalEmpDetail['CTC'] = $FinalEmpDetail['NetSalary'] + $FinalEmpDetail['TotalDeductionER'];
							
							
							 $updateAdvance=''; $ExtraDeductionTrans=''; $FinalExtraDeduction='';
							
							  if($checksalarydata['id']==''){
								 
								$extradeductionList = $this->CommanModel->getListWhere('*', 'tbl_loan_advance_details', 'id', 'ASC', array('emp_id'=>$emp_id,'status'=> 0, 'year_v <='=>$year,'month_v <='=>$month, 'client_id'=>$clientid, 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
							  	
								if(!empty($extradeductionList)){
									$isLoanAdvance = true;
									for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 if((float)$checkloanAdvance['due'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['due'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = 0;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$checkloanAdvance['due'];
											  $NetSalary = $NetSalary - (float)$checkloanAdvance['due'];
											  $TotalExtraDeduction +=  (float)$checkloanAdvance['due'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1; 
												  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
												  if($checkloanAdvance['month_v'] == '12'){
												  $updateAdvance[$i]['month_v'] = $checkloanAdvance['month_v'] ;
												  $updateAdvance[$i]['year_v'] = (int)$checkloanAdvance['year_v'] + 1;
												  }
												  else{
													  $updateAdvance[$i]['month_v'] = (int)$checkloanAdvance['month_v'] + 1;
												  }
											  }
											 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 elseif((float)$checkloanAdvance['due'] > $NetSalary && $NetSalary!=0){
											// echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.$NetSalary;
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = (float)$checkloanAdvance['due'] - $NetSalary;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + $NetSalary;
											  
											  $TotalExtraDeduction +=  $NetSalary;
											  $NetSalary = 0;
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $NetSalary;
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
												  
									 }
									
									 if($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$emidetail = $this->CommanModel->getListWhereLimit('*', 'tbl_loan_details', 'id', 'ASC', array('row_id'=>$checkloanAdvance['id'], 'emi_status'=>'0'), 1);
							  			}
										$EMISTATUS = true;
										 if((float)$emidetail[0]['emi_amount'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											 
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$emidetail[0]['id'].':'.$emidetail[0]['emi_amount'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  if($checkloanAdvance['emi_no'] != $emidetail[0]['no_of_emi']){
											  $updateAdvance[$i]['due'] = $checkloanAdvance['due'] - $emidetail[0]['emi_amount'];
											  }
											  elseif($checkloanAdvance['emi_no'] == $emidetail[0]['no_of_emi']){
												 $updateAdvance[$i]['due'] = 0; 
											  }
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$emidetail[0]['emi_amount'];
											  $NetSalary = $NetSalary - (float)$emidetail[0]['emi_amount'];
											  $TotalExtraDeduction +=  (float)$emidetail[0]['emi_amount'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											 $updateemiId = $emidetail[0]['id'];
											 $updat_emi_status['emi_status'] = 1; 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['emi_id'] = $emidetail[0]['id'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 
												  
									 }
									
									}
									
									
								}
							  
							  }
							  elseif($checksalarydata['id']!=''){
								$extradeductionList = $this->CommanModel->getListWhere('id,extradeduction_id,loan_type,emp_id,loan_approved,due,paid,emi_id', 'tbl_extradeduction_trans', 'id', 'ASC', array('emp_id'=>$emp_id, 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'), 'client_id'=>$clientid, 'payable_id'=>$checksalarydata['id']));  
							  	for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['paid'];
										 $TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
									 }
									 elseif($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$checkloanAdvance['emi_id'].':'.(float)$checkloanAdvance['paid'];
										$TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
										}
										
									 }
									 
								}
							  }
							  
							  	
							
							  $FinalEmpDetail['ExtraDeduction'] = implode(',', $FinalExtraDeduction);
							  if(!empty($TotalExtraDeduction)){
							  $FinalEmpDetail['TotalExtraDeduction'] = $TotalExtraDeduction;
							  }
							  else{
								  $FinalEmpDetail['TotalExtraDeduction'] = '0.00';
							  }
							  if( $NetSalary == 0){
								  $FinalEmpDetail['NetSalary'] = 0;
							  }else{
							 $FinalEmpDetail['NetSalary'] = $finaldata['PayableGrossSalary'] - ($finaldata['TotalDeductionEP'] + $TotalExtraDeduction);
							  }
							
							
							$FINAL[] =$FinalEmpDetail;
									
								}
							//var_dump($FINAL); exit;
							$cpablearray =''; $pablearray=''; $ccudeduction=''; $appdeduction='';
							
							 for($i=0; $i < count($FINAL); $i++){
								 $finaldata['year_v'] 								= 	$FINAL[0]['year_v']; 
								 $finaldata['month_v'] 								= 	$FINAL[0]['month_v'];
								 $finaldata['salary_type'] 							= 	$FINAL[0]['salary_type'];
								 $finaldata['emp_code'] 							= 	$FINAL[0]['emp_code'];
								 $finaldata['emp_id'] 								= 	$FINAL[0]['emp_id'];
								 $finaldata['PresentDay'] 							+= 	$FINAL[$i]['PresentDay'];
								 $finaldata['WeekOffDay'] 							+= 	$FINAL[$i]['WeekOffDay'];
								 $finaldata['AbsentDay'] 							+= 	$FINAL[$i]['AbsentDay'];
								 $finaldata['OTDay'] 								+= 	$FINAL[$i]['OTDay'];
								 $finaldata['OTDayAmount'] 							+= 	$FINAL[$i]['OTDayAmount'];
								 
								 $finaldata['PayableBasicSalary'] 					+= 	$FINAL[$i]['PayableBasicSalary'];
								 
								 $cpablearray[]  									= 	$FINAL[$i]['CurrentAllowance'];
								 
								 $pablearray[]									    = 	$FINAL[$i]['PayableAllowance'];
								 
								 $finaldata['BasicSalary'] 							+= 	$FINAL[$i]['BasicSalary'];
								 $finaldata['TotalAllowance'] 						+= 	$FINAL[$i]['TotalAllowance'];
								 $finaldata['GrossSalary'] 							+= 	$FINAL[$i]['GrossSalary'];
								 $finaldata['PayableGrossSalary'] 					+= 	$FINAL[$i]['PayableGrossSalary'];
								 
								 $ccudeduction[]  									= 	$FINAL[$i]['CurrentDeduction'];
								 $appdeduction[]  									= 	$FINAL[$i]['ApplyDeduction'];
								 
								 $finaldata['TotalDeductionEP'] 					+= 	$FINAL[$i]['TotalDeductionEP'];
								 $finaldata['TotalDeductionER'] 					+= 	$FINAL[$i]['TotalDeductionER'];
								 $finaldata['DeductionOnNetSalary'] 				+= 	$FINAL[$i]['DeductionOnNetSalary'];
								 $finaldata['DeductionAmountOnNetSalary'] 			+= 	$FINAL[$i]['DeductionAmountOnNetSalary'];
								 $finaldata['DeductionAmountOnNetSalary'] 			+= 	$FINAL[$i]['DeductionAmountOnNetSalary'];
								 $finaldata['FinalNetSalary'] 						+= 	$FINAL[$i]['FinalNetSalary'];
								 $finaldata['TakeHomeSalary'] 						+=	$FINAL[$i]['TakeHomeSalary'];
								 $finaldata['DeductionOnTakeHomeSalary'] 			+= 	$FINAL[$i]['DeductionOnTakeHomeSalary'];
								 $finaldata['DeductionAmountOnTakeHomeSalary'] 		+=  $FINAL[$i]['DeductionAmountOnTakeHomeSalary'];
								 $finaldata['FinalTakeHomeSalary'] 					+=  $FINAL[$i]['FinalTakeHomeSalary'];
								 $finaldata['CTC'] 									+=  $FINAL[$i]['CTC'];
      												
    
							 }
$allowanceList = $this->CommanModel->getListWhere('id','tbl_allowance','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));

$deductionList = $this->CommanModel->getListWhere('id','tbl_deduction_head','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));	
							
							$FINALCURRENTDEDUCRION=''; $deduction=''; 
							for($i=0; $i< count($ccudeduction); $i++){
								$deduction = $ccudeduction[$i];
								$deduction = explode(',', $deduction);
								//$fefp =''; $fepf=''; $efp=''; $efs='';$dedu='';
								for($j=0; $j < count($deduction); $j++){
									$dedu = explode(':', $deduction[$j]);
									foreach($deductionList as $d){
										if($dedu[0]== $d['id']){
											
											$efp = explode('@', $dedu[2]);
											$fefp[$j] += $efp[0];
											$efs = explode('@', $dedu[3]);
											$fepf[$j] += $efs[0];
											
										$FINALCURRENTDEDUCRION[$j] = $dedu[0].':'.$dedu[1].':'.$fefp[$j].'@'.$efp[1].':'.$fepf[$j].'@'.$efs[1].':'.$dedu[4].':'.$dedu[5];	
										}
									 }
								}
								
								
							}
							$adeduction=''; $FINALAPPLYDEDUCRION='';
							for($i=0; $i< count($appdeduction); $i++){
								
								$adeduction = $appdeduction[$i];
								$adeduction = explode(',', $adeduction);
								//$dedu =''; $efp=''; $cfefp=''; $efs=''; $cfepf='';
								for($j=0; $j < count($adeduction); $j++){
									$dedu = explode(':', $adeduction[$j]);
									foreach($deductionList as $d){
										if($dedu[0]== $d['id']){
											
											$efp = explode('@', $dedu[2]);
											$cfefp[$j] += $efp[0];
											$efs = explode('@', $dedu[3]);
											$cfepf[$j] += $efs[0];
											
										$FINALAPPLYDEDUCRION[$j] = $dedu[0].':'.$dedu[1].':'.$cfefp[$j].'@'.$efp[1].':'.$cfepf[$j].'@'.$efs[1].':'.$dedu[4].':'.$dedu[5];	
										}
									 }
								}
								
								
							}
							$callowance = '';$CURRENTALLOWANCE='';
							for($i=0; $i< count($cpablearray); $i++){
								$callowance = $cpablearray[$i];
								$callowance = explode(',', $callowance);
								//$allow =''; $amount='';
								for($j=0; $j < count($callowance); $j++){
									$allow = explode(':', $callowance[$j]);
									foreach($allowanceList as $d){
										if($allow[0]== $d['id']){
											$amount[$j] += $allow[1];
										$CURRENTALLOWANCE[$j] = $allow[0].':'.$amount[$j].':'.$allow[2];	
										}
									 }
								}
								
							}
							$allowance =''; $PAYABLEALLOWANCE='';
							for($i=0; $i< count($pablearray); $i++){
								$allowance = $pablearray[$i];
								$allowance = explode(',', $allowance);
								//$pamount=''; $allow='';
								for($j=0; $j < count($allowance); $j++){
									$allow = explode(':', $allowance[$j]);
									foreach($allowanceList as $d){
										if($allow[0]== $d['id']){
											$pamount[$j] += $allow[1];
										$PAYABLEALLOWANCE[$j] = $allow[0].':'.$pamount[$j].':'.$allow[2];	
										}
									 }
								}
								
							}
							
							if(count($getshiftdata) > 1){
								$finaldata['BasicSalary'] 			= 	$getsalarySt['basic_salary'];
								$gradeall = $getsalarySt['allowance'];
								$gradeallarray = explode(',' ,$gradeall);
								for($l=0; $l < count($gradeallarray); $l++){
									$partall='';
									$partall = explode('-', $gradeallarray[$l]);
									$Totalgradebaseallow += $partall[1];
									$CurrentGradeallo[]= $partall[0].':'.$partall[1].':0';
								}
								 $finaldata['TotalAllowance'] 		= 	$Totalgradebaseallow;
								 $finaldata['GrossSalary'] 	= $getsalarySt['basic_salary'] + $Totalgradebaseallow;
								 $finaldata['CurrentAllowance'] =implode(',', $CurrentGradeallo);	
							
							}
							else{
							$finaldata['CurrentAllowance'] =implode(',', $CURRENTALLOWANCE);
							}
							$finaldata['PayableAllowance'] =implode(',', $PAYABLEALLOWANCE);
							
							
							$finaldata['CurrentDeduction'] =implode(',', $FINALCURRENTDEDUCRION);
							$finaldata['ApplyDeduction'] =implode(',', $FINALAPPLYDEDUCRION);
							
							//var_dump($finaldata); exit;
							//Professional Tax Start............
							 $checkPtax = $this->CommanModel->getDataIfdataexists('p_tax', 'tbl_client', array('id'=>$clientid,
								'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
								
								if($checkPtax['p_tax'] == '1'){
									$ptax = $this->getPTax($finaldata['PayableGrossSalary']);
									$finaldata['TotalDeductionEP'] = $finaldata['TotalDeductionEP'] + $ptax;
									$finaldata['PTax'] = $ptax;
								}
							//Professional Tax End.............
							$NetSalary = $finaldata['PayableGrossSalary'] - $finaldata['TotalDeductionEP'];
							  
							 
							
							 if($checksalarydata==null){
							$finaldata['company_id'] = $this->session->userdata('company_id');
							$finaldata['branch_id'] = $this->session->userdata('branch_id');
							$finaldata['createdon'] =  date_timestamp_get(date_create());
							$finaldata['createdby'] = $this->session->userdata('loginid');
								$insert = $this->CommanModel->InsertData('tbl_salary', $finaldata);
									if($insert){
										if($EMISTATUS == true){
											$updat_emi_status['emi_payable_id'] = $insert; 
											$updatetemi = $this->CommanModel->UpdateData('tbl_loan_details', $updat_emi_status, array('id'=>$updateemiId));	
												
											}
											if($isLoanAdvance == true){
											for($i=0; $i < count($updateAdvance); $i++){
												$updateextradedution['due'] = $updateAdvance[$i]['due'];
												$updateextradedution['paid'] = $updateAdvance[$i]['paid'];
												$updateextradedution['status'] = $updateAdvance[$i]['status'];
												$updatetbal = $this->CommanModel->UpdateData('tbl_loan_advance_details',$updateextradedution, array('id'=>$updateAdvance[$i]['id']));
											}
											if(!empty($ExtraDeductionTrans)){
											for($i=0; $i < count($ExtraDeductionTrans); $i++){
												$ExtraDeductionTrans[$i][$clientid]['payable_id'] = $insert;
												$extraupdatetbal = $this->CommanModel->InsertData('tbl_extradeduction_trans',$ExtraDeductionTrans[$i][$clientid]);
											}}
											}
									
										for($i=0; $i < count($FINAL); $i++){
											$datainsert = $FINAL[$i];
											$datainsert['salary_id']=$insert; 
											$datainsert['company_id'] = $this->session->userdata('company_id');
											$datainsert['branch_id'] = $this->session->userdata('branch_id');
											$datainsert['createdon'] =  date_timestamp_get(date_create());
											$datainsert['createdby'] = $this->session->userdata('loginid');
											$insertsubid = $this->CommanModel->InsertData('tbl_salary_detail', $datainsert);
											if($insertsubid){
												$inserdata = true;
												
											}
											else{
												$inserdata = false;
											}
											
										}
									}
								 }
								 else{
										
							$finaldata['updatedon'] =  date_timestamp_get(date_create());
							$finaldata['updatedby'] = $this->session->userdata('loginid'); 
							$updateid = $this->CommanModel->UpdateData('tbl_salary',$finaldata, array('id'=>$checksalarydata['id']));
									if($updateid){
										for($i=0; $i < count($FINAL); $i++){
											$datainsert = $FINAL[$i];
											$datainsert['salary_id']= $checksalarydata['id']; 
											
											
											$checksalarysubdata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary_detail', array('emp_id'=>$finaldata['emp_id'],'year_v'=>$finaldata['year_v'],
											'month_v'=>$finaldata['month_v'],'shiftid'=>$datainsert['shiftid'],'salary_id'=>$datainsert['salary_id'],'clientid'=>$datainsert['clientid'],'serviceid'=>$datainsert['serviceid'],'subserviceid'=>$datainsert['subserviceid']));
											//echo var_dump($checksalarysubdata); exit;
											if($checksalarysubdata==''){
												
												$datainsert['salary_id']= $checksalarydata['id']; 
												$datainsert['company_id'] = $this->session->userdata('company_id');
												$datainsert['branch_id'] = $this->session->userdata('branch_id');
												$datainsert['createdon'] =  date_timestamp_get(date_create());
												$datainsert['createdby'] = $this->session->userdata('loginid');
												
												$insertsub = $this->CommanModel->InsertData('tbl_salary_detail', $datainsert);
												if($insertsub){
												$insersubdata = true;
												}
												else{
												$insersubdata = false;
												}
											}
											else{
												
												//echo var_dump($datainsert); exit;
												$datainsert['updatedon'] =  date_timestamp_get(date_create());
												$datainsert['updatedby'] = $this->session->userdata('loginid');
												$update = $this->CommanModel->UpdateData('tbl_salary_detail', $datainsert, array('id'=>$checksalarysubdata['id']));
												if($update){
												$insersubdata = true;
												}
												else{
												$insersubdata = false;
												}
											}
											
										}
									}
									 
								 }	
								 
								 
								if($inserdata==true){
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Salary Successfully Generated</div>');
									redirect('branchadmin/Employee/printSalary/'.$insert);
									}
									elseif($insersubdata==true){
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Salary Successfully Updated</div>');
										redirect('branchadmin/Employee/printSalary/'.$checksalarydata['id']);
									}
									else{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Salary Not Generated</div>');
										redirect('branchadmin/Employee/generateClientBasedSalary');
									}
									
								
					 
					  
					  
					  
					  
					  }
			  
		 }
		 
		 				if($emp_id == '-1'){
							$emplist = $this->CommanModel->getListWhere('emp_id', 'tbl_shift_emp', 'id', 'ASC', array('client_id'=>$client_id, 'year_v'=>$year, 'month_v'=>$month,'emp_id!='=>0));;
						
						//var_dump($emplist); exit;
						foreach($emplist as $emp){
							$FinalEmpDetail='';
							$FINAL = '';
							$emp_id = $emp['emp_id'];	
					  $attandanceData = $this->CommanModel->getDataIfdataexists('*', 'tbl_attendance', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $monthdetail = $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					  $getempPData = $this->CommanModel->getDataIfdataexists('id,emp_code,emp_name', 'tbl_employee', array('id'=>$emp_id));
					  $getempData = $this->CommanModel->getDataIfdataexists('*', 'tbl_employee_official', array('emp_id'=>$emp_id));
					  	
					  
					  $NoofDaysInmonth = $monthdetail['NoOfDays'];
					  $startmotnthdate = $year.'-'.$month.'-'. 01;
					  $endmotnthdate = $year.'-'.$month.'-'. $NoofDaysInmonth;
					  ///exit;
					  $getsalarySt = $this->CommanModel->getDataIfdataexists('*', 'tbl_gradebase_salary', array('grade_id'=>$getempData['grade'],
					  'department_id'=>$getempData['department'],'designation_id'=>$getempData['designation'],'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					  if($getsalarySt!=null){
						$checksalarydata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $getshiftdata = $this->CommanModel->getListWhere('*', 'tbl_shift_emp', 'id', 'ASC', array('emp_id'=>$emp_id, 'year_v'=>$year, 'month_v'=>$month)); 
					  //$vars = array_keys(get_defined_vars());
					  //var_dump($vars);
					 
							if($attandanceData['locked_status']=='1' && $attandanceData!=null && $getshiftdata!=null){
								
								
									if((strtotime($startmotnthdate) <= strtotime($getempData['doj'])) && (strtotime($getempData['doj']) <= strtotime($endmotnthdate))){
										
									$JoinInThisMOnth = true;	
									}
									else{
										
										$JoinInThisMOnth = false;
										for($i=1; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
										
										
									
										}
									}
									
									foreach($getshiftdata as $shift){
										$shiftid = $shift['id'];
										$clientid = $shift['client_id'];
										$serviceid = $shift['service_id'];
										$subserviceid = $shift['subservice_id'];
										$APW = explode(',', $shift['APW']);
										$days = $shift['days'];
										$days = explode(',', $days);
										$finaldays='';
										for($i=0; $i< count($days); $i++){
											$dy = explode('-', $days[$i]);
											$finaldays[$dy[0]]=$dy[1];	
										}
										if($JoinInThisMOnth == true){
										$joindate = explode('-', $getempData['doj']);
										//echo var_dump($finaldays);
										$p=''; $w='';$a='';
									for($i=(int)$joindate[2]; $i <=$NoofDaysInmonth; $i++){
										
										if($finaldays[$i]!=''){
											
											if($finaldays[$i] == 'P'){$p[]=$finaldays[$i];}
											if($finaldays[$i]=='W'){ $w[]=$finaldays[$i];}
											if($finaldays[$i]=='A'){ $a[]=$finaldays[$i];}
											
										}
										
										
									
										}
										
										if($p!=''){
										$totalPresent = count($p);
										}
										if($w!=''){
										$totalweekof = count($w);
										}
										if($a!=''){
										$totalabsend = count($a);
										}
										}
										else{
											
											$pp = explode('-', $APW[0]);
											$aa = explode('-', $APW[1]);
											$ww = explode('-', $APW[2]);
										$totalPresent = $pp[1];
										$totalweekof = $ww[1];
										$totalabsend = $aa[1];
										}
										$ot = explode('-', $APW[3]);
										$totalot = $ot[1];
										$FinalEmpDetail='';
										$FinalEmpDetail['year_v'] = $year;
					 					 $FinalEmpDetail['month_v'] = $month;
										 $FinalEmpDetail['salary_type'] = 1;
										 $FinalEmpDetail['shiftid'] = $shift['id'];
										$FinalEmpDetail['clientid'] = $shift['client_id'];
										$FinalEmpDetail['serviceid'] = $shift['service_id'];
										$FinalEmpDetail['subserviceid'] = $shift['subservice_id'];
										$FinalEmpDetail['APW'] = $shift['APW'];
					  						$FinalEmpDetail['emp_code'] = $getempPData['emp_code'];
					  						$FinalEmpDetail['emp_id'] = $emp_id;
					  						$FinalEmpDetail['PresentDay'] = (int)$totalPresent;
					  							$FinalEmpDetail['WeekOffDay'] = (int)$totalweekof;
					  							$FinalEmpDetail['AbsentDay'] = (int)$totalabsend;
					  							$FinalEmpDetail['OTDay'] = (float)$totalot;
								///var_dump($FinalEmpDetail); exit;		
						$getmappdata = $this->CommanModel->getDataIfdataexists('*', 'tbl_client_service_mapping', array('client_id'=>$clientid,
					  'service_id'=>$serviceid,'subservice_id'=>$subserviceid,'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					 
					  $allowance='';
					  
					  if($getmappdata!='' && $getsalarySt!=''){
						
							
							  $allowance = $getmappdata['allowance'];
							  $getbasisc='';
							  $getbasisc =  explode(',', $allowance);
							  $totalall = 0;
							  for($i=0; $i< count($getbasisc); $i++){
								  $r = explode('-', $getbasisc[$i]);
								  $totalall +=  $r[1];
							  }
							  
							  $deduction = $getsalarySt['deduction_id'];
							  $NoofDaysInmonth = $monthdetail['NoOfDays'];
							if($getmappdata['bill_cycle']=='1'){
						  		$FinalEmpDetail['BasicSalary'] = (float)$getmappdata['employee_rate'] - $totalall;
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
						  }
						  if($getmappdata['bill_cycle']=='3'){
							  $NoofDaysInmonth = (int)$getmappdata['bill_cycle_num'];
						  $FinalEmpDetail['BasicSalary'] = (float)$getmappdata['employee_rate'] - $totalall;
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
							 
						  }
						  if($getmappdata['bill_cycle']=='2'){
						  	$FinalEmpDetail['BasicSalary'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['PresentDay']);
							  $FinalEmpDetail['PayableBasicSalary'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['PresentDay']);
						  }
							 
								$CurrentAllowance=''; $PayableAllowance='';$totalallwance=''; $totalallwancepayable=''; $allwance='';$income='';
								if(!empty($allowance)){
									
									  $allowance = explode(',',$allowance);
								  for($i=0; $i < count($allowance); $i++){
									  $income = explode('-', $allowance[$i]);
									  $getalltype = $this->CommanModel->getDataIfdataexists('mode_of_payment', 'tbl_allowance', array('id'=>$income[0]));
									  if($getalltype['mode_of_payment']=='1'){
										  $totalallwance += (float)$income[1];
										  $totalallwancepayable += (float)$income[1];
										 $CurrentAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 }
										 if($getalltype['mode_of_payment']=='0'){
										if($getmappdata['bill_cycle']=='2'){
											  $totalallwance += round($income[1] * $FinalEmpDetail['PresentDay']);
						  						 $allwance = round($income[1] * $FinalEmpDetail['PresentDay']);
						  					}
											else{
												$totalallwance += (float)$income[1];
												 $allwance = round($income[1] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
												}
										  $totalallwancepayable += $allwance;
										  $CurrentAllowance[] = $income[0].':'.$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.$allwance.':'.$getalltype['mode_of_payment'];
										 }
										 
										 
								  }
								  $FinalEmpDetail['CurrentAllowance'] = implode(',', $CurrentAllowance);
								 $FinalEmpDetail['PayableAllowance'] = implode(',', $PayableAllowance);
								 $FinalEmpDetail['TotalAllowance'] = $totalallwancepayable;
								  }
								  else{
								$FinalEmpDetail['CurrentAllowance'] = '';
								 $FinalEmpDetail['PayableAllowance'] = '';
								 $FinalEmpDetail['TotalAllowance'] = 0;
								  }
								
								  
							$FinalEmpDetail['GrossSalary'] = $FinalEmpDetail['BasicSalary'] + $totalallwance; 
								  
							 if($FinalEmpDetail['OTDay']!=0){
									  if($getmappdata['bill_cycle']=='2'){
									  $FinalEmpDetail['OTDayAmount'] = round((float)$getmappdata['employee_rate'] * $FinalEmpDetail['OTDay']);
									  }
								  	else{
									  
									  $FinalEmpDetail['OTDayAmount'] = round($FinalEmpDetail['GrossSalary'] / $NoofDaysInmonth * $FinalEmpDetail['OTDay']);
								  		}
									  
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'] + $FinalEmpDetail['OTDayAmount'];
								  }
							else{
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'];
								  }	
								  
								 
							  if($deduction!=null){
								  $CurrentDeduction ='';
								  $ApplyDeduction ='';
								  $calculateddeduction1 ='';
								  $calculateddeduction2='';
								  $firstdeduction='';
								  $seconddeduction='';
								  $deduction = explode(',',$deduction);
								  $getdeduction = $this->CommanModel->getListWhereIn('*', 'tbl_deduction_head', 'id', 'ASC', $deduction);
								  for($i=0; $i < count($getdeduction); $i++){
									  if($getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
									  
									  if($getdeduction[$i]['type_of_deduction']==='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
													else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$calculateddeduction1 = ceil($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = ceil($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = ceil($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = ceil($AllwancedeductonGross * $seconddeduction / 100);
														}else{
															$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
														}
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['BasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
									  }
									  
									  if($getdeduction[$i]['type_of_deduction']==='Temperary'){
										  $todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
														if($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
														
														if($FinalEmpDetail['BasicSalary'] >= $getdeduction[$i]['max_salary_limit']){
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
														$FinalEmpDetail['BasicSalary'] = $getdeduction[$i]['max_salary_limit'];
														}else{
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];	
														}
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													
													$totald = $calculateddeduction1;
													}
													}
													else{
														$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['PayableBasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											}
									  }
									  
								  }
								  }
								  }
								
										
							  $FinalEmpDetail['CurrentDeduction'] = implode(',', $CurrentDeduction);
							  $FinalEmpDetail['ApplyDeduction'] = implode(',', $ApplyDeduction);
							  $FinalEmpDetail['TotalDeductionEP'] = 0;
								$FinalEmpDetail['TotalDeductionER'] = 0;
							  foreach($ApplyDeduction as $dedkey=>$deduva){
								  $fd = explode(':', $deduva);
								  //echo var_dump((float)$fd[2]);
								  $FinalEmpDetail['TotalDeductionEP'] += (float)$fd[2];
								  
									$FinalEmpDetail['TotalDeductionER'] += (float)$fd[3];
								  
								  }
							 $FinalEmpDetail['NetSalary'] = $FinalEmpDetail['PayableGrossSalary'] - $FinalEmpDetail['TotalDeductionEP'];
							  for($i=0; $i < count($getdeduction); $i++){
								  
									 if($getdeduction[$i]['deduction_applied_on']=='-3'){ 
									 if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}

													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
											}
									 }
									 else{
										 $FinalEmpDetail['DeductionOnNetSalary'] ='';
										 $FinalEmpDetail['DeductionAmountOnNetSalary']='0.00';
										 $FinalEmpDetail['FinalNetSalary'] ='0.00';
									 }
									if($FinalEmpDetail['FinalNetSalary']=='0.00'){
										$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['NetSalary'];
										}
										else{
											$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['FinalNetSalary'];
											}
											///echo var_dump($getdeduction[$i]['deduction_applied_on']); exit;
									if($getdeduction[$i]['deduction_applied_on']=='-4'){
									  if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
												
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
											}
											}
										
									  }
									else{
										$FinalEmpDetail['DeductionOnTakeHomeSalary'] ='';
										$FinalEmpDetail['DeductionAmountOnTakeHomeSalary']='0.00';
										$FinalEmpDetail['FinalTakeHomeSalary'] = '';
									}
									  if($FinalEmpDetail['FinalTakeHomeSalary']==''){
										  $FinalEmpDetail['FinalTakeHomeSalary'] = $FinalEmpDetail['TakeHomeSalary'];
									  }
									  
									  
							  }
							  
							$FinalEmpDetail['CTC'] = $FinalEmpDetail['NetSalary'] + $FinalEmpDetail['TotalDeductionER'];
					  		
							//echo var_dump($FinalEmpDetail); exit;
							
							
							}
							
							
								
						$FINAL[] =$FinalEmpDetail;	
					}
								
							unset($finaldata); unset($cpablearray); unset($pablearray); unset($ccudeduction); unset($appdeduction);
							 for($i=0; $i < count($FINAL); $i++){
								 $finaldata['year_v'] 								= 	$FINAL[0]['year_v']; 
								 $finaldata['month_v'] 								= 	$FINAL[0]['month_v'];
								 $finaldata['salary_type'] 							= 	1;
								 $finaldata['emp_code'] 							= 	$FINAL[0]['emp_code'];
								 $finaldata['emp_id'] 								= 	$FINAL[0]['emp_id'];
								 $finaldata['PresentDay'] 							+= 	$FINAL[$i]['PresentDay'];
								 $finaldata['WeekOffDay'] 							+= 	$FINAL[$i]['WeekOffDay'];
								 $finaldata['AbsentDay'] 							+= 	$FINAL[$i]['AbsentDay'];
								 $finaldata['OTDay'] 								+= 	$FINAL[$i]['OTDay'];
								 $finaldata['OTDayAmount'] 							+= 	$FINAL[$i]['OTDayAmount'];
								 $finaldata['BasicSalary'] 							+= 	$FINAL[$i]['BasicSalary'];
								 $finaldata['PayableBasicSalary'] 					+= 	$FINAL[$i]['PayableBasicSalary'];
								 
								 $cpablearray[]  									= 	$FINAL[$i]['CurrentAllowance'];
								 
								 $pablearray[]									    = 	$FINAL[$i]['PayableAllowance'];
								 
								 
								 $finaldata['TotalAllowance'] 						+= 	$FINAL[$i]['TotalAllowance'];
								 $finaldata['GrossSalary'] 							+= 	$FINAL[$i]['GrossSalary'];
								 $finaldata['PayableGrossSalary'] 					+= 	$FINAL[$i]['PayableGrossSalary'];
								 
								 $ccudeduction[]  									= 	$FINAL[$i]['CurrentDeduction'];
								 $appdeduction[]  									= 	$FINAL[$i]['ApplyDeduction'];
								 
								 
								 $finaldata['TotalDeductionEP'] 					+= 	$FINAL[$i]['TotalDeductionEP'];
								 $finaldata['TotalDeductionER'] 					+= 	$FINAL[$i]['TotalDeductionER'];
								 $finaldata['DeductionOnNetSalary'] 				+= 	$FINAL[$i]['DeductionOnNetSalary'];
								 $finaldata['DeductionAmountOnNetSalary'] 			+= 	$FINAL[$i]['DeductionAmountOnNetSalary'];
								 $finaldata['FinalNetSalary'] 						+= 	$FINAL[$i]['FinalNetSalary'];
								 $finaldata['TakeHomeSalary'] 						+=	$FINAL[$i]['TakeHomeSalary'];
								 $finaldata['DeductionOnTakeHomeSalary'] 			+= 	$FINAL[$i]['DeductionOnTakeHomeSalary'];
								 $finaldata['DeductionAmountOnTakeHomeSalary'] 		+= $FINAL[$i]['DeductionAmountOnTakeHomeSalary'];
								 $finaldata['FinalTakeHomeSalary'] 					+= $FINAL[$i]['FinalTakeHomeSalary'];
								 $finaldata['CTC'] 									+= $FINAL[$i]['CTC'];
      												
    
							 }
							 	
							$allowanceList = $this->CommanModel->getListWhere('id','tbl_allowance','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),
							'branch_id'=>$this->session->userdata('branch_id')));
							$deductionList = $this->CommanModel->getListWhere('id','tbl_deduction_head','id', 'ASC', array('company_id'=>$this->session->userdata('company_id'),
							'branch_id'=>$this->session->userdata('branch_id')));	
							$FINALCURRENTDEDUCRION=''; $deduction=''; $fefp=='';$fepf='';
							for($i=0; $i< count($ccudeduction); $i++){
								$deduction = $ccudeduction[$i];
								$deduction = explode(',', $deduction);
								//$fefp =''; $fepf=''; $efp=''; $efs='';$dedu='';
								for($j=0; $j < count($deduction); $j++){
									$dedu = explode(':', $deduction[$j]);
									foreach($deductionList as $d){
										if($dedu[0]== $d['id']){
											
											$efp = explode('@', $dedu[2]);
											$fefp[$j] += $efp[0];
											$efs = explode('@', $dedu[3]);
											$fepf[$j] += $efs[0];
											
										$FINALCURRENTDEDUCRION[$j] = $dedu[0].':'.$dedu[1].':'.$fefp[$j].'@'.$efp[1].':'.$fepf[$j].'@'.$efs[1].':'.$dedu[4].':'.$dedu[5];	
										}
									 }
								}
								
								
							}
							$adeduction=''; $FINALAPPLYDEDUCRION='';$cfefp='';$cfepf='';
							for($i=0; $i< count($appdeduction); $i++){
								
								$adeduction = $appdeduction[$i];
								$adeduction = explode(',', $adeduction);
								//$dedu =''; $efp=''; $cfefp=''; $efs=''; $cfepf='';
								for($j=0; $j < count($adeduction); $j++){
									$dedu = explode(':', $adeduction[$j]);
									foreach($deductionList as $d){
										if($dedu[0]== $d['id']){
											
											$efp = explode('@', $dedu[2]);
											$cfefp[$j] += $efp[0];
											$efs = explode('@', $dedu[3]);
											$cfepf[$j] += $efs[0];
											
										$FINALAPPLYDEDUCRION[$j] = $dedu[0].':'.$dedu[1].':'.$cfefp[$j].'@'.$efp[1].':'.$cfepf[$j].'@'.$efs[1].':'.$dedu[4].':'.$dedu[5];	
										}
									 }
								}
								
								
							}
							$callowance = '';$CURRENTALLOWANCE='';$allow =''; $amount='';
							for($i=0; $i< count($cpablearray); $i++){
								$callowance = $cpablearray[$i];
								$callowance = explode(',', $callowance);
								
								for($j=0; $j < count($callowance); $j++){
									$allow = explode(':', $callowance[$j]);
									foreach($allowanceList as $d){
										if($allow[0]== $d['id']){
											$amount[$j] += $allow[1];
										$CURRENTALLOWANCE[$j] = $allow[0].':'.$amount[$j].':'.$allow[2];	
										}
									 }
								}
								
							}
							$allowance =''; $PAYABLEALLOWANCE='';$pamount=''; $allow='';
							for($i=0; $i< count($pablearray); $i++){
								$allowance = $pablearray[$i];
								$allowance = explode(',', $allowance);
								
								for($j=0; $j < count($allowance); $j++){
									$allow = explode(':', $allowance[$j]);
									foreach($allowanceList as $d){
										if($allow[0]== $d['id']){
											$pamount[$j] += $allow[1];
										$PAYABLEALLOWANCE[$j] = $allow[0].':'.$pamount[$j].':'.$allow[2];	
										}
									 }
								}
								
							}
							$Totalgradebaseallow='';$gradeallarray='';$CurrentGradeallo='';
							if(count($getshiftdata) > 1){
								$finaldata['BasicSalary'] 			= 	$getsalarySt['basic_salary'];
								$gradeall = $getsalarySt['allowance'];
								$gradeallarray = explode(',' ,$gradeall);
								for($l=0; $l < count($gradeallarray); $l++){
									$partall='';
									$partall = explode('-', $gradeallarray[$l]);
									$Totalgradebaseallow += $partall[1];
									$CurrentGradeallo[]= $partall[0].':'.$partall[1].':0';
								}
								 $finaldata['TotalAllowance'] 		= 	$Totalgradebaseallow;
								 $finaldata['GrossSalary'] 	= $getsalarySt['basic_salary'] + $Totalgradebaseallow;
								 $finaldata['CurrentAllowance'] =implode(',', $CurrentGradeallo);	
							
							}
							else{
							$finaldata['CurrentAllowance'] =implode(',', $CURRENTALLOWANCE);
							}
							$finaldata['PayableAllowance'] =implode(',', $PAYABLEALLOWANCE);
							
							
							$finaldata['CurrentDeduction'] =implode(',', $FINALCURRENTDEDUCRION);
							$finaldata['ApplyDeduction'] =implode(',', $FINALAPPLYDEDUCRION);
							
							//var_dump($finaldata); exit;
							//Professional Tax Start............
							 $checkPtax = $this->CommanModel->getDataIfdataexists('p_tax', 'tbl_client', array('id'=>$clientid,
								'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
								
								if($checkPtax['p_tax'] == '1'){
									$ptax = $this->getPTax($finaldata['PayableGrossSalary']);
									$finaldata['TotalDeductionEP'] = $finaldata['TotalDeductionEP'] + $ptax;
									$finaldata['PTax'] = $ptax;
								}
							//Professional Tax End.............
							$NetSalary = $finaldata['PayableGrossSalary'] - $finaldata['TotalDeductionEP'];
							  
							  $updateAdvance=''; $ExtraDeductionTrans=''; $FinalExtraDeduction='';$TotalExtraDeduction='';
							  if($checksalarydata==null){
								$extradeductionList = $this->CommanModel->getListWhere('*', 'tbl_loan_advance_details', 'id', 'ASC', array('emp_id'=>$emp_id,'status'=>0, 'year_v <='=>$year,'month_v <='=>$month,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
							  	
								if(!empty($extradeductionList)){
									$isLoanAdvance = true;
									for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 if((float)$checkloanAdvance['due'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['due'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = 0;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$checkloanAdvance['due'];
											  $NetSalary = $NetSalary - (float)$checkloanAdvance['due'];
											  $TotalExtraDeduction +=  (float)$checkloanAdvance['due'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1; 
												  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
												  if($checkloanAdvance['month_v'] == '12'){
												  $updateAdvance[$i]['month_v'] = $checkloanAdvance['month_v'] ;
												  $updateAdvance[$i]['year_v'] = (int)$checkloanAdvance['year_v'] + 1;
												  }
												  else{
													  $updateAdvance[$i]['month_v'] = (int)$checkloanAdvance['month_v'] + 1;
												  }
											  }
											 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 elseif((float)$checkloanAdvance['due'] > $NetSalary && $NetSalary!=0){
											// echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.$NetSalary;
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = (float)$checkloanAdvance['due'] - $NetSalary;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + $NetSalary;
											  
											  $TotalExtraDeduction +=  $NetSalary;
											  $NetSalary = 0;
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $NetSalary;
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
												  
									 }
									
									 if($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$emidetail = $this->CommanModel->getListWhereLimit('*', 'tbl_loan_details', 'id', 'ASC', array('row_id'=>$checkloanAdvance['id'], 'emi_status'=>'0'), 1);
							  			}
										$EMISTATUS = true;
										 if((float)$emidetail[0]['emi_amount'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											 
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$emidetail[0]['id'].':'.$emidetail[0]['emi_amount'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  if($checkloanAdvance['emi_no'] != $emidetail[0]['no_of_emi']){
											  $updateAdvance[$i]['due'] = $checkloanAdvance['due'] - $emidetail[0]['emi_amount'];
											  }
											  elseif($checkloanAdvance['emi_no'] == $emidetail[0]['no_of_emi']){
												 $updateAdvance[$i]['due'] = 0; 
											  }
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$emidetail[0]['emi_amount'];
											  $NetSalary = $NetSalary - (float)$emidetail[0]['emi_amount'];
											  $TotalExtraDeduction +=  (float)$emidetail[0]['emi_amount'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											 $updateemiId = $emidetail[0]['id'];
											 $updat_emi_status['emi_status'] = 1; 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['emi_id'] = $emidetail[0]['id'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 
												  
									 }
									
									}
									
									
								}
							  
							  }
							  elseif($checksalarydata['id']!=''){
								$extradeductionList = $this->CommanModel->getListWhere('id,extradeduction_id,loan_type,emp_id,loan_approved,due,paid,emi_id', 'tbl_extradeduction_trans', 'id', 'ASC', array('emp_id'=>$emp_id, 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'), 'payable_id'=>$checksalarydata['id']));  
							  	for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['paid'];
										 $TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
									 }
									 elseif($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$checkloanAdvance['emi_id'].':'.(float)$checkloanAdvance['paid'];
										$TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
										}
										
									 }
									 
								}
							  }
							  
							  	/*var_dump($NetSalary);  
								 var_dump($extradeductionList);	
							  exit; 
							 	var_dump($ExtraDeductionTrans);
							 var_dump($UExtraDeductionTrans);
							var_dump($updateAdvance);*/
							
							  $finaldata['ExtraDeduction'] = implode(',', $FinalExtraDeduction);
							  if(!empty($TotalExtraDeduction)){
							  $finaldata['TotalExtraDeduction'] = $TotalExtraDeduction;
							  }
							  else{
								  $finaldata['TotalExtraDeduction'] = '0.00';
							  }
							  if( $NetSalary == 0){
								  $finaldata['NetSalary'] = 0;
							  }
							  else{
							 $finaldata['NetSalary'] = $finaldata['PayableGrossSalary'] - ($finaldata['TotalDeductionEP'] + $TotalExtraDeduction);
							  }
								
								
								
							 if($checksalarydata==null){
							$finaldata['company_id'] = $this->session->userdata('company_id');
							$finaldata['branch_id'] = $this->session->userdata('branch_id');
							$finaldata['createdon'] =  date_timestamp_get(date_create());
							$finaldata['createdby'] = $this->session->userdata('loginid');
								$insert = $this->CommanModel->InsertData('tbl_salary', $finaldata);
									if($insert){
										if($EMISTATUS == true){
											$updat_emi_status['emi_payable_id'] = $insert; 
											$updatetemi = $this->CommanModel->UpdateData('tbl_loan_details', $updat_emi_status, array('id'=>$updateemiId));	
												
											}
											if($isLoanAdvance == true){
											for($i=0; $i < count($updateAdvance); $i++){
												$updateextradedution['due'] = $updateAdvance[$i]['due'];
												$updateextradedution['paid'] = $updateAdvance[$i]['paid'];
												$updateextradedution['status'] = $updateAdvance[$i]['status'];
												$updatetbal = $this->CommanModel->UpdateData('tbl_loan_advance_details',$updateextradedution, array('id'=>$updateAdvance[$i]['id']));
											}
											if(!empty($ExtraDeductionTrans)){
											for($i=0; $i < count($ExtraDeductionTrans); $i++){
												$ExtraDeductionTrans[$i][$clientid]['payable_id'] = $insert;
												$extraupdatetbal = $this->CommanModel->InsertData('tbl_extradeduction_trans',$ExtraDeductionTrans[$i][$clientid]);
											}}
											}
										for($i=0; $i < count($FINAL); $i++){
											$datainsert = $FINAL[$i];
											$datainsert['salary_id']=$insert; 
											$datainsert['company_id'] = $this->session->userdata('company_id');
											$datainsert['branch_id'] = $this->session->userdata('branch_id');
											$datainsert['createdon'] =  date_timestamp_get(date_create());
											$datainsert['createdby'] = $this->session->userdata('loginid');
											$insertsubid = $this->CommanModel->InsertData('tbl_salary_detail', $datainsert);
											if($insertsubid){
												$inserdata = true;
												
											}
											else{
												$inserdata = false;
											}
											
										}
									}
								 }
								 else{
									 	
							$finaldata['updatedon'] =  date_timestamp_get(date_create());
							$finaldata['updatedby'] = $this->session->userdata('loginid'); 
									$updateid = $this->CommanModel->UpdateData('tbl_salary',$finaldata, array('id'=>$checksalarydata['id']));
									if($updateid){
										for($i=0; $i < count($FINAL); $i++){
											$datainsert = $FINAL[$i];
											$datainsert['salary_id']= $checksalarydata['id']; 
											
											//echo var_dump($datainsert); exit;
											$checksalarysubdata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary_detail', array('emp_id'=>$finaldata['emp_id'],'year_v'=>$finaldata['year_v'],
											'month_v'=>$finaldata['month_v'],'shiftid'=>$datainsert['shiftid'],'salary_id'=>$datainsert['salary_id'],'clientid'=>$datainsert['clientid'],'serviceid'=>$datainsert['serviceid'],'subserviceid'=>$datainsert['subserviceid']));
											//echo var_dump($checksalarysubdata); exit;
											if($checksalarysubdata==''){
												
												$datainsert['salary_id']= $checksalarydata['id']; 
												$datainsert['company_id'] = $this->session->userdata('company_id');
												$datainsert['branch_id'] = $this->session->userdata('branch_id');
												$datainsert['createdon'] =  date_timestamp_get(date_create());
												$datainsert['createdby'] = $this->session->userdata('loginid');
												
												$insertsub = $this->CommanModel->InsertData('tbl_salary_detail', $datainsert);
												if($insertsub){
												$inserdata = true;
												}
												else{
												$inserdata = false;
												}
											}
											else{
												
												//echo var_dump($datainsert); exit;
												$datainsert['updatedon'] =  date_timestamp_get(date_create());
												$datainsert['updatedby'] = $this->session->userdata('loginid');
												$update = $this->CommanModel->UpdateData('tbl_salary_detail', $datainsert, array('id'=>$checksalarysubdata['id']));
												if($update){
												$inserdata = true;
												}
												else{
												$inserdata = false;
												}
											}
											
										}
									}
									 
								 }	
								 
								 
								if($inserdata==true){
									
										$FINALINSERT = TRUE;
									}
									
									else{
										
										$FINALINSERT = FALSE;
									}	
								
					  
					  }
			  
						}
						}
						
						if($FINALINSERT == TRUE){
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Salary Successfully Generated</div>');
										redirect('branchadmin/Employee/generateClientBasedSalary');
									}
									
									else{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Salary Not Generated</div>');
										redirect('branchadmin/Employee/generateClientBasedSalary');
									}
				  }
			  }
		 		
			  }
			  }
		 else{
		
				redirect('web/index');	
		} 
	 }
	
	public function generateSalary(){
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/generateSalary';
			
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$emp_id = $this->input->post('emp_id');
			
			
			$data['empList'] = $this->CommanModel->getAllEMPDetailListWhere('tbl_employee.id,tbl_employee.emp_code, emp_name,tbl_designation.designation_name ',array('tbl_employee_official.salary_type'=>'AsPerEmployee','tbl_employee_official.date_of_leave'=>NULL)); 
			
			$this->form_validation->set_rules("year", "Year", "trim|required");
			$this->form_validation->set_rules("month", "Month", "trim|required");
			$this->form_validation->set_rules("emp_id", "Employee", "trim|required");
			
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view($this->layout, $data);
			  }
			  else{
				  if ($this->input->post('submit') == "Submit") {
					  //echo var_dump($_POST);
						if($emp_id != '-1'){
					  $attandanceData = $this->CommanModel->getDataIfdataexists('*', 'tbl_attendance', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $monthdetail = $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					  $getempPData = $this->CommanModel->getDataIfdataexists('id,emp_code,emp_name', 'tbl_employee', array('id'=>$emp_id));
					  $getempData = $this->CommanModel->getDataIfdataexists('*', 'tbl_employee_official', array('emp_id'=>$emp_id));
					  $checksalarydata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $NoofDaysInmonth = $monthdetail['NoOfDays'];
					  $startmotnthdate = $year.'-'.$month.'-'. 01;
					  $endmotnthdate = $year.'-'.$month.'-'. $NoofDaysInmonth;
					  ///exit;
					  //echo var_dump($monthdetail); exit;
					  
					  if($attandanceData==null){
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Mark Attandance first from this month or Employee!</div>');
							redirect('branchadmin/Employee/generateSalary');	
						  }
						if($attandanceData['locked_status']=='0'){
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Lock Attandance first from this month or Employee!</div>');
							redirect('branchadmin/Employee/generateSalary');
							
							}
							else{
									if((strtotime($startmotnthdate) <= strtotime($getempData['doj'])) && (strtotime($getempData['doj']) <= strtotime($endmotnthdate))){
										
									$joindate = explode('-', $getempData['doj']);	
										
									for($i=(int)$joindate[2]; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
									
										}
									}else{
										for($i=1; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
										
										
									
										}
									}
								}
					  	
					  
					  $FinalEmpDetail['year_v'] = $year;
					  $FinalEmpDetail['month_v'] = $month;
					  $FinalEmpDetail['emp_code'] = $getempPData['emp_code'];
					  $FinalEmpDetail['emp_id'] = $emp_id;
					  $FinalEmpDetail['salary_type'] = 2;
					  $FinalEmpDetail['PresentDay'] =count($p);
					  $FinalEmpDetail['WeekOffDay'] =count($w);
					  $FinalEmpDetail['AbsentDay'] =count($a);
					  $FinalEmpDetail['OTDay'] = (float)$attandanceData['ot_days'];
								//echo var_dump($FinalEmpDetail); exit;
								
					  if($getempData['salary_type'] = 'AsPerEmployee'){
					  $getsalarySt = $this->CommanModel->getDataIfdataexists('*', 'tbl_gradebase_salary', array('grade_id'=>$getempData['grade'],
					  'department_id'=>$getempData['department'],'designation_id'=>$getempData['designation'],'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					  if($getsalarySt==null){
						  	$this->session->set_flashdata('msg', '<div class="alert alert-danger">Can Not Find Any Salary Stracture for This Grade/Department/Designation!</div>');
							redirect('branchadmin/Employee/generateSalary');
						  }
						  else{
							  $allowance = $getsalarySt['allowance'];
							  
							  $deduction = $getsalarySt['deduction_id'];
							  
							  $FinalEmpDetail['BasicSalary'] = (float)$getsalarySt['basic_salary'];
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
							  
								
								if($allowance!=null){
									  $allowance = explode(',',$allowance);
								  for($i=0; $i < count($allowance); $i++){
									  $income = explode('-', $allowance[$i]);
									  $getalltype = $this->CommanModel->getDataIfdataexists('mode_of_payment', 'tbl_allowance', array('id'=>$income[0]));
									  if($getalltype['mode_of_payment']=='1'){
										  $totalallwance += (float)$income[1];
										  $totalallwancepayable += (float)$income[1];
										 $CurrentAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 }
										 if($getalltype['mode_of_payment']=='0'){
										$totalallwance += (float)$income[1];
										  $allwance = round($income[1] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
										  $totalallwancepayable += $allwance;
										  $CurrentAllowance[] = $income[0].':'.$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.$allwance.':'.$getalltype['mode_of_payment'];
										 }
										 
										 
								  }
								  $FinalEmpDetail['CurrentAllowance'] = implode(',', $CurrentAllowance);
								 $FinalEmpDetail['PayableAllowance'] = implode(',', $PayableAllowance);
								 $FinalEmpDetail['TotalAllowance'] = $totalallwancepayable;
								  }
								
								  
								  $FinalEmpDetail['GrossSalary'] = $FinalEmpDetail['BasicSalary'] + $totalallwance;
								// var_dump($FinalEmpDetail); exit;
								  if($FinalEmpDetail['OTDay']!=0){
									  $FinalEmpDetail['OTDayAmount'] = round($FinalEmpDetail['GrossSalary'] / $NoofDaysInmonth * $FinalEmpDetail['OTDay']);
									  
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'] + $FinalEmpDetail['OTDayAmount'];
								  }
								  else{
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'];
								  }
								  
								  
								  
								//var_dump($FinalEmpDetail); exit;  	  
							  if($deduction!=null){
								  $deduction = explode(',',$deduction);
								  $getdeduction = $this->CommanModel->getListWhereIn('*', 'tbl_deduction_head', 'id', 'ASC', $deduction);
								  for($i=0; $i < count($getdeduction); $i++){
									  if($getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
									  
									  if($getdeduction[$i]['type_of_deduction']==='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
													else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$calculateddeduction1 = ceil($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = ceil($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}else{
															$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = ceil($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = ceil($AllwancedeductonGross * $seconddeduction / 100);
														}else{
															$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
														}
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['BasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
									  }
									  
									  if($getdeduction[$i]['type_of_deduction']==='Temperary'){
										  $todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
														if($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
														
														if($FinalEmpDetail['BasicSalary'] >= $getdeduction[$i]['max_salary_limit']){
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
														$FinalEmpDetail['BasicSalary'] = $getdeduction[$i]['max_salary_limit'];
														}else{
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];	
														}
													$calculateddeduction1 = round($FinalEmpDetail['BasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['BasicSalary'] * $seconddeduction / 100);
													
													$totald = $calculateddeduction1;
													}
													}
													else{
														$calculateddeduction1 = round($FinalEmpDetail['BasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['BasicSalary'] * $seconddeduction / 100);
													$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['PayableBasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											}
									  }
									  
								  }
								  }
								  }
							  }
							  $FinalEmpDetail['CurrentDeduction'] = implode(',', $CurrentDeduction);
							  $FinalEmpDetail['ApplyDeduction'] = implode(',', $ApplyDeduction);
							  
							 
							  $FinalEmpDetail['TotalDeductionEP'] = 0;
								$FinalEmpDetail['TotalDeductionER'] = 0;
							  foreach($ApplyDeduction as $dedkey=>$deduva){
								  $fd = explode(':', $deduva);
								  //echo var_dump((float)$fd[2]);
								  $FinalEmpDetail['TotalDeductionEP'] += (float)$fd[2];
								  
									$FinalEmpDetail['TotalDeductionER'] += (float)$fd[3];
								  
								  }
							  
							  

							  $NetSalary = $FinalEmpDetail['PayableGrossSalary'] - $FinalEmpDetail['TotalDeductionEP'];
							 
							  $updateAdvance=''; $ExtraDeductionTrans=''; $FinalExtraDeduction='';
							  if($checksalarydata==null){
								 
								$extradeductionList = $this->CommanModel->getListWhere('*', 'tbl_loan_advance_details', 'id', 'ASC', array('emp_id'=>$emp_id,'status'=>0, 'year_v <='=>$year,'month_v <='=>$month,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
							  	
								if(!empty($extradeductionList)){
									$isLoanAdvance = true;
									for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 if((float)$checkloanAdvance['due'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['due'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = 0;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$checkloanAdvance['due'];
											  $NetSalary = $NetSalary - (float)$checkloanAdvance['due'];
											  $TotalExtraDeduction +=  (float)$checkloanAdvance['due'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1; 
												  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
												  if($checkloanAdvance['month_v'] == '12'){
												  $updateAdvance[$i]['month_v'] = $checkloanAdvance['month_v'] ;
												  $updateAdvance[$i]['year_v'] = (int)$checkloanAdvance['year_v'] + 1;
												  }
												  else{
													  $updateAdvance[$i]['month_v'] = (int)$checkloanAdvance['month_v'] + 1;
												  }
											  }
											 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 elseif((float)$checkloanAdvance['due'] > $NetSalary && $NetSalary!=0){
											// echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.$NetSalary;
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = (float)$checkloanAdvance['due'] - $NetSalary;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + $NetSalary;
											  
											  $TotalExtraDeduction +=  $NetSalary;
											  $NetSalary = 0;
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $NetSalary;
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
												  
									 }
									
									 if($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$emidetail = $this->CommanModel->getListWhereLimit('*', 'tbl_loan_details', 'id', 'ASC', array('row_id'=>$checkloanAdvance['id'], 'emi_status'=>'0'), 1);
							  			}
										$EMISTATUS = true;
										 if((float)$emidetail[0]['emi_amount'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											 
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$emidetail[0]['id'].':'.$emidetail[0]['emi_amount'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  if($checkloanAdvance['emi_no'] != $emidetail[0]['no_of_emi']){
											  $updateAdvance[$i]['due'] = $checkloanAdvance['due'] - $emidetail[0]['emi_amount'];
											  }
											  elseif($checkloanAdvance['emi_no'] == $emidetail[0]['no_of_emi']){
												 $updateAdvance[$i]['due'] = 0; 
											  }
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$emidetail[0]['emi_amount'];
											  $NetSalary = $NetSalary - (float)$emidetail[0]['emi_amount'];
											  $TotalExtraDeduction +=  (float)$emidetail[0]['emi_amount'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											 $updateemiId = $emidetail[0]['id'];
											 $updat_emi_status['emi_status'] = 1; 
											$ExtraDeductionTrans[$i][$clientid]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i][$clientid]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i][$clientid]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i][$clientid]['month_v'] = $month;
											$ExtraDeductionTrans[$i][$clientid]['year_v'] = $year;
											$ExtraDeductionTrans[$i][$clientid]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i][$clientid]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i][$clientid]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i][$clientid]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i][$clientid]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i][$clientid]['emi_id'] = $emidetail[0]['id'];
											$ExtraDeductionTrans[$i][$clientid]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i][$clientid]['createdby'] = $this->session->userdata('loginid');
										 }
										 
												  
									 }
									
									}
									
									
								}
							  
							  }
							  elseif($checksalarydata['id']!=''){
								 
								$extradeductionList = $this->CommanModel->getListWhere('id,extradeduction_id,loan_type,emp_id,loan_approved,due,paid,emi_id', 'tbl_extradeduction_trans', 'id', 'ASC', array('emp_id'=>$emp_id, 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'), 'payable_id'=>$checksalarydata['id']));  
							  	for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['paid'];
										 $TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
									 }
									 elseif($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$checkloanAdvance['emi_id'].':'.(float)$checkloanAdvance['paid'];
										$TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
										}
										
									 }
									 
								}
							  }
							  
							  	/*var_dump($NetSalary);  
								 var_dump($extradeductionList);	
							  exit; 
							 	var_dump($ExtraDeductionTrans);
							 var_dump($UExtraDeductionTrans);
							var_dump($updateAdvance);*/
							
							  $FinalEmpDetail['ExtraDeduction'] = implode(',', $FinalExtraDeduction);
							  if(!empty($TotalExtraDeduction)){
							  $FinalEmpDetail['TotalExtraDeduction'] = $TotalExtraDeduction;
							  }
							  else{
								  $FinalEmpDetail['TotalExtraDeduction'] = '0.00';
							  }
							  if( $NetSalary == 0){
								  $FinalEmpDetail['NetSalary'] = 0;
							  }else{
							 $FinalEmpDetail['NetSalary'] = $FinalEmpDetail['PayableGrossSalary'] - ($FinalEmpDetail['TotalDeductionEP'] + $TotalExtraDeduction);
							  }
							
							  for($i=0; $i < count($getdeduction); $i++){
								  
									 if($getdeduction[$i]['deduction_applied_on']=='-3'){ 
									 if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
											}
									 }
									 else{
										 $FinalEmpDetail['DeductionOnNetSalary'] =0;
										 $FinalEmpDetail['DeductionAmountOnNetSalary']='0.00';
										 $FinalEmpDetail['FinalNetSalary'] ='0.00';
									 }
									if($FinalEmpDetail['FinalNetSalary']=='0.00'){
										$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['NetSalary'];
										}
										else{
											$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['FinalNetSalary'];
											}
											///echo var_dump($getdeduction[$i]['deduction_applied_on']); exit;
									if($getdeduction[$i]['deduction_applied_on']=='-4'){
									  if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													

												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
												
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
											}
											}
										
									  }
									else{
										$FinalEmpDetail['DeductionOnTakeHomeSalary'] =0;
										$FinalEmpDetail['DeductionAmountOnTakeHomeSalary']='0.00';
										$FinalEmpDetail['FinalTakeHomeSalary'] = '';
									}
									  if($FinalEmpDetail['FinalTakeHomeSalary']==''){
										  $FinalEmpDetail['FinalTakeHomeSalary'] = $FinalEmpDetail['TakeHomeSalary'];
									  }
									  
									  
							  }
							  
							 
							 
							
							  
							  
							$FinalEmpDetail['CTC'] = $FinalEmpDetail['NetSalary'] + $FinalEmpDetail['TotalDeductionER'];
							
							
							
							
							
							
							 if($checksalarydata==null){
							$FinalEmpDetail['company_id'] 	= $this->session->userdata('company_id');
							$FinalEmpDetail['branch_id'] 	= $this->session->userdata('branch_id');
							$FinalEmpDetail['createdon']  	= date_timestamp_get(date_create());
							$FinalEmpDetail['createdby'] 	= $this->session->userdata('loginid');
								$insert = $this->CommanModel->InsertData('tbl_salary',$FinalEmpDetail);
										if($insert){
											if($EMISTATUS == true){
											$updat_emi_status['emi_payable_id'] = $insert; 
											$updatetemi = $this->CommanModel->UpdateData('tbl_loan_details', $updat_emi_status, array('id'=>$updateemiId));	
												
											}
											if($isLoanAdvance == true){
											for($i=0; $i < count($updateAdvance); $i++){
												$updateextradedution['due'] = $updateAdvance[$i]['due'];
												$updateextradedution['paid'] = $updateAdvance[$i]['paid'];
												$updateextradedution['status'] = $updateAdvance[$i]['status'];
												$updatetbal = $this->CommanModel->UpdateData('tbl_loan_advance_details',$updateextradedution, array('id'=>$updateAdvance[$i]['id']));
											}
											if(!empty($ExtraDeductionTrans)){
											for($i=0; $i < count($ExtraDeductionTrans); $i++){
												$ExtraDeductionTrans[$i][$clientid]['payable_id'] = $insert;
												$extraupdatetbal = $this->CommanModel->InsertData('tbl_extradeduction_trans',$ExtraDeductionTrans[$i][$clientid]);
											}}
											}
											redirect('branchadmin/Employee/printSalary/'.$insert);
										}
								 }
							else{
									
							$FinalEmpDetail['updatedon'] = date_timestamp_get(date_create());
							$FinalEmpDetail['updatedby'] = $this->session->userdata('loginid'); 
									$update = $this->CommanModel->UpdateData('tbl_salary',$FinalEmpDetail, array('id'=>$checksalarydata['id']));
									if($update){
										if($isLoanAdvance == true){
											for($i=0; $i < count($updateAdvance); $i++){
												$updateextradedution['due'] = $updateAdvance[$i]['due'];
												$updateextradedution['paid'] = $updateAdvance[$i]['paid'];
												$updateextradedution['status'] = $updateAdvance[$i]['status'];
												$updatetbal = $this->CommanModel->UpdateData('tbl_loan_advance_details',$updateextradedution, array('id'=>$updateAdvance[$i]['id']));
											}
											if($ExtraDeductionTrans[0]['id']!=''){
											for($i=0; $i < count($ExtraDeductionTrans); $i++){
												
												$extraupdatetbal = $this->CommanModel->InsertData('tbl_extradeduction_trans',$ExtraDeductionTrans[$i]);
											}}
											if($UExtraDeductionTrans[0]['id']!=''){
											for($i=0; $i < count($UExtraDeductionTrans); $i++){
												$UExtraDeductionTrans[$i]['id'];
											  $uudateextra['loan_approved'] = $UExtraDeductionTrans[$i]['loan_approved'];
											  $uudateextra['due'] = $UExtraDeductionTrans[$i]['due'];
											  $uudateextra['paid'] = $UExtraDeductionTrans[$i]['paid'];
											  $uudateextra['updatedon'] = $UExtraDeductionTrans[$i]['updatedon'];
											  $uudateextra['updatedby'] = $UExtraDeductionTrans[$i]['updatedby'];
												$extraupdatetbal = $this->CommanModel->UpdateData('tbl_extradeduction_trans',$uudateextra, array('id'=>$UExtraDeductionTrans[$i]['id']));
													}
													}
											}
										redirect('branchadmin/Employee/printSalary/'.$checksalarydata['id']);
									}
									 
								 }
							  ///echo var_dump($FinalEmpDetail); 
							  
							  //$this->session->set_userdata('salarydata', $FinalEmpDetail);
							  
					
					  	
					  }
						
				  }
				  	///// Bulk Salary Generation
					
					if($emp_id == '-1'){
						$FinalEmpDetail='';
						$emplist = $data['empList'];
						foreach($emplist as $emp){
							
							$emp_id = $emp['id'];
						$checksalarydata = $this->CommanModel->getDataIfdataexists('id', 'tbl_salary', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));	
					  $attandanceData = $this->CommanModel->getDataIfdataexists('*', 'tbl_attendance', array('emp_id'=>$emp_id,'year_v'=>$year,'month_v'=>$month));
					  $monthdetail = $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
					  $getempPData = $this->CommanModel->getDataIfdataexists('id,emp_code,emp_name', 'tbl_employee', array('id'=>$emp_id));
					  $getempData = $this->CommanModel->getDataIfdataexists('*', 'tbl_employee_official', array('emp_id'=>$emp_id));
					  
					  $NoofDaysInmonth = $monthdetail['NoOfDays'];
					  $startmotnthdate = $year.'-'.$month.'-'. 01;
					  $endmotnthdate = $year.'-'.$month.'-'. $NoofDaysInmonth;
					  ///exit;
					  //echo var_dump($monthdetail); exit;
					/// echo var_dump($attandanceData); exit;
					  if($attandanceData!=NULL && $attandanceData['locked_status']=='1'){
						$p=''; $w=''; $a='';
						 			if((strtotime($startmotnthdate) <= strtotime($getempData['doj'])) && (strtotime($getempData['doj']) <= strtotime($endmotnthdate))){
										
									$joindate = explode('-', $getempData['doj']);	
										
									for($i=(int)$joindate[2]; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
										
										
									
										}
									}else{
										for($i=1; $i <=$NoofDaysInmonth; $i++){
										if($attandanceData['day'.$i]!=''){
											if($attandanceData['day'.$i]=='P'){ $p[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='W'){ $w[]=$attandanceData['day'.$i];}
											if($attandanceData['day'.$i]=='A'){ $a[]=$attandanceData['day'.$i];}
										}
										
										
									
										}
									}
								
					  	
					  
					  $FinalEmpDetail['year_v'] = $year;
					  $FinalEmpDetail['month_v'] = $month;
					  $FinalEmpDetail['emp_code'] = $getempPData['emp_code'];
					  $FinalEmpDetail['emp_id'] = $emp_id;
					  $FinalEmpDetail['PresentDay'] =count($p);
					  $FinalEmpDetail['WeekOffDay'] =count($w);
					  $FinalEmpDetail['salary_type'] = 2;
					  $FinalEmpDetail['AbsentDay'] =count($a);
					  $FinalEmpDetail['OTDay'] = (float)$attandanceData['ot_days'];
					//echo var_dump($FinalEmpDetail); exit;
								
					  if($getempData['salary_type'] = 'AsPerEmployee'){
					  $getsalarySt = $this->CommanModel->getDataIfdataexists('*', 'tbl_gradebase_salary', array('grade_id'=>$getempData['grade'],
					  'department_id'=>$getempData['department'],'designation_id'=>$getempData['designation'],'company_id'=>$this->session->userdata('company_id'),
					  'branch_id'=>$this->session->userdata('branch_id')));
					 
						  if($getsalarySt!=null){
							  $allowance = $getsalarySt['allowance'];
							  
							  $deduction = $getsalarySt['deduction_id'];
							  
							  $FinalEmpDetail['BasicSalary'] = (float)$getsalarySt['basic_salary'];
							  $FinalEmpDetail['PayableBasicSalary'] = round($FinalEmpDetail['BasicSalary'] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
								
								$CurrentAllowance=''; $PayableAllowance='';$totalallwance=''; $totalallwancepayable=''; $allwance='';$income='';
								if(!empty($allowance)){
									
									  $allowance = explode(',',$allowance);
								  for($i=0; $i < count($allowance); $i++){
									  $income = explode('-', $allowance[$i]);
									  $getalltype = $this->CommanModel->getDataIfdataexists('mode_of_payment', 'tbl_allowance', array('id'=>$income[0]));
									  if($getalltype['mode_of_payment']=='1'){
										  $totalallwance += (float)$income[1];
										  $totalallwancepayable += (float)$income[1];
										 $CurrentAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.(float)$income[1].':'.$getalltype['mode_of_payment'];
										 }
										 if($getalltype['mode_of_payment']=='0'){
										$totalallwance += (float)$income[1];
										  $allwance = round($income[1] / $NoofDaysInmonth * $FinalEmpDetail['PresentDay']);
										  $totalallwancepayable += $allwance;
										  $CurrentAllowance[] = $income[0].':'.$income[1].':'.$getalltype['mode_of_payment'];
										 $PayableAllowance[] = $income[0].':'.$allwance.':'.$getalltype['mode_of_payment'];
										 }
										 
										 
								  }
								  $FinalEmpDetail['CurrentAllowance'] = implode(',', $CurrentAllowance);
								 $FinalEmpDetail['PayableAllowance'] = implode(',', $PayableAllowance);
								 $FinalEmpDetail['TotalAllowance'] = $totalallwancepayable;
								  }
								  else{
									  $FinalEmpDetail['CurrentAllowance'] = '';
								 $FinalEmpDetail['PayableAllowance'] = '';
								 $FinalEmpDetail['TotalAllowance'] = 0;
								  }
								
								  
								  $FinalEmpDetail['GrossSalary'] = $FinalEmpDetail['BasicSalary'] + $totalallwance; 
								  
							 if($FinalEmpDetail['OTDay']!=0){
									  $FinalEmpDetail['OTDayAmount'] = round($FinalEmpDetail['GrossSalary'] / $NoofDaysInmonth * $FinalEmpDetail['OTDay']);
									  
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'] + $FinalEmpDetail['OTDayAmount'];
								  }
								  else{
									  $FinalEmpDetail['PayableGrossSalary'] = $FinalEmpDetail['PayableBasicSalary'] + $FinalEmpDetail['TotalAllowance'];
								  }
							 $CurrentDeduction='';
								$ApplyDeduction='';
							  if($deduction!=null){
								  $CurrentDeduction ='';
								  $ApplyDeduction ='';
								  $calculateddeduction1 ='';
								  $calculateddeduction2='';
								  $firstdeduction='';
								  $seconddeduction='';
								  $deduction = explode(',',$deduction);
								  $getdeduction = $this->CommanModel->getListWhereIn('*', 'tbl_deduction_head', 'id', 'ASC', $deduction);
								  for($i=0; $i < count($getdeduction); $i++){
									  if($getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
									  
									  if($getdeduction[$i]['type_of_deduction']==='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
													else{
													$calculateddeduction1 = round($FinalEmpDetail['PayableBasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableBasicSalary'] * $seconddeduction / 100);
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$calculateddeduction1 = ceil($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = ceil($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}else{
															$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
														}
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
														if($getdeduction[$i]['deduction_head']=='ESIC'){
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = ceil($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = ceil($AllwancedeductonGross * $seconddeduction / 100);
														}else{
															$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
														}
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['BasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
									  }
									  
									  if($getdeduction[$i]['type_of_deduction']==='Temperary'){
										  $todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												$CurrentDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':-2:'.round($getdeduction[$i]['employee_contribution']).'@'.$getdeduction[$i]['employee_contribution'].':'.round($getdeduction[$i]['employer_contribution']).'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 
												if($getdeduction[$i]['deduction_applied_on']=='-1'){
													
													if($getdeduction[$i]['deduction_head']=='EPF'){
														
														if($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
														
														if($FinalEmpDetail['BasicSalary'] >= $getdeduction[$i]['max_salary_limit']){
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
														$FinalEmpDetail['BasicSalary'] = $getdeduction[$i]['max_salary_limit'];
														}else{
														$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];	
														}
													$calculateddeduction1 = round($FinalEmpDetail['BasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['BasicSalary'] * $seconddeduction / 100);
													
													$totald = $calculateddeduction1;
													}
													}
													else{
														$calculateddeduction1 = round($FinalEmpDetail['BasicSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['BasicSalary'] * $seconddeduction / 100);
													$FinalEmpDetail['PayableBasicSalary'] = $FinalEmpDetail['BasicSalary'];
													$totald = $calculateddeduction1;
													}
												}
												if($getdeduction[$i]['deduction_applied_on']=='-2'){
													
													if($getdeduction[$i]['deduction_not_applied_on']==0 || $getdeduction[$i]['deduction_not_applied_on']=='0'){
													$calculateddeduction1 = round($FinalEmpDetail['PayableGrossSalary'] * $firstdeduction / 100);
													$calculateddeduction2 = round($FinalEmpDetail['PayableGrossSalary'] * $seconddeduction / 100);
													}
													else{
														$deduction_not_on = $getdeduction[$i]['deduction_not_applied_on'];
														$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$deduction_not_on){
																$AmountdeductionOnGross = $notappled[1];
															}
															
														}
													$AllwancedeductonGross = $FinalEmpDetail['PayableGrossSalary'] -  $AmountdeductionOnGross;
													$calculateddeduction1 = round($AllwancedeductonGross * $firstdeduction / 100);
													$calculateddeduction2 = round($AllwancedeductonGross * $seconddeduction / 100);
													}
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['deduction_applied_on']!='-1' && $getdeduction[$i]['deduction_applied_on']!='-2' && $getdeduction[$i]['deduction_applied_on']!='-3' && $getdeduction[$i]['deduction_applied_on']!='-4'){
													
													$getall = explode(',', $FinalEmpDetail['PayableAllowance']);
														foreach($getall as $k=>$va){
															$notappled = explode(':', $va);
															if($notappled[0]==$getdeduction[$i]['deduction_applied_on']){
																$deductiononallowance = $notappled[1];
															}
															
														}
													
													$calculateddeduction1 = round($deductiononallowance * $firstdeduction / 100);
													$calculateddeduction2 = round($deductiononallowance * $seconddeduction / 100);
													$totald = $calculateddeduction1;
												}
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction && $FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['PayableGrossSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($getdeduction[$i]['deduction_head']=='EPF'){
													//echo var_dump($getdeduction[$i]['id']);
													if($FinalEmpDetail['PayableBasicSalary'] >= $maxdeduction){
														$deductionAllowedongross = true;
														//echo 'ok';
													}
													else{
														//echo 'no';
														$deductionAllowedongross = true;
													}
												}
												else{
													
												if($FinalEmpDetail['PayableGrossSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												}
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$CurrentDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$ApplyDeduction[] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												
												}
											}
											}
									  }
									  
								  }
								  }
								  }
							  }
							  $FinalEmpDetail['CurrentDeduction'] = implode(',', $CurrentDeduction);
							  $FinalEmpDetail['ApplyDeduction'] = implode(',', $ApplyDeduction);
							  $FinalEmpDetail['TotalDeductionEP'] = 0;
							$FinalEmpDetail['TotalDeductionER'] = 0;
							  foreach($ApplyDeduction as $dedkey=>$deduva){
								  $fd = explode(':', $deduva);
								  //echo var_dump((float)$fd[2]);
								  $FinalEmpDetail['TotalDeductionEP'] += (float)$fd[2];
								  
									$FinalEmpDetail['TotalDeductionER'] += (float)$fd[3];
								  
								  }
							  
							  $NetSalary = $FinalEmpDetail['PayableGrossSalary'] - $FinalEmpDetail['TotalDeductionEP'];
							  
							   $updateAdvance=''; $ExtraDeductionTrans=''; $FinalExtraDeduction='';$TotalExtraDeduction='';
							  if($checksalarydata==null){
								$extradeductionList = $this->CommanModel->getListWhere('*', 'tbl_loan_advance_details', 'id', 'ASC', array('emp_id'=>$emp_id,'status'=>0, 'year_v <='=>$year,'month_v <='=>$month,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
							  	
								if(!empty($extradeductionList)){
									$isLoanAdvance = true;
									for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 if((float)$checkloanAdvance['due'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['due'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = 0;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$checkloanAdvance['due'];
											  $NetSalary = $NetSalary - (float)$checkloanAdvance['due'];
											  $TotalExtraDeduction +=  (float)$checkloanAdvance['due'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1; 
												  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
												  if($checkloanAdvance['month_v'] == '12'){
												  $updateAdvance[$i]['month_v'] = $checkloanAdvance['month_v'] ;
												  $updateAdvance[$i]['year_v'] = (int)$checkloanAdvance['year_v'] + 1;
												  }
												  else{
													  $updateAdvance[$i]['month_v'] = (int)$checkloanAdvance['month_v'] + 1;
												  }
											  }
											 
											$ExtraDeductionTrans[$i]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i]['month_v'] = $month;
											$ExtraDeductionTrans[$i]['year_v'] = $year;
											$ExtraDeductionTrans[$i]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i]['createdby'] = $this->session->userdata('loginid');
										 }
										 elseif((float)$checkloanAdvance['due'] > $NetSalary && $NetSalary!=0){
											// echo $NetSalary.'<br>';
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.$NetSalary;
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  $updateAdvance[$i]['due'] = (float)$checkloanAdvance['due'] - $NetSalary;
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + $NetSalary;
											  
											  $TotalExtraDeduction +=  $NetSalary;
											  $NetSalary = 0;
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											$ExtraDeductionTrans[$i]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i]['month_v'] = $month;
											$ExtraDeductionTrans[$i]['year_v'] = $year;
											$ExtraDeductionTrans[$i]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i]['paid'] = $NetSalary;
											$ExtraDeductionTrans[$i]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i]['createdby'] = $this->session->userdata('loginid');
										 }
												  
									 }
									
									 if($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$emidetail = $this->CommanModel->getListWhereLimit('*', 'tbl_loan_details', 'id', 'ASC', array('row_id'=>$checkloanAdvance['id'], 'emi_status'=>'0'), 1);
							  			}
										$EMISTATUS = true;
										 if((float)$emidetail[0]['emi_amount'] <= $NetSalary && $NetSalary!=0){
											 ///echo $NetSalary.'<br>';
											 
											  $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$emidetail[0]['id'].':'.$emidetail[0]['emi_amount'];
											  $updateAdvance[$i]['id'] = $checkloanAdvance['id'];
											  if($checkloanAdvance['emi_no'] != $emidetail[0]['no_of_emi']){
											  $updateAdvance[$i]['due'] = $checkloanAdvance['due'] - $emidetail[0]['emi_amount'];
											  }
											  elseif($checkloanAdvance['emi_no'] == $emidetail[0]['no_of_emi']){
												 $updateAdvance[$i]['due'] = 0; 
											  }
											  $updateAdvance[$i]['paid'] = (float)$checkloanAdvance['paid'] + (float)$emidetail[0]['emi_amount'];
											  $NetSalary = $NetSalary - (float)$emidetail[0]['emi_amount'];
											  $TotalExtraDeduction +=  (float)$emidetail[0]['emi_amount'];
											  if($updateAdvance[$i]['due']==0){
												 $updateAdvance[$i]['status'] = 1;  
											  }
											  else{
												  $updateAdvance[$i]['status'] = 0;
											  }
											 $updateemiId = $emidetail[0]['id'];
											 $updat_emi_status['emi_status'] = 1; 
											$ExtraDeductionTrans[$i]['company_id'] = $this->session->userdata('company_id');
											$ExtraDeductionTrans[$i]['branch_id'] = $this->session->userdata('branch_id');
											$ExtraDeductionTrans[$i]['extradeduction_id'] = $updateAdvance[$i]['id'];
											$ExtraDeductionTrans[$i]['month_v'] = $month;
											$ExtraDeductionTrans[$i]['year_v'] = $year;
											$ExtraDeductionTrans[$i]['loan_type'] = $checkloanAdvance['loan_type'];
											$ExtraDeductionTrans[$i]['emp_id'] = $emp_id;
											$ExtraDeductionTrans[$i]['loan_approved'] = $checkloanAdvance['loan_approved'];
											$ExtraDeductionTrans[$i]['due'] = $updateAdvance[$i]['due'];
											$ExtraDeductionTrans[$i]['paid'] = $updateAdvance[$i]['paid'];
											$ExtraDeductionTrans[$i]['emi_id'] = $emidetail[0]['id'];
											$ExtraDeductionTrans[$i]['createdon'] = date_timestamp_get(date_create());
											$ExtraDeductionTrans[$i]['createdby'] = $this->session->userdata('loginid');
										 }
										 
												  
									 }
									
									}
									
									
								}
							  
							  }
							  elseif($checksalarydata['id']!=''){
								$extradeductionList = $this->CommanModel->getListWhere('id,extradeduction_id,loan_type,emp_id,loan_approved,due,paid,emi_id', 'tbl_extradeduction_trans', 'id', 'ASC', array('emp_id'=>$emp_id, 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'), 'payable_id'=>$checksalarydata['id']));  
							  	for($i=0; $i< count($extradeductionList); $i++){
									  
									  $checkloanAdvance = $extradeductionList[$i];
									  
									 if($checkloanAdvance['loan_type']!='0'){
										 $FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':0:'.(float)$checkloanAdvance['paid'];
										 $TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
									 }
									 elseif($checkloanAdvance['loan_type']=='0'){
										 if($checkloanAdvance['emi_no']!='0'){
							  			$FinalExtraDeduction[] = $checkloanAdvance['id'].':'.$checkloanAdvance['loan_type'].':'.$checkloanAdvance['emi_id'].':'.(float)$checkloanAdvance['paid'];
										$TotalExtraDeduction +=  (float)$checkloanAdvance['paid'];
										}
										
									 }
									 
								}
							  }
							  	//var_dump($FinalExtraDeduction);  
								//var_dump($extradeductionList);		  
							 	//var_dump($ExtraDeductionTrans);
							 //var_dump($UExtraDeductionTrans);
							//var_dump($updateAdvance);
							  $FinalEmpDetail['ExtraDeduction'] = implode(',', $FinalExtraDeduction);
							  if(!empty($TotalExtraDeduction)){
							  $FinalEmpDetail['TotalExtraDeduction'] = $TotalExtraDeduction;
							  }
							  else{
								  $FinalEmpDetail['TotalExtraDeduction'] = '0.00';
							  }
							  if( $NetSalary == 0){
								  $FinalEmpDetail['NetSalary'] = 0;
							  }else{
							 $FinalEmpDetail['NetSalary'] = $FinalEmpDetail['PayableGrossSalary'] - ($FinalEmpDetail['TotalDeductionEP'] + $TotalExtraDeduction);
							  }
							  
							  /*if($FinalEmpDetail['emp_code']=='5'){
								  
								  var_dump($FinalEmpDetail); exit;
							  }*/
							  
							  for($i=0; $i < count($getdeduction); $i++){
									 if($getdeduction[$i]['deduction_applied_on']=='-3'){ 
									 if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
											
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['NetSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['NetSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction && $FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['NetSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$Takehomesal = $FinalEmpDetail['NetSalary'] - $calculateddeduction1;
												$FinalEmpDetail['DeductionOnNetSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnNetSalary'] = $calculateddeduction1;
												$FinalEmpDetail['FinalNetSalary'] = $Takehomesal;
												}
												
												}
											}
											}
									 }
									 else{
										 $FinalEmpDetail['DeductionOnNetSalary'] ='';
										 $FinalEmpDetail['DeductionAmountOnNetSalary']='0.00';
										 $FinalEmpDetail['FinalNetSalary'] ='0.00';
									 }
									if($FinalEmpDetail['FinalNetSalary']=='0.00'){
										$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['NetSalary'];
										}
										else{
											$FinalEmpDetail['TakeHomeSalary'] = $FinalEmpDetail['FinalNetSalary'];
											}
											///echo var_dump($getdeduction[$i]['deduction_applied_on']); exit;
									if($getdeduction[$i]['deduction_applied_on']=='-4'){
									  if($getdeduction[$i]['type_of_deduction']=='Regular'){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
												
											}
									if($getdeduction[$i]['type_of_deduction']=='Temperary'){
										$todate = date("Y-m-d");
										  	if($getdeduction[$i]['date_from'] <= $todate && $todate <= $getdeduction[$i]['date_to']){
									 		if($getdeduction[$i]['mode_of_deduction']=='Fixed'){
												
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$totald = $firstdeduction + $seconddeduction;
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$getdeduction[$i]['employee_contribution'].'@'.$getdeduction[$i]['employee_contribution'].':'.$getdeduction[$i]['employer_contribution'].'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $getdeduction[$i]['employee_contribution'];
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
											if($getdeduction[$i]['mode_of_deduction']=='Calculated'){
												if($getdeduction[$i]['deduction_applied_on']=='-4'){
												if($getdeduction[$i]['employee_contribution']!='0.00'){
												$firstdeduction = $getdeduction[$i]['employee_contribution'];
												}else{ $firstdeduction = 0;}
												if($getdeduction[$i]['employer_contribution']!='0.00'){
												$seconddeduction = $getdeduction[$i]['employer_contribution'];
												}else{ $seconddeduction = 0;}
												
												$calculateddeduction1=0; 
												 $calculateddeduction2=0;
												 $calculateddeduction1 = round($FinalEmpDetail['TakeHomeSalary'] * $firstdeduction / 100);
												$calculateddeduction2 = round($FinalEmpDetail['TakeHomeSalary'] * $seconddeduction / 100);
												
												
												$totald = $calculateddeduction1;
												
												
												if($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												
												if($totald >= $mindeduction && $totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']!='0.00' && $getdeduction[$i]['max_deduction_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_deduction_limit'];
												
												
												if($totald >= $mindeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												elseif($getdeduction[$i]['min_deduction_limit']=='0.00' && $getdeduction[$i]['max_deduction_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_deduction_limit'];
												if($totald <= $maxdeduction){
														$deductionAllowed = true;
												}
												else{
														$deductionAllowed = false;
													}
												
												}
												else{
														$deductionAllowed = true;
													}
													
												if($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction && $FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']!='0.00' && $getdeduction[$i]['max_salary_limit']=='0.00'){
												$mindeduction = (float)$getdeduction[$i]['min_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] >= $mindeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												elseif($getdeduction[$i]['min_salary_limit']=='0.00' && $getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxdeduction = (float)$getdeduction[$i]['max_salary_limit'];
												
												
												if($FinalEmpDetail['TakeHomeSalary'] <= $maxdeduction){
														$deductionAllowedongross = true;
												}
												else{
														$deductionAllowedongross = false;
													}
												
												}
												else{
													
													$deductionAllowedongross = true;
													}
													
												
												if($getdeduction[$i]['min_salary_limit']!='0.00'){
												$minsalarylimit = $getdeduction[$i]['min_salary_limit'];
												}else{ $minsalarylimit = 0;}
												if($getdeduction[$i]['max_salary_limit']!='0.00'){
												$maxsalarylimit = $getdeduction[$i]['max_salary_limit'];
												}else{ $maxsalarylimit = 0;}
												
												
												
												if($deductionAllowed == true && $deductionAllowedongross == true){
												
												
												$FinalEmpDetail['DeductionOnTakeHomeSalary'] = $getdeduction[$i]['id'].':'.$getdeduction[$i]['deduction_applied_on'].':'.$calculateddeduction1.'@'.$getdeduction[$i]['employee_contribution'].':'.$calculateddeduction2.'@'.$getdeduction[$i]['employer_contribution'].':'.$getdeduction[$i]['type_of_deduction'].':'.$getdeduction[$i]['mode_of_deduction'];
												$FinalEmpDetail['DeductionAmountOnTakeHomeSalary'] = $calculateddeduction1;
												$FTakehomesal = $FinalEmpDetail['TakeHomeSalary'] - $calculateddeduction1;
												$FinalEmpDetail['FinalTakeHomeSalary'] = $FTakehomesal;
												}
												
												}
												
											}	
											}
											}
										
									  }
									else{
										$FinalEmpDetail['DeductionOnTakeHomeSalary'] ='';
										$FinalEmpDetail['DeductionAmountOnTakeHomeSalary']='0.00';
										$FinalEmpDetail['FinalTakeHomeSalary'] = '';
									}
									  if($FinalEmpDetail['FinalTakeHomeSalary']==''){
										  $FinalEmpDetail['FinalTakeHomeSalary'] = $FinalEmpDetail['TakeHomeSalary'];
									  }
									  
									  
							  }
							  
							$FinalEmpDetail['CTC'] = $FinalEmpDetail['NetSalary'] + $FinalEmpDetail['TotalDeductionER'];
							/*if($emp_id == '41'){
							echo var_dump($FinalEmpDetail); exit;
							}*/
							
							 if($checksalarydata==null){
							$FinalEmpDetail['company_id'] 			= $this->session->userdata('company_id');
							$FinalEmpDetail['branch_id'] 				= $this->session->userdata('branch_id');
							$FinalEmpDetail['createdon'] = date_timestamp_get(date_create());
							$FinalEmpDetail['createdby'] = $this->session->userdata('loginid');
								$insert = $this->CommanModel->InsertData('tbl_salary',$FinalEmpDetail);
										if($insert){
											if($EMISTATUS == true){
											$updat_emi_status['emi_payable_id'] = $insert; 
											$updatetemi = $this->CommanModel->UpdateData('tbl_loan_details', $updat_emi_status, array('id'=>$updateemiId));	
												
											}
											if($isLoanAdvance == true){
											for($i=0; $i < count($updateAdvance); $i++){
												$updateextradedution['due'] = $updateAdvance[$i]['due'];
												$updateextradedution['paid'] = $updateAdvance[$i]['paid'];
												$updateextradedution['status'] = $updateAdvance[$i]['status'];
												$updatetbal = $this->CommanModel->UpdateData('tbl_loan_advance_details',$updateextradedution, array('id'=>$updateAdvance[$i]['id']));
											}
											if(!empty($ExtraDeductionTrans)){
											for($i=0; $i < count($ExtraDeductionTrans); $i++){
												$ExtraDeductionTrans[$i]['payable_id'] = $insert;
												$extraupdatetbal = $this->CommanModel->InsertData('tbl_extradeduction_trans',$ExtraDeductionTrans[$i]);
											}}
											}
											 $generatesalary = TRUE;
										}
										else
										{
											$generatesalary = FALSE;
											
											}
								 }
								 else{
									
							$FinalEmpDetail['updatedon'] = date_timestamp_get(date_create());
							$FinalEmpDetail['updatedby'] = $this->session->userdata('loginid'); 
									$update = $this->CommanModel->UpdateData('tbl_salary',$FinalEmpDetail, array('id'=>$checksalarydata['id']));
									if($update){
										$generatesalary = TRUE;
									}
									else
										{
											$generatesalary = FALSE;
											
											}
									 
								 }
								 
								 
								 
								 
							  ///echo var_dump($FinalEmpDetail); 
							  
							  //$this->session->set_userdata('salarydata', $FinalEmpDetail);
							  
					
					  	
					  }
					  
						}
				  }
				  if($generatesalary = TRUE){
									$this->session->set_flashdata('msg', '<div class="alert alert-success">Bulk Salary Generation Successfull.</div>');
									redirect('Reports/ListOfSalary');
								 }
								 else
								 {
									 $this->session->set_flashdata('msg', '<div class="alert alert-warning">Bulk Salary Generation Unsuccessfull.</div>');
									redirect('branchadmin/Employee/generateSalary');
									 }
					}
				  //endhere
			  }
			  }
		 }
		 
		 else{
		
				redirect('web/index');	
		} 
	 }
	 
	 public function printSalary($id)
    {
		
		    $FinalEmpDetail['title'] 	 = 'Branchadmin | Employee';
			$FinalEmpDetail['content'] = 'branchadmin/employee/PrintSalarySlip';
			$FinalEmpDetail['salarydata'] = $this->CommanModel->getDataIfdataexists('*', 'tbl_salary', array('id'=>$id));
			$emp_id = $FinalEmpDetail['salarydata']['emp_id'];
			//echo var_dump($FinalEmpDetail['salarydata']); exit;
			$getempPData = $this->CommanModel->getDataIfdataexists('emp_code,emp_name,father_name', 'tbl_employee', array('id'=>$emp_id));
			$getempData = $this->CommanModel->getDataIfdataexists('*', 'tbl_employee_official', array('emp_id'=>$emp_id));
			
			$getGrade = $this->CommanModel->getDataIfdataexists('grade_name', 'tbl_grade', array('id'=>$getempData['grade']));
			$getDepartment = $this->CommanModel->getDataIfdataexists('department_name', 'tbl_department', array('id'=>$getempData['department']));
			$getDesignation = $this->CommanModel->getDataIfdataexists('designation_name', 'tbl_designation', array('id'=>$getempData['designation']));
			$FinalEmpDetail['salarydata']['Grade_name'] = $getGrade['grade_name'];	
			$FinalEmpDetail['salarydata']['department'] = $getDepartment['department_name'];
			$FinalEmpDetail['salarydata']['designation'] = $getDesignation['designation_name'];  
			$FinalEmpDetail['salarydata']['pfid']=$getempData['pf_id']; 
			$FinalEmpDetail['salarydata']['esicid']=$getempData['esic_id']; 
			$FinalEmpDetail['salarydata']['account']=$getempData['account_no'];
			$FinalEmpDetail['salarydata']['doj']=$getempData['doj']; 
			$FinalEmpDetail['salarydata']['name']=$getempPData['emp_name'];
			$FinalEmpDetail['salarydata']['father_name']=$getempPData['father_name'];
			 
			$this->load->view($this->layout, $FinalEmpDetail);
	   
	}
	
	
}
