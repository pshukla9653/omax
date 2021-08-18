<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Export/Import Employee</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Export/Import Employee</a>
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
                  <h4 class="card-title">Export/Import Employee</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                      <div class="col-md-3">
                            <a href="<?php echo base_url('branchadmin/UploadExcels/exportexcel')?>" class="btn btn-success btn-sm">Download Excel</a></p>
                            </div>
                             <?php $data=array('class'=>'form-inline'); echo form_open_multipart('branchadmin/UploadExcels/uploademp', $data);?>
                           
                            <div class="col-md-3"><div class="input-file"><?php echo form_upload(array('name'=>'excel'));?></div></div>
                            <div class="col-md-3"><?php echo form_submit(array('name'=>'Submit','class'=>'btn btn-success btn-sm','value'=>'Upload Excel'));?>
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