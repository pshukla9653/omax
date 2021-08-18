<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Opening Balance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Opening Balance</a>
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
                  <h4 class="card-title">Edit Opening Balance</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Web/editOutStandingAmount', array('name'=>'addBankBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Select Client'); ?>
                                <select class="form-control select2" name="client_id" autofocus>
                                <option value="">Select Client</option>
                                <?php 
								$i =0;
								foreach($clientDetail as $client){?>
                    <option value="<?php echo $client['id'];?>" <?php if($outsamtDetail[$i]['client_id']==$client['id']){?> selected<?php }?>><?php echo $client['client_name'];?></option>
                                <?php $i++; }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                            
                           
                            
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Opening Balance ( Till 31st March 2018 )'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$outsamtDetail[0]['outstanding_amount'], 'placeholder'=>'Opening Balance', 'name' => 'outstandingamt')); ?>
								<?php echo form_error('outstandingamt', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <input type="hidden" name="hidetxt" value="<?php echo $outsamtDetail[0]['client_id']?>">
                    
                     <div class="col-md-12">
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