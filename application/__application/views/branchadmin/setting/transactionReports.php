 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Transaction Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Transaction Report</a>
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
                  <h4 class="card-title">Transaction Report</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Web/transactionReports', array('name'=>'addDepartment'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                            <div class="col-md-4">

                             <div class="form-group">
                                        
                             <?php echo form_label('Client'); ?>
                                 <select name="client" class="form-control select2">
                                   <option value="">Select</option>
                                    <option value="-1">All</option>
                                    <?php foreach($client as $client_name){?>
                                    <option value="<?php echo $client_name['id']?>"><?php echo $client_name['client_name']?></option>
                                    <?php }?>
                                 </select>
                             <?php echo form_error('client', '<p class="text-danger">', '</p>'); ?>
                              </div>

                            </div>
                             <div class="col-md-4">

                             <div class="form-group">
                                        
                             <?php echo form_label('Year'); ?>
                                             <select name="year" class="form-control">
                                             <option value="">Select</option>
                                             <option value="-1">All</option>
                                            <?php foreach($this->year as $y=>$v){?>
                                <option value="<?php echo $y;?>"><?php echo $v;?></option>
                                <?php }?>
                                             </select>
                             <?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                                         </div>

                            </div>
                            <div class="col-md-4">
                                    
                                    <?php echo form_label('Month'); ?>
                                    <select name="month" class="form-control">
                                    <option value="">Select</option>
                                    <option value="-1">All</option>
                                    <?php foreach($this->month as $m_id=>$m_name){?>
                                    <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                    <?php }?>
                                    </select>
                            <?php echo form_error('month', '<p class="text-danger">', '</p>'); ?>
                            
                            </div>
                    <div class="col-md-6">
                           
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
      <div class="content-body">
            
        <!-- Column selectors table -->
       <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
              
                <div class="card-header">
                  <h4 class="card-title">Transaction Report</h4>
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
                    <div class="horizontal-scroll scroll-example">
                      <div class="horz-scroll-content">
                        <div class="row">
                        
                    <table class="table table-striped table-bordered dataex-html5-selectors">
                      <thead>
                     
                        
                        <tr>
                          <th>SNo</th>
                          <th>Client Name</th>
                          <th>Invoice Number</th>
                          <th>Year</th>
                          <th>Month</th> 
                        
                          <th>Total Amount</th>
                          <th>TDS Amount</th>
                          <th>Pay Amount</th>
                          <th>Due Amount</th>
                          <th>Payment Date</th>
                          <th>Cheque Number</th>
                          <th>Cheque Date</th>
                         
                          <th>Payment Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $r=1; foreach($clientDetail as $transaction){?>
                      <tr>
                       <td><?php echo $r;?></td>
                       <?php $clientname = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$transaction['clientid']))?>
                       <td><?php echo $clientname['client_name'] ?></td>
                       <td><?php echo $transaction['invoiceno']?></td>
                       <td><?php echo $transaction['year_v'];?></td>
                       <td><?php echo $this->month[$transaction['month_v']];?></td>
                       
                       <td><?php echo $transaction['totalamount']; $Totalamount[]=$transaction['totalamount'];?></td>
                       <td><?php echo $transaction['tds_amount']; $TotalTDS[]=$transaction['tds_amount'];?></td>
                       <td><?php echo $transaction['pay_amount']; $TotalPay[]=$transaction['pay_amount'];?></td>
                       <td><?php echo $transaction['due_amount']; $TotalDue[]=$transaction['due_amount'];?></td>
                       <td><?php echo $transaction['payment_date']?></td>
                       
                       <td><?php echo $transaction['cheque_no']?></td>
                       <td><?php echo $transaction['cleardate']?></td>
                       
                       
                       <td><?php echo $pstatus['payment_status']?></td>
                       
                       
                      </tr>
                       <?php $r++; }?>
                      </tbody>
                     <tfoot>
                     <th>Total</th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th><?=array_sum($Totalamount);?></th>
                     <th><?=array_sum($TotalTDS);?></th>
                     <th><?=array_sum($TotalPay);?></th>
                     <th><?=array_sum($TotalDue);?></th>
                      <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     </tfoot>
                    </table>
                    </div></div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Column selectors table -->
      </div>
        <!-- Basic Inputs end -->
  
      </div>
    </div>
    </section></div></div></div>
 
  
 
 
 