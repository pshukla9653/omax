 <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Employee</h3>
          <!--linc angular-->
          <script src="<?=base_url('assest/frontend/js/angular.min.js" type="text/javascript');?>"></script>
          <!--linc angular-->
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
        <section id="column-selectors" ng-app="">
          <div class="row">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
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
                    <table width="100%" border="1">
                    <tr><td>
                    <table>
                    <?php $company = $this->CommanModel->CompanyDetail('company_name,address,country,state,city,pincode,logo_path');
					
					 ?>
                    <tr>
                    <td style="width:20%;"><img src="<?=base_url('assest/app-assets/images/logo/logo.png');?>" width="60%" alt="" title=""/></td>
                    <td style="text-align:center; width:80%;">
                    <h1><?php echo $company['company_name'];?></h1>
                    <?php echo $company['address'];?><br>
                    <?php echo $company['city'].'-'.$company['pincode'].', ('.$company['state'].')';?><br>
                    Pay Slip for the month of <?php echo $this->month[$month];?>-<?php echo $year;?> 
                    </td>
                    </tr>
                    </table>
                    </td></tr>
                    <tr><td>
                    <table width="100%">
                    <tr>
                    <td>
                    <table width="100%">
                    <tr>
                    <td><strong>Employee Code :</strong></td>
                    <td><?php echo $salarydata['emp_code'];?></td>
                    </tr>
                     <tr>
                    <td><strong>Employee Name :</strong></td>
                    <td><?php  echo $salarydata['name']; ?></td>
                    </tr>
                    <tr>
                    <td><strong>Designation :</strong></td>
                    <td><?php echo $salarydata['designation'];?></td>
                    </tr>
                    <tr>
                    <td><strong>Department :</strong></td>
                    <td><?php echo $salarydata['department'];?></td>
                    </tr>
                    <tr>
                    <td><strong>Grade :</strong></td>
                    <td><?php echo $salarydata['Grade_name'];?></td>
                    </tr>
                    
                    <tr>
                    <td><strong>Payable Days :</strong></td>
                    <td><?php echo $salarydata['PresentDay'];?></td>
                    </tr>
                    <tr>
                    <td><strong>LWP :</strong></td>
                    <td><?php echo $salarydata['WeekOffDay'];?></td>
                    </tr>

                   <tr>
                    <td><strong>OT :</strong></td>
                    <td><?php echo $salarydata['OTDay'];?></td>
                    </tr>
                    
                    </table>
                    
                    </td>
                    <td> 
                    <table width="100%">
                    <tr>
                    <td><strong>Date Of Joining :</strong></td>
                    <td><?php 
echo date_format(date_create($empo['doj']),"d/m/Y");?></td>
                    </tr>
                     <tr>
                    <td><strong>Bank Ac No. :</strong></td>
                    <td><?php echo  $salarydata['account'];?></td>
                    </tr>
                    <tr>
                    <td><strong>PF No. :</strong></td>
                    <td><?php echo $salarydata['pfid'];?></td>
                    </tr>
                    <tr>
                    <td><strong>Esi No. :</strong></td>
                    <td><?php echo $salarydata['esicid'];?></td>
                    </tr>
                    
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td></tr>  
                    <tr><td>
                    <table width="100%" border="1">
                    <tr>
                    <td>
                    <h2>Earnings</h2>
                    
                    </td>
                    <td> 
                    <h2>Deduction</h2>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <table width="100%" border="1">
                    <tr>
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Earn Salary</th>
                    <th>Total</th>
                    </tr>
                     <tr>
                    <td>BASIC</td>
                    <td><input type="number" class="form-control" value="<?php echo $salarydata['BasicSalary'];?>"></td>
                    <td><input type="number" class="form-control" value="<?php $earn[]=$PayableBasicSalary; echo $PayableBasicSalary;?>"></td>
                    <td><input type="number" class="form-control" value="<?php $toearn[]=$PayableBasicSalary; echo $PayableBasicSalary;?>"></td>
                    </tr>
                    <?php foreach($Allowance as $all){?>
                    <tr>
                    <td><?php echo $all['AllowanceName'];?></td>
                    <td><?php $rate[]=$all['Amount']; echo $all['Amount'];?></td>
                    <td><?php $earn[]=$all['Amount']; echo $all['Amount'];?></td>
                    <td><?php $toearn[]=$all['Amount']; echo $all['Amount'];?></td>
                    </tr>
                    <?php }?>
                    <th>GROSS EARNINGS</th>
                    <th><input type="number" class="form-control" value="<?php echo $salarydata['PayableBasicSalary'];?>" ng-model="name"></th>
                    <th><input type="number" class="form-control" value="<?php echo array_sum($earn);?>" ng-model="name"></th>
                    <th><input type="number" class="form-control" value="<?php echo $salarydata['GrossSalary'];?>"></th>
                    </table>
                    
                    </td>
                    <td> 
                    <table width="100%" border="1">
                    <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    </tr>
                     <?php foreach($Deduction as $ded){?>
                    <tr>
                    <td><?php echo $ded['DeductionName'];?></td>
                    
                    <td><?php $Td[]=$ded['AmountEP']; echo $ded['AmountEP'];?></td>
                    </tr>
                    <?php }?>
                    <tr>
                    <th>GROSS DEDUCTIONS</th>
                    <th><input type="number" class="form-control" value="<?php echo $salarydata['TotalDeductionEP'] + $salarydata['TotalDeductionER'];?> " ></th>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td></tr>
                     <tr><td><strong>NET SALARY:<input type="number" class="form-control" value="<?php 
					 $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
						echo ucfirst($f->format($salarydata['NetSalary']));
					?>"></strong></td></tr>
                      
                     
                    <tr><td>
                         <table width="100%" border="1">
                               <tr>
                               <th>LOAN OR EMI</th>
                               <td><input type="number" class="form-control"></td>
                               </tr>
                              <tr>
                               
                               
                              </tr>
                              <tr>
                              <th>ADVANCE</th>
                              <td><input type="number" class="form-control"></td>
                              </tr>
                              
                         </table>
                    
                    </td></tr>
                     <tr><td></td></tr>
                     <tr><td></td></tr> 
                      
                   
                    </table>
                     Personal Note: This is a system generated payslip, does not require any signature.
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
 
  
 
 
 