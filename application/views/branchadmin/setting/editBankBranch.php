<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Bank Branch (For Company Use)</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Update Bank Branch (For Company Use)</a>
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
                  <h4 class="card-title">Update Bank Branch (For Company Use)</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editBankBranch/'.$editbankbranch[0]['id'], array('name'=>'addBankBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                                <select class="form-control" name="bank_id">
                                <option value="">Select Bank</option>
                                <?php foreach($bankList as $bank){?>
                                <option value="<?php echo $bank['id'];?>" <?php echo $editbankbranch[0]['bank_id']==$bank['id']?'selected':'';?>><?php echo $bank['bank_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('bank_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Branch Code'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editbankbranch[0]['branch_code'], 'placeholder'=>'Branch Code', 'name' => 'branch_code')); ?>
								<?php echo form_error('branch_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('IFSC Code'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editbankbranch[0]['ifsc_code'], 'placeholder'=>'IFSC Code', 'name' => 'ifsc_code')); ?>
								<input type="hidden" name="ifsc_code_hidden" value="<?php echo $editbankbranch[0]['ifsc_code'];?>"/>
								<?php echo form_error('ifsc_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" <?php echo $editbankbranch[0]['status']==1?'selected':'';?>>Active</option>
                                <option value="0" <?php echo $editbankbranch[0]['status']==0?'selected':'';?>>Inactive</option>
                                </select>
                                
                            </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Branch Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editbankbranch[0]['branch_name'], 'placeholder'=>'Branch Name', 'name' => 'branch_name')); ?>
								<input type="hidden" name="branch_name_hidden" value="<?php echo $editbankbranch[0]['branch_name'];?>"/>
								<?php echo form_error('branch_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Account No'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editbankbranch[0]['account_no'], 'placeholder'=>'Account No', 'name' => 'account_no')); ?>
								<?php echo form_error('account_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                             <div class="col-md-6">
                            
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('MICR Code'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editbankbranch[0]['micr_code'], 'placeholder'=>'MICR Code', 'name' => 'micr_code')); ?>
								<input type="hidden" name="micr_code_hidden" value="<?php echo $editbankbranch[0]['micr_code'];?>"/>
								<?php echo form_error('micr_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                    <div class="col-md-6">
                            
                              
                            
                            </div>
                    
                     <div class="col-md-6">
                  <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
                  </div>
                  </div>
                  
                  
                  </div>
                  </div>
                 
                </div>
              </div>
              
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Bank Branch</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Bank List</h4>
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
                    
                    <table class="table table-striped table-bordered compact">
                      <thead>
                      <th>Bank Name</th>
                      <th>Branch Name</th>
                      <th>IFSC Code</th>
                      <th>MICR Code</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($branchList as $branch) { ?>
                                    <tr>
                                        <td><?php echo $branch['bank_name']; ?></td>
                                        <td><?php echo $branch['branch_name']; ?></td>
                                        <td><?php echo $branch['ifsc_code']; ?></td>
                                        <td><?php echo $branch['micr_code']; ?></td>
                                       
                                        <td><?php echo ($branch['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editBankBranch/'.$branch['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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