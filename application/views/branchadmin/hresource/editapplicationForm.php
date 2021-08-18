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
                  <h4 class="card-title">Application Form (Update)</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/editapplicationForm/'.$editapplicant[0]['id']);?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                             <?php /*?><div class="form-group">
                				<label>Select From Date</label>
								<div class="input-group date">
									
                                	<input type="text" name="from_date" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y');?>" placeholder="dd/mm/yyyy" data-date-format='dd/mm/yyyy'/>
                                </div>
                                <?php echo form_error('from_date', '<p class="text-danger">', '</p>');?>
							 </div><?php */?>
                             
                             
                             <div class="form-group">
								<?php echo form_label('Date of Apply'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>date('d/m/y', $editapplicant[0]['date_of_apply']), 'placeholder'=>'dd/mm/yyyy', 'name' => 'date_of_apply','id'=>'date')); ?>
								<?php echo form_error('date_of_apply', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
                                <?php echo form_label('Department For'); ?>
                                <select class="form-control" name="department_id">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department){?>
                                <option value="<?php echo $department['id'];?>"<?php echo $editapplicant[0]['department_id']==$department['id']?'selected':'';?>><?php echo $department['department_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('department_id', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Designation For'); ?>
                                <select class="form-control" name="designation_id">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation){?>
                                <option value="<?php echo $designation['id'];?>" <?php echo $editapplicant[0]['designation_id']==$designation['id']?'selected':'';?>><?php echo $designation['designation_name'];?></option>
                                <?php }?>
                                </select>
                                <?php echo form_error('designation_id', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div class="form-group">
								<?php echo form_label('Applicant Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editapplicant[0]['applicant_name'], 'placeholder'=>'Applicant Name', 'name' => 'applicant_name')); ?>
								<?php echo form_error('applicant_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editapplicant[0]['father_name'], 'placeholder'=>'Father Name', 'name' => 'father_name')); ?>
								<?php echo form_error('father_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date of Birth'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>date('d/m/y', $editapplicant[0]['dob']), 'placeholder'=>'dd/mm/yyyy', 'name' => 'dob','id'=>'date')); ?>
								<?php echo form_error('dob', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                            
                            
                    <div class="col-md-6">
                    <div class="form-group">
								<?php echo form_label('Mobile No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editapplicant[0]['mobile'], 'placeholder'=>'Mobile No', 'name' => 'mobile','id'=>'mobile')); ?>
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Address'); ?>
                                <?php echo form_textarea(array('class'=>'form-control', 'value'=>$editapplicant[0]['address'], 'placeholder'=>'Address...', 'name' => 'address')); ?>
								<?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
                                <?php echo form_label('Application Status'); ?>
                                <select class="form-control" name="application_status">
                                <option value="Applied" <?php echo $editapplicant[0]['application_status']=='Applied'?'selected':'';?>>Applied</option>
                                <option value="Offered" <?php echo $editapplicant[0]['application_status']=='Offered'?'selected':'';?>>Offered</option>
                                <option value="Confirmed" <?php echo $editapplicant[0]['application_status']=='Confirmed'?'selected':'';?>>Confirmed</option>
                                <option value="Appointed" <?php echo $editapplicant[0]['application_status']=='Appointed'?'selected':'';?>>Appointed</option>
                                <option value="Rejected" <?php echo $editapplicant[0]['application_status']=='Rejected'?'selected':'';?>>Rejected</option>
                                </select>
                                
                            </div>
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" <?php echo $editapplicant[0]['status']==1?'selected':'';?>>Active</option>
                                <option value="0" <?php echo $editapplicant[0]['status']==0?'selected':'';?>>Inactive</option>
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
              
              <div class="card">
                <div class="card-header">
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Application Form List</h4>
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