 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Deduction Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Deduction Report</a>
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
                  <h4 class="card-title">Deduction Report</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   			<?php echo form_open_multipart('Reports/reportEPF', array('name'=>'addDepartment'));?>
                    
                             <div class="col-md-6">
                             			<?php echo $this->session->flashdata('msg'); ?>
                                          <div class="form-group">
													<?php echo form_label('All Deduction'); ?>
                                                        <select name="deductionId" class="form-control" id="deductid">
                                                        <option value="">Select</option>
                                                        <?php foreach($listDeduction as $item){?>
                                            			<option value="<?php echo $item['id'];?>"><?php echo $item['deduction_head'];?></option>
                                            		<?php }?>
                                          				</select>
                                         			<?php echo form_error('deductionId', '<p class="text-danger">', '</p>'); ?>
                                          </div>
                                          <div class="form-group ">
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
                                         <div class="form-group">
                                             <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                                             <?php echo form_close();?>
                                         </div>
                                          
                            
                            </div>
                  </div>
                  </div>
                 
                </div>
              	</div>
                
        <!-- Basic Inputs end -->
  
                </div>
            </div> 
           </div>
        </section>
      </div>
      
      		<?php if($deductionName['deduction_head'] == 'EPF'){?>
                      <div class="content-body">
                        <!-- Column selectors table -->
                        <section id="column-selectors">
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="card">
                              
                                <div class="card-header">
                                  <h4 class="card-title">EPF Report</h4>
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
                                    
                                        <tr>
                                          <th>SNo</th>
                                          <th>UAN</th>
                                          <th>Member Name</th> 
                                          <th>GrossWages</th> 
                                          <th>EPFWages</th>
                                          <th>EPSWages</th>
                                          <th>EDLIWages</th>
                                          <th>EPFContribution</th>	
                                          <th>EPSContribution</th>
                                          <th>EPFEPSDiff</th>	
                                          <th>ncpdays</th>
                                          <th>AdvRefund</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $i = 0;
                                        foreach($salaryList as $item):
															$getAll='';$getOne='';
                                                            $getAll =  explode(',',$item['ApplyDeduction']);
															for($r=0; $r < count($getAll); $r++){
                                                            $getOne = explode(':',$getAll[$r]);
															if($getOne[0]== $deductionName['id']){
                                                            $getEPF = (float)$getOne[2];
															$ALLOWEPR = true;
															break;
															}
															else{
																$ALLOWEPR = false;
															}
															}
												if($ALLOWEPR == true){
										?>
                                                      <tr>
                                                      <td><?=++$i?></td>
                                                     <td> 
                                                     <?php
                                                     $adhar =  $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
                                                     $Pfno =  $this->CommanModel->getDataIfdataexists('pf_id','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                                     echo $Pfno['pf_id'];
                                                     ?> </td>
                                                      <td> 
                                                     <?php
                                                     $empname =  $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
                                                     echo $empname['emp_name'];
                                                     ?> </td>
                                                     
                                                     <td><?=$item['PayableGrossSalary']; $GrossWages[] =$item['PayableGrossSalary']; ?></td>
                                                     <td><?=$item['PayableBasicSalary']; $EPFWages[]=$item['PayableBasicSalary']; ?></td>
                                                     <td><?php if($item['PayableBasicSalary'] < 15000){ echo $item['PayableBasicSalary'];$EPSWages[]=$item['PayableBasicSalary'];}else{echo '15000'; $EPSWages[]=15000;}?></td>
                                                     <td><?php if($item['PayableBasicSalary'] < 15000){ echo $item['PayableBasicSalary']; $EDLIWages[]=$item['PayableBasicSalary'];}else{echo '15000';$EDLIWages[]=15000;}?></td>
                                                         <?php 
                                                         	
															if($item['PayableBasicSalary'] > 15000){$amountonpf = 15000;}else{$amountonpf = $item['PayableBasicSalary'];}
                                                            $getEPS = round($amountonpf * 8.33 / 100);
                                                            $bothDiff = $getEPF - $getEPS;?>
                                                            <td><?php echo $getEPF; $EPFContribution[]=$getEPF;?>
                                                            </td><td><?php echo $getEPS ; $EPSContribution[]=$getEPS ;?>
                                                            </td><td><?php echo abs($bothDiff); $EPFEPSDiff[]=abs($bothDiff);?></td>
                                                     
                                                     
                                                       
                                                    
                                                      <td><?= $item['AbsentDay']; $ncpdays[]=$item['AbsentDay'];?></td>
                                                      <td></td>
                                                      
                                        
                                           </tr>
                                    
                            <?php } endforeach;?> 
                                       
                                      </tbody>
                                     <tfoot>
                                     <tr>
                                          <th></th>
                                          <th></th>
                                          <th>Total</th>
                                         
                                          <th><?php echo array_sum($GrossWages);?></th> 
                                          <th><?php echo array_sum($EPFWages);?></th>
                                          <th><?php echo array_sum($EPSWages);?></th>
                                          <th><?php echo array_sum($EDLIWages);?></th>
                                          <th><?php echo array_sum($EPFContribution);?></th>	
                                          <th><?php echo array_sum($EPSContribution);?></th>
                                          <th><?php echo array_sum($EPFEPSDiff);?></th>	
                                          <th><?php echo array_sum($ncpdays);?></th>
                                          <th>0</th>
                                          
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
             <?php }?>
			<?php if($deductionName['deduction_head'] == 'ESIC'){?>
                      <div class="content-body">
                        <!-- Column selectors table -->
                        <section id="column-selectors">
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="card">
                                    
                                <div class="card-header">
                                  <h4 class="card-title">ESIC Report</h4>
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
                                     
                                        
                                        <tr>
                                          <th>SNo</th>
                                          <th>IP Number </th>
                                          <th>IP Name</th> 
                                          <th>No of Days for which wages paid/payable during the month</th> 
                                          <th>Total Monthly Wages</th>
                                          <th>Reason Code for Zero workings days(numeric only; provide 0 for all other reasons- Click on the link for reference)</th>
                                          <th>Last Working Day</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $i = 0;
                                        foreach($salaryList as $item):?>
                                                      <tr>
                                                      <td><?=++$i?></td>
                                                     <td> 
                                                     <?php
                                                     $adhar =  $this->CommanModel->getDataIfdataexists('esic_id','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                                     echo $adhar['esic_id'];
                                                     ?> </td>
                                                      <td> 
                                                     <?php
                                                     $empname =  $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
                                                     echo $empname['emp_name'];
                                                     ?> </td>
                                                     
                                                     <td><?=$item['PresentDay']; $prasentdays[]=$item['PresentDay'];?></td>
                                                     <td><?=$item['PayableGrossSalary']; $payablegrosssallary[]=$item['PayableGrossSalary'];?></td>
                                                    
                                                    <td></td>
                                                    <td></td>
                                           </tr>
                                        <?php endforeach;?> 
                                       
                                      </tbody>
                                     <tfoot>
                                         
                                        <tr>
                                                      <th></th>
                                                     <th> 
                                                     Total</th>
                                                      <th> 
                                                     </th>
                                                     
                                                     <th><?=array_sum($prasentdays);?></th>
                                                     <th><?=array_sum($payablegrosssallary);?></th>
                                                    
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
           <?php }?>
           <?php if($deductionName['deduction_head'] != 'EPF' && $deductionName['deduction_head'] != 'ESIC' && $deductionName['id']!=''){?>
                      <div class="content-body">
                        <!-- Column selectors table -->
                        <section id="column-selectors">
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="card">
                                    
                                <div class="card-header">
                                  <h4 class="card-title"><?=$deductionName['deduction_head'];?> Report</h4>
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
                                        <tr>
                                          <th>SNo</th>
                                          <th>ID No.</th>
                                          <th>Member Name</th>
                                           <th>Department</th>
                                          
                                          <th><?=$deductionName['deduction_head'];?> Deduction</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $i = 0;
                                        foreach($salaryList as $item): 
										
													
													 $getAll='';$getOne='';
                                                            $getAll =  explode(',',$item['ApplyDeduction']);
															for($r=0; $r < count($getAll); $r++){
                                                            $getOne = explode(':',$getAll[$r]);
															if($getOne[0]== $deductionName['id']){
                                                            $ESIC = (float)$getOne[2];
                                                            $allOTherdeduction[]=$ESIC;
															if($ESIC !=''){
															$ALLOWEPR = TRUE;
															}
															else{
															$ALLOWEPR = FALSE;
															}
															break;
															}
															
															}
															
															
															
												if($ALLOWEPR == true){
													 ?>
                                                      <tr>
                                                      <td><?=++$i?></td>
                                                      <td> 
                                                     <?php
                                                     $empname =  $this->CommanModel->getDataIfdataexists('emp_code, emp_name','tbl_employee',array('id'=>$item['emp_id']));
													 $empoff =  $this->CommanModel->getDataIfdataexists('department','tbl_employee_official',array('emp_id'=>$item['emp_id']));
													 $depart =  $this->CommanModel->getDataIfdataexists('department_name','tbl_department',array('id'=>$empoff['department']));
                                                     echo $empname['emp_code'];
                                                     ?> </td>
                                                     <td><?php  echo $empname['emp_name'];?></td>	
                                                      <td><?php  echo $depart['department_name'];?></td>	
                                                    <td><?=$ESIC;?>
                                                     </td>
                                                    
                                           </tr>
                                        <?php } endforeach;?> 
                                        
                                      </tbody>
                                    <tfoot>
                                         <tr>
                                        <th></th>
                                         <th></th>
                                          <th></th>
                                          <th>Total</th>
                                          
                                          <th><?=array_sum($allOTherdeduction);?></th>
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
           <?php }?>	
              
      </div>
</div>



  
 
 
 