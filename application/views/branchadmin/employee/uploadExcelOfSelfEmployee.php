


<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Export/Import Attendance of self Employee</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Export/Import Attendance of self Employee</a>
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
                  <h4 class="card-title">Export/Import Attendance of self Employee</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <div class="col-md-12">
                    <a href="<?php echo base_url('branchadmin/UploadExcels/attendanceExportExcelForSelfEmp')?>" class="btn btn-success btn-sm">Download Excel</a></p>
                             <?php echo $this->session->flashdata('msg'); ?>
                             <?php $data=array('class'=>'form-inline'); echo form_open_multipart('branchadmin/UploadExcels/uploadExcelOfSelfEmployee', $data);?>
                       </div> 
                            <div class="col-md-3">
                           
                            <div class="form-group">
								<?php echo form_label('Year'); ?>
                                <select name="year" class="form-control">
                                <option value="">Select</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                </select>
								<?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Month'); ?>
                                <select name="Month" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('Month', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                            <div class="col-md-3">
                            
                            
                             <div class="form-group">
                             
                            <div class="input-file"><?php echo form_upload(array('name'=>'excel'));?></div>
                               
                               <br><br>
                              <?php echo form_submit(array('name'=>'Submit','class'=>'btn btn-success btn-sm','value'=>'Upload Excel','style'=>'padding:13px;font-size:16px;'));?>
                            <?php echo form_close();?>
                             </div>   
                           </div>
                             
                  
                  </div>
                      
                             
                           
                       <div class="col-md-3">
                           
                       </div>
                        
                        <div class="col-md-3">
                           
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