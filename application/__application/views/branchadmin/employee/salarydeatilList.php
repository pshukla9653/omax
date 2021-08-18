<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Employee</h3>
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
            
 
      <div class="content-body">
       
        <!-- Column selectors table -->
        <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
              
                <div class="card-header">
                  <h4 class="card-title">Salary List</h4>
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
                        
					           ?>
                        <tr>
                          <th colspan="16"></th>
                          <th colspan="<?php echo $allcoun;?>" style="text-align:center;">Allowance</th>
                          <th></th>
                          <th></th>
                          <th></th>
                         <th></th>
                          <th colspan="<?php echo $allowcount;?>" style="text-align:center;">Deduction</th>
                          
                          <th></th>
                          <th></th>
                          
                        </tr>
                        <tr>
                           <th>SNo</th>
                          <th>ID No.</th>
                          <th>Emp Code</th>
                          <th>Employee Name</th>
                          
                          <th>Father's Name</th>
                          <th>UAN No.</th>
                          <th>ESI No</th>
                          <th>Designation</th>
                          <th>Client Name</th>
                          <th>Designation For</th>
                          <th>Present Days</th>
                          <th>Absent Days</th>
                          <th>W/O</th>
                          <th>OT Days</th>
                          <th>Actual Basic Salary</th>
                          <th>Paybal Basic salary</th>
                          <?php 
                                      $AllowanceList= $this->CommanModel->getList('id,allowance_name','tbl_allowance','id','ASC');
                                      foreach ($AllowanceList as $allowance): ?>
                                      <th><?=$allowance['allowance_name']?></th>

                                       <?php endforeach; ?>
                                       
                          <th>Total Allowance</th>	
                          <th>Gross Salary</th>
                          <th>OT Amount</th>
                          <th>Paybal Gross Salary</th>
                          <?php 
                                      $DeductionList= $this->CommanModel->getList('id,deduction_head','tbl_deduction_head','id','ASC');
                                      foreach ($DeductionList as $deduction): ?>
                                      <th><?=$deduction['deduction_head']?></th>
                                      <?php endforeach; ?>
                          
                               
                          <th>Total Deduction</th>	
                          <th>Net Salary</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                       
						  <?php  
						  $i = 0;
						  foreach ($salaryList as $item): ?>
                                 <tr>
                                      <td><?=++$i?></td> 
                                      <td><?=$item['emp_id']?></td>
                                      <td><?=$item['emp_code']?></td>
                                      <td><?php
                                      $getEmpName = $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
									  echo $getEmpName['emp_name'];
									  ?></td>
                                      
                                      <td>
                                              <?php 
                                                
                                                $getEmpFather =   $this->CommanModel->getDataIfdataexists('father_name','tbl_employee',array('id'=>$item['emp_id']));
                                                echo  $getEmpFather['father_name'];
                                              ?>
                                        </td>
                                       <td></td>
                                        <td>
                                              <?php 
                                                
                                                $getEmpFather =   $this->CommanModel->getDataIfdataexists('esic_id','tbl_employee_official',array('emp_id'=>$item['emp_id']));
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
                                      $getClientName = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$item['clientid']));
                                      
									  echo $getClientName['client_name'];
									  ?></td>
                                      <td><?php
                                                  
												  
												  $desigNameD = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation
                                                  ',array('id'=>$item['subserviceid']));
                                                  echo  $desigNameD['designation_name'];
                                           ?>
                                      </td>
                                      <td><?php 
                                      
                                        $totalP[] = $item['PresentDay'];
                                      echo $item['PresentDay'];
                                     
                                      
                                      ?></td>
                                      <td><?php 
                                      
                                        $totalA[] = $item['AbsentDay'];
                                      echo $item['AbsentDay'];
                                     
                                      
                                      ?></td>
                                       <td><?php 
                                      
                                        $totalW[] = $item['WeekOffDay'];
                                      echo $item['WeekOffDay'];
                                     
                                      
                                      ?></td>
                                      <td><?php 
                                      
                                        $totalOT[] = $item['OTDay'];
                                      echo $item['OTDay'];
                                     
                                      
                                      ?></td>
                                      <td><?php 
                                      
                                        $totalBasicSalary[] = $item['BasicSalary'];
                                      echo $item['BasicSalary'];
                                     
                                      
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
                                              $ALLLO[$allowance['id']][]  =  $alloaanceamount;
											  break;
                                            }
                                            else{
                                              $alloaanceamount =  0;

                                            } 
                                          
                                          }
                                          ?>
                                                            
                                                            
                                            
                                            <td><?php echo $alloaanceamount;?></td>
										   
										                   <?php  endforeach; ?>

                                       <td><?php
                                        $allTotalAllowance[]  =  $item['TotalAllowance'];
                                       echo $item['TotalAllowance'];?></td>
                                       <td><?php 
                                       $totalGrossSlary[] =   $item['GrossSalary'];  
                                       echo $item['GrossSalary'];?></td>
										<td><?php 
                                       $totalOTDayAmount[] =   $item['OTDayAmount'];  
                                       echo $item['OTDayAmount'];?></td>
                                       <td><?php 
                                       $totalPayableGrossSalary[] =   $item['PayableGrossSalary'];  
                                       echo $item['PayableGrossSalary'];?></td>
                                        <?php 
                                     
                                                            foreach ($DeductionList as $deduction): 
                                            $payableall = explode(',', $item['ApplyDeduction']);
                                          foreach($payableall as $allawan){
                                            
                                            $Detailallwance = explode(':', $allawan);
											                      
                                            if($deduction['id'] == $Detailallwance[0]){
                                              $alloaanceamount = (float)$Detailallwance[2];
                                              if($deduction['deduction_head'] == 'EPF'){
                                                $allTotalAlow[$deduction['id']][]  = $alloaanceamount;
                                              }else if($deduction['deduction_head'] == 'ESIC'){
                                                $allTotalAlow[$deduction['id']][]   =   $alloaanceamount;    
                                              }else{
												  $allTotalAlow[$deduction['id']][]   =   $alloaanceamount; 
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
                                       	

                                            <td><?php 
                                            $allTotalDeductionEp[]  = $item['TotalDeductionEP'];
                                            echo $item['TotalDeductionEP'];?></td>
                                            <td><?php 
                                            $allTotalNetSalary[]  =  $item['NetSalary'];
                                            echo $item['NetSalary'];?></td>
                                            
                                             
                                             




                                </tr>
                          <?php endforeach; ?>
                       
                      </tbody>
                      <tfooter>
                      <tr>
                          <th colspan="10" style="text-align:center;">TOTAL :</th>
                          <th> <?php echo array_sum($totalP);?></th>
                          <th> <?php echo array_sum($totalA);?></th>
                          <th> <?php echo array_sum($totalW);?></th>
                          <th> <?php echo array_sum($totalOT);?></th>
                          <th> <?php echo array_sum($totalBasicSalary);?></th>
                          <th> <?php echo array_sum($allPaybalBasicSalary);?></th>
                          <?php foreach ($AllowanceList as $allowance): ?>
                                      <th><?=array_sum($ALLLO[$allowance['id']]);?></th>

                                       <?php endforeach; ?>
                          <th> <?php echo array_sum($allTotalAllowance);?></th>
                          <th> <?php echo array_sum($totalGrossSlary);?></th>
                          <th> <?php echo array_sum($totalOTDayAmount);?></th>
                          <th> <?php echo array_sum($totalPayableGrossSalary);?></th>
                          <?php foreach ($DeductionList as $deduction):?>
                          <th><?php echo array_sum($allTotalAlow[$deduction['id']]);?></th>
                          	
                          <?php endforeach;?>
                          
                                       
                          <th> <?php echo array_sum($allTotalDeductionEp);?> </th>
                          <th><?php echo array_sum($allTotalNetSalary);?></th>
                          
                          
                          
                         
                          </th>
                          
                      
                          
                        </tr>
                      
                      </tfooter>
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
 
  
 
 
 