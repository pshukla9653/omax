<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Applicant List</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Applicant List</a>
                
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
                   <div class="row">
                  
                   <div class="card">
                
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Applicant List</h4>
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
                <?php echo $this->session->flashdata('msg'); ?>
                    <table class="table table-striped table-bordered compact table-responsive">
                      <thead>
                      <th>Applicant Name</th>
                      <th>Date of Apply</th>
                      <th>Mobile</th>
                      <th>Offer Letter</th>
                      <th>Confirmation Letter</th>
                      <th>Appointment Letter</th>
                      
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($allaplicantlist as $application) { ?>
                                    <tr>
                                    <?php 
		$applicantname = $this->CommanModel->getDataIfdataexists('applicant_name','tbl_application',array('id'=>$application['applicant_id']));                      
									?>
                                        <td><?php echo $application['applicant_name']; ?></td>
                                        <td><?php echo $application['date_of_apply']; ?></td>
                                        <td><?php echo $application['mobile']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Hresource/generateofferletter/'.$application['id'])?>" target="_blank" class="btn btn-info">Print</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Hresource/generateconfirmationletter/'.$application['id'])?>" target="_blank" class="btn btn-info">Print</a>
                                        </td>
                                        <td>
                                        <a href="<?php echo site_url('branchadmin/Hresource/generateAppointmentLetter/'.$application['id'])?>" target="_blank" class="btn btn-info">Print</a>
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
              
             
            </div>
            
          </div>
        </section>
        </div>
       </div>
 </div>