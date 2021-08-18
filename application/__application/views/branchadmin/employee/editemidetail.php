<div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-2">
          <h3 class="content-header-title mb-0">Edit Loan/Advance</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Edit Loan/Advance</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
       <script>
             
				function codeAddress() {
				  var loan = document.getElementById('loantype').value;
				  var element = document.getElementById("editemi");
					if(loan == 'Loan')
					{
					   element.style.display = 'block';
					}
					else
					{
					 
					 element.style.display = 'none';
					}
				}
				window.onload = codeAddress;
        </script>
       
      </div>
      <div class="content-body">
        <!-- Basic tabs start -->
        <section id="basic-tabs-components">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Edit EMI Detail</h4>
          
                
                </div>
                <div class="card-body">
                  <div class="card-block">
                   <div class="row">
                   <?php echo $this->session->flashdata('msg');?>
                   <input type="hidden" name="hidetxt1" value="<?php echo $row['row_id']?>"/>
                  <table class="table table-striped table-bordered compact">
                      <thead>
                      
                      
                      <th>EMI Amount</th>
                      <th>No Of EMI</th>
                      <th>EMI Start Month</th>
                      
                      
                     
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                 
                                    <?php foreach($emidetail as $loan) { ?>
                                    <tr>
                                
                                        <td><?php echo $loan['emi_amount']; ?></td>
                                        
                                        <td><?php echo $loan['no_of_emi']; ?></td>
                                        <td><?php echo $loan['emi_start_month']; ?></td>
                                        
                                        <td>
                                            <a href="<?php echo site_url('branchadmin/Employee/editEmiDetail/'.$loan['id'])?>" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                             &nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('branchadmin/Employee/deleteEmiDetail/'.$loan['id'])?>" title="Edit"><i class="fa fa-trash"></i> Delete</a>
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
        </section>
        </div>
       </div>
 </div>
 
