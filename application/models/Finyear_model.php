<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Finyear_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
	
    public function getFinyearTable($param){
		$arOrder = array('','fin_year');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('fin_year', $searchValue); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_finyear');
		$this->db->order_by('finyear_id','DESC');
		$this->db->where('finyear_status',1);
        $query = $this->db->get();
        
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getNewguestTotalCount($param);
        $data['recordsFiltered'] = $this->getNewguestTotalCount($param);
        return $data;
	}
	public function getNewguestTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('fin_year', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_finyear');
		//$this->db->where("finyear_status",1);
		$this->db->order_by('finyear_id', 'DESC');
		$this->db->where('finyear_status',1);
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