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

?>
 <?php $this->load->view('layout/header', array('setting'=>$setting, 'SessionUser'=>$SessionUser, 'username'=>$username)); ?>
 
 <?php
 $this->load->view('layout/menu', array('setting'=>$setting, 'SessionUser'=>$SessionUser, 'username'=>$username)); 
 
   ?> 
 
 <?php $this->load->view($content, array('setting'=>$setting,  'SessionUser'=>$SessionUser,  'username'=>$username)); ?>
 <script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    	window.setTimeout(function () {
			$(".alert-info").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 3000);
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    $('[data-rel="chosen"],[rel="chosen"]').chosen();
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			  checkboxClass: 'icheckbox_minimal-blue',
			  radioClass: 'iradio_minimal-blue'
			});
    </script>
 <?php $this->load->view('layout/footer', array('setting'=>$setting, 'SessionUser'=>$SessionUser, 'username'=>$username)); ?>
 
  