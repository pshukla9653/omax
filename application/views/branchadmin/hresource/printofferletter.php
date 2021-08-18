<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Application Form</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Application Form</a>
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
                  <h4 class="card-title">Application Form</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                  {Employee Name}<br>
Address<br>
City, State, Pin<br>

Dear Mr./Ms. Name,<br>

It is my pleasure to extend the following offer of employment to you on behalf of <Company Name>, further to the interview and discussions you have had with us. You are expected to join duty on <Date> <Month> <Year>.
<br>
You are appointed to the position of <Designation> and in this capacity, you will report directly to <Supervisor Name>. As <designation>, your starting monthly remuneration will be Rs 00,000/- (Rupees ……..Thousand Only). You will be on a probation period of six months.
<br>
Your working hours start from <Start Time> to <End Time> with one hour break a day and you are scheduled to work through <Day> to <Day>, which is <Total hours> hours a week.
<br>
After successful completion of the probation and review thereof, you will be entitled to other allowances and benefits whatsoever as per policies of the organization. Regular performance reviews will be done to assess your suitability. You shall receive your payments on or before the <Date> of every month.
<br>
Offer stands canceled in case of any deviations in information or if you fail to report to me on or before pre-decided date. I will have to assume that you have not accepted this job offer if i do not hear from you before <dd/mm/yyyy>
<br>
You will need to submit all your original qualification documents, relieving documents and salary slip (if any) of last three months with a copy of each, on the date of joining.
<br>
I look forward to an enduring relationship with your self.
<br>
Yours sincerely,
<br>
<Name>
<Designation>
<Company Name>
<Date>
                  </div>
                  </div>
                  
                  
                  </div>
                  </div>
                 
                </div>
              </div>
              
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Bank</h4>
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
                    
                    <table class="table table-striped table-bordered compact table-responsive">
                      <thead>
                      <th>Applicant Name</th>
                      <th>Father Name</th>
                      <th>Mobile No.</th>
                      <th>Date Of Apply</th>
                      <th>Department Name</th>
                      <th>Designation Name</th>
                      <th>Application Status</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($applicationList as $application) { ?>
                                    <tr>
                                        <td><?php echo $application['applicant_name']; ?></td>
                                        <td><?php echo $application['father_name']; ?></td>
                                        <td><?php echo $application['mobile']; ?></td>
                                        <td><?php echo $application['date_of_apply']; ?></td>
                                        
                                        <td><?php echo $application['department_name']; ?></td>
                                        <td><?php echo $application['designation_name']; ?></td>
                                        <td><?php echo $application['application_status']; ?></td>
                                       
                                        <td><?php echo ($application['status'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>':'<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Setting/editBank/'.$bank['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
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