<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">GST Master</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">GST Master</a>
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
                  <h4 class="card-title">GST Master</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/GSTMaster', array('name'=>'GSTMaster'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            
                             <div class="col-md-12">
                              
                            <div class="col-md-4">
                            
                                 <div class="form-group">
								<?php echo form_label('CGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['cgst'], 'placeholder'=>'CGST', 'name' => 'cgst','autofocus'=>'autofocus')); ?>
								<?php echo form_error('cgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('SGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['sgst'], 'placeholder'=>'SGST', 'name' => 'sgst')); ?>
								<?php echo form_error('sgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('IGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['igst'], 'placeholder'=>'IGST', 'name' => 'igst')); ?>
								<?php echo form_error('igst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            </div>
                            <div class="col-md-12">
                            
                            
                            
                            <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            
                            
                           </div>
                   
                    
                     
                  
                  <?php echo form_close();?>
                  
                  </div>
                  
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                  
                  </div>
                  
                 
                </div>
              </div>
              
            </div>
            
          </div>
        </section>
        </div>
       </div>
 </div>
