<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Muster Roll Attendance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Muster Roll Attendance</a>
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
                  <h4 class="card-title">Muster Roll Attendance</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                 <div class="col-xl-6"><strong>Month: </strong> <?php echo $monthname;?></div>
                  <div class="col-xl-6"><strong>Year: </strong> <?php echo $yearname;?></div>  
                  
                  <div class="col-xl-12 col-lg-12">
                  <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Muster Roll Attendance</h4>
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
                  <?php echo form_open_multipart('branchadmin/employee/MusterRollAttendanceList', array('name'=>'MusterRollAttendanceList'));?>
                  <input type="hidden" name="year_v" value="<?php echo $yearname;?>"/>
                  <input type="hidden" name="month_v" value="<?php echo $month_id;?>"/>
                  <input type="hidden" name="NoOfDays" value="<?php echo $month['NoOfDays'];?>"/>
                   <div class="horizontal-scroll scroll-example">
                      <div class="horz-scroll-content">
                        <div class="row"> 
                        
                    <table class="table table-striped table-bordered compact">
                      <thead>
                      
                      <th>Employee Id</th>
                      <th>Employee Code</th>
                      <th>Employee Name</th>
                      <?php $days =  $month['Days']; 
					  foreach($days as $date=>$daysName){
					  ?>
                      <th><?php echo 'Day '.$date.'<br>('.$daysName.')';?></th>
                      <?php }?>
                      <th>OT Days</th>
                      <th>Lock/Unlock</th>
                      </thead>
                                        <tbody>
                                
                                    <?php foreach($empList as $emp) { ?>
                                    <tr>
                                    
                                    <td style="text-align:center;"><?php echo $emp['id']; ?>
                                    <input type="hidden" name="emp_id[]" value="<?php echo $emp['id']; ?>"/>
                                    </td>
                                    <td style="text-align:center;"><?php echo $emp['emp_code']; ?></td>
                                    <td style="text-align:left;"><?php echo $emp['emp_name']; ?></td>
                                    <?php foreach($days as $date=>$daysName){
										$attandence = $this->CommanModel->getData('tbl_attendance', array('emp_id'=>$emp['id'],'year_v'=>$yearname,'month_v'=>$month_id));
					  ?>
                      <?php /*?><?php if($daysName!='Sun'|| $daysName!='Sunday'){?> selected<?php }?>
                      <td <?php if($daysName=='Sun'|| $daysName=='Sunday'){?> style="background-color:#E3CE0D;"<?php }?>><?php */?>
                      <td>
                      <select name="att[<?php echo $emp['id'];?>][<?php echo $date;?>]" class="form-control" <?php echo $attandence[0]['locked_status']=='1'?'disabled':'';?>>
                      
                      <option value="P" <?php echo $attandence[0]['day'.$date]=='P'?'Selected':'Selected';?>>P</option>
                      <option value="W" <?php echo $attandence[0]['day'.$date]=='W'?'Selected':'';?>>W</option>
                      <option value="A" <?php echo $attandence[0]['day'.$date]=='A'?'Selected':'';?>>A</option>
                      
                      </select>
                      </td>
                      <?php }?>
                      <td style="width:10px;">
                     <input type="text" name="ot_days[<?php echo $emp['id']; ?>]" class="form-control" value="<?php echo $attandence[0]['ot_days']!=''?$attandence[0]['ot_days']:'0.0';?>" />
                      </td>
                      <td style="width:80px;">
                     <input type="radio" name="lock[<?php echo $emp['id']; ?>]" value="1" <?php echo $attandence[0]['locked_status']=='1'?'checked':'';?>/>Lock<br>
                     <input type="radio" name="lock[<?php echo $emp['id']; ?>]" value="0" <?php if($attandence[0]['locked_status']==''){echo 'checked';}else{ echo $attandence[0]['locked_status']=='0'?'checked':'';}?>/>UnLock
                      </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                      
                      
                    </table>
                    
                    
                  </div></div></div>
                  <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
                  <?php echo form_close();?>
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