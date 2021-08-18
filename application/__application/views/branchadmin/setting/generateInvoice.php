<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Generate Invoice</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Generate Invoice</a>
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
                  <h4 class="card-title">Generate Invoice</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/setting/generateInvoice');?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-12">
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Year'); ?>
                                <select name="year" class="form-control" autofocus>
                                <option value="">Select</option>
                                <?php foreach($this->year as $y=>$v){?>
                                <option value="<?php echo $y;?>"><?php echo $v;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Select Bank Branch'); ?>
                                <select name="bank_branch_id" class="form-control" id="bank_branch_id">
                                <option value="">Select</option>
                                </select>
								<?php echo form_error('bank_branch_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Select Sub-Service'); ?>
                                <select name="subservice_id[]" class="form-control select2" id="subservice_list" multiple>
                                <option value="">Select</option>
                                </select>
								<?php echo form_error('subservice_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Month'); ?>
                                <select name="month" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('month', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                             <div class="form-group">
								<?php echo form_label('Client'); ?>
                                <select name="client_id" class="form-control select2" id="client_list_invoice">
                                <option value="">Select</option>
                                <?php foreach($allclient as $client){?>
                                 <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Date on Invoice'); ?>
                               <input type="text" name="invoice_date" id="date" class="form-control" value="<?php echo date("d/m/Y"); ?>"/>
								<?php echo form_error('invoice_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
								<?php echo form_label('Select Bank'); ?>
                                <select name="bank_id" class="form-control" id="bank_id">
                                <option value="">Select</option>
                                <?php foreach($bankList as $bank){?>
                                 <option value="<?php echo $bank['id'];?>"><?php echo $bank['bank_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('bank_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            <div class="form-group">
								<?php echo form_label('Select Service'); ?>
                                <select name="service_id" class="form-control" id="service_list">
                                <option value="">Select</option>
                                </select>
								<?php echo form_error('service_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                           <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Other Deducation Head on Total Billing Amount'); ?>
                                <input type="text" class="form-control" name="other_deduction_head"/>
								<?php echo form_error('other_deduction_head', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Other Deducation UOM'); ?>
                                <input type="text" class="form-control" name="other_deduction_uom"/>
								<?php echo form_error('other_deduction_uom', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                             <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Other Deducation Amount'); ?>
                                <input type="text" class="form-control" name="other_deduction_amount"/>
								<?php echo form_error('other_deduction_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            </div>
                             <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
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