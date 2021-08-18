<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Deduction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Update Deduction</a>
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
                  <h4 class="card-title">Update Deduction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editDeduction/'.$editdeduction[0]['id'], array('name'=>'addDeduction'));?>
                   <div class="col-md-12"  id="errorMsg">
                             <?php echo $this->session->flashdata('msg');?>
                            </div> 
                            <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Type of Deduction<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="type_of_deduction" id="typeofdeduction">
                                <option value="Regular" <?php echo $editdeduction[0]['type_of_deduction']=='Regular'?'selected':'';?>>Regular</option>
                                <option value="Temperary" <?php echo $editdeduction[0]['type_of_deduction']=='Temperary'?'selected':'';?>>Temporary</option>
                                </select>
                               <?php echo form_error('type_of_deduction', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            <div id='fortypeofdeduction'>
                             <div class="col-md-6">
                             <div class="form-group" id="sandbox-container">
								<?php echo form_label('Date From<span class="text-danger">*</span>'); ?>
                                <div class="input-daterange" id="datepicker">
                                <?php echo form_input(array('class'=>'form-control', 'value'=>date_format(date_create($editdeduction[0]['date_from']), 'm/d/Y'), 'placeholder'=>'Date From', 'name' => 'date_from')); ?>
                                </div>
                                <?php echo form_error('date_from', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             <div class="col-md-6">
                             <div class="form-group" id="sandbox-container">
								<?php echo form_label('Date To<span class="text-danger">*</span>'); ?>
                                <div class="input-daterange" id="datepicker">
                                <?php echo form_input(array('class'=>'form-control', 'value'=>date_format(date_create($editdeduction[0]['date_to']), 'm/d/Y'), 'placeholder'=>'Date To', 'name' => 'date_to')); ?>
                                </div>
                                <?php echo form_error('date_to', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
                                <?php echo form_label('Mode of Deduction<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="mode_of_deduction" id="modeofdeduction">
                                <option value="Fixed" <?php echo $editdeduction[0]['mode_of_deduction']=='Fixed'?'selected':'';?>>Fixed</option>
                                <option value="Calculated" <?php echo $editdeduction[0]['mode_of_deduction']=='Calculated'?'selected':'';?>>Calculated</option>
                                </select>
                               <?php echo form_error('mode_of_deduction', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Deduction Head<span class="text-danger">*</span>'); ?>
								<input type="text" class="form-control" value="<?php echo $editdeduction[0]['deduction_head'];?>" name="deduction_head"
                                <?php if($editdeduction[0]['deduction_head']=='EPF' || $editdeduction[0]['deduction_head']=='ESIC'){
									echo 'readonly';}?>/>
								<input type="hidden" name="deduction_head_hidden" value="<?php echo $editdeduction[0]['deduction_head'];?>"/>
								<?php echo form_error('deduction_head', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div id="formodeofdeduction">
                           
                            
                            <div class="col-md-12">
                            
                                 <div class="form-group">
                                <?php echo form_label('Deduction Applied On'); ?>
                                <select class="form-control" name="deduction_applied_on">
                                <option value="0" <?php echo $editdeduction[0]['deduction_applied_on']==''?'selected':'';?>>Select</option>
                                <option value="-1" <?php echo $editdeduction[0]['deduction_applied_on']=='-1'?'selected':'';?>>BASIC SALARY</option>
                                <option value="-2" <?php echo $editdeduction[0]['deduction_applied_on']=='-2'?'selected':'';?>>GROSS SALARY</option>
                                <option value="-3" <?php echo $editdeduction[0]['deduction_applied_on']=='-3'?'selected':'';?>>NET SALARY</option>
                                <option value="-4" <?php echo $editdeduction[0]['deduction_applied_on']=='-4'?'selected':'';?>>TAKE HOME SALARY</option>
                                <option value="-5" <?php echo $editdeduction[0]['deduction_applied_on']=='-5'?'selected':'';?>>OT</option>
                                <?php foreach($allowanceList as $allowance){?>
                                <option value="<?php echo $allowance['id'];?>" <?php echo $editdeduction[0]['deduction_applied_on']==$allowance['id']?'selected':'';?>><?php echo $allowance['allowance_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('deduction_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                            <div class="col-md-12">
                            
                                 <div class="form-group">
                                <?php echo form_label('Deduction Not Applied On <span class="text-danger">(If Any)</span>'); ?>
                                <select class="form-control" name="deduction_not_applied_on">
                                <option value="0" <?php echo $editdeduction[0]['deduction_not_applied_on']==''?'selected':'';?>>Select</option>
                                <option value="-1" <?php echo $editdeduction[0]['deduction_not_applied_on']=='-1'?'selected':'';?>>BASIC SALARY</option>
                                <option value="-2" <?php echo $editdeduction[0]['deduction_not_applied_on']=='-2'?'selected':'';?>>GROSS SALARY</option>
                                <option value="-3" <?php echo $editdeduction[0]['deduction_not_applied_on']=='-3'?'selected':'';?>>NET SALARY</option>
                                <option value="-4" <?php echo $editdeduction[0]['deduction_not_applied_on']=='-4'?'selected':'';?>>TAKE HOME SALARY</option>
                                <option value="-5" <?php echo $editdeduction[0]['deduction_not_applied_on']=='-5'?'selected':'';?>>OT</option>
                                <?php foreach($allowanceList as $nallowance){?>
                                <option value="<?php echo $nallowance['id'];?>" <?php echo $editdeduction[0]['deduction_not_applied_on']==$nallowance['id']?'selected':'';?>><?php echo $nallowance['allowance_name'];?></option>
                                <?php }?>
                                </select>
                               <?php echo form_error('deduction_not_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                            </div>
                            
                             </div>
                             <div class="col-md-6">
                              <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Employee Contribution<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['employee_contribution'], 'placeholder'=>'Eg. 3.6/1000', 'name' => 'employee_contribution')); ?>
								<?php echo form_error('employee_contribution', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Employer Contribution'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['employer_contribution'], 'placeholder'=>'Eg. 3.6/1000', 'name' => 'employer_contribution')); ?>
								<?php echo form_error('employer_contribution', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Deduction Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['min_deduction_limit'], 'placeholder'=>'Minimum', 'name' => 'min_deduction_limit')); ?>
								<?php echo form_error('min_deduction_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Deduction Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['max_deduction_limit'], 'placeholder'=>'Maximum', 'name' => 'max_deduction_limit')); ?>
								<?php echo form_error('max_deduction_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Salary Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['min_salary_limit'], 'placeholder'=>'Minimum', 'name' => 'min_salary_limit')); ?>
								<?php echo form_error('min_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-6">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Salary Limit(If Any)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdeduction[0]['max_salary_limit'], 'placeholder'=>'Maximum', 'name' => 'max_salary_limit')); ?>
								<?php echo form_error('max_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
                            </div>
                            <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            </div>
                            
                           
                   
                    
                     
                  
                  <?php echo form_close();?>
                  
                  </div>
                  
                  
                  
                  </div>
                  
                 
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Deduction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   
                  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Deduction List</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body collapse in">
                  <div class="card-block card-dashboard">
                    
                    <table class="table table-striped table-bordered compact">
                      <thead>
                      <th>Deduction Name</th>
                      <th>Type of Deduction</th>
                     <th>Mode of Deduction</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($deductionList as $deduction) { ?>
                                    <tr>
                                        <td><?php echo $deduction['deduction_head']; ?></td>
                                        <td><?php echo $deduction['type_of_deduction']; ?></td>
                                       <td><?php echo $deduction['mode_of_deduction']; ?></td>
                                        <td><?php echo ($deduction['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editDeduction/'.$deduction['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                      
                      
                    </table>
                  
                  </div>
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