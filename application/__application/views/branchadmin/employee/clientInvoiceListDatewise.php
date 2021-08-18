<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Client Invoice List</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Client Invoice List (Date Wise)</a>
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
                  <h4 class="card-title">Client Invoice list (Invoice Date Wise)</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/clientInvoiceListdatewise', array('name'=>'addDepartment'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                <div class="form-group">
								<label>Invoice Date From</label>
                                <input type="date" name="datefrom" class="form-control" required/>
							</div>

                            
                            </div>
                            <div class="col-md-6">
                            
                           <div class="form-group">
								<label>Invoice Date To</label>
                                <input type="date" name="dateto" value="" class="form-control" required/>
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

</div>
      <div class="content-body">
       
        <!-- Column selectors table -->
        <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
              
                <div class="card-header">
                  <h4 class="card-title">Client Invoice List</h4>
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
                    
                       <tr>
                          <th>SNo</th>
                          <th>Client Name</th>
                          
                          <th>Invoice Number</th>
                          <th> Invoice Date</th>
                          <th>Month</th>
                          <th>Year</th>
                          <th>Total Basic Amount</th>
                          <?php foreach($deductionList as $deduction):?>
                          <th>Total <?=$deduction['deduction_head'];?></th>
                          <?php endforeach;?>
                          <th>Total Service Charge</th>
                          <th>Total Taxable Amount</th>
                          <th>Total CGST</th>
                          <th>Total SGST</th>
                          <th>Total IGST</th>
                          <th>Total GST</th>
                          <th>Gross Billing Amt.</th>
                          <th>Other Deduction Head</th>
                          <th>Other Deduction UOM</th>
                          <th>Other Deduction Amount</th>
                          <th>Gross Billing Amount After Duduction</th>
                          <th>Print Invoice</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       
						  <?php 
						  
						   $i = 0;
						  foreach ($invoicedetail as $item){ ?>
                                 <tr>
                                      <td><?=++$i?></td>
                                      <td>
									 <?php  $clientname = $this->CommanModel->getDataIfdataexists('client_name','tbl_client
',array('id'=>$item['client_id']));?>
									  <?php echo $clientname['client_name']?>
                                      </td>
                                     
                                      <td><?php echo $item['invoice_no']?></td>
                                      <td><?php echo $item['invoice_date']?></td>
                                      <td><?php echo $this->month[$item['month_v']];?></td>
                                      <td><?php echo $item['year_v']?></td>
                                      <?php 
									  $getAll =  explode(',',$item['total_payment_string']);
									  //var_dump($getAll); exit;
									 $totalamt = explode('-', $getAll[1]);
									   
									     
									  ?>
                                      <td><?php echo $totalamt[0]; $TotalBasicAmount[]=$totalamt[0];?></td>
                                      <?php foreach($deductionList as $deduction):?>
                          <td><?php if($totalamt[1]!=''){ $FTD =''; $TDedu=''; $TDedu = explode(':', $totalamt[1]);
						  foreach($TDedu as $td){
							  $FTD = explode('@', $td);
							  if($FTD[0] == $deduction['id']){
								 echo  $FTD[1]; 
								 $DEDPART[$deduction['id']][]= $FTD[1];
								 break; 
							  }
						  }
						    }?></td>
                          <?php endforeach;?>
                                      
                                      <td><?php echo $totalamt[2];$TotalServiceCharge[]=$totalamt[2];?></td>
                                      <td><?php echo $totalamt[3]; $TotalTaxebleAmount[]=$totalamt[3];?></td>
                                      <td><?php echo $totalamt[4];$TotalCGST[]=$totalamt[4];?></td>
                                      <td><?php echo $totalamt[5];$TotalSGST[]=$totalamt[5];?></td>
                                      <td><?php echo $totalamt[6];$TotalIGST[]=$totalamt[6];?></td>
                                      <td><?php echo $totalamt[7];$TotalGST[]=$totalamt[7];?></td>
                                      <td><?php echo $totalamt[8];$TotalSubseriveAmount[]=$totalamt[8];?></td>
                                      <td><?php echo $item['other_deduction_head']?></td>
                                      <td><?php echo $item['other_deduction_uom']?></td>
                                      <td><?php echo $item['other_deduction_amount']?></td>
                                      <td><?php echo $item['total_amount_after_deduction']?></td>
                                      <td><a class="btn btn-info" href="<?php echo base_url('branchadmin/Setting/printInvoice/'.$item['id']);?>">Print</a>|<a href="<?php echo base_url('branchadmin/Setting/deleteInvoice/'.$item['id']);?>" target="_blank" class="text-danger" onclick="return confirm('Are you sure? You want to delete!')">Delete</a></td>
                                      <td><a href="<?php echo base_url('Reports/invoiceDetail/'.$item['id']);?>">View Detail</a></td>
                                     </tr>
                          <?php } ?>
                       
                      </tbody>
                     <tfoot>
                     <th>Total</th>
                          <th></th>
                          
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th><?=array_sum($TotalBasicAmount);?></th>
                          <?php foreach($deductionList as $deduction):?>
                          <th><?=array_sum($DEDPART[$deduction['id']]);?></th>
                          <?php endforeach;?>
                          <th><?=array_sum($TotalServiceCharge);?></th>
                          <th><?=array_sum($TotalTaxebleAmount);?></th>
                          <th><?=array_sum($TotalCGST);?></th>
                          <th><?=array_sum($TotalSGST);?></th>
                          <th><?=array_sum($TotalIGST);?></th>
                          <th><?=array_sum($TotalGST);?></th>
                          <th><?=array_sum($TotalSubseriveAmount);?></th>
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
  
 
 
 