7<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Branch Admin</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Edit Profile</a>
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
                
                <div class="card-body">
                  <div class="card-block">
                   <?php echo form_open_multipart('branchadmin/Setting/profile/'.$admindetail2['user_id'], array('name'=>'addBranch'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                             <input type="hidden" name="hidetxt" value="<?php echo $admindetail2['user_id'];?>">
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Admin Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['name'], 'placeholder'=>'Admin Name', 'name' => 'name')); ?>
                                
								<?php echo form_error('name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                        
                             <div class="form-group">
								<?php echo form_label('Mobile Number'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'id'=>'mobile', 'value'=>$admindetail['mobile'], 'placeholder'=>'Contact Person Mobile', 'name' => 'mobile')); ?>
                                
								<?php echo form_error('gstnumber', '<p class="text-danger">', '</p>'); ?>
                            </div>
                              <div class="form-group">
                                        <?php echo form_label('Address'); ?>
                                       <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['address'],  'placeholder'=>'Address', 'name' => 'address')); ?>
                                        <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                              </div>
                              <div class="form-group">
                                        <?php echo form_label('Country'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['country'], 'placeholder'=>'Country', 'name' => 'country')); ?>
                                        <?php echo form_error('country', '<p class="text-danger">', '</p>'); ?>
                               </div>
                            
                            </div>
                            <div class="col-md-6">
                          
                                   
                        
                      
                                    <div class="form-group">
                                        <?php echo form_label('State'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['state'], 'placeholder'=>'State', 'name' => 'state')); ?>
                                        <?php echo form_error('state', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('City'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['city'], 'placeholder'=>'City', 'name' => 'city')); ?>
                                        <?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Zipcode'); ?>
                                        <?php echo form_input(array('class'=>'form-control', 'value'=>$admindetail2['zipcode'], 'placeholder'=>'Pincode', 'name' => 'zipcode')); ?>
                                        <?php echo form_error('zipcode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <br><?php echo form_label('Upload Profile Picture'); ?>
                                        <br><input type="file" name="profile_photo" class="form_control">
                                        <?php echo form_error('zipcode', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                            
                            </div>
                    
                    
                     <div class="col-md-12">
                  <?php echo form_submit(array('value' => 'Update', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
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