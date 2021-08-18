<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Salary</h3>
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
                  <h4 class="card-title">Salary Summary List</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/ListOfSalary', array('name'=>'addDepartment'));?>
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
							           	<?php echo form_label('Salary Type'); ?>
                                <select name="salary_type" class="form-control" id="SalaryTypeReport">
                                <option value="">Select</option>
                                <option value="-1">ALL</option>
                                <option value="AsPerClient">As Per Client</option>
                                <option value="AsPerEmployee">As Per Employee</option>
                                
                                </select>
							         	<?php echo form_error('salary_type', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                            </div>
                     <div class="col-md-6" id="divforclinet">
                           <div class="form-group">
							           	<?php echo form_label('Client'); ?>
                                <select name="client_id" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($clientList as $client){?>
                                <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php } ?>
                                </select>
							         	<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
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
                  <h4 class="card-title">Salary Summary List</h4>
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
                           <th>SNo</th>
                          
                          <th>Emp Code</th>
                          <th>Emp Name</th>
                          <th>Father's Name</th>
                          <th>UAN No.</th>
                          <th>ESIC No</th>
                          <th>Designation</th>
                          <th>Present Days</th>
                         
                          <th>W/O</th>
                          <th>OT Days</th>
                        
                          <th>Basic Salary</th>
                         
                         
                                       
                          <th>Allowance</th>	
                          <th>Gross Salary</th>
                           <th>Earn Basic</th>
                           <th>Earn Allowance</th>
                           <th>OT Amt.</th>
                            <th>Earn Gross</th>
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
                          <th>Total Deduction</th>	
                          <th>Net Salary</th>
                          <th>Signature/Bank</th>
                          <th style="width:500px !important;">Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                       
						  <?php  
						  $i = 0;
						  foreach ($salaryList as $item): ?>
                                 <tr>
                                      <td><?=++$i?></td> 
                                     
                                      <td><?=$item['emp_code']?></td>
                                      <td>
                                              <?php 
                                                
                                                $getEmpFather =   $this->CommanModel->getDataIfdataexists('emp_name,father_name','tbl_employee',array('id'=>$item['emp_id']));
                                                echo  $getEmpFather['emp_name'];
                                              ?>
                                        </td>
                                      <td>
                                              <?php 
                                                
                                                echo  $getEmpFather['father_name'];
												$getEmpFather =   $this->CommanModel->getDataIfdataexists('esic_id,pf_id','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                              ?>
                                        </td>
                                       <td><?php 
                                                
                                                
                                                echo $getEmpFather['pf_id'];
                                              ?></td>
                                        <td>
                                              <?php 
                                                
                                                
                                                echo $getEmpFather['esic_id'];
                                              ?>
                                        
                                        </td>
                                      <td><?php
                                                  $desigId = $this->CommanModel->getDataIfdataexists('designation','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                                  $desigName = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation
                                                  ',array('id'=>$desigId['designation']));
                                                  echo  $desigName['designation_name'];
                                           ?>
                                      </td>
                                      <td><?php 
                                             $totalPresentDay[] = $item['PresentDay'];
                                             echo $item['PresentDay'];?></td>
                                             
                                             <td><?php
                                              $totalWeekOffDay[]  = $item['WeekOffDay'];
                                              echo $item['WeekOffDay'];?></td>
                                             <td><?php 
                                             $totalOtDay[]  =  $item['OTDay'];
                                             echo $item['OTDay'];?></td>
                                            
                                      <td><?php 
                                      
                                        $totalBasicSalary[] = $item['BasicSalary'];
                                      echo $item['BasicSalary'];
                                     
                                      
                                      ?></td>
                                     
                                       <td><?php
									   $payableall = explode(',', $item['CurrentAllowance']);
									   $alloaanceamount ='';
                                          foreach($payableall as $allawan){
                                            
                                            $Detailallwance = explode(':', $allawan);
											$alloaanceamount += $Detailallwance[1];
                                            
                                          
                                          }
                                        $allTotalAllowance[]  =  $alloaanceamount;
                                       echo $alloaanceamount;?></td>
                                       <td><?php 
                                       $totalGrossSlary[] =   $item['GrossSalary'];  
                                       echo $item['GrossSalary'];?></td>
                                        <td><?php
                                      $allPaybalBasicSalary[] = $item['PayableBasicSalary'];
                                      echo $item['PayableBasicSalary'];?></td>
                                      <td><?php
									   
                                        $allpayableTotalAllowance[]  =  $item['TotalAllowance'];
                                       echo $item['TotalAllowance'];?></td>
<td><?php
									   
                                        $TotalOTAMOUNT[]  =  $item['OTDayAmount'];
                                       echo $item['OTDayAmount'];?></td>
                                       <td><?php 
                                       $totalPayableGrossSlary[] =   $item['PayableGrossSalary'];  
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
                          foreach ($extraDeductionList as $extraDeduction):?>
                          <td>
                          <?php
                          $extraDeductDataItem='';
                          $extraDeductDataItem = explode(',', $item['ExtraDeduction']);
													foreach($extraDeductDataItem as $allextraDeduct){
                            $DetailextraDeduct='';
                               $DetailextraDeduct = explode(':', $allextraDeduct);
															 foreach ($extraDeductionList as $extraDeductionForAll){
                                 if($DetailextraDeduct[1] != '0'){  
                                    if($DetailextraDeduct[1] == $extraDeduction['id']){
                                          $totalextraDeductAmount[$extraDeduction['id']][]	= 	$DetailextraDeduct[3];
                                             echo  $DetailextraDeduct[3]; break 2;
                                    }
                                    
                                    }
															 }
															 
                          }
                          ?></td>
                          <?php
                        endforeach;
												
								?>
                <td>
                 <?php 
                          $cutextraDeduct='';
													$cutextraDeduct = explode(',', $item['ExtraDeduction']);
													foreach($cutextraDeduct as $oneextraDeduct){
                            $DetailextraDeductData='';
															 $DetailextraDeductData = explode(':', $oneextraDeduct);
															 if($DetailextraDeductData[1] == '0')
															 {
															  	$totalLoan[] =  $DetailextraDeductData[3];
																   echo  $DetailextraDeductData[3];
															 }
															 else{
																 $totalLoan[] = 0;
															 }
																  
															 
													}
                       
												
											?>
                         </td>              
                                       
                                        <!-- extra deduction -->
                                       		<td><?php 
                                            $allTotalExtra[]  = $item['TotalExtraDeduction'] + $item['TotalDeductionEP'];
                                            echo $item['TotalExtraDeduction'] + $item['TotalDeductionEP'];?></td>

                                            
                                            <td><?php 
                                            $allTotalNetSalary[]  =  $item['NetSalary'];
                                            echo $item['NetSalary'];?></td>
                                            
                                             <td></td>
                                             <td> <a href="<?php echo base_url('branchadmin/Employee/printSalary/'.$item['id']);?>" target="_blank">Print</a>
                                             <?php if($item['salary_type']=='AsPerClient'){?>
                                             | <a href="<?php echo base_url('Reports/ListOfDetailedSalary/'.$item['id']);?>" target="_blank">View Deatils</a>
                                             <?php }?> |
                                             <a href="<?php echo base_url('branchadmin/Setting/deleteSalary/'.$item['id']);?>" target="_blank" class="text-danger" onclick="return confirm('Are you sure? You want to delete!')">Delete</a>
                                             </td>




                                </tr>
                          <?php endforeach; ?>
                       
                      </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                          <th style="text-align:center;">TOTAL :</th>
                          <th><?php echo array_sum($totalPresentDay);?></th>
                          <th><?php echo array_sum($totalWeekOffDay);?></th>
                          <th><?php echo array_sum($totalOtDay);?></th>
                          <th> <?php echo array_sum($totalBasicSalary);?></th>
                          <th> <?php echo array_sum($allTotalAllowance);?></th>
                          <th> <?php echo array_sum($totalGrossSlary);?></th>
                          <th> <?php echo array_sum($allPaybalBasicSalary);?></th>
                          <th> <?php echo array_sum($allpayableTotalAllowance);?></th>
                          <th> <?php echo array_sum($TotalOTAMOUNT);?></th>
                          <th> <?php echo array_sum($totalPayableGrossSlary);?></th>
                          <?php foreach ($DeductionList as $deduction):
						  ?>
                          <th><?php echo array_sum($allTotal[$deduction['id']]);?></th>
                          	
                          <?php endforeach;?>
                              <?php 
                                      $extraDeductionList = $this->CommanModel->getList('id,extradeduction_name','tbl_extradeduction','id','ASC');
                                      foreach ($extraDeductionList as $extraDeduction): 
									           ?>
                                      	<th><?php echo array_sum($totalextraDeductAmount[$extraDeduction['id']]);?></th>
                                      <?php endforeach; ?>
                           <th> <?php echo array_sum($totalLoan);?> </th>
                           <th> <?php echo array_sum($allTotalExtra);?> </th> 
                          <th><?php echo array_sum($allTotalNetSalary);?></th>
                          
                          <th>
                         
                          </th>
                          <th>
                         
                          </th>
                         
                      
                          
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
 
  <script>
      
      
  </script>
 
 
 