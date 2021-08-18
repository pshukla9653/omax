<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Grade Base Salary</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Grade Base Salary</a>
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
                  <h4 class="card-title">Grade Base Salary</h4>
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editGradeBaseSalary/'.$GradeBaseSalaryList['id'], array('name'=>'GradeBaseSalary'));?>
                   <div class="col-md-12">
                     <input type="hidden" name="hidetxt" value="<?php echo $GradeBaseSalaryList['id']?>">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                                <select class="form-control" name="grade_id">
                                <option value="">Select</option>
                                <?php foreach($gradeList as $grade){?>
                                <option value="<?php echo $grade['id'];?>" <?php if($GradeBaseSalaryList['grade_id'] == $grade['id']) {?> selected<?php }?>><?php echo $grade['grade_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('grade_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Department'); ?>
                                <select class="form-control" name="department_id">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department){?>
                                <option value="<?php echo $department['id'];?>" <?php if($GradeBaseSalaryList['department_id'] == $department['id']) {?> selected<?php }?>><?php echo $department['department_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('department_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Designation'); ?>
                                <select class="form-control" name="designation_id">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation){?>
                                <option value="<?php echo $designation['id'];?>" <?php if($GradeBaseSalaryList['designation_id'] == $designation['id']) {?> selected<?php }?>><?php echo $designation['designation_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('designation_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                              <label>Deduction :</label>
                              <div class="c-inputs-stacked">
                               <?php
							   $deduction_ids='';
							   $deduction_ids = explode(',', $GradeBaseSalaryList['deduction_id']);
							   
							    foreach($deductionList as $deduction){
								
								?>
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="deduction_id[]" value="<?php echo $deduction['id'];?>"
                                  <?php if(in_array($deduction['id'], $deduction_ids)==true){echo 'Checked';}?>
                                  />
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description ml-0"><?php echo $deduction['deduction_head'];?></span>
                                </label>
                                <?php }?>
                               
                              </div>
                            </div>
                           <div class="form-group">
                              <label>Income Tax :</label>
                              <div class="c-inputs-stacked">
                               
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="income_tax" value="1"
                                  <?php echo $GradeBaseSalaryList['income_tax']=='1'?'checked':'';?>
                                  />
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description ml-0">Yes</span>
                                </label>
                                
                               
                              </div>
                            </div>
                            
                            </div>
                            
                    <div class="col-md-6">
                    <div class="form-group">
								<?php echo form_label('Basic Salary'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$GradeBaseSalaryList['basic_salary'], 'placeholder'=>'Basic Salary', 'name' => 'basic_salary')); ?>
								<?php echo form_error('basic_salary', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                             <?php 
					$arr = explode(',',$GradeBaseSalaryList['allowance']);
						for($i=0;$i<count($arr);$i++){
							$res = explode('-',$arr[$i]);
							$allow[$res[0]]=$res[1];
						}
						
					foreach($allowanceList as $allowance):
							if(array_key_exists($allowance['id'], $allow)){
								
								$allovalue = $allow[$allowance['id']];
								}else{
									$allovalue = '';
									}	
					?>
                           
                            <div class="form-group">
								<?php echo form_label($allowance['allowance_name']); ?>
                               <?php 
								 
								 echo form_input(array('class'=>'form-control', 'value'=>$allovalue, 'placeholder'=>$allowance['allowance_name'], 'name' => 'allowance['.$allowance['id'].']')); ?>
								<?php echo form_error('allowance['.$allowance['id'].']', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <?php
							endforeach;?>
                            
                            
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
                            </div>
                            
                            </div>
                    
                     <div class="col-md-6">
                  <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
                  </div>
                  </div>
                  
                  
                  </div>
                  </div>
                 
                </div>
              </div>
              
              
            </div>
            
          </div>
        </section>
        </div>
       </div>
 </div>