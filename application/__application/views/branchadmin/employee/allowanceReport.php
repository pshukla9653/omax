 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Allownace Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Allownace Report</a>
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
                  <h4 class="card-title">Allownace Report</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   			<?php echo form_open_multipart('Reports/allowanceReport', array('name'=>'allowanceReport'));?>
                    
                             <div class="col-md-6">
                             			<?php echo $this->session->flashdata('msg'); ?>
                                          <div class="form-group">
													<?php echo form_label('All Allownance'); ?>
                                                        <select name="allowanceId" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php foreach($allowanceList as $item){?>
                                            			<option value="<?php echo $item['id'];?>"><?php echo $item['allowance_name'];?></option>
                                            		<?php }?>
                                          				</select>
                                         			<?php echo form_error('allowanceId', '<p class="text-danger">', '</p>'); ?>
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
      
                      <div class="content-body">
                        <!-- Column selectors table -->
                        <section id="column-selectors">
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="card">
                                    
                                <div class="card-header">
                                  <h4 class="card-title"><?php echo $allowanceName['allowance_name'];?> Report</h4>
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
                                          <th>UAN No.</th>
                                          <th>Member Name</th>
                                          <th>Basic Salary</th> 
                                          <th>Allowance</th> 
                                          <th>Gross</th>
                                          <th>Earn Basic </th>
                                          <th>Earn Allowance</th>
                                          <th>Earn Gross </th>
                                          <th>Total Ded.</th>
                                          <th>Net Salary</th>
                                          <th>Bank Account No.</th>
                                          <th>IFSC</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $a = 1;
                                        foreach($allowanceData as $item): $empname=''; $empoffical='';?>
                                                      <tr>
                                                      <td><?=$a?></td>
                                                       <td><?php $empname =  $this->CommanModel->getDataIfdataexists('emp_code,emp_name','tbl_employee',array('id'=>$item['emp_id']));
													   $empoffical =  $this->CommanModel->getDataIfdataexists('pf_id,account_no,ifsc_code','tbl_employee_official',array('emp_id'=>$item['emp_id']));
													   echo $empname['emp_code'];?></td>
                                                        <td> 
                                                     <?php
                                                     
                                                     echo $empoffical['pf_id'];
                                                     ?> </td>
                                                      <td> 
                                                     <?php
                                                     
                                                     echo $empname['emp_name'];
                                                     ?> </td>
                                                     <td><?=$item['BasicSalary']; $TOTALBASIC[] =$item['BasicSalary']; ?></td>
                                                    
                                                     <td>
                                                     	 <?php
														 $getAll =  explode(',',$item['CurrentAllowance']);
														 for($i = 0; $i< count($getAll) ;$i++){
														 $getOne =  explode(':',$getAll[$i]);
														     if($getOne[0] == $allowanceId){
															 	echo $getOne[1]; $TOTALALLOWA[]=$getOne[1];
															 }
															  
														 }
														 ?>
                                                     </td>
                                                     <td><?=$item['GrossSalary']; $TOTALGROSS[]=$item['GrossSalary']; ?></td>
                                                      <td><?=$item['PayableBasicSalary']; $PAYBASIC[]=$item['PayableBasicSalary'];?></td>
                                                    <td>
													  <?php
														 $getAll =  explode(',',$item['PayableAllowance']);
														 for($i = 0; $i< count($getAll) ;$i++){
														 $getOne =  explode(':',$getAll[$i]);
														     if($getOne[0] == $allowanceId){
															 	echo $getOne[1]; $ERONALLOW[]=$getOne[1];
															 }
															  
														 }
														 ?>
                                                     </td>	
                                                     <td><?=$item['PayableGrossSalary']; $PAYGROSS[]=$item['PayableGrossSalary'];?></td>
                                                    <td><?=$item['TotalDeductionEP']; $TOTALDEDUC[]=$item['TotalDeductionEP'];?></td>
                                                    <td><?=$item['TakeHomeSalary']; $TOTALNET[]=$item['TakeHomeSalary'];?></td>
                                                   <td><?php
                                                     
                                                     echo $empoffical['account_no'];
                                                     ?> </td>
                                                     <td><?php
                                                     
                                                     echo $empoffical['ifsc_code'];
                                                     ?> </td>
                                                    
                                                    
                                           </tr>
                                        <?php $a++; endforeach;?> 
                                       
                                      </tbody>
                                     <tfoot>
                                        <tr>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th>Total</th>
                                          <th><?=array_sum($TOTALBASIC);?></th> 
                                          <th><?=array_sum($TOTALALLOWA);?></th> 
                                          <th><?=array_sum($TOTALGROSS);?></th> 
                                           <th><?=array_sum($PAYBASIC);?></th> 
                                          <th><?=array_sum($ERONALLOW);?></th> 
                                           <th><?=array_sum($PAYGROSS);?></th>
                                          <th><?=array_sum($TOTALDEDUC);?></th>
                                         <th><?=array_sum($TOTALNET);?></th>
                                          <th>-</th>
                                          <th>-</th>
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
           	
      </div>
</div>



  
 
 
 