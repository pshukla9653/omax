<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Employee Registration</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a>
                </li>
                
                <li class="breadcrumb-item active">Employee Registration
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-xs-12">
          
        </div>
      </div>
      <div class="content-body">
        
        <!-- Form wizard with vertical tabs section start -->
        <section id="validation">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Employee Registration</h4>
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
                    
                     <?php echo form_open_multipart('branchadmin/Employee/create', array('class'=>'steps-validation wizard-circle', 'name'=>'emp'));?>
                     <?php echo $this->session->flashdata('msg'); ?>
                      <!-- Step 1 -->
                      <h6>Personal Detail</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-4">
                          <div class="form-group">
								<?php echo form_label('Employee Code <span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('emp_code'), 'placeholder'=>'Employee Code', 'name' => 'emp_code','autofocus'=>'autofocus')); ?>
								<?php echo form_error('emp_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Employee Name <span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('emp_name'), 'placeholder'=>'Employee Name', 'name' => 'emp_name')); ?>
								<?php echo form_error('emp_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date of Birth'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('dob'), 'placeholder'=>'dd/mm/yyyy', 'name' => 'dob','id'=>'date')); ?>
								<?php echo form_error('dob', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Gender'); ?>
                                <?php echo form_dropdown(array('class'=>'form-control', 'value'=>set_value('gender'), 'name' => 'gender'),array(''=>'Select','Male'=>'Male','Female'=>'Female')); ?>
								<?php echo form_error('gender', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Languages Known'); ?>
                                <?php echo form_dropdown(array('class'=>'form-control', 'value'=>set_value('language_known'), 'name' => 'language_known'),array(''=>'Select','Hindi'=>'Hindi','English'=>'English','Both'=>'Both')); ?>
								<?php echo form_error('language_known', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Married/Unmarried'); ?>
                                <?php echo form_dropdown(array('class'=>'form-control', 'value'=>set_value('married_status'), 'name' => 'married_status'),array(''=>'Select','Married'=>'Married','Unmarried'=>'Unmarried')); ?>
								<?php echo form_error('married_status', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Identification Mark'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('identification_mark'), 'placeholder'=>'Identification Mark', 'name' => 'identification_mark')); ?>
								<?php echo form_error('identification_mark', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                            	<label>Photo</label>
                                <input type="file" class="form-control" style="height:auto;" name="logo" id="logo" value="">
                                 <span class="text-danger"><?php echo form_error('logo'); ?></span>
                                 <img id="image_upload_preview" src="" alt=""/>
                            	 <img src=""  alt=""/>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Nationality'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>'INDIAN', 'placeholder'=>'Nationality', 'name' => 'nationality')); ?>
								<?php echo form_error('nationality', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
								<?php echo form_label('Mother Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('mother_name'), 'placeholder'=>'Mother Name', 'name' => 'mother_name')); ?>
								<?php echo form_error('mother_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Mobile<span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('mobile'), 'placeholder'=>'99999999999', 'name' => 'mobile','id'=>'mobile')); ?>
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Email'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('email'), 'placeholder'=>'xxxx@xx.xx', 'name' => 'email','id'=>'email')); ?>
								<?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('PAN'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pan'), 'placeholder'=>'AAAAA1234A', 'name' => 'pan','id'=>'pan')); ?>
								<?php echo form_error('pan', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Adhar Card No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('adhar_card_no'), 'placeholder'=>'9999 9999 9999', 'name' => 'adhar_card_no','id'=>'adhar_card_no')); ?>
								<?php echo form_error('adhar_card_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            <div class="form-group">
                            	<label>Finger Print (Right Hand Thumb)</label>
                                <input type="file" class="form-control" style="height:auto;" name="right_thumb"/>
                                 <span class="text-danger"><?php echo form_error('right_thumb'); ?></span>
                                 
                            </div>
                            <div class="form-group">
                            	<label>Finger Print (Left Hand Thumb)</label>
                                <input type="file" class="form-control" style="height:auto;" name="left_thumb"/>
                                 <span class="text-danger"><?php echo form_error('left_thumb'); ?></span>
                            </div>
                            
                            <div class="form-group">
								<?php echo form_label('Religion'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('religion'), 'placeholder'=>'Religion', 'name' => 'religion')); ?>
								<?php echo form_error('religion', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                         
                            <div class="form-group">
								<?php echo form_label('Father Name'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('father_name'), 'placeholder'=>'Father Name', 'name' => 'father_name')); ?>
								<?php echo form_error('father_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Wife/Husband Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('wife_husband_name'), 'placeholder'=>'Wife/Husband Name', 'name' => 'wife_husband_name')); ?>
								<?php echo form_error('wife_husband_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Children'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('children'), 'placeholder'=>'Children', 'name' => 'children')); ?>
								<?php echo form_error('children', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Blood Group'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('blood_group'), 'placeholder'=>'Blood Group', 'name' => 'blood_group')); ?>
								<?php echo form_error('blood_group', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Hight (In cms)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('hight'), 'placeholder'=>'Hight (In cms)', 'name' => 'hight')); ?>
								<?php echo form_error('hight', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Weight (In kgs)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('weight'), 'placeholder'=>'Weight (In kgs)', 'name' => 'weight')); ?>
								<?php echo form_error('weight', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Chest (In cms.)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('chest'), 'placeholder'=>'Chest (In cms.)', 'name' => 'chest')); ?>
								<?php echo form_error('chest', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Cast'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('cast'), 'placeholder'=>'Cast', 'name' => 'cast')); ?>
								<?php echo form_error('cast', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                        </div>
                        
                        
                      </fieldset>
                       <h6>Address Detail</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                          <h4>Permanent Address</h4>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('Village'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('p_village'), 'placeholder'=>'Village', 'name' => 'p_village','id'=>'p_village')); ?>
								<?php echo form_error('p_village', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Post'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('p_post'), 'placeholder'=>'Post', 'name' => 'p_post','id'=>'p_post')); ?>
								<?php echo form_error('p_post', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Police Station'); ?>
                                <?php echo form_input(array('class'=>'form-control ', 'value'=>set_value('p_police_station'), 'placeholder'=>'Police Station', 'name' => 'p_police_station','id'=>'p_police_station')); ?>
								<?php echo form_error('p_police_station', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('District'); ?>
                                <?php echo form_input(array('class'=>'form-control ', 'value'=>set_value('p_dist'), 'placeholder'=>'District', 'name' => 'p_dist','id'=>'p_dist')); ?>
								<?php echo form_error('p_dist', '<p class="text-danger">', '</p>'); ?>
                          </div> 
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('State'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('p_state'), 'placeholder'=>'State', 'name' => 'p_state','id'=>'p_state')); ?>
								<?php echo form_error('p_state', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('PIN'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('p_pin'), 'placeholder'=>'PIN', 'name' => 'p_pin','id'=>'p_pin')); ?>
								<?php echo form_error('p_pin', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Mobile'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>set_value('p_mobile'), 'placeholder'=>'Mobile', 'name' => 'p_mobile','id'=>'p_mobile')); ?>
								<?php echo form_error('p_mobile', '<p class="text-danger">', '</p>'); ?>
                          </div>
                           
                          </div>
                          
                          
                          </div>
                          <div class="col-md-6">
                          <h4>Presant Address</h4>
                          <div class="col-md-12">
                          <input type="checkbox" name="copydata" id="copy" onClick="copyAddress()"/> Same as Permanent
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('Village'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('village'), 'placeholder'=>'Village', 'name' => 'village','id'=>'village')); ?>
								<?php echo form_error('village', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Post'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('post'), 'placeholder'=>'Post', 'name' => 'post','id'=>'post')); ?>
								<?php echo form_error('post', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Police Station'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('police_station'), 'placeholder'=>'Police Station', 'name' => 'police_station','id'=>'police_station')); ?>
								<?php echo form_error('police_station', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('District'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('dist'), 'placeholder'=>'District', 'name' => 'dist','id'=>'dist')); ?>
								<?php echo form_error('dist', '<p class="text-danger">', '</p>'); ?>
                          </div> 
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('State'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('t_state'), 'placeholder'=>'State', 'name' => 't_state','id'=>'t_state')); ?>
								<?php echo form_error('t_state', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('PIN'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pin'), 'placeholder'=>'PIN', 'name' => 'pin','id'=>'pin')); ?>
								<?php echo form_error('pin', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Mobile'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('t_mobile'), 'placeholder'=>'Mobile', 'name' => 't_mobile','id'=>'t_mobile')); ?>
								<?php echo form_error('t_mobile', '<p class="text-danger">', '</p>'); ?>
                          </div>
                           
                          </div>
                          
                          
                          </div>
                          
                        </div>
                        
                        
                      </fieldset>
                       <h6>Qualification Details</h6>
                      <fieldset>
                        <div class="row">
                         
                          <table class="table-bordered" style="width:100%;">
                          <thead>
                          <th>Sr. No.</th>
                          <th>Standard/Class</th>
                          <th>Subjects</th>
                          <th>University/Collage Name</th>
                          <th>Passing Year</th>
                         
                          <th>Division</th>
                          </thead>
                          <tbody>
                          <?php for($i=1; $i< 6; $i++){?>
                          <tr>
                          <td><?php echo $i;?></td>
                          <td><input type="text" class="form-control" name="class_stad<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="subject<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="collage_name<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="passing_year<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="division<?php echo $i;?>" /></td>
                          </tr>
                          <?php }?>
                          </tbody>
                          </table>
                          
                        </div>
                        
                        
                      </fieldset>
                       <h6>Licence Details</h6>
                      <fieldset>
                        <div class="row">
                         
                          <table class="table-bordered" style="width:100%;">
                          <thead>
                          <th>Sr. No.</th>
                          <th>Type of Licence</th>
                          <th>Issued By</th>
                          <th>Register No</th>
                          <th>Date of Issue</th>
                          <th>Valid Up To</th>
                         
                         
                          </thead>
                          <tbody>
                          <?php for($i=1; $i< 4; $i++){?>
                          <tr>
                          <td><?php echo $i;?></td>
                          
                          <td><input type="text" class="form-control" name="licence_type<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="issued_by<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="regi_no<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="issue_date<?php echo $i;?>" id="ddate<?php echo $i;?>"/></td>
                          <td><input type="text" class="form-control" name="valid_upto<?php echo $i;?>" id="date<?php echo $i;?>"/></td>
                         
                          </tr>
                          <?php }?>
                          </tbody>
                          </table>
                          
                        </div>
                        
                        
                      </fieldset>
                       <h6>Reference Details</h6>
                      <fieldset>
                        <div class="row">
                         
                          <table class="table-bordered" style="width:100%;">
                          <thead>
                          <th>Sr. No.</th>
                          <th>Person Name</th>
                          <th>Address</th>
                          <th>Mobile</th>
                          <th>Period Knowm</th>
                         
                          </thead>
                          <tbody>
                          <?php for($i=1; $i<3; $i++){?>
                          <tr>
                          <td><?php echo $i;?></td>
                          <td><input type="text" class="form-control" name="ref_person_name<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="ref_person_add<?php echo $i;?>" /></td>
                          <td><input type="text" class="form-control" name="ref_person_mbile<?php echo $i;?>" id="mobile"/></td>
                          <td><input type="text" class="form-control" name="ref_person_known<?php echo $i;?>" /></td>
                          
                          </tr>
                          <?php }?>
                          </tbody>
                          </table>
                          
                        </div>
                        
                        
                      </fieldset>
                     <h6>Official Detail</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-4">
                          <div class="form-group">
								<?php echo form_label('Date of Joining'); ?>
                            
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('doj'), 'placeholder'=>'dd/mm/yyyy', 'name' => 'doj','id'=>'date')); ?>
								<?php echo form_error('doj', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Job Type'); ?>
                                <?php echo form_dropdown(array('class'=>'form-control required', 'value'=>set_value('job_type'), 'name' => 'job_type'),
								array(''=>'Select','Probation'=>'Probation','Permanent'=>'Permanent','Contract'=>'Contract'));?>
								<?php echo form_error('job_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                                <select name="grade" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($gradeList as $grade):?>
                                <option value="<?php echo $grade['id'];?>"><?php echo $grade['grade_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('grade', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Department'); ?>
                                <select name="department" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department):?>
                                <option value="<?php echo $department['id'];?>"><?php echo $department['department_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('department', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                          </div>
                          <div class="col-md-4">
                          
                          <div class="form-group">
								<?php echo form_label('ESIC Id'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('esic_id'), 'placeholder'=>'ESIC Id', 'name' => 'esic_id')); ?>
								<?php echo form_error('esic_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('UAN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('pf_id'), 'placeholder'=>'PF Id', 'name' => 'pf_id')); ?>
								<?php echo form_error('pf_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Bank Account No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('account_no'), 'placeholder'=>'Account No', 'name' => 'account_no')); ?>
								<?php echo form_error('account_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Post/Designation'); ?>
                                <select name="designation" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation):?>
                                <option value="<?php echo $designation['id'];?>"><?php echo $designation['designation_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('designation', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                             <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('bank_name'), 'placeholder'=>'Bank Name', 'name' => 'bank_name')); ?>

								<?php echo form_error('bank_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Bank Branch Name'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>set_value('bank_branch_name'), 'placeholder'=>'Bank Branch Name', 'name' => 'bank_branch_name')); ?>
								<?php echo form_error('bank_branch_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('IFSC Code'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>set_value('ifsc_code'), 'placeholder'=>'IFSC Code', 'name' => 'ifsc_code')); ?>
								<?php echo form_error('ifsc_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Branch Code'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>set_value('branch_code'), 'placeholder'=>'Branch Code', 'name' => 'branch_code')); ?>
								<?php echo form_error('branch_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Salary Type'); ?>
                                <?php echo form_dropdown(array('class'=>'form-control required', 'value'=>set_value('salary_type'), 'name' => 'salary_type','id'=>'emp_type'),
								array(''=>'Select','AsPerClient'=>'As Per Client','AsPerEmployee'=>'As Per Employee'));?>
								<?php echo form_error('salary_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Experience (In Year)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>set_value('experience'), 'placeholder'=>'Experience (In Year)', 'name' => 'experience')); ?>
								<?php echo form_error('experience', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                        </div>
                        
                        
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Form wizard with vertical tabs section end -->
      </div>
    </div>
  </div>