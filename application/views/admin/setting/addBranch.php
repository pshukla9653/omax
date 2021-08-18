<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Branch</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Add Branch</a>
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
                  <h4 class="card-title">Add Branch</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <?php echo form_open_multipart('admin/Setting/addBranch', array('name'=>'addBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Branch Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('branch_name'), 'placeholder'=>'Branch Name', 'name' => 'branch_name')); ?>
                                
								<?php echo form_error('branch_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Contact Person<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('person_name'), 'placeholder'=>'Contact Person Name', 'name' => 'person_name')); ?>
                                
								<?php echo form_error('person_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Username<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('username'), 'placeholder'=>'Username', 'name' => 'username')); ?>
                                
								<?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            <div class="form-group">
								<?php echo form_label('Contact Person Mobile<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('mobile'), 'placeholder'=>'Contact Person Mobile', 'name' => 'mobile')); ?>
                                
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Email<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('email'), 'placeholder'=>'Contact Person Email', 'name' => 'email')); ?>
                                
								<?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('GST Number<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'id'=>'gstin', 'value'=>set_value('gstnumber'), 'placeholder'=>'Contact Person Email', 'name' => 'gstnumber')); ?>
                                
								<?php echo form_error('gstnumber', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                        <?php echo form_label('Address'); ?>
                                       <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('address'),  'placeholder'=>'Address', 'name' => 'address')); ?>
                                        <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                   
                        
                        <div class="form-group">
                                        <?php echo form_label('Country'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('country'), 'placeholder'=>'Country', 'name' => 'country')); ?>
                                        <?php echo form_error('country', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('State'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('state'), 'placeholder'=>'State', 'name' => 'state')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('City'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('city'), 'placeholder'=>'City', 'name' => 'city')); ?>
                                        <?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Pincode'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pincode'), 'placeholder'=>'Pincode', 'name' => 'pincode')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Description'); ?>
                                       <?php echo form_textarea(array('class'=>'form-control', 'value'=>set_value('description'),  'placeholder'=>'Description', 'name' => 'description')); ?>
                                        <?php echo form_error('description', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                            
                            </div>
                    
                    
                     <div class="col-md-12">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
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