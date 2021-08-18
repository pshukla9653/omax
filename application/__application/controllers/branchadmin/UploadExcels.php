<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class UploadExcels extends Mycontroller{ 

    public function __construct(){
     		
        parent::__construct();
        $this->load->library('mycalendar');  // load mycalendar library
        
   }

   public function clientList(){
    if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
        $data['title'] 	 = 'Branchadmin | Shift';
        $data['content'] = 'branchadmin/setting/clientList';
        
        $this->load->view($this->layout, $data);
         }
     
     }
     // download excel
     public function clientexportexcel(){
        redirect('uploads/excel/clientExcel.xls');
        }

        // upload client excel

        public function uploadClient()
	    {
		
		                	$config['upload_path'] = 'uploads/excel/';
							$config['allowed_types'] = 'xls|csv';
							$config['max_size'] = '0';
							$config['max_filename'] = '0';
							$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
							$file = array();
							$is_file_error = FALSE;
							if (!$is_file_error) 
							{
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('excel')) 
										{
												$error = array('error' => $this->upload->display_errors());
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
												redirect('branchadmin/UploadExcels/clientList');	
												$is_file_error = TRUE;
						                } 
										else 
										{
												$file = $this->upload->data();
												$data = $this->import_excel($file['full_path']);
								
												$check= array("A" => "Sr.No.","B" => "Industry","C" => "Name of the Company/Firm/Client","D" => "PAN No.","E" => "Tax Deduction A/c or GSTIN No.","F" => "Contact Person Name","G" => "Contact Person Mobile","H" => "Contact Person Email","I" => "Company/Firm Reg. No.","J" => "Licence Number","K" => "Address","L" => "Country","M" => "State","N" => "City","O" => "Pincode","P" => "Service Charge (Percentage)","Q" => "Status","R" => "EPF","S" => "ESIC","T" => "CGST","U" => "SGST","V" => "IGST","W" => "On UP GST" );
										
												if($data['header'][1]===$check)
												{
													
														foreach($data['values'] as $xdata)
														{	
																if(preg_match('/^[a-zA-Z .]{2,300}$/', $xdata['C']))
																 {
																	 
																	   if(preg_match('/^[0-9]{5,5}$/', $xdata['E']) || $xdata['E'] =='')
																	   {
																		    if(preg_match('/^[A-Z]{5,5}[0-9]{4,4}[A-Z]$/', $xdata['D']) || $xdata['D'] =='' )
																			{
																			   if(preg_match('/^[a-zA-Z .]{1,}$/', $xdata['F']))
																			   {
																				  if(preg_match('/^[7-9][0-9]{9,9}$/', $xdata['G']))
																				  {
																					 if(filter_var($xdata['H'], FILTER_VALIDATE_EMAIL))
																					 {
                                                                                        
                                                                                            if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('client_name'=>$xdata['C'])) == FALSE)
                                                                                            {
                                                                                                if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('client_regi_no'=>$xdata['I'])) == FALSE)
                                                                                                {
                                                                                                    if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('pan_cord_no'=>$xdata['D'])) == FALSE)
                                                                                                    {
																										if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('contact_person_name'=>$xdata['F'])) == FALSE)
																										{
																											if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('contact_person_mobile'=>$xdata['G'])) == FALSE)
																											{
																												if($this->CommanModel->Ifdataexists('*', 'tbl_client', array('contact_person_email'=>$xdata['H'])) == FALSE)
																												{
																														$check=true;
																												}
																												else
																												{
																													unlink($file['full_path']);
																													$this->session->set_flashdata('msg', '<div class="alert alert-danger">contect person email "'.$xdata['H'].'" already available.At serial No."'.$xdata['A'].'"</div>');
																													redirect('branchadmin/UploadExcels/clientList');
																												}
																											}
																											else
																											{
																												unlink($file['full_path']);
																												$this->session->set_flashdata('msg', '<div class="alert alert-danger">contect person mobile "'.$xdata['G'].'" already available.At serial No."'.$xdata['A'].'"</div>');
																												redirect('branchadmin/UploadExcels/clientList');
																											}
																										}
																										else
																										{
																											unlink($file['full_path']);
																											$this->session->set_flashdata('msg', '<div class="alert alert-danger">contact person name "'.$xdata['F'].'" already available.At serial No."'.$xdata['A'].'"</div>');
																											redirect('branchadmin/UploadExcels/clientList');
																										}
                                                                                                    }   
                                                                                                    else
                                                                                                    {
                                                                                                        unlink($file['full_path']);
                                                                                                        $this->session->set_flashdata('msg', '<div class="alert alert-danger">PANCARD number "'.$xdata['D'].'" already available.At serial No."'.$xdata['A'].'"</div>');
                                                                                                        redirect('branchadmin/UploadExcels/clientList');
                                                                                                    }   
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    unlink($file['full_path']);
                                                                                                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">client registration number "'.$xdata['I'].'" already available.At serial No."'.$xdata['A'].'"</div>');
                                                                                                    redirect('branchadmin/UploadExcels/clientList');
                                                                                                }
                                                                                            }   
                                                                                            else
                                                                                            {
                                                                                                unlink($file['full_path']);
                                                                                                $this->session->set_flashdata('msg', '<div class="alert alert-danger">client name is  "'.$xdata['C'].'" already available.At serial No."'.$xdata['A'].'"</div>');
                                                                                                redirect('branchadmin/UploadExcels/clientList');
                                                                                            } 
                                                                                                                                                                         
																					 }
																					 else
																					 {
																						  unlink($file['full_path']);
																						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Email Not vailed "'.$xdata['H'].'"At serial No."'.$xdata['A'].'" </div>');
																						  redirect('branchadmin/UploadExcels/clientList'); 
																					 }
																				  }
																				  else
																				  {
																					  unlink($file['full_path']);
																					  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Only 10 digit number are allowed "'.$xdata['G'].'"At serial No."'.$xdata['A'].'" </div>');
																					  redirect('branchadmin/UploadExcels/clientList'); 
																				  }
																			   }
																			   else
																			   {
																					 unlink($file['full_path']);
																					 $this->session->set_flashdata('msg', '<div class="alert alert-danger">contact person Only character are allowed "'.$xdata['F'].'"At serial No."'.$xdata['A'].'" </div>');
																					 redirect('branchadmin/UploadExcels/clientList');
																				}
																			}
																			else
																			{
																				 unlink($file['full_path']);
																				 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Not valid Pancard number "'.$xdata['D'].'"At serial No."'.$xdata['A'].'" </div>');
																				 redirect('branchadmin/UploadExcels/clientList');
																			}
																	   }
																	   else
																	   {
																			 unlink($file['full_path']);
																			 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Only Number are allowed"'.$xdata['E'].'"At serial No."'.$xdata['A'].'" </div>');
																			 redirect('branchadmin/UploadExcels/clientList');
																	   }
																	   
																 }
																 else
																 {
																		unlink($file['full_path']);
																		$this->session->set_flashdata('msg', '<div class="alert alert-danger">client name  Only character are allowed"'.$xdata['C'].'" At serial No."'.$xdata['A'].'"</div>');
																		redirect('branchadmin/UploadExcels/clientList');
																 }
													    }
														
														
												}
												else
										        {
														unlink($file['full_path']);
														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data format Invalid</div>');
														redirect('branchadmin/UploadExcels/clientList');
												}
												if($check==true)
												{
														unset($studentdetail,$studentprofile);
														foreach($data['values'] as $xdata)
														{
															//echo var_dump($xdata); exit;
								                                $form['company_id'] 			                = $this->session->userdata('company_id');
																$form['branch_id'] 			                    = $this->session->userdata('branch_id');
																$form['industry_id'] 				            = $xdata['B'];
																$form['client_name']							= $xdata['C'];
														        $form['client_regi_no']							= $xdata['I'];
																$form['pan_cord_no']							= $xdata['D'];
																$form['licence_no']							    = $xdata['J'];
																$form['tax_deduction_ac_no']				    = $xdata['E'];
																$form['contact_person_name']				    = $xdata['F'];
																$form['contact_person_mobile']				    = $xdata['G'];
																$form['contact_person_email']				    = $xdata['H'];

																// deduction id

																if($xdata['R'] == '' && $xdata['S'] == '')
																{
																	$form['deduction_id']	=     "NAN";
																}
																elseif($xdata['R'] == '1' && $xdata['S'] == '1')
																{
																	$form['deduction_id']	=     "1,2";
																}
																elseif($xdata['R'] == '1' && $xdata['S'] == '')
																{
																	$form['deduction_id']	=     "1";
																}
																else{
																	$form['deduction_id']	=     "2";
																}

																// gst id
																
																if(($xdata['T'] != '') && ($xdata['U'] != '') && ($xdata['V'] != ''))
																{
																	
																			if($xdata['T'] == '1' && $xdata['U'] == '1' && $xdata['V'] == '0')
																			{
																				$form['gst']    =    "1,2";
																			}
																			elseif($xdata['T'] == '0' && $xdata['U'] == '0' && $xdata['V'] == '1')
																			{
																				$form['gst']    =    "3";
																			}
																		
																}
																else
																{
																	unlink($file['full_path']); unset($check);
																	$this->session->set_flashdata('msg', '<div class="alert alert-danger">Not Empty  CGST & SGST or IGST  </div>');
																	redirect('branchadmin/UploadExcels/clientList');
																}


																

																$form['service_tax']				            = $xdata['P'];

																$form['address']				                = $xdata['K'];
																$form['country']				                = $xdata['L'];
																$form['state']				                    = $xdata['M'];
																$form['city']				                    = $xdata['N'];
																$form['pincode']				                = $xdata['O'];
																$form['status']				                    = $xdata['Q'];
																$form['on_up_gst']				                = $xdata['W'];
																$form['createdby'] 				                = $this->session->userdata('loginid');
								                                $form['createdon']				                = date_timestamp_get(date_create());
															//	echo var_dump($form); exit;
																$id = $this->CommanModel->InsertData('tbl_client',$form);
																if(isset($id))
																{
																	$status=true;
																}
																else
																{
																	$status=false;
																}
														}
														if($status==true)
														{
															$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Upload Successfully</div>');
								                            redirect('branchadmin/UploadExcels/clientList');
														}
														else
														{
															unlink($file['full_path']); unset($check);
															$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Some Problem detact in your file. Re-check and try again</div>');
															redirect('branchadmin/UploadExcels/clientList');
														}
												}
												else
												{
														unlink($file['full_path']); unset($check);
														$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error in file</div>');
														redirect('branchadmin/UploadExcels/clientList');
												}
	
	                                    }
										
										// get value from excel
										
										
							
			
	                       }
							
        }
        

     //attendance upload excel --------------------------------------------------------------------------------------------------

        public function attendanceList()
        {
            if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
               $data['title'] 	 = 'Branchadmin | Shift';
               $data['content'] = 'branchadmin/setting/attendanceList';
               $data['clientName']=$this->CommanModel->getList('id,client_name','tbl_client','id','ASC');
               $data['serviceName']=$this->CommanModel->getList('id,service_name','tbl_service','id','ASC');
                               
               $this->load->view($this->layout, $data);
           }
        }
    //download attendance excel 

        public function attendanceExportExcel(){
			redirect('uploads/excel/attendance.xls');
            }
    // upload attendance excel

            public function uploadAttendance()
			{
				
						$serviceId          =$this->input->post('serviceName');
						$clientId           =$this->input->post('clientName');
						$year_v             =$this->input->post('year');	
						$month_v            =$this->input->post('Month');
						
						$this->form_validation->set_rules("clientName", "client name", "trim|required");
						$this->form_validation->set_rules("year", "year", "trim|required");
						$this->form_validation->set_rules("Month", "Month", "trim|required");
						$this->form_validation->set_rules("serviceName", "service name", "trim|required");
						if ($this->form_validation->run())
						{
						$monthdetail = $this->mycalendar->GetDaysDataFromMonth($month_v, $year_v,'S');
						$NoofDaysInmonth = $monthdetail['NoOfDays'];
								   $config['upload_path'] = 'uploads/excel/';
									$config['allowed_types'] = 'xls|csv';
									$config['max_size'] = '0';
									$config['max_filename'] = '0';
									$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
									$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) 
									{
											$s =  $this->upload->initialize($config);
											if (!$this->upload->do_upload('excel')) 
											{
												$error = array('error' => $this->upload->display_errors());
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
												redirect('branchadmin/UploadExcels/attendanceList');	
												$is_file_error = TRUE;
											}
											else
											{
													$file = $this->upload->data();
													$data = $this->import_excel($file['full_path']);
												   //echo var_dump($data); exit;  
												   $check= array ('A' => 'Sr.No.','B' => 'Employee Code','C' => 'Employee Name','D' => 'Employee Designation','E' => 'day1','F' => 'day2','G' => 'day3','H' => 'day4','I' => 'day5','J' => 'day6','K' => 'day7','L' => 'day8','M' => 'day9','N' => 'day10','O' => 'day11','P' => 'day12','Q' => 'day13','R' => 'day14','S' => 'day15','T' => 'day16','U' => 'day17','V' => 'day18','W' => 'day19','X' => 'day20','Y' => 'day21','Z' => 'day22','AA' => 'day23','AB' => 'day24','AC' => 'day25','AD' => 'day26','AE' => 'day27','AF' => 'day28','AG' => 'day29','AH' => 'day30','AI' => 'day31','AJ' => 'OT days','AK' => 'Locked');
												   //var_dump($data['header'][1]);exit;
												   if($data['header'][1]===$check)
												   {
														//var_dump($data['header'][1]);exit;
														$empid = array_column($data['values'],'B','A');
														$employeeid =$this->getDuplicateValueKeys($empid);
													
														if(empty($employeeid['duplicate']) && empty($employeeid['key']))
														{
																foreach($data['values'] as $xdata)
																{
																	
																      $desi_id =  $this->CommanModel->getDataIfdataexists('id','tbl_designation', array('designation_name'=>$xdata['D'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
																
																      $emp_id =  $this->CommanModel->getDataIfdataexists('id','tbl_employee', array('emp_code'=>$xdata['B'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
									
																	if($desi_id)
																	{
																		if($emp_id)
																		{
																			if($this->CommanModel->Ifdataexists('id','tbl_client_service_mapping',array('subservice_id'=>$desi_id['id'],'client_id'=>$clientId,'service_id'=>$serviceId,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')))==1){
																					$allchar=array('E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI');
																					for($i=0;$i<count($allchar);$i++)
																					{
																						
																						 if(preg_match('/^[PAW ]{1,2}$/', $xdata[$allchar[$i]] ) || $xdata[$allchar[$i]] == '')
																						 {
																							  if(preg_match('/^[0-9.]{1,5}$/', $xdata['AJ']) || $xdata['AJ']=='')
																								 {
																						 if(preg_match('/^[0-1]{1}$/', $xdata['AK']))
																						 {
																							  
																							  if($this->CommanModel->Ifdataexists('id','tbl_shift_emp',array('subservice_id'=>$desi_id['id'],'client_id'=>$clientId,'service_id'=>$clientId,'emp_id'=>$emp_id['id'],'year_v'=>$year_v,'month_v'=>$month_v,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')))==0){
																								$checkStatus=true;
																							  }
																							  else{
																								 unlink($file['full_path']);
																								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Record Already exist"'.$xdata['A'].'" </div>');
																								redirect('branchadmin/UploadExcels/attendanceList');
																								}
																						 }
																						 else
																						 {
																								unlink($file['full_path']);
																								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Only 0,1 are allowed"'.$xdata['A'].'" </div>');
																								redirect('branchadmin/UploadExcels/attendanceList');
																						 }
																					 }
																								else
																								 {
																							unlink($file['full_path']);
																							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Only number are allowed"'.$xdata['A'].'" </div>');
																							redirect('branchadmin/UploadExcels/attendanceList');
																								 } 
																								  
																						 }
																						 else
																						 {
																								unlink($file['full_path']);
																								$a=$i+1;
																								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data insert in day'.$a.' wrong Only P A W allowed"'.$xdata['A'].'" </div>');
																								redirect('branchadmin/UploadExcels/attendanceList');
																						 }
																					}
																			 
																			}
																			else
																			 {
																					unlink($file['full_path']);
																					$this->session->set_flashdata('msg', '<div class="alert alert-danger">Sub-service not given to this client"'.$xdata['A'].'" </div>');
																					redirect('branchadmin/UploadExcels/attendanceList');
																			 } 
																		}
																		else
																		{
																					unlink($file['full_path']);
																					$this->session->set_flashdata('msg', '<div class="alert alert-danger">Employee code not exist"'.$xdata['A'].'" </div>');
																					redirect('branchadmin/UploadExcels/attendanceList');
																		 }
																	}
																	else
																	{
																			unlink($file['full_path']);
																			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Designation Not Match At Sr.No. "'.$xdata['A'].'" </div>');
																			redirect('branchadmin/UploadExcels/attendanceList');
																	}
																	
																	
																	
																	
																	
																}
														}
														else
														{
																unlink($file['full_path']);
																$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Employee id. "'.$employeeid['duplicate'].'" at S.No. "'.$employeeid['key'].'" </div>');
																redirect('branchadmin/UploadExcels/attendanceList');
														}
														
												  }
												  else
												  {
														unlink($file['full_path']);
														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data format Invalid</div>');
														redirect('branchadmin/UploadExcels/attendanceList');
												  }
												  
												  
												  //validation finish 
												  
												  
												  if($checkStatus==true)
												  {
														foreach($data['values'] as $xdata)
														{
															//echo var_dump($xdata);
															$emp_id =  $this->CommanModel->getDataIfdataexists('id','tbl_employee',array('emp_code'=>$xdata['B'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
															$allchar=array('E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI');

															
															$form['emp_id']                    =$emp_id['id'];
															$form['year_v']                    =$year_v;
															$form['month_v']                   =$month_v;
															for($q=0; $q < count($allchar); $q++){
																$t = $q + 1;
																if($xdata[$allchar[$q]]!=null){

																	$form['day'.$t] = $xdata[$allchar[$q]];
																}



															}
															
															$form['ot_days']                    = $xdata['AJ'];
															$form['locked_status']              = $xdata['AK'];
															$form['createdby'] 				    = $this->session->userdata('loginid');
															$form['createdon']				    = date_timestamp_get(date_create());
															//var_dump($form);
															
															$checkdata = $this->CommanModel->getDataIfdataexists('id','tbl_attendance',array('emp_id'=>$emp_id['id'],'year_v'=>$year_v ,'month_v'=>$month_v ));
															
															
															if($checkdata){
																$id = $checkdata['id'];
																$update4 = $this->CommanModel->UpdateData('tbl_attendance',$form, array('id'=>$id));
																//echo var_dump($id);exit;
															}
															else{
																	$id = $this->CommanModel->InsertData('tbl_attendance',$form);
																	//echo var_dump($id);exit;
																}
															
															
															 if($id)
															 {
																 $atta= array();
																 $p = array();
																 $a = array();
																 $w = array();
																 for($i=1; $i <= 31; $i++){
																	if($form['day'.$i]!=''){
																	$atta[] = $i.'-'.$form['day'.$i];
																	 if($form['day'.$i]=='P'){
																			$p[]=$form['day'.$i];
																		 }
																		 if($form['day'.$i]=='A'){
																			$a[]=$form['day'.$i];
																		 }
																		 if($form['day'.$i]=='W'){
																			$w[]=$form['day'.$i];
																		 }
																	}
																	
																 }

																 //echo '<pre>';
																// echo var_dump(count($a));
																 $desig_id =  $this->CommanModel->getDataIfdataexists('id','tbl_designation', array('designation_name'=>$xdata['D'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
																 $shift['company_id'] 		    = $this->session->userdata('company_id');
																 $shift['branch_id']            = $this->session->userdata('branch_id');
																 $shift['client_id']            = $clientId;
																 $shift['service_id']           = $serviceId;
																 $shift['subservice_id']        = $desig_id['id'];
																 $shift['emp_id']               = $emp_id['id'];
																 $shift['year_v']               = $year_v;
																 $shift['month_v']              = $month_v;
																 $shift['days']                 = implode(',', $atta);
																 $shift['attendance_id']        = $id;
																 $shift['createdby']            = $this->session->userdata('loginid');
																 $shift['createdon']	        = date_timestamp_get(date_create());
																 if($xdata['AJ']!=''){$otday=$xdata['AJ'];}
																 else{$otday=0;}
																 
																 $shift['APW']             = 'P-'.count($p).',A-'.count($a).',W-'.count($w).',OT-'.$otday;
																
																 $checkSecondTableData = $this->CommanModel->getDataIfdataexists('id','tbl_shift_emp',array('emp_id'=>$emp_id['id'],'year_v'=>$year_v ,'month_v'=>$month_v ,'subservice_id'=>$desig_id['id'], 'service_id'=>$serviceId , 'client_id'=>$clientId,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')  ));
																 
															
																	if($checkSecondTableData==null){
																		$checkSecondTableData = $this->CommanModel->getDataIfdataexists('id','tbl_shift_emp',array('emp_id'=>'0','year_v'=>$year_v ,'month_v'=>$month_v ,'subservice_id'=>$desig_id['id'], 'service_id'=>$serviceId , 'client_id'=>$clientId,'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')  ));
																		if($checkSecondTableData==null){
																		$insertshift = $this->CommanModel->InsertData('tbl_shift_emp',$shift);
																		}
																		
																	}
																	if($checkSecondTableData!=null){
																		$id = $checkSecondTableData['id'];
																		$insertshift = $this->CommanModel->UpdateData('tbl_shift_emp',$shift, array('id'=>$id));	
																		}
																unset($a);unset($p); unset($w);unset($otday);unset($form);unset($shift);
																if($insertshift){
																	$isinsert = true;	
																}
																else{
																	$isinsert = false;	
																}
																 
															 }
														}
												  }
													if($isinsert==true){
														$this->session->set_flashdata('msg', '<div class="alert alert-success">Data save success</div>');
														redirect('branchadmin/UploadExcels/attendanceList');
													}
													else{
														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Response</div>');
														redirect('branchadmin/UploadExcels/attendanceList');
													}
				
				
											}
											
											
											
								   }
						}
						else
						{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">please select all fields!</div>');
							 redirect('branchadmin/UploadExcels/attendanceList');
						}
							
				
				
				
			} 


	// upload employee excel---------------------------------------------------------------------------------------------------
	
	
	public function empList(){
		if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Shift';
			$data['content'] = 'branchadmin/employee/empList';
			
			$this->load->view($this->layout, $data);
		}
		 
		 }

		 public function exportexcel(){
			redirect('uploads/excel/employeeExcel.xls');
			}

		
			public function uploademp(){
				//echo var_dump($_POST); exit;
									$config['upload_path'] = 'uploads/excel/';
									$config['allowed_types'] = 'xls|csv';
									$config['max_size'] = '0';
									$config['max_filename'] = '0';
									$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
									$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) {
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('excel')) {
									$error = array('error' => $this->upload->display_errors());
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
										 redirect('branchadmin/UploadExcels/empList');	
									 $is_file_error = TRUE;
								} 
								else {
									$file = $this->upload->data();
									$data = $this->import_excel($file['full_path']);
									//echo var_dump($data); exit;
								$check= array ('A' => 'Sr.No.','B' => 'Employee Code','C' => 'Employee Name','D' => 'Date of Birth (dd/mm/yyyy)','E' => 'Mobile','F' => 'PAN','G' => 'Adhar Card No.','H' => 'Father Name','I' => 'Permanent Police Station','J' => 'Permanent District','K' => 'Permanent PIN','L' => 'Permanent Mobile','M' => 'Present Police Station','N' => 'Present District','O' => 'Present PIN','P' => 'Present Mobile','Q' => 'Date of Joining','R' => 'Job Type','S' => 'Grade','T' => 'Department','U' => 'Post/Designation','V' => 'Salary Type','W' => 'Gender','X' => 'Languages Known','Y' => 'Married/Unmarried','Z' => 'Identification Mark',
								'AA' => 'Photo','AB' => 'Mother Name','AC' => 'Email','AD' => 'Finger Print (Right Hand Thumb)','AE' => 'Finger Print (Left Hand Thumb)','AF' => 'Religion','AG' => 'Wife/Husband Name','AH' => 'Children','AI' => 'Blood Group','AJ' => 'Hight (In cms)','AK' => 'Weight (In kgs)','AL' => 'Chest (In cms.)','AM' => 'Cast','AN' => 'Permanent Village','AO' => 'Permanent Post','AP' => 'Permanent State','AQ' => 'Present Village','AR' => 'Present Post','AS' => 'Present State','AT' => 'Type of Licence 1','AU' => 'Issued By 1','AV' => 'Register No 1','AW' => 'Date of Issue 1 (dd/mm/yyyy)','AX' => 'Valid Up To 1 (dd/mm/yyyy)','AY' => 'Type of Licence 2','AZ' => 'Issued By 2',
								'BA' => 'Register No 2','BB' => 'Date of Issue 2 (dd/mm/yyyy)','BC' => 'Valid Up To 2 (dd/mm/yyyy)','BD' => 'Type of Licence 3','BE' => 'Issued By 3','BF' => 'Register No 3','BG' => 'Date of Issue 3 (dd/mm/yyyy)','BH' => 'Valid Up To 3 (dd/mm/yyyy)','BI' => 'ESIC Id','BJ' => 'PF Id','BK' => 'Bank Account No.','BL' => 'Bank Name','BM' => 'Bank Branch Name','BN' => 'IFSC Code','BO' => 'Bank Branch Code','BP' => 'Experience (In Year)');
								if($data['header'][1]===$check){
								
								$empcode = array_column($data['values'], 'B','A');
								$df =$this->getDuplicateValueKeys($empcode);
								$pan = array_column($data['values'], 'F','A');
								$dfpan =$this->getDuplicateValueKeys($pan);
								$adhar = array_column($data['values'], 'G','A');
								$dfadhar =$this->getDuplicateValueKeys($adhar);
							///echo var_dump($dfpan); exit;
								
				
				if(empty($df['duplicate']) && empty($df['key'])){
					 if(empty($dfpan['duplicate']) && empty($dfpan['key'])){
						if(empty($dfadhar['duplicate']) && empty($dfadhar['key'])){
							foreach($data['values'] as $xdata){
					
					//echo var_dump($xdata);
					//echo var_dump($this->validateDateForExcel($xdata['Q']));
					// exit;
					
			
					if($this->validateDateForExcel($xdata['D'])){
						if(preg_match('/^[0-9]{10,10}$/',$xdata['E']) || $xdata['E']=''){
							if(preg_match('/^[A-Z]{5,5}[0-9]{4,4}[A-Z]$/', $xdata['F']) || $xdata['F']==''){
								if(preg_match('/^[0-9]{12,12}$/', $xdata['G']) || $xdata['G']==''){
									if(preg_match('/^[a-zA-z .]{2,50}$/', $xdata['H'])){
										if(preg_match('/^[a-zA-z .]{2,50}$/', $xdata['I']) || $xdata['I']==''){
											if(preg_match('/^[a-zA-z ]{2,50}$/', $xdata['J']) || $xdata['J']==''){
												if(preg_match('/^[0-9]{6,6}$/', $xdata['K']) || $xdata['K']==''){
													if(preg_match('/^[0-9]{10,10}$/', $xdata['L']) || $xdata['L']==''){
														if($this->validateDateForExcel($xdata['Q'])){
															if(preg_match('/^[0-9]{1,10}$/', $xdata['R'])){
																if(preg_match('/^[0-9]{1,10}$/', $xdata['S'])){
																	if(preg_match('/^[0-9]{1,10}$/', $xdata['T'])){
																		if(preg_match('/^[0-9]{1,10}$/', $xdata['U'])){
																			if(preg_match('/^[0-9]{1,10}$/', $xdata['V'])){
																				if($this->CommanModel->Ifdataexists('*', 'tbl_employee', array('emp_code'=>$xdata['B'],'branch_id', $this->session->userdata('branch_id'),'company_id', $this->session->userdata('company_id'))) == FALSE){
																					if($this->CommanModel->Ifdataexists('*', 'tbl_employee', array('pan'=>$xdata['F'])) == FALSE || $xdata['F']==''){
																						if($this->CommanModel->Ifdataexists('*', 'tbl_employee', array('adhar_card_no'=>$xdata['G'])) == FALSE || $xdata['G']==''){
																						$checked= TRUE;
																						}
																						else{unlink($file['full_path']); unset($checked);
																						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Adhar Card No. '.$xdata['G'].' is already Register. Please change or delete entry at Serial No.'.$xdata['A'].' (Adhar Card No must be Unique)</div>');
																						redirect('branchadmin/UploadExcels/empList');}
																						}
																					else{unlink($file['full_path']); unset($checked);
																					$this->session->set_flashdata('msg', '<div class="alert alert-danger">PAN '.$xdata['F'].' is already Register. Please change or delete entry at Serial No.'.$xdata['A'].' (PAN must be Unique)</div>');
																					redirect('branchadmin/UploadExcels/empList');}
																					}
																				else{unlink($file['full_path']); unset($checked);
																				$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Employee Code '.$xdata['B'].' is already Register. Please change or delete entry at Serial No.'.$xdata['A'].' (Employee Code must be Unique)</div>');
																				redirect('branchadmin/UploadExcels/empList');}
																			}
																			else{unlink($file['full_path']); unset($checked);
																			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Salary Type at Serial No.'.$xdata['A'].' (Only numeric are Allowed)</div>');
																			redirect('branchadmin/UploadExcels/empList');}
																			}
																		else{unlink($file['full_path']); unset($checked);
															$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Post/Designation at Serial No.'.$xdata['A'].' (Only numeric are Allowed)</div>');
															redirect('branchadmin/UploadExcels/empList');}
																	}
																	else{unlink($file['full_path']); unset($checked);
															$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Department at Serial No.'.$xdata['A'].' (Only numeric are Allowed)</div>');
															redirect('branchadmin/UploadExcels/empList');}
																}
																else{unlink($file['full_path']); unset($checked);
															$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Grade at Serial No.'.$xdata['A'].' (Only numeric are Allowed)</div>');
															redirect('branchadmin/UploadExcels/empList');}
															}
															else{unlink($file['full_path']); unset($checked);
															$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Job Type at Serial No.'.$xdata['A'].' (Only numeric are Allowed)</div>');
															redirect('branchadmin/UploadExcels/empList');}
															}
														else{unlink($file['full_path']); unset($checked);
														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Date of Joining at Serial No.'.$xdata['A'].' (default format: dd/mm/yyyy)</div>');
														redirect('branchadmin/UploadExcels/empList');}
														}
													else{unlink($file['full_path']); unset($checked);
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Permanent Mobile at Serial No.'.$xdata['A'].' (Only 10 digits are Allowed)</div>');
													redirect('branchadmin/UploadExcels/empList');}
													}
												else{unlink($file['full_path']); unset($checked);
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Permanent PIN at Serial No.'.$xdata['A'].' (Only 6 digits are Allowed)</div>');
													redirect('branchadmin/UploadExcels/empList');}
													}
											else{unlink($file['full_path']); unset($checked);
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Permanent District at Serial No.'.$xdata['A'].' (Only 10 digits are Allowed)</div>');
										redirect('branchadmin/UploadExcels/empList');}	
										}
										else{unlink($file['full_path']); unset($checked);
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Permanent Police Station at Serial No.'.$xdata['A'].' (Only Alphabatic are Allowed)</div>');
										redirect('branchadmin/UploadExcels/empList');}	
									}									
									else{unlink($file['full_path']); unset($checked);
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Father Name at Serial No.'.$xdata['A'].' (Only Alphabatic are Allowed)</div>');
													 redirect('branchadmin/UploadExcels/empList');}
								}
								else{unlink($file['full_path']); unset($checked);
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Adhar Card No. at Serial No.'.$xdata['A'].' (default format: 999999999999)</div>');
										redirect('branchadmin/UploadExcels/empList');}
								}
							else{unlink($file['full_path']); unset($checked);
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid PAN at Serial No. '.$xdata['A'].' (default format: AAAAA9999A)</div>');
								redirect('branchadmin/UploadExcels/empList');}
						}
						else{unlink($file['full_path']); unset($checked);
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Mobile Number at Serial No. '.$xdata['A'].' (default format: 9999999999)</div>');
						redirect('branchadmin/UploadExcels/empList');}
					}
					else{unlink($file['full_path']); unset($checked);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Date Format at Serial No. '.$xdata['A'].' (default format: dd/mm/yyyy)</div>');
					redirect('branchadmin/UploadExcels/empList');
					}
			}
						}
						else{
				
					unlink($file['full_path']);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Adhar Card No. "'.$dfadhar['duplicate'].'" at S.No. "'.$dfadhar['key'].'" </div>');
					redirect('branchadmin/UploadExcels/empList');
				}
					}
					else{
				
					unlink($file['full_path']);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate PAN. "'.$dfpan['duplicate'].'" at S.No. "'.$dfpan['key'].'" </div>');
					redirect('branchadmin/UploadExcels/empList');
				}
				}
				else{
				
					unlink($file['full_path']);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Employee Code. "'.$df['duplicate'].'" at S.No. "'.$df['key'].'" </div>');
					redirect('branchadmin/UploadExcels/empList');
				}
			}
			else{
				unlink($file['full_path']);
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data format Invalid</div>');
			redirect('branchadmin/UploadExcels/empList');
			}
			
			if($checked==TRUE)
			{
				unset($studentdetail,$studentprofile);
				foreach($data['values'] as $xdata)
				{
									//echo var_dump($xdata); exit;
					$form['company_id'] 			= $this->session->userdata('company_id');
					$form['branch_id'] 				= $this->session->userdata('branch_id');
					$form['emp_code'] 				= $xdata['B']; 
					$form['emp_name'] 				= $xdata['C']; 
					
					$form['dob'] 					= $this->convertDatetoMysqlDate($xdata['D']); 
					$form['gender'] 				= $xdata['W']; 
					$form['language_known'] 		= $xdata['X']; 
					$form['married_status'] 		= $xdata['Y']; 
					$form['identification_mark'] 	= $xdata['Z']; 
					$form['mother_name'] 			= $xdata['AB']; 
					$form['mobile'] 				= $xdata['E']; 
					$form['email'] 					= $xdata['AC']; 
					$form['pan'] 					= $xdata['F']; 
					$form['adhar_card_no'] 			= $xdata['G']; 
					$form['religion'] 				= $xdata['AF'];
					$form['father_name'] 			= $xdata['H'];
					$form['wife_husband_name'] 		= $xdata['AG']; 
					$form['children'] 				= $xdata['AH']; 
					$form['blood_group'] 			= $xdata['AI'];
					$form['hight'] 					= $xdata['AJ']; 
					$form['weight'] 				= $xdata['AK']; 
					$form['chest'] 					= $xdata['AL']; 
					$form['cast'] 					= $xdata['AM']; 
					$form['p_village'] 				= $xdata['AN']; 
					$form['p_post'] 				= $xdata['AO']; 
					$form['p_police_station'] 		= $xdata['I'];
					$form['p_dist'] 				= $xdata['J'];
					$form['p_state'] 				= $xdata['AP']; 
					$form['p_pin'] 					= $xdata['K']; 
					$form['p_mobile'] 				= $xdata['L'];
					$form['village'] 				= $xdata['AQ']; 
					$form['post'] 					= $xdata['AR']; 
					$form['police_station'] 		= $xdata['M']; 
					$form['dist'] 					= $xdata['N']; 
					$form['t_state'] 				= $xdata['AS']; 
					$form['pin'] 					= $xdata['O'];
					$form['t_mobile'] 				= $xdata['P']; 
					$form['createdby'] 				= $this->session->userdata('loginid');
					$form['createdon']				= date_timestamp_get(date_create());
					
					
					$form_detail['doj'] 			= $this->convertDatetoMysqlDate($xdata['Q']);  
					$form_detail['job_type'] 		= $xdata['R']; 
					$form_detail['experience'] 		= $xdata['BP']; 
					$form_detail['esic_id'] 		= $xdata['BI'];
					$form_detail['pf_id'] 			= $xdata['BJ']; 
					$form_detail['account_no'] 		= $xdata['BK'];
					$form_detail['bank_name'] 		= $xdata['BL'];
					$form_detail['ifsc_code'] 		= $xdata['BN'];
					$form_detail['branch_code'] 	= $xdata['BO'];
					$form_detail['bank_branch_name'] = $xdata['BM'];
					$form_detail['salary_type'] 	= $xdata['V'];
					$form_detail['grade'] 			= $xdata['S'];
					$form_detail['department'] 		= $xdata['T'];
					$form_detail['designation'] 	= $xdata['U'];
					$form_detail['photo'] 			= $xdata['AA'];
					$form_detail['right_thumb'] 	= $xdata['AD'];
					$form_detail['left_thumb'] 		= $xdata['AE'];
					
					$type_lince[1] 		=$xdata['AT'];
					$issued_by[1]  		=$xdata['AU'];
					$rego_no[1]  		=$xdata['AV'];
					$date_issue[1]  		=$xdata['AW'];
					$valid_date[1]  		=$xdata['AX'];
					
					$type_lince[2]  		=$xdata['AY'];
					$issued_by[2]  		=$xdata['AZ'];
					$rego_no[2]  		=$xdata['BA'];
					$date_issue[2]  		=$xdata['BB'];
					$valid_date[2]  		=$xdata['BC'];
					
					$type_lince[3]  		=$xdata['BD'];
					$issued_by[3]  		=$xdata['BE'];
					$rego_no[3]  		=$xdata['BF'];
					$date_issue[3]  		=$xdata['BG'];
					$valid_date[3]  		=$xdata['BH'];
					$id = $this->CommanModel->InsertData('tbl_employee',$form);
					if($id){
					$form_detail['emp_id'] 			= $id;
						if($this->CommanModel->InsertData('tbl_employee_official',$form_detail)){
							for($i=1; $i<= 3; $i++){
								
								if($type_lince[$i]!=''){
									$li['emp_id']=$id;
									$li['licence_type']=$type_lince[$i];
									$li['issued_by']=$issued_by[$i];
									$li['regi_no']=$rego_no[$i];
									$li['issue_date']=$this->convertDatetoMysqlDate($date_issue[$i]);
									$li['valid_upto']=$this->convertDatetoMysqlDate($valid_date[$i]);
									$this->CommanModel->InsertData('tbl_employee_licence',$li);
								}
								
								
							}
							$upload = TRUE;
							}
					}
			}
				if($upload = TRUE){
					$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Upload Successfully</div>');
					redirect('branchadmin/UploadExcels/empList');
				}
				elseif($upload = FALSE)
				{
					unlink($file['full_path']); unset($checked);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Some Problem detact in your file. Re-check and try again</div>');
					redirect('branchadmin/UploadExcels/empList');
				}
			
			}
			else
			{	unlink($file['full_path']); unset($checked);
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error in file</div>');
				redirect('branchadmin/UploadExcels/empList');
				
				}
			}
			}
						
									
					
			}	

      
           public function clientEmpAttendance(){
		
				if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
					$data['title'] 	 = 'Branchadmin | Employee';
					$data['content'] = 'branchadmin/employee/clientEmpAttendance';
					$data['clientName']=$this->CommanModel->getList('id,client_name','tbl_client','id','ASC');
                    $data['serviceName']=$this->CommanModel->getList('id,service_name','tbl_service','id','ASC');
					
					$year = $this->input->post('year');
					$month = $this->input->post('month');
					$emp_id = $this->input->post('emp_id');
					$service_id = $this->input->post('serviceName');
					$clientId = $this->input->post('clientName');
					
					
					$data['empList'] = $this->CommanModel->getAllEMPDetailListWhere('tbl_employee.id,tbl_employee.emp_code,emp_name,tbl_designation.designation_name',array('tbl_employee_official.salary_type'=>'AsPerClient','tbl_employee_official.date_of_leave'=>NULL)); 
					
					$this->form_validation->set_rules("year", "Year", "trim|required");
					$this->form_validation->set_rules("month", "Month", "trim|required");
					$this->form_validation->set_rules("emp_id[]", "Employee", "trim|required");
					$this->form_validation->set_rules("serviceName","subservice","trim|required");
					$this->form_validation->set_rules("clientName","Client","trim|required");
					
					$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
					$this->form_validation->set_message('required', '%s is required!');
			
					  if ($this->form_validation->run() == FALSE) {
						  $this->load->view($this->layout, $data);
					  }
					  else
					  {
						  if ($this->input->post('submit') == "Submit") {
							     
							if($this->CommanModel->Ifdataexists('id','tbl_client_service_mapping',array('client_id'=>$clientId,'service_id'=>$service_id)) !=0 )
							{
										  
										$vdata['title'] 	 	= 'Branchadmin | Employee';
										$vdata['content'] 		= 'branchadmin/employee/startClientEmpAttendance';
										$vdata['monthname'] 	= $this->month[$month];
										$vdata['month_id'] 		= $month;
										$vdata['client_id']     = $clientId;
										$vdata['service_id']	= $service_id;
										$vdata['yearname'] 		= $year;		
										$vdata['month'] 		= $this->mycalendar->GetDaysDataFromMonth($month, $year,'S');
										$vdata['empList'] 		= $this->CommanModel->getListWhereIn('id,emp_code,emp_name','tbl_employee','id', 'ASC', $emp_id);
										//echo var_dump($vdata['empList']); exit;
										$this->load->view($this->dlayout, $vdata);

							}else {
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">service not given to this client </div>');
								redirect('branchadmin/UploadExcels/clientEmpAttendance');
							}

						
						  }
					  }
				 }
				 else{
				
						redirect('web/index');	
				} 
			 }
			
			 public function attendanceStartOfClientEmp(){
		
				if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {

				   $year_v = $this->input->post('year_v');
				   $month_v = $this->input->post('month_v');
				   $clientid = $this->input->post('client');
				   $serviceid = $this->input->post('service');
				   $locked = $this->input->post('lock');
				   $ot_days = $this->input->post('ot_days');
				   $NoofDays = $this->input->post('NoOfDays');
				   $attendance = $this->input->post('att');
				   $emp_ids = $this->input->post('emp_id');
				   $checkBothStatus = false;
				   //echo var_dump($_POST); exit;
				   foreach($emp_ids as $empid){
					   
					   if($empid==''){
						   $this->session->set_flashdata('msg', '<div class="alert alert-danger">Select Employee First</div>');
						   redirect('branchadmin/UploadExcels/clientEmpAttendance');
						   }
					   else{
						   $forShiftTable = '';
						   $value['emp_id'] = $empid;
						   $value['ot_days'] = $ot_days[$empid];
						   $value['locked_status'] = $locked[$empid];
						   $value['year_v']	= $year_v;
						   $value['month_v'] =  $month_v;
						   $att	=	$attendance[$empid];
						   //echo 'ok';
									if($att[1]!='')
									{
													$day = '';
													$p   = '';
													$a   = '';
													$w   = '';
													for($i=1; $i <= $NoofDays; $i++)
													{
														if($att[$i]!='')
														{
															$value['day'.$i] = $att[$i];

															$checkatt[] = $att[$i];

															if($att[$i] == 'P'){ $p[] =  $att[$i];}
															if($att[$i] == 'A'){ $a[] =  $att[$i];}
															if($att[$i] == 'W'){ $w[] =  $att[$i];}

															$day[] =  $i.'-'.$att[$i];

														}
													
													}
																if($a != '')
																 {
																	 $aa = count($a);
																 }
																 if($w != '')
																 {
																	 $ww = count($w);
																 }
																 if($p != '')
																 {
																	 $pp = count($p);
																 }
													$forShiftTable['APW'] = 'P-'.count($p).',A-'.count($a).',W-'.count($w).',OT-'.$ot_days[$empid];
													$forShiftTable['days'] =  implode(',', $day);;
													//var_dump($forShiftTable['APW']);exit;
									}
							       else{
								   $checkatt =1;
								   }
								   
									if($checkatt==null)
									{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Mark atleast one day attendance!</div>');
								redirect('branchadmin/UploadExcels/clientEmpAttendance');
								   
								   }
							       else{
									   
										   $forShiftTable['company_id']     =  $this->session->userdata('');
										   $forShiftTable['branch_id']	    =  $this->session->userdata('');
										   $forShiftTable['client_id']      =  $clientid;
										   $forShiftTable['service_id']     =  $serviceid;
										   
										   $getId=$this->CommanModel->getDataIfdataexists('designation','tbl_employee_official',array('emp_id'=>$value['emp_id']));
										   $forShiftTable['subservice_id']  =  $getId['designation'];
										   $forShiftTable['emp_id']			=  $value['emp_id'];
										   $forShiftTable['year_v']			=  $year_v;
										   $forShiftTable['month_v']		=  $month_v;
										   $forShiftTable['company_id']		=  $this->session->userdata('company_id');
										   $forShiftTable['branch_id']		=  $this->session->userdata('branch_id');
										   
										   $forShiftTable['createdby']      = $this->session->userdata('loginid');
										   $forShiftTable['createdon'] = date_timestamp_get(date_create());


									   $checkIfdata = $this->CommanModel->getDataIfdataexists('id','tbl_attendance', array('emp_id'=>$value['emp_id'],'year_v'=>$value['year_v'],'month_v'=>$value['month_v']));
									   //echo var_dump($value); exit;
									   //echo var_dump($checkIfdata); exit;
									   if($checkIfdata==null){
										   //echo var_dump($value); exit;
										   $value['createdby'] = $this->session->userdata('loginid');
										   $value['createdon'] = date_timestamp_get(date_create());
										   $insert = $this->CommanModel->InsertData('tbl_attendance', $value);
										   $forShiftTable['attendance_id']  =  $insert;

										   }
									   if($checkIfdata!=null){
										   $value['updatedby'] = $this->session->userdata('loginid');
										   $value['updatedon'] = date_timestamp_get(date_create());
										   $update = $this->CommanModel->UpdateData('tbl_attendance',$value, array('id'=>$checkIfdata['id']));
										   $forShiftTable['attendance_id']  =  $checkIfdata['id'];
										   }
										  
										   // insert data in second table


										  $checkSecondTable = $this->CommanModel->getDataIfdataexists('id','tbl_shift_emp', array('emp_id'=>$value['emp_id'],'year_v'=>$value['year_v'],'month_v'=>$value['month_v'],'service_id'=>$forShiftTable['service_id'] ,'subservice_id'=>$forShiftTable['subservice_id'],'client_id'=>$forShiftTable['client_id'] ));  
										  if($checkSecondTable == null){
										$checkSecondTable = $this->CommanModel->getDataIfdataexists('id','tbl_shift_emp', array('emp_id'=>'0','year_v'=>$value['year_v'],'month_v'=>$value['month_v'],'service_id'=>$forShiftTable['service_id'] ,'subservice_id'=>$forShiftTable['subservice_id'],'client_id'=>$forShiftTable['client_id'] ));  
  
										  }
										   if($checkSecondTable == null )
										   {
											  $forShiftTable['createdby'] = $this->session->userdata('loginid');
											  $forShiftTable['createdon'] = date_timestamp_get(date_create());
											  if($this->CommanModel->InsertData('tbl_shift_emp', $forShiftTable)){
												  $checkBothStatus = true;
											  }
											  
										   }
										   if($checkSecondTable!=null){
											$forShiftTable['updatedby'] = $this->session->userdata('loginid');
											$forShiftTable['updatedon'] = date_timestamp_get(date_create());
											
												if($this->CommanModel->UpdateData('tbl_shift_emp',$forShiftTable, array('id'=>$checkSecondTable['id']))){
													$checkBothStatus = true;
												}
											
											}



									   }
							   
						   }
				   }
				   
				   if($insert || $update){
					     if($checkBothStatus == true){
				            $this->session->set_flashdata('msg', '<div class="alert alert-success">Attendance saved!</div>');
						   redirect('branchadmin/UploadExcels/clientEmpAttendance');	
						 }
				   }
				   
				   //echo var_dump($_POST); exit;
				   
		   
					 
				}
				else{
			   
					   redirect('web/index');	
			   } 
			}


			// download excel of self employee

			public function attendanceExportExcelForSelfEmp(){
				redirect('uploads/excel/attendance.xls');
				}

            // upload self employee excel

			public function uploadExcelOfSelfEmployee()
			{
				if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin'){
					$data['title']  	=		'self|employee|attendance';
					$data['content']	=		'branchadmin/employee/uploadExcelOfSelfEmployee';
				
					    $year_v             =$this->input->post('year');	
						$month_v            =$this->input->post('Month');
						
						$this->form_validation->set_rules("year", "year", "trim|required");
						$this->form_validation->set_rules("Month", "Month", "trim|required");
						
						if ($this->form_validation->run())
						{
						
								   $config['upload_path'] = 'uploads/excel/';
									$config['allowed_types'] = 'xls|csv';
									$config['max_size'] = '0';
									$config['max_filename'] = '0';
									$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
									$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) 
									{
											$s =  $this->upload->initialize($config);
											if (!$this->upload->do_upload('excel')) 
											{
												$error = array('error' => $this->upload->display_errors());
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
												redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');	
												$is_file_error = TRUE;
											}
											else
											{
													$file = $this->upload->data();
													$data = $this->import_excel($file['full_path']);
												  // echo var_dump($data); exit;  

												   $check= array ('A' => 'Sr.No.','B' => 'Employee Code','C' => 'Employee Name','D' => 'Employee Designation','E' => 'day1','F' => 'day2','G' => 'day3','H' => 'day4','I' => 'day5','J' => 'day6','K' => 'day7','L' => 'day8','M' => 'day9','N' => 'day10','O' => 'day11','P' => 'day12','Q' => 'day13','R' => 'day14','S' => 'day15','T' => 'day16','U' => 'day17','V' => 'day18','W' => 'day19','X' => 'day20','Y' => 'day21','Z' => 'day22','AA' => 'day23','AB' => 'day24','AC' => 'day25','AD' => 'day26','AE' => 'day27','AF' => 'day28','AG' => 'day29','AH' => 'day30','AI' => 'day31','AJ' => 'OT days','AK' => 'Locked');
												   //var_dump($data['header'][1]);exit;
												   if($data['header'][1]===$check)
												   {
														//var_dump($data['header'][1]);exit;
														$empid = array_column($data['values'],'B','A');
														$employeeid =$this->getDuplicateValueKeys($empid);
													
														if(empty($employeeid['duplicate']) && empty($employeeid['key']))
														{
																foreach($data['values'] as $xdata)
																{
																	
																	
																      $desi_id =  $this->CommanModel->getDataIfdataexists('id','tbl_designation', array('designation_name'=>$xdata['D'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
																
																      $emp_id =  $this->CommanModel->getDataIfdataexists('id','tbl_employee', array('emp_code'=>$xdata['B'], 'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
									
																	if($desi_id)
																	{
																		if($emp_id)
																		{
																			
																					$allchar=array('E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI');
																					for($i=0;$i<count($allchar);$i++)
																					{
																						
																						 if(preg_match('/^[PAW ]{1,2}$/', $xdata[$allchar[$i]]))
																						 {
																							  if(preg_match('/^[0-9.]{1,5}$/', $xdata['AJ']) || $xdata['AJ']=='')
																								 {
																									if(preg_match('/^[0-1]{1}$/', $xdata['AK']))
																									{
																											$checkStatus=true;
																										
																									}
																									else
																									{
																											unlink($file['full_path']);
																											$this->session->set_flashdata('msg', '<div class="alert alert-danger">Only 0,1 are allowed"'.$xdata['A'].'" </div>');
																											redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
																									}
																					 			}
																								else
																								 {
																							unlink($file['full_path']);
																							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Only number are allowed"'.$xdata['A'].'" </div>');
																							redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
																								 } 
																								  
																						 }
																						 else
																						 {
																								unlink($file['full_path']);
																								$a=$i+1;
																								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data insert in day'.$a.' wrong Only P A W allowed"'.$xdata['A'].'" </div>');
																								redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
																						 }
																					}
																			 
																			
																			 
																		}
																		else
																		{
																					unlink($file['full_path']);
																					$this->session->set_flashdata('msg', '<div class="alert alert-danger">Employee code not exist"'.$xdata['A'].'" </div>');
																					redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
																		 }
																	}
																	else
																	{
																			unlink($file['full_path']);
																			$this->session->set_flashdata('msg', '<div class="alert alert-danger">Designation Not Match At Sr.No. "'.$xdata['A'].'" </div>');
																			redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
																	}
																	
																	
																	
																	
																	
																}
														}
														else
														{
																unlink($file['full_path']);
																$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Employee id. "'.$employeeid['duplicate'].'" at S.No. "'.$employeeid['key'].'" </div>');
																redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
														}
														
												  }
												  else
												  {
														unlink($file['full_path']);
														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data format Invalid</div>');
														redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
												  }
												  
												  
												  //validation finish 
												  
												  
												  if($checkStatus==true)
												  {
														foreach($data['values'] as $xdata)
														{
															//echo var_dump($xdata);exit;
															$emp_id =  $this->CommanModel->getDataIfdataexists('id','tbl_employee',array('emp_code'=>$xdata['B'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
															$allchar=array('E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI');

															$form['emp_id']                    =$emp_id['id'];
															$form['year_v']                    =$year_v;
															$form['month_v']                   =$month_v;
															for($q=0; $q < count($allchar); $q++){
																$t = $q + 1;
																if($xdata[$allchar[$q]]!=''){

																	$form['day'.$t] = $xdata[$allchar[$q]];
																}

															}
															
															$form['ot_days']                    = $xdata['AJ'];
															$form['locked_status']              = $xdata['AK'];
															$form['createdby'] 				    = $this->session->userdata('loginid');
															$form['createdon']				    = date_timestamp_get(date_create());
															
															$checkdata = $this->CommanModel->getDataIfdataexists('id','tbl_attendance',array('emp_id'=>$emp_id['id'],'year_v'=>$year_v ,'month_v'=>$month_v ));
															
															if($checkdata){
																$id = $checkdata['id'];
																$insert = $this->CommanModel->UpdateData('tbl_attendance',$form, array('id'=>$id));
																//echo var_dump($id);exit;
															}
															else{
																	$update = $this->CommanModel->InsertData('tbl_attendance',$form);
																	//echo var_dump($id);exit;
																}
															
															
														}
												  }
												if($insert || $update){
													$this->session->set_flashdata('msg', '<div class="alert alert-success">Data save success</div>');
													redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
												}
												else{
													$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Response</div>');
													redirect('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');
												}
				
				
											}
											
											
											
								   }
						}
						else
						{
							//$this->session->set_flashdata('msg', '<div class="alert alert-danger">please select all fields!</div>');
							$this->load->view($this->layout,$data);
						}

				}else {
					redirect('web/index');
				}
			}

// upload Excel for HDFC date => 17/07/2018
			
	    public function uploadHDFC(){
				if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin'){
						$data['title']	=	'Upload | Excel |'.date('Y-m-d');
						$data['content']	=	'branchadmin/employee/uploadHDFC';
						
						$year_v             =$this->input->post('year');	
						$month_v            =$this->input->post('Month');
						
						$this->form_validation->set_rules("year", "year", "trim|required");
						$this->form_validation->set_rules("Month", "Month", "trim|required");
						if($this->form_validation->run())
						{
								$config['upload_path'] = 'uploads/excel/';
								$config['allowed_types'] = 'xls|csv';
								$config['max_size'] = '0';
								$config['max_filename'] = '0';
								$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
								$file = array();
								$is_file_error = FALSE;
								if (!$is_file_error) 
								{
											$s =  $this->upload->initialize($config);
											if (!$this->upload->do_upload('excel')) 
											{
												$error = array('error' => $this->upload->display_errors());
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
												redirect('branchadmin/UploadExcels/uploadHDFC');	
												$is_file_error = TRUE;
											}
											else{
																$file = $this->upload->data();
																$data = $this->import_excel($file['full_path']);
																  // echo var_dump($data); exit; 
																  
																$check	= array ('A' => 'S.No.',
																			   'B' => 'Transaction_Ref_No',
																			   'C' => 'Amount',
																			   'D' => 'Value_Date',
																			   'E' => 'Branch_Code',
																			   'F' => 'Sender_Account_Type',
																			   'G' => 'Remitter_Account_No',
																			   'H' => 'Remitter_Name',
																			   'I' => 'IFSC_Code',
																			   'J' => 'Debit_Account',
																			   'K' => 'Beneficiary_Account_type',
																			   'L' => 'Bank_Account_Number',
																			   'M' => 'Beneficiary_Name',
																			   'N' => 'Remittance_Details',
																			   'O' => 'Debit_Account_System',
																			   'P' => 'Email ID / Mobile Number',
																			   'Q' => 'Remark',
																			   'R' => 'Salary id',
																			   'S' => 'Emp id',
																			   'T' => 'Paid Status'
																			);
																//var_dump($data['header'][1]);exit;
																if($data['header'][1]===$check)
																{
																			// var_dump($data['header'][1]);exit;
																			$multipalEntry = array_column($data['values'],'R','S');
																			$multipalid =$this->getDuplicateValueKeys($multipalEntry);
																			if(empty($multipalid['duplicate']) && empty($multipalid['key']))
																			{
																						foreach($data['values'] as $xdata)
																						{
																									$checkExistData =  $this->CommanModel->getDataIfdataexists('id','tbl_salary', array('emp_id'=>$xdata['S'],'id'=>$xdata['R'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
																									if($checkExistData != '')
																									{
																												$getIdOfRow		=	$checkExistData['id'];
																												$checkData 	=	$this->CommanModel->getDataIfdataexists('NetSalary,paid_status','tbl_salary',array('id'=> $getIdOfRow ));
																												if($checkData['NetSalary'] == $xdata['C']){
																															
																																			$params['paid_status']	= $xdata['T'];
																																			$update		=	$this->CommanModel->UpdateData('tbl_salary',$params, array('id'=>$getIdOfRow));
																																			if($update){

																																				$isUpdate = true;
																																			}

																															

																												}else{
																														unlink($file['full_path']);
																														$this->session->set_flashdata('msg', '<div class="alert alert-danger">Paid Amount"'.$xdata['C'].'" And Salary Amount "'.$checkData['NetSalary'].'" Not Same Ar S.No. "'.$xdata['A'].'" </div>');
																														redirect('branchadmin/UploadExcels/uploadHDFC');
																												}

																									}
																									else{
																											unlink($file['full_path']);
																											$this->session->set_flashdata('msg', '<div class="alert alert-danger">Salary Not Generated Of This "'.$xdata['S'].'" Employee"'.$xdata['A'].'" </div>');
																											redirect('branchadmin/UploadExcels/uploadHDFC');
																									}
																						}
																						
																						if($isUpdate == true){
																						    	$this->session->set_flashdata('msg', '<div class="alert alert-Success">Data Save Successfully ...</div>');
																																					redirect('branchadmin/UploadExcels/uploadHDFC');
																						}
																			}
																			else
																			{
																					unlink($file['full_path']);
																					$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Data. "'.$multipalid['duplicate'].'" at S.No. "'.$multipalid['key'].'" </div>');
																					redirect('branchadmin/UploadExcels/uploadHDFC');
																			}
																}
																else
																{
																		unlink($file['full_path']);
																		$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data format Invalid</div>');
																		redirect('branchadmin/UploadExcels/uploadHDFC');
																}
												}
								}
						}
						else{
							$this->load->view($this->layout,$data);
						}
				}else{
					redirect('web/index');
				}
		}
	
		public function extradeductionExportExcel(){
			redirect('uploads/excel/extradeduction.xls');
            }
	
		public function uploadextradeduction(){
			 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Upload Extra Deduction';
			$data['content'] = 'branchadmin/employee/extradeductionupload';
			$data['extradedutinmasterList'] = $this->CommanModel->getList('*','tbl_extradeduction','id', 'ASC'); 
			$this->form_validation->set_rules("loan_type", "Loan Type Must be Required", "trim|required");
			$this->form_validation->set_message('required', '%s');
	        
			  
			  if ($this->form_validation->run() == FALSE)
			  {
				  $this->load->view($this->layout, $data);
			  }
			  else
			  {
				$config['upload_path'] = 'uploads/excel/';
				$config['allowed_types'] = 'xls|csv';
				$config['max_size'] = '0';
				$config['max_filename'] = '0';
				$config['file_name'] = 'upload_file_'.$this->session->userdata('branch_id').'_'.date("Y_m_d_H_i_s");
				$file = array();
				$is_file_error = FALSE;
									
				  $s =  $this->upload->initialize($config);
				  if (!$this->upload->do_upload('extrafile')) {
					  $error = array('error' => $this->upload->display_errors());
					  $this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$error['error'].'</div>');
					  redirect('branchadmin/UploadExcels/empList');	
					  $is_file_error = TRUE;
				  } 
				  else {
					  $file = $this->upload->data();
					  $data = $this->import_excel($file['full_path']);
					  //echo var_dump($data);
					  $check= array ('A' => 'Sr.No.','B' => 'Employee Code','C' => 'Employee Name','D' => 'Employee Designation',
					  'E' => 'Applied Amount','F' => 'Approved Amount', 'G' =>'Applied Date(DD/MM/YYYY)','H' =>'Approved Date(DD/MM/YYYY)',
					  'I' =>'No. Of EMI (In case of Loan)','J' =>'Description');
					 
					 
					  if($data['header'][1]===$check){
								$empcode = array_column($data['values'], 'B','A');
								$df =$this->getDuplicateValueKeys($empcode);
							if(empty($df['duplicate']) && empty($df['key'])){
								foreach($data['values'] as $xdata){
					
					//echo var_dump($xdata);
					//echo var_dump($this->validateDateForExcel($xdata['Q']));
					// exit;
					if($this->CommanModel->Ifdataexists('*', 'tbl_employee', array('emp_code'=>$xdata['B'],'branch_id', $this->session->userdata('branch_id'),'company_id', $this->session->userdata('company_id'))) == FALSE){
					  	if(preg_match('/^[0-9]{1,20}$/', $xdata['E'])){
								if(preg_match('/^[0-9]{1,20}$/', $xdata['F'])){
									if($this->validateDateForExcel($xdata['G'])){
										if($this->validateDateForExcel($xdata['H'])){
												if(preg_match('/^[0-9]{1,2}$/', $xdata['I']) || $xdata['I']=='' || $xdata['I']!='0'){
													$checked= TRUE;
												  }
												  else{
												  unlink($file['full_path']); unset($checked);
												  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid No. Of EMI '.$xdata['I'].' at Serial No.'.$xdata['A'].' (No. Of EMI must be Numeric)</div>');
												  redirect('branchadmin/UploadExcels/uploadextradeduction');
												  }
											}
											else{
											unlink($file['full_path']); unset($checked);
											$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Approved Date format'.$xdata['H'].' at Serial No.'.$xdata['A'].' (Approved Date format (DD/MM/YYYY))</div>');
											redirect('branchadmin/UploadExcels/uploadextradeduction');
											}
									}
									else{
									unlink($file['full_path']); unset($checked);
									$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Applied Date format'.$xdata['G'].' at Serial No.'.$xdata['A'].' (Applied Date format (DD/MM/YYYY))</div>');
									redirect('branchadmin/UploadExcels/uploadextradeduction');
									}
								}
								else{
								unlink($file['full_path']); unset($checked);
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Approved Amount '.$xdata['F'].' at Serial No.'.$xdata['A'].' (Approved Amount must be Numeric)</div>');
								redirect('branchadmin/UploadExcels/uploadextradeduction');
								}
						}
						else{
								unlink($file['full_path']); unset($checked);
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid Applied Amount '.$xdata['E'].' at Serial No.'.$xdata['A'].' (Applied Amount must be Numeric)</div>');
								redirect('branchadmin/UploadExcels/uploadextradeduction');
							}
					  }
					else{unlink($file['full_path']); unset($checked);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">This Employee Code '.$xdata['B'].' is already Register. Please change or delete entry at Serial No.'.$xdata['A'].' (Employee Code must be Unique)</div>');
					redirect('branchadmin/UploadExcels/uploadextradeduction');}
			}
							}
							else{
								unlink($file['full_path']);
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">We found a duplicate Employee Code. "'.$df['duplicate'].'" at S.No. "'.$df['key'].'" </div>');
								redirect('branchadmin/UploadExcels/uploadextradeduction');
							}
							if($checked==TRUE)
							{
				unset($studentdetail,$studentprofile);
				foreach($data['values'] as $xdata)
				{
					$empid = $this->CommanModel->getDataIfdataexists('id','tbl_employee', array('emp_code'=>$xdata['B'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
					$loanAdvanceDetail['company_id'] 	  = $this->session->userdata('company_id');
					$loanAdvanceDetail['branch_id'] 	  = $this->session->userdata('branch_id');
					$loanAdvanceDetail['loan_type']       = $this->input->post('loan_type');
					$loanAdvanceDetail['emp_id']          = $empid['id'];
					$loanAdvanceDetail['loan_amount']     = $xdata['E'];
					$loanAdvanceDetail['loan_approved']   = $xdata['F'];
					$dateapp								=	explode('/', $xdata['H']);
					$loanAdvanceDetail['year_v']    		= $dateapp[2];
					$loanAdvanceDetail['month_v']    		= $dateapp[1];
					$loanAdvanceDetail['due']   			= $xdata['F'];
					$loanAdvanceDetail['paid']  			 = 0;
					if($loanAdvanceDetail['loan_type']!='0')
					{
					$loanAdvanceDetail['emi_amount'] = 0;
					$loanAdvanceDetail['emi_no'] = 0;
					}
					else
					{
						if($xdata['I'] !=''){
					$loanAdvanceDetail['emi_amount']  = round($loanAdvanceDetail['loan_approved'] / $xdata['I']);
					$loanAdvanceDetail['emi_no']      = $xdata['I']; 
						}
					}
					$loanAdvanceDetail['date_applied']    = $xdata['G'];
					$loanAdvanceDetail['date_approved']   = $xdata['H'];
					$loanAdvanceDetail['loan_approved_by'] = 0;
					$loanAdvanceDetail['purpose_loan']     = $xdata['J'];
					$loanAdvanceDetail['createdon']        = date_timestamp_get(date_create());
					$loanAdvanceDetail['createdby']        = $this->session->userdata('loginid');
					$loanAdvanceDetail['status']           = 0;
					
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
						    $loanDetail['emp_id'] = $loanAdvanceDetail['emp_id'];
							$loanDetail['emi_amount'] = $loanAdvanceDetail['emi_amount'];
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
					 $upload = TRUE;
					 }
					 
					  }
					  }
					
				}
				if($upload = TRUE){
					$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Upload Successfully</div>');
					redirect('branchadmin/UploadExcels/uploadextradeduction');
				}
				elseif($upload = FALSE)
				{
					unlink($file['full_path']); unset($checked);
					$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Some Problem detact in your file. Re-check and try again</div>');
					redirect('branchadmin/UploadExcels/uploadextradeduction');
				}
			
			}
					  else
					  {	unlink($file['full_path']); unset($checked);
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error in file</div>');
						  redirect('branchadmin/UploadExcels/uploadextradeduction');
		  
					  }
			
						
					  }
					  else{
						  $this->session->set_flashdata('msg', '<div class="alert alert-danger">invalid Excel Format</div>');
					  redirect('branchadmin/UploadExcels/empList');	
					  }
				  }
					  
			  }
		 }
		 else
		 {
		
				redirect('web/index');	
		} 
		}


}

?>