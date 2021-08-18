<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Generate Letters</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Generate Letters</a>
                
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
                  <h4 class="card-title">Generate Letters</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/generateLetters')?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                             
                    </div> 
                              <div class="col-md-6">
                                 <div class="form-group">
									<?php echo form_label('Select Letter Type'); ?>
                                  
                                    <select name="letter_type" class="form-control">
                                      <option value="" selected>Select</option>
                                      
                                      <option value="1" >Offer Letter</option>
                                      <option value="2" >Confirmation Letter</option>
                                      <option value="3" >Appointment Letter</option>
                                      <option value="4" >Applicant To Employee</option>
                                    </select>
                                    <?php echo form_error('letter_type', '<p class="text-danger">', '</p>'); ?>
                                </div>
                              </div>
                            
                                
                            
                           <div class="col-md-6">
                    
                           
                             <div class="form-group">
								<?php echo form_label('Applicant Name'); ?>
                                <?php 
								$applicant_name = $this->CommanModel->getListWhere('applicant_name,id','tbl_application','id','ASC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
								?>
                               <select name="applicant_name" class="form-control select2">
                                <option value="" selected>Select</option>
                                <?php foreach($applicant_name as $applicant) { ?>
                               <option value="<?php echo $applicant['id']?>"><?php echo $applicant['applicant_name']?></option>
                                 <?php } ?>
                                </select>
								<?php echo form_error('applicant_name', '<p class="text-danger">', '</p>'); ?>
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
              
              
            </div>
            
          </div>
        </section>
        </div>
       </div>
 </div>