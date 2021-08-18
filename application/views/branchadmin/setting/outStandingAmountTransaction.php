<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Opening Balance Transaction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Opening Balance Transaction</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      
      </div>
      <div class="content-body" ng-app="">
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Opening Balance Transaction </h4>
                  
                </div>
               <script>
				   function jsFunction(value)
					{
						if(value == 1)
						{
						   document.getElementById("cash").style.display = 'block';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 2)
						{
						   document.getElementById("cheque").style.display = 'block';
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 3)
						{
						   document.getElementById("online").style.display = 'block';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 0)
						{
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'none';
						   document.getElementById("tdstxt").style.display = 'none';
						}
					}
					

               </script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <script>
                $(document).ready(function(e) {
					var result = 0; 
				   $(".payamt").blur(function(){
					 
					 var dueamt = $('#damount').val();
					 var payamt = $(".payamt").val();
					 var tdsamount = $(".tdsamt").val();
					 if(tdsamount == "" )
					 {
						tdsamount = 0.00; 
					 }
					 var totalcut = parseFloat(payamt)+parseFloat(tdsamount);
					 
					  
					 result = parseFloat(dueamt)-parseFloat(totalcut);
					 
				     $('#dueamt').val(result.toFixed(2));
					  
					});
					
					
				});
               </script>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Web/outStandingAmountTransaction/'.$outamtDetail['client_id'], array('name'=>'addBankBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                 <div class="form-group">
								<?php echo form_label('Cleint Name'); ?>
                                <?php $name = $this->CommanModel->getDataIfdataexists('client_name','tbl_client',array('id'=>$outamtDetail['client_id']));?>
                                <input type="text" class="form-control" readonly   value="<?php echo $name['client_name']?>" />
								<?php echo form_error('totalamount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            <div class="form-group">
								<?php echo form_label('Total Amount'); ?>
          <input type="text" class="form-control" readonly name="totalamount" id="totalamt" value="<?php echo $outamtDetail['outstanding_amount']?>" />
								<?php echo form_error('totalamount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Paid Amount'); ?>
                                <input type="text" class="form-control" readonly name="paidamount"  value="<?php echo $outamtDetail['paid_amount']?>" id="paidamt"/>
								<?php echo form_error('dueamount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Due Amount'); ?>
                                <input type="text" class="form-control" readonly name="dueamount"  value="<?php echo $outamtDetail['due_amount']?>" id="dueamt"/>
								<?php echo form_error('dueamount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <input type="hidden" value="<?php echo $outamtDetail['due_amount']?>"  id="damount">
                            <input type="hidden" value="<?php echo $outamtDetail['client_id'];?>" name="clientid">
                            
                             </div>
                            
                    
                            <div class="col-md-6">
                         
                           <div class="form-group">
								<?php echo form_label('Payment Mode'); ?>
                                <select class="form-control" name="paymentmode" onchange="jsFunction(this.value);" id="paymentmode">
                                <option value="">--select--</option>
                                <option value="1">By Cash</option>
                                <option value="2">By Cheque</option>
                                <option value="3">Online</option>
                                </select>
								<?php echo form_error('paymentmode', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                                <div class="form-group" id="tdstxt" style="display:none;" >
								<?php echo form_label('TDS Amount'); ?>
                                <input type="text" class="form-control tdsamt"  name="tdsamount"  placeholder="TDS Amount" />
								<?php echo form_error('tdsamount', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="form-group" id="paytxt" style="display:none;" >
								<?php echo form_label('Pay Amount'); ?>
                                <input type="text" class="form-control payamt"  name="payamount"  placeholder="Pay Amount" />
								<?php echo form_error('payamount', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            <div id="cash" style="display:none;">
                                
                                 <div class="form-group">
                                 <?php echo form_label('Payable Person'); ?>
								 <input type="text" name="payperson" class="form-control" placeholder="Payable Person">
                                <?php echo form_error('payperson', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="form-group">
								<?php echo form_label('Payment Date'); ?>
                                <input type="text" class="form-control"  name="cashpaydate"  placeholder="Payment Date" id="date"/>
								<?php echo form_error('cashpaydate', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <div id="cheque" style="display:none;">
                                
                                <div class="form-group">
								<?php echo form_label('Cheque Number'); ?>
                                <input type="text" class="form-control"  name="chequenumber"  placeholder="Cheque Number"/>
								<?php echo form_error('chequenumber', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                 <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                                <input type="text" class="form-control"  name="chequebank"  placeholder="Bank Name"/>
								<?php echo form_error('chequebank', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                 <div class="form-group">
								<?php echo form_label('Cheque Date'); ?>
                                <input type="text" class="form-control"  name="cleardate" id="date"  placeholder="Cheque Date"/>
								<?php echo form_error('cleardate', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                 <div class="form-group">
								<?php echo form_label('Payment Date'); ?>
                                <input type="text" class="form-control"  name="chequepaydate" id="date"  placeholder="Payment Date"/>
								<?php echo form_error('chequepaydate', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <div id="online" style="display:none;">
                              
                                <div class="form-group">
								<?php echo form_label('Transaction Id'); ?>
                                <input type="text" class="form-control"  name="transactionid"  placeholder="Transaction Id"/>
								<?php echo form_error('transactionid', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                                <input type="text" class="form-control"  name="onlinebank"  placeholder="Bank Name"/>
								<?php echo form_error('onlinebank', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="form-group">
								<?php echo form_label('Payment Date'); ?>
                                <input type="text" class="form-control"  name="onlinepaydate" id="date"  placeholder="Payment Date"/>
								<?php echo form_error('onlinepaydate', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <br>
                            <?php if($outamtDetail['status'] != 'Paid'){?>
                               <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            
							<?php } else { ?>
                              <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg disabled')); ?>
                            <?php }?>
                  <?php echo form_close();?>
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