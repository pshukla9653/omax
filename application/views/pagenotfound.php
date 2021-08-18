<?php
//WEBSITE CONFIGRATION SETTING DATA
$this->db->select('*');
$this->db->where('id', 1);
$q 			= $this->db->get('tbl_setting');
$setting	= array_shift($q->result_array());
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $setting['title']?> | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/iCheck/square/blue.css') ; ?>">
    <link rel="icon" href="<?php echo base_url('assets/backend/images/favicon.ico'); ?>" type="image/x-icon" />
    <script src="<?php echo base_url('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#"><img src="<?php echo $this->SettingModel->getLogo() ;?>" class="img-responsive" style="margin-left:90px"/></a>
      </div>
      <!-- User name -->
    

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        
          <img src="<?php echo base_url('assets/backend/dist/img/404-error-page.png');?>" alt="User Image">
        
        <!-- /.lockscreen-image -->
		
        <!-- lockscreen credentials (contains the form) -->
       

      </div><!-- /.lockscreen-item -->
      
      <div class="lockscreen-footer text-center">
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Schoolcube</a>.</strong> All rights reserved.
      </div>
    </div><!-- /.center -->
    <script src="<?php echo base_url('assets/backend/bootstrap/js/bootstrap.min.js'); ?>" ></script>
    <script src="<?php echo base_url('assets/backend/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>