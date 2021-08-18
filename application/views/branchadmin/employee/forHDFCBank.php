<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">FOR HDFC BANK</h3>
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
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">FOR HDFC BANK</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/forHDFCBank', array('name'=>'forHDFCBank'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                          <div class="form-group">
                                        
                                        <?php echo form_label('Year'); ?>
                                                        <select name="year" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="-1">ALL</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        </select>
                                        <?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                                                    </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                            <div class="form-group">
							           	<?php echo form_label('Month'); ?>
                                <select name="Month" class="form-control">
                                <option value="">Select</option>
                                <option value="-1">ALL</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
							         	<?php echo form_error('Month', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                             </div>
                    <div class="col-md-6">
                           <div class="form-group">
							           	<?php echo form_label('Salary Type'); ?>
                                <select name="salary_type" class="form-control" id="SalaryTypeReport">
                                <option value="">Select</option>
                                <option value="-1">ALL</option>
                                <option value="AsPerClient">As Per Client</option>
                                <option value="AsPerEmployee">As Per Employee</option>
                                
                                </select>
							         	<?php echo form_error('salary_type', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                            </div>
                     <div class="col-md-6" id="divforclinet">
                           <div class="form-group">
							           	<?php echo form_label('Client'); ?>
                                <select name="client_id[]" class="form-control select2" multiple>
                                <option value="">Select</option>
                                <?php foreach($clientList as $client){?>
                                <option value="<?php echo $client['id'];?>"><?php echo $client['client_name'];?></option>
                                <?php } ?>
                                </select>
							         	<?php echo form_error('client_id', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
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
                  <h4 class="card-title">FOR HDFC BANK LIST </h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li>
						  <?php echo form_open_multipart('Reports/downloadExcelOfHDFC', array('name'=>'forHDFCBank'));?>
                          		<input type="hidden"  name="hideYear" value="<?php echo $year;?>">
                                <input type="hidden"  name="hideMonth" value="<?php echo $month;?>">
                                <input type="hidden"  name="hidesalary_type" value="<?php echo $salary_type;?>">
                                <input type="hidden"  name="hideclient_id" value="<?php echo $client_ids;?>">
                          <?php echo form_submit(array('value' => 'Download Excel', 'name'=>'download', 'class'=>'btn tag-success')); ?>
                            <?php echo form_close();?>
                      </li>
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
                    <table class="table table-striped table-bordered compact">
                      <thead>
                     
                            <tr>
                            <th>S.No.</th>
                            <th>Transaction_Ref_No</th>
                            <th>Amount</th>
                            <th>Value_Date</th>
                            <th>Branch_Code</th>
                            <th>Sender_Account_Type</th>
                            <th>Remitter_Account_No</th>
                            <th>Remitter_Name</th>
                            <th>IFSC_Code</th>
                            <th>Debit_Account</th>
                           
                            <th>Beneficiary_Account_type</th>
                            <th>Bank_Account_Number</th>
                            
                            <th>Beneficiary_Name</th>
                            <th>Remittance_Details</th>
                            <th>Debit_Account_System</th>
                            <th>Email ID / Mobile Number</th>
                            <th>Remark</th>
                            
                            <th>Salary id</th>
                            <th>Emp Id</th>
                            <th>Paid Status</th>
                            <th>Client Name</th>
                            </tr>
                        
                      </thead>
                      <tbody>
                       
						  <?php  
						  $i = 0;
						  foreach ($bankRecordDetail as $item): ?>
                          <?php            
								$empaccount =  $this->CommanModel->getEMPDetailListWhere('tbl_employee.emp_name,tbl_employee.emp_code,tbl_employee_official.account_no, tbl_employee_official.ifsc_code', $item['emp_id']);
						  ?>
                                 <tr>
                                      <td style="text-align:center;"><?=++$i?></td> 
                                      <td><?php
                                       
                                       if(strlen($i)==2)
                                       {
                                          $last = "0000" .$i; 
                                       }elseif(strlen($i)==3){
                                         $last = "000" .$i; 
                                       }elseif(strlen($i)==4){
                                         $last = "00" .$i; 
                                       }else {
                                         $last = "00000" .$i; 
                                       }
                                       
                                        echo (int)substr(date("Y"),2).''. date("d") .''. date("m") .'0594' .  $last;
                                       
                                      ?>
                                      
                                      </td>
                                      <td><?=$item['NetSalary']; $TOTAL[]=$item['NetSalary'];?></td>
                                      <td><?php echo date("d.m.y");?></td>
                                      <td><?php echo "0594";?></td>
                                      <td><?php echo "CA";?></td>
                                      <td><?php echo "05942320001694";?></td>
                                      <td><?php echo "OMAX SECURITY SER.PVT. LTD.";?></td>
                                      <td><?php echo $empaccount['ifsc_code'];?></td>
                                      <td><?php echo "05942320001694";?></td>
                                      <td><?php echo "SB";?></td>
                                      <td><?php echo $empaccount['account_no'];?></td> 
                                      <td><?php echo $empaccount['emp_name'];?></td>
                                      <td><?php echo "salary";?></td>
                                      <td><?php echo "omax security seervices pvt. Ltd.";?></td>
                                      <td><?php echo 'omaxsecurityservices.com';?></td> 

                                      <td><?php echo '';?></td>
                                      <td><?php echo $item['id'];?></td>
                                      <td><?php echo $item['emp_id'];?></td>
                                      <td><?php echo $item['paid_status'];?></td>
                                      <td><?php echo $item['client_name'];?></td>
                                     
                                         
                                </tr>
                          <?php    endforeach; ?>
                       
                      </tbody>
                     <tfoot>
                     <tr>
                            <th></th>
                            <th>Total</th>
                            <th><?=array_sum($TOTAL);?></th>
                            <th></th>
                           <th></th>
                            <th></th>
                           <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                           
                            <th></th>
                            <th></th>
                            
                            <th></th>
                            <th></th>
                            <th></th>
                           <th></th>
                            <th></th>
                            
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
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
 
  
 
 
 