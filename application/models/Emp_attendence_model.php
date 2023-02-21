<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emp_attendence_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	public function getServiceCallReport($param){
        $arOrder = array('','emp_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
      
        
		$this->db->where("emp_status",1);
		
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_employee');
		//$this->db->join('tbl_staff','staff_id = staff_id_fk');
		$this->db->order_by('emp_id', 'DESC');
        $query = $this->db->get();
        
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getServiceCallReportTotalCount($param);
        $data['recordsFiltered'] = $this->getServiceCallReportTotalCount($param);
        return $data;
	}
	public function getServiceCallReportTotalCount($param){
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
		
		$this->db->where("emp_status",1);
		$this->db->select('*');
		$this->db->from('tbl_employee');
		$this->db->order_by('emp_id', 'DESC');
        $query = $this->db->get();
		return $query->num_rows();
	}
	function get_att($date)
	{
				
		$this->db->select('*,tbl_employee.emp_name');
		$this->db->from('tbl_empattendance');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->where("att_date", $date);
		
        $query = $this->db->get();
		
    	return $query->result();
	}
}
?>