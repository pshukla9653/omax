<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome | Schoolcube</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/plugins/iCheck/square/blue.css') ; ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/dist/css/skins/_all-skins.min.css') ; ?>">
    
  </head>
  <body class="hold-transition layout-top-nav">
 
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-default" role="navigation">
            	<div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>    
                    </div>
                    <a class="navbar-brand" href="#"><img src="<?php echo $this->SettingModel->getLogo() ;?>" class="img-responsive" style="    margin-top: -7%;height: 40px;" /></a>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo site_url('web/login')?>">Login</a></li>
                            <li><a href="<?php echo site_url('web/register')?>">Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <div class="container">
                <section class="content" style="min-height:530px;">
                    <form action="#" method="get" class="form">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="search" placeholder="Search..."  autofocus>
                            <span class="input-group-btn">
                                <input class="btn btn-info btn-flat" type="submit" name="search" Value="Go!">
                            </span>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        
        <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Schoolcube</a>.</strong> All rights reserved.
        </footer> 
    </div>
    

        
    <script src="<?php echo base_url('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/backend/bootstrap/js/bootstrap.min.js'); ?>" ></script>
    <script src="<?php echo base_url('assets/backend/plugins/iCheck/icheck.min.js'); ?>"></script>
    
	<script src="<?php echo base_url('assest/backend/plugins/fastclick/fastclick.min.js'); ?>"></script>
    <script src="<?php echo base_url('assest/backend/dist/js/app.min.js');?>"></script>
    <script src="<?php echo base_url('assest/backend/dist/js/demo.js');?> "></script>
    
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