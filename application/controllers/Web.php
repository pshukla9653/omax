<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web extends Mycontroller{ 

	public function __construct(){
     	
          parent::__construct();
		  $this->load->library('mycalendar');
		  
     }
	
	public function index() {
         
		if ($this->session->userdata('loginid')) {
			 
            redirect('web/dashboard');
        }
		
		else {
			$this->load->view('web/login');
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
	
		public function login(){
		if($this->session->userdata('loginid')) {
			redirect("web/index");
		}
		else {
			  $username = $this->input->post("username");
			  
			  //set validations
			  $this->form_validation->set_rules("username", "Username", "trim|required");
			  
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view('web/login');
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('btn_login') == "Login") {

						if(preg_match('/^[0-9]{10,10}$/', $username)){
							$usr_result = $this->UsersModel->getUserName(array('mobile'=>$username));
							$utype = 'Mobile Number';
							
							}
						elseif(preg_match('/^[a-zA-z0-9]{3,20}$/', $username)){
							$usr_result = $this->UsersModel->getUserName(array('username'=>$username));
							$utype = 'Username';
							}
							if($usr_result!=null){
								//$randamN = $this->randomKey(6);
								$randamN = 123456;
								$hashpass =  hash("sha256", $randamN.$usr_result['salt']);
								$update = $this->UsersModel->UpdateData('tbl_users',array('password'=>$hashpass), array('id'=>$usr_result['id']));
								if($update){
									$msg = 'Your OTP for login is '.$randamN.' .Do not share with anybody. Regards, Omax Security';
									
									//$sendsms = $this->sendSMS($usr_result['mobile'],$msg);
									$sendsms = '1|1';
									
									$ifdelivert = explode('|', $sendsms);
									
									if($ifdelivert[0]==1 || $ifdelivert[0]=='1'){
										$sessiondata = array('uname'=>$usr_result['username'],'mno'=>$usr_result['mobile'],'otp'=>$randamN);
										$this->session->set_userdata($sessiondata);

									 if($this->session->userdata('uname')==$usr_result['username']){

									 redirect("web/OTPVerificaion");
									 }
									}
										
									else{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">There is some technical error, please try after sometime</div>');
										redirect('web/login');
										}
									}
								}
								else{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid '.$utype.'.Try Again!</div>');
							redirect('web/login');		
									
									}
				   }
				   else {
						redirect('web/login');
				   }
			  }
		}
		}
	public function OTPVerificaion() {
	
		if(!$this->session->userdata('mno')) {
			redirect("web/index");
		}
		else {
			  $username = $this->input->post("username");
			  $password = $this->input->post("password");
			  //set validations
			  $this->form_validation->set_rules("username", "Username", "trim|required");
			  $this->form_validation->set_rules("password", "Password", "trim|required");
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->load->view('web/otpVerification');
			  }
			  else {
				   //validation succeeds
				   if ($this->input->post('btn_login') == "Login") {

						
							$usr_result = $this->UsersModel->get_user($username, $password);
							
							
								if (empty($usr_result)==FALSE) {
									if($usr_result[0]['id'] && $usr_result[0]['type']=='smartadmin'){
									 //set the session variables
									 $sessiondata = array(										 
										  'loginid' 	=> $usr_result[0]['id'],
										  'username' 	=> $usr_result[0]['username'],
								           'type' 		=> $usr_result[0]['type'],
										   'role' 		=> $usr_result[0]['role']										  
									 );
									}
									elseif($usr_result[0]['id'] && $usr_result[0]['type']!='smartadmin'){
									 //set the session variables
									 $sessiondata = array(										 
										  'loginid' 	=> $usr_result[0]['id'],
										  'username' 	=> $usr_result[0]['username'],
								           'type' 		=> $usr_result[0]['type'],
										   'role' 		=> $usr_result[0]['role'],
										   'company_id' => $usr_result[0]['company_id'],
										   'branch_id' 	=> $usr_result[0]['branch_id']										  
									 );
									}
									
									
									$this->session->set_userdata($sessiondata);
									 if($this->session->userdata('loginid')==$usr_result[0]['id']){
										
									 redirect("web/index");
									 }
									 else{ $this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid username &amp; password!</div>');
										redirect('web/login');}
								}
								if (empty($usr_result)==TRUE) {
								$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid username &amp; password!</div>');
								redirect('web/login');
									
								}
							
				   }
				   else {
						redirect('web/login');
				   }
			  }
		}
     }
	 
	public function dashboard() {
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'web/dashboard';
			$data['birth']   =  $this->CommanModel->getDateofBirth('tbl_employee.emp_name,tbl_employee.mobile,tbl_employee_official.photo,tbl_employee_official.designation');
			$this->load->view($this->dlayout, $data);
		}
		else {
			redirect('web/index');
		}
	}
	
	public function transaction()
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'branchadmin/setting/transaction';
			$data['client_id'] = $this->input->post('client');
			$data['year'] = $this->input->post('year');
			$data['month'] = $this->input->post('month');
			
			$data['clientname']  = $this->CommanModel->getListWhere('id,client_name','tbl_client','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			
			$this->form_validation->set_rules("client", "Please Select Client!!", "trim|required");
			$this->form_validation->set_rules("year", "Please Select Year!!", "trim|required");
			$this->form_validation->set_rules("month", "Please Select Month!!", "trim|required");
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->layout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Submit")
				  {
					  redirect('Web/transactionDetail/'.$this->input->post('client').'/'.$this->input->post('year').'/'.$this->input->post('month'));
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Record Not Found</div>');
					  redirect('Web/transaction');
				  }
			}
		}
		else {
			redirect('web/index');
		}
	}
	
	public function transactionDetail($id, $year, $month)
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'branchadmin/setting/transactionDetial';
			$data['totalamount']  = $this->CommanModel->getDataIfdataexists('id,invoice_no,year_v,month_v,total_amount,client_id,payment_status,paid_amount,due_amount','tbl_client_invoice',array('client_id'=>$id,'year_v'=>$year,'month_v'=>$month));
			
			$data['client_id'] = $id;
			
			$transaction['company_id']	= $this->session->userdata('company_id');
			$transaction['branch_id']	= $this->session->userdata('branch_id');
			$transaction['clientid']    = $this->input->post('clientid');
			$transaction['paymentmode'] = $this->input->post('paymentmode');
			$transaction['totalamount'] = $this->input->post('totalamount');
			$transaction['due_amount']  = $this->input->post('dueamount');
			$transaction['invoiceno']   = $this->input->post('invoiceno');
			$transaction['invoiceid']   = $data['totalamount']['id'];
			$tds = $this->input->post('tdsamount');
			if($tds == ''){
			  $transaction['tds_amount']  = 0.00;
			}
			else
			{
			$transaction['tds_amount']  = $this->input->post('tdsamount');
			}
			$transaction['pay_amount']  = $this->input->post('payamount');
			$transaction['createdon']	= date_timestamp_get(date_create());
			$transaction['year_v']	    = date('Y');
			$transaction['month_v']	    = date('m');
			
			
			if($transaction['paymentmode'] == 1)
			{
			   
			   $transaction['pay_person']   = $this->input->post('payperson');
			   $transaction['payment_date'] = $this->convertDatetoMysqlDate($this->input->post('cashpaydate'));
			  
			   
			   $this->form_validation->set_rules("payperson", "Please Enter Pay Person Name!!", "trim|required");
			   $this->form_validation->set_rules("cashpaydate", "Please Enter Pay Date!!", "trim|required");
			}
			if($transaction['paymentmode'] == 2)
			{
				
				$transaction['cheque_no']   = $this->input->post('chequenumber');
				$transaction['bank_name']           = $this->input->post('chequebank');
				$transaction['cleardate']      = $this->convertDatetoMysqlDate($this->input->post('cleardate'));
				$transaction['payment_date']   = $this->convertDatetoMysqlDate($this->input->post('chequepaydate'));
				
				$this->form_validation->set_rules("chequenumber", "Please Enter Cheque Number!!", "trim|required|numeric");
				$this->form_validation->set_rules("chequebank", "Please Select Bank!!", "trim|required");
				$this->form_validation->set_rules("chequepaydate", "Please Enter Payment Date!!", "trim|required");
			}
			if($transaction['paymentmode'] == 3)
			{
				
				$transaction['transactionid']         = $this->input->post('transactionid');
				$transaction['bank']                  = $this->input->post('onlinebank');
				$transaction['payment_date']               = $this->input->post('onlinepaydate');
				
				$this->form_validation->set_rules("transactionid", "Please Enter Transaction Id!!", "trim|required");
				$this->form_validation->set_rules("onlinebank", "Please Select Bank!!", "trim|required");
				$this->form_validation->set_rules("onlinepaydate", "Please Enter Payment Date!!", "trim|required");
			}
			$this->form_validation->set_rules("paymentmode", "Please Select Payment Mode!!", "trim|required");
			
			
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->layout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Submit")
				  {
					 //var_dump($transaction); exit;
					 $this->CommanModel->InsertData('tbl_transaction',$transaction); 
					 $invoiceid = $this->CommanModel->Ifdataexists('id','tbl_client_invoice',array('id'=>$transaction['invoiceid']));
					
					 if($invoiceid)
					 {
						    $otherdetail['paid_amount']    =  $this->input->post('paidamount')+$this->input->post('payamount')+$this->input->post('tdsamount');
							$otherdetail['due_amount']     =  $this->input->post('dueamount');
							if($data['totalamount']['total_amount'] == $otherdetail['paid_amount'] && $this->input->post('dueamount') == 0)
							{
							  $otherdetail['payment_status'] =  "Paid";
							}
							else
							{
								$otherdetail['payment_status'] =  "Due";
							}
							$otherdetail['updatedon']      =  date_timestamp_get(date_create());
							$otherdetail['updatedby']      =  $this->session->userdata('login_id');
						$this->CommanModel->UpdateData('tbl_client_invoice',$otherdetail, array('id'=>$transaction['invoiceid'])); 
					    $this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Successfull</div>');
					    redirect('Web/transaction');
					 }
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Record Not Found</div>');
					  redirect('Web/transaction');
				  }
			}
			
		}
		else {
			redirect('web/index');
		}
	}
    
	public function transactionReports()
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Transaction | Reports';
			$data['content'] = 'branchadmin/setting/transactionReports';
			$data['client']  = $this->CommanModel->getListWhere('id,client_name','tbl_client','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			
			$transaction['client_id']         = $this->input->post('client');
			$transaction['year']                  = $this->input->post('year');
			$transaction['month']               = $this->input->post('month');
			$this->form_validation->set_rules("client", "Please Select Client!!", "trim|required");
			$this->form_validation->set_rules("year", "Please Select Year!!", "trim|required");
			$this->form_validation->set_rules("month", "Please Select Month!", "trim|required");
			
			
			
			
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->dlayout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Submit")
				  {
					  
					 
						$data['clientDetail'] = $this->CommanModel->getListWhere('*','tbl_transaction','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
					 
					  
					  if($data['clientDetail'])
					  {
					     $this->load->view($this->dlayout, $data);
					  }
					  else
					  {
						  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Record Not Found</div>');
					      redirect('Web/transactionReports');
					  }
					  
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Record Not Found</div>');
					  redirect('Web/transactionReports');
				  }
			}
			
		}
		else {
			redirect('web/index');
		}
	}
	
	public function outStandingAmount()
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'branchadmin/setting/outStandingAmount';
			$data['clientDetail']  = $this->CommanModel->getListWhere('id,client_name','tbl_client','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			
			$data['outsamtDetail']  = $this->CommanModel->getListWhere('*','tbl_outstading_amount','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$outsamt['company_id']         = $this->session->userdata('company_id');
			$outsamt['branch_id']          = $this->session->userdata('branch_id');
			$outsamt['client_id']          = $this->input->post('client_id');
			$outsamt['outstanding_amount'] = $this->input->post('outstandingamt');
			$outsamt['paid_amount']        = 0.00;
			$outsamt['due_amount']         = $this->input->post('outstandingamt');
			$outsamt['createdon']          = date_timestamp_get(date_create());
			$outsamt['createdby']          = $this->session->userdata('loginid');
			$outsamt['status']             = 1;
			$this->form_validation->set_rules("client_id", "Select Client or Record already Exist
			
			", "trim|required|is_unique[tbl_outstading_amount.client_id]");
			$this->form_validation->set_rules("outstandingamt", "Please Select Year!!", "trim|required");
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->layout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Submit")
				  {
					 $insert_id = $this->SettingModel->InsertData('tbl_outstading_amount', $outsamt);
					 if($insert_id)
					 {
						$this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Added Successfully.....</div>');
					    redirect('Web/outStandingAmount'); 
					 }
					 else
					 {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Something Went Wrong!!!Try Again..</div>');
					     redirect('Web/outStandingAmount');
					 }
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Something Went Wrong!!!Try Again..</div>');
					  redirect('Web/outStandingAmount');
				  }
			}
		}
		else {
			redirect('web/index');
		}
	}
	
	public function editOutStandingAmount()
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'branchadmin/setting/editOutStandingAmount';
			$data['clientDetail']  = $this->CommanModel->getListWhere('id,client_name','tbl_client','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			
			$data['outsamtDetail']  = $this->CommanModel->getListWhere('*','tbl_outstading_amount','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
			$outsamt['company_id']         = $this->session->userdata('company_id');
			$outsamt['branch_id']          = $this->session->userdata('branch_id');
			$outsamt['client_id']          = $this->input->post('client_id');
			$outsamt['outstanding_amount'] = $this->input->post('outstandingamt');
			$outsamt['paid_amount']        = 0.00;
			$outsamt['due_amount']         = $this->input->post('outstandingamt');
			$outsamt['updatedon']          = date_timestamp_get(date_create());
			$outsamt['updatedby']          = $this->session->userdata('loginid');
			$this->form_validation->set_rules("client_id", "Select Client require", "trim|required");
			$this->form_validation->set_rules("outstandingamt", "Please Select Year!!", "trim|required");
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->layout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Update")
				  {
					 $insert_id = $this->CommanModel->Ifdataexists('client_id','tbl_outstading_amount',array('client_id'=>$this->input->post('hidetxt')));
					 if($insert_id)
					 {
						$this->CommanModel->UpdateData('tbl_outstading_amount', $outsamt,array('client_id'=>$this->input->post('hidetxt')));
						$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully.....</div>');
					    redirect('Web/outStandingAmount'); 
					 }
					 else
					 {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger">Something Went Wrong!!!Try Again..</div>');
					     redirect('Web/outStandingAmount');
					 }
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-danger">Something Went Wrong!!!Try Again..</div>');
					  redirect('Web/outStandingAmount');
				  }
			}
		}
		else {
			redirect('web/index');
		}
	}
	
	
	public function outStandingAmountTransaction($id)
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Dashboard | Admin';
			$data['content'] = 'branchadmin/setting/outStandingAmountTransaction';
			$data['outamtDetail']  = $this->CommanModel->getDataIfdataexists('id,client_id,outstanding_amount,paid_amount,due_amount,status','tbl_outstading_amount',array('client_id'=>$id));
			
			
			$transaction['company_id']	= $this->session->userdata('company_id');
			$transaction['branch_id']	= $this->session->userdata('branch_id');
			$transaction['client_id']    = $this->input->post('clientid');
			$transaction['paymentmode'] = $this->input->post('paymentmode');
			$transaction['totalamount'] = $this->input->post('totalamount');
			$transaction['due_amount']  = $this->input->post('dueamount');
			
			$tds = $this->input->post('tdsamount');
			if($tds == ''){
			  $transaction['tds_amount']  = 0.00;
			}
			else
			{
			$transaction['tds_amount']  = $this->input->post('tdsamount');
			}
			$transaction['pay_amount']  = $this->input->post('payamount');
			$transaction['createdon']	= date_timestamp_get(date_create());
			$transaction['year_v']	    = date('Y');
			$transaction['month_v']	    = date('m');
			
			
			if($transaction['paymentmode'] == 1)
			{
			   
			   $transaction['pay_person']   = $this->input->post('payperson');
			   $transaction['payment_date'] = $this->convertDatetoMysqlDate($this->input->post('cashpaydate'));
			  
			   
			   $this->form_validation->set_rules("payperson", "Please Enter Pay Person Name!!", "trim|required");
			   $this->form_validation->set_rules("cashpaydate", "Please Enter Pay Date!!", "trim|required");
			}
			if($transaction['paymentmode'] == 2)
			{
				
				$transaction['cheque_no']   = $this->input->post('chequenumber');
				$transaction['bank_name']           = $this->input->post('chequebank');
				$transaction['cleardate']      = $this->convertDatetoMysqlDate($this->input->post('cleardate'));
				$transaction['payment_date']   = $this->convertDatetoMysqlDate($this->input->post('chequepaydate'));
				
				$this->form_validation->set_rules("chequenumber", "Please Enter Cheque Number!!", "trim|required|numeric");
				$this->form_validation->set_rules("chequebank", "Please Select Bank!!", "trim|required");
				$this->form_validation->set_rules("chequepaydate", "Please Enter Payment Date!!", "trim|required");
			}
			if($transaction['paymentmode'] == 3)
			{
				
				$transaction['transactionid']         = $this->input->post('transactionid');
				$transaction['bank']                  = $this->input->post('onlinebank');
				$transaction['payment_date']          = $this->input->post('onlinepaydate');
				
				$this->form_validation->set_rules("transactionid", "Please Enter Transaction Id!!", "trim|required");
				$this->form_validation->set_rules("onlinebank", "Please Select Bank!!", "trim|required");
				$this->form_validation->set_rules("onlinepaydate", "Please Enter Payment Date!!", "trim|required");
			}
			$this->form_validation->set_rules("paymentmode", "Please Select Payment Mode!!", "trim|required");
			
			
			if($this->form_validation->run() == FALSE)
			{
				  $this->load->view($this->layout, $data);
			}
			else
			{
				  if ($this->input->post('submit') == "Submit")
				  {
					 
					 //var_dump($transaction); exit;
					 $this->CommanModel->InsertData('tbl_outstandingamountt_transaction',$transaction); 
					 $invoiceid = $this->CommanModel->Ifdataexists('client_id','tbl_outstading_amount',array('client_id'=>$transaction['client_id']));
					
					 if($invoiceid)
					 {
						    $otherdetail['paid_amount']    =  $this->input->post('paidamount')+$this->input->post('payamount')+$this->input->post('tdsamount');
							$otherdetail['due_amount']     =  $this->input->post('dueamount');
							if($data['outamtDetail']['outstanding_amount'] == $otherdetail['paid_amount'] && $this->input->post('dueamount') == 0)
							{
							  $otherdetail['status']    =  3;
							}
							else
							{
								$otherdetail['status'] =  2;
							}
							$otherdetail['updatedon']      =  date_timestamp_get(date_create());
							$otherdetail['updatedby']      =  $this->session->userdata('loginid');
						$this->CommanModel->UpdateData('tbl_outstading_amount',$otherdetail, array('client_id'=>$transaction['client_id'])); 
					    $this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Successfull</div>');
					    redirect('Web/outStandingAmount');
					 }
				  }
				  else
				  {
					  $this->session->set_flashdata('msg', '<div class="alert alert-alert">Record Not Found</div>');
					  redirect('Web/outStandingAmount');
				  }
			}
			
		}
		else {
			redirect('web/index');
		}
	}
	
	public function outStandingAmountTransactionReports()
	{
		if ($this->session->userdata('loginid')) {
			//echo $this->session->userdata('branch_id'); exit;
			
			$data['title'] 	 = 'Out Standing Amount Transaction | Reports';
			$data['content'] = 'branchadmin/setting/outStandingAmountTransactionReports';
			$data['clientDetail'] = $this->CommanModel->getListWhere('*','tbl_outstandingamountt_transaction','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));  
		    $this->load->view($this->dlayout, $data);
					 
			
		}
		else {
			redirect('web/index');
		}
	}
	public function logout() {
        $this->session->unset_userdata('loginid');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('status');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('web/index', 'refresh');
    }
	
	public function db_backup()
{
       $this->load->dbutil();   
	   
	   $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );
       $backup =& $this->dbutil->backup($prefs);  
       //$this->load->helper('file');
     	$db_name = 'omaxsecuritydb-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'uploads/dbbackup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 


        $this->load->helper('download');
        force_download($db_name, $backup);
		unlink($save); 
}
	public function send_db_backup()
{
       $this->load->dbutil();   
       $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );
       $backup =& $this->dbutil->backup($prefs);  
       //$this->load->helper('file');
     	$db_name = 'omaxsecuritydb-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'uploads/dbbackup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 
		
		$subject='Omax Security  DB backup';
		$message='Dear Sir/Madam,
		
		This is a system genrated database backup. Please do not delete this mail and attachment.
		Find the attachment with this mail.
		
		Thanks & Regards
		CZTN  Team
		
		';
		$config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'mail.omaxsecurity.com',
      'smtp_port' => 587,
      'smtp_user' => 'no-reply@omaxsecurity.com', 
      'smtp_pass' => 'S!r_VPGxgE)(GU[s', 
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );


          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('no-reply@omaxsecurity.com');
          $this->email->to('prashant@cztn.co.in');
          $this->email->subject($subject);
          $this->email->message($message);
          $this->email->attach($save);
          $this->email->send();
		  unlink($save);
         
}
	
	
}
