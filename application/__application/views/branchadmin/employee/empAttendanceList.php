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
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Employee Attendance list	</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <?php echo form_open_multipart('Reports/empAttendanceList', array('name'=>'addDepartment'));?>
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                       <div class="form-group">
                                        
                                        <?php echo form_label('Client'); ?>
                                                        <select name="client" class="form-control select2" autofocus >
                                                        <option value="">Select</option>
                                                        <option value="-1">All</option>
                                                            <?php 
                                                            $getClient = $this->CommanModel->getList('id,client_name','tbl_client','id','ASC');
                                                            for($i=0;$i<count($getClient);$i++)
                                                            {
                                                                ?>  <option value="<?php echo $getClient[$i]['id']; ?>"><?php echo $getClient[$i]['client_name']?></option>   <?php
                                                            }
                                                            
                                                            ?>      
                                                        
                                                        </select>
                                        <?php echo form_error('client', '<p class="text-danger">', '</p>'); ?>
                                                    </div>



                                          <div class="form-group">
                                        
                                        <?php echo form_label('Year'); ?>
                                                        <select name="year" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="-1">All</option>
                                                        <?php foreach($this->year as $y=>$v){?>
                                <option value="<?php echo $y;?>"><?php echo $v;?></option>
                                <?php }?>
                                                        </select>
                                        <?php echo form_error('year', '<p class="text-danger">', '</p>'); ?>
                                                    </div>
                            
                            </div>
                            <div class="col-md-6">
                            
                            <div class="form-group">
							           	<?php echo form_label('Month'); ?>
                                <select name="Month" class="form-control">
                                <option value="">Select</option>
                                <option value="-1">All</option>
                                <?php foreach($this->month as $m_id=>$m_name){?>
                                 <option value="<?php echo $m_id;?>"><?php echo $m_name;?></option>
                                <?php }?>
                                </select>
							         	<?php echo form_error('Month', '<p class="text-danger">', '</p>'); ?>
                                
                            </div>
                    <div class="col-md-6">
                           
                            </div>
                    
                     <div class="col-md-6">
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
                  </div>
                  </div>
                  
                  
                  </div>
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
                  <h4 class="card-title">Employee Attendance List</h4>
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
                            <th>S.No.</th>
                            
                            <th>Employee Code</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            
                            <?php 
                                 for($j=1;$j<=$numberOfDays;$j++)
                                 {
                                    ?>     <th><?php echo 'day_' . $j;?> </th>  <?php
                                 }
                            ?>
                            <th>Present</th>
                            <th>W/O</th>
                           
                            <th>OT</th>
                            <th>Total Days</th>
                            <th>Action</th>
                            </tr>
                        
                      </thead>
                      <tbody>
                       
						  <?php  
						  $i = 0;
						  //var_dump($attendanceList); exit;
						  foreach ($attendanceList as $item): ?>
                                 <tr>
                                      <td><?=++$i?></td> 
                                     
                                          <?php 
                                             
                                             $getEmpFather =   $this->CommanModel->getDataIfdataexists('emp_name,emp_code','tbl_employee',array('id'=>$item['emp_id']));
                                                 ?>   <td><?php echo $getEmpFather['emp_code']; ?></td>  <?php
                                                 ?>   <td><?php echo $getEmpFather['emp_name']; ?></td>  <?php
                                           ?>
                                     
                                     <td><?php
                                                  $desigId = $this->CommanModel->getDataIfdataexists('designation','tbl_employee_official',array('emp_id'=>$item['emp_id']));
                                                  $desigName = $this->CommanModel->getDataIfdataexists('designation_name','tbl_designation
                                                  ',array('id'=>$desigId['designation']));
                                                  echo  $desigName['designation_name'];
                                           ?>
                                      </td>
                                      
                                      
                                      <?php 
                                          $dayDetail ='';
                                        $dayDetail = explode(',', $item['days']);
                                      $FINALATT='';
                                        for($r=0 ;$r<$numberOfDays;$r++)
                                        {		$getCutOne = '';
                                               $getCutOne =   explode('-',$dayDetail[$r]);
											   if($getCutOne[1] !=null){
                                               $FINALATT[$getCutOne[0]] = $getCutOne[1];
											   }
                                              
                                        }
                                      
                                      
                                      ?>
										<?php 
                                 for($j=1;$j<=$numberOfDays;$j++)
                                 {
                                    ?>     <td><?php if($FINALATT[$j]!=null){echo $FINALATT[$j];}else{echo '-';}?> </td>  <?php
                                 }
                            ?>
                                      <?php
                                          $p = '';
                                          $a = '';
                                          $w = '';
                                          $ot = '';
                                          $dayTotal = '';
                                           $dayTotal = explode(',', $item['APW']);
                                          
                                           $p = explode('-', $dayTotal[0]);
                                           $a = explode('-', $dayTotal[1]);
                                           $w = explode('-', $dayTotal[2]);
                                           $ot = explode('-', $dayTotal[3]);
                                      
                                      ?>
                                       <td><?php echo $p[1];?></td>
                                       <td><?php echo $w[1];?></td>
                                       <td><?php echo $ot[1];?></td>
                                       <td><?php echo $p[1]+$w[1]+$ot[1];?></td>
                                       <td><a href="<?php echo base_url('branchadmin/Setting/deleteAttadance/'.$item['id']);?>" target="_blank" class="text-danger" onclick="return confirm('Are you sure? You want to delete!')">Delete</a></td>
                                      
                                      



                                </tr>
                          <?php endforeach; ?>
                       
                      </tbody>
                     
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
    </section></div></div></div>
 
  
 
 
 