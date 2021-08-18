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
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/plugins/forms/wizard.min.css');?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assest/app-assets/css/plugins/forms/extended/form-extended.min.css');?>">
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
             
            </a>
          </li>
          </li><p class="lead" style="position:relative;top:20px;left:-15px;font-weight:bold;">Omax Security</p>
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
                 <?php $pic = $this->CommanModel->getDataIfdataexists('profile_photo','tbl_user_details',array('user_id'=>$this->session->userdata('loginid')));?>  
                  <img src="<?php  if(!empty($pic['profile_photo'])){echo base_url('uploads/profile/'.$pic['profile_photo']);}else{echo base_url('uploads/profile/avatar.jpg'); }?>" alt="avatar"><i></i></span>
                <span class="user-name"><?php echo  $SessionUser['name'];?></span>
              </a>
              <?php if($this->session->userdata('type') == 'admin') {?>
              <div class="dropdown-menu dropdown-menu-right"><a href="<?php echo base_url('admin/Setting/profile')?>" class="dropdown-item"><i class="ft-user"></i> Edit Profile</a>
               <?php }?>
               <?php if($this->session->userdata('type') == 'branchadmin') { ?>
               <div class="dropdown-menu dropdown-menu-right"><a href="<?php echo base_url('branchadmin/Setting/profile')?>" class="dropdown-item"><i class="ft-user"></i> Edit Profile</a>
               <?php }?>
                <div class="dropdown-divider"></div><a href="<?php echo site_url('web/logout')?>" class="dropdown-item"><i class="ft-power"></i> Logout</a>
               
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>