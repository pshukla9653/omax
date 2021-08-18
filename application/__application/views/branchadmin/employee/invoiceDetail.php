 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Client Invoice Detail</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">List</a>
                </li>
                
              </ol>
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
                  <h4 class="card-title">Client Invoice Detail List</h4>
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
                        <?php echo $this->session->flashdata('msg'); ?>
                    <table class="table table-striped table-bordered dataex-html5-selectors">
                      <thead>
                    <?php $paymentdetail = explode(',',$invoicealldetail['payment_string']);
					$payment = explode('-',$paymentdetail[1]);
					
				
					 ?>
                       <tr>
                          <th>Service Id</th>
                          <th>Sub Serivice Id</th>
                          <th>Client Rate</th>
                          <th>Quantitiy</th>
                          <th>BillCycle</th>
                          <th>Total Present Days</th>
                          <th>Per Day Bill Rate</th>
                          <th>Total Present Days Billing Amount</th>
                          <th>OT Days</th>
                          <th>Per Day Ot Billing Rate</th>
                          <th>Total OT Billing Amount</th>
                          <th>Total Basic Amount</th>
                          <?php
						  $tax = explode(':' , $payment[12]);
						   for($r=0; $r < count($tax); $r++){ 
						  	$taxdetail = explode('@', $tax[$r]);
						  ?>
                          <th><?php echo $taxdetail[1];?></th>
                           <th><?php echo $taxdetail[1].' Percent';?></th>
                          <?php }?>
                          <th>Service Charge</th>
                          <th>Service Charge Percent</th>
                          <th>Total Taxable Amount</th>
                          <th>CGST</th>
                          <th>CGST Percent</th>
                          <th>SGST</th>
                          <th>SGST Percent</th>
                          <th>IGST</th>
                          <th>IGST Percent</th>
                          <th>Total GST</th>
                          <th>Total Sub Service Amount</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                       
                         <?php 
						   
						    for($i=1;$i<count($paymentdetail);$i++)
							{
							   $paymentdata = explode('-',$paymentdetail[$i]);
                               
						
						      ?> 
						     <tr>
                                <?php 
								$servicename = $this->CommanModel->getDataIfdataexists('service_name','tbl_service',array('id'=>$paymentdata[0]));
								?>
                                <td><?php echo $servicename['service_name'];?></td>
                                <?php 
								$subservicename = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation',array('id'=>$paymentdata[1]));
								?>
                                <td><?php echo $subservicename['designation_name'];?></td>
                                <td><?php echo $paymentdata[2];?></td>
                                <td><?php echo $paymentdata[3];?></td>
                                <td><?php echo $paymentdata[4];?></td>
                                <td><?php echo $paymentdata[5];?></td>
                                <td><?php echo round($paymentdata[6], 2);?></td>
                                <td><?php echo $paymentdata[7];?></td>
                                <td><?php echo $paymentdata[8];?></td>
                                <td><?php echo $paymentdata[9];?></td>
                                <td><?php echo $paymentdata[10];?></td>
                                <td><?php echo $paymentdata[11];?></td>
                                <?php $tax1=''; $taxd='';
						  $tax1 = explode(':' , $paymentdata[12]);
						   for($r=0; $r < count($tax1); $r++){ 
						  	$taxd = explode('@', $tax1[$r]);
						  ?>
                          <td><?php echo $taxd[2];?></td>
                           <td><?php echo $taxd[3];?></td>
                          <?php }?>
                                
                                <?php $service = explode('@',$paymentdata[13]);?>
                                <td><?php echo $service[0];?></td>
                                <td><?php echo $service[1];?></td>
                                <td><?php echo $paymentdata[14];?></td>
                                <?php $cgst = explode('@',$paymentdata[15]);?>
                                <td><?php echo $cgst[0];?></td>
                                <td><?php echo $cgst[1];?></td>
                                <?php $sgst = explode('@',$paymentdata[16]);?>
                                <td><?php echo $sgst[0];?></td>
                                <td><?php echo $sgst[1];?></td>
                                <?php $igst = explode('@',$paymentdata[17]);?>
                                <td><?php echo $igst[0];?></td>
                                <td><?php echo $igst[1];?></td>
                                <td><?php echo $paymentdata[18];?></td>
                                <td><?php echo $paymentdata[19];?></td>
                               
                               
                               
                                
                                
                           </tr>
                       <?php } ?>
                        
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
 
  
 
 
 