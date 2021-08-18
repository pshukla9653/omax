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
                
                <li class="breadcrumb-item active">Update
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
                    
                     <?php echo form_open_multipart('branchadmin/Employee/editEmp/'.$editemp['emp_id'], array('class'=>'steps-validation wizard-circle', 'name'=>'emp'));?>
                     <?php echo $this->session->flashdata('msg'); ?>
                      <!-- Step 1 -->
                      <h6>Personal Detail</h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-4">
                          <div class="form-group">
								<?php echo form_label('Employee Code <span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['emp_code'], 'placeholder'=>'Employee Code', 'name' => 'emp_code','required' => 'required')); ?>
								<?php echo form_error('emp_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Employee Name <span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['emp_name'], 'placeholder'=>'Employee Name', 'name' => 'emp_name')); ?>
								<?php echo form_error('emp_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date of Birth'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>date_format(date_create($editemp['dob']), 'd/m/Y'), 'placeholder'=>'dd/mm/yyyy', 'name' => 'dob','id'=>'date')); ?>
								<?php echo form_error('dob', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Gender'); ?>
                                <select name="gender" class="form-control">
                                <option value="Male" <?php echo $editemp['gender']=='Male'?'selected':'';?>>Male</option>
                                <option value="Female" <?php echo $editemp['gender']=='Female'?'selected':'';?>>Female</option>
                                </select>
								<?php echo form_error('gender', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Languages Known'); ?>
								<select name="language_known" class="form-control">
                                <option value="Hindi" <?php echo $editemp['language_known']=='Hindi'?'selected':'';?>>Hindi</option>
                                <option value="English" <?php echo $editemp['language_known']=='English'?'selected':'';?>>English</option>
                                <option value="Both" <?php echo $editemp['language_known']=='Both'?'selected':'';?>>Both</option>
                                </select>
								<?php echo form_error('language_known', '<p class="text-danger">', '</p>'); ?>
                            </div>
                             <div class="form-group">
								<?php echo form_label('Married/Unmarried'); ?>
								<select name="married_status" class="form-control">
                                <option value="Married" <?php echo $editemp['married_status']=='Married'?'selected':'';?>>Married</option>
                                <option value="Unmarried" <?php echo $editemp['married_status']=='Unmarried'?'selected':'';?>>Unmarried</option>
                                </select>
								<?php echo form_error('married_status', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Identification Mark'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['identification_mark'], 'placeholder'=>'Identification Mark', 'name' => 'identification_mark')); ?>
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
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['nationality'], 'placeholder'=>'Nationality', 'name' => 'nationality')); ?>
								<?php echo form_error('nationality', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                           <div class="form-group">
								<?php echo form_label('Mother Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['mother_name'], 'placeholder'=>'Mother Name', 'name' => 'mother_name')); ?>
								<?php echo form_error('mother_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Mobile<span class="danger">*</span>'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['mobile'], 'placeholder'=>'99999999999', 'name' => 'mobile','id'=>'mobile')); ?>
								<?php echo form_error('mobile', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Email'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['email'], 'placeholder'=>'xxxx@xx.xx', 'name' => 'email','id'=>'email')); ?>
								<?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('PAN'); ?>
                                <?php echo form_input(array('class'=>'form-control ', 'value'=>$editemp['pan'], 'placeholder'=>'AAAAA1234A', 'name' => 'pan','id'=>'pan')); ?>
								<?php echo form_error('pan', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Adhar Card No.'); ?>
                                <?php echo form_input(array('class'=>'form-control ', 'value'=>$editemp['adhar_card_no'], 'placeholder'=>'9999 9999 9999', 'name' => 'adhar_card_no','id'=>'adhar_card_no')); ?>
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
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['religion'], 'placeholder'=>'Religion', 'name' => 'religion')); ?>
								<?php echo form_error('religion', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                         
                            <div class="form-group">
								<?php echo form_label('Father Name'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['father_name'], 'placeholder'=>'Father Name', 'name' => 'father_name')); ?>
								<?php echo form_error('father_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                           <div class="form-group">
								<?php echo form_label('Wife/Husband Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['wife_husband_name'], 'placeholder'=>'Wife/Husband Name', 'name' => 'wife_husband_name')); ?>
								<?php echo form_error('wife_husband_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Children'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['children'], 'placeholder'=>'Children', 'name' => 'children')); ?>
								<?php echo form_error('children', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Blood Group'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['blood_group'], 'placeholder'=>'Blood Group', 'name' => 'blood_group')); ?>
								<?php echo form_error('blood_group', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Hight (In cms)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['hight'], 'placeholder'=>'Hight (In cms)', 'name' => 'hight')); ?>
								<?php echo form_error('hight', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Weight (In kgs)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['weight'], 'placeholder'=>'Weight (In kgs)', 'name' => 'weight')); ?>
								<?php echo form_error('weight', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Chest (In cms.)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['chest'], 'placeholder'=>'Chest (In cms.)', 'name' => 'chest')); ?>
								<?php echo form_error('chest', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Cast'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['cast'], 'placeholder'=>'Cast', 'name' => 'cast')); ?>
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
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['p_village'], 'placeholder'=>'Village', 'name' => 'p_village','id'=>'p_village')); ?>
								<?php echo form_error('p_village', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Post'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['p_post'], 'placeholder'=>'Post', 'name' => 'p_post','id'=>'p_post')); ?>
								<?php echo form_error('p_post', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Police Station'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['p_police_station'], 'placeholder'=>'Police Station', 'name' => 'p_police_station','id'=>'p_police_station')); ?>
								<?php echo form_error('p_police_station', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('District'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['p_dist'], 'placeholder'=>'District', 'name' => 'p_dist','id'=>'p_dist')); ?>
								<?php echo form_error('p_dist', '<p class="text-danger">', '</p>'); ?>
                          </div> 
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('State'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['p_state'], 'placeholder'=>'State', 'name' => 'p_state','id'=>'p_state')); ?>
								<?php echo form_error('p_state', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('PIN'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['p_pin'], 'placeholder'=>'PIN', 'name' => 'p_pin','id'=>'p_pin')); ?>
								<?php echo form_error('p_pin', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Mobile'); ?>
                                <?php echo form_input(array('class'=>'form-control required', 'value'=>$editemp['p_mobile'], 'placeholder'=>'Mobile', 'name' => 'p_mobile','id'=>'p_mobile')); ?>
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
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['village'], 'placeholder'=>'Village', 'name' => 'village','id'=>'village')); ?>
								<?php echo form_error('village', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Post'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['post'], 'placeholder'=>'Post', 'name' => 'post','id'=>'post')); ?>
								<?php echo form_error('post', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Police Station'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['police_station'], 'placeholder'=>'Police Station', 'name' => 'police_station','id'=>'police_station')); ?>
								<?php echo form_error('police_station', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('District'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['dist'], 'placeholder'=>'District', 'name' => 'dist','id'=>'dist')); ?>
								<?php echo form_error('dist', '<p class="text-danger">', '</p>'); ?>
                          </div> 
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
								<?php echo form_label('State'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['t_state'], 'placeholder'=>'State', 'name' => 't_state','id'=>'t_state')); ?>
								<?php echo form_error('t_state', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('PIN'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['pin'], 'placeholder'=>'PIN', 'name' => 'pin','id'=>'pin')); ?>
								<?php echo form_error('pin', '<p class="text-danger">', '</p>'); ?>
                          </div>
                          <div class="form-group">
								<?php echo form_label('Mobile'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['t_mobile'], 'placeholder'=>'Mobile', 'name' => 't_mobile','id'=>'t_mobile')); ?>
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
                          <?php $r=1; for($i=0; $i< 5; $i++){
							  ?>
                          <tr>
                          <td><?php echo $r;?><input type="hidden" name="class_id<?php echo $i;?>" value="<?php echo $editquali[$i]['id'];?>"/></td>
                          <td><input type="text" class="form-control" name="class_stad<?php echo $i;?>" value="<?php echo $editquali[$i]['class_stad'];?>"/></td>
                          <td><input type="text" class="form-control" name="subject<?php echo $i;?>" value="<?php echo $editquali[$i]['subject'];?>"/></td>
                          <td><input type="text" class="form-control" name="collage_name<?php echo $i;?>" value="<?php echo $editquali[$i]['collage_name'];?>"/></td>
                          <td><input type="text" class="form-control" name="passing_year<?php echo $i;?>" value="<?php echo $editquali[$i]['passing_year'];?>"/></td>
                          <td><input type="text" class="form-control" name="division<?php echo $i;?>" value="<?php echo $editquali[$i]['division'];?>"/></td>
                          </tr>
                          <?php $r++;}?>
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
                          <?php $r=1; for($i=0; $i< 3; $i++){?>
                          <tr>
                          <td><?php echo $r;?><input type="hidden" name="licence_id<?php echo $i;?>" value="<?php echo $editlice[$i]['id'];?>"/></td>
                          
                          <td><input type="text" class="form-control" name="licence_type<?php echo $i;?>" value="<?php echo $editlice[$i]['licence_type'];?>"/></td>
                          <td><input type="text" class="form-control" name="issued_by<?php echo $i;?>" value="<?php echo $editlice[$i]['issued_by'];?>"/></td>
                          <td><input type="text" class="form-control" name="regi_no<?php echo $i;?>" value="<?php echo $editlice[$i]['regi_no'];?>"/></td>
                          <td><input type="text" class="form-control" name="issue_date<?php echo $i;?>" id="ddate<?php echo $i;?>" value="<?php  if($editlice[$i]['id']!=''){echo date_format(date_create($editlice[$i]['issue_date']), 'd/m/Y');}?>"/></td>
                          <td><input type="text" class="form-control" name="valid_upto<?php echo $i;?>" id="date<?php echo $i;?>" value="<?php  if($editlice[$i]['id']!=''){echo date_format(date_create($editlice[$i]['valid_upto']), 'd/m/Y');}?>"/></td>
                         
                          </tr>
                          <?php $r++; }?>
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
                          <?php $r=1; for($i=0; $i<2; $i++){?>
                          <tr>
                          <td><?php echo $r;?><input type="hidden" name="ref_person_id<?php echo $i;?>" value="<?php echo $editrefe[$i]['id'];?>"/></td>
                          <td><input type="text" class="form-control" name="ref_person_name<?php echo $i;?>" value="<?php echo $editrefe[$i]['ref_person_name'];?>"/></td>
                          <td><input type="text" class="form-control" name="ref_person_add<?php echo $i;?>" value="<?php echo $editrefe[$i]['ref_person_add'];?>"/></td>
                          <td><input type="text" class="form-control" name="ref_person_mbile<?php echo $i;?>" value="<?php echo $editrefe[$i]['ref_person_mbile'];?>"/></td>
                          <td><input type="text" class="form-control" name="ref_person_known<?php echo $i;?>" value="<?php echo $editrefe[$i]['ref_person_known'];?>"/></td>
                          
                          </tr>
                          <?php $r++; }?>
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
                                
								<input type="text" class="form-control" value="<?php echo date_format(date_create($editemp['doj']), 'd/m/Y') ?>" placeholder="dd/mm/yyyy" name="doj" id="date"  <?php if($editemp['doj'] !=''){ ?> readonly <?php } ?> />
                                <?php echo form_error('doj', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Job Type'); ?>
                                
                                <select name="job_type" class="form-control">
                                <option value="Probation" <?php echo $editemp['job_type']=='Probation'?'selected':'';?>>Probation</option>
                                <option value="Permanent" <?php echo $editemp['job_type']=='Permanent'?'selected':'';?>>Permanent</option>
                                <option value="Contract" <?php echo $editemp['job_type']=='Contract'?'selected':'';?>>Contract</option>
                                </select>
								<?php echo form_error('job_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Grade'); ?>
                                <select name="grade" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($gradeList as $grade):?>
                                <option value="<?php echo $grade['id'];?>" <?php echo $editemp['grade']==$grade['id']?'selected':'';?>><?php echo $grade['grade_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('grade', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Department'); ?>
                                <select name="department" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($departmentList as $department):?>
                                <option value="<?php echo $department['id'];?>" <?php echo $editemp['department']==$department['id']?'selected':'';?>><?php echo $department['department_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('department', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Date of Leaving'); ?>
                                <?php if($editemp['date_of_leave']!=''){$date=date_format(date_create($editemp['date_of_leave']), 'd/m/Y');}else{$date='';}?>
								<input type="text" class="form-control" value="<?php echo $date; ?>" placeholder="dd/mm/yyyy" name="date_of_leave" id="date1"  <?php if($editemp['date_of_leave'] !=''){ ?> readonly <?php } ?> />
                                <?php echo form_error('date_of_leave', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                          </div>
                          <div class="col-md-4">
                          
                          <div class="form-group">
								<?php echo form_label('ESIC Id'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['esic_id'], 'placeholder'=>'ESIC Id', 'name' => 'esic_id')); ?>
								<?php echo form_error('esic_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('UAN No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['pf_id'], 'placeholder'=>'PF Id', 'name' => 'pf_id')); ?>
								<?php echo form_error('pf_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Bank Account No.'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['account_no'], 'placeholder'=>'Account No', 'name' => 'account_no')); ?>
								<?php echo form_error('account_no', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Post/Designation'); ?>
                                <select name="designation" class="form-control required">
                                <option value="">Select</option>
                                <?php foreach($designationList as $designation):?>
                                <option value="<?php echo $designation['id'];?>" <?php echo $editemp['designation']==$designation['id']?'selected':'';?>><?php echo $designation['designation_name'];?></option>
                                <?php endforeach;?>
                                </select>
								<?php echo form_error('designation', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                            
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                             <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['bank_name'], 'placeholder'=>'Bank Name', 'name' => 'bank_name')); ?>

								<?php echo form_error('bank_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Bank Branch Name'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['bank_branch_name'], 'placeholder'=>'Bank Branch Name', 'name' => 'bank_branch_name')); ?>
								<?php echo form_error('bank_branch_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('IFSC Code'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['ifsc_code'], 'placeholder'=>'IFSC Code', 'name' => 'ifsc_code')); ?>
								<?php echo form_error('ifsc_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Branch Code'); ?>
    							<?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['branch_code'], 'placeholder'=>'Branch Code', 'name' => 'branch_code')); ?>
								<?php echo form_error('branch_code', '<p class="text-danger">', '</p>'); ?>
                            </div>
                          <div class="form-group">
								<?php echo form_label('Salary Type'); ?>
                                <select name="salary_type" class="form-control">
                                <option value="AsPerClient" <?php echo $editemp['salary_type']=='AsPerClient'?'selected':'';?>>As Per Client</option>
                                <option value="AsPerEmployee" <?php echo $editemp['salary_type']=='AsPerEmployee'?'selected':'';?>>As Per Employee</option>
                                </select>
								<?php echo form_error('salary_type', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Experience (In Year)'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editemp['experience'], 'placeholder'=>'Experience (In Year)', 'name' => 'experience')); ?>
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