<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Confirmation Letter</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Confirmation Letter</a>
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
                  <h4 class="card-title">Confirmation Letter</h4>
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/confirmationLetter/'.$details3['id']);?>
                   <div class="col-md-12">
                        <input name="hidetxt" type="hidden" value="<?php echo $details3['id']?>">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Applicant Name : <strong>'.$details3['applicant_name'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name : <strong>'.$details3['father_name'].'</strong>'); ?>
                             </div>   
                            <div class="form-group">
								<?php echo form_label('Reference Number : <strong>'.''.'</strong>'); ?>
                               <label> <?php echo $details['reference_number'];?></label>
                             </div> 
                            </div>
                            
                        <div class="col-md-4">
                            
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                                 <?php 
								$des = $this->CommanModel->getDataByFieldName('grade_name,id','tbl_grade');
								
								?>
                                <select name="grade" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($des as $designation) { ?>
                                    <option value="<?php echo $designation['id']?>" <?php if($confirmationletterlist[0]['grade'] == $designation['id']){?>selected<?php }?>><?php echo $designation['grade_name']?></option>
                                 <?php } ?>   
                                </select>
								<?php echo form_error('grade', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Designation'); ?>
                                <?php 
								$des = $this->CommanModel->getDataByFieldName('designation_name,id','tbl_designation');
								
								?>
                                <select name="designation" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($des as $designation) { ?>
                                    <option value="<?php echo $designation['designation_name']?>" <?php if($confirmationletterlist[0]['designation'] == $designation['designation_name']){?>selected<?php }?>><?php echo $designation['designation_name']?></option>
                                 <?php } ?>   
                                </select>
								<?php echo form_error('designation', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Appointment Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$confirmationletterlist[0]['appointemntdate'], 'placeholder'=>'Appointment Date', 'name' => 'appointemntdate','id'=>'date')); ?>
								<?php echo form_error('appointemntdate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>    
                            
                    <div class="col-md-4">
                    
                           <div class="form-group">
								<?php echo form_label('Signatory Name (Designation)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$confirmationletterlist[0]['signDesignation'], 'placeholder'=>'Signatory Name (Designation)', 'name' => 'signDesignation')); ?>
								<?php echo form_error('signDesignation', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Confirmation Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$confirmationletterlist[0]['confirmdate'], 'placeholder'=>'Confirmation Date', 'name' => 'confirmdate','id'=>'date1')); ?>
								<?php echo form_error('confirmdate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            <div class="form-group">
								<?php echo form_label('Report Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$confirmationletterlist[0]['reportdate'], 'placeholder'=>'Report Date', 'name' => 'reportdate','id'=>'date2')); ?>
								<?php echo form_error('reportdate', '<p class="text-danger">', '</p>'); ?>
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
              
            </div>
            
          </div>
        </section>
        </div>
       </div>
 </div>