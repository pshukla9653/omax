
 <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="customizer border-left-blue-grey border-left-lighten-4 hidden-lg-down"><a href="#" class="customizer-close"><i class="ft-x font-medium-3"></i></a><a href="#"
    class="customizer-toggle bg-danger"><i class="ft-cog font-medium-3 fa-spin fa fa-spin fa-fw white"></i></a>
    <div class="customizer-content p-2">
      <h4 class="text-uppercase mb-0">Quick Links</h4>
      <hr>
     
      <ul class="nav nav-tabs nav-underline nav-justified layout-options">
        <li class="nav-item">
          <a class="nav-link layouts active" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21"
          href="#tabIcon21" aria-expanded="true">Links</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navigation" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22"
          href="#tabIcon22" aria-expanded="false">Navigation</a>
        </li>
       
      </ul>
      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tabIcon21" aria-expanded="true"
        aria-labelledby="baseIcon-tab21">
          <p class="lead btn btn-lg ">
          
          <a href="<?php echo base_url('branchadmin/Employee/generateSalary');?>">Generate Salary</a> </p>
               
           <p class="lead btn btn-lg"><a href="<?php echo base_url('branchadmin/Setting/generateInvoice');?>">Generate Invoice	</a></p>
              <br> <p class="lead btn btn-lg"><a href="<?php echo base_url('Reports/reportEPF');?>">EPF Report</a></p>
              <br> <p class="lead btn btn-lg"><a href="<?php echo base_url('Reports/reportESIC');?>">ESIC Report</a></p>
              <br> <p class="lead btn btn-lg"><a href="<?php echo base_url('Reports/ListOfSalary');?>">Salary List</a></p>
         
         
         
        </div>
        <div class="tab-pane" id="tabIcon22" aria-labelledby="baseIcon-tab22">
          <p>
            <label class="display-inline-block custom-control custom-checkbox">
              <input type="checkbox" name="fixed-layout" id="fixed-layout" class="custom-control-input">
              <span class="c-indicator bg-primary custom-control-indicator"></span>
              <span class="custom-control-description">Fixed Layout</span>
            </label>
          </p>
          <p>
            <label class="display-inline-block custom-control custom-checkbox">
              <input type="checkbox" name="native-scroll" id="native-scroll" class="custom-control-input">
              <span class="c-indicator bg-primary custom-control-indicator"></span>
              <span class="custom-control-description">Native Scroll</span>
            </label>
          </p>
          <p>
            <label class="display-inline-block custom-control custom-checkbox">
              <input type="checkbox" name="right-side-icons" id="right-side-icons" class="custom-control-input">
              <span class="c-indicator bg-primary custom-control-indicator"></span>
              <span class="custom-control-description">Right Side Icons</span>
            </label>
          </p>
          <p>
            <label class="display-inline-block custom-control custom-checkbox">
              <input type="checkbox" name="bordered-navigation" id="bordered-navigation" class="custom-control-input">
              <span class="c-indicator bg-primary custom-control-indicator"></span>
              <span class="custom-control-description">Bordered Navigation</span>
            </label>
          </p>
          
          
         
        </div>
       
      </div>
     
      
    </div>
  </div>
<!--end-->
<footer class="footer footer-static footer-dark navbar-border" style="margin-bottom:0 !important;">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-xs-block d-md-inline-block">Copyright &copy; <?php echo date('Y'); $companyName = $this->CommanModel->CompanyDetail('company_name');
	  echo '. '.$companyName['company_name'];?>, All rights reserved. </span>
      <span class="float-md-right d-xs-block d-md-inline-block">Designed and Developed By <a href="http://cztn.co.in"
        target="_blank" class="text-bold-800 grey darken-2">CZTN</a></span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/vendors.min.js" type="text/javascript');?>"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?=base_url('assest/app-assets/js/core/app-menu.min.js" type="text/javascript');?>"></script>
  <script src="<?=base_url('assest/app-assets/js/core/app.min.js" type="text/javascript');?>"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/customizer.min.js" type="text/javascript');?>"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/forms/tags/form-field.js" type="text/javascript');?>"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/extensions/jquery.steps.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/tables/datatables/datatable-styling.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript');?>"></script>
  <script src="<?=base_url('assest/app-assets/js/bootstrap-datepicker.js" type="text/javascript');?>"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/forms/wizard-steps.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/forms/validation/jquery.validate.min.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/tables/datatables/datatable-basic.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/forms/select/select2.full.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/forms/select/form-select2.min.js');?>" type="text/javascript"></script>
   <script src="<?=base_url('assest/app-assets/vendors/js/forms/validation/jquery.validate.min.js');?>"
  type="text/javascript"></script>
  <script src="<?php echo base_url('assest/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js');?>"
  type="text/javascript"></script>
  <script src="<?php echo base_url('assest/app-assets/js/scripts/forms/extended/form-inputmask.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assest/app-assets/js/custom.js');?>"></script>
  <script src="<?php echo base_url('assest/app-assets/js/payroll.js');?>"></script>
  
  <script type="text/javascript">
  function readURL(input) {
if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
		$('#image_upload_preview').attr('src', e.target.result);
		$("#image_upload_preview").css("width", "100px");
		$("#image_upload_preview").css("height", "150px");
	}

	reader.readAsDataURL(input.files[0]);
}
}

$("#logo").change(function () {
readURL(this);
});
   
</script>

  <script type="text/javascript">
    $('#bank_id').on('change',function(){
        var bankID = $(this).val();
		///alert(bankID);
        if(bankID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getBankBranch');?>',
                data:'bank_id='+bankID,
				
                success:function(html){
                  $('#bank_branch_id').html(html);
                }
				
            }); 
        }else{
            $('#bank_branch_id').html('<option value="">Select Bank First</option>'); 
        }
    });
	
</script>   
 <script type="text/javascript">
    $('#ClientId').on('change',function(){
        var ClientId = $(this).val();
		var Yearv = $('#yearv').val();
		var Monthv = $('#monthv').val();
		//alert(Monthv);
        if(ClientId){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getEmpList');?>',
                data:'client_id='+ClientId+'&year_v='+Yearv+'&month_v='+Monthv,
				
                success:function(html){
                  $('#Emp_id').html(html);
                }
				
            }); 
        }else{
            $('#Emp_id').html('<option value="">Select Client First</option>'); 
        }
    });
	
</script> 
<script type="text/javascript">
    $('#client_list').on('change',function(){
        var ClientId = $(this).val();
		
        if(ClientId){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getClientSeriveList');?>',
                data:'client_id='+ClientId,
				
                success:function(html){
                  $('#service_id').html(html);
                }
				
            }); 
        }else{
            $('#service_id').html('<option value="">Select Client First</option>'); 
        }
    });
	
</script> 
<script type="text/javascript">
    $('#service_id').on('change',function(){
        var service_id = $(this).val();
		var client_id = $('#client_list').val();
		var Yearv = $('#year_v').val();
		var Monthv = $('#month_v').val();
        if(service_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getClientSubSeriveList');?>',
                data:'service_id='+service_id+'&client_id='+client_id+'&year_v='+Yearv+'&month_v='+Monthv,
				
                success:function(html){
                  $('#subservice_id').html(html);
                }
				
            }); 
        }else{
            $('#subservice_id').html('<div class="text-danger">Select Client  and Service First</div>'); 
        }
    });
	
</script>  

<script type="text/javascript">
    $('#client_list_invoice').on('change',function(){
        var ClientId = $(this).val();
		
        if(ClientId){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getClientSeriveListForInvoice');?>',
                data:'client_id='+ClientId,
				
                success:function(html){
                  $('#service_list').html(html);
                }
				
            }); 
        }else{
            $('#service_list').html('<option value="">Select Client First</option>'); 
        }
    });
	
</script> 
<script type="text/javascript">
    $('#service_list').on('change',function(){
        var service_id = $(this).val();
		var client_id = $('#client_list_invoice').val();
        if(service_id){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('branchadmin/ajaxcall/getClientSubSeriveListForInvoice');?>',
                data:'service_id='+service_id+'&client_id='+client_id,
				
                success:function(html){
                  $('#subservice_list').html(html);
                }
				
            }); 
        }else{
            $('#subservice_list').html('<div class="text-danger">Select Client  and Service First</div>'); 
        }
    });
	
</script>
<script type="text/javascript">
$( document ).ready(function() {
	<?php if($client_service_mapping_detail[0]['bill_cycle'] == 3) { ?> 
	
	$('#billing_cycle_box').show();
	 <?php }else{ ?>$('#billing_cycle_box').hide();<?php }?>
	
    $('#billing_cycle').on('change',function(){
        var bill = $(this).val();
		
        if(bill==3){
            $("#billing_cycle_box").show(1000); 
        }else{
            $('#billing_cycle_box').hide(1000); 
        }
    });
	});
</script>   
<script type="text/javascript">
	$( document ).ready(function() {
   $('#divforclinet').hide();

    $('#SalaryTypeReport').on('change',function(){
        var salary = $(this).val();
		
        if(salary=='AsPerClient'){
            $('#divforclinet').show(2000);
        }else{
            $('#divforclinet').hide(2000);
        }
    });
	});
</script>    
 <script>
	
		 $('#datepicker').datepicker({
      autoclose: true
    });
	
	</script>
 <script>
 <?php if($editdeduction[0]['id']==''){?>
	$("#formodeofdeduction").hide();
	$("#fortypeofdeduction").hide(); 
	 <?php }else{
	 if($editdeduction[0]['type_of_deduction']=='Regular'){?>
	 $("#fortypeofdeduction").hide();
	  <?php }
	  if($editdeduction[0]['mode_of_deduction']=='Fixed'){?>
	 $("#formodeofdeduction").hide();
	  ?>
	 
 <?php }}?>
	</script>
  <!-- END PAGE LEVEL JS-->
</body>

</html>