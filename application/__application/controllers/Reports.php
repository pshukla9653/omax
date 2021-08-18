<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Mycontroller{ 

	public function __construct(){
          parent::__construct(); 
		  $this->load->library('mycalendar');
		  $this->load->library('PHPExcel');
     }
	 
	 public function downloadExcelOfHDFC(){
		 if($this->input->post('download') == 'Download Excel')
				{
					
						
					$data['year'] =	$this->input->post('hideYear');
					$data['month']  = $this->input->post('hideMonth');
					$data['salary_type']  = $this->input->post('hidesalary_type');
					$data['client_id'] = explode(',', $this->input->post('hideclient_id'));
					$clien_name='';
					for($i=0; $i < count($data['client_id']); $i++){
						$clientdata ='';
						$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$data['client_id'][$i]));
						$clien_name[] = $clientdata['client_name'];	
					}
					$msg = ' (For '.implode(',',$clien_name).')';
					$data['title'] 	 = 'HDFC Bank List of month-'.$this->month[$data['month']].'-'.$data['year'].$msg;
				    if($data['year']!='-1'){
						$find['tbl_salary.year_v'] = $data['year'];
						
					}
					if($data['month']!='-1'){
						$find['tbl_salary.month_v'] = $data['month'];
					}
					if($data['salary_type']!='-1'){
						$find['tbl_salary.salary_type'] = $data['salary_type'];
					}
					
					$find['tbl_salary.company_id']    =	$this->session->userdata('company_id');
					$find['tbl_salary.branch_id']    =	$this->session->userdata('branch_id');
						//$data = $this->CommanModel->getListWhere('emp_id,FinalTakeHomeSalary','tbl_salary','id','ASC',$find); 
						
							$phpExcel = new PHPExcel();
							
							$prestasi = $phpExcel->setActiveSheetIndex(0);
									//merger
							$phpExcel->getActiveSheet()->mergeCells('A1:U1');
							$phpExcel->getActiveSheet()->mergeCells('A2:U2');
									//manage row hight
							$phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
							for($col = 'A'; $col !== 'T'; $col++) {
							$phpExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
							
							}
									//style alignment
							$styleArray = array(
								'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
									'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
								),
								'borders' => array(
								'allborders' => array(
								 'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							 )
							);
							$phpExcel->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
							$phpExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray);
							$phpExcel->getActiveSheet()->getStyle('A2:U2')->getFont()->setBold(true);
							$phpExcel->getActiveSheet()->getStyle('A2:U2')->applyFromArray($styleArray);
							$phpExcel->getActiveSheet()->getStyle('A3:U3')->getFont()->setBold(true);
							$phpExcel->getActiveSheet()->getStyle('A3:U3')->applyFromArray($styleArray);
									//border
							$styleArray1 = array(
							 
							);
									//background
							$styleArray12 = array(
								'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID
									
								),
							);
									//freeepane
							//$phpExcel->getActiveSheet()->freezePane('A3');
									//coloum width
							
									
									
									
									$prestasi->setCellValue('A1', 'OMAX SECURITY SERVICES PRIVATE LIMITED');
									$prestasi->setCellValue('A2', $data['title']);
									$prestasi->setCellValue('A3', 'S.No.');
									$prestasi->setCellValue('B3', 'Transaction_Ref_No');
									$prestasi->setCellValue('C3', 'Amount');
									$prestasi->setCellValue('D3', 'Value_Date');
									$prestasi->setCellValue('E3', 'Branch_Code');
									$prestasi->setCellValue('F3', 'Sender_Account_Type');
									$prestasi->setCellValue('G3', 'Remitter_Account_No');
									$prestasi->setCellValue('H3', 'Remitter_Name');
									$prestasi->setCellValue('I3', 'IFSC_Code');
									$prestasi->setCellValue('J3', 'Debit_Account');
									$prestasi->setCellValue('K3', 'Beneficiary_Account_type');
									$prestasi->setCellValue('L3', 'Bank_Account_Number');
									$prestasi->setCellValue('M3', 'Beneficiary_Name');
									$prestasi->setCellValue('N3', 'Remittance_Details');
									$prestasi->setCellValue('O3', 'Debit_Account_System');
									$prestasi->setCellValue('P3', 'Email ID / Mobile Number');
									$prestasi->setCellValue('Q3', 'Remark');
									$prestasi->setCellValue('R3', 'Salary id');
									$prestasi->setCellValue('S3', 'Emp id');
									$prestasi->setCellValue('T3', 'Paid Status');
									$prestasi->setCellValue('U3', 'Client Name');
									
									//$data['bankRecordDetail'] = $this->CommanModel->getListWhere('id,emp_id,NetSalary,paid_status','tbl_salary','id','ASC',$find); 
									if($data['salary_type']=='AsPerClient'){
									$data['bankRecordDetail'] = $this->CommanModel->getClientwiseSalaryIn($find, $data['client_id']);
							
									}else{
										$data['bankRecordDetail'] = $this->CommanModel->getListWhere('*','tbl_salary','id','ASC',$find); 
										}
									$i = 1;
									$sl = 1;
									$row_no = 4;    
									foreach($data['bankRecordDetail'] as $val){  
										$empaccount =  $this->CommanModel->getEMPDetailListWhere('tbl_employee.emp_name,tbl_employee.emp_code,tbl_employee_official.account_no, tbl_employee_official.ifsc_code', $val['emp_id']);
										 if(strlen($i)==2)
										   {
											  $last = "0000" .$i; 
										   }elseif(strlen($i)==3){
											 $last = "000" .$i; 
										   }elseif(strlen($i)==4){
											 $last = "00" .$i; 
										   }else {
											 $last = "00000" .$i; 
										   }
                                       
                                        $refNo = (int)substr(date("Y"),2).''. date("d") .''. date("m") .'0594' .  $last;
										$prestasi->setCellValue('A'.$row_no,$sl);
										$prestasi->setCellValueExplicit('B'.$row_no,$refNo,PHPExcel_Cell_DataType::TYPE_STRING);
										$prestasi->setCellValue('C'.$row_no,$val['NetSalary']);
										$prestasi->setCellValue('D'.$row_no,date("d.m.y"));
										$prestasi->setCellValue('E'.$row_no,'0594');
										$prestasi->setCellValue('F'.$row_no,'CA');
										$prestasi->setCellValueExplicit('G'.$row_no,'05942320001694',PHPExcel_Cell_DataType::TYPE_STRING);
										$prestasi->setCellValue('H'.$row_no,'OMAX SECURITY SER. PVT. LTD.');
										$prestasi->setCellValue('I'.$row_no,$empaccount['ifsc_code']);
										$prestasi->setCellValueExplicit('J'.$row_no,'05942320001694',PHPExcel_Cell_DataType::TYPE_STRING);
										$prestasi->setCellValue('K'.$row_no,'SB');
										$prestasi->setCellValueExplicit('L'.$row_no,$empaccount['account_no'],PHPExcel_Cell_DataType::TYPE_STRING);
										$prestasi->setCellValue('M'.$row_no,$empaccount['emp_name']);
										$prestasi->setCellValue('N'.$row_no,'salary');
										$prestasi->setCellValue('O'.$row_no,'omax security services pvt. Ltd.');
										$prestasi->setCellValue('P'.$row_no,'omaxsecurityservices.com');
										$prestasi->setCellValue('Q'.$row_no,'');
										$prestasi->setCellValue('R'.$row_no,$val['id']);
										$prestasi->setCellValue('S'.$row_no,$val['emp_id']);
										$prestasi->setCellValue('T'.$row_no,$val['paid_status']);
										$prestasi->setCellValue('U'.$row_no,$val['client_name']);
										$TOTA[]=$val['NetSalary'];	
										$i++;
										$sl++;
										$row_no++;
									}
									
									$col23='B'.$row_no;
									$col24='C'.$row_no;
									$phpExcel->getActiveSheet()->getStyle($col23.':'.$col24)->getFont()->setBold(true);
									$phpExcel->getActiveSheet()->getStyle($col23.':'.$col24)->applyFromArray($styleArray);
									$prestasi->setCellValue('B'.$row_no, 'TOTAL');
									
									$prestasi->setCellValue('C'.$row_no, array_sum($TOTA));
									
									$filetitle = $data['title'].'.xls';
									
									header("Content-Type: application/vnd.ms-excel");
									header("Content-Disposition: attachment; filename=\"$filetitle\"");
									header("Cache-Control: max-age=0");
									$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
									$objWriter->save("php://output");
									$this->load->view($this->layout, $data);
				}
				else{
						redirect('reports/forHDFCBank');	
				}
	 	
	 }
	 
	 
	 public function ListOfSalary()
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['content'] = 'branchadmin/employee/salaryList';
			
			$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
			
			if($this->input->post('submit') == 'Submit')
				{
					$year =	$this->input->post('year');
					$month  = $this->input->post('Month');
					$salary_type  = $this->input->post('salary_type');
					$client_id = $this->input->post('client_id');
					
					if($year!='-1'){
						$find['tbl_salary.year_v'] = $year;
						
					}
					if($month!='-1'){
						$find['tbl_salary.month_v'] = $month;
					}
					if($salary_type!='-1'){
						$find['tbl_salary.salary_type'] = $salary_type;
					}
					$data['title'] 	 = 'Salary Summary of month-'.$this->month[$month].'-'.$year;
					$find['tbl_salary.company_id']    =	$this->session->userdata('company_id');
					$find['tbl_salary.branch_id']    =	$this->session->userdata('branch_id');
				
						if($salary_type=='AsPerClient'){
							$data['salaryList'] = $this->CommanModel->getClientwiseSalary($find, $client_id);
							
						}else{
						$data['salaryList'] = $this->CommanModel->getListWhere('*','tbl_salary','id','ASC',$find); 
						}
						
						
						$this->load->view($this->dlayout, $data);
				}
				else{
					$this->load->view($this->dlayout,$data);
				}		
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
public function ListOfSalaryAsClient()
	{
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/ListOfSalaryAsClient';
			
			$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
			
			if($this->input->post('submit') == 'Submit')
				{
					$year =	$this->input->post('year');
					$month  = $this->input->post('Month');
					$client_id = $this->input->post('client_id');
					$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$client_id));
					$msg = ' (For '.$clientdata['client_name'].')';
					$data['title'] 	 = 'Salary List of month-'.$this->month[$month].'-'.$year.$msg;
					if($year!='-1'){
						$find['tbl_salary_detail.year_v'] = $year;
						
					}
					if($month!='-1'){
						$find['tbl_salary_detail.month_v'] = $month;
					}
					
					$find['tbl_salary_detail.company_id']   =	$this->session->userdata('company_id');
					$find['tbl_salary_detail.branch_id']    =	$this->session->userdata('branch_id');
					$find['tbl_salary_detail.salary_type']  = 	'AsPerClient';
					$data['salaryList'] 			 =  $this->CommanModel->getClientwiseSalaryN($find, $client_id);
					//$data['clientInvoiceDetail']	 =	$this->CommanModel->getListWhere('payment_string,total_payment_string,total_amount','tbl_client_invoice','id','ASC',array('client_id' => $client_id));
					$data['invoicedetail'] = $this->CommanModel->getListWhere('*','tbl_client_invoice','id','ASC',array('client_id' => $client_id)); 
					
				}
				$this->load->view($this->dlayout, $data);	
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	public function ListOfDetailedSalary($id)
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Salary | List';
			$data['content'] = 'branchadmin/employee/salarydeatilList';
			$find['company_id']    =	$this->session->userdata('company_id');
					$find['branch_id']    =	$this->session->userdata('branch_id');
					$find['salary_id']    =	$id;
					
					
						$data['salaryList'] = $this->CommanModel->getListWhere('*','tbl_salary_detail','id','ASC',$find); 
						
						$this->load->view($this->dlayout, $data);	
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	public function ListOfClientShiftSalary()
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Salary | List';
			$data['content'] = 'branchadmin/employee/ClientShiftSalary';
			$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
			if($this->input->post('submit') == 'Submit')
				{
					$year =	$this->input->post('year');
					$month  = $this->input->post('Month');
					$find['clientid'] = $this->input->post('client_id');
					$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$find['clientid']));
					$msg = ' (For '.$clientdata['client_name'].')';
					$data['title'] 	 = 'Client Shift List of month-'.$this->month[$month].'-'.$year.$msg;
					if($year!='-1'){
						$find['year_v'] = $year;
						
					}
					if($month!='-1'){
						$find['month_v'] = $month;
					}
					
					$find['company_id']   =	$this->session->userdata('company_id');
					$find['branch_id']    =	$this->session->userdata('branch_id');
					$data['salaryList'] = $this->CommanModel->getListWhere('*','tbl_salary_detail','id','ASC',$find); 
				}
					$this->load->view($this->dlayout, $data);	
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	public function forHDFCBank()
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['content'] = 'branchadmin/employee/forHDFCBank';
			$data['clientList'] = $this->SettingModel->getList('id, client_name','tbl_client','id', 'ASC');
		
			if($this->input->post('submit') == 'Submit')
				{
					$data['year'] =	$this->input->post('year');
					$data['month']  = $this->input->post('Month');
					$data['salary_type']  = $this->input->post('salary_type');
					$data['client_id'] = $this->input->post('client_id');
					$data['client_ids'] = implode(',', $this->input->post('client_id'));
					$clien_name='';
					for($i=0; $i < count($data['client_id']); $i++){
						$clientdata ='';
						$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$data['client_id'][$i]));
						$clien_name[] = $clientdata['client_name'];	
					}
					$msg = ' (For '.implode(',',$clien_name).')';
					$data['title'] 	 = 'HDFC Bank List of month-'.$this->month[$data['month']].'-'.$data['year'].$msg;
					
				    if($data['year']!='-1'){
						$find['tbl_salary.year_v'] = $data['year'];
						
					}
					if($data['month']!='-1'){
						$find['tbl_salary.month_v'] = $data['month'];
					}
					if($data['salary_type']!='-1'){
						$find['tbl_salary.salary_type'] = $data['salary_type'];
					}
					
					$find['tbl_salary.company_id']    =	$this->session->userdata('company_id');
					$find['tbl_salary.branch_id']    =	$this->session->userdata('branch_id');
				
						if($data['salary_type']=='AsPerClient'){
							//var_dump($data['client_id']); exit;
							$data['bankRecordDetail'] = $this->CommanModel->getClientwiseSalaryIn($find, $data['client_id']);
							
						}else{
						$data['bankRecordDetail'] = $this->CommanModel->getListWhere('*','tbl_salary','id','ASC',$find); 
						}
					
				///$data['bankRecordDetail'] = $this->CommanModel->getListWhere('id,emp_id,NetSalary,paid_status','tbl_salary','id','ASC',$find); 
						//$this->CTH_debug_var($data['bankRecordDetail']);exit;
						
				}
				$this->load->view($this->layout, $data);	
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	
	public function empAttendanceList()
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/empAttendanceList';
			if($this->input->post('submit') == 'Submit')
				{
					$year =	$this->input->post('year');
					$month  = $this->input->post('Month');
					$data['numberOfDays'] = $this->mycalendar->NumberOfDayInMonth($month,$year);
					$client  = $this->input->post('client');
					if($year!='-1'){
						$find['year_v'] = $year;
						
					}
					if($month!='-1'){
						$find['month_v'] = $month;
					}
					if($client!='-1'){
						$find['client_id']	=  $client;
						$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$client));
						$msg = ' (For '.$clientdata['client_name'].')';
					}
					
					$find['company_id']    =	$this->session->userdata('company_id');
					$find['branch_id']    =	$this->session->userdata('branch_id');

					$clientdata = $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array());
					
						$data['attendanceList'] = $this->CommanModel->getListWhere('*','tbl_shift_emp','id','ASC',$find); 
						$data['title'] 	 = 'Attendence Sheet for the month of '.$this->month[$month].'-'.$year.$msg;
						//$this->CTH_debug_var($data);exit;
						$this->load->view($this->dlayout, $data);
				}
				else{
					$this->load->view($this->dlayout,$data);
				}		
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	
	 public function clientInvoiceList()
	 {
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/clientInvoiceList';
			if($this->input->post('submit') == 'Submit')
				{
					$year =	$this->input->post('year');
					$month  = $this->input->post('Month');
					if($year!='-1'){
						$find['year_v'] = $year;
						
					}
					if($month!='-1'){
						$find['month_v'] = $month;
					}
					
					$find['company_id']    =	$this->session->userdata('company_id');
					$find['branch_id']    =	$this->session->userdata('branch_id');

					$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');
					$data['invoicedetail'] = $this->CommanModel->getListWhere('*','tbl_client_invoice','id','ASC',$find); 
					$data['title'] 	 = ' Client Invoice Statement for the month of '.$this->month[$month].'-'.$year;
					//var_dump($data['deductionList']); exit;
					
					$this->load->view($this->dlayout, $data);
				}else{
					$this->load->view($this->dlayout, $data);
				}
		 }
		 else{
		
				redirect('web/index');	
		}  
	 }
	 
	 public function clientInvoiceListDatewise()
	 {
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/clientInvoiceListDatewise';
			if($this->input->post('submit') == 'Submit')
				{//echo var_dump($_POST); exit;
					$datefrom =	$this->input->post('datefrom');
					$dateto  = $this->input->post('dateto');
					
					$find['company_id']   =	$this->session->userdata('company_id');
					$find['branch_id']    =	$this->session->userdata('branch_id');
					$find['invoice_date>=']    =	$datefrom;
					$find['invoice_date<=']    =	$dateto;

					$data['deductionList'] = $this->SettingModel->getList('id,deduction_head','tbl_deduction_head','id', 'ASC');
					$data['invoicedetail'] = $this->CommanModel->getListWhere('*','tbl_client_invoice','id','ASC',$find); 
					$data['title'] 	 = ' Client Invoice Statement for the month of '.$datefrom.' to '.$dateto;
					//var_dump($data['deductionList']); exit;
					
					$this->load->view($this->dlayout, $data);
				}else{
					$this->load->view($this->dlayout, $data);
				}
		 }
		 else{
		
				redirect('web/index');	
		}  
	 }
	 
	 public function invoiceDetail($id)
	 {
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/invoiceDetail';
			$data['invoicealldetail'] =  $this->CommanModel->getDataIfdataexists('payment_string,emp_details','tbl_client_invoice',array('id'=>$id));

			
			$this->load->view($this->dlayout, $data);
		 }
		 else{
		
				redirect('web/index');	
		}  
	 }
	 
	 public function editSalary($id)
	 {
		  if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			$data['title'] 	 = 'Branchadmin | Employee';
			$data['content'] = 'branchadmin/employee/editSalary';
			$data['salarydata'] = $this->CommanModel->getListWhere('*','tbl_salary','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id'),'id'=>$id));
			
			//$data['empdata'] = $this->CommanModel->getDataIfdataexists('emp_code,emp_name', 'tbl_employee', array('id'=>$id));
			 
			$this->load->view($this->layout,$data);
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	public function reportEPF()
	{
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/reportEPF';
			$data['listDeduction']		 =  $this->CommanModel->getList('id,deduction_head','tbl_deduction_head','id','ASC');
			//var_dump($data['listDeduction']);exit;
				if($this->input->post('submit') == 'Submit')
				{	$find = array('ApplyDeduction!='=> '');
					$year 		=	$this->input->post('year');
					$month 		=   $this->input->post('Month');
					$deductId   =	$this->input->post('deductionId');
					    if($year!='-1'){
							$find['year_v'] = $year;
							
						}
						if($month!='-1'){
							$find['month_v'] = $month;
						}
						
						$find['company_id']    		=	$this->session->userdata('company_id');
						$find['branch_id']     		=	$this->session->userdata('branch_id');
						$data['deductionName'] 	    =    $this->CommanModel->getDataIfdataexists('id,deduction_head','tbl_deduction_head',array('id'=>$deductId));
						
						$data['salaryList']   	   	=    $this->CommanModel->getListWhere('*','tbl_salary','id', 'ASC', $find);
						if($data['deductionName']['deduction_head']=='EPF' || $data['deductionName']['deduction_head'] =='ESIC'){
						$data['title'] 	 			= 		$data['deductionName']['deduction_head'].' Challan Statement for the month of '.$this->month[$month].'-'.$year;
						}
						else{
							$data['title'] 	 			= 		$data['deductionName']['deduction_head'].' Statement for the month of '.$this->month[$month].'-'.$year;
						}
						$this->load->view($this->dlayout,$data);
						
						
				}else
				{
					$this->load->view($this->dlayout,$data);
				}
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	public function allowanceReport()
	{
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/allowanceReport';
			$data['allowanceList']		 =  $this->CommanModel->getList('id,allowance_name','tbl_allowance','id','ASC');
			//var_dump($data['listDeduction']);exit;
				if($this->input->post('submit') == 'Submit')
				{
					$year 		   =	$this->input->post('year');
					$month 		   =    $this->input->post('Month');
					$allowanceId   =	$this->input->post('allowanceId');
					    if($year!='-1'){
							$find['year_v'] = $year;
						}
						if($month!='-1'){
							$find['month_v'] = $month;
						}
						
						$find['company_id']    		=	$this->session->userdata('company_id');
						$find['branch_id']     		=	$this->session->userdata('branch_id');
						$data['allowanceName'] 	    =    $this->CommanModel->getDataIfdataexists('id,allowance_name','tbl_allowance',array('id'=>$allowanceId));
						if($data['allowanceName'] != ''){
							$data['allowanceData']	   = 	$this->CommanModel->getListWhere('*','tbl_salary','id','ASC',$find);
							$data['allowanceId']	   =	$allowanceId ;
						}
						$data['title'] 	 = $data['allowanceName']['allowance_name'].' Statement for the month of '.$this->month[$month].'-'.$year;
						$this->load->view($this->dlayout,$data);
						
						
				}else
				{
					$this->load->view($this->dlayout,$data);
				}
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	public function extraDeduction()
	{
		
		 if ($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin') {
			
			$data['content'] = 'branchadmin/employee/extraDeduction';
			$data['extradeductionList']		 =  $this->CommanModel->getList('id,extradeduction_name','tbl_extradeduction','id','ASC');
			//var_dump($data['listDeduction']);exit;
				if($this->input->post('submit') == 'Submit')
				{
					$find = array('loan_type='=> $this->input->post('extradeductionId'));
					$year 		   =	$this->input->post('year');
					$month 		   =    $this->input->post('Month');
					$extraDeductionId   =	$this->input->post('extradeductionId');
					    if($year!='-1'){
							$find['year_v'] = $year;
						}
						if($month!='-1'){
							$find['month_v'] = $month;
						}
						
						
						
						$find['company_id']    		=	$this->session->userdata('company_id');
						$find['branch_id']     		=	$this->session->userdata('branch_id');
							
						$data['extraDeduction']	  	   = 	$this->CommanModel->getListWhere('*','tbl_loan_advance_details','id','ASC',$find);
						if($extraDeductionId=='0'){
						$data['extraDeductionName']	   =	'Loan' ;
						}
						else{
							$getexname =  $this->CommanModel->getDataIfdataexists('extradeduction_name','tbl_extradeduction', array('id'=>$extraDeductionId));
								$data['extraDeductionName']	   =	$getexname['extradeduction_name'] ;
						}
						$data['extraDeductionId']	   =	$extraDeductionId ;
						if($this->month[$month] == '-1' || $year == '-1'){
							$data['title'] 	 = $data['extraDeductionName'].' Deduction Statement';
						}
						else{
						$data['title'] 	 = $data['extraDeductionName'].' Deduction Statement for the month of '.$this->month[$month].'-'.$year;
						}
						//var_dump($data['extraDeduction']); exit;
						$this->load->view($this->dlayout,$data);
						
						
				}else{
					$this->load->view($this->dlayout,$data);
				}
		 }
		 else{
		
				redirect('web/index');	
		} 
	}
	
	public function loanAdvance()
	{
		
		if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
		{
			$data['title'] = 'Loan/Advance Report-'.$this->month[$month].'-'.$year;
			$data['content'] = 'branchadmin/employee/loanAdvance';
			
			if($this->input->post('submit') == 'Submit')
			{
				$year =	$this->input->post('year');
				$month  =	$this->input->post('Month');
				if($year!='-1'){
					$find['year_v'] = $year;
					
				}
				if($month!='-1'){
					$find['month_v'] = $month;
				}
				
				$find['company_id']    =	$this->session->userdata('company_id');
				$find['branch_id']    =	$this->session->userdata('branch_id');
					$data['lonaAdvance'] = $this->CommanModel->getListWhere('*','tbl_loan_advance_details','id','ASC', $find);
					
					$this->load->view($this->dlayout,$data);
					
			}else
			{
				$this->load->view($this->dlayout,$data);
			}
		}
		else
		{
			redirect('web/index');
		}
	}
	
	public function emiDetial($id)
	{
		
		if($this->session->userdata('loginid') && $this->session->userdata('type')=='branchadmin')
		{
			$data['title'] = 'Emi | List';
			$data['content'] = 'branchadmin/employee/emiList';
			$data['emidtail'] = $this->CommanModel->getListWhere('*','tbl_loan_details','id','ASC',array('row_id'=>$id));
			
		   $this->load->view($this->dlayout,$data);
		}
		else
		{
			redirect('web/index');
		}
	}
	
	
	
	 
}