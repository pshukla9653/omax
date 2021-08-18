
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
      
          
          
          
           
             <h4 style="margin-left:20px;">To,</h4>
             <h4 style="margin-left:20px;">Mr.&nbsp;<?php echo $details2[0]['applicant_name']?></h4>
             <h4 style="margin-left:20px;">S/o Shri&nbsp;<?php echo $details2[0]['father_name']?></h4>
             <h4 style="margin-left:20px;">Address &nbsp;<?php echo $details2[0]['address']?></h4>
             
             <h4 style="margin-left:20px;">Mobile No-+91 &nbsp;<?php echo $details2[0]['mobile']?></h4>
             <center><strong><u>LETTER OF OFFER</u></strong></center>
             
             <br>
             <p style="margin-left:20px;">
                <strong>Dear Mr&nbsp;<?php echo $details2[0]['applicant_name']?>,</strong>
             </p>
             <p style="margin-left:20px;font-size:17px;">
             This has reference of your interview & subsequent discussion.
             </p>
             
             <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
 1.	You have been selected for the post of “<?php echo $details[0]['post_offered']?>” at <?php echo $details3['branch_name']?> <strong>Branch</strong>. You are advised to join on or before <strong><?php echo $details[0]['reportingon']?></strong>. on gross salary <strong>Rs</strong><?php echo $details[0]['offered_salary']?>/- (…………………………………………………). Bifurcation will be sent along with appointment letter,  <strong>at our <?php echo $details3['branch_name']?> Branch</strong>/ for familiarization and other instruction. 
             </p>
              <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
              2.  Please submit the fallowing documents to enable us to process your appointment order within a week after or before date of joining to Delhi Branch.<br>
(a)  Photocopies of all the academic certificates.<br>
(b)  Original Matriculation Certificate.<br>
(c)  Photo ID Proof i.e. Pan Card, Driving License and Voter ID.<br>
(d)  Address Proof.<br>
(e)  Aadhar Card.<br>
(f)   Photocopy of Personal Bank  Account.<br>
(g)  Medical Fitness Certificate.<br>
(h)  Police verification.<br>
(i)   Relieving Letter/experience Letter from last employer (s) if any.<br>
(j)   Last Employer’s Appointment letter and Salary slip if applicable.<br>
(k)  04 in Nov. Passport size photographs with red background.
 
             </p>
             
              <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                
3.Your appointment will be purely temporary and can be terminated at any time without assigning any 
reason thereof.
 
             </p>
             
              <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                
4. On Completion of familiarization period at our Bhopal Branch, you will continue as such (as <?php echo $details3['branch_name']?>) 
in the branch.

             </p>
             
               <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                
5. You will take over charge of &nbsp;<strong><?php echo $details[0]['reportingon']?></strong>&nbsp;after going through all the records.
             </p>
             
        <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                
6. Appointment Letter along with term &amp; conditions will be issued to you after receipt of required 
documents.

             </p>
             
             <p style="text-align:justify;margin-left:20px;margin-right:20px;font-size:17px;">
                
7. Further it is brought to your notice that your employment will be effective from the date of your 
Acceptance of this letter or joining of duty whichever is later.


             </p>
             <p style="margin-left:380px;font-size:19px;">
             <strong style="">For Omax Security Services Private Limited</strong><br>
             <strong style="margin-left:70px;">Acceptance of Offer Letter </strong>
             </p>
             
             <p style="margin-left:20px;font-size:19px;">
              <strong>Authorized Signatory</strong>
             </p>
           </div>
         
      </page>
   

