<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Extra Deduction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Extra Deduction</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <script>
               function jsFunction(value)
				{
					var emi = document.getElementById("emifield").style.display;
					var em =document.getElementById("emifield");
					if(value == '0')
					{
						em.style.display = "block";
					}
					else
					{
						em.style.display = "none";
					}
				}


        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
           $(document).ready(function(e) {
            $("#emino").blur(function(){
				var emiamount = 0;
                var loanamount = $('#loanamt').val();
			    var emino = $('#emino').val();
				
				emiamount = loanamount/emino;
				
				$('#emiamt').val(emiamount.toFixed(2));
            });
        });
        </script>
      </div>
      <div class="content-body">
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Extra Deduction</h4>
                 
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Employee/CreateLoan', array('name'=>'CreateLoan'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg');?>
                            </div> 
                             
                            <div class="col-md-6">
                             <div class="form-group">
								<?php echo form_label('Type of Extra Deduction'); ?>
                                <select name="loan_type" class="form-control" onchange="jsFunction(this.value);">
                                <option value="">Select</option>
                                 <option value="0">LOAN</option>
                                <?php foreach($extradedutinmasterList as $extra){?>
                                  <option value="<?php echo $extra['id'];?>"><?php echo $extra['extradeduction_name'];?></option>
                                 <?php }?>
                                
                                </select>
								<?php echo form_error('loan_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Employee'); ?>
                                <select name="emp_id" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($empList as $emp){?>
                                 <option value="<?php echo $emp['id'];?>"><?php echo $emp['emp_name'].'('.$emp['emp_code'].')';?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('emp_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Applied Amount'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('loan_amount'), 'placeholder'=>'Applied Amount', 'name' => 'loan_amount')); ?>
								<?php echo form_error('loan_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Approved Amount'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('loan_approved'), 'placeholder'=>'Approved Amount', 'name' => 'loan_approved','id'=>'loanamt')); ?>
								<?php echo form_error('loan_approved', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div id="emifield" style="display:none;">
                             <div class="form-group">
								<?php echo form_label('No of EMI'); ?>
                                <input class='form-control' 'value'="" placeholder='No of EMI' name ='emi_no'  id="emino" >
								<?php echo form_error('emi_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('EMI Amount'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('emi_amount'), 'placeholder'=>'EMI Amount', 'name' => 'emi_amount','id'=>'emiamt','readonly'=>'readonly')); ?>
								<?php echo form_error('emi_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           
                            </div>
                           
                            
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Applied Date'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>date("d/m/Y"), 'name' => 'date_applied','id'=>'date','placeholder'=>'Applied Date')); ?>
								<?php echo form_error('date_applied', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Approved Date'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>date("d/m/Y"), 'name' => 'date_approved','id'=>'date1','placeholder'=>'Approved Date')); ?>
								<?php echo form_error('date_approved', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            <div class="form-group">
								<?php echo form_label('Approved By'); ?>
                                <select name="loan_approved_by" class="form-control select2">
                                <option value="">Select</option>
                                <?php foreach($adminList as $admin){?>
                                 <option value="<?php echo $admin['id'];?>"><?php echo $admin['emp_name'].' ('.$admin['designation_name'].')';?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('loan_approved_by', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Description'); ?>
                                <?php echo form_textarea(array('class'=>'form-control required', 'value'=>set_value('purpose_loan'), 'placeholder'=>'Description', 'name' => 'purpose_loan','resize'=>'none')); ?>
								<?php echo form_error('purpose_loan', '<p class="text-danger">', '</p>'); ?>
                            </div>
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  </div>
                  <?php echo form_close();?>
                  
                  </div>
                  
                  
                  </div>
                  </div>
                 
                </div>
              </div>
              
              
               <div class="card">
               
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Extra Deduction List</h4>
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
                    
                    <table class="table table-striped table-bordered compact table-responsive">
                      <thead>
                      
                      <th>Extra Deduction Type</th>
                      <th>Employee Code</th>
                      <th>Employee Name</th>
                      <th>Applied Amount</th>
                      <th>Approved Amount</th>
                      <th>EMI Amount</th>
                      <th>No Of EMI</th>
                      <th>Applied Date</th>
                      <th>Approved Date</th>
                      <th>Approved By</th>
                     
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                 
                                    <?php foreach($loandetail as $loan) { ?>
                                    <tr>
                                     <?php 
								
								  $aempname = $this->CommanModel->getDataIfdataexists('emp_name,emp_code','tbl_employee',array('id'=>$loan['emp_id']));
								  
								  $approvedbyempname = $this->CommanModel->getDataIfdataexists('emp_name','tbl_employee',array('id'=>$loan['loan_approved_by'])); 
								?>
                                        <td>
										<?php if($loan['loan_type']=='0'){ echo 'Loan';}
										else{
												$loantypename = $this->CommanModel->getDataIfdataexists('extradeduction_name','tbl_extradeduction',array('id'=>$loan['loan_type']));	
										echo $loantypename['extradeduction_name'];
										}
										
										
										?></td>
                                        <td><?php echo $aempname['emp_code']; ?></td>
                                        <td><?php echo $aempname['emp_name']; ?></td>
                                        <td><?php echo $loan['loan_amount']; ?></td>
                                        <td><?php echo $loan['loan_approved']; ?></td>
                                        <td><?php echo $loan['emi_amount']; ?></td>
                                        <td><?php echo $loan['emi_no']; ?></td>
                                        <td><?php echo $loan['date_applied']; ?></td>
                                        <td><?php echo $loan['date_approved']; ?></td>
                                        <td><?php echo $approvedbyempname['emp_name']; ?></td>
                                       
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Employee/editLoan/'.$loan['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                      
                      
                    </table>
                  
                  </div>
                </div>
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
 
