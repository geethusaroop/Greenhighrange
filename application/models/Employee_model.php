<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Employee_model extends CI_Model{
	public function getEmployeeTable($param){
		$arOrder = array('','emp_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
        $this->db->where("emp_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,DATE_FORMAT(emp_doj,\'%d/%m/%Y\') as emp_doj');
		$this->db->from('tbl_employee');
		$this->db->order_by('emp_id', 'ASC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getEmployeeTotalCount($param);
        $data['recordsFiltered'] = $this->getEmployeeTotalCount($param);
        return $data;
	}
	public function getEmployeeTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
		$this->db->select('*,DATE_FORMAT(emp_doj,\'%d/%m/%Y\') as emp_doj');
		$this->db->from('tbl_employee');
		$this->db->order_by('emp_id', 'DESC');
        $this->db->where("emp_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->where('emp_status', $status);
		$query = $this->db->get();
		
		$emp_names = array();
		
		if ($query -> result()) {
		foreach ($query->result() as $emp_name) {
		$emp_names[$emp_name-> emp_id] = $emp_name -> emp_name;
			}
		return $emp_names;
		}		else {
		return FALSE;
		}
	}

	public function emp_names()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->where('emp_status', $status);
		$query = $this->db->get();
		return $query->result();
	}

}
?>