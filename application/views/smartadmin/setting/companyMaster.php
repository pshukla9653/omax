<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Company</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Add Company</a>
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
                  <h4 class="card-title">Add Company</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <?php echo form_open_multipart('smartadmin/Setting/addCompany', array('name'=>'addcompany'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                        href="#tab1" aria-expanded="true">Company Detail</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2"
                        aria-expanded="false">Company Other Detail</a>
                      </li>
                      
                     
                    </ul>
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                       <div class="col-md-6">          
                              
                            <div class="form-group">
								<?php echo form_label('Name of the Company<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('cname'), 'placeholder'=>'Company Name', 'name' => 'cname')); ?>
                                
								<?php echo form_error('cname', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="col-md-6">
                             <div class="form-group">
								<?php echo form_label('Finacial Year From'); ?>
                                
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('financial_year_from'), 'placeholder'=>'Finacial Year From', 'name' => 'financial_year_from','id'=>'date')); ?>
                                
                                <?php echo form_error('financial_year_from', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             <div class="col-md-6">
                             <div class="form-group">
								<?php echo form_label('To'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('financial_year_to'), 'placeholder'=>'To', 'name' => 'financial_year_to','id'=>'date1')); ?>
                                <?php echo form_error('financial_year_to', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             </div>
                             <div class="form-group">
								<?php echo form_label('Establishment Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('establishment_date'), 'placeholder'=>'Establishment Date', 'name' => 'establishment_date','id'=>'date2')); ?>
                                <?php echo form_error('establishment_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Company/Firm Reg. No.<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('company_regi_no'), 'placeholder'=>'Company/Firm Reg. No.', 'name' => 'company_regi_no')); ?>
                                
								<?php echo form_error('company_regi_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Licence Number'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('licence_no'), 'placeholder'=>'Licence Number', 'name' => 'licence_no')); ?>
                                
								<?php echo form_error('licence_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('PAN No.<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pan_cord_no'), 'placeholder'=>'PAN No.', 'name' => 'pan_cord_no','id'=>'pan')); ?>
                                
								<?php echo form_error('pan_cord_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Tax Deduction A/c or GSTIN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('tax_deduction_ac_no'), 'placeholder'=>'Tax Deduction A/c or GSTIN No.', 'name' => 'tax_deduction_ac_no')); ?>
                                
								<?php echo form_error('tax_deduction_ac_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Contact Person<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('person_name'), 'placeholder'=>'Contact Person Name', 'name' => 'person_name')); ?>
                                
								<?php echo form_error('person_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Username<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('username'), 'placeholder'=>'Username', 'name' => 'username')); ?>
                                
								<?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            <div class="form-group">
								<?php echo form_label('Contact Person Mobile<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('mobile'), 'placeholder'=>'Contact Person Mobile', 'name' => 'mobile')); ?>
                                
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Contact Person Email<span class="text-danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('email'), 'placeholder'=>'Contact Person Email', 'name' => 'email')); ?>
                                
								<?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             
                            </div>
                      </div>
                      <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                        <div class="col-md-6">
                             
                            <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('PF Registration No.'); ?>
                                
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pf_regi_no'), 'placeholder'=>'PF Registration No.', 'name' => 'pf_regi_no')); ?>
                                <?php echo form_error('pf_regi_no', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('PF Registration Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pf_regi_date'), 'placeholder'=>'PF Registration Date', 'name' => 'pf_regi_date','id'=>'date3')); ?>
                                <?php echo form_error('pf_regi_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Policy in Lieu of EDLI No.'); ?>
                                
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('policy_in_lieu_edli_no'), 'placeholder'=>'Policy in Lieu of EDLI No.', 'name' => 'policy_in_lieu_edli_no')); ?>
                                <?php echo form_error('policy_in_lieu_edli_no', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Policy in Lieu of EDLI Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('policy_in_lieu_edli_date'), 'placeholder'=>'Date', 'name' => 'policy_in_lieu_edli_date','id'=>'date4')); ?>
                                <?php echo form_error('policy_in_lieu_edli_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('E.S.I. Registration No.'); ?>
                                
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('esi_regi_no'), 'placeholder'=>'E.S.I. Registration No.', 'name' => 'esi_regi_no')); ?>
                                <?php echo form_error('esi_regi_no', '<p class="text-danger">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('E.S.I. Registration Date'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('esi_regi_date'), 'placeholder'=>'E.S.I. Registration Date', 'name' => 'esi_regi_date','id'=>'date4')); ?>
                                <?php echo form_error('esi_regi_date', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                           <div class="form-group">
                                <?php echo form_label('Gratuity Registration No.'); ?>
                                
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('gratuity_reg_no'), 'placeholder'=>'Gratuity Registration No.', 'name' => 'gratuity_reg_no')); ?>
                                <?php echo form_error('gratuity_reg_no', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                <div class="col-md-12">
                            <div class="form-group col-md-12">
                            	<label>Company Logo</label>
                                <input type="file" class="form-control" style="height:auto;" name="logo" id="logo" value="">
                                 <span class="text-danger"><?php echo form_error('logo'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                            	
                                <img id="image_upload_preview" src="" alt=""/>
                            <img src=""  alt=""/>
                            </div>
                            
                            </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                        <?php echo form_label('Address'); ?>
                                       <?php echo form_textarea(array('class'=>'form-control', 'value'=>set_value('address'),  'placeholder'=>'Address', 'name' => 'address')); ?>
                                        <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                   
                        
                        <div class="form-group">
                                        <?php echo form_label('Country'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('country'), 'placeholder'=>'Country', 'name' => 'country')); ?>
                                        <?php echo form_error('country', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('State'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('state'), 'placeholder'=>'State', 'name' => 'state')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('City'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('city'), 'placeholder'=>'City', 'name' => 'city')); ?>
                                        <?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Pincode'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pincode'), 'placeholder'=>'Pincode', 'name' => 'pincode')); ?>
                                        <?php echo form_error('pincode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                            
                            </div>     
                      </div>
                      
                      
                    </div>
                    
                     <div class="col-md-12">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
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