<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Edit Loan/Advance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Edit Loan/Advance</a>
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
                  <h4 class="card-title">Edit Loan/Advance</h4>
               
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Employee/editEmiDetail/'.$emidetail[0]['id'], array('name'=>'CreateLoan'));?>
                   <input name="txthide" type="hidden" value="<?php echo $emidetail[0]['id']?>">
                  
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg');?>
                            </div> 
                             
                            <div class="col-md-6">
                          <div class="form-group">
                           <?php echo form_label('EMI No'); ?>
                               <input type="text" class="form-control" value="<?php echo $emidetail[0]['no_of_emi'];?>" name ='emi_no'  id="emino" />
							</div>	
                             <div class="form-group">
                             <?php echo form_label('EMI Amount'); ?>
                               <input type="text" class="form-control" value="<?php echo $emidetail[0]['emi_amount'];?>" name ='emi_amount' />
                               </div>
                               
                               <div class="form-group">
								<?php echo form_label('EMI Start/ Loan Return Month'); ?>
                                <select name="emi_start_month" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($this->month as $k=>$m){?>
                                 <?php $month = explode('-',$emidetail[0]['emi_start_month']);?>
                                 <option value="<?php echo $k;?>"<?php if($emidetail[0]['emi_start_month'] == $k) {?> selected<?php } ?> ><?php echo $m;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('emi_start_month[]', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                            </div>
                            
                            <div class="col-md-6">
                             
             
                            </div>
                  
                        
                           
                  <?php echo form_close();?>
                  
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
 
