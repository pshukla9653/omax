 <style>
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
  font-size:12px !important;
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
@media print {
  body, page {
    margin: 0 !important;
    box-shadow: 0 !important;
  }
  page[size="A4"] {
  width: 21cm;
  height: auto;  
}
.table-bordered,.table-bordered td,.table-bordered th{border:1px solid #1F1F1F}
/*.footer{
	display:none;
}*/
}
  </style>
 
 <page size="A4">
 <table style="width:21cm !important;" border="1" class="table-bordered">
                    <tr><td>
                    <table style="width:100%;" class="table-bordered">
                       <?php echo $this->session->flashdata('msg'); ?>
                    <tr>
                    <td style="width:20%;"><img src="<?=base_url('assest/app-assets/images/logo/logo.png');?>" width="80%" alt="" title=""/></td>
                    <td style="text-align:center; width:80%;">
                    <h1><?php echo $company['company_name'];?></h1>
                    <?php echo $Branchdata['address'];?><br>
                    <?php echo $Branchdata['city'].'-'.$Branchdata['pincode'].', ('.$Branchdata['state'].')';?><br>
                    </td>
                    </tr>
                    </table>
                    </td></tr>
                    
                    <tr>
                    <td>
                    <center><span style="color:BLACK; font-size:12px!important;">GSTIN : <?php echo $Branchdata['gstnumber'];?></span></center>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <center><span style="color:BLACK; font-size:12px!important;">TAX INVOICE</span></center>
                    </td>
                    </tr>
                    
                    
                    <tr>
                    <td>
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr>
                    <td style="width:45%;">
                    <center><span>MONTH OF BILL</span></center>
                    </td>
                    <td style="width:55%;">
                    <center><span style="font-weight:bold;"><?php echo $this->month[$Invoicedata['month_v']];?>-<?php echo $Invoicedata['year_v'];?></span></center>
                    </td>
                    </tr>
                    <tr>
                    <td style="width:45%;">
                    <center><span>INVOICE No.</span></center>
                    </td>
                    <td style="width:55%;">
                    <center><span style="font-weight:bold;"><?php echo $Invoicedata['invoice_no'];?></span></center>
                    </td>
                    </tr>
                    <tr>
                    <td style="width:45%;">
                    <center><span>INVOICE DATE.</span></center>
                    </td>
                    <td style="width:55%;">
                    <center><span style="font-weight:bold;"><?php echo date("d.m.Y");?></span></center>
                    </td>
                    </tr>
                    <tr>
                    <td style="width:45%;">
                    <center><span>STATE NAME</span></center>
                    </td>
                    <td style="width:55%;">
                    <center><span style="font-weight:bold;"><?php echo $Branchdata['state'];?></span></center>
                    </td>
                    </tr>
                    <tr>
                    <td style="width:45%;">
                    <center><span style="font-weight:bold;">DETAILS OF RECEIVER/BILL TO</span></center>
                    </td>
                    <td style="width:55%;">
                    <center><span style="font-weight:bold;">DETAILS OF SENDER</span></center>
                    </td>
                    </tr>
                    <tr>
                    <td style="width:45%;">
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr><td>NAME</td> <td> <?php echo $ClientDetail['client_name'];?></td></tr>
                    <tr><td>ADDRESS</td> <td><?php echo $ClientDetail['address'];?></td></tr>
                    <tr><td>GSTIN</td> <td><?php echo $ClientDetail['tax_deduction_ac_no'];?></td></tr>
                    </table>
                    </td>
                    <td style="width:55%;">
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr><td>NAME</td> <td><?php echo $company['company_name'];?></td></tr>
                    <tr><td>ADDRESS</td> <td><?php echo $Branchdata['address'];?></td></tr>
                    <tr><td>GSTIN</td> <td><?php echo $Branchdata['gstnumber'];?></td></tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    
                   <tr>
                    <td>
                    <table style="font-size:12px!important; width:100% !important; text-align:center !important;">
                    <tr>
                    <th rowspan="2">S.No.</th>
                    <th rowspan="2">NAME OF<br> PRODUCT/<br>SERVICES</th>
                    <th rowspan="2">HSN/SAC</th> 
                    <th rowspan="2">UOM</th>
                    
                    <th rowspan="2">QTY</th>
                   <th rowspan="2">RATE</th>
                    <th rowspan="2">AMT</th>
                    
                    <th rowspan="2">S.C. <br>@<br> <?php $epf = explode('@', $paymentdetail[1][14]); echo $epf[1].'%';?> ON <br>BASIC<br> WAGES</th>
                    <th rowspan="2">TAXEBLE<br>VALU</th>
                    <th colspan="2">CGST</th>
                    <th colspan="2">SGST</th>
                    <th colspan="2">IGST</th>
                    
                    <th rowspan="2">TOTAL <br>AMOUNT</th>
                    </tr>
                    <tr>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    <th>RATE</th>
                    <th>AMOUNT</th>
                    </tr>
                    <?php for($r=1; $r < count($paymentdetail); $r++){
						$payment = $paymentdetail[$r];
						
						?>
                    <tr>
                    <td><?php echo $r;?></td>
                    <td style="text-align:left !important;"><?php $designation= $this->CommanModel->getDataIfdataexists('designation_name, description', 'tbl_designation', array('id'=>$payment[1]));
					echo $designation['designation_name'];?></td>
                    <td><?php echo $HSN;?></td>
                    <td><?php echo $payment[5] + $payment[8];?></td>
                    <td><?php echo $payment[3];?></td>
                     <td><?php echo $payment[2];?></td>
                     <td><?php echo $payment[11];?></td>
                     
                     <td><?php $sc = explode('@', $payment[14]); echo $sc[0];?></td>
                     <td><?php echo $payment[15];?></td>
                      <td><?php $cgst = explode('@', $payment[16]); echo $cgst[1];?>%</td>
                      <td><?php $cgst = explode('@', $payment[16]); echo $cgst[0];?></td>
                      <td><?php $sgst = explode('@', $payment[17]); echo $sgst[1];?>%</td>
                      <td><?php $sgst = explode('@', $payment[17]); echo $sgst[0];?></td>
                      <td><?php $igst = explode('@', $payment[18]); echo $igst[1];?>%</td>
                      <td><?php $igst = explode('@', $payment[18]); echo $igst[0];?></td>
                     
                     <td><?php echo $payment[20];?></td>
                    </tr>
                    <?php  }?>
                  <tr>
                  <th colspan="8" style="text-align:center !important;">TOTAL</th>
                  
                  <th style="text-align:center !important;"><?php echo $totalpayment[1][4];?></th>
                  <th style="text-align:center !important;"><?php $cgst = explode('@', $paymentdetail[1][16]); echo $cgst[1];?>%</th>
                  <th style="text-align:center !important;"><?php echo $totalpayment[1][5];?></th>
                   <th style="text-align:center !important;"><?php $cgst = explode('@', $paymentdetail[1][17]); echo $cgst[1];?>%</th>
                  <th style="text-align:center !important;"><?php echo $totalpayment[1][6];?></th>
                   <th style="text-align:center !important;"><?php $cgst = explode('@', $paymentdetail[1][18]); echo $cgst[1];?>%</th>
                  <th style="text-align:center !important;"><?php echo $totalpayment[1][7];?></th>
                  <th style="text-align:center !important;"><?php echo $totalpayment[1][9];?></th>
                  
                  
                  </tr>
                    </table>
                    </td>
                    </tr>
                    
                   <tr>
                    <td>
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    
                    <tr>
                    <td style="width:45%;">
                    <strong>TOTAL INVOICE AMOUNT IN WORDS: </strong>
                    <?php echo $this->mycalendar->getIndianCurrency($totalpayment[1][9]);?>
                        
                    </td>
                    <td style="width:55%;">
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr><td>TOTAL AMOUNT BEFORE GST</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][0];?></td></tr>
                    <tr><td>ADD: CGST</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][5];?></td></tr>
                    <tr><td>ADD: SGST</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][6];?></td></tr>
                    <tr><td>ADD: IGST</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][7];?></td></tr>
                    <tr><td>TOTAL AMOUNT: GST</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][8];?></td></tr>
                    
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr> 
                    <tr>
                    <td>
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    
                    <tr>
                    <td style="width:45%;">
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr><td colspan="2" style="text-align:center;">BANK DETAIL</td></tr>
                    <tr><td>BANK NAME</td><td><?php echo $BankBranch['bank_name'];?></td></tr>
                    <tr><td>BANK ACCOUNT NUMBER</td><td><?php echo $BankBranch['account_no'];?></td></tr>
                    <tr><td>BANK BRANCH IFSC</td><td><?php echo $BankBranch['ifsc_code'];?></td></tr>
                    <tr><td colspan="2" style="font-size:10px; text-align:center; vertical-align:top; width:50px">TERMS AND CONDITIONS:
                    
                    </td></tr>
                    <tr><td colspan="2" style="font-size:10px; text-align:left; vertical-align:top; height:180px; width:50px">
                    NOTE:<br>
                   1. Bill are strictly payable within 7 days from date of submission of bill.<br>
                    2. An Interst @10% p.a. will be payble by you payment is not made on due date &amp; after 1 month interest @20% p a will be payble by you.<br>
                    3.Payment of bills to be made by NEFT/RTGS/Cheque.<br>
                    4.GST will be applicable on gross bill amount extra @ 18% as Govt Rule.<br>
                    </td></tr>
                    </table>
                    </td>
                    <td style="width:55%;">
                    <table style="width:100%; font-size:12px!important;" class="table-bordered">
                    <tr><td>TOTAL AMOUNT AFTER TAX</td> <td style="text-align:center !important;"><?php echo $totalpayment[1][9];?></td></tr>
                    <tr><td style="height:80px; width:50px">GST PAYABLE ON REVENUE CHARGE</td> <td style="text-align:center !important;"></td></tr>
                    
                    <tr><td colspan="2" style="font-size:10px; text-align:center; vertical-align:top; height:130px; width:50px">CERTIFIED THAT THE PARTICULARS GIVAN ABOVE ARE TRUE AND CORRECT</td></tr>
                    <tr><td colspan="2" style="font-size:10px; text-align:right; vertical-align:bottom; height:30px; width:50px">AUTHORIZED SIGNATORY</td></tr>
                    
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
  </page>
  
 
 
 