<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingModel extends CI_Model
{ 
	 private $tableUser 		= 'tbl_users';
	 private $tableUserDetail 	= 'tbl_user_details';

     function __construct(){
     
          parent::__construct();
		  
     }
	 public function save_file_info($file, $where, $table, $field) {
		//start db traction
		$this->db->trans_start();
		
		$this->db->where($where);
		$this->db->update($table, array($field=>$file['file_name']));
		
		//complete the transaction
		$this->db->trans_complete();
		//check transaction status
		if ($this->db->trans_status() === FALSE) {
			$file_path = $file['full_path'];
			//delete the file from destination
			if (file_exists($file_path)) {
			unlink($file_path);
		}
		//rollback transaction
		$this->db->trans_rollback();
			return FALSE;
		} else {
			//commit the transaction
			$this->db->trans_commit();
			return TRUE;
		}
	}	
	
	public function getLastInserted() {
		return $this->db->insert_id();
    }
   	public function InsertData($tablename,$data){
		$this->db->insert($tablename, $data);
		return $this->db->insert_id();
	}
	
	public function UpdateData($tablename,$value, $where) {
		$this->db->where($where);
		$this->db->update($tablename,$value);
		return TRUE;
	}
	
	
	public function getData($table_name, $field){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($field);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getList($fields,$tablename,$order, $by) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where('status', 1);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getListWhere($fields,$tablename,$order, $by, $where) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($where);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getBankBranchList() {
	$this->db->select('tbl_bank_branch.*,tbl_bank.bank_name');
	$this->db->from('tbl_bank_branch');
	$this->db->join('tbl_bank', 'tbl_bank.id = tbl_bank_branch.bank_id');
	$this->db->where('tbl_bank.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_bank.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getSubServiceList() {
	$this->db->select('tbl_sub_service.*,tbl_service.service_name');
	$this->db->from('tbl_sub_service');
	$this->db->join('tbl_service', 'tbl_service.id = tbl_sub_service.service_id');
	$this->db->where('tbl_service.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_service.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
}
?>
