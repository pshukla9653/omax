<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Allowance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Add Allowance</a>
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
                  <h4 class="card-title">Add Allowance</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/addAllowance', array('name'=>'addAllowance'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Allowance Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('allowance_name'), 'placeholder'=>'Allowance Name', 'name' => 'allowance_name','autofocus'=>'autofocus')); ?>
								<?php echo form_error('allowance_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                            
                                 <div class="form-group">
                                <?php echo form_label('Mode of Payment'); ?>
                                <select class="form-control" name="mode_of_payment">
                                <option value="" selected>Select</option>
                                <option value="1">Fixed</option>
                                <option value="0">Payable</option>
                                </select>
                               <?php echo form_error('mode_of_payment', '<p class="text-danger">', '</p>'); ?> 
                            </div>
                            
                            </div>
                    <div class="col-md-6">
                            
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                                </select>
                                
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
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Allowance</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   
                  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Allowance List</h4>
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
                      <th>Allowance Name</th>
                      <th>Mode of Payment</th>
                     
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($incomeList as $income) { ?>
                                    <tr>
                                        <td><?php echo $income['allowance_name']; ?></td>
                                        <td><?php echo $income['mode_of_payment']==1?'Fixed':'Payable'; ?></td>
                                       
                                        <td><?php echo ($income['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editAllowance/'.$income['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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