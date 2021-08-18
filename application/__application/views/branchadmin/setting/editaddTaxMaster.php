<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Income Tax Master</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Income Tax Master</a>
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
                  <h4 class="card-title">Income Tax Master</h4>
                  
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editaddTaxMaster/'.$incometaxList['id'], array('name'=>'addTaxMaster'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                             <input type="hidden" name="hidetxt" value="<?php echo  $incometaxList['id']?>">
                            </div>
                            <div class="col-md-12"> 
                            <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label('Type of Tax<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="type_of_tax">
                                <option value="Monthly" <?php if($incometaxList['type_of_tax'] == 'Monthly'){?> selected<?php }?>>Monthly</option>
                                </select>
                               <?php echo form_error('type_of_tax', '<p class="text-danger">', '</p>'); ?> 
                           </div>
                            
                             
                            
                            
                             </div>
                             <div class="col-md-4">
                            
                                 <div class="form-group">
                                <?php echo form_label('Tax Applied On'); ?>
                                <select class="form-control" name="tax_applied_on">
                                <option value="" selected>Select</option>
                                <option value="-1"  <?php if($incometaxList['tax_applied_on'] == '-1'){?> selected<?php }?>>BASIC SALARY</option>
                                <option value="-2" <?php if($incometaxList['tax_applied_on'] == '-2'){?> selected<?php }?>>GROSS SALARY</option>
                                <option value="-3" <?php if($incometaxList['tax_applied_on'] == '-3'){?> selected<?php }?>>NET SALARY</option>
                                <option value="-4" <?php if($incometaxList['tax_applied_on'] == '-4'){?> selected<?php }?>>TAKE HOME SALARY</option>
                                </select>
                               <?php echo form_error('tax_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                             </div>
                             <div class="col-md-12">
                              
                            <div class="col-md-4">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Salary Limit'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$incometaxList['min_salary_limit'], 'placeholder'=>'Minimum', 'name' => 'min_salary_limit')); ?>
								<?php echo form_error('min_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Salary Limit'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$incometaxList['max_salary_limit'], 'placeholder'=>'Maximum', 'name' => 'max_salary_limit')); ?>
								<?php echo form_error('max_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('Percentage'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$incometaxList['percentage'], 'placeholder'=>'Maximum', 'name' => 'percentage')); ?>
								<?php echo form_error('percentage', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected <?php if($incometaxList['status'] == '1'){?> selected<?php }?>>Active</option>
                                <option value="0" <?php if($incometaxList['status'] == '0'){?> selected<?php }?>>Inactive</option>
                                </select>
                                
                            </div>
                            
                            <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            </div>
                            
                           </div>
                   
                    
                     
                  
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
