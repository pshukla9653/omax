 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Employee</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">List</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        
      </div>
      <div class="content-body">
       
        <!-- Column selectors table -->
        <section id="column-selectors">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Employee List</h4>
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
                    <div class="horizontal-scroll scroll-example">
                      <div class="horz-scroll-content">
                        <div class="row">
                        <?php echo $this->session->flashdata('msg'); ?>
                    <table class="table table-striped table-bordered dataex-html5-selectors">
                      <thead>
                        <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Joining date</th>
                        <th>Father Name</th>  
                          <th>Mobile</th>
                          <th>PAN</th>
                          <th>Adhar Card No</th>
                          <th>Village</th>
                          <th>Post</th>
                          <th>District</th>
                          <th>State</th>
                          <th>Pin Code</th>
                          <th>Experience</th>
                          <th>Esic Id</th>
                          <th>PF Id</th>
                          <th>Account No</th>
                          <th>Bank Name</th>
                          <th>IFSC Code</th>
                          <th>Branch Code</th>
                          <th>Bank Branch Name</th>
                          
                          <th>salary_type</th>
                          <th>Grade</th>
                          <th>Department</th>
                          <th>Designation</th>
                          
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      
                        <?php foreach($empList as $emp){?>
                        <tr>
                          <td><?php echo $emp['emp_code'];?></td>
                          <td><?php echo $emp['emp_name'];?></td>
                          <td><?php echo date_format(date_create($emp['doj']),"d/m/Y");?></td>
                          <td><?php echo $emp['father_name'];?></td>
                          <td><?php echo $emp['mobile'];?></td>
                          <td><?php echo $emp['pan'];?></td>
                          <td><?php echo $emp['adhar_card_no'];?></td>
                          <td><?php echo $emp['p_village'];?></td>
                          <td><?php echo $emp['p_post'];?></td>
                          <td><?php echo $emp['p_dist'];?></td>
                          <td><?php echo $emp['p_state'];?></td>
                          <td><?php echo $emp['p_pin'];?></td>
                          <td><?php echo $emp['experience'];?></td>
                          <td><?php echo $emp['esic_id'];?></td>
                          <td><?php echo $emp['pf_id'];?></td>
                          <td><?php echo $emp['account_no'];?></td>
                          <td><?php echo $emp['bank_name'];?></td>
                          <td><?php echo $emp['ifsc_code'];?></td>
                          <td><?php echo $emp['branch_code'];?></td>
                          <td><?php echo $emp['bank_branch_name'];?></td>
                          <td><?php echo $emp['salary_type'];?></td>
                          <?php
						   $gradename = $this->CommanModel->getDataIfdataexists('grade_name','tbl_grade',array('id'=>$emp['grade']));
						   
						  ?>
                          <td><?php echo $gradename['grade_name'];?></td>
                           <?php
						   $departname = $this->CommanModel->getDataIfdataexists('department_name','tbl_department',array('id'=>$emp['department']));
						  ?>
                          <td><?php echo $departname['department_name'];?></td>
                           <?php
						   $designationname = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation',array('id'=>$emp['designation']));
						   
						  ?>
                          <td><?php echo $designationname['designation_name'];?></td>
                          <td><a href="<?php echo base_url('branchadmin/Employee/editEmp/'.$emp['emp_id']);?>">Edit</a></td>
                          
                          
                          
                        </tr>
                       <?php }?>
                       
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Joining date</th>
                        <th>Father Name</th>  
                          <th>Mobile</th>
                          <th>PAN</th>
                          <th>Adhar Card No</th>
                          <th>Village</th>
                          <th>Post</th>
                          <th>District</th>
                          <th>State</th>
                          <th>Pin Code</th>
                          <th>Experience</th>
                          <th>Esic Id</th>
                          <th>PF Id</th>
                          <th>Account No</th>
                          <th>Bank Name</th>
                          <th>IFSC Code</th>
                          <th>Branch Code</th>
                          <th>Bank Branch Name</th>
                          
                          <th>salary_type</th>
                          <th>Grade</th>
                          <th>Department</th>
                          <th>Designation</th>
                          
                          <th>Action</th>
                        </tr>
                     
                      </tfoot>
                    </table>
                    </div></div></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Column selectors table -->
      </div>
        <!-- Basic Inputs end -->
  
      </div>
    </div>
 
  
 
 
 