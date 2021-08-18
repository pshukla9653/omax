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
                   <?php echo form_open_multipart('branchadmin/Setting/addTaxMaster', array('name'=>'addTaxMaster'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <div class="col-md-12"> 
                            <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label('Type of Tax<span class="text-danger">*</span>'); ?>
                                <select class="form-control" name="type_of_tax" autofocus>
                               
                                <option value="Monthly">Monthly</option>
                               
                                </select>
                               <?php echo form_error('type_of_tax', '<p class="text-danger">', '</p>'); ?> 
                           </div>
                            
                             
                            
                            
                             </div>
                             <div class="col-md-4">
                            
                                 <div class="form-group">
                                <?php echo form_label('Tax Applied On'); ?>
                                <select class="form-control" name="tax_applied_on">
                                <option value="" selected>Select</option>
                                <option value="-1">BASIC SALARY</option>
                                <option value="-2">GROSS SALARY</option>
                                <option value="-3">NET SALARY</option>
                                <option value="-4">TAKE HOME SALARY</option>
                                </select>
                               <?php echo form_error('tax_applied_on', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                             </div>
                             <div class="col-md-12">
                              
                            <div class="col-md-4">
                            
                                 <div class="form-group">
								<?php echo form_label('Minimum Salary Limit'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('min_salary_limit'), 'placeholder'=>'Minimum', 'name' => 'min_salary_limit')); ?>
								<?php echo form_error('min_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('Maximum Salary Limit'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('max_salary_limit'), 'placeholder'=>'Maximum', 'name' => 'max_salary_limit')); ?>
								<?php echo form_error('max_salary_limit', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-4">
                            
                                <div class="form-group">
								<?php echo form_label('Percentage'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('percentage'), 'placeholder'=>'Maximum', 'name' => 'percentage')); ?>
								<?php echo form_error('percentage', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="col-md-4">
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
                            </div>
                            
                            <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            </div>
                            
                           </div>
                   
                    
                     
                  
                  <?php echo form_close();?>
                  
                  </div>
                  
                  
                  
                  </div>
                  
                 
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Income Tax</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   
                  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Income Tax List</h4>
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
                    
                    <table class="table table-striped table-bordered compact table-responsive">
                      <thead>
                      <th>Type of Tax</th>
                      <th>Tax Applied on</th>
                     <th>Minimum Salary Limit</th>
                     <th>Maximum Salary Limit</th>
                     <th>Percentage</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($taxList as $tax) { ?>
                                    <tr>
                                        <td><?php echo $tax['type_of_tax']; ?></td>
                                        <td><?php if($tax['tax_applied_on']=='-1'){echo 'BASIC SALARY';}
										if($tax['tax_applied_on']=='-2'){echo 'GROSS SALARY';}
										if($tax['tax_applied_on']=='-3'){echo 'NET SALARY';}
										if($tax['tax_applied_on']=='-4'){echo 'TAKE HOME SALARY';} ?></td>
                                       <td><?php echo $tax['min_salary_limit']; ?></td>
                                       <td><?php echo $tax['max_salary_limit']; ?></td>
                                       <td><?php echo $tax['percentage']; ?></td>
                                        <td><?php echo ($tax['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                        <a href="<?php echo site_url('branchadmin/Setting/editaddTaxMaster/'.$tax['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
