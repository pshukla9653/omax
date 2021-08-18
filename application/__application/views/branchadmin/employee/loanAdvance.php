 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Extra Deduction Report</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Extra Deduction Report</a>
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
                  <h4 class="card-title">Extra Deduction Report</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/loanAdvance', array('name'=>'addDepartment'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">

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
                            <div class="col-md-6">
                                    
                                    <?php echo form_label('Month'); ?>
                                    <select name="Month" class="form-control">
                                    <option value="">Select</option>
                                    <option value="-1">All</option>
                                    <?php foreach($this->month as $m_id=>$m_name){?>
                                    <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                    <?php }?>
                                    </select>
                            <?php echo form_error('Month', '<p class="text-danger">', '</p>'); ?>
                            
                            </div>
                    <div class="col-md-6">
                           
                            </div>
                    
                     <div class="col-md-6"><br>
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
                  <h4 class="card-title">Extra Deduction Report</h4>
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
                          <th>Extra Deducation Type</th>
                          <th>Employee Code</th> 
                          <th>Employee Name</th> 
                          <th>Extra Deducation Amount</th> 
                          <th>Extra Deducation Approved Amount</th>
                          <th>EMI Start/ Loan Return Month</th>
                          <th>Date of Applied</th>
                          <th>Date of Approved</th>
                          <th>Deducation Approved by</th>
                          <th>Deducation Purpose</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 0;
						foreach($lonaAdvance as $item){?>
                                      <tr>
                                      <td><?=++$i?></td>
                                      <td><?php 
									   $extra =  $this->CommanModel->getDataIfdataexists('extradeduction_name','tbl_extradeduction',array('id'=>$item['loan_type']));
									  echo $extra['extradeduction_name'];?></td>
                                      <td> 
                                     <?php
									 $empname =  $this->CommanModel->getDataIfdataexists('emp_name,emp_code','tbl_employee',array('id'=>$item['emp_id']));
									 echo $empname['emp_code'];
									 ?> </td>
                                     <td><?php echo $empname['emp_name'];?></td>
                                     <td><?php echo $item['loan_amount']?></td>
                                    
                                     <td><?php echo $item['loan_approved']?></td>
                                    
                                     <td><?php echo $item['emi_start_month'] ?></td>
                                    
                                    <td><?php echo $item['date_applied']?></td>
                                    <td><?php echo $item['date_approved']?></td>
                                    <td>
									<?php
									 $empname =  $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$item['loan_approved_by']));
									 echo $empname['emp_name'];
									 ?></td>
                                    <td><?php echo $item['purpose_loan']?></td>
                                    <?php if($item['loan_type'] == 'Loan'){?>
                                    <td><a href="<?php echo base_url('Reports/emiDetial/'.$item['id']);?>" class="btn btn-info">Emi Detail</a></td>
                                    <?php }else{?><td>--</td><?php }?>
                                    
                                    
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
 
  
 
 
 