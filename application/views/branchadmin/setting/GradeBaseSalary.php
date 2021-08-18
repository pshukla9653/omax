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
                   <?php echo form_open_multipart('branchadmin/Setting/GradeBaseSalary', array('name'=>'GradeBaseSalary'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                                <select class="form-control" name="grade_id" autofocus>
                                <option value="">Select</option>
                                <?php foreach($gradeList as $grade){?>
                                <option value="<?php echo $grade['id'];?>"><?php echo $grade['grade_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('grade_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Department'); ?>
                                <select class="form-control" name="department_id">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department){?>
                                <option value="<?php echo $department['id'];?>"><?php echo $department['department_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('department_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Designation'); ?>
                                <select class="form-control" name="designation_id">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation){?>
                                <option value="<?php echo $designation['id'];?>"><?php echo $designation['designation_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('designation_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                              <label>Deduction :</label>
                              <div class="c-inputs-stacked">
                               <?php
							   //$deduction_ids = explode(',', $editdclient[0]['deduction_id']);
							   
							    foreach($deductionList as $deduction){
								
								?>
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="deduction_id[]" value="<?php echo $deduction['id'];?>"
                                  <?php //if(in_array($deduction['id'], $deduction_ids)==true){echo 'Checked';}?>
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
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('basic_salary'), 'placeholder'=>'Basic Salary', 'name' => 'basic_salary')); ?>
								<?php echo form_error('basic_salary', '<p class="text-danger">', '</p>'); ?>
                            </div>
                    <?php foreach($allowanceList as $allowance){?>
                            <div class="form-group">
								<?php echo form_label($allowance['allowance_name']); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('allowance['.$allowance['id'].']'), 'placeholder'=>$allowance['allowance_name'], 'name' => 'allowance['.$allowance['id'].']')); ?>
								<?php echo form_error('allowance['.$allowance['id'].']', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <?php }?>
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
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
              
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Grade Base Salary</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Grade Base Salary List</h4>
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
                    
                    <table class="table table-striped table-bordered compact">
                      <thead>
                      <th>Id</th>
                      <th>Grade Name</th>
                      <th>Department Name</th>
                      <th>Designation Name</th>
                      <th>Basic Salary</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($GradeBaseSalaryList as $grade) { ?>
                                    <tr>
                                       <td><?php echo $grade['id']; ?></td>
                                       <td><?php echo $grade['grade_name']; ?></td>
                                       <td><?php echo $grade['department_name']; ?></td>
                                       <td><?php echo $grade['designation_name']; ?></td>
                                       <td><?php echo $grade['basic_salary']; ?></td>
                                        <td><?php echo ($grade['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('branchadmin/Setting/editGradeBaseSalary/'.$grade['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                      
                      
                    </table>
                  
                  </div>
                </div>
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