<?php 
//SESSION USER TABLE IS AND USERNAME
$id = $this->session->userdata('loginid');

$username = $this->session->userdata('username');
//echo hash("sha256", 'admin'.'2eab0f499b6cda709f40ded36cffa652');
//exit;
$this->db->select("*");
$this->db->from('tbl_users');
$this->db->join('tbl_user_details','tbl_user_details.user_id = tbl_users.id');
$this->db->where('tbl_users.id', $id);
$q = $this->db->get();
//echo var_dump($q); exit;
$SessionUser = array_shift($q->result_array());
//WEBSITE CONFIGRATION SETTING DATA
$this->db->select('*');
$this->db->where('id', 1);
$q 			= $this->db->get('tbl_setting');
$setting	= array_shift($q->result_array());
//echo var_dump($setting); exit;
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="<?php echo $setting['description']; ?>">
  <meta name="keywords" content="<?php echo $setting['keyword']; ?>">
  <meta name="author" content="Canzone Technologies">
  <title><?php echo isset($title) ? $title : ''; ?></title>
  <link rel="icon" href="<?=base_url('assest/app-assets/images/ico/favicon.ico');?>" type="image/ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/bootstrap.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/bootstrap-datepicker.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/feather/style.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/flag-icon-css/css/flag-icon.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/extensions/pace.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/forms/selects/select2.min.css');?>">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/bootstrap-extended.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/app.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/colors.min.css');?>">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/core/menu/menu-types/vertical-menu.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/core/colors/palette-gradient.min.css');?>">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/assets/css/style.css');?>">
  <!-- END Custom CSS-->
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns fixed-navbar">
  <!-- - var navbarShadow = true-->
  <!-- navbar-fixed-top-->
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
        
          <li class="nav-item">
            <a href="<?php echo base_url();?>" class="navbar-brand">
              <img alt="stack admin logo" src="<?php echo base_url('uploads/logo/'.$setting['logo']);?>" height="40px"
              class="brand-logo">
              <!--<h2 class="brand-text">Stack</h2>-->
            </a>
          </li>
          <li class="nav-item hidden-md-up float-xs-right">
            <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu"></i></a></li>
            
            <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon ft-maximize"></i></a></li>
            
          </ul>
          <ul class="nav navbar-nav float-xs-right">
            <li class="dropdown dropdown-user nav-item">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                <span class="avatar avatar-online">
                 <?php //$pic = $this->UsersModel->getSessionUserPic($SessionUser['user_id']);?>
                  <img src="<?php  if(!empty($pic[0]['profile_photo'])){echo base_url('uploads/profile/'.$pic[0]['profile_photo']);}else{echo base_url('uploads/profile/avatar.jpg'); }?>" alt="avatar"><i></i></span>
                <span class="user-name"><?php echo  $SessionUser['name'];?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a href="<?php echo site_url('web/profile')?>" class="dropdown-item"><i class="ft-user"></i> Edit Profile</a>
               
                <div class="dropdown-divider"></div><a href="<?php echo site_url('web/logout')?>" class="dropdown-item"><i class="ft-power"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
 
 <?php
 $this->load->view('layout/menu', array('setting'=>$setting, 'SessionUser'=>$SessionUser, 'username'=>$username)); 
 
   ?> 
 
 <?php $this->load->view($content, array('setting'=>$setting,  'SessionUser'=>$SessionUser,  'username'=>$username)); ?>
 <!--side menu-->
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
 <!--side menu-->
 <footer class="footer footer-static footer-dark navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-xs-block d-md-inline-block">Copyright &copy; <?php echo date('Y'); $companyName = $this->CommanModel->CompanyDetail('company_name');
	  echo '. '.$companyName['company_name'];?>, All rights reserved. </span>
      <span class="float-md-right d-xs-block d-md-inline-block">Designed and Developed By <a href="http://cztn.co.in"
        target="_blank" class="text-bold-800 grey darken-2">CZTN</a></span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/vendors.min.js');?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/jquery.dataTables.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js');?>"
  type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/jszip.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/pdfmake.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/vfs_fonts.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/buttons.html5.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/buttons.print.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/tables/buttons.colVis.min.js');?>" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?=base_url('assest/app-assets/js/core/app-menu.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/core/app.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/customizer.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/vendors/js/forms/select/select2.full.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/scripts/forms/select/form-select2.min.js');?>" type="text/javascript"></script>
  <!-- END STACK JS-->
  
  <script src="<?=base_url('assest/app-assets/js/bootstrap-datepicker.js" type="text/javascript');?>"></script>
  <script src="<?php echo base_url('assest/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js');?>"
  type="text/javascript"></script>
  <script src="<?php echo base_url('assest/app-assets/js/scripts/forms/extended/form-inputmask.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assest/app-assets/js/custom.js');?>"></script>
  <script src="<?php echo base_url('assest/app-assets/js/payroll.js');?>"></script>
  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
  $(document).ready(function() {
	
  $('.dataex-html5-selectors').DataTable( {
	
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copyHtml5',
			footer: true,
            exportOptions: {
                columns: [ 0, ':visible' ]
            }
        },
        {
            extend: 'excelHtml5',
			footer: true,
			title: 'Omax Security Services Private Limited',
			messageTop: '<?php echo $title;?>',
            customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="A"]', sheet).attr( 's', '2' );
            },
			exportOptions: {
                columns: ':visible'
            }
			
        },
        {
            extend: 'pdfHtml5',
			footer: true,
			title: 'Omax Security Services Private Limited',
			messageTop: '<?php echo $title;?>',
			   customize: function(doc) {
				  
				 doc.styles.title.color = 'red',
				 doc.styles.title.fontSize = '40',
				 doc.styles.title.alignment = 'center',
				 doc.styles.message.color = 'black',
				 doc.styles.message.fontSize = '20',
				 doc.styles.message.alignment = 'center'
			   },
		orientation: 'landscape',
           // message: 'Hello Word',
            pageSize: 'A2',
            exportOptions: {
                modifier: {
                    columns: [ 0, ':visible' ]
                }
            }
        },
        'colvis'
    ]
} );} );
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

  <!-- END PAGE LEVEL JS-->
</body>

</html>
 
  