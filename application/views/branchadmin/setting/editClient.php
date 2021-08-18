<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Client</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Update Client</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      	<script>
            function thirdDisable()
			{
				
					
					var pro=document.getElementById("third").disabled;
					if(pro==false)
					{
						document.getElementById("third").disabled=true;
					}else
					{
						document.getElementById("third").disabled=false;
					}
				
			}
			function twoDisable()
			{
				
				var pro1=document.getElementById("first").disabled;
				var pro2=document.getElementById("second").disabled;
				var pro3=document.getElementById("third").disabled;
				if(pro1==false && pro2==false)
				{
					document.getElementById("first").disabled=true;
					document.getElementById("second").disabled=true;
				}
				else if(pro3==false)
				{
					document.getElementById("first").disabled=false;
					document.getElementById("second").disabled=false;
				}
				else
				{
					document.getElementById("first").disabled=false;
					document.getElementById("second").disabled=false;
				}
			}

      </script>
        
        
      </div>
      <div class="content-body">
      <!-- Form wizard with vertical tabs section start -->
        <section id="validation">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Update Client</h4>
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
                  <div class="card-block">
                    
                     <?php echo form_open_multipart('branchadmin/Setting/editClient/'.$editdclient[0]['id'], array('class'=>'steps-validation wizard-circle', 'name'=>'addclient'));?>
                     <?php echo $this->session->flashdata('msg'); ?>
                      <!-- Step 1 -->
                      <h6>Update Client</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                    <div class="col-md-6">          
                               <div class="form-group">
								<?php echo form_label('Industry'); ?>
                                <select name="industry_id" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($industryList as $industry){?>
                                <option value="<?php echo $industry['id'];?>" <?php echo $industry['id']==$editdclient[0]['industry_id']?'selected':'';?>><?php echo $industry['industry_name'];?></option>
                                <?php }?>
                                </select>
                                
								<?php echo form_error('industry_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Name of the Company/Firm/Client<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['client_name'], 'placeholder'=>'Company Name', 'name' => 'cname')); ?>
                                
								<?php echo form_error('cname', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Company/Firm Reg. No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['client_regi_no'], 'placeholder'=>'Company/Firm Reg. No.', 'name' => 'client_regi_no')); ?>
                                
								<?php echo form_error('client_regi_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Licence Number'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['licence_no'], 'placeholder'=>'Licence Number', 'name' => 'licence_no')); ?>
                                
								<?php echo form_error('licence_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('PAN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['pan_cord_no'], 'placeholder'=>'PAN No.', 'name' => 'pan_cord_no','id'=>'pan')); ?>
                                
								<?php echo form_error('pan_cord_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Tax Deduction A/c or GSTIN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['tax_deduction_ac_no'], 'placeholder'=>'Tax Deduction A/c or GSTIN No.', 'name' => 'tax_deduction_ac_no')); ?>
								<?php echo form_error('tax_deduction_ac_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Name<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['contact_person_name'], 'placeholder'=>'Contact Person Name', 'name' => 'contact_person_name')); ?>
                                
								<?php echo form_error('contact_person_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Mobile<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['contact_person_mobile'], 'placeholder'=>'Contact Person Mobile', 'name' => 'contact_person_mobile','id'=>'mobile')); ?>
                                
								<?php echo form_error('contact_person_mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                              <label>Deduction :</label>
                              <div class="c-inputs-stacked">
                               <?php
							   $deduction_ids = explode(',', $editdclient[0]['deduction_id']);
							   
							    foreach($deductionList as $deduction){
								
								?>
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="deduction_id[]" value="<?php echo $deduction['id'];?>"
                                  <?php if(in_array($deduction['id'], $deduction_ids)==true){echo 'Checked';}?>
                                  />
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description ml-0"><?php echo $deduction['deduction_head'];?></span>
                                </label>
                                <?php }?>
                               
                              </div>
                            </div>
                             <div class="form-group">
                              <label>Professional Tax :</label>
                              <div class="c-inputs-stacked">
                               
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="p_tax" value="1" <?=$editdclient[0]['p_tax']=='1'?'checked':'';?>/>
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description ml-0">Yes</span>
                                </label>
                               
                               
                              </div>
                            </div>
                            </div>
                        <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('Contact Person Email<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['contact_person_email'], 'placeholder'=>'Contact Person Email', 'name' => 'contact_person_email')); ?>
                                
								<?php echo form_error('contact_person_email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                        <?php echo form_label('Address'); ?>
                                       <?php echo form_textarea(array('class'=>'form-control', 'value'=>$editdclient[0]['address'],  'placeholder'=>'Address', 'name' => 'address')); ?>
                                        <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                   
                        
                        <div class="form-group">
                                        <?php echo form_label('Country'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['country'], 'placeholder'=>'Country', 'name' => 'country')); ?>
                                        <?php echo form_error('country', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('State'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['state'], 'placeholder'=>'State', 'name' => 'state')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('City'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['city'], 'placeholder'=>'City', 'name' => 'city')); ?>
                                        <?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Pincode'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['pincode'], 'placeholder'=>'Pincode', 'name' => 'pincode')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    
                            <div class="form-group">
                                        <?php echo form_label('Service Charge (Percentage)'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdclient[0]['service_tax'], 'placeholder'=>'Service Tax', 'name' => 'service_tax')); ?>
                                        <?php echo form_error('service_tax', '<p class="text-danger">', '</p>'); ?>
                                    </div> 
                                 <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" <?php echo $editdclient[0]['status']==1?'selected':'';?>>Active</option>
                                <option value="0" <?php echo $editdclient[0]['status']==0?'selected':'';?>>Inactive</option>
                                </select>
                                
                            
                            
                            </div>
                            <div class="form-group">
                              <label>GST :</label>
                               <select class="form-control" name="gst">
                                <option value="1,2" <?php echo $editdclient[0]['gst']=='1,2'?'selected':'';?>>CGST &amp; SGST</option>
                                <option value="3" <?php echo $editdclient[0]['gst']=='3'?'selected':'';?>>IGST</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Bill On UP GST :</label>
                              <div class="c-inputs-stacked">
                                <label class="inline custom-control custom-checkbox block">
                                  <input type="checkbox" class="custom-control-input" name="on_up_gst" value="1" <?php echo $editdclient[0]['on_up_gst']==1?'Checked':'';?> />
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description ml-0">Yes</span>
                                </label>
                              </div>
                            </div>
                            </div>
                        </div>
                        
                      </fieldset>
                       <h6>Update Sub Client (Optional)</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                    <div class="col-md-6">          
                              
                            <div class="form-group">
								<?php echo form_label('Name of the Company/Firm/Client<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['client_name'], 'placeholder'=>'Company Name', 'name' => 'ocname')); ?>
                                
								<?php echo form_error('ocname', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Company/Firm Reg. No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['client_regi_no'], 'placeholder'=>'Company/Firm Reg. No.', 'name' => 'oclient_regi_no')); ?>
                                
								<?php echo form_error('oclient_regi_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Licence Number'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['licence_no'], 'placeholder'=>'Licence Number', 'name' => 'olicence_no')); ?>
                                
								<?php echo form_error('olicence_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('PAN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['opan_cord_no'], 'placeholder'=>'PAN No.', 'name' => 'opan_cord_no','id'=>'pan')); ?>
                                
								<?php echo form_error('pan_cord_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Tax Deduction A/c or GSTIN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['tax_deduction_ac_no'], 'placeholder'=>'Tax Deduction A/c or GSTIN No.', 'name' => 'otax_deduction_ac_no')); ?>
                                
								<?php echo form_error('otax_deduction_ac_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Name<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['contact_person_name'], 'placeholder'=>'Contact Person Name', 'name' => 'ocontact_person_name')); ?>
                                
								<?php echo form_error('ocontact_person_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Mobile<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['contact_person_mobile'], 'placeholder'=>'Contact Person Mobile', 'name' => 'ocontact_person_mobile','id'=>'mobile1')); ?>
                                
								<?php echo form_error('ocontact_person_mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            
                            </div>
                        <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('Contact Person Email<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['contact_person_email'], 'placeholder'=>'Contact Person Email', 'name' => 'ocontact_person_email','id'=>'email1')); ?>
                                
								<?php echo form_error('ocontact_person_email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                        <?php echo form_label('Address'); ?>
                                       <?php echo form_textarea(array('class'=>'form-control', 'value'=>$editdsubclient[0]['address'],  'placeholder'=>'Address', 'name' => 'oaddress')); ?>
                                        <?php echo form_error('oaddress', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                   
                        
                        <div class="form-group">
                                        <?php echo form_label('Country'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['country'], 'placeholder'=>'Country', 'name' => 'ocountry')); ?>
                                        <?php echo form_error('ocountry', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('State'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['state'], 'placeholder'=>'State', 'name' => 'ostate')); ?>
                                        <?php echo form_error('opincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('City'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['city'], 'placeholder'=>'City', 'name' => 'ocity')); ?>
                                        <?php echo form_error('ocity', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Pincode'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$editdsubclient[0]['pincode'], 'placeholder'=>'Pincode', 'name' => 'opincode')); ?>
                                        <?php echo form_error('opincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                   
                            
                            
                            
                           
                            </div>
                        </div>
                        </div>
                        
                      </fieldset>
                       
                    <?php echo form_close();?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Form wizard with vertical tabs section end -->
        
        <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Client</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   
                   
                  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Client List</h4>
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
                      <th>Id</th>
                      <th>Client Name</th>
                      <th>Contact Person Name</th>
                      <th>Contact Person Mobile</th>
                       <th>Contact Person Email</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($clientList as $client) { ?>
                                    <tr>
                                         <td><?php echo $client['id']; ?></td>
                                        <td><?php echo $client['client_name']; ?></td>
                                        <td><?php echo $client['contact_person_name']; ?></td>
                                        <td><?php echo $client['contact_person_mobile']; ?></td>
                                         <td><?php echo $client['contact_person_email']; ?></td>
                                        <td><?php echo ($client['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editClient/'.$client['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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
       </div>
 </div>