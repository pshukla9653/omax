<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Client Services Mapping</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Client Services Mapping</a>
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
                  <h4 class="card-title">Client Services Mapping</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/ClientServiceMap', array('name'=>'ClientServiceMap'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Client'); ?>
                                <select class="form-control select2" name="client_id" autofocus>
                                <option value="">Select</option>
                                <?php foreach($clientList as $client){?>
                                <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Service'); ?>
                                <select class="form-control" name="service_id">
                                <option value="">Select</option>
                                <?php foreach($serviceList as $service){?>
                                <option value="<?php echo $service['id'];?>"><?php echo $service['service_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('service_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Sub Services'); ?>
                                <select class="form-control select2" name="subservice_id">
                                <option value="">Select</option>
                                <?php foreach($DesignationList as $service){?>
                                <option value="<?php echo $service['id'];?>"><?php echo $service['designation_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('subservice_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Client Rate'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('Client rate'), 'placeholder'=>'Client rate', 'name' => 'client_rate','id' => 'client_rate','Onblur'=>'addempstrength()')); ?>
								<?php echo form_error('client_rate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Employee Rate (Gross Salary)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('Employee rate'), 'placeholder'=>'Employee rate', 'name' => 'employee_rate')); ?>
								<?php echo form_error('employee_rate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Strength'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('Strength'), 'placeholder'=>'Strength', 'name' => 'strength','id' => 'strength', 'Onblur'=>'addempstrength()')); ?>
								<?php echo form_error('strength', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Total'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>0, 'placeholder'=>'total', 'name' => 'total','id' => 'total','readonly'=>'readonly')); ?>
								<?php echo form_error('total', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Bill Cycle'); ?>
                                <select name="bill_cycle" class="form-control" id="billing_cycle">
                                <option value="">Select</option>
                                <option value="1">Month Wise</option>
                                <option value="2">Per Day Wise</option>
                               	<option value="3">Days Wise</option>
                                </select>
								<?php echo form_error('bill_cycle', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group" id="billing_cycle_box">
								<?php echo form_label('Number Of Days'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('bill_cycle_num'), 'type'=>'number', 'max'=>'31', 'min'=>'1', 'placeholder'=>'Number of Days', 'name' => 'bill_cycle_num')); ?>
								<?php echo form_error('bill_cycle_num', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                    <div class="col-md-6">
                    <?php foreach($allowanceList as $allowance){?>
                            <div class="form-group">
								<?php echo form_label($allowance['allowance_name']); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('allowance['.$allowance['id'].']'), 'placeholder'=>$allowance['allowance_name'], 'name' => 'allowance['.$allowance['id'].']')); ?>
								<?php echo form_error('allowance['.$allowance['id'].']', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <?php }?>
                            <div class="form-group">
								<?php echo form_label('OT Rate Per Day (If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>'0.00', 'placeholder'=>'OT Rate', 'name' => 'ot_rate','id' => 'total')); ?>
								<?php echo form_error('ot_rate', '<p class="text-danger">', '</p>'); ?>
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
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Client Services Mapping List</h4>
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
                      <th>Client Name</th>
                      <th>Service Name</th>
                      <th>Sub Service Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($ClientSeriveMapList as $client) { ?>
                                    <tr>
                                       <td><?php echo $client['id']; ?></td>
                                        <td><?php echo $client['client_name']; ?></td>
                                       <td><?php echo $client['service_name']; ?></td>
                                       <td><?php echo $client['designation_name']; ?></td>
                                        <td><?php echo ($client['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('branchadmin/Setting/editClientServiceMap/'.$client['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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