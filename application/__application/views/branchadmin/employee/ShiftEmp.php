<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Shift Management</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Shift Management</a>
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
                  <h4 class="card-title">Shift Management</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Employee/ShiftEmp', array('name'=>'ShiftEmp'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             
                            <div class="col-md-6">
                             <div class="form-group">
								<?php echo form_label('Client Name'); ?>
                                <select name="client_id" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($clientList as $client){?>
                                 <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Service'); ?>
                                <select class="form-control" name="service_id" id="service_id">
                                <option value="">Select</option>
                                <?php foreach($serviceList as $service){?>
                                <option value="<?php echo $service['id'];?>"><?php echo $service['service_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('service_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Sub Service'); ?>
                                <select class="form-control" name="subservice_id" id="subservice_id">
                                <option value="">Select</option>
                                
                                </select>
								<?php echo form_error('subservice_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Employee Name'); ?>
                                <select name="emp_id" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($empList as $emp){?>
                                 <option value="<?php echo $emp['id'];?>"><?php echo $emp['emp_name'].' ('.$emp['emp_code'].')';?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('emp_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date From'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('date_from'), 'name' => 'date_from','id'=>'date')); ?>
								<?php echo form_error('date_from', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date To'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('date_to'), 'name' => 'date_to','id'=>'date1')); ?>
								<?php echo form_error('date_to', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  </div>
                  <?php echo form_close();?>
                  
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