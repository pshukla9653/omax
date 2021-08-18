<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Payment Transaction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Payment Transaction</a>
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
                  <h4 class="card-title">Payment Transaction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Web/transaction', array('name'=>'addBankBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-12"><br>
                             <div class="col-md-4">
                              <div class="form-group">
                                        
                                        <?php echo form_label('Year'); ?>
                                                        <select name="year" class="form-control" autofocus>
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
                                <select name="month" class="form-control">
                                <option value="">Select</option>
                               
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
							         	<?php echo form_error('month', '<p class="text-danger">', '</p>'); ?>
                                
                            </div></div>
                            <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Select Client'); ?>
                                <select class="form-control select2" name="client">
                                
                                  <option value="">--Select--</option>
                                  <?php foreach($clientname as $client){?>
                                  
                                  <option  value="<?php echo $client['id']?>"><?php echo  $client['client_name']?></option>
                                  <?php }?>
                                </select>
								<?php echo form_error('client', '<p class="text-danger">', '</p>'); ?>
                            </div></div>
                            
                            </div>
                          
                           
                    
                     <div class="col-md-12">
                     
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