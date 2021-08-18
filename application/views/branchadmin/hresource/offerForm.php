<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Offer Form</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Offer Form</a>
                
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
                  <h4 class="card-title">Offer Form</h4>
                 
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Hresource/offerLetter/'.$appFormDetails[0]['id']);?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                             <input name="hidetxt" type="hidden" value="<?php echo $appFormDetails[0]['id']?>">
                            </div> 
                             <div class="col-md-4">
                             
                             
                             
                             <div class="form-group">
								<?php echo form_label('Date of Apply : <strong>'.$appFormDetails[0]['date_of_apply'].'</strong>'); ?>
                                
                            </div>
                             
                            <div class="form-group">
								<?php echo form_label('Applicant Name : <strong>'.$appFormDetails[0]['applicant_name'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Father Name : <strong>'.$appFormDetails[0]['father_name'].'</strong>'); ?>
                             </div>   
                            <div class="form-group">
								<?php echo form_label('Date of Birth : <strong>'.$appFormDetails[0]['dob'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Gender : <strong>'.$appFormDetails[0]['gender'].'</strong>'); ?>
                                
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Education Qualification : <strong>'.$appFormDetails[0]['edu_qua'].'</strong>'); ?>
                               
                            </div>
                             <div class="form-group">
								<?php echo form_label('Prof/Tech. Qualification : <strong>'.$appFormDetails[0]['tech_qua'].'</strong>'); ?>
                                
                            </div>
                            </div>
                            
                        <div class="col-md-4">
                   
                             
                            <div class="form-group">
								<?php echo form_label('Work Experience : <strong>'.$appFormDetails[0]['work_exp'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Last Salary : <strong>'.$appFormDetails[0]['last_salary'].'</strong>'); ?>
                                
                            </div>
                            <div class="form-group">
								<?php echo form_label('Expected Salary : <strong>'.$appFormDetails[0]['expected_salary'].'</strong>'); ?>
                               
                            </div>
                            <div class="form-group">
								<?php echo form_label('Reporting On'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$offerdetail[0]['reportingon'], 'placeholder'=>'Reporting On', 'name' => 'reportingon','id'=>'datetime')); ?>
								<?php echo form_error('reportingon', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Location/Place'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$offerdetail[0]['place'], 'placeholder'=>'Location/Place', 'name' => 'place')); ?>
								<?php echo form_error('place', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            </div>    
                            
                    <div class="col-md-4">
                    
                           <div class="form-group">
								<?php echo form_label('Interviewed On'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$offerdetail[0]['interviewon'], 'placeholder'=>'Interviewd On', 'name' => 'interviewon','id'=>'date')); ?>
								<?php echo form_error('interviewon', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Interviewed By'); ?>
                                <?php 
								$emp = $this->CommanModel->getDataByFieldName('emp_name,emp_code','tbl_employee');
								
								?>
                                
                                <select name="interviewed_by" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($emp as $employee) { ?>
                               <option value="<?php echo $employee['emp_code']?>" <?php if($offerdetail[0]['interviewed_by'] == $employee['emp_code']){?>selected<?php }?>><?php echo $employee['emp_name']?></option>
                                 <?php } ?>
                                </select>
								<?php echo form_error('interviewed_by', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Post Offered'); ?>
                                <?php 
								$des = $this->CommanModel->getDataByFieldName('designation_name,id','tbl_designation');
								
								?>
                                <select name="post_offered" class="form-control">
                                <option value="" selected>Select</option>
                                <?php foreach($des as $designation) { ?>
                                    <option value="<?php echo $designation['designation_name']?>" <?php if($offerdetail[0]['post_offered'] == $designation['designation_name']){?>selected<?php }?>><?php echo $designation['designation_name']?></option>
                                 <?php } ?>   
                                </select>
								<?php echo form_error('post_offered', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Offered Salary'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$offerdetail[0]['offered_salary'], 'placeholder'=>'Offered Salary', 'name' => 'offered_salary')); ?>
								<?php echo form_error('offered_salary', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            
                            </div>
                    
                     <div class="col-md-12">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit','class'=>'btn btn-success pull-right btn-lg')); ?>
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