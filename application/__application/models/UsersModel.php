<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsersModel extends CI_Model
{ 
	 private $tableUser 		= 'tbl_users';
	 private $tableUserDetail 	= 'tbl_user_details';

     function __construct(){
     
          parent::__construct();
		  
     }
	
		//get the username & password from tbl_usrs
    public function get_user($username, $password){
  		// echo $username, $password;exit;
		$this -> db -> select('*');
		$this -> db -> from('tbl_users');
		$this -> db -> where('username', $username);
		$this -> db -> where('status', '1');
		$query = $this->db->get();
		
		if($query -> num_rows() == 1) {
		//echo "hello";exit;
			$res['result'] = array_shift($query->result_array());
			//echo var_dump($res['result']);
			$h = hash("sha256", $password.$res['result']['salt']);
			//echo $h;
			if($h==$res['result']['password'])
			//echo "hello";exit;
				return $query->result_array();
		} else {
			//echo "hiii";exit;
			return false;
		}			
     }
	 
	public function getUserName($username){
  		// echo $username, $password;exit;
		$this -> db -> select('*');
		$this -> db -> from('tbl_users');
		$this -> db -> where($username);
		$this -> db -> where('status', '1');
		$query = $this->db->get();
		return array_shift($query->result_array());			
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
	public function checkDuplicate($table_name, $field){
	
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($field);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getList($fields,$tablename,$order, $by) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->order_by($order, $by);
		//$this->db->where_not_in('status','3');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getSum($fields,$tablename) {
		$this->db->select_sum($fields);
		$this->db->from($tablename);
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getEmployees(){
  $this->db->select("tbl_etopup_dis.*,tbl_distributor.name");
  $this->db->from('tbl_etopup_dis');
  $this->db->join('tbl_distributor', 'tbl_etopup_dis.distibutor_id = tbl_distributor.id');
  $query = $this->db->get();
  return $query->result_array();
 }
}
?>
