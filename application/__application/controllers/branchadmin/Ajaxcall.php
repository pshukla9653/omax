<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxcall extends Mycontroller{ 

	
	
	public function __construct(){
     
          parent::__construct();
		  
     }

	public function getBankBranch(){
       if($this->session->userdata('loginid')) {
           if(!empty($_POST['bank_id'])){
              $query =$this->CommanModel->getBankBranch($_POST['bank_id']);
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Bank Branch</option>';
                            echo '<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Bank Branch</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<option value="">No Bank Branch Assign to Bank (Assign first)</option>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getEmpList(){
       if($this->session->userdata('loginid')) {
		   if(empty($_POST['year_v'])){
			   echo '<option value="">Please Select Year</option>';
		   }
		   if(empty($_POST['month_v'])){
			   echo '<option value="">Please Select Month</option>';
		   }
           if(!empty($_POST['client_id'])){
              $query =$this->CommanModel->getShiftBasedEmpList(array('tbl_shift_emp.client_id'=>$_POST['client_id'],'tbl_shift_emp.year_v'=>$_POST['year_v'],'tbl_shift_emp.month_v'=>$_POST['month_v']));
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Employee</option>';
						 echo '<option value="-1">All</option>';
                            echo '<option value="'.$row['id'].'">'.$row['emp_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Employee</option>';
						 echo '<option value="-1">All</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['emp_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<option value="">No Employee Assign to this Client for this Month Or Year (Assign first)</option>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getSubService(){
       if($this->session->userdata('loginid')) {
           if(!empty($_POST['service_id'])){
              $query =$this->CommanModel->getSubService($_POST['service_id']);
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Sub Service</option>';
                            echo '<option value="'.$row['id'].'">'.$row['sub_service_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Sub Service</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['sub_service_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<option value="">No Sub Service Assign to Service (Assign first)</option>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getClientSeriveList(){
       if($this->session->userdata('loginid')) {
		   
           if(!empty($_POST['client_id'])){
              $query =$this->CommanModel->getServiceListClientBased(array('tbl_client_service_mapping.client_id'=>$_POST['client_id']));
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Service</option>';
                            echo '<option value="'.$row['id'].'">'.$row['service_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Service</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['service_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<option value="">No Service Assign to this Client (Assign first)</option>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getClientSeriveListForInvoice(){
       if($this->session->userdata('loginid')) {
		   
           
		   
		   if(!empty($_POST['client_id'])){
              $query =$this->CommanModel->getServiceListClientBased(array('tbl_client_service_mapping.client_id'=>$_POST['client_id']));
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Service</option>';
						 echo '<option value="-1">All</option>';
                            echo '<option value="'.$row['id'].'">'.$row['service_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Service</option>';
						 echo '<option value="-1">All</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['service_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<option value="">No Service Assign to this Client (Assign first)</option>';
                }
            }
			
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getClientSubSeriveList(){
       if($this->session->userdata('loginid')) {
		   
           if(!empty($_POST['client_id'])){
              $query =$this->CommanModel->getSubServiceListClientBased(array('tbl_client_service_mapping.client_id'=>$_POST['client_id'],'tbl_client_service_mapping.service_id'=>$_POST['service_id']));
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
						 $checkdata=''; $p=''; $w=''; $o=''; $a=''; $checked='';
						$checkdata = $this->CommanModel->getDataIfdataexists('id, APW', 'tbl_shift_emp', array('year_v'=>$_POST['year_v'],'month_v'=>$_POST['month_v'],'client_id'=>$_POST['client_id'],'service_id'=>$_POST['service_id'],'subservice_id'=>$row['id']));
                         if($checkdata!=''){
							$AWP =  explode(',', $checkdata['APW']);
							$p = explode('-', $AWP[0]);
							$a = explode('-', $AWP[1]);
							$w = explode('-', $AWP[2]);
							$o = explode('-', $AWP[3]);
							$checked='checked';
						 }
						 echo '<div class="col-md-12">
                             <div class="col-md-2"><strong>Sub Service Name</strong></div>
							 <div class="col-md-2"><strong>Reqiured Strength</strong></div>
							 <div class="col-md-2"><strong>Total Present Days</strong></div>
							 <div class="col-md-2"><strong>Total Absent Days</strong></div>
							 <div class="col-md-2"><strong>Total Weekoff Days</strong></div>
							 <div class="col-md-2"><strong>Total OT Days</strong></div>
			<br><br></div>
                  				</div><div class="col-md-12">
                             <div class="col-md-2"><div class="form-group"><label><input type="checkbox" name="subserice[]" value="'.$row['id'].'" '.$checked.'/>'.$row['designation_name'].'</label>
							 </div></div>
							 <div class="col-md-2">'.$row['strength'].'</div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="prasent['.$row['id'].']" value="'.$p[1].'" class="form-control" placeholder="Present Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="absent['.$row['id'].']" value="'.$a[1].'" class="form-control" placeholder="Absend Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="weekoff['.$row['id'].']" value="'.$w[1].'" class="form-control" placeholder="WeekOff Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="OT['.$row['id'].']" value="'.$o[1].'" class="form-control" placeholder="OT Days"/></div></div>
                  				</div>';
                        }
                    }else{
                         echo '<div class="col-md-12">
                             <div class="col-md-2"><strong>Sub Service Name</strong></div>
							 <div class="col-md-2"><strong>Reqiured Strength</strong></div>
							 <div class="col-md-2"><strong>Total Present Days</strong></div>
							 <div class="col-md-2"><strong>Total Absent Days</strong></div>
							 <div class="col-md-2"><strong>Total Weekoff Days</strong></div>
							 <div class="col-md-2"><strong>Total OT Days</strong></div>
			<br><br></div>
			';
                         foreach($rowlist as $row){
							 $checkdata=''; $p=''; $w=''; $o=''; $a='';$checked='';
							 $checkdata = $this->CommanModel->getDataIfdataexists('id, APW', 'tbl_shift_emp', array('year_v'=>$_POST['year_v'],'month_v'=>$_POST['month_v'],'client_id'=>$_POST['client_id'],'service_id'=>$_POST['service_id'],'subservice_id'=>$row['id']));
						 if($checkdata!=NULL){
							$AWP =  explode(',', $checkdata['APW']);
							$p = explode('-', $AWP[0]);
							$a = explode('-', $AWP[1]);
							$w = explode('-', $AWP[2]);
							$o = explode('-', $AWP[3]);
							$checked='checked';
							
						 } 
                             echo '
                  				</div><div class="col-md-12">
                             <div class="col-md-2"><div class="form-group"><label><input type="checkbox" name="subserice[]" value="'.$row['id'].'" '.$checked.'/>'.$row['designation_name'].'</label>
							 </div></div>
							 <div class="col-md-2">'.$row['strength'].'</div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="prasent['.$row['id'].']" value="'.$p[1].'" class="form-control" placeholder="Present Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="absent['.$row['id'].']" value="'.$a[1].'" class="form-control" placeholder="Absend Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="weekoff['.$row['id'].']" value="'.$w[1].'" class="form-control" placeholder="WeekOff Days"/></div></div>
			<div class="col-md-2"><div class="form-group"><input type="text" name="OT['.$row['id'].']" value="'.$o[1].'" class="form-control" placeholder="OT Days"/></div></div>
                  				</div>';
                            }
                        }
        
                }
               else{
                    echo '<div class="text-danger">No Service Assign to this Client (Assign first)</div>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
	
	public function getClientSubSeriveListForInvoice(){
       if($this->session->userdata('loginid')) {
		   if($_POST['service_id']=='-1'){
			  echo '<option value="-1">All</option>'; 
		   }
           if(!empty($_POST['client_id']) && !empty($_POST['service_id'])){
              $query =$this->CommanModel->getSubServiceListClientBased(array('tbl_client_service_mapping.client_id'=>$_POST['client_id'],'tbl_client_service_mapping.service_id'=>$_POST['service_id'],'tbl_client_service_mapping.status'=>1));
        
              $rowCount = $query->num_rows();
        
              $rowlist = $query->result_array();
    
               if($rowCount > 0 && $rowCount!=0){
                    if($rowCount==1){
        
                        foreach($rowlist as $row){ 
                         echo '<option value="">Select Sub-Service</option>';
                            echo '<option value="'.$row['id'].'">'.$row['designation_name'].'</option>';
                        }
                    }else{
                         echo '<option value="">Select Sub-Service</option>';
						 echo '<option value="-1">All</option>';
                         foreach($rowlist as $row){ 
                             echo '<option value="'.$row['id'].'">'.$row['designation_name'].'</option>';
                            }
                        }
        
                }
               else{
                    echo '<div class="text-danger">No Sub-Service Assign to this Client (Assign first)</div>';
                }
            }
        }
        else {
            redirect('web/index');  
        } 
    }
}
