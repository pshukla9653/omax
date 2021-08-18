 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">EMI List Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">EMI List Report</a>
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
                  <h4 class="card-title">EMI List</h4>
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
                          <th>Employee Name</th>
                          <th>EMI Amount</th>
                          <th>EMI Number</th> 
                          <th>EMI Start Month</th> 
                          <th>EMI Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 0;
						foreach($emidtail as $item){?>
                                      <tr>
                                      <td><?=++$i?></td>
                                      <td> 
                                     <?php
									 $empname =  $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['emp_id']));
									 echo $empname['emp_name'];
									 ?> </td>
                                     <td><?php echo $item['emi_amount']?></td>
                                    
                                     <td><?php echo $item['no_of_emi']?></td>
                                    
                                     <td><?php echo $this->month[$item['emi_start_month']]; ?></td>
                                    <?php if($item['emi_status'] == 0){?>
                                     <td><a class="btn btn-danger">Unpaid</a></td>
                                    <?php }else{?><a class="btn btn-success">Paid</a><?php }?>
                                    
                                    
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
 
  
 
 
 