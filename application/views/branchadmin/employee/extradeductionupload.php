<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Extra Deduction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Extra Deduction</a>
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
                  <h4 class="card-title">Upload Extra Deduction</h4>
                 
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/UploadExcels/uploadextradeduction', array('name'=>'CreateLoan'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg');?>
                            </div> 
                             
                            <div class="col-md-4">
                            <a href="<?=base_url('branchadmin/UploadExcels/extradeductionExportExcel');?>" class="btn btn-success">Download Excel</a>
                            <br><br><br>
                             <div class="form-group">
								<?php echo form_label('Type of Extra Deduction'); ?>
                                <select name="loan_type" class="form-control">
                                <option value="">Select</option>
                                 <option value="0">LOAN</option>
                                <?php foreach($extradedutinmasterList as $extra){?>
                                  <option value="<?php echo $extra['id'];?>"><?php echo $extra['extradeduction_name'];?></option>
                                 <?php }?>
                                
                                </select>
								<?php echo form_error('loan_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
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
                            <div class="form-group">
                            <?php echo form_label('Upload File'); ?>
								<input type="file" name="extrafile" required/>
							
                            </div>
                           <div class="form-group">
                           <?php echo form_submit(array('value' => 'Upload', 'name'=>'submit', 'class'=>'btn btn-success pull-right')); ?>
                            </div>
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
 
