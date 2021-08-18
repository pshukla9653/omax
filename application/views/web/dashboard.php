  <div class="app-content content container-fluid" style="min-height:554px;">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
             
        <!-- Stats -->
        <div class="row">
        
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="p-2 text-xs-center bg-primary bg-darken-2 media-left media-middle">
                    <i class="fa fa-user" style="font-size:35px;color:#fff;"></i> 
                  </div>
                  <div class="p-2 bg-gradient-x-primary white media-body ">
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script src="jquery.counterup.min.js"></script>
                   <script>
                    jQuery(document).ready(function($) {
                      $('.counter').counterUp({
                       delay: 10,
                       time: 1000
                       });
                    });
					</script>
                    <h5 style="font-weight:bold;">Total Client</h5>
                  <h5 class="text-bold-400" style="font-weight:bold;"><i class="ft-arrow-up"></i> 
				   <span class="counter"><?php echo $this->CommanModel->Ifdataexists('id','tbl_client', array('company_id'=>$this->session->userdata('company_id'),
'branch_id'=>$this->session->userdata('branch_id')));?></span></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="p-2 text-xs-center bg-danger bg-darken-2 media-left media-middle">
                    <i class="fa fa-cog" style="font-size:35px;color:#fff;"></i>
                  </div>
                  <div class="p-2 bg-gradient-x-danger white media-body">
                    <h5>Total Services</h5>
                    <h5 class="text-bold-400"><i class="ft-arrow-up"></i><?php echo $this->CommanModel->Ifdataexists('id','tbl_service', array('company_id'=>$this->session->userdata('company_id'),
'branch_id'=>$this->session->userdata('branch_id')));?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="p-2 text-xs-center bg-warning bg-darken-2 media-left media-middle">
                    <i class="fa fa-cogs" style="font-size:35px;color:#fff;"></i>
                  </div>
                  <div class="p-2 bg-gradient-x-warning white media-body">
                    <h5>Total Sub-Services</h5>
                    <h5 class="text-bold-400"><i class="ft-arrow-up"></i> <?php echo $this->CommanModel->Ifdataexists('id','tbl_designation', array('company_id'=>$this->session->userdata('company_id'),
'branch_id'=>$this->session->userdata('branch_id')));?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="p-2 text-xs-center bg-success bg-darken-2 media-left media-middle">
                    <i class="fa fa-user" style="font-size:35px;color:#fff;"></i>
                  </div>
                  <div class="p-2 bg-gradient-x-success white media-body">
                    <h5>Total Employees</h5>
                    <h5 class="text-bold-400"><i class="ft-arrow-up"></i> <?php echo $this->CommanModel->Ifdataexists('id','tbl_employee', array('company_id'=>$this->session->userdata('company_id'),
'branch_id'=>$this->session->userdata('branch_id')));?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
        </div>
        <!--/ Stats -->
        <!--Product sale & buyers -->
        
       
      </div>
         <!--Recent Orders & Monthly Salse -->
       <div class="row">
          <div class="col-xl-12">
            <div class="card">
            
              <div class="card-header">
                <h4 class="card-title">Recent Invoice</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  </ul>
                </div>
              </div>
               
              <div class="card-body">
                <div class="card-block">
                  <p>
                    <span class="float-xs-right"><a href="<?php echo base_url('Reports/clientInvoiceList');?>" target="_blank">Invoice Summary <i class="ft-arrow-right"></i></a></span>
                  </p>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered dataex-html5-selectors">
                    <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Client Name</th>
                         <th>Year</th>
                          <th>Month</th>
                        <th>Invoice#</th>
                        <th>Status</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th><i class="fa fa-inr"></i> Amount</th>
                        <th>Payment</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

                            $getInv  =	$this->CommanModel->getListWhereLimit('id,client_id,invoice_no,payment_status,total_amount,paid_amount,due_amount,year_v,month_v','tbl_client_invoice','id','DESC',array('company_id'=>$this->session->userdata('company_id'),'branch_id'=>$this->session->userdata('branch_id')),'25');
							
                            for($i=0;$i<count($getInv);$i++)
                            {
                                    ?>  <tr>
                                           <td><?php echo $i+1;?></td>
                                           <td><?php 
                                                 $clientName =  $this->CommanModel->getDataIfdataexists('client_name','tbl_client', array('id'=>$getInv[$i]['client_id']));
                                                 echo $clientName['client_name'];?></td>  
                                                 <td><?php echo $getInv[$i]['year_v'];?></td>
                                                 <td><?php echo $this->month[$getInv[$i]['month_v']];?></td>  
                                           <td><a href="<?php echo base_url('branchadmin/Setting/printInvoice/' . $getInv[$i]['id']);?>"  target="_blank" ><?php echo $getInv[$i]['invoice_no']?></a></td> 
                                           <td><?php 
                                           
                                           if($getInv[$i]['payment_status'] == 'Unpaid'){
                                                    echo '<p class="btn btn-danger">Unpaid</p>';
                                           }elseif($getInv[$i]['payment_status'] == 'Paid'){
                                                    echo '<p class="btn btn-success">Paid</p>';
                                           }else{
                                                   echo '<p class="btn btn-warning">Due</p>';
                                           }

                                           
                                           ?></td> 
                                           <td><i class="fa fa-inr"></i> <?php echo $getInv[$i]['paid_amount']?></td>
                                           <td><i class="fa fa-inr"></i> <?php echo $getInv[$i]['due_amount']?></td>
                                           <td><i class="fa fa-inr"></i> <?php echo $getInv[$i]['total_amount']?></td>
                                           <?php if($getInv[$i]['payment_status'] != 'Paid'){?>                     
        <td><a href="<?php echo base_url('Web/transactionDetail/'.$getInv[$i]['client_id'].'/'.$getInv[$i]['year_v'].'/'.$getInv[$i]['month_v']);?>" class="btn btn-info">Get Payment</a></td> 
                             <?php }else{?>
                             <td><a href="<?php echo base_url('Web/transactionDetail/'.$getInv[$i]['client_id'].'/'.$getInv[$i]['year_v'].'/'.$getInv[$i]['month_v']);?>" class="btn btn-info disabled">Get Payment</a></td> 
                             <?php }?>
                                    
                                    </tr>                               <?php
                            }
							
                      ?>
                     
                    </tbody>
                  </table>
                </div>
              </div>
              
               
            </div>
          </div>
         </div>
        
        <!--/Recent Orders & Monthly Salse -->
          <div class="row match-height" >
         <style>
		 .mycss{
			overflow:hidden;
			}
         .mycss:hover{
		   overflow-y:scroll;
		   
		}
         </style>
         
          <div class="col-xl-4 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Birthday Event</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-body px-1 mycss" >
                <div id="recent-buyers" class="list-group height-300 position-relative ">
                  <?php if($birth == NULL){?>
                   <a href="#" class="list-group-item list-group-item-action media no-border">
                    <div class="media-left">
                      <span class="avatar avatar-md avatar-online">
                        <img class="media-object rounded-circle" src="<?php echo base_url('uploads/profile/avatar.jpg');?>"
                        alt="Generic placeholder image" style="height:80px;width:50px;">
                        <i></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <h6 class="list-group-item-heading"><strong>There is no birthday today</strong>
                     <span class="font-medium-4 float-xs-right pt-1"><i class="fa fa-birthday-cake" aria-hidden="true" style="font-size:30
                     px;"></i></span>
                      </h6>
                    
                    </div>
                  </a>
                  <?php }?>
                  <?php foreach($birth as $birthditail){?>
                  <a href="#" class="list-group-item list-group-item-action media ">
                    <div class="media-left">
                      <span class="avatar avatar-md avatar-online">
                        <img class="media-object rounded-circle" src="<?php  if(!empty($birthditail['photo'])){echo base_url('uploads/profile/'.$birthditail['photo']);}else{echo base_url('uploads/profile/avatar.jpg'); }?>"
                        alt="Generic placeholder image" style="height:80px;width:50px;">
                        <i></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <h6 class="list-group-item-heading"><?php echo $birthditail['emp_name'];?>
                     <span class="font-medium-4 float-xs-right pt-1"><i class="fa fa-birthday-cake" aria-hidden="true" style="font-size:30
                     px;"></i></span>
                      </h6>
                      <p class="list-group-item-text">
                          <?php $desname = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation',array('id'=>$birthditail['designation']));?>
                        <span class="tag tag-primary"><?php echo $desname['designation_name'];?></span><br><br>
                         <span class="tag tag-primary"><?php echo $birthditail['mobile'];?></span>
                      </p>
                    </div>
                  </a>
                  <?php }?>
                  
               </div>
              </div>
            </div>
          </div>
         
        </div>
        <!--/ Product sale & buyers -->
    </div>
  </div>
  
   