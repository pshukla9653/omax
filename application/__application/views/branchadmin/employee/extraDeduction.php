 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Extra Deduction</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Extra Deduction</a>
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
                  <h4 class="card-title">Extra Deduction</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   			<?php echo form_open_multipart('Reports/extraDeduction', array('name'=>'extraDeduction'));?>
                    
                             <div class="col-md-6">
                             			<?php echo $this->session->flashdata('msg'); ?>
                                          <div class="form-group">
													<?php echo form_label('All Extra Deduction'); ?>
                                                        <select name="extradeductionId" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="0">LOAN</option>
                                                        <?php foreach($extradeductionList as $item){?>
                                            			<option value="<?php echo $item['id'];?>"><?php echo $item['extradeduction_name'];?></option>
                                            		<?php }?>
                                          				</select>
                                         			<?php echo form_error('extradeductionId', '<p class="text-danger">', '</p>'); ?>
                                          </div>
                                          <div class="form-group ">
													<?php echo form_label('Year'); ?>
                                                        <select name="year" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="-1">ALL</option>
                                                        <?php foreach($this->year as $y=>$v){?>
                                            			<option value="<?php echo $y;?>"><?php echo $v;?></option>
                                            		<?php }?>
                                          				</select>
                                         			<?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                                          </div>
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
                                         <div class="form-group">
                                             <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                                             <?php echo form_close();?>
                                         </div>
                                          
                            
                            </div>
                  </div>
                  </div>
                 
                </div>
              	</div>
                
        <!-- Basic Inputs end -->
  
                </div>
            </div> 
           </div>
        </section>
      </div>
      
                      <div class="content-body">
                        <!-- Column selectors table -->
                        <section id="column-selectors">
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="card">
                                    
                                <div class="card-header">
                                  <h4 class="card-title"><?=$extraDeductionName;?> Deduction Report</h4>
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
                                          <th>ID No.</th>
                                          <th>Member Name</th>
                                          <th>Unit/Client</th>
                                          <th>Recovery Amt.</th> 
                                          <th>Balance Amt.</th> 
                                          <th>Remarks </th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $j = 0;
                                        foreach($extraDeduction as $item):
										$empname =  $this->CommanModel->getDataIfdataexists('emp_code,emp_name','tbl_employee',array('id'=>$item['emp_id']));
										$empofficial =  $this->CommanModel->getDataIfdataexists('department','tbl_employee_official',array('emp_id'=>$item['emp_id']));
										$department =  $this->CommanModel->getDataIfdataexists('department_name','tbl_department',array('id'=>$empofficial['department']));
										$getOne =''; $etraamoun=''; $getAll='';
										
													
										?>
                                                      <tr>
                                                      <td><?=++$j?></td>
                                                      <td><?php echo $empname['emp_code'];?></td>
                                                      <td> 
                                                     <?php echo $empname['emp_name'];?> </td>
                                                     <td><?=$department['department_name'];?></td>
                                                     <td><?=$item['paid']?></td>
                                                    
                                                    <td><?=$item['due']?></td>
                                                    <td>&nbsp;</td>
                                           </tr>
                                        <?php   endforeach;?> 
                                       
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
           	
      </div>
</div>



  
 
 
 