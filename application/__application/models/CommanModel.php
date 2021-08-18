<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommanModel extends CI_Model
{ 
	

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
	
	public function deleteData($tablename, $where) {
		$this->db->delete($tablename, $where); 
		return TRUE;
	}
	
	public function getData($table_name, $field){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($field);
		//$this->db->where('branch_id', $this->session->userdata('branch_id'));
		//$this->db->where('company_id', $this->session->userdata('company_id'));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getBankBranch($id){
		$this->db->select('*');
		$this->db->from('tbl_bank_branch');
		$this->db->where('bank_id', $id);
		$query = $this->db->get();
		return $query;
	}
	public function getSubService($id){
		$this->db->select('*');
		$this->db->from('tbl_sub_service');
		$this->db->where('service_id', $id);
		$query = $this->db->get();
		return $query;
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
	
	public function getAllListAll($fields,$tablename,$order, $by) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getDataByFieldName($fieldname,$tablename)
	{
		$this->db->select($fieldname);
        $this->db->from($tablename);
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
	public function getSubServiceByClinetListWhere($fields,$tablename,$order, $by, $service, $where) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where_in('subservice_id', $where);
		$this->db->where($service);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getListWhereLimit($fields,$tablename,$order, $by, $where, $limit) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($where);
		$this->db->order_by($order, $by);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getListLimit($fields,$tablename,$order, $by, $limit) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->order_by($order, $by);
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getListWhereIn($fields,$tablename,$order, $by, $where) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where_in('id', $where);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getEmpdetailsWhereIn($fields,$order, $by, $wherein, $where) {
		$this->db->select($fields);
		$this->db->from('tbl_employee_official');
		$this->db->where_in('emp_id', $where);
		$this->db->where($where);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function Ifdataexists($fields,$tablename, $where) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
	
	public function getDataIfdataexists($fields,$tablename, $where) {
		
		try
		{	
			$this->db->select($fields);
			$this->db->from($tablename);
			$this->db->where($where);
			$data_list = $this->db->get();
			
			if($data_list)
			{
				$data_list = $data_list->result_array();
				return array_shift($data_list);		
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			return DB_ERROR;	
		}
	}
	public function getBankBranchList() {
	$this->db->select('tbl_bank_branch.*,tbl_bank.bank_name');
	$this->db->from('tbl_bank_branch');
	$this->db->join('tbl_bank', 'tbl_bank.id = tbl_bank_branch.bank_id');
	$query = $this->db->get();
	return $query->result_array();
	}
	
	public function getDataFromTwoTables($value, $firsttable, $secondtable, $firstcondiation, $where) {
	$this->db->select($value);
	$this->db->from($firsttable);
	$this->db->join($secondtable, $firstcondiation);
	$this->db->where($where);
	$query = $this->db->get();
	return array_shift($query->result_array());
	}
	public function getAllEMPDetailList($value) {
	$this->db->select($value);
	$this->db->from('tbl_employee');
	$this->db->join('tbl_employee_official', 'tbl_employee.id=tbl_employee_official.emp_id');
	$this->db->where('tbl_employee.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_employee.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getAllEMPDetailListWhere($value, $where) {
	$this->db->select($value);
	$this->db->from('tbl_employee');
	$this->db->join('tbl_employee_official', 'tbl_employee.id=tbl_employee_official.emp_id');
	$this->db->join('tbl_designation', 'tbl_designation.id=tbl_employee_official.designation');
	$this->db->where($where);
	$this->db->where('tbl_employee.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_employee.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getAllEMPDetailListWhereIn($value, $where, $wherein) {
	$this->db->select($value);
	$this->db->from('tbl_employee');
	$this->db->join('tbl_employee_official', 'tbl_employee.id=tbl_employee_official.emp_id');
	$this->db->join('tbl_designation', 'tbl_designation.id=tbl_employee_official.designation');
	$this->db->where_in($where, $wherein);
	$this->db->where('tbl_employee.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_employee.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getEMPDetailListWhere($value, $where) {
	$this->db->select($value);
	$this->db->from('tbl_employee');
	$this->db->join('tbl_employee_official', 'tbl_employee.id=tbl_employee_official.emp_id');
	$this->db->where('tbl_employee.id', $where);
	$this->db->where('tbl_employee.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_employee.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return array_shift($query->result_array());
	}
	public function getAllClientListWhere($value, $where) {
	$this->db->select($value);
	$this->db->from('tbl_client_invoice');
	$this->db->join('tbl_transaction','tbl_client_invoice.id=tbl_transaction.client_id');
	$this->db->where($where);
	$this->db->where('tbl_client_invoice.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_client_invoice.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getDateofBirth($value) {
	$date = date("m-d");
	$this->db->select($value);
	$this->db->from('tbl_employee');
	$this->db->join('tbl_employee_official', 'tbl_employee.id=tbl_employee_official.emp_id');
	$this->db->like('tbl_employee.dob', $date, 'before');
	$this->db->where('tbl_employee.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_employee.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getBankBranchDetail($id) {
	$this->db->select('tbl_bank_branch.*,tbl_bank.bank_name');
	$this->db->from('tbl_bank_branch');
	$this->db->join('tbl_bank', 'tbl_bank.id=tbl_bank_branch.bank_id');
	$this->db->where('tbl_bank_branch.id',$id);
	$query = $this->db->get();
	return array_shift($query->result_array());
	}
	public function getDataFromThreeTables($value, $firsttable, $secondtable, $thirdtable, $firstcondiation,$secondcondiation) {
	$this->db->select($value);
	$this->db->from($firsttable);
	$this->db->join($secondtable, $firstcondiation);
	$this->db->join($thirdtable, $secondcondiation);
	$query = $this->db->get();
	return $query->result_array();
	}
	
	public function getClientwiseSalary($where, $id) {
	try
		{	
			$this->db->select('tbl_salary.*,tbl_client.client_name');
			$this->db->from('tbl_salary');
			$this->db->join('tbl_salary_detail', 'tbl_salary.id=tbl_salary_detail.salary_id');
			$this->db->join('tbl_client', 'tbl_client.id=tbl_salary_detail.clientid');
			$this->db->where($where);
			$this->db->where('tbl_salary_detail.clientid', $id);
			$this->db->order_by('tbl_salary.id', 'ASC');
			$data_list = $this->db->get();
			
			if($data_list)
			{
				$data_list = $data_list->result_array();
				return $data_list;		
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			return DB_ERROR;	
		}
	}
	public function getClientwiseSalaryN($where, $id) {
	try
		{	
			$this->db->select('tbl_salary_detail.*,tbl_salary.ExtraDeduction,tbl_salary.TotalExtraDeduction');
			$this->db->from('tbl_salary_detail');
			$this->db->join('tbl_salary', 'tbl_salary.id=tbl_salary_detail.salary_id');
			$this->db->where($where);
			$this->db->where('tbl_salary_detail.clientid', $id);
			$this->db->order_by('tbl_salary_detail.id', 'ASC');
			$data_list = $this->db->get();
			
			if($data_list)
			{
				$data_list = $data_list->result_array();
				return $data_list;		
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			return DB_ERROR;	
		}
	}
	public function getClientwiseSalaryIn($where, $id) {
	try
		{	
			$this->db->select('tbl_salary.*,tbl_client.client_name');
			$this->db->from('tbl_salary');
			$this->db->join('tbl_salary_detail', 'tbl_salary.id=tbl_salary_detail.salary_id');
			$this->db->join('tbl_client', 'tbl_client.id=tbl_salary_detail.clientid');
			$this->db->where($where);
			$this->db->where_in('tbl_salary_detail.clientid', $id);
			$this->db->order_by('tbl_salary.id', 'ASC');
			$data_list = $this->db->get();
			
			if($data_list)
			{
				$data_list = $data_list->result_array();
				return $data_list;		
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			return DB_ERROR;	
		}
	}
	public function getClientServiceMapList() {
	$this->db->select('tbl_client_service_mapping.*,tbl_client.client_name,tbl_service.service_name,tbl_designation.designation_name');
	$this->db->from('tbl_client_service_mapping');
	$this->db->join('tbl_client', 'tbl_client_service_mapping.client_id=tbl_client.id');
	$this->db->join('tbl_service', 'tbl_client_service_mapping.service_id=tbl_service.id');
	$this->db->join('tbl_designation', 'tbl_client_service_mapping.subservice_id=tbl_designation.id');
	$this->db->where('tbl_client_service_mapping.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_client_service_mapping.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	public function getGradeBaseSalaryList() {
	$this->db->select('tbl_gradebase_salary.*,tbl_grade.grade_name,tbl_department.department_name,tbl_designation.designation_name');
	$this->db->from('tbl_gradebase_salary');
	$this->db->join('tbl_grade', 'tbl_gradebase_salary.grade_id=tbl_grade.id');
	$this->db->join('tbl_department', 'tbl_gradebase_salary.department_id=tbl_department.id');
	$this->db->join('tbl_designation', 'tbl_gradebase_salary.designation_id=tbl_designation.id');
	$this->db->where('tbl_gradebase_salary.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_gradebase_salary.company_id', $this->session->userdata('company_id'));
	$query = $this->db->get();
	return $query->result_array();
	}
	
	public function getShiftBasedEmpList($where) {
	$this->db->select('tbl_employee.id,tbl_employee.emp_name');
	$this->db->from('tbl_shift_emp');
	$this->db->join('tbl_employee', 'tbl_shift_emp.emp_id=tbl_employee.id');
	$this->db->where('tbl_shift_emp.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_shift_emp.company_id', $this->session->userdata('company_id'));
	$this->db->where($where);
	$query = $this->db->get();
	return $query;
	}
	
	public function getServiceListClientBased($where) {
	$this->db->select('tbl_service.id,tbl_service.service_name');
	$this->db->from('tbl_client_service_mapping');
	$this->db->join('tbl_service', 'tbl_client_service_mapping.service_id=tbl_service.id');
	$this->db->where('tbl_client_service_mapping.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_client_service_mapping.company_id', $this->session->userdata('company_id'));
	$this->db->where($where);
	$this->db->group_by('tbl_client_service_mapping.service_id');
	$query = $this->db->get();
	return $query;
	}
	public function getSubServiceListClientBased($where) {
	$this->db->select('tbl_designation.id,tbl_designation.designation_name,tbl_client_service_mapping.strength');
	$this->db->from('tbl_client_service_mapping');
	$this->db->join('tbl_designation', 'tbl_client_service_mapping.subservice_id=tbl_designation.id');
	$this->db->where('tbl_client_service_mapping.branch_id', $this->session->userdata('branch_id'));
	$this->db->where('tbl_client_service_mapping.company_id', $this->session->userdata('company_id'));
	$this->db->where($where);
	///$this->db->group_by('tbl_client_service_mapping.subservice_id');
	$query = $this->db->get();
	return $query;
	}
	public function getSubServiceList() {
	$this->db->select('tbl_sub_service.*,tbl_service.service_name');
	$this->db->from('tbl_sub_service');
	$this->db->join('tbl_service', 'tbl_service.id = tbl_sub_service.service_id');
	$query = $this->db->get();
	return $query->result_array();
	}
	
	public function CompanyDetail($value){
		$this->db->select($value);
		$this->db->from('tbl_company');
		$this->db->where('id', $this->session->userdata('company_id'));
		$query = $this->db->get();
		return array_shift($query->result_array());
		
		}
	
	public function CompanyBranchDetail($value){
		$this->db->select($value);
		$this->db->from('tbl_branch');
		$this->db->where('id', $this->session->userdata('branch_id'));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$query = $this->db->get();
		return array_shift($query->result_array());
		
		}
	public function getShiftDateBetweenDates($value, $startdate, $enddate, $where){
		$this->db->select($value);
		$this->db->from('tbl_shift_emp');
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where($where);
		$this->db->where('date_from>=', $startdate);
		$this->db->where('date_to<=', $enddate);
		$query = $this->db->get();
		return $query->result_array();
		
		}
		public function getListBetweenDates($fields,$tablename,$order, $by, $where, $fromdate, $todate) {
		$this->db->select($fields);
		$this->db->from($tablename);
		$this->db->where($where);
		$this->db->where('createdon>=', $fromdate);
		$this->db->where('createdon<=', $todate);
		$this->db->order_by($order, $by);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getSumAmount($value, $table, $where){

	try
		{	
			$this->db->select_sum($value);
			$this->db->from($table);
			$this->db->where($where);
			$data_list = $this->db->get();
			
			if($data_list)
			{
				$data_list = $data_list->result_array();
				return $data_list;		
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			return DB_ERROR;	
		}	
	}
}
?>
