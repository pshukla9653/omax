<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">  Quick Invoice Generation</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Quick Invoice Generation</a>
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
                  <h4 class="card-title">Quick Invoice Generation</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/QuickInvoice');?>
                   <div class="col-md-12">
                   <?php echo form_error("prasent", "<p class='text-danger'>", "</p>"); ?>
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-12">
                             <div class="col-md-3">
                            <div class="form-group">
								<?php echo form_label('Year'); ?>
                                <select name="year_v" class="form-control" id="year_v">
                                <option value="">Select</option>
                                <?php foreach($this->year as $yv=>$ya):?>
                                <option value="<?=$yv;?>"><?=$ya;?></option>
                                <?php endforeach;?>
                                
                                </select>
								<?php echo form_error('year_v', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-3">
                             <div class="form-group">
								<?php echo form_label('Month'); ?>
                                <select name="month_v" class="form-control" id="month_v">
                                <option value="">Select</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('month_v', '<p class="text-danger">', '</p>'); ?>
                             </div>
                            </div>
                           
                            <div class="col-md-3">
                             <div class="form-group">
                             <?php echo form_label('Client'); ?>
                             <select name="client_id" class="form-control select2" id="client_list">
                             <option value="">Select</option>
                                 <?php foreach($clientName as $name){?>
                                  <option value="<?php echo $name['id'];?>"><?php echo $name['client_name'];?></option>
                                 <?php }?>
                             </select>
                             <?php echo form_error("client_id", "<p class='text-danger'>", "</p>"); ?>
                             </div>
                            </div>
 <div class="col-md-3">
                             <div class="form-group">
                             <?php echo form_label('Service'); ?>
                             <select name="service_id" id="service_id" class="form-control" autofocus>
                             <option value="">Select</option>
                                 
                             </select>
                             <?php echo form_error('service_id', '<p class="text-danger">', '</p>'); ?>
                             </div>
                            </div>
                            </div>
                            <div class="col-md-12" id="subservice_id">
                             
                  
                  </div>
                  </div>
                  
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