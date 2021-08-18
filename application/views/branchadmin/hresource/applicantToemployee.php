<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Applicant To Employee</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Applicant To Employee</a>
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
                  <h4 class="card-title">Applicant To Employee</h4>
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/createConvertEmployee/'.$empdetails['id']);?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Applicant Name : <strong>'.$empdetails['applicant_name'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name : <strong>'.$empdetails['father_name'].'</strong>'); ?>
                             </div>   
                            <div class="form-group">
								<?php echo form_label('Date of Birth : <strong>'.$empdetails['dob'].'</strong>'); ?>
                             </div> 
                             <div class="form-group">
								<?php echo form_label('Address : <strong>'.$empdetails['address'].'</strong>'); ?>
                             </div> 
                             <div class="form-group">
								<?php echo form_label('City : <strong>'.$empdetails['city'].'</strong>'); ?>
                             </div> 
                             <div class="form-group">
								<?php echo form_label('Mobile : <strong>'.$empdetails['mobile'].'</strong>'); ?>
                             </div> 
                            </div>
                            
                        <div class="col-md-4">
                            
                            <div class="form-group">
								<?php echo form_label('Designation : <strong>'.$empdesignation['post_offered'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Education Qualifition : <strong>'.$empdetails['edu_qua'].'</strong>'); ?>
                             </div>   
                            <div class="form-group">
								<?php echo form_label('Gender : <strong>'.$empdetails['gender'].'</strong>'); ?>
                             </div> 
                             
                            </div>    
                            
                    <div class="col-md-4">
                    
                           <div class="form-group">
								<?php echo form_label('Employee Code'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('empcode'), 'placeholder'=>'', 'name' => 'empcode')); ?>
								<?php echo form_error('empcode', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Department'); ?>
                                 <?php 
								$emp = $this->CommanModel->getDataByFieldName('department_name','tbl_department');
								
								?>
                                
                                <select name="department" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($emp as $employee) { ?>
                               <option value="<?php echo $employee['department_name']?>"><?php echo $employee['department_name']?></option>
                                 <?php } ?>
                                </select>
								<?php echo form_error('department', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            <div class="form-group">
								<?php echo form_label('Report To'); ?>
                                 <?php 
								$emp1 = $this->CommanModel->getDataByFieldName('emp_name,emp_code','tbl_employee');
								
								?>
                                
                                <select name="reportto" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($emp1 as $employee1) { ?>
                               <option value="<?php echo $employee1['emp_code']?>"><?php echo $employee1['emp_name']?></option>
                                 <?php } ?>
                                </select>
								<?php echo form_error('reportto', '<p class="text-danger">', '</p>'); ?>
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
                  <h4 class="card-title">Applicant To Employee</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Applicant To Employee</h4>
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