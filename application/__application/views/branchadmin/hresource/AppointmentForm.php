<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Appointment Letter</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Appointment Letter</a>
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
                  <h4 class="card-title">Appointment Letter</h4>
                 
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/appointmentLetter/'.$details2['applicant_id']);?>
                   <div class="col-md-12">
                   <input name="hidetxt" type="hidden" value="<?php echo $details2['applicant_id']?>">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Applicant Name : <strong>'.$details['applicant_name'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name : <strong>'.$details['father_name'].'</strong>'); ?>
                             </div>   
                            <div class="form-group">
								<?php echo form_label('Post Offered : <strong>'.$details2['post_offered'].'</strong>'); ?>
                             </div> 
                            </div>
                            
                        <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Signatory Name (Designation)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['sdesignation'], 'placeholder'=>'Signatory Name (Designation)', 'name' => 'sdesignation')); ?>
								<?php echo form_error('sdesignation', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                               <select name="grade" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($grade as $grad) { ?>
                               <option value="<?php echo $grad['id']?>" <?php if($appointmentletterlist[0]['grade']==$grad['id']){?>selected<?php }?>><?php echo $grad['grade_name'];?></option>
                                 <?php } ?>
                                </select>
								<?php echo form_error('grade', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Probation Period'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['probation_period'], 'placeholder'=>'Probation Period', 'name' => 'probation_period')); ?>
								<?php echo form_error('probation_period', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Appointment Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['appointmentdate'], 'placeholder'=>'Appointment Date', 'name' => 'appointmentdate','id'=>'date1')); ?>
								<?php echo form_error('appointmentdate', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>    
                            
                    <div class="col-md-4">
                    
                           <div class="form-group">
								<?php echo form_label('Reference Number'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['refnumber'], 'placeholder'=>'Reference Number', 'name' => 'refnumber')); ?>
								<?php echo form_error('refnumber', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Generation Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['generation_date'], 'placeholder'=>'Generation Date', 'name' => 'generation_date','id'=>'date1')); ?>
								<?php echo form_error('generation_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Notice Period'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['notice_period'], 'placeholder'=>'Notice Period', 'name' => 'notice_period')); ?>
								<?php echo form_error('notice_period', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Signature Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$appointmentletterlist[0]['signdate'], 'placeholder'=>'Signatue Date', 'name' => 'signdate','id'=>'date2')); ?>
								<?php echo form_error('signdate', '<p class="text-danger">', '</p>'); ?>
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