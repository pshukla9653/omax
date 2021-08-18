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
.footer{
	display:none;
}
}
  </style>
     <page size="A4">
      <div style="width:21cm !important;">
     <br><br><br><br><br><br><br><br>
             <h4 style="float:right;margin-right:150px;">Date : <?php echo date("Y-m-d");?></h4><br><br><br>
             <h4 style="margin-left:20px;">Mr,&nbsp;<?php echo $details2[0]['applicant_name']?></h4>
             <h4 style="margin-left:20px;">S/o Shri&nbsp;<?php echo $details2[0]['father_name']?></h4>
             <h4 style="margin-left:20px;">Address &nbsp;<?php echo $details2[0]['address']?></h4>
             
             <h4 style="margin-left:20px;">Mobile No-+91 &nbsp;<?php echo $details2[0]['mobile']?></h4>
             
             <br>
             <p style="margin-left:20px;">
                <strong>Dear Mr.&nbsp;<?php echo $details2[0]['applicant_name']?>,</strong>
             </p>
             <p style="margin-left:20px;font-size:17px;">
             <?php 
			     $refnum = $this->CommanModel->getDataIfdataexists('reference_number','tbl_offerletter',array('applicant_id'=>$appid))
			 ?>
             We are pleased to inform you that your services with the company have been confirmed with effect from <strong><?php echo $refnum['reference_number']?></strong>.
             </p>
             <p style="margin-left:20px;font-size:17px;">
             All other terms and conditions of your employment remain unchanged.
             </p>
            <p style="margin-left:20px;font-size:17px;">
             Please sign and return the duplicate copy of this letter for our records.
             </p>
             <p style="margin-left:20px;font-size:17px;">
            With best wishes,
             </p>
             <p style="margin-left:20px;font-size:19px;">
             <strong style="float:left;">For Omax Security Services Private Limited</strong>
            <br>
             </p>
             
             <p style="margin-left:20px;font-size:19px;">
              <strong>Authorized Signatory</strong>
             </p>
          
          
      </div>
 </page>
  

