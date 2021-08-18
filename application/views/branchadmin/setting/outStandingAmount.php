<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Opening Balance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Opening Balance</a>
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
                  <h4 class="card-title">Opening Balance</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Web/outStandingAmount', array('name'=>'addBankBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Select Client'); ?>
                                <select class="form-control select2" name="client_id" autofocus>
                                <option value="">Select Client</option>
                                <?php foreach($clientDetail as $client){?>
                                <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            
                            
                           
                            
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Opening Balance ( Till 31st March 2018 )'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('outstandingamt'), 'placeholder'=>'Opening Balance', 'name' => 'outstandingamt')); ?>
								<?php echo form_error('outstandingamt', '<p class="text-danger">', '</p>'); ?>
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
              
              <div class="card">
                
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Opening Balance List</h4>
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
                      <tr>
                      <th>Client Name</th>
                      <th>Outstanding Amount</th>
                      <th>Action</th>
                      <th>Status</th>
                      <th>Payment</th
                      ></tr>
                      </thead>
                         <tbody>
                        
                            <?php foreach($outsamtDetail as $outdeatil){?>
                              <tr>
                                <?php 
								 $cname = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$outdeatil['client_id'],'company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')));
								?>
                                <td><?php echo $cname['client_name']?></td>
                                <td><?php echo $outdeatil['outstanding_amount']?></td>
                                <?php if($outdeatil['status'] == "Unpaid"){?>
                                <td><a class="btn btn-info " href="<?php echo base_url('Web/editOutStandingAmount/'.$outdeatil['client_id']);?>">Edit</a></td>
                                <?php }else{?>
                                <td><a class="btn btn-info disabled" href="<?php echo base_url('Web/editOutStandingAmount/'.$outdeatil['client_id']);?>">Edit</a></td>
                                <?php }?>
                                <?php if($outdeatil['status'] == "Unpaid"){?>
                                <td><a class="btn btn-danger" href="#"><?php echo $outdeatil['status']?></a></td>
                                <?php }?>
                                <?php if($outdeatil['status'] == "Due"){?>
                                <td><a class="btn btn-warning" href="#"><?php echo $outdeatil['status']?></a></td>
                                <?php }?>
                                <?php if($outdeatil['status'] == "Paid"){?>
                                <td><a class="btn btn-success" href="#"><?php echo $outdeatil['status']?></a></td>
                                <?php }?>
                                <?php if($outdeatil['status'] == "Paid"){?>
                                <td><a class="btn btn-info disabled" href="#">Get Payment</a></td>
                                <?php }else{?>
   <td><a class="btn btn-info" target="_blank" href="<?php echo base_url('Web/outStandingAmountTransaction/'.$outdeatil['client_id']);?>">Get Payment</a></td>
                                <?php }?>
                              </tr>
                            <?php }?>
                            
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
            
          </div>
        </section>
        </div>
       </div>
 </div>