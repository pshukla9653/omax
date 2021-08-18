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
  </style><br>
   <page size="A4">
      <div style="width:21cm !important;">
      
         <br>
              <p style="margin-left:20px;">
             <br>
              <strong style=""> Letter No.Omax/HO/HR /<?php echo date("Y");?></strong>
                <strong style="float:right;margin-right:30px;">Date : <?php echo date("Y-m-d");?></strong>
             </p><br>
             <h4 style="margin-left:20px;">To,</h4>
             <p style="margin-left:20px;"><?php echo $details2[0]['applicant_name'];?>&nbsp;S/o <?php echo $details2[0]['father_name'];?></p>
             <p style="margin-left:20px;"><?php echo $details2[0]['address'];?></p>
             <p style="margin-left:20px;"><?php echo $details2[0]['city'];?>,<?php echo $details2[0]['state'];?><br><?php echo $details2[0]['country'];?></p>
             
             <center><strong style="font-size:25px;"><u>Appointment Letter</u></strong></center>
             <br>
             
             <p style="margin-left:20px;font-size:20px;margin-right:20px;">
             This has reference to your application and the subsequent interview you had with us, we are pleased to appoint you with our organization and for the sake of good office order, the  terms and conditions of your appointment is as given below for your information.
             </p>
             <p style="margin-left:20px;font-size:17px;font-weight:bold;">Designation:- <?php echo $details[0]['post_offered'];?></p>
             <p style="margin-left:20px;font-size:17px;font-weight:bold;">Date of  Joining:- <?php echo $details3['appointmentdate'];?></p>
            
             <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                <ul>
                  <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">This appointment is purely probationary for a period of two months from the date of joining and is extendable on negotiation.</li><br>
                  <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">This appointment will expire automatically after completion of probation period.</li></br>
                  <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Your appointment being purely probationary in nature, it can be terminated at any time without any notice and reason there of during the probationary period.</li><br>
                   <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Company will pay the salary&nbsp;<strong><?php echo $details[0]['offered_salary'];?></strong>.inclusive of all charges.</li><br>
                   <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Deduction will be made from your salary as per applicable statutory liabilities/ Rules if any.</li><br>
                   <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Your services are liable to be transferred to any other branch of the company within the country, during the period of your employment (PAN basis).</li><br>
                   <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You are required to give 3 month in advance, Clear notice of your intention to leave the services of the company failing which 3 month salary will be required to be deposited for getting immediate discharge from service. You are required to submit an affidavit on 100 Rupees stamp paper to this effect.</li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">All the records and company information’s which you will possess during your employment in the company shall be maintained properly with absolute secrecy.</li>
                    <br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You must be just and fair and shall not divulge or disclose to any person/ firm particulars of any contract, case or any information pertaining to this company affairs during course of your service and duties. </li>
                    <br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">After joining the company you will not engage yourself in any other services, business activity or any other activity directly or indirectly without taking written permission of competent authority of the company nor you shall accept any presents, commission in cash or kind from any person, firm, organization having business dealing with us without the permission of the company.</li>
                    <br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You will observe the office timing strictly and your services beyond the office hour can also be taken as and when needed.</li>
                    <br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You will have to observe the “dress code” of the company. No fancy dress is allowed while you are on duty except Saturday. </li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Intoxication in any kind is strictly prohibited during office hour and is field area too when you are on duty. </li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">Nevertheless to mention that you have to maintain hierarchy in the system and maintain discipline.</li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">During the joining with us you will be governed by the service conditions under the industrial employment Act & Rules and regulations contained in the standing others of the company as amended from time to time. </li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You will be fully responsible and accountable for any loss, damage of any material equipment etc. given to you in your charge and custody. In case of any loss/damage which is attributed to the negligence on your part, the company shall have full right to recover the cost thereof from your wages without any reference to you or recourse to legal proceedings.</li><br>
                    <li style="text-align:justify;margin-left:20px;font-size:20px;margin-right:60px;">You shall intimate to the company immediately if any changes in your permanent/Local address, Contact no. or nomination takes place. <br>
Wishing you good luck and long association with us.
</li>
                </ul>
 
             </p>
           
             <p style="margin-left:20px;font-size:19px;"><br>
             <strong style="float:right;margin-right:60px;">For Omax Security Services Private Limited </br><br><br><span style="margin-left:187px;">Authorized Signatory</span></strong><br>
            
             </p>
             <p><br><br><br><br><br><br><br><br><hr>
             <center><strong style="font-size:20px;"><u>ACCEPTANCE OF TERM AND CONDITIONS</u></strong></center>
             </p>
             <p style="margin-left:40px;text-align:justify;font-size:19px;margin-right:40px;line-height:35px;">
               I hereby acknowledge that I have understood the terms and conditions mentioned here in above which I have read or have been read out and explained to me in the language, I understand. I agree to abide by them and accept my above appointment, on the same term and condition. I also agree to abide by the rules, regulations, and the instructions issued by the company. I am prepared to go anywhere in the country for performance of my duties pertaining to the appointment.<br>
               I would hereafter held myself responsible in the company in case I fail to discharge my obligations on any count stated above and even my services may be terminated without any notice or compensation and my employer shall not be obliged to assign any reason there off.<br>
               I have received and retained one copy of this letter of appointment for my reference and records.
             </p><br>
             <p style="float:right;margin-right:100px;">________________________________</p><br><br>
             <p style="margin-left:40px;font-weight:bold;font-size:20px;">Date: - 
             <strong style="float:right;margin-right:120px;">Signature of Applicants</strong><br><br>
             <strong>Place :- </strong>
             </p>
             </strong>
             </div>
            
         </page>
  

