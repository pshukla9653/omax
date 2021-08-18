<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Deduction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Add Deduction</a>
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
                  <h4 class="card-title">Add Deduction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/addDeduction', array('name'=>'addDeduction'));?>
                   <div class="col-md-12"  id="errorMsg">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                            <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Type of Deduction<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="type_of_deduction" id="typeofdeduction" autofocus>
                                <option value="" selected>Select</option>
                                <option value="Regular">Regular</option>
                                <option value="Temperary">Temporary</option>
                                </select>
                               <?php echo form_error('type_of_deduction', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div id='fortypeofdeduction'>
                             <div class="col-md-6">
                             <div class="form-group" id="sandbox-container">
								<?php echo form_label('Date From<span class="text-danger">*</span>'); ?>
                                <div class="input-daterange" id="datepicker">
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('date_from'), 'placeholder'=>'Date From', 'name' => 'date_from')); ?>
                                </div>
                                <?php echo form_error('date_from', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             <div class="col-md-6">
                             <div class="form-group" id="sandbox-container">
								<?php echo form_label('Date To<span class="text-danger">*</span>'); ?>
                                <div class="input-daterange" id="datepicker">
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('date_to'), 'placeholder'=>'Date To', 'name' => 'date_to')); ?>
                                </div>
                                <?php echo form_error('date_to', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
                                <?php echo form_label('Mode of Deduction<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="mode_of_deduction" id="modeofdeduction">
                                <option value="" selected>Select</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Calculated">Calculated</option>
                                </select>
                               <?php echo form_error('mode_of_deduction', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Deduction Head<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('deduction_head'), 'placeholder'=>'Deduction Name', 'name' => 'deduction_head')); ?>
								<?php echo form_error('deduction_head', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div id="formodeofdeduction">
                           
                            
                            <div class="col-md-12">
                            
                                 <div class="form-group">
                                <?php echo form_label('Deduction Applied On'); ?>
                                <select class="form-control" name="deduction_applied_on">
                                <option value="" selected>Select</option>
                                <option value="-1">BASIC SALARY</option>
                                <option value="-2">GROSS SALARY</option>
                                <option value="-3">NET SALARY</option>
                                <option value="-4">TAKE HOME SALARY</option>
                                <option value="-5">OT</option>
                                <?php foreach($allowanceList as $allowance){?>
                                <option value="<?php echo $allowance['id'];?>"><?php echo $allowance['allowance_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('deduction_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                            <div class="col-md-12">
                            
                                 <div class="form-group">
                                <?php echo form_label('Deduction Not Applied On <span class="text-danger">(If Any)</span>'); ?>
                                <select class="form-control" name="deduction_not_applied_on">
                                <option value="0" selected>Select</option>
                                <option value="-1">BASIC SALARY</option>
                                <option value="-2">GROSS SALARY</option>
                                <option value="-3">NET SALARY</option>
                                <option value="-4">TAKE HOME SALARY</option>
                                <option value="-5">OT</option>
                                <?php foreach($allowanceList as $allowance){?>
                                <option value="<?php echo $allowance['id'];?>"><?php echo $allowance['allowance_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('deduction_not_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                            </div>
                            
                             </div>
                             <div class="col-md-6">
                              <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Employee Contribution<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('employee_contribution'), 'placeholder'=>'Eg. 3.6/1000', 'name' => 'employee_contribution')); ?>
								<?php echo form_error('employee_contribution', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Employer Contribution'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'Eg. 3.6/1000', 'name' => 'employer_contribution')); ?>
								<?php echo form_error('employer_contribution', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Deduction Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'Minimum', 'name' => 'min_deduction_limit')); ?>
								<?php echo form_error('min_deduction_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Deduction Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'Maximum', 'name' => 'max_deduction_limit')); ?>
								<?php echo form_error('max_deduction_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Salary Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'Minimum', 'name' => 'min_salary_limit')); ?>
								<?php echo form_error('min_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Salary Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'Maximum', 'name' => 'max_salary_limit')); ?>
								<?php echo form_error('max_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
                            </div>
                            <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            </div>
                            
                           
                   
                    
                     
                  
                  <?php echo form_close();?>
                  
                  </div>
                  
                  
                  
                  </div>
                  
                 
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Deduction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   
                  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Deduction List</h4>
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
                      <th>Deduction Name</th>
                      <th>Type of Deduction</th>
                     <th>Mode of Deduction</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($deductionList as $deduction) { ?>
                                    <tr>
                                        <td><?php echo $deduction['deduction_head']; ?></td>
                                        <td><?php echo $deduction['type_of_deduction']; ?></td>
                                       <td><?php echo $deduction['mode_of_deduction']; ?></td>
                                        <td><?php echo ($deduction['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editDeduction/'.$deduction['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
        </section>
        </div>
       </div>
 </div>
