<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Overtime_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
    public function getOvertimeTable($param){
		$arOrder = array('','emp_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
        $this->db->where("overtym_status",1);
        if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,date_format(overtym_date,"%d/%m/%Y") as overtym_date');
		$this->db->from('tbl_overtime');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->order_by('overtym_id', 'ASC');
        $query = $this->db->get();
		
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getOvertimeTotalCount($param);
        $data['recordsFiltered'] = $this->getOvertimeTotalCount($param);
        return $data;
	}
	public function getOvertimeTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_overtime');
		$this->db->join('tbl_employee','emp_id = emp_id_fk');
		$this->db->order_by('overtym_id', 'ASC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function view_by()
	{
		$status=1;
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		
		$category_names = array();
		if ($query -> result()) {
		foreach ($query->result() as $category_name) {
		$category_names[$category_name-> category_id] = $category_name -> category_name;
			}
		return $category_names;
		} else {
		return FALSE;
		}
		}
		public function view_byname()
		{
		$status=1;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_status', $status);
		$query = $this->db->get();
		return $query->result();
		}
    public function getlast($insert_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id', $insert_id);
        $query = $this->db->get();
        return $query->result();
    }            
		
}
?>