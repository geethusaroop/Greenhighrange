<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branchlogin_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	
    public function getCompanyTable($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue); 
        }
        //$this->db->where("finyear_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('admin_login');
        $this->db->join('tbl_branch','admin_login.branch_id_fk=branch_id','left');
		$this->db->order_by('id','DESC');
        $this->db->where('user_status',1);
       $this->db->where('admin_login.user_type','B');
        $this->db->where('admin_login.branch_id_fk !=',0);
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
            $this->db->like('branch_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('admin_login');
        $this->db->join('tbl_branch','admin_login.branch_id_fk=branch_id','left');
		$this->db->order_by('id','DESC');
        $this->db->where('user_status',1);
       $this->db->where('admin_login.user_type','B');
        $this->db->where('admin_login.branch_id_fk !=',0);
		$this->db->where('user_status',1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>