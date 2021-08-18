 <style>
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  font-size:12px !important;
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print {
  body, page {
    margin: 0 !important;
    box-shadow: 0 !important;
  }
  page[size="A4"] {
  width: 21cm;
  height: auto;  
}
.table-bordered,.table-bordered td,.table-bordered th{border:1px solid #1F1F1F}
/*.footer{
	display:none;
}*/
}
  </style>
 
 <page size="A4">
 <table style="width:21cm !important;" border="1" class="table-bordered">
                    <tr><td>
                    <table>
                    <?php $company = $this->CommanModel->CompanyDetail('company_name,address,country,state,city,pincode,logo_path');
					$branch = $this->CommanModel->CompanyBranchDetail('address,country,state,city,pincode');
					//var_dump($salarydata); exit;
					 ?>
                    <tr>
                    <td style="width:20%;"><img src="<?=base_url('assest/app-assets/images/logo/logo.png');?>" width="60%" alt="" title=""/></td>
                    <td style="text-align:center; width:80%;">
                    <h1><?php echo $company['company_name'];?></h1>
                    <?php echo $branch['address'];?><br>
                    <?php echo $branch['city'].'-'.$branch['pincode'].', ('.$branch['state'].')';?><br>
                    <strong>Pay Slip :- <?php echo $this->month[$salarydata['month_v']];?>-<?php echo $salarydata['year_v'];?></strong> 
                    </td>
                    <td></td>
                    </tr>
                    </table>
                    </td></tr>
                    <tr><td>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <table width="100%">
                    <tr>
                    <td>
                    <table width="100%">
                    
                    <tr>
                    <td><strong>Employee Code :</strong></td>
                    <td><?php echo $salarydata['emp_code'];?></td>
                    </tr>
                     <tr>
                    <td><strong>Employee Name :</strong></td>
                    <td><?php echo $salarydata['name']; ?></td>
                    </tr>
                    <tr>
                    <td><strong>Father Name :</strong></td>
                    <td><?php echo $salarydata['father_name']; ?></td>
                    </tr>
                    <tr>
                    <td><strong>Designation :</strong></td>
                    <td><?php echo $salarydata['designation'];?></td>
                    </tr>
                    <tr>
                    <td><strong>Department :</strong></td>
                    <td><?php echo $salarydata['department'];?></td>
                    </tr>
                    <tr>
                    <td><strong>Grade :</strong></td>
                    <td><?php echo $salarydata['Grade_name'];?></td>
                    </tr>
                    
                    <tr>
                    <td><strong>Payable Days :</strong></td>
                    <td><?php echo $salarydata['PresentDay'];?></td>
                    </tr>
                    <tr>
                    <td><strong>WeekOff Days :</strong></td>
                    <td><?php echo $salarydata['WeekOffDay'];?></td>
                    </tr>
                    <tr>
                    <td><strong>LWP :</strong></td>
                    <td><?php echo $salarydata['AbsentDay'];?></td>
                    </tr>
                   <tr>
                    <td><strong>OT :</strong></td>
                    <td><?php echo $salarydata['OTDay'];?></td>
                    </tr>
                    
                    </table>
                    
                    </td>
                    <td> 
                    <table width="100%">
                    <tr>
                    <td><strong>Date Of Joining :</strong></td>
                    <td><?php 
echo date_format(date_create($salarydata['doj']),"d/m/Y");?></td>
                    </tr>
                     <tr>
                    <td><strong>Bank Ac No. :</strong></td>
                    <td><?php echo  $salarydata['account'];?></td>
                    </tr>
                    <tr>
                    <td><strong>UAN No. :</strong></td>
                    <td><?php echo $salarydata['pfid'];?></td>
                    </tr>
                    <tr>
                    <td><strong>ESIC No. :</strong></td>
                    <td><?php echo $salarydata['esicid'];?></td>
                    </tr>
                    
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td></tr>  
                    <tr><td>
                    <table width="100%" border="1">
                    <tr>
                    <td>
                    <h2>Earnings</h2>
                    
                    </td>
                    <td> 
                    <h2>Deduction</h2>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <table width="100%" border="1">
                    <tr>
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Earn Salary</th>
                    
                    </tr>
                    <tr>
                        <td>BASIC</td>
                        <td><?php echo $salarydata['BasicSalary'];?></td>
                        <td><?php echo $salarydata['PayableBasicSalary'];?></td>
                        
                    </tr>
                    <?php 
					   
					 $allInArray = explode(',',$salarydata['PayableAllowance']);
					 $current = explode(',',$salarydata['CurrentAllowance']);
					  if($current!=''){
					   for($i=0;$i<count($allInArray);$i++)
					   {
						  $getOne = explode(':', $allInArray[$i]);
						  
						   $getCurrent = explode(':', $current[$i]);
						  $allowancename=$this->CommanModel->getDataIfdataexists('allowance_name','tbl_allowance',array('id'=>$getOne[0]));
						 ?><tr><td><?php echo $allowancename['allowance_name']; ?></td>
                         <td><?php echo $getCurrent[1]; $currallanace =+ $getCurrent[1]; ?></td>
                         <td><?php echo $getOne[1]; ?></td>
						</tr>
						 <?php
					   }}
					   ?>
                    
                    <?php if(!empty($salarydata['OTDayAmount'])){?>
                    <tr>
                        <td>OT</td>
                        <td>&nbsp;</td>
                        <td><?php echo round($salarydata['OTDayAmount']);?></td>
                        
                    </tr>
                    <?php }?>
                    <th>GROSS EARNINGS</th>
                    <th><?php echo $salarydata['GrossSalary'];?></th>
                    <th><?php echo round($salarydata['PayableGrossSalary']);?></th>
                    
                    </table>
                    
                    </td>
                    <td> 
                    <table width="100%" border="1">
                    <tr>
                    <th>Description</th>
                   
                    <th>Amount</th>
                    </tr>
                    
                     <?php 
					 $allInArray = explode(',',$salarydata['ApplyDeduction']);
					 if($allInArray!=''){
					 
					 for($i=0;$i<count($allInArray);$i++)
					 {
						 $getone = explode(':', $allInArray[$i]);
						 //echo var_dump($getone);
						$deduction='';
						  $deduction = $this->CommanModel->getDataIfdataexists('deduction_head','tbl_deduction_head',array('id'=>$getone[0]));
					       ?><tr><td><?php echo $deduction['deduction_head']; ?></td>
                           <td><?php $fldata= (float)$getone[2]; echo $fldata;?></td></tr>
						 
						 <?php
					   }
					 }
					   
					 ?>
                      <?php 
					 $extradeductoin = explode(',',$salarydata['ExtraDeduction']);
					 if($extradeductoin!=''){
					 
					 for($i=0;$i<count($extradeductoin);$i++)
					 {
						 $extradeductoinde = explode(':', $extradeductoin[$i]);
						
						  $extradeductionname = $this->CommanModel->getDataIfdataexists('extradeduction_name','tbl_extradeduction',array('id'=>$extradeductoinde[1]));
					       
						   ?><tr><td><?php if($extradeductoinde[1]=='0'){echo 'LOAM EMI';}else{echo $extradeductionname['extradeduction_name'];} ?></td>
                           <td><?php echo $extradeductoinde[3];?></td></tr>
						 
						 <?php
					   }
					 }
					 if($salarydata['PTax'] != NULL){  
					 ?>
                     <tr>
                    <td>Professional Tax</td>
                   
                    <td><?php echo $salarydata['PTax'];?></td>
                   
                    </tr>
                     <?php }?>
                    <tr>
                    <th>GROSS DEDUCTIONS</th>
                   
                    <th><?php echo round($salarydata['TotalDeductionEP']) + round($salarydata['TotalExtraDeduction']);?></th>
                   
                    </tr>
                    
                   
                   
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td></tr>
                    
                     
                     
                     <tr><td><strong>NET SALARY: <?php echo $salarydata['NetSalary'];?></strong></td></tr>
                     <?php if($salarydata['DeductionOnNetSalary']!='0'){?>
                     <tr>
                          <td><strong>NET SALARY DEDUCTION :</strong><td>
                      </tr>
                      <?php 
					        $getAll=  explode(',',$salarydata['DeductionOnNetSalary']);
							for($i=0;$i<count($getAll);$i++)
							{
							   $getOne =explode(':',$getAll[$i]);
							  $getName= $this->CommanModel->getDataIfdataexists('deduction_head','tbl_deduction_head',array('id'=>$getOne[0]));
						 ?><tr><td><?php echo $getName['deduction_head'] .':'. (float)$getOne[2]; ?><td>
						 </tr>
						 <?php
					   }
					   ?>
                        
                      
                      <tr><td><strong>FINAL NET SELERY: <?php echo $salarydata['FinalNetSalary'];?></strong></td></tr>
                      <?php }?>
                       
                       <?php if($salarydata['DeductionOnTakeHomeSalary']!='0'){?>
                      <tr>
                          <td><strong>DEDUCTION ON TAKEHOME SALARY :</strong><td>
                      </tr>
                      <?php 
					        $getAll=  explode(',',$salarydata['DeductionOnTakeHomeSalary']);
							for($i=0;$i<count($getAll);$i++)
							{
							   $getOne =explode(':',$getAll[$i]);
							  $getName= $this->CommanModel->getDataIfdataexists('deduction_head','tbl_deduction_head',array('id'=>$getOne[0]));
						 ?><tr><td><?php echo $getName['deduction_head'] .':'. (float)$getOne[2]; ?><td>
						 </tr>
						 <?php
					   }
					   ?>
                      <tr><td><strong>FINAL TAKEHOME SALARY: <?php echo $salarydata['FinalTakeHomeSalary'];?></strong></td></tr>
                      <?php }?>
                     <tr><td><strong>NET SALARY IN WORDS: 
                    <?php echo $this->mycalendar->getIndianCurrency($salarydata['NetSalary']);?></strong></td></tr>
                     <tr><td></td></tr>
                     <tr><td></td></tr> 
                     
                    
                    </table>
Personal Note: This is a system generated payslip, does not require any signature.
  </page>
  
 
 
 