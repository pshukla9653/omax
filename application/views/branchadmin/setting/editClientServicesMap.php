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
                  <h4 class="card-title">Edit Client Services Mapping</h4>
                 
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editClientServiceMap/'.$client_service_mapping_detail[0]['id'], array('name'=>'ClientServiceMap'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                             <input name="txthide" type="hidden" value="<?php echo $client_service_mapping_detail[0]['id']?>">
                            <div class="form-group">
								<?php echo form_label('Client'); ?>
                                <select class="form-control" name="client_id">
                              
                                <option value="">select</option>
                                <?php foreach($clientList as $client){?>
                               <option value="<?php echo $client['id'];?>" <?php if($client_service_mapping_detail[0]['client_id'] ==$client['id'] ) { ?> selected <?php } ?>><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Service'); ?>
                                <select class="form-control" name="service_id">
                                <option value="">Select</option>
                                <?php foreach($serviceList as $service){?>
                                <option value="<?php echo $service['id'];?>" <?php if($client_service_mapping_detail[0]['service_id'] ==$service['id'] ) { ?> selected <?php } ?>><?php echo $service['service_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('service_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Sub Service'); ?>
                                <select class="form-control" name="subservice_id">
                               	<option value="">Select</option>
                                 <?php foreach($DesignationList as $service){?>
        <option value="<?php echo $service['id'];?>" <?php if($service['id'] == $client_service_mapping_detail[0]['subservice_id']) {?> selected<?php }?>><?php echo $service['designation_name'];?></option>
                                 <?php }?>
                                </select>
								<?php echo form_error('subservice_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Client Rate'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['client_rate'], 'placeholder'=>'Client rate', 'name' => 'client_rate','id' => 'client_rate','Onblur'=>'addempstrength()')); ?>
								<?php echo form_error('client_rate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Employee Rate'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['employee_rate'], 'placeholder'=>'Employee rate', 'name' => 'employee_rate')); ?>
								<?php echo form_error('employee_rate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Strength'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['strength'], 'placeholder'=>'Strength', 'name' => 'strength','id' => 'strength', 'Onblur'=>'addempstrength()')); ?>
								<?php echo form_error('strength', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Total'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['total'], 'placeholder'=>'total', 'name' => 'total','id' => 'total','readonly'=>'readonly')); ?>
								<?php echo form_error('total', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                           
                            <div class="form-group">
								<?php echo form_label('Bill Cycle'); ?>
                                <select name="bill_cycle" class="form-control" id="billing_cycle">
                                <option value="">Select</option>
                                <option value="1" <?php if($client_service_mapping_detail[0]['bill_cycle'] == 1) { ?> selected <?php } ?>>Month Wise</option>
                                <option value="2" <?php if($client_service_mapping_detail[0]['bill_cycle'] == 2) { ?> selected <?php } ?>>Per Day Wise</option>
                               	<option value="3" <?php if($client_service_mapping_detail[0]['bill_cycle'] == 3) { ?> selected <?php } ?>>Days Wise</option>
                                </select>
								<?php echo form_error('bill_cycle', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group" id="billing_cycle_box">
								<?php echo form_label('Number Of Days'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['bill_cycle_num'], 'type'=>'number', 'max'=>'31', 'min'=>'1', 'placeholder'=>'Number of Days', 'name' => 'bill_cycle_num')); ?>
								<?php echo form_error('bill_cycle_num', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                    <div class="col-md-6">
                    
                    <?php 
					$arr = explode(',',$client_service_mapping_detail[0]['allowance']);
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
								<?php echo form_label('OT Rate Per Day (If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$client_service_mapping_detail[0]['ot_rate'], 'placeholder'=>'OT Rate', 'name' => 'ot_rate','id' => 'total')); ?>
								<?php echo form_error('ot_rate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" <?php if($client_service_mapping_detail[0]['status'] == 1) { ?> selected <?php } ?>>Active</option>
                                <option value="0" <?php if($client_service_mapping_detail[0]['status'] == 0) { ?> selected <?php } ?>>Inactive</option>
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