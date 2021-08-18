<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Application Form</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Application Form</a>
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
                  <h4 class="card-title">Application Form</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/applicationForm');?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Date of Apply'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>date('d/m/y'), 'placeholder'=>'dd/mm/yyyy', 'name' => 'date_of_apply','id'=>'date')); ?>
								<?php echo form_error('date_of_apply', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
                                <?php echo form_label('Department For'); ?>
                                <select class="form-control" name="department_id">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department){?>
                                <option value="<?php echo $department['id'];?>"><?php echo $department['department_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('department_id', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Designation For'); ?>
                                <select class="form-control" name="designation_id">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation){?>
                                <option value="<?php echo $designation['id'];?>"><?php echo $designation['designation_name'];?></option>
                                <?php }?>
                                </select>
                                <?php echo form_error('designation_id', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div class="form-group">
								<?php echo form_label('Applicant Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('applicant_name'), 'placeholder'=>'Applicant Name', 'name' => 'applicant_name')); ?>
								<?php echo form_error('applicant_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('father_name'), 'placeholder'=>'Father Name', 'name' => 'father_name')); ?>
								<?php echo form_error('father_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date of Birth'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('dob'), 'placeholder'=>'dd/mm/yyyy', 'name' => 'dob','id'=>'date1')); ?>
								<?php echo form_error('dob', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Mobile'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('mobile'), 'placeholder'=>'', 'name' => 'mobile','id'=>'mobile')); ?>
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                        <div class="col-md-4">
                         <div class="form-group">
                                <?php echo form_label('Gender'); ?>
                                <select class="form-control" name="gender">
                                <option value="" selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                                
                            </div>
                   			<div class="form-group">
                                <?php echo form_label('Marital Status'); ?>
                                <select class="form-control" name="marital_status">
                                <option value="" selected>Select</option>
                                <option value="Single">Single</option>
                                <option value="Maried">Maried</option>
                                </select>
                                
                            </div>
                             <div class="form-group">
								<?php echo form_label('Education Qualification'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('edu_qua'), 'placeholder'=>'Education Qualification', 'name' => 'edu_qua')); ?>
								<?php echo form_error('edu_qua', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Prof/Tech. Qualification'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('tech_qua'), 'placeholder'=>'Prof/Tech. Qualification', 'name' => 'tech_qua')); ?>
								<?php echo form_error('tech_qua', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Work Experiance'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('work_exp'), 'placeholder'=>'Work Experiance', 'name' => 'work_exp')); ?>
								<?php echo form_error('work_exp', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Last Salary'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('last_salary'), 'placeholder'=>'Last Salary', 'name' => 'last_salary')); ?>
								<?php echo form_error('last_salary', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Expected Salary'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('expected_salary'), 'placeholder'=>'Expected Salary', 'name' => 'expected_salary')); ?>
								<?php echo form_error('expected_salary', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                                 
                            
                            </div>    
                            
                    <div class="col-md-4">
                    		<div class="form-group">
								<?php echo form_label('Notice Period'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('notice_period'), 'placeholder'=>'Notice Period', 'name' => 'notice_period')); ?>
								<?php echo form_error('notice_period', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Address'); ?>
                                <?php echo form_textarea(array('class'=>'form-control', 'value'=>set_value('address'), 'placeholder'=>'Address...', 'name' => 'address')); ?>
								<?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('City'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('city'), 'placeholder'=>'City', 'name' => 'city')); ?>
								<?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('State'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('state'), 'placeholder'=>'State', 'name' => 'state')); ?>
								<?php echo form_error('state', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Country'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('country'), 'placeholder'=>'Country', 'name' => 'country')); ?>
								<?php echo form_error('country', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                            <?php echo form_label('Attached Resume'); ?>
                                <input type="file" name="resume" />
                            </div>
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
                  <h4 class="card-title">Application</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Application List</h4>
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
                    
                    <table class="table table-striped table-bordered compact table-responsive">
                      <thead>
                      <th>Applicant Name</th>
                      <th>Father Name</th>
                      <th>Mobile No.</th>
                      <th>Date Of Apply</th>
                      <th>Department Name</th>
                      <th>Designation Name</th>
                      <th>Application Status</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Offer Letter</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($applicationList as $application) { ?>
                                    <tr>
                                        <td><?php echo $application['applicant_name']; ?></td>
                                        <td><?php echo $application['father_name']; ?></td>
                                        <td><?php echo $application['mobile']; ?></td>
                                        <td><?php echo $application['date_of_apply']; ?></td>
                                        <td><?php echo $application['department_name']; ?></td>
                                        <td><?php echo $application['designation_name']; ?></td>
                                        <td><?php echo $application['application_status']; ?></td>
                                       
                                        <td><?php echo ($application['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Hresource/editapplicationForm/'.$application['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo site_url('branchadmin/Hresource/offerLetter/'.$application['id'])?>" >Generate</a>
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