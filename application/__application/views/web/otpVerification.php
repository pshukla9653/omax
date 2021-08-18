<?php 
//SESSION USER TABLE IS AND USERNAME
$id = $this->session->userdata('loginid');
$username = $this->session->userdata('username');
$this->db->select("*");
$this->db->from('tbl_users');
$this->db->join('tbl_user_details','tbl_user_details.user_id = tbl_users.id');
$this->db->where('tbl_users.id', $id);
$q = $this->db->get();
$SessionUser = array_shift($q->result_array());
//WEBSITE CONFIGRATION SETTING DATA
$this->db->select('*');
$this->db->where('id',1 );
$q 			= $this->db->get('tbl_setting');
$setting	= array_shift($q->result_array());
//e
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="<?php echo $setting['description']; ?>">
  <meta name="keywords" content="<?php echo $setting['keyword']; ?>">
  <meta name="author" content="OneBox">
  <title><?php echo isset($title) ? $title : ''; ?></title>
  <link rel="icon" href="<?=base_url('assest/app-assets/images/ico/favicon.ico');?>" type="image/ico"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/bootstrap.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/feather/style.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/font-awesome/css/font-awesome.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/fonts/flag-icon-css/css/flag-icon.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/extensions/pace.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/forms/icheck/icheck.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/vendors/css/forms/icheck/custom.css');?>">
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
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/pages/login-register.min.css');?>">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/assets/css/style.css');?>">
  <!-- END Custom CSS-->
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column bg-full-screen-image blank-page blank-page">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-3 p-0">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
              <div class="card-header no-border">
                <div class="card-title text-xs-center">
                  <img src="<?=base_url('assest/app-assets/images/logo/logo.png');?>" width="60%"	 alt="branding logo">
                </div>
                
              </div>
              <div class="card-body collapse in">
                
                <p class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-2 my-1">
                  <span>Enter OTP</span>
                </p>
                 <?php echo $this->session->flashdata('msg');?>
                <div class="card-block">
                  <?php echo form_open_multipart('web/OTPVerificaion', array('name'=>'OTPVerificaion','class'=>'form-horizontal'));?>
                 
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" class="form-control" id="user-name" name="username" placeholder="Your Username"
                      value="<?php echo $this->session->userdata('uname');?>"
                      readonly>
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                      <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="text" class="form-control" id="user-name" name="mobile" placeholder="Your Mobile"
                      value="<?php echo $this->session->userdata('mno');?>"
                      readonly>
                      <div class="form-control-position">
                        <i class="ft-phone"></i>
                      </div>
                      <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control" id="user-password" name="password" placeholder="Enter OTP"
                      required autofocus>
                      <div class="form-control-position">
                        <i class="fa fa-key"></i>
                      </div>
                      <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
                    </fieldset>
                    <!--<fieldset class="form-group row">
                      <div class="col-md-6 col-xs-12 text-xs-center text-sm-left">
                        <fieldset>
                          <input type="checkbox" id="remember-me" class="chk-remember">
                          <label for="remember-me"> Remember Me</label>
                        </fieldset>
                      </div>
                      <div class="col-md-6 col-xs-12 float-sm-left text-xs-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                    </fieldset>-->
                    <button type="submit" name="btn_login" value="Login" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Login</button>
                 <?php echo form_close();?>
                </div>
                
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  
  <!-- BEGIN VENDOR JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/vendors.min.js');?>" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?=base_url('assest/app-assets/vendors/js/forms/icheck/icheck.min.js');?>" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?=base_url('assest/app-assets/js/core/app-menu.min.js');?>" type="text/javascript"></script>
  <script src="<?=base_url('assest/app-assets/js/core/app.min.js');?>" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?=base_url('assest/app-assets/js/scripts/forms/form-login-register.min.js');?>" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  <script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 5000);
    
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 5000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 5000);
    
    </script>
</body>
</html>