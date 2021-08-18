<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Generate Client Based Salary</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Generate Client Based Salary</a>
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
                  <h4 class="card-title">Generate Client Based Salary</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Employee/generateClientBasedSalary', array('name'=>'generateClientBasedSalary'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-12">
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Year'); ?>
                                <select name="year" id="yearv" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($this->year as $y=>$v){?>
                                <option value="<?php echo $y;?>"><?php echo $v;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Month'); ?>
                                <select name="month" id="monthv" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('month', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                            <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Client'); ?>
                                <select name="client_id" id="ClientId" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($ClientList as $client){?>
                                 <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('emp_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                  
                  </div>
                  <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Employee'); ?>
                                <select name="emp_id" id="Emp_id" class="form-control select2">
                                <option value="">Select</option>
                                
                                
                                </select>
								<?php echo form_error('emp_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                  
                  </div>
                  <div class="col-md-4">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
                  </div>
                  </div>
                  </div>
                  
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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