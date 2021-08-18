 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Opening Balance Transaction Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Opening Balance Transaction Report</a>
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
              
      <div class="content-body">
            
        <!-- Column selectors table -->
       <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
              
                <div class="card-header">
                  <h4 class="card-title">Opening Balance Transaction Report</h4>
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
                         
                          <th>Payment Mode</th> 
                          <th>Total Amount</th>
                          <th>TDS Amount</th>
                          <th>Pay Amount</th>
                          <th>Due Amount</th>
                          <th>Payment Date</th>
                          <th>Cheque Number</th>
                          <th>Cheque Date</th>
                          <th>Transaction Id</th>
                          <th>Paid Amount</th>
                          <th>Payment Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($clientDetail as $transaction){?>
                      <tr>
                       <td>1</td>
                       <?php $clientname = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$transaction['client_id']))?>
                       <td><?php echo $clientname['client_name'] ?></td>
                       
                       
                       <?php if($transaction['paymentmode'] == 1){?>
                       <td>By Cash</td>
                       <?php }?>
                       <?php if($transaction['paymentmode'] == 2){?>
                       <td>By Cheque</td>
                       <?php }?>
                       <?php if($transaction['paymentmode'] == 3){?>
                       <td>Online</td>
                       <?php }?>
                       <td><?php echo $transaction['totalamount']?></td>
                       <td><?php echo $transaction['tds_amount']?></td>
                       <td><?php echo $transaction['pay_amount']?></td>
                       <td><?php echo $transaction['due_amount']?></td>
                       <td><?php echo $transaction['payment_date']?></td>
                       <?php if($transaction['cheque_no'] != ""){?>
                       <td><?php echo $transaction['cheque_no']?></td>
                       <td><?php echo $transaction['cleardate']?></td>
                       <?php }else{?>
                       <td>---</td>
                       <td>---</td>
                       <?php }?>
                       <?php if($transaction['transaction_id'] != ""){?>
                       <td><?php echo $transaction['transaction_id']?></td>
                       <?php }else{?>
                       <td>---</td>
                       <?php }?>
					  <?php $pstatus = $this->CommanModel->getDataIfdataexists('paid_amount,status','tbl_outstading_amount',array('client_id'=>$transaction['client_id']))?>
                       <td><?php echo $pstatus['paid_amount']?></td>
                       <td><?php echo $pstatus['status']?></td>
                       
                       
                      </tr>
                       <?php }?>
                      </tbody>
                     
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
 
  
 
 
 