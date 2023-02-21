<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_login_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	
    public function getCompanyTable($param){
		$arOrder = array('','emp_fname');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_fname', $searchValue); 
        }
        //$this->db->where("finyear_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('admin_login');
        $this->db->join('tbl_employee','admin_login.emp_id=tbl_employee.emp_id','left');
		$this->db->order_by('id','DESC');
        $this->db->where('user_status',1);
        $where = '(admin_login.user_type="OA" or admin_login.user_type = "E")';
        $this->db->where($where);
       // $this->db->where('admin_login.user_type','E');
        $this->db->where('admin_login.emp_id !=',0);
		$this->db->where('user_status',1);
        $query = $this->db->get();
        
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCompanyTotalCount($param);
        $data['recordsFiltered'] = $this->getCompanyTotalCount($param);
        return $data;
	}
	public function getCompanyTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('emp_fname', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('admin_login');
        $this->db->join('tbl_employee','admin_login.emp_id=tbl_employee.emp_id','left');
		$this->db->order_by('id', 'DESC');
        $where = '(admin_login.user_type="OA" or admin_login.user_type = "E")';
        $this->db->where($where);
        //$this->db->where('admin_login.user_type','E');
        $this->db->where('admin_login.emp_id !=',0);
		$this->db->where('user_status',1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function getdes($id)
    {
        $this->db->select('*')->from('tbl_employee');
        $this->db->like('emp_id',$id);
        $this->db->where('emp_status',1);
        $query = $this->db->get();
        return $query->row();
    }
		
}
?>