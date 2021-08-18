<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Grade</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Update Grade</a>
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
                  <h4 class="card-title">Update Grade</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('branchadmin/Setting/editGrade/'.$editgrade[0]['id'], array('name'=>'addGrade'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Grade Name'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editgrade[0]['grade_name'], 'placeholder'=>'Grade Name', 'name' => 'grade_name')); ?>
								<input type="hidden" name="grade_name_hidden" value="<?php echo $editgrade[0]['grade_name'];?>"/>
								<?php echo form_error('grade_name', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                             <div class="col-md-6">
                            <div class="form-group">
								<?php echo form_label('Nature of Work'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editgrade[0]['nature_of_work'], 'placeholder'=>'As', 'name' => 'nature_of_work')); ?>
								<?php echo form_error('nature_of_work', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                       <?php echo form_label('Description'); ?>
                                       <?php echo form_textarea(array('class'=>'form-control', 'value'=>$editgrade[0]['description'],  'placeholder'=>'Description', 'name' => 'description')); ?>
                                       <?php echo form_error('description', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </div>
                     <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Status'); ?>
                                <select class="form-control" name="status">
                                <option value="1" <?php echo $editgrade[0]['status']==1?'selected':'';?>>Active</option>
                                <option value="0" <?php echo $editgrade[0]['status']==0?'selected':'';?>>Inactive</option>
                                </select>
                                
                            </div>
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
                  <h4 class="card-title">Grade</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Grade List</h4>
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
                      <th>Grade Name</th>
                      <th>Nature of Work</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($gradeList as $grade) { ?>
                                    <tr>
                                        <td><?php echo $grade['grade_name']; ?></td>
                                        <td><?php echo $grade['nature_of_work']; ?></td>
                                        <td><?php echo $grade['description']; ?></td>
                                        <td><?php echo ($grade['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editGrade/'.$grade['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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