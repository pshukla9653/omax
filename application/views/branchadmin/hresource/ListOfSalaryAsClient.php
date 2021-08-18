<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Salary As Client</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">List</a>
                </li>
                
              </ol>
            </div>
          </div>
        </div>
        
      </div>
    
      <div class="content-body">
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Salary As Client</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/ListOfSalaryAsClient', array('name'=>'ListOfSalaryAsClient'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                          <div class="form-group">
                                        
                                        <?php echo form_label('Year'); ?>
                                                        <select name="year" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="-1">ALL</option>
                                                        <?php foreach($this->year as $y=>$v){?>
                                <option value="<?php echo $y;?>"><?php echo $v;?></option>
                                <?php }?>
                                                        </select>
                                        <?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                                                    </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                            <div class="form-group">
							           	<?php echo form_label('Month'); ?>
                                <select name="Month" class="form-control">
                                <option value="">Select</option>
                                <option value="-1">ALL</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
							         	<?php echo form_error('Month', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                            </div>
                    <div class="col-md-6">
                           <div class="form-group">
							           	<?php echo form_label('Client List'); ?>
                                <select name="client_id" class="form-control select2" id="SalaryTypeReport">
                                <option value="">Select</option>
                                <?php foreach($clientList as $client):?>
                                	<option value="<?php echo $client['id'];?>"> <?php echo $client['client_name'];?> </option>
                                <?php endforeach;?>
                                </select>
							         	<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                            </div>
                     <div class="col-md-6" id="divforclinet">
                         
                      </div>
                     <div class="col-md-6">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
                  </div>
                  </div>
                  
                  
                  </div>
                  </div>
                 
                </div>
              </div>

</div>
 
      <div class="content-body">
       
        <!-- Column selectors table -->
        <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
              
                <div class="card-header">
                  <h4 class="card-title">Salary As Client</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body collapse in">
                  <div class="card-block card-dashboard">
                    <div class="horizontal-scroll scroll-example">
                      <div class="horz-scroll-content">
                        <div class="row">
                        <?php echo $this->session->flashdata('msg'); ?>
                    <table class="table table-striped table-bordered dataex-html5-selectors">
                      <thead>
                      <?php
                        $allAllowance= $this->CommanModel->getList('allowance_name','tbl_allowance','id','ASC');
                        $allcoun = count($allAllowance); 
                        
                        $alldeduct= $this->CommanModel->getList('deduction_head','tbl_deduction_head','id','ASC');
                        $allowcount = count($alldeduct);
                        $extraDeduction= $this->CommanModel->getList('extradeduction_name','tbl_extradeduction','id','ASC');
					  	$allExtraDeduction = count($extraDeduction);
					  
					           ?>
                        <tr>
                          <th colspan="6"></th>
                          <th colspan="<?php echo $allcoun;?>" style="text-align:center;">Current Allowance</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th colspan="<?php echo $allcoun;?>" style="text-align:center;">Paybal Allowance</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th colspan="<?php echo $allowcount;?>" style="text-align:center;">Deduction</th>
                          <th colspan="<?php echo $allExtraDeduction+1;?>" style="text-align:center;">Extra Deduction</th>
                          <th colspan="14"></th>
                          
                        </tr>
                        <tr>
                           <th>SNo</th>
                          <th>ID No.</th>
                          <th>Client Name</th>
                          <th>Employee Name</th>
                          <th>Designation</th>
                          <th> Basic Salary</th>
                          <?php 
                                      $AllowanceList= $this->CommanModel->getList('id,allowance_name','tbl_allowance','id','ASC');
                                      foreach ($AllowanceList as $allowance): ?>
                                      <th><?=$allowance['allowance_name']?></th>

                                       <?php endforeach; ?>
                                       
                          
                          <th>Present Days</th>	
                          <th>OT Days</th>
                          <th>Total Days</th>
                          <th>Paybal Basic salary</th>
                          <th>Paybal Allowance</th>
                          <th>Total Allowance</th>
                          <th>OT.Amount</th>
                          <th>Paybal Gross Salary</th>
                          <?php 
                                      $DeductionList= $this->CommanModel->getList('id,deduction_head','tbl_deduction_head','id','ASC');
                                      foreach ($DeductionList as $deduction): ?>
                                      <th><?=$deduction['deduction_head']?></th>
                                      <?php endforeach; ?>
                          <?php 
                                      $extraDeductionList= $this->CommanModel->getList('id,extradeduction_name','tbl_extradeduction','id','ASC');
                                      foreach ($extraDeductionList as $extraDeduction): ?>
                                      <th><?=$extraDeduction['extradeduction_name']?></th>
                                      <?php endforeach; ?>
                          <th>Loan</th>   
                          <th>Total Extra Deduction</th>
                          
                          <th>Net Salary</th> 
                          <th>Service Charges</th>
                          <th>PF Employer</th>
                          <th>ESIC Employer</th>
                          <th>Total Bill Amount</th>
                          <th>GST</th>
                          <th>GROSS BILLING</th>
                          <th>PF Payable</th>
                          <th>ESIC Payable</th>
                           <th>Salary Paid Date</th>
                           <th>Bank Name</th>
                           <th>Ch No.</th>
                           <th>Remark</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                       
						  <?php  
						  $i = 0;
						  foreach ($salaryList as $item): ?>
                                 <tr>
                                      <td><?=++$i?></td> 
                                      <td><?=$item['emp_id']?></td>
                                      <td>
											 <?php  $clientname = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$invoicedetail[0]['client_id']));?>
                                              <?php echo $clientname['client_name']?>
                                      </td>
                                      <td><?php
                                                  $emp_name = $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
                                                  
                                                  echo  $emp_name['emp_name'];
                                           ?></td>
                                       <td><?php
                                                  $desigId = $this->CommanModel->getDataIfdataexists('designation','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                                  $desigName = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation',array('id'=>$desigId['designation']));
                                                  echo  $desigName['designation_name'];
                                           ?>
                                      </td>
                                      <td><?php 
                                      
                                        $totalBasicSalary[] = $item['BasicSalary'];
                                      echo $item['BasicSalary'];
									  
                                      ?></td>
                                      <?php 
                                     
                                      foreach ($AllowanceList as $allowance): 
                                            $Currenteall = explode(',', $item['CurrentAllowance']);
                                          foreach($Currenteall as $allawan){
                                            
                                            $Detailallwance = explode(':', $allawan);
											
                                            if($allowance['id'] == $Detailallwance[0]){
                                              $alloaanceamount = $Detailallwance[1];
                                              $allCurrenteAllowance[$allowance['id']][]  =  $alloaanceamount;
											  break;
                                            }
                                            else{
                                              $alloaanceamount =  0;

                                            } 
                                          
                                          }
                                          ?>
                                       <td><?php echo $alloaanceamount;?></td>
                                        <?php  endforeach; ?>

                                       <td><?php echo $item['PresentDay']; $TOTALPRA[]=$item['PresentDay'];?></td>
                                       <td><?php echo $item['OTDay']; $TOTALOT[]=$item['OTDay'];?></td>
                                       <td><?php echo (int)$item['PresentDay'] + (int)$item['AbsentDay'] + (int)$item['WeekOffDay'] + (int)$item['OTDay'];
									   $TOTALDAYS[]=(int)$item['PresentDay'] + (int)$item['AbsentDay'] + (int)$item['WeekOffDay'] + (int)$item['OTDay'];
									   ?></td>
                                       <td><?php
                                     	 $allPaybalBasicSalary[] = $item['PayableBasicSalary'];
                                     	 echo $item['PayableBasicSalary'];?></td>
                                       <?php 
                                     
											  foreach ($AllowanceList as $allowance): 
													$payableall = explode(',', $item['PayableAllowance']);
												  foreach($payableall as $allawan){
													
													$Detailallwance = explode(':', $allawan);
													
													if($allowance['id'] == $Detailallwance[0]){
													  $alloaanceamount = $Detailallwance[1];
													  $allAllowance[]  =  $alloaanceamount;
													  break;
													}
													else{
													  $alloaanceamount =  0;
		
													} 
												  
												  }
												  ?>
											   
												<?php  endforeach; ?>
												<td><?php echo $alloaanceamount;?></td>
											   <td><?php
												$allTotalAllowance[]  =  $item['TotalAllowance'];
											   echo $item['TotalAllowance'];?></td>
                                               <td><?php
												$allTotalOtAmount[]  =  $item['OTDayAmount'];
											   echo $item['OTDayAmount'];?></td>
                                               <td><?php
												$allTotalPaybalGrossSalary[]  =  $item['PayableGrossSalary'];
											   echo $item['PayableGrossSalary'];?></td>
                                               
                                                 <?php 
                                     
																		foreach ($DeductionList as $deduction): 
														$payableall = explode(',', $item['ApplyDeduction']);
													  foreach($payableall as $allawan){
														
														$Detailallwance = explode(':', $allawan);
																			  
														if($deduction['id'] == $Detailallwance[0]){
														  $alloaanceamount = (float)$Detailallwance[2];
														  if($deduction['deduction_head'] == 'EPF'){
															$allTotal[$deduction['id']][]  = $alloaanceamount;
														  }else if($deduction['deduction_head'] == 'ESIC'){
															$allTotal[$deduction['id']][]   =   $alloaanceamount;    
														  }else{
															  $allTotal[$deduction['id']][]   =   $alloaanceamount; 
														  }
			
														
														  break;
														}
														else{
														  $alloaanceamount =  0;
			
														} 
													  
													  }
												   ?>              
														
														<td><?php echo $alloaanceamount;?></td>
														
														<?php   endforeach; ?> 
                                      
                                        

                                     
                                            <!-- extra deduction -->
												<?php 
													$extraDeduct = explode(',', $item['ExtraDeduction']);
													foreach($extraDeduct as $allextraDeduct){
															 $DetailextraDeduct = explode(':', $allextraDeduct);
															 foreach ($extraDeductionList as $extraDeductionForAll){
															 	if($DetailextraDeduct[1] == $extraDeductionForAll['id'])
																{
																	//$extraDeductId[]        = $extraDeductionForAll['id'];
																	$totalextraDeductAmount[$extraDeductionForAll['id']][]	= 	$DetailextraDeduct[3];
																	?> <td> <?php echo  $DetailextraDeduct[3];?></td>  <?php
																}
																else{
																			?> <td> <?php echo  '0';?></td>  <?php
																	 }
															 }
															 
													}
													
												
											?>
                                            <?php 
													$cutextraDeduct = explode(',', $item['ExtraDeduction']);
													foreach($cutextraDeduct as $oneextraDeduct){
															 $DetailextraDeductData = explode(':', $oneextraDeduct);
															 if($DetailextraDeductData[1] == '0')
															 {
																$totalLoan[] =  $DetailextraDeductData[3];
																?> <td> <?php echo  $DetailextraDeductData[3];?></td>  <?php
															 }else{
																 		?> <td> <?php echo  '0';?></td>  <?php
																  }
															 
													}
													
												
											?>
                                       
                                       
                                        <!-- extra deduction -->
                                       		<td><?php 
                                            $allTotalExtra[]  = $item['TotalExtraDeduction'];
                                            echo $item['TotalExtraDeduction'];?></td>
											
                                            <td><?php 
                                            $allTotalNetSalary[]  =  $item['NetSalary'];
                                            echo $item['NetSalary'];?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
											<td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>                                            

                                </tr>
                          <?php endforeach; ?>
                       
                      </tbody>
                     <tfoot>
                      <tr>
                          <th></th>
                          <th>TOTAL</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th> <?php echo array_sum($totalBasicSalary);?></th>
                          <?php foreach ($AllowanceList as $allowance): ?>
                          <th> <?php echo array_sum($allCurrenteAllowance[$allowance['id']]);?></th>
                          <?php endforeach;?>
                          
                          <th><?php echo array_sum($TOTALPRA);?></th>
                          <th><?php echo array_sum($TOTALOT);?></th>
                          <th><?php echo array_sum($TOTALDAYS);?></th>
                          <th> <?php echo array_sum($allPaybalBasicSalary);?></th>
                          <th> </th>
                          <th> <?php echo array_sum($allTotalAllowance);?></th>
                          <th> <?php echo array_sum($allTotalOtAmount);?></th>
                          <th> <?php echo array_sum($allTotalPaybalGrossSalary);?></th>
                          <?php foreach ($DeductionList as $deduction):
						  ?>
                          <th><?php echo array_sum($allTotal[$deduction['id']]);?></th>
                          	
                          <?php endforeach;?>
                          <?php 
                                      $extraDeductionList= $this->CommanModel->getList('id,extradeduction_name','tbl_extradeduction','id','ASC');
                                      foreach ($extraDeductionList as $extraDeduction): 
									  ?>
                                      	<th><?php echo array_sum($totalextraDeductAmount[$extraDeduction['id']]);?></th>
                                      <?php endforeach; ?>
                           <th><?php echo array_sum($totalLoan);?></th>
                           <th> <?php echo array_sum($allTotalExtra);?> </th> 
                           
                           <th><?php echo array_sum($allTotalNetSalary);?></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           
                          
                         
                      
                          
                        </tr>
                      
                     </tfoot>
                    </table>
                    </div></div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Column selectors table -->
      </div>
        <!-- Basic Inputs end -->
  
      </div>
    </div>
    </section></div></div></div>
 
  
 
 
 