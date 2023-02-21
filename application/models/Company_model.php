<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	
    public function getCompanyTable($param){
		$arOrder = array('','info_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('info_name', $searchValue); 
        }
        //$this->db->where("finyear_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_company_info');
		$this->db->order_by('info_id','DESC');
		$this->db->where('info_status',1);
        $query = $this->db->get();
        
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCompanyTotalCount($param);
        $data['recordsFiltered'] = $this->getCompanyTotalCount($param);
        return $data;
	}
	public function getCompanyTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('info_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_company_info');
		//$this->db->where("finyear_status",1);
		$this->db->order_by('info_id', 'DESC');
		$this->db->where('info_status',1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
		public function getvalues()
	{
		$this->db->select('*'); 
		$this->db->from('tbl_finyear');   
		$query = $this->db->get();
		return $query->result();
	}
		
}
?>